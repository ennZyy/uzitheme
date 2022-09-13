<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BPSD
 */

global $post;

$ratings = get_field('rating_settings');
$comments_args = [
    'post_id'=>$post->ID,
    'orderby'=>'comment_parent',
    'order'=>'ASC',
];
$comments = get_comment_replies(0, $comments_args);
$review_total = count($comments);

get_header();

//echo $post->post_type;

if ( $post->post_type == 'post' ):
?>

    <main class="main">
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
                    <div class="rtg">
                        <div class="container">
                            <div class="rtg__in">
                                <h1 class="rtg__title section__title"><?= $post->post_title ?></h1>
                                <div class="rtg__body">
                                    <picture>
                                        <source srcset="" type="image/webp">
                                        <img src="<?= the_post_thumbnail_url([1080, 608]); ?>" alt="<?= $post->post_title ?>">
                                    </picture>
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
                                        консультацию от&nbsp;наших специалистов
                                    </div>
                                    <input type="tel" id="telInput" class="feed__body_input" placeholder="+7 (495) 555-55-55">
                                    <button class="feed__body_btn">
                                        Получить консультацию
                                    </button>
                                    <div class="feed__body_link">
                                        при нажатии на кнопку вы соглашаетесь с&nbsp;<a href="#">политикой конфиденциальности</a>
                                    </div>
                                </form>
                                <div class="feed__img">
                                    <picture>
                                        <source srcset="" type="image/webp">
                                        <source srcset=".<?php echo get_template_directory_uri() ?>/assets/img/feed/feed-mob-mini-img.png" media="(max-width:650px)" type="image/webp">
                                        <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/feed/feed-mob-img.png" media="(max-width:900px)" type="image/webp">

                                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/feed/feed-img.png" alt="">
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="prod__descr">
                        <?= the_content() ?>

                        <div class="prod__rates">
                            <div class="prod__rates_head">
                                Читайте другие статьи
                            </div>
                            <div class="prod__rates_list">
                                <?php foreach ($ratings as $rating): ?>
                                    <a href="<?= $rating['url'] ?>" class="prod__rates_list_item"><?= $rating['name'] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>

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
    </main>

<?php
else:
    $vendor_desc = get_the_content();
    $vendor_information = get_field('information_about_vendor');
    $vendor_sensors = get_field('vendor_sensor');

    $vendor_products = get_vendor_product($post->ID);

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
                                <?php if ( $vendor_information['vendor_phone'] ): ?>
                                    <a href="tel:" class="link">
                                        <div class="link__name">Телефон: </div>
                                        <div class="link__value"><?= $vendor_information['vendor_phone'] ?></div>
                                    </a>
                                <?php endif; ?>

                                <?php if ( $vendor_information['vendor_email'] ): ?>
                                    <a href="mailto" class="link">
                                        <div class="link__name">Email: </div>
                                        <div class="link__value"><?= $vendor_information['vendor_email'] ?></div>
                                    </a>
                                <?php endif; ?>

                                <?php if ( $vendor_information['vendor_web-site'] ): ?>
                                    <a href="" class="link">
                                        <div class="link__name">Сайт: </div>
                                        <div class="link__value"><?= $vendor_information['vendor_web-site'] ?></div>
                                    </a>
                                <?php endif; ?>

                                <?php if ( $vendor_information['vendor_address'] ): ?>
                                    <div class="nolink">
                                        <div class="nolink__name">Адрес: </div>
                                        <div class="nolink__value"><?= $vendor_information['vendor_address'] ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="vendor__body_list">
                            <?php if ( $vendor_information['kind-of-activity'] ): ?>
                                <div class="vendor__body_list_item">
                                    <h3 class="head">Вид деятельности:</h3>
                                    <div class="text">
                                        <?= $vendor_information['kind-of-activity'] ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ( $vendor_desc ): ?>
                                <div class="vendor__body_list_item">
                                    <h3 class="head">Информация о компании:</h3>
                                    <div class="text">
                                        <?= $vendor_desc ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ( $vendor_products ): ?>
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
                                                $products = array_slice($vendor_products, 3, 99999);
                                            }
                                            foreach ( $products as $product ):
                                                $vendor_product = wc_get_product($product->ID);
                                                $image = wp_get_attachment_image_url($vendor_product->get_image_id());
                                                $product_attributes = $vendor_product->get_attributes();
                                                $price = wc_price($vendor_product->get_price(), [
                                                    'price_format'       => '%2$s',
                                                    'thousand_separator' => ' ',
                                                    'decimal_separator'  => ' ',
                                                    'decimals'           => 0
                                                ]);?>
                                                <a href="<?= $vendor_product->get_permalink() ?>" class="list__item card">
                                                    <div class="card__img">
                                                        <picture>
                                                            <source srcset="" type="image/webp">
                                                            <img src="<?= $image ?>" alt="<?= $vendor_product->get_title() ?>">
                                                        </picture>
                                                    </div>
                                                    <div class="card__body">
                                                        <div class="card__body_main">
                                                            <div class="name"
                                                                <?php
                                                                if (strlen($vendor_product->get_title()) > 55):?>
                                                                    style="line-height: 29px;"
                                                                <?php elseif (strlen($vendor_product->get_title()) > 20): ?>
                                                                    style="line-height: 29px;" <?php endif; ?>
                                                            >
                                                                <?= $vendor_product->get_title() ?>
                                                            </div>
                                                            <div class="values">
                                                                <div class="values__price">
                                                                    от <?= $price ?> <?= get_woocommerce_currency_symbol() ?>
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
                                                            <div class="action product-action-consultation">
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

                                    <?php if ( count($vendor_products) > 3 ): ?>
                                        <div class="more">
                                            <button class="more__btn vendor__product-more">Показать еще</button>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            <?php
                            endif;
                            if ( $vendor_sensors ) : ?>
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
                                                $price = wc_price($sensor_product->get_price(), [
                                                    'price_format'       => '%2$s',
                                                    'thousand_separator' => ' ',
                                                    'decimal_separator'  => ' ',
                                                    'decimals'           => 0
                                                ]);
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
                                                            <div class="name"
                                                                <?php
                                                                if (strlen($sensor_product->get_title()) > 55):?>
                                                                    style="line-height: 29px;"
                                                                <?php elseif (strlen($sensor_product->get_title()) > 20): ?>
                                                                    style="line-height: 29px;" <?php endif; ?>
                                                            >
                                                                <?= $sensor_product->get_title() ?>
                                                            </div>
                                                            <div class="values">
                                                                <div class="values__price">
                                                                    от <?= $price ?> <?= get_woocommerce_currency_symbol() ?>
                                                                </div>

                                                            </div>
                                                            <div class="link">
                                                                <div>Подробнее</div>
                                                            </div>
                                                        </div>
                                                        <div class="card__body_ex">
                                                            <div class="head">
                                                                Подходит:
                                                            </div>
                                                            <?php if ( !empty($attributes) ): ?>
                                                                <ul class="list">
                                                                    <?php
                                                                    $similar_product = $sensor_product->get_upsell_ids();

                                                                    foreach ( $similar_product as $id ):
                                                                        $similar = wc_get_product($id);
                                                                        echo '<li class="list__item">— ' . $similar->get_title() . '</li>';
                                                                    endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                            <div class="action product-action-consultation">
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

                                    <?php if ( count($vendor_sensors) ): ?>
                                        <div class="more">
                                            <button class="more__btn sensor__more">Показать еще</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
endif;
get_footer();
