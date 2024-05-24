function imgslickdetail(e)
{
	var img = $(e).find('img').attr('src');
	$('.popup-product .img-big img').attr('src', img);
}
function addProductToCart(e, id, inputNumber)
{
	var number_product = Number.isInteger( parseInt( $(inputNumber).val() ) ) ? $(inputNumber).val() : 1;
	var product_id = id;
	$.ajax({
	    url: $('input[name="url"]').val()+"/cart/add-product-to-cart",
	    method: "POST",
	    data:
	    {
	        product_id: product_id,
	        number_product: number_product
	    },
	    headers: 
	    {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    datatype: "json"
	}).done(function(data){
		
		$('.item.show-cart').html(data);
		reloadCartAllPage();
		showMessageCart();
		closePopupDetail();
	});
}

function updateProductToCart(e, id, inputNumber)
{
	var number_product = Number.isInteger( parseInt( $(inputNumber).val() ) ) ? $(inputNumber).val() : 1;
	var product_id = id;
	$.ajax({
	    url: $('input[name="url"]').val()+"/cart/update-product-to-cart",
	    method: "POST",
	    data:
	    {
	        product_id: product_id,
	        number_product: number_product
	    },
	    headers: 
	    {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    datatype: "json"
	}).done(function(data){
		
		$('.item.show-cart').html(data);
		reloadCartAllPage();
		//showMessageCart();
	});
}
function removeProductToCart(e, id)
{
	var product_id = id;
	$.ajax({
	    url: $('input[name="url"]').val()+"/cart/remove-product-to-cart",
	    method: "POST",
	    data:
	    {
	        product_id: product_id
	    },
	    headers: 
	    {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    datatype: "json"
	}).done(function(data){
		
		$('.item.show-cart').html(data);
		$('.data-product-item-'+ id).remove();
		reloadCartAllPage();
		//showMessageCart();
	});
}

function buyNowProduct(e, id, inputNumber)
{
	//addProductToCart(e, id, inputNumber);
	var number_product = Number.isInteger( parseInt( $(inputNumber).val() ) ) ? $(inputNumber).val() : 1;
	var product_id = id;
	$.ajax({
	    url: $('input[name="url"]').val()+"/cart/add-product-to-cart",
	    method: "POST",
	    data:
	    {
	        product_id: product_id,
	        number_product: number_product
	    },
	    headers: 
	    {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    datatype: "json"
	}).done(function(data){
		
		$('.item.show-cart').html(data);
		reloadCartAllPage();
		window.location.href = $(e).attr('data-href');
	});
}

function showPopupDetail(e, id)
{
	var product_id = id;
	$.ajax({
	    url: $('input[name="url"]').val()+"/product/view-popup-detail",
	    method: "POST",
	    data:
	    {
	        product_id: product_id
	    },
	    headers: 
	    {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    datatype: "json"
	}).done(function(data){
		$('body').addClass('no-scroll');
		$('body .popup-product').remove();
		$('body').append(data);
	});
}

function showMessageCart()
{
	var message = $('.message-cart').html();
	$('#message').remove();
	$('body').append(`<div id="message" class="message">
		<div class="item">Thêm giỏ hàng thành công</div>
	</div>`);
	setTimeout(function(){
		$('#message').remove();
	}, 3000);

}

function closePopupDetail(e)
{
	$('.popup-product').remove();
	$('body').removeClass('no-scroll');
}

function eventNumberProduct(e, inputNumber, type)
{
	// type == 1 => -, type == 2 => +
	var number = parseInt($(inputNumber).val());
	if(type == 1)
	{
		if(number - 1 <= 0)
			$(inputNumber).val(1);
		else
			$(inputNumber).val(number - 1);
	}
	if(type == 2)
	{
		$(inputNumber).val(number + 1);
	}
}

function eventNumberProductActive(e, inputNumber, type, product_id)
{
	var number = parseInt($(inputNumber).val());
	if(type == 1)
	{
		if(number - 1 <= 0)
			$(inputNumber).val(1);
		else
			$(inputNumber).val(number - 1);
	}
	if(type == 2)
	{
		$(inputNumber).val(number + 1);
	}

	updateProductToCart(e, product_id, inputNumber);
}

function reloadCartAllPage()
{
	var totalPrice = $('input[name="totalPrice"]').val();
	$('.total-price').html(totalPrice);
	$('.list-item-cart ul li').each(function(){
		$('.total-price-product-'+$(this).attr('data-item')).html($(this).find('input[name="total-price-product"]').val());
	});
	if($('.list-item-cart ul li').length < 1)
	{
		$('.content-cart').remove();
		$('.content-cart-no-item').css('display', 'block');
	}
}


$('.logout-btn').click(function(e) {
	e.preventDefault();
	$(".logout-form").submit();
});
function slickAjax(elementID)
{
	$('#'+ elementID + ' .slick-special').slick({
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
}