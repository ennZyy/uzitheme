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
                                    <input type="tel" id="telInput" class="feed__body_input" placeholder="+7 (ХХХ) ХХХ ХХ ХХ">
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
                        <!--<div class="prod__descr_item active" id="descripton">
                            <div class="prod__descr_item_head">
                                <h3 class="prod__descr_item_head_title">Описание</h3>
                                <button class="prod__descr_item_head_btn">Скрыть</button>
                            </div>
                            <div class="prod__descr_item_body">
                                <div class="text">
                                    Превосходная универсальность, гибкая организация рабочего процесса и стабильно высокое качество изображения УЗИ сканера Xario 200 помогут справиться с клиническими задачами любой сложности. В систему Toshiba Xario входит комплексный пакет клинически проверенных программ, обеспечивающих великолепное качество изображений и высокое разрешение для самых разных областей применения. Широкий ассортимент технологий для визуализации и количественного анализа позволяет принимать максимально обоснованные решения о тактике лечения заболеваний.
                                </div>

                                <div class="video">
                                    <iframe width="1097" height="617" src="https://www.youtube.com/embed/Az4d7jlN6wo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>

                            </div>
                        </div>

                        <div class="prod__descr_item active" id="useful">
                            <div class="prod__descr_item_head">
                                <h3 class="prod__descr_item_head_title">Полезная информация</h3>
                                <button class="prod__descr_item_head_btn">Скрыть</button>
                            </div>
                            <div class="prod__descr_item_body">
                                <div class="text">
                                    Превосходная универсальность, гибкая организация рабочего процесса и стабильно высокое качество изображения УЗИ сканера Xario 200 помогут справиться с клиническими задачами любой сложности. В систему Toshiba Xario входит комплексный пакет клинически проверенных программ, обеспечивающих великолепное качество изображений и высокое разрешение для самых разных областей применения.
                                </div>
                                <div class="usf">
                                    <div class="usf__img">
                                        <picture>
                                            <source srcset="" type="image/webp">
                                            <img src="./img/usf/usf.png" alt="">
                                        </picture>
                                    </div>
                                    <div class="usf__body">
                                        Широкий ассортимент технологий для визуализации и количественного анализа позволяет принимать максимально обоснованные решения о тактике лечения заболеваний.

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="prod__descr_item active" id="rateProd">
                            <div class="prod__descr_item_head">
                                <div class="prod__descr_item_head_title">
                                    15 место Xario 200
                                </div>
                                <div class="prod__descr_item_head_btn">
                                    Скрыть
                                </div>
                            </div>
                            <div class="prod__descr_item_body">
                                <div class="prod__main">

                                    <div class="prod__main_content">
                                        <div class="prod__main_thumbs swiper">
                                            <div class="prod__main_thumbs_wr swiper-wrapper">
                                                <div class="prod__main_thumbs_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-thumb.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_thumbs_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-thumb.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_thumbs_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-thumb.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_thumbs_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-thumb.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_thumbs_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-thumb.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_thumbs_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-thumb.png" alt="">
                                                    </picture>
                                                </div>
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
                                            <div class="prod__main_slider_wr swiper-wrapper">
                                                <div class="prod__main_slider_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-main.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_slider_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-main.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_slider_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-main.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_slider_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-main.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_slider_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-main.png" alt="">
                                                    </picture>
                                                </div>
                                                <div class="prod__main_slider_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-main.png" alt="">
                                                    </picture>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="prod__descr_item active">
                            <div class="prod__descr_item_body">
                                <div class="text">
                                    Превосходная универсальность, гибкая организация рабочего процесса и стабильно высокое качество изображения УЗИ сканера Xario 200 помогут справиться с клиническими задачами любой сложности. В систему Toshiba Xario входит комплексный пакет клинически проверенных программ, обеспечивающих великолепное качество изображений и высокое разрешение для самых разных областей применения.
                                </div>
                                <div class="spr">
                                    <div class="spr__item spr__main">
                                        <div class="spr__item_head">Важно</div>
                                        <div class="spr__item_body">
                                            Лишь реплицированные с зарубежных источников, современные исследования, инициированные исключительно синтетически, ограничены исключительно образом мышления.
                                        </div>
                                    </div>
                                    <div class="spr__item spr__wr">
                                        <div class="spr__item_head">Справка</div>
                                        <div class="spr__item_body">
                                            Для современного мира граница обучения кадров обеспечивает широкому кругу (специалистов) участие в формировании позиций, занимаемых участниками в отношении поставленных задач.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="prod__descr_item active">
                            <div class="prod__descr_item_head">
                                <div class="prod__descr_item_head_title">
                                    14 место Xario 200
                                </div>
                                <div class="prod__descr_item_head_btn">
                                    Скрыть
                                </div>
                            </div>
                            <div class="prod__descr_item_body">
                                <div class="prod__main">

                                    <div class="prod__main_content">
                                        <div class="prod__main_slider swiper">
                                            <div class="prod__main_slider_wr swiper-wrapper">
                                                <div class="prod__main_slider_sl swiper-slide">
                                                    <picture>
                                                        <source srcset="" type="image/webp">
                                                        <img src="./img/prod/prod-main.png" alt="">
                                                    </picture>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                    <div class="prod__main_action">
                                        <a href="#" class="prod__main_action_btn">
                                            Перейти к аппарату
                                        </a>
                                    </div>
                                </div>
                                <div class="text">
                                    Превосходная универсальность, гибкая организация рабочего процесса и стабильно высокое качество изображения УЗИ сканера Xario 200 помогут справиться с клиническими задачами любой сложности. В систему Toshiba Xario входит комплексный пакет клинически проверенных программ, обеспечивающих великолепное качество изображений и высокое разрешение для самых разных областей применения.
                                    <br>
                                    <br>
                                    Не следует, однако, забывать, что сплочённость команды профессионалов влечет за собой процесс внедрения и модернизации системы массового участия. Вот вам яркий пример современных тенденций - перспективное планирование способствует повышению качества стандартных подходов. В своём стремлении улучшить пользовательский опыт мы упускаем, что интерактивные прототипы смешаны с не уникальными данными до степени совершенной неузнаваемости, из-за чего возрастает их статус бесполезности. Принимая во внимание показатели успешности,
                                </div>
                            </div>
                        </div>-->



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
                                <div class="prod__comment_body_h">
                                    Написать с помощью +
                                </div>
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
