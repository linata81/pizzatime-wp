<?php
  $product_id = get_the_ID();

  $product_price = carbon_get_post_meta($product_id, 'product_price');
  $product_attributes = carbon_get_post_meta($product_id, 'product_attributes');
  $product_img_src = get_the_post_thumbnail_url($product_id, 'product');
  $product_img_src_webp = convertToWebpSrc($product_img_src);

  $product_categories = get_the_terms($product_id, 'product-categories');
  $product_categories_str = '';
  foreach ($product_categories as $category) {
    $product_categories_str .= "$category->slug,";
  }
  $product_categories_str = substr($product_categories_str, 0, -1);
  
  $product_data_attribute = count($product_attributes) !== 0 ? 'data-product-attribute="'. $product_attributes[0]['name'] .'"' : "";
?>

<div class="catalog__item" data-category="<?php echo $product_categories_str; ?>">
  <div class="product catalog__product js-product" data-product-name="<?php the_title(); ?>" data-product-price="<?php echo $product_price; ?>" <?php echo $product_data_attribute; ?> data-product-src="<?php echo get_the_post_thumbnail_url($product_id, 'product'); ?>">
    <a class="product__img-link" href="<?php the_permalink(); ?>">
      <picture>
        <source type="image/webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-srcset="<?php echo $product_img_src_webp; ?>">
        <img class="product__img lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="<?php echo $product_img_src; ?>" alt="">
      </picture>
    </a>
    <div class="product__content">
      <a class="product__link" href="<?php the_permalink(); ?>">
        <h3 class="product__title"><?php the_title(); ?></h3>
      </a>
      <div class="product__description">
        <?php the_excerpt(); ?>
      </div>
    </div>
    <footer class="product__footer">
      <?php if ($product_attributes) : ?>
        <div class="product__sizes">
          <?php $is_first_item = true; ?>
          <?php foreach ($product_attributes as $attribute) : ?>
            <?php
              $attribute_active_class = $is_first_item ? ' is-active' : ''; ?>
          <button data-product-attribute-price="<?php echo $attribute['price']; ?>" data-product-attribute-value="<?php echo $attribute['name']; ?>" class="js-btn-product-attribute product__size<?php echo $attribute_active_class; ?>" type="button"><?php echo $attribute['name']; ?></button>
          <?php
              $is_first_item = false;
            endforeach;
          ?>
        </div>
      <?php endif; ?>

      <div class="product__bottom">
        <div class="product__price">
          <span class="product__price-value js-product-price-value"><?php echo $product_price; ?></span>
          <span class="product__currency">&#8381;</span>
        </div>
        <button class="btn product__btn js-btn-add-to-cart" data-popup="popup-order" type="button" >????????????????</button>
      </div>
    </footer>
  </div>
</div>