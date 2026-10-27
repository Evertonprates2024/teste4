<?php
/**
 * ADE SAMPA 2025 - Script de Backup Completo do Site e Banco de Dados
 *
 * Suporta dois modos de backup:
 * 1. MODO PADRÃO (Rápido):
 *    - Dump SQL completo de todas as tabelas do WordPress
 *    - Cópia segura de wp-config.php
 *    - Tema oficial compactado (tema-ade-sampa-v2.1.3.zip)
 *    - Manifesto do sistema (backup_info.json)
 *
 * 2. MODO COMPLETO (Toda a pasta www / Full WordPress):
 *    - Dump SQL completo de todas as tabelas do WordPress
 *    - Estrutura completa de diretórios e arquivos da raiz (www):
 *      * wp-admin/
 *      * wp-includes/
 *      * wp-content/ (todos os plugins, temas e uploads de mídia)
 *      * Arquivos de raiz (.htaccess, wp-config.php, index.php, etc.)
 *    - Manifesto do sistema (backup_info.json)
 *    - Exclusões inteligentes: backups anteriores (.zip) e pastas temporárias
 *
 * Uso:
 * - Backup Padrão (HTML):    http://oranilom.com.br/backup-site.php?key=ade_sampa_super_secret_2025
 * - Backup Padrão (Download): http://oranilom.com.br/backup-site.php?key=ade_sampa_super_secret_2025&download=1
 * - Backup Completo WWW (HTML): http://oranilom.com.br/backup-site.php?key=ade_sampa_super_secret_2025&full=1
 * - Backup Completo WWW (Download): http://oranilom.com.br/backup-site.php?key=ade_sampa_super_secret_2025&full=1&download=1
 * - Consulta de Status / Scan (JSON): http://oranilom.com.br/backup-site.php?key=ade_sampa_super_secret_2025&scan=1
 *
 * @package Tema_ADE_Sampa
 */

define( 'BACKUP_SECURITY_KEY', 'ade_sampa_super_secret_2025' );

@set_time_limit( 600 );
@ini_set( 'memory_limit', '1024M' );
@ignore_user_abort( true );

$received_key = isset( $_REQUEST['key'] ) ? trim( $_REQUEST['key'] ) : '';
$is_download  = isset( $_GET['download'] ) && $_GET['download'] === '1';
$is_full      = ( isset( $_GET['full'] ) && $_GET['full'] === '1' ) || ( isset( $_GET['type'] ) && $_GET['type'] === 'full' );
$is_scan      = isset( $_GET['scan'] ) && $_GET['scan'] === '1';
$is_json      = ( isset( $_GET['format'] ) && $_GET['format'] === 'json' ) ||
                ( isset( $_SERVER['HTTP_ACCEPT'] ) && strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false );

if ( empty( $received_key ) || $received_key !== BACKUP_SECURITY_KEY ) {
	http_response_code( 403 );
	if ( $is_json ) {
		header( 'Content-Type: application/json; charset=utf-8' );
		echo json_encode( array( 'success' => false, 'error' => 'Acesso negado: chave de segurança inválida.' ) );
	} else {
		echo '<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><title>Acesso Negado</title><style>body{font-family:sans-serif;padding:40px;background:#f8f9fa;color:#721c24;}</style></head><body><h1>403 - Acesso Negado</h1><p>Chave de segurança incorreta ou não informada.</p></body></html>';
	}
	exit;
}

// 1. Auto-detecta a raiz do WordPress
if ( file_exists( __DIR__ . '/wp-config.php' ) || is_dir( __DIR__ . '/wp-content' ) ) {
	$root_dir = __DIR__;
} elseif ( file_exists( dirname( __DIR__, 3 ) . '/wp-config.php' ) || is_dir( dirname( __DIR__, 3 ) . '/wp-content' ) ) {
	$root_dir = dirname( __DIR__, 3 );
} else {
	$root_dir = realpath( __DIR__ . '/../../..' ) ?: dirname( __DIR__, 3 );
}

