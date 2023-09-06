import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // template css
                'resources/admin_tem/assets/vendors/mdi/css/materialdesignicons.min.css',
                'resources/admin_tem/assets/vendors/css/vendor.bundle.base.css',
                'resources/admin_tem/assets/vendors/jvectormap/jquery-jvectormap.css',
                'resources/admin_tem/assets/vendors/flag-icon-css/css/flag-icon.min.css',
                'resources/admin_tem/assets/vendors/owl-carousel-2/owl.carousel.min.css',
                'resources/admin_tem/assets/vendors/owl-carousel-2/owl.theme.default.min.css',
                'resources/admin_tem/assets/css/style.css',
                'resources/admin_tem/assets/images/favicon.png',
                // template js
                'resources/admin_tem/assets/vendors/js/vendor.bundle.base.js',
                'resources/admin_tem/assets/vendors/chart.js/Chart.min.js',
                'resources/admin_tem/assets/vendors/progressbar.js/progressbar.min.js',
                'resources/admin_tem/assets/vendors/jvectormap/jquery-jvectormap.min.js',
                'resources/admin_tem/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js',
                'resources/admin_tem/assets/vendors/owl-carousel-2/owl.carousel.min.js',
                'resources/admin_tem/assets/js/off-canvas.js',
                'resources/admin_tem/assets/js/hoverable-collapse.js',
                'resources/admin_tem/assets/js/misc.js',
                'resources/admin_tem/assets/js/settings.js',
                'resources/admin_tem/assets/js/todolist.js',
                'resources/admin_tem/assets/js/dashboard.js',
                'resources/admin_tem/assets/js/popover.js',
            ],
            refresh: true,
        }),
    ],
});
