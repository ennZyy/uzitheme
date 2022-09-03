<?php
$footer_settings = get_field('footer_settings', 'option');

$phone = str_replace(array('+', ' ', '(', ')', '-'), '', $footer_settings['contacts']['phone']);
?>
    <footer class="footer">
        <div class="footer__main">
            <div class="container">
                <div class="footer__main_in">
                    <div class="footer__main_top">
                        <a href="#" class="footer__main_top_logo">
                            <picture>
                                <source srcset="" type="image/webp">
                                <img src="<?= $footer_settings['logo']['url'] ?>">
                            </picture>
                        </a>
                        <button class="footer__main_top_btn" id="upBtn">
                            <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.50019 9.73123C1.16174 10.0794 0.600522 10.0847 0.255384 9.74304C-0.0786184 9.41239 -0.0859278 8.87856 0.238899 8.53907L8.13756 0.283685C8.49272 -0.087521 9.08726 -0.0954994 9.45246 0.26604C9.80593 0.615962 9.8114 1.1816 9.46478 1.53816L1.50019 9.73123Z"
                                      fill="#5C82E4"/>
                                <path d="M17.7456 8.53188C18.0848 8.86773 18.0848 9.41226 17.7456 9.74811C17.4063 10.084 16.8563 10.084 16.517 9.74811L8.53146 1.84259C8.19221 1.50674 8.19221 0.962208 8.53146 0.626355C8.87072 0.2905 9.42076 0.2905 9.76001 0.626355L17.7456 8.53188Z"
                                      fill="#5C82E4"/>
                            </svg>

                        </button>
                    </div>
                    <div class="footer__main_body">
                        <div class="footer__main_body_item">
                            <div class="item">
                                <h3 class="item__head">
                                    Контакты
                                </h3>
                                <div class="item__list">
                                    <a href="mailto:siteadressmail@mail.ru" class="item__list-link">
                                        Email: <span><?= $footer_settings['contacts']['email'] ?></span>
                                    </a>
                                    <a href="tel:+<?= $phone ?>" class="item__list-link">
                                        Телефон: <span><?= $footer_settings['contacts']['phone'] ?></span>
                                    </a>
                                </div>
                            </div>

                            <div class="item">
                                <h3 class="item__head">
                                    Документы
                                </h3>
                                <div class="item__list">
                                    <?php foreach ($footer_settings['documents'] as $item): ?>
                                        <a href="<?= $item['url'] ?>" class="item__list_item"><?= $item['text'] ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer__main_body_item">
                            <div class="item">
                                <h3 class="item__head">
                                    Рейтинги
                                </h3>
                                <div class="item__list">
                                    <?php foreach ($footer_settings['rating'] as $item): ?>
                                        <a href="<?= $item['url'] ?>" class="item__list_item"><?= $item['text'] ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer__main_body_item">
                            <div class="item">
                                <h3 class="item__head">
                                    Лучшие производители
                                </h3>
                                <div class="item__list">
                                    <?php foreach ($footer_settings['top-producers'] as $item): ?>
                                        <a href="<?= $item['url'] ?>" class="item__list_item"><?= $item['text'] ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer__main_body_item">
                            <div class="item">
                                <h3 class="item__head">
                                    Лучшие аппараты
                                </h3>
                                <div class="item__list">
                                    <?php foreach ($footer_settings['best-devices'] as $item): ?>
                                        <a href="<?= $item['url'] ?>" class="item__list_item"><?= $item['text'] ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bot">
            <div class="container">
                <div class="footer__bot_in">
                    <?= $footer_settings['copyright'] ?>
                </div>
            </div>
        </div>
    </footer>
</div>

