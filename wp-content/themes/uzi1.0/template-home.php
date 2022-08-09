<?php
/* Template Name: Home page */
get_header();

global $post;

//Get admin settings
$category_settings = get_field('categories_settings');
$rating_settings = get_field('rating_settings');
$best_devices = get_field('devices_settings');
$manufacturer_settings = get_field('manufacturer_settings');
$articles_settings = get_field('articles_settings');
$policy_url = get_field('right_device_settings');
$apparatus_settings = get_field('apparatus_settings');
$about_us_settings = get_field('aboutus_settings');
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

        <section class="hero">
            <div class="container">
                <div class="hero__in">

                    <div class="hero__side">
                        <h3 class="hero__side_title section__title">
                            <span>категории</span>
                            УЗИ аппаратов
                        </h3>

                        <div class="hero__side_content">
                            <h4 class="hero__side_content_title"><?= $category_settings['sub_title'] ?></h4>
                            <ul class="hero__side_content_list">
                                <?php foreach ($category_settings['article'] as $category): ?>
                                    <li class="hero__side_content_item">
                                        <a href="<?= $category['url'] ?>"><?= $category['title'] ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="hero__body">
                        <div class="hero__body_wr">
                            <?php
                            $block_class = '';
                            for ($i=0; $i < 3; $i++) :
                                $block_class = match ($i) {
                                    0 => 'hero__body_col_left',
                                    1 => 'hero__body_col_mid',
                                    2 => 'hero__body_col_right',
                                };

                                ?>
                                <div class="hero__body_col <?= $block_class ?>">
                                    <?php
                                    $categories = '';
                                    if ($i == 0){
                                        $categories = array_slice($category_settings['categories'], 0, 3);
                                    } elseif ($i == 1) {
                                        $categories = array_slice($category_settings['categories'], 2, 3);
                                    } elseif ($i == 2) {
                                        $categories = array_slice($category_settings['categories'], 5, 3);
                                    }

                                    foreach ($categories as $category_id):
                                        $thumbnail_id = get_woocommerce_term_meta($category_id, 'thumbnail_id', true);
                                        $image = wp_get_attachment_url($thumbnail_id);
                                        $name = get_the_category_by_ID($category_id);
                                        $product_count = get_term( $category_id, 'product_cat' );
                                        ?>
                                        <a href="<?php echo get_category_link($category_id); ?>" class="item w-l" style="background-image: url('<?= $image ?>');">
                                            <div class="item__value"><?= $name ?> <span>(<?= $product_count->count ?>)</span></div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php
                            endfor;
                            ?>
                        </div>

                        <div class="hero__body_action">
                            <button>Показать еще</button>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="rates">
            <div class="container">
                <div class="rates__in">
                    <div class="rates__content">
                        <h2 class="rates__content_title section__title">
                            <?= $rating_settings['title'] ?>
                        </h2>
                        <ul class="rates__content_list">
                            <?php foreach ($rating_settings['articles'] as $article): ?>
                                <li class="rates__content_item">
                                    <a href="<?= $article['url'] ?>"><?= $article['title'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="rates__content_action">
                            <a href="<?php if ( empty($rating_settings['button_url']) ) { echo get_page_link(15);} else {echo $rating_settings['button_url'];}  ?>">
                                Перейти ко всем рейтингам
                            </a>
                        </div>
                    </div>
                    <div class="rates__img">
                        <div class="rates__img_body">
                            <div class="descr">
                                <?= $rating_settings['messager']['title'] ?>
                            </div>
                            <div class="ms">
                                <div class="ms__item l">
                                    <div class="ms__item_av" style="background-image: url('<?= $rating_settings['messager']['first_image']['url'] ?>');"></div>
                                    <div class="ms__item_value">
                                        <?= $rating_settings['messager']['first_comment'] ?>
                                    </div>
                                </div>
                                <div class="ms__item r">
                                    <div class="ms__item_av" style="background-image: url('<?= $rating_settings['messager']['second_image']['url'] ?>');"></div>
                                    <div class="ms__item_value">
                                        <?= $rating_settings['messager']['second_comment'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="best">
            <div class="container">
                <div class="best__in">
                    <div class="best__content">
                        <h2 class="best__content_title section__title">
                            <?= $best_devices['title'] ?>
                        </h2>
                        <div class="best__content_action">
                            <a href="#">Перейти ко всем аппаратам</a>
                        </div>
                    </div>
                    <div class="best__title section__title"><?= $best_devices['title'] ?></div>

                    <?php
                    $featured = new WP_Query(array(
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => 1,
                        'posts_per_page' => 3,
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'post__in' => wc_get_featured_product_ids()
                    ));
                    if ($featured->have_posts()) :
                        ?>
                        <div class="best__list">
                            <?php while ($featured->have_posts()):
                                $featured->the_post();
                                get_template_part('template-parts/product', 'card');
                            endwhile;?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="pop">
            <div class="container">
                <div class="pop__in">
                    <div class="pop__head">
                        <?php if ( isset($manufacturer_settings['title']) ): ?>
                            <h3 class="pop__head_title section__title">
                                <?= $manufacturer_settings['title'] ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( isset($manufacturer_settings['button']) ): ?>
                            <button class="pop__head_add">
                                <?= $manufacturer_settings['button'] ?>
                            </button>
                        <?php endif; ?>
                    </div>
                    <div class="pop__body">
                        <div class="pop__slider swiper">
                            <div class="pop__slider_wr swiper-wrapper">
                                <?php
                                $vendors = get_wcmp_vendors($manufacturer_settings['manufacturers']);

                                foreach ($vendors as $vendor) {
                                    $vendor_profile_image = get_user_meta($vendor->id, '_vendor_profile_image', true);
                                    if (isset($vendor_profile_image) && $vendor_profile_image > 0)
                                        $vendor_image = wp_get_attachment_url($vendor_profile_image);
                                    else
                                        $vendor_image = get_avatar_url($vendor->id, array('size' => 120));
                                    ?>
                                    <a href="<?= $vendor->get_permalink() ?>" class="pop__slider_sl swiper-slide">
                                        <div class="pop__slider_sl_img">
                                            <picture>
                                                <source srcset="" type="image/webp">
                                                <img src="<?= $vendor_image ?>" alt="<?= $vendor->page_title ?>">
                                            </picture>
                                        </div>
                                        <div class="pop__slider_sl_name"><?= $vendor->page_title ?></div>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                        <div class="pop__slider_prev pop__slider_nav">
                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.73123 16.4998C10.0794 16.8383 10.0847 17.3995 9.74304 17.7446C9.41239 18.0786 8.87856 18.0859 8.53907 17.7611L0.283686 9.86244C-0.0875199 9.50728 -0.0954982 8.91274 0.266042 8.54754C0.615963 8.19407 1.1816 8.18859 1.53817 8.53522L9.73123 16.4998Z" fill="white"/>
                                <path d="M8.53188 0.254442C8.86773 -0.0848123 9.41226 -0.0848122 9.74811 0.254442C10.084 0.593695 10.084 1.14373 9.74811 1.48299L1.84259 9.46854C1.50674 9.80779 0.962209 9.80779 0.626356 9.46854C0.290501 9.12928 0.290501 8.57924 0.626356 8.23999L8.53188 0.254442Z" fill="white"/>
                            </svg>

                        </div>
                        <div class="pop__slider_next pop__slider_nav">
                            <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.268772 1.50019C-0.079394 1.16174 -0.0847205 0.600522 0.256958 0.255384C0.587613 -0.0786183 1.12144 -0.0859278 1.46093 0.238899L9.71631 8.13756C10.0875 8.49272 10.0955 9.08726 9.73396 9.45246C9.38404 9.80593 8.8184 9.81141 8.46183 9.46478L0.268772 1.50019Z" fill="white"/>
                                <path d="M1.46812 17.7456C1.13227 18.0848 0.587744 18.0848 0.25189 17.7456C-0.0839634 17.4063 -0.0839634 16.8563 0.25189 16.517L8.15741 8.53146C8.49326 8.19221 9.03779 8.19221 9.37364 8.53146C9.7095 8.87072 9.7095 9.42076 9.37364 9.76001L1.46812 17.7456Z" fill="white"/>
                            </svg>

                        </div>
                        <div class="pop__slider_pag"></div>
                    </div>

                </div>
            </div>
        </section>

        <section class="qts">
            <div class="container">
                <div class="qts__in">
                    <h2 class="qts__title section__title">
                        <span>читайте</span>
                        Последние статьи
                    </h2>
                    <div class="qts__body">
                        <div class="qts__slider swiper">
                            <div class="qts__slider_wr swiper-wrapper">
                                <?php
                                $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1));
                                ?>

                                <?php if ( $wpb_all_query->have_posts() ) : ?>
                                    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
                                        <a href="<?php the_permalink() ?>" class="qts__slider_sl swiper-slide">
                                            <div class="img">
                                                <picture>
                                                    <source srcset="" type="image/webp">
                                                    <img src="<?= get_the_post_thumbnail($post->ID) ?>" alt="">
                                                </picture>
                                            </div>
                                            <div class="descr">
                                                <div class="descr__name">
                                                    <?php the_title(); ?>
                                                </div>
                                                <div class="descr__info">
                                                    <div class="descr__info_item descr__info_item-cmt">
                                                        (<?= get_comments_number($post->ID) ?>)
                                                    </div>
                                                    <div class="descr__info_item descr__info_item-sn">
                                                        (<?= get_post_views($post->ID) ?>)
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="feed">
            <div class="container">
                <div class="feed__in">
                    <form class="feed__body">
                        <h2 class="feed__body_title section__title">
                            <span>как правильно </span>
                            Выбрать аппарат
                        </h2>
                        <div class="feed__body_descr">
                            получите бесплатную
                            консультацию от наших специалистов
                        </div>
                        <input type="tel" id="telInput" class="feed__body_input" placeholder="+7 (ХХХ) ХХХ ХХ ХХ">
                        <button class="feed__body_btn">
                            Получить консультацию
                        </button>
                        <div class="feed__body_link">
                            при нажатии на кнопку вы соглашаетесь с <a href="
                            <?php
                            if(isset($policy_url['url'])){
                                echo $policy_url['url'];
                            }else{
                                echo get_page_link(3);
                            } ?>">политикой конфиденциальности</a>
                        </div>
                    </form>
                    <div class="feed__img">
                        <picture>
                            <source srcset="" type="image/webp">
                            <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/feed/feed-mob-mini-img.png" media="(max-width:650px)" type="image/webp">
                            <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/feed/feed-mob-img.png" media="(max-width:900px)" type="image/webp">

                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/feed/feed-img.png" alt="">
                        </picture>
                    </div>
                </div>
            </div>
        </section>

        <section class="apr">
            <div class="container">
                <div class="apr__in">
                    <h2 class="apr__title section__title"><?= $apparatus_settings['title'] ?></h2>
                    <div class="apr__list">
                        <?php
                        $featured = new WP_Query(array(
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'posts_per_page' => 8,
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'post__in' => wc_get_featured_product_ids()
                        ));
                        if ($featured->have_posts()) :
                            ?>
                            <div class="best__list">
                                <?php while ($featured->have_posts()):
                                    $featured->the_post();
                                    get_template_part('template-parts/second-product', 'card');
                                endwhile;?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="apr__action">
                        <button>Показать еще</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="revs">
            <div class="container">
                <div class="revs__in">
                    <h2 class="revs__head">
                        <span>что говорят</span>
                        О нашем сайте
                    </h2>
                    <div class="revs__body">
                        <div class="revs__body_slider swiper">
                            <div class="revs__body_slider_wr swiper-wrapper">
                                <?php foreach ($about_us_settings['reviews'] as $review): ?>
                                    <div class="revs__body_slider_sl swiper-slide">
                                        <div class="text">
                                            <?= $review['desc'] ?>
                                        </div>
                                        <div class="info">
                                            <div class="info__head"><?= $review['name'] ?></div>
                                            <div class="info__ex"><?= $review['sub_name'] ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="revs__body_thumbs_l">
                            <div class="revs__body_thumbs_nav revs__body_thumbs_nav_prev">
                                <svg width="13" height="25" viewBox="0 0 13 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6895 23.9503C13.1035 23.5378 13.1035 22.8689 12.6895 22.4563L2.50592 12.3074L12.3037 2.5431C12.7176 2.13053 12.7176 1.46163 12.3037 1.04906C11.8897 0.636492 11.2185 0.636494 10.8045 1.04906L0.310428 11.5074C-0.103552 11.9199 -0.103552 12.5888 0.310429 13.0014C0.355894 13.0467 0.404461 13.087 0.45545 13.1224C0.507053 13.2571 0.587332 13.3835 0.696282 13.4921L11.1904 23.9503C11.6043 24.3629 12.2755 24.3629 12.6895 23.9503Z" fill="#2F2F2F"/>
                                </svg>


                            </div>
                            <div class="revs__body_thumbs swiper">
                                <div class="revs__body_thumbs_wr swiper-wrapper">
                                    <?php foreach ($about_us_settings['reviews'] as $review): ?>
                                        <div class="revs__body_thumbs_sl swiper-slide">
                                            <picture>
                                                <source srcset="" type="image/webp">
                                                <img src=<?= $review['avatar']['url'] ?>>
                                            </picture>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="revs__body_thumbs_nav revs__body_thumbs_nav_next">
                                <svg width="13" height="25" viewBox="0 0 13 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.310485 1.04917C-0.103495 1.46174 -0.103495 2.13065 0.310485 2.54321L10.4941 12.6921L0.696279 22.4564C0.282299 22.869 0.282299 23.5379 0.696279 23.9505C1.11026 24.363 1.78145 24.363 2.19543 23.9505L12.6895 13.4922C13.1035 13.0796 13.1035 12.4107 12.6895 11.9981C12.6441 11.9528 12.5955 11.9125 12.5446 11.8772C12.493 11.7424 12.4127 11.6161 12.3037 11.5075L1.80964 1.04917C1.39566 0.636604 0.724465 0.636604 0.310485 1.04917Z" fill="#2F2F2F"/>
                                </svg>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();
