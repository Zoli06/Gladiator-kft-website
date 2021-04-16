'use strict'

var searchAvaible = false;
var isPhoneView;
var animationDuration = 200;

function phoneView() {
  var windowWidth = getWidth();
  if (windowWidth <= 680) {
    $('nav div .search-div img#open-img').stop().show();
    $('nav div .search-div img#search-img').stop().hide();
    $('nav div .search-div img#close-img').stop().hide();
    $('nav div .search-div .search').stop().hide();
    $('nav div a').stop().show();
    searchAvaible = false;
  } else {
    $('nav div .search-div img#open-img').stop().hide();
    $('nav div .search-div img#search-img').stop().show();
    $('nav div .search-div img#close-img').stop().hide();
    $('nav div .search-div .search').stop().show();
    $('nav div a').stop().show();
  }
}

$(document).scroll(function () {
  onScroll();
});

function getWidth() {
  return ((window.innerWidth > 0) ? window.innerWidth : screen.width);
}

var isDesktop = getWidth() > 680;
$(window).resize(function () {
  if ((getWidth() > 680) == isDesktop) return;
  isDesktop = getWidth() > 680;

  callQuickfit();
  phoneView();
});

function vh(v) {
  var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
  return (v * h) / 100;
}

function vw(v) {
  var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
  return (v * w) / 100;
}

function vmin(v) {
  return Math.min(vh(v), vw(v));
}

function vmax(v) {
  return Math.max(vh(v), vw(v));
}

function onScroll() {
  const minOpacity = 0.8;
  const maxOpacity = 1;
  const minHeight = vh(6);
  const maxHeight = vh(9.24);
  const changeIntervalStart = $('nav').height();
  const changeIntervalEnd = $(window).height() / 2;
  const guidelineValue = $(document).scrollTop();

  if ($(document).scrollTop() >= changeIntervalStart && $(document).scrollTop() <= changeIntervalEnd) {
    $('nav').css({ opacity: projectValue(minOpacity, maxOpacity, changeIntervalStart, changeIntervalEnd, guidelineValue) });
  } else if ($(document).scrollTop() <= changeIntervalStart) {
    $('nav').css({ opacity: maxOpacity })
  } else if ($(document).scrollTop() >= changeIntervalEnd) {
    $('nav').css({ opacity: minOpacity })
  }
}

function projectValue(minValue, maxValue, changeIntervalStart, changeIntervalEnd, guidelineValue) {
  return maxValue - ((100 / (changeIntervalEnd - changeIntervalStart) * (guidelineValue - changeIntervalStart)) / (100 / (1 - minValue)));
}

function callQuickfit() {
  $(".scrollable-machine h3, .goods-container .box h3").quickfit({
    max: vw(2)
  });
}

function redirectToSubpage(machine, path) {
  path = path.replace('./goods/', '');
  path = path.slice(0, path.indexOf('/', path.indexOf('/')));
  window.location.href = window.location.origin + '/pricelist.php?category=' + path + '&scroll=' + machine;
}

function watchFullText() {
  $('.long-text.min span').hide();
  $('.long-text.max').show();
}

function sendMail() {
  var name = $('#name').val();
  var email = $('#email').val();
  var subject = $('#subject').val();
  var message = $('#message').val();

  var waiting = '<p id="waiting" class="completed-status">' +
    '            <img alt="várakozás" src="./images/ezgif-5-eda144892486.gif" alt="completed_symbol" />' +
    '            <span>Küldés...</span>' +
    '          </p>';

  var finished = '<p id="finished" class="completed-status">' +
    '            <img alt="elküldve" alt src="./images/imageedit_1_9183836706.gif" alt="completed_symbol" />' +
    '            <span>E-mail elküldve!</span>' +
    '          </p>';

  $('#textboxes').after(waiting);
  $.post('contact.php', { name: name, email: email, subject: subject, message: message }).done(function () {
    $('#waiting').remove();
    $('#textboxes').after(finished);
  });
}

function isEmpty(str) {
  return (!str || str.length === 0 || /^\s*$/.test(str));
}

function search() {
  var input = document.getElementById("search");
  if (!isEmpty(input.value)) {
    window.location.href = window.location.origin + '/pricelist.php?category=search&lookingFor=' + input.value;
  }
}

function selectCategory(element) {
  var url = window.location.origin + '/pricelist.php?category=' + element.innerText;
  window.location.href = url;
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return undefined;
}

