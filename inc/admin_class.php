<?php
if ( ! defined( 'ABSPATH' ) ) exit;
	class WINPM_Next_Article_Layout_Grid extends WINPM_Errors_Messages{

		public function __construct(){
			global $wpdb;
			add_action('admin_print_scripts',array( $this, 'animate_load_admin_script'));
			add_action('wp_enqueue_scripts',array($this, 'animate_load_scripts'));
		}
		
		function animate_load_admin_script(){
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'winpm-script-handle', '/wp-includes/js/colorpicker.min', array( 'jquery','wp-color-picker' ), false, true );
			wp_enqueue_script('wimpm-next-ace-js', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js', array("jquery"), false, false);
			wp_enqueue_script('next-editor-js', plugins_url('../assets/js/textarea-as-ace-editor.min.js', __FILE__), array("jquery"), false, false);
			wp_enqueue_script('wimpm-next-admin-js', plugins_url('../assets/js/admin.js', __FILE__), array("jquery"), false, false);
			wp_enqueue_style( 'wimpm-admin-css', $this->animate_plugin_url( '../assets/css/admin.css'), array(), '' );
			wp_enqueue_style( 'vcfti-font-stroke-css', plugins_url('../assets/css/pe-icon-7-stroke.css', __FILE__));
		}
		
		function animate_load_scripts() {
			$next_article_layout = new WINPM_Next_Article_Layout();
			$options = $next_article_layout->sblog_get_options();
			
			wp_register_style( 'wimpm-next-post-css', plugins_url('../assets/css/front.css', __FILE__));
			wp_enqueue_style( 'wimpm-next-post-css');
			wp_enqueue_style( 'vcfti-font-stroke-css', plugins_url('../assets/css/pe-icon-7-stroke.css', __FILE__));
			
		}
		
		function next_print_script_in_header(){
			$next_article_layout = new WINPM_Next_Article_Layout();
			$options = $next_article_layout->sblog_get_options();
			$layout_style = $options->get('layout_style');
			$custom_css = $options->get('custom_css');
			$leftsidebar_width = $options->get('leftsidebar_width');			
			$pbgcolor = $options->get('pbgcolor');
			$pbghcolor = $options->get('pbghcolor');
			$pbgacolor = $options->get('pbgacolor');
			$pbgalcolor = $options->get('pbgalcolor');
			$tcolor = $options->get('tcolor');
			$thcolor = $options->get('thcolor');
			$title_size = $options->get('title_size');
			$sidebar_header_bgcolor = $options->get('sidebar_header_bgcolor');
			$sidebar_header_tcolor = $options->get('sidebar_header_tcolor');
			$hide_selector = $options->get('hide_selector');
			$after_content_align = $options->get('after_content_align');
			$slider_position = $options->get('slider_position');		
			
			ob_start();?>
			<style type="text/css">
				<?php if($custom_css){echo $custom_css;}
				if($hide_selector){
					$exp = explode(',',$hide_selector);
					for($p = 0;$p<count($exp);$p++){?>
				.svc_infinite_container.svc_next_artical_div <?php echo $exp[$p];?>{display:none; !important;}
				<?php }
				}?>
			</style>
			<?php
			$p = ob_get_clean();
			echo $p;
		}
		
		function next_print_script_in_footer(){
			$next_article_layout = new WINPM_Next_Article_Layout();
			$options = $next_article_layout->sblog_get_options();
			$user_id = get_the_author_meta('ID');
			$current_post_type = get_post_type();
			$after_content = '';

			global $post;
			$svc_next_disable = get_post_meta( $post->ID, 'svc_next_disable', true );
			$svc_related_by = get_post_meta( $post->ID, 'svc_related_by', true );
			if($svc_next_disable == 'yes'){
				return;
			}
			$other_post_type = '';
			//infinite, bottom_slider, sidebar
			$layout_style = $options->get('layout_style');
			$post_type = $options->get('post_type');
			$related_by = $options->get('related_by');
			$feture_img = $options->get('post_thumbnail');
			$ajax_disable = $options->get('ajax_disable');
			$title_length = $options->get('title_length');
			$more_stories_text = $options->get('more_stories_text');					
			$artical_parent_selector = $options->get('artical_parent_selector');
			//$artical_parent_selector = '.column.eightcol'; .content-wrap
			$artical_selector = $options->get('artical_selector');//'.post-full.clearfix';
			//$artical_selector = '.post-full.clearfix'; .site-content.container
			$next_arrow = $options->get('next_arrow');
			$next_post_text = stripslashes_deep($options->get('next_post_text'));
			$after_content_enable = $options->get('after_content_enable');
			$after_content_padding_top = $options->get('after_content_padding_top');
			$after_content_padding_right = $options->get('after_content_padding_right');
			$after_content_padding_bottom = $options->get('after_content_padding_bottom');
			$after_content_padding_left = $options->get('after_content_padding_left');
			$after_content_bgcolor = $options->get('after_content_bgcolor');
			$after_content_margin_top = $options->get('after_content_margin_top');
			$after_content_margin_bottom = $options->get('after_content_margin_bottom');
			$next_text_color = $options->get('next_text_color');
			$next_line_color = $options->get('next_line_color');
			$next_text_size = $options->get('next_text_size');
			$on_start_callback_enable = $options->get('on_start_callback_enable');
			$on_end_callback_enable = $options->get('on_end_callback_enable');
			$call_back_end_timeout = $options->get('call_back_end_timeout');
			
			if($svc_related_by != $related_by && $svc_related_by != ''){
				$related_by = $svc_related_by;
			}
			
			if(in_array( $current_post_type, $post_type)){
				if($current_post_type != 'post'){
					$related_by = 'latest_post';
					$other_post_type = true;
				}
			}else{
				return;	
			}
			
			$main_post_id = $post->ID;
			$main_post_url = get_the_permalink($post->ID);
			$mail_post_title = get_the_title($post->ID);
			$main_img_id=get_post_meta( $main_post_id , '_thumbnail_id' ,true );
			
			$post_ids = $post_links = array();
		
		
		$post_object = get_queried_object();
		
		$term = '';
		$terms = wp_get_post_terms( $post_object->ID, 'category', array( 'fields' => 'ids' ) );
		if(count($terms) > 0){
			$term = implode(',',$terms);
		}

		$tags = wp_get_post_terms( $post_object->ID, 'post_tag', array( 'fields' => 'ids' ) );

		$post_count = $options->get('post_count');
		if($post_count > 2){
			$post_count = 2;
		}
		if($related_by == 'by_cat'){
			$args = array(
				'post__not_in' => array($main_post_id),
				'cat' => $term,
				'posts_per_page' => $post_count,
				'no_found_rows' => true,
				'suppress_filters' => true
			);
		}
		if($related_by == 'by_tags'){
			$args = array(
				'post__not_in' => array($main_post_id),
				'tag__in' => $tags,
				'posts_per_page' => $post_count,
				'no_found_rows' => true,
				'suppress_filters' => true
			);
		}		
		
		
		$my_query = new WP_Query( $args );
		if( $my_query->have_posts() ) {
			while( $my_query->have_posts() ) {
				$my_query->the_post(); 
				$svc_next_exclude = get_post_meta( get_the_ID(), 'svc_next_exclude', true );
				if($svc_next_exclude != 'yes' ){
					$post_ids[] = get_the_ID();
					$post_links[] = get_the_permalink(get_the_ID());
					$post_titles[] = get_the_title(get_the_ID());
				}
			}
		}
		wp_reset_query();
		
		
		if($options->get('after_content')){
			$after_content = do_shortcode(winpm_display_field($options->get('after_content')));
		}
		
			
			wp_enqueue_script('winpm-next-post-js', plugins_url('../assets/js/next-post-script.js', __FILE__), array("jquery"), false, false);
			if($layout_style == 'infinite'){
				$buffer_pixel = $options->get('buffer_pixel');
				wp_localize_script('winpm-next-post-js', 'winpm_next_ajax_url',
					array(
						'artical_parent_selector' => $artical_parent_selector,
						'artical_selector' => $artical_selector,
						'style' => $layout_style,
						'ids' => $post_ids,
						'links' => $post_links,
						'titles' => $post_titles,
						'first_id' => $main_post_id,
						'first_url' => $main_post_url,
						'first_title' => $mail_post_title,
						'offset' => $buffer_pixel,
						'next_arrow' => $next_arrow,
						'next_post_text' => $next_post_text,
						'after_content_enable' => $after_content_enable,
						'after_content' => esc_html( wp_unslash($after_content)),
						'on_start_callback_enable' => $on_start_callback_enable,
						'on_end_callback_enable' => $on_end_callback_enable,
						'call_back_end_timeout' => $call_back_end_timeout
					)
				);
			}
			
			ob_start();?>
            <style type="text/css">
			.svc_pre_container_after{
				margin-top:<?php echo $after_content_margin_top;?>px;
				margin-bottom:<?php echo $after_content_margin_bottom;?>px;
			}
			.svc_pre_container_after .svc_next_content{
				padding:<?php echo $after_content_padding_top;?>px <?php echo $after_content_padding_right;?>px <?php echo $after_content_padding_bottom;?>px <?php echo $after_content_padding_left;?>px;
				background:<?php echo $after_content_bgcolor;?>;
			}	
			.svc_pre_container_after .svc_next_ref{border-top: 4px solid <?php echo $next_line_color;?>;}
			.svc_pre_container_after .svc_next_ref::before{border-top: 10px solid <?php echo $next_line_color;?>;}
			.svc_pre_container_after .svc_next_ref .svc_next_txt{ color:<?php echo $next_text_color;?>; font-size:<?php echo $next_text_size;?>px; line-height:<?php echo $next_text_size;?>px;}
			
			</style>
            <?php			
			if($layout_style == 'infinite'){
				if(count($post_ids) > 0) {?>
				<input type="hidden" class="svc_next_url" value="<?php echo $post_links[0];?>">
				<input type="hidden" class="svc_next_url_set" value="<?php echo (count($post_ids) > 0) ? 1 : 0;?>">
                <?php if($on_start_callback_enable || $on_end_callback_enable){?>
                <script>
					<?php if($on_start_callback_enable){?>
						function svc_on_start_callback(){
							console.log('start_callback');
							<?php echo stripslashes($options->get('on_start_callback'));?>
						}
					<?php }
					if($on_end_callback_enable){?>
					function svc_on_end_callback(){
						console.log('end_callback');
						<?php echo stripslashes($options->get('on_end_callback'));?>
					}
					<?php }?>
				</script>
			<?php }
				}
			}
			
			$m =ob_get_clean();
			echo $m;
		}

		protected function animate_plugin_url( $path = '' ) {
			return plugins_url( ltrim( $path, '/' ), __FILE__ );
		}

		protected function plugin_root_url(){
			return get_site_url().'/wp-admin/admin.php?page=next-post';
		}
	}