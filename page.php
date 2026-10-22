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
?>

<main id="primary" class="site-main internal-page-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="page-banner-simple">
				<div class="container">
					<h1 class="section-title"><?php the_title(); ?></h1>
				</div>
			</header>

			<div class="container page-content-container">
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
