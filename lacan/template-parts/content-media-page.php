<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lacan
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="event_title"><?php the_title(); ?></div>
	<div class="date_post"><?php echo get_the_modified_date('d.m.Y'); ?></div>
	<div class="entry-content"><?php the_content(); ?></div>
</article>