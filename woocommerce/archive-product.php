<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
// do_action('woocommerce_before_main_content');

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
do_action('woocommerce_shop_loop_header');

if (woocommerce_product_loop()) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	// do_action('woocommerce_before_shop_loop');
?>
	<div class="max-w-screen-lg mx-auto">
		<?php
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
			$finalClasses = $current_cat_id == 0 ? $activeClasses:$defaultClasses;

		?>
			<div class="flex flex-wrap gap-3 py-4">
				<a href="<?php echo bloginfo('url'); ?>"
					class="border border-gray-400 px-4 py-2 rounded-full text-sm font-medium transition <?php echo $finalClasses; ?>">
					همه محصولات
				</a>
				<?php foreach ($categories as $category) :
					$is_active = ($category->term_id === $current_cat_id);
					$finalClasses = $is_active ? $activeClasses:$defaultClasses;
				?>
					<a
						href="<?php echo esc_url(get_term_link($category)); ?>"
						class="px-4 py-2 border border-gray-400 rounded-full text-sm font-medium transition <?php echo $finalClasses; ?>">
						<?php echo esc_html($category->name); ?>
					</a>
				<?php endforeach; ?>
			</div>

		<?php endif; ?>

		<?php
		woocommerce_product_loop_start();
		?>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">

			<?php
			if (wc_get_loop_prop('total')) {
				while (have_posts()) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action('woocommerce_shop_loop');

					wc_get_template_part('content', 'product');
				}
			}
			?>

		</div>

	</div>
<?php

	woocommerce_product_loop_end();

	// woocommerce_product_subcategories();
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action('woocommerce_after_shop_loop');
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action('woocommerce_sidebar');

get_footer('shop');
