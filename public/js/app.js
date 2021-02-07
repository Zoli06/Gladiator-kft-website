$(document).ready(function () {
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

scrolledMachine = 0;

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
  var subject = $('#subject').val();
  var message = $('#message').val();
  window.open('mailto:gladiatorteamkft@gmail.com?subject=' + subject + '&body=' + message + '%0D%0A%0D%0A' + name);
}