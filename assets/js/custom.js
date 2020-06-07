/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.2
Version:    V 1.2
Last change:    25.05.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/

/* ----------------- MAIN JS FILE ----------------- */


/* ----------------- Start Document ----------------- */
(function($){
"use strict";

$(document).ready(function(){

	/*----------------------------------------------------*/
	/*  Back to Top
	/*----------------------------------------------------*/
	// Button
	function backToTop() {
		$('body').append('<div id="backtotop"><a href="#"></a></div>');
	}
	backToTop();

	// Showing Button
	var pxShow = 600; // height on which the button will show
	var scrollSpeed = 500; // how slow / fast you want the button to scroll to top.

	$(window).scroll(function(){
	 if($(window).scrollTop() >= pxShow){
		$("#backtotop").addClass('visible');
	 } else {
		$("#backtotop").removeClass('visible');
	 }
	});

	$('#backtotop a').on('click', function(){
	 $('html, body').animate({scrollTop:0}, scrollSpeed);
	 return false;
	});
	

	/*--------------------------------------------------*/
	/*  Ripple Effect
	/*--------------------------------------------------*/
	$('.ripple-effect, .ripple-effect-dark').on('click', function(e) {
		var rippleDiv = $('<span class="ripple-overlay">'),
			rippleOffset = $(this).offset(),
			rippleY = e.pageY - rippleOffset.top,
			rippleX = e.pageX - rippleOffset.left;

		rippleDiv.css({
			top: rippleY - (rippleDiv.height() / 2),
			left: rippleX - (rippleDiv.width() / 2),
		}).appendTo($(this));

		window.setTimeout(function() {
			rippleDiv.remove();
		}, 800);
	});


	/*--------------------------------------------------*/
	/*  Interactive Effects
	/*--------------------------------------------------*/
	$(".switch, .radio").each(function() {
		var intElem = $(this);
		intElem.on('click', function() {
			intElem.addClass('interactive-effect');
		   setTimeout(function() {
					intElem.removeClass('interactive-effect');
		   }, 400);
		});
	});


	/*--------------------------------------------------*/
	/*  Sliding Button Icon
	/*--------------------------------------------------*/
	$(window).on('load', function() {
		$(".button.button-sliding-icon").not(".task-listing .button.button-sliding-icon").each(function() {
			var buttonWidth = $(this).outerWidth()+30;
			$(this).css('width',buttonWidth);
		});
	});


	/*--------------------------------------------------*/
	/*  Sliding Button Icon
	/*--------------------------------------------------*/
    $('.bookmark-icon').on('click', function(e){
    	e.preventDefault();
		$(this).toggleClass('bookmarked');
	});

    $('.bookmark-button').on('click', function(e){
    	e.preventDefault();
		$(this).toggleClass('bookmarked');
	});


	/*----------------------------------------------------*/
	/*  Notifications Boxes
	/*----------------------------------------------------*/
	$("a.close").removeAttr("href").on('click', function(){
		function slideFade(elem) {
			var fadeOut = { opacity: 0, transition: 'opacity 0.5s' };
			elem.css(fadeOut).slideUp();
		}
		slideFade($(this).parent());
	});

	/*--------------------------------------------------*/
	/*  Full Screen Page Scripts
	/*--------------------------------------------------*/

	// Wrapper Height (window height - header height)
	function wrapperHeight() {
		var headerHeight = $("#header-container").outerHeight();
		var windowHeight = $(window).outerHeight() - headerHeight;
		$('.full-page-content-container, .dashboard-content-container, .dashboard-sidebar-inner, .dashboard-container, .full-page-container').css({ height: windowHeight });
		$('.dashboard-content-inner').css({ 'min-height': windowHeight });
	}

	// Enabling Scrollbar
	function fullPageScrollbar() {
		$(".full-page-sidebar-inner, .dashboard-sidebar-inner").each(function() {

			var headerHeight = $("#header-container").outerHeight();
			var windowHeight = $(window).outerHeight() - headerHeight;
			var sidebarContainerHeight = $(this).find(".sidebar-container, .dashboard-nav-container").outerHeight();

			// Enables scrollbar if sidebar is higher than wrapper
			if (sidebarContainerHeight > windowHeight) {
				$(this).css({ height: windowHeight });
		
			} else {
				$(this).find('.simplebar-track').hide();
			}
		});
	}

	// Init
	$(window).on('load resize', function() {
		wrapperHeight();
		fullPageScrollbar();
	});

	// Thumnail Switcher
	function avatarSwitcher() {
	    var readURL = function(input,name='profile-pic') {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('.'+name).attr('src', e.target.result);
	            };
	    
	            reader.readAsDataURL(input.files[0]);
	        }
	    };
	   
	    $(".file-upload").on('change', function(){
	        readURL(this);
	    });

	    $(".image-upload").on('change', function(){
	        readURL(this,$(this).data('img'));
	    });
	    
	    $(".upload-button").on('click', function() {
	       $(".file-upload").click();
	    });

	    $(".image-upload-button").on('click', function() {
	       var id = $(this).next('.image-upload').attr('id')
	       $('#'+id).click();
	    });
	} avatarSwitcher();


	/*----------------------------------------------------*/
	/* Dashboard Scripts
	/*----------------------------------------------------*/

	// Dashboard Nav Submenus
    $('.dashboard-nav ul li a').on('click', function(e){
		if($(this).closest("li").children("ul").length) {
			if ( $(this).closest("li").is(".active-submenu") ) {
	           $('.dashboard-nav ul li').removeClass('active-submenu');
	        } else {
	            $('.dashboard-nav ul li').removeClass('active-submenu');
	            $(this).parent('li').addClass('active-submenu');
	        }
	        e.preventDefault();
		}
	});


	// Responsive Dashbaord Nav Trigger
    $('.dashboard-responsive-nav-trigger').on('click', function(e){
    	e.preventDefault();
		$(this).toggleClass('active');

		var dashboardNavContainer = $('body').find(".dashboard-nav");

		if( $(this).hasClass('active') ){
			$(dashboardNavContainer).addClass('active');
		} else {
			$(dashboardNavContainer).removeClass('active');
		}

		$('.dashboard-responsive-nav-trigger .hamburger').toggleClass('is-active');

	});

	// Fun Facts
	function funFacts() {
		/*jslint bitwise: true */
		function hexToRgbA(hex){
		    var c;
		    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
		        c= hex.substring(1).split('');
		        if(c.length== 3){
		            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
		        }
		        c= '0x'+c.join('');
		        return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',0.07)';
		    }
		}

		$(".fun-fact").each(function() {
			var factColor = $(this).attr('data-fun-fact-color');

	        if(factColor !== undefined) {
	        	$(this).find(".fun-fact-icon").css('background-color', hexToRgbA(factColor));
	            $(this).find("i").css('color', factColor);
	        }
		});

	} funFacts();


	// Messages Scrollbar
	$(window).on('load resize', function() {
		var winwidth = $(window).width();
		if ( winwidth > 1199) {

			// Notes
			$('.row').each(function() {
				var mbh = $(this).find('.main-box-in-row').outerHeight();
				var cbh = $(this).find('.child-box-in-row').outerHeight();
				if ( mbh < cbh ) {
					var headerBoxHeight = $(this).find('.child-box-in-row .headline').outerHeight();
					var mainBoxHeight = $(this).find('.main-box-in-row').outerHeight() - headerBoxHeight + 39;

					$(this).find('.child-box-in-row .content')
							.wrap('<div class="dashboard-box-scrollbar" style="max-height: '+mainBoxHeight+'px" data-simplebar></div>');
				}
			});

		}
	});

	// Mobile Adjustment for Single Button Icon in Dashboard Box
	$('.buttons-to-right').each(function() {
		var btr = $(this).width();
		if (btr < 36) {
			$(this).addClass('single-right-button');
		}
	});

	// Small Footer Adjustment
	$(window).on('load resize', function() {
		var smallFooterHeight = $('.small-footer').outerHeight();
		$('.dashboard-footer-spacer').css({
			'padding-top': smallFooterHeight + 45
		});
	});


	// Auto Resizing Message Input Field
    /* global jQuery */
	jQuery.each(jQuery('textarea[data-autoresize]'), function() {
		var offset = this.offsetHeight - this.clientHeight;

		var resizeTextarea = function(el) {
		    jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
		};
		jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
	});


	/*--------------------------------------------------*/
	/*  Star Rating
	/*--------------------------------------------------*/
	function starRating(ratingElem) {

		$(ratingElem).each(function() {

			var dataRating = $(this).attr('data-rating');

			// Rating Stars Output
			function starsOutput(firstStar, secondStar, thirdStar, fourthStar, fifthStar) {
				return(''+
					'<span class="'+firstStar+'"></span>'+
					'<span class="'+secondStar+'"></span>'+
					'<span class="'+thirdStar+'"></span>'+
					'<span class="'+fourthStar+'"></span>'+
					'<span class="'+fifthStar+'"></span>');
			}

			var fiveStars = starsOutput('star','star','star','star','star');

			var fourHalfStars = starsOutput('star','star','star','star','star half');
			var fourStars = starsOutput('star','star','star','star','star empty');

			var threeHalfStars = starsOutput('star','star','star','star half','star empty');
			var threeStars = starsOutput('star','star','star','star empty','star empty');

			var twoHalfStars = starsOutput('star','star','star half','star empty','star empty');
			var twoStars = starsOutput('star','star','star empty','star empty','star empty');

			var oneHalfStar = starsOutput('star','star half','star empty','star empty','star empty');
			var oneStar = starsOutput('star','star empty','star empty','star empty','star empty');

			// Rules
	        if (dataRating >= 4.75) {
	            $(this).append(fiveStars);
	        } else if (dataRating >= 4.25) {
	            $(this).append(fourHalfStars);
	        } else if (dataRating >= 3.75) {
	            $(this).append(fourStars);
	        } else if (dataRating >= 3.25) {
	            $(this).append(threeHalfStars);
	        } else if (dataRating >= 2.75) {
	            $(this).append(threeStars);
	        } else if (dataRating >= 2.25) {
	            $(this).append(twoHalfStars);
	        } else if (dataRating >= 1.75) {
	            $(this).append(twoStars);
	        } else if (dataRating >= 1.25) {
	            $(this).append(oneHalfStar);
	        } else if (dataRating < 1.25) {
	            $(this).append(oneStar);
	        }

		});

	} starRating('.star-rating');

	/*--------------------------------------------------*/
	/*  Tippy JS 
	/*--------------------------------------------------*/
    /* global tippy */
	tippy('[data-tippy-placement]', {
		delay: 100,
		arrow: true,
		arrowType: 'sharp',
		size: 'regular',
		duration: 200,

		// 'shift-toward', 'fade', 'scale', 'perspective'
		animation: 'shift-away',

		animateFill: true,
		theme: 'dark',

		// How far the tooltip is from its reference element in pixels 
		distance: 10,

	});

	/*--------------------------------------------------*/
	/*  Keywords
	/*--------------------------------------------------*/
	$(".keywords-container").each(function() {

		var keywordInput = $(this).find(".keyword-input");
		var keywordsList = $(this).find(".keywords-list");

		// adding keyword
		function addKeyword() {
			var $newKeyword = $("<span class='keyword'><span class='keyword-remove'></span><span class='keyword-text'>"+ keywordInput.val() +"</span></span>");
			keywordsList.append($newKeyword).trigger('resizeContainer');
			keywordInput.val("");
		}

		// add via enter key
		keywordInput.on('keyup', function(e){
			if((e.keyCode == 13) && (keywordInput.val()!=="")){
				addKeyword();
			}
		});

		// add via button
		$('.keyword-input-button').on('click', function(){ 
			if((keywordInput.val()!=="")){
				addKeyword();
			}
		});

		// removing keyword
		$(document).on("click",".keyword-remove", function(){
			$(this).parent().addClass('keyword-removed');

			function removeFromMarkup(){
			  $(".keyword-removed").remove();
			}
			setTimeout(removeFromMarkup, 500);
			keywordsList.css({'height':'auto'}).height();
		});


		// animating container height
		keywordsList.on('resizeContainer', function(){
		    var heightnow = $(this).height();
		    var heightfull = $(this).css({'max-height':'auto', 'height':'auto'}).height();

			$(this).css({ 'height' : heightnow }).animate({ 'height': heightfull }, 200);
		});

		$(window).on('resize', function() {
			keywordsList.css({'height':'auto'}).height();
		});

		// Auto Height for keywords that are pre-added
		$(window).on('load', function() {
			var keywordCount = $('.keywords-list').children("span").length;

			// Enables scrollbar if more than 3 items
			if (keywordCount > 0) {
				keywordsList.css({'height':'auto'}).height();
		
			} 
		});

	});


	/*--------------------------------------------------*/
	/*  Bootstrap Range Slider
	/*--------------------------------------------------*/

	// Thousand Separator
	function ThousandSeparator(nStr) {
	    nStr += '';
	    var x = nStr.split('.');
	    var x1 = x[0];
	    var x2 = x.length > 1 ? '.' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + ',' + '$2');
	    }
	    return x1 + x2;
	}

	// Default Bootstrap Range Slider
	var currencyAttr = $(".range-slider").attr('data-slider-currency');
	
	$(".range-slider").slider({
		formatter: function(value) {
			return currencyAttr + ThousandSeparator(parseInt(value[0])) + " - " + currencyAttr + ThousandSeparator(parseInt(value[1]));
		}
	});

	$(".range-slider-single").slider();


	/*----------------------------------------------------*/
	/*  Payment Accordion
	/*----------------------------------------------------*/
    var radios = document.querySelectorAll('.payment-tab-trigger > input');
 
    for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', expandAccordion);
    }
 
    function expandAccordion (event) {
      /* jshint validthis: true */
      var tabber = this.closest('.payment');
      var allTabs = tabber.querySelectorAll('.payment-tab');
      for (var i = 0; i < allTabs.length; i++) {
        allTabs[i].classList.remove('payment-tab-active');
      }
      clearInputs('paymentForm');
      event.target.parentNode.parentNode.classList.add('payment-tab-active');
    }

	/*----------------------------------------------------*/
	/*  Share URL and Buttons
	/*----------------------------------------------------*/
  	/* global ClipboardJS */
	$('.copy-url input').val(window.location.href);
	new ClipboardJS('.copy-url-button');

	$(".share-buttons-icons a").each(function() {
		var buttonBG = $(this).attr("data-button-color");
        if(buttonBG !== undefined) {
        	$(this).css('background-color',buttonBG);
        }
	});


	/*----------------------------------------------------*/
	/*  Tabs
	/*----------------------------------------------------*/
	var $tabsNav    = $('.popup-tabs-nav'),
	$tabsNavLis = $tabsNav.children('li');

	$tabsNav.each(function() {
		 var $this = $(this);

		 $this.next().children('.popup-tab-content').stop(true,true).hide().first().show();
		 $this.children('li').first().addClass('active').stop(true,true).show();
	});

	$tabsNavLis.on('click', function(e) {
		 var $this = $(this);

		 $this.siblings().removeClass('active').end().addClass('active');

		 $this.parent().next().children('.popup-tab-content').stop(true,true).hide()
		 .siblings( $this.find('a').attr('href') ).fadeIn();

		 e.preventDefault();
	});

	var hash = window.location.hash;
	var anchor = $('.tabs-nav a[href="' + hash + '"]');
	if (anchor.length === 0) {
		 $(".popup-tabs-nav li:first").addClass("active").show(); //Activate first tab
		 $(".popup-tab-content:first").show(); //Show first tab content
	} else {
		 anchor.parent('li').click();
	}

	// Disable tabs if there's only one tab
	$('.popup-tabs-nav').each(function() {
		var listCount = $(this).find("li").length;
		if ( listCount < 2 ) {
			$(this).css({
				'pointer-events': 'none'
			});
		}
	});


  	/*----------------------------------------------------*/
    /*  Indicator Bar
    /*----------------------------------------------------*/
	$('.indicator-bar').each(function() {
		var indicatorLenght = $(this).attr('data-indicator-percentage');
		$(this).find("span").css({
			width: indicatorLenght + "%"
		});
	});


    /*----------------------------------------------------*/
    /*  Custom Upload Button
    /*----------------------------------------------------*/

	var uploadButton = {
		$button    : $('.uploadButton-input-visual'),
		$nameField : $('.uploadButton-file-name-visual')
	};

	var uploadButton2 = {
		$button    : $('.uploadButton-input-cover'),
		$nameField : $('.uploadButton-file-name-cover')
	};

	var uploadButton3 = {
		$button    : $('.uploadButton-input-thumb'),
		$nameField : $('.uploadButton-file-name-thumb')
	};

	var uploadButton4 = {
		$button    : $('.uploadButton-input-profit'),
		$nameField : $('.uploadButton-file-name-profit')
	};

	uploadButton.$button.on('change',function() {
		_populateFileField($(this),uploadButton);
	});

	uploadButton2.$button.on('change',function() {
		_populateFileField($(this),uploadButton2);
	});

	uploadButton3.$button.on('change',function() {
		_populateFileField($(this),uploadButton3);
	});

	uploadButton4.$button.on('change',function() {
		_populateFileField($(this),uploadButton4);
	});

	function _populateFileField($button,varaibale) {
		var selectedFile = [];
	    for (var i = 0; i < $button.get(0).files.length; ++i) {
	        selectedFile.push($button.get(0).files[i].name +'<br>');
	    }
	    varaibale.$nameField.html(selectedFile);
	}

	
  	/*----------------------------------------------------*/
    /*  Slick Carousel
    /*----------------------------------------------------*/
	$('.blog-carousel').slick({
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: false,
		arrows: true,
		responsive: [
			{
			  breakpoint: 1365,
			  settings: {
				slidesToShow: 3,
				dots: true,
				arrows: false
			  }
			},
			{
			  breakpoint: 992,
			  settings: {
				slidesToShow: 2,
				dots: true,
				arrows: false
			  }
			},
			{
			  breakpoint: 768,
			  settings: {
				slidesToShow: 1,
				dots: true,
				arrows: false
			  }
			}
		]
	});

	$('.popup-with-zoom-anim').magnificPopup({
		 type: 'inline',

		 fixedContentPos: false,
		 fixedBgPos: true,

		 overflowY: 'auto',

		 closeBtnInside: true,
		 preloader: false,

		 midClick: true,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in',
		 disableOn: function() {
  			if(userID ==='') {
  				popnotificaton('<b> Please login to perform this action </b>','info');
  				setTimeout(function(){
                        window.location.replace(baseUrl+"login");
                    }, 2000);
    			return false;
  			}
  			return true;
		}
	});

});

})(this.jQuery);


	// -------------------------------------------------------------
  	//  Owl Carousel
	// -------------------------------------------------------------

	/*----------------------------------------------------*/
    /*  Recent / Popular & Solid Listings
    /*----------------------------------------------------*/
    "use strict";
 	function LoadThreeSliders() {

    $("#recent-slider,#popular-slider,#sold-slider,feature-active").owlCarousel({
       	items:4,
       	nav:true,
        autoplay:true,
        dots:true,
        autoplayHoverPause:true,
        nav:true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy:1
            },
            500: {
                items: 1,
                slideBy:1
            },
            991: {
                items: 2,
                slideBy:1
            },
            1200: {
                items: 4,
                slideBy:1
            },
        }            

    });
	}


	/*----------------------------------------------------*/
    /*  Sponsored Listings
    /*----------------------------------------------------*/
