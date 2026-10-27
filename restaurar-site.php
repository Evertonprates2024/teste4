<?php
/**
 * ADE SAMPA 2025 - Script de Recuperação de Desastre (Disaster Recovery)
 *
 * Reconstrói automaticamente:
 * 1. WordPress Core oficial (wp-admin, wp-includes, arquivos raiz)
 * 2. Estrutura de pastas wp-content/ (themes, plugins, uploads)
 * 3. Tema oficial ADE SAMPA direto do GitHub (brunnomolinaro/tema-ade-sampa)
 * 4. Plugins essenciais (Elementor) direto do repositório oficial do WordPress
 * 5. Permissões de escrita e verificação de integridade
 *
 * Uso:
 * Acesse no navegador: http://oranilom.com.br/restaurar-site.php?key=ade_sampa_super_secret_2025
 * Ou via terminal/curl: curl -s "http://oranilom.com.br/restaurar-site.php?key=ade_sampa_super_secret_2025"
 */

// Chave mestra de segurança
define('RECOVERY_KEY', 'ade_sampa_super_secret_2025');

// Permite execução sem limite de tempo para download dos pacotes
@set_time_limit(300);
@ini_set('memory_limit', '256M');

$received_key = isset($_POST['key']) ? $_POST['key'] : (isset($_GET['key']) ? $_GET['key'] : '');
$is_json = (isset($_GET['format']) && $_GET['format'] === 'json') || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

if (empty($received_key) || $received_key !== RECOVERY_KEY) {
    http_response_code(403);
    if ($is_json) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => false, 'error' => 'Acesso negado: chave de recuperação inválida.']);
    } else {
        echo '<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Acesso Negado</title><style>body{font-family:sans-serif;padding:40px;background:#f8f9fa;color:#721c24;}</style></head><body><h1>403 - Acesso Negado</h1><p>Chave de segurança incorreta ou não informada.</p></body></html>';
    }
    exit;
}

// Auto-detecta a raiz do WordPress (funciona tanto na raiz 'www/' quanto dentro de 'wp-content/themes/tema-ade-sampa/')
if (file_exists(__DIR__ . '/wp-config.php') || is_dir(__DIR__ . '/wp-content')) {
    $root_dir = __DIR__;
} elseif (file_exists(dirname(__DIR__, 3) . '/wp-config.php') || is_dir(dirname(__DIR__, 3) . '/wp-content')) {
    $root_dir = dirname(__DIR__, 3);
} else {
    $root_dir = realpath(__DIR__ . '/../../..') ?: dirname(__DIR__, 3);
}

// Sincroniza automaticamente a cópia na raiz (www) e a cópia no tema
$root_copy  = $root_dir . '/restaurar-site.php';
$theme_copy = $root_dir . '/wp-content/themes/tema-ade-sampa/restaurar-site.php';

if (__FILE__ === $root_copy && is_dir(dirname($theme_copy))) {
    @copy($root_copy, $theme_copy);
} elseif (__FILE__ === $theme_copy && is_dir($root_dir)) {
    @copy($theme_copy, $root_copy);
}
$temp_dir = sys_get_temp_dir() . '/wp_recovery_' . time();
if (!is_dir($temp_dir)) {
    mkdir($temp_dir, 0755, true);
}

$steps_log = [];

function log_step($title, $status = 'OK', $details = '') {
    global $steps_log;
    $steps_log[] = [
        'step' => $title,
        'status' => $status,
        'details' => $details,
        'time' => date('H:i:s')
    ];
}

function download_file($url, $destination, $headers = []) {
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        $fp = fopen($destination, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_USERAGENT, 'ADE-SAMPA-Disaster-Recovery/2.0');
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 180);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fp);
        return $res && ($http_code >= 200 && $http_code < 400) && filesize($destination) > 1000;
    } else {
        return copy($url, $destination);
    }
}

// --------------------------------------------------------------------------
// 1. RECUPERAÇÃO DO CORE WORDPRESS (wp-admin, wp-includes, arquivos raiz)
// --------------------------------------------------------------------------
$need_wp_core = !is_dir($root_dir . '/wp-admin') || !is_dir($root_dir . '/wp-includes') || !file_exists($root_dir . '/index.php');

