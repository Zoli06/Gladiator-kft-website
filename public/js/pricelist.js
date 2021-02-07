$(document).ready(function () {
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

    catch(e) {}
  }
});

function selectCategory(element) {
  url = window.location.origin + '/pricelist.php?category=' + element.innerText;
  window.location.href = url;
}