/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
(function ($) {

	// translate to Czech

	$.extend(true, $.magnificPopup.defaults, {
		tClose: 'Zavřít (Esc)',
		tLoading: 'Načítám...',
		gallery: {
			tPrev: 'Předchozí',
			tNext: 'Další',
			tCounter: '%curr% z %total%'
		},
		image: {
			tError: '<a href="%url%">Obrázek</a> není možné nahrát.'
		},
		ajax: {
			tError: '<a href="%url%">The content</a> could not be loaded.'
		}
	});

	$(document).ready(function () {

		// single images

		$('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').each(function () {
			if ($(this).parents('.gallery').length == 0) {
				$(this).magnificPopup({
					type: 'image',
					callbacks: {
						open: function () {
							$('.mfp-description').append(this.currItem.el.attr('alt'));
						},
						afterChange: function () {
							$('.mfp-description').empty().append(this.currItem.el.attr('alt'));
						}
					},
					image: {
						titleSrc: function (item) {
							return item.el.find('img').attr('alt');
						}
					}
				});
			}
		});


		// galleries

		$('.gallery').each(function () {
			$(this).magnificPopup({
				delegate: 'a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]',
				type: 'image',

				callbacks: {
					open: function () {
						$('.mfp-description').append(this.currItem.el.attr('alt'));
					},
					afterChange: function () {
						$('.mfp-description').empty().append(this.currItem.el.attr('alt'));
					}
				},

				gallery: {
					enabled: true
				},

				image: {
					titleSrc: function (item) {
						return item.el.find('img').attr('alt');
					}
				}
			});
		});
	});

})(jQuery);


