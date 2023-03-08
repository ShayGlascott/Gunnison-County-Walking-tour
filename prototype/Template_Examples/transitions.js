var locationContainer = document.querySelector('.location-container');
var banner = document.querySelector('.banner');

window.addEventListener('scroll', function() {
  if (window.scrollY > locationContainer.clientHeight) {
    banner.classList.add('visible');
  } else {
    banner.classList.remove('visible');
  }
});
