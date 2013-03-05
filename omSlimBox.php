<?php
/**
 * Plugin Name: omSlimBox
 * Plugin URI: http://www.omdesign.cz
 * Description: SlimBox2 for Wordpress
 * Version: 1.0
 * Author: Roman Ožana
 * Author URI: http://www.omdesign.cz/kontakt
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class omSlimBox {

	/** @var string */
	public static $version = '2';
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
		if (self::$js) {
			add_action('wp_print_scripts', array(&$this, 'enqueue_scripts'));
		}

		if (self::$css) {
			add_action('wp_print_styles', array(&$this, 'enqueue_styles'));
		}

		if (self::$content) {
			add_filter('the_content', array(&$this, 'content'), 99);
		}
	}

	public function enqueue_scripts() {
		if (is_admin()) return;
		wp_enqueue_script(
			'wp-slimbox', plugins_url('slimbox/js/slimbox2.js', __FILE__), array('jquery'), self::$version, true
		);
	}

	public function enqueue_styles() {
		if (is_admin() || is_feed()) return;
		wp_enqueue_style('wp-slimbox', plugins_url('slimbox/css/slimbox2.css', __FILE__), false, self::$version);
	}


	public function content($content) {
		$pattern = "/(<a(?![^>]*?rel=['\"]lightbox.*)[^>]*?href=['\"][^'\"]+?\.(?:bmp|gif|jpg|jpeg|png)\?{0,1}\S{0,}['\"][^\>]*)>/i";
		$replacement = '$1 rel="' . (get_the_ID() ? 'lightbox-' . get_the_ID() : 'lightbox') . '">';
		return preg_replace($pattern, $replacement, $content);
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	public static function options($name) {
		return self::$options[$name];
	}
}

omSlimBox::init();