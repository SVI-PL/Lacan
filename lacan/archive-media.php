<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lacan
 */

get_header();
?>

<div class="main_content archive">
	<div class="article_header">
		<div class="logo">
		<a href="/"><img src="<?php the_field('logo_black', 'option'); ?>" class="logo_rtl"></a>
        <a href="/"><img src="<?php the_field('logo_eng', 'option'); ?>" class="logo_eng"></a>
		</div>
	</div>
	<div class="main_page_body">
		<div class="entry-header"><?php the_archive_title('<h1 class="page-title">', '</h1>'); ?></div>
		<div class="archive_text">
			<?php the_field('media_description', 'option'); ?>
		</div>
		<?php if (have_posts()) : ?>

		<?php
			/* Start the Loop */
			while (have_posts()) :
				the_post();

				get_template_part('template-parts/content', 'media');

			endwhile;

			the_posts_navigation();

		else :

			get_template_part('template-parts/content', 'none');

		endif;
		?>
	</div>
</div>

<?php
get_sidebar();
get_footer();
