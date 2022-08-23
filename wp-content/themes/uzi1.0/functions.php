<?php
/**
 * BPSD functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BPSD
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '2.1' );
}

if ( ! function_exists( 'uzi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function uzi_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on BPSD, use a find and replace
		 * to change 'bpsd' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'uzi', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'uzi' ),
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
				'uzi_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

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
endif;
add_action( 'after_setup_theme', 'uzi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uzi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uzi_content_width', 640 );
}
add_action( 'after_setup_theme', 'uzi_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uzi_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'uzi' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'uzi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'uzi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function uzi_scripts() {
    wp_enqueue_script( 'jquery' );

    wp_enqueue_style( 'uzi-main-css', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION );

    wp_enqueue_script( 'uzi-main-js', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), _S_VERSION, true );
    wp_enqueue_script( 'uzi-product-js', get_template_directory_uri() . '/assets/js/product.js', array('jquery'), _S_VERSION, true );
    wp_enqueue_script( 'uzi-sub-main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), _S_VERSION, true );

    if(is_product()){
        wp_localize_script( 'uzi-product-js', 'ajax_url',
            array(
                'url' => admin_url('admin-ajax.php')
            )
        );
    }

    wp_localize_script( 'uzi-sub-main-js', 'ajax_url',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );
}
add_action( 'wp_enqueue_scripts', 'uzi_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/custom-post-type.php';
require get_template_directory() . '/inc/category-functions.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/inc/product-admin.php';
require get_template_directory() . '/inc/product-review.php';
//require get_template_directory() . '/inc/cart.php';

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


//add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_filter( 'wp_sitemaps_enabled', '__return_false' );

function array_mb_replace($value) {
    return [
        'option' => str_replace(' ', '-', mb_strtolower($value['option'])),
        'price' => $value['price']
    ];
}

add_filter( 'woocommerce_checkout_redirect_empty_cart', '__return_false' );
add_filter( 'woocommerce_checkout_update_order_review_expired', '__return_false' );

// Utility function that give the discount percentage based on quantity argument
function get_discount_percent( $quantity, $product_id, $variations){
    $product = wc_get_product($product_id);
    $percent = 0;
    $discountTable = get_field('discount_table', 'product_cat_'.$product->get_category_ids()[0]);
    $optionsTable = array_map('array_mb_replace', get_field('add_dop_price', 'product_cat_'.$product->get_category_ids()[0]));

    $price = 0;
    foreach ($variations as $variation) {
        $min_variant = str_replace(' ', '-', mb_strtolower($variation));
        $column_id = array_search($min_variant, array_column($optionsTable, 'option'));
        if ($column_id !== false) {
            $price += $optionsTable[$column_id]['price'];
        }
    }

    foreach ($discountTable as $discount) {
        if ($quantity >= $discount['from'] && $quantity < $discount['to'])
            $percent = $discount['discount'];
    }

    return [$percent, $price];
}

function get_discount_table($product_id, $variations){
    $product = wc_get_product($product_id);
    $percent = 0;
    $discountTable = get_field('discount_table', 'product_cat_'.$product->get_category_ids()[0]);
    $optionsTable = array_map('array_mb_replace', get_field('add_dop_price', 'product_cat_'.$product->get_category_ids()[0]));

    $price = 0;
    foreach ($variations as $variation) {
        $min_variant = str_replace(' ', '-', mb_strtolower($variation));
        $column_id = array_search($min_variant, array_column($optionsTable, 'option'));
        if ($column_id !== false) {
            $price += $optionsTable[$column_id]['price'];
        }
    }

    return [
        'table' => $discountTable,
        'dop_price' => $price
    ];
}

add_filter('woocommerce_add_cart_item_data', 'add_items_default_price_as_custom_data', 20, 3 );
function add_items_default_price_as_custom_data( $cart_item_data, $product_id, $variation_id ){
    $productID = $product_id;
    $product_id = $variation_id > 0 ? $variation_id : $product_id;

    // The WC_Product Object
    $product = wc_get_product($product_id);

    // Set the Product default base price as custom cart item data
    $cart_item_data['discounts'] = get_discount_table($productID, $product->get_attributes());

    if (isset($_POST['custom_variant'])) {

        list($width, $height) = explode('-x-', $_POST['variant']);

        $cart_item_data['custom_size'] = $_POST['variant'];
        if ($_POST['new_price']) {
            $cart_item_data['custom_price'] = $_POST['new_price'];
        } else {
            $cart_item_data['custom_price'] = $product->get_price()*$width*$height;
        }

        if ($_POST['new_name']) {
            $cart_item_data['custom_name'] = $_POST['new_name'];
        }
    }

    if (isset($_POST['custom_weight'])) {
        $cart_item_data['custom_weight'] = $_POST['custom_weight'];
    }

    return $cart_item_data;
}

// Display the product original price
add_filter('woocommerce_cart_item_price', 'display_cart_items_default_price', 20, 3 );
function display_cart_items_default_price( $product_price, $cart_item, $cart_item_key ){
    if( isset($cart_item['discount'][0]) ) {
        $product        = $cart_item['data'];
        $product_price  = wc_price( wc_get_price_to_display( $product, array( 'price' => $cart_item['discount'][0] ) ) );
    }
    return $product_price;
}

// Display the product name with the discount percentage
add_filter( 'woocommerce_cart_item_name', 'append_percetage_to_item_name', 20, 3 );
function append_percetage_to_item_name( $product_name, $cart_item, $cart_item_key ){
//    if (isset($cart_item['custom_size'])) {
//
//        $attributes = $cart_item['data']->get_attributes();
//
//        $attributes['pa_set-size'] = $cart_item['custom_size'];
//
//        $cart_item['data']->set_attributes($attributes);
//    }

    // get the percent based on quantity
    $percent = get_discount_percent($cart_item['quantity'], $cart_item['product_id'], $cart_item['variation']);

    if($percent[0] != 0) {
        if( $cart_item['data']->get_price() != $cart_item['discount'][0] )
            $product_name .= ' <em>(' . $percent[0] . '% discounted)</em>';
    }
    return $product_name;
}

add_action( 'woocommerce_before_calculate_totals', 'set_custom_discount_cart_item_price', 25, 1 );
function set_custom_discount_cart_item_price( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    foreach( $cart->get_cart() as $cart_item ){
        // get the percent based on quantity
        $percentage = get_discount_percent($cart_item['quantity'], $cart_item['product_id'], $cart_item['variation']);

        $price = $cart_item['data']->get_price();
        if (isset($cart_item['custom_price'])) {
            $price = $cart_item['custom_price'];
        }

        if (isset($cart_item['custom_name'])) {
            $cart_item['data']->set_name($cart_item['custom_name']);
        }

        if (isset($cart_item['custom_weight'])) {
            $cart_item['data']->set_weight($cart_item['custom_weight']);
        }

        // For items non on sale set a discount based on quantity as defined in
        if( $percentage != 0 && ! $cart_item['data']->is_on_sale() ) {
            $cart_item['data']->set_price(($price-$percentage[1]) * ((100-$percentage[0])/100) + $percentage[1]);
        } else {
            $cart_item['data']->set_price($price);
        }

        file_put_contents('../.log-product_data', date('[Y-m-d H:i:s] ') . "\n" . print_r([
                'variation' => $cart_item['variation'],
                'discount' => $percentage[0],
                'quantity' => $cart_item['quantity'],
                'product_id' => $cart_item['product_id'],
                'old_price' => $price,
                'dop_price' => $percentage[1],
                'no_dop_price' =>$price-$percentage[1],
                'new_price' => ($price-$percentage[1]) * ((100-$percentage[0])/100) + $percentage[1],
                'cart_item_data' => $cart_item
            ], true) . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}


function register_pending_artwork_order_status() {
    register_post_status( 'wc-pending-artwork', array(
        'label'                     => 'Pending Artwork Approval',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Pending Artwork Approval (%s)', 'Pending Artwork Approval (%s)' )
    ) );
}
add_action('init', 'register_pending_artwork_order_status');
function register_artwork_approved_order_status() {
    register_post_status( 'wc-artwork-approved', array(
        'label'                     => 'Artwork Approved',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Artwork Approved (%s)', 'Artwork Approved (%s)' )
    ) );
}
add_action('init', 'register_artwork_approved_order_status');
function register_in_production_order_status() {
    register_post_status( 'wc-in-production', array(
        'label'                     => 'In production',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'In production (%s)', 'In production (%s)' )
    ) );
}
add_action('init', 'register_in_production_order_status');
function register_ready_for_quality_check_order_status() {
    register_post_status( 'wc-ready-check', array(
        'label'                     => 'Ready for Quality Check',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Ready for Quality Check (%s)', 'Ready for Quality Check (%s)' )
    ) );
}
add_action('init', 'register_ready_for_quality_check_order_status');
function register_ready_for_pickup_order_status() {
    register_post_status( 'wc-ready-pickup', array(
        'label'                     => 'Ready for Pickup',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Ready for Pickup (%s)', 'Ready for Pickup (%s)' )
    ) );
}
add_action('init', 'register_ready_for_pickup_order_status');
function register_picked_up_order_status() {
    register_post_status( 'wc-picked-up', array(
        'label'                     => 'Picked Up',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Picked Up (%s)', 'Picked Up (%s)' )
    ) );
}
add_action('init', 'register_picked_up_order_status');


function add_pending_artwork_approval_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-pending-artwork'] = 'Pending Artwork Approval';
        }
    }
    return $new_order_statuses;
}
add_filter('wc_order_statuses', 'add_pending_artwork_approval_to_order_statuses');
function add_artwork_approved_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-artwork-approved'] = 'Artwork Approved';
        }
    }
    return $new_order_statuses;
}
add_filter('wc_order_statuses', 'add_artwork_approved_to_order_statuses');
function add_in_production_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-in-production'] = 'In production';
        }
    }
    return $new_order_statuses;
}
add_filter('wc_order_statuses', 'add_in_production_to_order_statuses');
function add_ready_for_quality_check_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-ready-check'] = 'Ready for Quality Check';
        }
    }
    return $new_order_statuses;
}
add_filter('wc_order_statuses', 'add_ready_for_quality_check_to_order_statuses');
function add_ready_for_pickup_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-ready-pickup'] = 'Ready for Pickup';
        }
    }
    return $new_order_statuses;
}
add_filter('wc_order_statuses', 'add_ready_for_pickup_to_order_statuses');
function add_picked_up_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-picked-up'] = 'Picked Up';
        }
    }
    return $new_order_statuses;
}
add_filter('wc_order_statuses', 'add_picked_up_to_order_statuses');


function change_custom_to_order_notification( $order_id, $from_status, $to_status, $order ) {
    global $woocommerce;
    $order = new WC_Order( $order_id );

    if($order->status === 'artwork-approved') {
        $email_notifications = WC()->mailer()->get_emails();
        $email_notifications['WC_Email_Customer_In_Production_Order']->trigger($order_id);
    }
    if($order->status === 'ready-pickup') {
        $email_notifications = WC()->mailer()->get_emails();
        $email_notifications['WC_Email_Customer_Ready_For_Pickup_Order']->trigger($order_id);
    }
    if($order->status === 'picked-up') {
        $email_notifications = WC()->mailer()->get_emails();
        $email_notifications['WC_Email_Customer_Picked_Up_Order']->trigger($order_id);
    }
}
add_action('woocommerce_order_status_changed', 'change_custom_to_order_notification', 10, 4);

add_filter('nav_menu_css_class', 'filter_nav_menu_css_classes', 10, 4);
function filter_nav_menu_css_classes($classes, $item, $args, $depth) {
    if ($args->menu === 'Category Menu') {
        if ($depth == 0) {
            $classes = [
                'main-menu__category-list-item is_mobile',
            ];
        } else {
            $classes = [];
        }
    }

    return $classes;
}

add_filter('nav_menu_submenu_css_class', 'filter_nav_menu_submenu_css_class', 10, 3);
function filter_nav_menu_submenu_css_class($classes, $args, $depth) {
    if ($args->menu == 'Category Menu') {
        if ($depth == 0) {
            $classes = [
                'sub-menu__category'
            ];
        } else {
            $classes = [];
        }
    }

    return $classes;
}

add_filter( 'wp_mail_content_type', 'true_content_type' );

function true_content_type( $content_type ) {
    return 'text/html';
}

add_filter( 'wp_mail_charset', 'true_mail_charset' );

function true_mail_charset( $content_type ) {
    return 'utf-8';
}

function custom_remove_post_locked() {
    $current_post_type = get_current_screen()->post_type;

    // Disable locking for page, post and some custom post type
    $post_types_arr = array(
        'page',
        'post',
        'custom_post_type',
        'shop_order'
    );

    if(in_array($current_post_type, $post_types_arr)) {
        add_filter( 'show_post_locked_dialog', '__return_false' );
        add_filter( 'wp_check_post_lock_window', '__return_false' );
        wp_deregister_script('heartbeat');
    }
}

add_action('load-edit.php', 'custom_remove_post_locked');
add_action('load-post.php', 'custom_remove_post_locked');

add_filter( 'wpo_wcpdf_paper_format', 'wcpdf_a6_packing_slips', 10, 2 );
function wcpdf_a6_packing_slips($paper_format, $template_type) {
    if ($template_type == 'packing-slip') {
        $paper_format = 'a6';
    }

    return $paper_format;
}

//Add page with custom fields
acf_add_options_page(array(
    'page_title' => 'Основные настройки',
    'menu_title' => 'Основные настройки',
    'menu_slug' => 'general_options',
    'capability' => 'edit_posts',
    'redirect' => false
));

//Add custom class for menu items
function add_custom_class_to_menu_item($classes, $item, $args)
{
    if ('Header menu' === $args->menu) {
        $classes[] = 'header__nav_item';
    } elseif ('Sub menu' === $args->menu) {
        $classes[] = '';
    } elseif ('Menu 404' === $args->menu) {
        $classes[] = 'notfound__body_item';
    } elseif ('Mob menu' === $args->menu ) {
        $classes[] = 'mobmenu__item';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'add_custom_class_to_menu_item', 10, 3);

//Add custom class for url items
function nav_link_filter( $atts, $item, $args, $depth ){
    if ('Sub menu' === $args->menu) {
        $atts['class'] = 'tbs__item swiper-slide';
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'nav_link_filter', 10, 4 );


add_filter("wp_head", "wpds_increament_post_view");
function get_post_views($post_id=NULL){
    global $post;
    if($post_id==NULL)
        $post_id = $post->ID;
    if(!empty($post_id)){
        $views_key = 'wpds_post_views';
        $views = get_post_meta($post_id, $views_key, true);
        if(empty($views) || !is_numeric($views)){
            delete_post_meta($post_id, $views_key);
            add_post_meta($post_id, $views_key, '0');
            return "0";
        }
        else if($views == 1)
            return "1";
        return $views.'';
    }
}

function wpds_increament_post_view() {
    global $post;

    if(is_singular()){
        $views_key = 'wpds_post_views';
        $views = get_post_meta($post->ID, $views_key, true);
        if(empty($views) || !is_numeric($views)){
            delete_post_meta($post->ID, $views_key);
            add_post_meta($post->ID, $views_key, '1');
        }else
            update_post_meta($post->ID, $views_key, ++$views);
    }
}

//Добавление post type - производитель
add_action( 'init', function() {

    register_post_type( 'vendors',
        [
            'public'                    => true,
            'menu_icon'                 => 'dashicons-welcome-widgets-menus',
            'supports'                  => [
                'title',
                'editor',
                'thumbnail',
                'custom-fields' => [
                        'test'  => 'test'
                ]
            ],
            'labels'                    => [
                'name'                  => 'Производители',
                'all_items'             => 'Список всех производителей',
                'add_new'               => 'Добавить нового производителя',
                'featured_image'        => 'Изображение производителя',
                'set_featured_image'    => 'Установить изображение производителя',
            ],
            'exclude_from_search'       => true,
            'has_archive'               => true,
            'menu_position'             => 3
        ]
    );

} );

function get_vendor_product($vendor_id) {
    $vendor_products = [];
    $all_products = new WP_Query([
        'post_type'              => array( 'product' ),
        'post_status'            => array( 'publish' ),
        'nopaging'               => true,
    ]);

    foreach ( $all_products->posts as $product ) {
        $product_meta = get_post_meta($product->ID);

        if ( isset($product_meta['product_vendor']) && !empty($product_meta['product_vendor']) && $product_meta['product_vendor'][0] == $vendor_id ) {
            $vendor_products[] = $product;
            $product->rating = $product_meta['rating'][0];
        }
    }

    return $vendor_products;
}

function get_count_vendor_product_apparatus ($vendor_id) {
    $vendor_products = [];
    $all_products = new WP_Query([
        'post_type'              => array( 'product' ),
        'post_status'            => array( 'publish' ),
        'tax_query'              => [
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => 47,
            'operator' => 'IN'
        ],
    ]);

    foreach ( $all_products->posts as $product ) {
        $product_meta = get_post_meta($product->ID);

        if ( isset($product_meta['product_vendor']) && !empty($product_meta['product_vendor']) && $product_meta['product_vendor'][0] == $vendor_id ) {
            $vendor_products[] = $product;
        }
    }

    return count($vendor_products);
}

function add_user_contact_page() {
    add_menu_page(
        'Заявки пользователей',
        'Заявки пользователей',
        'administrator',
        'user-request',
        'get_user_contact_page',
        'dashicons-buddicons-pm',
        2
    );
}
add_action( 'admin_menu', 'add_user_contact_page' );

function get_user_contact_page() {
    global $wpdb;

    $phones = $wpdb->get_results('SELECT * FROM `wp_user_request_contact`', ARRAY_A);
    ?>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #fff;
            color: #000000;
        }
    </style>
    </head>
    <body>

    <h1>Заявки пользователей</h1>

    <?php if ( !empty($phones) ): ?>
    <table id="customers">
        <tr>
            <th>ID</th>
            <th>Phone</th>
        </tr>
        <?php foreach ( $phones as $phone ):
            $phone_number = str_replace(array('+', ' ', '(' , ')', '-'), '', $phone['phones']);;
        ?>
        <tr>
            <th><?= $phone['id'] ?></th>
            <th>
                <a href="tel:+<?= $phone_number ?>"><?= $phone['phones'] ?></a>
            </th>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif;
}

function get_wc_product_by_title( $title ){
    global $wpdb;

    $post_title = strval($title);

    $post_table = $wpdb->prefix . "posts";
    $result = $wpdb->get_col("
        SELECT ID
        FROM $post_table
        WHERE post_title LIKE '$post_title'
        AND post_type LIKE 'product'
    ");

    if( empty( $result[0] ) )
        return;
    else
        return wc_get_product( intval( $result[0] ) );
}

function loadmore_get_posts(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $posts = query_posts($args);

    foreach ($posts as $post) :
        $product = new WC_Product($post->ID);
        $attributes = $product->get_attributes();

        $rating = get_field('rating', get_the_ID());
    ?>
        <a href="<?= $product->get_permalink() ?>" class="list__body_items_item card" id="nercard">
            <div class="card__img">
                <picture>
                    <source srcset="" type="image/webp">
                    <img
                            src="<?= wp_get_attachment_url($product->get_image_id()); ?>"
                            alt="<?= $product->get_title() ?>"
                    >
                </picture>
            </div>
            <div class="card__body">
                <div class="card__body_main">
                    <div class="name"><?= $product->get_title() ?></div>
                    <div class="values">
                            <div class="values__price">
                                от <?php echo $product->get_price() . get_woocommerce_currency_symbol( $currency = '' ); ?>
                            </div>
                        <div class="values__cnt">
                            <?php if ( !empty($rating) ): ?><span><?= $rating ?>/10</span><?php else: ?><span>0/10</span><?php endif; ?>
                        </div>
                    </div>
                    <div class="link">
                        <div>Подробнее</div>
                    </div>
                </div>
                <div class="card__body_ex">
                    <div class="head">
                        В категориях
                    </div>
                    <?php if ( !empty( $attributes ) ): ?>
                    <ul class="list">
                        <?php
                        foreach ( $attributes as $attribute_item ):
                            foreach (wc_get_product_terms( $product->get_id(), $attribute_item->get_data()['name'], array( 'taxonomy' =>  'sensor-frequencies' ) ) as $value): ?>
                                <?php
                                if ( $value->taxonomy === 'pa_application-area' ):
                                    echo '<li class="list__item">— ' . $value->name . '</li>';
                                endif;

                                if ( $value->taxonomy === 'pa_suitable-device' && is_product_category(48) ) {
                                    echo '<li class="list__item">— ' . $value->name . '</li>';
                                }

                                ?>
                            <?php endforeach;
                        endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <div class="action">
                        <button>
                            Консультация в один клик
                        </button>
                    </div>
                </div>
            </div>

        </a>

    <?php
    endforeach;

    wp_die();
}
add_action('wp_ajax_loadmore', 'loadmore_get_posts');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_get_posts');

function loadmore_featured(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $posts = query_posts($args);

    foreach ($posts as $post) :
        $product = new WC_Product($post->ID);
        $attributes = $product->get_attributes();

        $rating = get_field('rating', get_the_ID());
        ?>
        <a href="<?= $product->get_permalink() ?>" class="apr__item card" id="nercard">
            <div class="card__img">
                <picture>
                    <source srcset="" type="image/webp">
                    <img
                            src="<?= wp_get_attachment_url($product->get_image_id()); ?>"
                            alt="<?= $product->get_title(); ?>"
                    >
                </picture>
            </div>
            <div class="card__body">
                <div class="card__body_main">
                    <div class="name"><?= $product->get_title(); ?></div>
                    <div class="values">
                        <div class="values__price">
                            от <?php echo $product->get_price() . get_woocommerce_currency_symbol( $currency = '' ); ?>
                        </div>
                        <div class="values__cnt">
                            <?php if ( !empty($rating) ): ?><span><?= $rating ?>/10</span><?php else: ?><span>0/10</span><?php endif; ?>
                        </div>
                    </div>
                    <div class="link">
                        <div>Подробнее</div>
                    </div>
                </div>
                <div class="card__body_ex">
                    <div class="head">
                        В категориях
                    </div>
                    <?php if ( !empty( $attributes ) ): ?>
                        <ul class="list">
                            <?php
                            foreach ( $attributes as $attribute_item ):
                                foreach (wc_get_product_terms( $product->get_id(), $attribute_item->get_data()['name'], array( 'taxonomy' =>  'sensor-frequencies' ) ) as $value): ?>
                                    <?php
                                    if ( $value->taxonomy === 'pa_application-area' ):
                                        echo '<li class="list__item">— ' . $value->name . '</li>';
                                    endif;

                                    if ( $value->taxonomy === 'pa_suitable-device' && is_product_category(48) ) {
                                        echo '<li class="list__item">— ' . $value->name . '</li>';
                                    }

                                    ?>
                                <?php endforeach;
                            endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="action">
                        <button>
                            Консультация в один клик
                        </button>
                    </div>
                </div>
            </div>

        </a>

    <?php
    endforeach;

    wp_die();
}
add_action('wp_ajax_loadmore_featured', 'loadmore_featured');
add_action('wp_ajax_nopriv_loadmore_featured', 'loadmore_featured');

function loadmore_get_articles(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $posts = query_posts($args);

    foreach ($posts as $post) :
        ?>
        <a href="<?= $post->guid ?>" class="articles__list_item art">
            <div class="art__img">
                <picture>
                    <source srcset="" type="image/webp">
                    <img src="<?= get_the_post_thumbnail($post->ID) ?>" alt="<?= $post->post_title ?>">
                </picture>
            </div>
            <div class="art__body">
                <div class="art__body_name"><?= $post->post_title ?></div>
                <div class="art__body_info">
                    <div class="art__body_info_item art__body_info_item-rep">(<?= get_comments_number($post->ID) ?>)</div>
                    <div class="art__body_info_item art__body_info_item-sn">(<?= get_post_views($post->ID) ?>)</div>
                </div>
            </div>
        </a>
    <?php
    endforeach;

    wp_die();
}
add_action('wp_ajax_loadmore_get_articles', 'loadmore_get_articles');
add_action('wp_ajax_nopriv_loadmore_get_articles', 'loadmore_get_articles');

function filter_articles_by_date() {
    $posts = new WP_Query(
        array(
            'post_type'=>'post',
            'post_status'=>'publish',
            'order' => $_POST['orderBy'],
            'posts_per_page'=>'-1'));

    foreach ( $posts->posts as $post ) {
        $post_comment_count = get_comments_number($post->ID);
        $post_views = get_post_views($post->ID);
        ?>
        <a href="<?= $post->guid ?>" class="articles__list_item art">
            <div class="art__img">
                <picture>
                    <source srcset="" type="image/webp">
                    <img src="<?= get_the_post_thumbnail($post->ID) ?>" alt="<?= $post->post_title ?>">
                </picture>
            </div>
            <div class="art__body">
                <div class="art__body_name"><?= $post->post_title ?></div>
                <div class="art__body_info">
                    <div class="art__body_info_item art__body_info_item-rep">(<?= $post_comment_count ?>)</div>
                    <div class="art__body_info_item art__body_info_item-sn">(<?= $post_views ?>)</div>
                </div>
            </div>
        </a>
        <?php
    }

    wp_die();
}
add_action('wp_ajax_filter_articles_by_date', 'filter_articles_by_date');
add_action('wp_ajax_nopriv_filter_articles_by_date', 'filter_articles_by_date');

function filter_articles_by_views() {
    $order_views = $_POST['views'];
    $data = [];
    $posts = new WP_Query(
        array(
            'post_type'=>'post',
            'post_status'=>'publish',
            'order'=>'ASC'));

    $filtered_posts = [];
    $views_key = 'wpds_post_views';

    foreach ( $posts->posts as $post ) {
        $views = get_post_meta($post->ID, $views_key, true);

        $filtered_posts[] = [
          'id'    => $post->ID,
          'views' => $views
        ];
    }

    if ($order_views == 'popular') {
        usort($filtered_posts, function($a, $b){
            return ($a['views'] < $b['views']);
        });
    } else {
        usort($filtered_posts, function($a, $b){
            return ($a['views'] > $b['views']);
        });
    }

    foreach ( $filtered_posts as $item ) {
        $post = get_post($item['id']);
        $post_comment_count = get_comments_number($item['id']);
        $post_views = get_post_views($item['id']);
        ?>
        <a href="<?= $post->guid ?>" class="articles__list_item art">
            <div class="art__img">
                <picture>
                    <source srcset="" type="image/webp">
                    <img src="<?= get_the_post_thumbnail($post->ID) ?>" alt="<?= $post->post_title ?>">
                </picture>
            </div>
            <div class="art__body">
                <div class="art__body_name"><?= $post->post_title ?></div>
                <div class="art__body_info">
                    <div class="art__body_info_item art__body_info_item-rep">(<?= $post_comment_count ?>)</div>
                    <div class="art__body_info_item art__body_info_item-sn">(<?= $post_views ?>)</div>
                </div>
            </div>
        </a>
    <?php
    }

    wp_die();
}
add_action('wp_ajax_filter_articles_by_views', 'filter_articles_by_views');
add_action('wp_ajax_nopriv_filter_articles_by_views', 'filter_articles_by_views');

function get_comment_replies($comment_id=0,$args=array()) {
    $args = wp_parse_args($args,array(
        'post_id'=>0,
        'orderby'=>'comment_parent',
        'order'=>'ASC',
    ));
    extract($args);
    if (is_numeric($comment_id) && $comment_id>0 && !$post_id) {
        $comment = get_comment($comment_id);
        $post_id = $comment->comment_post_ID;
    }
    if (!$post_id && !is_numeric($comment_id) && $comment_id!='all') {
        wp_die('get_comment_replies() will not parse all comments unless explicitly requested.');
    }
    $comments = get_comments($args);
    $replies = array();
    foreach($comments as $comment) {
        $comment->reply_count = 0;
        $comment->replies = array();
        $replies[$comment->comment_ID] = $comment;
        if ($comment_id==$comment->comment_ID)
            $this_comment = $comment;
        if ($comment->comment_parent) {
            if (!isset($replies[$comment->comment_parent]->replies))
                $replies[$comment->comment_parent]->replies = array();
            $replies[$comment->comment_parent]->replies[$comment->comment_ID] = $comment;
        }
    }
    $children = array();
    $count = 0;
    if ($comment_id>0) {
        $this_comment->reply_count = _count_comment_replies($replies,$comment_id);
        $this_comment->replies = $replies[$comment_id]->replies;
        $replies = $this_comment;
    }
    return $replies;
}

function _count_comment_replies(&$replies,$comment_id) {
    $count = 0;
    if (count($replies[$comment_id]->replies)>0) {
        $count = count($replies[$comment_id]->replies);
        foreach($replies[$comment_id]->replies as $index => $reply) {
            $count += _count_comment_replies($replies,$reply->comment_ID);
        }
        $replies[$comment_id]->reply_count = $count;
    }
    return $count;
}

add_filter( 'woocommerce_subcategory_count_html', 'true_category_price_range', 25, 2 );

function true_category_price_range( $product_category ) {
    $result = '';
    $product_ids = get_posts( array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'fields' => 'ids',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $product_category,
            ),
            array(
                'taxonomy' => 'product_visibility',
                'field' => 'name',
                'terms' => 'exclude-from-catalog',
                'operator' => 'NOT IN',
            ),
        )
    ) );

    // если товаров в категории нет, то возвращаем ничего
    if( ! $product_ids ) {
        return;
    }

    // окей, товары значит есть, пройдёмся по ним циклом и вычислим минимальное и максимальное значение
    $min = PHP_FLOAT_MAX;
    $max = 0;

    foreach ( $product_ids as $product_id ) {
        // получим объект товара из его ID
        $product = wc_get_product( $product_id );
        // если товар простой
        if ( $product->is_type( 'simple' ) ) {
            // получаем цену
            $product_price = $product->get_price();
            // вычисляем минимальное
            $min = $product_price < $min ? $product_price : $min;
            // вычисляем максимальное
            $max = $product_price > $max ? $product_price : $max;

            // если товар вариативный, то тут можно слегка заморочиться
        } elseif ( $product->is_type( 'variable' ) ) {
            // получаем массив цен вариаций этого товара, уже отсортированных!
            $prices = $product->get_variation_prices();
            // вычисляем минимальное
            $min = current( $prices[ 'price' ] ) < $min ? current( $prices[ 'price' ] ) : $min;
            // вычисляем максимальное
            $max = end( $prices[ 'price' ] ) > $max ? end( $prices[ 'price' ] ) : $max;
        }
    }

    // финальная проверка, если существуют мин и макс, то выводим
    if( $min && $max ) {
        $result = [
            'min'   => $min,
            'max'   => $max
        ];
        return $result;
    }
}