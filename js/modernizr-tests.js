// Compiled by CoffeeScript 1.6.3 on 2016-02-02 20:04:14
/*
Custom Modernizr Tests
*/


(function() {
  Modernizr.addTest('matchmedia', function() {
    return (window.matchMedia != null) && typeof window.matchMedia === 'function';
  });

  Modernizr.addTest('matchmedialistener', function() {
    var match;
    if (Modernizr.matchmedia) {
      match = window.matchMedia('only all');
      return (match.addListener != null) && typeof match.addListener === 'function';
    } else {
      return false;
    }
  });

  Modernizr.addTest('dpr', function() {
    return window.devicePixelRatio != null;
  });

  Modernizr.addTest('anytouch', function() {
    var touch;
    touch = Modernizr.prefixed("MaxTouchPoints", navigator);
    return Modernizr.touch || touch > 1;
  });

  Modernizr.addTest('pointerevents', function() {
    return Modernizr.prefixed("PointerEnabled", navigator);
  });

}).call(this);
