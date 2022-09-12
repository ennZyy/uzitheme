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

function get_vendor_product($vendor_id, $category_id=47) {
    $vendor_products = [];
    $all_products = new WP_Query([
        'post_type'              => array( 'product' ),
        'post_status'            => array( 'publish' ),
        'nopaging'               => true,
    ]);

    foreach ( $all_products->posts as $product ) {
        $t_product = wc_get_product($product->ID);
        $product_meta = get_post_meta($product->ID);
        $product_cat = $t_product->get_category_ids();

        if ( $product_meta['product_vendor'] && $product_meta['product_vendor'][0] == $vendor_id && in_array($category_id, $product_cat) ) {
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

    <?php if ( !empty($phones) ):

//        echo '<pre>';
//        print_r($phones);
//        echo '</pre>';
    ?>
    <table id="customers">
        <tr>
            <th>ID</th>
            <th>Phone</th>
        </tr>
        <?php foreach ( $phones as $key => $phone ):
            $phone_number = str_replace(array('+', ' ', '(' , ')', '-'), '', $phone['phones']);
            ?>
        <tr>
            <th><?= $key ?></th>
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
    $jsonData = stripslashes(html_entity_decode($_POST['query']));

    $args = json_decode($jsonData,true);

    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $posts = query_posts($args);

    if ( $args['post_type'] != 'vendors' ):
    foreach ($posts as $post) :
        $product = new WC_Product($post->ID);
        $attributes = $product->get_attributes();
        $product_category = $product->get_category_ids();
        $rating = get_field('rating', get_the_ID());
        $price = wc_price($product->get_price(), [
            'price_format' => '%2$s',
            'thousand_separator' => ' ',
            'decimal_separator' => ' ',
            'decimals' => 0
        ]);
    ?>
        <a href="<?= $product->get_permalink() ?>" class="list__body_items_item card newcard">
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
                    <div class="name" <?php if ( strlen($product->get_title()) > 20 || in_array(48, $product_category) ): ?> style="line-height: 29px;" <?php endif; ?>><?= $product->get_title() ?></div>
                    <div class="values">
                            <div class="values__price">
                                от <?= $price . get_woocommerce_currency_symbol( $currency = '' ); ?>
                            </div>
                        <?php if ( !in_array(48, $product_category) ): ?>
                        <div class="values__cnt">
                            <?php if ( !empty($rating) ): ?><span><?= $rating ?>/10</span><?php else: ?><span>0/10</span><?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="link">
                        <div>Подробнее</div>
                    </div>
                </div>
                <div class="card__body_ex">
                    <?php if ( !in_array(48, $product_category) ): ?>
                        <div class="head">
                            В категориях
                        </div>
                    <?php else: ?>
                        <div class="head">
                            Подходит:
                        </div>
                    <?php endif; ?>

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
                    <div class="action product-action-consultation">
                        <button>
                            Консультация в один клик
                        </button>
                    </div>
                </div>
            </div>

        </a>

    <?php
    endforeach;
    else:
        foreach ( $posts as $vendor ):?>
            <a href="<?= get_permalink($vendor->ID) ?>" class="vendors__item">
                <div class="vendors__item_img">
                    <picture>
                        <source srcset="" type="image/webp">
                        <?= get_the_post_thumbnail($vendor->ID, '', ['alt' => $vendor->post_title]) ?>
                    </picture>
                </div>
                <div class="vendors__item_body">
                    <div class="vendors__item_body_name"><?= $vendor->post_title ?></div>
                    <p class="vendors__item_body_link">подробнее</p>
                </div>
            </a>
        <?
        endforeach;
    endif;
    wp_die();
}
add_action('wp_ajax_loadmore', 'loadmore_get_posts');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_get_posts');

function loadmore_featured(){
    $jsonData = stripslashes(html_entity_decode($_POST['query']));

    $args = json_decode($jsonData,true);
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    $posts = query_posts($args);

    foreach ($posts as $post) :
        $product = new WC_Product($post->ID);
        $attributes = $product->get_attributes();

        $rating = get_field('rating', get_the_ID());
        $price = wc_price($product->get_regular_price(), [
            'price_format'       => '%2$s',
            'thousand_separator' => ' ',
            'decimal_separator'  => ' ',
            'decimals'           => 0
        ]);
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
                            от <?= $price . get_woocommerce_currency_symbol(); ?>                        </div>
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
                    <div class="action product-action-consultation">
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

function true_category_price_range($product_category)
{
    $result = '';
    $product_ids = get_posts(array(
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
    ));
    if (!$product_ids) {
        return;
    }

    $prices = [];
    foreach ($product_ids as $product_id) {
        $product = wc_get_product($product_id);
        if ($product->is_type('simple')) {
            $product_price = $product->get_price();
            $prices[] = $product_price;
        } elseif ($product->is_type('variable')) {
            $prices = $product->get_variation_prices();
            $min = current($prices['price']) < $min ? current($prices['price']) : $min;
            $max = end($prices['price']) > $max ? end($prices['price']) : $max;
        }
    }

    $result = [
        'min' => min($prices),
        'max' => max($prices)
    ];
    return $result;
}

add_shortcode( 'heading', 'heading_shortcode_handler' );
function heading_shortcode_handler( $atts ){
    $rg = (object) shortcode_atts( [
        'text' => '',
    ], $atts );

    $out = '
	<div class="prod__descr_item_head">
        <h3 class="prod__descr_item_head_title">'.$rg->text.'</h3>
    </div>
	';

    return $out;
}

add_shortcode( 'textwithimage', 'textwithimage_shortcode_handler' );
function textwithimage_shortcode_handler( $atts ){
    $rg = (object) shortcode_atts( [
        'imgurl'=>'',
        'imgtext'=>''
    ], $atts );

    $out = '
	<div class="prod__descr_item_body">
                                <div class="text">
                                '. $rg->text .'
                                </div>
                                <div class="usf">
                                    <div class="usf__img">
                                        <picture>
                                            <source srcset="" type="image/webp">
                                            <img src="'. $rg->imgurl .'" alt="">
                                        </picture>
                                    </div>
                                    <div class="usf__body">
                                        '. $rg->imgtext .'
                                    </div>
                                </div>
                            </div>
	';

    return $out;
}

add_shortcode( 'productrating', 'product_rating_shortcode_handler' );
function product_rating_shortcode_handler( $atts ){
    $rg = (object) shortcode_atts( [
        'id' => '',
        'place'=>''
    ], $atts );

    $product = wc_get_product($rg->id);
    $attachment_ids = $product->get_gallery_image_ids();
    $images = '';

    foreach( $attachment_ids as &$attachment_id ) {
        $attachment_id = wp_get_attachment_image_url( $attachment_id, [530, 581], '$icon' );
    }

    foreach ($attachment_ids as $attachment_id) {
        $url = $attachment_id;
        $images .= '
        <div class="prod__main_thumbs_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="'. $url .'" alt="'.$product->get_title().'">
                                                    </picture>
                                                </div>
        ';
    }

    $out = '
	<div class="prod__descr_item active" id="rateProd">
                            <div class="prod__descr_item_head">
                                <div class="prod__descr_item_head_title">
                                    '.$rg->place.'
                                </div>
                            </div>
                            <div class="prod__descr_item_body">
                                <div class="prod__main">

                                    <div class="prod__main_content">
                                        <div class="prod__main_thumbs swiper">
                                            <div class="prod__main_thumbs_wr swiper-wrapper">
                                                '. $images .'
                                            </div>

                                            <div class="prod__main_thumbs_prev">
                                                <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.50019 9.73123C1.16174 10.0794 0.600522 10.0847 0.255384 9.74304C-0.0786183 9.41239 -0.0859278 8.87856 0.238899 8.53907L8.13756 0.283686C8.49272 -0.0875205 9.08726 -0.0954989 9.45246 0.266041C9.80593 0.615962 9.81141 1.1816 9.46478 1.53817L1.50019 9.73123Z" fill="#2F2F2F"/>
                                                    <path d="M17.7456 8.53188C18.0848 8.86773 18.0848 9.41226 17.7456 9.74811C17.4063 10.084 16.8563 10.084 16.517 9.74811L8.53146 1.84259C8.19221 1.50674 8.19221 0.962209 8.53146 0.626355C8.87072 0.290501 9.42076 0.290501 9.76001 0.626355L17.7456 8.53188Z" fill="#2F2F2F"/>
                                                </svg>

                                            </div>
                                            <div class="prod__main_thumbs_next">
                                                <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16.4998 0.268772C16.8383 -0.0793941 17.3995 -0.0847205 17.7446 0.256958C18.0786 0.587613 18.0859 1.12144 17.7611 1.46093L9.86244 9.71631C9.50728 10.0875 8.91274 10.0955 8.54754 9.73396C8.19407 9.38404 8.18859 8.8184 8.53522 8.46183L16.4998 0.268772Z" fill="#2F2F2F"/>
                                                    <path d="M0.254442 1.46812C-0.0848122 1.13227 -0.0848122 0.587743 0.254442 0.25189C0.593695 -0.0839642 1.14373 -0.0839641 1.48299 0.25189L9.46854 8.15741C9.80779 8.49326 9.80779 9.03779 9.46854 9.37364C9.12928 9.7095 8.57924 9.7095 8.23999 9.37364L0.254442 1.46812Z" fill="#2F2F2F"/>
                                                </svg>

                                            </div>
                                        </div>
                                        <div class="prod__main_slider swiper">
                                            <div class="prod__main_slider_wr swiper-wrapper">
                                                '. $images .'
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
	';

    return $out;
}

add_shortcode( 'producttext', 'product_text_shortcode_handler' );
function product_text_shortcode_handler( $atts ){
    extract( shortcode_atts( [
        'description'=>'',
        'important'=>'',
        'ref'=>''
    ], $atts ));

    $out = '
	<div class="prod__descr_item active">
                                <div class="prod__descr_item_body">
                                    <div class="text">
                                        '. $description .'
                                    </div>
                                    <div class="spr">
                                        <div class="spr__item spr__main">
                                            <div class="spr__item_head">Важно</div>
                                            <div class="spr__item_body">
                                             '. $important .'
                                            </div>
                                        </div>
                                        <div class="spr__item spr__wr">
                                            <div class="spr__item_head">Справка</div>
                                            <div class="spr__item_body">
                                            '. $ref .'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
	';

    return $out;
}

// Хуки 1
function true_add_mce_button() {
    // проверяем права пользователя - может ли он редактировать посты и страницы
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return; // если не может, то и кнопка ему не понадобится, в этом случае выходим из функции
    }
    // проверяем, включен ли визуальный редактор у пользователя в настройках (если нет, то и кнопку подключать незачем)
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'true_add_tinymce_script' );
        add_filter( 'mce_buttons', 'true_register_mce_button' );
    }
}
add_action('admin_head', 'true_add_mce_button');

