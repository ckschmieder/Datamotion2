// Compiled by CoffeeScript 1.6.3 on 2016-02-02 20:04:13
/*
Form Validation jQuery Functions
*/


(function() {
  var $;

  $ = jQuery;

  $.fn.ajaxValidate = function(options, ajax_options) {
    var $form, $input, ajax_defaults, ajax_opts, defaults, opts, val;
    $input = this;
    $form = $input.closest('form');
    val = $input.val();
    defaults = {
      submit_button: $form.find('input[type="submit"]')
    };
    opts = $.extend(defaults, options);
    ajax_defaults = {
      type: 'POST',
      dataType: 'json',
      success: function(json) {
        if (json.status === 'ERROR') {
          opts.submit_button.disable();
          $input.next('.validate_message').remove();
          return $input.after($('<div/>', {
            'class': 'validate_message invalid',
            text: json.message
          }));
        } else {
          if (!$form.hasInvalidFields()) {
            opts.submit_button.enable();
          }
          $input.next('.validate_message').remove();
          return $input.after($('<div/>', {
            'class': 'validate_message valid'
          }));
        }
      }
    };
    ajax_opts = $.extend(ajax_defaults, ajax_options);
    ajax_opts.data = {};
    ajax_opts.data[opts.data_key] = val;
    return $.ajax(ajax_opts);
  };

  $.fn.validateBlank = function(options) {
    var $form, $input, defaults, opts, val;
    $input = this;
    $form = $input.closest('form');
    val = $input.val();
    defaults = {
      submit_button: $form.find('input[type="submit"]')
    };
    opts = $.extend(defaults, options);
    if (val === '') {
      opts.submit_button.disable();
      $input.next('.validate_message').remove();
      $input.after($('<div/>', {
        'class': 'validate_message invalid',
        text: 'Cannot be blank'
      }));
      return false;
    } else {
      if (!$form.hasInvalidFields()) {
        opts.submit_button.enable();
      }
      $input.next('.validate_message').remove();
      $input.after($('<div/>', {
        'class': 'validate_message valid'
      }));
      return true;
    }
  };

  $.fn.validateMatch = function(options) {
    var $form, $input, $match_field, defaults, message, opts, val;
    $input = this;
    $form = $input.closest('form');
    val = $input.val();
    defaults = {
      submit_button: $form.find('input[type="submit"]'),
      match_field: $input.closest('form').find('#user_password_confirmation'),
      message: 'Must match'
    };
    opts = $.extend(defaults, options);
    $match_field = opts.match_field;
    if (val !== $match_field.val() || val === '') {
      message = $('<div/>', {
        'class': 'validate_message invalid',
        text: opts.message
      });
      opts.submit_button.disable();
      $input.next('.validate_message').remove();
      $match_field.next('.validate_message').remove();
      $input.after(message);
      $match_field.after(message.clone());
      return false;
    } else {
      message = $('<div/>', {
        'class': 'validate_message valid'
      });
      if (!$form.hasInvalidFields()) {
        opts.submit_button.enable();
      }
      $input.next('.validate_message').remove();
      $match_field.next('.validate_message').remove();
      $input.after(message);
      $match_field.after(message.clone());
      return true;
    }
  };

  $.fn.validateLength = function(options) {
    var $form, $input, default_length, defaults, message, opts, val;
    $input = this;
    $form = $input.closest('form');
    val = $input.val();
    default_length = 6;
    defaults = {
      submit_button: $form.find('input[type="submit"]'),
      length: default_length,
      message: "Must be at least " + default_length + " characters"
    };
    opts = $.extend(defaults, options);
    if (val.length < opts.length) {
      message = $('<div/>', {
        'class': 'validate_message invalid',
        text: message
      });
      opts.submit_button.disable();
      $input.next('.validate_message').remove();
      $input.after(message);
      return false;
    } else {
      message = $('<div/>', {
        'class': 'validate_message valid'
      });
      if (!$form.hasInvalidFields()) {
        opts.submit_button.enable();
      }
      $input.next('.validate_message').remove();
      $input.after(message);
      return true;
    }
  };

  $.fn.disable = function() {
    return $(this).attr('disabled', 'disabled').addClass('disabled');
  };

  $.fn.enable = function() {
    return $(this).removeAttr('disabled').removeClass('disabled');
  };

  $.fn.toggleDisable = function() {
    if ($(this).attr('disabled')) {
      return $(this).enable();
    } else {
      return $(this).disable();
    }
  };

  $.fn.hasInvalidFields = function() {
    return $(this).find('.invalid').size() > 0;
  };

}).call(this);
