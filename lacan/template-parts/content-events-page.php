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
$cur_terms = get_the_terms(get_the_ID(), 'categorys');
$category_id = $cur_terms[0]->term_id;
// Get the URL of this category
$category_link = get_category_link($category_id);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1><a href="<?php echo $category_link ?>"><?php echo $cur_terms[0]->name ?></a>
	</h1>
	<div class="event_title"><?php the_title(); ?></div>
	<div class="from_autor"><?php the_field('from_autor'); ?></div>
	<div class="tooltips">
		<div class="tooltip_items">
			<div class="tooltip_time">
				<div class="time_i"></div>
			</div>
			<div class="tooltip_price">
				<div class="price_i"></div>
			</div>
			<div class="tooltip_loc">
				<div class="loc_i"></div>
			</div>
		</div>
		<div class="tooltip_descr">
			<div class="time_descr">
				<p><?php the_field('date_tooltip'); ?></p>
			</div>
			<div class="price_descr">
				<p><?php the_field('price_tooltip'); ?></p>
			</div>
			<div class="loc_descr">
				<p><?php the_field('location_tooltip'); ?></p>
			</div>
		</div>
	</div>
	<div class="entry-content"><?php the_content(); ?></div>
</article>