if ($need_wp_core) {
    $wp_zip = $temp_dir . '/wordpress.zip';
    $wp_url = 'https://pt-br.wordpress.org/latest-pt_BR.zip';
    
    if (download_file($wp_url, $wp_zip)) {
        $zip = new ZipArchive();
        if ($zip->open($wp_zip) === TRUE) {
            $zip->extractTo($temp_dir);
            $zip->close();
            
            // Move wp-admin, wp-includes e arquivos da raiz para $root_dir
            $extracted_wp = $temp_dir . '/wordpress';
            if (is_dir($extracted_wp)) {
                $dir_iterator = new RecursiveDirectoryIterator($extracted_wp, RecursiveDirectoryIterator::SKIP_DOTS);
                $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

                foreach ($iterator as $item) {
                    $subPath = substr($item->getPathname(), strlen($extracted_wp) + 1);
                    $destPath = $root_dir . '/' . $subPath;

                    // Não sobrescrever wp-config.php existente
                    if ($subPath === 'wp-config.php' && file_exists($destPath)) {
                        continue;
                    }
                    // Não sobrescrever pastas de tema existente se não estiver vazia
                    if (strpos($subPath, 'wp-content/themes') === 0 && file_exists($destPath)) {
                        continue;
                    }

                    if ($item->isDir()) {
                        if (!is_dir($destPath)) {
                            mkdir($destPath, 0755, true);
                        }
                    } else {
                        $parent = dirname($destPath);
                        if (!is_dir($parent)) {
                            mkdir($parent, 0755, true);
                        }
                        copy($item->getPathname(), $destPath);
                    }
                }
                log_step('WordPress Core Oficial (pt_BR)', 'OK', 'wp-admin, wp-includes e arquivos raiz restaurados com sucesso.');
            } else {
                log_step('WordPress Core Oficial', 'AVISO', 'Estrutura descompactada não encontrada.');
            }
        } else {
            log_step('WordPress Core Oficial', 'ERRO', 'Não foi possível descompactar o pacote do WordPress.');
        }
    } else {
        log_step('WordPress Core Oficial', 'ERRO', 'Falha ao baixar pacote oficial do WordPress.org.');
    }
} else {
    log_step('WordPress Core Oficial', 'OK', 'wp-admin e wp-includes já estão íntegros e preservados.');
}

// --------------------------------------------------------------------------
// 2. RECUPERAÇÃO DA ESTRUTURA WP-CONTENT
// --------------------------------------------------------------------------
$content_dir = $root_dir . '/wp-content';
$themes_dir  = $content_dir . '/themes';
$plugins_dir = $content_dir . '/plugins';
$uploads_dir = $content_dir . '/uploads';

foreach ([$content_dir, $themes_dir, $plugins_dir, $uploads_dir] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}
log_step('Estrutura de Pastas wp-content', 'OK', 'themes, plugins e uploads verificados e ativos.');

// --------------------------------------------------------------------------
// 3. RECUPERAÇÃO DO TEMA ADE SAMPA DIRETO DO GITHUB
// --------------------------------------------------------------------------
$theme_target_dir = $themes_dir . '/tema-ade-sampa';
$theme_is_present = file_exists($theme_target_dir . '/style.css') && file_exists($theme_target_dir . '/front-page.php');

if ($theme_is_present) {
    log_step('Tema ADE SAMPA 2025 (GitHub)', 'OK', 'Tema tema-ade-sampa já se encontra íntegro e instalado.');
} else {
    $github_zip = $temp_dir . '/github-theme.zip';
    $github_url = 'https://api.github.com/repos/brunnomolinaro/tema-ade-sampa/zipball/main';
    $github_token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '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';
    $headers = [
        'Authorization: token ' . $github_token,
        'Accept: application/vnd.github.v3+json',
        'User-Agent: ADE-SAMPA-Recovery/2.0'
    ];

    if (download_file($github_url, $github_zip, $headers)) {
        $zip = new ZipArchive();
        if ($zip->open($github_zip) === TRUE) {
            $zip_extracted = $temp_dir . '/theme_extracted';
            $zip->extractTo($zip_extracted);
            $zip->close();

            if (!is_dir($theme_target_dir)) {
                mkdir($theme_target_dir, 0755, true);
            }

            // O GitHub nomeia a pasta raiz como 'brunnomolinaro-tema-ade-sampa-<hash>'
            $extracted_dirs = glob($zip_extracted . '/*', GLOB_ONLYDIR);
            $github_folder = !empty($extracted_dirs) ? $extracted_dirs[0] : '';

            if ($github_folder && is_dir($github_folder)) {
                $dir_iterator = new RecursiveDirectoryIterator($github_folder, RecursiveDirectoryIterator::SKIP_DOTS);
                $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);

                foreach ($iterator as $item) {
                    $subPath = substr($item->getPathname(), strlen($github_folder) + 1);
                    $destPath = $theme_target_dir . '/' . $subPath;

                    if ($item->isDir()) {
                        if (!is_dir($destPath)) {
                            mkdir($destPath, 0755, true);
                        }
                    } else {
                        $parent = dirname($destPath);
                        if (!is_dir($parent)) {
                            mkdir($parent, 0755, true);
                        }
                        copy($item->getPathname(), $destPath);
                    }
                }
                log_step('Tema ADE SAMPA 2025 (GitHub)', 'OK', 'Tema baixado do repositório GitHub e instalado em wp-content/themes/tema-ade-sampa.');
            } else {
                log_step('Tema ADE SAMPA 2025 (GitHub)', 'AVISO', 'Subpasta do tema não localizada no zip.');
            }
        } else {
            log_step('Tema ADE SAMPA 2025 (GitHub)', 'ERRO', 'Falha ao descompactar o tema do GitHub.');
        }
    } else {
        log_step('Tema ADE SAMPA 2025 (GitHub)', 'ERRO', 'Falha ao baixar o tema do repositório GitHub.');
    }
}

