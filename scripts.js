// ---------------------------
// Author : Grant Imbo
// Site : grantimbo.com
// Version : 1.1
// Description : Custom Script for northwoodsauna.com
// ---------------------------


$(function() {


	slider = function() {

		$('.slider-container:first-child').addClass('active');


		function shownext(tae) {

			
			if (tae != null) {
				var activeNxtSlide = tae.parent().siblings(".slides").children('.active');
			} else {
				var activeNxtSlide = $('.slides .active');
			}

			if (activeNxtSlide.is(':last-child')) {
				activeNxtSlide.removeClass('active');
				$('.slides div:first-child').addClass('active');
			} else {
				activeNxtSlide.removeClass('active').next().addClass('active');
			}
			
			
		}

		function showprev(tae) {

			if (tae != null) {
				var activePrevSlide = tae.parent().siblings(".slides").children('.active');
			} else {
				var activePrevSlide = $('.slides .active');
			}

			if (activePrevSlide.is(':first-child')) {
				activePrevSlide.removeClass('active');
				$('.slides div:last-child').addClass('active');
			} else {
				activePrevSlide.removeClass('active').prev().addClass('active');
			}

		}

		var timer = setInterval(shownext, 10000);
	

		$('.slide-controls a').on('click', function(e) {
			e.preventDefault();

			// reset interval
			clearInterval(timer)
			timer = setInterval(shownext, 10000);


			if ($(this).hasClass('next-slide')) {
				shownext($(this));
			} else {
				showprev($(this));
			}

		});


	},


	/*--------------------------------
	    Run functions
	--------------------------------*/
	slider();


	console.log('-------------------------------');
	console.log('|    Written by Grant Imbo    |');
	console.log('-------------------------------');


});