// Sincroniza automaticamente a cópia na raiz (www) e a cópia no tema
$root_copy  = $root_dir . '/backup-site.php';
$theme_copy = $root_dir . '/wp-content/themes/tema-ade-sampa/backup-site.php';

if ( __FILE__ === $root_copy && is_dir( dirname( $theme_copy ) ) ) {
	@copy( $root_copy, $theme_copy );
} elseif ( __FILE__ === $theme_copy && is_dir( $root_dir ) ) {
	@copy( $theme_copy, $root_copy );
}

// 2. Modo Scan / Diagnóstico
if ( $is_scan ) {
	$scan_start  = microtime( true );
	$total_files = 0;
	$total_dirs  = 0;
	$total_bytes = 0;
	$breakdown   = array();

	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $root_dir, RecursiveDirectoryIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::SELF_FIRST
	);

	foreach ( $iterator as $item ) {
		$path           = $item->getPathname();
		$rel_path       = ltrim( substr( $path, strlen( $root_dir ) ), '/\\' );
		$rel_normalized = str_replace( '\\', '/', $rel_path );

		if ( strpos( $rel_normalized, 'wp-content/uploads/backups' ) === 0 || substr( $rel_normalized, -4 ) === '.zip' || strpos( $rel_normalized, '.git' ) === 0 ) {
			continue;
		}

		$parts    = explode( '/', $rel_normalized );
		$top_part = $parts[0];
		if ( ! isset( $breakdown[ $top_part ] ) ) {
			$breakdown[ $top_part ] = array( 'files' => 0, 'bytes' => 0 );
		}

		if ( $item->isDir() ) {
			$total_dirs++;
		} elseif ( $item->isFile() ) {
			$size = $item->getSize();
			$total_files++;
			$total_bytes += $size;
			$breakdown[ $top_part ]['files']++;
			$breakdown[ $top_part ]['bytes'] += $size;
		}
	}

	header( 'Content-Type: application/json; charset=utf-8' );
	echo json_encode(
		array(
			'success'         => true,
			'root_dir'        => $root_dir,
			'total_files'     => $total_files,
			'total_dirs'      => $total_dirs,
			'total_bytes'     => $total_bytes,
			'total_megabytes' => round( $total_bytes / ( 1024 * 1024 ), 2 ),
			'scan_seconds'    => round( microtime( true ) - $scan_start, 3 ),
			'breakdown'       => $breakdown,
		),
		JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
	);
	exit;
}

$wp_config_file = $root_dir . '/wp-config.php';
if ( ! file_exists( $wp_config_file ) ) {
	$response = array(
		'success' => false,
		'error'   => 'Arquivo wp-config.php não encontrado na raiz: ' . $root_dir,
	);
	if ( $is_json ) {
		header( 'Content-Type: application/json; charset=utf-8' );
		echo json_encode( $response );
	} else {
		echo '<h1>Erro</h1><p>' . htmlspecialchars( $response['error'] ) . '</p>';
	}
	exit;
}

// 3. Extrai credenciais do banco de dados de wp-config.php
$config_content = file_get_contents( $wp_config_file );
preg_match( "/define\s*\(\s*['\"]DB_NAME['\"]\s*,\s*['\"](.*?)['\"]\s*\)/", $config_content, $m_name );
preg_match( "/define\s*\(\s*['\"]DB_USER['\"]\s*,\s*['\"](.*?)['\"]\s*\)/", $config_content, $m_user );
preg_match( "/define\s*\(\s*['\"]DB_PASSWORD['\"]\s*,\s*['\"](.*?)['\"]\s*\)/", $config_content, $m_pass );
preg_match( "/define\s*\(\s*['\"]DB_HOST['\"]\s*,\s*['\"](.*?)['\"]\s*\)/", $config_content, $m_host );
preg_match( "/\\\$table_prefix\s*=\s*['\"](.*?)['\"]/", $config_content, $m_prefix );

$db_name   = $m_name[1] ?? '';
$db_user   = $m_user[1] ?? '';
$db_pass   = $m_pass[1] ?? '';
$db_host   = $m_host[1] ?? 'localhost';
$db_prefix = $m_prefix[1] ?? 'wp_';

