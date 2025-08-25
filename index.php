<?php
get_header();

// چک می‌کنیم ووکامرس فعال باشه
if ( class_exists('WooCommerce') ) {
    // مستقیم قالب آرشیو محصولات رو لود می‌کنیم
    wc_get_template_part('archive', 'product');
} else {
    // اگه ووکامرس نصب نبود، محتویات معمول ایندکس نمایش داده بشه
    ?>
    <main id="main" class="site-main ">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_title('<h2>', '</h2>');
                the_content();
            }
        } else {
            echo '<p>محتوایی یافت نشد.</p>';
        }
        ?>
    </main>
    <?php
}

get_footer();
?>