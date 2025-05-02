//bs navbar
(() => {
    const openNavMenu = document.querySelector(".bs-open-nav-menu"),
    closeNavMenu = document.querySelector(".bs-close-nav-menu"),
    navMenu = document.querySelector(".bs-nav-menu"),
    menuOverlay = document.querySelector(".bs-menu-overlay"),
    mediaSize = 991;

    openNavMenu.addEventListener("click", toggleNavMenu);
    closeNavMenu.addEventListener("click", toggleNavMenu);
    menuOverlay.addEventListener("click", toggleNavMenu);
    function toggleNavMenu(){
        navMenu.classList.toggle("open");
        menuOverlay.classList.toggle("active");
        document.body.classList.toggle("bs-hidden-scrolling");
    }
    navMenu.addEventListener("click", (event) =>{
        if(event.target.hasAttribute("data-toggle") && window.innerWidth <= mediaSize){
            event.preventDefault();
            const menuItemHasChildren = event.target.parentElement;
            if(menuItemHasChildren.classList.contains("active")){
                collapseSubMenu();
            }else{
                if(navMenu.querySelector(".bs-has-children.active")){
                    collapseSubMenu();
                }
                menuItemHasChildren.classList.add("active");
                const subMenu = menuItemHasChildren.querySelector(".bs-sub-menu");
                subMenu.style.maxHeight = subMenu.scrollHeight + "px";
            }

        }
    })
    function collapseSubMenu(){
        navMenu.querySelector(".bs-has-children.active .bs-sub-menu").removeAttribute("style");
        navMenu.querySelector(".bs-has-children.active").classList.remove("active");
    }
    function resizeFix(){
        if(navMenu.classList.contains("open")){
            toggleNavMenu();
        }
    }
    window.addEventListener("resize", function(){
        if(this.innerWidth > mediaSize){
            resizeFix();
        }
    })
})();
//bs navbar
//gs slide
var swiper = new Swiper(".gs-slider", {
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    loop:true,
    grabCursor:true,
    autoplay: {
        delay: 5000,
      },
});
//gs slide
//county
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}
const county = document.querySelector('.county-section');
let valueDisplays = document.querySelectorAll(".county-num");
let interval = 3000;
let isSpotted = false;
document.addEventListener('scroll', function () {
    if(isInViewport(county) && isSpotted != true){
        isSpotted = true;
        valueDisplays.forEach(valueDisplay => {
            let startValue = 0;
            let endValue = parseInt(valueDisplay.getAttribute("data-val"));
            if(endValue == 0)
                endValue = 1;
            let duration = Math.floor(interval / endValue);
            let counter = setInterval(function(){
                startValue += 1;
                valueDisplay.textContent = startValue;
                if(startValue == endValue)
                    clearInterval(counter);
            }, duration);
        });
    };
});
//county
//testoslider
var swiper2 = new Swiper(".testoslider-testimonial", {
    slidesPerView: 1,
    grabCursor: true,
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
//testoslider
//bloggoslider
$(document).ready(function(){
    $('.bloggoslider-container').owlCarousel({
        pagination: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            700: {
                items: 2,
            },
            1000: {
                items: 3,
            },
        }
    });
});
//bloggoslider
//goTopButton
var goTopButton = document.getElementById("goTopButton");
var rootElement = document.documentElement;
function goTopScrolling(){
    rootElement.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}
function handleScroll(){
    var scrollTotal = rootElement.scrollHeight - rootElement.clientHeight;
    if ((rootElement.scrollTop / scrollTotal ) > 0.40 ) {
        // Show button
        goTopButton.classList.add("showBtn");
      } else {
        // Hide button
        goTopButton.classList.remove("showBtn");
    }
}
document.addEventListener("scroll", handleScroll);
goTopButton.addEventListener("click", goTopScrolling);
//goTopButton