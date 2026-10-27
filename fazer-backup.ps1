param(
    [string]$SiteUrl = "http://oranilom.com.br",
    [string]$SecretKey = "ade_sampa_super_secret_2025",
    [string]$OutputDir = ""
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

# 2. Conectando ao servidor para gerar e baixar dump do banco de dados
Write-Host "[2/3] Solicitando dump do banco de dados e arquivos de configuracao..." -ForegroundColor Yellow

$dbBackupFile = Join-Path $OutputDir "backup_banco_dados_oranilom_$timestamp.zip"
$primaryDownloadUrl = "$SiteUrl/backup-site.php?key=$SecretKey&download=1"
$themeDownloadUrl = "$SiteUrl/wp-content/themes/tema-ade-sampa/backup-site.php?key=$SecretKey&download=1"

$downloadSuccess = $false
try {
    Write-Host "  -> Conectando em $primaryDownloadUrl ..." -ForegroundColor Gray
    curl.exe -s -f -L "$primaryDownloadUrl" -o "$dbBackupFile"
    if ((Test-Path $dbBackupFile) -and ((Get-Item $dbBackupFile).Length -gt 1000)) {
        $downloadSuccess = $true
    }
} catch {}

if (-not $downloadSuccess) {
    try {
        Write-Host "  -> Tentando via endpoint do tema: $themeDownloadUrl ..." -ForegroundColor Gray
        curl.exe -s -f -L "$themeDownloadUrl" -o "$dbBackupFile"
        if ((Test-Path $dbBackupFile) -and ((Get-Item $dbBackupFile).Length -gt 1000)) {
            $downloadSuccess = $true
        }
    } catch {}
}

if ($downloadSuccess) {
    $dbSize = (Get-Item $dbBackupFile).Length / 1KB
    Write-Host "  -> Backup remoto baixado com sucesso: $dbBackupFile ($([math]::Round($dbSize, 2)) KB)" -ForegroundColor Green
} else {
    Write-Host "  -> Nao foi possivel baixar o dump do banco diretamente." -ForegroundColor Yellow
    Write-Host "     Verifique se backup-site.php ja foi publicado no servidor ou use deploy.php." -ForegroundColor Yellow
}

# 3. Resumo final
Write-Host ""
Write-Host "[3/3] Resumo dos Backups Salvos:" -ForegroundColor Green
Get-ChildItem -Path $OutputDir -Filter "*.zip" | Sort-Object LastWriteTime -Descending | Select-Object -First 5 | ForEach-Object {
    Write-Host ("  - {0} ({1:N2} MB) - {2}" -f $_.Name, ($_.Length / 1MB), $_.LastWriteTime) -ForegroundColor White
}

Write-Host ""
Write-Host "Processo finalizado com sucesso!" -ForegroundColor Green
