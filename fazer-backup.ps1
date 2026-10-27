param(
    [string]$SiteUrl = "http://oranilom.com.br",
    [string]$SecretKey = "ade_sampa_super_secret_2025",
    [string]$OutputDir = "",
    [switch]$Completo,
    [switch]$ScanOnly
)

Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host "       ADE SAMPA 2025 - BACKUP COMPLETO DO SITE           " -ForegroundColor Cyan
Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host ""

if ([string]::IsNullOrWhiteSpace($OutputDir)) {
    $OutputDir = Join-Path $PSScriptRoot "backups"
}

if (!(Test-Path $OutputDir)) {
    New-Item -ItemType Directory -Path $OutputDir -Force | Out-Null
}

$timestamp = Get-Date -Format "yyyyMMdd_HHmmss"

# Modo Diagnóstico / Scan
if ($ScanOnly) {
    Write-Host "[Diagnostico] Mapeando estrutura e tamanho da pasta www no servidor..." -ForegroundColor Yellow
    $scanUrl = "$SiteUrl/backup-site.php?key=$SecretKey&scan=1"
    try {
        $scan = Invoke-RestMethod -Uri $scanUrl -Method Get -TimeoutSec 60
        Write-Host "Raiz detectada: $($scan.root_dir)" -ForegroundColor White
        Write-Host "Total de arquivos: $($scan.total_files)" -ForegroundColor White
        Write-Host "Total de diretorios: $($scan.total_dirs)" -ForegroundColor White
        Write-Host "Tamanho total descompactado: $($scan.total_megabytes) MB" -ForegroundColor Green
        Write-Host ""
        Write-Host "Distribuicao por pasta:" -ForegroundColor Cyan
        $scan.breakdown.PSObject.Properties | ForEach-Object {
            $mb = [math]::Round($_.Value.bytes / 1MB, 2)
            Write-Host ("  - {0,-20}: {1,5} arquivos ({2,7} MB)" -f $_.Name, $_.Value.files, $mb) -ForegroundColor Gray
        }
    } catch {
        Write-Host "Erro ao consultar diagnostico: $_" -ForegroundColor Red
    }
    return
}

# 1. Backup do tema local
Write-Host "[1/3] Gerando pacote de backup do tema local..." -ForegroundColor Yellow
$themeBackupFile = Join-Path $OutputDir "backup_tema_ade_sampa_v2.1.3_$timestamp.zip"
Push-Location $PSScriptRoot
try {
    tar.exe -a -c -f $themeBackupFile --exclude=".git" --exclude=".github" --exclude="backups" --exclude="*.zip" *
    $themeSize = (Get-Item $themeBackupFile).Length / 1MB
    Write-Host "  -> Tema empacotado: $themeBackupFile ($([math]::Round($themeSize, 2)) MB)" -ForegroundColor Green
} catch {
    Write-Host "  -> Erro ao gerar pacote do tema: $_" -ForegroundColor Red
} finally {
    Pop-Location
}

# 2. Conectando ao servidor para gerar e baixar backup
$isFull = $Completo.IsPresent
$modeName = if ($isFull) { "ESTRUTURA COMPLETA DA PASTA WWW (WordPress + Plugins + Uploads + Banco)" } else { "PADRAO (Banco de Dados + wp-config + Tema)" }
$targetFile = if ($isFull) { "backup_completo_www_oranilom_$timestamp.zip" } else { "backup_banco_dados_oranilom_$timestamp.zip" }
$fullParam = if ($isFull) { "&full=1" } else { "" }

Write-Host "[2/3] Solicitando $modeName..." -ForegroundColor Yellow

$dbBackupFile = Join-Path $OutputDir $targetFile
$primaryDownloadUrl = "$SiteUrl/backup-site.php?key=$SecretKey$fullParam&download=1"
$themeDownloadUrl = "$SiteUrl/wp-content/themes/tema-ade-sampa/backup-site.php?key=$SecretKey$fullParam&download=1"

$downloadSuccess = $false
try {
    Write-Host "  -> Solicitando arquivo do servidor (pode levar alguns segundos para compactar toda a pasta www)..." -ForegroundColor Gray
    curl.exe -s -f -L "$primaryDownloadUrl" -o "$dbBackupFile"
    if ((Test-Path $dbBackupFile) -and ((Get-Item $dbBackupFile).Length -gt 1000)) {
        $downloadSuccess = $true
    }
} catch {}

if (-not $downloadSuccess) {
    try {
        Write-Host "  -> Tentando via endpoint alternativo do tema..." -ForegroundColor Gray
        curl.exe -s -f -L "$themeDownloadUrl" -o "$dbBackupFile"
        if ((Test-Path $dbBackupFile) -and ((Get-Item $dbBackupFile).Length -gt 1000)) {
            $downloadSuccess = $true
        }
    } catch {}
}

if ($downloadSuccess) {
    $dbSize = (Get-Item $dbBackupFile).Length / 1MB
    Write-Host "  -> Backup baixado com sucesso: $dbBackupFile ($([math]::Round($dbSize, 2)) MB)" -ForegroundColor Green
} else {
    Write-Host "  -> Nao foi possivel baixar o backup automaticamente." -ForegroundColor Yellow
}

# 3. Resumo final
Write-Host ""
Write-Host "[3/3] Resumo dos Arquivos na Pasta de Backups:" -ForegroundColor Green
Get-ChildItem -Path $OutputDir -Filter "*.zip" | Sort-Object LastWriteTime -Descending | Select-Object -First 10 | ForEach-Object {
    Write-Host ("  - {0} ({1:N2} MB) - {2}" -f $_.Name, ($_.Length / 1MB), $_.LastWriteTime) -ForegroundColor White
}

Write-Host ""
Write-Host "Processo finalizado com sucesso!" -ForegroundColor Green
