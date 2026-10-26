<?php
/**
 * The Footer for ADE SAMPA 2025 Theme
 * Atualizado com base no novo mockup oficial do Figma
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	<!-- =====================================================================
	     FOOTER OFICIAL (FIGMA PIXEL-PERFECT)
	     ===================================================================== -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container footer-container">
			
			<!-- Linha Superior do Rodapé -->
			<div class="footer-top-row">
				<div class="footer-brand-col">
					<div class="footer-logo">
						<?php echo ade_sampa_get_logo( 'ade-footer' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<p class="footer-desc">
						<?php esc_html_e( 'Entidade vinculada à Secretaria Municipal de Desenvolvimento Econômico e Trabalho (SMDET) da Prefeitura de São Paulo, dedicada à aceleração de negócios, inclusão produtiva e redução das desigualdades regionais.', 'tema-ade-sampa' ); ?>
					</p>
				</div>

				<div class="footer-social-col">
					<span class="footer-social-title"><?php esc_html_e( 'Redes sociais', 'tema-ade-sampa' ); ?></span>
					<div class="footer-social-icons">
						<!-- Instagram -->
						<a href="https://instagram.com/adesampa" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Instagram da ADE SAMPA">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
								<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
								<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
							</svg>
						</a>

						<!-- LinkedIn -->
						<a href="https://linkedin.com/company/adesampa" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="LinkedIn da ADE SAMPA">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
								<path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76a1.64 1.64 0 1 0 0-3.28 1.64 1.64 0 0 0 0 3.28m1.4 9.74v-8.37H5.06v8.37h2.8z"/>
							</svg>
						</a>

						<!-- YouTube -->
						<a href="https://youtube.com/@adesampa" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="YouTube da ADE SAMPA">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
								<path d="M21.58 7.19a2.5 2.5 0 0 0-1.76-1.77C18.26 5 12 5 12 5s-6.26 0-7.82.42A2.5 2.5 0 0 0 2.42 7.2 26.3 26.3 0 0 0 2 12a26.3 26.3 0 0 0 .42 4.81 2.5 2.5 0 0 0 1.76 1.77C5.74 19 12 19 12 19s6.26 0 7.82-.42a2.5 2.5 0 0 0 1.76-1.77A26.3 26.3 0 0 0 22 12a26.3 26.3 0 0 0-.42-4.81zM10 15V9l5.2 3-5.2 3z"/>
							</svg>
						</a>

						<!-- Facebook -->
						<a href="https://facebook.com/adesampa" target="_blank" rel="noopener noreferrer" class="social-btn" aria-label="Facebook da ADE SAMPA">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
								<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
							</svg>
						</a>
					</div>
				</div>
			</div>

			<!-- 8 Colunas de Navegação com Marcadores Coloridos -->
			<div class="footer-nav-columns-grid">
				<!-- Coluna 1: ADE SAMPA -->
				<div class="footer-nav-col col-marker-blue">
					<h4 class="footer-col-title"><?php esc_html_e( 'ADE SAMPA', 'tema-ade-sampa' ); ?></h4>
					<ul class="footer-col-links">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Início', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/sobre/' ) ); ?>"><?php esc_html_e( 'Sobre a agência', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#diretoria"><?php esc_html_e( 'Diretoria e equipe', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#transparencia"><?php esc_html_e( 'Portal da transparência', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#licitacoes"><?php esc_html_e( 'Licitações e contratos', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#trabalhe-conosco"><?php esc_html_e( 'Trabalhe conosco', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#agendamentos"><?php esc_html_e( 'Área de agendamentos', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>

				<!-- Coluna 2: Sampa Empreende -->
				<div class="footer-nav-col col-marker-cyan">
					<h4 class="footer-col-title"><?php esc_html_e( 'Sampa Empreende', 'tema-ade-sampa' ); ?></h4>
					<ul class="footer-col-links">
						<li><a href="#atendimento"><?php esc_html_e( 'Atendimento', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#orientacao"><?php esc_html_e( 'Orientação empresarial', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#microcredito"><?php esc_html_e( 'Microcrédito', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#educacao-financeira"><?php esc_html_e( 'Educação financeira', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#consultoria"><?php esc_html_e( 'Consultoria em gestão', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#fabrica"><?php esc_html_e( 'Fabrica de negócios', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#curso-gestao"><?php esc_html_e( 'Curso gestão de negócios', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#podcast"><?php esc_html_e( 'Estúdio de podcast', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#fotografia"><?php esc_html_e( 'Estúdio de fotografia', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>

				<!-- Coluna 3: Sampa Tech -->
				<div class="footer-nav-col col-marker-lightblue">
					<h4 class="footer-col-title"><?php esc_html_e( 'Sampa Tech', 'tema-ade-sampa' ); ?></h4>
					<ul class="footer-col-links">
						<li><a href="#vai-tec"><?php esc_html_e( 'Aceleração Vai Tec', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#hub-ia"><?php esc_html_e( 'Hub de inovação em IA', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>

				<!-- Coluna 4: Sampa Games -->
				<div class="footer-nav-col col-marker-purple">
					<h4 class="footer-col-title"><?php esc_html_e( 'Sampa Games', 'tema-ade-sampa' ); ?></h4>
					<ul class="footer-col-links">
						<li><a href="#aceleracao-estudios"><?php esc_html_e( 'Aceleração de estúdios', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#game-dev"><?php esc_html_e( 'Curso de game dev', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#hub-educacao"><?php esc_html_e( 'Hub de educação', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>

				<!-- Coluna 5: Sampa Verde -->
				<div class="footer-nav-col col-marker-green">
					<h4 class="footer-col-title"><?php esc_html_e( 'Sampa Verde', 'tema-ade-sampa' ); ?></h4>
					<ul class="footer-col-links">
						<li><a href="#negocios-rurais"><?php esc_html_e( 'Aceleração de negócios rurais', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#hortas"><?php esc_html_e( 'Aceleração de hortas', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#negocios-verdes"><?php esc_html_e( 'Aceleração de negócios verdes', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#hub-verde"><?php esc_html_e( 'Hub de inovação verde', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>

				<!-- Coluna 6: Sampa Criativa -->
				<div class="footer-nav-col col-marker-orange">
					<h4 class="footer-col-title"><?php esc_html_e( 'Sampa Criativa', 'tema-ade-sampa' ); ?></h4>
					<ul class="footer-col-links">
						<li><a href="#audiovisual"><?php esc_html_e( 'Aceleração de audiovisual', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#moda"><?php esc_html_e( 'Aceleração de moda', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#formacao-audiovisual"><?php esc_html_e( 'Hub de formação em audio visual', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#musica"><?php esc_html_e( 'Estúdio de música', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>

				<!-- Coluna 7: Equipamentos -->
				<div class="footer-nav-col col-marker-blue">
					<h4 class="footer-col-title"><?php esc_html_e( 'Equipamentos', 'tema-ade-sampa' ); ?></h4>
					<ul class="footer-col-links">
						<li><a href="#teia"><?php esc_html_e( 'Teia coworking público', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#sampa-ensina"><?php esc_html_e( 'Sampa Ensina', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#gestao-sampa"><?php esc_html_e( 'Gestão Sampa', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#data-sampa"><?php esc_html_e( 'Data Sampa', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#victor-civita"><?php esc_html_e( 'Praça Victor Civita', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>

				<!-- Coluna 8: Imprensa & SAC -->
				<div class="footer-nav-col col-marker-blue">
					<h4 class="footer-col-title"><?php esc_html_e( 'Imprensa & SAC', 'tema-ade-sampa' ); ?></h4>
					<ul class="footer-col-links">
						<li><a href="<?php echo esc_url( home_url( '/noticias/' ) ); ?>"><?php esc_html_e( 'Releases e noticias', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#assessoria"><?php esc_html_e( 'Contato de assessoria', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#marca"><?php esc_html_e( 'Manual de marca', 'tema-ade-sampa' ); ?></a></li>
						<li><a href="#redacao"><?php esc_html_e( 'Manual de redação', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>
			</div>

			<!-- Linha Inferior: Direitos, CNPJ e Links Institucionais -->
			<div class="footer-bottom-row">
				<div class="footer-bottom-left">
					<p class="footer-legal-title">
						<strong><?php esc_html_e( 'ADE SAMPA – Agência São Paulo de Desenvolvimento', 'tema-ade-sampa' ); ?></strong> | CNPJ: 19.349.522/0001-38
					</p>
					<p class="footer-legal-address">
						<?php esc_html_e( 'Sede Administrativa: Rua Líbero Badaró, 425 - 8º andar - Centro Histórico, São Paulo - SP, CEP 01009-905', 'tema-ade-sampa' ); ?>
					</p>
					<p class="footer-copyright">
						<?php
						/* translators: %s: current year */
						printf( esc_html__( '© %s ADE SAMPA • Prefeitura do Município de São Paulo. Todos os direitos reservados.', 'tema-ade-sampa' ), esc_html( gmdate( 'Y' ) ) );
						?>
					</p>
				</div>

				<div class="footer-bottom-right">
					<ul class="footer-legal-links">
						<li><a href="#termos"><?php esc_html_e( 'Termos de uso', 'tema-ade-sampa' ); ?></a></li>
						<li class="separator" aria-hidden="true">•</li>
						<li><a href="#privacidade"><?php esc_html_e( 'Privacidade (LGPD)', 'tema-ade-sampa' ); ?></a></li>
						<li class="separator" aria-hidden="true">•</li>
						<li><a href="#acessibilidade"><?php esc_html_e( 'Acessibilidade', 'tema-ade-sampa' ); ?></a></li>
					</ul>
				</div>
			</div>

			<!-- Brasão Oficial Prefeitura de São Paulo -->
			<div class="footer-prefeitura-badge">
				<?php echo ade_sampa_get_logo( 'brasao-prefeitura-white' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>

		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
