$(document).ready(function($) {
	$('.popup-open-auth').click(function() {
		$('.popup-fade-auth').fadeIn();
		return false;
	});	
	
	$('.popup-close-auth').click(function() {
		$(this).parents('.popup-fade-auth').fadeOut();
		return false;
	});		
 
	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade-auth').fadeOut();
		}
	});
	
	$('.popup-fade-auth').click(function(e) {
		if ($(e.target).closest('.popup-auth').length == 0) {
			$(this).fadeOut();					
		}
	});
});

$(document).ready(function($) {
	$('.popup-open-korz').click(function() {
		$('.popup-fade-korz').fadeIn();
		return false;
	});	
	
	$('.popup-close-korz').click(function() {
		$(this).parents('.popup-fade-korz').fadeOut();
		return false;
	});		
 
	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade-korz').fadeOut();
		}
	});
	
	$('.popup-fade-korz').click(function(e) {
		if ($(e.target).closest('.popup-korz').length == 0) {
			$(this).fadeOut();					
		}
	});
});