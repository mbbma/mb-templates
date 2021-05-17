/*
 * Mbbma Scripts File
 * Author: MB - Bedrijfskundig Marketing Advies
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/**
 * Jquery Inview 2
 * Version: 0.1
 * Author: Matthew Frey (mmmeff)
 *    - forked from http://github.com/protonet/jquery.inview/
 */
(function ($) {
	var inviewObjects = {},
	d = document,
	w = window,
	documentElement = d.documentElement,
	expando = $.expando,
	timer,
	   // pixel count margins to wrap viewport (negative gives extra time for dom to render)
	   yMargin = -100,
	   xMargin = 0;

	   $.event.special.inview = {
		   add: function(data) {
			   inviewObjects[data.guid + "-" + this[expando]] = { data: data, $element: $(this) };

		   // Use setInterval in order to also make sure this captures elements within
		   // "overflow:scroll" elements or elements that appeared in the dom tree due to
		   // dom manipulation and reflow
		   // old: $(window).scroll(checkInView);
		   //
		   // By the way, iOS (iPad, iPhone, ...) seems to not execute, or at least delays
		   // intervals while the user scrolls. Therefore the inview event might fire a bit late there
		   // 
		   // Don't waste cycles with an interval until we get at least one element that
		   // has bound to the inview event.	
		   if (!timer && !$.isEmptyObject(inviewObjects)) {
			   timer = setInterval(checkInView, 333);
		   }
	   },

	   remove: function(data) {
		   try { delete inviewObjects[data.guid + "-" + this[expando]]; } catch(e) {}

		   // Clear interval when we no longer have any elements listening
		   if ($.isEmptyObject(inviewObjects)) {
			   clearInterval(timer);
			   timer = null;
		   }
	   }
   };

   function checkInView() {
	   // Fuck IE and its quirks, we're doing this the right way.
	   var $elements = $();

	   $.each(inviewObjects, function(i, inviewObject) {
		   var selector = inviewObject.data.selector,
		   $element = inviewObject.$element;

		   $elements = $elements.add(selector ? $element.find(selector) : $element);
	   });

	   if ($elements.length) {
		   for (var i = 0; i < $elements.length; i++) {
			   if (!$elements[i]) {
				   continue;
			   } else if (!$.contains(documentElement, $elements[i])) {
				   delete $elements[i];
				   continue;
			   }

			   var $el = $($elements[i]),
			   inView = $el.data('inview'),
			   rect = $el[0].getBoundingClientRect(),
			   height = $el.height(),
			   width = $el.width();
			   
			   if (rect.top >= (0 - height + yMargin) &&
				   rect.left >= (0 - width + xMargin) &&
				   rect.bottom <= ((w.innerHeight || documentElement.clientHeight) + height - yMargin) &&
				   rect.right <= ((w.innerWidth || documentElement.clientWidth) + width - xMargin)) {
				   if (!inView) {
					   // object has entered viewport
					   $el.data('inview', true).trigger('inview', [true]);
				   }
			   } else if (inView) {
				   // object has left viewport
				   $el.data('inview', false).trigger('inview', [false]);
			   }
		   }
	   }
   }
})(jQuery);


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/

/* skip-link-focus-fix.js */
( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && 'undefined' !== typeof( document.getElementById ) ) {
		var eventMethod = ( window.addEventListener ) ? 'addEventListener' : 'attachEvent';
		window[ eventMethod ]( 'hashchange', function() {
			var element = document.getElementById( location.hash.substring( 1 ) );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
					element.tabIndex = -1;

				element.focus();
			}
		}, false );
	}
})();


