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
					<li class="nav-item <?php echo is_front_page() ? 'current-menu-item' : ''; ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'tema-ade-sampa' ); ?></a>
					</li>
					<li class="nav-item <?php echo ( is_page( 'sobre' ) || is_page_template( 'page-sobre.php' ) ) ? 'current-menu-item' : ''; ?>">
						<a href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Sobre', 'tema-ade-sampa' ); ?></a>
					</li>
					<li class="nav-item nav-item-has-dropdown nav-item-mega" id="nav-programas">
						<button type="button" class="nav-dropdown-toggle" aria-expanded="false" aria-controls="megamenu-programas">
							<span><?php esc_html_e( 'Programas', 'tema-ade-sampa' ); ?></span>
							<svg class="chevron-icon" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>

						<!-- MEGA MENU PROGRAMAS (FIGMA NODE 10-971) -->
						<div class="mega-menu-dropdown" id="megamenu-programas" role="region" aria-label="<?php esc_attr_e( 'Menu de Programas', 'tema-ade-sampa' ); ?>">
							<!-- Seção Esquerda: Verticais de atuação (68%) -->
							<div class="mega-menu-left">
								<div class="mega-menu-section-header">
									<h3 class="mega-menu-title"><?php esc_html_e( 'Verticais de atuação', 'tema-ade-sampa' ); ?></h3>
								</div>

								<div class="mega-verticais-columns-grid">
									<!-- 1. Sampa Empreende -->
									<div class="mega-col mega-col-empreende">
										<div class="mega-col-logo">
											<a href="<?php echo esc_url( home_url( '/#sampa-empreende' ) ); ?>" aria-label="Sampa Empreende">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mini-sampa-empreende.png' ); ?>" alt="Sampa Empreende" width="89" height="29" loading="lazy">
											</a>
										</div>
										<ul class="mega-col-links">
											<li><a href="#atendimento"><?php esc_html_e( 'Atendimento', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#orientacao-empresarial">Orientação<br>empresarial</a></li>
											<li><a href="#linhas-credito"><?php esc_html_e( 'Linhas de crédito', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#educacao-financeira"><?php esc_html_e( 'Educação financeira', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#consultoria-gestao">Consultoria em<br>gestão financeira</a></li>
											<li><a href="#fabrica-negocios">Curso fábrica de<br>negócios</a></li>
											<li><a href="#gestao-negocios">Curso de gestão de<br>negócios</a></li>
										</ul>
									</div>

									<!-- 2. Sampa Tech -->
									<div class="mega-col mega-col-tech">
										<div class="mega-col-logo">
											<a href="<?php echo esc_url( home_url( '/#sampa-tech' ) ); ?>" aria-label="Sampa Tech">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mini-sampa-tech.png' ); ?>" alt="Sampa Tech" width="72" height="29" loading="lazy">
											</a>
										</div>
										<ul class="mega-col-links">
											<li><a href="#vai-tec"><?php esc_html_e( 'Aceleração Vai Tec', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#hub-ia">Hub de inovação em<br>inteligência artificial</a></li>
										</ul>
									</div>

									<!-- 3. Sampa Games -->
									<div class="mega-col mega-col-games">
										<div class="mega-col-logo">
											<a href="<?php echo esc_url( home_url( '/#sampa-games' ) ); ?>" aria-label="Sampa Games">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mini-sampa-games.png' ); ?>" alt="Sampa Games" width="71" height="29" loading="lazy">
											</a>
										</div>
										<ul class="mega-col-links">
											<li><a href="#aceleracao-estudios">Aceleração de<br>estúdios</a></li>
											<li><a href="#curso-game-dev"><?php esc_html_e( 'Curso de game dev', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#hub-educacao"><?php esc_html_e( 'Hub de educação', 'tema-ade-sampa' ); ?></a></li>
										</ul>
									</div>

									<!-- 4. Sampa Verde -->
									<div class="mega-col mega-col-verde">
										<div class="mega-col-logo">
											<a href="<?php echo esc_url( home_url( '/#sampa-verde' ) ); ?>" aria-label="Sampa Verde">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mini-sampa-verde.png' ); ?>" alt="Sampa Verde" width="72" height="29" loading="lazy">
											</a>
										</div>
										<ul class="mega-col-links">
											<li><a href="#negocios-rurais">Aceleração de<br>negócios rurais</a></li>
											<li><a href="#aceleracao-hortas"><?php esc_html_e( 'Aceleração de hortas', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#negocios-verdes">Aceleração de<br>negócios verdes</a></li>
											<li><a href="#hub-inovacao"><?php esc_html_e( 'Hub de inovação', 'tema-ade-sampa' ); ?></a></li>
										</ul>
									</div>

									<!-- 5. Sampa Criativa -->
									<div class="mega-col mega-col-criativa">
										<div class="mega-col-logo">
											<a href="<?php echo esc_url( home_url( '/#sampa-criativa' ) ); ?>" aria-label="Sampa Criativa">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mini-sampa-criativa.png' ); ?>" alt="Sampa Criativa" width="72" height="29" loading="lazy">
											</a>
										</div>
										<ul class="mega-col-links">
											<li><a href="#aceleracao-audiovisual">Aceleração de<br>audiovisual</a></li>
											<li><a href="#aceleracao-moda"><?php esc_html_e( 'Aceleração de moda', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#hub-formacao-audiovisual">Hub de formação<br>em audiovisual</a></li>
										</ul>
									</div>
								</div>
							</div>

							<!-- Linha Divisória Vertical -->
							<div class="mega-menu-divider" aria-hidden="true"></div>

							<!-- Seção Direita: Plataformas e espaços (32%) -->
							<div class="mega-menu-right">
								<div class="mega-menu-section-header">
									<h3 class="mega-menu-title"><?php esc_html_e( 'Plataformas e espaços', 'tema-ade-sampa' ); ?></h3>
								</div>

								<div class="mega-plataformas-groups">
									<!-- Grupo 1: Teia -->
									<div class="mega-group">
										<h4 class="mega-group-title"><?php esc_html_e( 'Teia', 'tema-ade-sampa' ); ?></h4>
										<ul class="mega-col-links">
											<li><a href="#teia-coworking"><?php esc_html_e( 'Coworking público', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#teia-podcast"><?php esc_html_e( 'Estúdio de podcast', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#teia-fotografia"><?php esc_html_e( 'Estúdio de fotografia', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#teia-musica"><?php esc_html_e( 'Estúdio de música', 'tema-ade-sampa' ); ?></a></li>
										</ul>
									</div>

									<!-- Grupo 2: Produtos digitais -->
									<div class="mega-group">
										<h4 class="mega-group-title"><?php esc_html_e( 'Produtos digitais', 'tema-ade-sampa' ); ?></h4>
										<ul class="mega-col-links">
											<li><a href="#sampa-ensina"><?php esc_html_e( 'Sampa Ensina', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#gestao-sampa"><?php esc_html_e( 'Gestão Sampa', 'tema-ade-sampa' ); ?></a></li>
											<li><a href="#data-sampa"><?php esc_html_e( 'Data Sampa', 'tema-ade-sampa' ); ?></a></li>
										</ul>
									</div>

									<!-- Grupo 3: Praça Victor Civita -->
									<div class="mega-group">
										<h4 class="mega-group-title"><?php esc_html_e( 'Praça Victor Civita', 'tema-ade-sampa' ); ?></h4>
										<ul class="mega-col-links">
											<li><a href="#praca-civita"><?php esc_html_e( 'Conhecer equipamentos', 'tema-ade-sampa' ); ?></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
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