(function ($) {
  var Quickfit, QuickfitHelper, defaults, pluginName;

  pluginName = 'quickfit';

  defaults = {
    min: 8,
    max: 12,
    tolerance: 0.02,
    truncate: false,
    width: null,
    sampleNumberOfLetters: 10,
    sampleFontSize: 12
  };
  QuickfitHelper = (function () {

    var sharedInstance = null;

    QuickfitHelper.instance = function (options) {
      if (!sharedInstance) {
        sharedInstance = new QuickfitHelper(options);
      }
      return sharedInstance;
    };

    function QuickfitHelper(options) {
      this.options = options;

      this.item = $('<span id="meassure"></span>');
      this.item.css({
        position: 'absolute',
        left: '-1000px',
        top: '-1000px',
        'font-size': "" + this.options.sampleFontSize + "px"
      });
      $('body').append(this.item);

      this.meassures = {};
    }

    QuickfitHelper.prototype.getMeassure = function (letter) {
      var currentMeassure;
      currentMeassure = this.meassures[letter];
      if (!currentMeassure) {
        currentMeassure = this.setMeassure(letter);
      }
      return currentMeassure;
    };

    QuickfitHelper.prototype.setMeassure = function (letter) {
      var currentMeassure, index, sampleLetter, text, _ref;

      text = '';
      sampleLetter = letter === ' ' ? '&nbsp;' : letter;

      for (index = 0, _ref = this.options.sampleNumberOfLetters - 1; 0 <= _ref ? index <= _ref : index >= _ref; 0 <= _ref ? index++ : index--) {
        text += sampleLetter;
      }

      this.item.html(text);
      currentMeassure = this.item.width() / this.options.sampleNumberOfLetters / this.options.sampleFontSize;
      this.meassures[letter] = currentMeassure;

      return currentMeassure;
    };

    return QuickfitHelper;

  })();

  Quickfit = (function () {

    function Quickfit(element, options) {
      this.$element = element;
      this.options = $.extend({}, defaults, options);
      this.$element = $(this.$element);
      this._defaults = defaults;
      this._name = pluginName;
      this.quickfitHelper = QuickfitHelper.instance(this.options);
    }

    Quickfit.prototype.fit = function () {
      var elementWidth;
      if (!this.options.width) {
        elementWidth = this.$element.width();
        this.options.width = elementWidth - this.options.tolerance * elementWidth;
      }
      if (this.text = this.$element.attr('data-quickfit')) {
        this.previouslyTruncated = true;
      } else {
        this.text = this.$element.text();
      }
      this.calculateFontSize();

      if (this.options.truncate) this.truncate();

      return {
        $element: this.$element,
        size: this.fontSize
      };
    };

    Quickfit.prototype.calculateFontSize = function () {
      var letter, textWidth, i;

      textWidth = 0;
      for (i = 0; i < this.text.length; ++i) {
        letter = this.text.charAt(i);
        textWidth += this.quickfitHelper.getMeassure(letter);
      }

      this.targetFontSize = parseInt(this.options.width / textWidth);
      return this.fontSize = Math.max(this.options.min, Math.min(this.options.max, this.targetFontSize));
    };

    Quickfit.prototype.truncate = function () {
      var index, lastLetter, letter, textToAdd, textWidth;

      if (this.fontSize > this.targetFontSize) {
        textToAdd = '';
        textWidth = 3 * this.quickfitHelper.getMeassure('.') * this.fontSize;

        index = 0;
        while (textWidth < this.options.width && index < this.text.length) {
          letter = this.text[index++];
          if (lastLetter) textToAdd += lastLetter;
          textWidth += this.fontSize * this.quickfitHelper.getMeassure(letter);
          lastLetter = letter;
        }

        if (textToAdd.length + 1 === this.text.length) {
          textToAdd = this.text;
        } else {
          textToAdd += '...';
        }
        this.textWasTruncated = true;

        return this.$element.attr('data-quickfit', this.text).html(textToAdd);

      } else {
        if (this.previouslyTruncated) {
          return this.$element.html(this.text);
        }
      }
    };

    return Quickfit;

  })();

  return $.fn.quickfit = function (options) {
    var measurements = [];

    // Separate measurements from repaints
    // First calculate all measurements...
    var $elements = this.each(function () {
      var measurement = new Quickfit(this, options).fit();
      measurements.push(measurement);
      return measurement.$element;
    });

    // ... then apply the measurements.
    for (var i = 0; i < measurements.length; i++) {
      var measurement = measurements[i];

      measurement.$element.css({ fontSize: measurement.size + 'px' });
    }

    return $elements;
  };

})(jQuery, window);

