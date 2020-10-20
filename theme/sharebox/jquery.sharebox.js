(function($) {
	"use strict";

	// Plugin name
	var name = "sharebox";

	// jQuery plugin
	var Self = function(options) {
		var	Defaults = Self.defaults,
			Services = Self.services;

		this.each(function() {
			var	$this = $(this),
				attrs = {
					url      : $this.data("url"),
					title    : $this.data("title"),
					services : $this.data("services")
				},
				settings = $.extend({}, Defaults, attrs, options),
				services = settings.services.match(/\S+/g);

			// Container
			var $ul = $this.find("ul.sharebox-buttons");
			if (! $ul.length)
				$ul = $("<ul></ul>").addClass("sharebox-buttons").appendTo($this);

			// Buttons
			$.each(services, function(i, name) {
				name = name.replace("google+", "google-plus");

				var Service = Services[name];
				if (! Service) return;

				// li
				var $li = $ul.find("li.share-"+name);
				if (! $li.length)
					$li = $("<li></li>").addClass("share-"+name).appendTo($ul);

				// a
				$li.append(
					$("<a></a>")
						.attr({
							href  : ($.isFunction(Service.url) ? Service.url(settings) : Service.url),
							title : (Service.label || name)
						})
						.data({
							width  : Service.width,
							height : Service.height
						})
						.click(function() {
							return Service.click.call(this, settings);
						})
						.append(
							$("<span></span>")
								.text(Service.label || name)
						)
				);
			});
		});

		return this;
	};

	// Autoinit `.sharebox` elements
	$(document).ready(function() {
		$(".sharebox").sharebox();
	});

	Self.popup = function(options) {
		var $this  = $(this),
			url    = $this.attr("href"),
			width  = $this.data("width") || 400,
			height = $this.data("height") || 300;

		window.open(url, "share",
				"menubar=no,status=no,resizable=yes,menubar=no,width={WIDTH},height={HEIGHT}"
					.replace("{WIDTH}", width)
					.replace("{HEIGHT}", height)
			);

		return false;
	};

	// Defaults options
	Self.defaults = {
		url      : document.location.href,
		title    : $(document).attr("title"),
		services : "facebook twitter google+"
	};

	// Services
	Self.services = {
		facebook: {
			label  : "Facebook",
			width  : 500,
			height : 300,
			url    : function(options) {
				return "https://www.facebook.com/sharer/sharer.php?u={URL}&t={TITLE}"
					.replace("{URL}", encodeURIComponent(options.url))
					.replace("{TITLE}", encodeURIComponent(options.title));
			},
			click  : Self.popup
		},
		instagram: {
			label : "Instagram",
			width  : 500,
			height : 460,
			url    : function(options) {
				return "https://instagram.com/?url={URL}"
					.replace("{URL}", encodeURIComponent(options.url));
			},
			click  : Self.popup
		},
		linkedin: {
			label  : "LinkedIn",
			width  : 500,
			height : 400,
			url    : function(options) {
				return "https://www.linkedin.com/shareArticle?mini=true&url={URL}&title={TITLE}&summary=&source="
					.replace("{URL}", encodeURIComponent(options.url))
					.replace("{TITLE}", encodeURIComponent(options.title));
			},
			click  : Self.popup
		},
		pinterest: {
			label  : "Pinterest",
			width  : 500,
			height : 300,
			url    : function(options) {
				return "https://pinterest.com/pin/create/link/?url={URL}&description={TITLE}"
					.replace("{URL}", encodeURIComponent(options.url))
					.replace("{TITLE}", encodeURIComponent(options.title));
			},
			click  : Self.popup
		},
		twitter: {
			label  : "Twitter",
			width  : 500,
			height : 300,
			url    : function(options) {
				return "https://twitter.com/intent/tweet?url={URL}&text={TITLE}"
					.replace("{URL}", encodeURIComponent(options.url))
					.replace("{TITLE}", encodeURIComponent(options.title));
			},
			click  : Self.popup
		},
	};

	$.fn[name] = Self;

})(jQuery);