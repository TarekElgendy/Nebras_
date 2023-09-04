(function ($) {
  "use strict";

  $(".preloader").delay(600).fadeOut();

  // Select
  //$("select").selectric();

  Fancybox.bind("[data-fancybox]", {
    // Your options go here
  });
})(jQuery);

(function () {
  ("use strict");

  // Swiper Slider
  {
    var swiper0 = new Swiper(".swiper-home", {
      loop: true,
      // pagination: {
      //   el: ".swiper-pagination",
      //   // type: "progressbar",
      //   dynamicBullets: true,
      //   clickable: true,
      // },
      speed: 1000,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    });

    var swiper1 = new Swiper(".swiper-categories", {
      loop: true,
      centeredSlides: true,
      slidesPerView: 3,
      navigation: {
        nextEl: ".swiper1-button-next",
        prevEl: ".swiper1-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
          spaceBetween: 5,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 15,
        },
        1199: {
          slidesPerView: 5,
          spaceBetween: 15,
        },
        1400: {
          slidesPerView: 7,
          spaceBetween: 15,
        },
      },
      speed: 1000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });

    var swiper_2 = new Swiper(".swiper-categories_two", {
      loop: true,
      centeredSlides: true,
      slidesPerView: 3,
      navigation: {
        nextEl: ".swiper_2-button-next",
        prevEl: ".swiper_2-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
          spaceBetween: 5,
        },
        640: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 15,
        },
      },
      speed: 1000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });

    var swiper2 = new Swiper(".swiper-products", {
      loop: true,
      centeredSlides: true,
      slidesPerView: 3,
      navigation: {
        nextEl: ".swiper2-button-next",
        prevEl: ".swiper2-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 3,
          spaceBetween: 9,
        },
        640: {
          slidesPerView: 3,
          spaceBetween: 9,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 9,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 9,
        },
      },
      speed: 1000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });

    var swiper3 = new Swiper(".swiper-products2", {
      loop: true,
      centeredSlides: true,
      slidesPerView: 3,
      navigation: {
        nextEl: ".swiper3-button-next",
        prevEl: ".swiper3-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
          spaceBetween: 9,
        },
        640: {
          slidesPerView: 3,
          spaceBetween: 9,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 9,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 9,
        },
      },
      speed: 1000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });

    var swiper3 = new Swiper(".swiper-offers", {
      loop: true,
      centeredSlides: true,
      slidesPerView: 3,
      navigation: {
        nextEl: ".swiper4-button-next",
        prevEl: ".swiper4-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 3,
          spaceBetween: 9,
        },
        640: {
          slidesPerView: 3,
          spaceBetween: 9,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 9,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 9,
        },
      },
      speed: 1000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });

    var swiper4 = new Swiper(".swiper-brands", {
      loop: true,
      centeredSlides: true,
      slidesPerView: 3,
      navigation: {
        nextEl: ".swiper4-button-next",
        prevEl: ".swiper4-button-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 4,
          spaceBetween: 9,
        },
        640: {
          slidesPerView: 4,
          spaceBetween: 9,
        },
        768: {
          slidesPerView: 5,
          spaceBetween: 9,
        },
        1024: {
          slidesPerView: 7,
          spaceBetween: 9,
        },
      },
      speed: 10000,
      autoplay: {
        delay: 200,
        disableOnInteraction: false,
      },
    });

    // Slides Thums Bottom
    var swiperBtm = new Swiper(".swiperThumps", {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
      slideToClickedSlide: true,
      loop: true,
      breakpoints: {
        0: {
          slidesPerView: 4,
          spaceBetween: 4,
        },
        640: {
          slidesPerView: 4,
          spaceBetween: 4,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 5,
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 5,
        },
        1200: {
          slidesPerView: 5,
          spaceBetween: 5,
        },
      },
    });
    var swiper2Btm = new Swiper(".swiperImages", {
      effect: "fade",
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiperBtm,
      },
    });

    var galleryThumbs = new Swiper(".gallery-thumbs", {
      slidesPerView: 4,
      direction: "vertical",
      breakpoints: {
        0: {
          slidesPerView: 3,
          spaceBetween: 5,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 5,
        },
        1400: {
          slidesPerView: 5,
          spaceBetween: 5,
        },
      },
    });
    var galleryMain = new Swiper(".gallery-main", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      effect: "fade",
      fadeEffect: {
        crossFade: true,
      },
      thumbs: {
        swiper: galleryThumbs,
      },
    });
    galleryMain.on("slideChangeTransitionStart", function () {
      galleryThumbs.slideTo(galleryMain.activeIndex);
    });
    galleryThumbs.on("transitionStart", function () {
      galleryMain.slideTo(galleryThumbs.activeIndex);
    });

    var testimonialsOne = new Swiper(".swiper-testimonials-one", {
      loop: true,
      navigation: {
        nextEl: ".testi-button-next",
        prevEl: ".testi-button-prev",
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
      },
      speed: 1000,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    });

    var testimonialsTwo = new Swiper(".swiper-testimonials-two", {
      loop: true,
      slidesPerView: 1,
      navigation: {
        nextEl: ".testi0-button-next",
        prevEl: ".testi0-button-prev",
      },
      speed: 1000,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    });

    var testimonialsThree = new Swiper(".swiper-testimonials-three", {
      effect: "cards",
      grabCursor: true,
      speed: 1000,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    });
  }

  // tooltip Trigger List
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // QTY
  var qtyDecs = document.querySelectorAll(".qty-minus");
  var qtyIncs = document.querySelectorAll(".qty-plus");
  qtyDecs.forEach((qtyDec) => {
    qtyDec.addEventListener("click", function (e) {
      if (e.target.nextElementSibling.value > 0) {
        e.target.nextElementSibling.value--;
      } else {
        // delete the item, etc
      }
    });
  });
  qtyIncs.forEach((qtyDec) => {
    qtyDec.addEventListener("click", function (e) {
      e.target.previousElementSibling.value++;
    });
  });

  // Define Overlay For All
  let bodyOverlay = document.querySelector("body");
  let divBG = document.createElement("div");
  divBG.className = "overlay-bg";
  bodyOverlay.appendChild(divBG);
  // if (!divBG) return;

  // Script Cart Sidebar
  const btnShowCart = document.querySelector(".btn-showcart");
  const cartSidebar = document.querySelector(".cart-sidebar");
  const btnCloseCart = document.querySelector(".close-cart");
  if ((btnShowCart, btnCloseCart, divBG)) {
    btnShowCart.addEventListener("click", showCart);
    btnCloseCart.addEventListener("click", closeCart);
    divBG.addEventListener("click", closeCart);
  }
  function showCart(e) {
    e.preventDefault();
    cartSidebar.classList.add("showing");
    divBG.className = "overlay-bg showing";
  }
  function closeCart() {
    cartSidebar.classList.remove("showing");
    divBG.classList.remove("showing");
  }

  // Script Search Popup
  const btnSearch = document.querySelector(".btn-search");
  const boxSearch = document.querySelector(".box-search");
  const closeSearch = document.querySelector(".close_search");

  if ((btnSearch, closeSearch, boxSearch, divBG)) {
    btnSearch.addEventListener("click", showSearch);
    closeSearch.addEventListener("click", exitSearch);
    divBG.addEventListener("click", exitSearch);
  }
  function showSearch(e) {
    e.preventDefault();
    boxSearch.classList.add("showing");
    divBG.className = "overlay-bg showing";
  }
  function exitSearch() {
    boxSearch.classList.remove("showing");
    divBG.classList.remove("showing");
  }

  // Toggle toggle Header Menu
  const btnToggleMenu = document.querySelector(".toggle-menu");
  const headerNavMenu = document.querySelector("header .middle-header nav");
  if ((btnToggleMenu, divBG)) {
    btnToggleMenu.addEventListener("click", toggleMenuNav, { passive: true });
    divBG.addEventListener("click", closeMenuNav, { passive: true });
  }
  function toggleMenuNav() {
    headerNavMenu.classList.add("showing");
    divBG.className = "overlay-bg showing";
  }
  function closeMenuNav() {
    headerNavMenu.classList.remove("showing");
  }

  // Toggle Shop Filter
  const btnToggleShopFilter = document.querySelector(".toggle_filter");
  const shopSidebarFilter = document.querySelector(".sidebar-filter");

  if (btnToggleShopFilter) {
    btnToggleShopFilter.addEventListener("click", toggleShopFilter);
    divBG.addEventListener("click", closeShopFilter);
  }

  function toggleShopFilter() {
    shopSidebarFilter.classList.add("showing");
    divBG.className = "overlay-bg showing";
  }
  function closeShopFilter() {
    shopSidebarFilter.classList.remove("showing");
    divBG.classList.remove("showing");
  }

  // Mobile Sidebar Profile
  const btnToggleSidebarFilter = document.querySelector(".btn-toggle-menu");
  // if (!btnToggleSidebarFilter) return;
  const profileSidebarFilter = document.querySelector(".sidebar-profile > ul");

  if (btnToggleSidebarFilter) {
    btnToggleSidebarFilter.addEventListener("click", showMenuProfile);
    divBG.addEventListener("click", closeMenuProfile);
  }

  function showMenuProfile() {
    profileSidebarFilter.classList.add("show");
    divBG.className = "overlay-bg showing";
  }
  function closeMenuProfile() {
    profileSidebarFilter.classList.remove("show");
    divBG.classList.remove("showing");
  }

  // Range Price
  var parent = document.querySelector(".range-slider");
  if (!parent) return;
  var rangeS = parent.querySelectorAll("input[type=range]");
  var numberS = parent.querySelectorAll("input[type=number]");

  rangeS.forEach(function (el) {
    el.oninput = function () {
      var slide1 = parseFloat(rangeS[0].value),
        slide2 = parseFloat(rangeS[1].value);
      if (slide1 > slide2) {
        [slide1, slide2] = [slide2, slide1];
      }
      numberS[0].value = slide1;
      numberS[1].value = slide2;
    };
  });
  numberS.forEach(function (el) {
    el.oninput = function () {
      var number1 = parseFloat(numberS[0].value),
        number2 = parseFloat(numberS[1].value);
      if (number1 > number2) {
        var tmp = number1;
        numberS[0].value = number2;
        numberS[1].value = tmp;
      }
      rangeS[0].value = number1;
      rangeS[1].value = number2;
    };
  });
})();
