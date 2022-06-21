<?php
/*
    Template Name: Home page
    */
get_header();
?>
<div class="home_page">
  <div class="main_content">
    <div class="content_header">
      <div class="logo">
        <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/group-31-copy.svg" class="Group-31-Copy"></a>
      </div>
      <div class="achive">
        <img src="<?php echo get_template_directory_uri(); ?>/img/if.png" class="IF">
      </div>
    </div>
    <div class="main_page_body">
      <div class="lottie_img"></div>
      <div class="main_page_text">
        <h1 class="main_title"><?php the_field('main_title'); ?></h1>
        <div class="text"><?php the_field('main_text'); ?></div>
        <div class="sup-text"><?php the_field('sub_text'); ?></div>
      </div>
    </div>
  </div>
  <div class="tabs">
    <!-- ACCORDION ROW -->
    <ul class="accordion-group" id="accordion">
      <li>
        <div class="accordion-overlay"></div>
        <div class="tab-title"><?php the_field('tab_name'); ?> <span class="tab_toogle"></span></div>
        <div class="tab-subtitle"><?php the_field('tab_subname'); ?></div>
        <section class="article-widget">
          <div class="owl-carousel owl-theme">
            <?php
            $query = new WP_Query('cat=1&posts_per_page=3');
            if ($query->have_posts()) {
              while ($query->have_posts()) {
                $query->the_post();
            ?>
                <div class="article-item">
                  <article>
                    <figure>
                      <img src="<?php the_post_thumbnail_url(500, 300); ?>">
                    </figure>
                    <div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <?php the_excerpt(); ?>
                  </article>
                </div>
            <?php
              }
              wp_reset_postdata();
            } else
              echo 'Записей нет.';
            ?>
          </div>
        </section>
      </li>
      <li>
        <div class="accordion-overlay"></div>
        <div class="tab-title"><?php the_field('tab_name2'); ?> <span class="tab_toogle"></span></div>
        <div class="tab-subtitle"><?php the_field('tab_subname_2'); ?></div>
        <section class="article-widget">
          <div class="owl-carousel owl-theme owl2">
            <?php
            $query = new WP_Query('post_type=events&posts_per_page=3');
            if ($query->have_posts()) {
              while ($query->have_posts()) {
                $query->the_post();
            ?>
                <div class="article-item">
                  <article>
                    <figure>
                      <img src="<?php the_post_thumbnail_url(500, 300); ?>">
                    </figure>
                    <div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <?php the_excerpt(); ?>
                  </article>
                </div>
            <?php
              }
              wp_reset_postdata();
            } else
              echo 'Записей нет.';
            ?>
          </div>
        </section>
      </li>
    </ul>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/css-element-queries/1.2.3/ResizeSensor.min.js"></script>
<script>
  jQuery(document).ready(function($) {
    var owl = $('.owl-carousel').owlCarousel({
      loop: false,
      margin: 10,
      items: 1,
      nav: true,
      rtl: true,
      dots: false,
      navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
      responsive: true,
      responsiveClass: true,
      responsiveRefreshRate: 100,
      responsiveBaseElement: $(".article-widget")[0],
      responsive: {
        0: {
          items: 1
        },
        350: {
          items: 1
        },
        600: {
          items: 1
        },
      },
    })

    $('.owl2').owlCarousel({
      loop: false,
      margin: 10,
      items: 1,
      nav: true,
      rtl: true,
      dots: true,
      navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
      responsive: true,
      responsiveClass: true,
      responsiveRefreshRate: 100,
      responsiveBaseElement: $(".article-widget")[1],
      responsive: {
        0: {
          items: 1
        },
        350: {
          items: 1
        },
        600: {
          items: 1
        },
      },
    })

    new ResizeSensor(jQuery('#accordion > li'), function() {
      owl.trigger('refresh.owl.carousel').delay(250).fadeIn(250);
    });

  });
</script>
<?php get_footer(); ?>