// В этом функции указываем ссылку на JavaScript-файл кнопки
function true_add_tinymce_script( $plugin_array ) {
    $plugin_array['true_mce_button'] = get_stylesheet_directory_uri() .'/true_button.js'; // true_mce_button - идентификатор кнопки
    return $plugin_array;
}

// Регистрируем кнопку в редакторе
function true_register_mce_button( $buttons ) {
    array_push( $buttons, 'true_mce_button2' ); // true_mce_button - идентификатор кнопки
    return $buttons;
}

// Хуки 2
function true_add_mce_button2() {
    // проверяем права пользователя - может ли он редактировать посты и страницы
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return; // если не может, то и кнопка ему не понадобится, в этом случае выходим из функции
    }
    // проверяем, включен ли визуальный редактор у пользователя в настройках (если нет, то и кнопку подключать незачем)
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'true_add_tinymce_script2' );
        add_filter( 'mce_buttons', 'true_register_mce_button2' );
    }
}
add_action('admin_head', 'true_add_mce_button2');

// В этом функции указываем ссылку на JavaScript-файл кнопки
function true_add_tinymce_script2( $plugin_array ) {
    $plugin_array['true_mce_button2'] = get_stylesheet_directory_uri() .'/true_button.js'; // true_mce_button - идентификатор кнопки
    return $plugin_array;
}

