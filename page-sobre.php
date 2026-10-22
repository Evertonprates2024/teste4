<?php
/**
 * Template Name: Página Sobre (ADE SAMPA 2025)
 * Template Post Type: page
 *
 * Implements the exact Figma design for the "Sobre" page (node-id=1224-20288).
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$img_uri = get_template_directory_uri() . '/assets/images/';
?>

<main id="primary" class="site-main sobre-main">

	<!-- =====================================================================
	     SOBRE HERO SECTION
	     ===================================================================== -->
	<section class="sobre-hero" style="background-image: url('<?php echo esc_url( $img_uri . 'sobre-hero.jpg' ); ?>');">
		<div class="sobre-hero-overlay"></div>
		<div class="container sobre-hero-container">
			<h1 class="sobre-hero-title">
				<span class="sobre-line-blue">Apoiando o</span>
				<span class="sobre-line-cyan">empreendedorismo</span>
				<span class="sobre-line-blue">da cidade</span>
				<span class="sobre-line-blue">de São Paulo</span>
			</h1>
		</div>
	</section>

	<!-- =====================================================================
	     SOBRE INSTITUTIONAL CONTENT (A ADE SAMPA / MISSÃO / VISÃO / VALORES)
	     ===================================================================== -->
	<section class="sobre-content-section">
		<div class="container">

			<!-- Row 1: A ADE SAMPA -->
			<div class="sobre-row sobre-row-intro">
				<div class="sobre-col-label">
					<h2 class="sobre-section-heading">A ADE SAMPA</h2>
				</div>
				<div class="sobre-col-text">
					<p>
						A Agência São Paulo de Desenvolvimento – ADE SAMPA é uma instituição voltada para promover políticas de desenvolvimento local que ajudem a reduzir as desigualdades regionais na cidade de São Paulo, contribuindo para a geração de renda, fomento ao empreendedorismo e estímulo à economia solidária e criativa.
					</p>
					<p>
						É um Serviço Social Autônomo, criado pela Lei Municipal nº 15.838, de 4 de julho de 2013, vinculado à Secretaria Municipal de Desenvolvimento Econômico e Trabalho (SMDET) da Prefeitura de São Paulo.
					</p>
					<p>
						Os programas e ações da ADE SAMPA atuam nas temáticas de orientação ao empreendedor, acesso a crédito, capacitação empreendedora, espaços de trabalho colaborativos, estúdios criativos, aceleração de negócios periféricos e inovação tecnológica.
					</p>
				</div>
			</div>

			<hr class="sobre-dotted-divider" />

			<!-- Row 2: Missão -->
			<div class="sobre-row">
				<div class="sobre-col-label">
					<h2 class="sobre-section-heading">Missão</h2>
				</div>
				<div class="sobre-col-text">
					<p>
						Promover o desenvolvimento econômico sustentável da cidade de São Paulo, priorizando a geração de renda e o fortalecimento de negócios, por meio de soluções colaborativas, inovadoras e inclusivas, que fomentem o desenvolvimento local e as vocações econômicas do município.
					</p>
				</div>
			</div>

			<hr class="sobre-dotted-divider" />

			<!-- Row 3: Visão -->
			<div class="sobre-row">
				<div class="sobre-col-label">
					<h2 class="sobre-section-heading">Visão</h2>
				</div>
				<div class="sobre-col-text">
					<p>
						Ser reconhecida como protagonista do fortalecimento do ecossistema empreendedor e no desenvolvimento local, para tornar a cidade de São Paulo referência global em sustentabilidade econômica e social.
					</p>
				</div>
			</div>

			<hr class="sobre-dotted-divider" />

			<!-- Row 4: Valores -->
			<div class="sobre-row">
				<div class="sobre-col-label">
					<h2 class="sobre-section-heading">Valores</h2>
				</div>
				<div class="sobre-col-text">
					<p>
						Comprometimento, transparência, confiança, impessoalidade, pró-atividade e dedicação às demandas da população em vulnerabilidade.
					</p>
				</div>
			</div>

		</div>
	</section>

</main>

<?php
get_footer();
