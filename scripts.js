// ---------------------------
// Author : Grant Imbo
// Site : grantimbo.com
// Version : 1
// Description : Custom Script for northwoodsauna.com
// ---------------------------


$(function() {


	menuShow = function() {


		// menu function
		$(document).on('click', 'a.icon-menu.mobile-menu', function(e) {
			e.preventDefault();
			$('.header .mobile-menu-wrap').show();
		});


		$(document).on('click', 'a.icon-cross.mobile-menu', function(e) {
			e.preventDefault();
			$('.header .mobile-menu-wrap').hide();
		});



		$(window).resize(function() {
			if ($(window).width() > 768) {
			   $('.header .mobile-menu-wrap').hide();
			}
		});




		$(document).on('click', 'a.read', function(e) {
			e.preventDefault();
			$(this).parent().parent().toggleClass('expand');
			$(this).text(($(this).text() == 'Read More') ? 'Read Less' : 'Read More');
		});




	},


	/*--------------------------------
	    Run functions
	--------------------------------*/
	menuShow();


	console.log('-------------------------------');
	console.log('|    Written by Grant Imbo    |');
	console.log('-------------------------------');


});