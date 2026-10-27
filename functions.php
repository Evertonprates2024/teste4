<?php
/**
 * ADE SAMPA 2025 Theme Functions and Definitions
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ADE_SAMPA_VERSION', '2.0.8' );

require_once get_template_directory() . '/inc/svg-logos.php';

/**
 * Theme Setup
 */
function ade_sampa_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'elementor' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary'       => __( 'Menu Principal (Header)', 'tema-ade-sampa' ),
			'transparencia' => __( 'Menu Transparência (Dropdown & Footer)', 'tema-ade-sampa' ),
			'footer_site'   => __( 'Menu Rodapé (Site)', 'tema-ade-sampa' ),
		)
	);

	// Auto-sincroniza o script de recuperação na raiz (ABSPATH / www)
	if ( defined( 'ABSPATH' ) ) {
		$source      = get_template_directory() . '/restaurar-site.php';
		$destination = ABSPATH . 'restaurar-site.php';
		if ( file_exists( $source ) ) {
			if ( ! file_exists( $destination ) || md5_file( $source ) !== md5_file( $destination ) ) {
				@copy( $source, $destination );
			}
		}
	}
}
add_action( 'after_setup_theme', 'ade_sampa_setup' );

/**
 * Enqueue Scripts and Styles
 */
function ade_sampa_scripts() {
	wp_enqueue_style(
		'ade-sampa-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'ade-sampa-style',
		get_stylesheet_uri(),
		array( 'ade-sampa-google-fonts' ),
		ADE_SAMPA_VERSION
	);

	wp_enqueue_script(
		'ade-sampa-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		ADE_SAMPA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ade_sampa_scripts' );

/**
 * Register Custom Post Types: Editais and Agenda
 */
function ade_sampa_register_cpts() {
	register_post_type(
		'edital',
		array(
			'labels'       => array(
				'name'          => __( 'Editais', 'tema-ade-sampa' ),
				'singular_name' => __( 'Edital', 'tema-ade-sampa' ),
				'add_new_item'  => __( 'Adicionar Novo Edital', 'tema-ade-sampa' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'menu_icon'    => 'dashicons-portfolio',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
			'show_in_rest' => true,
		)
	);

	register_taxonomy(
		'categoria_edital',
		'edital',
		array(
			'label'        => __( 'Categorias de Edital', 'tema-ade-sampa' ),
			'hierarchical' => true,
			'public'       => true,
			'show_in_rest' => true,
		)
	);

	register_post_type(
		'agenda',
		array(
			'labels'       => array(
				'name'          => __( 'Agenda', 'tema-ade-sampa' ),
				'singular_name' => __( 'Evento da Agenda', 'tema-ade-sampa' ),
				'add_new_item'  => __( 'Adicionar Evento', 'tema-ade-sampa' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'menu_icon'    => 'dashicons-calendar-alt',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'ade_sampa_register_cpts' );

/**
 * Ensure core institutional pages (Sobre, Notícias, Agenda) exist on theme activation
 */
function ade_sampa_ensure_pages() {
	if ( get_option( 'ade_sampa_pages_created_v1' ) ) {
		return;
	}

	$pages = array(
		'sobre'    => array(
			'title'    => 'Sobre',
			'template' => 'page-sobre.php',
		),
		'noticias' => array(
			'title'    => 'Notícias',
			'template' => '',
		),
		'agenda'   => array(
			'title'    => 'Agenda',
			'template' => '',
		),
	);

	foreach ( $pages as $slug => $data ) {
		$existing = get_page_by_path( $slug );
		if ( ! $existing ) {
			$page_id = wp_insert_post(
				array(
					'post_title'   => $data['title'],
					'post_name'    => $slug,
					'post_status'  => 'publish',
					'post_type'    => 'page',
					'post_content' => '',
				)
			);
			if ( $page_id && ! is_wp_error( $page_id ) && ! empty( $data['template'] ) ) {
				update_post_meta( $page_id, '_wp_page_template', $data['template'] );
			}
		}
	}

	update_option( 'ade_sampa_pages_created_v1', 1 );
}
add_action( 'after_switch_theme', 'ade_sampa_ensure_pages' );
add_action( 'init', 'ade_sampa_ensure_pages', 20 );

/**
 * Helper to get the URL for the "Sobre" page (with fallback query param if permalinks are plain)
 */
function ade_sampa_get_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page->ID );
	}
	return add_query_arg( 'ade_page', $slug, home_url( '/' ) );
}

/**
 * Allow routing via ?ade_page=sobre / noticias / agenda as a seamless fallback
 */
function ade_sampa_template_include( $template ) {
	if ( isset( $_GET['ade_page'] ) ) {
		$slug = sanitize_key( wp_unslash( $_GET['ade_page'] ) );
		if ( 'sobre' === $slug ) {
			$sobre_tpl = locate_template( 'page-sobre.php' );
			if ( $sobre_tpl ) {
				return $sobre_tpl;
			}
		}
	}
	if ( is_page( 'sobre' ) ) {
		$sobre_tpl = locate_template( 'page-sobre.php' );
		if ( $sobre_tpl ) {
			return $sobre_tpl;
		}
	}
	return $template;
}
add_filter( 'template_include', 'ade_sampa_template_include' );

/**
 * Returns the 9 official Transparência menu items from the Figma prototype
 */
function ade_sampa_get_transparencia_items() {
	return array(
		array(
			'label' => 'Acesso à informação',
			'url'   => '#acesso-a-informacao',
		),
		array(
			'label' => 'Participação social',
			'url'   => '#participacao-social',
		),
		array(
			'label' => 'Quadro de serviços',
			'url'   => '#quadro-de-servicos',
		),
		array(
			'label' => 'Editais',
			'url'   => '#editais',
		),
		array(
			'label' => 'Observatório MEI',
			'url'   => '#observatorio-mei',
		),
		array(
			'label' => 'Comunicados',
			'url'   => '#comunicados',
		),
		array(
			'label' => 'Política de privacidade',
			'url'   => '#politica-de-privacidade',
		),
		array(
			'label' => 'LGPD',
			'url'   => '#lgpd',
		),
		array(
			'label' => 'Estágios',
			'url'   => '#estagios',
		),
	);
}

/**
 * Returns the 12 Editais cards (matching the "1 --- 12" counter and 8 category filters in Figma)
 */
function ade_sampa_get_editais_data() {
	$img_base = get_template_directory_uri() . '/assets/images/';

	return array(
		array(
			'id'       => 'vaitec',
			'category' => 'TECNOLOGIA',
			'logo'     => 'edital-vaitec',
			'image'    => $img_base . 'edital-vaitec.png',
			'title'    => 'ACELERAÇÃO VAI TEC',
			'desc'     => 'Apoia negócios inovadores nas periferias, impulsionando faturamento, geração de renda e desenvolvimento local com capacitação técnica.',
			'url'      => '#edital-vaitec',
		),
		array(
			'id'       => 'sampagames',
			'category' => 'GAMES',
			'logo'     => 'edital-sampagames',
			'image'    => $img_base . 'edital-games.jpg',
			'title'    => 'SAMPA GAMES',
			'desc'     => 'Fortalece negócios de jogos eletrônicos, conectando empreendedores ao ecossistema de inovação e tecnologia, promovendo emprego, renda e competitividade no setor.',
			'url'      => '#edital-sampagames',
		),
		array(
			'id'       => 'amplificacine',
			'category' => 'AUDIOVISUAL',
			'logo'     => 'edital-amplificacine',
			'image'    => $img_base . 'edital-cine.jpg',
			'title'    => 'AMPLIFICA CINE',
			'desc'     => 'Fortalece o setor audiovisual periférico em parceria com a SPCine, ampliando visibilidade e inserção no mercado cinematográfico paulistano.',
			'url'      => '#edital-amplificacine',
		),
		array(
			'id'       => 'greensampa',
			'category' => 'ECONOMIA VERDE',
			'logo'     => 'edital-greensampa',
			'image'    => $img_base . 'edital-greensampa.png',
			'title'    => 'GREEN SAMPA',
			'desc'     => 'Acelera startups oferecendo residência, mentorias, oficinas e conexões estratégicas para soluções sustentáveis e tecnologias verdes na cidade de São Paulo.',
			'url'      => '#edital-greensampa',
		),
		array(
			'id'       => 'samparural',
			'category' => 'RURAL',
			'logo'     => 'edital-rural',
			'image'    => $img_base . 'edital-rural.png',
			'title'    => 'SAMPA RURAL',
			'desc'     => 'Impulsiona produtores e negócios da agricultura familiar e periurbana paulistana com assistência técnica, escoamento produtivo e sustentabilidade.',
			'url'      => '#edital-samparural',
		),
		array(
			'id'       => 'biocosmeticos',
			'category' => 'ECONOMIA VERDE',
			'logo'     => 'edital-greensampa',
			'image'    => $img_base . 'edital-verde-2.png',
			'title'    => 'ECO BIO SAMPA',
			'desc'     => 'Fomenta empreendimentos de bioeconomia, cosméticos naturais e insumos sustentáveis com apoio financeiro, mentorias e acesso a novos mercados.',
			'url'      => '#edital-ecobio',
		),
		array(
			'id'       => 'modasampa',
			'category' => 'TÊXTIL',
			'logo'     => 'edital-textil',
			'image'    => $img_base . 'edital-textil.png',
			'title'    => 'MODA SAMPA',
			'desc'     => 'Qualifica e acelera empreendedores da cadeia têxtil, costura e moda autoral periférica, promovendo gestão, design circular e comercialização.',
			'url'      => '#edital-modasampa',
		),
		array(
			'id'       => 'hackathon',
			'category' => 'HACKATONS',
			'logo'     => 'edital-hackathon',
			'image'    => $img_base . 'edital-tech.jpg',
			'title'    => 'HACKATHON ADE SAMPA',
			'desc'     => 'Maratonas de programação e inovação aberta voltadas para o desenvolvimento de soluções tecnológicas para desafios públicos e urbanos de São Paulo.',
			'url'      => '#edital-hackathon',
		),
		array(
			'id'       => 'vaitec-2',
			'category' => 'TECNOLOGIA',
			'logo'     => 'edital-vaitec',
			'image'    => $img_base . 'edital-vaitec.png',
			'title'    => 'VAI TEC IMPACTO',
			'desc'     => 'Seleção de negócios de base tecnológica das periferias paulistanas com aporte financeiro, assessoria especializada e conexão com investidores.',
			'url'      => '#edital-vaitec-impacto',
		),
		array(
			'id'       => 'sampagames-jam',
			'category' => 'GAMES',
			'logo'     => 'edital-sampagames',
			'image'    => $img_base . 'edital-games.jpg',
			'title'    => 'SAMPA GAME JAM',
			'desc'     => 'Incubação e premiação de estúdios independentes de jogos digitais e formação prática em Game Design e desenvolvimento multiplataforma.',
			'url'      => '#edital-gamejam',
		),
		array(
			'id'       => 'amplifica-doc',
			'category' => 'AUDIOVISUAL',
			'logo'     => 'edital-amplificacine',
			'image'    => $img_base . 'edital-cine.jpg',
			'title'    => 'AMPLIFICA PRODUÇÃO',
			'desc'     => 'Apoio técnico e financeiro para produtoras independentes de conteúdo digital, web séries, documentários e produções culturais nas periferias.',
			'url'      => '#edital-amplifica-doc',
		),
		array(
			'id'       => 'hacka-cidades',
			'category' => 'HACKATONS',
			'logo'     => 'edital-hackathon',
			'image'    => $img_base . 'edital-tech.jpg',
			'title'    => 'DESAFIO CIDADES INTELIGENTES',
			'desc'     => 'Premia projetos e protótipos tecnológicos criados por jovens empreendedores para mobilidade, finanças digitais e serviços públicos.',
			'url'      => '#edital-cidades-inteligentes',
		),
	);
}

/**
 * Customize browser tab title: ADE SAMPA
 */
function ade_sampa_custom_document_title( $title ) {
	if ( is_front_page() || is_home() ) {
		return 'ADE SAMPA - Agência São Paulo de Desenvolvimento';
	}
	return $title . ' - ADE SAMPA';
}
add_filter( 'pre_get_document_title', 'ade_sampa_custom_document_title', 50 );

function ade_sampa_custom_title_parts( $title_parts ) {
	if ( empty( $title_parts['site'] ) || 'WordPress' === $title_parts['site'] || 'Wordpress' === $title_parts['site'] ) {
		$title_parts['site'] = 'ADE SAMPA';
	}
	if ( is_front_page() || is_home() ) {
		$title_parts['title']   = 'ADE SAMPA';
		$title_parts['tagline'] = 'Agência São Paulo de Desenvolvimento';
	}
	return $title_parts;
}
add_filter( 'document_title_parts', 'ade_sampa_custom_title_parts', 50 );

/**
 * Automatically update WordPress site name to ADE SAMPA if default
 */
function ade_sampa_update_default_site_title() {
	$current_name = get_option( 'blogname' );
	if ( 'WordPress' === $current_name || 'Wordpress' === $current_name || empty( $current_name ) ) {
		update_option( 'blogname', 'ADE SAMPA' );
		update_option( 'blogdescription', 'Agência São Paulo de Desenvolvimento' );
	}
}
add_action( 'init', 'ade_sampa_update_default_site_title', 5 );

