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
get_footer();
