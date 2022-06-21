<?php

/**
 * Template part for displaying event pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lacan
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div class="entry_img"><?php lacan_post_thumbnail(); ?></div>
		<div class="entry_text">
			<div class="entry-header">
				<?php the_title(sprintf('<div class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></div>'); ?>
			</div>
			<div class="entry-meta">
				<?php $categories_list = get_the_category_list( esc_html__( ', ', 'lacan' ) ); printf( '<span class="cat-links">' . esc_html__( 'Posted in: %1$s', 'lacan' ) . '</span>', $categories_list ); ?>
			</div>
			<div class="entry-content">
				<?php
				the_excerpt();
				?>
			<div class="tooltip_items">
				<div class="tooltip_time"><div class="time_i" data-tooltip="<?php the_field('date_tooltip'); ?>"></div></div>
				<div class="tooltip_price"><div class="price_i" data-tooltip="<?php the_field('price_tooltip'); ?>"></div></div>
				<div class="tooltip_loc"><div class="loc_i" data-tooltip="<?php the_field('location_tooltip'); ?>"></div></div>
			</div>
			<div class="read_more"> לפרטים נוספים והרשמה ></div>
		</div>
	</div>
	
</article>