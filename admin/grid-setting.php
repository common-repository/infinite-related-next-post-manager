<script type="text/javascript">
jQuery(function($){
	//on-off start
	$(".on_off label").click(function(){
		var id = $(this).attr('id');
		var data = $(this).attr('data');
		if(data == 'y'){
			$('.'+id).show();
		}
		if(data == 'n'){
			$('.'+id).hide();
		}
        $(this).parent('div').children('label').removeClass("on");
        $(this).addClass("on");
    });
	//on-off end

	$('.post-list-tabs-menu li').click(function(){
		var tab = $(this).attr('data-tab-index');
		if(tab == 'activation_tab'){
			$('.svc_save_btn_admin,.svc_not_active_container').hide();
		}else{
			$('.svc_save_btn_admin,.svc_not_active_container').show();
		}
		$('.post-list-tabs-menu li').removeClass('spl_active');
		$(this).addClass('spl_active');
		$('.spl_tabs').hide();
		$('#'+tab).show();
	});
	
	$('.layout_style').on('change', function (e) {
		var valueSelected = this.value;
		jQuery('.svc_option_tab').hide();
		jQuery('.'+valueSelected+'_tab').show();
	});
	
	$('#grid_query').click(function(){
		$('#grid_query_div').slideToggle();	
	});
});
</script>
<style type="text/css">
.notice-error, div.error{ display:none !important;}
.new_fields{ background:#fff; margin-top:0px; padding:5px 5px 0; border:1px solid #e7e4e4; border-top:0px;}
.widefat.dataa,.widefat.dataa td{ border:0px; box-shadow:none; cursor:move;}
.post-list-tabs-menu li {
    cursor: pointer;
    float: left;
    padding: 17px 30px;
    text-align: center;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-o-box-sizing: border-box;
    margin:0;
	font-size: 15px;
	border-bottom: 2px solid transparent;
	font-weight: 400;
    color: #80a5bb;
	position:relative;
}
.post-list-tabs-menu li.spl_active {
    border-bottom: 2px solid #444f5b;
	color: #444f5b;
}
.post-list-tabs-menu {
    clear: both;
    list-style: none outside none;
    display: inline-block;
    width: 100%;
    margin: 0;
	background: #fff;
    border-radius: 7px 7px 0 0;
}
.spost_button,.spost_button_act {
    background: #4ad504;
    border: 1px solid #4ad504;
    border-radius: 3px;
    box-shadow: none;
    font-size: 13px;
    color: #fff;
    padding: 10px 20px;
    text-transform: uppercase;
    font-weight: 500;
    cursor: pointer;
    text-align: center;
	text-decoration: none;
	position: relative;
}
.spost_button:hover,.spost_button:focus,.spost_button:active,
.spost_button_act:hover,.spost_button_act:focus,.spost_button_act:active{
	background: #3ecc00;
	text-decoration:none;
	color:#fff;
}
@keyframes a{0%{transform:rotate(0deg)}to{transform:rotate(1turn)}}
.svc_next_loader,.svc_next_loader_act{
	display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 16px;
    height: 16px;
    margin: -8px 0 0 -8px;
    border-radius: 50%;
    background: #fff;
    background: linear-gradient(90deg,#fff 10%,hsla(0,0%,100%,0) 42%);
    animation: a 1s infinite linear;
    transform: translateZ(0);
    opacity: 0;
    transition: all .1s ease;
}
.svc_next_loader:before,.svc_next_loader_act:before {
    width: 50%;
    height: 50%;
    border-radius: 100% 0 0 0;
    background: #fff;
}
.svc_next_loader:after,.svc_next_loader_act:after {
    width: 65%;
    height: 65%;
    border-radius: 50%;
    margin: auto;
    bottom: 0;
    right: 0;
    background: #08d947;
}
.svc_next_loader:after,.svc_next_loader:before,
.svc_next_loader_act:after,.svc_next_loader_act:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
}
.svc_save_btn_admin {
    background: #333;
    padding: 35px;
    border-radius: 0 0 7px 7px;
	display: inline-block;
    width: 100%;
    box-sizing: border-box;
    margin-top: -20px;
}
.svc-option-save-success{
	display: inline-block;
    position: relative;
    visibility: visible;
    vertical-align: middle;
    margin-left: 15px;
    opacity: 0;
    line-height: 1;
    font-weight: 700;
    transition: all 1s ease;
    transition-delay: 0.1s;
	color: #6dcf59;
}
.svc-option-save-error{
	display: inline-block;
    position: relative;
    visibility: visible;
    vertical-align: middle;
    margin-left: 15px;
    opacity: 0;
    line-height: 1;
    font-weight: 700;
    transition: all 1s ease;
    transition-delay: 0.1s;
	color: #d20012;
}
.svc-save-success-label{
    margin-left: 3px;
}
.svc_option_tab{ display:none;}
.svc_plugin_active_not_ok .svc-admin-item-notification {
    display: block;
    position: absolute;
    top: 17px;
    right: 15px;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #ff8c99;
}
.svc_plugin_active_ok .svc-admin-item-notification {
    display: block;
    position: absolute;
    top: 17px;
    right: 17px;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #4ad504;
}
</style>

<?php 
$grid = self::sblog_get_options();
$svc_activation_status = 'activat';//get_option( '_next_post_activation_status');
$svc_activation_code = get_option( '_next_post_activation_code');

if($svc_activation_status == 'activat'){
	$svc_activation_status_class = 'svc_plugin_active_ok';
}else{
	$svc_activation_status_class = 'svc_plugin_active_not_ok';	
}
//echo "<pre>";print_r($grid);echo "</pre>";?>
<script>
jQuery(function($){
	$('.<?php echo $grid->get('layout_style');?>_tab').show();	
});
</script>
<ul class="post-list-tabs-menu">
	<li data-tab-index="general_tab" class="spl_active"><?php _e('General','next-post-manager');?></li>
	<li data-tab-index="infinite_tab" class="infinite_tab svc_option_tab"><?php _e('Infinite Loading','next-post-manager');?></li>
    <li data-tab-index="bottom_slider_tab" class="bottom_slider_tab svc_option_tab"><?php _e('Bottom/Top Slider','next-post-manager');?></li>
    <li data-tab-index="sidebar_tab" class="sidebar_tab svc_option_tab"><?php _e('Left Sidebar','next-post-manager');?></li>
    <li data-tab-index="bottom_left_sidebar_tab" class="bottom_left_sidebar_tab svc_option_tab"><?php _e('Bottom Left Sidebar','next-post-manager');?></li>    
	<li data-tab-index="color_tab" class=""><?php _e('Color / Size','next-post-manager');?></li>
	<li data-tab-index="before_after_tab" class=""><?php _e('Post After Content','next-post-manager');?></li>
	<li data-tab-index="callback_tab" class=""><?php _e('Callbacks','next-post-manager');?></li>
	<li data-tab-index="preferences_tab" class=""><?php _e('Preferences','next-post-manager');?></li>
</ul>

<div class="sblog_setting_container">
<div id="general_tab" class="spl_tabs" style="display:block;">
	<div style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting vertical-top">	
                	<tr>
                    	<th><strong class="afl"><?php _e('Select Type','next-post-manager');?></strong></th>
                        <td>
                            <select name="layout_style" class="layout_style" id="spost_layout_style" data-check-depen="yes">
                            	<option value="" <?php selected( $grid->get('layout_style'), '' ); ?>><?php _e('Select Next Post Type','next-post-manager');?></option>
                                <option value="infinite" <?php selected( $grid->get('layout_style'), 'infinite' ); ?>><?php _e('Infinite Loading','next-post-manager');?></option>
                                <option value="bottom_slider" <?php selected( $grid->get('layout_style'), 'bottom_slider' ); ?> disabled="disabled"><?php _e('Bottom/Top Slider (PRO)','next-post-manager');?></option>
                                <option value="sidebar" <?php selected( $grid->get('layout_style'), 'sidebar' ); ?> disabled="disabled"><?php _e('Left Sidebar (PRO)','next-post-manager');?></option>
                                <option value="bottom_left_sidebar" <?php selected( $grid->get('layout_style'), 'bottom_left_sidebar' ); ?> disabled="disabled"><?php _e('Bottom Left Sidebar (PRO)','next-post-manager');?></option>
                            </select>
                            <p class="description"><?php _e('Select Type for Next post Style. Pro version buy for more option. <a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO Version</a>','next-post-manager');?></p>
                        </td>
                    </tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Select Post Type','next-post-manager');?></strong></th>
                        <td>
                        	<?php 
							$exclu_post_type = array('shop_order','shop_coupon','shop_webhook','wpcf7_contact_form','vc_grid_item');
							$args = array(
							   'public'   => true,
							   'publicly_queryable' => true
							);
							$output = 'names'; // names or objects, note names is the default
							$operator = 'and'; // 'and' or 'or'
							$post_types = get_post_types($args, $output, $operator); 
							foreach($post_types as $post_type){
							if($post_type != 'attachment' && $post_type != 'revision' && $post_type != 'nav_menu_item' && $post_type != 'product_variation' && $post_type != 'shop_order_refund'){?>
							<input type="checkbox" name="post_type[]" value="<?php echo $post_type;?>" <?php if(in_array( $post_type, $grid->get('post_type') )){ echo 'checked';} ?>/><?php echo $post_type;?>&nbsp;
							<?php if($post_type == 'post'){?>
							<input type="checkbox" name="post_type[]" value="page" <?php if(in_array( 'page', $grid->get('post_type') )){ echo 'checked';} ?>/><?php _e('page','next-post-manager');?>&nbsp;                                        						
							<?php }
								}}?>
                            <p class="description"><?php _e('Select Post Type for Next post. Other Post type only get latest post. and also CPT working with only same selector.','next-post-manager');?></p>
                        </td>
                    </tr>
					<tr>
						<th><strong class="afl"><?php _e('Select Related By','next-post-manager');?></strong></th>	
						<td>	
							<div class="svc_related_by"><input type="radio" value="by_cat" name="related_by" <?php checked( $grid->get('related_by'), 'by_cat' ); ?>/><?php _e('Related Posts by Category','next-post-manager');?></div>
                            <div class="svc_related_by"><input type="radio" value="by_tags" name="related_by" <?php checked( $grid->get('related_by'), 'by_tags' ); ?>/><?php _e('Related Posts by Tags','next-post-manager');?></div>
                            <div class="svc_related_by"><input type="radio" value="by_cat_author" name="related_by" disabled="disabled"/><?php _e('Related Posts by Category and Author','next-post-manager');?></div>
                            <div class="svc_related_by"><input type="radio" value="by_tags_author" name="related_by" disabled="disabled"/><?php _e('Related Posts by Tags and Author','next-post-manager');?></div>
                            <div class="svc_related_by"><input type="radio" value="by_author" name="related_by" disabled="disabled"/><?php _e('Related Posts by Author','next-post-manager');?></div>
                            <div class="svc_related_by"><input type="radio" value="latest_post" name="related_by" disabled="disabled"/><?php _e('Latest Post','next-post-manager');?></div>
							<p class="description"><?php _e('Choose Next post by. Pro version buy for more options. <a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO Version</a>','next-post-manager');?>.</p></td>	
					</tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Post Display','next-post-manager');?></strong></th>
                        <td>
							<input type="number" step="1" value="<?php echo $grid->get('post_count');?>" name="post_count" max="2" min="1">
                            <p class="description"><?php _e('How many post to show? default: 2. Pro version buy for Increase post. <a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO Version</a>','next-post-manager');?></p>
                        </td>
                    </tr>
                    <tr class="winpm_blur_tr">	
						<th><strong class="afl"><?php _e('On Scroll URL History Push','next-post-manager');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>	
						<td>
						<div class="onoffswitch">
                            <input type="checkbox" value="yes" name="enable_history_push" class="onoffswitch-checkbox"/>
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
						<p class="description"><?php _e('On Scroll URL History Push and Main Title change according to display post.','next-post-manager');?></p>
						<div class="winpm_blur_section"></div>
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="sidebar" data-value1="bottom_left_sidebar" data-id="spost_layout_style" data-attr="select">
                    	<th><strong class="afl"><?php _e('More Stories Text','next-post-manager');?></strong></th>
                        <td>
                            <input type="text" name="more_stories_text" value="<?php echo $grid->get('more_stories_text');?>"/>
                            <p class="description"><?php _e('Change More Stories Text. Default: MORE STORIES','next-post-manager');?></p>
                        </td>
                    </tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Content Selector','next-post-manager');?></strong></th>
                        <td>
                            <input type="text" name="artical_selector" value="<?php echo $grid->get('artical_selector');?>"/>
                            <p class="description"><?php _e('class or id of div which is containing your post','next-post-manager');?></p>
                        </td>
                    </tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Content Parent Selector (optional)','next-post-manager');?></strong></th>
                        <td>
                            <input type="text" name="artical_parent_selector" value="<?php echo $grid->get('artical_parent_selector');?>"/>
                            <p class="description"><?php _e('class or id of Parent div which is containing your post.','next-post-manager');?></p>
                        </td>
                    </tr>
                    <tr data-depen-set="true" data-value="bottom_slider" data-id="spost_layout_style" data-attr="select">
                    	<th><strong class="afl"><?php _e('Slider wrapper Class (optional)','next-post-manager');?></strong></th>
                        <td>
                            <input type="text" name="slider_warpper" value="<?php echo $grid->get('slider_warpper');?>"/>
                            <p class="description"><?php _e('Add Slider wrapper Class. Class add without dot "."','next-post-manager');?></p>
                        </td>
                    </tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Next Post Hide Section Selector','next-post-manager');?></strong></th>
                        <td>
                            <input type="text" name="hide_selector" value="<?php echo $grid->get('hide_selector');?>"/>
                            <p class="description"><?php _e('Comma separated list of post next Class and id. e.g. .comment_section,#authore_box,.like_container','next-post-manager');?></p>
                        </td>
                    </tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="infinite_tab" class="spl_tabs">
	<div style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">	
					<tr>
                    	<th><strong class="afl"><?php _e('Buffer Pixels','next-post-manager');?></strong></th>
                        <td>
							<div class="sblog-font-size"><input type="number" step="1" value="<?php echo $grid->get('buffer_pixel');?>" name="buffer_pixel" max="9000" min="0"> px</div>
                            <p class="description"><?php _e('Increase this number if you want infinite scroll to fire quicker.default:350px','next-post-manager');?></p>
                        </td>
                    </tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="color_tab" class="spl_tabs">
	<div style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="vertical-top anew_slider_setting">
					<tr>	
						<th><strong class="afl"><?php _e('Title Hover Color','next-post-manager');?></strong></th>	
						<td>	
						<input type="text" class="my-color-field" name="thcolor" data-default-color="" value="<?php echo $grid->get('thcolor');?>"/>	
						<p class="description"><?php _e('Set Title Hover Color','next-post-manager');?>.</p>	
						</td>
					</tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="before_after_tab" class="spl_tabs">
	<div style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="vertical-top anew_slider_setting">
					<tr>	
						<th><strong class="afl"><?php _e('After Next Arrow','next-post-manager');?></strong></th>	
						<td>
						<div class="onoffswitch">
                            <input type="checkbox" value="yes" name="next_arrow" id="spost_next_arrow" data-check-depen="yes" <?php checked( $grid->get('next_arrow'), 'yes' ); ?> class="onoffswitch-checkbox"/>
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
						<p class="description"><?php _e('Enable Post After Next Post Arrow.','next-post-manager');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_next_arrow" data-attr="checkbox">
                    	<th><strong class="afl"><?php _e('Next Post Text','next-post-manager');?></strong></th>
                        <td>
                            <input type="text" name="next_post_text" value="<?php echo stripslashes_deep($grid->get('next_post_text'));?>"/>
                            <p class="description"><?php _e('add Next Post Text.Default:NEXT STORY','next-post-manager');?></p>
                        </td>
                    </tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_next_arrow" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('Next Post Text Color','next-post-manager');?></strong></th>	
						<td>	
						<input type="text" class="my-color-field" name="next_text_color" data-default-color="#cccccc" value="<?php echo $grid->get('next_text_color');?>"/>
						<p class="description"><?php _e('Next Post Text. Default: gray','next-post-manager');?>.</p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_next_arrow" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('Next Post Line/Arrow Color','next-post-manager');?></strong></th>	
						<td>	
						<input type="text" class="my-color-field" name="next_line_color" data-default-color="#cccccc" value="<?php echo $grid->get('next_line_color');?>"/>
						<p class="description"><?php _e('Next Post Line/Arrow. Default: gray','next-post-manager');?>.</p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_next_arrow" data-attr="checkbox">
                    	<th><strong class="afl"><?php _e('Next Post Text Font Size','next-post-manager');?></strong></th>
                        <td>
							<div class="sblog-font-size"><input type="number" step="1" value="<?php echo $grid->get('next_text_size');?>" name="next_text_size" max="90000" min="1"> px</div>
                            <p class="description"><?php _e('Next Post Text Font Size. default : 20px','next-post-manager');?></p>
                        </td>
                    </tr>
                    <tr class="winpm_blur_tr">	
						<th><strong class="afl"><?php _e('Enable After add Content','next-post-manager');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>	
						<td>						
						<div class="onoffswitch">
							<input type="checkbox" value="yes" name="after_content_enable" id="spost_after_content_enable" data-check-depen="yes" checked="checked" class="onoffswitch-checkbox"/>
							<label class="onoffswitch-label" for="myonoffswitch">
								<span class="onoffswitch-inner"></span>
								<span class="onoffswitch-switch"></span>
							</label>
						</div>
						<p class="description"><?php _e('Enable Post After Content add.','next-post-manager');?></p>	
						<div class="winpm_blur_section"></div>
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_after_content_enable" data-attr="checkbox" class="winpm_blur_tr">
                    	<th><strong class="afl"><?php _e('Add Content','next-post-manager');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>
                        <td class="ace-monokai">
                        	<textarea name="after_content" class="svc_after_content" cols="90" rows="5" data-editor="xml" data-gutter="1"><?php echo winpm_display_field($grid->get('after_content'));?></textarea>
                            <p class="description"><?php _e('add html code or shortcode. please not add javascript code.','next-post-manager');?></p>
							<div class="winpm_blur_section"></div>
                        </td>
                    </tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_after_content_enable" data-attr="checkbox" class="winpm_blur_tr">
                    	<th><strong class="afl"><?php _e('Content Align','next-post-manager');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>
                        <td>
                            <select name="after_content_align">
                            	<option value="" <?php selected( $grid->get('after_content_align'), '' ); ?>>Select Align</option>
                                <option value="center" <?php selected( $grid->get('after_content_align'), 'center' ); ?>>Center</option>
                                <option value="left" <?php selected( $grid->get('after_content_align'), 'left' ); ?>>Left</option>
                                <option value="right" <?php selected( $grid->get('after_content_align'), 'right' ); ?>>Right</option>
                            </select>
                            <p class="description"><?php _e('Select Skin type for left sidebar post.','next-post-manager');?></p>
							<div class="winpm_blur_section"></div>
                        </td>
                    </tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_after_content_enable" data-attr="checkbox" class="winpm_blur_tr">
                    	<th><strong class="afl"><?php _e('Padding of Content','next-post-manager');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>
                        <td class="ace-monokai">
                        	<div class="sblog-font-size">
                                <input type="number" step="1" value="<?php echo $grid->get('after_content_padding_top');?>" name="after_content_padding_top" max="3000" min="0"> top
                                <input type="number" step="1" value="<?php echo $grid->get('after_content_padding_right');?>" name="after_content_padding_right" max="3000" min="0"> right
                                <input type="number" step="1" value="<?php echo $grid->get('after_content_padding_bottom');?>" name="after_content_padding_bottom" max="3000" min="0"> bottom
                                <input type="number" step="1" value="<?php echo $grid->get('after_content_padding_left');?>" name="after_content_padding_left" max="3000" min="0"> left
                            </div>
                            <p class="description"><?php _e('Padding of After Content. padding in "px"','next-post-manager');?></p>
							<div class="winpm_blur_section"></div>
                        </td>
                    </tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_after_content_enable" data-attr="checkbox" class="winpm_blur_tr">	
						<th><strong class="afl"><?php _e('Content background Color','next-post-manager');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>	
						<td>	
						<input type="text" class="my-color-field" name="after_content_bgcolor" data-default-color="#f2f2f2" value="<?php echo $grid->get('after_content_bgcolor');?>"/>
						<p class="description"><?php _e('Add Content background Color. Default: light gray','next-post-manager');?>.</p>
						<div class="winpm_blur_section"></div>
						</td>	
					</tr>
                    <tr>
                    	<th><strong class="afl"><?php _e('Margin of Next Arrow and Content Section','next-post-manager');?></strong></th>
                        <td class="ace-monokai">
                        	<div class="sblog-font-size">
                                <input type="number" step="1" value="<?php echo $grid->get('after_content_margin_top');?>" name="after_content_margin_top" max="3000" min="0"> top
                                <input type="number" step="1" value="<?php echo $grid->get('after_content_margin_bottom');?>" name="after_content_margin_bottom" max="3000" min="0"> bottom
                            </div>
                            <p class="description"><?php _e('Margin of After Content. margin in "px"','next-post-manager');?></p>
                        </td>
                    </tr>
				</table>
				</div>	
				</div>	
			</div>	
		</div>
	</div>
</div>

<div id="callback_tab" class="spl_tabs">
	<div style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">
                	<tr>	
						<th><strong class="afl"><?php _e('On Post Load Start Callback','next-post-manager');?></strong></th>	
						<td>
						<div class="onoffswitch">
                            <input type="checkbox" value="yes" name="on_start_callback_enable" id="spost_on_start_callback_enable" data-check-depen="yes" <?php checked( $grid->get('on_start_callback_enable'), 'yes' ); ?> class="onoffswitch-checkbox"/>
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
						<p class="description"><?php _e('Enable Every Next Post Load Start before call.','next-post-manager');?></p>	
						</td>	
					</tr>
					<tr data-depen-set="true" data-value="yes" data-id="spost_on_start_callback_enable" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('On Every Next Post Load Start Before Call','next-post-manager');?></strong></th>	
						<td class="ace-monokai">
                        <textarea name="on_start_callback" class="on_start_callback" cols="90" rows="5" data-editor="xml" data-gutter="1"><?php echo winpm_display_field($grid->get('on_start_callback'));?></textarea>
						<p class="description"><?php _e('Executes on next post load start Before Call. (Use Javasctipt/jQuery code to trigger custom event).','next-post-manager');?></p>	
						</td>	
					</tr>
                    <tr>	
						<th><strong class="afl"><?php _e('On Post Load End Callback','next-post-manager');?></strong></th>	
						<td>
						<div class="onoffswitch">
                            <input type="checkbox" value="yes" name="on_end_callback_enable" id="spost_on_end_callback_enable" data-check-depen="yes" <?php checked( $grid->get('on_end_callback_enable'), 'yes' ); ?> class="onoffswitch-checkbox"/>
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
						<p class="description"><?php _e('Enable Every Next Post Load End before call.','next-post-manager');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_on_end_callback_enable" data-attr="checkbox">	
						<th><strong class="afl"><?php _e('On Every Next Post Load completed After Call','next-post-manager');?></strong></th>	
						<td class="ace-monokai">
                        <textarea name="on_end_callback" class="on_end_callback" cols="90" rows="5" data-editor="xml" data-gutter="1"><?php echo winpm_display_field($grid->get('on_end_callback'));?></textarea>
						<p class="description"><?php _e('Executes immediately after next post load completed after Call. (Use Javasctipt/jQuery code to trigger custom event).','next-post-manager');?></p>	
						</td>	
					</tr>
                    <tr data-depen-set="true" data-value="yes" data-id="spost_on_end_callback_enable" data-attr="checkbox">
                    	<th><strong class="afl"><?php _e('On Post Load End Callback Timeout','next-post-manager');?></strong></th>
                        <td>
							<div class="sblog-font-size"><input type="number" step="100" value="<?php echo $grid->get('call_back_end_timeout');?>" name="call_back_end_timeout" max="90000" min="0"> millisecond</div>
                            <p class="description"><?php _e('How many post to show? default: 0, 1000 millisecond = 1 second','next-post-manager');?></p>
                        </td>
                    </tr>
					<tr class="winpm_blur_tr">	
						<th><strong class="afl"><?php _e('Google Analytics for Loadmore Post','sblog');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>	
						<td>
						<div class="onoffswitch">
                            <input type="checkbox" value="yes" name="on_google_analytics" id="spost_on_google_analytics" data-check-depen="yes" class="onoffswitch-checkbox"/>
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
						<p class="description"><?php _e('On Google Analytics for Loadmore Post. this option on for "analytics.js"','sblog');?></p>
						<div class="winpm_blur_section"></div>						
						</td>	
					</tr>
					<tr class="winpm_blur_tr">	
						<th><strong class="afl"><?php _e('Google Tag for Loadmore Post','sblog');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>	
						<td>
						<div class="onoffswitch">
                            <input type="checkbox" value="yes" name="on_google_tag" id="spost_on_google_tag" data-check-depen="yes" <?php checked( $grid->get('on_google_tag'), 'yes' ); ?> class="onoffswitch-checkbox"/>
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
						<p class="description"><?php _e('On Google Tag for Loadmore Post. this option on for "gtag.js"','sblog');?></p>	
						<div class="winpm_blur_section"></div>	
						</td>	
					</tr>
					<tr class="winpm_blur_tr">
                    	<th><strong class="afl"><?php _e('Add Google Analytics ID','sblog');?></strong>
						<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>
                        <td>
                            <input type="text" name="add_google_id" value="<?php echo $grid->get('add_google_id');?>"/>
                            <p class="description"><?php _e('Please add GA_MEASUREMENT_ID. like: "UA-XXXXXXXX-Y"','sblog');?></p>
							<div class="winpm_blur_section"></div>	
                        </td>
                    </tr>
				</table>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="preferences_tab" class="spl_tabs">
	<div style="width:100%;">
		<div class="postbox-container" style="width:100%;">	
			<div class="meta-box-sortables ui-sortable" style="margin:0">	
				<div class="postbox">
				<div class="inside">	
				<table class="anew_slider_setting">	
					<tr>	
						<th><strong class="afl"><?php _e('Custom CSS','next-post-manager');?></strong></th>	
						<td class="ace-monokai">
                        <textarea name="custom_css" class="custom_css" cols="90" rows="5" data-editor="xml" data-gutter="1"><?php echo winpm_display_field($grid->get('custom_css'));?></textarea>
						<p class="description"><?php _e("Here you can set the plugin's custom styles. The code will be added to each page with the widget.",'next-post-manager');?></p>	
						</td>	
					</tr>
				</table>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>


</div>
<div class="svc_save_btn_admin">
    <a href="#" class="spost_button"><span class="svc_save_data_btn">Save Setting</span><span class="svc_next_loader"></span></a>
    <span class="svc-option-save-success">
        <i class="fa fa-check"></i><span class="svc-save-success-label">Done!</span>
    </span>
</div>
