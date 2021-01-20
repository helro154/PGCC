/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Home Slider
4. Init Search
5. Init Menu
6. Init Isotope


******************************/

$(document).ready(function()
{
	"use strict";

	/* 

	1. Vars and Inits

	*/

	var header = $('.header');
	var hambActive = false;
	var menuActive = false;

	setHeader();

	$(window).on('resize', function()
	{
		setHeader();
	});

	$(document).on('scroll', function()
	{
		setHeader();
	});

	initHomeSlider();
	initSearch();
	initMenu();
	initIsotope();
	course_accordian();
	calendar_action();
	section_nav();
	section_top_drop();
	mobile_menu_half();
	calendar_month_view();
	notify_alert();

	/* 

	2. Set Header

	*/

	function setHeader()
	{
		if($(window).scrollTop() > 100)
		{
			header.addClass('scrolled');
		}
		else
		{
			header.removeClass('scrolled');
		}
	}

	/* 

	3. Init Home Slider

	*/

	function initHomeSlider()
	{
		if($('.home_slider').length)
		{
			var homeSlider = $('.home_slider');
			homeSlider.owlCarousel(
			{
				items:1,
				autoplay:true,
				autoplayTimeout:10000,
				loop:true,
				nav:false,
				smartSpeed:1200,
				dotsSpeed:1200,
				fluidSpeed:1200
			});

			/* Custom dots events */
			if($('.home_slider_custom_dot').length)
			{
				$('.home_slider_custom_dot').on('click', function()
				{
					$('.home_slider_custom_dot').removeClass('active');
					$(this).addClass('active');
					homeSlider.trigger('to.owl.carousel', [$(this).index(), 1200]);
				});
			}

			/* Change active class for dots when slide changes by nav or touch */
			homeSlider.on('changed.owl.carousel', function(event)
			{
				$('.home_slider_custom_dot').removeClass('active');
				$('.home_slider_custom_dots li').eq(event.page.index).addClass('active');
			});

			// add animate.css class(es) to the elements to be animated
			function setAnimation ( _elem, _InOut )
			{
				// Store all animationend event name in a string.
				// cf animate.css documentation
				var animationEndEvent = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

				_elem.each ( function ()
				{
					var $elem = $(this);
					var $animationType = 'animated ' + $elem.data( 'animation-' + _InOut );

					$elem.addClass($animationType).one(animationEndEvent, function ()
					{
						$elem.removeClass($animationType); // remove animate.css Class at the end of the animations
					});
				});
			}

			// Fired before current slide change
			homeSlider.on('change.owl.carousel', function(event)
			{
				var $currentItem = $('.home_slider_item', homeSlider).eq(event.item.index);
				var $elemsToanim = $currentItem.find("[data-animation-out]");
				setAnimation ($elemsToanim, 'out');
			});

			// Fired after current slide has been changed
			homeSlider.on('changed.owl.carousel', function(event)
			{
				var $currentItem = $('.home_slider_item', homeSlider).eq(event.item.index);
				var $elemsToanim = $currentItem.find("[data-animation-in]");
				setAnimation ($elemsToanim, 'in');
			})
		}
	}

	/* 

	4. Init Search

	*/

	function initSearch()
	{
		if($('.top-search').length && $('.search_panel').length)
		{
			
			var search = $('.top-search');
			var panel = $('.search_panel');
			var search_icon=$('.search_icon');
			var search_mobile = $('.top-search-mobile');

			search.on('click', function()
			{
				panel.toggleClass('active');
				search_icon.toggleClass('enable');

			});
			search_mobile.on('click', function()
			{
				panel.toggleClass('active');
				search_icon.toggleClass('enable');

			});
		}
	}

	/* 

	5. Init Menu

	*/

	function initMenu()
	{
		if($('.hamburger').length)
		{
			var hamb = $('.hamburger');

			hamb.on('click', function(event)
			{
				event.stopPropagation();

				if(!menuActive)
				{
					openMenu();
					$(this).addClass('active');
					
					$(document).one('click', function cls(e)
					{
						if($(e.target).hasClass('menu_mm'))
						{
							$(document).one('click', cls);
						}
						else
						{
							closeMenu();
						}
					});
				}
				else
				{
					$('.menu').removeClass('active');
					$(this).removeClass('active');
					menuActive = false;
				}
			});

			//Handle page menu
			if($('.page_menu_item').length)
			{
				var items = $('.page_menu_item');
				items.each(function()
				{
					var item = $(this);

					item.on('click', function(evt)
					{
						if(item.hasClass('has-children'))
						{
							evt.preventDefault();
							evt.stopPropagation();
							$(this).toggleClass('active');
							var subItem = item.find('> ul');
						    if(subItem.hasClass('active'))
						    {
						    	subItem.toggleClass('active');
								TweenMax.to(subItem, 0.3, {height:0});
						    }
						    else
						    {
						    	subItem.toggleClass('active');
						    	TweenMax.set(subItem, {height:"auto"});
								TweenMax.from(subItem, 0.3, {height:0});
						    }
						}
						else
						{
							evt.stopPropagation();
						}
					});
				});
			}
		}
	}

	function openMenu()
	{
		var fs = $('.menu');
		fs.addClass('active');
		hambActive = true;
		menuActive = true;
	}

	function closeMenu()
	{
		var fs = $('.menu');
		fs.removeClass('active');
		hambActive = false;
		menuActive = false;
	}

	/* 

	6. Init Isotope

	*/

	function initIsotope()
	{
		var sortingButtons = $('.product_sorting_btn');
		var sortNums = $('.num_sorting_btn');

		if($('.product_grid').length)
		{
			var grid = $('.product_grid').isotope({
				itemSelector: '.product',
				layoutMode: 'fitRows',
				fitRows:
				{
					gutter: 30
				},
	            getSortData:
	            {
	            	price: function(itemElement)
	            	{
	            		var priceEle = $(itemElement).find('.product_price').text().replace( '$', '' );
	            		return parseFloat(priceEle);
	            	},
	            	name: '.product_name',
	            	stars: function(itemElement)
	            	{
	            		var starsEle = $(itemElement).find('.rating');
	            		var stars = starsEle.attr("data-rating");
	            		return stars;
	            	}
	            },
	            animationOptions:
	            {
	                duration: 750,
	                easing: 'linear',
	                queue: false
	            }
	        });
		}
	}

	/* 7 course accordian  */

	function course_accordian()
	{
		
			
			var accordian_title = $('.course-accordian-group>.accordian-title');			
			accordian_title.on('click', function()
			{
				$(this).toggleClass('active');
			});

			var accordian_expand= $('.overview-expand>span');
			var accordian_groups= $('.accordian-title');
			accordian_expand.on('click', function()
			{
				
				accordian_groups.toggleClass('active');
				if ($(this).text() =="EXPAND ALL")
				 {
				 	$(this).text('CLOSE ALL');
				 }
				else {
					$(this).text('EXPAND ALL');
				}
			});

	}

	/*8 calendar in sidebar*/

	function calendar_action()
	{
		var myEvents = [{
		      title: "Event Title 1",
		      date: 1519806678259, // unix timestamp
		      month:"month.html",
		      link: "jqueryscript.net" // event link
		    },{
		      title: "Event Title 2",
		      date: 1519851600000,
		      link: "jqueryscript.net"
		    },
		    // more events here
		];

		$("#calendar_div").MEC({
		  calendar_link: "jqueryscript.net", // calendar link
		  events: myEvents
		});

		$("#calendar-top").MEC({
		  calendar_link: "jqueryscript.net", // calendar link
		  events: myEvents
		});
	}

	/*9 section nav*/
	function section_nav()
	{
		var sectionNav_btn = $('.section-tabs-btn');
		var sectionNav_block = $('.section-tabs-nav');
		sectionNav_btn.on('click', function()
		{
			$(this).toggleClass('active');
		});	
	}
	/*10 top section drop*/
	function section_top_drop()
	{
		var sectionTop_drop = $('.top-calendar-drop');
		sectionTop_drop.on('click', function()
		{
			$(this).toggleClass('active');
		});	
	}

	/*11 mobile menu*/
	function mobile_menu_half()
	{
		var mobile_menu = $('.mobile-menu li.hassubs');
		mobile_menu.on('click', function(event)
		{
			
			event.stopPropagation();
			console.log('active');
			$(this).toggleClass('active');
		});	
	}

	// 12 calendar month view
	function calendar_month_view(){
		const myEvents = [
		      {
		        start: '2018-11-04 11:30',
		        end: '2018-11-4 12:30',
		        title: 'welcome',
		        url: '#',
		        class: 'custom-class',
		        color: '#008378',
		        data: {}
		      },
		      {
		        start: '2018-11-04 17:30',
		        end: '2018-11-04 18:30',
		        title: 'test',
		        url: '#',
		        class: 'custom-class',
		        color: '#008378',
		        data: { }
		      },
		      {
		        start: '2018-11-20 17:30',
		        end: '2018-11-22 17:30',
		        title: 'Event 3',
		        url: '#',
		        class: 'custom-class',
		        color: '#008378',
		        data: { }
		      },
		];
		 $('#calendar-month').equinox({
		 	onEventClick: null,
		  	onPreviousMonthStart: null,
		  	onNextMonthStart: null,
		  	onCurrentMonthStart: null,
		  	onLoadStart: null,
		  	onLoadEnd: null,
		 	events: myEvents

		 });
	}

	// 13 alert
	function notify_alert()
	{
		var notify_close = $('.notify-close');
		notify_close.on('click', function(event)
		{
			event.stopPropagation();
			$(".notify-alert").toggleClass('close');
		});	
	}



});