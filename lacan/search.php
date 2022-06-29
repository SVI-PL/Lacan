<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
		<div class="entry-header">
			<h1 class="entry-title"><?php printf(esc_html__('Search Results for: %s', 'lacan'), '<span>' . get_search_query() . '</span>'); ?></h1>
		</div>
		<?php if (have_posts()) : ?>
		<?php
			/* Start the Loop */
			while (have_posts()) :
				the_post();
				get_template_part('template-parts/content', 'search');

			endwhile;

			the_posts_navigation();

		else :

			get_template_part('template-parts/content', 'none');

		endif;
		?>
	</div>
</div>

<?php
get_footer();
