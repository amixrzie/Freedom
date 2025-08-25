<?php
get_header();
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
get_footer();
?>
