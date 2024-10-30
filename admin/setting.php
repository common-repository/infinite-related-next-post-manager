<script type="text/javascript">
jQuery(function($){
	$('.my-color-field').wpColorPicker();
	$(".handlediv,.hndle").click(function(){
		$(this).next('h3').next('.inside').toggle();
		if($(this).parent('.postbox').hasClass('closed')){
			$(this).parent('.postbox').removeClass('closed');
		}else{
			$(this).parent('.postbox').addClass('closed');
		}
	});
	$('.spost_button').click(function(e){
		e.preventDefault();
		jQuery('.svc_save_data_btn').css('opacity','0');
		jQuery('.svc_next_loader').css('opacity','1');
		var params=jQuery('.sav_next_admin_form').serialize();
		jQuery.ajax({
			type: 'POST',
			url: '<?php echo admin_url( 'admin-ajax.php' );?>',
			data:  params+'&action=winpm_next_setting_data',
			success: function(rr) {
				if(rr == 'updated'){
					jQuery('.svc_save_data_btn').css('opacity','1');
					jQuery('.svc_next_loader').css('opacity','0');
					jQuery('.svc-option-save-success').css('opacity','1');
					jQuery('.svc-option-save-error').css('opacity','0');
					setTimeout(function(){
						jQuery('.svc-option-save-success').css('opacity','0');
					},4000);
				}
				if(rr == 'notupdated'){
					jQuery('.svc_save_data_btn').css('opacity','1');
					jQuery('.svc_next_loader').css('opacity','0');
					jQuery('.svc-option-save-error').css('opacity','1');
					jQuery('.svc-option-save-success').css('opacity','0');
					setTimeout(function(){
						jQuery('.svc-option-save-error').css('opacity','0');
					},4000);
				}
			}
		});	
	});
});
</script>
<?php
$msg = false;
$mcode = 0;
$error = false;
if(isset($_POST['sblog_save_Setting'])){
	extract($_POST);
	//echo "<pre>";print_r($_POST);die;
	update_option( '_winpm_next_post_option', serialize($_POST));

	/*$templates = array();
    $templates['ID'] = $_POST['page_id'];
    $templates['post_content'] = '[blog_layout_manager]';
    wp_update_post($templates);*/
	
	wp_redirect( 'admin.php?page=next-post' );exit;
}
?>
<style type="text/css">
a,a:focus,a:active{ outline:none !important; box-shadow:none !important;}
.animate_slider_popup_loader{background:url(<?php echo $this->animate_plugin_url('../assets/image/default.gif');?>) no-repeat center #fff;}
.h2_logo{
	background:url(<?php echo $this->animate_plugin_url('../assets/image/round.png');?>) !important;
	background-repeat:no-repeat !important;
	box-shadow:none !important;
	background-size:42px 42px;
	display:table;
	font-size: 23px;
    font-weight: 400;
    line-height: 30px;
    padding: 6px 15px 7px 50px !important;
	margin:0 !important;
	border-bottom:0px !important;
}
.widefat td{border-bottom: 1px solid #f1f1f1;}
.aslider_required{ color:red; font-size:18px; vertical-align:middle; margin-left:2px;}
.help_btn{position: absolute; right: 15px; top: 7px;}
.afr{ float:right;}.afl{ float:left;color: #444f5b;font-size: 14px;}.apadl0{padding-left:0px !important;}.atal{text-align:left;}
.anew_slider{ margin-bottom:10px;}
.anew_slider th{ width:20px; vertical-align:top; text-align:left;}
.anew_slider1 th{ width:175px; text-align:left; vertical-align:top;}
.anew_slider_setting th{ width:220px; vertical-align:top; text-align:left; position:relative;}
.spl_tabs{ display:none;}
#grid_query{
	border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
    font-size: 13px;
    padding: 5px 18px;
    text-shadow: 1px 1px #f2f2f2;
}
#grid_query_div{
	background: #f2f2f2 none repeat scroll 0 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    display: none;
    padding: 10px;
	position:relative;
}
.vertical-top th{vertical-align:top; position:relative;}
.spost_hidden{ display:none !important;}
.svc_related_by{ width:100%; display:block; padding:4px 0;}
#adminmenu li.current a.menu-top{
	background:rgb(214, 53, 214);
	background: -webkit-linear-gradient(left, rgb(94, 141, 199) 0%, rgb(49, 194, 189) 100%);
	background: -moz-linear-gradient(left, rgb(94, 141, 199) 0%, rgb(49, 194, 189) 100%);
	background: -ms-linear-gradient(left, rgb(94, 141, 199) 0%, rgb(49, 194, 189) 100%);
}
.svc-header-version-text {
    float: right;
    margin-top: -40px;
    background: rgba(0,0,0,.1);
    box-shadow: none;
    text-decoration: none;
    color: #fff;
    font-size: 13px;
    font-weight: 500;
    line-height: 32px;
    padding: 0 24px;
    height: 32px;
    border: none;
    border-radius: 3px;
}
div.sav_next_wrap{
	margin: 10px 50px 0 32px;
}
.wp-picker-container input[type=text].wp-color-picker{
	width: 70px !important;
	padding: 3px 8px !important;
}

