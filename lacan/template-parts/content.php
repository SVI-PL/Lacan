<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lacan
 */

?>
<?php
    // Get the ID of a given category
	$cur_terms = get_the_terms(get_the_ID(), 'category');
	$category_id = $cur_terms[0]->term_id;
    // Get the URL of this category
    $category_link = get_category_link( $category_id ); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1><a href="<?php echo $category_link?>"><?php  echo $cur_terms[0]->name ?></a>
</h1>
	<div class="event_title"><?php the_title(); ?></div>
	<div class="from_autor"><?php the_field('from_autor'); ?></div>
	<div class="page_setting">
	<span class="color_toogle">
			<img src="<?php echo get_template_directory_uri(); ?>/img/darkmod.png" class="darkmod black" alt="Dark mode">
			<img src="<?php echo get_template_directory_uri(); ?>/img/lightmod.png" class="lightmod white" alt="Light mode">
		</span>
		<span class="font_increase">
			<img src="<?php echo get_template_directory_uri(); ?>/img/increase.png" class="increase black" alt="increase font">
			<img src="<?php echo get_template_directory_uri(); ?>/img/increase_w.png" class="increase white" alt="increase font">
		</span>
		<span class="font_decrease">
			<img src="<?php echo get_template_directory_uri(); ?>/img/decrease.png" class="decrease black" alt="decrease font">
			<img src="<?php echo get_template_directory_uri(); ?>/img/decrease_w.png" class="decrease white" alt="decrease font">
		</span>
	</div>
	<div class="date_post"><?php echo get_the_modified_date('d.m.Y'); ?></div>
	<div class="time_reading"><?php 
	$content = strip_tags($post->post_content); 
	$content_num = count(explode(' ', html_entity_decode(mb_convert_encoding($content,'HTML-ENTITIES','UTF-8'),ENT_QUOTES,'UTF-8')));
	echo round($content_num / 220, 0) . " דקות קריאה";
	?>
</div>
	<div class="entry-content"><?php the_content(); ?></div>
</article>