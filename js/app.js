$(document).ready(function () {
  onScroll();
});

$(document).scroll(function () {
  onScroll();
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
    $('nav').css({ opacity: projectValue(minOpacity, maxOpacity, changeIntervalStart, changeIntervalEnd, guidelineValue)/*, height:  projectValue(minHeight, maxHeight, changeIntervalStart, changeIntervalEnd, guidelineValue)*/ });
  } else if ($(document).scrollTop() <= changeIntervalStart) {
    $('nav').css({ opacity: maxOpacity })
  } else if ($(document).scrollTop() >= changeIntervalEnd) {
    $('nav').css({ opacity: minOpacity })
  }
}

function projectValue(minValue, maxValue, changeIntervalStart, changeIntervalEnd, guidelineValue) {
  return maxValue - ((100 / (changeIntervalEnd - changeIntervalStart) * (guidelineValue - changeIntervalStart)) / (100 / (1 - minValue)));
}