.svc-act-form{
    position: relative;
    background: #fafafa;
    padding: 40px;
    width: 50%;
    box-sizing: border-box;
    border-radius: 4px;
    margin-top: 5px;
}
.svc-act-form-header {
    position: relative;
}
.svc-act-form-header h4{
	margin-top: 0;
	margin: 0 0 20px;
	font-size: 20px;
    line-height: 20px;
	color: #444f5b;
    font-weight: 500;
    padding: 0;
}
.svc-act-status {
    position: absolute;
    top: 3px;
    left: 201px;
    white-space: nowrap;
}
.svc-act-status-activated {
    color: #02c23c;
    opacity: 0;
}
.svc-act-status-not-activated {
    color: #ff4734;
    opacity: 1;
}
.svc-act-status-activated,.svc-act-status-not-activated {
    font-size: 13px;
    font-weight: 400;
    text-transform: uppercase;
    padding-left: 13px;
    position: absolute;
    left: 0;
    top: 0;
    transition: all .2s ease;
}
.svc_plugin_active_ok .svc-act-form-purchase-code-input{
    border-color: #49d506 !important;
}
.svc_plugin_active_ok .svc-act-form-message-success{ display:block;}
.svc_plugin_active_ok .svc-act-status-activated{ opacity:1;}
.svc_plugin_active_not_ok .svc-act-status-not-activated{ opacity:1;}
.svc_plugin_active_not_ok .svc-act-status-activated{ opacity:0;}
.svc_plugin_active_ok .svc-act-status-not-activated{ opacity:0;}
.svc-act-status-activated:before {
    background: #02c23c;
}
.svc-act-status-not-activated:before {
    background: #ff4734;
}
.svc-act-status-activated:before,
.svc-act-status-not-activated:before {
    content: "";
    display: block;
    position: absolute;
    top: 50%;
    left: 0;
    width: 5px;
    height: 5px;
    margin-top: -2.5px;
    border-radius: 50%;
}
.svc-act-form-field{
    margin: 0 0 20px;
}
.svc-act-form-field-label {
    color: #808d9a;
	font-size: 15px;
    font-weight: 400;
    line-height: 1.6;
}
.svc-act-form-message-success.svc-act-form-message,
.svc-act-form-message-error.svc-act-form-message{
    position: absolute;
    left: 134px;
    top: 0;
}
input.svc-act-form-purchase-code-input {
    border-color: #49d506;
	width: 100%;
    border: 1px solid #e2e9ec;
    border-radius: 4px;
    box-shadow: none;
    box-sizing: border-box;
    color: #444f5b;
    font-size: 15px;
    font-weight: 400;
    padding: 10px 12px;
    margin-top: 14px;
    transition: all .2s ease;
	background-color: #fff;
}
.svc-act-form-field:last-child {
    margin-bottom: 0;
	position: relative;
}
.svc-act-form-message {
    font-size: 13px;
    font-weight: 400;
    margin-left: 32px;
    display: none;
}
.svc-act-form-message-success {
    color: #02c23c;
}
.svc-act-form-message-error{
    color: #ff293b;
}
.svc_faq_div {
    padding: 30px 30px 0 30px;
}
.svc_faq_div h3 {
    font-size: 20px;
    line-height: 20px;
    margin-bottom: 40px;
    color: #444f5b;
}
.svc_faq_faq {
    border-top: 1px solid #e8e8e8;
    padding: 20px 0 20px 0;
}
.svc_faq_faq strong {
    font-weight: 500;
    font-size: 15px;
    color: #444f5b;
}
.svc_faq_faq p {
    font-size: 15px;
    line-height: 1.6em;
}
.svc_faq_faq a {
    color: #2092f2;
    text-decoration: none;
    font-weight: 500;
}
</style>

