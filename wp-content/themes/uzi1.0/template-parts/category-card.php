<li class="category-card">
    <a href="<?php echo get_category_link($args['cat_id']); ?>" class="category-card__link">
        <b class="category-card__title"><?php echo get_the_category_by_ID($args['cat_id']); ?></b>
        <?php
        $thumbnail_id = get_woocommerce_term_meta( $args['cat_id'], 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
//        echo kama_thumb_img([
//            'width' => 185,
//            'height'=> 133,
//            'class' => 'category-card__image',
//            'src'   => $image,
//            'title' => 'San Diego ' . get_the_category_by_ID($args['cat_id']) . ' Printing',
//            'alt'   => 'San Diego ' . get_the_category_by_ID($args['cat_id']) . ' Printing',
//        ]);
        ?>
        <img src="<?php echo $image;?>" class="category-card__image">
        <div class="category-card__button">LEARN MORE</div>
    </a>
</li>
