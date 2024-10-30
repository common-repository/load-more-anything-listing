<?php 
/*
* Scripts
*/
if( !function_exists('lmal_scripts') ){
function lmal_scripts(){
	//wp_enqueue_style('lmal-stylesheet', plugin_dir_url(__FILE__).'inc/css/lmal-main.css',array(),'1.0');	
	wp_enqueue_script('jquery');
}
}

add_action('init','lmal_scripts');



/*
* Custom CSS script
*/

if( !function_exists('lmal_custom_style') ){
function lmal_custom_style(){?>
	<style type="text/css"> 
		<?php 
		if(!empty(get_option('lmal_load_class'))){
			echo esc_attr( get_option('lmal_load_class') );
		} 
		if(!empty(get_option('lmal_load_classa'))){
			echo ','.esc_attr( get_option('lmal_load_classa') );
		} 
		if(!empty(get_option('lmal_load_classb'))){
			echo ','.esc_attr( get_option('lmal_load_classb') );
		} 
		if(!empty(get_option('lmal_load_classc'))){
			echo ','.esc_attr( get_option('lmal_load_classc') );
		} 
		if(!empty(get_option('lmal_load_classd'))){
			echo ','.esc_attr( get_option('lmal_load_classd') );
		} 		
		?>{
			display: none;
		}
		<?php if(empty(get_option('lmal_css_class'))){ ?>
		.btn.loadMoreBtn {
			color: #333333;
			text-align: center;
		}

		.btn.loadMoreBtn:hover {
		  text-decoration: none;
		}
		<?php } else{
			echo esc_attr( get_option('lmal_css_class') );
		} ?>
	</style>
<?php }

}

add_action('wp_head','lmal_custom_style');

/*
* Admin Scripts for form Design
*/
if( !function_exists('lmal_admin_style') ){
function lmal_admin_style(){?>
	<style type="text/css"> 
		@media(min-width:960px){
			.left-col{			
				width:60%;
			}
			.right-col{			
				width:40%;
			}
			td.right-col{
				vertical-align:top;
			}
		}
		.successModal {
			display: inline-block;
		}
		<?php if(empty(get_option('lmal_css_class'))){ ?>
		.btn.loadMoreBtn {
			color: #333333;
			text-align: center;
		}

		.btn.loadMoreBtn:hover {
		  text-decoration: none;
		}
		<?php } else{
			echo esc_attr( get_option('lmal_css_class') );
		} ?>
	</style>
<?php }
}

add_action('admin_head','lmal_admin_style');

/*
* Ajax option Saving
*/
if( !function_exists('lmal_ajax_save_btn') ){
	function lmal_ajax_save_btn(){ ?>
	<?php submit_button(); ?>
	<div id="saveResult"></div>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#lmal_option_form').submit(function() {
				jQuery(this).ajaxSubmit({
					success: function() {
						jQuery('#saveResult').html("<div id='saveMessage' class='successModal'></div>");
						jQuery('#saveMessage').append("<p><?php echo htmlentities(__('Settings Saved Successfully','wp'),ENT_QUOTES); ?></p>").show();
					},
					beforeSend: function() {
						jQuery('#saveResult').html("<div id='saveMessage' class='successModal'><span class='is-active spinner'></span></div>");
					},
					timeout: 10000
				});
								

				return false;
			});
		});
	</script>
<?php }
}

if( !function_exists('lmal_custom_code') ){
function lmal_custom_code(){?>
	<script type="text/javascript"> 
		(function($) {
			'use strict';

			jQuery(document).ready(function() {
				//wrapper zero
				<?php if(!empty(get_option('lmal_wrapper_class'))):?>
					$("<?php echo esc_attr( get_option('lmal_wrapper_class') ); ?>").append('<a href="#" class="btn loadMoreBtn" id="loadMore"><?php echo esc_attr( get_option('lmal_load_label') ); ?></a>');
					
					$("<?php echo esc_attr( get_option('lmal_load_class') ); ?>").slice(0, <?php echo esc_attr( get_option('lmal_item_show') ); ?>).show();
$("<?php echo esc_attr( get_option('lmal_item_pagination') ); ?>").fadeOut('slow');				
				
			
					$("#loadMore").on('click', function (e) {
						e.preventDefault();
						$("<?php echo esc_attr( get_option('lmal_load_class') ); ?>:hidden").slice(0, <?php echo esc_attr( get_option('lmal_item_load') ); ?>).slideDown();
						if ($("<?php echo esc_attr( get_option('lmal_load_class') ); ?>:hidden").length == 0) {
							$("#loadMore").fadeOut('slow');
							$("<?php echo esc_attr( get_option('lmal_item_pagination') ); ?>").show();	
						}
					});
				<?php endif;?>
				// end wrapper 1

			});

		})(jQuery);
	</script>
<style>
	.btn.loadMoreBtn {
    color: #333333;
    text-align: center;
    background: #ffffff;
    padding: 12px 15px;
    margin: 0 auto;
    display: block;
    max-width: 250px;
    border: 1px solid #8d46ff;
}

.btn.loadMoreBtn:hover {
   text-decoration: none;
   background:#000;
   color:#fff;
   border: 1px solid #000;
}
<</style>

<?php } 
}

add_action('wp_footer','lmal_custom_code');