if ( empty( $db_name ) || empty( $db_user ) ) {
	$response = array( 'success' => false, 'error' => 'Não foi possível ler as credenciais do banco em wp-config.php.' );
	if ( $is_json ) {
		header( 'Content-Type: application/json; charset=utf-8' );
		echo json_encode( $response );
	} else {
		echo '<h1>Erro</h1><p>' . $response['error'] . '</p>';
	}
	exit;
}

// 4. Conecta ao MySQL e gera Dump SQL
$mysqli = @new mysqli( $db_host, $db_user, $db_pass, $db_name );
if ( $mysqli->connect_error ) {
	$response = array( 'success' => false, 'error' => 'Falha ao conectar no MySQL: ' . $mysqli->connect_error );
	if ( $is_json ) {
		header( 'Content-Type: application/json; charset=utf-8' );
		echo json_encode( $response );
	} else {
		echo '<h1>Erro de Conexão</h1><p>' . $response['error'] . '</p>';
	}
	exit;
}
$mysqli->set_charset( 'utf8mb4' );

$timestamp     = date( 'Y-m-d_H-i-s' );
$date_readable = date( 'd/m/Y H:i:s' );
$mode_label    = $is_full ? 'ESTRUTURA COMPLETA (WWW + BANCO)' : 'PADRÃO (BANCO + CONFIGS + TEMA)';

$sql_dump  = "-- ============================================================\n";
$sql_dump .= "-- ADE SAMPA 2025 - BACKUP DO BANCO DE DADOS WORDPRESS\n";
$sql_dump .= "-- Modo            : {$mode_label}\n";
$sql_dump .= "-- Data de Geração : {$date_readable}\n";
$sql_dump .= "-- Banco de Dados  : {$db_name}\n";
$sql_dump .= "-- Host            : {$db_host}\n";
$sql_dump .= "-- Prefixo Tabelas : {$db_prefix}\n";
$sql_dump .= "-- ============================================================\n\n";
$sql_dump .= "SET FOREIGN_KEY_CHECKS=0;\n";
$sql_dump .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
$sql_dump .= "SET AUTOCOMMIT = 0;\n";
$sql_dump .= "START TRANSACTION;\n";
$sql_dump .= "SET time_zone = \"+00:00\";\n\n";

$tables_res    = $mysqli->query( 'SHOW TABLES' );
$tables        = array();
$total_records = 0;

while ( $row = $tables_res->fetch_array() ) {
	$tables[] = $row[0];
}

foreach ( $tables as $table ) {
	$sql_dump .= "-- ------------------------------------------------------------\n";
	$sql_dump .= "-- Estrutura da tabela `{$table}`\n";
	$sql_dump .= "-- ------------------------------------------------------------\n";
	$sql_dump .= "DROP TABLE IF EXISTS `{$table}`;\n";

	$create_res = $mysqli->query( "SHOW CREATE TABLE `{$table}`" );
	if ( $create_res ) {
		$create_row = $create_res->fetch_row();
		$sql_dump  .= $create_row[1] . ";\n\n";
		$create_res->free();
	}

	$data_res = $mysqli->query( "SELECT * FROM `{$table}`" );
	if ( $data_res ) {
		$num_fields     = $data_res->field_count;
		$num_rows       = $data_res->num_rows;
		$total_records += $num_rows;

		if ( $num_rows > 0 ) {
			$fields = array();
			$finfo  = $data_res->fetch_fields();
			foreach ( $finfo as $val ) {
				$fields[] = "`" . $val->name . "`";
			}
			$fields_str   = implode( ', ', $fields );
			$insert_batch = array();

			while ( $row = $data_res->fetch_row() ) {
				$values = array();
				for ( $j = 0; $j < $num_fields; $j++ ) {
					if ( is_null( $row[ $j ] ) ) {
						$values[] = 'NULL';
					} else {
						$values[] = "'" . $mysqli->real_escape_string( $row[ $j ] ) . "'";
					}
				}
				$insert_batch[] = '(' . implode( ', ', $values ) . ')';

				if ( count( $insert_batch ) >= 100 ) {
					$sql_dump    .= "INSERT INTO `{$table}` ({$fields_str}) VALUES\n" . implode( ",\n", $insert_batch ) . ";\n";
					$insert_batch = array();
				}
			}

			if ( ! empty( $insert_batch ) ) {
				$sql_dump .= "INSERT INTO `{$table}` ({$fields_str}) VALUES\n" . implode( ",\n", $insert_batch ) . ";\n";
			}
			$sql_dump .= "\n";
		}
		$data_res->free();
	}
}

