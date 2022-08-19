<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package BPSD
 */

get_header();

wc_page_noindex()
?>
    <main class="main">
        <section class="search">
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
                <div class="search__in">
                    <div class="search__head">
                        Поиск по фразе «<span><?= get_search_query() ?></span>»
                    </div>
                    <div class="search__list">
                        <a href="#" class="search__list_item card">
                            <div class="card__img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="./img/card/card.png" alt="">
                                </picture>
                            </div>
                            <div class="card__body">
                                <div class="card__body_main">
                                    <div class="name">Philips SE 310</div>
                                    <div class="values">
                                        <div class="values__price">
                                            от 2 800 000 ₽
                                        </div>
                                        <div class="values__cnt">
                                            9/10
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
                                        <li class="list__item">— для сердца и сосудов</li>
                                        <li class="list__item">— для геникологии и акушерства</li>
                                        <li class="list__item">— 3d/4d аппараты</li>
                                    </ul>
                                    <div class="action">
                                        <button>
                                            Консультация в один клик
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </a>
                        <a href="#" class="search__list_item card">
                            <div class="card__img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="./img/card/card.png" alt="">
                                </picture>
                            </div>
                            <div class="card__body">
                                <div class="card__body_main">
                                    <div class="name">Philips SE 310</div>
                                    <div class="values">
                                        <div class="values__price">
                                            от 2 800 000 ₽
                                        </div>
                                        <div class="values__cnt">
                                            9/10
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
                                        <li class="list__item">— для сердца и сосудов</li>
                                        <li class="list__item">— для геникологии и акушерства</li>
                                        <li class="list__item">— 3d/4d аппараты</li>
                                    </ul>
                                    <div class="action">
                                        <button>
                                            Консультация в один клик
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </a>
                        <a href="#" class="search__list_item card">
                            <div class="card__img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="./img/card/card.png" alt="">
                                </picture>
                            </div>
                            <div class="card__body">
                                <div class="card__body_main">
                                    <div class="name">Philips SE 310</div>
                                    <div class="values">
                                        <div class="values__price">
                                            от 2 800 000 ₽
                                        </div>
                                        <div class="values__cnt">
                                            9/10
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
                                        <li class="list__item">— для сердца и сосудов</li>
                                        <li class="list__item">— для геникологии и акушерства</li>
                                        <li class="list__item">— 3d/4d аппараты</li>
                                    </ul>
                                    <div class="action">
                                        <button>
                                            Консультация в один клик
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </a>
                        <a href="#" class="search__list_item card">
                            <div class="card__img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="./img/card/card.png" alt="">
                                </picture>
                            </div>
                            <div class="card__body">
                                <div class="card__body_main">
                                    <div class="name">Philips SE 310</div>
                                    <div class="values">
                                        <div class="values__price">
                                            от 2 800 000 ₽
                                        </div>
                                        <div class="values__cnt">
                                            9/10
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
                                        <li class="list__item">— для сердца и сосудов</li>
                                        <li class="list__item">— для геникологии и акушерства</li>
                                        <li class="list__item">— 3d/4d аппараты</li>
                                    </ul>
                                    <div class="action">
                                        <button>
                                            Консультация в один клик
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </a>
                        <a href="#" class="search__list_item card">
                            <div class="card__img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="./img/card/card.png" alt="">
                                </picture>
                            </div>
                            <div class="card__body">
                                <div class="card__body_main">
                                    <div class="name">Philips SE 310</div>
                                    <div class="values">
                                        <div class="values__price">
                                            от 2 800 000 ₽
                                        </div>
                                        <div class="values__cnt">
                                            9/10
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
                                        <li class="list__item">— для сердца и сосудов</li>
                                        <li class="list__item">— для геникологии и акушерства</li>
                                        <li class="list__item">— 3d/4d аппараты</li>
                                    </ul>
                                    <div class="action">
                                        <button>
                                            Консультация в один клик
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </a>
                        <a href="#" class="search__list_item art">
                            <div class="art__img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <img src="./img/prod/exmaple.png" alt="">
                                </picture>
                            </div>
                            <div class="art__body">
                                <div class="art__body_name">Рейтинг лучших УЗИ аппаратов. ТОП 15 популярных</div>
                                <div class="art__body_info">
                                    <div class="art__body_info_item art__body_info_item-rep">(4)</div>
                                    <div class="art__body_info_item art__body_info_item-sn">(13 324)</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
get_footer();
