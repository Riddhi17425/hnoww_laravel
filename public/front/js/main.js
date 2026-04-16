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
            fade:true,
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

// document.querySelectorAll(".zoom-container").forEach((container) => {
//     const img = container.querySelector(".zoom-image");
//     const lens = container.querySelector(".zoom-lens");

//     if (!img || !lens) return;

//     const zoom = 2; // zoom strength (2x)

//     container.addEventListener("mousemove", (e) => {
//         lens.style.display = "block";

//         const rect = container.getBoundingClientRect();
//         const x = e.clientX - rect.left;
//         const y = e.clientY - rect.top;

//         const lensW = lens.offsetWidth / 2;
//         const lensH = lens.offsetHeight / 2;

//         let posX = x - lensW;
//         let posY = y - lensH;

//         // boundaries
//         posX = Math.max(
//             0,
//             Math.min(posX, container.clientWidth - lens.offsetWidth),
//         );
//         posY = Math.max(
//             0,
//             Math.min(posY, container.clientHeight - lens.offsetHeight),
//         );

//         lens.style.left = posX + "px";
//         lens.style.top = posY + "px";

//         // Correct background position
//         const bgPosX = -(posX * zoom);
//         const bgPosY = -(posY * zoom);

//         lens.style.backgroundImage = `url(${img.src})`;
//         lens.style.backgroundSize = `${container.clientWidth * zoom}px ${container.clientHeight * zoom}px`;
//         lens.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
//     });

//     container.addEventListener("mouseleave", () => {
//         lens.style.display = "none";
//     });
// });

// ------


document.addEventListener("DOMContentLoaded", function () {
    // Sabhi zoom containers ko select karein
    document.querySelectorAll(".zoom-container").forEach((container) => {
        const img = container.querySelector(".zoom-image");
        const lens = container.querySelector(".zoom-lens");

        // Agar image ya lens nahi hai toh aage mat badho
        if (!img || !lens) return;

        const zoom = 2; // zoom strength (2x)

        container.addEventListener("mousemove", (e) => {
            lens.style.display = "block"; // Pehle lens show karein taaki width calculate ho sake

            const rect = container.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const lensW = lens.offsetWidth / 2;
            const lensH = lens.offsetHeight / 2;

            let posX = x - lensW;
            let posY = y - lensH;

            // Boundaries (Lens container ke baahar na jaye)
            posX = Math.max(0, Math.min(posX, container.clientWidth - lens.offsetWidth));
            posY = Math.max(0, Math.min(posY, container.clientHeight - lens.offsetHeight));

            lens.style.left = posX + "px";
            lens.style.top = posY + "px";

            // Correct background position
            const bgPosX = -(posX * zoom);
            const bgPosY = -(posY * zoom);

            lens.style.backgroundImage = `url('${img.src}')`; // Quotes add kiye hain safe URL ke liye
            lens.style.backgroundSize = `${container.clientWidth * zoom}px ${container.clientHeight * zoom}px`;
            lens.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
        });

        container.addEventListener("mouseleave", () => {
            lens.style.display = "none";
        });
    });
});

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

// const loader = document.getElementById("page-loader");
// const path = document.querySelector(".loader-box path");

// // Get real path length
// const length = path.getTotalLength();

// // Setup stroke animation
// path.style.strokeDasharray = length;
// path.style.strokeDashoffset = length;

// // Draw animation (SLOW)
// path.animate([{ strokeDashoffset: length }, { strokeDashoffset: 0 }], {
//     duration: 3200,
//     easing: "ease-in-out",
//     fill: "forwards",
// });

// // Hide loader smoothly
// window.addEventListener("load", () => {
//     setTimeout(() => {
//         loader.classList.add("hidden");
//     }, 2000);
// });

const loader = document.getElementById("page-loader");
const path = document.querySelector(".loader-box path");

// Get real path length
const length = path.getTotalLength();

// Setup stroke animation
path.style.strokeDasharray = length;
path.style.strokeDashoffset = length;

// Draw animation (SLOW)
path.animate([{ strokeDashoffset: length }, { strokeDashoffset: 0 }], {
    duration: 3000,
    easing: "ease-in-out",
    fill: "forwards",
});

// Hide loader smoothly after a maximum of 5 seconds
window.addEventListener("load", () => {
    // Change the timeout to 5000 milliseconds (5 seconds)
    setTimeout(() => {
        loader.classList.add("hidden");
    }, 2000); 
});

// loader js end

document.querySelectorAll(".read-more-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        const wrapper = this.previousElementSibling;

        if (!wrapper.classList.contains("expanded")) {
            // OPEN
            wrapper.style.maxHeight = wrapper.scrollHeight + "px";
            wrapper.classList.add("expanded");
            this.textContent = "Read Less";
        } else {
            // CLOSE
            wrapper.style.maxHeight = wrapper.scrollHeight + "px"; 
            requestAnimationFrame(() => {
                wrapper.style.maxHeight = "90px";
            });
            wrapper.classList.remove("expanded");
            this.textContent = "Read More";
        }
    });
});


// ---------------------------- user drop down ------------------------
document.addEventListener("DOMContentLoaded", function () {
    const userIcon = document.querySelector(".user_icon");
    const userMenu = document.querySelector(".user_menu");

    userIcon.addEventListener("click", function (e) {
        e.preventDefault();
        userMenu.classList.toggle("open");
    });

    // Outside click se close ho
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".user_dropdown")) {
            userMenu.classList.remove("open");
        }
    });
});



document.addEventListener("DOMContentLoaded", function () {
    function applyHnowwStyle(node) {
        // Sirf text nodes ko check karein
        if (node.nodeType === 3) {
            let text = node.nodeValue;
            
            // "hnoww" ko detect karke <span class="hnoww-font"> me wrap karega
            // 'gi' matlab Global (poore page par) aur Case-Insensitive (Chota-bada font dono)
            let updated = text.replace(/hnoww/gi, function (match) {
                return `<span class="hnoww-font">${match}</span>`;
            });

            if (updated !== text) {
                let tempSpan = document.createElement("span");
                tempSpan.innerHTML = updated;
                node.replaceWith(tempSpan);
            }
        } else if (node.nodeType === 1 && node.childNodes.length > 0) {
            // Script aur Style tags ko ignore karein taaki code break na ho
            if (node.tagName !== 'SCRIPT' && node.tagName !== 'STYLE') {
                Array.from(node.childNodes).forEach(applyHnowwStyle);
            }
        }
    }

    applyHnowwStyle(document.body);
});