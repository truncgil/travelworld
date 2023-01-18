jQuery(document).ready(function () {

    jQuery('.main-logo').parent().hover(function () {
        jQuery('.main-logo').addClass('animated').addClass('pulse');
    }, function () {
        jQuery('.main-logo').removeClass('animated').removeClass('pulse');
    });

    jQuery('#testimonialSliderCustom').carousel();

    jQuery('#mobile_nav_icon').click(function () {
        jQuery('body,html').animate({
            scrollTop: 0
        }, 100);
        jQuery('body').toggleClass('js_nav');
    });


    jQuery('.top_bar #searchform button').click(function (e) {
        e.preventDefault();

        if (jQuery(window).width() < 960) {
            if (jQuery(this).hasClass('active')) {
                jQuery('#custom_logo').attr('style', '');
                jQuery('#custom_logo_transparent').attr('style', '');
            } else {
                jQuery('#custom_logo').attr('style', 'display:none;');
                jQuery('#custom_logo_transparent').attr('style', 'display:none;');
            }
        }
        if (jQuery(this).hasClass('active')) {
            jQuery(this).removeClass('active');
        } else {
            jQuery(this).addClass('active');
        }
        jQuery('#menu_border_wrapper').toggle();
        jQuery('#searchform label').toggleClass('visible');
        jQuery('.top_bar #searchform input').toggle();
        jQuery('.top_bar #searchform input').focus();
    });


    var $ = jQuery;
	
	setTimeout(function(){
		var hew = jQuery('#portfolio_filter_wrapper').css('height');
		
		var tew = jQuery('.thumb_content.classic').css('height');
		try {
			hew = parseInt(hew.replace('px',''));
			tew = parseInt(tew.replace('px',''));
		} catch (error) {
			
		}
		
		
		hew = hew + 160;
		tew = tew + 90;
		
		jQuery('#portfolio_filter_wrapper').css('height',hew + 'px');
		jQuery('.thumb_content.classic').css('height',tew + 'px');
	}, 600);
	
	
	
	  jQuery.fn.carousel.Constructor.TRANSITION_DURATION = 2000  // 2 seconds
	
	/*
	jQuery('#searchButton').on('click',function(){	
		if(jQuery('#searchInput').attr('data-visible') == "false"){
			jQuery('#searchInput').css('display','block');
			jQuery('#searchInput').attr('data-visible','true');
			$('#navbarUl').css('display','none');
		}
		else{
			jQuery('#searchInput').css('display','none');
			jQuery('#searchInput').attr('data-visible','false');
			$('#navbarUl').css('display','block');
		}
	});
	*/
	
	$("#mainSlider").swipe({
	  swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
		if (direction == 'left') $(this).carousel('next');
		if (direction == 'right') $(this).carousel('prev');
	  },
	  allowPageScroll:"vertical"
	});
	
	setTimeout(function(){
		//alert('asdasd');
		if($('#turSayfasiSpan').length > 0){
			var im = $('.parallax-block > .parallax-image').attr('src');
			$('.parallax-block').css({
				'width' : '100%',
				'height' : '100vh',
				'background' : 'fixed url('+ im +') no-repeat'
			});
			$('.parallax-block > .parallax-image').css('display','none');
		}
	}, 300);
	

});