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
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


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


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

	/*
		* Let's fire off the gravatar function
		* You can remove this if you don't need it
	*/
	loadGravatars();

	(function ($) {
		$(document).ready(function() {
		$("body").css("display", "none");
		$("body").fadeIn(600);
		});
	})(jQuery);

	(function ($) {
		$('.menu-toggle').click(function(){
			$(this).toggleClass('menu-toggle-active');
			$('.main-navigation ul.menu').slideToggle();
		});
		$('.sub-menu').before('<a href="#" class="submenu-toggle"><i class="fa fa-angle-down" aria-hidden="true"></i></a>');
		$('.submenu-toggle').click(function(){
			$(this).siblings('.sub-menu').slideToggle();
		});
	})(jQuery);

	/* Smooth scrolling */
	$('a').click(function(){
	    $('html, body').animate({
	        scrollTop: $( $(this).attr('href') ).offset().top
	    }, 700);
	    return false;
	});

	// Contact form check icons
	$('.wpcf7-form-control-wrap input, .wpcf7-form-control-wrap textarea').focusout(function(){
		if ($(this).val()) {
			$(this).parent().addClass('active');
		} else{
			$(this).parent().removeClass('active');
		}
	});


	// Contact form redirect
	// https://contactform7.com/dom-events/
	// http://vincoding.com/passing-contact-form-7-data-thank-page/
	// Deze code is gemaakt voor meerdere formulier met textuele input velden en optioneel één textarea

	var forms = [];
	var formSelector = [];
	$('.wpcf7').each(function(){
		forms.push('#' + $(this).attr('id'));
		formSelector.push(document.querySelector('#' + $(this).attr('id')));
	});

	if ($('.wpcf7').length) {
		for (var j = 0; j <= forms.length - 1; j++) {
			formSelector[j].addEventListener( 'wpcf7mailsent', function(event) {
				var inputNames = [];
				var inputValues = [];
				var url = $('.logo a').attr('href') + 'contact/bedankt/?';

				$(this).find('input.wpcf7-form-control').each(function(){ //De variabelen in arrays plaatsen
					if ($(this).hasClass('wpcf7-submit') == false) {
						inputNames.push($(this).attr('placeholder'));
						inputValues.push($(this).val());
					}
				});

				for (var i = 0; i <= inputNames.length - 1; i++) { //Voor elk input veld worden de variabelen in de URL geplaatst
					url += inputNames[i] + '=' + inputValues[i] + '&';
				};

				if ($(this).find('textarea').length) { //Als er een textarea bestaat wordt deze ook toegevoegd
					url += $(this).find('textarea').attr('placeholder') + '=' + $(this).find('textarea').val() + '&';
				}

				location = url;

			}, false );
		};
	}

}); /* end of as page load scripts */