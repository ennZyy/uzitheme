<?php
/*
Template Name: Мой страницы производителя
Template Post Type: vendors
*/

global $post;

$vendor_information = get_field('information_about_vendor');
$vendor_sensors = get_field('vendor_sensor');

$vendor_products = get_vendor_product($post->ID);

//echo '<pre>';
//print_r($vendor_products);
//echo '</pre>';

get_header();
?>

    <main class="main">
        <section class="vendor">
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
                <div class="vendor__in">
                    <h2 class="vendor__head"><?= the_title() ?></h2>
                    <div class="vendor__body">
                        <div class="vendor__body_ps">
                            <div class="vendor__body_ps_img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= the_title() ?>">
                                </picture>
                            </div>
                            <div class="vendor__body_ps_descr">
                                <a href="tel:" class="link">
                                    <div class="link__name">Телефон: </div>
                                    <div class="link__value"><?= $vendor_information['vendor_phone'] ?></div>
                                </a>
                                <a href="mailto" class="link">
                                    <div class="link__name">Email: </div>
                                    <div class="link__value"><?= $vendor_information['vendor_email'] ?></div>
                                </a>
                                <a href="" class="link">
                                    <div class="link__name">Сайт: </div>
                                    <div class="link__value"><?= $vendor_information['vendor_web-site'] ?></div>
                                </a>
                                <div class="nolink">
                                    <div class="nolink__name">Адрес: </div>
                                    <div class="nolink__value"><?= $vendor_information['vendor_address'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="vendor__body_list">
                            <div class="vendor__body_list_item">
                                <h3 class="head">Вид деятельности:</h3>
                                <div class="text">
                                    <?= $vendor_information['kind-of-activity'] ?>

                                </div>
                            </div>
                            <div class="vendor__body_list_item">
                                <h3 class="head">Информация о компании:</h3>
                                <div class="text">
                                    <?= the_content() ?>
                                </div>
                            </div>

                            <div class="vendor__body_list_item">
                                <h3 class="head">Товары от этой компании</h3>
                                <?php
                                    $block_class = '';
                                    for ($i=0; $i < 2; $i++) :
                                        $block_class = match ($i) {
                                            0 => '',
                                            1 => 'vendor__list-hidden',
                                        };
                                ?>
                                <div class="list vendor__list <?= $block_class ?>">
                                    <?php
                                    $products = '';
                                    if ($i == 0){
                                        $products = array_slice($vendor_products, 0, 3);
                                    } elseif ($i == 1) {
                                        $products = array_slice($vendor_products, 3);
                                    }
                                    foreach ( $products as $product ):
                                        $vendor_product = wc_get_product($product->ID);
                                        $image = wp_get_attachment_image_url($vendor_product->get_image_id());
                                        $product_attributes = $vendor_product->get_attributes();?>
                                        <a href="<?= $vendor_product->get_permalink() ?>" class="list__item card">
                                            <div class="card__img">
                                                <picture>
                                                    <source srcset="" type="image/webp">
                                                    <img src="<?= $image ?>" alt="<?= $vendor_product->get_title() ?>">
                                                </picture>
                                            </div>
                                            <div class="card__body">
                                                <div class="card__body_main">
                                                    <div class="name"><?= $vendor_product->get_title() ?></div>
                                                    <div class="values">
                                                        <div class="values__price">
                                                            от <?= $vendor_product->get_price() ?> <?= get_woocommerce_currency_symbol() ?>
                                                        </div>
                                                        <div class="values__cnt">
                                                            <?php if ( !empty($product->rating) ): ?><span><?= $product->rating ?>/10</span><?php else: ?><span>0/10</span><?php endif; ?>
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
                                                            foreach (wc_get_product_terms( $vendor_product->get_id(), $attribute_item->get_data()['name'], array( 'taxonomy' =>  'sensor-frequencies' ) ) as $value): ?>
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
                                                    <div class="action">
                                                        <button>
                                                            Консультация в один клик
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <?php endfor; ?>

                                <div class="more">
                                    <button class="more__btn vendor__product-more">Показать еще</button>
                                </div>
                            </div>

                            <div class="vendor__body_list_item">
                                <h3 class="head">Датчики</h3>
                            <?php
                            $block_class = '';
                            for ($i=0; $i < 2; $i++) :
                                $block_class = match ($i) {
                                    0 => '',
                                    1 => 'sensor__list-hidden',
                                };
                                ?>
                                <div class="list sensor__list <?= $block_class ?>">
                                    <?php

                                    $sensors = '';
                                    if ($i == 0) {
                                        $sensors = array_slice($vendor_sensors, 0, 3);
                                    } elseif ($i == 1) {
                                        $sensors = array_slice($vendor_sensors, 3);
                                    }

                                    foreach ( $sensors as $sensor ):
                                        $sensor_product = wc_get_product($sensor->ID);
                                        $image = wp_get_attachment_image_url($sensor_product->get_image_id());
                                        $attributes = $sensor_product->get_attributes();
                                    ?>
                                    <a href="<?= $sensor_product->get_permalink() ?>" class="list__item card">
                                        <div class="card__img">
                                            <picture>
                                                <source srcset="" type="image/webp">
                                                <img src="<?= $image ?>" alt="<?= $sensor_product->get_title() ?>">
                                            </picture>
                                        </div>
                                        <div class="card__body">
                                            <div class="card__body_main">
                                                <div class="name"><?= $sensor_product->get_title() ?></div>
                                                <div class="values">
                                                    <div class="values__price">
                                                        от <?= $sensor_product->get_price() ?> <?= get_woocommerce_currency_symbol() ?>
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
                                                <?php if ( !empty($attributes) ): ?>
                                                <ul class="list">
                                                    <?php
                                                    foreach ( $attributes as $attribute_item ):
                                                        foreach (wc_get_product_terms( $sensor_product->get_id(), $attribute_item->get_data()['name'], array( 'taxonomy' =>  'sensor-frequencies' ) ) as $value): ?>
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
                                    <?php endforeach; ?>
                                </div>
                            <?php endfor; ?>
                                <div class="more">
                                    <button class="more__btn sensor__more">Показать еще</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
