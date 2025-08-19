<?php
get_header();

if ( file_exists( get_template_directory() . '/front-page.php' ) ) {
    include( get_template_directory() . '/front-page.php' );
} else {
    echo '<main class="max-w-7xl mx-auto px-6 mt-6"><p>هیچ محتوایی وجود ندارد.</p></main>';
}

get_footer();