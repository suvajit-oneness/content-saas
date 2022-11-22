$(function () {
  $(".certification-slider").owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    dots: false,
    navText: [
      "<img src='assets/img/right-arrow.png'>",
      "<img src='assets/img/right-arrow.png'>",
    ],
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      600: {
        items: 1,
        nav: false,
      },
      1000: {
        items: 1,
      },
    },
  });

  $('.portfolio-v4-testimonials').owlCarousel({
    loop: true, margin: 10, nav: false, responsive: { 0: { items: 1 }, 600: { items: 1 }, 1000: { items: 3 } }
  })
});

(function ($, window, Typist) {
  // Dropdown Menu Fade
  jQuery(document).ready(function () {
    $(".dropdown").hover(
      function () {
        $(".dropdown-menu", this).fadeIn("fast");
      },
      function () {
        $(".dropdown-menu", this).fadeOut("fast");
      }
    );
  });

  /*-------active---------*/

  $(document).ready(function () {
    $(".nav-link").click(function () {
      $(".nav-link").removeClass("active");
      $(this).addClass("active");
    });
  });

  /*-------------headder_fixed-------------*/

  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 104) {
      $(".navbar").addClass("top");
    } else {
      $(".navbar").removeClass("top");
    }
  });

  $(document).ready(function () {
    $('.blog-list-panel').show();
    $('.toolsFilter li').each(function () {
      if ($(this).find('label input[type="radio"]').prop('checked') == true) {
        var iValue = $(this).find('label input[type="radio"]').attr('value');
        var targetBox = $("." + iValue);
        $(".blog-list-panel").not(targetBox).hide();
        $(targetBox).show();
      }
    });
    $('.toolsFilter li label input[type="radio"]').click(function () {
      var inputValue = $(this).attr("value");
      var targetBox = $("." + inputValue);
      $(".blog-list-panel").not(targetBox).hide();
      $(targetBox).show();
    });
    $('.eventlist').show();
    $('.toolsFilter li').each(function () {
      if ($(this).find('label input[type="radio"]').prop('checked') == true) {
        var iValue = $(this).find('label input[type="radio"]').attr('value');
        var targetBox = $("." + iValue);
        $(".eventlist").not(targetBox).hide();
        $(targetBox).show();
      }
    });
    $('.toolsFilter li label input[type="radio"]').click(function () {
      var inputValue = $(this).attr("value");
      var targetBox = $("." + inputValue);
      $(".eventlist").not(targetBox).hide();
      $(targetBox).show();
    });
    $(".sidebar").theiaStickySidebar({
      // Settings
      sidebarBehavior: "modern",
      additionalMarginTop: 120,
      additionalMarginBottom: 0,
    });
  });

  $(window).scroll(function () {
    var sticky = $(".js-sticky-header"),
      scroll = $(window).scrollTop();

    if (scroll >= 120) sticky.addClass("fixed");
    else sticky.removeClass("fixed");
  });

  /*--------------ASO.JS---------------*/

  AOS.init();

  //refresh animations

  $(window).on("load", function () {
    AOS.refresh();
  });

  /*--------Accordion-------------*/

  $(".accordion").each(function () {
    var $accordian = $(this);
    $accordian.find(".accordion-head").on("click", function () {
      $(this).removeClass("open").addClass("close");
      $accordian.find(".accordion-body").slideUp();
      if (!$(this).next().is(":visible")) {
        $(this).removeClass("close").addClass("open");
        $(this).next().slideDown();
      }
    });
  });

  /*------------slider_sw------------*/

  var swiper = new Swiper(".schoole_wear", {
    slidesPerView: 4,
    spaceBetween: 0,
    slidesPerGroup: 1,
    loop: true,
    loopFillGroupWithBlank: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      360: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      640: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 0,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 0,
      },
    },
  });
  var swiper = new Swiper(".Bestdeals2", {
    navigation: {
      nextEl: ".swiper-button-next-2",
      prevEl: ".swiper-button-prev-2",
    },
    breakpoints: {
      300: {
        slidesPerView: 2,
        spaceBetween: 8,
      },
      640: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 15,
      },
      1366: {
        slidesPerView: 3,
        spaceBetween: 15,
      },
    },
  });
  /*---search_openclose----*/

  $(document).ready(function () {
    $(".search_ic").click(function () {
      $(".resp_search_input").toggle();
    });
  });
})(jQuery, window);

