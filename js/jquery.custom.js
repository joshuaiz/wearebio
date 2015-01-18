/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/

(function($) {
	"use strict";

	$(document).ready(function() {

		var $window = $(window),
			$html = $('html').removeClass('no-js'),
			$body = $('body');

		/* ----------------------------------------- */
		/* Isotope
		/* ----------------------------------------- */
		$(window).load(function() {
			// Isotope
			if( $.fn.isotope ) {
				if( $body.hasClass('page-template-template-portfolio-php') ) {
					var htmlFrag = '<li class="portfolio-filter"><a href="#" class="active-filter" data-portfolio-filter="">'+zillaMesh.portfolioFilterAll+'</a></li>';
					$('.portfolio-filter').parents('ul.menu').prepend(htmlFrag);
				}

				var $container = $('#portfolio-feed'),
					$filter = $('.portfolio-filter a'),
					colWidth;

				var getColWidth = function() {
					var width,
						windowWidth = $window.width();

					if( $container.length ) {
						if( windowWidth <= 400 ) {
							width = Math.floor( $container.width() );
						} else if( windowWidth <= 1080 ) {
							width = Math.floor( $container.width() / 2 );
						} else if( windowWidth <= 1480 ) {
							width = Math.floor( $container.width() / 3 );
						} else if( windowWidth <= 1880 ) {
							width = Math.floor( $container.width() / 4 );
						} else if( windowWidth <= 2280 ) {
							width = Math.floor( $container.width() / 5 );
						} else if( windowWidth <= 2680 ) {
							width = Math.floor( $container.width() / 6 );
						} else if( windowWidth <= 3080 ) {
							width = Math.floor( $container.width() / 7 );
						} else {
							width = 400;
						}
					}

					return width;
				}

				var setWidths = function(colWidth) {
					$container.children().css({ width: colWidth });
					zilla_resize_media();
				}

				colWidth = getColWidth();
				setWidths(colWidth);

				$container.isotope({
					layoutMode: 'masonry',
					masonry: {
						columnWidth: colWidth
					}
				});

				$window.smartresize(function() {
					colWidth = getColWidth();
					setWidths(colWidth);
					$container.isotope({
						masonry: {
							columnWidth: colWidth
						}
					});
				});

				if( $body.hasClass('page-template-template-portfolio-php') ) {
					$filter.click(function(e) {

						var $this = $(this),
							selector = $this.data('portfolio-filter');

						if( selector === '' ) {
							selector = "*";
						} else {
							selector = '.' + selector;
						}

						$container.isotope({ filter: selector });
						$filter.removeClass('active-filter');
						$this.addClass('active-filter');

						e.preventDefault();
						return false;
					});
				}

				if( $html.hasClass('lt-ie9') ) {
					$(window).trigger('resize');
				}
			}
		});

		/* ----------------------------------------- */
		/* Cycle
		/* ----------------------------------------- */
		if( $.fn.cycle ) {
			var $slideshows = $('.slideshow');

			$slideshows.each(function() {
				var $slideshow = $(this),
					next = $slideshow.siblings('.zilla-slide-next'),
					prev = $slideshow.siblings('.zilla-slide-prev');

				$slideshow.cycle({
					autoHeight: 0,
					fx: 'fade',
					slides: '> li',
					speed: 500,
					timeout: 0,
					next: next,
					prev: prev
				});
			});
		}

		/* --------------------------------------- */
		/* jPlayer
		/* --------------------------------------- */
		if( $.fn.jPlayer ) {
			var $jplayers = $('.jp-jplayer');

			$jplayers.each(function() {
				var $player = $(this),
					playerType = $player.data('player-type'),
					playerMedia = $player.data('media-info'),
					playerHeight = $player.data('orig-height'),
					playerWidth = $player.data('orig-width');

				if( playerType === 'video' ) {
					$player.jPlayer({
						ready: function() {
							$(this).jPlayer('setMedia', {
								poster: playerMedia.p,
								m4v: playerMedia.m,
								ogv: playerMedia.o,
							});
						},
						size: {
							width: playerWidth,
							height: playerHeight,
						},
						play: function() { // To avoid multiple jPlayers playing together.
							$(this).jPlayer("pauseOthers");
						},
						swfPath: zillaMesh.jsFolder,
						cssSelectorAncestor: playerMedia.ancestor,
						supplied: 'm4v, ogv'
					});

					// Show/Hide player controls when video playing
					$player.bind($.jPlayer.event.playing, function(e) {
						var gui = $(this).next('.jp-video').find('.jp-interface');
						$(this).add(gui).hover( function() {
							$(gui).stop().animate({ opacity: 1 }, 300);
						}, function() {
							$(gui).stop().animate({ opacity: 0}, 300);
						});
					});

					$player.bind($.jPlayer.event.pause, function(e) {
						var gui = $(this).next('.jp-video').find('.jp-interface');
						$(this).add(gui).unbind('hover');
						$(gui).stop().animate({ opacity: 1 }, 300);
					});
				} else {
					$player.jPlayer({
						ready: function() {
							$(this).jPlayer('setMedia', {
								poster: playerMedia.p,
								mp3: playerMedia.m,
								oga: playerMedia.o,
							});
						},
						size: {
							width: playerWidth,
							height: playerHeight,
						},
						play: function() { // To avoid multiple jPlayers playing together.
							$(this).jPlayer("pauseOthers");
						},
						preload: 'auto',
						swfPath: zillaMesh.jsFolder,
						cssSelectorAncestor: playerMedia.ancestor,
						supplied: 'mp3, ogg'
					});	
				}
			});
		}

		/* ------------------------------------------- */
		/* Single portfolio open/close animation
		/* ------------------------------------------- */
		$(window).load(function() {
			if( $body.hasClass('single-portfolio') ) {
				var $portfolioContent = $('#primary').find('.entry-content'),
					portfolioHeight = $portfolioContent.outerHeight(),
					$hideShow = $('#show-hide-content');

				$hideShow.on('click', function() {
					var currentHeight = $portfolioContent.outerHeight();

					if( currentHeight > 30 ) {
						$portfolioContent.animate({
							height: 30,
							paddingTop: 0,
							paddingBottom: 0
						}, 300, function() {
							$portfolioContent.toggleClass('hide-content');
							$hideShow.removeClass('rotateToOpen').addClass('rotateToClose');
							$portfolioContent.animate({
								width: 30,
								padding: 0
							}, 200);
						});
					} else {
						$portfolioContent.animate({
							width: '100%',
							paddingLeft: 50,
							paddingRight: 50
						}, 200, function() {
							$portfolioContent.animate({
								height: portfolioHeight,
								paddingBottom: 50,
								paddingTop: 40
							}, 300, function() {
								$portfolioContent.toggleClass('hide-content');
								$hideShow.addClass('rotateToOpen').removeClass('rotateToClose');
							});
						});
					}
				});
			}
		});

		/* ------------------------------------------- */
		/* Footer Animations
		/* ------------------------------------------- */
		var $footerToggle = $('#toggle-footer'),
			$footer = $('#footer'),
			$footerInner = $('#footer-inner'),
			height;

		$footerToggle.on('click', function(e) {
			e.preventDefault();

			if( $footer.hasClass('open') ) {
				$footerInner.animate({
					height: 0
				}, 400, function() {
					$footerInner.hide();
					$footer.css({
						position: 'fixed'
					}).removeClass('open');
				});
			} else {
				$footer.css({
					position: 'relative'
				}).addClass('open');

				$footer.animate({
					height: height - 30
				}, 400, function() {
					$footerInner.fadeIn(200);
					$footerInner.css({ height: 'auto' });
					$body.animate({ scrollTop: $footer.offset().top - 150 });
					$html.animate({ scrollTop: $footer.offset().top - 150 });
				});
			}
		});

		/* --------------------------------------------- */
		/* Resize Audio/Video on Resize
		/* --------------------------------------------- */
		$('#primary').fitVids();

		function zilla_resize_media() {
			var $jplayers = $('.jp-jplayer');
			
			if( $jplayers.length && $().jPlayer ) {
				var containerWidth;
			
				if( $body.hasClass('single-portfolio') ) {
					containerWidth = $('.portfolio-media').width();
				} else {
					containerWidth = $('.post-media').width();
				}
			
				$jplayers.each(function() {
					var player = $(this),
						origWidth = player.attr('data-orig-width'),
						origHeight = player.attr('data-orig-height'),
						newWidth = containerWidth,
						newHeight = Math.floor( (origHeight * newWidth) / origWidth );
			
					if( player.hasClass('jp-jplayer') ) {
						player.jPlayer('option', 'size', { width: newWidth, height: newHeight });
					}
					if( player.hasClass('embed-video') ) {
						player.width(newWidth).height(newHeight);
					}
				});
			}
		}

		// Resize the media on page load
		zilla_resize_media();


		/* --------------------------------------------- */
		/* Sexy post truncation
		/* --------------------------------------------- */
		if( $body.is('.blog, .archive, .search') ) {
			$window.load(function() {
				function truncatePosts() {
					$posts.each( function() {
						var $this = $(this),
							$content = $this.find('.entry-content'),
							postHeight = $this.outerHeight(),
							footerHeight = $this.find('.entry-meta').outerHeight(true),
							mediaHeight,
							calcHeight;

						if( $this.hasClass('format-gallery') ) {
							mediaHeight = $this.find('img:first').outerHeight() || 0;
						} else {
							mediaHeight = $this.find('.post-media').outerHeight() || 0;
						}

						calcHeight = postHeight - mediaHeight - footerHeight;

						$content
							.dotdotdot({ height: calcHeight - 44 })
							.css({ height: calcHeight });
					});
				}
				var $posts = $('.post');

				truncatePosts();

				$window.smartresize( function() {
					truncatePosts();
				});
			});
		}
	});
})(window.jQuery);


(function() {
    var root = (typeof exports === 'undefined' ? window : exports);
    var config = {
        // An option to choose a suffix for 2x images
        retinaImageSuffix : '@2x',

        // Ensure Content-Type is an image before trying to load @2x image
        // https://github.com/imulus/retinajs/pull/45)
        check_mime_type: true,

        // Resize high-resolution images to original image's pixel dimensions
        // https://github.com/imulus/retinajs/issues/8
        force_original_dimensions: true
    };

    function Retina() {}

    root.Retina = Retina;

    Retina.configure = function(options) {
        if (options === null) {
            options = {};
        }

        for (var prop in options) {
            if (options.hasOwnProperty(prop)) {
                config[prop] = options[prop];
            }
        }
    };

    Retina.init = function(context) {
        if (context === null) {
            context = root;
        }
        context.addEventListener('load', function (){
            var images = document.getElementsByTagName('img'), imagesLength = images.length, retinaImages = [], i, image;
            for (i = 0; i < imagesLength; i += 1) {
                image = images[i];

                if (!!!image.getAttributeNode('data-no-retina')) {
                    if (image.src) {
                        retinaImages.push(new RetinaImage(image));
                    }
                }
            }
        });
    };

    Retina.isRetina = function(){
        var mediaQuery = '(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)';

        if (root.devicePixelRatio > 1) {
            return true;
        }

        if (root.matchMedia && root.matchMedia(mediaQuery).matches) {
            return true;
        }

        return false;
    };


    var regexMatch = /\.[\w\?=]+$/;
    function suffixReplace (match) {
        return config.retinaImageSuffix + match;
    }

    function RetinaImagePath(path, at_2x_path) {
        this.path = path || '';
        if (typeof at_2x_path !== 'undefined' && at_2x_path !== null) {
            this.at_2x_path = at_2x_path;
            this.perform_check = false;
        } else {
            if (undefined !== document.createElement) {
                var locationObject = document.createElement('a');
                locationObject.href = this.path;
                locationObject.pathname = locationObject.pathname.replace(regexMatch, suffixReplace);
                this.at_2x_path = locationObject.href;
            } else {
                var parts = this.path.split('?');
                parts[0] = parts[0].replace(regexMatch, suffixReplace);
                this.at_2x_path = parts.join('?');
            }
            this.perform_check = true;
        }
    }

    root.RetinaImagePath = RetinaImagePath;

    RetinaImagePath.confirmed_paths = [];

    RetinaImagePath.prototype.is_external = function() {
        return !!(this.path.match(/^https?\:/i) && !this.path.match('//' + document.domain) );
    };

    RetinaImagePath.prototype.check_2x_variant = function(callback) {
        var http, that = this;
        if (!this.perform_check && typeof this.at_2x_path !== 'undefined' && this.at_2x_path !== null) {
            return callback(true);
        } else if (this.at_2x_path in RetinaImagePath.confirmed_paths) {
            return callback(true);
        } else if (this.is_external()) {
            return callback(false);
        } else {
            http = new XMLHttpRequest();
            http.open('HEAD', this.at_2x_path);
            http.onreadystatechange = function() {
                if (http.readyState !== 4) {
                    return callback(false);
                }

                if (http.status >= 200 && http.status <= 399) {
                    if (config.check_mime_type) {
                        var type = http.getResponseHeader('Content-Type');
                        if (type === null || !type.match(/^image/i)) {
                            return callback(false);
                        }
                    }

                    RetinaImagePath.confirmed_paths.push(that.at_2x_path);
                    return callback(true);
                } else {
                    return callback(false);
                }
            };
            http.send();
        }
    };

    function RetinaImage(el) {
        this.el = el;
        this.path = new RetinaImagePath(this.el.getAttribute('src'), this.el.getAttribute('data-at2x'));
        var that = this;
        this.path.check_2x_variant(function(hasVariant) {
            if (hasVariant) {
                that.swap();
            }
        });
    }

    root.RetinaImage = RetinaImage;

    RetinaImage.prototype.swap = function(path) {
        if (typeof path === 'undefined') {
            path = this.path.at_2x_path;
        }

        var that = this;
        function load() {
            if (! that.el.complete) {
                setTimeout(load, 5);
            } else {
                if (config.force_original_dimensions) {
                    if (that.el.offsetWidth == 0 && that.el.offsetHeight == 0) {
                        that.el.setAttribute('width', that.el.naturalWidth);
                        that.el.setAttribute('height', that.el.naturalHeight);
                    } else {
                        that.el.setAttribute('width', that.el.offsetWidth);
                        that.el.setAttribute('height', that.el.offsetHeight);
                    }
                }

                that.el.setAttribute('src', path);
            }
        }
        load();
    };


    if (Retina.isRetina()) {
        Retina.init(root);
    }
})();



