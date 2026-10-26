<?php
/**
 * The Header for ADE SAMPA 2025 Theme
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Pular para o conteúdo principal', 'tema-ade-sampa' ); ?></a>

	<!-- =====================================================================
	     HEADER / NAVEGAÇÃO PRINCIPAL (FIGMA PIXEL-PERFECT)
	     ===================================================================== -->
	<header id="masthead" class="site-header" role="banner">
		<div class="header-container">
			<!-- Logo ADE SAMPA -->
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home" aria-label="ADE SAMPA - Página Inicial">
					<?php echo ade_sampa_get_logo( 'ade-header' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</div>

			<!-- Menu Principal de Navegação -->
			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Menu Principal', 'tema-ade-sampa' ); ?>">
				<ul class="nav-list">
					<li class="nav-item current-menu-item">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tema-ade-sampa' ); ?></a>
					</li>
					<li class="nav-item">
						<a href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Sobre', 'tema-ade-sampa' ); ?></a>
					</li>
					<li class="nav-item nav-item-has-dropdown" id="nav-programas">
						<button type="button" class="nav-dropdown-toggle" aria-expanded="false" aria-controls="submenu-programas">
							<span><?php esc_html_e( 'Programas', 'tema-ade-sampa' ); ?></span>
							<svg class="chevron-icon" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<ul class="nav-dropdown-menu" id="submenu-programas">
							<li><a href="#verticais"><?php esc_html_e( 'Sampa Empreende', 'tema-ade-sampa' ); ?></a></li>
							<li><a href="#verticais"><?php esc_html_e( 'Sampa Tech', 'tema-ade-sampa' ); ?></a></li>
							<li><a href="#verticais"><?php esc_html_e( 'Sampa Games', 'tema-ade-sampa' ); ?></a></li>
							<li><a href="#verticais"><?php esc_html_e( 'Sampa Verde', 'tema-ade-sampa' ); ?></a></li>
							<li><a href="#verticais"><?php esc_html_e( 'Sampa Criativa', 'tema-ade-sampa' ); ?></a></li>
						</ul>
					</li>
					<li class="nav-item nav-item-has-dropdown" id="nav-imprensa">
						<button type="button" class="nav-dropdown-toggle" aria-expanded="false" aria-controls="submenu-imprensa">
							<span><?php esc_html_e( 'Imprensa', 'tema-ade-sampa' ); ?></span>
							<svg class="chevron-icon" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<ul class="nav-dropdown-menu" id="submenu-imprensa">
							<li><a href="<?php echo esc_url( home_url( '/noticias/' ) ); ?>"><?php esc_html_e( 'Notícias & Releases', 'tema-ade-sampa' ); ?></a></li>
							<li><a href="#contato-assessoria"><?php esc_html_e( 'Contato de Assessoria', 'tema-ade-sampa' ); ?></a></li>
							<li><a href="#manual-marca"><?php esc_html_e( 'Manual de Marca', 'tema-ade-sampa' ); ?></a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="#transparencia"><?php esc_html_e( 'Transparência', 'tema-ade-sampa' ); ?></a>
					</li>
					<li class="nav-item nav-item-mobile-cta">
						<a href="#agendamentos" class="btn btn-primary btn-block"><?php esc_html_e( 'Agendamentos', 'tema-ade-sampa' ); ?></a>
					</li>
				</ul>
			</nav>

			<!-- Ação Principal (CTA) -->
			<div class="header-actions">
				<a href="#agendamentos" class="btn btn-primary btn-header-agendamento"><?php esc_html_e( 'Agendamentos', 'tema-ade-sampa' ); ?></a>
				<button type="button" class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="<?php esc_attr_e( 'Abrir menu', 'tema-ade-sampa' ); ?>" aria-expanded="false">
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
		</div>
	</header>
