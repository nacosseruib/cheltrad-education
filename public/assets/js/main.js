$(function() {
    
    "use strict";
    
    //===== Prealoder
    
    $(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });
    
    
    //===== Mobile Menu 
    
    $(".navbar-toggler").on('click', function() {
        $(this).toggleClass('active');
    });
    
    $(".navbar-nav a").on('click', function() {
        $(".navbar-toggler").removeClass('active');
    });
    
    
    //===== close navbar-collapse when a  clicked
    
    $(".navbar-nav a").on('click', function () {
        $(".navbar-collapse").removeClass("show");
    });
    
    
    //===== Responsive Menu 
    
    var subMenu = $('.sub-menu-bar .navbar-nav .sub-menu');
    
    if(subMenu.length) {
        subMenu.parent('li').children('a').append(function () {
            return '<button class="sub-nav-toggler"> <i class="fa fa-chevron-down"></i> </button>';
        });
        
        var subMenuToggler = $('.sub-menu-bar .navbar-nav .sub-nav-toggler');
        
        subMenuToggler.on('click', function() {
            $(this).parent().parent().children(".sub-menu").slideToggle();
            return false
        });
        
    }
    
    
    //===== Sticky
    
    $(window).on('scroll',function(event) {    
        var scroll = $(window).scrollTop();
        if (scroll < 245) {
            $(".navbar").removeClass("sticky");
        }else{
            $(".navbar").addClass("sticky");
        }
    });

    
    //===== Magnific Popup
    
    $('.video-popup').magnificPopup({
        type: 'iframe',
    });
    
    
    //===== Owl Carousel Causes Siled
    
    $('.causes-siled').slick({
        dots: false,
        infinite: true,
        centerMode: true,
        centerPadding: '0',
        speed: 600,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>' ,
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>' ,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 3,
              }
            },
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 2,
                  centerMode: false,
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                  arrows: false,
              }
            },
            {
              breakpoint: 576,
              settings: {
                slidesToShow: 1,
                  arrows: false,
              }
            }
        ]
    });
    
    
    //===== Range Slider
    
    $('input[type="range"]').rangeslider({
        polyfill:false,
        onInit:function(){
            $('.raise-goal .raise').text($('input[type="range"]').val());
        },
        onSlide:function(position, value){
            $('.raise-goal .raise').text(value);
        },
	});
    
    
    // Single Event Active
    
    $('#events-part').on('mouseover', '.singel-event', function() {
        $('.singel-event.active').removeClass('active');
        $(this).addClass('active');
    });
    
    
    
    //===== Magnific Popup
    
    $('.gallery-item').magnificPopup({
        type: 'image',
        gallery:{
        enabled:true
        }
    });
    
    
    //===== Counter Up
    
    $('.counter').counterUp({
        delay: 10,
        time: 2000
    });

    //===== Slick Testimonials Slied
    
     $('.test-thumb').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        fade: true,
        asNavFor: '.testimonials-content'
    });
    
    $('.testimonials-content').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.test-thumb',
        dots: false,
        arrows: true,
        prevArrow:'<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
        focusOnSelect: true,
        responsive: [
            {
              breakpoint: 576,
              settings: {
                  arrows: false,
              }
            }
        ]
    });
    
    
    //===== Back to top
    
    // Show or hide the sticky footer button
    $(window).on('scroll', function(event) {
        if($(this).scrollTop() > 600){
            $('.back-to-top').fadeIn(200)
        } else{
            $('.back-to-top').fadeOut(200)
        }
    });
    
    
    //Animate the scroll to yop
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        
        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });
    
    
    
    //===== 
    
    
    
    
    
    
});