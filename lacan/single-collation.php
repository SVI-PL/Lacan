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
		<form id="redirectForm" method="post" action="/collation">
			<input class="form-control" name="event_array" value="<?php echo implode(",", $event_array); ?>" />
			<input class="form-control" name="general_array" value="<?php echo implode(",", $general_array); ?>" />
			<input class="form-control" name="media_array" value="<?php echo implode(",", $media_array); ?>" />
			<button type="submit" class="btn btn-primary btn-block" value="Pay">Submit</button>
		</form>

		<?php if ($event_array) { ?>
			<div class="post_type_block event">
				<div class="post_type_name">מפגשים, סמינרים ואירועים</div>
				<?php
				$query = new WP_Query('post_type=events&order=DESC&taxonomy=categorys&posts_per_page=3&terms=' . implode(",", $event_array));
					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content', 'events');
						}
						wp_reset_postdata();
					}
				 ?>
				<div class="more_post"><a href="#">טען עוד ></a></div>
			</div>
		<?php } ?>



		<?php if ($general_array) { ?>
			<div class="post_type_block general">
				<div class="post_type_name">מאמרים</div>
				<?php
				$query = new WP_Query('post_type=post&order=DESC&posts_per_page=3&cat=' . implode(",", $general_array));
					
					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content', 'archive');
						}
						wp_reset_postdata();
					}
				 ?>
				<div class="more_post"><a href="#">טען עוד ></a></div>
			</div>
		<?php } ?>


		<?php if ($media_array) { ?>
			<div class="post_type_block media">
				<div class="post_type_name">מדיה</div>
				<?php
				
				$query = new WP_Query('post_type=media&order=DESC&taxonomy=medias&posts_per_page=3&terms=' . implode(",", $media_array));
					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							get_template_part('template-parts/content', 'media');
						}
						wp_reset_postdata();
					}
				 ?>
				<div class="more_post"><a href="#">טען עוד ></a></div>
			</div>
		<?php } ?>
	</div>
</div>
<?php
get_footer();
