<?php

/**
 * Template part for displaying media pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lacan
 */

?>
<style>
	/* MODAL */
	.modal-overlay-<?php the_ID(); ?> {
		position: fixed;
		top: 0;
		left: 0;
		z-index: 100;
		width: 100%;
		height: 100%;
		visibility: hidden;
		opacity: 0;
		background: rgba(30, 30, 30, 0.8);
		-webkit-transition: 0.3s;
		-moz-transition: 0.3s;
		-ms-transition: 0.3s;
		transition: 0.3s;
	}

	.modal-container-<?php the_ID(); ?> {
		position: fixed;
		max-width: 746px;
		aspect-ratio: 16/9;
		width: 100%;
		top: 50%;
		left: 50%;
		z-index: 200;
		text-align: center;
		visibility: hidden;
		-webkit-transform: translate(-50%, -50%);
		-moz-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
	}

	.modal-content {
		position: relative;
		opacity: 0;
		-webkit-transition: 0.8s;
		-moz-transition: 0.8s;
		transition: 0.3s;
		background: #fff;
		height: 100%;
	}

	.modal--show {
		visibility: visible;
	}

	.modal--show~.modal-overlay-<?php the_ID(); ?> {
		visibility: visible;
		opacity: 1;
	}

	.modal--show .modal-content {
		opacity: 1;
	}

	@media screen and (max-width: 899px) {
		.modal-container-<?php the_ID(); ?> {
			padding: 0 20px;
		}

	}
</style>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content media">
		<div class="video_box modal-trigger-<?php the_ID(); ?>">
			<?php if (get_field('preview_image') == true) { ?>
				<div class="entry_img"><img src="<?php the_field('preview_image'); ?>" alt="" class="youtube_img">
					<div class="y_play"></div>
				</div>
			<?php }  ?>
			<?php if (get_field('youtube') == true) { ?>
				<div class="entry_img"><img src="//img.youtube.com/vi/<?php the_field('youtube'); ?>/hqdefault.jpg" alt="" class="youtube_img">
					<div class="y_play"></div>
				</div>
			<?php }  ?>
		</div>
		<div class="entry_text">
			<div class="entry-header">
            <div class="entry-title modal-trigger-<?php the_ID(); ?> pointer"><?php the_title(); ?></div>
			</div>
			<div class="entry-content">
				<?php
				the_excerpt();
				?>
			</div>
		</div>
		<div class="modal-container-<?php the_ID(); ?>">
			<div class="modal-title"><?php the_title(); ?></div>
			<div class="modal-content">
				<?php if (get_field('my_video') == true) {
					echo do_shortcode('[video src="' . get_field('my_video') . '"]');
				} else { ?>
					<iframe src="https://www.youtube.com/embed/<?php the_field('youtube'); ?>?enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<?php } ?>
			</div>
		</div>
		<div class="modal-overlay-<?php the_ID(); ?>"></div>
</article>
<script>
	jQuery(document).ready(function($) {
		var $modalOverlay = $('.modal-overlay-<?php the_ID(); ?>'),
			$modalContainer = $('.modal-container-<?php the_ID(); ?>'),
			$modalTrigger = $('.modal-trigger-<?php the_ID(); ?>');

		$modalTrigger.on('click', function() {
			$modalContainer.toggleClass('modal--show');
		});

		$modalOverlay.on('click', function() {
			$modalContainer.toggleClass('modal--show');
			$("iframe").each(function() {
				$(this)[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
				$modalContainer = $('.modal-container-<?php the_ID(); ?>');
				const video = $modalContainer.find('video')[0];
				video.pause();
			})
		});
	});
</script>