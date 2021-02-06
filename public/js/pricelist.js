$(document).ready(function () {
  $(".page-menu .box");
});

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