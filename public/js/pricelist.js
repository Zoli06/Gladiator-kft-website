$(document).ready(function () {
  $(".page-menu .box");
  callQuickfit();
});

$(window).resize(function() {
  callQuickfit();
})

function selectCategory(element) {
  var name = element.innerText;
  var url = window.location.href;
  while (url.indexOf('category') > -1) {
    url = url.slice(url.indexOf('category') - 1, url.indexOf('&', url.indexOf('category')) + 1);
  }
  if (url.indexOf('?') > -1) {
    url += '&category=' + name;
  } else {
    url += '?category=' + name;
  }
  window.location.href = url;
}

function callQuickfit() {
  $(".content .goods-container .box h3").quickfit({
    max: vw(2)
  });
}