jQuery(document).ready(function($){
	
	//if a message is displayed, change the top offset:
	if($('#message').length > 0){
		$('.subtitle').css('top', '155px');
	}
	
	//smart empty:
	$('#the_subtitle').click(function(){
		if($(this).val() == 'Subtitle'){
			$(this).val('');
			$(this).focus();
			$(this).bind('blur', function(){
				if($(this).val() == ''){
					$(this).val('Subtitle');
				}
			})
		}
	})
})