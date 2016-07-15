<?php
/**
 * Plugin Name: omLightBox
 * Plugin URI: http://www.omdesign.cz
 * Description: Small responsive lightbox for Wordpress
 * Version: 4.0
 * Author: Roman Ožana
 * Author URI: http://www.omdesign.cz/kontakt
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */

namespace omLightbox {

	function print_styles() {
		if (!is_admin() && !is_feed()) {
			wp_enqueue_style('omLightbox', plugins_url('dist/omLightbox.css', __FILE__), false, null);
		}
	}

	function print_scripts() {
		if (!is_admin()) {
			wp_enqueue_script('omLightboxLoad', plugins_url('dist/omLightbox.min.js', __FILE__), ['jquery'], null, true);
		}
	}

	add_action('wp_print_scripts', __NAMESPACE__ . '\print_scripts');
	add_action('wp_print_styles', __NAMESPACE__ . '\print_styles');
}