// Регистрируем кнопку в редакторе
function true_register_mce_button2( $buttons ) {
    array_push( $buttons, 'true_mce_button' ); // true_mce_button - идентификатор кнопки
    return $buttons;
}


// Хуки 3
function true_add_mce_button3() {
    // проверяем права пользователя - может ли он редактировать посты и страницы
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return; // если не может, то и кнопка ему не понадобится, в этом случае выходим из функции
    }
    // проверяем, включен ли визуальный редактор у пользователя в настройках (если нет, то и кнопку подключать незачем)
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'true_add_tinymce_script3' );
        add_filter( 'mce_buttons', 'true_register_mce_button3' );
    }
}
add_action('admin_head', 'true_add_mce_button3');

// В этом функции указываем ссылку на JavaScript-файл кнопки
function true_add_tinymce_script3( $plugin_array ) {
    $plugin_array['true_mce_button3'] = get_stylesheet_directory_uri() .'/true_button.js'; // true_mce_button - идентификатор кнопки
    return $plugin_array;
}

// Регистрируем кнопку в редакторе
function true_register_mce_button3( $buttons ) {
    array_push( $buttons, 'true_mce_button3' ); // true_mce_button - идентификатор кнопки
    return $buttons;
}


// Хуки 4
function true_add_mce_button4() {
    // проверяем права пользователя - может ли он редактировать посты и страницы
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return; // если не может, то и кнопка ему не понадобится, в этом случае выходим из функции
    }
    // проверяем, включен ли визуальный редактор у пользователя в настройках (если нет, то и кнопку подключать незачем)
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'true_add_tinymce_script4' );
        add_filter( 'mce_buttons', 'true_register_mce_button4' );
    }
}
add_action('admin_head', 'true_add_mce_button4');

// В этом функции указываем ссылку на JavaScript-файл кнопки
function true_add_tinymce_script4( $plugin_array ) {
    $plugin_array['true_mce_button4'] = get_stylesheet_directory_uri() .'/true_button.js'; // true_mce_button - идентификатор кнопки
    return $plugin_array;
}

// Регистрируем кнопку в редакторе
function true_register_mce_button4( $buttons ) {
    array_push( $buttons, 'true_mce_button4' ); // true_mce_button - идентификатор кнопки
    return $buttons;
}