$sql_dump .= "SET FOREIGN_KEY_CHECKS=1;\n";
$sql_dump .= "COMMIT;\n";
$mysqli->close();

// 5. Inicializa arquivo ZIP do Backup
$zip_filename = $is_full ? "backup_completo_www_oranilom_{$timestamp}.zip" : "backup_oranilom_v2.1.3_{$timestamp}.zip";
$temp_zip     = sys_get_temp_dir() . '/' . $zip_filename;
$zip          = new ZipArchive();

if ( $zip->open( $temp_zip, ZipArchive::CREATE | ZipArchive::OVERWRITE ) !== true ) {
	$response = array( 'success' => false, 'error' => 'Não foi possível criar o arquivo ZIP no servidor.' );
	if ( $is_json ) {
		header( 'Content-Type: application/json; charset=utf-8' );
		echo json_encode( $response );
	} else {
		echo '<h1>Erro</h1><p>' . $response['error'] . '</p>';
	}
	exit;
}

// Adiciona Dump SQL sempre
$zip->addFromString( "database_backup_{$timestamp}.sql", $sql_dump );

$files_count_in_zip  = 1;
$uncompressed_bytes  = strlen( $sql_dump );

if ( $is_full ) {
	// ============================================================
	// MODO COMPLETO: Compacta toda a pasta WWW recursivamente
	// ============================================================
	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $root_dir, RecursiveDirectoryIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::SELF_FIRST
	);

	foreach ( $iterator as $item ) {
		$path           = $item->getPathname();
		$rel_path       = ltrim( substr( $path, strlen( $root_dir ) ), '/\\' );
		$rel_normalized = str_replace( '\\', '/', $rel_path );

		// Regras de exclusão inteligente:
		// 1. Não empacotar backups anteriores para não inflar o tamanho
		if ( strpos( $rel_normalized, 'wp-content/uploads/backups' ) === 0 ) {
			continue;
		}
		// 2. Não incluir outros arquivos .zip
		if ( substr( $rel_normalized, -4 ) === '.zip' ) {
			continue;
		}
		// 3. Ignorar pastas de controle de versão ou temporárias
		if ( strpos( $rel_normalized, '.git' ) === 0 || strpos( $rel_normalized, 'tmp/' ) === 0 ) {
			continue;
		}

		if ( $item->isDir() ) {
			$zip->addEmptyDir( $rel_normalized );
		} elseif ( $item->isFile() ) {
			$zip->addFile( $path, $rel_normalized );
			$files_count_in_zip++;
			$uncompressed_bytes += $item->getSize();

			// Previne estouro de file descriptors (ulimit) fechando e reabrindo a cada 300 arquivos
			if ( $files_count_in_zip % 300 === 0 ) {
				$zip->close();
				$zip->open( $temp_zip );
			}
		}
	}
} else {
	// ============================================================
	// MODO PADRÃO: wp-config.php + tema oficial
	// ============================================================
	if ( file_exists( $wp_config_file ) ) {
		$zip->addFile( $wp_config_file, 'wp-config.php' );
		$files_count_in_zip++;
		$uncompressed_bytes += filesize( $wp_config_file );
	}

	$theme_zip_candidate = $root_dir . '/wp-content/themes/tema-ade-sampa/tema-ade-sampa.zip';
	if ( file_exists( $theme_zip_candidate ) ) {
		$zip->addFile( $theme_zip_candidate, 'tema-ade-sampa-v2.1.3.zip' );
		$files_count_in_zip++;
		$uncompressed_bytes += filesize( $theme_zip_candidate );
	}
}

