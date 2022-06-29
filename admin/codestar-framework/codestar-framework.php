<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.

if (!function_exists('psyche')) {
    function psyche($option = '', $default = null)
    {
        $options = get_option('psyche_theme_options'); // Attention: Set your unique id of the framework
        return (isset($options[$option])) ? $options[$option] : $default;
    }
}

require_once plugin_dir_path( __FILE__ ) .'classes/init.class.php';
require_once plugin_dir_path( __FILE__ ) .'classes/setup.class.php';
require_once plugin_dir_path( __FILE__ ) .'options/admin-options.php';
// require_once plugin_dir_path( __FILE__ ) .'options/diy-options.php';
 require_once plugin_dir_path( __FILE__ ) .'options/metabox-options.php';
//require_once plugin_dir_path( __FILE__ ) .'options/profile-options.php';
// require_once plugin_dir_path( __FILE__ ) .'options/shortcode-options.php';
//require_once plugin_dir_path( __FILE__ ) .'options/taxonomy-options.php';
//require_once plugin_dir_path( __FILE__ ) .'options/widget-options.php';
//require_once plugin_dir_path( __FILE__ ) .'options/nav-menu-options.php';