jQuery(document).ready(function($) {

	(function ($) {
		$('.menu-toggle').click(function(){
			$(this).toggleClass('active');
			$('.main-navigation ul.menu').slideToggle();
		});
		$('.sub-menu').before('<div class="submenu-toggle"></div>');
		$('.submenu-toggle').click(function(){
			$(this).siblings('.sub-menu').slideToggle();
			$(this).toggleClass('active');
		});
	})(jQuery);

	/***************************
	Smooth scrolling
	***************************/
	$('a').click(function(){
		if(/#/.test($(this).prop('href')) === true) {
			smoothScroll( $(this).attr('href'), 700 );
		}
	});

	function smoothScroll(elem, time){
		$('html, body').animate({
			scrollTop: $( elem ).offset().top
		}, time);
		return false;
	}

	/***************************
	Meescrollend menu
	***************************/
	fixedScrollMenu();

	function fixedScrollMenu(){
		var didScroll;
		var lastScrollTop = 0;
		var delta = 5;
		var navbarHeight = $('header.site-header').outerHeight();
		$(window).scroll(function(event){
			didScroll = true;
		});
		setInterval(function() {
			if (didScroll) {
				hasScrolled();
				didScroll = false;
			}
		}, 250);
		function hasScrolled() {
			var st = $(this).scrollTop();
			if (st)
			if (Math.abs(lastScrollTop - st) <= delta)
				return;

			if (st > lastScrollTop && st > navbarHeight){
				$('header.site-header').addClass('site-header-up');

			} else {
				if(st + $(window).height() < $(document).height()) { 
					$('header.site-header').removeClass('site-header-up');
				}

			}
			lastScrollTop = st;
		}
	}

	/***************************
	IOS hover fix
	***************************/
	$(document).on({
		touchstart: function() {
			$(this).addClass('hover');
		},
		touchend: function() {
			$(this).removeClass('hover');
		}
	});
	
	/***************************
	Change title when on another tab
	***************************/
	//changeTabTitle("Miss You ❤");
	
	function changeTabTitle(title){
		var pageTitle = $("title").text();
		$(window).blur(function() {
			$("title").text(title);
		});
		$(window).focus(function() {
			$("title").text(pageTitle);
		});
	}

	/***************************
	Get parameter from URL
	***************************/
	let getUrlParameter = function getUrlParameter(sParam) {
		let sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;
	
		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
	
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
	};
	// var tech = getUrlParameter('technology');

	/***************************
	Gravity forms
	***************************/
	checkForm();

	$('.ginput_container input, .ginput_container textarea').focusout(function(){
		checkForm();
	});

	function checkForm(){
		$('.ginput_container input, .ginput_container textarea').each(function() {
			if ($(this).val()) {
				$(this).parent().addClass('active');
			} else{
				$(this).parent().removeClass('active');
			}
		});
	}

	/***************************
		Ajax url Declaration
	***************************/	
	var ajaxUrl = $('.site-branding .logo a').attr('href') + 'wp-admin/admin-ajax.php';

	
	/***************************
	Pop-ups System
	***************************/
	if($('.show-popup').length){
		popupsArrays = [];
		$('.show-popup').each(function(){

			// Get pop-up names
			popupName = $(this).data('value');

			// Avoid duplication
			if(popupsArrays.indexOf(popupName) == -1){
				popupsArrays.push(popupName);
			}
		});
		// Array to string with commas
		popupNames = popupsArrays.join();

		var data = {
			'action': 'load_popups_by_ajax',
			'popups': popupNames
		};
		$.post(ajaxUrl, data, function(response) {
			if(response != '') {
				$('.popups').append(response);

				$('.popups .popup').each(function(){
					let pageURL = window.location.href;
					var pageURLArr = pageURL.split("/");
					var siteUrl = pageURLArr[0] + "//" + pageURLArr[2];
					let formAction = pageURL.replace(siteUrl, '');
					let formAnchor = $(this).find('.gform_anchor').attr('id');
					$(this).find('form').attr('action',''+formAction+'#'+formAnchor+'');
				});
			}
		});
	}

	$(document).on('click','.popup .gform_button', function(e){
		window.document.dispatchEvent(new Event("DOMContentLoaded", { bubbles: true, cancelable: true }));
	});

	/***************************
	Popup
	***************************/
	$('.show-popup').click(function(){
		let popupValue = $(this).attr('data-value');
		$('.popup[data-name="' + popupValue + '"], .popup-background').addClass('active');
		$('body').addClass('no-scroll');
		setTimeout(function(){
			$('.popup-background').addClass('show');
		}, 10);
		setTimeout(function(){
			$('.popup[data-name="' + popupValue + '"]').addClass('show');
		}, 100);
	});
	$(document).on('click', '.popup .close, .popup-background', function(){
		
		// If video popup
		var src = $('.popup.active iframe').attr("src");
		$('.popup.active iframe').attr("src", '');
		$('.popup.active iframe').attr("src", src);
		
		
		$('.popup, .popup-background').removeClass('active show');
		$('body').removeClass('no-scroll');
	});

	/***************************
	Uitklapbare footer menu's
	***************************/
	$('#zone-footer-wrapper .fold').click(function(){
		$(this).toggleClass('active');
		$('#zone-footer-wrapper .foldable[data-name="' + $(this).attr('data-value') + '"]').slideToggle();
	});

	/***************************
	FAQ
	***************************/
	$('.faq-block .question').click(function(){
		if($(this).closest('.item').hasClass('active') == false){
			$('.faq-block .item').removeClass('active');
			$('.faq-block .item .answer').slideUp();
		}
		$(this).closest('.item').toggleClass('active');
		$(this).closest('.item').find('.answer').slideToggle();
	});

	/***************************
	Viewport animaties
	***************************/
	// viewportAnimation();

	function viewportAnimation(){
		var animaties = [
			'.voorbeeldreis .block .images .image',
			'.voorbeeldreis .block .images .overlay-image',
			'#bedrijven .logo',
			'.reizen-grid .block',
			'.reizen-grid .cta-bar',
			'#werkwijze .block',
		];

		var animatiesLength = animaties.length;
		for (var i = 0; i < animatiesLength; i++) {
			$(animaties[i]).each(function(index) {
				$(this).bind('inview', function(event, isInView) {
					if (isInView) {
						var thisBlock = this;
						setTimeout(function(){
							$(thisBlock).addClass('show');
						}, index * 50);
					}
				});
			});
		}
	}

});
