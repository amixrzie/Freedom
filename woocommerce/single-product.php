<?php
defined('ABSPATH') || exit;
get_header('shop');
?>

<main class="max-w-screen-xl mx-auto px-6 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <aside class="bg-white rounded-lg shadow p-4 order-2 lg:order-1 h-fit">
            <h2 class="text-lg font-semibold mb-4 pb-2">محصولات مشابه</h2>
            <div class="flex items-center gap-3 mb-3 border-b border-gray-200 p-2">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/Images/HedJbl.webp" class="w-12 h-12 object-cover rounded">
                <span class="text-sm text-gray-700">هدفون jbl</span>
            </div>
            <div class="flex items-center gap-3 mb-3 border-b border-gray-200 p-2">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/Images/Lablv.webp" class="w-12 h-12 object-cover rounded">
                <span class="text-sm text-gray-700">لپ تاپ لنوو</span>
            </div>
            <div class="flex items-center gap-3">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/Images/ps5.webp" class="w-12 h-12 object-cover rounded">
                <span class="text-sm text-gray-700">کنسول ps5</span>
            </div>
        </aside>
        <section class="col-span-1 lg:col-span-3 bg-white rounded-lg shadow p-6 flex flex-col order-1 lg:order-2">
            <?php
            while (have_posts()) : the_post();
                global $product;

                if (has_post_thumbnail()) {
                    the_post_thumbnail('large', ['class' => 'w-full sm:h-45 md:h-80 lg:h-90 object-contain rounded mb-4']);
                }
            ?>

            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold text-gray-800"><?php the_title(); ?></h1>
                <div class="flex items-center gap-4">
                    <?php
                        $price = $product->get_price();
                        $regular_price = $product->get_regular_price();
                        $discount = ($regular_price && $price && $regular_price > $price) ? round((($regular_price - $price)/$regular_price)*100) : 0;

                        if($price){
                            if($discount > 0){
                                echo '<span class="text-white font-bold p-2 rounded-lg bg-red-600">'. $discount .'%</span>';
                                echo '<span class="text-gray-400 line-through">'. number_format($regular_price) .' تومان</span>';
                            }
                            echo '<span class="text-lg font-bold text-gray-800">'. number_format($price) .' تومان</span>';
                        }
                    ?>
                </div>
            </div>

            <div class="text-sm text-gray-500 leading-loose mb-4">
                <?php the_content(); ?>
            </div>

            <div class="mb-4 flex justify-start gap-2">
                <?php
                echo apply_filters('woocommerce_loop_add_to_cart_link',
                    sprintf('<a href="%s" class="bg-blue2 justify-center text-white rounded-lg overflow-hidden flex p-2 font-light text-sm flex items-center gap-2">%s</a>',
                        esc_url($product->add_to_cart_url()),
                        esc_html($product->add_to_cart_text())
                    ),
                $product );
                ?>
            </div>
            <?php
                $features = get_post_meta(get_the_ID(), 'features', true);
                if(!empty($features)){
                    $features = explode(',', $features);
                    echo '<h3 class="text-lg font-bold text-gray-800 mb-2">ویژگی ها</h3>';
                    echo '<ul class="list-disc pr-5 text-sm text-gray-500">';
                    foreach($features as $feature){
                        echo '<li>'. esc_html(trim($feature)) .'</li>';
                    }
                    echo '</ul>';
                }
                ?>

            <?php endwhile; ?>
        </section>
    </div>
</main>

<?php get_footer('shop'); ?>
