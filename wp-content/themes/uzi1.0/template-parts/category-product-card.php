<?php
$product = wc_get_product();
?>
<a href="<?php the_permalink(); ?>" class="list__body_items_item card">
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
            <div class="name"><?= the_title(); ?></div>
            <div class="values">
                <?php if ($product->is_type( 'variable' )): ?>
                    <div class="values__price">
                        от <?php $price = $product->get_variation_price('min'); echo ($price > 30) ? explode('.', $price)[0] : '30' ?>
                    </div>
                <?php else: ?>
                    <div class="values__price">
                        от <?php echo $product->get_regular_price() . get_woocommerce_currency_symbol( $currency = '' ); ?>
                    </div>
                <?php endif; ?>
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
                $categories = get_the_terms( $product->get_id(), 'product_cat' );

                foreach ($categories as $category) : ?>
                    <li class="list__item">— <?= $category->name ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="action">
                <button>
                    Консультация в один клик
                </button>
            </div>
        </div>
    </div>

</a>