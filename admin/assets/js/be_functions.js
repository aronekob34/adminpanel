
/*
$(function() {
	
	
});
*/

/*$('a.be-edit-btn').click(function() {
	$('body').animate({
        scrollTop: $('#be-edit-form-position').offset().top
    }, 2000);
});*/

/*
$('a.be-remove-btn').click(function() {
	$('body').animate({
        scrollTop: $('#be-edit-form-position').offset().top
    }, 2000);
});
*/

function be_open_remove_form_modal(remove_id) {
	$('#be-remove-id').val(remove_id);
	$('div.be-remove-form-modal').modal('toggle');
}
function be_open_suspend_form_modal(suspend_id) {
	$('#be-suspend-id').val(suspend_id);
	$('div.be-suspend-form-modal').modal('toggle');
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