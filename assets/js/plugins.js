/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.0
Version:    V 1.0
Last change:    20.04.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/

(function ($) {

    'use strict';
    /*---------------====================
     Mobile Menu 
    ================-------------------*/
    $(".menu-item-has-children > a").on("click", function () {
      var element = $(this).parent("li");
      if (element.hasClass("open")) {
        element.removeClass("open");
        element.find("li").removeClass("open");
        element.find("ul").slideUp(500, "linear");
      } else {
        element.addClass("open");
        element.children("ul").slideDown();
        element.siblings("li").children("ul").slideUp();
        element.siblings("li").removeClass("open");
        element.siblings("li").find("li").removeClass("open");
        element.siblings("li").find("ul").slideUp();
      }
    }); // menu menu active link

    $(".main-menu ul li").on("click", function () {
      $(".main-menu ul li").removeClass("active");
      $(this).addClass("active");
    }); // mobile menu click

    $(".menu-click").on("click", function () {
      $(".main-menu > ul").toggleClass('show');
      return false;
    });
    
    $('a.smooth-scroll').on("click", function (e) {
      var anchor = $(this);
      $('html, body').stop().animate({
        scrollTop: $(anchor.attr('href')).offset().top - 70
      }, 1200, 'easeInOutExpo');
      e.preventDefault();
    });
    
    if($('.navbar-collapse').length > 0){
      $('body').scrollspy({
        target: '.navbar-collapse',
        offset: 195
      });
    }
    
    $(".navbar-toggler").on('click', function () {
      $(".navbar-toggler").toggleClass("cg");
    });
    
    $('.open-creatac').on("click", function () {
      $(".slippa-modal-input.two , .slippa-modal-headr.two").addClass("show-cac");
      $(".slippa-modal-input.one, .slippa-modal-headr.one").addClass("hide-cac");
    });
    
    $(".slippa-one-page-menu ul > li.nav-item > a.nav-link").on('click', function () {
      $(".navbar-collapse").removeClass("show");
      $(".navbar-toggler").removeClass("cg");
    });
    
    $(".open-cart-opt").on("click", function () {
      $(".slippa-cart-box").toggleClass("active");
    });

    /*--------------------------------------------------*/
    /*  Mobile Menu Deafult
    /*--------------------------------------------------*/

    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 200) {
        $(".slippa-sticky").removeClass("slippa-sticky-active fadeInDown animated");
      } 
      else 
      {
        $(".slippa-sticky").addClass("slippa-sticky-active fadeInDown animated");
      }
    });

    $(".slippa-search-open").on("click", function () {
      $(".slippa-hidden-search").addClass("slippa-search-active");
    });

    $(".slippa-search-close").on("click", function () {
      $(".slippa-hidden-search").removeClass("slippa-search-active");
    });

})(jQuery)