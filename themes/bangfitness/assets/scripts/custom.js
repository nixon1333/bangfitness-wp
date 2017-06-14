var Froogaloop=function(){function e(c){return new e.fn.init(c)}function g(c,b,a){if(!a.contentWindow.postMessage)return!1;var d=a.getAttribute("src").split("?")[0],c=JSON.stringify({method:c,value:b});a.contentWindow.postMessage(c,d)}function i(c){var b,a;try{b=JSON.parse(c.data),a=b.event||b.method}catch(l){}"ready"==a&&!h&&(h=!0);if(c.origin!=j)return!1;var c=b.value,e=b.data,f=""===f?null:b.player_id;b=f?d[f][a]:d[a];a=[];if(!b)return!1;void 0!==c&&a.push(c);e&&a.push(e);f&&a.push(f);return 0<
a.length?b.apply(null,a):b.call()}function k(c,b,a){a?(d[a]||(d[a]={}),d[a][c]=b):d[c]=b}var d={},h=!1,j="";e.fn=e.prototype={element:null,init:function(c){"string"===typeof c&&(c=document.getElementById(c));this.element=c;for(var c=this.element.getAttribute("src").split("/"),b="",a=0,d=c.length;a<d;a++){if(3>a)b+=c[a];else break;2>a&&(b+="/")}j=b;return this},api:function(c,b){if(!this.element||!c)return!1;var a=this.element,d=""!==a.id?a.id:null,e=!b||!b.constructor||!b.call||!b.apply?b:null,f=
b&&b.constructor&&b.call&&b.apply?b:null;f&&k(c,f,d);g(c,e,a);return this},addEvent:function(c,b){if(!this.element)return!1;var a=this.element,d=""!==a.id?a.id:null;k(c,b,d);"ready"!=c?g("addEventListener",c,a):"ready"==c&&h&&b.call(null,d);return this},removeEvent:function(c){if(!this.element)return!1;var b=this.element,a;a:{if((a=""!==b.id?b.id:null)&&d[a]){if(!d[a][c]){a=!1;break a}d[a][c]=null}else{if(!d[c]){a=!1;break a}d[c]=null}a=!0}"ready"!=c&&a&&g("removeEventListener",c,b)}};e.fn.init.prototype=
e.fn;window.addEventListener?window.addEventListener("message",i,!1):window.attachEvent("onmessage",i,!1);return window.Froogaloop=window.$f=e}();

/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

;(function( $ ){

  'use strict';

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement("div");
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        'iframe[src*="player.vimeo.com"]',
        'iframe[src*="youtube.com"]',
        'iframe[src*="youtube-nocookie.com"]',
        'iframe[src*="kickstarter.com"][src*="video.html"]',
        'object',
        'embed'
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not('object object'); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(count){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + count;
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+'%');
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );