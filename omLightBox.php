<?php
/**
 * Plugin Name: omLightBox
 * Plugin URI: http://www.omdesign.cz
 * Description: Small responsive lightbox for Wordpress
 * Version: 3.0
 * Author: Roman Ožana
 * Author URI: http://www.omdesign.cz/kontakt
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class omLightBox {

	const VERSION = 3;

	/** @var bool */
	public static $css = true;

	/** @var bool */
	public static $js = true;

	public function __construct() {
		add_action('wp_print_scripts', [&$this, 'enqueue_scripts']);
		add_action('wp_print_styles', [&$this, 'enqueue_styles']);
	}

	public function enqueue_scripts() {
		if (!self::$js || is_admin()) return;
		wp_enqueue_script(
			'omLightbox', plugins_url('magnific-popup/dist/jquery.magnific-popup.min.js', __FILE__), ['jquery'],
			self::VERSION, true
		);

		wp_enqueue_script('omLightboxLoad', plugins_url('load.js', __FILE__), ['omLightbox'], self::VERSION, true);
	}

	public function enqueue_styles() {
		if (!self::$css || is_admin() || is_feed()) return;
		wp_enqueue_style(
			'omLightbox', plugins_url('magnific-popup/dist/magnific-popup.css', __FILE__), false, self::VERSION
		);
	}
}

new omLightBox;