<?php
$product = wc_get_product();
$product_attributes = $product->get_attributes();
$rating = get_field('rating', get_the_ID());

$price = wc_price($product->get_regular_price(), [
    'price_format'       => '%2$s',
    'thousand_separator' => ' ',
    'decimal_separator'  => ' ',
    'decimals'           => 0
]);
?>

<a href="<?php the_permalink(); ?>" class="apr__item card">
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
            <div class="name"
                <?php
                if (strlen($product->get_title()) > 55):?>
                    style="line-height: 29px;"
                <?php elseif (strlen($product->get_title()) > 20): ?>
                    style="line-height: 29px;" <?php endif; ?>
            >
                <?= the_title(); ?>
            </div>
            <div class="values">
                    <div class="values__price">
                        от <?= $price . get_woocommerce_currency_symbol(); ?>
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