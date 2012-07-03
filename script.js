jQuery(document).ready(function($){

    if(jQuery("#the_subtitle").length) { 
        jQuery('#titlediv #titlewrap').after(jQuery("#the_subtitle").show());
    }
	
    //smart empty:
    $('#the_subtitle').click(function(){
        if($(this).val() == 'Subtitle'){
            $(this).val('');
            $(this).focus();
            $(this).bind('blur', function(){
                if($(this).val() === ''){
                    $(this).val('Subtitle');
                }
            });
        }
    });
});