/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
(function ($) {
	$('.wp-caption').each(function () {
				if (!$('a', this).attr('title')) {
					var caption = $('p.wp-caption-text', this).text();
					$('a', this).attr('title', caption);
				}
			}
	);

	$("a[data-lightbox-gallery]").nivoLightbox();
})(jQuery);