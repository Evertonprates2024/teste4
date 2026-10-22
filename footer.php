<?php
/**
 * The Footer for the ADE SAMPA 2025 Theme
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();
?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container footer-main">
		<!-- Column 1: Logo & Address -->
		<div class="footer-col footer-col-brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-link">
				<?php echo ade_sampa_get_logo( 'ade-footer' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
			<address class="footer-address">
				Rua Líbero Badaró, 425<br>
				Centro Histórico - São Paulo - SP
			</address>
		</div>

		<!-- Column 2: SITE -->
		<div class="footer-col footer-col-site">
			<h3 class="footer-heading">SITE</h3>
			<ul class="footer-links">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a></li>
				<li><a href="<?php echo esc_url( ade_sampa_get_page_url( 'sobre' ) ); ?>">Sobre</a></li>
				<li><a href="<?php echo esc_url( ade_sampa_get_page_url( 'noticias' ) ); ?>">Notícias</a></li>
				<li><a href="<?php echo esc_url( ade_sampa_get_page_url( 'agenda' ) ); ?>">Agenda</a></li>
			</ul>
		</div>

		<!-- Column 3: TRANSPARÊNCIA -->
		<div class="footer-col footer-col-transparencia">
			<h3 class="footer-heading">TRANSPARÊNCIA</h3>
			<ul class="footer-links">
				<li><a href="#acesso-a-informacao">Acesso a informação</a></li>
				<li><a href="#participacao-social">Participação social</a></li>
				<li><a href="#quadro-de-servicos">Quadro de serviços</a></li>
				<li><a href="#editais">Editais</a></li>
				<li><a href="#observatorio-mei">Observatório MEI</a></li>
				<li><a href="#comunicados">Comunicados</a></li>
				<li><a href="#politica-de-privacidade">Politica de Privacidade</a></li>
				<li><a href="#lgpd">LGPD</a></li>
				<li><a href="#estagios">Estágios</a></li>
			</ul>
		</div>

		<!-- Column 4: NOSSAS REDES -->
		<div class="footer-col footer-col-social">
			<h3 class="footer-heading">NOSSAS REDES</h3>
			<div class="footer-social-icons">
				<a href="https://www.instagram.com/adesampa" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Instagram">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
						<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
						<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
					</svg>
				</a>
				<a href="https://www.facebook.com/adesampaoficial" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Facebook">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
						<path d="M15.12 5.32H17V2.14A26.11 26.11 0 0 0 14.26 2c-2.72 0-4.58 1.66-4.58 4.7v2.62H6.61v3.56h3.07V22h3.68v-9.12h3.06l.46-3.56h-3.52V6.65c0-1.05.29-1.73 1.76-1.73Z"/>
					</svg>
				</a>
				<a href="https://www.tiktok.com/@adesampa" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="TikTok">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
						<path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1Z"/>
					</svg>
				</a>
				<a href="https://www.youtube.com/@adesampa" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="YouTube">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
						<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
					</svg>
				</a>
				<a href="https://www.linkedin.com/company/adesampa" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="LinkedIn">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
						<path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/>
					</svg>
				</a>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="footer-bottom">
			<p class="footer-copyright">
				2025 ADE SAMPA - Agência São Paulo de Empreendedorismo - Todos os direitos reservados.
			</p>
			<div class="footer-prefeitura">
				<img src="<?php echo esc_url( $theme_uri . '/assets/images/brasao-sp.png' ); ?>" alt="Brasão da Prefeitura de São Paulo" class="brasao-sp-img" />
				<div class="prefeitura-text">
					<span class="prefeitura-line-1">PREFEITURA DE</span>
					<span class="prefeitura-line-2">SÃO PAULO</span>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
