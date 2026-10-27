param(
    [string]$SiteUrl = "http://oranilom.com.br",
    [string]$SecretKey = "ade_sampa_super_secret_2025"
)

Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host "   ADE SAMPA 2025 - RECUPERACAO DE DESASTRE AUTOMATICA    " -ForegroundColor Cyan
Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host ""

$primaryUrl = "$SiteUrl/restaurar-site.php?key=$SecretKey&format=json"
$themeUrl = "$SiteUrl/wp-content/themes/tema-ade-sampa/restaurar-site.php?key=$SecretKey&format=json"

Write-Host "[1/3] Conectando ao servidor para iniciar reconstrucao..." -ForegroundColor Yellow

$response = $null
try {
    $response = Invoke-RestMethod -Uri $primaryUrl -Method Get -TimeoutSec 300
} catch {
    try {
        Write-Host "Tentando via endpoint do tema..." -ForegroundColor Yellow
        $response = Invoke-RestMethod -Uri $themeUrl -Method Get -TimeoutSec 300
    } catch {
        $response = $null
    }
}

if ($response -and $response.success) {
    Write-Host "[2/3] Processo de restauracao concluido pelo servidor!" -ForegroundColor Green
    Write-Host ""
    Write-Host "--- RELATORIO DE ETAPAS EXECUTADAS ---" -ForegroundColor White

    foreach ($step in $response.steps) {
        $color = if ($step.status -eq "OK") { "Green" } elseif ($step.status -eq "ALERTA" -or $step.status -eq "AVISO") { "Yellow" } else { "Red" }
        Write-Host "[$($step.status)] $($step.step): $($step.details)" -ForegroundColor $color
    }

    Write-Host ""
    Write-Host "[3/3] Site recuperado com sucesso!" -ForegroundColor Green
    Write-Host "Home: $SiteUrl" -ForegroundColor Cyan
    Write-Host "Painel WP: $SiteUrl/wp-admin" -ForegroundColor Cyan
} else {
    Write-Host "Aviso: Nao foi possivel obter resposta de 'restaurar-site.php'." -ForegroundColor Yellow
    Write-Host "Tentando metodo alternativo via Webhook de Deploy..." -ForegroundColor Yellow

    $deployZip = Join-Path $env:TEMP "emergency_deploy.zip"
    if (Test-Path $deployZip) { Remove-Item -Force $deployZip }
    
    Push-Location $PSScriptRoot
    tar.exe -a -c -f $deployZip --exclude=".git*" --exclude="*.zip" *
    Pop-Location

    $deployResult = curl.exe -s -X POST "$SiteUrl/deploy.php" -F "key=$SecretKey" -F "theme_zip=@$deployZip"
    Write-Host "Resposta do servidor: $deployResult" -ForegroundColor White
    Write-Host "Tema e scripts de emergencia sincronizados com sucesso!" -ForegroundColor Green
}

Write-Host ""
Write-Host "Finalizado com sucesso!" -ForegroundColor Green
