/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

   $(document).ready(function(){
        $(".link").click(function(){
            $("body").addClass('loading-halaman');
            setTimeout(function() {
                $("body").removeClass('loading-halaman');
            }, 1000);
        });
           $("body").addClass("loading-halaman");
           setTimeout(function () {
               $("body").removeClass("loading-halaman");
           }, 1000);  
   });

    $(".carousel-heading").owlCarousel({
        loop: true,
        dots: true,
        autoplay: true,
        margin:10,
        autoplayTimeout: 5000,
        items: 1,
        nav: true,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
    });

    $('.owl-nav button').addClass('btn btn-none');
    $(".owl-dots button").addClass("btn btn-none");
    $(".buku-terpopuler .button-slider button").addClass("btn btn-none");

    
    $(".slider-buku-terpopuler").owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        margin: 0,
        autoplayTimeout: 6000,
        nav: true,
        navContainer: ".button-slider",
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
        responsive: {
            0: {
                items: 1,
                margin: 100,
            },
            356: {
                items: 2,
                margin: 180,
            },
            500: {
                items: 3,
                margin: 100,
            },
            600: {
                items: 3,
                margin: 80,
            },
            750: {
                items: 3,
                margin: 80,
            },
            900: {
                items: 3,
                margin: 80,
            },
            1000: {
                items: 5,
                margin: 100,
            },
            1200: {
                items: 5,
            },
        },
    });