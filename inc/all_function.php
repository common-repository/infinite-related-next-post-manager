<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function winpm_display_field($string) {
	return htmlspecialchars(stripslashes($string));
}

add_action('wp_ajax_winpm_next_setting_data','winpm_next_setting_data');
add_action('wp_ajax_nopriv_winpm_next_setting_data','winpm_next_setting_data');
function winpm_next_setting_data(){
	extract($_POST);
	$svc_activation_status = 'activat';
	if($svc_activation_status == '' || $svc_activation_status == 'notactivat'){
		echo "notupdated";
	}else{
		if(!isset($_POST['post_thumbnail'])){ $_POST['post_thumbnail'] = '0';}
		if(!isset($_POST['ajax_disable'])){ $_POST['ajax_disable'] = '0';}
		if(!isset($_POST['enable_history_push'])){ $_POST['enable_history_push'] = '0';}
		if(!isset($_POST['owl_js_on'])){ $_POST['owl_js_on'] = '0';}
		if(!isset($_POST['leftsidebar_content_enable'])){ $_POST['leftsidebar_content_enable'] = '0';}				
		if(!isset($_POST['next_arrow'])){ $_POST['next_arrow'] = '0';}
		if(!isset($_POST['after_content_enable'])){ $_POST['after_content_enable'] = '0';}
		update_option( '_winpm_next_post_option', serialize($_POST));
		echo "updated";
	}
	wp_die();
}

function winpm_next_post_add_meta_box() {

		add_meta_box(
			'myplugin_sectionid',
			__( 'Next Post Manager', 'next-post-manager' ),
			'winpm_next_post_meta_box_callback',
			'post'
		);
}
add_action( 'add_meta_boxes', 'winpm_next_post_add_meta_box' );