const stars = document.querySelectorAll(".stars");
const score = document.querySelector(".score");

stars.forEach((star) => {
  //console.log(stars.length)
  const starr = star.querySelectorAll("i");

  starr.forEach((item, index) => {
    item.addEventListener("click", (e) => {
      let currentStar = index + 1;

      starr.forEach((item, index2) => {
        let nextStar = index2 + 1;

        if (currentStar >= nextStar) {
          item.classList.remove("fa-regular", "fa-star");
          item.classList.add("fa-solid", "fa-star");
        } else {
          item.classList.remove("fa-solid");
          item.classList.add("fa-regular");
        }
      });

      //console.log();
      const faSolid = document.querySelectorAll(".stars .fa-solid").length;
      score.innerHTML = faSolid / stars.length;
    });
  });
});

const tableTabs = document.querySelectorAll(".table-tab");
const tbodyContents = document.querySelectorAll(".tbody-content");
const profileMenuContent = document.querySelector(".profile-menu-content");
const profileModal = document.querySelector(".profile-modal");

tableTabs.forEach((tableTab) => {
  tableTab.addEventListener("click", (e) => {
    tableTab.classList.add("active");

    tableTabs.forEach((tableTab2) => {
      if (tableTab != tableTab2) {
        tableTab2.classList.remove("active");
      }
    });

    const dataTableTab = tableTab.getAttribute("data-tab-table");
    console.log(dataTableTab);

    tbodyContents.forEach((item) => {
      const tbodyContentData = item.getAttribute("id");
      const trs = item.querySelectorAll("tr");
      // console.log(trs)

      if (dataTableTab === tbodyContentData) {
        item.classList.add("active");
      } else {
        item.classList.remove("active");
      }
    });
  });
});

/*
tbodyContents.forEach((item) => {
  const trs = item.querySelectorAll("tr");

  trs.forEach((tr) => {
    tr.addEventListener("click", (e) => {
      if (e.target.classList.contains("trash")) {
        e.target.parentElement.parentElement.parentElement.remove();
      }

      if (e.target.classList.contains("edit")) {
        console.log(
          item.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.nextElementSibling.classList.add(
            "showModall"
          )
        );
        const td1 =
          e.target.parentElement.parentElement.previousElementSibling.innerHTML;
        console.log(td1);
      }
    });
  });
});
*/

/*
document.addEventListener("mouseup", function (event) {
  if (!profileMenuContent.contains(event.target)) {
    profileModal.classList.remove("showModall");
    // input.value = ''
  }
});
*/

/* PRICE PAGE TAB */
const faqTabs = document.querySelectorAll(".faq-tab");
const faqContents = document.querySelectorAll(".faq-content");

faqTabs.forEach((faqTab) => {
  faqTab.addEventListener("click", (e) => {
    faqTab.classList.add("active");

    faqTabs.forEach((faqTab2) => {
      if (faqTab2 != faqTab) {
        faqTab2.classList.remove("active");
      }
    });

    const tabData = faqTab.getAttribute("data-tab");

    faqContents.forEach((faqContent) => {
      const faqContentData = faqContent.getAttribute("id");
      console.log(faqContentData);
      if (tabData === faqContentData) {
        faqContent.classList.add("active");
      } else {
        faqContent.classList.remove("active");
      }
    });
  });
});
/* PRICE PAGE TAB */

