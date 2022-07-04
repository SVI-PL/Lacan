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

<div class="main_content archive">
	<div class="article_header">
		<div class="logo">
			<a href="/"><img src="<?php the_field('logo_black', 'option'); ?>" class="logo_rtl"></a>
			<a href="/"><img src="<?php the_field('logo_eng', 'option'); ?>" class="logo_eng"></a>
		</div>
	</div>
	<div class="main_page_body">
		<div class="entry-header"><?php the_title('<h1 class="page-title">', '</h1>'); ?></div>
		<div class="archive_text">
			<?php the_field('collation_description', 'option'); ?>
		</div>
		<?php
		$tags_array = the_field('choose_tags');
		$event_array = get_field('categories_event');
		$general_array = get_field('Collation');
		$media_array = get_field('categories_media');
		?>


		<?php if ($event_array) { ?>
			<div class="post_type_block event">
				<div class="post_type_name">מפגשים, סמינרים ואירועים</div>
				<?php
				foreach ($event_array as $events_ids) {
					$term = get_term($events_ids);
					$slug = array($term->slug);

					$query = new WP_Query([

						'tax_query' =>
						[
							'relation' => 'AND',
							[
								'taxonomy' => 'categorys', // taxonomy name
								'field'    => 'slug',
								'terms'    => $slug // slug of the term
							],
						],
						'post_type' => 'events', // post_type name
						'order'     => 'ASC',
						"posts_per_page" => 3,
					]);
					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content', 'events');
						}
				?>
						<div class="more_post"><a href="/categorys/<?php echo implode($slug);  ?>">טען עוד ></a></div>
				<?php
						wp_reset_postdata();
					}
				} ?>
			</div>
		<?php } ?>



		<?php if ($general_array) { ?>
			<div class="post_type_block general">
				<div class="post_type_name">מאמרים</div>
				<?php
				foreach ($general_array as $general_ids) {
					$term = get_term($general_ids);
					$slug = array($term->slug);

					$query = new WP_Query([

						'tax_query' =>
						[
							'relation' => 'AND',
							[
								'taxonomy' => 'category', // taxonomy name
								'field'    => 'slug',
								'terms'    => $slug // slug of the term
							],
						],
						'post_type' => 'post', // post_type name
						'order'     => 'ASC',
						"posts_per_page" => 3,
					]);

					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content', 'archive');
						}
				?>
						<div class="more_post"><a href="/category/<?php echo implode($slug);  ?>">טען עוד ></a></div>
				<?php
						wp_reset_postdata();
					}
				} ?>
			</div>
		<?php } ?>


		<?php if ($media_array) { ?>
			<div class="post_type_block media">
				<div class="post_type_name">מדיה</div>
				<?php
				foreach ($media_array as $media_ids) {
					$term = get_term($media_ids);
					$slug = array($term->slug);

					$query = new WP_Query([

						'tax_query' =>
						[
							'relation' => 'AND',
							[
								'taxonomy' => 'medias', // taxonomy name
								'field'    => 'slug',
								'terms'    => $slug // slug of the term
							],
						],
						'post_type' => 'media', // post_type name
						'order'     => 'ASC',
						"posts_per_page" => 3,
					]);

					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content', 'media');
						}
				?>
						<div class="more_post"><a href="/medias/<?php echo implode($slug);  ?>">טען עוד ></a></div>
				<?php
						wp_reset_postdata();
					}
				} ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php
get_footer();
