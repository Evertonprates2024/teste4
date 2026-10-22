<?php
/**
 * The main template file (Fallback / Blog & Notícias index)
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If visiting the root front page and front-page.php wasn't already dispatched, load front-page.php.
if ( is_front_page() && ! isset( $_GET['ade_page'] ) ) {
	require get_template_directory() . '/front-page.php';
	return;
}

get_header();
?>

<main id="primary" class="site-main archive-main">
	<section class="page-banner-simple">
		<div class="container">
			<h1 class="section-title">
				<?php
				if ( is_home() && ! is_front_page() ) {
					single_post_title();
				} elseif ( is_archive() ) {
					the_archive_title();
				} else {
					esc_html_e( 'Notícias e Atualizações', 'tema-ade-sampa' );
				}
				?>
			</h1>
			<p class="section-subtitle">
				Acompanhe as principais novidades, programas e ações da ADE SAMPA na cidade de São Paulo.
			</p>
		</div>
	</section>

	<section class="archive-posts-section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<div class="posts-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'news-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="news-card-thumb">
									<?php the_post_thumbnail( 'medium_large' ); ?>
								</a>
							<?php endif; ?>
							<div class="news-card-body">
								<span class="news-card-date"><?php echo esc_html( get_the_date() ); ?></span>
								<h2 class="news-card-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="news-card-excerpt">
									<?php the_excerpt(); ?>
								</div>
								<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Ler mais</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<div class="pagination-wrap">
					<?php the_posts_pagination(); ?>
				</div>
			<?php else : ?>
				<div class="empty-state-box text-center">
					<h2><?php esc_html_e( 'Nenhuma publicação encontrada no momento.', 'tema-ade-sampa' ); ?></h2>
					<p><?php esc_html_e( 'Confira nossos programas e editais abertos na página inicial.', 'tema-ade-sampa' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Voltar ao Início</a>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
