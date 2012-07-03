$('#carousel-programs').carousel({
	interval:5000,
	loop:true
});

function displayVideo(product) {
	var youtubeID;
	var headerTitle = 'Vidéo de présentation de ' + product;
		
	if (product == 'SkinSwitch') {
		youtubeID = '2flTzCK4hyo';
	} else if (product == 'FantaBobMod') {
		youtubeID = 'hsPDkvEjat4';
	}
		
	var bodyContent = '<iframe id="#player" width="640" height="360" src="http://www.youtube.com/embed/' + youtubeID + '?rel=0&autoplay=1&origin=http://dev.outadoc.fr" frameborder="0" allowfullscreen></iframe>';
		
	$('.modal-header > h3').html(headerTitle);
	$('.modal-body').html(bodyContent);
	$('.modal-footer-container').html('<div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Fermer</a></div>');
	
	$('#carousel-product').carousel({
		interval: 10000
	});
	
	$('.modal').modal().css({
		width: 'auto',
	    'margin-left': function () {
	    	return -($(this).width() / 2);
	 	}
	});
	
	$('.modal').on('hidden', function(event) {
		$('.modal-header > h3').html(null);
		$('.modal-body').html(null);
		$('.modal-footer-container').html(null);
	});
}

function displayScreenshots(product)
{
	var headerTitle = 'Captures d\'écran de ' + product;
	var slidesCount = 0;
	var width, height;
	
	if(product == 'FreeStance') {
		slidesCount = 5;
		width = 400;
		imgwidth = width/2;
		height = 400;
	} else if(product == 'FreeStance-chrome') {
		headerTitle = 'Captures d\'écran de FreeStance pour Google Chrome&trade;';
		slidesCount = 2;
		width = 600;
		imgwidth = width;
	} else if(product == 'FreeStance-desktop') {
		headerTitle = 'Captures d\'écran de FreeStance Desktop';
		slidesCount = 3;
		width = 450;
		imgwidth = width;
	} else if(product == 'iPhShortcut') {
		slidesCount = 6;
		width = 400;
		imgwidth = 250;
	} else if(product == 'Borguerie-Center') {
		headerTitle = 'Captures d\'écran du Borguerie Center';
		slidesCount = 1;
		width = 700;
		imgwidth = width;
	} else if(product == 'FantaBobMod') {
		slidesCount = 5;
		width = 600;
		imgwidth = width;
	} else if(product == 'SkinSwitch') {
		slidesCount = 3;
		width = 400;
		imgwidth = width/2;
		height = 400;
	}
	
	var bodyContent = '<div class="carousel carousel-product"><div class="carousel-inner">';
	
	for(var i = 0; i < slidesCount; i++)
	{
		if(i == 0) {
			bodyContent += '<div class="item active">';
		}
		else {
			bodyContent += '<div class="item">';
		}
		
		bodyContent += '<a href="' + 'img/' + product + '/' + i + '.png"><img class="img-slider-product" src="' + 'img/' + product + '/' + i + '.png" width="' + imgwidth + '"/></div></a>';
	}
	
	if(slidesCount != 1)
	{
		bodyContent += '</div><a class="carousel-control left" href="#" onclick="$(\'.carousel-product\').carousel(\'prev\');" data-slide="prev">&lsaquo;</a><a class="carousel-control right" href="#" onclick="$(\'.carousel-product\').carousel(\'next\');" data-slide="next">&rsaquo;</a></div>';
	} else {
		bodyContent += '</div></div>';
	}
	
	$('.modal-header > h3').html(headerTitle);
	$('.modal-body').html(bodyContent);
	$('.carousel-product').css({
		'width': width,
		'height': height
	});
	
	$('#carousel-product').carousel({
		interval:10000
	});
	
	$('.modal').modal().css({
		width: 'auto',
	    'margin-left': function () {
	    	return -($(this).width() / 2);
	 	},
	 	'margin-bottom': function () {
	 		return ($(window).height() / 2) - ($(this).height() / 2);
	 	}
	});
	
	$('.modal').on('hidden', function(event) {
		$('.modal-header > h3').html(null);
		$('.modal-body').html(null);
	});
}