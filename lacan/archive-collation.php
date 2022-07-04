<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lacan
 */

get_header();
$sorting = $_GET["sorting"];
if ($_GET["sorting"] == NULL || $_GET["sorting"] == "ALL") {
	$sorting = "ASC";
}
?>
<div class="main_content archive">
	<div class="article_header">
		<div class="logo">
			<a href="/"><img src="<?php the_field('logo_black', 'option'); ?>" class="logo_rtl"></a>
			<a href="/"><img src="<?php the_field('logo_eng', 'option'); ?>" class="logo_eng"></a>
		</div>
	</div>
	<div class="main_page_body">
		<div class="entry-header">
			<h1 class="page-title">מרחב תינוקות וילדים</h1>
		</div>
		<div class="archive_text">
			<?php the_field('collation_description', 'option'); ?>
		</div>
		<div class="post_type_block event">
			<div class="post_type_name">מפגשים, סמינרים ואירועים</div>
			<?php
			$query = new WP_Query(array(
				"post_type"      => "events",
				"posts_per_page" => 2,
				"paged"          => (get_query_var("paged")) ? get_query_var("paged") : 1,
				"taxonomy"       => "categorys",
				"orderby"        => "meta_value_num",
				"order"          => ASC,
			));

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					get_template_part('template-parts/content', 'events');
				}
			} else {
				get_template_part('template-parts/content', 'none');
			}
			wp_reset_postdata();
			?>
			<div class="more_post"><a href="/events">טען עוד ></a></div>
		</div>

		<div class="post_type_block general">
			<div class="post_type_name">מאמרים</div>
			<?php
			$query = new WP_Query(array(
				"post_type"      => "post",
				"posts_per_page" => 2,
				"paged"          => (get_query_var("paged")) ? get_query_var("paged") : 1,
				"taxonomy"       => "category",
				"orderby"        => "meta_value_num",
				"order"          => ASC,
			));

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					get_template_part('template-parts/content', 'archive');
				}
			} else {
				get_template_part('template-parts/content', 'none');
			}
			wp_reset_postdata();


			?>
			<div class="more_post"><a href="/blog">טען עוד ></a></div>
		</div>

		<div class="post_type_block media">
			<div class="post_type_name">מדיה</div>
			<?php
			$query = new WP_Query(array(
				"post_type"      => "media",
				"posts_per_page" => 2,
				"paged"          => (get_query_var("paged")) ? get_query_var("paged") : 1,
				"taxonomy"       => "medias",
				"orderby"        => "meta_value_num",
				"order"          => ASC,
			));

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					get_template_part('template-parts/content', 'media');
				}
			} else {
				get_template_part('template-parts/content', 'none');
			}
			wp_reset_postdata();


			?>
			<div class="more_post"><a href="/media">טען עוד ></a></div>
		</div>
	</div>
</div>
<?php
get_footer();
