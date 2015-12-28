/*
 * Bones Scripts File
 * Author: Eddie Machado
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

var vfb = {};

vfb.map = jQuery('#vmap');

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

var activeCallback = jQuery.Callbacks();

vfb.loadFonts = function () {
  WebFont.load({
    google: {
      families: [
      'Open Sans:400,800',
      'Open Sans Condensed:300,700',
      'Lobster']
    },
    active: function () { activeCallback.fire(); },
    inactive: function () { activeCallback.fire(); },
    timeout: 2000
  });
};


// Choose state handler
vfb.chooseState = function (stateCode) {
  var $states = jQuery('.states'),
    $state = $states.find('.' + stateCode),
    $mapState = jQuery('#jqvmap1_' + stateCode),
    $newsletter = jQuery('.sign-up-notice').eq(0);

  $states.find('.active').removeClass('active');
  $state.addClass('active');

  if (history && history.replaceState) {
    history.replaceState({}, '', '#' + stateCode);
  }

  $mapState.velocity('callout.bounce', { complete: function () {
    $newsletter.appendTo($state).find('select').val($state.find('h3').text());
    jQuery('html, body').animate({ scrollTop: $state.offset().top - 100 }, 1000);
  }});

};

vfb.trackEvent = function () {
  var args, params, i;

  try {
    args = arguments;

    if(args.length < 2 || args.length > 4) {
      console.debug('trackEvent(category, action) [' + Array.prototype.slice.call(arguments).toString() + ']');
      return false;
    }

    ga('send', 'event', args[0], args[1]);
    return false;

  } catch(e) {
    console.error('GA Error: ' + e);
  }
};

vfb.trackElements = function () {
  jQuery('[data-track]').on('click', function () {
    var $trackingData = jQuery(this).data('track').split(',');

    vfb.trackEvent.apply(null, $trackingData);
  });
};

vfb.resizeMap = function () {
  viewport = updateViewportDimensions();

  if (viewport.width > 460) {
    vfb.map.height(viewport.height - vfb.map.offset().top - 10);
  }
};

if (vfb.map.length) {
  jQuery(window).resize(function () {
    waitForFinalEvent(function(){
      vfb.resizeMap();
    }, timeToWaitForLast, "VFBMap");
  });
}

var $top = jQuery('.to-map');

vfb.backToTop = function () {
  var trigger = 400,
    scrollTop = document.body.scrollTop;

  if (scrollTop > trigger) {
    $top.addClass('show');
  } else {
    $top.removeClass('show');
  }
};

if ($top.length) {
  jQuery(window).scroll(function () {
    waitForFinalEvent(function(){
      vfb.backToTop();
    }, timeToWaitForLast, "VFBTop");
  });

  $top.on('click', function (event) {
    event.preventDefault();

    jQuery('html, body').animate({ scrollTop: 0 }, 500);
  });
}


vfb.buildMap = function () {
 // Build map if available

  if (vfb.map.length) {
    vfb.resizeMap();

    var open = '#0571b0',
    closed = '#ca0020',
    other = '#f4a582',
    caucusOpen = '#92c5de',
    caucusClosed = '#B94F4F',
    $states = jQuery('.states');

    vfb.map.vectorMap({
        map: 'usa_en',
        backgroundColor: null,
        borderColor: '#fff',
        color: '#323944',
        // colors: colors,
        hoverColor: '#c9dfaf',
        selectedColor: '#c9dfaf',
        hoverOpacity: 0.5,
        enableZoom: false,
        showTooltip: true,
        selectedRegion: null,
        onLabelShow: function (element, label, code) {
          var $stateDetails = $states.find('.' + code),
            primaryTextSource = $stateDetails.find('strong').eq(0).text(),
            primaryText = primaryTextSource.charAt(0).toUpperCase() + primaryTextSource.slice(1),
            labelText;

          if ($stateDetails.length) {
            labelText = primaryText + ($stateDetails.hasClass('caucus') ? ' Caucus' : ' Primary');
          } else {
            labelText = 'To Be Announced';
          }

          jQuery(label).html('<strong>' + jQuery(label).text() + '</strong><br>' + labelText );
        },
        onRegionOver: function (event, code) {
          var $stateDetails = $states.find('.' + code),
            type = $stateDetails.data('type');

          if ($stateDetails.length) {
            // Fade out other legend items
            jQuery('.legend').find('li').not('.' + type).velocity({ opacity: 0.3 }, { queue: false });

            // Switch explanation
            vfb.explain(jQuery('.legend').find('.' + type));
          }
        },
        onRegionOut: function (event, code) {
          var $stateDetails = $states.find('.' + code),
            type = $stateDetails.data('type');

          jQuery('.legend').find('li').not('.' + type).velocity({ opacity: 1 }, { queue: false });
        },
        onRegionClick: function (element, code, region) {
          vfb.trackEvent('State click', code);
          vfb.chooseState(code);
        }
    });

    // vfb.map.css('opacity', 1);
    // A/B Test - No animation, subtle animation (15 delay, slideDownIn entrance) and heavy (20 delay and )
    // vfb.map.velocity('transition.flipBounceXIn');
    // vfb.map.velocity('transition.perspectiveRightIn');
    // vfb.map.velocity('transition.slideDownBigIn');
    // vfb.map.velocity('transition.slideDownIn');
    // vfb.map.velocity('transition.bounceIn');

    jQuery('.legend').find('li').velocity('transition.slideLeftIn', { delay: 500, stagger: 100, display: 'inline-block', opacity: 1 } );
    jQuery('.inner-content').eq(0).velocity('transition.slideDownIn', { delay: 1000, opacity: 1 });
    vfb.map.find('.jqvmap-region').velocity('transition.perspectiveDownIn', { opacity: 1 });

    // vfb.map.velocity({}, { duration: 500 })
    //   .velocity({scaleX: 1, scaleY: 1}, { duration: 1000 });


    // Animate in map colors
    var delay = 0;
    var $stateList = $states.find('.state');

    $stateList.each(function (i) {
      var $state = jQuery(this),
        stateCode = $state.data('code'),
        $stateOnMap = jQuery('#jqvmap1_' + stateCode);

      if ($stateOnMap.length) {
        setTimeout(function () {
          if ($state.hasClass('open')) {
            $stateOnMap.velocity({ fill: open });
          } else if ($state.hasClass('closed')) {
            $stateOnMap.velocity({fill: closed});
          } else if ($state.hasClass('other') || $state.hasClass('other-caucus')) {
            $stateOnMap.velocity({fill: other});
          } else if ($state.hasClass('open-caucus')) {
            $stateOnMap.velocity({fill: caucusOpen});
          } else if ($state.hasClass('closed-caucus')) {
            $stateOnMap.velocity({fill: caucusClosed});
          }

          if (i === $stateList.length - 1) {
            // Animations Complete
            setTimeout(function () {
              vfb.scrollOnHash();
            }, 1000);

          }
        }, delay);
        delay += 15;
      }
    });

  }
};

vfb.enhanceSharing = function () {

  viewport = updateViewportDimensions();

  if (viewport.width < 767) {
    jQuery('.fb-like').detach().appendTo('#crestashareicon');
  }

  jQuery('.fb-like').velocity('transition.slideDownBigIn', { stagger: 0, opacity: 1 });
  var $floatShareWrapper = jQuery('#crestashareicon'),
  $contentShareWrappers = jQuery('.cresta-share-icon').not($floatShareWrapper);

  addCounter = function ($parent, count) {
    $parent.append('<span class="cresta-the-count">' + count + '</span>');
  };

  findCounter = function (site) {
    if (!$floatShareWrapper.find('#' + site + '-count').text()) {
      return setTimeout(function () { findCounter(site) }, 100);
    } else {
      addCounter($contentShareWrappers.find('.' + site + '-cresta-share'), $floatShareWrapper.find('#' + site + '-count').text());
    }
  };

  if ($floatShareWrapper.length && $contentShareWrappers.length) {

    findCounter('facebook');
    findCounter('twitter');
    findCounter('googleplus');
  }
};

vfb.explain = function (legendItem) {
  var $this = jQuery(legendItem),
    $explanations = jQuery('.explanations').find('li'),
    $activeExplanation = $explanations.siblings('.active'),
    $explanation = $explanations.siblings('.' + $this.data('type'));

  if ($activeExplanation[0]  !== $explanation[0]) {
    $activeExplanation.removeClass('active');
    $explanation.addClass('active');
  }
};

vfb.handleNavToggle = function () {
  var $toggleButton = jQuery('.nav-toggle'),
    $nav = jQuery('.nav');

  $toggleButton.on('click', function (event) {
    event.preventDefault();

    $nav.toggleClass('expanded');
  });
};

vfb.handleLegend = function () {
  var $legend = jQuery('.legend');

  if ($legend.length) {
    $legend.on('mouseover click', 'li', function () {
      vfb.explain(jQuery(this));
    });
  }
};

vfb.handleStateSelector = function () {
  var $stateSelector = jQuery('.state-selector');

  $stateSelector.on('change', function () {
    var code = $stateSelector.val();
    vfb.trackEvent('State select', code);
    vfb.chooseState(code);
  });
};

vfb.scrollOnHash = function () {
  var code = location.hash ? location.hash.substr(1) : null;

  if (code && jQuery('#state-' + code).length) {
    vfb.trackEvent('State hash', code);
    vfb.chooseState(code);
  }
};

// Replace all img.svg with inline SVG, allowing CSS styling
vfb.handleSVG = function () {
  jQuery('img.svg').each(function(){
    var $img = jQuery(this),
      imgID = $img.attr('id'),
      imgClass = $img.attr('class'),
      imgURL = $img.data('src');

    jQuery.get(imgURL, function(data) {
    // Get the SVG tag
    var $svg = jQuery(data).find('svg');

    // Add replace image ID to the new SVG
    if(typeof imgID !== 'undefined') {
    $svg = $svg.attr('id', imgID);
    }
    // Add replaced image classes to the new SVG
    if(typeof imgClass !== 'undefined') {
    $svg = $svg.attr('class', imgClass+' replaced-svg');
    }

    // Remove any invalid XML tags as per http://validator.w3.org
    $svg = $svg.removeAttr('xmlns:a');

    // Replace image with new SVG
    $img.replaceWith($svg);

    }, 'xml');

  });
};

vfb.stateInit = function () {
  var $statePage = jQuery('.state-page');

  if ($statePage.length) {
    var $newsletter = jQuery('.newsletter'),
      $submitCorrectionBtn = jQuery('.correction-btn'),
      $correction = jQuery('.submit-correction'),
      $correctionForm = jQuery('.updated').find('.wpcf7');

    $newsletter.find('select').val($statePage.data('state'));
    $correction.find('input[name="state"]').val($statePage.data('state'));

    $submitCorrectionBtn.on('click', function (event) {
      event.preventDefault();

      jQuery(this).parent().hide();
      $correctionForm.fadeIn();
    });

  }
};

/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  loadGravatars();

  vfb.loadFonts();

  vfb.handleNavToggle();

  vfb.handleLegend();

  vfb.handleSVG();

  vfb.handleStateSelector();

  vfb.stateInit();

  vfb.trackElements();

  activeCallback.add(function () {

    jQuery('.slab').bigtext();

    jQuery('.init').removeClass('init').addClass('done');

    vfb.buildMap();

    setTimeout(function () {
      vfb.enhanceSharing();
    }, 1000);
  });


}); /* end of as page load scripts */
