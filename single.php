<?php
/**
 * The template for displaying all single posts and editais
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main single-post-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="page-banner-simple">
				<div class="container">
					<p class="single-post-meta"><?php echo esc_html( get_the_date() ); ?></p>
					<h1 class="section-title"><?php the_title(); ?></h1>
				</div>
			</header>

			<div class="container page-content-container">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="single-featured-image">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
