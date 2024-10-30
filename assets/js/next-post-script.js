var wl = jQuery(window);
jQuery(function($){
	var currentMsid = '';
	var next_links = winpm_next_ajax_url.links;
	var next_ids = winpm_next_ajax_url.ids;
	var next_titles = winpm_next_ajax_url.titles;
	var post_count = 0;
	var ajax_disable = winpm_next_ajax_url.ajax_disable;
	
	//var slider_count = winpm_next_ajax_url.slider_count;
	var slider_offset = winpm_next_ajax_url.offset;
	var slider_offset_bottom = winpm_next_ajax_url.offset_bottom;
	var artical_parent_selector = winpm_next_ajax_url.artical_parent_selector;
	//var artical_parent_selector = '.column.eightcol';
	var artical_selector = winpm_next_ajax_url.artical_selector;//'.post-full.clearfix';
	//var artical_selector = '.post-full.clearfix';
	var next_arrow = winpm_next_ajax_url.next_arrow;
	var next_post_text = winpm_next_ajax_url.next_post_text;
	var after_content_enable = winpm_next_ajax_url.after_content_enable;
	var after_content = winpm_next_ajax_url.after_content;
	var on_start_callback_enable = winpm_next_ajax_url.on_start_callback_enable;
	var on_end_callback_enable = winpm_next_ajax_url.on_end_callback_enable;
	var call_back_end_timeout = winpm_next_ajax_url.call_back_end_timeout;
	var goto_offset = winpm_next_ajax_url.goto_offset;
	
	/*left sidebar*/
	
	if(artical_selector == ''){
		return '';	
	}
	
	
	if(winpm_next_ajax_url.style == 'infinite'){
		//jQuery( artical_parent_selector ).after('<div class="loadmore_next"></div>');
		if(artical_parent_selector != ''){
			jQuery( artical_parent_selector+' '+artical_selector ).wrapInner('<div class="svc_infinite_container" id="svc_infinite_id_'+winpm_next_ajax_url.first_id+'" next-data-url="'+winpm_next_ajax_url.first_url+'" next-data-title="'+winpm_next_ajax_url.first_title+'" next-data-id="'+winpm_next_ajax_url.first_id+'"></div>');
		}else{
			jQuery( artical_selector ).wrapInner('<div class="svc_infinite_container" id="svc_infinite_id_'+winpm_next_ajax_url.first_id+'" next-data-url="'+winpm_next_ajax_url.first_url+'" next-data-title="'+winpm_next_ajax_url.first_title+'" next-data-id="'+winpm_next_ajax_url.first_id+'"></div>');
		}		
		
		if((after_content_enable == 'yes' || next_arrow == 'yes') && next_ids[0]){
		var content_after = '<div class="svc_pre_container_after"><div class="svc_pre_under_container">';
			if(after_content_enable == 'yes'){
				content_after += '<div class="svc_next_content">'+after_content+'</div>';
			}
			if(next_arrow == 'yes'){
				content_after += '<div class="svc_next_ref"><span class="svc_next_txt">'+next_post_text+'</span></div>';
			}
			content_after += '</div><div class="lds-dual-ring"></div></div>';
			jQuery('.svc_infinite_container').append(content_after);
			jQuery(".td-g-rec").addClass('svc_ads_done');
			setTimeout(function(){
				if(on_end_callback_enable){svc_on_end_callback();}
			},call_back_end_timeout);
		}
		
		jQuery(document).scroll(function(){
			if(post_count > 1){
				return '';					
			}
			if(typeof $('body').find('.svc_infinite_container')[0] == 'undefined'){
				return '';
			}
			var repeat_post_offset = jQuery( artical_parent_selector+' .svc_infinite_container' ).last().offset().top;
			var repeat_post_height = jQuery( artical_parent_selector+' .svc_infinite_container' ).last().height();
			
			if (((repeat_post_offset + repeat_post_height - wl.scrollTop()) - slider_offset) < wl.height()) {
				var next_url = jQuery('.svc_next_url').val();
				var next_url_set = jQuery('.svc_next_url_set').val();
				if(next_url_set == 1){
					$('.svc_next_url_set').val(0);
					
					if(on_start_callback_enable){svc_on_start_callback();}
					$.get(next_url, function(response) {
						jQuery('.lds-dual-ring').remove();
						var ht = '';
						var h = $(response).find(artical_selector).html();
						
						for(var t = 0;t<25;t++){
							h = h.replace('document.write(','jQuery(".td-g-rec").not(".svc_ads_done").addClass("svc_ads_done").prepend(');
						}

						if(typeof h != 'undefined' && h != ''){
							ht = '<div class="svc_infinite_container svc_next_artical_div" id="svc_infinite_id_'+next_ids[post_count]+'" next-data-url="'+next_links[post_count]+'" next-data-title="'+next_titles[post_count]+'" next-data-id="'+next_ids[post_count]+'">';
							ht += h;
							if((after_content_enable == 'yes' || next_arrow == 'yes') && next_ids[post_count+1] && post_count < 1){
								ht += '<div class="svc_pre_container_after"><div class="svc_pre_under_container">';
								if(after_content_enable == 'yes'){
									ht += '<div class="svc_next_content">'+after_content+'</div>';
								}
								if(next_arrow == 'yes'){
									ht += '<div class="svc_next_ref"><span class="svc_next_txt">'+next_post_text+'</span></div>';
								}
								ht += '</div><div class="lds-dual-ring"></div></div>';
							}
						
							ht += '</div>';
							
							h = ht;
							//jQuery( artical_parent_selector ).append(h);
							jQuery( artical_selector ).append(h);
						}
						post_count++;
						setTimeout(function(){
							if(on_end_callback_enable){svc_on_end_callback();}
						},call_back_end_timeout);
						if(next_links[post_count] != '' && typeof next_links[post_count] != 'undefined'){
							jQuery('.svc_next_url').val(next_links[post_count]);
							jQuery('.svc_next_url_set').val(1);
						}else{
							jQuery('.svc_next_url').val('');
							jQuery('.svc_next_url_set').val(0);
						}
					});
					
				}
			}
			
		});	
	}
});