<div class="wrap sav_next_wrap">

<div class="meta-box-sortables ui-sortable">
	<div class="postbox sav_next_admin_top" style="margin-bottom:10px;">
		<div class="inside" style="padding:0 53px; margin:20px 0;">
			<h3 class="h2_logo"><a href="<?php echo self::plugin_root_url();?>" style="text-decoration:none; color:#fff;"><?php echo esc_html( 'Next Post Manager for WordPress' ); ?></a></h3>
            <span class="svc-header-version-text">Version 1.0</span>
		</div>
	</div>
</div>

<?php if($msg == true && $mcode > 0 ){?>
<div class="<?php echo ($error == true) ? 'error' : 'updated';?>">
	<p><strong>
	<?php echo self::error_msg($mcode);?>
	</strong></p>
</div>
<?php }
$grid = self::sblog_get_options();?>
<form method="post" class="sav_next_admin_form">
<?php /*<div class="meta-box-sortables ui-sortable">
	<div class="postbox" style="margin-bottom:10px;border-radius: 7px 7px 0 0;">
		<div class="inside" style="padding:0 12px;">
			<strong style="margin-top: 5px;margin-right: 10px;"><?php _e('Select Type','next-post-manager');?></strong>
            <select name="layout_style">
                <option value="infinite" <?php selected( $grid->get('layout_style'), 'infinite' ); ?>>Infinite Loading</option>
                <option value="bottom_slider" <?php selected( $grid->get('layout_style'), 'bottom_slider' ); ?>>Bottom Slider</option>
                <option value="sidebar" <?php selected( $grid->get('layout_style'), 'sidebar' ); ?>>Left Sidebar</option>
            </select>
		</div>
	</div>
</div>*/?>
<?php 
include('grid-setting.php');?>
</form>
<script>
jQuery(function($){
	function spost_dependency_check(){		
		$('[data-depen-set]').each(function(index, element) {
			var this_tr = $(this);
			var field_value = '';
			var data_attr = this_tr.attr('data-attr');
			var data_id = this_tr.attr('data-id');
			var data_value = this_tr.attr('data-value');
			var data_value1 = this_tr.attr('data-value1');
			var data_value2 = this_tr.attr('data-value2');
			var data_value3 = this_tr.attr('data-value3');
			var data_value4 = this_tr.attr('data-value4');
			var data_value5 = this_tr.attr('data-value5');
			var data_value6 = this_tr.attr('data-value6');
			var data_value7 = this_tr.attr('data-value7');

			if(data_attr == 'checkbox'){
				if ($('#'+data_id).is(":checked")){
					field_value = $('#'+data_id).val();
				}
				if(field_value == data_value){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');	
				}
			}
			
			if(data_attr == 'select'){
				field_value = $('#'+data_id).val();
				if(field_value == data_value || field_value == data_value1 || field_value == data_value2 || field_value == data_value3 || field_value == data_value4 || field_value == data_value5 || field_value == data_value6 || field_value == data_value7){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');
				}
			}
			
			if(data_attr == 'number'){
				field_value = $('#'+data_id).val();
				if(field_value == data_value){
					this_tr.removeClass('spost_hidden');	
				}else{
					this_tr.addClass('spost_hidden');	
				}
			}
		});
		
		setTimeout(function(){
			$('.spost_hidden').each(function(index, element) {
				var this_input = $(this);
				var closesr_id = this_input.children('td').children('input').attr('id');
				$('[data-id]').each(function(index, element) {
					var this_sss = $(this);
					if(this_sss.attr('data-id') == closesr_id){
						this_sss.addClass('spost_hidden');
					}
				});						
			});
		},800);
	}
	spost_dependency_check();
	
	$('[data-check-depen]').not('select').click(function(){
		spost_dependency_check();
	});
	$('[data-check-depen]').change(function(){
		spost_dependency_check();
	});
});
</script>
</div>
