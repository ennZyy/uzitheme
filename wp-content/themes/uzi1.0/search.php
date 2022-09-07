<?php

$query = get_search_query();
$sentence = $_GET['sentence'];
$search_types = explode(',', $_GET['post_type']);
$result_str = ' Поиск по фразе ' . '<span>“' . get_search_query() . '”</span>';
$posts = [];
foreach ( $search_types as $type ) {
    $res= new WP_Query(
        [
            'post_type' => $type,
            'order'     => 'DESC',
            's'         => $query,
            'sentence'  => $sentence
        ]
    );
    $posts[] = $res->posts;
}

if ( empty($posts[0]) && empty($posts[1]) ) {
    $result_str = ' Поиск по фразе ' . '<span>“' . get_search_query() . '” ничего не найдено</span>';
} else {
    $result_str = ' Поиск по фразе ' . '<span>“' . get_search_query() . '”';
}

get_header();
?>

    <main class="main">
        <section class="search">
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
                <div class="search__in">
                    <div class="search__head">
                        <?= $result_str ?>
                    </div>
                    <div class="search__list">

                        <?php foreach ( $search_types as $type ):
                            $posts = new WP_Query(
                                [
                                    'post_type' => $type,
                                    'order'     => 'DESC',
                                    's'         => $query,
                                    'sentence'  => $sentence
                                ]
                            );

                            foreach ( $posts->posts as $post ):
                                if ( $post->post_type == 'product' ):
                                    $product = wc_get_product($post->ID);
                                    $product_rating = get_field('rating', $post->ID);
                                    $product_attributes = $product->get_attributes();
                                    ?>
                                    <a href="<?= $product->get_permalink() ?>" class="search__list_item card">
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
                                                        от <?php echo $product->get_regular_price() . ' ' . get_woocommerce_currency_symbol( $currency = '' ); ?>
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
                                                <ul class="list">
                                                    <?php
                                                    foreach ( $product_attributes as $attribute_item ):
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
                                                <div class="action product-action-consultation">
                                                    <button>
                                                        Консультация в один клик
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php elseif ( $post->post_type == 'post' ) : ?>
                                    <a href="<?= get_permalink($post->ID) ?>" class="search__list_item art">
                                        <div class="art__img">
                                            <picture>
                                                <source srcset="" type="image/webp">
                                                <?= get_the_post_thumbnail($post->ID, 'post-thumbnail', ['alt' => $post->post_title]); ?>
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
                                endif;
                            endforeach;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();