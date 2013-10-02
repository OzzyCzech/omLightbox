<?php
/**
 * Plugin Name: omLightBox
 * Plugin URI: http://www.omdesign.cz
 * Description: Small responsive lightbox for Wordpress
 * Version: 2.0
 * Author: Roman Ožana
 * Author URI: http://www.omdesign.cz/kontakt
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class omSlimBox {

	/** @var string */
	public static $version = 2;
	/** @var bool */
	public static $css = true;
	/** @var bool */
	public static $js = true;
	/** @var bool */
	public static $content = true;

	public static function init() {
		return new self;
	}

	public function __construct() {
		add_action('wp_print_scripts', array(&$this, 'enqueue_scripts'));
		add_action('wp_print_styles', array(&$this, 'enqueue_styles'));
		add_filter('the_content', array(&$this, 'content'), 99);
	}

	public function enqueue_scripts() {
		if (!self::$js || is_admin()) return;
		wp_enqueue_script('omLightbox', plugins_url('lightbox/distr/nivo-lightbox.min.js', __FILE__), array('jquery'), self::$version, true);
		wp_enqueue_script('omLightboxLoad', plugins_url('load.js', __FILE__), array('omLightbox'), self::$version, true);
	}

	public function enqueue_styles() {
		if (!self::$css || is_admin() || is_feed()) return;
		wp_enqueue_style('omLightbox', plugins_url('lightbox/src/nivo-lightbox.css', __FILE__), false, self::$version);
		wp_enqueue_style('omLightboxTheme', plugins_url('lightbox/themes/default/default.css', __FILE__), false, self::$version);
	}


	public function content($content) {
		if (!self::$content) return $content;
		$pattern = "/(<a(?![^>]*?rel=['\"]lightbox.*)[^>]*?href=['\"][^'\"]+?\.(?:bmp|gif|jpg|jpeg|png)\?{0,1}\S{0,}['\"][^\>]*)>/i";
		$replacement = '$1 data-lightbox-gallery="' . (get_the_ID() ? 'gallery-' . get_the_ID() : 'gallery') . '">';
		return preg_replace($pattern, $replacement, $content);
	}
}

omSlimBox::init();