/**
* jquery.matchHeight-min.js v0.5.2
* http://brm.io/jquery-match-height/
* License: MIT
*/
(function(c){var n=-1,f=-1,r=function(a){var b=null,d=[];c(a).each(function(){var a=c(this),k=a.offset().top-h(a.css("margin-top")),l=0<d.length?d[d.length-1]:null;null===l?d.push(a):1>=Math.floor(Math.abs(b-k))?d[d.length-1]=l.add(a):d.push(a);b=k});return d},h=function(a){return parseFloat(a)||0},p=function(a){var b={byRow:!0,remove:!1,property:"height"};if("object"===typeof a)return c.extend(b,a);"boolean"===typeof a?b.byRow=a:"remove"===a&&(b.remove=!0);return b},b=c.fn.matchHeight=function(a){a=
p(a);if(a.remove){var e=this;this.css(a.property,"");c.each(b._groups,function(a,b){b.elements=b.elements.not(e)});return this}if(1>=this.length)return this;b._groups.push({elements:this,options:a});b._apply(this,a);return this};b._groups=[];b._throttle=80;b._maintainScroll=!1;b._beforeUpdate=null;b._afterUpdate=null;b._apply=function(a,e){var d=p(e),g=c(a),k=[g],l=c(window).scrollTop(),f=c("html").outerHeight(!0),m=g.parents().filter(":hidden");m.each(function(){var a=c(this);a.data("style-cache",
a.attr("style"))});m.css("display","block");d.byRow&&(g.each(function(){var a=c(this),b="inline-block"===a.css("display")?"inline-block":"block";a.data("style-cache",a.attr("style"));a.css({display:b,"padding-top":"0","padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px"})}),k=r(g),g.each(function(){var a=c(this);a.attr("style",a.data("style-cache")||"")}));c.each(k,function(a,b){var e=c(b),f=0;d.byRow&&1>=e.length||(e.each(function(){var a=
c(this),b={display:"inline-block"===a.css("display")?"inline-block":"block"};b[d.property]="";a.css(b);a.outerHeight(!1)>f&&(f=a.outerHeight(!1));a.css("display","")}),e.each(function(){var a=c(this),b=0;"border-box"!==a.css("box-sizing")&&(b+=h(a.css("border-top-width"))+h(a.css("border-bottom-width")),b+=h(a.css("padding-top"))+h(a.css("padding-bottom")));a.css(d.property,f-b)}))});m.each(function(){var a=c(this);a.attr("style",a.data("style-cache")||null)});b._maintainScroll&&c(window).scrollTop(l/
f*c("html").outerHeight(!0));return this};b._applyDataApi=function(){var a={};c("[data-match-height], [data-mh]").each(function(){var b=c(this),d=b.attr("data-match-height")||b.attr("data-mh");a[d]=d in a?a[d].add(b):b});c.each(a,function(){this.matchHeight(!0)})};var q=function(a){b._beforeUpdate&&b._beforeUpdate(a,b._groups);c.each(b._groups,function(){b._apply(this.elements,this.options)});b._afterUpdate&&b._afterUpdate(a,b._groups)};b._update=function(a,e){if(e&&"resize"===e.type){var d=c(window).width();
if(d===n)return;n=d}a?-1===f&&(f=setTimeout(function(){q(e);f=-1},b._throttle)):q(e)};c(b._applyDataApi);c(window).bind("load",function(a){b._update(!1,a)});c(window).bind("resize orientationchange",function(a){b._update(!0,a)})})(jQuery);


jQuery(document).ready(function($){
  

 // Fix for Soliloquy carousel and retina images
      // Select carousel images
      // grab src attribute
      // strip file extension
      // add image size, @2x, then file extension (works!)
      
      jQuery(document).ready(function($){
        var $feature = $('.post-media > img');
        $feature.each(function() {
          var $this = $(this);
          var src = $(this).attr('src');
          var ext = src.substr(src.lastIndexOf('.') + 1);
          var newSrc = src.substr(0, src.lastIndexOf('.'));
          $this.attr('data-2x', newSrc + '@2x' + '.' + ext);
        })
      });

});