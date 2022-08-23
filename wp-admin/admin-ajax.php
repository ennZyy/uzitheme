<?php
/**
 * WordPress Ajax Process Execution
 *
 * @package WordPress
 * @subpackage Administration
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
 */

/**
 * Executing Ajax process.
 *
 * @since 2.1.0
 */
define('DOING_AJAX', true);
if (!defined('WP_ADMIN')) {
    define('WP_ADMIN', true);
}

/** Load WordPress Bootstrap */
require_once dirname(__DIR__) . '/wp-load.php';

/** Allow for cross-domain requests (from the front end). */
send_origin_headers();

header('Content-Type: text/html; charset=' . get_option('blog_charset'));
header('X-Robots-Tag: noindex');

// Require a valid action parameter.
if (empty($_REQUEST['action']) || !is_scalar($_REQUEST['action'])) {
    wp_die('0', 400);
}

/** Load WordPress Administration APIs */
require_once ABSPATH . 'wp-admin/includes/admin.php';

/** Load Ajax Handlers for WordPress Core */
require_once ABSPATH . 'wp-admin/includes/ajax-actions.php';

send_nosniff_header();
nocache_headers();

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

/** This action is documented in wp-admin/admin.php */
do_action('admin_init');

$core_actions_get = array(
    'fetch-list',
    'ajax-tag-search',
    'wp-compression-test',
    'imgedit-preview',
    'oembed-cache',
    'autocomplete-user',
    'dashboard-widgets',
    'logged-in',
    'rest-nonce',
);

$core_actions_post = array(
    'oembed-cache',
    'image-editor',
    'delete-comment',
    'delete-tag',
    'delete-link',
    'delete-meta',
    'delete-post',
    'trash-post',
    'untrash-post',
    'delete-page',
    'dim-comment',
    'add-link-category',
    'add-tag',
    'get-tagcloud',
    'get-comments',
    'replyto-comment',
    'edit-comment',
    'add-menu-item',
    'add-meta',
    'add-user',
    'closed-postboxes',
    'hidden-columns',
    'update-welcome-panel',
    'menu-get-metabox',
    'wp-link-ajax',
    'menu-locations-save',
    'menu-quick-search',
    'meta-box-order',
    'get-permalink',
    'sample-permalink',
    'inline-save',
    'inline-save-tax',
    'find_posts',
    'widgets-order',
    'save-widget',
    'delete-inactive-widgets',
    'set-post-thumbnail',
    'date_format',
    'time_format',
    'wp-remove-post-lock',
    'dismiss-wp-pointer',
    'upload-attachment',
    'get-attachment',
    'query-attachments',
    'save-attachment',
    'save-attachment-compat',
    'send-link-to-editor',
    'send-attachment-to-editor',
    'save-attachment-order',
    'media-create-image-subsizes',
    'heartbeat',
    'get-revision-diffs',
    'save-user-color-scheme',
    'update-widget',
    'query-themes',
    'parse-embed',
    'set-attachment-thumbnail',
    'parse-media-shortcode',
    'destroy-sessions',
    'install-plugin',
    'update-plugin',
    'crop-image',
    'generate-password',
    'save-wporg-username',
    'delete-plugin',
    'search-plugins',
    'search-install-plugins',
    'activate-plugin',
    'update-theme',
    'delete-theme',
    'install-theme',
    'get-post-thumbnail-html',
    'get-community-events',
    'edit-theme-plugin-file',
    'wp-privacy-export-personal-data',
    'wp-privacy-erase-personal-data',
    'health-check-site-status-result',
    'health-check-dotorg-communication',
    'health-check-is-in-debug-mode',
    'health-check-background-updates',
    'health-check-loopback-requests',
    'health-check-get-sizes',
    'toggle-auto-updates',
    'send-password-reset',
);

// Deprecated.
$core_actions_post_deprecated = array(
    'wp-fullscreen-save-post',
    'press-this-save-post',
    'press-this-add-category',
    'health-check-dotorg-communication',
    'health-check-is-in-debug-mode',
    'health-check-background-updates',
    'health-check-loopback-requests',
);
$core_actions_post = array_merge($core_actions_post, $core_actions_post_deprecated);

// Register core Ajax calls.
if (!empty($_GET['action']) && in_array($_GET['action'], $core_actions_get, true)) {
    add_action('wp_ajax_' . $_GET['action'], 'wp_ajax_' . str_replace('-', '_', $_GET['action']), 1);
}