// Manifesto do backup
$manifest = array(
	'site_url'           => ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . '://' . ( $_SERVER['HTTP_HOST'] ?? 'oranilom.com.br' ),
	'backup_mode'        => $is_full ? 'full_www' : 'standard',
	'backup_description' => $is_full ? 'Backup Estrutural Completo da Pasta WWW + Banco de Dados MySQL' : 'Backup Padrão (Banco de Dados + wp-config.php + Tema)',
	'backup_date'        => $date_readable,
	'timestamp'          => $timestamp,
	'theme_version'      => '2.1.3',
	'database_name'      => $db_name,
	'database_host'      => $db_host,
	'table_prefix'       => $db_prefix,
	'tables_count'       => count( $tables ),
	'records_count'      => $total_records,
	'sql_size_bytes'     => strlen( $sql_dump ),
	'files_in_zip'       => $files_count_in_zip,
	'uncompressed_bytes' => $uncompressed_bytes,
	'tables_exported'    => $tables,
);
$zip->addFromString( 'backup_info.json', json_encode( $manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) );

$zip->close();
$zip_size = filesize( $temp_zip );

// 6. Salva cópia permanente no servidor em wp-content/uploads/backups/
$backup_storage_dir = $root_dir . '/wp-content/uploads/backups';
if ( ! is_dir( $backup_storage_dir ) ) {
	@mkdir( $backup_storage_dir, 0755, true );
}
$permanent_file = $backup_storage_dir . '/' . $zip_filename;
@copy( $temp_zip, $permanent_file );

// 7. Download direto se solicitado
if ( $is_download ) {
	header( 'Content-Type: application/zip' );
	header( 'Content-Disposition: attachment; filename="' . $zip_filename . '"' );
	header( 'Content-Length: ' . $zip_size );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );
	readfile( $temp_zip );
	@unlink( $temp_zip );
	exit;
}

