<?php
/**
 * The Front Page template file (Home - Site ADE SAMPA 2025)
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Elementor compatibility: detect if edited with Elementor or previewing in Elementor editor
if ( have_posts() ) {
	the_post();
}

$is_elementor = false;
if ( class_exists( '\Elementor\Plugin' ) ) {
	$is_preview = \Elementor\Plugin::$instance->preview->is_preview_mode();
	$is_editor  = \Elementor\Plugin::$instance->editor->is_edit_mode();
	$doc        = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
	$is_built   = $doc ? $doc->is_built_with_elementor() : false;
	if ( $is_preview || $is_editor || $is_built ) {
		$is_elementor = true;
	}
}

if ( isset( $_GET['elementor-preview'] ) || ( isset( $_GET['action'] ) && 'elementor' === $_GET['action'] ) ) {
	$is_elementor = true;
}

if ( $is_elementor ) {
	?>
	<main id="primary" class="site-main elementor-fullwidth-main">
		<?php the_content(); ?>
	</main>
	<?php
	get_footer();
	return;
}

$img_uri      = get_template_directory_uri() . '/assets/images/';
$editais_data = ade_sampa_get_editais_data();
?>

<main id="primary" class="site-main home-main">

	<!-- =====================================================================
	     1. HERO SECTION
	     ===================================================================== -->
	<section class="hero-section" style="background-image: url('<?php echo esc_url( $img_uri . 'hero-bg.jpg' ); ?>');">
		<div class="hero-overlay"></div>

		<!-- Decorative Cyan Plus Grid (Bottom Left) -->
		<div class="hero-deco-plus" aria-hidden="true"></div>

		<div class="container hero-content">
			<p class="hero-kicker">AGÊNCIA SÃO PAULO DE DESENVOLVIMENTO</p>
			<h1 class="hero-title">
				Apoiando o empreendedorismo e<br>
				criando oportunidades na cidade<br>
				de São Paulo
			</h1>
			<div class="hero-buttons">
				<a href="#cadastro" class="btn btn-primary btn-lg">Cadastre-se</a>
				<a href="#entrar" class="btn btn-outline-light btn-lg">Entrar</a>
			</div>
		</div>

		<!-- Decorative Blue Dots Grid (Bottom Right) -->
		<div class="hero-deco-dots" aria-hidden="true"></div>
	</section>

	<!-- =====================================================================
	     2. ATENDIMENTO AO EMPREENDEDOR
	     ===================================================================== -->
	<section class="section-atendimento" id="atendimento">
		<div class="container">
			<header class="section-header text-center">
				<h2 class="section-title">ATENDIMENTO AO EMPREENDEDOR</h2>
				<p class="section-subtitle">
					Orientação sobre formalização, regularização e desenvolvimento de negócios
				</p>
			</header>

			<div class="atendimento-grid">
				<!-- Left Column: 2x2 Photo Collage + Caption + CTA -->
				<div class="atendimento-photos-col">
					<div class="photo-collage-2x2">
						<img src="<?php echo esc_url( $img_uri . 'teia-1.png' ); ?>" alt="Unidade de atendimento ADE SAMPA 1" />
						<img src="<?php echo esc_url( $img_uri . 'teia-2.png' ); ?>" alt="Unidade de atendimento ADE SAMPA 2" />
						<img src="<?php echo esc_url( $img_uri . 'teia-3.jpg' ); ?>" alt="Unidade de atendimento ADE SAMPA 3" />
						<img src="<?php echo esc_url( $img_uri . 'teia-4.jpg' ); ?>" alt="Unidade de atendimento ADE SAMPA 4" />
					</div>
					<p class="atendimento-unidades-text">
						Mais de 40 unidades em todas as regiões de São Paulo.
					</p>
					<div class="atendimento-btn-wrap">
						<a href="#unidades" class="btn btn-primary">Encontre a mais próxima</a>
					</div>
				</div>

				<!-- Right Column: Contrata SP & Descomplica SP -->
				<div class="atendimento-programs-col">
					<div class="program-item">
						<div class="program-logo-wrap">
							<?php echo ade_sampa_get_logo( 'contrata-sp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<p class="program-description">
							Conecta micro e pequenos empreendedores a oportunidades de negócios, promovendo a inclusão produtiva e o aumento de renda.
						</p>
					</div>

					<hr class="cyan-divider" />

					<div class="program-item">
						<div class="program-logo-wrap">
							<?php echo ade_sampa_get_logo( 'descomplica-sp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
						<p class="program-description">
							Atendimento presencial para orientação sobre formalização, regularização, acesso a crédito e programas de apoio ao empreendedorismo.
						</p>
					</div>

					<div class="atendimento-btn-wrap">
						<a href="#iniciativas" class="btn btn-primary">Conheça todas as iniciativas</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     3. ESPAÇOS DE TRABALHO & HUB'S DE INOVAÇÃO
	     ===================================================================== -->
	<section class="section-espacos-wrapper" id="espacos">
		<div class="container">
			<div class="espacos-blue-box">
				<header class="section-header section-header-light text-center">
					<h2 class="section-title">Espaços de trabalho</h2>
					<p class="section-subtitle">
						Infraestrutura completa para impulsionar o trabalho empreendedor, além de<br>
						cursos, oficinas, eventos e ampliação das redes de contato
					</p>
				</header>

				<!-- Interactive Tabs Navigation -->
				<div class="espacos-tabs-nav" role="tablist" aria-label="Espaços de trabalho da ADE SAMPA">
					<button type="button" class="espacos-tab-btn active" role="tab" aria-selected="true" aria-controls="tab-panel-teia" id="tab-btn-teia" data-tab="teia">
						Teia
					</button>
					<button type="button" class="espacos-tab-btn" role="tab" aria-selected="false" aria-controls="tab-panel-sampacast" id="tab-btn-sampacast" data-tab="sampacast">
						Sampa Cast
					</button>
					<button type="button" class="espacos-tab-btn" role="tab" aria-selected="false" aria-controls="tab-panel-sampaaudio" id="tab-btn-sampaaudio" data-tab="sampaaudio">
						Sampa Audio
					</button>
					<button type="button" class="espacos-tab-btn" role="tab" aria-selected="false" aria-controls="tab-panel-sampaestudio" id="tab-btn-sampaestudio" data-tab="sampaestudio">
						Sampa Estúdio
					</button>
				</div>

				<!-- Tab Panel 1: TEIA -->
				<div class="espacos-tab-panel active" id="tab-panel-teia" role="tabpanel" aria-labelledby="tab-btn-teia" data-panel="teia">
					<div class="espacos-panel-grid">
						<div class="espacos-media photo-collage-2x2">
							<img src="<?php echo esc_url( $img_uri . 'teia-1.png' ); ?>" alt="Espaço Colaborativo TEIA 1" />
							<img src="<?php echo esc_url( $img_uri . 'teia-2.png' ); ?>" alt="Espaço Colaborativo TEIA 2" />
							<img src="<?php echo esc_url( $img_uri . 'teia-4.jpg' ); ?>" alt="Espaço Colaborativo TEIA 3" />
							<img src="<?php echo esc_url( $img_uri . 'teia-5.jpg' ); ?>" alt="Espaço Colaborativo TEIA 4" />
						</div>
						<div class="espacos-info">
							<div class="espacos-logo">
								<?php echo ade_sampa_get_logo( 'teia' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<p class="espacos-desc">
								Os Espaços de Trabalho Colaborativos estão localizados em todas as regiões da cidade de São Paulo. Os TEIAs oferecem estações de trabalho com computadores, internet sem fio e salas de reunião, além de uma programação mensal com cursos, oficinas, encontros de networking, feiras e palestras de qualificação empreendedora.
							</p>
						</div>
					</div>
				</div>

				<!-- Tab Panel 2: SAMPA CAST -->
				<div class="espacos-tab-panel" id="tab-panel-sampacast" role="tabpanel" aria-labelledby="tab-btn-sampacast" data-panel="sampacast" hidden>
					<div class="espacos-panel-grid">
						<div class="espacos-media photo-collage-2col">
							<img src="<?php echo esc_url( $img_uri . 'sampacast-1.jpg' ); ?>" alt="Estúdio Sampa Cast 1" />
							<img src="<?php echo esc_url( $img_uri . 'sampacast-2.jpg' ); ?>" alt="Estúdio Sampa Cast 2" />
						</div>
						<div class="espacos-info">
							<div class="espacos-logo">
								<?php echo ade_sampa_get_logo( 'sampacast' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<p class="espacos-desc">
								Estúdios gratuitos para gravação de podcasts com equipamentos profissionais e equipe técnica qualificada, pronta para auxiliar na produção dos materiais. É voltado para a criação de conteúdos do universo empreendedor em diversos formatos além de podcasts, como vídeo conteúdo, web séries e entrevistas.
							</p>
						</div>
					</div>
				</div>

				<!-- Tab Panel 3: SAMPA AUDIO -->
				<div class="espacos-tab-panel" id="tab-panel-sampaaudio" role="tabpanel" aria-labelledby="tab-btn-sampaaudio" data-panel="sampaaudio" hidden>
					<div class="espacos-panel-grid">
						<div class="espacos-media photo-collage-2col">
							<img src="<?php echo esc_url( $img_uri . 'sampaaudio-1.jpg' ); ?>" alt="Estúdio Sampa Áudio 1" />
							<img src="<?php echo esc_url( $img_uri . 'sampaaudio-2.jpg' ); ?>" alt="Estúdio Sampa Áudio 2" />
						</div>
						<div class="espacos-info">
							<div class="espacos-logo">
								<?php echo ade_sampa_get_logo( 'sampaaudio' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<p class="espacos-desc">
								Estúdio equipado para gravações de músicas, locuções e produções sonoras em geral, com estrutura de ponta e suporte técnico especializado para produções de áudio com qualidade profissional.
							</p>
						</div>
					</div>
				</div>

				<!-- Tab Panel 4: SAMPA ESTÚDIO -->
				<div class="espacos-tab-panel" id="tab-panel-sampaestudio" role="tabpanel" aria-labelledby="tab-btn-sampaestudio" data-panel="sampaestudio" hidden>
					<div class="espacos-panel-grid">
						<div class="espacos-media photo-collage-single">
							<img src="<?php echo esc_url( $img_uri . 'sampaestudio-1.png' ); ?>" alt="Sampa Estúdio Audiovisual" />
						</div>
						<div class="espacos-info">
							<div class="espacos-logo">
								<?php echo ade_sampa_get_logo( 'sampaestudio' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<p class="espacos-desc">
								Estrutura completa com cenário, iluminação profissional e suporte técnico para produções audiovisuais, como vídeos institucionais e conteúdos multiplataformas.
							</p>
						</div>
					</div>
				</div>

				<!-- Nested Cyan Box: HUB's de inovação -->
				<div class="hubs-cyan-box">
					<header class="section-header text-center">
						<h3 class="section-title hubs-title">HUB's de inovação</h3>
						<p class="section-subtitle hubs-subtitle">
							Espaços públicos voltados para o fortalecimento de negócios de sustentabilidade<br>
							e da indústria criativa
						</p>
					</header>

					<div class="hubs-cards-grid">
						<!-- HUB Green Sampa -->
						<article class="hub-white-card">
							<div class="hub-card-logo">
								<?php echo ade_sampa_get_logo( 'hub-greensampa' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<p class="hub-card-desc">
								O Centro de Inovação Verde Bruno Covas - Hub Green Sampa apoia startups de economia verde e é aberto para o público com unidades do TEIA e Sampa Cast.
							</p>
							<a href="#hub-green-sampa" class="btn btn-primary btn-sm">Saiba mais</a>
						</article>

						<!-- HUB Sampa Games -->
						<article class="hub-white-card">
							<div class="hub-card-logo">
								<?php echo ade_sampa_get_logo( 'hub-sampagames' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
							<p class="hub-card-desc">
								Fortalecerá o setor de games por meio da escola de programação (GameDev) e design de jogos (Game Design), além de eventos como Game Jams e competições de e-sports.
							</p>
							<a href="#hub-sampa-games" class="btn btn-primary btn-sm">Saiba mais</a>
						</article>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     4. PANORAMIC SÃO PAULO SKYLINE DIVIDER BANNER
	     ===================================================================== -->
	<div class="skyline-banner" style="background-image: url('<?php echo esc_url( $img_uri . 'banner-skyline.jpg' ); ?>');" role="img" aria-label="Vista panorâmica da cidade de São Paulo">
		<div class="skyline-overlay"></div>
	</div>

	<!-- =====================================================================
	     5. PRODUTOS FINANCEIROS & NOSSOS PARCEIROS
	     ===================================================================== -->
	<section class="section-produtos-financeiros" id="produtos-financeiros">
		<div class="container">
			<header class="section-header text-center">
				<h2 class="section-title">Produtos financeiros</h2>
				<p class="section-subtitle">
					Oportunidades de crédito, produtos e serviços financeiros, de acordo com as<br>
					necessidades de cada negócio
				</p>
			</header>

			<div class="produtos-grid">
				<!-- Left Column: CRED SAMPA -->
				<div class="produtos-col-left">
					<div class="credsampa-logo-wrap">
						<?php echo ade_sampa_get_logo( 'credsampa' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<p class="credsampa-desc">
						Os melhores produtos e serviços financeiros para cada negócio. O CRED SAMPA auxilia na solicitação de crédito com linhas mais baratas, máquinas de cartão com desconto e outras soluções financeiras.
					</p>
				</div>

				<!-- Center Column: Vertical Image -->
				<div class="produtos-col-center">
					<img src="<?php echo esc_url( $img_uri . 'produtos-financeiros.jpg' ); ?>" alt="Análise financeira para negócios" class="produtos-center-img" />
				</div>

				<!-- Right Column: Parcerias & Academia de Finanças -->
				<div class="produtos-col-right">
					<div class="fin-feature-card fin-card-blue">
						<h3 class="fin-card-title">PARCERIAS</h3>
						<p class="fin-card-text">
							Acesso a soluções financeiras por meio de parcerias estratégicas e condições especiais para quem busca fortalecer seu negócio.
						</p>
					</div>

					<div class="fin-feature-card fin-card-cyan">
						<h3 class="fin-card-title">ACADEMIA DE FINANÇAS</h3>
						<p class="fin-card-text">
							Consultorias individuais com profissionais CFP® sobre planejamento financeiro, controle de custos, impostos e estratégias de crescimento para negócios.
						</p>
					</div>
				</div>
			</div>

			<!-- Nossos Parceiros Dark Blue Banner -->
			<div class="parceiros-banner">
				<h3 class="parceiros-title">Nossos parceiros</h3>
				<div class="parceiros-logos-row">
					<img src="<?php echo esc_url( $img_uri . 'parceiro-bb.png' ); ?>" alt="Banco do Brasil" class="partner-logo-img" />
					<span class="partner-text-logo partner-caixa" aria-label="CAIXA">CAIXA</span>
					<span class="partner-text-logo partner-bancodopovo" aria-label="Banco do Povo"><small>BANCO DO</small><strong>POVO</strong></span>
					<img src="<?php echo esc_url( $img_uri . 'parceiro-sicredi.png' ); ?>" alt="Sicredi" class="partner-logo-img" />
					<img src="<?php echo esc_url( $img_uri . 'parceiro-febraban.png' ); ?>" alt="Meu Bolso em Dia - Febraban Educação" class="partner-logo-img partner-logo-tall" />
					<img src="<?php echo esc_url( $img_uri . 'parceiro-ton.png' ); ?>" alt="Parceiro Ton" class="partner-logo-img" />
					<img src="<?php echo esc_url( $img_uri . 'parceiro-estimulo.png' ); ?>" alt="Estímulo" class="partner-logo-img partner-logo-tall" />
					<img src="<?php echo esc_url( $img_uri . 'parceiro-justa.png' ); ?>" alt="Justa" class="partner-logo-img" />
					<img src="<?php echo esc_url( $img_uri . 'parceiro-planejar.png' ); ?>" alt="Planejar" class="partner-logo-img" />
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     6. SISTEMA DE GESTÃO PARA O SEU NEGÓCIO
	     ===================================================================== -->
	<section class="section-sistema-gestao" id="sistema-gestao">
		<div class="container">
			<header class="section-header text-center">
				<h2 class="section-title">Sistema de gestão para o seu negócio</h2>
			</header>

			<div class="gestao-showcase">
				<div class="gestao-photo-wrap">
					<img src="<?php echo esc_url( $img_uri . 'erp-gestao.jpg' ); ?>" alt="Empreendedores utilizando o Gestão Sampa ERP gratuito" class="gestao-photo" />
					<span class="erp-gratuito-badge">ERP gratuito</span>
				</div>

				<div class="gestao-glass-card">
					<div class="gestao-logo-wrap">
						<?php echo ade_sampa_get_logo( 'gestaosampa' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<p class="gestao-card-desc">
						Gerenciamento completo do negócio em uma única plataforma, com relatórios em tempo real e informações sincronizadas e automatizadas.
					</p>
				</div>
			</div>

			<div class="text-center gestao-cta-wrap">
				<a href="#cadastro" class="btn btn-primary btn-lg">Cadastre-se</a>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     7. CAPACITAÇÕES
	     ===================================================================== -->
	<section class="section-capacitacoes" id="capacitacoes">
		<div class="container">
			<header class="section-header text-center">
				<h2 class="section-title">Capacitações</h2>
				<p class="section-subtitle">
					Cursos, mentorias e oficinas que ajudam micro e pequenos empreendedores a<br>
					desenvolver habilidades em gestão, marketing e estratégias de negócio
				</p>
			</header>

			<div class="capacitacoes-grid">
				<!-- Card 1: Fábrica de Negócios -->
				<article class="capacitacao-card">
					<div class="capacitacao-logo">
						<?php echo ade_sampa_get_logo( 'fabrica-negocios' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<p class="capacitacao-desc">
						Curso que ensina a criar e gerir negócios, voltado para quem já empreende ou quer começar.
					</p>
				</article>

				<!-- Card 2: ADE SAMPA Ensina -->
				<article class="capacitacao-card">
					<div class="capacitacao-logo">
						<?php echo ade_sampa_get_logo( 'ade-ensina' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<p class="capacitacao-desc">
						Plataforma com cursos gratuitos de qualificação profissional, gestão e empreendedorismo.
					</p>
				</article>
			</div>

			<div class="text-center capacitacoes-cta-wrap">
				<a href="#cadastro" class="btn btn-primary btn-lg">Cadastre-se</a>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     8. EDITAIS
	     ===================================================================== -->
	<section class="section-editais" id="editais">
		<div class="container">
			<header class="section-header text-center">
				<h2 class="section-title">Editais</h2>
				<p class="section-subtitle editais-subtitle">
					Voltadas para negócios, especialmente geridos por jovens das periferias, com aporte financeiro,<br>
					oficinas de capacitação, mentorias, assessorias, ampliação das redes de contato e possibilidade<br>
					de participação em eventos nacionais e internacionais.
				</p>
			</header>

			<!-- Category Filter Pills -->
			<div class="editais-filters" role="tablist" aria-label="Filtrar editais por categoria">
				<?php
				$categories = array( 'GERAL', 'TECNOLOGIA', 'GAMES', 'AUDIOVISUAL', 'ECONOMIA VERDE', 'RURAL', 'TÊXTIL', 'HACKATONS' );
				foreach ( $categories as $index => $cat ) :
					?>
					<button
						type="button"
						class="edital-filter-pill <?php echo 0 === $index ? 'active' : ''; ?>"
						data-filter="<?php echo esc_attr( $cat ); ?>"
						role="tab"
						aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>">
						<?php echo esc_html( $cat ); ?>
					</button>
				<?php endforeach; ?>
			</div>

			<!-- Carousel Track -->
			<div class="editais-carousel-viewport">
				<div class="editais-carousel-track" id="editais-track">
					<?php foreach ( $editais_data as $idx => $edital ) : ?>
						<article
							class="edital-card"
							data-category="<?php echo esc_attr( $edital['category'] ); ?>"
							data-index="<?php echo esc_attr( $idx + 1 ); ?>">
							<div class="edital-card-top">
								<div class="edital-card-logo">
									<?php echo ade_sampa_get_logo( $edital['logo'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
								<div class="edital-card-thumb">
									<img src="<?php echo esc_url( $edital['image'] ); ?>" alt="<?php echo esc_attr( $edital['title'] ); ?>" />
								</div>
							</div>
							<div class="edital-card-body">
								<p class="edital-card-desc"><?php echo esc_html( $edital['desc'] ); ?></p>
								<a href="<?php echo esc_url( $edital['url'] ); ?>" class="btn btn-cyan btn-sm">Saiba mais</a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Carousel Controls & Counter (1 --- 12) -->
			<div class="editais-controls">
				<div class="editais-arrows">
					<button type="button" class="carousel-arrow" id="edital-prev" aria-label="Edital anterior">
						<svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.5 1.5L2 8L8.5 14.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
					<button type="button" class="carousel-arrow" id="edital-next" aria-label="Próximo edital">
						<svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.5 1.5L8 8L1.5 14.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</div>
				<div class="editais-counter" aria-live="polite">
					<span id="edital-current-num">1</span>
					<span class="counter-line"></span>
					<span id="edital-total-num"><?php echo count( $editais_data ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================================
	     9. PRE-FOOTER CTA BANNER
	     ===================================================================== -->
	<section class="section-prefooter-cta" id="cadastro">
		<div class="container text-center">
			<h2 class="prefooter-cta-title">
				Conheça todos os serviços da ADE SAMPA<br>
				e participe dos nossos programas!
			</h2>
			<a href="#cadastro-form" class="btn btn-primary btn-lg">Cadastre-se</a>
		</div>
	</section>

</main>

<?php
get_footer();