<div class="addc">
    <form class="addc__body" id="registrationVendor">
        <button type="button" class="addc__body_close">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="3.20093" height="32.0093" rx="1.60047"
                      transform="matrix(0.710018 0.704183 -0.710018 0.704183 22.7266 0)" fill="white"/>
                <rect width="3.20093" height="32.0093" rx="1.60047"
                      transform="matrix(0.710018 -0.704183 0.710018 0.704183 0 2.45947)" fill="white"/>
            </svg>

        </button>
        <div class="addc__body_in">
            <h2 class="addc__body_head">
                Добавление компании
            </h2>
            <div class="addc__body_upl">
                <input type="file" id="uploadLogo" name="vendorLogo">
                <label class="addc__body_upl_in" for="uploadLogo">
                    <div class="place"></div>
                    <div class="body">
                        <div class="body__name">Прикрепите лого компании</div>
                        <div class="body__info">
                            Рекомендуемый размер 700х210
                        </div>
                    </div>
                </label>
            </div>
            <div class="addc__body_input">
                <input type="text" placeholder="Название компании" name="vendorName">
            </div>
            <div class="addc__body_text">
                <textarea placeholder="Пропишите сюда описание компании и контакты" name="vendorDescription"></textarea>
            </div>
            <div class="addc__body_action">
                <button class="vendor__registration">Отправить</button>
            </div>
        </div>
    </form>
</div>
<!-- EX blocks -->

<!-- Моибльное меню -->
<div class="mobmenu">
    <div class="mobmenu__in">
        <div class="mobmenu__head">
            <h3 class="mobmenu__head_title">
                Меню
            </h3>
            <button class="mobmenu__head_close" id="mobmenuClose">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M0.741953 0.757274C-0.247318 1.76697 -0.247318 3.40402 0.741953 4.41372L8.95856 12.8L1.32979 20.5863C0.340522 21.596 0.340523 23.233 1.32979 24.2427C2.31906 25.2524 3.92299 25.2524 4.91226 24.2427L12.541 16.4564L20.0873 24.1585C21.0765 25.1682 22.6805 25.1682 23.6697 24.1585C24.659 23.1488 24.659 21.5118 23.6697 20.5021L16.1235 12.8L24.2576 4.49793C25.2468 3.48824 25.2468 1.85119 24.2576 0.841491C23.2683 -0.168207 21.6644 -0.168207 20.6751 0.841491L12.541 9.14355L4.32442 0.757274C3.33515 -0.252425 1.73122 -0.252424 0.741953 0.757274Z"
                          fill="#2F2F2F"/>
                </svg>
            </button>
        </div>
        <?php
        wp_nav_menu([
            'theme_location' => '',
            'menu' => 'Mob menu',
            'container' => '',
            'menu_class' => 'mobmenu__list',
            'fallback_cb' => 'wp_page_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        ]);
        ?>
        <div class="mobmenu__links">
            <div class="mobmenu__links_item">
                <div class="name">телефон</div>
                <a href="tel:+<?= $phone ?>" class="value"><?= $footer_settings['contacts']['phone'] ?></a>
            </div>
            <div class="mobmenu__links_item">
                <div class="name">email</div>
                <a href="mailto:<?= $footer_settings['contacts']['email'] ?>"
                   class="value"><?= $footer_settings['contacts']['email'] ?></a>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно "Консультация в один клик" -->
<div class="feed feed-modal modal-hide">
    <div class="feed-overlay">
        <div class="container">
            <div class="feed__in">
                <i class="fa fa-times close" aria-hidden="true"></i>
                <form class="feed__body-modal">
                    <h2 class="feed__body_title section__title">
                        <span>как правильно </span>
                        Выбрать аппарат
                    </h2>
                    <div class="feed__body_descr">
                        получите бесплатную
                        <br>
                        консультацию от наших специалистов
                    </div>
                    <input type="tel" id="modalTelInput" name="userPhone" class="feed__body_input" placeholder="+7 (495) 555-55-55">
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
    </div>
</div>
<!-- Конец Модальное окно "Консультация в один клик" -->
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
<?php wp_footer(); ?>

</body>
</html>