(function() {

"use strict";

        $("#featured-slider").owlCarousel({
            items:4,
            nav:true,
            autoplay:true,
            dots:true,
            autoplayHoverPause:true,
            nav:true,
            navText: [
              "<i class='fa fa-angle-left '></i>",
              "<i class='fa fa-angle-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                    slideBy:1
                },
                500: {
                    items: 1,
                    slideBy:1
                },
                991: {
                    items: 2,
                    slideBy:1
                },
                1200: {
                    items: 4,
                    slideBy:1
                },
            }            

        });

}());


	/*----------------------------------------------------*/
    /*  Featured Sliders Listing Page
    /*----------------------------------------------------*/

(function() {

"use strict";

        $("#featured-slider-page").owlCarousel({
            items:2,
            nav:true,
            autoplay:true,
            dots:true,
            autoplayHoverPause:true,
            nav:true,
            navText: [
              "<i class='fa fa-angle-left '></i>",
              "<i class='fa fa-angle-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                    slideBy:1
                },
                500: {
                    items: 1,
                    slideBy:1
                },
                991: {
                    items: 2,
                    slideBy:1
                },
                1200: {
                    items: 2,
                    slideBy:1
                },
            }            

        });

}());


	/*----------------------------------------------------*/
    /*  Sponsored Slider
    /*----------------------------------------------------*/
(function() {

"use strict";

        $("#sponsored-slider").owlCarousel({
            items:1,
            nav:true,
            autoplay:true,
            dots:true,
            autoplayHoverPause:true,
            nav:true,
            navText: [
              "<i class='fa fa-angle-left '></i>",
              "<i class='fa fa-angle-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                    slideBy:1
                },
                500: {
                    items: 1,
                    slideBy:1
                },
                991: {
                    items: 1,
                    slideBy:1
                },
                1200: {
                    items: 1,
                    slideBy:1
                },
            }            

        });

}());

	/*----------------------------------------------------*/
    /*  Featured Domains Slider
    /*----------------------------------------------------*/
	if ($('#feature-active').length > 0) {
	$("#feature-active").owlCarousel({
       	items:4,
       	nav:true,
        autoplay:true,
        dots:true,
        autoplayHoverPause:true,
        nav:true,
        navText: [
            "<i class='fa fa-angle-left '></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                slideBy:1
            },
            500: {
                items: 1,
                slideBy:1
            },
            991: {
                items: 2,
                slideBy:1
            },
            1200: {
                items: 4,
                slideBy:1
            },
        }            

    });
    } // slider animation

	/*----------------------------------------------------*/
    /*  More from user Slider
    /*----------------------------------------------------*/
(function() {

"use strict";

        $("#user-products-slider").owlCarousel({
            items:4,
            nav:true,
            autoplay:true,
            dots:true,
            autoplayHoverPause:true,
            nav:true,
            navText: [
              "<i class='fa fa-angle-left '></i>",
              "<i class='fa fa-angle-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                    slideBy:1
                },
                500: {
                    items: 1,
                    slideBy:1
                },
                991: {
                    items: 2,
                    slideBy:1
                },
                1200: {
                    items: 4,
                    slideBy:1
                },
            }            

        });

}());

	/*----------------------------------------------------*/
    /*  Ending Soon Slider
    /*----------------------------------------------------*/
(function() {

"use strict";

        $("#ending-soon-slider").owlCarousel({
            items:4,
            nav:true,
            autoplay:true,
            dots:true,
            autoplayHoverPause:true,
            nav:true,
            navText: [
              "<i class='fa fa-angle-left '></i>",
              "<i class='fa fa-angle-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                    slideBy:1
                },
                500: {
                    items: 1,
                    slideBy:1
                },
                991: {
                    items: 2,
                    slideBy:1
                },
                1200: {
                    items: 4,
                    slideBy:1
                },
            }            

        });

}());


	/*----------------------------------------------------*/
    /*  Pricing Plans Sliders
    /*----------------------------------------------------*/
(function() {

"use strict";

        $("#pricing-plans-1,#pricing-plans-2,#pricing-plans-3").owlCarousel({
            items:3,
            nav:true,
            autoplay:true,
            dots:true,
            autoplayHoverPause:true,
            nav:true,
            navText: [
              "<i class='fa fa-angle-left '></i>",
              "<i class='fa fa-angle-right'></i>"
            ],
            responsive: {
                0: {
                    items: 1,
                    slideBy:1
                },
                500: {
                    items: 1,
                    slideBy:1
                },
                991: {
                    items: 2,
                    slideBy:1
                },
                1200: {
                    items: 3,
                    slideBy:1
                },
            }            

        });

}());

	/*----------------------------------------------------*/
    /*  Top Domain Ads Crousel Slider
    /*----------------------------------------------------*/
$(document).ready(function() {
	"use strict";

    $('.owl-domain-prices-previw').owlCarousel({
            loop: true,
            margin: 10,
           	autoplay:true,
            autoplayTimeout: 3000,
            autoplayHoverPause:true,
            responsiveClass: true,
            dots: false,
            responsive: {
                0: {
                   items: 1,
                },
                340: {
                   items: 1,
                   margin: 20
                },
                350: {
                   items: 2,
                   margin: 20
                },
                490: {
                   items: 3,
                   margin: 20
                },
                780: {
                   items: 2,
                   margin: 20
                },
                1000: {
                  items: 3,
                  loop: true,
                  margin: 20
                },
                1200: {
                   items: 4,
                   loop: true,
                   margin: 20
                }
        }
    })
});

/*--------------------------------------------------*/
/*  Tooltips
/*--------------------------------------------------*/
$(window).on('load', function() {	
	$('[data-toggle="tooltip"]').tooltip()
});

