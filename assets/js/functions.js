$(function() {
	$(document).on( 'scroll', function(){
	    if ($(window).scrollTop() > 150) {
	        $('.scroll-top-wrapper').addClass('show');
	    } else {
	        $('.scroll-top-wrapper').removeClass('show');
	    }
	});
	$('.scroll-top-wrapper').on('click', scrollToTop);
	
	if(navigator.userAgent.toLowerCase().indexOf("chrome") >= 0 || navigator.userAgent.toLowerCase().indexOf("safari") >= 0){
		window.setTimeout(function(){
		    $('input:-webkit-autofill').each(function(){
		        var clone = $(this).clone(true, true);
		        $(this).after(clone).remove();
		    });
		}, 3500);
	}
	
	/*
	$('.be-form-input-genre').typeahead({
		name: 'genre',
        //local:['Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
        prefetch : $('#be-base-url').val() + 'api/get_genres/',
        highlight:true,
        hint:true
    });
    */
    
	//$('#be-home-subscribe-form').validate_popover({onsubmit: true, popoverPosition: 'top'});
	//$('#be-home-signup-form').validate_popover({onsubmit: true, popoverPosition: 'top'});
	$('.be-form-input-country').selectpicker({
		size: 8
	});
	$('.selectpicker').selectpicker({
		style: 'btn-info',
		size: 8
	});
	
	$('.be-form-input-zip').change(function() {
		var zip = $(this).val();
		var city = '';
		if($.isNumeric(zip) && zip.length >= 3 && zip.length <= 6) {
			$.ajax({
			  url: $('#be-base-url').val() + 'api/get_zip_info/',
			  type: "POST",
			  data: {zip : zip},
			  dataType: "html",
			  async:true,
			  success: function(msg){
				  $('.be-form-input-city').val(msg);
			  }
			});
			
		}
	});
	
	$('.be-dashboard-block-content').mCustomScrollbar({
		axis:"y",
		theme:"minimal-dark"
    });
	
	$('.be-form-input-song-link').bootstrapFileInput('Upload a Song');
	
	$("[data-toggle='tooltip']").tooltip();
});
function onClickDashboardFormLive(val) {
	$('#be-dashboard-form-live-val').val(val);
	$('#be-dashboard-form-live0').removeClass('active');
	$('#be-dashboard-form-live1').removeClass('active');
	$('#be-dashboard-form-live'+val).addClass('active');
}

function scrollToTop() {
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $('body');
    offset = element.offset();
    offsetTop = offset.top;
    $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}
var beLocalStorage = {
    set: function(name, data) {
        window.localStorage.setItem(name, JSON.stringify(data));
    },

    get: function(name) {
        return JSON.parse(window.localStorage.getItem(name));
    },

    destroy: function(name) {
        return window.localStorage.removeItem(name);
    },

    clear: function() {
        return window.localStorage.clear();
    },

    has: function(name) {
        return name in window.localStorage;
    }
};