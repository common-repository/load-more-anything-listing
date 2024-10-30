<?php 
/*
Plugin Name: Load More Anything Listing 
Plugin URI: https://xpertdeveloperz.com/load-more-anything-listing
Description: This plugin helps out to make any WordPress listing with load more button which having a smooth transition. Options having select how many list item show up and also with option to select list item after pressing load more button. 
Version: 1.0
Author: Xpert Developers
Author URI: https://xpertdeveloperz.com
Text Domain: https://xpertdeveloperz.com
*/


/**
* Get Scripts files 
**/
require_once('inc/lmal-scripts.php');

/**
* Add Setting Page Submenu
*/
if( !function_exists('lmal_add_submenu_page') ){
	
function lmal_add_submenu_page() {
	add_submenu_page( 
		'options-general.php', 
		'Load More Anything Listing Settings page by XpertDeveloperz', 
		'Load More Anything Listing', 
		'manage_options',  
		'lmal_setting', 
		'lmal_settings_callback' 
	);
}
}
add_action( 'admin_menu', 'lmal_add_submenu_page' );


/**
* Design Setting Page
**/
if( !function_exists('lmal_settings_callback') ){
function lmal_settings_callback(){ ?>
<div class="wrap">
<h1>Load More Anyting Listing - Xpert Developerz</h1>

<form method="post" action="options.php" id="lmal_option_form">
    <?php settings_fields( 'lmal-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'lmal-plugin-settings-group' ); ?>

	<table class="form-table">
		<tr>
			<td class="left-col">
			<!-- Wrapper One Start -->
				<div id="postimagediv" class="postbox">    
					<a class="header" >
						<span id="poststuff"> 
							<h2 class="hndle">Main Settings</h2>
						</span>
					</a>

						<div class="inside">
							<table class="form-table">
								<tr valign="top">
									<th scope="row">Load More Button Wrapper</th>
									<td>
										<input class="regular-text" type="text" name="lmal_wrapper_class" value="<?php echo esc_attr( get_option('lmal_wrapper_class') ); ?>" />
										<p>Load More Button will show inside End of this Div</p>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Load More Div</th>
									<td>
										<input class="regular-text" type="text" name="lmal_load_class" value="<?php echo esc_attr( get_option('lmal_load_class') ); ?>" />
										<p>Which Div,class,ID you want to Ajaxing?</p>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Visiable Items</th>
									<td>
										<input class="regular-text" type="number" name="lmal_item_show" value="<?php echo esc_attr( get_option('lmal_item_show') ); ?>" />
										<p>How Many Item Will Show Before Load Items?</p>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">Load Items</th>
									<td>
										<input class="regular-text" type="number" name="lmal_item_load" value="<?php echo esc_attr( get_option('lmal_item_load') ); ?>" />
										<p>How Many Item Will Load When Click Load More Button?</p>
									</td>
								</tr>
								
								
								<tr valign="top">
									<th scope="row">Pagination Class</th>
									<td>
										<input class="regular-text" type="text" name="lmal_item_pagination" value="<?php echo esc_attr( get_option('lmal_item_pagination') ); ?>" />
										<p>Pagination Class or ID as pagination will be hidden until it reach to as per above settings.</p>
									</td>
								</tr>
															
								
								
								<tr valign="top">
									<th scope="row">Load More Button Label</th>
									<td>
										<input class="regular-text" type="text" name="lmal_load_label" value="<?php echo esc_attr( get_option('lmal_load_label') ); ?>" />
										<p>Enter The Name of Load More Button</p>
									</td>
								</tr>
							</table>
						</div>
			
				</div>
				<!-- Wrapper One end -->
				


			</td>
			<td class="right-col">
				<h2>How to Use?</h2>
				
				<pre><textarea style="width:100%;min-height:600px; background:#fff;color:#000 !important;" name="asr_lmal_css_class" id="" rows="10" disabled>
For Example we have this format 

<div id="#post-list">
  <article>content</article>
  <article>content</article>
  <article>content</article>
  <article>content</article>
  ....
 
 <div class="pagination">1 2 ....</div>

</div><!-- End of Post List -->


Field: Load More Button Wrapper	
Load More Button will show inside End of that Div (For Example: #post-list)

Field: Load More Div 	
Which Div,class,ID you want to Ajaxing? It mean the content inside the main div will be populated in our case for example ( #post-list article)

Field: Visible Items	
This field take how many items show up on loading of page. (For example: 2 or 3 or 4)


Field: Load Items
This field takes value in integer mean how many item shows up after hitting the load more button. (For Example 1, 2 or any number)


Field: Pagination Class	
This field takes class name as it will auto hide/show as per above setting once reach to end it will show automatically and load more button will be hide automatically. In our case (.pagination)


Field: Load More Button Label	
Easy write up whatever you wanted to show on button text. (E,g Load More)



</textarea></pre> 


			</td>
		</tr>
	</table>
	
    <?php lmal_ajax_save_btn(); ?>
	
</form>
</div>



<?php }
}

/*
* Register settings fields to database
*/
if( !function_exists('register_lmal_plugin_settings') ){
function register_lmal_plugin_settings() {
	
	// wrapper one option data 
	register_setting( 'lmal-plugin-settings-group', 'lmal_wrapper_class' );
	register_setting( 'lmal-plugin-settings-group', 'lmal_load_class' );
	register_setting( 'lmal-plugin-settings-group', 'lmal_item_show' );
	register_setting( 'lmal-plugin-settings-group', 'lmal_item_load' );
	register_setting( 'lmal-plugin-settings-group', 'lmal_load_label' );
	register_setting( 'lmal-plugin-settings-group', 'lmal_item_pagination' );
	register_setting( 'lmal-plugin-settings-group', 'asr_lmal_css_class' );
	
	
}
}
add_action( 'admin_init', 'register_lmal_plugin_settings' );

/**
 * Adds plugin action links.
 *
 * @since 1.0.0
 * @version 4.0.0
 */
 if( !function_exists('lmal_plugin_action_links') ){
function lmal_plugin_action_links( $links ) {
	$plugin_links = array(
		'<a href="options-general.php?page=lmal_setting">' . esc_html__( 'Settings', 'lmal' ) . '</a>',
	);
	return array_merge( $plugin_links, $links );
}
 }
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'lmal_plugin_action_links' );