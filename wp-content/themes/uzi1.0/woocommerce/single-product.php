<?php

$product = wc_get_product(get_the_ID());
$product_image = wp_get_attachment_url( $product->get_image_id());
$attachment_ids = $product->get_gallery_image_ids();
$category_ids = $product->get_category_ids();

foreach( $attachment_ids as &$attachment_id ) {
    $attachment_id = '"'.wp_get_attachment_image_url( $attachment_id, [520, 400], '$icon' ).'"';
}

$video_url = get_field('video_url');
$characteristics = get_field('characteristics');
$innovative_technologies = get_field('innovative_technologies');
$example = get_field('example');
$ratings = get_field('product_rating');

$comments_args = [
    'post_id'=>$product->get_id(),
    'orderby'=>'comment_parent',
    'order'=>'ASC',
];
$comments = get_comment_replies(0, $comments_args);

$sensor_products = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => 3,
    'orderby' => 'meta_value_num',
    'meta_key' => '_price',
    'order' => 'asc',
    'paged'=> get_query_var('page'),
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => 48,
            'operator' => 'IN'
        ),
    )
));

$review_total = $product->get_review_count();

$product_attributes = $product->get_attributes();

$rating = get_field('rating');

$vendor = get_field('product_vendor');

get_header();
?>