/* ACCORDION COURSE */
const courseAccorContents = document.querySelectorAll('.course-content-accor')
const accorContents = document.querySelectorAll('.accor-content')
courseAccorContents.forEach(item => {
  const accorTop = item.querySelector('.accor-top')
  const accorTopLeft = item.querySelector('.accor-top-left').children[1]
  console.log(accorTopLeft)
  accorTop.addEventListener('click', (e) => {
    // console.log('ff')

    courseAccorContents.forEach(item2 => {
      if (item2 != item) {
        item2.classList.remove('active')

      }
    })

    const angleIcon = e.target.children[0].children[0]
    console.log(angleIcon)
    item.classList.toggle('active')
    angleIcon.classList.remove('fa-angle-down')
    angleIcon.classList.add('fa-angle-up')

  })

  accorTopLeft.addEventListener('click', (e) => {
    console.log('ff')

    courseAccorContents.forEach(item2 => {
      if (item2 != item) {
        item2.classList.remove('active')

      }
    })

    // const angleIcon = e.target.previousElementSibling
    //  console.log(angleIcon)
    item.classList.toggle('active')
    // angleIcon.classList.remove('fa-angle-down')
    // angleIcon.classList.add('fa-angle-up')

  })
})
/* ACCORDION COURSE */

/* MARKET PAGE TAB */
const marketTabs = document.querySelectorAll(".market-tab");
const marketContents = document.querySelectorAll(".market-content .row");


document.addEventListener('DOMContentLoaded', () => {
  marketTabs.forEach(marketTab => {
    const tabData = marketTab.getAttribute("data-tab-market");
    marketContents.forEach((marketContent) => {
      const faqContentData = marketContent.getAttribute("id");
      console.log(faqContentData);
      if (tabData === faqContentData) {
        marketContent.classList.add("active");
      } else {
        marketContent.classList.remove("active");
      }
    });
  })
})
marketTabs.forEach((marketTab) => {
  $('.market-tab').show();
  marketTab.addEventListener("click", (e) => {
    marketTab.classList.add("active");

    marketTabs.forEach((marketTab2) => {
      if (marketTab2 != marketTab) {
        marketTab2.classList.remove("active");
      }
    });

    const tabData = marketTab.getAttribute("data-tab-market");

    marketContents.forEach((marketContent) => {
      const faqContentData = marketContent.getAttribute("id");
      console.log(faqContentData);
      if (tabData === faqContentData) {
        marketContent.classList.add("active");
      } else {
        marketContent.classList.remove("active");
      }
    });
  });
});
/* MARKET PAGE TAB */

/* PORTFOLIO TAB */
const portTabs = document.querySelectorAll(".port-tab");
const portItemLinks = document.querySelectorAll(".portfolio-links-item");

portTabs.forEach((portTab) => {
  portTab.addEventListener("click", () => {
    portTab.classList.add("active");

    portTabs.forEach((portTab2) => {
      if (portTab2 != portTab) {
        portTab2.classList.remove("active");
      }
    });

    const portData = portTab.getAttribute("data-port");
    console.log(portData);

    portItemLinks.forEach((portItemLink) => {
      // portItemLink.classList.remove('active')
      //portItemLink.classList.add("hide");
      const portItemData = portItemLink.getAttribute('id')

      if (portItemData == portData) {
        // portItemLink.classList.remove("hide");
        //   portItemLink.classList.add('active')
        portItemLink.classList.add('active')
      }
      else {
        portItemLink.classList.remove('active')
      }
    });
  });
});
/* PORTFOLIO TAB */

/* PORTFOLIO TAB2 */
const portTabsv2 = document.querySelectorAll(".portv2-tab");
const portItemLinksv2 = document.querySelectorAll(".portfolio-links-item");

