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
			<a href="/"><img src="<?php the_field('logo_black', 'option'); ?>" class="logo_bw"></a>
		</div>
	</div>
	<div class="main_page_body">
		<div class="entry-header"><?php the_archive_title('<h1 class="page-title">', '</h1>'); ?></div>
		<div class="archive_text">
			<?php echo category_description($cat->cat_ID); ?>
		</div>
		<div class="archive_filters">
			<div class="filter_by">סינון לפי ></div>
			<form class="sorting_form">
			<div class="sorting_select">
					<label class="filter_1"><input type="checkbox" class="sort_list" name="sorting" value="ALL" <?= ($_GET["sorting"] == NULL || $_GET["sorting"] == "ALL") ? "checked" : ""; ?>><span>הכל</span></label>
					<label class="filter_2"><input type="checkbox" class="sort_list" name="sorting" value="DESC" <?= ($_GET["sorting"] == "DESC") ? "checked" : ""; ?>><span>אירועי עבר</span></label>
					<label class="filter_3"><input type="checkbox" class="sort_list" name="sorting" value="ASC" <?= ($_GET["sorting"] == "ASC") ? "checked" : ""; ?>><span>אירועים עתידיים</span></label>
				</div>
			</form>
		</div>
		<?php
		global $wp_query;

		if ($_GET["sorting"] == NULL || $_GET["sorting"] == "ALL") {
			$query = new WP_Query(array(
				"post_type"      => "events",
				"posts_per_page" => -1,
				"paged"          => (get_query_var("paged")) ? get_query_var("paged") : 1,
				"taxonomy"       => "categorys",
				"meta_key"       => "date_event", # поле ACF
				"orderby"        => "meta_value_num",
				"order"          => ASC,
			));
		} elseif ($_GET["sorting"] == ASC) {
			$query = new WP_Query(array(
				"post_type"      => "events",
				"posts_per_page" => -1,
				"paged"          => (get_query_var("paged")) ? get_query_var("paged") : 1,
				"taxonomy"       => "categorys",
				"meta_key"       => "date_event", # поле ACF
				"orderby"        => "meta_value_num",
				"order"          => ASC,
				'meta_type' => 'DATETIME',
				'meta_query' => array(
					array(
						'key' => 'date_event',
						'value' => date('Y.m.d H:i'),
						'compare' => '>=',
						'type' => 'DATETIME'
					)
				)
			));
		} elseif ($_GET["sorting"] == DESC) {
			$query = new WP_Query(array(
				"post_type"      => "events",
				"posts_per_page" => -1,
				"paged"          => (get_query_var("paged")) ? get_query_var("paged") : 1,
				"taxonomy"       => "categorys",
				"meta_key"       => "date_event", # поле ACF
				"orderby"        => "meta_value_num",
				"order"          => DESC,
				'meta_type' => 'DATETIME',
				'meta_query' => array(
					array(
						'key' => 'date_event',
						'value' => date('Y.m.d H:i'),
						'compare' => '<=',
						'type' => 'DATETIME'
					)
				)
			));
		}

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				get_template_part('template-parts/content', 'events');
			}
		} else {
			get_template_part('template-parts/content', 'none');
		}
		?>
	</div>
</div>

<?php
get_sidebar();
get_footer();
