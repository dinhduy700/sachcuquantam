$(document).ready(function(){
	$('#slider-banner').slick({
	  	dots: false,
	  	infinite: true,
	  	speed: 500,
	  	fade: true,
	  	cssEase: 'linear',
	  	arrows: false,
	  	autoplay: true,
			autoplaySpeed: 2000
	});
	$('#slick-category').slick({
	  	dots: false,
	  	infinite: false,
	  	speed: 300,
	  	slidesToShow: 3,
	  	slidesToScroll: 3,
	  	arrows: false,
	  	responsive: [
	    {
      		breakpoint: 1024,
      		settings: {
        		slidesToShow: 3,
        		slidesToScroll: 3,
      		}
	    },
	    {
	      	breakpoint: 767,
	      	settings: {
	        	slidesToShow: 2,
	        	slidesToScroll: 2
	      	}
	    },
	    {
	      	breakpoint: 480,
	      	settings: {
	        	slidesToShow: 2,
	        	slidesToScroll: 2
	      	}
	    }
	  ]
	});
	$('.slick-vertical').slick({
		dots: false,
	  	infinite: false,
	  	speed: 500,
	  	arrows: true,
	})
	$('.slick-special').slick({
	  	dots: false,
	  	infinite: false,
	  	speed: 300,
	  	slidesToShow: 4,
	  	slidesToScroll: 4,
	  	arrows: false,
	  	responsive: [
		    {
	      		breakpoint: 1024,
	      		settings: {
	        		slidesToShow: 4,
	        		slidesToScroll: 4,
	      		}
		    },
		    {
		      	breakpoint: 767,
		      	settings: {
		        	slidesToShow: 1,
		        	slidesToScroll: 1
		      	}
		    }
		]
	});
	$('#slick-like').slick({
	  	dots: false,
	  	infinite: false,
	  	speed: 300,
	  	slidesToShow: 3,
	  	slidesToScroll: 3,
	  	arrows:true,
	  	responsive: [
	    {
      		breakpoint: 1024,
      		settings: {
        		slidesToShow: 3,
        		slidesToScroll: 3,
      		}
	    },
	    {
	      	breakpoint: 767,
	      	settings: {
	        	slidesToShow: 2,
	        	slidesToScroll: 2
	      	}
	    }
	  ]
	});
	$('.slider-big').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-small'
	});
	$('.slider-small').slick({
	  	slidesToShow: 5,
	  	infinite: false,
	  	slidesToScroll: 1,
	  	asNavFor: '.slider-big',
	  	dots: false,
	  	focusOnSelect: true,
	  	arrows: true,
	});
	$(window).scroll(function(){
		var scroll = $(window).scrollTop();
		if(scroll > 100)
		{
			$('.scroll-top').addClass('show');
		}
		else
		{
			$('.scroll-top').removeClass('show');
		}
	});
	$('.scroll-top').click(function(e){
		e.preventDefault();
		$('html,body').scrollTop(0);
	});
	$('.popup-product #close').click(function(){
		$('body').removeClass('no-scroll');
		$('.popup-product').removeClass('active');
	});
	$('.detail-product-show').click(function(e){
		e.preventDefault();
		$('body').addClass('no-scroll');
		$('.popup-product').addClass('active');
		
	});
	$(window).scroll(function(){
		var h = $('header').height();
		if($(window).width() <= 990)
		{
			if($(this).scrollTop() > h )
			{
				$('.header-l').addClass('fixed-nav');
			}
			else
			{
				$('.header-l').removeClass('fixed-nav');
			}
		}
	});
	if($("a[data-fancybox]").length > 0)
	{
		$("a[data-fancybox]").fancybox({
			type: "iframe",
			'width': 1250,
			'height': 700,
			onStart: function (el, index) {
			    var thisElement = $(el[index]);
			    $.extend(this, {
			        href: thisElement.data("href")
			    });
			  }
		});
	}

	$('.list-tab .item').click(function(){
		$('.list-tab .item').removeClass('active');
		$(this).addClass('active');
		var elementId = $(this).attr('data-element-id');
		var dataType = $(this).attr('data-type');
		$('.tab-show .list > div').css('display', 'none');
		$('#'+ elementId).css('display', 'block');
		
		if(!$('#'+ elementId).hasClass('hasactive'))
		{
			$('.tab-show .list .gif-ajax').css('display', 'block');
			$.ajax({
			    url: $('input[name="url"]').val()+"/load-view-product-tab",
			    method: "POST",
			    data:
			    {
			        dataType: dataType
			    },
			    headers: 
			    {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			    datatype: "json"
			}).done(function(data){
				
				$('#'+ elementId).addClass('hasactive');
				$('#'+ elementId).html(data);
				slickAjax(elementId);
				$('.tab-show .list .gif-ajax').css('display', 'none');
				
			});
		}
		else
		{
			$('#'+ elementId).css('display', 'block');
		}
	})
});


// Toast
$(".toast-close").click(function() {
	$(this).closest('.toast').remove();
});

setTimeout(() => {
	$('div.toast-list').remove();
}, 5000);

// Show popup
$('.language-dropdown-active').click(function() {
	console.log('dalkjfdlsajlkfsj');
	$('.language-dropdown').toggleClass('show')
});