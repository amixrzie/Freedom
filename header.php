<!doctype html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php bloginfo('name'); ?> <?php wp_title('|'); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/Assets/Images/HodeCode2-logo-shadowed.png">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-gray-50'); ?>>
<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col sm:flex-row justify-between items-center py-4 gap-y-4 sm:gap-y-0">
            <div class="flex items-center gap-x-6 flex-1 justify-start">
                <div class="text-xl font-bold ">
                    <a href="<?php echo home_url(); ?>">
                        <?php 
                        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                            the_custom_logo();
                        } else {
                            ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/Assets/Images/HodeCode2-logo-shadowed.png"
                                 alt="<?php bloginfo('name'); ?>" class="h-10 w-auto">
                            <?php
                        }
                        ?>
                    </a>
                </div>

                <nav class="flex items-center gap-x-4">
                    <a href="<?php echo home_url(); ?>" class="text-gray-700 hover:text-blue-500">خانه</a>
                    <a href="<?php echo get_post_type_archive_link('products'); ?>" class="text-gray-700 hover:text-blue-500">محصولات</a>
                </nav>
            </div>

            <div class="flex items-center gap-x-6 flex-1 justify-end">
                <a href="<?php echo site_url('/contact-us'); ?>" class="text-gray-700 hover:text-blue-500">ارتباط با ما</a>
                <a href="#" class="text-gray-700 hover:text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>
