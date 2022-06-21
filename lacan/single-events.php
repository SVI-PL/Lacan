<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Lacan
 */

get_header();
?>
<div class="content_page">
	<div class="article_content_wraper white">
	<div class="article_content">
		<div class="article_header">
		<div class="logo">
				<a href="/" class="logo_black"><img src="<?php the_field('logo_black', 'option'); ?>" ></a>
				<a href="/" class="logo_white"><img src="<?php the_field('logo', 'option'); ?>" ></a>
			</div>
		</div>
		<?php
		while (have_posts()) :
			the_post();
			get_template_part('template-parts/content', 'events-page');
		endwhile;
		?>
	</div>
	<div class="article_btn"></div>
	</div>
	<div class="image_wraper"><?php lacan_post_thumbnail(); ?></div>
</div>
<?php
get_footer();
