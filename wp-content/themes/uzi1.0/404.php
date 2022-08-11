<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BPSD
 */

get_header();
?>

    <main class="main">
        <section class="notfound">
            <div class="container">
                <div class="notfound__in">
                    <div class="notfound__body">
                        <h2 class="notfound__body_head">
                            ошибка
                            <span>404</span>
                            Страница не найдена
                        </h2>
                        <div class="notfound__body_list">
                            <?php
                            wp_nav_menu( [
                                'theme_location'  => '',
                                'menu'            => 'Menu 404',
                                'container'       => '',
                                'menu_class'      => 'notfound__body_list',
                                'fallback_cb'     => 'wp_page_menu',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            ] );
                            ?>
                        </div>
                    </div>
                    <div class="notfound__img">
                        <picture>
                            <source srcset="" type="image/webp">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/notfound/notfound.png" alt="">
                        </picture>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
get_footer();