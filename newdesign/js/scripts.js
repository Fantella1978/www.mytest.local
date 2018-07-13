$(document).ready(function() {
	// Mobile Menu
    $('#hornavmenu').slicknav({
		label: '',
		duration: 800,
		easingOpen: "easeOutBounce"
	});
    $( "div.slicknav_menu" ).addClass( "d-lg-none" );
	// prettyPhoto
	$("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'fast',
		autoplay_slideshow: false,
		autoplay: false,
		hideflash: false,
		wmode: 'opaque',
		default_width: 1024,
		default_height: 768,
		show_title: true,
		allow_resize: true,
		opacity: 0.80,
		theme: 'pp_default',
		counter_separator_label: ' из ',
		social_tools: '',
		modal: false,
		overlay_gallery: true,
		overlay_gallery_max: 15,
		ie6_fallback: true
	});
	// Кнопка Вверх
	$('body').append('<div id="toTop" class="btn btn-info mb-5 mb-md-5 mb-lg-0 topzindex"><i class="fas fa-chevron-circle-up"></i> Вверх</div>');
	$(window).scroll(function () {
		if ($(this).scrollTop() != 0) {
			$('#toTop').fadeIn();
		} else {
			$('#toTop').fadeOut();
		}
	}); 
	$('#toTop').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});
});	
$(function(){
	//Lazyload IMG
	$("img.lazy").Lazy({
		effect: 'fadeIn',
		effectTime: 400,
		enableThrottle: true,
		throttle: 300
	});
	// Stellar Parallax
	var ua = navigator.userAgent,
		isMobileWebkit = /WebKit/.test(ua) && /Mobile/.test(ua);
	// var allow = (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))?true:false;
	// var obj  = { allowresize: allow };
	$(function(){
		if (isMobileWebkit || Modernizr.touch) {
			// Stellar Parallax ON
			// alert('Mobile');
			// alert (obj.allowresize);
			$(window).stellar({
				scrollProperty: 'scroll',
				horizontalScrolling: false,
				verticalOffset: 150
			});
		} else {
			//alert('Desktop');
			//alert (obj.allowresize);
			// Stellar Parallax ON
			$(window).stellar({
				horizontalScrolling: false,
				verticalOffset: 150
			});
		}
	});		
});
/*$(window).load(function(){
	$("#stickermenu").sticky({ topSpacing: 0 });
});*/
/* Portfolio */
/* $(window).load(function() {
    var $cont = $('.portfolio-group');
    
    $cont.isotope({
        itemSelector: '.portfolio-group .portfolio-item',
        masonry: {columnWidth: $('.isotope-item:first').width(), gutterWidth: -20, isFitWidth: true},
        filter: '*',
    });

    $('.portfolio-filter-container a').click(function() {
        $cont.isotope({
            filter: this.getAttribute('data-filter')
        });

        return false;
    });

    var lastClickFilter = null;
    $('.portfolio-filter a').click(function() {

        //first clicked we don't know which element is selected last time
        if (lastClickFilter === null) {
            $('.portfolio-filter a').removeClass('portfolio-selected');
        }
        else {
            $(lastClickFilter).removeClass('portfolio-selected');
        }

        lastClickFilter = this;
        $(this).addClass('portfolio-selected');
    });

}); */

/* Image Hover  - Add hover class on hover */
/*$(document).ready(function(){
    if (Modernizr.touch) {
        // show the close overlay button
        $(".close-overlay").removeClass("hidden");
        // handle the adding of hover class when clicked
        $(".image-hover figure").click(function(e){
            if (!$(this).hasClass("hover")) {
                $(this).addClass("hover");
            }
        });
        // handle the closing of the overlay
        $(".close-overlay").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            if ($(this).closest(".image-hover figure").hasClass("hover")) {
                $(this).closest(".image-hover figure").removeClass("hover");
            }
        });
    } else {
        // handle the mouseenter functionality
        $(".image-hover figure").mouseenter(function(){
            $(this).addClass("hover");
        })
        // handle the mouseleave functionality
        .mouseleave(function(){
            $(this).removeClass("hover");
        });
    }
}); */

// thumbs animations
/* $(function () {
    
    $(".thumbs-gallery i").animate({
             opacity: 0
    
          }, {
             duration: 300,
             queue: false
          });

   $(".thumbs-gallery").parent().hover(
       function () {},
       function () {
          $(".thumbs-gallery i").animate({
             opacity: 0
          }, {
             duration: 300,
             queue: false
          });
   });
 
   $(".thumbs-gallery i").hover(
      function () {
          $(this).animate({
             opacity: 0
    
          }, {
             duration: 300,
             queue: false
          });

          $(".thumbs-gallery i").not( $(this) ).animate({
             opacity: 0.4         }, {
             duration: 300,
             queue: false
          });
      }, function () {
      }
   );

}); */

// Tooltips by jQuery UI
/*$(function(){
	/* $(document).tooltip();
});*/
