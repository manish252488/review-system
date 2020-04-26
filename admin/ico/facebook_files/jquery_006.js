jQuery.fn.inputCaption = function(options) {

	var defaults = {  
		caption: 'caption',		// Field caption
		color: '#000'			// Caption color
	};  
	var options = jQuery.extend(defaults, options);  

	return this.each(function() {

		var oField = jQuery(this);
		var oForm = oField.parents('form');

		if (options.caption != '') {
			var oUpdateField = function() {
				if (oField.val() == options.caption) {
					oField.css('color', options.color);
				} else {
					oField.css('color', 'inherit');
				}
			}
	
			jQuery(this).focus(function() { 
				if (jQuery(this).val() == options.caption) {
					jQuery(this).val('');
				}
				oUpdateField();
			});
	
			jQuery(this).blur(function() {
				if (jQuery(this).val() == '') {
					jQuery(this).val(options.caption);
				}
				oUpdateField();
			});
			
			if (jQuery(this).val() == '') {
				jQuery(this).val(options.caption);
			}
	
			oForm.submit(function() {
				if (oField.val() == options.caption) {
					oField.val('');
				}
			});
	
			oUpdateField();
		}
	});

}
