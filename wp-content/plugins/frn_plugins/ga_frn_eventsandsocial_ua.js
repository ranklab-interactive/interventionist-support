//Some of this based on: http://jsfiddle.net/shamel67/VzbPw/1/
//coded by daxon edwards (daxon.me) 2013-2014


//#####
//### SPECIAL SITE-WIDE EVENT TRACKING
//#####

//reducing errors
if(typeof frn_eli_deact === 'undefined') var frn_eli_deact="";
if(typeof frn_eli_target === 'undefined') var frn_eli_target="";
if(typeof baseDomain === 'undefined') var baseDomain="";  //also triggers ga logging
if(typeof pluginInstall === 'undefined') var pluginInstall="";

///////////////////
// _trackMailTo
if(typeof ga != 'undefined') {
	jQuery("body").ready(function($) {
		//used to use "document" ready instead of "body"
		$('a[href^="mailto"]').on('click', function(e) {
			ga('send', 'event', 'Email Address Clicks', this.href.replace(/^mailto:/i, ''));
		});
	});
}

///////////////////
// _trackOutbound
jQuery("body").ready(function($) {	
	
	var dom_pattern= new RegExp(location.host,"i");
	
	//sees if the domain of the page is different than the domain in the href
	$('a[href^="http"]').filter(function() {
       if((dom_pattern).test($(this).attr('href'))) return false;
	   else return true;
	}).on('click', function(e) {
	
    //Old case sensitive version: $('a[href^="http"]:not([href*="//' + location.host + '"])').on('click', function(e) {
		//Sees if external link is a download and track if so
		regex_pttn = /\.(zip|mp\\d+|mpe*g|pdf|docx*|pptx*|xlsx*|jpe*g|png|gif|tiff*)/i;
		if(regex_pttn.test(this.href) && typeof ga != 'undefined') { 
			ga('send', 'event', 'Downloads', regex_pttn.exec(this.href)[1].toUpperCase(), "Off-Site Download: "+this.href.replace(/^.*\/\//, ''));
			//alert("Outbound Download Tracked: (" + regex_pttn.exec(this.href)[1].toUpperCase() + ") " + this.href.replace(/^.*\/\//, ''));
		};
		//Tracks outbound link whether download or not
		if(typeof ga != 'undefined') ga('send', 'event', 'Outbound Links', "Outbound: "+this.href.match(/\/\/([^\/]+)/)[1]);
    });
	
	var currStyle="", hasbgimg="", styleBg="", img_check="";
	var ext_icon = "background-image:url('"+pluginInstall+"/frn_plugins/images/icon_ext_links.png'); background-repeat:no-repeat; background-position:right center; padding-right:14px; margin-right: 5px;";
	//Adds external link icon and target=_blank
	if(frn_eli_target!="D" || frn_eli_deact!="Y") {
		$('a[href^="http"]').filter(function() {
			   if((dom_pattern).test($(this).attr('href'))) return false;
			   else return true;
			}).each(function(e) {
				//Old case sensitive version: $('a[href^="http"]:not([href*="//' + location.host + '"])').each(function(e) {
				//alert($(this).attr("href"));
				if(frn_eli_deact!="Y" && !$(this).attr("data-exticon")) { 
				//deactivates icon for external links if variable = Y or if the link has data-exticon attribute defined
					//alert(currStyle);
					//check if inline styles present so we can just append to them
					currStyle=$(this).attr("style");
					if(typeof currStyle!="undefined") { //if there is a style attribute manually added to the link, add a semicolon
						currStyle=currStyle.trim(); //removes end spaces
						if(currStyle.substr(currStyle.length - 1)!=";") currStyle=currStyle+"; "; //adds a semicolon if inline style doesn't have one
					}
					else currStyle="";
					
					//Check if image is linked or if css uses a background image for linking
					img_check = $(this).html();
					styleBg=$(this).css('background-image');
					if(img_check.indexOf("img")==-1 && styleBg=="none") 
						$(this).attr("style", currStyle+ext_icon);
				}
				//sets the outbound link to open in another window by default
				if(frn_eli_target!="D" && !$(this).attr("data-target")) $(this).attr("target","_blank");
		});
	}
	
	if(frn_eli_deact!="Y" && !$(this).attr("data-exticon")) { 
		//deactivates icon for email addresses if variable = Y
		$('a[href^="mailto"]').each(function(e) {
			currStyle=$(this).attr("style");
			if(typeof currStyle != 'undefined') {
				currStyle=currStyle.trim(); //removes end spaces
				if(currStyle.substr(currStyle.length - 1)!=";") currStyle=currStyle+"; "; //adds a semi colon if inline style doesn't have one
			}
			else currStyle="";
			
			img_check = $(this).html();
			styleBg=$(this).css('background-image');
			if(img_check.indexOf("img")==-1 && styleBg=="none") 
				$(this).attr("style", currStyle+ext_icon);
		});
	}
	
});


///////////////////
// _trackDownloads
if(typeof ga != 'undefined') {
	jQuery("body").ready(function($) {
		// helper function - allow regex as jQuery selector
		$.expr[':'].regex = function(e, i, m) {
			var mP = m[3].split(','),
				l = /^(data|css):/,
				a = {
					method: mP[0].match(l) ? mP[0].split(':')[0] : 'attr',
					property: mP.shift().replace(l, '')
				},
				r = new RegExp(mP.join('').replace(/^\s+|\s+$/g, ''), 'ig');
			return r.test($(e)[a.method](a.property));
		};

		$('a:regex(href,\\.(zip|mp\\d+|mpe*g|pdf|docx*|pptx*|xlsx*|jpe*g|png|gif|tiff*))').on('click', function(e) {
			//Make sure it's on this website
			var download_error = "";
			if (this.href.indexOf(baseDomain)>0) {
				regex_pttn = /\.(zip|mp\\d+|mpe*g|pdf|docx*|pptx*|xlsx*|jpe*g|png|gif|tiff*)/i;
				ga('send', 'event', 'Downloads', regex_pttn.exec(this.href)[1].toUpperCase(), "On-Site Download: "+this.href.replace(/^.*\/\//, ''));
				//alert("On-Site Download Tracked: (" + regex_pttn.exec(this.href)[1].toUpperCase() + ") " + this.href.replace(/^.*\/\//, ''));
			}
		});
	});
}



///////////////////
// _trackError: track 404 - Page not found Errors
if(typeof ga != 'undefined') {
	if(typeof error_404_title === 'undefined') var error_404_title="Page Not Found";
	else if(error_404_title=="") error_404_title="Page Not Found";
	if(document.referrer=="") $site_referrer = "; Problem_on=[direct_visit/offsite]";
	else {
		if(document.referrer="http://"+location.host) $site_referrer = "; Problem_on=" + document.referrer.replace("http://"+location.host+"/","[homepage]");
		else $site_referrer = "; Problem_on=" + document.referrer.replace("http://"+location.host,"");
	}
	if (document.title.search(error_404_title) >=0) {
		regex_pttn = /\.(zip|mp\\d+|mpe*g|pdf|docx*|pptx*|xlsx*|jpe*g|png|gif|tiff*)/i;
		if(regex_pttn.test(location.pathname)) {error_label = "On-Site Download (" + regex_pttn.exec(location.pathname)[1].toUpperCase() + ")"; error_type = "Download Error";}
		else {error_label = "Page Not Found"; error_type = "Page Not Found";}
		ga('send', 'event', '404 Errors', error_type + "; Broken_URL=" + location.pathname + $site_referrer, error_label);
		//alert(error_type + "; Broken_URL=" + location.pathname + $site_referrer + "; Label:" + error_label);
	}
}



//#####
//### SOCIAL SHARING TRACKING
//#####

// Copyright 2012 Google Inc. All Rights Reserved.
// Tracking modified by daxon edwards 2014 in compliance with Universal Analytics

if(typeof ga != 'undefined') {
	/**
	 * @fileoverview A simple script to automatically track Facebook and Twitter
	 * buttons using Google Analytics social tracking feature.
	 * @author api.nickm@gmail.com (Nick Mihailovski)
	 * @author api.petef@gmail.com (Pete Frisella)
	 */


	/**
	 * Namespace.
	 * @type {Object}.
	 */
	var _ga = _ga || {};


	/**
	 * Tracks social interactions by iterating through each tracker object
	 * of the page, and calling the _trackSocial method. This function
	 * should be pushed onto the _gaq queue. For details on parameters see
	 * http://code.google.com/apis/analytics/docs/gaJS/gaJSApiSocialTracking.html
	 * @param {string} network The network on which the action occurs.
	 * @param {string} socialAction The type of action that happens.
	 * @param {string} opt_target Optional text value that indicates the
	 *     subject of the action.
	 * @param {string} opt_pagePath Optional page (by path, not full URL)
	 *     from which the action occurred.
	 * @return a function that iterates over each tracker object
	 *    and calls the _trackSocial method.
	 * @private
	 */
	_ga.getSocialActionTrackers_ = function(
		network, socialAction, opt_target, opt_pagePath) {
		//if(opt_pagePath!="") opt_pagePath = '{\'page\': '+opt_pagePath+'}';
	  return function() {
		var trackers = _gat._getTrackers();
		for (var i = 0, tracker; tracker = trackers[i]; i++) {
		  tracker._trackSocial(network, socialAction, opt_target, opt_pagePath);
		}
	  };
	};


	/**
	 * Tracks Facebook likes, unlikes and sends by subscribing to the Facebook
	 * JSAPI event model. Note: This will not track facebook buttons using the
	 * iframe method.
	 * @param {string} opt_pagePath An optional URL to associate the social
	 *     tracking with a particular page.
	 */
	_ga.trackFacebook = function(opt_pagePath) {
	  try {
		if (FB && FB.Event && FB.Event.subscribe) {
		  FB.Event.subscribe('edge.create', function(opt_target) {
			ga('send', 'social', _ga.getSocialActionTrackers_('facebook', 'like', opt_target, opt_pagePath));
		  });
		  FB.Event.subscribe('edge.remove', function(opt_target) {
			ga('send', 'social', _ga.getSocialActionTrackers_('facebook', 'unlike', opt_target, opt_pagePath));
		  });
		  FB.Event.subscribe('message.send', function(opt_target) {
			ga('send', 'social', _ga.getSocialActionTrackers_('facebook', 'send', opt_target, opt_pagePath));
		  });
		}
	  } catch (e) {}
	};


	/**
	 * Handles tracking for Twitter click and tweet Intent Events which occur
	 * everytime a user Tweets using a Tweet Button, clicks a Tweet Button, or
	 * clicks a Tweet Count. This method should be binded to Twitter click and
	 * tweet events and used as a callback function.
	 * Details here: http://dev.twitter.com/docs/intents/events
	 * @param {object} intent_event An object representing the Twitter Intent Event
	 *     passed from the Tweet Button.
	 * @param {string} opt_pagePath An optional URL to associate the social
	 *     tracking with a particular page.
	 * @private
	 */
	_ga.trackTwitterHandler_ = function(intent_event, opt_pagePath) {
	  var opt_target; //Default value is undefined
	  if (intent_event && intent_event.type == 'tweet' || intent_event.type == 'click') {
		if (intent_event.target.nodeName == 'IFRAME') {
		  opt_target = _ga.extractParamFromUri_(intent_event.target.src, 'url');
		}
		var socialAction = intent_event.type + ((intent_event.type == 'click') ? '-' + intent_event.region : ''); //append the type of click to action
		ga('send', 'social', _ga.getSocialActionTrackers_('twitter', socialAction, opt_target, opt_pagePath));
	  }
	};

	/**
	 * Binds Twitter Intent Events to a callback function that will handle
	 * the social tracking for Google Analytics. This function should be called
	 * once the Twitter widget.js file is loaded and ready.
	 * @param {string} opt_pagePath An optional URL to associate the social
	 *     tracking with a particular page.
	 */
	_ga.trackTwitter = function(opt_pagePath) {
	  intent_handler = function(intent_event) {
		_ga.trackTwitterHandler_(intent_event, opt_pagePath);
	  };

	  //bind twitter Click and Tweet events to Twitter tracking handler
	  twttr.events.bind('click', intent_handler);
	  twttr.events.bind('tweet', intent_handler);
	};


	/**
	 * Extracts a query parameter value from a URI.
	 * @param {string} uri The URI from which to extract the parameter.
	 * @param {string} paramName The name of the query paramater to extract.
	 * @return {string} The un-encoded value of the query paramater. undefined
	 *     if there is no URI parameter.
	 * @private
	 */
	_ga.extractParamFromUri_ = function(uri, paramName) {
	  if (!uri) {
		return;
	  }
	  var regex = new RegExp('[\\?&#]' + paramName + '=([^&#]*)');
	  var params = regex.exec(uri);
	  if (params != null) {
		return unescape(params[1]);
	  }
	  return;
	};

}
