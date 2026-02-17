// ================= HEADER STICKY + HIDE/SHOW =================
let lastScroll = 0;
const header = document.querySelector(".sticky-header");

if (header) {
    window.addEventListener("scroll", () => {
        const currentScroll = window.pageYOffset;

        // background & shadow after scroll
        if (currentScroll > 50) {
            header.classList.add("header-scrolled");
        } else {
            header.classList.remove("header-scrolled");
        }

        // top position
        if (currentScroll <= 0) {
            header.classList.remove("header-hidden");
            header.classList.add("header-visible");
            lastScroll = 0;
            return;
        }

        // scroll down/up behavior
        if (currentScroll > lastScroll) {
            header.classList.add("header-hidden");
            header.classList.remove("header-visible");
        } else {
            header.classList.remove("header-hidden");
            header.classList.add("header-visible");
        }

        lastScroll = currentScroll;
    });
}

// ================= HAMBURGER MENU =================

document
    .querySelector(".navbar-toggler")
    .addEventListener("click", function () {
        this.classList.toggle("active");
    });

// HEADER ICON EFFECT

document.addEventListener("DOMContentLoaded", function () {
    const userIcon = document.querySelector(".user_icon");
    const userMenu = document.querySelector(".user_menu");

    const searchIcon = document.querySelector(".search_icon");
    const searchBox = document.querySelector(".search_box");

    // User dropdown toggle
    userIcon.addEventListener("click", function (e) {
        e.stopPropagation();
        userMenu.classList.toggle("open");
        searchBox.classList.remove("open");
    });

    // Search dropdown toggle
    searchIcon.addEventListener("click", function (e) {
        e.stopPropagation();
        searchBox.classList.toggle("open");
        userMenu.classList.remove("open");
    });

    // Close on outside click
    document.addEventListener("click", function () {
        userMenu.classList.remove("open");
        searchBox.classList.remove("open");
    });
});

// ================= SLICK SLIDERS =================
$(document).ready(function () {
    if ($(".desire_slider").length) {
        $(".desire_slider").slick({
            dots: true,
            arrows: false,
            centerMode: true,
            centerPadding: "10%",
            slidesToShow: 3,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        centerPadding: "40px",
                        centerMode: false
                    },
                }
            ],
        });
    }
if ($(".corporate_slider").length) {

  $(".corporate_slider").slick({
    slidesToShow: 3,
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 2500,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 1
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }
    ]
});


}


    if ($(".cor_kits_slider").length) {
        $(".cor_kits_slider").slick({
            slidesToShow: 1,
            arrows: false,
            dots: true,
            autoplay: true,
            autoplaySpeed: 2500,
        });
    }
});

// ================= INCREMENT / DECREMENT =================
const decBtn = document.querySelector(".dec_btn");
const incBtn = document.querySelector(".inc_btn");
const valueSpan = document.querySelector(".span_value");

let value = 1;
//if (valueSpan) valueSpan.textContent = value;

if (incBtn) {
    incBtn.addEventListener("click", () => {
        value++;
        valueSpan.textContent = value;
    });
}

if (decBtn) {
    decBtn.addEventListener("click", () => {
        if (value > 1) {
            value--;
            valueSpan.textContent = value;
        }
    });
}

document.querySelectorAll(".zoom-container").forEach((container) => {
    const img = container.querySelector(".zoom-image");
    const lens = container.querySelector(".zoom-lens");

    if (!img || !lens) return;

    const zoom = 2; // zoom strength (2x)

    container.addEventListener("mousemove", (e) => {
        lens.style.display = "block";

        const rect = container.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const lensW = lens.offsetWidth / 2;
        const lensH = lens.offsetHeight / 2;

        let posX = x - lensW;
        let posY = y - lensH;

        // boundaries
        posX = Math.max(
            0,
            Math.min(posX, container.clientWidth - lens.offsetWidth),
        );
        posY = Math.max(
            0,
            Math.min(posY, container.clientHeight - lens.offsetHeight),
        );

        lens.style.left = posX + "px";
        lens.style.top = posY + "px";

        // Correct background position
        const bgPosX = -(posX * zoom);
        const bgPosY = -(posY * zoom);

        lens.style.backgroundImage = `url(${img.src})`;
        lens.style.backgroundSize = `${container.clientWidth * zoom}px ${container.clientHeight * zoom}px`;
        lens.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
    });

    container.addEventListener("mouseleave", () => {
        lens.style.display = "none";
    });
});

// ------

$(document).on("click", ".icon_hert", function (e) {
    e.preventDefault();

    const $heart = $(this);

    if ($heart.hasClass("active")) {
        // inactive
        $heart.removeClass("active");
    } else {
        // active + animation retrigger
        $heart.removeClass("active");
        void this.offsetWidth; // reflow
        $heart.addClass("active");
    }
});

// ceremonial_box

document.querySelectorAll(".ceremonial_box").forEach((box) => {
    const circle = box.querySelector(".inquire_bespoke");

    box.addEventListener("mouseenter", () => {
        circle.style.opacity = "1";
        circle.style.visibility = "visible";
    });

    box.addEventListener("mousemove", (e) => {
        const rect = box.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        circle.style.left = x + "px";
        circle.style.top = y + "px";
    });

    box.addEventListener("mouseleave", () => {
        circle.style.opacity = "0";
        circle.style.visibility = "hidden";
    });
});

// ============= mobile slider add

function mobileOnlySlider() {
    if (window.innerWidth < 768) {
        if (!$(".mobile_slider").hasClass("slick-initialized")) {
            $(".mobile_slider").slick({
                slidesToShow: 1,
                arrows: false,
                dots: true,
                centerMode: true,
                centerPadding: "0px",
            });
        }
    } else {
        if ($(".mobile_slider").hasClass("slick-initialized")) {
            $(".mobile_slider").slick("unslick");
        }
    }
}

$(document).ready(function () {
    mobileOnlySlider();
    $(window).on("resize", mobileOnlySlider);
});

// loader js start

const loader = document.getElementById("page-loader");
const path = document.querySelector(".loader-box path");

// Get real path length
const length = path.getTotalLength();

// Setup stroke animation
path.style.strokeDasharray = length;
path.style.strokeDashoffset = length;

// Draw animation (SLOW)
path.animate([{ strokeDashoffset: length }, { strokeDashoffset: 0 }], {
    duration: 3200,
    easing: "ease-in-out",
    fill: "forwards",
});

// Hide loader smoothly
window.addEventListener("load", () => {
    setTimeout(() => {
        loader.classList.add("hidden");
    }, 2000);
});

// loader js end

document.querySelectorAll(".read-more-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        const wrapper = this.previousElementSibling;

        wrapper.classList.toggle("expanded");

        this.textContent = wrapper.classList.contains("expanded")
            ? "Read Less"
            : "Read More";
    });
});

// ---------------------------- login ------------------------

