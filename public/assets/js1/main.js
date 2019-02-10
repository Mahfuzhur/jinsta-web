$('#temp_carousel').carousel({
	interval: 5000
});

// Menu Toggle Script
$(document).ready(function() {
	var windowsize = $(window).width();
    if (windowsize <= 767) {
		$("#wrapper").removeClass('toggled');
	}

	$("#sidebar_toggle").click(function(e) {
		e.preventDefault();
	  	$("#wrapper").toggleClass("toggled");
	});
});


// text area counter
var text_max = 170;
	$('#count_message').html('0 / ' + text_max );

$('#text').keyup(function() {
  	var text_length = $('#text').val().length;
  	var text_remaining = text_max - text_length;  
  	$('#count_message').html(text_length + ' / ' + text_max);
});

//custom pagination for menuscript registration
	pageSize = 3;

	showPage = function(page) {
	    $(".single_template").hide();
	    $(".single_template").each(function(n) {
	        if (n >= pageSize * (page - 1) && n < pageSize * page)
	            $(this).show();
	    });        
	}
	    
	showPage(1);
	$("#temp_carousel .page-item a").click(function(e) {
		e.preventDefault();
	    $("#temp_carousel .page-item").removeClass("active");
	    $(this).parent().addClass("active");
	    showPage(parseInt($(this).text())) 
	});

	