<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lacan
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<header id="masthead" class="site-header">
			<div class="header_bar">
				<div class="header_search">
					<div class="search_icon"></div>
					<div class="search_block">
						<div class="search_container">
							<div class="serch_qwery">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div>
					<div class="lang_switch"><?php echo do_shortcode("[language-switcher]") ?></div>
				</div>
				<div class="header_menu">
					<div class="menu_icon"></div>
					<div class="menu_block">
						<div class="menu_wiev" id="lottie2">
							<div class="subs_form subs_in">
								<div class="forms_title"><?php the_field('subs_form_title', 'option'); ?></div>
								<?php $contact_form = get_field('contact_form', 'option');
								echo do_shortcode("$contact_form"); ?>
								<div class="form_text"><?php the_field('subs_form_text', 'option'); ?></div>
							</div>
							<div class="menu_right">
								<div class="logo">
									<a href="/"><img src="<?php the_field('logo', 'option'); ?>"></a>
								</div>
								<div class="social_block">
									<ul class="social">
										<li><a href="<?php the_field('email_link', 'option'); ?>"><img src="<?php the_field('email_icon', 'option'); ?>" alt=""></a></li>
										<li><a href="<?php the_field('youtube_link', 'option'); ?>"><img src="<?php the_field('youtube_icon', 'option'); ?>" alt=""></a></li>
										<li><a href="<?php the_field('facebook_link', 'option'); ?>"><img src="<?php the_field('facebook_icon', 'option'); ?>" alt=""></a></li>
									</ul>
								</div>
								<nav id="site-navigation" class="main-navigation">
									<?php wp_nav_menu(array('theme_location' => 'menu-1', 'menu_id'        => 'primary-menu',)); ?>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div class="header_subs">
					<div class="subs_icon"></div>
					<div class="subs_block">
						<div class="subs_form">
						<div class="subs_form_close"></div>
							<div class="forms_title"><?php the_field('subs_form_title', 'option'); ?></div>
							<div class="form_text"><?php the_field('subs_form_text', 'option'); ?></div>
							<?php $contact_form = get_field('contact_form', 'option');
							echo do_shortcode("$contact_form"); ?>
						</div>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->