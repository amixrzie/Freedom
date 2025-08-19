<?php get_header(); ?>

<main class="max-w-7xl mx-auto px-6 mt-6">

    <section class="mb-8">
        <div class="flex flex-wrap gap-3">
            <a href="<?php echo get_post_type_archive_link('product'); ?>"
                class="px-5 py-2 bg-gray-200 text-gray-800 rounded-full hover:bg-blue-600 hover:text-white transition">
                همه محصولات
            </a>

            <?php
            $terms = get_terms([
                'taxonomy'   => 'product_cat',
                'hide_empty' => true,
            ]);

            if (!empty($terms) && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $active = (is_tax('product_cat', $term->term_id)) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800';
                    echo '<a href="' . esc_url(get_term_link($term)) . '" class="px-5 py-2 ' . $active . ' rounded-full hover:bg-blue-500 hover:text-white transition">'
                        . esc_html($term->name) .
                        '</a>';
                }
            }
            ?>
        </div>
    </section>

    <section>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            $args = [
                'post_type'      => 'product',
                'posts_per_page' => 6,
                'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
            ];

            if (is_tax('product_cat')) {
                $args['tax_query'] = [[
                    'taxonomy' => 'product_cat',
                    'field'    => 'id',
                    'terms'    => get_queried_object_id(),
                ]];
            }

            $loop = new WP_Query($args);

            if ($loop->have_posts()) :
                while ($loop->have_posts()) : $loop->the_post();
                    $price    = get_post_meta(get_the_ID(), 'price', true);
                    $old_price = get_post_meta(get_the_ID(), 'old_price', true);
                    $discount = ($old_price && $price) ? round((($old_price - $price) / $old_price) * 100) : 0;
            ?>
                    <div class="rounded-xl overflow-hidden shadow hover:shadow-2xl transition">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-contain bg-white']); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/Assets/Images/no-image.png"
                                    alt="بدون تصویر" class="w-full h-48 object-contain bg-white">
                            <?php endif; ?>
                        </a>

                        <div class="p-4">
                            <h2 class="text-lg font-semibold"><?php the_title(); ?></h2>

                            <p class="text-sm text-gray-500 mb-3">
                                <?php echo get_the_term_list(get_the_ID(), 'product_cat', '', ', '); ?>
                            </p>
                            <?php if ($price) : ?>
                                <div class="flex items-center justify-between gap-3 mb-4">
                                    <?php if ($discount > 0) : ?>
                                        <span class="text-white bg-red-600 p-2 rounded-lg font-bold"><?php echo $discount; ?>%</span>
                                        <span class="text-gray-400 line-through"><?php echo number_format($old_price); ?> تومان</span>
                                    <?php endif; ?>
                                    <span class="text-lg font-bold text-gray-800"><?php echo number_format($price); ?> تومان</span>
                                </div>
                            <?php endif; ?>
                            <div class="flex gap-2">
                                <a href="?add-to-cart=<?php the_ID(); ?>"
                                   class="flex-1 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition text-center">
                                    افزودن به سبد
                                </a>
                                <a href="<?php the_permalink(); ?>"
                                   class="flex-1 bg-gray-200 text-center py-2 rounded-lg hover:bg-gray-300 transition">
                                    جزئیات
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else: ?>
                <p class="text-center col-span-3 animate-pulse hover:text-blue-900 transition">هیچ محصولی یافت نشد.</p>
            <?php endif;
            wp_reset_postdata(); ?>
        </div>
    </section>
    <section>
        <div class="flex justify-center items-center gap-4 mt-8 mb-12">
            <?php
            echo paginate_links([
                'total'     => $loop->max_num_pages,
                'prev_text' => 'قبلی',
                'next_text' => 'بعدی',
            ]);
            ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>

