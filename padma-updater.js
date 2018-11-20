jQuery(document).ready(function(){
	jQuery('#update-plugins-table .plugin-title p strong:first-of-type').each(function(){
		if(jQuery(this).text().match(/^Padma/)){
			jQuery(this).parent().find('.dashicons').remove();
			jQuery(this).parent().prepend('<img src="https://cdn.padmaunlimited.com/logos/default-icon-256x256.png" alt="">');
		}
	});
});