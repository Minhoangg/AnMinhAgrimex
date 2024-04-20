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
  }
  if (event.target == searchForm) {
    searchForm.classList.toggle('active')
  }
};
let openSearchBtn = document.querySelector('.open-search-btn')
openSearchBtn.addEventListener('click', function () {
  searchForm.classList.toggle('active')
})
let orderModal = document.getElementById('orderModal');
let orderModalForm = orderModal.querySelector('form')
orderModalForm.querySelector('ul').classList.add('row')
orderModalForm.querySelector('textarea').classList.add('form-control', 'mb-3')
orderModalForm.querySelectorAll('input').forEach(input => {
  input.classList.add('form-control', 'mb-3')
})
orderModalForm.querySelectorAll('label').forEach(input => {
  input.classList.add('form-label', 'fw-medium')
})

$(document).ready(function () {
  $('.product-slide').slick({
    dots: true,
    infinite: false,
    speed: 300,
    autoplay: false,
    autoplaySpeed: 2000,
    slidesToShow: 5,
    slidesToScroll: 2,
    arrows: true,
    nextArrow: '<button type="button" class="custom-next"><i class="fa-solid fa-angle-right"></i></button>',
    prevArrow: '<button type="button" class="custom-prev"><i class="fa-solid fa-angle-left"></i></button>',
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
  $('.product-slide-lien-quan').slick({
    dots: true,
    infinite: false,
    speed: 300,
    autoplay: false,
    autoplaySpeed: 2000,
    slidesToShow: 5,
    slidesToScroll: 2,
    arrows: true,
    nextArrow: '<button type="button" class="custom-next"><i class="fa-solid fa-angle-right"></i></button>',
    prevArrow: '<button type="button" class="custom-prev"><i class="fa-solid fa-angle-left"></i></button>',
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
  $('.my-slick').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 4,
    arrows: true,
    nextArrow: '<button type="button" class="custom-next"><i class="ri-arrow-right-s-line"></i></button>',
    prevArrow: '<button type="button" class="custom-prev"><i class="ri-arrow-left-s-line"></i></button>',
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