function winpm_next_post_meta_box_callback( $post ) {
	$next_article_layout = new WINPM_Next_Article_Layout();
	$grid = $next_article_layout->sblog_get_options();
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'winpm_post_save_meta_box_data', 'winpm_post_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$svc_next_disable = get_post_meta( $post->ID, 'svc_next_disable', true );
	$svc_next_exclude = get_post_meta( $post->ID, 'svc_next_exclude', true );
	$related_by = get_post_meta( $post->ID, 'svc_related_by', true );
	ob_start();
	if($related_by == ''){
		$related_by = $grid->get('related_by');
	}?>
    <style type="text/css">
	.sav_next_admin_form_post input[type="text"]{
		border: 2px solid #d7e5ee;
		border-radius: 4px;
		box-shadow: none;
		box-sizing: border-box;
		width: 354px;
		color: #444f5b;
		font-size: 13px;
		font-weight: 500;
		padding: 10px 19px;
		transition: all .2s ease;
		height: auto;
	}
	.sav_next_admin_form_post th{
		width: 220px;
		vertical-align: top;
		text-align: left;
		box-sizing: border-box;
	}
	.sav_next_admin_form_post tr {
		width: 100%;
		display: inline-block;
		border-bottom: 1px solid #f2f2f2;
		padding: 10px;
		box-sizing: border-box;
	}
	.sav_next_admin_form_post td { position:relative;}
	.svc_or_next {
		position: absolute;
		border: 1px solid #ccc;
		padding: 10px;
		border-radius: 50%;
		background: #fff;
		left: 50%;
		bottom: -30px;
		font-size: 12px;
		line-height: 15px;
	}
	.sav_next_admin_form_post tr:last-child {
		border-bottom: none;
	}
	.svc_related_by {
		width: 100%;
		display: block;
		padding: 4px 0;
	}
	.sav_next_admin_form_post p.description {
		display: inline-block;
		width: 100%;
		color: #808d9b;
		margin-top: 7px;
	}
	.sav_next_admin_form_post th label{
		float: left;
		color: #444f5b;
		font-size: 14px;
		font-weight: 500;
	}
	td.svc_padding10 {
		padding: 0px 0 10px 0;
	}
	.svc_padding20 {
		padding: 10px 0 0px 0;
	}
	</style>
	<table class="sav_next_admin_form_post">
    	<tr>
			<th><label for="myplugin_new_field"><?php _e( 'Disable Related Posts display', 'next-post-manager' );?></label></th>
			<td>
            	<div class="onoffswitch">
                    <input type="checkbox" value="yes" name="svc_next_disable" <?php checked( $svc_next_disable, 'yes' ); ?> class="onoffswitch-checkbox"/>
                    <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
                <p class="description"><?php _e('If this is checked, then Next Related Posts will not automatically load.','next-post-manager');?></p>
                
            </td>
		</tr>
        <tr>
			<th><label for="myplugin_new_field"><?php _e( 'Exclude this post from the next Posts list ', 'next-post-manager' );?></label></th>
			<td>
            	<div class="onoffswitch">
                    <input type="checkbox" value="yes" name="svc_next_exclude" <?php checked( $svc_next_exclude, 'yes' ); ?> class="onoffswitch-checkbox"/>
                    <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
                <p class="description"><?php _e('If this is checked, then this post will be excluded from the next posts list.','next-post-manager');?></p>
                
            </td>
		</tr>
		<tr>
			<th><label for="myplugin_new_field"><?php _e( 'Override default Related By', 'next-post-manager' );?></label></th>
			<td class="svc_padding10">	
                <div class="svc_related_by"><input type="radio" value="by_cat" name="related_by" <?php checked( $related_by, 'by_cat' ); ?>/><?php _e('Related Posts by Category','next-post-manager');?></div>
                <div class="svc_related_by"><input type="radio" value="by_tags" name="related_by" <?php checked( $related_by, 'by_tags' ); ?>/><?php _e('Related Posts by Tags','next-post-manager');?></div>
                <div class="svc_related_by"><input type="radio" value="by_cat_author" name="related_by" disabled="disabled"/><?php _e('Related Posts by Category and Author','next-post-manager');?></div>
                <div class="svc_related_by"><input type="radio" value="by_tags_author" name="related_by" disabled="disabled"/><?php _e('Related Posts by Tags and Author','next-post-manager');?></div>
                <div class="svc_related_by"><input type="radio" value="by_author" name="related_by" disabled="disabled"/><?php _e('Related Posts by Author','next-post-manager');?></div>
                <div class="svc_related_by"><input type="radio" value="latest_post" name="related_by" disabled="disabled"/><?php _e('Latest Post','next-post-manager');?></div>
                <p class="description"><?php _e('override default Related By Setting. Pro version buy for more options. <a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO Version</a>','next-post-manager');?></p>
                <div class="svc_or_next">OR</div>
            </td>
		</tr>
        <tr class="winpm_blur_tr">
			<th class="svc_padding20"><label for="myplugin_new_field"><?php _e( 'Add Manual Next Posts', 'next-post-manager' );?></label>
			<span class="winpm_pro_link"><a href="https://codecanyon.net/item/wordpress-next-post-manager/21800899?ref=saragna" target="_blank">PRO <span class="pe-7s-link"></span></a></span></th>
			<td class="svc_padding20">
            	<input type="text" value="" name="svc_manual_post" disabled="disabled"/>
                <p class="description"><?php _e('Comma separated list of post IDs. e.g. 98,569,120. These will be given preference over the Next posts generated by the plugin. Once you enter the list above and save this page. Only IDs corresponding to published posts will be retained.','next-post-manager');?></p>
				<div class="winpm_blur_section"></div>
            </td>
		</tr>
	</table>
	<?php
	$m = ob_get_clean();
	echo $m;
}

function winpm_next_post_save_meta_box_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['winpm_post_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['winpm_post_meta_box_nonce'], 'winpm_post_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Sanitize user input.
	$svc_next_disable = sanitize_text_field( $_POST['svc_next_disable'] );
	$svc_next_exclude = sanitize_text_field( $_POST['svc_next_exclude'] );
	$related_by = sanitize_text_field( $_POST['related_by'] );	

	//Update the meta field in the database.
	update_post_meta( $post_id, 'svc_next_disable', $svc_next_disable );
	update_post_meta( $post_id, 'svc_next_exclude', $svc_next_exclude );
	update_post_meta( $post_id, 'svc_related_by', $related_by );
}
add_action( 'save_post', 'winpm_next_post_save_meta_box_data' );

function winpm_title_limit($excerpt,$limit=900){
	//$excerpt = strip_tags($excerpt);
	$excerpt = explode(' ', $excerpt, $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	//$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}
?>
