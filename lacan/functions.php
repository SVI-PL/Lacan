<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
/**
 * Lacan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lacan
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lacan_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Lacan, use a find and replace
		* to change 'lacan' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('lacan', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'lacan'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'lacan_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'lacan_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lacan_content_width()
{
	$GLOBALS['content_width'] = apply_filters('lacan_content_width', 640);
}
add_action('after_setup_theme', 'lacan_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lacan_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'lacan'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'lacan'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'lacan_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function lacan_scripts()
{
	wp_enqueue_style('lacan-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('lacan-main-style', get_template_directory_uri() . '/css/main.css', array(), _S_VERSION);
	wp_enqueue_style('lacan-owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), _S_VERSION);
	wp_enqueue_style('lacan-owl-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css', array(), _S_VERSION);

	wp_enqueue_script('jquery');
	wp_enqueue_script('lacan-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
	wp_enqueue_script('lacan-resize-js', get_template_directory_uri() . '/js/jquery-resizable.js', array(), _S_VERSION, true);
	wp_enqueue_script('lacan-owl-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('lacan-cookie-js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), _S_VERSION, true);
	wp_enqueue_script('lottie-js', get_template_directory_uri() . '/js/lottie.js', array(), _S_VERSION, true);
	
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'lacan_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
add_theme_support('post-thumbnails');
add_theme_support('post-thumbnails', array('post'));
set_post_thumbnail_size(500, 400, true);


if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Theme setting',
		'menu_title' => 'Theme setting',
		'menu_slug'  => 'theme_settings',
	));
}

add_filter('get_the_archive_title', function ($title) {
	return preg_replace('~^[^:]+: ~', '', $title);
});
add_filter('excerpt_more', fn () => '...');

add_filter('get_search_form', 'ba_search_form');
function ba_search_form($form)
{
	$form = '
		<form role="search" method="get" id="searchform" action="' . home_url('/') . '" >
			<input type="text" value="' . get_search_query() . '" name="s" class="search-input" id="s" placeholder="Search" /> <div class="search_icon2"></div>
		</form>
		<div class="result-search search_result">
			<div class="result-search-list"></div>
		</div>
	';
	return $form;
}

function ba_ajax_search()
{

	$args = array(
		's' => $_POST['term'],
		'posts_per_page' => 5,
	);

	$the_query = new WP_Query($args);
	?> 
	<div class="post_count">Найдено записей: <?php echo $the_query->post_count; ?> </div>
	<?php
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
	?>
			<div class="result_item clear">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<div class="search_cat">Category:
					<?php
					foreach ((get_the_category()) as $category) {
						echo $category->cat_name . ' ';
					}
					?>
				</div>
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>"><div class="read_more"> לפרטים נוספים והרשמה &gt;</div></a>
			</div>
		<?php
		}
	} else {
		?>
		<div class="result_item">
			<span class="not_found">Ничего не найдено, попробуйте другой запрос</span>
		</div>
<?php
	}
	wp_die();
}
add_action('wp_ajax_nopriv_ba_ajax_search', 'ba_ajax_search');
add_action('wp_ajax_ba_ajax_search', 'ba_ajax_search');
