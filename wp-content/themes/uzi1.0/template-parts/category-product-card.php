<?php
$product = wc_get_product();
$attributes = $product->get_attributes();
$product_category = $product->get_category_ids();

$price = wc_price($product->get_regular_price(), [
    'price_format'       => '%2$s',
    'thousand_separator' => ' ',
    'decimal_separator'  => ' ',
    'decimals'           => 0
]);

$rating = get_field('rating', get_the_ID());
?>
<a href="<?php the_permalink(); ?>" class="list__body_items_item card" <?php if ( in_array(47, $product_category) ): ?> style="max-height: 200px; height: 100%;" <?php else: ?> style="max-height: 200px; height: 100%;" <?php endif; ?>>
    <div class="card__img">
        <picture>
            <source srcset="" type="image/webp">
            <img
                    src="<?= wp_get_attachment_url($product->get_image_id()); ?>"
                    alt="<?= the_title(); ?>"
            >
        </picture>
    </div>
    <div class="card__body">
        <div class="card__body_main">
            <div class="name" <?php if (strlen($product->get_title()) > 30): ?> style="line-height: 29px;" <?php endif; ?>><?= the_title(); ?></div>
            <div class="values">
                    <div class="values__price">
                        от <?= $price . get_woocommerce_currency_symbol(); ?>
                    </div>
                <?php if (!in_array(48, $product_category)): ?>
                    <div class="values__cnt">
                        <?php if (!empty($rating)): ?><span><?= $rating ?>/10</span><?php else: ?>
                            <span>0/10</span><?php endif; ?>
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
            <ul class="list">
                <?php
                if ( !in_array(48, $product_category) ):
                    foreach ($attributes as $attribute_item):
                        foreach (wc_get_product_terms($product->get_id(), $attribute_item->get_data()['name'], array('taxonomy' => 'sensor-frequencies')) as $value): ?>
                            <?php
                            if ($value->taxonomy === 'pa_application-area'):
                                echo '<li class="list__item">— ' . $value->name . '</li>';
                            endif;

                            if ($value->taxonomy === 'pa_suitable-device' && is_product_category(48)) {
                                echo '<li class="list__item">— ' . $value->name . '</li>';
                            }

                            ?>
                        <?php endforeach;
                    endforeach;
                else:
                    $first_app = array_slice($product->get_upsell_ids(), 0, 2);
                    foreach ( $first_app as $item ):
                        $similar = wc_get_product($item);
                    ?>
                        <li class="list__item">— <?= $similar->get_title() ?></li>
                <?php
                endforeach;
                endif;
                ?>
            </ul>
            <div class="action product-action-consultation">
                <button>
                    Консультация в один клик
                </button>
            </div>
        </div>
    </div>

</a>