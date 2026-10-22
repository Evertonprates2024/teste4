<?php
/**
 * The Header for the ADE SAMPA 2025 Theme
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_sobre_active    = is_page( 'sobre' ) || ( isset( $_GET['ade_page'] ) && 'sobre' === $_GET['ade_page'] );
$is_noticias_active = is_page( 'noticias' ) || is_home() && ! is_front_page();
$is_agenda_active   = is_page( 'agenda' ) || is_post_type_archive( 'agenda' );
$is_home_active     = is_front_page() && ! $is_sobre_active;
$transparencia_list = ade_sampa_get_transparencia_items();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header" role="banner">
	<div class="header-container">
		<!-- Left Navigation -->
		<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Menu Principal', 'tema-ade-sampa' ); ?>">
			<ul class="nav-list">
				<li class="nav-item <?php echo $is_home_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				</li>
				<li class="nav-item <?php echo $is_sobre_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( ade_sampa_get_page_url( 'sobre' ) ); ?>">Sobre</a>
				</li>
				<li class="nav-item <?php echo $is_noticias_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( ade_sampa_get_page_url( 'noticias' ) ); ?>">Notícias</a>
				</li>
				<li class="nav-item <?php echo $is_agenda_active ? 'current-menu-item' : ''; ?>">
					<a href="<?php echo esc_url( ade_sampa_get_page_url( 'agenda' ) ); ?>">Agenda</a>
				</li>
				<li class="nav-item nav-item-has-dropdown" id="nav-transparencia">
					<button type="button" class="nav-dropdown-toggle" aria-expanded="false" aria-haspopup="true">
						<span>Transparência</span>
						<svg class="chevron-icon" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
					<ul class="transparencia-dropdown" aria-label="<?php esc_attr_e( 'Submenu Transparência', 'tema-ade-sampa' ); ?>">
						<?php foreach ( $transparencia_list as $item ) : ?>
							<li>
								<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
		</nav>

		<!-- Center Logo -->
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
				<?php echo ade_sampa_get_logo( 'ade-header' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</div>

		<!-- Right Auth Buttons -->
		<div class="header-actions">
			<a href="#cadastro" class="btn btn-primary btn-header-cta">Cadastre-se</a>
			<a href="#entrar" class="btn btn-outline btn-header-login">Entrar</a>

			<button type="button" class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="<?php esc_attr_e( 'Abrir menu', 'tema-ade-sampa' ); ?>" aria-expanded="false">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
	</div>
</header>