if (!empty($_POST['action']) && in_array($_POST['action'], $core_actions_post, true)) {
    add_action('wp_ajax_' . $_POST['action'], 'wp_ajax_' . str_replace('-', '_', $_POST['action']), 1);
}

add_action('wp_ajax_nopriv_generate-password', 'wp_ajax_nopriv_generate_password');

add_action('wp_ajax_nopriv_heartbeat', 'wp_ajax_nopriv_heartbeat', 1);

add_action('wp_ajax_post_user_request', 'post_user_request');
add_action('wp_ajax_nopriv_post_user_request', 'post_user_request');

add_action('wp_ajax_post_registration_vendor', 'post_registration_vendor');
add_action('wp_ajax_nopriv_post_registration_vendor', 'post_registration_vendor');

add_action('wp_ajax_post_add_reply', 'post_add_reply');
add_action('wp_ajax_nopriv_post_add_reply', 'post_add_reply');

add_action('wp_ajax_filter_apparatus', 'filter_apparatus');
add_action('wp_ajax_nopriv_filter_apparatus', 'filter_apparatus');

add_action('wp_ajax_get_all_apparatus', 'get_all_apparatus');
add_action('wp_ajax_nopriv_get_all_apparatus', 'get_all_apparatus');

$action = $_REQUEST['action'];

if (is_user_logged_in()) {
    // If no action is registered, return a Bad Request response.
    if (!has_action("wp_ajax_{$action}")) {
        wp_die('0', 400);
    }

    /**
     * Fires authenticated Ajax actions for logged-in users.
     *
     * The dynamic portion of the hook name, `$action`, refers
     * to the name of the Ajax action callback being fired.
     *
     * @since 2.1.0
     */
    do_action("wp_ajax_{$action}");
} else {
    // If no action is registered, return a Bad Request response.
    if (!has_action("wp_ajax_nopriv_{$action}")) {
        wp_die('0', 400);
    }

    /**
     * Fires non-authenticated Ajax actions for logged-out users.
     *
     * The dynamic portion of the hook name, `$action`, refers
     * to the name of the Ajax action callback being fired.
     *
     * @since 2.8.0
     */
    do_action("wp_ajax_nopriv_{$action}");
}

function post_user_request()
{
    global $wpdb;
    $status = '';

    if (isset($_POST['data']) && !empty($_POST['data'])) {
        $wpdb->insert('wp_user_request_contact', ['phones' => $_POST['data']]);
        $status = 'ok';
    } else {
        $status = 'Не удалось принять вашу заявку!';
    }

    wp_die($status);
}

function post_registration_vendor()
{
    $uploaddir = '../files-manager/';

    if (!is_dir($uploaddir)) mkdir($uploaddir, 775);

    $files = $_FILES;
    $done_files = [];
    $status = '';

    foreach ($files as $file) {
        $file_name = $file['name'];

        if (move_uploaded_file($file['tmp_name'], "$uploaddir/$file_name")) {
            $done_files[] = realpath("$uploaddir/$file_name");
        }
    }

    $vendor_img = str_replace('\\', "/", $done_files[0]);

    $vendor_id = wp_insert_post([
        'post_type' => 'vendors',
        'post_title' => $_POST['name'],
        'post_content' => $_POST['desc']
    ]);
    $img_tag = '';
    if ($vendor_id) {
        $img_tag = media_sideload_image($vendor_img, $vendor_id, 'Логотип ' . $_POST['name']);
        $status = 'ok';
    } else {
        $status = 'error';
    }

    echo json_encode($status);

    wp_die();
}

function post_add_reply()
{
    $status = 'error';

    if ($_POST['data']) {
        $data = array(
            'comment_post_ID' => $_GET['post_id'],
            'comment_content' => $_POST['data']['text'],
            'comment_parent' => $_GET['comment_reply_id'],
            'comment_author' => $_POST['data']['name'],
            'comment_author_email' => $_POST['data']['email'],
        );

        $comment_id = wp_insert_comment($data);
        if (!is_wp_error($comment_id)) {
            $status = 'ok';
        }
    }

    wp_die(json_encode($status));
}

