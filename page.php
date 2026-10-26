<?php
/**
 * The template for displaying all pages
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_page( 'sobre' ) ) {
	require get_template_directory() . '/page-sobre.php';
	return;
}

get_header();

$is_noticias = is_page( 'noticias' ) || ( isset( $_GET['ade_page'] ) && 'noticias' === $_GET['ade_page'] );

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
?>

<?php if ( $is_elementor ) : ?>
<main id="primary" class="site-main elementor-fullwidth-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php else : ?>
<main id="primary" class="site-main internal-page-main">
	<?php
	while ( have_posts() ) :
		the_post();
		$content = get_the_content();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="page-banner-simple">
				<div class="container">
					<h1 class="section-title"><?php the_title(); ?></h1>
					<?php if ( $is_noticias ) : ?>
						<p class="section-subtitle"><?php esc_html_e( 'Não há notícias', 'tema-ade-sampa' ); ?></p>
					<?php endif; ?>
				</div>
			</header>

			<div class="container page-content-container">
				<div class="entry-content">
					<?php if ( $is_noticias && empty( trim( $content ) ) ) : ?>
						<div class="empty-state-box text-center">
							<h2><?php esc_html_e( 'Não há notícias', 'tema-ade-sampa' ); ?></h2>
							<p><?php esc_html_e( 'Confira nossos programas e editais abertos na página inicial.', 'tema-ade-sampa' ); ?></p>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Voltar ao Início</a>
						</div>
					<?php else : ?>
						<?php the_content(); ?>
					<?php endif; ?>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php endif; ?>

<?php
get_footer();
