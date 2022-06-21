<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lacan
 */

get_header();
?>
<div class="main_content page">
	<div class="article_header">
		<div class="logo">
			<a href="/"><img src="<?php the_field('logo_black', 'option'); ?>" class="logo_bw"></a>
		</div>
	</div>
	<div class="main_page_body">
	<div class="entry-header"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></div>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php lacan_post_thumbnail(); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>

<?php
get_footer();
