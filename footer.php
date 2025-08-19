<footer class="max-w-7xl mx-auto px-6 py-6 border-t mt-12 flex items-center justify-between text-gray-700 bg-gray-50">
    <div class="flex items-center space-x-3 rtl:space-x-reverse">
        <?php 
        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
            the_custom_logo();
        } else {
            ?>
            <img src="<?php echo get_template_directory_uri(); ?>/Assets/Images/HodeCode2-logo-shadowed.png"
                 alt="<?php bloginfo('name'); ?>" class="w-10 h-10 object-contain">
            <?php
        }
        ?>
    </div>

    <div class="text-center flex-1 px-6 text-sm">
        <?php echo 'کلیه حقوق این سایت برای ' . get_bloginfo('name') . ' محفوظ است'; ?>
    </div>

    <div class="flex items-center gap-4 rtl:space-x-reverse text-xl">
        <a href="#" aria-label="توییتر" class="hover:text-blue-500 transition p-1 border border-gray-700 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                <path d="M8 19c7.732 0 11.963-6.402 11.963-11.963 0-.182 0-.363-.013-.543A8.576 8.576 0 0022 5.92a8.344 8.344 0 01-2.357.646 4.112 4.112 0 001.806-2.27 8.193 8.193 0 01-2.605.995 4.104 4.104 0 00-6.993 3.74A11.642 11.642 0 013 4.74a4.093 4.093 0 001.27 5.475 4.07 4.07 0 01-1.859-.514v.052a4.105 4.105 0 003.29 4.026 4.134 4.134 0 01-1.853.07 4.108 4.108 0 003.832 2.85A8.232 8.232 0 014 17.65a11.616 11.616 0 006.29 1.843"/>
            </svg>
        </a>
        <a href="#" aria-label="لینکدین" class="hover:text-blue-700 transition p-1 border border-gray-700 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                <path d="M4.98 3.5A2.5 2.5 0 002.5 6v12a2.5 2.5 0 002.48 2.5h14.04a2.5 2.5 0 002.48-2.5V6a2.5 2.5 0 00-2.48-2.5H4.98zM8.47 17H6.42v-7.57h2.05V17zm-1.02-8.65c-.68 0-1.1-.46-1.1-1.03 0-.59.44-1.03 1.14-1.03.7 0 1.1.44 1.12 1.03 0 .57-.43 1.03-1.16 1.03zM18 17h-2.04v-4.02c0-.99-.35-1.67-1.22-1.67-.67 0-1.07.45-1.24.88-.06.15-.07.36-.07.57V17h-2.05v-7.57h2.05v1.04c.28-.44.7-1.07 1.7-1.07 1.24 0 2.17.8 2.17 2.54V17z"/>
            </svg>
        </a>
        <a href="#" aria-label="فیسبوک" class="hover:text-blue-600 transition p-1 border border-gray-700 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                <path d="M22 12a10 10 0 10-11.62 9.87v-6.98H8.07v-2.9h2.31V9.41c0-2.28 1.35-3.54 3.42-3.54.99 0 2.02.18 2.02.18v2.23h-1.14c-1.12 0-1.47.7-1.47 1.42v1.71h2.5l-.4 2.9h-2.1v6.98A10 10 0 0022 12z"/>
            </svg>
        </a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
