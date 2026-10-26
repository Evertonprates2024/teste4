<?php
/**
 * Template Name: Elementor Largura Total (ADE SAMPA)
 * Template Post Type: page, post
 *
 * @package Tema_ADE_Sampa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main elementor-fullwidth-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
