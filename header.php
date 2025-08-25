<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class("bg-gray-100"); ?>>
    <header class="bg-white py-3 border-b border-gray-200">
        <div class="max-w-screen-lg mx-auto flex gap-4 items-center">
            <?php if (function_exists("the_custom_logo")) {
                the_custom_logo();
            } ?>
            <?php wp_nav_menu([
                "theme_location" => 'Header',
                "menu_class" => "main-nav flex grow gap-3",
                "container" => false
            ]);
            ?>
            <div>
                <?php
                $count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
                ?>
                <a href="<?php echo wc_get_cart_url(); ?>" class="relative inline-flex items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19" stroke="#47505D" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" stroke="#47505D" stroke-width="1.5" />
                        <path d="M16.5 18C17.3284 18 18 18.6715 18 19.5C18 20.3284 17.3284 21 16.5 21C15.6716 21 15 20.3284 15 19.5C15 18.6715 15.6716 18 16.5 18Z" stroke="#47505D" stroke-width="1.5" />
                        <path d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5" stroke="#47505D" stroke-width="1.5" />
                    </svg>

                    <!-- Badge -->
                    <?php if ($count > 0): ?>
                        <span class="absolute -top-2 -right-2 inline-flex items-center justify-center 
                     p-[3px] text-xs leading-none text-white 
                     bg-red-600 rounded-full aspect-square">
                            <?php echo esc_html($count); ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

    </header>