// --------------------------------------------------------------------------
// 4. RECUPERAÇÃO DO PLUGIN ELEMENTOR (OFICIAL)
// --------------------------------------------------------------------------
$elementor_dir = $plugins_dir . '/elementor';
if (!is_dir($elementor_dir)) {
    $elementor_zip = $temp_dir . '/elementor.zip';
    $elementor_url = 'https://downloads.wordpress.org/plugin/elementor.latest-stable.zip';
    
    if (download_file($elementor_url, $elementor_zip)) {
        $zip = new ZipArchive();
        if ($zip->open($elementor_zip) === TRUE) {
            $zip->extractTo($plugins_dir);
            $zip->close();
            log_step('Plugin Elementor (Oficial)', 'OK', 'Elementor baixado e instalado em wp-content/plugins/elementor.');
        } else {
            log_step('Plugin Elementor', 'ERRO', 'Falha ao descompactar o Elementor.');
        }
    } else {
        log_step('Plugin Elementor', 'ERRO', 'Falha ao baixar o Elementor do repositório oficial.');
    }
} else {
    log_step('Plugin Elementor', 'OK', 'Plugin já se encontra instalado.');
}

// --------------------------------------------------------------------------
// 5. VERIFICAÇÃO DO WP-CONFIG.PHP
// --------------------------------------------------------------------------
if (file_exists($root_dir . '/wp-config.php')) {
    log_step('Configuração de Banco de Dados (wp-config.php)', 'OK', 'Arquivo wp-config.php presente e preservado.');
} else {
    log_step('Configuração de Banco de Dados (wp-config.php)', 'ALERTA', 'wp-config.php não encontrado. Se o arquivo foi apagado, restaure as credenciais do banco da KingHost.');
}

// Limpeza de arquivos temporários
function remove_dir_recursive($dir) {
    if (!is_dir($dir)) return;
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . '/' . $item;
        is_dir($path) ? remove_dir_recursive($path) : @unlink($path);
    }
    @rmdir($dir);
}
remove_dir_recursive($temp_dir);

// Resposta JSON ou HTML
if ($is_json) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => true,
        'message' => 'Processo de recuperação de desastre finalizado com sucesso.',
        'timestamp' => date('Y-m-d H:i:s'),
        'steps' => $steps_log
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADE SAMPA — Relatório de Recuperação do Site</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #0F172A; color: #E2E8F0; padding: 40px 20px; line-height: 1.5; }
        .card { max-width: 760px; margin: 0 auto; background: #1E293B; border-radius: 12px; border: 1px solid #334155; padding: 32px; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .header { display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #334155; padding-bottom: 20px; margin-bottom: 24px; }
        .header h1 { font-size: 1.4rem; color: #38BDF8; font-weight: 700; }
        .badge { background: #0284C7; color: white; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        .steps { list-style: none; display: flex; flex-direction: column; gap: 14px; }
        .step-item { background: #0F172A; border: 1px solid #334155; border-radius: 8px; padding: 14px 18px; display: flex; align-items: flex-start; justify-content: space-between; }
        .step-title { font-weight: 600; color: #F8FAFC; margin-bottom: 4px; font-size: 0.95rem; }
        .step-desc { font-size: 0.85rem; color: #94A3B8; }
        .status-pill { font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 6px; text-transform: uppercase; }
        .status-OK { background: rgba(34, 197, 94, 0.15); color: #4ADE80; border: 1px solid rgba(74, 222, 128, 0.3); }
        .status-ALERTA, .status-AVISO { background: rgba(234, 179, 8, 0.15); color: #FACC15; border: 1px solid rgba(250, 204, 21, 0.3); }
        .status-ERRO { background: rgba(239, 68, 68, 0.15); color: #F87171; border: 1px solid rgba(248, 113, 113, 0.3); }
        .actions { margin-top: 30px; padding-top: 20px; border-top: 1px solid #334155; display: flex; gap: 14px; }
        .btn { display: inline-block; padding: 10px 20px; background: #0284C7; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 0.9rem; transition: background 0.15s; }
        .btn:hover { background: #0369A1; }
        .btn-outline { background: transparent; border: 1px solid #64748B; color: #CBD5E1; }
        .btn-outline:hover { background: #334155; color: white; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <div>
                <h1>Portal ADE SAMPA — Recuperação de Desastre</h1>
                <p style="font-size: 0.85rem; color: #94A3B8; margin-top: 4px;">Restauração de Core, Tema GitHub e Plugins</p>
            </div>
            <span class="badge">v2.1.2</span>
        </div>

        <ul class="steps">
            <?php foreach ($steps_log as $s): ?>
                <li class="step-item">
                    <div>
                        <div class="step-title"><?php echo htmlspecialchars($s['step']); ?></div>
                        <div class="step-desc"><?php echo htmlspecialchars($s['details']); ?></div>
                    </div>
                    <span class="status-pill status-<?php echo htmlspecialchars($s['status']); ?>"><?php echo htmlspecialchars($s['status']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="actions">
            <a href="/" class="btn" target="_blank">Acessar Home do Site &rarr;</a>
            <a href="/wp-admin" class="btn btn-outline" target="_blank">Acessar Painel WP &rarr;</a>
        </div>
    </div>
</body>
</html>
