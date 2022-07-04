<?php

/**
 * Template part for displaying event pages
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
if (date('d/m/Y') <= get_field('date_event')) {
	$date_event = "future";
} else {
	$date_event = "past";
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content <?php echo $date_event . date('d/m/Y') ?>">
		<div class="entry_img"><?php lacan_post_thumbnail(); ?></div>
		<div class="entry_text">
			<div class="entry-header">
				<?php the_title(sprintf('<div class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></div>'); ?>
			</div>
			<div class="entry-meta">
				<span class="cat-links">Posted in: <a href="<?php echo $category_link ?>"><?php echo $cur_terms[0]->name ?></a></span>
			</div>
			<div class="entry-content">
				<?php
				the_excerpt();
				?>
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
				<a href="<?php the_permalink(); ?>" class="read_more">לפרטים נוספים והרשמה ></a>
			</div>
		</div>

</article>