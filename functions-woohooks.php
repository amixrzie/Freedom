<?php
// removing woo stylings
add_filter('woocommerce_enqueue_styles', '__return_false');

add_filter('woocommerce_show_page_title', function ($title) {
  if (is_shop()) {
    return false; // Hide shop title
  }
  return $title;
});

// to justify content in middle of page
add_action('woocommerce_before_main_content', 'hodecode_content_wrapper', 10);
function hodecode_content_wrapper()
{
  echo '<div id="content" class="mx-auto max-w-screen-lg">'; // Add your desired class here
}
add_action('woocommerce_after_main_content', 'hodecode_content_wrapper_end', 10);
function hodecode_content_wrapper_end()
{
  echo '</div>';
}

// remove sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

// removing extra data at shop top page
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Adding category bar
add_action('woocommerce_before_shop_loop', 'hodcode_woo_cats');
function hodcode_woo_cats()
{
  $categories = get_terms([
    'taxonomy'   => 'product_cat',
    'hide_empty' => false, // include empty categories
  ]);

  $activeClasses = 'bg-blue1 text-white';
  $defaultClasses = 'text-gray-700 hover:bg-blue-500 bg-white';
  if (!empty($categories) && !is_wp_error($categories)) :
    // Get current active category ID (if on product category page)
    $current_cat_id = 0;
    if (is_tax('product_cat')) {
      $current_cat_id = get_queried_object_id();
    }
    $finalClasses = $current_cat_id == 0 ? $activeClasses : $defaultClasses;

?>
    <div class="flex flex-wrap gap-3 py-4">
      <a href="<?php echo bloginfo('url'); ?>"
        class="border border-gray-400 px-4 py-2 rounded-full text-sm font-medium transition <?php echo $finalClasses; ?>">
        همه محصولات
      </a>
      <?php foreach ($categories as $category) :
        $is_active = ($category->term_id === $current_cat_id);
        $finalClasses = $is_active ? $activeClasses : $defaultClasses;
      ?>
        <a
          href="<?php echo esc_url(get_term_link($category)); ?>"
          class="px-4 py-2 border border-gray-400 rounded-full text-sm font-medium transition <?php echo $finalClasses; ?>">
          <?php echo esc_html($category->name); ?>
        </a>
      <?php endforeach; ?>
    </div>

  <?php endif;
}

// Override product loop container
add_filter('woocommerce_product_loop_start', 'hodcode_product_loop_start');
function hodcode_product_loop_start()
{
  return '<ul class="list-none grid grid-cols-1 md:grid-cols-3 gap-4">';
}

add_filter('woocommerce_product_loop_end', 'hodcode_product_loop_end');
function hodcode_product_loop_end()
{
  return '</ul>';
}

// Product card classes
add_filter('woocommerce_post_class', 'add_bootstrap_product_classes', 10, 2);
function add_bootstrap_product_classes($classes, $product)
{
  $classes[] = 'list-none rounded-lg overflow-hidden bg-white'; // Adjust based on Bootstrap grid size (e.g., col-md-3, col-lg-4)
  return $classes;
}

// Adding card below image paddings
add_action("woocommerce_before_shop_loop_item_title", "hodcode_product_loop_item_details_wrapper", 40);
function hodcode_product_loop_item_details_wrapper()
{
  echo '<div class="p-3">';
}
add_action("woocommerce_after_shop_loop_item", "hodcode_product_loop_item_details_wrapper_close", 40);
function hodcode_product_loop_item_details_wrapper_close()
{
  echo '</div>';
}

// Product card title classes
add_filter('woocommerce_product_loop_title_classes', 'hodecode_product_loop_title_classes');
function hodecode_product_loop_title_classes($classes)
{
  $classes .= ' text-lg font-semibold py-2';
  return $classes;
}

// adding category below title
add_action('woocommerce_shop_loop_item_title', 'hodcode_product_loop_item_category', 15);
function hodcode_product_loop_item_category()
{
  global $product;

  ?>
  <div class="text-sm text-gray-500 mb-2">
    <?php
    $categories = get_the_terms($product->get_id(), 'product_cat');
    if ($categories && !is_wp_error($categories)) {
      echo esc_html($categories[0]->name);
    }
    ?>
  </div>
<?php
}

// add-to-card styling
add_filter('woocommerce_loop_add_to_cart_args', function ($args, $product) {
  $args['class'] .= ' bg-blue2 justify-center text-white rounded-lg overflow-hidden flex p-2 font-light text-sm ';

  return $args;
}, 10, 2);

// Buttons section
add_action("woocommerce_after_shop_loop_item_title", "hodcode_product_link_section_wrapper", 11);
function hodcode_product_link_section_wrapper()
{
  echo '<div class="grid grid-cols-2 justify-center items-center gap-2">';
}
add_action("woocommerce_after_shop_loop_item", "hodcode_product_link_section_wrapper_close", 11);
function hodcode_product_link_section_wrapper_close()
{
  echo "</div >";
}

// Details product link
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close');
add_action("woocommerce_after_shop_loop_item", "hodcode_product_link", 9);
function hodcode_product_link()
{
?>
  <div class="justify-center p-2 font-light text-sm bg-gray-200 text-gray rounded-lg flex text-center">
    <?php woocommerce_template_loop_product_link_open() ?>
    مشاهده جزیات
    <?php woocommerce_template_loop_product_link_close() ?>
  </div>
<?php
}


// Price formatting
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
add_action('woocommerce_after_shop_loop_item_title', 'hodcode_template_loop_price');
function hodcode_template_loop_price()
{
  global $product;

  $price = ($product->get_price());
  $regularPrice = ($product->get_regular_price());
  $offPercent = 100 * ($regularPrice - $price) / $price
?>

  <span class="flex gap-2 items-center mb-3">
    <?php if ($offPercent): ?><span class="bg-red-600 text-white px-1 rounded-md">
        <?= toPersianNumerals(number_format($offPercent)) ?>%
      </span>
    <?php endif; ?>
    <span class="grow"></span>
    <?php if ($offPercent): ?>
      <span class="text-gray-300 line-through"><?= toPersianNumerals(number_format($regularPrice)) ?></span>
    <?php endif; ?>
    <span class=""><?= toPersianNumerals(number_format($price)) ?></span>
    <span class="">ریال</span>
  </span>
<?php
}
