// Compiled by CoffeeScript 1.6.3 on 2016-02-02 20:04:13
/*
DataMotion WordPress Theme
Main CoffeeScript

Authors:
  Mike Green <mike@fifthroomcreative.com>
  Ron de Leon <ron@fifthroomcreative.com>
*/


(function() {
  var __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

  $(document).ready(function() {
    /*
    Alerts
    */

    var $alert, $feat_vid, $menu_container, $newsletter_form, $play_btn, $spinner, $thumb_link, $trial_form, $vid_thumb, cycle_alerts, cycle_alerts_interval, cycle_speed, mobileMatcher, resolution_match, resolution_query, width_listener, width_match, width_query, windowStartWidth, zopimExists, zopimHide, zopimMedia, zopimVisible;
    if ($('#alert').size()) {
      $alert = $('#alert');
      cycle_speed = $alert.data('speed') ? $alert.data('speed') * 1000 : 5000;
      $alert.data('currentAlert', 0);
      $alert.find('p').hide().eq(0).show();
      cycle_alerts = function() {
        var $current, $next, current_idx, next_idx;
        current_idx = $alert.data('currentAlert');
        next_idx = current_idx + 1;
        $current = $alert.find('p').eq(current_idx);
        $next = $alert.find('p').eq(next_idx);
        if (!$next.size()) {
          next_idx = 0;
          $next = $alert.find('p').eq(next_idx);
        }
        return $current.fadeOut(400, function() {
          $next.fadeIn(400);
          return $alert.data('currentAlert', next_idx);
        });
      };
      if ($alert.find('p').size() > 1) {
        cycle_alerts_interval = setInterval(cycle_alerts, cycle_speed);
      }
      $alert.find('a.close_alert').click(function() {
        $(this).parent().fadeOut(400);
        if ($alert.find('p').size() > 1) {
          clearInterval(cycle_alerts_interval);
        }
        return false;
      });
    }
    /*
    Misc
    */

    $('.tweet a').attr('target', '_blank');
    $('a[href^="http"]').attr('target', function(idx, attr) {
      if (this.href.indexOf(window.location.hostname) === -1) {
        return '_blank';
      } else {
        return attr;
      }
    });
    $('.footer_info_links li.no-link').each(function() {
      var $link, txt;
      $link = $(this).find('a');
      txt = $link.text();
      $link.remove();
      return $(this).text(txt);
    });
    $('#video_embed').fitVids();
    $('.two_column').fitVids();
    if ($(window).innerWidth() > 767) {
      $('a[rel="fancybox"]').fancybox();
      $('a.offsite[rel="fancybox"]').unbind('click').fancybox({
        hideOnContentClick: false,
        width: 735,
        height: 600,
        showNavArrows: false,
        cyclic: false,
        enableEscapeButton: false
      });
      $('a[rel="fancybox"].youtube').unbind('click').click(function() {
        $.fancybox({
          padding: 0,
          autoScale: false,
          transitionIn: 'none',
          transitionOut: 'none',
          width: 680,
          height: 495,
          href: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
          type: 'swf',
          swf: {
            allowfullscreen: 'true',
            wmode: 'transparent'
          }
        });
        return false;
      });
    }
    if ($('.featured_video').size()) {
      $feat_vid = $('.featured_video');
      $thumb_link = $feat_vid.find('#video_thumb');
      $vid_thumb = $thumb_link.find('img.thumb');
      $play_btn = $thumb_link.find('.play_button');
      $vid_thumb.imagesLoaded(function($images, $proper, $broken) {
        var height_diff, width_diff;
        height_diff = $vid_thumb.height() - $play_btn.height();
        width_diff = $vid_thumb.innerWidth() - $play_btn.width();
        return $play_btn.css({
          top: (height_diff / 2) + 'px',
          left: (width_diff / 2) + 'px'
        });
      });
    }
    $("li.menu-item ul ul").closest("li").find("a:first").append("<span class=\"raquo_web\">&raquo;</span>");
    $("ul.sub-menu").closest("li").find("a:first").append("<span class=\"raquo_mobile\">&raquo;</span>");
    $('.library_sections div:eq(1)').after($('<div/>', {
      'class': 'clearfix',
      css: {
        float: 'none',
        width: 'auto',
        margin: '0px'
      }
    }));
    $(window).scroll(function() {
      if ($(this).scrollTop() > 100) {
        return $("#scroll_to_top").fadeIn();
      } else {
        return $("#scroll_to_top").fadeOut();
      }
    });
    $("#scroll_to_top a").click(function() {
      $("body,html").animate({
        scrollTop: 0
      }, 800);
      return false;
    });
    if (Modernizr.matchmedia) {
      resolution_query = "only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (min--moz-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 3/2), only screen and (min-resolution: 1.5dppx)";
      resolution_match = window.matchMedia(resolution_query);
      if (resolution_match.matches) {
        $('img[data-retina-src]').each(function() {
          return $(this).attr('src', $(this).attr('data-retina-src'));
        });
      }
      width_query = "only screen and (max-width: 1023px)";
      width_match = window.matchMedia(width_query);
      width_listener = function(match) {
        var $container, container_width;
        $container = $('.two_column');
        container_width = $container.innerWidth();
        return $container.find('img').each(function() {
          var $img, height_attr, width_attr;
          $img = $(this);
          width_attr = $(this).attr('width');
          height_attr = $(this).attr('height');
          if (match.matches) {
            if (width_attr.indexOf('%') === -1 && parseInt(width_attr) > container_width) {
              $img.data('oldWidth', width_attr);
              $img.data('oldHeight', height_attr);
              return $img.attr({
                width: '100%',
                height: 'auto'
              });
            }
          } else {
            if (width_attr === '100%' && $img.data('oldWidth')) {
              return $img.attr({
                width: $img.data('oldWidth'),
                height: $img.data('oldHeight')
              });
            }
          }
        });
      };
      if (Modernizr.matchmedialistener) {
        width_match.addListener(width_listener);
      }
      width_listener(width_match);
    }
    /*
    Newsletter Subscription Form
    */

    if ($('.newsletter_form').size()) {
      $newsletter_form = $('.newsletter_form form');
      $newsletter_form.submit(function() {
        var $email, $name, jax;
        $name = $newsletter_form.find('#newsletter_name');
        $email = $newsletter_form.find('#newsletter_email');
        jax = $.ajax($(this).attr('action'), {
          type: 'POST',
          dataType: 'json',
          data: {
            name: $name.val(),
            email: $email.val()
          }
        });
        jax.success(function(json) {
          if (json.status === 'OK') {
            return $newsletter_form.fadeOut(500, function() {
              $('.newsletter_form').find('p.status').remove();
              return $('.newsletter_form').append('<p>' + json.message + '</p>');
            });
          } else {
            $('.newsletter_form').find('p.status').remove();
            return $('.newsletter_form').find('h3').after($('<p/>', {
              'class': 'status',
              text: json.message
            }));
          }
        });
        return false;
      });
    }
    /*
    Free Trial Registration Form
    */

    if ($('.free_trial_form').size()) {
      $trial_form = $('.free_trial_form form');
      $spinner = $trial_form.find('.spinner');
      $trial_form.append($('<input/>', {
        'type': 'hidden',
        'name': 'is_ajax',
        'value': 'true'
      }));
      $trial_form.submit(function() {
        var $fields, form_data, jax, trial_url;
        trial_url = $(this).attr('action');
        $fields = {
          first_name: $trial_form.find('#first_name'),
          last_name: $trial_form.find('#last_name'),
          email: $trial_form.find('#email'),
          company: $trial_form.find('#company'),
          phone: $trial_form.find('#phone')
        };
        form_data = $(this).serialize();
        jax = $.ajax(trial_url, {
          type: 'POST',
          dataType: 'json',
          data: form_data,
          beforeSend: function(xhr, settings) {
            return $spinner.show();
          }
        });
        jax.success(function(json, txt, xhr) {
          $spinner.hide();
          return window.location.href = '/trial-thank-you';
        });
        jax.error(function(xhr, txt, err) {
          var json, status_code;
          status_code = xhr.status;
          $spinner.hide();
          if (status_code === 400) {
            json = $.parseJSON(xhr.responseText);
            $.each(json.fields, function(i, val) {
              var $field;
              $field = $fields[val];
              return $field.addClass('error');
            });
            return alert(json.message);
          } else if (status_code === 500) {
            json = $.parseJSON(xhr.responseText);
            return alert(json.message);
          }
        });
        return false;
      });
    }
    /*
    Mobile Navigation
    */

    windowStartWidth = $(window).width();
    $("div.mobile_navigation ul.sub-menu").css("left", windowStartWidth);
    $menu_container = $('div.mobile_navigation div.menu-header-menu-container');
    $menu_container.data('topLevel', true);
    $('li.title').each(function() {
      var $parent_link, $title_link;
      $parent_link = $(this).closest('ul').closest('li').children('a').eq(0);
      $title_link = $(this).find('a');
      return $title_link.text($parent_link.text());
    });
    $(window).bind('resize', function() {
      var width;
      width = $(window).width();
      $('div.mobile_navigation ul.sub-menu').css("left", width + 'px');
      if (!$menu_container.data('topLevel')) {
        $menu_container.css('marginLeft', -width + 'px');
      }
      if ($('.collapse-header').size()) {
        return $('.collapse-header').each(function() {
          var $content, $plus_minus;
          $content = $(this).next('.collapsible-content');
          $plus_minus = $(this).find('.plus_minus');
          if ($content.is(':visible')) {
            return $plus_minus.text('-');
          } else {
            return $plus_minus.text('+');
          }
        });
      }
    });
    $("div.mobile_navigation li a").click(function() {
      var $child_ul, $list_item, current_left, new_left, window_width;
      $list_item = $(this).closest('li');
      $child_ul = $list_item.children('ul');
      window_width = $(window).width();
      current_left = parseInt($menu_container.css('marginLeft'), 10);
      new_left = current_left - window_width;
      if ($child_ul.size()) {
        $menu_container.data('topLevel', false);
        $list_item.addClass("current");
        $list_item.children("ul.sub-menu").css("display", "block");
        $menu_container.animate({
          marginLeft: new_left + 'px'
        });
        return false;
      }
      return true;
    });
    $("div.mobile_navigation li.title a").unbind('click').click(function(evt) {
      var $current_li, $current_ul, $list_item, current_margin_left, new_margin_left, window_width;
      $list_item = $(this).closest('li');
      $current_ul = $list_item.closest('ul');
      $current_li = $menu_container.find('li.current');
      window_width = $(window).width();
      current_margin_left = parseInt($menu_container.css('marginLeft'));
      new_margin_left = current_margin_left + window_width;
      if (new_margin_left === 0) {
        $menu_container.data('topLevel', true);
      }
      $menu_container.animate({
        marginLeft: new_margin_left + 'px'
      }, 400, function() {
        $current_ul.css('display', 'none');
        $current_ul.closest('li').removeClass('current');
        if ($menu_container.data('topLevel')) {
          return $current_li.removeClass('current');
        }
      });
      return false;
    });
    $('#mobile_nav_icon').click(function(evt) {
      var $icon;
      $icon = $(this);
      return $menu_container.toggle('slide', {
        direction: 'up'
      }, 400, function() {
        var add_class, rm_class;
        add_class = $icon.hasClass('mobile_nav_drop_icon') ? 'mobile_nav_icon_active' : 'mobile_nav_drop_icon';
        rm_class = $icon.hasClass('mobile_nav_drop_icon') ? 'mobile_nav_drop_icon' : 'mobile_nav_icon_active';
        return $icon.addClass(add_class).removeClass(rm_class);
      });
    });
    if (Modernizr.anytouch || $('.faq').size()) {
      $('.collapse-header').each(function() {
        var $content, $plus_minus;
        $content = $(this).next('.collapsible-content');
        $plus_minus = $(this).find('.plus_minus');
        if ($content.is(':visible')) {
          return $plus_minus.text('-');
        } else {
          return $plus_minus.text('+');
        }
      });
      $('.collapse-header a').click(function(evt) {
        var $content, $plus_minus;
        $plus_minus = $(this).hasClass('plus_minus') ? $(this) : $(this).next('.plus_minus');
        $content = $(this).parent().next('.collapsible-content');
        $content.toggle();
        if ($content.is(':visible')) {
          $plus_minus.text('-');
        } else {
          $plus_minus.text('+');
        }
        return false;
      });
    } else {
      $('.collapse-header a').click(function() {
        return false;
      });
    }
    zopimVisible = true;
    zopimExists = function() {
      return __indexOf.call(window, '$zopim') >= 0 && typeof window.$zopim === 'function';
    };
    zopimHide = function() {
      $zopim(function() {
        return $zopim.livechat.window.hide();
      });
      return zopimVisible = false;
    };
    zopimMedia = function(matcher) {
      if (matcher.matches) {
        return zopimHide();
      }
    };
    if (Modernizr.matchmedia && Modernizr.matchmedialistener) {
      mobileMatcher = matchMedia("screen and (max-width: 767px)");
      mobileMatcher.addListener(zopimMedia);
      zopimMedia(mobileMatcher);
    } else {
      if ($(window).innerWidth() < 768) {
        zopimMedia({
          matches: true
        });
      }
    }
    return $('a[data-track-event]').on('click', function(evt) {
      var $this, action, category, hitCallback, href, label, params, target, value;
      if (!window.__gaTracker) {
        return true;
      }
      $this = $(this);
      href = $this.attr('href');
      target = $this.attr('target');
      category = $this.data('trackEvent');
      action = $this.data('eventAction');
      label = $this.data('eventLabel');
      value = $this.data('eventValue');
      hitCallback = function() {
        return window.location.href = href;
      };
      if (target !== '_blank') {
        evt.preventDefault();
        evt.stopPropagation();
      }
      params = {
        hitType: 'event'
      };
      params.eventCategory = category || 'link';
      params.eventAction = action || 'click';
      params.eventLabel = label || '';
      params.eventValue = value || 1;
      if (target !== '_blank') {
        params.hitCallback = hitCallback;
      }
      __gaTracker('send', params);
      if (target === '_blank') {
        return true;
      }
    });
  });

  $(window).load(function() {
    var images_loaded_callback;
    images_loaded_callback = function($images, $proper, $broken) {
      var show_images;
      $('#slider').flexslider({
        animation: 'slide'
      });
      show_images = function() {
        return $('#slider img').show();
      };
      return setTimeout(show_images, 100);
    };
    if ($('html').hasClass('ie')) {
      images_loaded_callback();
    } else {
      $('#slider').imagesLoaded(images_loaded_callback);
    }
    $('#customer_slider').flexslider({
      animation: 'slide',
      directionNav: true,
      itemWidth: 222,
      minItems: 2,
      maxItems: 4,
      controlNav: false
    });
    if (Modernizr.anytouch && !window.location.hash) {
      return setTimeout((function() {
        return window.scrollTo(0, 1);
      }), 100);
    }
  });

}).call(this);