//Panel Colapse//
function toggleIcon(e) {
$(e.target)
    .prev('.panel-heading')
    .find(".more-less")
    .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse',toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);



/*--------------------------------------------------*/
/*  Load Trending Listings
/*--------------------------------------------------*/
"use strict";
function loadTrendingAds(){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadingtrendingAds').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'main/loadTrendingAds/',
    data:{[csrfName]: csrfHash },
    success:function(data){
    $('#trendingAds').fadeOut(100).html(data.response).fadeIn(500);
    $('#trendingAds').html(data.response);
    $('.txt_csrfname').val(data.token); 
    LoadThreeSliders();
    $('#loadingtrendingAds').hide();
    },
    complete: function(){
    $('#loadingtrendingAds').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
}

/*--------------------------------------------------*/
/*  Discount Coupon
/*--------------------------------------------------*/
$(document).on("submit", "#discountCouponForm", function(event) {
	event.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
  	var cartArray = shoppingCart.listCart();
  	$('#loadingCoupon').show();

  	if($("#checkoutCoupon").val()==="")
  	{
    	bootstrap_alert.error('Please enter a coupon code','#discountCouponValidate');
    	$('#loadingCoupon').hide();
    	return;
  	}

  	if (Array.isArray(cartArray) && cartArray.length === 0) { 

  		bootstrap_alert.error('Sorry Coupon Code is not valid','#discountCouponValidate');
    	$('#loadingCoupon').hide();
    	return;
  	}  

  	$.ajax({
    method :'POST',
    url: baseUrl+'main/validate_discount_code',
    data:{code:$('#checkoutCoupon').val(),purchases:cartArray,[csrfName]: csrfHash},
    success:function(data){
    if(data ==='')
    {
    	bootstrap_alert.error('Invalid Code','#discountCouponValidate');
    	$('#loadingCoupon').hide();
    	return;
    }
    else
    {
    	var dataArr = JSON.parse(data);
    	var total = shoppingCart.totalCart();

    	bootstrap_alert.success('Successfully applied the discount code','#discountCouponValidate');

    	if(dataArr.discountType === '0')
    	{
    		discount = (total * dataArr.discount) / 100;
    		$('.discount-type').html(dataArr.discount+'%');
    		$('.total-discount').html(('('+dataArr.discount+'%) - ')+' '+'('+discount+')');
    		$('.total-cost').html(total- discount);
    	}
    	else if(dataArr.discountType === '1')
    	{
    		$('.discount-type').html("");
    		$('.total-discount').html(dataArr.discount);
    		$('.total-cost').html(total - dataArr.discount);
    	}
    	
    }
    $('#loadingCoupon').hide();
    },
    complete: function(){
    $('#loadingCoupon').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});


/*--------------------------------------------------*/
/*  Button Next
/*--------------------------------------------------*/
$(document).on('click','#BtnNext',function(){
	var form = $('#createListingForm');
    form.validate();
    if (form.valid()) {
    	$("#ThirdTab").removeAttr('href');
    	$("#SecondStep").show();
    	$("#collapseTwo").collapse('hide');
    	$("#collapseThree").collapse('toggle');
	}

});

/*--------------------------------------------------*/
/*  Button Next Pay
/*--------------------------------------------------*/
$(document).on('click','#BtnNextPay',function(){
	var form = $('#createListingForm');
    form.validate();
    if (form.valid()) {
    	$("#FifthTab").removeAttr('href');
    	$("#FifthStep").show();
    	$("#collapseFive").collapse('hide');
    	$("#collapseSix").collapse('toggle');
	}
});

/*--------------------------------------------------*/
/*  Button Pay Domain
/*--------------------------------------------------*/
$(document).on('click','#BtnNextPayDom',function(){
	var form = $('#createListingForm');
    form.validate();
    if (form.valid()) {
    	$("#FifthTab").removeAttr('href');
    	$("#FourthStep").show();
    	$("#collapseFour").collapse('hide');
    	$("#collapseSix").collapse('toggle');
	}
});

/*--------------------------------------------------*/
/*  Button Skip
/*--------------------------------------------------*/
$(document).on('click','#BtnSkip',function(){
	var form = $('#createListingForm');
    form.validate();
    if (form.valid()) {
    	$('.listings').prop("checked",false);
    	$('.sponsored').prop("checked",false);
    	$("#FourthTab").removeAttr('href');
    	$("#FourthStep").show();
    	$("#collapseFour").collapse('hide');
    	$("#collapseFive").collapse('toggle');
	}
});

/*--------------------------------------------------*/
/*  Button Final Next 
/*--------------------------------------------------*/
$(document).on('click','#BtnNextFinal',function(){
	var form = $('#createListingForm');
    form.validate();
    if (form.valid()) {
    	TotalAmount = parseFloat($('#txt_payamount').val());
    	$("#pay_listing").show();
    	$("#create_listing_sesction").hide();

    	if(TotalAmount > 0){
    		$('#answer_3_freecheckout').prop("disabled",true);
    		$('#answer_3_freecheckout').prop("checked",false);
    		$('#answer_1_payvia_card').prop("checked",true);
    		$('#answer_2_payvia_paypal').prop("checked",false);
    		$('#answer_4_payvia_paypal').prop("checked",false);
    		$('#Pay_free').hide();
    		$('#Pay_Credit_Card').show();
    		$('#Pay_stripe').hide();
    		$('#button_pay').show();
    	}
    	else
    	{
    		$('#answer_3_freecheckout').prop("checked",true);
    		$('#answer_2_payvia_paypal').prop("checked",false);
    		$('#answer_1_payvia_card').prop("checked",false);
    		$('#answer_1_payvia_card').prop("disabled",true);
    		$('#answer_4_payvia_paypal').prop("checked",false);
    		$('#answer_4_payvia_paypal').prop("disabled",true);
    		$('#answer_2_payvia_paypal').prop("disabled",true);
    		$('#freecheckout_select').show();
    		$('#Pay_free').show();
    		$('#Pay_Credit_Card').hide();
    		$('#Pay_stripe').hide();
    		$('#button_pay').show();
    	}
	}
});


/*--------------------------------------------------*/
/*  Verify New Domain
/*--------------------------------------------------*/

$(document).on('click','.button-verify-url',function(){
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();

    if($("#selectedCategory").val() === ''){
        $("#domainVerificationDiv").hide();
        return;
    }

    if($("#siteURL").val() === ''){
        $("#domainVerificationDiv").hide();
        return;
    }

    if(!validateURL($("#siteURL").val())){
        $("#domainVerificationDiv").hide();
        return;
    }

    CheckBlacklistedDomains($("#siteURL").val(),function(response) {
   	if(response === true){
        bootstrap_alert.error(errorBlacklistedDomain,'#DomainValMsg');
        $("#domainVerificationDiv").hide();
        return;
    }
    else
    { 
       	$("#domainVerificationDiv").show();
        $("#loadingImageVerify").show();
        $.ajax({
            url: baseUrl+'common/uploadFileGenerator/',
            type:"POST",
            data: {lisingtDomain : $("#siteURL").val(),[csrfName]: csrfHash},
            dataType: "json",
            success: function (data) {
            if(data !==''){
            	$('.txt_csrfname').val(data.token); 
                if(data.response !=='false'){
                	$("#loadingImageVerify").hide();   
                	loadingInfo =   '<div>'
               		+'1). DOWNLOAD FILE : &nbsp;<a href="'+baseUrl+'/assets/verification/'+data.response['token']+'.zip'+'" class="btn btn-success">DOWNLOAD FILE</a><br>'
                	+'2). UNZIP AND UPLOAD .TXT FILE TO YOUR DOMAIN ROOT FOLDER<br>'
                	+'3). <b>IF YOU HAVE DONE EVERYTHING RIGHT YOU SHOULD BE ABLE TO ACCESS THE FILE FROM FOLLOWING URL</b>'
                	+'<a style="display: inline-block;" href="'+'//'+data.response['domain']+'/'+data.response['token']+'.txt'+'" target="_blank">'+'http://'+data.response['domain']+'/'+data.response['token']+'.txt'+'</a><br>'
                	+'4). NOW PLEASE VERIFY : <button id="btnVerifyDomain" name="btnVerifyDomain" type="button" class="btn btn-info centerButtons">VERIFY</button>'
                	+'</div></br>'
                	+'';
                	$('#savedDataInfo').val(JSON.stringify(data.response));
                	if(data.response.validations === true) {
                		$("#verificationFile").html(loadingInfo);
                		return;
                	}
                	else
                	{
                		var values = $('#savedDataInfo').val(); 
    					values = JSON.parse(values);
                		$("#domainVerificationDiv").hide();
            			bootstrap_alert.success('Successfully Verified your domain.. Please wait..','#DomainValMsg');
            			csrfName = $('.txt_csrfname').attr('name');
    					csrfHash = $('.txt_csrfname').val();
            			$('#loadingImageContinue').show();
            			$.ajax({
            			url: baseUrl+'common/checkListingExists/',
            			type:"POST",
            			data: {lisingtDomain : $("#siteURL").val(),branch_1_group_1:$('#listing_type').val(),[csrfName]: csrfHash},
            			dataType: "json",
            			success: function (data) {
            			$('.txt_csrfname').val(data.token); 
            			if(data.response === true){
                			bootstrap_alert.error('Sorry, You already have a listing for this domain.','#DomainValMsg');
                			$('#loadingImageContinue').hide();
                			$("#btnfoward").hide();
                			return;
            			}
            			else
            			{
                			$('#loadingImageContinue').hide();
                			bootstrap_alert.success('Please wait..','#ContinueVal');
                			$("#siteURL").prop("readonly", true);
                			setTimeout(function(){
                			$("#domainName").html(values.domain);
                			$("#WebsiteName").html(values.domain);
                			$("#website_BusinessName").val(values.domain);
                			$("#domainTitle").html(values.domain);
                			$("#domain_id").val(values.id);
                			$("#FirstTab").removeAttr('href');
                			$("#FirstStep").show();
                			$("#collapseOne").collapse('hide');
                			$("#collapseTwo").collapse('toggle');
                			}, 3000);
                			return;
            			}
        				}
        				});
               		}
            	}
                else{
                    $("#loadingImageVerify").hide();
                    bootstrap_alert.error('Something Went Wrong','#DomainValMsg');
                    return;
                }
            }
           	}
        });
    }    
    });      
 });


/*Submit Payment Form*/
$(document).on('submit','#payWrapper',function(e){
    e.preventDefault();
    var form = $(this);
    form.validate();
    if (form.valid()) {
        $(this)[0].submit();    
    }

});


/*Submit Listing Type*/
$(document).on('submit','#listingTypeForm',function(e){
    e.preventDefault();
    var form = $(this);
    form.validate();
    if (form.valid()) {

    	if($("input[name='branch_1_group_1']:checked").val() === 'Sell-Websites')
    	{
    		window.location.href = baseUrl+"user/create_listings/website/";
    	}
    	else
    	{
    		window.location.href = baseUrl+"user/create_listings/domain/";
    	}
     
    }

});


/*--------------------------------------------------*/
/*  Submit Listings Form
/*--------------------------------------------------*/

$(document).on('submit','#createListingForm',function(e){
    e.preventDefault();
    var form 		= $(this);
    var formData 	= new FormData(this);

    if($('input[name=website_1_group_2]:checked', form).val() === 'auction') {
    	if ($('#website_reserveprice').length > 0) {
    		if($('#website_reserveprice').val() !=='' && $('#website_startingprice').val() !== ''){
				if($('#website_reserveprice').val() < $('#website_startingprice').val()){
					bootstrap_alert.error('Reserved Price should be greater than Minimum Price','#submitValidaton');
            		return;
				}
			}
		}	
	}

    form.validate();
    if (form.valid()) {
       	$('#loadingImageSubmit').show();
       	$.ajax({
    	type :'POST',
    	url: baseUrl+'user/add_listing',
    	data:formData,
    	dataType: 'json',
    	cache:false,
        contentType: false,
        processData: false,
    	success:function(data){
    	$('.txt_csrfname').val(data.token); 
    	if(data.response !== false){
    		var rData = data.response;
    		bootstrap_alert.success('Successfully saved your listing.. Please wait..','#submitValidaton');
    		$('#listing_id').val(rData.id);
    		$('#txt_listingid').val(rData.id);
    		$('#loadingImageSubmit').hide();
    		$("#ThirdTab").removeAttr('href');
    		$("#linkAnalyticsAdd").attr("href", baseUrl+"analytics/index/"+$('#domain_id').val()+"/"+$('#listing_id').val()+"/123");
            $("#ThirdStep").show();
            $("#collapseThree").collapse('hide');
            $("#collapseFour").collapse('toggle');   		
    	}
    	else
    	{
    		bootstrap_alert.error(updateError,'#submitValidaton');
    		$('#loadingImageSubmit').hide(); 
        	return;
    	}
    	},
    	});
    }

});


/*--------------------------------------------------*/
/*   Category Form
/*--------------------------------------------------*/

$(document).on('submit','#CategorySettingsForm',function(e){
    e.preventDefault();
    var form 		= $(this);
    var formData 	= new FormData(this);

    form.validate();
    if (form.valid()) {
       	$('#loadingCategories').show();
       	$.ajax({
    	method :'POST',
    	url: baseUrl+'admin/save_category_data',
    	data:formData,
    	dataType: 'json',
    	cache:false,
        contentType: false,
        processData: false,
    	success:function(data){
    	$('.txt_csrfname').val(data.token); 
    	if(data.response === true){
    		bootstrap_alert.success(sucessfullyupdated,'#categoriesSettingsMsg');
    		$('#loadingCategories').hide(); 
    		location.reload(true);		
    	}
    	else
    	{
    		bootstrap_alert.error(updateError,'#categoriesSettingsMsg');
    		$('#loadingCategories').hide(); 
        	return;
    	}
    	},
    	});
    }
});


/*--------------------------------------------------*/
/*  Category URL Slug Generator
/*--------------------------------------------------*/
$(document).on('change', '#category_name', function(e){ 
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#category_name").val();
    if($("#category_name").val() !== ''){
    $.ajax({
    method :'POST',
    url: baseUrl+'common/category_urlSlugGenerator',
    data:{'title': title,[csrfName]: csrfHash},
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response){
       $("#category_url_slug").val(data.response);
       return;
    }
    },
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
    }
    else{
       $("#category_url_slug").val("");
    }
});

/*--------------------------------------------------*/
/*  Change Category Icon Upload
/*--------------------------------------------------*/
$(document).on('change', '#file-upload', function(e){ 
  	var i = $(this).prev('label').clone();
  	var file = $('#file-upload')[0].files[0].name;
  	$(this).prev('label').text(file);
});


/*--------------------------------------------------*/
/*   Listing Header Form
/*--------------------------------------------------*/

$(document).on('submit','#ListingsSettingsForm',function(e){
    e.preventDefault();
    var form = $(this);
    var formData = new FormData(this);
    form.validate();
    if (form.valid()) {
       	$('#loadinglistings').show();
       	$.ajax({
    	type :'POST',
    	url: baseUrl+'admin/save_listing_header_data',
    	data:formData,
		dataType: 'json',
    	cache:false,
        contentType: false,
        processData: false,
    	success:function(data){
    	$('.txt_csrfname').val(data.token);
    	if(data.response === true){
    		bootstrap_alert.success(sucessfullyupdated,'#listingSettingsMsg');
    		$('#loadinglistings').hide(); 
    		location.reload(true);		
    	}
    	else
    	{
    		bootstrap_alert.error(updateError,'#listingSettingsMsg');
    		$('#loadinglistings').hide(); 
        	return;
    	}
    	},
    	});
    }

});


/*--------------------------------------------------*/
/*  Listing URL Change Event
/*--------------------------------------------------*/

$(document).on('change', '#siteURL', function(e){  
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$("#btnfoward").hide();
    if($("#selectedCategory").val() === ''){
        $("#domainVerificationDiv").hide();
        return;
    }

    if($("#siteURL").val() === ''){
        $("#domainVerificationDiv").hide();
        return;
    }

    if(!validateURL($("#siteURL").val())){
        $("#domainVerificationDiv").hide();
        return;
    }

    CheckBlacklistedDomains($("#siteURL").val(),function(response) {
   	if(response === true){
        bootstrap_alert.error(errorBlacklistedDomain,'#DomainValMsg');
        $("#domainVerificationDiv").hide();
        return;
    }
   	else
   	{
        $("#domainVerificationDiv").show();
        $("#loadingImageVerify").show();
        $.ajax({
        url: baseUrl+'common/uploadFileGenerator/',
        type:"POST",
        data: {lisingtDomain : $("#siteURL").val(),[csrfName]: csrfHash},
       	dataType: "json",
        success: function (data) {
        if(data !==''){
            if(data.response !=='false'){
            	$('.txt_csrfname').val(data.token); 
                $("#loadingImageVerify").hide();   
                loadingInfo =   '<div>'
               	+'1). DOWNLOAD FILE : &nbsp;<a href="'+baseUrl+'/assets/verification/'+data.response['token']+'.zip'+'" class="btn btn-success">DOWNLOAD FILE</a><br>'
                +'2). UNZIP AND UPLOAD .TXT FILE TO YOUR DOMAIN ROOT FOLDER<br>'
                +'3). <b>IF YOU HAVE DONE EVERYTHING RIGHT YOU SHOULD BE ABLE TO ACCESS THE FILE FROM FOLLOWING URL</b>'
                +'<a style="display: inline-block;" href="'+'//'+data.response['domain']+'/'+data.response['token']+'.txt'+'" target="_blank">'+'http://'+data.response['domain']+'/'+data.response['token']+'.txt'+'</a><br>'
                +'4). NOW PLEASE VERIFY : <button id="btnVerifyDomain" name="btnVerifyDomain" type="button" class="btn btn-info centerButtons">VERIFY</button>'
                +'</div></br>'
                +'';
                $('#savedDataInfo').val(JSON.stringify(data.response));
                if(data.response.validations === true) {
                	$("#verificationFile").html(loadingInfo);
                	return;
                }
                else
                {
                	var values = $('#savedDataInfo').val(); 
    				values = JSON.parse(values);
                	$("#domainVerificationDiv").hide();
            		bootstrap_alert.success('Successfully Verified your domain.. Please wait..','#DomainValMsg');
            		csrfName = $('.txt_csrfname').attr('name');
    				csrfHash = $('.txt_csrfname').val();
            		$('#loadingImageContinue').show();
            		$.ajax({
            		url: baseUrl+'common/checkListingExists/',
            		type:"POST",
            		data: {lisingtDomain : $("#siteURL").val(),branch_1_group_1:$('#listing_type').val(),[csrfName]: csrfHash},
            		dataType: "json",
            		success: function (data) {
            		$('.txt_csrfname').val(data.token); 
            		if(data.response === true){
                		bootstrap_alert.error('Sorry, You already have a listing for this domain.','#DomainValMsg');
                		$('#loadingImageContinue').hide();
                		$("#btnfoward").hide();
                		return;
            		}
            		else
            		{
                		$('#loadingImageContinue').hide();
                		bootstrap_alert.success('Please wait..','#ContinueVal');
                		$("#siteURL").prop("readonly", true);
                		setTimeout(function(){
                		$("#domainName").html(values.domain);
                		$("#WebsiteName").html(values.domain);
                		$("#website_BusinessName").val(values.domain);
                		$("#domainTitle").html(values.domain);
                		$("#domain_id").val(values.id);
                		$("#FirstTab").removeAttr('href');
                		$("#FirstStep").show();
                		$("#collapseOne").collapse('hide');
                		$("#collapseTwo").collapse('toggle');
                		}, 3000);
                		return;
            		}
        			}
        			});
                }
            }
            else
            {
                $("#loadingImageVerify").hide();
                bootstrap_alert.error('Something Went Wrong','#DomainValMsg');
                return;
            }
        }
    	}
    	});      
    }      
    });               
});


/*--------------------------------------------------*/
/*  Button Verification Click
/*--------------------------------------------------*/

$(document).on('click','#btnVerifyDomain',function(){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $("#loadingImageVerify").show();
    var values = $('#savedDataInfo').val(); 
    values = JSON.parse(values);

    $.ajax({
    url: baseUrl+'common/readAndVerifyDomain/',
    type:"POST",
    data: {dataArr : values,[csrfName]: csrfHash},
    dataType: "json",
    success: function (data) {
    $('.txt_csrfname').val(data.token); 
    if(data !==''){
        if(data.response !== 'false'){
            $("#loadingImageVerify").hide();
            bootstrap_alert.success('Successfully Verified your domain.. Please wait..','#DomainValMsg');
            csrfName = $('.txt_csrfname').attr('name');
    		csrfHash = $('.txt_csrfname').val();
            $('#loadingImageContinue').show();
            $.ajax({
            url: baseUrl+'common/checkListingExists/',
            type:"POST",
            data: {lisingtDomain : $("#siteURL").val(),branch_1_group_1:$('#listing_type').val(),[csrfName]: csrfHash},
            dataType: "json",
            success: function (data) {
            $('.txt_csrfname').val(data.token); 
            if(data.response === true){
                bootstrap_alert.error('Sorry, You already have a listing for this domain.','#DomainValMsg');
                $('#loadingImageContinue').hide();
                $("#btnfoward").hide();
                return;
            }
            else
            {
                $('#loadingImageContinue').hide();
                bootstrap_alert.success('Please wait..','#ContinueVal');
                $("#siteURL").prop("readonly", true);
                setTimeout(function(){
                $("#domainName").html(values.domain);
                $("#WebsiteName").html(values.domain);
                $("#website_BusinessName").val(values.domain);
                $("#domainTitle").html(values.domain);
                $("#domain_id").val(values.id);
                $("#FirstTab").removeAttr('href');
                $("#FirstStep").show();
                $("#collapseOne").collapse('hide');
                $("#collapseTwo").collapse('toggle');
                }, 3000);
                return;
            }
        	}
        	});
        }
        else
        {
            $("#loadingImageVerify").hide();
            $("#btnfoward").hide();
            bootstrap_alert.error('Verification Failed.. Please try again','#DomainValMsg');
            return;
        }

    }
    else
    {
        $("#loadingImageVerify").hide();
        $("#btnfoward").hide();
        bootstrap_alert.error('Something Went Wrong','#DomainValMsg');
        return;
    }
    }
    });
});


$('input[type=radio][name=branch_1_group_2]').change(function() {
   if(this.value === 'Sell-Auction'){
   	$('#Sell-Auction').show();
   	$("#Sell-Classified").hide();
   }
   else
   {
   	$("#Sell-Auction").hide();
   	$('#Sell-Classified').show();
   }
});


$('input[type=radio][name=branch_1_pay_1]').change(function() {

   if(this.value === 'payvia_card')
   {
   		showDiv('#Pay_Credit_Card');
   		hideDiv('#Pay_paypal');
   		hideDiv('#Pay_free');
   		hideDiv('#Pay_stripe');
   }
   else if(this.value === 'payvia_paypal')
   {
   		hideDiv('#Pay_Credit_Card');
   		showDiv('#Pay_paypal');
   		hideDiv('#Pay_free');
   		hideDiv('#Pay_stripe');
   }
   else if(this.value === 'payvia_stripe')
   {
   		hideDiv('#Pay_Credit_Card');
   		hideDiv('#Pay_paypal');
   		hideDiv('#Pay_free');
   		showDiv('#Pay_stripe');
   }
   else if(this.value === 'free_checkout'){
   		hideDiv('#Pay_Credit_Card');
   		hideDiv('#Pay_paypal');
   		showDiv('#Pay_free');
   		hideDiv('#Pay_stripe');
   }
       
});

/*--------------------------------------------------*/
/*  Pricing Option Change Calculations
/*--------------------------------------------------*/
$('input[type=radio][name=listing_group_1]').change(function() {
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
   	$('#LoadingPayCalVal').show();
   	$('#btnfoward').hide();
    bootstrap_alert.success('Please wait..','#PayCalVal');
    $.ajax({
    method :'POST',
    url: baseUrl+'user/get_selectedListingHeader/'+this.value,
    data:{[csrfName]: csrfHash},
    dataType: "json",
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response !== false){
    	dataArr = data.response;
    	Output = '<li>'+dataArr[0].listing_name+ '-' + ' $ '+dataArr[0].listing_price +'</li>';
    	$('#listings').html(Output);
    	$('#txt_payid').val(dataArr[0].listing_id);
    	$('.txt_listingname').val(dataArr[0].listing_name);
    	$('.txt_listamount').val(dataArr[0].listing_price);
    	$('#txt_payamount').val(dataArr[0].listing_price);
    	$('#LoadingPayCalVal').hide();
    	$('#btnfoward').show();
    }
    },
    complete: function(){
    	$('#LoadingPayCalVal').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });  
});


/*--------------------------------------------------*/
/* Listing Sponsor Option Changed Calculations
/*--------------------------------------------------*/
$('input[type=radio][name=sponsor_group_1]').change(function() {
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
   	$('#LoadingPayCalVal').show();
   	$('#btnfoward').hide();
    bootstrap_alert.success('Please wait..','#PayCalVal');
    $.ajax({
    method :'POST',
    url: baseUrl+'user/get_selectedListingHeader/'+this.value,
    data:{[csrfName]: csrfHash},
    dataType: "json",
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response !== false){
    	dataArr = data.response;
    	var TotalAmount = parseFloat(dataArr[0].listing_price) + parseFloat($('.txt_listamount').val());
    	Output = '<li>'+$('.txt_listingname').val()+ '-' + ' $ '+$('.txt_listamount').val() +'</li>'
    			+'<li>'+dataArr[0].listing_name+ '-' + ' $ '+dataArr[0].listing_price +'</li>';
    	$('#listings').html(Output);
    	$('#total').html('<b>TOTAL AMOUNT : </b> '+'$ '+TotalAmount);
    	$('#txt_sponsored_id').val(dataArr[0].listing_id);
    	$('#txt_payamount').val(TotalAmount);
    	$('#LoadingPayCalVal').hide();
    	$('#btnfoward').show(); 
    }
    },
    complete: function(){
    	$('#LoadingPayCalVal').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});


/*--------------------------------------------------*/
/* Last 12 Months Revenue Anual Profit Change
/*--------------------------------------------------*/
$(document).on('change', '#last12_monthsrevenue', function(e){  
	e.preventDefault();
	if(this.value !==''){
		if($('#last12_monthsexpenses').val()!==''){
			$('#annual_profit').val(this.value - $('#last12_monthsexpenses').val());
		}
	}
});

/*--------------------------------------------------*/
/* Last 12 Months Revenue Expenses Change
/*--------------------------------------------------*/
$(document).on('change', '#last12_monthsexpenses', function(e){  
	e.preventDefault();
	if(this.value !==''){
		if($('#last12_monthsrevenue').val()!==''){
			$('#annual_profit').val($('#last12_monthsrevenue').val() - this.value);
		}
	}
});

/*--------------------------------------------------*/
/* Last 12 Months Revenue Profit Calculation
/*--------------------------------------------------*/
$(document).on('change', '#website_reserveprice', function(e){  
	e.preventDefault();
	if(this.value !=='' && $('#website_startingprice').val() !== ''){
		if(this.value < $('#website_startingprice').val()){
			bootstrap_alert.error('Reserved Price should be greater than Minimum Price','#reservredPriceWebsite');
            return;
		}
	}
});

/*--------------------------------------------------*/
/* Domain Reserved Price Change Event
/*--------------------------------------------------*/
$(document).on('change', '#domain_reserveprice', function(e){  
	e.preventDefault();
	if(this.value !=='' && $('#domain_startingprice').val() !== ''){
		if(this.value < $('#domain_startingprice').val()){
			bootstrap_alert.error('Reserved Price should be greater than Minimum Price','#reservredPriceHelp');
            return;
		}
	}
});


/*--------------------------------------------------
|  Withdrawal User Reviews 
/*--------------------------------------------------*/
$(document).on("click", ".paginationReviews li a", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$.ajax({
   	url:baseUrl+"main/profile_reviews/"+$('#profile_id').val()+'/'+$(this).attr('data-ci-pagination-page'),
   	method:"POST",
   	data:{[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token); 
    	$('#user_reviews_tab').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});

/*--------------------------------------------------
|  Link Google Analytics Button
/*--------------------------------------------------*/
$(document).on('click','#link_googleAnalytics',function(e){ 
	e.preventDefault();
    $('#wrapped').attr('action', baseUrl+"analytics/index").submit();       
});

/*--------------------------------------------------
|  Unlink Google Analytics Button
/*--------------------------------------------------*/
$(document).on('click','#unlink_googleAnalytics',function(e){ 
	e.preventDefault();
    window.location = baseUrl+"analytics/unlink/" + $('#domain_id').val();    
});

/*--------------------------------------------------
| Listing Type Selection
/*--------------------------------------------------*/
$('input[type=radio][name=website_1_group_2]').change(function() {
   if(this.value === 'auction'){
   	hideDiv('#Sell-Classified-Website');
	showDiv('#Sell-Auction-Website');
   	$("#website_buynowpriceclas").prop('disabled',true);
   	$("#website_buynowpriceauc").prop('disabled',false);
   }
   else
   {
   	hideDiv('#Sell-Auction-Website');
	showDiv('#Sell-Classified-Website');
   	$("#website_buynowpriceauc").prop('disabled',true);
   	$("#website_buynowpriceclas").prop('disabled',false);
   }
});


/*--------------------------------------------------
|  Cancel Offer
/*--------------------------------------------------*/
$(document).on('click','.cancel_offer',function(e){ 
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$(this).prop('disabled', true);
	$.ajax({
    method :'POST',
    url: baseUrl+'user/update_offer_status/'+$(this).attr("data-offerid"),
    data:{[csrfName]: csrfHash},
   	dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    $(this).prop('disabled', false); 
    if(data.response !== false){
    	location.reload(true);
    }
    },
    complete: function(){
    	
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });     
});

/*--------------------------------------------------
|  Accept Cancel Request
/*--------------------------------------------------*/
$(document).on('click','.accept_cancel',function(e){ 
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$(this).prop('disabled', true);
	$('#loadercontract').show();
	$.ajax({
    method :'POST',
    url: baseUrl+'main/acceptCancelreq/'+$(this).attr("data-contractid"),
    data:{[csrfName]: csrfHash},
   	dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    $(this).prop('disabled', false);
    location.reload(true);  
    if(data.response !== false){
    	$('#loadercontract').hide();
    }
    },
    complete: function(){
    	$('#loadercontract').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });     
});


/*--------------------------------------------------
|  Upload Google Key
/*--------------------------------------------------*/
$("#upload_key_form").submit(function(e) {
    e.preventDefault();
    var data = new FormData(this);
    $('#loaderkey').show();
    $.ajax({
    method :'POST',
   	url: baseUrl+'admin/upload_key/',
    data: data,
    dataType: 'json',
    processData:false,
    contentType:false,
    cache:false,
    async:false,
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
       bootstrap_alert.success("Sucessfully Uploaded",'#notificationkey');
       $('#loaderkey').hide();
    }
    else
    {
       bootstrap_alert.error(updateError,'#notificationkey');
       $('#loaderkey').hide();
    }
    },
    complete: function(){
    $('#loaderkey').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
   	});   
});


/*--------------------------------------------------
|  Reject Cancel Request
/*--------------------------------------------------*/
$(document).on('click','.reject_cancel',function(e){ 
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$('#loadercontract').show();
	$(this).prop('disabled', true);
	$.ajax({
    method :'POST',
    url: baseUrl+'main/rejectCancelreq/'+$(this).attr("data-contractid"),
    data:{[csrfName]: csrfHash},
   	dataType: 'json',
    success:function(data){
    location.reload(true);
    $('.txt_csrfname').val(data.token);
    $(this).prop('disabled', false);
    $('#loadercontract').hide();  
    if(data.response !== false){
    	location.reload(true);
    }
    },
    complete: function(){
    	$('#loadercontract').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });     
});


/*--------------------------------------------------
|  Raise a Dispute
/*--------------------------------------------------*/
$(document).on('click','.raise_dispute',function(e){ 
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$('#loadercontract').show();
	$(this).prop('disabled', true);
	$.ajax({
    method :'POST',
    url: baseUrl+'main/raisedaDispute/'+$(this).attr("data-contractid"),
    data:{[csrfName]: csrfHash},
   	dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    $(this).prop('disabled', false);
    $('#loadercontract').hide(); 
    if(data.response !== false){ 
    	location.reload(true);
    }
    },
    complete: function(){
    	$('#loadercontract').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });     
});


/*--------------------------------------------------
|  Place an Offer
/*--------------------------------------------------*/
$(document).on('submit','.offer-now-form',function(e){
    e.preventDefault();
    $('#loaderoffer').show();
    if($('.offer_amount').val() ===""){
    	$('#loaderoffer').hide();
        bootstrap_alert.error('Please enter a Offer Value ','#offerValidation');
        return;
    }

    if($('.offer_amount').val() < (parseFloat($('.offer_min_value').val()))){
    	$('#loaderoffer').hide();
        bootstrap_alert.error('Offer Value Must be Greater than '+(parseFloat($('.offer_min_value').val())),'#offerValidation');
        return;
    }
    $.ajax({
    method :'POST',
    url: baseUrl+'main/add_offer',
    data:$(".offer-now-form").serialize(),
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    if(data.response === true){
    	$('#loaderoffer').hide();
    	$('.offer_amount').val('');
    	$('.offer_msg').val('');
    	$.magnificPopup.close();
    	$('#OfferSuccessfull').modal('show');
    }
    else
    {
    	$('#loaderoffer').hide();
    	bootstrap_alert.error(data.response,'#offerValidation');
        return;
    }
    },
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});

/*--------------------------------------------------
|  Place a Bid
/*--------------------------------------------------*/
$(document).on('submit','#bid-now-form',function(e){
    e.preventDefault();
    $('#loader').show();
    if($('#bid_amount').val() ===""){
    	$('#loader').hide();
        bootstrap_alert.error('Please enter a Bid Value','#bidValidation');
        return;
    }

    if($('#bid_amount').val() < (parseFloat($('#current_bid_value').val()) + parseFloat($('#bid_gap_value').val()))){
    	$('#loader').hide();
        bootstrap_alert.error('Bid Value Must be Greater than '+(parseFloat($('#current_bid_value').val()) + parseFloat($('#bid_gap_value').val())),'#bidValidation');
        return;
    }

    $.ajax({
    method :'POST',
    url: baseUrl+'main/add_bid',
    data:$("#bid-now-form").serialize(),
   	dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    if(data.response === true){
    	$('#loader').hide();
    	$('#bid_amount').val('');
    	$.magnificPopup.close();
    	$('#BidSuccessfull').modal('show');
    }
    else
    {
    	$('#loader').hide();
    	bootstrap_alert.error(data.response,'#bidValidation');
        return;
    }
    },
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });

});

/*--------------------------------------------------
|  Radio Button Change
/*--------------------------------------------------*/
$(document).on('change', '[type*="radio"]', function(e){  
 	var me = $(this);
});


/*--------------------------------------------------
|  Review Submit Form
/*--------------------------------------------------*/
$(document).on('submit','#leave-review-form',function(e){
    e.preventDefault();
    if($("input[name='rating']:checked").val() ===""){
        bootstrap_alert.error('Please enter a Bid Value','#reviewVal');
        return;
    }

    $.ajax({
    method :'POST',
    url: baseUrl+'main/post_review',
    data:$("#leave-review-form").serialize(),
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    if(data.response === true){
    	$('#review_msg').val('');
    	$.magnificPopup.close();
    	location.reload(true);
    }
    else
    {
    	bootstrap_alert.error(updateError,'#reviewVal');
        return;
    }
    },
    complete: function(){
    	
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });

});

/*----------------------------------------------------------------------
| Add Notification
------------------------------------------------------------------------*/
function add_notification(subject,notification,url){
	$.ajax({ type: "POST", url: baseUrl  + "user/add_notification", data: {subject : subject,notification : notification,url : url } ,cache: false,
        success: function(response){
          
        }
    });
}

/*----------------------------------------------------------------------
| Successful Bid Popup Hidden 
------------------------------------------------------------------------*/
$(document).on('hidden.bs.modal','#BidSuccessfull',function(){
    location.reload(true);
});

/*----------------------------------------------------------------------
| Function to submit comment
------------------------------------------------------------------------*/
$(document).on('submit','#commentsForm',function(e){
        e.preventDefault();
        var txtarea = $('#write-comment');
        var message = txtarea.val();
        if(message !== ""){
            txtarea.val('');
            $.ajax({ type: "POST", url: baseUrl  + "user/insert_comment", data: $("#commentsForm").serialize(),dataType: 'json',cache: false,
                success: function(response){
                	$('.txt_csrfname').val(response.token); 
                	if(response.response !== false){
                    	bootstrap_alert.success('Your comment has been added','#commentsVal');
                    	loadComments($('#comment_listing').val(),$('#comment_section').val());
                    	return;
                    }
                    else
                    {
                    	bootstrap_alert.success(updateError,'#commentsVal');
                    }
                }
            });
        }
        else
        {
            bootstrap_alert.error('Failed','#commentsVal');
            return;
        }
});


/*----------------------------------------------------------------------
| Load Comments
------------------------------------------------------------------------*/
function loadComments(id,type){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$.ajax({ type: "POST", url: baseUrl  + "user/get_comments", data: {listing_id : id, type : type,[csrfName]: csrfHash },dataType: "json",cache: false,
        success: function(threads){
        $('.txt_csrfname').val(threads.token); 
        $('#prev-comment').empty();

        $.each(threads.response, function(key,thread) {

            if(thread.author_comment === '0' )
            {   
                comment = '<li  class="comment-auction user-comment">'+
                '<div class="info-comments">'+
                '<a href="#">'+thread.firstname+'</a>'+
                '<span>'+thread.ago+'</span>'+
                '</div>'+
                '<a class="avatar-comments" href="#">'+
                '<img src="'+baseUrl+'assets/img/users/'+thread.thumbnail+'" width="35" alt="Profile Avatar" title="'+thread.firstname+'" />';
                '</a>'+
                '<p>'+thread.body+'</p>'+
                '</li>';
            }
            else
            {
            	comment = '<li  class="comment-auction author-comment">'+
                '<div class="info-comments">'+
                '<a href="#">'+thread.firstname+' (Author)</a>'+
                '<span>'+thread.ago+'</span>'+
                '</div>'+
                '<a class="avatar-comments" href="#">'+
                '<img src="'+baseUrl+'assets/img/users/'+thread.thumbnail+'" width="35" alt="Profile Avatar" title="'+thread.firstname+'" />';
                '</a>'+
                '<p>'+thread.body+'</p>'+
                '</li>';
            }

            $('#prev-comment').append(comment);
            $('#write-comment').val('');
            $('#prev-comments').load(location.href + " #prev-comments");
        });
    }
	
	});
}


/*----------------------------------------------------------------------
| User Details Save Form
------------------------------------------------------------------------*/
$(document).on('submit','#UserDetailsChangeForm',function(e){
    e.preventDefault();
    $('#loader').show();
    var data = new FormData(this);
    $.ajax({
      method :'POST',
      url: baseUrl+'common/SaveUserSettings',
      data:data,
      dataType: 'json',
      processData:false,
      contentType:false,
      cache:false,
      async:false,
      success:function(data){
      if(data.response === true){
      	$('.txt_csrfname').val(data.token); 
        bootstrap_alert.success(sucessfullyupdated,'#validator');
      }
      else
      {
        bootstrap_alert.error(updateError,'#validator');
      }
      },
      complete: function(){
      $('#loader').hide();
      },
      error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });

});


/*----------------------------------------------------------------------
| Password Change Form
------------------------------------------------------------------------*/
$(document).on('submit','#ChangePasswordForm',function(e){
    e.preventDefault();
    $('#loadingImageChangePassword').show();
    $.ajax({
      method :'POST',
      url: baseUrl+'common/changePasswordUpdate',
      data:$("#ChangePasswordForm").serialize(),
      dataType: 'json',
      success:function(data){
	  $('.txt_csrfname').val(data.token); 
      if(data.response === true){
        bootstrap_alert.success(sucessfullyupdated,'#buttonChangePassword');
      }
      else
      {
        bootstrap_alert.error(updateError,'#buttonChangePassword');
      }
      },
      complete: function(){
      $('#loadingImageChangePassword').hide();
      },
      error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });

});

/*--------------------------------------------------
|  User Status Switch
/*--------------------------------------------------*/

	if ($('.status-switch label.user-invisible').hasClass('current-status')) {
		$('.status-indicator').addClass('right');
	}

	$('.status-switch label.user-invisible').on('click', function(){
		$('.status-indicator').addClass('right');
		$('.status-switch label').removeClass('current-status');
		$('.user-invisible').addClass('current-status');
		$('.user-avatar,.status-icon').removeClass('status-online');
		changeStatusTo(0)
	});

	$('.status-switch label.user-online').on('click', function(){
		$('.status-indicator').removeClass('right');
		$('.status-switch label').removeClass('current-status');
		$('.user-online').addClass('current-status');
		$('.user-avatar,.status-icon').addClass('status-online');
		changeStatusTo(1)
	});


/*--------------------------------------------------
|  User Status Switch Function
/*--------------------------------------------------*/
	function changeStatusTo(status) {
		$.ajax({ type: "POST", url: baseUrl  + "common/ChangeUserOnlineStatus", data: {status : status,[csrfName]: csrfHash},dataType: 'json',cache: false,
    	});
	}

/*--------------------------------------------------
|  Open Contract Dialog Box Open
/*--------------------------------------------------*/

$('.popup-with-open-contract').click(function(){
    $('#offer-amount').html($(this).data('bidcur')+addCommas($(this).data('bidamount')));
    $('#offer-from').html('Open Contract With '+$(this).data('bidder'));
    $('#o_bid_id_cont').val($(this).data('bidid'));
    $('#businessName').html($(this).data('bidid'));
    $('#customerName').html($(this).data('bidder'));
    $('#bid_amount').html($(this).data('bidcur')+addCommas($(this).data('bidamount')));
});

$('.popup-with-open-contract').magnificPopup({
		 type: 'inline',

		 fixedContentPos: false,
		 fixedBgPos: true,

		 overflowY: 'auto',

		 closeBtnInside: true,
		 preloader: false,

		 midClick: true,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in',
		 disableOn: function() {
  			if(userID ==='') {
  				popnotificaton('<b> Please login to accept the offer </b>','info');
  				setTimeout(function(){
                        window.location.replace(baseUrl+"login");
                    }, 2000);
    			return false;
  			}
  			return true;
		},
		callbacks: {
    	open: function() {
      		
    	},
    	close: function() {
      		
    	}

  		}
});


/*--------------------------------------------------
|  Offer Accept Dialog Box Open
/*--------------------------------------------------*/

$('.popup-with-accept-offer').click(function(){
    $('#offer-amount').html($(this).data('bidcur')+addCommas($(this).data('bidamount')));
    $('.offer-from').html('Accept Offer From '+$(this).data('bidder'));
    $('#offer_id').val($(this).data('bidid'));
    $('#businessName').html($(this).data('bidid'));
    $('#customerName').html($(this).data('bidder'));
    $('#bid_amount').html($(this).data('bidcur')+addCommas($(this).data('bidamount')));
});

$('.popup-with-accept-offer').magnificPopup({
		 type: 'inline',

		 fixedContentPos: false,
		 fixedBgPos: true,

		 overflowY: 'auto',

		 closeBtnInside: true,
		 preloader: false,

		 midClick: true,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in',
		 disableOn: function() {
  			if(userID ==='') {
  				popnotificaton('<b> Please login to accept the offer </b>','info');
  				setTimeout(function(){
                        window.location.replace(baseUrl+"login");
                    }, 2000);
    			return false;
  			}
  			return true;
		},
		callbacks: {
    	open: function() {
      		
    	},
    	close: function() {
      		
    	}

  		}
});



/*--------------------------------------------------
|  Offer Accept Send Message
/*--------------------------------------------------*/


$('.popup-with-send-message').click(function(){
    $('#sendMessageh3').html('Direct Message To '+$(this).data('bidder'));
    $('.owner_id').val($(this).data('ownerid'));
    $('#o_bid_id').html($(this).data('bidid'));
});


$('.popup-with-send-message').magnificPopup({
		 type: 'inline',

		 fixedContentPos: false,
		 fixedBgPos: true,

		 overflowY: 'auto',

		 closeBtnInside: true,
		 preloader: false,

		 midClick: true,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in',
		 disableOn: function() {
  			if(userID ==='') {
  				popnotificaton('<b> Please login to accept the offer </b>','info');
  				setTimeout(function(){
                        window.location.replace(baseUrl+"login");
                    }, 2000);
    			return false;
  			}
  			return true;
		},
		callbacks: {
    	open: function() {
      		
    	},
    	close: function() {
      		
    	}

  		}
});


/*--------------------------------------------------
| Number Formatting
/*--------------------------------------------------*/

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}


/*--------------------------------------------------
|  Accept Bidders
/*--------------------------------------------------*/

$('.popup-with-accept-bidders').click(function(){
    $('#avatarbids').html('<img src="'+$(this).data('thumbnail')+'" alt="" class="msgavatar centerButtons">');
    $('#offer-from').html('Accept Bids From '+$(this).data('bidder'));
    $('.o_bid_id').val($(this).data('bidid'));
});

$('.popup-with-accept-bidders').magnificPopup({
		 type: 'inline',

		 fixedContentPos: false,
		 fixedBgPos: true,

		 overflowY: 'auto',

		 closeBtnInside: true,
		 preloader: false,

		 midClick: true,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in',
		 disableOn: function() {
  			if(userID ==='') {
  				popnotificaton('<b> Please login to accept the offer </b>','info');
  				setTimeout(function(){
                        window.location.replace(baseUrl+"login");
                    }, 2000);
    			return false;
  			}
  			return true;
		},
		callbacks: {
    	open: function() {
      		
    	},
    	close: function() {
      		
    	}

  		}
});


/*--------------------------------------------------
|  Accept Bidders Form
/*--------------------------------------------------*/
$(document).on('submit','#acceptBidderForm',function(e){
    e.preventDefault();
    $('#loader').show();	
	$.ajax({ type: "POST", url: baseUrl  + "user/accept_bidder", data: $("#acceptBidderForm").serialize(),cache: false,
	dataType: 'json',
	success:function(data){
	$('.txt_csrfname').val(data.token); 
      	if(data.response === true){
      		$('#loader').hide();
        	bootstrap_alert.success('Sucessfully Approved the Bids from this Bidder','#acceptmsg');
            $('#manage_bidders').load(location.href + " #manage_bidders");
      	}
      	else{
      		$('#loader').hide();
        	bootstrap_alert.error(updateError,'#acceptmsg');
      	}
      }
    });
});

/*--------------------------------------------------
|  Report Listing Form
/*--------------------------------------------------*/
$(document).on('submit','#ReportForm',function(e){
    e.preventDefault();

    if(userID ==='') {
  		popnotificaton('<b> Please login to perform this action </b>','info');
  		setTimeout(function(){
            window.location.replace(baseUrl+"login");
        }, 2000);
    	return false;
  	}	

    if($('#txt_reason').val() ===""){
        bootstrap_alert.error('Please enter why do you report','#validationMsg');
        return;
    }

	$.ajax({ type: "POST", url: baseUrl  + "user/insert_report", data: $("#ReportForm").serialize(),dataType: 'json',cache: false,
	success:function(data){
	$('.txt_csrfname').val(data.token); 
      	if(data.response === true){  			
        	bootstrap_alert.success('Your Request has been sent','#validationMsg');
            location.reload(true);
      	}
      	else{
        	bootstrap_alert.error(updateError,'#validationMsg');
      	}
      }
    });
});


/*--------------------------------------------------
|  Open Contract Time Left
/*--------------------------------------------------*/

function timeleft(){

var today = new Date();
var todayDate = today.toLocaleDateString();
var todayDateYear = parseInt(todayDate.substr(0, 4));
var todayDateMonth = parseInt(todayDate.substr(4, 6).replace("-", ""));
var todayDateDay = parseInt(todayDate.substr(6).replace("-", ""));
var todayTime = today.toLocaleTimeString();
var todayTimeHour = parseInt(todayTime.substr(0, 2).replace("/", ""));
var todayTimeMinutes = parseInt(todayTime.substr(3).replace("/", ""));

var completeZero = function (x) {
  if (x < 10) return '0' + x;
  return x;
};

todayDateDay = completeZero(todayDateDay);
todayDateMonth = completeZero(todayDateMonth);
todayTimeHour = completeZero(todayTimeHour);
todayTimeMinutes = completeZero(todayTimeMinutes);

var deadline = 0;

var getTime = function () {
  var t = Date.parse(deadline) - Date.parse(new Date());
  var seconds = Math.floor(t / 1000 % 60);
  var minutes = Math.floor(t / 1000 / 60 % 60);
  var hours = Math.floor(t / (1000 * 60 * 60) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds };

};

var time = function () {
  timeleft = getTime();
  d = timeleft.days >= 0 ? timeleft.days : 0;
  h = timeleft.hours >= 0 ? timeleft.hours : 0;
  m = timeleft.minutes >= 0 ? timeleft.minutes : 0;
  s = timeleft.seconds >= 0 ? timeleft.seconds : 0;

  d = completeZero(d);
  h = completeZero(h);
  m = completeZero(m);
  s = completeZero(s);

  var color = 'rgb(' +
  Math.round((24 - h) * 255 / 24) + ',' +
  0 + ',' + // Math.round(m * 100 / 60) + ',' +
  0 + ')'; // Math.round(s * 100 / 60) + ')';

  if (d > 0) {
    document.getElementById("days").innerHTML = '<span>' + d + '</span> days,';
  }
  if (h > 0 || m > 0 || s > 0) {
    document.getElementById("time").innerHTML = h + ':' + m + ':' + '<span>' + s + '</span>';
    document.getElementById("container").style["background-color"] = color;
    setTimeout(function () {time();}, 1000);
    document.getElementById("action").style.opacity = 0;
  } else
  {
  	document.getElementById("action").style.opacity = 100;
    document.getElementById("time").innerHTML = "time's " + '<span>up.</span>';
  }
};

deadline = 	dateval + " ";
deadline += timeval;

time();

}


/*--------------------------------------------------
|  Withdrawal Method Change
/*--------------------------------------------------*/
$(document).on('change', '#withdrawal_method', function(e){  
	e.preventDefault();
	if(this.value !=='' && $('#domain_startingprice').val() !== '')
	{
		if(this.value < $('#domain_startingprice').val())
		{
			bootstrap_alert.error('Reserved Price should be greater than Minimum Price','#validator');
            return;
		}
	}

});

/*--------------------------------------------------
|  Withdrawal Request 
/*--------------------------------------------------*/
$(document).on('submit','#withdrawForm',function(e){
    e.preventDefault();	
    $('#loader').show();

    if($('#withdraw_amount').val() === ''){
		bootstrap_alert.error('Please enter a withdrawal amount','#validator');
		$('#loader').hide();
        return;
	}

	$.ajax({ type: "POST", url: baseUrl  + "user/create_withdrawal", data: $("#withdrawForm").serialize(),dataType: 'json',cache: false,
	success:function(data){
	$('.txt_csrfname').val(data.token);
      	if(data.response === true){
      		$('#loader').hide();
        	bootstrap_alert.success('Sucessfully Approved sent the withdrawal Request','#validator');
           	window.setTimeout(function(){location.reload(true)},3000);
      	}
      	else{
      		$('#loader').hide();
        	bootstrap_alert.error(data.response,'#validator');
      	}
      }
    });
});

/*--------------------------------------------------
|  Withdrawal History Pagination 
/*--------------------------------------------------*/
$(document).on("click", ".paginationWithdrawals li a", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$.ajax({
   	url:baseUrl+"user/user_withdrawals/"+$(this).attr('data-ci-pagination-page'),
   	method:"POST",
   	data:{[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token); 
    	$('#user_withdrawals').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});


/*--------------------------------------------------
|  Pagination Blog
/*--------------------------------------------------*/
$(document).on("click", ".paginationBlog li a", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$.ajax({
   	url:baseUrl+"main/blog_pagination/"+$(this).attr('data-ci-pagination-page'),
   	method:"POST",
   	data:{[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token); 
    	$('#recent-posts').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});

/*--------------------------------------------------
|  Next Post
/*--------------------------------------------------*/
$(document).on("click", ".next-post", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$.ajax({
   	url:baseUrl+"main/blog_nextprev/"+$('#current_id').val()+'/max',
   	method:"POST",
   	data:{[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token); 
    	$('#posts-nav').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});


/*--------------------------------------------------
|  Prev Post
/*--------------------------------------------------*/
$(document).on("click", ".prev-post", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$.ajax({
   	url:baseUrl+"main/blog_nextprev/"+$('#current_id').val()+'/min',
   	method:"POST",
   	data:{[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token); 
    	$('#posts-nav').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});



/*--------------------------------------------------*/
/*  User Login
/*--------------------------------------------------*/
$(document).on('submit','#UserLoginForm',function(e){
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    if($('#login_username').val() ===""){
        bootstrap_alert.error(errorUsernameBlank,'#loginStatus');
        return;
    }

    if($('#login_password').val() ===""){
        bootstrap_alert.error(errorPasswordBlank,'#loginStatus');
        return;
    }

    $('#loadingImageLogin').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'common/LoginUser',
    data:data,
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === 0){
        bootstrap_alert.warning(errorAccountLogin,'#loginStatus');
        return;
    }
    else if(data.response === 1 ){
        bootstrap_alert.warning(errorAccountActivation,'#loginStatus'); 
        return;
    }
    else if(data.response === 2 ){
        bootstrap_alert.success(successLogin,'#loginStatus');
    	window.location.href = referrer;
    	return;
    }
    else if(data.response === 3 ){
        bootstrap_alert.error(errorAccountBanned,'#loginStatus');
        return;
    }
    else if(data.response === 4 ){
        bootstrap_alert.error(errorAccountDisabled,'#loginStatus');
        return;
    }
    else if(data.response === 8 ){
        bootstrap_alert.error(errorNoPermissions,'#loginStatus');
        return;
    }
    else
    {
        bootstrap_alert.error(errorInvalidLogin,'#loginStatus');
        return;
    }
    },
    complete: function(){
    $('#loadingImageLogin').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });

    });


/*--------------------------------------------------*/
/*  User signup
/*--------------------------------------------------*/

$(document).on('submit','#UserRegistrationForm',function(e){
    e.preventDefault();
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    var form = $(this);
    var formData = form.serialize();

    if($("#register_firstname").val() === ""){
       bootstrap_alert.error(errorLastAndFirstNames,'#registrationStatus');
       return;
    }

    if($("#register_lastname").val() === ""){
       bootstrap_alert.error(errorLastAndFirstNames,'#registrationStatus');
       return;
    }

    if($("#register_repassword").val() !== "" && $('#register_password').val() !=="" && $('#register_username').val() !=="" && $('#register_email').val() !=="" && $('#register_firstname').val() !=="" && $('#register_lastname').val() !==""){
       	
       	if($("#register_repassword").val() === $('#register_password').val()){
          	
          	$.getJSON(baseUrl+'common/RegistrationEmailChecks/',{register_email: $("#register_email").val(), [csrfName]: csrfHash},function(data){
           	
           	if(data.response !== 'false'){
            
            $.getJSON(baseUrl+'common/RegistrationUsernameChecks/',{register_username : $("#register_username").val(),[csrfName]: csrfHash},function(data){
            
            if(data.response !== 'false'){

               	if($('#register_termsconditions').prop("checked") === false){
                    bootstrap_alert.error(errorTermsandConditionsCheck,'#registrationStatus');
                    return;
                }

                $('#loadingImageRegister').show();
                $.ajax({
                method :'POST',
                url: baseUrl+'common/RegisterUser',
                data:formData,
                dataType: 'json',
                success:function(data){
                $('.txt_csrfname').val(data.token); 
                if(data.response === true){
                    bootstrap_alert.success(successRegistration,'#registrationStatus');
                    $('.auto-form-wrapper input[type="text"]').val('');
                    $('.auto-form-wrapper input[type="password"]').val('');
                    window.location.href = baseUrl+'login';
                }
                else{
                    bootstrap_alert.error(errorRegistration,'#registrationStatus');
                    return;
                }
                },
                complete: function(){
                $('.txt_csrfname').val(data.token); 
                $('#loadingImageRegister').hide();
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
            else
            {
               	bootstrap_alert.error(errorRegistration,'#registrationStatus');
               	$('.txt_csrfname').val(data.token); 
                return;
            }

            });
            
            }
            else
            {
              bootstrap_alert.error(errorRegistration,'#registrationStatus');
              $('.txt_csrfname').val(data.token); 
              return;
            }

          	});
        }
        else
        {
          bootstrap_alert.error(errorRegistration,'#registrationStatus');
          return;
        }
    }
    else
    {
       bootstrap_alert.error(errorRegistration,'#registrationStatus');
       return;
    }

});


/*--------------------------------------------------*/
/*  User signup username availablity check
/*--------------------------------------------------*/

$(document).on('change', '#register_username', function(e){ 
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    if($("#register_username").val() !== ""){

        $("#register_submit").attr("disabled", true);
        $("#i_usernamecheck").toggleClass('fa-check-circle valid-icon',false);
        $("#i_usernamecheck").toggleClass('fa-times-circle invalid-icon',false);
        $("#i_usernamecheck").toggleClass('fa-check-circle',false);
        $("#i_usernamecheck").toggleClass('fa-cog fa-spin',true);

        $.getJSON(baseUrl+'common/RegistrationUsernameChecks/',{register_username : $("#register_username").val(), [csrfName]: csrfHash},function(data){
          if(data ==='false'){
            $("#register_submit").attr("disabled", true);
            $("#i_usernamecheck").toggleClass('fa-check-circle valid-icon',false);
            $("#i_usernamecheck").toggleClass('fa-cog fa-spin',false)
            $("#i_usernamecheck").toggleClass('fa-times-circle invalid-icon',true);
          }
          else{
            $("#register_submit").attr("disabled", false);
            $("#i_usernamecheck").toggleClass('fa-times-circle invalid-icon',false);
            $("#i_usernamecheck").toggleClass('fa-cog fa-spin',false);
            $("#i_usernamecheck").toggleClass('fa-check-circle valid-icon',true);
          }

        });

    }
    else{
        $("#register_submit").attr("disabled", true);
        $("#i_usernamecheck").toggleClass('fa-check-circle valid-icon',false);
        $("#i_usernamecheck").toggleClass('fa-times-circle invalid-icon',false);
        $("#i_usernamecheck").toggleClass('fa-cog fa-spin',false);
        $("#i_usernamecheck").toggleClass('fa-check-circle',true);
    }
    $('.txt_csrfname').val(data.token);
});


/*--------------------------------------------------*/
/*  User signup Email availablity check
/*--------------------------------------------------*/

$(document).on('change', '#register_email', function(e){ 
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    if($("#register_email").val() !== ""){

        if(isEmail($("#register_email").val())){
          $("#register_submit").attr("disabled", true);
          $("#i_emailcheck").toggleClass('fa-check-circle valid-icon',false);
          $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon',false);
          $("#i_emailcheck").toggleClass('fa-check-circle',false);
          $("#i_emailcheck").toggleClass('fa-cog fa-spin',true);

          $.getJSON(baseUrl+'common/RegistrationEmailChecks/',{register_email: $("#register_email").val(), [csrfName]: csrfHash},function(data){
            if(data ==='false'){
              $("#register_submit").attr("disabled", true);
              $("#i_emailcheck").toggleClass('fa-check-circle valid-icon',false);
              $("#i_emailcheck").toggleClass('fa-cog fa-spin',false)
              $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon',true);
            }
            else{
              $("#register_submit").attr("disabled", false);
              $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon',false);
              $("#i_emailcheck").toggleClass('fa-cog fa-spin',false);
              $("#i_emailcheck").toggleClass('fa-check-circle valid-icon',true);
            }

          });
        }
        else{
          $("#register_submit").attr("disabled", true);
          $("#i_emailcheck").toggleClass('fa-check-circle valid-icon',false);
          $("#i_emailcheck").toggleClass('fa-cog fa-spin',false)
          $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon',true);
        }
    }
    else{
        $("#register_submit").attr("disabled", true);
        $("#i_emailcheck").toggleClass('fa-check-circle valid-icon',false);
        $("#i_emailcheck").toggleClass('fa-times-circle invalid-icon',false);
        $("#i_emailcheck").toggleClass('fa-cog fa-spin',false);
        $("#i_emailcheck").toggleClass('fa-check-circle',true);
    }
    $('.txt_csrfname').val(data.token);
});


/*--------------------------------------------------*/
/*  Retype Password checker
/*--------------------------------------------------*/

$(document).on('change', '#register_repassword', function(e){ 

    if($("#register_repassword").val() !== ""){
        $("#register_submit").attr("disabled", true);
        $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon',false);
        $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon',false);
        $("#i_retypepasswordcheck").toggleClass('fa-check-circle',false);
        $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin',true);

        if($("#register_repassword").val() !== $('#register_password').val()){
            $("#register_submit").attr("disabled", true);
            $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon',false);
            $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin',false)
            $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon',true);
        }
        else{
            $("#register_submit").attr("disabled", false);
            $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon',false);
            $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin',false);
            $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon',true);
        }
    }
    else{
        $("#register_submit").attr("disabled", true);
        $("#i_retypepasswordcheck").toggleClass('fa-check-circle valid-icon',false);
        $("#i_retypepasswordcheck").toggleClass('fa-times-circle invalid-icon',false);
        $("#i_retypepasswordcheck").toggleClass('fa-cog fa-spin',false);
        $("#i_retypepasswordcheck").toggleClass('fa-check-circle',true);
    }

});

	
/*--------------------------------------------------
| Filter Search 
/*--------------------------------------------------*/
function filterSearch(min,max){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	var parameters = {};
	parameters['category'] = '';
	parameters['business_registeredCountry'] = $('#location-input').val();
	parameters['searchterm'] = $('#searchterm').val();
	parameters['extension']= '';
	parameters['min']= min;
	parameters['max']= max;
	if($('#website_industry').length){
		parameters['category'] = $('#website_industry').val();
	}

	if($('#extension').length){
		parameters['extension'] = $('#extension').val();
	}

	if($("#classified_check").is(':checked')){
		parameters['listing_option'] = 'classified';
	}
	else if($("#auction_check").is(':checked')){
		parameters['listing_option'] = 'auction';
	}
	else{
		parameters['listing_option'] = '';
	}
	var jsonstring = JSON.stringify(parameters);
	$.ajax({
	method:"POST",
   	url:baseUrl+"main/single_search/"+$('#listing_type').val()+'/'+0+'/'+$('#sortyby').val(),
   	data:{parameters:jsonstring,[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token);
    	$('#searchResultsDiv').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
}

/*--------------------------------------------------
|  Search Results Paginations 
/*--------------------------------------------------*/
$(document).on("click", ".paginationSearch li a", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	var parameters = {};
	parameters['business_registeredCountry'] = $('#location-input').val();
	parameters['category'] = '';
	parameters['extension']= '';
	parameters['listing_option'] = '';
	parameters['searchterm'] = $('#searchterm').val();
	parameters['min']= $('.range-slider').data('slider').getValue()[0];
	parameters['max']=$('.range-slider').data('slider').getValue()[1];
	if($('#website_industry').length){
		parameters['category'] = $('#website_industry').val();
	}

	if($('#extension').length){
		parameters['extension'] = $('#extension').val();
	}

	if($("#classified_check").is(':checked')){
		parameters['listing_option'] = 'classified';
	}
	else if($("#auction_check").is(':checked')){
		parameters['listing_option'] = 'auction';
	}
	else{
		parameters['listing_option'] = '';
	}
	var jsonstring = JSON.stringify(parameters);
	$.ajax({
	method:"POST",
   	url:baseUrl+"main/single_search/"+$('#listing_type').val()+'/'+$(this).attr('data-ci-pagination-page'),
   	data:{parameters:jsonstring,[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token);
    	$('#searchResultsDiv').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});

/*--------------------------------------------------
| Sorting Change Event
/*--------------------------------------------------*/
$(document).on("change", "#sortyby", function(e){
	e.preventDefault();
	var min = $('.range-slider').data('slider').getValue()[0];
	var max = $('.range-slider').data('slider').getValue()[1];
	filterSearch(min,max);
});

/*--------------------------------------------------
| Listing type Change Auction
/*--------------------------------------------------*/
$(document).on("change", "#auction_check", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	var parameters = {};
	parameters['business_registeredCountry'] = $('#location-input').val();
	parameters['category'] = '';
	parameters['extension']= '';
	parameters['listing_option'] = '';
	parameters['searchterm'] = $('#searchterm').val();
	parameters['min']= $('.range-slider').data('slider').getValue()[0];
	parameters['max']=$('.range-slider').data('slider').getValue()[1];
	if($('#website_industry').length){
		parameters['category'] = $('#website_industry').val();
	}

	if($('#extension').length){
		parameters['extension'] = $('#extension').val();
	}

	if($(this).is(':checked')){
		parameters['listing_option'] = 'auction';
		if($("#classified_check").is(':checked')){
			$("#classified_check").prop('checked',false);
		}
	}
	var jsonstring = JSON.stringify(parameters);
	$.ajax({
	method:"POST",
   	url:baseUrl+"main/single_search/"+$('#listing_type').val()+'/'+0+'/'+$('#sortyby').val(),
   	data:{parameters:jsonstring,[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token);
    	$('#searchResultsDiv').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});

/*--------------------------------------------------
| Listing type Change Classified
/*--------------------------------------------------*/
$(document).on("change", "#classified_check", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	var parameters = {};
	parameters['business_registeredCountry'] = $('#location-input').val();
	parameters['category'] = '';
	parameters['extension']= '';
	parameters['listing_option'] = '';
	parameters['searchterm'] = $('#searchterm').val();
	parameters['min']= $('.range-slider').data('slider').getValue()[0];
	parameters['max']=$('.range-slider').data('slider').getValue()[1];
	if($('#website_industry').length){
		parameters['category'] = $('#website_industry').val();
	}

	if($('#extension').length){
		parameters['extension'] = $('#extension').val();
	}

	if($(this).is(':checked')){
		parameters['listing_option'] = 'classified';
		if($("#auction_check").is(':checked')){
			$("#auction_check").prop('checked',false);
		}
	}
	
	var jsonstring = JSON.stringify(parameters);
	$.ajax({
	method:"POST",
   	url:baseUrl+"main/single_search/"+$('#listing_type').val()+'/'+0+'/'+$('#sortyby').val(),
   	data:{parameters:jsonstring,[csrfName]: csrfHash},
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token);
    	$('#searchResultsDiv').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});

/*--------------------------------------------------
| Category Change Event
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
$(document).on("change", "#website_industry", function(e){
	e.preventDefault();
	var min = $('.range-slider').data('slider').getValue()[0];
	var max = $('.range-slider').data('slider').getValue()[1];
	filterSearch(min,max);
});}


/*--------------------------------------------------
| Search Button
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
$(document).on("click", ".button-search", function(e){
	e.preventDefault();
	var min = $('.range-slider').data('slider').getValue()[0];
	var max = $('.range-slider').data('slider').getValue()[1];
	filterSearch(min,max);
});}


/*--------------------------------------------------
| Country Dropdown Change
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
$(document).on("change", "#location-input", function(e){
	e.preventDefault();
	var min = $('.range-slider').data('slider').getValue()[0];
	var max = $('.range-slider').data('slider').getValue()[1];
	filterSearch(min,max);
});}


/*--------------------------------------------------
| TLD Dropdown Change
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
$(document).on("change", "#extension", function(e){
	e.preventDefault();
	var min = $('.range-slider').data('slider').getValue()[0];
	var max = $('.range-slider').data('slider').getValue()[1];
	filterSearch(min,max);
});}

/*--------------------------------------------------
| Slider Change
/*--------------------------------------------------*/
if ($('.range-slider').length > 0) {
$('.range-slider').slider().on('slideStop', function(event) {
	var min = parseInt(event.value[0]);
	var max = parseInt(event.value[1]);
	filterSearch(min,max);
});}

/*--------------------------------------------------*/
/*  Admin Login
/*--------------------------------------------------*/

	$(document).on('submit','#AdminLoginForm',function(e){
    e.preventDefault();
    var form = $(this);
    var data = form.serialize();
    if($('#login_username').val() ===""){
        bootstrap_alert.error(errorUsernameBlank,'#loginStatus');
        return;
    }

    if($('#login_password').val() ===""){
        bootstrap_alert.error(errorPasswordBlank,'#loginStatus');
        return;
    }

    $('#loadingImageLogin').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'common/LoginUser/0',
    data:data,
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    if(data.response === 0){
        bootstrap_alert.warning(errorAccountLogin,'#loginStatus');
        return;
    }
    else if(data.response === 1 ){
        bootstrap_alert.warning(errorAccountActivation,'#loginStatus');
        return;
    }
    else if(data.response === 2 ){
        bootstrap_alert.success('Welcome Admin !! '+successLogin,'#loginStatus');
        if (document.referrer != "") {
            window.location.replace(document.referrer);
        }
        window.location.href = baseUrl+'admin/';
        return;
    }
    else if(data.response === 3 ){
        bootstrap_alert.error(errorAccountBanned,'#loginStatus');
        return;
    }
    else if(data.response === 4 ){
        bootstrap_alert.error(errorAccountDisabled,'#loginStatus');
        return;
    }
    else if(data.response === 8 ){
        bootstrap_alert.error(errorNoPermissions,'#loginStatus');
        return;
    }
    else{
        bootstrap_alert.error(errorInvalidLogin,'#loginStatus');
        return;
    }
    },
    complete: function(){
    $('#loadingImageLogin').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });

    });


/*--------------------------------------------------*/
/*  Admin Pages Creation
/*--------------------------------------------------*/

$(document).on('submit','#pageSettingsForm',function(e){
    e.preventDefault();
    if($.trim($('#txt_page_title').val()) ===""){
        bootstrap_alert.error('Please enter a Page Title','#notification');
       	return;
    }

    if($.trim($('#txt_page_meta_description').val()) ===""){
        bootstrap_alert.error('Please enter a Meta Description','#notification');
        return;
    }

    if($.trim($('#txt_page_meta_keywords').val()) ===""){
        bootstrap_alert.error('Please enter a Meta Keywords','#notification');
        return;
    }

    if($.trim($('#txt_page_description').val()) ===""){
        bootstrap_alert.error('Please enter a Description','#notification');
        return;
    }

    $('#loader').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'admin/save_page_data',
    data:$("#pageSettingsForm").serialize(),
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
       	bootstrap_alert.success(sucessfullyupdated,'#notification');
        clearInputs('pageSettingsForm');
        $('#txt_page_description').summernote('reset');
        loadPageData();
        $('#loader').hide();
        return;
    }
    else
    {
        bootstrap_alert.error(updateError,'#notification');
        $('#loader').hide();
        return;
    }
    },
    complete: function(){
    $('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});


/*--------------------------------------------------*/
/*  Page URL Slug Generator
/*--------------------------------------------------*/

$(document).on("change", "#txt_page_title", function(e){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#txt_page_title").val();
    if($("#txt_page_title").val() !== ''){
    $.ajax({
    method :'POST',
    url: baseUrl+'common/urlSlugGenerator',
    data:{'title': title,[csrfName]: csrfHash},
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response){
       $("#txt_page_url_slug").val(data.response);
       return;
    }
    },
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
    }
    else{
       $("#txt_page_url_slug").val("");
    }
});


/*--------------------------------------------------*/
/*  Blog Post Creation
/*--------------------------------------------------*/

$(document).on('submit','#blogSettingsForm',function(e){
    e.preventDefault();
    var formData = new FormData(this);

    if($.trim($('#txt_blogpost_title').val()) ===""){
        bootstrap_alert.error('Please enter a Blog Title','#notification');
       	return;
    }

    if($.trim($('#txt_blogpost_meta_description').val()) ===""){
        bootstrap_alert.error('Please enter a Blog Meta Description','#notification');
        return;
    }

    if($.trim($('#txt_blogpost_meta_keywords').val()) ===""){
        bootstrap_alert.error('Please enter Meta Keywords','#notification');
        return;
    }

    if($.trim($('#txt_blogpost_description').val()) ===""){
        bootstrap_alert.error('Please enter blog post','#notification');
        return;
    }

    $('#loader').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'admin/save_blog_data',
    data:formData,
    dataType: 'json',
    processData:false,
    contentType:false,
	cache:false,
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
       	bootstrap_alert.success(sucessfullyupdated,'#notification');
        clearInputs('blogSettingsForm');
        $('#txt_blogpost_description').summernote('reset');
        loadBlogData();
        $('#loader').hide();
        return;
    }
    else
    {
        bootstrap_alert.error(updateError,'#notification');
        $('#loader').hide();
        return;
    }
    },
    complete: function(){
    $('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});

/*--------------------------------------------------*/
/*  Blog URL Slug Generator
/*--------------------------------------------------*/

$(document).on("change", "#txt_blogpost_title", function(e){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    title = $("#txt_blogpost_title").val();
    if($("#txt_blogpost_title").val() !== ''){
    $.ajax({
    method :'POST',
    url: baseUrl+'common/blog_urlSlugGenerator',
    data:{'title': title,[csrfName]: csrfHash},
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    if(data.response){
       	$("#txt_blogpost_url_slug").val(data.response);
       	return;
    }
    },
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
    }
    else{
       $("#txt_blogpost_url_slug").val("");
    }
});


/*--------------------------------------------------*/
/*  IMages Manager
/*--------------------------------------------------*/

$(document).on('submit','#Imageform',function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $('#loaderImage').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'admin/save_images_data',
    data:formData,
    dataType: 'json',
    processData:false,
    contentType:false,
    cache:false,
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
       	bootstrap_alert.success('Sucessfully Images were uploaded','#validator');
        $('#loaderImage').hide();
        return;
    }
    else
    {
        bootstrap_alert.error(updateError,'#validator');
        $('#loaderImage').hide();
        return;
    }
    },
    complete: function(){
    $('#loaderImage').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});
/*--------------------------------------------------*/
/*  General Settings Save
/*--------------------------------------------------*/

$(document).on('submit','#generalSettingsForm',function(e){
	e.preventDefault();
    $('#loader').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'admin/save_general_settings',
    data:$("#generalSettingsForm").serialize(),
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
       	bootstrap_alert.success(sucessfullyupdated,'#notification');
        loadPageData();
        $('#loader').hide();
        return;
    }
    else
    {
        bootstrap_alert.error(updateError,'#notification');
        $('#loader').hide();
        return;
    }
    },
    complete: function(){
    $('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});


/*--------------------------------------------------*/
/*  Cron Jobs Manager
/*--------------------------------------------------*/

$('#cronJobsFrom').on('submit',function(e){
    e.preventDefault();
    $.ajax({
    url:baseUrl+'cron/save_job',
    type: 'POST',
    data:$("#cronJobsFrom").serialize(),
    dataType: 'json',   
    success:function(data){
    $('.txt_csrfname').val(data.token);  
       loadCronData();
    },
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});


/*--------------------------------------------------*/
/*  Announcement Manager
/*--------------------------------------------------*/

$('.announcementForm').on('submit',function(e){
    e.preventDefault();
    $.ajax({
    url:baseUrl+'admin/save_announcement',
    type: 'POST',
    data:$("#announcementForm").serialize(), 
    dataType: 'json',  
    success:function(data){ 
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
       	bootstrap_alert.success(sucessfullyupdated,'#notification');
       	clearInputs('announcementForm');
        loadAnnouncementData();
        $('#loader').hide();
        return;
    }
    else
    {
        bootstrap_alert.error(updateError,'#notification');
        $('#loader').hide();
        return;
    }
    },
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});

/*--------------------------------------------------*/
/*  Save Language From
/*--------------------------------------------------*/

$('#newLanguageFrom').on('submit',function(e){
    e.preventDefault();
    $('#loader').show();
    $.ajax({
    url:baseUrl+'admin/save_language_data',
    type: 'POST',
    data:$("#newLanguageFrom").serialize(),  
    dataType: 'json', 
    success:function(data){
    $('.txt_csrfname').val(data.token);  
    if(data.response === true){
       	bootstrap_alert.success(sucessfullyupdated,'#notification');
        loadLanguageData();
        $('#loader').hide();
        return;
    }
    else
    {
        bootstrap_alert.error(updateError,'#notification');
        $('#loader').hide();
        return;
    }
    },
    complete: function(){
    	$('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});


/*--------------------------------------------------*/
/*  Ads From
/*--------------------------------------------------*/
$('#AdsForm').on('submit',function(e){
    e.preventDefault();
    $('#loader').show();
    $.ajax({
    url:baseUrl+'admin/save_ads',
    type: 'POST',
    data:$("#AdsForm").serialize(), 
    dataType: 'json',  
    success:function(data){
    $('.txt_csrfname').val(data.token);  
    if(data.response === true){
       	bootstrap_alert.success(sucessfullyupdated,'#notification');
        $('#loader').hide();
        return;
    }
    else
    {
        bootstrap_alert.error(updateError,'#notification');
        $('#loader').hide();
        return;
    }
    },
    complete: function(){
    	$('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});

/*--------------------------------------------------*/
/*  Ads From
/*--------------------------------------------------*/
$('#EmailForm').on('submit',function(e){
    e.preventDefault();
    $('#loader').show();
    $.ajax({
    url:baseUrl+'admin/save_email_settings',
    type: 'POST',
    data:$("#EmailForm").serialize(),
    dataType: 'json',   
    success:function(data){
    $('.txt_csrfname').val(data.token);  
    if(data.response === true){
       	bootstrap_alert.success(sucessfullyupdated,'#notification');
        $('#loader').hide();
        return;
    }
    else
    {
        bootstrap_alert.error(updateError,'#notification');
        $('#loader').hide();
        return;
    }
    },
    complete: function(){
    	$('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});

/*--------------------------------------------------*/
/*  Paypal Setup form
/*--------------------------------------------------*/
$(document).on('submit','#paypal_setup_form',function(e){
    e.preventDefault();
    $('#loader').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'admin/paypal_data_Save/1',
    data:$("#paypal_setup_form").serialize(),
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
        bootstrap_alert.success(sucessfullyupdated,'#notification');
       	$("#paymentContent").load(location.href + " #paymentContent");
       	location.reload(true);
        if($("#paypal_status").val() =='1'){
          	$("#defaultPaypalStatus").hide();
          	$("#paypalInactivity").html("<label class='form-control badge badge-success'> ACTIVE </label>");
        }
    	else
    	{
        	$("#defaultPaypalStatus").hide();
        	$("#paypalInactivity").html("<label class='form-control badge badge-danger'> INACTIVE </label>");
    	}
    }
   	else
    {
        bootstrap_alert.error(updateError,'#notification');
    }
    },
    complete: function(){
    $('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
   });     
});


/*--------------------------------------------------*/
/*  Paypal Pro Setup form
/*--------------------------------------------------*/
$(document).on('submit','#paypalpro_setup_form',function(e){
    e.preventDefault();
    $('#loader').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'admin/paypal_data_Save/2',
    data:$("#paypalpro_setup_form").serialize(),
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
    	bootstrap_alert.success(sucessfullyupdated,'#notification');
    	location.reload(true);
        if($("#paypalpro_status").val() =='1'){
        	$("#defaultPaypalProStatus").hide();
            $("#paypalInactivityPro").html("<label class='form-control badge badge-success'> ACTIVE </label>");
        }
        else
        {
            $("#defaultPaypalProStatus").hide();
            $("#paypalInactivityPro").html("<label class='form-control badge badge-danger'> INACTIVE </label>");
        }
    }
    else
   	{
      bootstrap_alert.error(updateError,'#notification');
    }
    },
    complete: function(){
    $('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });   
});


/*--------------------------------------------------*/
/*  Stripe Setup form
/*--------------------------------------------------*/
$(document).on('submit','#stripesetup_form',function(e){
    e.preventDefault();
    $('#loader').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'admin/paypal_data_Save/3',
    data:$("#stripesetup_form").serialize(),
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response === true){
    	bootstrap_alert.success(sucessfullyupdated,'#notification');
    	location.reload(true);
        if($("#paypalpro_status").val() =='1'){
        	$("#defaultPaypalProStatus").hide();
            $("#paypalInactivityPro").html("<label class='form-control badge badge-success'> ACTIVE </label>");
        }
        else
        {
            $("#defaultPaypalProStatus").hide();
            $("#paypalInactivityPro").html("<label class='form-control badge badge-danger'> INACTIVE </label>");
        }
    }
    else
   	{
      bootstrap_alert.error(updateError,'#notification');
    }
    },
    complete: function(){
    $('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });   
});


/*--------------------------------------------------*/
/*  Reset Password Form
/*--------------------------------------------------*/
$(document).on('submit','#ResetPasswordForm',function(e){
    e.preventDefault();
    $('#loadingImageReset').show();
    $.getJSON(baseUrl+'common/RegistrationEmailChecks/',{register_email: $("#reset_email").val()},function(data){
    if(data ==='false'){
    	$.ajax({
      	method :'POST',
      	url: baseUrl+'common/reset_user_password',
      	data:$("#ResetPasswordForm").serialize(),
      	dataType: 'json',
      	success:function(data){
      	$('.txt_csrfname').val(data.token); 
      	if(data.response === true){
        	bootstrap_alert.success(successReset,'#ResetStatus');
      	}
      	else
      	{
        	bootstrap_alert.error(errorReset,'#ResetStatus');
      	}
      	},
      	complete: function(){
      	$('#loadingImageReset').hide();
      	},
      	error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
      	});
	}
	else
	{
		bootstrap_alert.error(errorResetEmail,'#ResetStatus');
		$('#loadingImageReset').hide();
	}
	});
});


/*--------------------------------------------------*/
/*  Reset Email Validation
/*--------------------------------------------------*/
$(document).on("change", "#reset_email", function(e){

   	if($("#reset_email").val() !== ""){

      if(isEmail($("#reset_email").val())){

        $("#button_reset").attr("disabled", false);
        $("#i_emailcheckReset").toggleClass('fa-times-circle invalid-icon',false);
        $("#i_emailcheckReset").toggleClass('fa-cog fa-spin',false);
        $("#i_emailcheckReset").toggleClass('fa-check-circle valid-icon',true);
      }
      else
      {
        $("#button_reset").attr("disabled", true);
        $("#i_emailcheckReset").toggleClass('fa-check-circle valid-icon',false);
        $("#i_emailcheckReset").toggleClass('fa-cog fa-spin',false)
        $("#i_emailcheckReset").toggleClass('fa-times-circle invalid-icon',true);
      }
    }
    else
    {
      $("#button_reset").attr("disabled", true);
      $("#i_emailcheckReset").toggleClass('fa-check-circle valid-icon',false);
      $("#i_emailcheckReset").toggleClass('fa-times-circle invalid-icon',false);
      $("#i_emailcheckReset").toggleClass('fa-cog fa-spin',false);
      $("#i_emailcheckReset").toggleClass('fa-check-circle',true);
    }

});

/*--------------------------------------------------*/
/*  Reset Password Update
/*--------------------------------------------------*/
$(document).on('submit','#resetPasswordChangeForm',function(e){
    e.preventDefault();

    if($('#reset_user_password').val() ===""){
       	bootstrap_alert.error(errorPasswordBlank,'#resetCompleteStatus');
       	return;
    }

    if($('#reset_user_repassword').val() ===""){
       	bootstrap_alert.error(errorPasswordBlank,'#resetCompleteStatus');
       	return;
    }	

    $('#loadingImageresetComplete').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'common/reset_user_password_update',
    data:$("#resetPasswordChangeForm").serialize(),
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    if(data.response === true){
        bootstrap_alert.success(sucessfullyupdated,'#resetCompleteStatus');
        window.location.href = baseUrl+'login';
    }
    else
    {
       	bootstrap_alert.error(updateError,'#resetCompleteStatus');
    }
    },
    complete: function(){
    $('#loadingImageresetComplete').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});

/*--------------------------------------------------*/
/*  Reset Password Change
/*--------------------------------------------------*/
$(document).on("change", "#reset_user_repassword", function(e){

    if($("#reset_user_repassword").val() !== ""){
      
      $("#resetComplete_submit").attr("disabled", true);
      $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon',false);
      $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon',false);
      $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle',false);
      $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin',true);

        if($("#reset_user_repassword").val() !== $('#reset_user_password').val()){
          $("#resetComplete_submit").attr("disabled", true);
          $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon',false);
          $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin',false)
          $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon',true);
        }
        else
        {
          $("#resetComplete_submit").attr("disabled", false);
          $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon',false);
          $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin',false);
          $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon',true);
        }
    }
    else
    {
      $("#resetComplete_submit").attr("disabled", true);
      $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon',false);
      $("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon',false);
      $("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin',false);
      $("#i_retypepasswordcheckrs").toggleClass('fa-check-circle',true);
    }
});

/*--------------------------------------------------*/
/*  Reset User Password Change
/*--------------------------------------------------*/
$('#reset_user_password').on('keyup', function () {
    var password = $(this);
    if(password ===""){

      $("#resetComplete_submit").attr("disabled", true);
      $("#i_passwordcheckrs").toggleClass('fa-check-circle valid-icon',false);
      $("#i_passwordcheckrs").toggleClass('fa-times-circle invalid-icon',false);
      $("#i_passwordcheckrs").toggleClass('fa-check-circle',false);
      $("#i_passwordcheckrs").toggleClass('fa-cog fa-spin',true);
    }
    else
    {
      $("#resetComplete_submit").attr("disabled", false);
      $("#i_passwordcheckrs").toggleClass('fa-times-circle invalid-icon',false);
      $("#i_passwordcheckrs").toggleClass('fa-cog fa-spin',false);
      $("#i_passwordcheckrs").toggleClass('fa-check-circle valid-icon',true);

      	if($("#txt_user_retypepassword").val() !== ""){

        	if($("#reset_user_repassword").val() !== $('#reset_user_password').val()){
          		$("#resetComplete_submit").attr("disabled", true);
          		$("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon',false);
          		$("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin',false)
          		$("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon',true);
        	}
        	else
        	{
          		$("#resetComplete_submit").attr("disabled", false);
          		$("#i_retypepasswordcheckrs").toggleClass('fa-times-circle invalid-icon',false);
          		$("#i_retypepasswordcheckrs").toggleClass('fa-cog fa-spin',false);
          		$("#i_retypepasswordcheckrs").toggleClass('fa-check-circle valid-icon',true);
        	}
      	}

      var pass = password.val();
      var passLabel = $('[for="password"]');
      var stength = 'Weak';
      var pclass = 'danger';
      if (best.test(pass) == true) {
        stength = 'Very Strong';
        pclass = 'success';
      } else if (better.test(pass) == true) {
        stength = 'Strong';
        pclass = 'warning';
      } else if (good.test(pass) == true) {
        stength = 'Almost Strong';
        pclass = 'warning';
      } else if (bad.test(pass) == true) {
        stength = 'Weak';
      } else {
        stength = 'Very Weak';
      }

      var popover = password.attr('data-content', stength).data('bs.popover');
      popover.setContent();
      popover.$tip.addClass(popover.options.placement).removeClass('danger success info warning primary').addClass(pclass);
    }
});

/*--------------------------------------------------
|  Withdrawals Method Change
/*--------------------------------------------------*/
$(document).on('change', '#withdrawal_methods', function(e){  
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$.getJSON(baseUrl+'common/get_selected_row/tbl_withdrawal_methods/id/'+$("#withdrawal_methods").val(),{[csrfName]: csrfHash},function(data){
		if(data.response !== ''){
			$('#withdrawal_threshold').val(data.response[0].threshold);
			$('#fee_method').val(data.response[0].cal_meth);
			$('#fee_amount').val(data.response[0].cal_meth);
			$('#withdrawal_status').val(data.response[0].status);
		}
	});
});


/*--------------------------------------------------
|  Withdrawals Filter Change
/*--------------------------------------------------*/
$(document).on('change', '#filter_type_withdraw', function(e){  
	e.preventDefault();
	loadWithdrawalsData($("#filter_type_withdraw").val());
});

/*--------------------------------------------------
|  Withdrawals Settings Update
/*--------------------------------------------------*/
$(document).on('submit','#withdrawalsFrom',function(e){
    e.preventDefault();
    $('#loader').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'admin/withdrawals_setup',
   	data:$("#withdrawalsFrom").serialize(),
   	dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    if(data.response === true){
      	bootstrap_alert.success(sucessfullyupdated,'#notification');
    }
    else
    {
      bootstrap_alert.error(updateError,'#notification');
    }
    },
    complete: function(){
    $('#loader').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});


/*--------------------------------------------------*/
/*  Copy Page URL Tooltip
/*--------------------------------------------------*/

function setTooltip(message,id) {
    $(id).tooltip('hide')
    .attr('data-original-title', message)
    .tooltip('show');
}

function hideTooltip(id) {
    setTimeout(function() {
    $(id).tooltip('hide');
    }, 1000);
}

function hideAllTooltips() {
    setTimeout(function() {
    $('.copy-url-button').tooltip('hide');
    }, 1000);
}

var cb = new ClipboardJS('.copy-pageurl');

$(document).on('click', '.copy-pageurl', function(event){ 

    var link    = $(this);
    var btn_id  = $(this).attr('id');
    var clipboard = new ClipboardJS('#'+btn_id);

    $('#'+btn_id).tooltip({
        trigger: 'click',
        placement: 'bottom'
    });

    clipboard.on('success', function(e) {
    	hideAllTooltips();
        setTooltip('Copied!','#'+btn_id);
    });

    clipboard.on('error', function(e) {
        setTooltip('Failed!','#'+btn_id);
        hideTooltip('#'+btn_id);
    });
});



/*--------------------------------------------------
| Listing Filter Change
/*--------------------------------------------------*/
$(document).on("change", "#filter_type", function(e){
	e.preventDefault();
	loadListingsData($('#filter_type').val())
});

/*--------------------------------------------------
| Auction Listings
/*--------------------------------------------------*/
function auctionListings(){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadingAuctions').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'main/loadAuctions/',
    data:{[csrfName]: csrfHash },
    success:function(data){
    $('#auctionListings').fadeOut(100).html(data.response).fadeIn(500);
    $('#auctionListings').html(data.response);
    $('.txt_csrfname').val(data.token); 
    $('#loadingAuctions').hide();
    },
    complete: function(){
    $('#loadingAuctions').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
}

/*--------------------------------------------------
| Auction Pagination
/*--------------------------------------------------*/
$(document).on("click", ".paginationAuction li a", function(e){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	e.preventDefault();
	$.ajax({
   	url:baseUrl+"main/auction_pag/"+$('#myAuctionsTab .active').attr('id')+'/'+$(this).attr('data-ci-pagination-page'),
   	method:"POST",
   	data:{[csrfName]: csrfHash },
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token);
    	$('#auction_table').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});

/*--------------------------------------------------
| Auction Tab Change
/*--------------------------------------------------*/
$('#myAuctionsTab').on("shown.bs.tab",function(event){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadingAuctions').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'main/auction_pag/'+event.target.id+'/'+0,
    data:{[csrfName]: csrfHash },
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    $('#auction_table').fadeOut(100).html(data.response).fadeIn(500);
    $('#auction_table').html(data.response); 
    $('#loadingAuctions').hide();
    },
    complete: function(){
    $('#loadingAuctions').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});


/*--------------------------------------------------
| Offer Pagination
/*--------------------------------------------------*/
$(document).on("click", ".paginationOffer li a", function(e){
	e.preventDefault();
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
	$.ajax({
   	url:baseUrl+"main/offers_pag/"+$('#myOffersTab .active').attr('id')+'/'+$(this).attr('data-ci-pagination-page'),
   	method:"POST",
   	data:{[csrfName]: csrfHash },
   	dataType: 'json',
   	success:function(data){
   		$('.txt_csrfname').val(data.token);
    	$('#offer_table').fadeOut(100).html(data.response).fadeIn(500);
   	}
  	}); 
});

/*--------------------------------------------------
| Offer Tab Change
/*--------------------------------------------------*/
$('#myOffersTab').on("shown.bs.tab",function(event){
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    $('#loadingAuctions').show();
    $.ajax({
    method :'POST',
    url: baseUrl+'main/offers_pag/'+event.target.id+'/'+0,
    data:{[csrfName]: csrfHash },
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    $('#offer_table').fadeOut(100).html(data.response).fadeIn(500);
    $('#offer_table').html(data.response); 
    $('#loadingAuctions').hide();
    },
    complete: function(){
    $('#loadingAuctions').hide();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});

/*--------------------------------------------------
| Year Filter Change
/*--------------------------------------------------*/
$(document).on("change", "#year_drop", function(e){
	e.preventDefault();
	loadMonthlyWiseTotalEarnings('monthlyearningschart',$(this).val())
});

/*--------------------------------------------------
| Language Selection
/*--------------------------------------------------*/
$('.slippa-selectactive').select2({
      minimumResultsForSearch: Infinity
});


/*--------------------------------------------------
| Sort Selection
/*--------------------------------------------------*/
$('.slippa-sort').select2({
      minimumResultsForSearch: Infinity
});



/*--------------------------------------------------
| Pre Loader
/*--------------------------------------------------*/
jQuery(window).load(function () {
  jQuery(".slippa-preloder").fadeOut(300);
});


/*--------------------------------------------------
| Contact Form
/*--------------------------------------------------*/
$(document).on('submit','#contactform',function(e){
	e.preventDefault();
	$('#loader').show();

	if($("#contact_name").val()===""){
		bootstrap_alert.error(contactErrorEmptyName,'#notification');
		$('#loader').hide();
		return;
	}

	if($("#contact_email").val()===""){
		bootstrap_alert.error(contactErrorEmptyEmail,'#notification');
		$('#loader').hide();
		return;
	}

	if(!validateEmail($("#contact_email").val())){
		bootstrap_alert.error(contactErrorInvalidEmail,'#notification');
		$('#loader').hide();
		return;
	}

	if($("#contact_subject").val()===""){
		bootstrap_alert.error(contactErrorEmptySubject,'#notification');
		$('#loader').hide();
		return;
	}

	if($("#contact_msg").val()===""){
		bootstrap_alert.error(contactErrorEmptyMsg,'#notification');
		$('#loader').hide();
		return;
	}

	$.ajax({
	method :'POST',
    url: baseUrl+'common/send_msg',
   	data:$("#contactform").serialize(),
   	dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token);
    if(data.response === true){
        $('#loader').hide();
        clearInputs('contactform'); 
        bootstrap_alert.success(msgSentSuccess,'#notification');
    }
    else
    {
        $('#loader').hide(); 
        bootstrap_alert.error(updateError,'#notification');
    }
    },
    complete: function(){
    $('#loader').hide(); 
    $('#notification').show();
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
});

/*--------------------------------------------------
| Text Rotator
/*--------------------------------------------------*/
function textRotator(){

  	var TxtRotate = function(el, toRotate, period) {
    	this.toRotate = toRotate;
    	this.el = el;
    	this.loopNum = 0;
    	this.period = parseInt(period, 10) || 2000;
    	this.txt = '';
    	this.tick();
    	this.isDeleting = false;
  	};

  	TxtRotate.prototype.tick = function() {
  	var i = this.loopNum % this.toRotate.length;
  	var fullTxt = this.toRotate[i];

  	if (this.isDeleting) {
    	this.txt = fullTxt.substring(0, this.txt.length - 1);
  	} else {
    	this.txt = fullTxt.substring(0, this.txt.length + 1);
  	}

  	this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  	var that = this;
  	var delta = 300 - Math.random() * 100;

  	if (this.isDeleting) { delta /= 2; }

  	if (!this.isDeleting && this.txt === fullTxt) {
    	delta = this.period;
    	this.isDeleting = true;
  	} else if (this.isDeleting && this.txt === '') {
    	this.isDeleting = false;
    	this.loopNum++;
    	delta = 500;
  	}

  	setTimeout(function() {
    	that.tick();
  		}, delta);
  	};

  	window.onload = function() {
  	$.getJSON(baseUrl+'common/text_rotator',function(textrot){
  		var elements = document.getElementsByClassName('txt-rotate');
  		for (var i=0; i<elements.length; i++) {
    	var toRotate = textrot;
    	var period = elements[i].getAttribute('data-period');
    	if (toRotate) {
      		new TxtRotate(elements[i], toRotate, period);
    	}
    
  		}
    
  		var css = document.createElement("style");
  		css.type = "text/css";
  		css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
  		document.body.appendChild(css);
  	});
 };
}


/*--------------------------------------------------
| Checkout page
/*--------------------------------------------------*/
function checkoutpage(){
	$(function() {

	if ($('.creditly-wrapper .paypal').length > 0) {
		var paypal = Creditly.initialize(
		'.creditly-wrapper .paypal .expiration-month-and-year',
		'.creditly-wrapper .paypal .credit-card-number',
		'.creditly-wrapper .paypal .security-code',
		'.creditly-wrapper .paypal .card-type');
	}
	

	if ($('.creditly-wrapper .stripe').length > 0) {
		var stripe = Creditly.initialize(
		'.creditly-wrapper .stripe .expiration-month-and-year',
		'.creditly-wrapper .stripe .credit-card-number',
		'.creditly-wrapper .stripe .security-code',
		'.creditly-wrapper .stripe .card-type');
	}


	$('input[type="radio"][name="cardType"]').change(function(){
		if(this.value === 'PayPal_Pro'){
			if ($('#stripe').length > 0) {
				hideDiv('#stripe');
			}
			if ($('#paypal-pro').length > 0) {
				showDiv('#paypal-pro');
			}
		}
		else if(this.value === 'Stripe')
		{
			if ($('#stripe').length > 0) {
				showDiv('#stripe');
			}
			if ($('#paypal-pro').length > 0) {
				hideDiv('#paypal-pro');
			}
		}
	});

	$(".creditly-card-form .submitpay").click(function(e) {
		e.preventDefault();
		if($('input[name="cardType"]:checked').val() === 'PayPal_Pro') {
			var output = paypal.validate();
			if (output) {
				$('#txt_Domains').val(JSON.stringify(cartArray));
				$('#txt_payTotal').val(shoppingCart.totalCart());
				$('.txt_month').val(output["expiration_month"]);
				$('.txt_year').val(output["expiration_year"]);
				$('#paymentType').val('PayPal_Pro');
				$('#paymentForm').submit();
			}
		}
		else if($('input[name="cardType"]:checked').val() === 'Stripe'){
			var output = stripe.validate();
			if (output) {
				$('#txt_Domains').val(JSON.stringify(cartArray));
				$('#txt_payTotal').val(shoppingCart.totalCart());
				$('.txt_month').val(output["expiration_month"]);
				$('.txt_year').val(output["expiration_year"]);
				$('#paymentType').val('Stripe');
				$('#paymentForm').submit();
			}
		}
		else if($('input[name="cardType"]:checked').val() === 'PayPal_Express'){
			var cartArray = shoppingCart.listCart();
			$('#txt_Domains').val(JSON.stringify(cartArray));
			$('#txt_payTotal').val(shoppingCart.totalCart());
			$('#paymentType').val('PayPal_Express');
			$('#paymentForm').submit();
		}
	});

	});

	$("body").on("creditly_client_validation_error", function(e, data) {
  		bootstrap_alert.error(data["messages"].join(", "),'#paymentValidations');
	});
}



/*--------------------------------------------------
| Create Listings Checkout
/*--------------------------------------------------*/
function checkoutlistingspage(){
	$(function() {

		if ($('.creditly-wrapper .paypal').length > 0) {
			var paypal = Creditly.initialize(
			'.creditly-wrapper .paypal .expiration-month-and-year',
			'.creditly-wrapper .paypal .credit-card-number',
			'.creditly-wrapper .paypal .security-code',
			'.creditly-wrapper .paypal .card-type');
		}

		if ($('.creditly-wrapper .stripe').length > 0) {
			var stripe = Creditly.initialize(
			'.creditly-wrapper .stripe .expiration-month-and-year',
			'.creditly-wrapper .stripe .credit-card-number',
			'.creditly-wrapper .stripe .security-code',
			'.creditly-wrapper .stripe .card-type');
		}

		$(".creditly-card-form .submit").click(function(e) {
			e.preventDefault();
			if($('input[name="branch_1_pay_1"]:checked').val() === 'payvia_card') {
				showDiv('#Pay_Credit_Card');
   				hideDiv('#Pay_paypal');
   				hideDiv('#Pay_free');
   				hideDiv('#Pay_stripe');
				var output = paypal.validate();
				if (output) {
					$('.txt_month').val(output.expiration_month);
					$('.txt_year').val(output.expiration_year);
					$('#payWrapper').submit();
				}
			}
			else if($('input[name="branch_1_pay_1"]:checked').val() === 'payvia_stripe') {
				hideDiv('#Pay_Credit_Card');
   				hideDiv('#Pay_paypal');
   				hideDiv('#Pay_free');
   				showDiv('#Pay_stripe');
				var output = stripe.validate();
				if (output) {
					$('.txt_month').val(output.expiration_month);
					$('.txt_year').val(output.expiration_year);
					$('#payWrapper').submit();
				}
			} 
			else if($('input[name="branch_1_pay_1"]:checked').val() === 'payvia_paypal'){
				hideDiv('#Pay_Credit_Card');
   				showDiv('#Pay_paypal');
   				hideDiv('#Pay_free');
   				hideDiv('#Pay_stripe');
				$('#payWrapper').submit();
			}
			else if($('input[name="branch_1_pay_1"]:checked').val() === 'free_checkout'){
				hideDiv('#Pay_Credit_Card');
   				hideDiv('#Pay_paypal');
   				showDiv('#Pay_free');
   				hideDiv('#Pay_stripe');
				$('#payWrapper').submit();
			}
		});
	});

	$("body").on("creditly_client_validation_error", function(e, data) {
  		bootstrap_alert.error(data["messages"].join(", "),'#paymentValidations');
	});
}

/*--------------------------------------------------
| Plugin Status Changer
/*--------------------------------------------------*/

$( ".plugin_activate" ).click(function() {
	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();
    if($(this).attr('data-actkey') !== 'VPS'){
        if($(this).hasClass("active")){
           id = $(this).attr('data-pluginid');
           status = 1;
        }
        else
        {
           id = $(this).attr('data-pluginid');
           status = 0;
        }

        $.getJSON(baseUrl+'common/plugin_status_changer/'+id+'/'+status,{[csrfName]: csrfHash},function(data){$('.txt_csrfname').val(data.token); if(data.response !== 'false') {location.reload(true);
        return ;} });
    }
});



/*--------------------------------------------------
| Hide Div
/*--------------------------------------------------*/
function hideDiv(el) {
    $('input', el).each(function(){
        $(this).attr('disabled', 'disabled');
    });
    $(el).hide();
}


/*--------------------------------------------------
| Show Div
/*--------------------------------------------------*/
function showDiv(el) {
    $('input', el).each(function(){
        $(this).removeAttr('disabled');
    });
    $(el).show();
}

// ------------------ End Document ------------------ //












