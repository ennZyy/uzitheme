<?php
$current_category = get_queried_object();
$category_product_count = '';
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
            'terms' => $current_category->term_id,
            'operator' => 'IN'
        ),
    )
));

$category_product_count = '';

if ($_GET['attribute']) {
    $filtered_products = new WP_Query(array(
        'post_type' => 'product',
        'posts_per_page' => '9',
        'order' => 'asc',
        'paged' => get_query_var('page'),
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => 47,
            ),
            array(
                'taxonomy' => 'pa_application-area',
                'field' => 'term_id',
                'terms' => $_GET['attribute']
            ),
        )
    ));
    $category_product_count = count($filtered_products->posts);
} else {
    $category_product_count = $current_category->count;
}

$price_range = true_category_price_range($current_category->slug);

$product_vendors = new WP_Query([
    'post_type' => 'vendors',
    'post_status' => 'publish'
]);

$application_area = get_terms('pa_application-area', [
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $current_category->term_id,
            'operator' => 'IN'
        ),
    ),
    'hide_empty' => false,
]);

//echo '<pre>';
//print_r($application_area);
//echo '</pre>';

$apparatus_type = get_terms('pa_apparatus-type', [
    'hide_empty' => false,
]);

get_header();
?>

    <main class="main">

        <div class="tbs">
            <div class="container">
                <div class="tbs__in swiper">
                    <div class="tbs__wrap swiper-wrapper">
                        <?php
                        wp_nav_menu([
                            'theme_location' => '',
                            'menu' => 'Sub menu',
                            'container' => '',
                            'menu_class' => 'tbs__wrap swiper-wrapper',
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <section class="list">

            <div class="container">

                <div class="list__in">

                    <aside class="filter">
                        <div class="filter__in">
                            <div class="filter__head">
                                <h1 class="filter__head_title">Фильтр</h1>

                                <button class="filter__head_btn">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect width="1.9206" height="19.206" rx="0.960302"
                                              transform="matrix(0.710018 0.704183 -0.710018 0.704183 13.6367 0)"
                                              fill="#2F2F2F"/>
                                        <rect width="1.9206" height="19.206" rx="0.960302"
                                              transform="matrix(0.710018 -0.704183 0.710018 0.704183 0 1.47559)"
                                              fill="#2F2F2F"/>
                                    </svg>

                                </button>
                            </div>
                            <div class="filter__list">
                                <input type="hidden" name="categoryID" value="<?= $current_category->term_id ?>">
                                <!-- Фильтр по цене -->
                                <div class="filter__item">
                                    <h3 class="filter__item_head">Цена ₽</h3>
                                    <div class="filter__item_inps">
                                        <div class="filter__item_inps_item">
                                            <label>От
                                                <input type="number" min="<?= $price_range['min'] ?>"
                                                       placeholder="<?= $price_range['min'] . ' ' . get_woocommerce_currency_symbol() ?>"
                                                       name="fprice">
                                            </label>
                                        </div>
                                        <div class="filter__item_inps_item">
                                            <label>До
                                                <input type="number" min="<?= $price_range['min'] ?>"
                                                       max="<?= $price_range['max'] ?>"
                                                       placeholder="<?= $price_range['max'] . ' ' . get_woocommerce_currency_symbol() ?>"
                                                       name="tprice">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Фильтр с чекбоксами и со скрытым контентом "Производители" -->
                                <div class="filter__item">
                                    <h3 class="filter__item_head">Производители</h3>
                                    <?php
                                    $block_class = '';
                                    for ($i = 0; $i < 2; $i++) :
                                        $block_class = match ($i) {
                                            0 => 'filter__item_body-show',
                                            1 => 'filter__item_body-hide',
                                        };
                                        ?>
                                        <div class="filter__item_body <?= $block_class ?>">
                                            <?php
                                            $vendors = '';
                                            if ($i == 0) {
                                                $vendors = array_slice($product_vendors->posts, 0, 4);
                                            } elseif ($i == 1) {
                                                $vendors = array_slice($product_vendors->posts, 4);
                                            }

                                            foreach ($vendors as $vendor):
                                                $vendor_product_count = count(get_vendor_product($vendor->ID, $current_category->term_id));
                                                ?>
                                                <div class="filter__item_body_item">
                                                    <input id="vendor-<?= $vendor->ID ?>" type="radio"
                                                           value="<?= $vendor->ID ?>" name='f1'>
                                                    <label for="vendor-<?= $vendor->ID ?>">
                                                        <div class="icon"></div>
                                                        <div class="text"><?= $vendor->post_title ?>
                                                            <span>(<?= $vendor_product_count ?>)</span></div>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endfor; ?>
                                    <div class="filter__item_btn">
                                        <button class="filterToggler">показать еще</button>
                                    </div>
                                </div>

                                <!-- Фильтр с чекбоксами и со скрытым контентом "Область применения" - готово -->
                                <div class="filter__item">
                                    <h3 class="filter__item_head">Область применения</h3>
                                    <?php
                                    $block_class = '';
                                    for ($i = 0; $i < 2; $i++) :
                                        $block_class = match ($i) {
                                            0 => 'filter__item_body-show',
                                            1 => 'filter__item_body-hide',
                                        };
                                        ?>
                                        <div class="filter__item_body <?= $block_class ?>">
                                            <?php
                                            $attributes = '';
                                            if ($i == 0) {
                                                $attributes = array_slice($application_area, 0, 4);
                                            } elseif ($i == 1) {
                                                $attributes = array_slice($application_area, 4);
                                            }
                                            foreach ($attributes as $attr):
                                                $products_attr = new WP_Query(array(
                                                    'post_type' => 'product',
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'product_cat',
                                                            'field' => 'term_id',
                                                            'terms' => $current_category->term_id,
                                                            'operator' => 'IN'
                                                        ),
                                                        array(
                                                            'taxonomy' => 'pa_application-area',
                                                            'field' => 'term_id',
                                                            'terms' => $attr->term_id
                                                        )
                                                    )
                                                ));

                                                $product_count = count($products_attr->posts);
                                                ?>
                                                <div class="filter__item_body_item">
                                                    <input id="attribute-<?= $attr->term_id ?>" <?php if ($_GET['attribute'] == $attr->term_id): ?> checked <?php endif; ?>
                                                           type="checkbox" name="f2" value="<?= $attr->slug ?>">
                                                    <label for="attribute-<?= $attr->term_id ?>">
                                                        <div class="icon"></div>
                                                        <div class="text"><?= $attr->name ?>
                                                            <span>(<?= $product_count ?>)</span></div>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endfor; ?>

                                    <div class="filter__item_btn">
                                        <button class="filterToggler">показать еще</button>
                                    </div>
                                </div>

                                <!-- Фильтр с чекбоксами "Тип аппарата" -->
                                <?php if (is_product_category(47)): ?>
                                    <div class="filter__item">
                                        <h3 class="filter__item_head">Тип аппарата</h3>
                                        <div class="filter__item_body filter__item_body-show">
                                            <?php foreach ($apparatus_type as $type):
                                                $products_attr = new WP_Query(array(
                                                    'post_type' => 'product',
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'product_cat',
                                                            'field' => 'term_id',
                                                            'terms' => $current_category->term_id,
                                                            'operator' => 'IN'
                                                        ),
                                                        array(
                                                            'taxonomy' => 'pa_apparatus-type',
                                                            'field' => 'term_id',
                                                            'terms' => $type->term_id
                                                        )
                                                    )
                                                ));

                                                $product_count = count($products_attr->posts);?>
                                                <div class="filter__item_body_item">
                                                    <input id="type-<?= $type->term_id ?>" type="checkbox" name="f3"
                                                           value="<?= $type->slug ?>">
                                                    <label for="type-<?= $type->term_id ?>">
                                                        <div class="icon"></div>
                                                        <div class="text"><?= $type->name ?> <span
                                                                    class="filter-">(<?= $product_count ?>)</span></div>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Информация о результатах -->
                                <div class="filter__item">
                                    <div class="filter__item_info">
                                        Показано результатов
                                        <span>(<?= $category_product_count ?>)</span>
                                    </div>
                                    <div class="filter__item-action">
                                        <a class="filter__item-reset">сбросить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>

                    <div class="list__body">

                        <!-- Breadcrumbs -->
                        <div class="bc">
                            <?php woocommerce_breadcrumb(
                                array(
                                    'delimiter' => '',
                                    'wrap_before' => '<div class="bc__list">',
                                    'wrap_after' => '</div>',
                                    'before' => '<li class="bc__item">',
                                    'after' => '</li>',
                                    'home' => _x('Home', 'breadcrumb', 'woocommerce'),
                                )
                            ); ?>
                        </div>

                        <div class="list__body_head">
                            <h2 class="list__body_head_title normal__title"><?= $current_category->name ?></h2>
                            <button class="list__body_head_btn">
                                Фильтр
                            </button>
                        </div>
                        <div class="list__body_items">
                            <?php
                            if ($_GET['attribute']) :
                                $products = new WP_Query(array(
                                    'post_type' => 'product',
                                    'posts_per_page' => '9',
                                    'order' => 'asc',
                                    'paged' => get_query_var('page'),
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'term_id',
                                            'terms' => 47,
                                        ),
                                        array(
                                            'taxonomy' => 'pa_application-area',
                                            'field' => 'term_id',
                                            'terms' => $_GET['attribute']
                                        ),
                                    )
                                ));
                            endif;
                            if ($products->have_posts()):
                                while ($products->have_posts()) :
                                    $products->the_post();
                                    get_template_part('template-parts/category-product', 'card');
                                    ?>
                                <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <div class="list__body_action">
                            <?php if ($products->max_num_pages > 1) : ?>
                                <script>
                                    var posts_vars = '<?php echo serialize($products->query_vars); ?>';
                                    var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                                    var max_pages = '<?php echo $products->max_num_pages; ?>';
                                </script>
                                <button id="loadmore">Показать ещё</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

<?php
get_footer();