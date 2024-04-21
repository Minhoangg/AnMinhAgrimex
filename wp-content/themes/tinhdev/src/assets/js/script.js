// jQuery(document).ready(function ($) {
//     $(".owl-carousel").owlCarousel({
//         loop: true,
//         margin: 10,
//         autoplay: true,
//         autoplayTimeout: 5000,
//         autoplayHoverPause: true,
//         dots: true,
//         responsive: {
//             // breakpoint from 0 up
//             0: {
//                 items: 1,
//             },
//             // breakpoint from 480 up
//             480: {
//                 items: 2,
//             },
//             // breakpoint from 768 up
//             768: {
//                 items: 2,
//             },
//             992: {
//                 items: 3,
//             },
//             1200: {
//                 items: 4,
//             }
//         }
//     });
//     $('input, textarea, select').addClass('form-control');
// })





















let openNavMenuBtn = document.querySelector('.open-nav-menu-btn')
let closeMenuBtn = document.querySelector('.close-nav-menu-btn')
let navbarMenu = document.querySelector('.header-menu-nav')
let searchForm = document.getElementById('search-form')
openNavMenuBtn.addEventListener('click', function (e) {
  navbarMenu.classList.toggle('active')
  closeMenuBtn.classList.toggle('active')
})
closeMenuBtn.addEventListener('click', function (e) {
  navbarMenu.classList.toggle('active')
  this.classList.remove('active');
})
window.onclick = function (event) {
  if (event.target == navbarMenu) {
    navbarMenu.classList.toggle('active')
    closeMenuBtn.classList.toggle('active')
  }
  if (event.target == searchForm) {
    searchForm.classList.toggle('active')
  }
};
let openSearchBtn = document.querySelector('.open-search-btn')
openSearchBtn.addEventListener('click', function () {
  searchForm.classList.toggle('active')
})

$(document).ready(function () {
  $('.slick').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 4,
    arrows: true,
    nextArrow: '<button type="button" class="custom-next"><i class="fa-solid fa-chevron-right"></i></button>',
    prevArrow: '<button type="button" class="custom-prev"><i class="fa-solid fa-chevron-left"></i></button>',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
});