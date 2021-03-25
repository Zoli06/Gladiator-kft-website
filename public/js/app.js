'use strict'

$(document).ready(function () {
  var i = 1;
  var pictures = 6;
  var loaded = false;
  var time = 7500;
  var animationDuration = 0;
  //$('header:not(.subpage) div h1, header div p').css('color', 'black');

  var changeBackground = function () {
    if (!loaded) {
      $('header').append('<div class="background" style="background-image: url(\'../images/background' + i + '.webp\'); opacity: 0"></div>')
    }
    if(animationDuration == 0) {
      $('header:not(.subpage) .background').css('opacity', 1);
    } else {
      $('header:not(.subpage) .background').stop().fadeTo(animationDuration, 0);
      $('header:not(.subpage) .background:eq(' + (i - 1) + ')').stop().fadeTo(animationDuration, 1);
    }
    if (i == 6) {
      $('header:not(.subpage) div h1, header div p').css('color', 'black');
    } else {
      $('header:not(.subpage) div h1, header div p').css('color', 'white');
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

  $('.img-container.google-maps').append('<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4704.750499788218!2d19.07733520527396!3d47.571989195245976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741da23ecba6b4f%3A0x29979b66898e66ae!2zQnVkYXBlc3QsIFbDoWNpIMO6dCA1OSwgMTA0Nw!5e0!3m2!1shu!2shu!4v1608304731556!5m2!1shu!2shu" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>');

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
});

$(document).scroll(function () {
  onScroll();
});

$(window).resize(function () {
  callQuickfit();
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