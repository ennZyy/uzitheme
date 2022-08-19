<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BPSD
 */

$vendors_query = $wpb_all_query = new WP_Query(
    array(
        'post_type'=>'vendors',
        'post_status'=>'publish',
        'order' => 'DESC',
        'posts_per_page'=>'9'));

$vendors = $vendors_query->posts;

//echo '<pre>';
//print_r($vendors);
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
                    <h2 class="vendors__head">
                        Производители
                    </h2>
                    <div class="vendors__list">
                        <?php foreach ( $vendors as $vendor ): ?>
                            <div class="vendors__item">
                                <div class="vendors__item_img">
                                    <picture>
                                        <source srcset="" type="image/webp">
                                        <?= get_the_post_thumbnail($vendor->ID, '', ['alt' => $vendor->post_title]) ?>
                                    </picture>
                                </div>
                                <div class="vendors__item_body">
                                    <div class="vendors__item_body_name"><?= $vendor->post_title ?></div>
                                    <a href="<?= get_post_permalink($vendor->ID) ?>" class="vendors__item_body_link">подробнее</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
