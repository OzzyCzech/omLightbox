<?php
/**
 * Plugin Name: omLightBox
 * Plugin URI: https://ozana.cz
 * Description: Small responsive lightbox for Wordpress
 * Version: 5.0
 * Author: Roman Ožana
 * Author URI: https://ozana.cz/
 *
 * @author Roman Ozana <roman@ozana.cz>
 */

namespace omLightbox;

add_action(
	'wp_print_scripts',
	function () {
		if (!is_admin()) {
			wp_enqueue_script('omLightboxLoad', plugins_url('dist/omLightbox.min.js', __FILE__), ['jquery'], null, true);
		}
	}
);

add_action(
	'wp_print_styles',
	function () {
		if (!is_admin() && !is_feed()) {
			wp_enqueue_style('omLightbox', plugins_url('dist/omLightbox.css', __FILE__), false, null);
		}
	}
);