function filter_apparatus()
{
//    echo '<pre>';
//    print_r($_GET);
//    echo '</pre>';

    $min = '';
    $max = '';
    $vendor = '';
    $attributes = '';
    $type = '';

    $args = [
        'relation' => 'AND',
        [
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $_GET['category_id'],
        ]
    ];
    if (isset($_GET['min']) && !empty($_GET['min'])) {
        $min = $_GET['min'];
    } else {
        $min = 0;
    }

    if (isset($_GET['max']) && !empty($_GET['max'])) {
        $max = $_GET['max'];
    } else {
        $max = 99999999;
    }

    if (isset($_GET['vendor']) && !empty($_GET['vendor'])) {
        $vendor = $_GET['vendor'];
    } else {
        $vendor = '';
    }

    if (isset($_GET['attribute']) && !empty($_GET['attribute'])) {
        $attributes = explode(';', $_GET['attribute']);

        if (count($attributes) > 0) {
            foreach ($attributes as $attribute) {
                $args[] = [
                    'taxonomy' => 'pa_application-area',
                    'field' => 'slug',
                    'terms' => $attribute
                ];
            }
        }
    } else {
        $attributes = '';
    }

    if (isset($_GET['type']) && !empty($_GET['type'])) {
        $type = explode(';', $_GET['type']);

        if (count($type) > 0) {
            foreach ($type as $item) {
                $args[] = [
                    'taxonomy' => 'pa_apparatus-type',
                    'field' => 'slug',
                    'terms' => $item
                ];
            }
        }
    } else {
        $type = '';
    }

    $products = new WP_Query(array(
        'post_type' => 'product',
        'posts_per_page' => '9',
        'meta_key' => '_price',
        'order' => 'asc',
        'paged' => get_query_var('page'),
        'tax_query' => $args,
        'meta_query' => [
            [
                'key' => '_price',
                'value' => [$min, $max],
                'compare' => 'BETWEEN',
                'type' => 'DECIMAL(10,' . wc_get_price_decimals() . ')'
            ]
        ]
    ));

    foreach ($products->posts as $product) :
        $wc_product = wc_get_product($product->ID);
        $attributes = $wc_product->get_attributes();

        $rating = get_field('rating', get_the_ID());
        ?>
        <a href="<?= $wc_product->get_permalink() ?>" class="list__body_items_item card">
            <div class="card__img">
                <picture>
                    <source srcset="" type="image/webp">
                    <img
                            src="<?= wp_get_attachment_url($wc_product->get_image_id()); ?>"
                            alt="<?= $wc_product->get_title() ?>"
                    >
                </picture>
            </div>
            <div class="card__body">
                <div class="card__body_main">
                    <div class="name"><?= $wc_product->get_title() ?></div>
                    <div class="values">
                        <div class="values__price">
                            от <?php echo $wc_product->get_regular_price() . get_woocommerce_currency_symbol($currency = ''); ?>
                        </div>
                        <div class="values__cnt">
                            <?php if (!empty($rating) && is_product_category(47)): ?><span><?= $rating ?>/10</span><?php else: ?><span>0/10</span><?php endif; ?>
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
                    <ul class="list">
                        <?php
                        foreach ($attributes as $attribute_item):
                            foreach (wc_get_product_terms($wc_product->get_id(), $attribute_item->get_data()['name'], array('taxonomy' => 'sensor-frequencies')) as $value): ?>
                                <?php
                                if ($value->taxonomy === 'pa_application-area'):
                                    echo '<li class="list__item">— ' . $value->name . '</li>';
                                endif;

                                if ($value->taxonomy === 'pa_suitable-device' && is_product_category(48)) {
                                    echo '<li class="list__item">— ' . $value->name . '</li>';
                                }

                                ?>
                            <?php endforeach;
                        endforeach; ?>
                    </ul>
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
    $count = count($products->posts);
    echo "<input type='hidden' name='countProduct' value='$count'>";
    wp_die();
}

function get_all_apparatus()
{
    $products = new WP_Query(array(
        'post_type' => 'product',
        'posts_per_page' => '9',
        'orderby' => 'meta_value_num',
        'meta_key' => '_price',
        'order' => 'asc',
        'paged' => get_query_var('page'),
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $_GET['category_id'],
                'operator' => 'IN'
            ),
        )
    ));

    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            get_template_part('template-parts/category-product', 'card');
        }
    }

    wp_die();
}

// Default status.
wp_die('0');
