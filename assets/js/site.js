/*
 * Bones Scripts File
 * Author: Jon Hughes
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

  var scrollToState = function () {
    if ($state.is('tr')) {
      $newsletter.insertAfter($state).wrap('<tr><td colspan="4"></td></tr>').find('select').val($state.find('.name').find('span').text());
    } else {
      $newsletter.appendTo($state).find('select').val($state.find('h3').text());
    }
    jQuery('html, body').animate({ scrollTop: $state.offset().top - 100 }, 1000);
  }

  if ($mapState.length) {
    $mapState.velocity('callout.bounce', { complete: function () {
      scrollToState();
    }});
  } else {
    scrollToState();
  }

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

  if (viewport.width > 460 && viewport.height > 635) {
    vfb.map.height(viewport.height - vfb.map.offset().top - 10);
  } else {
    vfb.map.height(400);
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

 var $primaryMap = jQuery('.primary-map');

  if ($primaryMap.length) {
    vfb.resizeMap();

    var open = '#0571b0',
    closed = '#ca0020',
    other = '#f4a582',
    caucusOpen = '#92c5de',
    caucusClosed = '#B94F4F',
    $states = jQuery('.states');

    $primaryMap.vectorMap({
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
            labelText += '<br>' + $stateDetails.find('.resources').find('p').eq(0).html();
            labelText += '<br>' + $stateDetails.find('.exp').html();
          } else {
            labelText = 'To Be Announced';
          }

          jQuery(label).html('<strong>' + jQuery(label).text() + '</strong><br>' + labelText);
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
    jQuery('.vfb-like').detach().appendTo('#crestashareicon');
  }

  jQuery('.vfb-like').velocity('transition.slideDownBigIn', { stagger: 0, opacity: 1 });
  var $allContentShareWrappers = jQuery('.cresta-share-icon'),
  $floatShareWrapper = jQuery('#crestashareicon'),
  $contentShareWrappers = $allContentShareWrappers.not($floatShareWrapper);

  addCounter = function ($parent, count) {
    $parent.append('<span class="cresta-the-count">' + count + '</span>');
  };

  findCounter = function (site) {
    if (!$floatShareWrapper.find('#' + site + '-count').text()) {
      return setTimeout(function () { findCounter(site); }, 100);
    } else {
      addCounter($contentShareWrappers.find('.' + site + '-cresta-share'), $floatShareWrapper.find('#' + site + '-count').text());
    }
  };

  if ($floatShareWrapper.length && $contentShareWrappers.length) {

    findCounter('facebook');
    findCounter('twitter');
    findCounter('googleplus');
  }

  // Track social shares
  $allContentShareWrappers.on('click', '.sbutton', function (event) {
    var type = jQuery(this).get(0).id.split('-')[0],
      source = jQuery('.state-page').length ? jQuery('.state-page').data('stateCode') : window.location.pathname;

    vfb.trackEvent(type + 'Share', source);
  });
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
    $legend.find('li').velocity('transition.slideLeftIn', { delay: 500, stagger: 100, display: 'inline-block', opacity: 1 } );

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

vfb.scheduleInit = function () {
  var $scheduleMap = jQuery('.schedule-map'),
    $states = jQuery('.states');

  if ($scheduleMap.length) {
    vfb.resizeMap();

    $scheduleMap.vectorMap({
      map: 'usa_en',
      backgroundColor: null,
      borderColor: '#fff',
      color: '#323944',
      hoverColor: '#c9dfaf',
      selectedColor: '#c9dfaf',
      hoverOpacity: 0.5,
      enableZoom: false,
      showTooltip: true,
      selectedRegion: null,
      onLabelShow: function (element, label, code) {
        var $stateDetails = $states.find('.' + code),
          labelText;

        if ($stateDetails.length) {
          labelText = 'Primary/Caucus Date: <strong>' + $stateDetails.find('.prim').find('span').eq(0).text()  + '</strong><br>';
          labelText += 'Registration Deadline: <strong>' + $stateDetails.find('.reg').find('span').eq(0).text() + '</strong><br>';
          if ($stateDetails.find('.aff').find('span').text().length) {
            labelText += 'Affiliation Deadline: <strong>' + $stateDetails.find('.aff').find('span').eq(0).text() + '</strong>';
          }
        } else {
          labelText = 'To Be Announced';
        }

        jQuery(label).html('<strong>' + jQuery(label).text() + '</strong><br>' + labelText);
      },
      onRegionClick: function (element, code, region) {
        vfb.trackEvent('Schedule State click', code);
        vfb.chooseState(code);
      }
    });

    vfb.map.find('.jqvmap-region').velocity('transition.perspectiveDownIn', { opacity: 1 });

    // Animate in map colors
    var delay = 0;
    var $stateList = $states.find('.state-data');


    $stateList.each(function (i) {
      var $state = jQuery(this),
        stateCode = $state.data('code'),
        $stateOnMap = jQuery('#jqvmap1_' + stateCode),
        $daysAway = $state.find('.prim').data('text');


      if ($stateOnMap.length) {
        setTimeout(function () {
          if ($daysAway < 0) {
            $stateOnMap.velocity({ fill: '#f4a582' });
          } else if ($daysAway < 7) {
            $stateOnMap.velocity({ fill: '#ca0020' });
          } else if ($daysAway < 14) {
            $stateOnMap.velocity({ fill: '#B94F4F' });
          } else if ($daysAway < 30) {
            $stateOnMap.velocity({ fill: '#0571b0' });
          } else {
            $stateOnMap.velocity({ fill: '#92c5de' });
          }

          if (i === $stateList.length - 1) {

          }
        }, delay);
        delay += 15;
      }
    });
  }

};

vfb.formatDaysAway = function (daysAway) {

  var daysAwayText;
  console.log(daysAway);

  if (daysAway !== '') {
    daysAway = parseInt(daysAway, 10);

    if (daysAway < 0) {
      daysAwayText = 'has already passed';
    } else if (daysAway === 0) {
      daysAwayText = 'is <strong>today</strong>!';
    } else if (daysAway === 1) {
      daysAwayText = 'is <strong>tomorrow</strong>!';
    } else {
      daysAwayText = 'in ' + daysAway + ' days';
    }
  }

  return daysAwayText;
};

vfb.gotvInit = function () {
  var $gotvMap = jQuery('.gotv-map'),
    $states = jQuery('.states');

  if ($gotvMap.length) {
    vfb.resizeMap();

    $gotvMap.vectorMap({
      map: 'usa_en',
      backgroundColor: null,
      borderColor: '#fff',
      color: '#0571b0',
      hoverColor: '#c9dfaf',
      selectedColor: '#c9dfaf',
      hoverOpacity: 0.5,
      enableZoom: false,
      showTooltip: true,
      selectedRegion: null,
      onLabelShow: function (element, label, code) {
        var stateData = statesData[code],
          $stateOnMap = jQuery('#jqvmap1_' + code),
          labelText;

        labelText = 'Voting ' + vfb.formatDaysAway(stateData.primaryDaysAway) + '<br>';

        if (stateData.registerDaysAway && stateData.primaryDaysAway >= 0) {
          labelText += 'Registration Deadline ' + vfb.formatDaysAway(stateData.registerDaysAway) + '</strong><br>';
        }

        console.log('$stateOnMap', $stateOnMap);
        if ($stateOnMap.data('type') === 'phonebank') {
          labelText += '<br>Phonebank!';
        } else {
          labelText += '<br>Canvass!';
        }

        jQuery(label).html('<strong>' + jQuery(label).text() + '</strong><br>' + labelText);
      },
      onRegionClick: function (element, code, region) {
        var $stateOnMap = jQuery('#jqvmap1_' + code);
        vfb.trackEvent('GOTV State click', code);


        jQuery('html, body').animate({ scrollTop: jQuery('.' + $stateOnMap.data('type')).offset().top - 100 }, 1000);
      }
    });

    vfb.map.find('.jqvmap-region').velocity('transition.perspectiveDownIn', { opacity: 1 });

    // Animate in map colors
    var delay = 0,
      canvassColor = '#ca0020',
      pbColor = '#0571b0';

    for (var stateCode in statesData) {
      // console.log(stateCode, statesData[stateCode]);

      var $stateOnMap = jQuery('#jqvmap1_' + stateCode),
        stateData = statesData[stateCode],
        canvass = false;

      if ((stateData.primaryDaysAway >= 0 && stateData.primaryDaysAway < 10) || stateData.registerDaysAway && stateData.registerDaysAway >= 0 && stateData.registerDaysAway < 10) {
        canvass = true;
      }

      if ($stateOnMap.length) {
        if (!canvass) {
          $stateOnMap.data('type','phonebank').velocity({ fill: pbColor });
        } else {
          $stateOnMap.data('type','canvass').velocity({ fill: canvassColor });
        }
      }
    }
    // });
  }

};

vfb.handleNewsletters = function () {
  jQuery('body').on('submit' ,'.yiks-mailchimp-custom-form', function() {
    // Don't show newsletter popup if subbed
    document.cookie = 'vfbsub=true';
    document.cookie = 'wBounce=true';
  });

  // Find state via zipcode
  var $newsletters = jQuery('.yks-mailchimpFormContainer'),
    $zipcode = $newsletters.find('.yks-mc-input-zip-code'),
    $state = $newsletters.find('.yks-mc-input-state'),
    $submit = $newsletters.find('.ykfmc-submit');

  var isValidZip = function(zip) {
     return /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zip);
  };


  $submit.addClass('disabled');

  $newsletters.addClass('has-js');

  $zipcode.on('input', function () {
    var zip = jQuery(this).val();
    if (isValidZip(zip)) {
      jQuery.get('http://api.zippopotam.us/us/' + zip, function (data) {
        $submit.removeClass('disabled');
        if (data && data.places) {
          $state.val(data.places[0].state);
        } else {
          $newsletters.removeClass('has-js');
        }
      })
      .fail(function () {
        $submit.removeClass('disabled');
        $newsletters.removeClass('has-js');
      });
    }
  });




  // Check for newsletter cookie
  // if (document.cookie.indexOf('vfbsub') === -1) {
  // }

};

vfb.tableInit = function () {
  jQuery('.tablesorter').tablesorter();
};

vfb.feelTheBird = function() {

  // April Fools!

  if (!jQuery('#birds').length) {
    return;
  }

  // jQuery('body').children().each(function() {
  //   jQuery(this).html(jQuery(this).html().replace(/Bernie/g,'Birdie'));
  // });


  var Bird = function() {

    var scope = this;

    THREE.Geometry.call(this);

    v(5, 0, 0);
    v(-5, -2, 1);
    v(-5, 0, 0);
    v(-5, -2, -1);

    v(0, 2, -6);
    v(0, 2, 6);
    v(2, 0, 0);
    v(-3, 0, 0);

    f3(0, 2, 1);
    // f3( 0, 3, 2 );

    f3(4, 7, 6);
    f3(5, 6, 7);

    this.computeFaceNormals();

    function v(x, y, z) {

      scope.vertices.push(new THREE.Vector3(x, y, z));

    }


    function f3(a, b, c) {

      scope.faces.push(new THREE.Face3(a, b, c));

    }

    // for ( var i = 0; i < scope.faces.length; i ++ ) {
    //   scope.faces[ i ].color.setHex( Math.random() * 0xff00ff );
    //   scope.faces[ i ].vertexColors[0] = new THREE.Color(0xff0000);
    //   scope.faces[ i ].vertexColors[1] = new THREE.Color(0x00ff00);
    //   scope.faces[ i ].vertexColors[2] = new THREE.Color(0x0000ff);
    // }

  }

  Bird.prototype = Object.create(THREE.Geometry.prototype);
  Bird.prototype.constructor = Bird;




  /**
   * @author mrdoob / http://mrdoob.com/
   * @author supereggbert / http://www.paulbrunt.co.uk/
   * @author julianwa / https://github.com/julianwa
   */

  THREE.RenderableObject = function() {

    this.id = 0;

    this.object = null;
    this.z = 0;
    this.renderOrder = 0;

  };

  //

  THREE.RenderableFace = function() {

    this.id = 0;

    this.v1 = new THREE.RenderableVertex();
    this.v2 = new THREE.RenderableVertex();
    this.v3 = new THREE.RenderableVertex();

    this.normalModel = new THREE.Vector3();

    this.vertexNormalsModel = [new THREE.Vector3(), new THREE.Vector3(), new THREE.Vector3()];
    this.vertexNormalsLength = 0;

    this.color = new THREE.Color();
    this.material = null;
    this.uvs = [new THREE.Vector2(), new THREE.Vector2(), new THREE.Vector2()];

    this.z = 0;
    this.renderOrder = 0;

  };

  //

  THREE.RenderableVertex = function() {

    this.position = new THREE.Vector3();
    this.positionWorld = new THREE.Vector3();
    this.positionScreen = new THREE.Vector4();

    this.visible = true;

  };

  THREE.RenderableVertex.prototype.copy = function(vertex) {

    this.positionWorld.copy(vertex.positionWorld);
    this.positionScreen.copy(vertex.positionScreen);

  };

  //

  THREE.RenderableLine = function() {

    this.id = 0;

    this.v1 = new THREE.RenderableVertex();
    this.v2 = new THREE.RenderableVertex();

    this.vertexColors = [new THREE.Color(), new THREE.Color()];
    this.material = null;

    this.z = 0;
    this.renderOrder = 0;

  };

  //

  THREE.RenderableSprite = function() {

    this.id = 0;

    this.object = null;

    this.x = 0;
    this.y = 0;
    this.z = 0;

    this.rotation = 0;
    this.scale = new THREE.Vector2();

    this.material = null;
    this.renderOrder = 0;

  };

  //

  THREE.Projector = function() {

    var _object, _objectCount, _objectPool = [],
      _objectPoolLength = 0,
      _vertex, _vertexCount, _vertexPool = [],
      _vertexPoolLength = 0,
      _face, _faceCount, _facePool = [],
      _facePoolLength = 0,
      _line, _lineCount, _linePool = [],
      _linePoolLength = 0,
      _sprite, _spriteCount, _spritePool = [],
      _spritePoolLength = 0,

      _renderData = {
        objects: [],
        lights: [],
        elements: []
      },

      _vector3 = new THREE.Vector3(),
      _vector4 = new THREE.Vector4(),

      _clipBox = new THREE.Box3(new THREE.Vector3(-1, -1, -1), new THREE.Vector3(1, 1, 1)),
      _boundingBox = new THREE.Box3(),
      _points3 = new Array(3),
      _points4 = new Array(4),

      _viewMatrix = new THREE.Matrix4(),
      _viewProjectionMatrix = new THREE.Matrix4(),

      _modelMatrix,
      _modelViewProjectionMatrix = new THREE.Matrix4(),

      _normalMatrix = new THREE.Matrix3(),

      _frustum = new THREE.Frustum(),

      _clippedVertex1PositionScreen = new THREE.Vector4(),
      _clippedVertex2PositionScreen = new THREE.Vector4();

    //

    this.projectVector = function(vector, camera) {

      console.warn('THREE.Projector: .projectVector() is now vector.project().');
      vector.project(camera);

    };

    this.unprojectVector = function(vector, camera) {

      console.warn('THREE.Projector: .unprojectVector() is now vector.unproject().');
      vector.unproject(camera);

    };

    this.pickingRay = function(vector, camera) {

      console.error('THREE.Projector: .pickingRay() is now raycaster.setFromCamera().');

    };

    //

    var RenderList = function() {

      var normals = [];
      var uvs = [];

      var object = null;
      var material = null;

      var normalMatrix = new THREE.Matrix3();

      function setObject(value) {

        object = value;
        material = object.material;

        normalMatrix.getNormalMatrix(object.matrixWorld);

        normals.length = 0;
        uvs.length = 0;

      }

      function projectVertex(vertex) {

        var position = vertex.position;
        var positionWorld = vertex.positionWorld;
        var positionScreen = vertex.positionScreen;

        positionWorld.copy(position).applyMatrix4(_modelMatrix);
        positionScreen.copy(positionWorld).applyMatrix4(_viewProjectionMatrix);

        var invW = 1 / positionScreen.w;

        positionScreen.x *= invW;
        positionScreen.y *= invW;
        positionScreen.z *= invW;

        vertex.visible = positionScreen.x >= -1 && positionScreen.x <= 1 &&
          positionScreen.y >= -1 && positionScreen.y <= 1 &&
          positionScreen.z >= -1 && positionScreen.z <= 1;

      }

      function pushVertex(x, y, z) {

        _vertex = getNextVertexInPool();
        _vertex.position.set(x, y, z);

        projectVertex(_vertex);

      }

      function pushNormal(x, y, z) {

        normals.push(x, y, z);

      }

      function pushUv(x, y) {

        uvs.push(x, y);

      }

      function checkTriangleVisibility(v1, v2, v3) {

        if (v1.visible === true || v2.visible === true || v3.visible === true) return true;

        _points3[0] = v1.positionScreen;
        _points3[1] = v2.positionScreen;
        _points3[2] = v3.positionScreen;

        return _clipBox.intersectsBox(_boundingBox.setFromPoints(_points3));

      }

      function checkBackfaceCulling(v1, v2, v3) {

        return ((v3.positionScreen.x - v1.positionScreen.x) *
          (v2.positionScreen.y - v1.positionScreen.y) -
          (v3.positionScreen.y - v1.positionScreen.y) *
          (v2.positionScreen.x - v1.positionScreen.x)) < 0;

      }

      function pushLine(a, b) {

        var v1 = _vertexPool[a];
        var v2 = _vertexPool[b];

        _line = getNextLineInPool();

        _line.id = object.id;
        _line.v1.copy(v1);
        _line.v2.copy(v2);
        _line.z = (v1.positionScreen.z + v2.positionScreen.z) / 2;
        _line.renderOrder = object.renderOrder;

        _line.material = object.material;

        _renderData.elements.push(_line);

      }

      function pushTriangle(a, b, c) {

        var v1 = _vertexPool[a];
        var v2 = _vertexPool[b];
        var v3 = _vertexPool[c];

        if (checkTriangleVisibility(v1, v2, v3) === false) return;

        if (material.side === THREE.DoubleSide || checkBackfaceCulling(v1, v2, v3) === true) {

          _face = getNextFaceInPool();

          _face.id = object.id;
          _face.v1.copy(v1);
          _face.v2.copy(v2);
          _face.v3.copy(v3);
          _face.z = (v1.positionScreen.z + v2.positionScreen.z + v3.positionScreen.z) / 3;
          _face.renderOrder = object.renderOrder;

          // use first vertex normal as face normal

          _face.normalModel.fromArray(normals, a * 3);
          _face.normalModel.applyMatrix3(normalMatrix).normalize();

          for (var i = 0; i < 3; i++) {

            var normal = _face.vertexNormalsModel[i];
            normal.fromArray(normals, arguments[i] * 3);
            normal.applyMatrix3(normalMatrix).normalize();

            var uv = _face.uvs[i];
            uv.fromArray(uvs, arguments[i] * 2);

          }

          _face.vertexNormalsLength = 3;

          _face.material = object.material;

          _renderData.elements.push(_face);

        }

      }

      return {
        setObject: setObject,
        projectVertex: projectVertex,
        checkTriangleVisibility: checkTriangleVisibility,
        checkBackfaceCulling: checkBackfaceCulling,
        pushVertex: pushVertex,
        pushNormal: pushNormal,
        pushUv: pushUv,
        pushLine: pushLine,
        pushTriangle: pushTriangle
      }

    };

    var renderList = new RenderList();

    this.projectScene = function(scene, camera, sortObjects, sortElements) {

      _faceCount = 0;
      _lineCount = 0;
      _spriteCount = 0;

      _renderData.elements.length = 0;

      if (scene.autoUpdate === true) scene.updateMatrixWorld();
      if (camera.parent === null) camera.updateMatrixWorld();

      _viewMatrix.copy(camera.matrixWorldInverse.getInverse(camera.matrixWorld));
      _viewProjectionMatrix.multiplyMatrices(camera.projectionMatrix, _viewMatrix);

      _frustum.setFromMatrix(_viewProjectionMatrix);

      //

      _objectCount = 0;

      _renderData.objects.length = 0;
      _renderData.lights.length = 0;

      scene.traverseVisible(function(object) {

        if (object instanceof THREE.Light) {

          _renderData.lights.push(object);

        } else if (object instanceof THREE.Mesh || object instanceof THREE.Line || object instanceof THREE.Sprite) {

          var material = object.material;

          if (material.visible === false) return;

          if (object.frustumCulled === false || _frustum.intersectsObject(object) === true) {

            _object = getNextObjectInPool();
            _object.id = object.id;
            _object.object = object;

            _vector3.setFromMatrixPosition(object.matrixWorld);
            _vector3.applyProjection(_viewProjectionMatrix);
            _object.z = _vector3.z;
            _object.renderOrder = object.renderOrder;

            _renderData.objects.push(_object);

          }

        }

      });

      if (sortObjects === true) {

        _renderData.objects.sort(painterSort);

      }

      //

      for (var o = 0, ol = _renderData.objects.length; o < ol; o++) {

        var object = _renderData.objects[o].object;
        var geometry = object.geometry;

        renderList.setObject(object);

        _modelMatrix = object.matrixWorld;

        _vertexCount = 0;

        if (object instanceof THREE.Mesh) {

          if (geometry instanceof THREE.BufferGeometry) {

            var attributes = geometry.attributes;
            var groups = geometry.groups;

            if (attributes.position === undefined) continue;

            var positions = attributes.position.array;

            for (var i = 0, l = positions.length; i < l; i += 3) {

              renderList.pushVertex(positions[i], positions[i + 1], positions[i + 2]);

            }

            if (attributes.normal !== undefined) {

              var normals = attributes.normal.array;

              for (var i = 0, l = normals.length; i < l; i += 3) {

                renderList.pushNormal(normals[i], normals[i + 1], normals[i + 2]);

              }

            }

            if (attributes.uv !== undefined) {

              var uvs = attributes.uv.array;

              for (var i = 0, l = uvs.length; i < l; i += 2) {

                renderList.pushUv(uvs[i], uvs[i + 1]);

              }

            }

            if (geometry.index !== null) {

              var indices = geometry.index.array;

              if (groups.length > 0) {

                for (var o = 0; o < groups.length; o++) {

                  var group = groups[o];

                  for (var i = group.start, l = group.start + group.count; i < l; i += 3) {

                    renderList.pushTriangle(indices[i], indices[i + 1], indices[i + 2]);

                  }

                }

              } else {

                for (var i = 0, l = indices.length; i < l; i += 3) {

                  renderList.pushTriangle(indices[i], indices[i + 1], indices[i + 2]);

                }

              }

            } else {

              for (var i = 0, l = positions.length / 3; i < l; i += 3) {

                renderList.pushTriangle(i, i + 1, i + 2);

              }

            }

          } else if (geometry instanceof THREE.Geometry) {

            var vertices = geometry.vertices;
            var faces = geometry.faces;
            var faceVertexUvs = geometry.faceVertexUvs[0];

            _normalMatrix.getNormalMatrix(_modelMatrix);

            var material = object.material;

            var isFaceMaterial = material instanceof THREE.MultiMaterial;
            var objectMaterials = isFaceMaterial === true ? object.material : null;

            for (var v = 0, vl = vertices.length; v < vl; v++) {

              var vertex = vertices[v];

              _vector3.copy(vertex);

              if (material.morphTargets === true) {

                var morphTargets = geometry.morphTargets;
                var morphInfluences = object.morphTargetInfluences;

                for (var t = 0, tl = morphTargets.length; t < tl; t++) {

                  var influence = morphInfluences[t];

                  if (influence === 0) continue;

                  var target = morphTargets[t];
                  var targetVertex = target.vertices[v];

                  _vector3.x += (targetVertex.x - vertex.x) * influence;
                  _vector3.y += (targetVertex.y - vertex.y) * influence;
                  _vector3.z += (targetVertex.z - vertex.z) * influence;

                }

              }

              renderList.pushVertex(_vector3.x, _vector3.y, _vector3.z);

            }

            for (var f = 0, fl = faces.length; f < fl; f++) {

              var face = faces[f];

              material = isFaceMaterial === true ?
                objectMaterials.materials[face.materialIndex] :
                object.material;

              if (material === undefined) continue;

              var side = material.side;

              var v1 = _vertexPool[face.a];
              var v2 = _vertexPool[face.b];
              var v3 = _vertexPool[face.c];

              if (renderList.checkTriangleVisibility(v1, v2, v3) === false) continue;

              var visible = renderList.checkBackfaceCulling(v1, v2, v3);

              if (side !== THREE.DoubleSide) {

                if (side === THREE.FrontSide && visible === false) continue;
                if (side === THREE.BackSide && visible === true) continue;

              }

              _face = getNextFaceInPool();

              _face.id = object.id;
              _face.v1.copy(v1);
              _face.v2.copy(v2);
              _face.v3.copy(v3);

              _face.normalModel.copy(face.normal);

              if (visible === false && (side === THREE.BackSide || side === THREE.DoubleSide)) {

                _face.normalModel.negate();

              }

              _face.normalModel.applyMatrix3(_normalMatrix).normalize();

              var faceVertexNormals = face.vertexNormals;

              for (var n = 0, nl = Math.min(faceVertexNormals.length, 3); n < nl; n++) {

                var normalModel = _face.vertexNormalsModel[n];
                normalModel.copy(faceVertexNormals[n]);

                if (visible === false && (side === THREE.BackSide || side === THREE.DoubleSide)) {

                  normalModel.negate();

                }

                normalModel.applyMatrix3(_normalMatrix).normalize();

              }

              _face.vertexNormalsLength = faceVertexNormals.length;

              var vertexUvs = faceVertexUvs[f];

              if (vertexUvs !== undefined) {

                for (var u = 0; u < 3; u++) {

                  _face.uvs[u].copy(vertexUvs[u]);

                }

              }

              _face.color = face.color;
              _face.material = material;

              _face.z = (v1.positionScreen.z + v2.positionScreen.z + v3.positionScreen.z) / 3;
              _face.renderOrder = object.renderOrder;

              _renderData.elements.push(_face);

            }

          }

        } else if (object instanceof THREE.Line) {

          if (geometry instanceof THREE.BufferGeometry) {

            var attributes = geometry.attributes;

            if (attributes.position !== undefined) {

              var positions = attributes.position.array;

              for (var i = 0, l = positions.length; i < l; i += 3) {

                renderList.pushVertex(positions[i], positions[i + 1], positions[i + 2]);

              }

              if (geometry.index !== null) {

                var indices = geometry.index.array;

                for (var i = 0, l = indices.length; i < l; i += 2) {

                  renderList.pushLine(indices[i], indices[i + 1]);

                }

              } else {

                var step = object instanceof THREE.LineSegments ? 2 : 1;

                for (var i = 0, l = (positions.length / 3) - 1; i < l; i += step) {

                  renderList.pushLine(i, i + 1);

                }

              }

            }

          } else if (geometry instanceof THREE.Geometry) {

            _modelViewProjectionMatrix.multiplyMatrices(_viewProjectionMatrix, _modelMatrix);

            var vertices = object.geometry.vertices;

            if (vertices.length === 0) continue;

            v1 = getNextVertexInPool();
            v1.positionScreen.copy(vertices[0]).applyMatrix4(_modelViewProjectionMatrix);

            var step = object instanceof THREE.LineSegments ? 2 : 1;

            for (var v = 1, vl = vertices.length; v < vl; v++) {

              v1 = getNextVertexInPool();
              v1.positionScreen.copy(vertices[v]).applyMatrix4(_modelViewProjectionMatrix);

              if ((v + 1) % step > 0) continue;

              v2 = _vertexPool[_vertexCount - 2];

              _clippedVertex1PositionScreen.copy(v1.positionScreen);
              _clippedVertex2PositionScreen.copy(v2.positionScreen);

              if (clipLine(_clippedVertex1PositionScreen, _clippedVertex2PositionScreen) === true) {

                // Perform the perspective divide
                _clippedVertex1PositionScreen.multiplyScalar(1 / _clippedVertex1PositionScreen.w);
                _clippedVertex2PositionScreen.multiplyScalar(1 / _clippedVertex2PositionScreen.w);

                _line = getNextLineInPool();

                _line.id = object.id;
                _line.v1.positionScreen.copy(_clippedVertex1PositionScreen);
                _line.v2.positionScreen.copy(_clippedVertex2PositionScreen);

                _line.z = Math.max(_clippedVertex1PositionScreen.z, _clippedVertex2PositionScreen.z);
                _line.renderOrder = object.renderOrder;

                _line.material = object.material;

                if (object.material.vertexColors === THREE.VertexColors) {

                  _line.vertexColors[0].copy(object.geometry.colors[v]);
                  _line.vertexColors[1].copy(object.geometry.colors[v - 1]);

                }

                _renderData.elements.push(_line);

              }

            }

          }

        } else if (object instanceof THREE.Sprite) {

          _vector4.set(_modelMatrix.elements[12], _modelMatrix.elements[13], _modelMatrix.elements[14], 1);
          _vector4.applyMatrix4(_viewProjectionMatrix);

          var invW = 1 / _vector4.w;

          _vector4.z *= invW;

          if (_vector4.z >= -1 && _vector4.z <= 1) {

            _sprite = getNextSpriteInPool();
            _sprite.id = object.id;
            _sprite.x = _vector4.x * invW;
            _sprite.y = _vector4.y * invW;
            _sprite.z = _vector4.z;
            _sprite.renderOrder = object.renderOrder;
            _sprite.object = object;

            _sprite.rotation = object.rotation;

            _sprite.scale.x = object.scale.x * Math.abs(_sprite.x - (_vector4.x + camera.projectionMatrix.elements[0]) / (_vector4.w + camera.projectionMatrix.elements[12]));
            _sprite.scale.y = object.scale.y * Math.abs(_sprite.y - (_vector4.y + camera.projectionMatrix.elements[5]) / (_vector4.w + camera.projectionMatrix.elements[13]));

            _sprite.material = object.material;

            _renderData.elements.push(_sprite);

          }

        }

      }

      if (sortElements === true) {

        _renderData.elements.sort(painterSort);

      }

      return _renderData;

    };

    // Pools

    function getNextObjectInPool() {

      if (_objectCount === _objectPoolLength) {

        var object = new THREE.RenderableObject();
        _objectPool.push(object);
        _objectPoolLength++;
        _objectCount++;
        return object;

      }

      return _objectPool[_objectCount++];

    }

    function getNextVertexInPool() {

      if (_vertexCount === _vertexPoolLength) {

        var vertex = new THREE.RenderableVertex();
        _vertexPool.push(vertex);
        _vertexPoolLength++;
        _vertexCount++;
        return vertex;

      }

      return _vertexPool[_vertexCount++];

    }

    function getNextFaceInPool() {

      if (_faceCount === _facePoolLength) {

        var face = new THREE.RenderableFace();
        _facePool.push(face);
        _facePoolLength++;
        _faceCount++;
        return face;

      }

      return _facePool[_faceCount++];


    }

    function getNextLineInPool() {

      if (_lineCount === _linePoolLength) {

        var line = new THREE.RenderableLine();
        _linePool.push(line);
        _linePoolLength++;
        _lineCount++;
        return line;

      }

      return _linePool[_lineCount++];

    }

    function getNextSpriteInPool() {

      if (_spriteCount === _spritePoolLength) {

        var sprite = new THREE.RenderableSprite();
        _spritePool.push(sprite);
        _spritePoolLength++;
        _spriteCount++;
        return sprite;

      }

      return _spritePool[_spriteCount++];

    }

    //

    function painterSort(a, b) {

      if (a.renderOrder !== b.renderOrder) {

        return a.renderOrder - b.renderOrder;

      } else if (a.z !== b.z) {

        return b.z - a.z;

      } else if (a.id !== b.id) {

        return a.id - b.id;

      } else {

        return 0;

      }

    }

    function clipLine(s1, s2) {

      var alpha1 = 0,
        alpha2 = 1,

        // Calculate the boundary coordinate of each vertex for the near and far clip planes,
        // Z = -1 and Z = +1, respectively.
        bc1near = s1.z + s1.w,
        bc2near = s2.z + s2.w,
        bc1far = -s1.z + s1.w,
        bc2far = -s2.z + s2.w;

      if (bc1near >= 0 && bc2near >= 0 && bc1far >= 0 && bc2far >= 0) {

        // Both vertices lie entirely within all clip planes.
        return true;

      } else if ((bc1near < 0 && bc2near < 0) || (bc1far < 0 && bc2far < 0)) {

        // Both vertices lie entirely outside one of the clip planes.
        return false;

      } else {

        // The line segment spans at least one clip plane.

        if (bc1near < 0) {

          // v1 lies outside the near plane, v2 inside
          alpha1 = Math.max(alpha1, bc1near / (bc1near - bc2near));

        } else if (bc2near < 0) {

          // v2 lies outside the near plane, v1 inside
          alpha2 = Math.min(alpha2, bc1near / (bc1near - bc2near));

        }

        if (bc1far < 0) {

          // v1 lies outside the far plane, v2 inside
          alpha1 = Math.max(alpha1, bc1far / (bc1far - bc2far));

        } else if (bc2far < 0) {

          // v2 lies outside the far plane, v2 inside
          alpha2 = Math.min(alpha2, bc1far / (bc1far - bc2far));

        }

        if (alpha2 < alpha1) {

          // The line segment spans two boundaries, but is outside both of them.
          // (This can't happen when we're only clipping against just near/far but good
          //  to leave the check here for future usage if other clip planes are added.)
          return false;

        } else {

          // Update the s1 and s2 vertices to match the clipped line segment.
          s1.lerp(s2, alpha1);
          s2.lerp(s1, 1 - alpha2);

          return true;

        }

      }

    }

  };




  /**
   * @author mrdoob / http://mrdoob.com/
   */

  THREE.SpriteCanvasMaterial = function(parameters) {

    THREE.Material.call(this);

    this.type = 'SpriteCanvasMaterial';

    this.color = new THREE.Color(0xffffff);
    this.program = function(context, color) {};

    this.setValues(parameters);

  };

  THREE.SpriteCanvasMaterial.prototype = Object.create(THREE.Material.prototype);
  THREE.SpriteCanvasMaterial.prototype.constructor = THREE.SpriteCanvasMaterial;

  THREE.SpriteCanvasMaterial.prototype.clone = function() {

    var material = new THREE.SpriteCanvasMaterial();

    material.copy(this);
    material.color.copy(this.color);
    material.program = this.program;

    return material;

  };

  //

  THREE.CanvasRenderer = function(parameters) {

    console.log('THREE.CanvasRenderer', THREE.REVISION);

    parameters = parameters || {};

    var _this = this,
      _renderData, _elements, _lights,
      _projector = new THREE.Projector(),

      _canvas = parameters.canvas !== undefined ?
      parameters.canvas :
      document.createElement('canvas'),

      _canvasWidth = _canvas.width,
      _canvasHeight = _canvas.height,
      _canvasWidthHalf = Math.floor(_canvasWidth / 2),
      _canvasHeightHalf = Math.floor(_canvasHeight / 2),

      _viewportX = 0,
      _viewportY = 0,
      _viewportWidth = _canvasWidth,
      _viewportHeight = _canvasHeight,

      _pixelRatio = 1,

      _context = _canvas.getContext('2d', {
        alpha: parameters.alpha === true
      }),

      _clearColor = new THREE.Color(0x000000),
      _clearAlpha = parameters.alpha === true ? 0 : 1,

      _contextGlobalAlpha = 1,
      _contextGlobalCompositeOperation = 0,
      _contextStrokeStyle = null,
      _contextFillStyle = null,
      _contextLineWidth = null,
      _contextLineCap = null,
      _contextLineJoin = null,
      _contextLineDash = [],

      _camera,

      _v1, _v2, _v3, _v4,
      _v5 = new THREE.RenderableVertex(),
      _v6 = new THREE.RenderableVertex(),

      _v1x, _v1y, _v2x, _v2y, _v3x, _v3y,
      _v4x, _v4y, _v5x, _v5y, _v6x, _v6y,

      _color = new THREE.Color(),
      _color1 = new THREE.Color(),
      _color2 = new THREE.Color(),
      _color3 = new THREE.Color(),
      _color4 = new THREE.Color(),

      _diffuseColor = new THREE.Color(),
      _emissiveColor = new THREE.Color(),

      _lightColor = new THREE.Color(),

      _patterns = {},

      _image, _uvs,
      _uv1x, _uv1y, _uv2x, _uv2y, _uv3x, _uv3y,

      _clipBox = new THREE.Box2(),
      _clearBox = new THREE.Box2(),
      _elemBox = new THREE.Box2(),

      _ambientLight = new THREE.Color(),
      _directionalLights = new THREE.Color(),
      _pointLights = new THREE.Color(),

      _vector3 = new THREE.Vector3(), // Needed for PointLight
      _centroid = new THREE.Vector3(),
      _normal = new THREE.Vector3(),
      _normalViewMatrix = new THREE.Matrix3();

    /* TODO
    _canvas.mozImageSmoothingEnabled = false;
    _canvas.webkitImageSmoothingEnabled = false;
    _canvas.msImageSmoothingEnabled = false;
    _canvas.imageSmoothingEnabled = false;
    */

    // dash+gap fallbacks for Firefox and everything else

    if (_context.setLineDash === undefined) {

      _context.setLineDash = function() {};

    }

    this.domElement = _canvas;

    this.autoClear = true;
    this.sortObjects = true;
    this.sortElements = true;

    this.info = {

      render: {

        vertices: 0,
        faces: 0

      }

    };

    // WebGLRenderer compatibility

    this.supportsVertexTextures = function() {};
    this.setFaceCulling = function() {};

    // API

    this.getContext = function() {

      return _context;

    };

    this.getContextAttributes = function() {

      return _context.getContextAttributes();

    };

    this.getPixelRatio = function() {

      return _pixelRatio;

    };

    this.setPixelRatio = function(value) {

      if (value !== undefined) _pixelRatio = value;

    };

    this.setSize = function(width, height, updateStyle) {

      _canvasWidth = width * _pixelRatio;
      _canvasHeight = height * _pixelRatio;

      _canvas.width = _canvasWidth;
      _canvas.height = _canvasHeight;

      _canvasWidthHalf = Math.floor(_canvasWidth / 2);
      _canvasHeightHalf = Math.floor(_canvasHeight / 2);

      if (updateStyle !== false) {

        _canvas.style.width = width + 'px';
        _canvas.style.height = height + 'px';

      }

      _clipBox.min.set(-_canvasWidthHalf, -_canvasHeightHalf);
      _clipBox.max.set(_canvasWidthHalf, _canvasHeightHalf);

      _clearBox.min.set(-_canvasWidthHalf, -_canvasHeightHalf);
      _clearBox.max.set(_canvasWidthHalf, _canvasHeightHalf);

      _contextGlobalAlpha = 1;
      _contextGlobalCompositeOperation = 0;
      _contextStrokeStyle = null;
      _contextFillStyle = null;
      _contextLineWidth = null;
      _contextLineCap = null;
      _contextLineJoin = null;

      this.setViewport(0, 0, width, height);

    };

    this.setViewport = function(x, y, width, height) {

      _viewportX = x * _pixelRatio;
      _viewportY = y * _pixelRatio;

      _viewportWidth = width * _pixelRatio;
      _viewportHeight = height * _pixelRatio;

    };

    this.setScissor = function() {};
    this.setScissorTest = function() {};

    this.setClearColor = function(color, alpha) {

      _clearColor.set(color);
      _clearAlpha = alpha !== undefined ? alpha : 1;

      _clearBox.min.set(-_canvasWidthHalf, -_canvasHeightHalf);
      _clearBox.max.set(_canvasWidthHalf, _canvasHeightHalf);

    };

    this.setClearColorHex = function(hex, alpha) {

      console.warn('THREE.CanvasRenderer: .setClearColorHex() is being removed. Use .setClearColor() instead.');
      this.setClearColor(hex, alpha);

    };

    this.getClearColor = function() {

      return _clearColor;

    };

    this.getClearAlpha = function() {

      return _clearAlpha;

    };

    this.getMaxAnisotropy = function() {

      return 0;

    };

    this.clear = function() {

      if (_clearBox.isEmpty() === false) {

        _clearBox.intersect(_clipBox);
        _clearBox.expandByScalar(2);

        _clearBox.min.x = _clearBox.min.x + _canvasWidthHalf;
        _clearBox.min.y = -_clearBox.min.y + _canvasHeightHalf; // higher y value !
        _clearBox.max.x = _clearBox.max.x + _canvasWidthHalf;
        _clearBox.max.y = -_clearBox.max.y + _canvasHeightHalf; // lower y value !

        if (_clearAlpha < 1) {

          _context.clearRect(
            _clearBox.min.x | 0,
            _clearBox.max.y | 0,
            (_clearBox.max.x - _clearBox.min.x) | 0,
            (_clearBox.min.y - _clearBox.max.y) | 0
          );

        }

        if (_clearAlpha > 0) {

          setBlending(THREE.NormalBlending);
          setOpacity(1);

          setFillStyle('rgba(' + Math.floor(_clearColor.r * 255) + ',' + Math.floor(_clearColor.g * 255) + ',' + Math.floor(_clearColor.b * 255) + ',' + _clearAlpha + ')');

          _context.fillRect(
            _clearBox.min.x | 0,
            _clearBox.max.y | 0,
            (_clearBox.max.x - _clearBox.min.x) | 0,
            (_clearBox.min.y - _clearBox.max.y) | 0
          );

        }

        _clearBox.makeEmpty();

      }

    };

    // compatibility

    this.clearColor = function() {};
    this.clearDepth = function() {};
    this.clearStencil = function() {};

    this.render = function(scene, camera) {

      if (camera instanceof THREE.Camera === false) {

        console.error('THREE.CanvasRenderer.render: camera is not an instance of THREE.Camera.');
        return;

      }

      if (this.autoClear === true) this.clear();

      _this.info.render.vertices = 0;
      _this.info.render.faces = 0;

      _context.setTransform(_viewportWidth / _canvasWidth, 0, 0, -_viewportHeight / _canvasHeight, _viewportX, _canvasHeight - _viewportY);
      _context.translate(_canvasWidthHalf, _canvasHeightHalf);

      _renderData = _projector.projectScene(scene, camera, this.sortObjects, this.sortElements);
      _elements = _renderData.elements;
      _lights = _renderData.lights;
      _camera = camera;

      _normalViewMatrix.getNormalMatrix(camera.matrixWorldInverse);

      /* DEBUG
      setFillStyle( 'rgba( 0, 255, 255, 0.5 )' );
      _context.fillRect( _clipBox.min.x, _clipBox.min.y, _clipBox.max.x - _clipBox.min.x, _clipBox.max.y - _clipBox.min.y );
      */

      calculateLights();

      for (var e = 0, el = _elements.length; e < el; e++) {

        var element = _elements[e];

        var material = element.material;

        if (material === undefined || material.opacity === 0) continue;

        _elemBox.makeEmpty();

        if (element instanceof THREE.RenderableSprite) {

          _v1 = element;
          _v1.x *= _canvasWidthHalf;
          _v1.y *= _canvasHeightHalf;

          renderSprite(_v1, element, material);

        } else if (element instanceof THREE.RenderableLine) {

          _v1 = element.v1;
          _v2 = element.v2;

          _v1.positionScreen.x *= _canvasWidthHalf;
          _v1.positionScreen.y *= _canvasHeightHalf;
          _v2.positionScreen.x *= _canvasWidthHalf;
          _v2.positionScreen.y *= _canvasHeightHalf;

          _elemBox.setFromPoints([
            _v1.positionScreen,
            _v2.positionScreen
          ]);

          if (_clipBox.intersectsBox(_elemBox) === true) {

            renderLine(_v1, _v2, element, material);

          }

        } else if (element instanceof THREE.RenderableFace) {

          _v1 = element.v1;
          _v2 = element.v2;
          _v3 = element.v3;

          if (_v1.positionScreen.z < -1 || _v1.positionScreen.z > 1) continue;
          if (_v2.positionScreen.z < -1 || _v2.positionScreen.z > 1) continue;
          if (_v3.positionScreen.z < -1 || _v3.positionScreen.z > 1) continue;

          _v1.positionScreen.x *= _canvasWidthHalf;
          _v1.positionScreen.y *= _canvasHeightHalf;
          _v2.positionScreen.x *= _canvasWidthHalf;
          _v2.positionScreen.y *= _canvasHeightHalf;
          _v3.positionScreen.x *= _canvasWidthHalf;
          _v3.positionScreen.y *= _canvasHeightHalf;

          if (material.overdraw > 0) {

            expand(_v1.positionScreen, _v2.positionScreen, material.overdraw);
            expand(_v2.positionScreen, _v3.positionScreen, material.overdraw);
            expand(_v3.positionScreen, _v1.positionScreen, material.overdraw);

          }

          _elemBox.setFromPoints([
            _v1.positionScreen,
            _v2.positionScreen,
            _v3.positionScreen
          ]);

          if (_clipBox.intersectsBox(_elemBox) === true) {

            renderFace3(_v1, _v2, _v3, 0, 1, 2, element, material);

          }

        }

        /* DEBUG
        setLineWidth( 1 );
        setStrokeStyle( 'rgba( 0, 255, 0, 0.5 )' );
        _context.strokeRect( _elemBox.min.x, _elemBox.min.y, _elemBox.max.x - _elemBox.min.x, _elemBox.max.y - _elemBox.min.y );
        */

        _clearBox.union(_elemBox);

      }

      /* DEBUG
      setLineWidth( 1 );
      setStrokeStyle( 'rgba( 255, 0, 0, 0.5 )' );
      _context.strokeRect( _clearBox.min.x, _clearBox.min.y, _clearBox.max.x - _clearBox.min.x, _clearBox.max.y - _clearBox.min.y );
      */

      _context.setTransform(1, 0, 0, 1, 0, 0);

    };

    //

    function calculateLights() {

      _ambientLight.setRGB(0, 0, 0);
      _directionalLights.setRGB(0, 0, 0);
      _pointLights.setRGB(0, 0, 0);

      for (var l = 0, ll = _lights.length; l < ll; l++) {

        var light = _lights[l];
        var lightColor = light.color;

        if (light instanceof THREE.AmbientLight) {

          _ambientLight.add(lightColor);

        } else if (light instanceof THREE.DirectionalLight) {

          // for sprites

          _directionalLights.add(lightColor);

        } else if (light instanceof THREE.PointLight) {

          // for sprites

          _pointLights.add(lightColor);

        }

      }

    }

    function calculateLight(position, normal, color) {

      for (var l = 0, ll = _lights.length; l < ll; l++) {

        var light = _lights[l];

        _lightColor.copy(light.color);

        if (light instanceof THREE.DirectionalLight) {

          var lightPosition = _vector3.setFromMatrixPosition(light.matrixWorld).normalize();

          var amount = normal.dot(lightPosition);

          if (amount <= 0) continue;

          amount *= light.intensity;

          color.add(_lightColor.multiplyScalar(amount));

        } else if (light instanceof THREE.PointLight) {

          var lightPosition = _vector3.setFromMatrixPosition(light.matrixWorld);

          var amount = normal.dot(_vector3.subVectors(lightPosition, position).normalize());

          if (amount <= 0) continue;

          amount *= light.distance == 0 ? 1 : 1 - Math.min(position.distanceTo(lightPosition) / light.distance, 1);

          if (amount == 0) continue;

          amount *= light.intensity;

          color.add(_lightColor.multiplyScalar(amount));

        }

      }

    }

    function renderSprite(v1, element, material) {

      setOpacity(material.opacity);
      setBlending(material.blending);

      var scaleX = element.scale.x * _canvasWidthHalf;
      var scaleY = element.scale.y * _canvasHeightHalf;

      var dist = 0.5 * Math.sqrt(scaleX * scaleX + scaleY * scaleY); // allow for rotated sprite
      _elemBox.min.set(v1.x - dist, v1.y - dist);
      _elemBox.max.set(v1.x + dist, v1.y + dist);

      if (material instanceof THREE.SpriteMaterial) {

        var texture = material.map;

        if (texture !== null) {

          var pattern = _patterns[texture.id];

          if (pattern === undefined || pattern.version !== texture.version) {

            pattern = textureToPattern(texture);
            _patterns[texture.id] = pattern;

          }

          if (pattern.canvas !== undefined) {

            setFillStyle(pattern.canvas);

            var bitmap = texture.image;

            var ox = bitmap.width * texture.offset.x;
            var oy = bitmap.height * texture.offset.y;

            var sx = bitmap.width * texture.repeat.x;
            var sy = bitmap.height * texture.repeat.y;

            var cx = scaleX / sx;
            var cy = scaleY / sy;

            _context.save();
            _context.translate(v1.x, v1.y);
            if (material.rotation !== 0) _context.rotate(material.rotation);
            _context.translate(-scaleX / 2, -scaleY / 2);
            _context.scale(cx, cy);
            _context.translate(-ox, -oy);
            _context.fillRect(ox, oy, sx, sy);
            _context.restore();

          }

        } else {

          // no texture

          setFillStyle(material.color.getStyle());

          _context.save();
          _context.translate(v1.x, v1.y);
          if (material.rotation !== 0) _context.rotate(material.rotation);
          _context.scale(scaleX, -scaleY);
          _context.fillRect(-0.5, -0.5, 1, 1);
          _context.restore();

        }

      } else if (material instanceof THREE.SpriteCanvasMaterial) {

        setStrokeStyle(material.color.getStyle());
        setFillStyle(material.color.getStyle());

        _context.save();
        _context.translate(v1.x, v1.y);
        if (material.rotation !== 0) _context.rotate(material.rotation);
        _context.scale(scaleX, scaleY);

        material.program(_context);

        _context.restore();

      }

      /* DEBUG
      setStrokeStyle( 'rgb(255,255,0)' );
      _context.beginPath();
      _context.moveTo( v1.x - 10, v1.y );
      _context.lineTo( v1.x + 10, v1.y );
      _context.moveTo( v1.x, v1.y - 10 );
      _context.lineTo( v1.x, v1.y + 10 );
      _context.stroke();
      */

    }

    function renderLine(v1, v2, element, material) {

      setOpacity(material.opacity);
      setBlending(material.blending);

      _context.beginPath();
      _context.moveTo(v1.positionScreen.x, v1.positionScreen.y);
      _context.lineTo(v2.positionScreen.x, v2.positionScreen.y);

      if (material instanceof THREE.LineBasicMaterial) {

        setLineWidth(material.linewidth);
        setLineCap(material.linecap);
        setLineJoin(material.linejoin);

        if (material.vertexColors !== THREE.VertexColors) {

          setStrokeStyle(material.color.getStyle());

        } else {

          var colorStyle1 = element.vertexColors[0].getStyle();
          var colorStyle2 = element.vertexColors[1].getStyle();

          if (colorStyle1 === colorStyle2) {

            setStrokeStyle(colorStyle1);

          } else {

            try {

              var grad = _context.createLinearGradient(
                v1.positionScreen.x,
                v1.positionScreen.y,
                v2.positionScreen.x,
                v2.positionScreen.y
              );
              grad.addColorStop(0, colorStyle1);
              grad.addColorStop(1, colorStyle2);

            } catch (exception) {

              grad = colorStyle1;

            }

            setStrokeStyle(grad);

          }

        }

        _context.stroke();
        _elemBox.expandByScalar(material.linewidth * 2);

      } else if (material instanceof THREE.LineDashedMaterial) {

        setLineWidth(material.linewidth);
        setLineCap(material.linecap);
        setLineJoin(material.linejoin);
        setStrokeStyle(material.color.getStyle());
        setLineDash([material.dashSize, material.gapSize]);

        _context.stroke();

        _elemBox.expandByScalar(material.linewidth * 2);

        setLineDash([]);

      }

    }

    function renderFace3(v1, v2, v3, uv1, uv2, uv3, element, material) {

      _this.info.render.vertices += 3;
      _this.info.render.faces++;

      setOpacity(material.opacity);
      setBlending(material.blending);

      _v1x = v1.positionScreen.x;
      _v1y = v1.positionScreen.y;
      _v2x = v2.positionScreen.x;
      _v2y = v2.positionScreen.y;
      _v3x = v3.positionScreen.x;
      _v3y = v3.positionScreen.y;

      drawTriangle(_v1x, _v1y, _v2x, _v2y, _v3x, _v3y);

      if ((material instanceof THREE.MeshLambertMaterial || material instanceof THREE.MeshPhongMaterial) && material.map === null) {

        _diffuseColor.copy(material.color);
        _emissiveColor.copy(material.emissive);

        if (material.vertexColors === THREE.FaceColors) {

          _diffuseColor.multiply(element.color);

        }

        _color.copy(_ambientLight);

        _centroid.copy(v1.positionWorld).add(v2.positionWorld).add(v3.positionWorld).divideScalar(3);

        calculateLight(_centroid, element.normalModel, _color);

        _color.multiply(_diffuseColor).add(_emissiveColor);

        material.wireframe === true ?
          strokePath(_color, material.wireframeLinewidth, material.wireframeLinecap, material.wireframeLinejoin) :
          fillPath(_color);

      } else if (material instanceof THREE.MeshBasicMaterial ||
        material instanceof THREE.MeshLambertMaterial ||
        material instanceof THREE.MeshPhongMaterial) {

        if (material.map !== null) {

          var mapping = material.map.mapping;

          if (mapping === THREE.UVMapping) {

            _uvs = element.uvs;
            patternPath(_v1x, _v1y, _v2x, _v2y, _v3x, _v3y, _uvs[uv1].x, _uvs[uv1].y, _uvs[uv2].x, _uvs[uv2].y, _uvs[uv3].x, _uvs[uv3].y, material.map);

          }

        } else if (material.envMap !== null) {

          if (material.envMap.mapping === THREE.SphericalReflectionMapping) {

            _normal.copy(element.vertexNormalsModel[uv1]).applyMatrix3(_normalViewMatrix);
            _uv1x = 0.5 * _normal.x + 0.5;
            _uv1y = 0.5 * _normal.y + 0.5;

            _normal.copy(element.vertexNormalsModel[uv2]).applyMatrix3(_normalViewMatrix);
            _uv2x = 0.5 * _normal.x + 0.5;
            _uv2y = 0.5 * _normal.y + 0.5;

            _normal.copy(element.vertexNormalsModel[uv3]).applyMatrix3(_normalViewMatrix);
            _uv3x = 0.5 * _normal.x + 0.5;
            _uv3y = 0.5 * _normal.y + 0.5;

            patternPath(_v1x, _v1y, _v2x, _v2y, _v3x, _v3y, _uv1x, _uv1y, _uv2x, _uv2y, _uv3x, _uv3y, material.envMap);

          }

        } else {

          _color.copy(material.color);

          if (material.vertexColors === THREE.FaceColors) {

            _color.multiply(element.color);

          }

          material.wireframe === true ?
            strokePath(_color, material.wireframeLinewidth, material.wireframeLinecap, material.wireframeLinejoin) :
            fillPath(_color);

        }

      } else if (material instanceof THREE.MeshNormalMaterial) {

        _normal.copy(element.normalModel).applyMatrix3(_normalViewMatrix);

        _color.setRGB(_normal.x, _normal.y, _normal.z).multiplyScalar(0.5).addScalar(0.5);

        material.wireframe === true ?
          strokePath(_color, material.wireframeLinewidth, material.wireframeLinecap, material.wireframeLinejoin) :
          fillPath(_color);

      } else {

        _color.setRGB(1, 1, 1);

        material.wireframe === true ?
          strokePath(_color, material.wireframeLinewidth, material.wireframeLinecap, material.wireframeLinejoin) :
          fillPath(_color);

      }

    }

    //

    function drawTriangle(x0, y0, x1, y1, x2, y2) {

      _context.beginPath();
      _context.moveTo(x0, y0);
      _context.lineTo(x1, y1);
      _context.lineTo(x2, y2);
      _context.closePath();

    }

    function strokePath(color, linewidth, linecap, linejoin) {

      setLineWidth(linewidth);
      setLineCap(linecap);
      setLineJoin(linejoin);
      setStrokeStyle(color.getStyle());

      _context.stroke();

      _elemBox.expandByScalar(linewidth * 2);

    }

    function fillPath(color) {

      setFillStyle(color.getStyle());
      _context.fill();

    }

    function textureToPattern(texture) {

      if (texture.version === 0 ||
        texture instanceof THREE.CompressedTexture ||
        texture instanceof THREE.DataTexture) {

        return {
          canvas: undefined,
          version: texture.version
        };

      }

      var image = texture.image;

      if (image.complete === false) {

        return {
          canvas: undefined,
          version: 0
        };

      }

      var canvas = document.createElement('canvas');
      canvas.width = image.width;
      canvas.height = image.height;

      var context = canvas.getContext('2d');
      context.setTransform(1, 0, 0, -1, 0, image.height);
      context.drawImage(image, 0, 0);

      var repeatX = texture.wrapS === THREE.RepeatWrapping;
      var repeatY = texture.wrapT === THREE.RepeatWrapping;

      var repeat = 'no-repeat';

      if (repeatX === true && repeatY === true) {

        repeat = 'repeat';

      } else if (repeatX === true) {

        repeat = 'repeat-x';

      } else if (repeatY === true) {

        repeat = 'repeat-y';

      }

      var pattern = _context.createPattern(canvas, repeat);

      if (texture.onUpdate) texture.onUpdate(texture);

      return {
        canvas: pattern,
        version: texture.version
      };

    }

    function patternPath(x0, y0, x1, y1, x2, y2, u0, v0, u1, v1, u2, v2, texture) {

      var pattern = _patterns[texture.id];

      if (pattern === undefined || pattern.version !== texture.version) {

        pattern = textureToPattern(texture);
        _patterns[texture.id] = pattern;

      }

      if (pattern.canvas !== undefined) {

        setFillStyle(pattern.canvas);

      } else {

        setFillStyle('rgba( 0, 0, 0, 1)');
        _context.fill();
        return;

      }

      // http://extremelysatisfactorytotalitarianism.com/blog/?p=2120

      var a, b, c, d, e, f, det, idet,
        offsetX = texture.offset.x / texture.repeat.x,
        offsetY = texture.offset.y / texture.repeat.y,
        width = texture.image.width * texture.repeat.x,
        height = texture.image.height * texture.repeat.y;

      u0 = (u0 + offsetX) * width;
      v0 = (v0 + offsetY) * height;

      u1 = (u1 + offsetX) * width;
      v1 = (v1 + offsetY) * height;

      u2 = (u2 + offsetX) * width;
      v2 = (v2 + offsetY) * height;

      x1 -= x0;
      y1 -= y0;
      x2 -= x0;
      y2 -= y0;

      u1 -= u0;
      v1 -= v0;
      u2 -= u0;
      v2 -= v0;

      det = u1 * v2 - u2 * v1;

      if (det === 0) return;

      idet = 1 / det;

      a = (v2 * x1 - v1 * x2) * idet;
      b = (v2 * y1 - v1 * y2) * idet;
      c = (u1 * x2 - u2 * x1) * idet;
      d = (u1 * y2 - u2 * y1) * idet;

      e = x0 - a * u0 - c * v0;
      f = y0 - b * u0 - d * v0;

      _context.save();
      _context.transform(a, b, c, d, e, f);
      _context.fill();
      _context.restore();

    }

    function clipImage(x0, y0, x1, y1, x2, y2, u0, v0, u1, v1, u2, v2, image) {

      // http://extremelysatisfactorytotalitarianism.com/blog/?p=2120

      var a, b, c, d, e, f, det, idet,
        width = image.width - 1,
        height = image.height - 1;

      u0 *= width;
      v0 *= height;
      u1 *= width;
      v1 *= height;
      u2 *= width;
      v2 *= height;

      x1 -= x0;
      y1 -= y0;
      x2 -= x0;
      y2 -= y0;

      u1 -= u0;
      v1 -= v0;
      u2 -= u0;
      v2 -= v0;

      det = u1 * v2 - u2 * v1;

      idet = 1 / det;

      a = (v2 * x1 - v1 * x2) * idet;
      b = (v2 * y1 - v1 * y2) * idet;
      c = (u1 * x2 - u2 * x1) * idet;
      d = (u1 * y2 - u2 * y1) * idet;

      e = x0 - a * u0 - c * v0;
      f = y0 - b * u0 - d * v0;

      _context.save();
      _context.transform(a, b, c, d, e, f);
      _context.clip();
      _context.drawImage(image, 0, 0);
      _context.restore();

    }

    // Hide anti-alias gaps

    function expand(v1, v2, pixels) {

      var x = v2.x - v1.x,
        y = v2.y - v1.y,
        det = x * x + y * y,
        idet;

      if (det === 0) return;

      idet = pixels / Math.sqrt(det);

      x *= idet;
      y *= idet;

      v2.x += x;
      v2.y += y;
      v1.x -= x;
      v1.y -= y;

    }

    // Context cached methods.

    function setOpacity(value) {

      if (_contextGlobalAlpha !== value) {

        _context.globalAlpha = value;
        _contextGlobalAlpha = value;

      }

    }

    function setBlending(value) {

      if (_contextGlobalCompositeOperation !== value) {

        if (value === THREE.NormalBlending) {

          _context.globalCompositeOperation = 'source-over';

        } else if (value === THREE.AdditiveBlending) {

          _context.globalCompositeOperation = 'lighter';

        } else if (value === THREE.SubtractiveBlending) {

          _context.globalCompositeOperation = 'darker';

        }

        _contextGlobalCompositeOperation = value;

      }

    }

    function setLineWidth(value) {

      if (_contextLineWidth !== value) {

        _context.lineWidth = value;
        _contextLineWidth = value;

      }

    }

    function setLineCap(value) {

      // "butt", "round", "square"

      if (_contextLineCap !== value) {

        _context.lineCap = value;
        _contextLineCap = value;

      }

    }

    function setLineJoin(value) {

      // "round", "bevel", "miter"

      if (_contextLineJoin !== value) {

        _context.lineJoin = value;
        _contextLineJoin = value;

      }

    }

    function setStrokeStyle(value) {

      if (_contextStrokeStyle !== value) {

        _context.strokeStyle = value;
        _contextStrokeStyle = value;

      }

    }

    function setFillStyle(value) {

      if (_contextFillStyle !== value) {

        _context.fillStyle = value;
        _contextFillStyle = value;

      }

    }

    function setLineDash(value) {

      if (_contextLineDash.length !== value.length) {

        _context.setLineDash(value);
        _contextLineDash = value;

      }

    }

  };


  var Boid = function() {

    var vector = new THREE.Vector3(),
      _acceleration, _width = 50,
      _height = 50,
      _depth = 20,
      _goal, _neighborhoodRadius = 100,
      _maxSpeed = 4,
      _maxSteerForce = 0.1,
      _avoidWalls = true;

    this.position = new THREE.Vector3();
    this.velocity = new THREE.Vector3();
    _acceleration = new THREE.Vector3();

    this.setGoal = function(target) {

      _goal = target;

    };

    this.setAvoidWalls = function(value) {

      _avoidWalls = value;

    };

    this.setWorldSize = function(width, height, depth) {

      _width = width;
      _height = height;
      _depth = depth;

    };

    this.run = function(boids) {

      if (_avoidWalls) {

        vector.set(-_width, this.position.y, this.position.z);
        vector = this.avoid(vector);
        vector.multiplyScalar(5);
        _acceleration.add(vector);

        vector.set(_width, this.position.y, this.position.z);
        vector = this.avoid(vector);
        vector.multiplyScalar(5);
        _acceleration.add(vector);

        vector.set(this.position.x, -_height, this.position.z);
        vector = this.avoid(vector);
        vector.multiplyScalar(5);
        _acceleration.add(vector);

        vector.set(this.position.x, _height, this.position.z);
        vector = this.avoid(vector);
        vector.multiplyScalar(5);
        _acceleration.add(vector);

        vector.set(this.position.x, this.position.y, -_depth);
        vector = this.avoid(vector);
        vector.multiplyScalar(5);
        _acceleration.add(vector);

        vector.set(this.position.x, this.position.y, _depth);
        vector = this.avoid(vector);
        vector.multiplyScalar(5);
        _acceleration.add(vector);

      }

      if (Math.random() > 0.5) {

        this.flock(boids);

      }

      this.move();

    };

    this.flock = function(boids) {

      if (_goal) {

        _acceleration.add(this.reach(_goal, 0.005));

      }

      _acceleration.add(this.alignment(boids));
      _acceleration.add(this.cohesion(boids));
      _acceleration.add(this.separation(boids));

    };

    this.move = function() {

      this.velocity.add(_acceleration);

      var l = this.velocity.length();

      if (l > _maxSpeed) {

        this.velocity.divideScalar(l / _maxSpeed);

      }

      this.position.add(this.velocity);
      _acceleration.set(0, 0, 0);

    };

    this.checkBounds = function() {

      if (this.position.x > _width) this.position.x = -_width;
      if (this.position.x < -_width) this.position.x = _width;
      if (this.position.y > _height) this.position.y = -_height;
      if (this.position.y < -_height) this.position.y = _height;
      if (this.position.z > _depth) this.position.z = -_depth;
      if (this.position.z < -_depth) this.position.z = _depth;

    };

    //

    this.avoid = function(target) {

      var steer = new THREE.Vector3();

      steer.copy(this.position);
      steer.sub(target);

      steer.multiplyScalar(1 / this.position.distanceToSquared(target));

      return steer;

    };

    this.repulse = function(target) {

      var distance = this.position.distanceTo(target);

      if (distance < 150) {

        var steer = new THREE.Vector3();

        steer.subVectors(this.position, target);
        steer.multiplyScalar(0.5 / distance);

        _acceleration.add(steer);

      }

    };

    this.reach = function(target, amount) {

      var steer = new THREE.Vector3();

      steer.subVectors(target, this.position);
      steer.multiplyScalar(amount);

      return steer;

    };

    this.alignment = function(boids) {

      var boid, velSum = new THREE.Vector3(),
        count = 0;

      for (var i = 0, il = boids.length; i < il; i++) {

        if (Math.random() > 0.6) continue;

        boid = boids[i];

        distance = boid.position.distanceTo(this.position);

        if (distance > 0 && distance <= _neighborhoodRadius) {

          velSum.add(boid.velocity);
          count++;

        }

      }

      if (count > 0) {

        velSum.divideScalar(count);

        var l = velSum.length();

        if (l > _maxSteerForce) {

          velSum.divideScalar(l / _maxSteerForce);

        }

      }

      return velSum;

    };

    this.cohesion = function(boids) {

      var boid, distance,
        posSum = new THREE.Vector3(),
        steer = new THREE.Vector3(),
        count = 0;

      for (var i = 0, il = boids.length; i < il; i++) {

        if (Math.random() > 0.6) continue;

        boid = boids[i];
        distance = boid.position.distanceTo(this.position);

        if (distance > 0 && distance <= _neighborhoodRadius) {

          posSum.add(boid.position);
          count++;

        }

      }

      if (count > 0) {

        posSum.divideScalar(count);

      }

      steer.subVectors(posSum, this.position);

      var l = steer.length();

      if (l > _maxSteerForce) {

        steer.divideScalar(l / _maxSteerForce);

      }

      return steer;

    };

    this.separation = function(boids) {

      var boid, distance,
        posSum = new THREE.Vector3(),
        repulse = new THREE.Vector3();

      for (var i = 0, il = boids.length; i < il; i++) {

        if (Math.random() > 0.6) continue;

        boid = boids[i];
        distance = boid.position.distanceTo(this.position);

        if (distance > 0 && distance <= _neighborhoodRadius) {

          repulse.subVectors(this.position, boid.position);
          repulse.normalize();
          repulse.divideScalar(distance);
          posSum.add(repulse);

        }

      }

      return posSum;

    }

  }

  var SCREEN_WIDTH = window.innerWidth,
    SCREEN_HEIGHT = window.innerHeight,
    SCREEN_WIDTH_HALF = SCREEN_WIDTH / 2,
    SCREEN_HEIGHT_HALF = SCREEN_HEIGHT / 2;

  var camera, scene, renderer,
    birds, bird;

  var boid, boids;

  init();
  animate();

  function init() {

    camera = new THREE.PerspectiveCamera(75, SCREEN_WIDTH / SCREEN_HEIGHT, 1, 10000);
    camera.position.z = 450;

    scene = new THREE.Scene();

    birds = [];
    boids = [];

    for (var i = 0; i < 20; i++) {

      boid = boids[i] = new Boid();
      boid.position.x = Math.random() * 400 - 200;
      boid.position.y = Math.random() * 400 - 200;
      boid.position.z = Math.random() * 400 - 200;
      boid.velocity.x = Math.random() * 2 - 1;
      boid.velocity.y = Math.random() * 2 - 1;
      boid.velocity.z = Math.random() * 2 - 1;
      boid.setAvoidWalls(true);
      boid.setWorldSize(500, 500, 400);

      bird = birds[i] = new THREE.Mesh(new Bird(), new THREE.MeshBasicMaterial({
        color: 0x0e85cc,
        side: THREE.DoubleSide
      }));
      console.log(bird);
      bird.phase = Math.floor(Math.random() * 62.83);

      scene.add(bird);


    }

    renderer = new THREE.WebGLRenderer( { alpha: true } );
    renderer.setClearColor(0x000000, 0);
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);

    document.addEventListener('mousemove', onDocumentMouseMove, false);

    document.getElementById('birds').appendChild(renderer.domElement);


    window.addEventListener('resize', onWindowResize, false);

  }

  function onWindowResize() {

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize(window.innerWidth, window.innerHeight);

  }

  function onDocumentMouseMove(event) {

    var vector = new THREE.Vector3(event.clientX - SCREEN_WIDTH_HALF, -event.clientY + SCREEN_HEIGHT_HALF, 0);

    for (var i = 0, il = boids.length; i < il; i++) {

      boid = boids[i];

      vector.z = boid.position.z;

      boid.repulse(vector);

    }

  }

  //

  function animate() {

    requestAnimationFrame(animate);

    render();

  }

  function render() {

    for (var i = 0, il = birds.length; i < il; i++) {

      boid = boids[i];
      boid.run(boids);

      bird = birds[i];
      bird.position.copy(boids[i].position);

      color = bird.material.color;
      color.r = color.g = color.b = (500 - bird.position.z) / 1000;

      bird.rotation.y = Math.atan2(-boid.velocity.z, boid.velocity.x);
      bird.rotation.z = Math.asin(boid.velocity.y / boid.velocity.length());

      bird.phase = (bird.phase + (Math.max(0, bird.rotation.z) + 0.1)) % 62.83;
      bird.geometry.vertices[5].y = bird.geometry.vertices[4].y = Math.sin(bird.phase) * 5;

    }

    renderer.render(scene, camera);

  }


};

/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  vfb.handleNewsletters();

  vfb.loadFonts();

  vfb.handleNavToggle();

  vfb.handleLegend();

  vfb.handleSVG();

  vfb.handleStateSelector();

  vfb.stateInit();

  vfb.trackElements();

  vfb.scheduleInit();

  vfb.gotvInit();

  vfb.tableInit();

  vfb.feelTheBird();

  activeCallback.add(function () {

    jQuery('.slab').bigtext();

    jQuery('.init').removeClass('init').addClass('done');

    vfb.buildMap();

    setTimeout(function () {
      vfb.enhanceSharing();
    }, 1000);
  });


}); /* end of as page load scripts */
