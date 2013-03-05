/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
 (function ($) {

 	if (!/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)) {

 		$('.wp-caption').each(function () {
 			if (!$('a', this).attr('title')) {
 				var caption = $('p.wp-caption-text', this).text();
 				$('a', this).attr('title', caption);
 			}
 		}
 		);
 		var options = {
 			counterText: 'Obrázek {x} z {y}',
 			captionAnimationDuration: 150,
 			overlayFadeDuration: 150,
 			imageFadeDuration: 150,
 			resizeDuration: 150
 		};
 		
 		$("a[rel^='lightbox']").slimbox(options, null, function (el) {
 			return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
 		});
 	}
 })(jQuery);