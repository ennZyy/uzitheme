<?php
/* Template Name: Blog page */
global $post;

$wpb_all_query = new WP_Query(
        array(
            'post_type'=>'post',
            'post_status'=>'publish',
            'order' => 'DESC',
            'posts_per_page'=>'12'));

get_header();
?>

    <main>
        <section class="articles">
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
                <div class="articles__in">
                    <h1 class="articles__head">
                        Статьи
                    </h1>
                    <div class="articles__filter">
                        <label for="filterView">
                            <button class="articles__filter_item articles__filter-views" name="filterView">Фильтровать по просмотрам</button>
                            <input type="hidden" name="inputFilterView" value="nopopular">
                        </label>
                        <label for="filterDate">
                            <button class="articles__filter_item articles__filter-date active" name="filterDate" >Фильтровать по дате</button>
                            <input type="hidden" name="inputFilterDate" value="ASC">
                        </label>
                    </div>
                    <div class="articles__list" id="response">
                        <?php if ( $wpb_all_query->have_posts() ) : ?>
                        <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
                        <a href="<?php the_permalink() ?>" class="articles__list_item art">
                            <div class="art__img">
                                <picture>
                                    <source srcset="" type="image/webp">
                                    <?= get_the_post_thumbnail($post->ID, 'post-thumbnail', ['alt'=>$post->post_title]) ?>
                                </picture>
                            </div>
                            <div class="art__body">
                                <div class="art__body_name"><?php the_title(); ?></div>
                                <div class="art__body_info">
                                    <div class="art__body_info_item art__body_info_item-rep">(<?= get_comments_number($post->ID) ?>)</div>
                                    <div class="art__body_info_item art__body_info_item-sn">(<?= get_post_views($post->ID) ?>)</div>
                                </div>
                            </div>
                        </a>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ($wpb_all_query->max_num_pages > 1) : ?>
                        <div class="articles__action">
                            <script>
                                var posts_vars = '<?php echo serialize($wpb_all_query->query_vars); ?>';
                                var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                                var max_pages = '<?php echo $wpb_all_query->max_num_pages; ?>';
                            </script>
                            <button id="blog-loadmore" class="articles__action_btn">Показать ещё</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main

<?php
get_footer();