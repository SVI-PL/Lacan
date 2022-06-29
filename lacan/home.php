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
        <a href="/"><img src="<?php the_field('logo_black', 'option'); ?>" class="logo_rtl"></a>
        <a href="/"><img src="<?php the_field('logo_eng', 'option'); ?>" class="logo_eng"></a>
      </div>
      <div class="achive">
        <img src="<?php echo get_template_directory_uri(); ?>/img/if.png" class="IF">
      </div>
    </div>
    <div class="main_page_body">
      <div class="lottie_img" id="lottie"></div>
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
          <div class="owl-carousel owl-theme owl1">
            <?php
            $query = new WP_Query('cat=1&posts_per_page=3');
            if ($query->have_posts()) {
              while ($query->have_posts()) {
                $query->the_post();
            ?>
                <div class="article-item">
                  <article>
                    <figure>
                      <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url(500, 300); ?>"></a>
                    </figure>
                    <div class="tab_article_content">
                      <div class="dots_clone">
                        <div class="owl-dots">
                          <button role="button" class="owl-dot active"><span></span></button>
                          <button role="button" class="owl-dot"><span></span></button>
                          <button role="button" class="owl-dot"><span></span></button>
                        </div>
                      </div>
                      <div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                      <?php the_excerpt(); ?>
                    </div>
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
                      <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url(500, 300); ?>"></a>
                    </figure>
                    <div class="tab_article_content">
                      <div class="dots_clone">
                        <div class="owl-dots">
                          <button role="button" class="owl-dot active"><span></span></button>
                          <button role="button" class="owl-dot"><span></span></button>
                          <button role="button" class="owl-dot"><span></span></button>
                        </div>
                      </div>
                      <div class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                      <?php the_excerpt(); ?>
                    </div>
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

<script>
  jQuery(document).ready(function($) {
    var owl = $('.owl-carousel').owlCarousel({
      loop: false,
      margin: 10,
      items: 1,
      nav: true,
      rtl: true,
      dots: true,

      navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"]
    })

    var owl2 = $('.owl2').owlCarousel({
      loop: false,
      margin: 10,
      items: 1,
      nav: true,
      rtl: true,
      dots: true,

      navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"]
    })
    new ResizeSensor(jQuery('#accordion > li'), function() {
      owl.trigger('refresh.owl.carousel').delay(50).fadeIn(50);
    });
    var anim;
    var elem = document.getElementById("lottie");
    var animData = {
      container: elem,
      renderer: 'svg',
      loop: true,
      autoplay: true,
      rendererSettings: {
        progressiveLoad: true,
        preserveAspectRatio: "xMidYMid meet",
        imagePreserveAspectRatio: "xMidYMid meet"
      },
      path: '<?php echo get_template_directory_uri(); ?>/img/Glass_Shape_Animation.json'
    };
    anim = lottie.loadAnimation(animData);
    anim.addEventListener("DOMLoaded", function() {
      $("#lottie").css("background", "url()");
    });



  });
</script>
<?php get_footer(); ?>