<main class="main">
    <?php if ( in_array(47, $category_ids) ): ?>
    <section class="prod">
        <div class="container">
            <div class="prod__in">
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
                <div class="prod__main">

                    <div class="prod__main_name">
                        <?= the_title() ?>
                    </div>

                    <div class="prod__main_content">
                        <div class="prod__main_thumbs swiper">
                            <div class="prod__main_thumbs_wr swiper-wrapper">
                                <div class="prod__main_thumbs_sl swiper-slide">
                                    <picture>
                                        <source srcset="" type="image/webp">
                                        <img
                                                src=<?= $product_image ?>
                                                alt="<?= the_title() ?>"
                                        >
                                    </picture>
                                </div>
                                <?php if ($attachment_ids): ?>
                                <?php foreach ($attachment_ids as $attachment_id): ?>
                                    <div class="prod__main_thumbs_sl swiper-slide">
                                        <picture>
                                            <source srcset="" type="image/webp">
                                            <img
                                                    src=<?= $attachment_id ?>
                                                    alt="<?= the_title() ?>"
                                            >
                                        </picture>
                                    </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div class="prod__main_thumbs_prev">
                                <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.50019 9.73123C1.16174 10.0794 0.600522 10.0847 0.255384 9.74304C-0.0786183 9.41239 -0.0859278 8.87856 0.238899 8.53907L8.13756 0.283686C8.49272 -0.0875205 9.08726 -0.0954989 9.45246 0.266041C9.80593 0.615962 9.81141 1.1816 9.46478 1.53817L1.50019 9.73123Z" fill="#2F2F2F"/>
                                    <path d="M17.7456 8.53188C18.0848 8.86773 18.0848 9.41226 17.7456 9.74811C17.4063 10.084 16.8563 10.084 16.517 9.74811L8.53146 1.84259C8.19221 1.50674 8.19221 0.962209 8.53146 0.626355C8.87072 0.290501 9.42076 0.290501 9.76001 0.626355L17.7456 8.53188Z" fill="#2F2F2F"/>
                                </svg>

                            </div>
                            <div class="prod__main_thumbs_next">
                                <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.4998 0.268772C16.8383 -0.0793941 17.3995 -0.0847205 17.7446 0.256958C18.0786 0.587613 18.0859 1.12144 17.7611 1.46093L9.86244 9.71631C9.50728 10.0875 8.91274 10.0955 8.54754 9.73396C8.19407 9.38404 8.18859 8.8184 8.53522 8.46183L16.4998 0.268772Z" fill="#2F2F2F"/>
                                    <path d="M0.254442 1.46812C-0.0848122 1.13227 -0.0848122 0.587743 0.254442 0.25189C0.593695 -0.0839642 1.14373 -0.0839641 1.48299 0.25189L9.46854 8.15741C9.80779 8.49326 9.80779 9.03779 9.46854 9.37364C9.12928 9.7095 8.57924 9.7095 8.23999 9.37364L0.254442 1.46812Z" fill="#2F2F2F"/>
                                </svg>

                            </div>
                        </div>
                        <div class="prod__main_slider swiper">
                                <div class="prod__main_thumbs_wr swiper-wrapper">
                                    <div class="prod__main_thumbs_sl swiper-slide">
                                        <picture>
                                            <source srcset="" type="image/webp">
                                            <img
                                                    src=<?= $product_image ?>
                                                    alt="<?= the_title() ?>"
                                            >
                                        </picture>
                                    </div>
                                    <?php if ($attachment_ids): ?>
                                    <?php foreach ($attachment_ids as $attachment_id): ?>
                                        <div class="prod__main_thumbs_sl swiper-slide">
                                            <picture>
                                                <source srcset="" type="image/webp">
                                                <img
                                                        src=<?= $attachment_id ?>
                                                        alt="<?= the_title() ?>"
                                                >
                                            </picture>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                        </div>
                        <div class="prod__main_descr">
                            <div class="prod__main_descr_part">
                                <div class="head">Цена <?= get_woocommerce_currency_symbol(); ?></div>
                                <div class="value">
                                    от <?= $product->get_price() ?> <?php if ( !empty($rating) ): ?><span><?= $rating ?>/10</span><?php else: ?><span>0/10</span><?php endif; ?>
                                </div>
                                <div class="ex">*точную цену узнайте на консультации</div>
                            </div>
                            <div class="prod__main_descr_part">
                                <div class="head">В категориях:</div>
                                <div class="list">
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
                                </div>
                            </div>
                            <div class="prod__main_descr_part">
                                <div class="head">Характеристики</div>
                                <div class="list">
                                    <div class="list__item">Производитель: <?php if ( $vendor ) { $vendor->post_title; } else {echo 'Производитель не указан';} ?></div>
                                    <?php
                                    foreach ( $product_attributes as $attribute_item ):
                                        foreach (wc_get_product_terms( get_the_ID(), $attribute_item->get_data()['name'], array( 'taxonomy' =>  'sensor-frequencies' ) ) as $value): ?>
                                            <?php
                                                if ( $value->taxonomy === 'pa_country-of-origin' && in_array(47, $category_ids ) ) {
                                                    echo '<div class="list__item">Страна производства: '. $value->name .'</div>';
                                                } elseif ( $value->taxonomy === 'pa_year-of-issue' && in_array(47, $category_ids) ) {
                                                    echo '<div class="list__item">Год выпуска: '. $value->name .'</div>';
                                                } elseif ( $value->taxonomy === 'pa_guarantee' && in_array(47, $category_ids) ) {
                                                    echo '<div class="list__item">Гарантия: '. $value->name .'</div>';
                                                }
                                            ?>
                                        <?php endforeach;
                                    endforeach; ?>
                                </div>
                            </div>
                            <div class="prod__main_descr_action">
                                <button class="prod__main_descr_action_btn">Консультация перед покупкой</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="feed">
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
                                    при нажатии на кнопку вы соглашаетесь с <a href="#">политикой конфиденциальности</a>
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
                </div>

                <div class="prod__tabs">
                    <a href="#descripton" class="prod__tabs_item">Описание</a>
                    <a href="#innovation" class="prod__tabs_item">Инновационные технологии</a>
                    <a href="#characteristics" class="prod__tabs_item">Характеристики</a>
                    <a href="#sensors" class="prod__tabs_item">Датчики</a>
                    <a href="#examples" class="prod__tabs_item">Примеры эхограмм</a>
                </div>

                <div class="prod__descr">

                    <div class="prod__descr_item active" id="descripton">
                        <div class="prod__descr_item_head">
                            <h3 class="prod__descr_item_head_title">Описание</h3>
                            <button class="prod__descr_item_head_btn">Скрыть</button>
                        </div>
                        <?php if ( !empty(the_content()) ): ?>
                        <div class="prod__descr_item_body">
                            <div class="text">
                                <?= the_content() ?>
                            </div>

                            <div class="video">
                                <iframe width="1097" height="617" src="<?= $video_url ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="prod__descr_item active" id="characteristics">
                        <div class="prod__descr_item_head">
                            <h3 class="prod__descr_item_head_title">Характеристики</h3>
                            <button class="prod__descr_item_head_btn">Скрыть</button>
                        </div>
                        <?php if ( !empty($characteristics) ): ?>
                        <div class="prod__descr_item_body">
                            <div class="char">
                                <div class="char__list">
                                    <?php
                                    if ( !empty($characteristics) ):
                                        foreach ($characteristics as $item): ?>
                                            <div class="char__list_item">
                                                <div class="name"><?= $item['title'] ?></div>
                                                <div class="value"><?= $item['value'] ?></div>
                                            </div>
                                        <?php endforeach;
                                    endif;
                                     ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if ( !empty($innovative_technologies) ): ?>
                    <div class="prod__descr_item active" id="innovation">
                        <div class="prod__descr_item_head">
                            <h3 class="prod__descr_item_head_title">Инновационные технологии</h3>
                            <button class="prod__descr_item_head_btn">Скрыть</button>
                        </div>
                        <div class="prod__descr_item_body">
                            <div class="ex">
                                <div class="ex__list">
                                    <?php foreach ( $innovative_technologies as $item ): ?>
                                    <div class="ex__list_item">
                                        <span><?= $item['title'] ?></span> – <?= $item['text'] ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="prod__descr_item active" id="sensors">
                        <div class="prod__descr_item_head">
                            <h3 class="prod__descr_item_head_title">Датчики</h3>
                            <button class="prod__descr_item_head_btn">Скрыть</button>
                        </div>
                        <div class="prod__descr_item_body">
                            <div class="sensors">
                                <div class="sensors__text">
                                    Конвекстные
                                </div>

                                <div class="sensors__list">
                                    <div class="sensors__list-show">
                                        <?php
                                            foreach ( $sensor_products->posts as $item ):
                                                $sensor_product = wc_get_product($item->ID);
                                                $image = wp_get_attachment_image_url($sensor_product->get_image_id());
                                                $attributes = $sensor_product->get_attributes();
                                        ?>
                                            <div class="sensors__list_item">
                                            <div class="img">
                                                <picture>
                                                    <source srcset="" type="image/webp">
                                                    <img src="<?= $image ?>" alt="<?= $item->post_title ?>">
                                                </picture>
                                            </div>
                                            <div class="body">
                                                <a href="<?= $item->guid ?>" class="body__name">
                                                    <?= $item->post_title ?>
                                                </a>
                                                <?php if ( !empty($attributes) ): ?>
                                                    <div class="body__info">
                                                        <?php
                                                        foreach ( $attributes as $attribute_item ):
                                                        foreach (wc_get_product_terms( $item->ID, $attribute_item->get_data()['name'], array( 'taxonomy' =>  'sensor-frequencies' ) ) as $value): ?>
                                                            <?php
                                                                if ( $value->taxonomy === 'pa_sensor-frequencies' ) {
                                                                    echo $value->name;
                                                                }
                                                            ?>
                                                        <?php endforeach;
                                                        endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="body__info">
                                                    <?= $item->post_excerpt ?>
                                                </div>
                                                <div class="body__info">
                                                    от <?= $sensor_product->get_price() ?> <?= get_woocommerce_currency_symbol() ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            endforeach;
                                        ?>
                                    </div>
                                    <!-- <a href="#" class="sensors__action">
                                        Показать все датчики
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="prod__descr_item active" id="examples">
                        <div class="prod__descr_item_head">
                            <div class="prod__descr_item_head_title">Примеры эхограмм <span><?= the_title() ?></span></div>
                            <button class="prod__descr_item_head_btn">Скрыть</button>
                        </div>
                        <?php if ( !empty($example) ): ?>
                        <div class="prod__descr_item_body">
                            <div class="examples">
                                <div class="examples__slider swiper">
                                    <div class="examples__slider_wr swiper-wrapper">
                                        <?php foreach ( $example as $item ): ?>
                                        <a data-fancybox="gallery" href="<?= $item['image'] ?>" class="examples__slider_sl swiper-slide">
                                            <picture>
                                                <source srcset="" type="imgae/webp">
                                                <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
                                            </picture>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="examples__slider_prev">
                                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.73123 16.4998C10.0794 16.8383 10.0847 17.3995 9.74304 17.7446C9.41239 18.0786 8.87856 18.0859 8.53907 17.7611L0.283686 9.86244C-0.0875199 9.50728 -0.0954982 8.91274 0.266042 8.54754C0.615963 8.19407 1.1816 8.18859 1.53817 8.53522L9.73123 16.4998Z" fill="white"/>
                                            <path d="M8.53188 0.254442C8.86773 -0.0848123 9.41226 -0.0848122 9.74811 0.254442C10.084 0.593695 10.084 1.14373 9.74811 1.48299L1.84259 9.46854C1.50674 9.80779 0.962209 9.80779 0.626356 9.46854C0.290501 9.12928 0.290501 8.57924 0.626356 8.23999L8.53188 0.254442Z" fill="white"/>
                                        </svg>

                                    </div>
                                    <div class="examples__slider_next">
                                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.268772 1.50019C-0.079394 1.16174 -0.0847205 0.600522 0.256958 0.255384C0.587613 -0.0786183 1.12144 -0.0859278 1.46093 0.238899L9.71631 8.13756C10.0875 8.49272 10.0955 9.08726 9.73396 9.45246C9.38404 9.80593 8.8184 9.81141 8.46183 9.46478L0.268772 1.50019Z" fill="white"/>
                                            <path d="M1.46812 17.7456C1.13227 18.0848 0.587744 18.0848 0.25189 17.7456C-0.0839634 17.4063 -0.0839634 16.8563 0.25189 16.517L8.15741 8.53146C8.49326 8.19221 9.03779 8.19221 9.37364 8.53146C9.7095 8.87072 9.7095 9.42076 9.37364 9.76001L1.46812 17.7456Z" fill="white"/>
                                        </svg>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if ( !empty($product->get_upsell_ids()) ): ?>
                    <div class="prod__sml">
                        <div class="prod__sml_head">
                            Похожие товары
                        </div>
                        <div class="prod__sml_list">
                            <?php foreach ( $product->get_upsell_ids() as $id ):
                                $similar = wc_get_product($id);
                                $rating = get_field('rating', $id);
                            ?>
                            <a href="<?= $similar->get_permalink() ?>" class="prod__sml_list_item card">
                                <div class="card__img">
                                    <picture>
                                        <source srcset="" type="image/webp">
                                        <?= $similar->get_image() ?>
                                    </picture>
                                </div>
                                <div class="card__body">
                                    <div class="card__body_main">
                                        <div class="name"><?= $similar->get_title() ?></div>
                                        <div class="values">
                                            <div class="values__price">
                                                от <?= $similar->get_price() ?> <?= get_woocommerce_currency_symbol() ?>
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
                                            $attributes = $similar->get_attributes();
                                            foreach ( $attributes as $attribute_item ):
                                                foreach (wc_get_product_terms( $similar->get_id(), $attribute_item->get_data()['name'], array( 'taxonomy' =>  'sensor-frequencies' ) ) as $value): ?>
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
                    </div>
                    <?php endif; ?>

                    <?php if ( !empty($ratings) ): ?>
                    <div class="prod__rates">
                        <div class="prod__rates_head">
                            Читайте рейтинги
                        </div>
                        <div class="prod__rates_list">
                            <?php foreach ($ratings as $item): ?>
                                <a href="<?= $item['url'] ?>" class="prod__rates_list_item"><?= $item['title'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="prod__comment">
                        <div class="prod__comment_head">
                            Написать комментарий
                        </div>

                        <div class="prod__comment_body">
                            <form class="prod__review-form">
                                <div class="prod__comment_body_inp">
                                    <input type="text" placeholder="Имя" name="name" required>
                                </div>
                                <div class="prod__comment_body_inp">
                                    <input type="email" placeholder="Email" name="email" required>
                                    <div class="prod__comment_body_inp_ex">*Email будет скрыт </div>
                                </div>
                                <div class="prod__comment_body_text">
                                    <textarea placeholder="Комментарий..." name="text" required></textarea>
                                </div>
                                <div class="prod__comment_body_action">
                                    <button class="prod__comment_body_action_btn">Отправить</button>
                                </div>
                                <input type="hidden" name="product_id" value="<?php the_id(); ?>">
                            </form>
                        </div>

                        <?php

//                        echo '<pre>';
//                        print_r($comments);
//                        echo '</pre>';

                        ?>

                        <?php if ( !empty($comments) ): ?>
                            <div class="prod__comment_list">
                            <div class="prod__comment_list_head">
                                Комментарии <span>(<?= $review_total ?>)</span>
                            </div>
                            <?php foreach( $comments as $comment ) :
                                if (empty($comment->comment_parent) && $comment->comment_approved == 1) :
                                    $comment_meta=get_comment_meta($comment->comment_ID);

                                    $user_name= $comment->comment_author;
                                    ?>
                                    <div class="prod__comment_list_item">
                                        <div class="text">
                                            <?= $comment->comment_content ?>
                                        </div>
                                        <div class="action">
                                            <div class="action__name"><?= $user_name ?></div>
                                            <div class="action__date"><?= date('d.m.Y', strtotime($comment->comment_date)) ?></div>
                                            <button class="action__btn comment-answer-btn" data-comment="<?= $comment->comment_ID ?>">Ответить</button>
                                        </div>
                                    </div>

                                <?php if ( !empty($comment->replies) ): ?>
                                    <?php foreach ( $comment->replies as $answer ):
                                        $answer_name= $answer->comment_author;
                                        ?>
                                    <div class="prod__comment_list_item answer">
                                        <div class="text">
                                            <?= $answer->comment_content ?>
                                        </div>
                                        <div class="action">
                                            <div class="action__name"><?= $answer_name ?></div>
                                            <div class="action__date"><?= date('d.m.Y', strtotime($answer->comment_date)) ?></div>
                                            <button class="action__btn comment-answer-btn" data-comment="<?= $comment->comment_ID ?>">Ответить</button>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif;
                            endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php elseif ( in_array(48,$category_ids ) ): ?>
        <section class="sensor">

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
                <div class="sensor__in">

                    <div class="sensor__main">
                        <h2 class="sensor__main_head"><?= the_title() ?></h2>
                        <div class="sensor__main_body">
                            <div class="sensor__main_body_img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="<?= $product_image ?>" alt="<?= the_title() ?>">
                                </picture>
                            </div>
                            <div class="sensor__main_body_content">
                                <div class="sensor__main_body_content_part">
                                    <div class="head">Цена ₽</div>
                                    <div class="price">от <?= $product->get_price() ?></div>
                                    <div class="ex">*точную цену узнайте на консультации</div>
                                </div>
                                <div class="sensor__main_body_content_part">
                                    <div class="head">Описание</div>
                                    <div class="list">
                                        <?php
                                        foreach ( $product_attributes as $attribute_item ):
                                            foreach (wc_get_product_terms( $product->get_id(), $attribute_item->get_data()['name'], array( 'taxonomy' =>  'sensor-frequencies' ) ) as $value): ?>
                                                <?php
                                                if ( $value->taxonomy === 'pa_sensor-frequencies' ):
                                                    echo '<div class="list__item">Диапазон частот ' . $value->name . '</div>';
                                                endif;

                                                if ( $value->taxonomy === 'pa_center-frequencies' ) {
                                                    echo '<div class="list__item">Центральная частота' . $value->name . '</div>';
                                                }

                                                if ( $value->taxonomy === 'pa_aperture' ) {
                                                    echo '<div class="list__item">Апертура' . $value->name . '</div>';
                                                }
                                                ?>
                                            <?php endforeach;
                                        endforeach; ?>
                                    </div>
                                </div>
                                <div class="sensor__main_body_content_part">
                                    <div class="head">Аппараты к которым подходит</div>
                                    <?php
                                        $first_part = array_slice($product->get_upsell_ids(), 0, 2);
                                        $second_part = array_slice($product->get_upsell_ids(), 2)
                                    ?>
                                    <div class="list">
                                        <?php foreach ( $first_part as $id ):
                                            $similar = wc_get_product($id);
                                        ?>
                                            <a href="<?= $similar->get_permalink() ?>" class="list__item"><?= $similar->get_title() ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="list list-hidden">
                                        <?php foreach ( $second_part as $id ):
                                            $similar = wc_get_product($id);
                                        ?>
                                            <a href="<?= $similar->get_permalink() ?>" class="list__item"><?= $similar->get_title() ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="list__action sensor-list-drop-trigger">
                                        Показать все
                                    </button>
                                </div>
                                <div class="sensor__main_body_content_part">
                                    <button class="button">
                                        Консультация перед покупкой
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sensor__descr">
                        <h3 class="sensor__descr_head">Описание</h3>
                        <?php if ( !empty(the_content()) ): ?>
                        <div class="sensor__descr_text">
                            <?= the_content() ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
</main>

<?php
get_footer();