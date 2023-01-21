const swiper = new Swiper('.swiper', {
    // Optional parameters
    loop: true,
    loopedSlides: 2,
    pagination: {
        el: ".swiper-pagination",
        type: "progressbar",
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});