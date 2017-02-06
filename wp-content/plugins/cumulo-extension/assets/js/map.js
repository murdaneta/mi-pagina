function resize_uvc_map(map, wrap)
{
	var map_override = jQuery('#'+map).attr('data-map_override');
	var is_relative = 'true';				
	if(jQuery('#'+wrap).parents('.wpb_column').length > 0)
		var ancenstor = jQuery('#'+wrap).parents('.wpb_column');
	else if(jQuery('#'+wrap).parents('.wpb_row').length > 0)
		var ancenstor = jQuery('#'+wrap).parents('.wpb_row');
	else
		var ancenstor = jQuery('#'+wrap).parent();
	var parent = ancenstor;
	if(map_override=='full'){
		ancenstor= jQuery('body');
		is_relative = 'false';
	}
	if(map_override=='ex-full'){
		ancenstor= jQuery('html');
		is_relative = 'false';
	}
	if( ! isNaN(map_override)){
		for(var i=1;i<map_override;i++){
			if(ancenstor.prop('tagName')!='HTML'){
				ancenstor = ancenstor.parent();
			}else{
				break;
			}
		}
	}
	if(is_relative == 'false')
		var w = ancenstor.outerWidth();
	else
		var w = ancenstor.width();
	var mheight = jQuery('#'+map).outerHeight();
	//parent.css({'height':mheight+'px'});		
	var map_left = jQuery('#'+map).offset().left;
	var map_left_pos = jQuery('#'+map).position().left;
	var div_left = ancenstor.offset().left;
	var cal_left = div_left - map_left;
	if(map_left_pos < 0)
		cal_left = map_left_pos + cal_left;
	else
		cal_left = map_left_pos - map_left;
	jQuery('#'+map).css({'position':'absolute','width': w,'min-width':w});
	if(is_relative == 'false')
		jQuery('#'+map).css({'left': cal_left });
}