// 8. Resposta JSON
if ( $is_json ) {
	header( 'Content-Type: application/json; charset=utf-8' );
	echo json_encode(
		array(
			'success'             => true,
			'message'             => $is_full ? 'Backup COMPLETO da pasta WWW e banco gerado com sucesso!' : 'Backup padrão gerado com sucesso!',
			'mode'                => $is_full ? 'full_www' : 'standard',
			'timestamp'           => $timestamp,
			'backup_file'         => $zip_filename,
			'size_bytes'          => $zip_size,
			'size_readable'       => round( $zip_size / ( 1024 * 1024 ), 2 ) . ' MB',
			'uncompressed_mb'     => round( $uncompressed_bytes / ( 1024 * 1024 ), 2 ) . ' MB',
			'files_in_zip'        => $files_count_in_zip,
			'tables_count'        => count( $tables ),
			'records_count'       => $total_records,
			'sql_size_bytes'      => strlen( $sql_dump ),
			'download_url'        => ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . '://' . ( $_SERVER['HTTP_HOST'] ?? 'oranilom.com.br' ) . '/backup-site.php?key=' . BACKUP_SECURITY_KEY . ( $is_full ? '&full=1' : '' ) . '&download=1',
			'server_copy_path'    => $permanent_file,
		),
		JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
	);
	exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $is_full ? 'Backup Completo (WWW)' : 'Backup Padrão'; ?> — ADE SAMPA 2025</title>
	<style>
		body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #0F172A; color: #F8FAFC; margin: 0; padding: 40px 20px; display: flex; justify-content: center; align-items: center; min-height: 100vh; box-sizing: border-box; }
		.card { background: #1E293B; border: 1px solid #334155; border-radius: 16px; padding: 36px; max-width: 640px; width: 100%; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.5); }
		.badge { display: inline-block; background: <?php echo $is_full ? '#004CE8' : '#10B981'; ?>; color: white; padding: 4px 12px; border-radius: 999px; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 16px; letter-spacing: 0.05em; }
		h1 { margin: 0 0 10px 0; font-size: 1.8rem; color: #FFFFFF; }
		p { color: #94A3B8; line-height: 1.6; margin: 0 0 24px 0; font-size: 0.95rem; }
		.stats { background: #0F172A; border-radius: 12px; padding: 20px; margin-bottom: 28px; border: 1px solid #1E293B; }
		.stat-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #1E293B; font-size: 0.9rem; }
		.stat-row:last-child { border-bottom: none; }
		.stat-label { color: #64748B; font-weight: 500; }
		.stat-val { color: #38BDF8; font-weight: 600; font-family: monospace; }
		.btn { display: inline-block; width: 100%; text-align: center; background: #004CE8; color: white; padding: 14px 20px; border-radius: 10px; font-weight: 700; font-size: 1rem; text-decoration: none; transition: background 0.2s; box-sizing: border-box; margin-bottom: 12px; }
		.btn:hover { background: #0038b3; }
		.btn-outline { background: transparent; border: 1px solid #334155; color: #94A3B8; }
		.btn-outline:hover { background: #334155; color: white; }
	</style>
</head>
<body>
	<div class="card">
		<span class="badge"><?php echo $is_full ? 'Backup Estrutural WWW' : 'Backup Padrão'; ?> Concluído</span>
		<h1><?php echo $is_full ? 'Backup Completo da Pasta WWW' : 'Backup Geral do Site (v2.1.3)'; ?></h1>
		<p><?php echo $is_full ? 'Todo o ecossistema WordPress (wp-admin, wp-includes, plugins, uploads, temas e banco de dados) foi empacotado em um único arquivo ZIP.' : 'O dump completo do banco MySQL e os arquivos de configuração foram empacotados com sucesso.'; ?></p>

		<div class="stats">
			<div class="stat-row">
				<span class="stat-label">Tipo de Backup:</span>
				<span class="stat-val"><?php echo htmlspecialchars( $mode_label ); ?></span>
			</div>
			<div class="stat-row">
				<span class="stat-label">Data e Hora:</span>
				<span class="stat-val"><?php echo htmlspecialchars( $date_readable ); ?></span>
			</div>
			<div class="stat-row">
				<span class="stat-label">Banco de Dados:</span>
				<span class="stat-val"><?php echo htmlspecialchars( $db_name ); ?> (<?php echo count( $tables ); ?> tabelas / <?php echo number_format( $total_records, 0, ',', '.' ); ?> linhas)</span>
			</div>
			<?php if ( $is_full ) : ?>
			<div class="stat-row">
				<span class="stat-label">Arquivos Incluídos:</span>
				<span class="stat-val"><?php echo number_format( $files_count_in_zip, 0, ',', '.' ); ?> arquivos</span>
			</div>
			<div class="stat-row">
				<span class="stat-label">Tamanho Descompactado:</span>
				<span class="stat-val"><?php echo round( $uncompressed_bytes / ( 1024 * 1024 ), 2 ); ?> MB</span>
			</div>
			<?php endif; ?>
			<div class="stat-row">
				<span class="stat-label">Tamanho do Arquivo ZIP:</span>
				<span class="stat-val"><?php echo round( $zip_size / ( 1024 * 1024 ), 2 ); ?> MB</span>
			</div>
		</div>

		<a href="?key=<?php echo urlencode( BACKUP_SECURITY_KEY ); ?>&<?php echo $is_full ? 'full=1&' : ''; ?>download=1" class="btn">
			⬇ Baixar Arquivo ZIP do Backup (<?php echo round( $zip_size / ( 1024 * 1024 ), 2 ); ?> MB)
		</a>

		<?php if ( ! $is_full ) : ?>
		<a href="?key=<?php echo urlencode( BACKUP_SECURITY_KEY ); ?>&full=1" class="btn btn-outline">
			📦 Alternar para Backup Completo da Pasta WWW
		</a>
		<?php else : ?>
		<a href="?key=<?php echo urlencode( BACKUP_SECURITY_KEY ); ?>" class="btn btn-outline">
			⚡ Alternar para Backup Rápido (Banco + Tema)
		</a>
		<?php endif; ?>
	</div>
</body>
</html>
