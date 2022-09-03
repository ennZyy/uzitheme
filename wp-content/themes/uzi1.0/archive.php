<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BPSD
 */

$vendors_query =  new WP_Query(
    array(
        'post_type'=>'vendors',
        'post_status'=>'publish',
        'order' => 'DESC',
        'posts_per_page'=>'9'));

$vendors = $vendors_query->posts;

//echo '<pre>';
//print_r($vendors_query);
//echo '</pre>';

get_header();
?>

    <main class="main">
        <section class="vendors">
            <div class="container">
                <div class="bc">
                    <?php  woocommerce_breadcrumb(
                        array(
                            'delimiter'   => '',
                            'wrap_before' => '<div class="bc__list">',
                            'wrap_after'  => '</div>',
                            'before'      => '<li class="bc__item">',
                            'after'       => '</li>',
                            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
                        )
                    );?>
                </div>
                <div class="vendors__in">
                    <h1 class="vendors__head">
                        Производители
                    </h1>
                    <div class="vendors__list">
                        <?php foreach ( $vendors as $vendor ): ?>
                            <a href="<?= get_post_permalink($vendor->ID) ?>" class="vendors__item">
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
                        <?php endforeach; ?>
                    </div>
                    <?php if ($vendors_query->max_num_pages > 1) : ?>
                        <script>
                            var posts_vars = '<?php echo serialize($vendors_query->query_vars); ?>';
                            var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                            var max_pages = '<?php echo $vendors_query->max_num_pages; ?>';
                        </script>
                        <button id="vendor-loadmore">Показать ещё</button>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
