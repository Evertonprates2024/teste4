<?php
/**
 * The Front Page template file (Home - Portal ADE SAMPA 2025)
 * Atualizado com base no novo mockup oficial do Figma
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Compatibilidade inteligente com o Elementor
if ( have_posts() ) {
	the_post();
}

$elementor_data        = get_post_meta( get_the_ID(), '_elementor_data', true );
$has_elementor_content = ! empty( $elementor_data ) && '[]' !== trim( $elementor_data );

$is_elementor_editor = false;
if ( class_exists( '\Elementor\Plugin' ) ) {
	$is_preview = \Elementor\Plugin::$instance->preview->is_preview_mode();
	$is_editor  = \Elementor\Plugin::$instance->editor->is_edit_mode();
	if ( $is_preview || $is_editor ) {
		$is_elementor_editor = true;
	}
}

if ( isset( $_GET['elementor-preview'] ) || ( isset( $_GET['action'] ) && 'elementor' === $_GET['action'] ) ) {
	$is_elementor_editor = true;
}

if ( $is_elementor_editor || $has_elementor_content ) {
	?>
	<main id="primary" class="site-main elementor-fullwidth-main">
		<?php the_content(); ?>
	</main>
	<?php
	get_footer();
	return;
}

$img_uri = get_template_directory_uri() . '/assets/images/';
?>

<main id="primary" class="site-main home-main">

	<!-- =====================================================================
	     1. HERO SECTION
	     ===================================================================== -->
	<section class="hero-section" id="hero">
		<div class="container hero-container text-center">
			<span class="pill-badge pill-badge-blue"><?php esc_html_e( 'DESENVOLVIMENTO ECONÔMICO', 'tema-ade-sampa' ); ?></span>
			<h1 class="hero-title">
				<?php esc_html_e( 'Fomentando o futuro dos', 'tema-ade-sampa' ); ?><br>
				<?php esc_html_e( 'negócios em São Paulo', 'tema-ade-sampa' ); ?>
			</h1>
			<p class="hero-subtitle">
				<?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'tema-ade-sampa' ); ?>
			</p>
			<div class="hero-cta-wrap">
				<a href="#sobre" class="btn btn-primary btn-lg"><?php esc_html_e( 'Conheça a ADE SAMPA', 'tema-ade-sampa' ); ?></a>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     2. NOSSAS VERTICAIS DE ATUAÇÃO
	     ===================================================================== -->
	<section class="section-verticais" id="verticais">
		<div class="container">
			<header class="section-header text-center">
				<h2 class="section-title"><?php esc_html_e( 'Nossas verticais de atuação', 'tema-ade-sampa' ); ?></h2>
				<p class="section-subtitle">
					<?php esc_html_e( 'Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'tema-ade-sampa' ); ?>
				</p>
			</header>

			<div class="verticais-grid">
				<!-- 1. Sampa Empreende -->
				<a href="#sampa-empreende" class="vertical-card" aria-label="<?php esc_attr_e( 'Sampa Empreende', 'tema-ade-sampa' ); ?>">
					<img src="<?php echo esc_url( $img_uri . 'card-sampa-empreende.png' ); ?>" alt="<?php esc_attr_e( 'Sampa Empreende', 'tema-ade-sampa' ); ?>" width="309" height="347" loading="lazy">
				</a>

				<!-- 2. Sampa Tech -->
				<a href="#sampa-tech" class="vertical-card" aria-label="<?php esc_attr_e( 'Sampa Tech', 'tema-ade-sampa' ); ?>">
					<img src="<?php echo esc_url( $img_uri . 'card-sampa-tech.png' ); ?>" alt="<?php esc_attr_e( 'Sampa Tech', 'tema-ade-sampa' ); ?>" width="309" height="347" loading="lazy">
				</a>

				<!-- 3. Sampa Games -->
				<a href="#sampa-games" class="vertical-card" aria-label="<?php esc_attr_e( 'Sampa Games', 'tema-ade-sampa' ); ?>">
					<img src="<?php echo esc_url( $img_uri . 'card-sampa-games.png' ); ?>" alt="<?php esc_attr_e( 'Sampa Games', 'tema-ade-sampa' ); ?>" width="309" height="347" loading="lazy">
				</a>

				<!-- 4. Sampa Verde -->
				<a href="#sampa-verde" class="vertical-card" aria-label="<?php esc_attr_e( 'Sampa Verde', 'tema-ade-sampa' ); ?>">
					<img src="<?php echo esc_url( $img_uri . 'card-sampa-verde.png' ); ?>" alt="<?php esc_attr_e( 'Sampa Verde', 'tema-ade-sampa' ); ?>" width="309" height="347" loading="lazy">
				</a>

				<!-- 5. Sampa Criativa -->
				<a href="#sampa-criativa" class="vertical-card" aria-label="<?php esc_attr_e( 'Sampa Criativa', 'tema-ade-sampa' ); ?>">
					<img src="<?php echo esc_url( $img_uri . 'card-sampa-criativa.png' ); ?>" alt="<?php esc_attr_e( 'Sampa Criativa', 'tema-ade-sampa' ); ?>" width="309" height="347" loading="lazy">
				</a>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     3. DESTAQUES E OPORTUNIDADES (CARROSSEL NATIVO)
	     ===================================================================== -->
	<section class="section-oportunidades" id="oportunidades">
		<div class="container">
			<div class="oportunidades-header">
				<h2 class="section-title"><?php esc_html_e( 'Destaques e oportunidades', 'tema-ade-sampa' ); ?></h2>
				<hr class="section-divider-line">
			</div>

			<div class="carousel-wrapper">
				<button type="button" class="carousel-nav-btn carousel-nav-prev" id="oportunidades-prev" aria-label="<?php esc_attr_e( 'Oportunidade anterior', 'tema-ade-sampa' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
						<path d="M15 18L9 12L15 6"/>
					</svg>
				</button>

				<div class="oportunidades-carousel-viewport">
					<div class="oportunidades-track" id="oportunidades-track">
						<!-- Card 1: Vai Tec -->
						<article class="oportunidade-card">
							<div class="oportunidade-card-inner">
								<span class="pill-badge pill-badge-cyan"><?php esc_html_e( 'SAMPA TECH', 'tema-ade-sampa' ); ?></span>
								<h3 class="oportunidade-title"><?php esc_html_e( 'Edital aberto: Aceleração Vai Tec', 'tema-ade-sampa' ); ?></h3>
								<p class="oportunidade-desc">
									<?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus.', 'tema-ade-sampa' ); ?>
								</p>
								<div class="oportunidade-btn-wrap">
									<a href="#vai-tec" class="btn btn-primary btn-block"><?php esc_html_e( 'Acessar página do curso', 'tema-ade-sampa' ); ?></a>
								</div>
							</div>
						</article>

						<!-- Card 2: Game Dev (Em destaque) -->
						<article class="oportunidade-card destaque-ativo">
							<div class="oportunidade-card-inner">
								<span class="pill-badge pill-badge-purple"><?php esc_html_e( 'SAMPA GAMES', 'tema-ade-sampa' ); ?></span>
								<h3 class="oportunidade-title"><?php esc_html_e( 'Curso de Game Dev: Vagas para turma de Abril', 'tema-ade-sampa' ); ?></h3>
								<p class="oportunidade-desc">
									<?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus.', 'tema-ade-sampa' ); ?>
								</p>
								<div class="oportunidade-btn-wrap">
									<a href="#game-dev" class="btn btn-primary btn-block"><?php esc_html_e( 'Acessar página do curso', 'tema-ade-sampa' ); ?></a>
								</div>
							</div>
						</article>

						<!-- Card 3: Gestão de Negócios -->
						<article class="oportunidade-card">
							<div class="oportunidade-card-inner">
								<span class="pill-badge pill-badge-blue-soft"><?php esc_html_e( 'SAMPA EMPREENDE', 'tema-ade-sampa' ); ?></span>
								<h3 class="oportunidade-title"><?php esc_html_e( 'Curso Gestão de Negócios: Inscrições abertas', 'tema-ade-sampa' ); ?></h3>
								<p class="oportunidade-desc">
									<?php esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus.', 'tema-ade-sampa' ); ?>
								</p>
								<div class="oportunidade-btn-wrap">
									<a href="#gestao-negocios" class="btn btn-primary btn-block"><?php esc_html_e( 'Acessar página do curso', 'tema-ade-sampa' ); ?></a>
								</div>
							</div>
						</article>
					</div>
				</div>

				<button type="button" class="carousel-nav-btn carousel-nav-next" id="oportunidades-next" aria-label="<?php esc_attr_e( 'Próxima oportunidade', 'tema-ade-sampa' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
						<path d="M9 18L15 12L9 6"/>
					</svg>
				</button>
			</div>

			<!-- Indicadores de paginação -->
			<div class="carousel-dots" id="oportunidades-dots" role="tablist" aria-label="Indicadores do carrossel">
				<button type="button" class="dot active" role="tab" aria-selected="true" aria-label="Slide 1"></button>
				<button type="button" class="dot" role="tab" aria-selected="false" aria-label="Slide 2"></button>
				<button type="button" class="dot" role="tab" aria-selected="false" aria-label="Slide 3"></button>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     4. NOSSO IMPACTO EM NÚMEROS (DARK NAVY SECTION)
	     ===================================================================== -->
	<section class="section-impacto" id="impacto">
		<div class="container">
			<div class="impacto-header">
				<span class="pill-badge pill-badge-dark"><?php esc_html_e( 'INDICADORES DE DESENVOLVIMENTO', 'tema-ade-sampa' ); ?></span>
				<h2 class="section-title text-white"><?php esc_html_e( 'Nosso impacto em números', 'tema-ade-sampa' ); ?></h2>
				<p class="section-subtitle text-muted-blue">
					<?php esc_html_e( 'Resultados consolidados de apoio ao empreendedorismo, inovação periférica e descentralização econômica na cidade.', 'tema-ade-sampa' ); ?>
				</p>
				<hr class="impacto-divider">
			</div>

			<div class="impacto-cards-grid">
				<!-- Stat 1 -->
				<div class="impacto-card">
					<div class="impacto-stat-number"><?php esc_html_e( '11 anos', 'tema-ade-sampa' ); ?></div>
					<p class="impacto-stat-label"><?php esc_html_e( 'Fomentando o desenvolvimento de São Paulo', 'tema-ade-sampa' ); ?></p>
				</div>

				<!-- Stat 2 (Highlight) -->
				<div class="impacto-card card-destaque">
					<div class="impacto-stat-number"><?php esc_html_e( '+180.000', 'tema-ade-sampa' ); ?></div>
					<p class="impacto-stat-label"><?php esc_html_e( 'Empreendedores e cidadãos atendidos', 'tema-ade-sampa' ); ?></p>
				</div>

				<!-- Stat 3 -->
				<div class="impacto-card">
					<div class="impacto-stat-number"><?php esc_html_e( '+20', 'tema-ade-sampa' ); ?></div>
					<p class="impacto-stat-label"><?php esc_html_e( 'Coworkings públicos em operação', 'tema-ade-sampa' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     5. TEIA: COWORKINGS PÚBLICOS E GRATUITOS
	     ===================================================================== -->
	<section class="section-teia" id="teia">
		<div class="container">
			<div class="teia-split-grid">
				<!-- Left Column: Informações -->
				<div class="teia-info-col">
					<span class="pill-badge pill-badge-blue"><?php esc_html_e( 'EQUIPAMENTO PÚBLICO', 'tema-ade-sampa' ); ?></span>
					<h2 class="section-title teia-title">
						<?php esc_html_e( 'Teia: Coworkings Públicos e gratuitos por toda a cidade', 'tema-ade-sampa' ); ?>
					</h2>
					<p class="teia-description">
						<?php esc_html_e( 'Espaços estruturados com Wi-Fi veloz, computadores, salas de reunião compartilhadas e suporte técnico nas regiões periféricas e centrais de São Paulo.', 'tema-ade-sampa' ); ?>
					</p>

					<ul class="teia-checklist">
						<li>
							<?php echo ade_sampa_get_logo( 'check-circle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span><?php esc_html_e( 'Acesso gratuito para MEIs, autônomos e coletivos', 'tema-ade-sampa' ); ?></span>
						</li>
						<li>
							<?php echo ade_sampa_get_logo( 'check-circle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span><?php esc_html_e( 'Oficinas de empreendedorismo semanais', 'tema-ade-sampa' ); ?></span>
						</li>
						<li>
							<?php echo ade_sampa_get_logo( 'check-circle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<span><?php esc_html_e( 'Agendamento de salas de reunião', 'tema-ade-sampa' ); ?></span>
						</li>
					</ul>

					<div class="teia-buttons-wrap">
						<a href="#conhecer-teia" class="btn btn-outline-primary"><?php esc_html_e( 'Saiba mais', 'tema-ade-sampa' ); ?></a>
						<a href="#agendamentos" class="btn btn-primary"><?php esc_html_e( 'Agende um horário', 'tema-ade-sampa' ); ?></a>
					</div>
				</div>

				<!-- Right Column: Visual Unit & Map Card -->
				<div class="teia-map-col">
					<div class="teia-interactive-card">
						<div class="teia-card-topbar">
							<span class="teia-card-topbar-title">← TEIA Parque Novo Mundo</span>
							<span class="teia-card-topbar-icon" aria-hidden="true">↗</span>
						</div>
						<div class="teia-card-body">
							<div class="teia-card-meta">
								<div class="meta-item">
									<label><?php esc_html_e( 'Unidade', 'tema-ade-sampa' ); ?></label>
									<strong><?php esc_html_e( 'TEIA Parque Novo Mundo', 'tema-ade-sampa' ); ?></strong>
								</div>
								<div class="meta-item">
									<label><?php esc_html_e( 'ZONA', 'tema-ade-sampa' ); ?></label>
									<span><?php esc_html_e( 'Norte I', 'tema-ade-sampa' ); ?></span>
								</div>
								<div class="meta-item">
									<label><?php esc_html_e( 'Classificação', 'tema-ade-sampa' ); ?></label>
									<span><?php esc_html_e( 'TEIA - Espaço de Trabalho', 'tema-ade-sampa' ); ?></span>
								</div>
								<div class="meta-item">
									<label><?php esc_html_e( 'Atendimento Funcionando?', 'tema-ade-sampa' ); ?></label>
									<span class="status-badge-active"><?php esc_html_e( 'Atendimento funcionando', 'tema-ade-sampa' ); ?></span>
								</div>
								<div class="meta-item">
									<label><?php esc_html_e( 'Endereço', 'tema-ade-sampa' ); ?></label>
									<address><?php esc_html_e( 'Av. Ernesto Augusto Lopes, 100 - Parque Vila Maria, São Paulo - SP, 02169-030', 'tema-ade-sampa' ); ?></address>
								</div>
							</div>
							<div class="teia-card-map-img">
								<img src="<?php echo esc_url( $img_uri . 'teia-map-sp.png' ); ?>" alt="Mapa de localização TEIA São Paulo" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     6. NOSSOS PRODUTOS DIGITAIS
	     ===================================================================== -->
	<section class="section-produtos" id="produtos-digitais">
		<div class="container">
			<header class="section-header text-center">
				<h2 class="section-title"><?php esc_html_e( 'Nossos produtos digitais', 'tema-ade-sampa' ); ?></h2>
				<p class="section-subtitle">
					<?php esc_html_e( 'Soluções tecnológicas desenvolvidas para impulsionar a capacitação, a gestão e a inteligência empreendedora na cidade.', 'tema-ade-sampa' ); ?>
				</p>
			</header>

			<div class="produtos-digital-grid">
				<!-- 1. Sampa Ensina -->
				<article class="produto-digital-card">
					<div class="produto-icon-wrap">
						<?php echo ade_sampa_get_logo( 'product-ensina' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<h3 class="produto-card-title"><?php esc_html_e( 'Sampa Ensina', 'tema-ade-sampa' ); ?></h3>
					<p class="produto-card-desc">
						<?php esc_html_e( 'Plataforma aberta de capacitação online, trilhas de aprendizagem e cursos gratuitos para empreendedores e futuros negócios.', 'tema-ade-sampa' ); ?>
					</p>
					<a href="#sampa-ensina" class="produto-link">
						<span><?php esc_html_e( 'Acessar plataforma', 'tema-ade-sampa' ); ?></span>
						<span class="arrow-symbol">→</span>
					</a>
				</article>

				<!-- 2. Data Sampa -->
				<article class="produto-digital-card">
					<div class="produto-icon-wrap">
						<?php echo ade_sampa_get_logo( 'product-data' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<h3 class="produto-card-title"><?php esc_html_e( 'Data Sampa', 'tema-ade-sampa' ); ?></h3>
					<p class="produto-card-desc">
						<?php esc_html_e( 'Portal de inteligência de dados, observatório econômico territorial e indicadores abertos sobre o ecossistema empreendedor paulistano.', 'tema-ade-sampa' ); ?>
					</p>
					<a href="#data-sampa" class="produto-link">
						<span><?php esc_html_e( 'Explorar indicadores', 'tema-ade-sampa' ); ?></span>
						<span class="arrow-symbol">→</span>
					</a>
				</article>

				<!-- 3. Gestão Sampa -->
				<article class="produto-digital-card">
					<div class="produto-icon-wrap">
						<?php echo ade_sampa_get_logo( 'product-gestao' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<h3 class="produto-card-title"><?php esc_html_e( 'Gestão Sampa', 'tema-ade-sampa' ); ?></h3>
					<p class="produto-card-desc">
						<?php esc_html_e( 'Solução digital integrada para gestão empresarial, fluxo de caixa, precificação, controle fiscal e apoio na formalização de MEIs.', 'tema-ade-sampa' ); ?>
					</p>
					<a href="#gestao-sampa" class="produto-link">
						<span><?php esc_html_e( 'Conhecer ferramenta', 'tema-ade-sampa' ); ?></span>
						<span class="arrow-symbol">→</span>
					</a>
				</article>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     7. PRAÇA VICTOR CIVITA (FOREST GREEN SECTION)
	     ===================================================================== -->
	<section class="section-civita" id="victor-civita">
		<div class="container">
			<div class="civita-split-grid">
				<!-- Left Column: Informações -->
				<div class="civita-info-col">
					<span class="pill-badge pill-badge-green"><?php esc_html_e( 'SUSTENTABILIDADE', 'tema-ade-sampa' ); ?></span>
					<h2 class="section-title text-white"><?php esc_html_e( 'Praça Victor Civita', 'tema-ade-sampa' ); ?></h2>
					<p class="civita-description">
						<?php esc_html_e( 'Um espaço dedicado à sustentabilidade, educação ambiental e cultura na zona oeste da cidade. Gerido para fomentar economia verde e integração comunitária.', 'tema-ade-sampa' ); ?>
					</p>

					<hr class="civita-divider">

					<div class="civita-meta-grid">
						<div class="civita-meta-item">
							<span class="civita-meta-label"><?php esc_html_e( 'Funcionamento', 'tema-ade-sampa' ); ?></span>
							<strong class="civita-meta-val"><?php esc_html_e( 'Segunda a Domingo, 06h às 18h', 'tema-ade-sampa' ); ?></strong>
						</div>
						<div class="civita-meta-item">
							<span class="civita-meta-label"><?php esc_html_e( 'Localização', 'tema-ade-sampa' ); ?></span>
							<strong class="civita-meta-val"><?php esc_html_e( 'R. Sumidouro, 580 - Pinheiros, São Paulo', 'tema-ade-sampa' ); ?></strong>
						</div>
					</div>

					<div class="civita-btn-wrap">
						<a href="#programacao-civita" class="btn btn-civita-white"><?php esc_html_e( 'Ver programação completa', 'tema-ade-sampa' ); ?></a>
					</div>
				</div>

				<!-- Right Column: Galeria de Fotos Verticais -->
				<div class="civita-photos-col">
					<div class="civita-photo-card">
						<img src="<?php echo esc_url( $img_uri . 'victor-civita-1.png' ); ?>" alt="Praça Victor Civita Edifício Histórico" />
					</div>
					<div class="civita-photo-card">
						<img src="<?php echo esc_url( $img_uri . 'victor-civita-2.png' ); ?>" alt="Praça Victor Civita Decks e Jardins" />
					</div>
					<div class="civita-photo-card">
						<img src="<?php echo esc_url( $img_uri . 'victor-civita-3.png' ); ?>" alt="Praça Victor Civita Espaço Comunitário" />
					</div>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
