jQuery(document).ready(function($){
	//if a message is displayed, change the top offset:
	if($('#message').length > 0 || $('#screen-meta').is(':visible')){
		calculateTopOffset();
	}
	
	$('#screen-meta').click(function(){
		calculateTopOffset();
	})
	
	$('#screen-meta-links').click(function(){
		if($('#screen-meta').height() > 1){
			var initH = $('#screen-meta').height();
			$('.subtitle').animate({top:'-=144'}, 'fast', function(){
				var h = initH;
				if(h > 144){
					var diff = h - 144;
					$('.subtitle').animate({top: '-='+diff}, 100);
				}
			});
		}else{
			$('.subtitle').animate({top:'+=144'}, 'fast', function(){
				var h = $('#screen-meta').height();
				if(h > 144){
					var diff = h - 144;
					$('.subtitle').animate({top: '+='+diff}, 100);
				}
				
			});
		}	
	})
	
	function calculateTopOffset(){
		if($('#message').length > 0){
			var amount = 0;
			$('[id=message]').each(function(){
				amount++;
			
			})
		}
		var newX = amount * 55 + 100;
		
		if($('.update-nag').length > 0){
			newX += $('.update-nag').height() + 10;
		}
		
		if($('#screen-meta').is(':visible')){
			newX += $('#screen-meta').height();
		}
	
		
		
		$('.subtitle').css('top', newX+'px');
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