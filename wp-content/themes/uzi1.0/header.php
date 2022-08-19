<?php
//Get custom fields from admin
$header  = get_field('header', 'option');

$phone = str_replace(array('+', ' ', '(' , ')', '-'), '', $header['phone']);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body>

<div class="wrapper">

    <header class="header">
        <div class="container">
            <div class="header__in">
                <div class="header__top">
                    <div class="header__left">
                        <a href="<?= get_home_url() ?>" class="header__logo">
                            <picture>
                                <source srcset="" type="image/webp">
                                <img src="<?= $header['logo']['url'] ?>">
                            </picture>
                        </a>
                        <div class="header__search" id="searchFeild">
                            <input type="text" name="search" placeholder="Я ищу...">
                            <button class="search__btn">
                                Найти
                            </button>

                            <div class="close" id="searchFieldClose">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="1.9206" height="19.206" rx="0.960302" transform="matrix(0.710018 0.704183 -0.710018 0.704183 13.6367 0)" fill="#2F2F2F"/>
                                    <rect width="1.9206" height="19.206" rx="0.960302" transform="matrix(0.710018 -0.704183 0.710018 0.704183 0 1.47559)" fill="#2F2F2F"/>
                                </svg>
                            </div>

                        </div>
                    </div>
                    <div class="header__right">
                        <?php if ( !empty($header['phone']) ): ?>
                            <div class="header__link">
                                <div class="header__link_name">телефон</div>
                                <a href="tel:+<?= $phone ?>" class="header__link_value"><?= $header['phone'] ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="header__link">
                            <div class="header__link_name">email</div>
                            <a href="mailto:siteadressmail@mail.ru" class="header__link_value"><?= $header['email'] ?></a>
                        </div>
                    </div>
                    <button class="header__burger" id="mobmenuTrigger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="header__sr" id="searchFieldToggler">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.96875 17.1875C13.9556 17.1875 17.1875 13.9556 17.1875 9.96875C17.1875 5.98194 13.9556 2.75 9.96875 2.75C5.98194 2.75 2.75 5.98194 2.75 9.96875C2.75 13.9556 5.98194 17.1875 9.96875 17.1875Z" stroke="#5C82E4" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.0732 15.0732L19.2499 19.2499" stroke="#5C82E4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                    </button>
                </div>
                <div class="header__bottom">
                    <?php
                    wp_nav_menu( [
                        'theme_location'  => '',
                        'menu'            => 'Header menu',
                        'container'       => '',
                        'menu_class'      => 'header__nav',
                        'fallback_cb'     => 'wp_page_menu',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    ] );
                    ?>
                </div>
            </div>
        </div>
    </header>