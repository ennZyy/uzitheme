<?php
$current_category = get_queried_object();
$per_page=9;
$products = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => $per_page,
    'orderby' => 'meta_value_num',
    'meta_key' => '_price',
    'order' => 'asc',
    'paged'=> get_query_var('page'),
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $current_category->term_id,
            'operator' => 'IN'
        ),
    )
));

get_header();
?>

    <main class="main">

        <div class="tbs">
            <div class="container">
                <div class="tbs__in swiper">
                    <div class="tbs__wrap swiper-wrapper">
                        <?php
                        wp_nav_menu( [
                            'theme_location'  => '',
                            'menu'            => 'Sub menu',
                            'container'       => '',
                            'menu_class'      => 'tbs__wrap swiper-wrapper',
                            'fallback_cb'     => 'wp_page_menu',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        ] );
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
                                <h2 class="filter__head_title">Фильтр</h2>
                                <button class="filter__head_btn">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="1.9206" height="19.206" rx="0.960302" transform="matrix(0.710018 0.704183 -0.710018 0.704183 13.6367 0)" fill="#2F2F2F"/>
                                        <rect width="1.9206" height="19.206" rx="0.960302" transform="matrix(0.710018 -0.704183 0.710018 0.704183 0 1.47559)" fill="#2F2F2F"/>
                                    </svg>

                                </button>
                            </div>
                            <div class="filter__list">
                                <?php get_sidebar(); ?>
                                <!-- Фильтр по цене -->
                                <div class="filter__item">
                                    <h3 class="filter__item_head">Цена ₽</h3>
                                    <div class="filter__item_inps">
                                        <div class="filter__item_inps_item">
                                            <label>От
                                                <input type="number" placeholder="220 000 ₽">
                                            </label>
                                        </div>
                                        <div class="filter__item_inps_item">
                                            <label>До
                                                <input type="number" placeholder="10 000 000 ₽">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Фильтр с чекбоксами и со скрытым контентом -->
                                <div class="filter__item">
                                    <h3 class="filter__item_head">Производители</h3>
                                    <div class="filter__item_body filter__item_body-show">

                                        <div class="filter__item_body_item">
                                            <input id="f1-1" type="radio" name='f1'>
                                            <label for="f1-1">
                                                <div class="icon"></div>
                                                <div class="text">Canon <span>(33)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f1-2" type="radio" name='f1'>
                                            <label for="f1-2">
                                                <div class="icon"></div>
                                                <div class="text">Toshiba <span>(54)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f1-3" type="radio" name='f1'>
                                            <label for="f1-3">
                                                <div class="icon"></div>
                                                <div class="text">Samsung Medicine <span>(5)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f1-4" type="radio" name='f1'>
                                            <label for="f1-4">
                                                <div class="icon"></div>
                                                <div class="text">Hitachi <span>(14)</span></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="filter__item_body filter__item_body-hide">
                                        <div class="filter__item_body_item">
                                            <input id="f1-5" type="radio" name='f1'>
                                            <label for="f1-5">
                                                <div class="icon"></div>
                                                <div class="text">Canon <span>(33)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f1-6" type="radio" name='f1'>
                                            <label for="f1-6">
                                                <div class="icon"></div>
                                                <div class="text">Toshiba <span>(54)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f1-7" type="radio" name='f1'>
                                            <label for="f1-7">
                                                <div class="icon"></div>
                                                <div class="text">Samsung Medicine <span>(5)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f1-8" type="radio" name='f1'>
                                            <label for="f1-8">
                                                <div class="icon"></div>
                                                <div class="text">Hitachi <span>(14)</span></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="filter__item_btn">
                                        <button class="filterToggler">показать еще</button>
                                    </div>
                                </div>

                                <!-- Фильтр с чекбоксами и со скрытым контентом -->
                                <div class="filter__item">
                                    <h3 class="filter__item_head">Область применения</h3>
                                    <div class="filter__item_body filter__item_body-show">
                                        <div class="filter__item_body_item">
                                            <input id="f2-1" type="checkbox" name="f2">
                                            <label for="f2-1">
                                                <div class="icon"></div>
                                                <div class="text">Для акушерства и гинекологии <span>(54)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f2-2" type="checkbox" name="f2">
                                            <label for="f2-2">
                                                <div class="icon"></div>
                                                <div class="text">Для сердца и сосудов <span>(33)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f2-3" type="checkbox" name="f2">
                                            <label for="f2-3">
                                                <div class="icon"></div>
                                                <div class="text">Универсальные <span>(14)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f2-4" type="checkbox" name="f2">
                                            <label for="f2-4">
                                                <div class="icon"></div>
                                                <div class="text">Для 3D/4D <span>(14)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f2-5" type="checkbox" name="f2">
                                            <label for="f2-5">
                                                <div class="icon"></div>
                                                <div class="text">Для детей <span>(14)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f2-6" type="checkbox" name="f2">
                                            <label for="f2-6">
                                                <div class="icon"></div>
                                                <div class="text">Для животных <span>(14)</span></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="filter__item_body filter__item_body-hide">
                                        <div class="filter__item_body_item">
                                            <input id="f2-7" type="checkbox" name="f2">
                                            <label for="f2-7">
                                                <div class="icon"></div>
                                                <div class="text">Для акушерства и гинекологии <span>(54)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f2-8" type="checkbox" name="f2">
                                            <label for="f2-8">
                                                <div class="icon"></div>
                                                <div class="text">Для сердца и сосудов <span>(33)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f2-9" type="checkbox" name="f2">
                                            <label for="f2-9">
                                                <div class="icon"></div>
                                                <div class="text">Универсальные <span>(14)</span></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="filter__item_btn">
                                        <button class="filterToggler">показать еще</button>
                                    </div>
                                </div>

                                <!-- Фильтр с чекбоксами -->
                                <div class="filter__item">
                                    <h3 class="filter__item_head">Тип аппарата</h3>
                                    <div class="filter__item_body filter__item_body-show">
                                        <div class="filter__item_body_item">
                                            <input id="f3-1" type="checkbox" name="f3">
                                            <label for="f3-1">
                                                <div class="icon"></div>
                                                <div class="text">Стационарный <span>(55)</span></div>
                                            </label>
                                        </div>
                                        <div class="filter__item_body_item">
                                            <input id="f3-2" type="checkbox" name="f3">
                                            <label for="f3-2">
                                                <div class="icon"></div>
                                                <div class="text">Портативный <span>(33)</span></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Информация о результатах -->
                                <div class="filter__item">
                                    <div class="filter__item_info">
                                        Показано результатов
                                        <span>(18)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>

                    <div class="list__body">

                        <!-- Breadcrumbs -->
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

                        <div class="list__body_head">
                            <h2 class="list__body_head_title normal__title"><?= $current_category->name ?></h2>
                            <button class="list__body_head_btn">
                                Фильтр
                            </button>
                        </div>
                        <div class="list__body_items">
                            <?php
                            $featured = new WP_Query(array(
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'ignore_sticky_posts' => 1,
                                'posts_per_page' => -1,
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'post__in' => wc_get_featured_product_ids()
                            ));
                            if($featured->have_posts()):
                                while ($featured->have_posts()) :
                                    $featured->the_post();
                                    get_template_part( 'template-parts/category-product', 'card');
                            ?>
                            <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <div class="list__body_action">
                            <button>Показать еще</button>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

<?php
get_footer();