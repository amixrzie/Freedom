<?php get_header(); ?>

<main class="max-w-screen-xl mx-auto px-8 py-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <aside class="bg-white rounded-lg shadow p-4 h-fit order-2 lg:order-1">
            <h2 class="text-lg font-semibold mb-4 pb-2">محصولات مشابه</h2>
            <div class="flex items-center gap-3 mb-3 border-b border-gray-200 p-2">
                <img src="<?php echo get_template_directory_uri(); ?>/Assets/Images/HedJbl.webp" class="w-12 h-12 object-cover rounded">
                <span class="text-sm text-gray-700">هدفون jbl</span>
            </div>
             <div class="flex items-center gap-3 mb-3 border-b border-gray-200 p-2">
                <img src="<?php echo get_template_directory_uri(); ?>/Assets/Images/Lablv.webp" alt="لپ تاپ لنوو" class="w-12 h-12 object-cover rounded">
                <span class="text-sm text-gray-700">لپ تاپ لنوو</span>
            </div>
            <div class="flex items-center gap-3">
                <img src="<?php echo get_template_directory_uri(); ?>/Assets/Images/ps5.webp" alt="کنسول ps5" class="w-12 h-12 object-cover rounded">
                <span class="text-sm text-gray-700">کنسول ps5</span>
            </div>
        </aside>

        <section class="col-span-1 md:col-span-1 lg:col-span-3 bg-white rounded-lg shadow p-6 flex flex-col order-1 lg:order-2">

            <?php if(has_post_thumbnail()): ?>
                <?php the_post_thumbnail('large', ['class' => 'w-full sm:h-45 md:h-80 lg:h-90 object-contain rounded mb-4']); ?>
            <?php endif; ?>

            <div class="flex items-center justify-between mb-4">
                <h1 class="text-xl font-semibold text-gray-800"><?php the_title(); ?></h1>
                <div class="flex items-center gap-4">
                    <?php 
                        $price = get_post_meta(get_the_ID(), 'price', true);
                        $old_price = get_post_meta(get_the_ID(), 'old_price', true);
                        $discount = ($old_price && $price) ? round((($old_price - $price)/$old_price)*100) : 0;

                        if($price){
                            if($discount > 0){
                                echo '<span class="text-white font-bold p-2 rounded-lg bg-red-600">'. $discount .'%</span>';
                                echo '<span class="text-gray-400 line-through">'. number_format($old_price) .' تومان</span>';
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
                <a href="?add-to-cart=<?php the_ID(); ?>" class="flex items-center gap-2 bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    افزودن به سبد خرید
                </a>
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
        </section>
    </div>
</main>

<?php get_footer(); ?>
