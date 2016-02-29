$(document).ready(function() {
	$('#panel-item-container .panel-item').each(function(index, el) {
		if ($(el).position().left > 0) {
			$(el).css('float', 'right');
		}
	});

	$('.summernote-container').summernote({
		height : 250
	});

	$('.autogrow-textarea').autoGrow();
});

$(window).resize(function(){
	$('#panel-item-container .panel-item').each(function(index, el) {
		if ($(el).position().left > 0) {
			$(el).css('float', 'right');
		} else {
			$(el).css('float', '');
		}
	});
});

$('.panel-item').mouseover(function(){
	$(this).find('.panel-body-action').removeClass('hidden');
});

$('.panel-item').mouseout(function(){
	$(this).find('.panel-body-action').addClass('hidden');
});

$('.panel-body-action .main-btn-group .btn-show-other').click(function(event){
	event.preventDefault();
	$(this).parent().addClass('hidden');
	$(this).parent().parent().find('.other-btn-group').removeClass('hidden');
});

$('.panel-body-action .other-btn-group .btn-show-other').click(function(event){
	event.preventDefault();
	$(this).parent().addClass('hidden');
	$(this).parent().parent().find('.main-btn-group').removeClass('hidden');
});