//$(document).ready(function () {
  var i = 0;
  var pictures = 5;
  var loaded = false;
  var time = 7500;
  var animationDuration = 0;
  //$('header:not(.subpage) div h1, header div p').css('color', 'black');

  var changeBackground = function () {
    if (animationDuration == 0) {
      $('header').append('<div class="background" style="background-image: url(\'../images/background0.webp\')"></div>');
    } else if (!loaded) {
      $('header').append('<div class="background" style="background-image: url(\'../images/background' + i + '.webp\'); opacity: 0"></div>');
    }
    if (!animationDuration == 0) {
      $('header:not(#subpage) .background').stop().fadeTo(animationDuration, 0);
      $('header:not(#subpage) .background:eq(' + (i) + ')').stop().fadeTo(animationDuration, 1);
    }
    if (i != 0) {
      if (i == 1) {
        $('header:not(#subpage) div h1, header div h2').css('color', 'black');
      } else {
        $('header:not(#subpage) div h1, header div h2').css('color', 'white');
      }
    }
    if (i == pictures) {
      i = 0;
      loaded = true;
    }
    animationDuration = 200;
    i++;
    setTimeout(changeBackground, time);
  }
  changeBackground();

  /*setInterval(function () {
    if(!loaded) {
      $('header').append('<div class="background" style="background-image: url(\'../images/background' + i + '.webp\')"></div>')
    }
    $('header:not(.subpage) .background').stop().fadeTo('fast', 0);
    $('header:not(.subpage) .background:eq(' + (i-1) + ')').stop().fadeTo('fast', 1);
    if(i == 6) {
      $('header:not(.subpage) div h1, header div p').css('color', 'black');
    } else {
      $('header:not(.subpage) div h1, header div p').css('color', 'white');
    }
    if(i == pictures) {
      i = 0;
      loaded = true;
    }
    i++;
  }, 7500);*/

  $('.img-container.google-maps').append('<iframe title="Váci út 59" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4704.750499788218!2d19.07733520527396!3d47.571989195245976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741da23ecba6b4f%3A0x29979b66898e66ae!2zQnVkYXBlc3QsIFbDoWNpIMO6dCA1OSwgMTA0Nw!5e0!3m2!1shu!2shu!4v1608304731556!5m2!1shu!2shu" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>');

  onScroll();
  callQuickfit();
  $(".scroll-box.prev-box").click(function () {
    $('.scrollable-machine-container .box-container').animate({
      scrollLeft: $('.scrollable-machine-container .box-container').scrollLeft() - 500
    },
      300);
  });

  $(".scroll-box.next-box").click(function () {
    $('.scrollable-machine-container .box-container').animate({
      scrollLeft: $('.scrollable-machine-container .box-container').scrollLeft() + 500
    },
      300);
  });

  var input = document.getElementById("search");
  input.addEventListener("keyup", function (event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      search();
    }
  });

  phoneView();

  $('nav div .search-div img:not(#search-img)').click(function () {
    if (searchAvaible) {
      $('nav div .search-div .search').stop().hide(animationDuration);
      $('nav div a').stop().show(animationDuration);
      $('nav div .search-div img#open-img').stop().show(animationDuration);
      $('nav div .search-div img#close-img').stop().hide(animationDuration);
      searchAvaible = false;
    } else {
      $('nav div .search-div .search').stop().show(animationDuration);
      $('nav div a').stop().hide(animationDuration);
      $('nav div .search-div img#open-img').stop().hide(animationDuration);
      $('nav div .search-div img#close-img').stop().show(animationDuration);
      searchAvaible = true;
    }
  });

  if (getCookie('hide-cookie') !== undefined) {
    $(".cookie-div").remove();
  }

  $(".close-button").click(function () {
    $(".cookie-div").remove();
    setCookie('hide-cookie', true);
  });

  if (window.location.pathname.slice(0, 14) == '/pricelist.php') {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const scroll = urlParams.get('scroll')
    if (scroll != undefined) {
      try { //if it doesn't find the element, throws error
        var coordinate = Array.from(document.querySelectorAll('h3'))
          .find(el => el.textContent == scroll).parentElement.offsetTop;

        setTimeout(() => {
          $('html').animate({
            scrollTop: coordinate - $('nav').height()
          },
            500);
        }, 250);
      }

      catch (e) { }
    }
  }
//});