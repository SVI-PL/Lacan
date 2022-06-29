<?php
/*
    Template Name: about page
    */
get_header();
?>
<div class="main_content page">
	<div class="article_header">
		<div class="logo">
			<a href="/"><img src="<?php the_field('logo_black', 'option'); ?>" class="logo_bw"></a>
		</div>
	</div>
	<div class="main_page_body">
		<div class="entry-header"><?php the_title('<h1 class="entry-title">', '</h1>'); ?></div>
		<div class="archive_text"><?php the_field('text'); ?></div>
		<div class="people_list">
			<div class="people_title">תפקידים</div>
			<div class="people_name">
				<div class="people_name_title">הועד המנהל</div>
				<p>מזכירה: תמי רכטר</p>
				<p>נציג (דלגייט): אמיר ניסנסון</p>
				<p>גזבר: אסף גבע</p>
			</div>
			<div class="people_name">
				<div class="people_name_title">ועדה אפיסטמית לפורום ולמרחב הקליני</div>
				<p>מזכירה: תמי רכטר</p>
				<p>נציג (דלגייט): אמיר ניסנסון</p>
				<p>גזבר: אסף גבע</p>
			</div>
			<div class="people_name">
				<div class="people_name_title">הועד המנהל</div>
				<p>מזכירה: תמי רכטר</p>
				<p>נציג (דלגייט): אמיר ניסנסון</p>
				<p>גזבר: אסף גבע</p>
			</div>
			<div class="people_name">
				<div class="people_name_title">הועד המנהל</div>
				<p>מזכירה: תמי רכטר</p>
				<p>נציג (דלגייט): אמיר ניסנסון</p>
				<p>גזבר: אסף גבע</p>
			</div>
		</div>
		<div class="about_title">חברי הפורום</div>
		<div class="about_blocks">
			<?php
			if (have_rows('person_constructor')) { // если найдены данные
				while (have_rows('person_constructor')) {
					the_row(); ?>
					<div class="about_item">
						<div class="about_list_item">
							<div class="about_list_item_img">
								<img src="<?php the_sub_field('background_image'); ?>">
							</div>
							<div class="about_hover">
								<div class="about_list_item_content">
									<div class="about_list_item_title"><?php the_sub_field('title'); ?></div>
									<div class="about_list_item_text"><?php the_sub_field('text_block'); ?></div>
								</div>
								<div class="about_list_item_block">
									<span class="email"><img src="<?php echo get_template_directory_uri(); ?>/img/email_small.svg" alt=""><?php the_sub_field('email'); ?></span>
									<span class="tel"><img src="<?php echo get_template_directory_uri(); ?>/img/phone_small.svg" alt=""><?php the_sub_field('tel'); ?></span>
									<span class="geo"><img src="<?php echo get_template_directory_uri(); ?>/img/geo_small.svg" alt=""><?php the_sub_field('geo'); ?></span>
								</div>
							</div>
						</div>
						<div class="about_name"><?php the_sub_field('title_block'); ?></div>
					</div>
			<?php
				}
			}
			?>
		</div>

	</div>
</div>

<?php get_footer(); ?>