portTabsv2.forEach((portTabv2) => {
  portTabv2.addEventListener("click", () => {
    portTabv2.classList.add("active");

    portTabsv2.forEach((portTab2v2) => {
      if (portTab2v2 != portTabv2) {
        portTab2v2.classList.remove("active");
      }
    });

    const portDatav2 = portTabv2.getAttribute("data-portv2-link");
    console.log(portDatav2);

    portItemLinks.forEach((portItemLink) => {
      // portItemLink.classList.remove('active')
      portItemLink.classList.add("hide");

      if (portItemLink.getAttribute("id") == portDatav2 || portDatav2 == "all") {
        portItemLink.classList.remove("hide");
        //   portItemLink.classList.add('active')
      }
    });
  });
});
/* PORTFOLIO TAB2 */
/* PORTFOLIO TAB3 */
const portTabsv3 = document.querySelectorAll(".portv3-tab");
const portItemLinksv3 = document.querySelectorAll(".portfoliov3-links-item");

portTabsv3.forEach((portTabv3) => {
  portTabv3.addEventListener("click", () => {
    portTabv3.classList.add("active");

    portTabsv3.forEach((portTab2v3) => {
      if (portTab2v3 != portTabv3) {
        portTab2v3.classList.remove("active");
      }
    });

    const portDatav3 = portTabv3.getAttribute("data-tab");
    console.log(portDatav3);

    portItemLinks.forEach((portItemLink) => {
      // portItemLink.classList.remove('active')
      portItemLink.classList.add("hide");

      if (portItemLink.getAttribute("id") == portDatav3 || portDatav3 == "all") {
        portItemLink.classList.remove("hide");
        //   portItemLink.classList.add('active')
      }
    });
  });
});
/* PORTFOLIO TAB3 */



/* DASHBOARD */
const dashboardSidebar = document.querySelector(".dashboard-sidebar");
const sidebarClose = document.querySelector(".sidebar-close");
const dashBoardRight = document.querySelector(".dashboard-right");
const dashboardMenu = document.querySelector(".dashboard-menu");

sidebarClose.addEventListener("click", () => {
  dashboardSidebar.classList.add("show-sidebar");
  dashBoardRight.classList.add("margin-init");
});
dashboardMenu.addEventListener("click", () => {
  dashboardSidebar.classList.remove("show-sidebar");
  dashBoardRight.classList.remove("margin-init");
});

// document.addEventListener('mouseup', function (event) {

// 	if (!dashboardSidebar.contains(event.target) && !sidebarClose.contains(event.target)) {
// 		dashboardSidebar.classList.remove('show-sidebar')
// 	}
// });

function myFunction(x) {
  if (x.matches) {
    // If media query matches
    dashboardSidebar.classList.add("show-sidebar");
    dashBoardRight.classList.add("margin-init");
  } else {
    dashboardSidebar.classList.remove("show-sidebar");
    dashBoardRight.classList.remove("margin-init");
  }
}

var x = window.matchMedia("(max-width: 990px)");
myFunction(x); // Call listener function at run time
//x.addListener(myFunction); // Attach listener function on state changes
x.addEventListener("change", myFunction);

/* DASHBOARD */

/* CLEAR FILTER */
const clearFilter = document.querySelector(".clear-filter");
const filterKeywordsInput = document.querySelector(
  ".jobs-filter-keywords input"
);
const checkboxContentInputs = document.querySelectorAll(
  ".checkbox-content input"
);

// filterKeywordsInput.focus();

clearFilter.addEventListener("click", (e) => {
  if (filterKeywordsInput.value) {
    filterKeywordsInput.value = "";
    filterKeywordsInput.focus();
  }

  checkboxContentInputs.forEach((checkboxContentInput) => {
    console.log(checkboxContentInput);
    if (checkboxContentInput.checked) {
      checkboxContentInput.checked = false;
    }
  });
});
/* CLEAR FILTER */




/* blog category */

$('.Blog_toolsFilter li a').on('click', function (e) {
  e.preventDefault();
  console.log('here');
  var tab_id = $(this).attr('data-target');
  $('.blog-list-panel').hide();
  $('#' + tab_id).show();
});




