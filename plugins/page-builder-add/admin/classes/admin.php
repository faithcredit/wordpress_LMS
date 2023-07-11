<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class ULPB_AdminClass {

	function __construct(){

		$this->_init();
		$this->_hooks();
		$this->_filters();

	}

	function _init(){
		global $pagenow;

		add_action( 'admin_enqueue_scripts', array( $this, 'pluginOps_db_updater_load_scripts' ) );

		if ( 'plugins.php' === $pagenow ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'POPB_feedback_load_scripts' ) );
			add_action( 'admin_footer', array( $this, 'POPB_deactivation_feedback_form' ) );
		}
		
		add_filter( 'wp_check_filetype_and_ext', array($this,'update_mime_types'), 10, 3 );
		if (isset($_GET['page'])) {
			if ($pagenow == 'edit.php' && $_GET['page'] == 'page-builder-new-landing-page') {
				add_filter( 'upload_mimes', array($this,'allow_custom_fonts_to_upload') );
			}
		}
		
	}

	function _hooks(){
		
		
		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts' ));

		add_action('edit_form_after_title' ,array( $this, 'wssf_custom_UI_without_metabox' ));

		add_action('admin_print_scripts', array($this,'ulpb_disable_autosave_cpt') );

		$perm_structure = get_option( 'permalink_structure' );

		$ulpb_new_user_perm = get_option( 'ulpb_new_user_perm' );

		if ( $perm_structure == "/%postname%/") {
			add_action( 'pre_get_posts', array($this,'pbp_custom_parse_request_tricksy'),11 );
			add_filter( 'post_type_link', array($this,'pbp_custom_remove_cpt_slug'), 10, 3 );
			add_action( 'init', array( $this, 'ulpb_register_page_builder_post_types' ) );
		}else{
			add_action( 'init', array( $this, 'ulpb_register_page_builder_post_types_with_landingpage' ) );
		}

		
		
		add_filter( 'hidden_meta_boxes',array($this,'remove_meta_boxes_all'),10, 3 );

		
		add_filter('template_redirect', array($this,'replace_default_front_page') );

		add_filter('manage_ulpb_post_posts_columns', array($this,'ulpb_columns_admin') );

		add_action('manage_ulpb_post_posts_custom_column',array($this,'ulpb_column_visitors_data'),10, 2);
		add_action('manage_ulpb_post_posts_custom_column',array($this,'ulpb_front_page_column'),10, 2);
		

		add_action('admin_menu',array($this,'ulpb_menupages_add') );

		add_action( 'admin_footer', array( $this, 'custom_UI_for_pages' ) );

		add_action('admin_enqueue_scripts', array($this, 'custom_UI_for_pages_script') );

		add_shortcode( 'pb_samlple_nav', array($this,'pb_shortcode_sample_nav'
		) );


		add_action('get_header', array($this, 'enable_coming_soon_mode') );

		add_action( 'admin_init', array($this,'add_landing_pages_to_pages_dropdown'));
		

		$landingPageSafeModeFeature = get_option( 'landingPageSafeModeFeature', false );
		if ($landingPageSafeModeFeature == 'enabled') {
			# code...
		}else{
			add_action( 'admin_enqueue_scripts', array( $this, 'deregister_unwanted_forced_scripts' ), 9999);
		}


		$landingpageTempalteIncludeType = get_option( 'landingpageTempalteIncludeType', false );
		
		if ($landingpageTempalteIncludeType == 'singleTemplate') {
			add_filter( 'single_template', array( $this,'ulpb_main_landingpage_html_template'), 999 );
		}else{
			add_filter( 'template_include', array( $this,'ulpb_main_landingpage_html_template'), 999 );
		}
		
		

	}

	function _filters(){
		global $pagenow;
		if ( 'post.php' !== $pagenow ) {
			add_filter('the_content',array($this,'ulpb_pagebuilder_content_filter'), 25 );
		}

		add_filter( 'template_include', array($this,'ulpb_pagebuilder_replace_default_page_template') );

		add_filter('display_post_states', array($this, 'add_pluginOps_post_state_to_table'), 10, 2);
	}


	function add_pluginOps_post_state_to_table($post_states, $post){
		
		$is_pluginops_active_on_post = get_post_meta( $post->ID, 'ulpb_page_builder_active', true );

		if ($is_pluginops_active_on_post == "true") {
			$post_states['pluginops'] = __( 'PluginOps', 'pluginops' );
		}

		return $post_states;
	}



	function allow_custom_fonts_to_upload($mimes){
	    $mimes['woff']  = 'application/x-font-woff';
	    $mimes['woff2'] = 'application/x-font-woff2';
	    $mimes['ttf']   = 'application/x-font-ttf';
	    $mimes['svg']   = 'image/svg+xml';
	    $mimes['eot']   = 'application/vnd.ms-fontobject';
	    $mimes['otf']   = 'font/otf';

	    return $mimes;
	}




	function update_mime_types( $defaults, $file, $filename ) {

		if ( 'ttf' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
			$defaults['type'] = 'application/x-font-ttf';
			$defaults['ext']  = 'ttf';
		}

		if ( 'otf' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
			$defaults['type'] = 'application/x-font-otf';
			$defaults['ext']  = 'otf';
		}

		if ( 'svg' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
			$defaults['type'] = 'image/svg+xml';
			$defaults['ext']  = 'svg';
		}

		if ( 'woff' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
			$defaults['type'] = 'application/x-font-woff';
			$defaults['ext']  = 'woff';
		}

		if ( 'woff2' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
			$defaults['type'] = 'application/x-font-woff2';
			$defaults['ext']  = 'woff2';
		}

		if ( 'eot' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
			$defaults['type'] = 'application/vnd.ms-fontobject';
			$defaults['ext']  = 'eot';
		}

		return $defaults;

    }



	function add_landing_pages_to_pages_dropdown(){

		function add_pluginOpsLandingPagesToSettingsPagesDropdown( $pages ){
		    $args = array(
		    	'numberposts'      => 10,
		        'post_type' => 'ulpb_post'
		    );
		    $items = get_posts($args);
		    $pages = array_merge($pages, $items);

		    return $pages;
		}

		$screen_id = get_current_screen();
		add_filter( 'get_pages', 'add_pluginOpsLandingPagesToSettingsPagesDropdown' );
		
	}

	function enable_coming_soon_mode() {
 
      if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
      		$landingPageAsComingSoonPage = get_option( 'landingPageAsComingSoonPage', false );
      		if ($landingPageAsComingSoonPage) {
      			if (!empty($landingPageAsComingSoonPage) && $landingPageAsComingSoonPage != '' && $landingPageAsComingSoonPage != 'none' ) {
      				$selectedComingSoonPage = get_page_link($landingPageAsComingSoonPage);
      				$lp_coming_soon_status = get_post_status($landingPageAsComingSoonPage);
      				
      				if ($lp_coming_soon_status == 'publish') {
      					wp_redirect($selectedComingSoonPage);
      					exit();
      				}
      				
      			}
      		}
  	  }
 
	}
	


	function POPB_feedback_load_scripts() {
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_script( 'POPB_Send_feedback',ULPB_PLUGIN_URL.'/js/get-feedback.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-dialog' ), false, true );
		wp_localize_script( 'POPB_Send_feedback', 'POPB_feedback_URL',array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) ) );
	}

	function pluginOps_db_updater_load_scripts(){

		$POPB_data_nonce = wp_create_nonce( 'POPB_data_nonce_imageLib_reset' );
    	$request_url = esc_attr(admin_url('admin-ajax.php'))."?action=popb_update_databaseUrls_imageLib&POPB_nonce=".$POPB_data_nonce;

		wp_enqueue_script('pluginops_db_update_img_lib', ULPB_PLUGIN_URL.'/js/pluginops-updater-req.js', array('jquery'),false, true);
		wp_localize_script( 'pluginops_db_update_img_lib', 'db_updater_req_url',array( 'admin_ajax' => $request_url ) );
	}


	function POPB_deactivation_feedback_form() {
		/*
			Code Snippet from POST SMTP : https://wordpress.org/plugins/post-smtp/
			License : GPL V2
		*/
			$pb_current_user = wp_get_current_user(); 
		?>
		<div id="POPB_feedback_form_container" style="display: none;">
			<p>
				<b>It is really sad to see you leaving. 😢 <br>
				I would love to get a small feedback from you. </b>
			</p>
			<form>
				<?php wp_nonce_field(); ?>
				<ul id="POPB-deactivate-reasons">

					<li class="POPB-reason">
						<label>
							<span><input value="Plugin is not good" type="radio" name="reason" checked="checked" /></span>
							<span>Plugin is not good</span>
						</label>					
					</li>
					<li class="POPB-reason">
						<label>
							<span><input value="bad support" type="radio" name="reason" /></span>
							<span>Bad Support</span>
						</label>					
					</li>
					<li class="POPB-reason POPB-custom-input">
						<label>
							<span><input value="Found a better plugin" type="radio" name="reason" /></span>
							<span>Found a better plugin</span>
						</label>
					</li>
					<li class="POPB-reason POPB-custom-input">
						<label>
							<span><input value="The plugin didn't work" type="radio" name="reason" /></span>
							<span>The plugin didn't work</span>
						</label>	
					</li>
					<li class="POPB-reason">
						<label>
							<span><input value="Temporary Deactivation" type="radio" name="reason" /></span>
							<span>Temporary</span>
						</label>					
					</li>
					<li class="POPB-reason POPB-custom-input">
						<label>
							<span><input value="Other Reason" type="radio" name="reason" /></span>
							<span>Other Reason</span>
						</label>
					</li>
					<li class="POPB-reason POPB-support-input">
						<label>
							<span><input value="Support Ticket" type="radio" name="reason" /></span>
							<span>Open A support ticket for me</span>
						</label>
						<div class="POPB-reason-input" style="display: none;">
							<input type="email" name="support[email]" placeholder="Your Email Address" required>
							<input type="text" name="support[title]" placeholder="The Title" required>
							<textarea name="support[text]" placeholder="Describe the issue" required></textarea>
						</div>
					</li>
					<li class="POPB-reason">
						<label>
							<span><input type="checkbox" value="<?php echo($pb_current_user->user_email) ?>" name="followUpEmail"  checked /></span>
							<span>Share your email address. (We can get in touch with you to fix this)</span>
						</label>
					</li>															
				</ul>
				<div class="POPB-reason-input" style="display: none;">
					<input type="text" class="regular-text" name="other_input" placeholder="Do you mind help and give more details ?">
				</div>				
			</form>
		</div>
		<style type="text/css">
			.POPB_feedback_form_form .ui-dialog-buttonset {
				float: none !important;
			}

			#POPB_feedback_form_go {
				float: left;
			}

			#POPB_feedback_form_skip, #POPB_feedback_form_cancel {
				float: right;
			}

			#POPB_feedback_form_container p {
				font-size: 1.1em;
			}

			.POPB-reason-input textarea {
				margin-top: 10px;
				width: 100%;
				height: 150px;
			}

			.POPB_feedback_form_form .ui-icon {
				display: none;
			}

			#POPB_feedback_form_go.POPB-ajax-progress .ui-icon {
				text-indent: inherit;
				display: inline-block !important;
				vertical-align: middle;
				animation: rotate 2s infinite linear;
			}

			#POPB_feedback_form_go.POPB-ajax-progress .ui-button-text {
				vertical-align: middle;
			}			

			@keyframes rotate {
			  0%    { transform: rotate(0deg); -ms-transform: rotate(0deg); -webkit-transform: rotate(0deg); }
			  100%  { transform: rotate(360deg); -ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); }
			}			
		</style>
	<?php
	}


function ulpb_register_page_builder_post_types() {


	$labels_one = array(
		'name'                => __( 'Landing Pages', 'page-builder-add' ),
		'singular_name'       => __( 'Landing Page', 'page-builder-add' ),
		'all_items'       	  => __( 'Landing Pages', 'page-builder-add' ),
		'add_new'             => _x( 'Add New Page', 'page-builder-add', 'page-builder-add' ),
		'add_new_item'        => __( 'Add New Page', 'page-builder-add' ),
		'edit_item'           => __( 'Edit Page', 'page-builder-add' ),
		'new_item'            => __( 'New Page', 'page-builder-add' ),
		'view_item'           => __( 'View Page', 'page-builder-add' ),
		'search_items'        => __( 'Search Pages', 'page-builder-add' ),
		'not_found'           => __( 'No Pages found', 'page-builder-add' ),
		'not_found_in_trash'  => __( 'No Pages found in Trash', 'page-builder-add' ),
		'parent_item_colon'   => __( 'Parent Page:', 'page-builder-add' ),
		'menu_name'           => __( 'Landing Pages By PluginOps', 'page-builder-add' ),
	);

	$args_one = array(
		'labels'              => $labels_one,
		'hierarchical'        => false,
		'description'         => 'Add Pages',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => ULPB_PLUGIN_URL.'/images/dashboard/page-builder-templates-icon.png',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title','revisions','thumbnail','page-attributes','common'
			)
	);

	register_post_type( 'ulpb_post', $args_one );

	$args = array(
    	'public'   => true,
	);
	$output = 'objects';
	$taxonomies = get_taxonomies( $args, $output );
	foreach  ( $taxonomies as $taxonomy ) {

		if ($taxonomy->name == 'category' || $taxonomy->name == 'post_tag' || $taxonomy->name == 'post_format') {
			register_taxonomy_for_object_type( $taxonomy->name, 'ulpb_post' );
		}else{
			unregister_taxonomy_for_object_type( $taxonomy->name, 'ulpb_post' );
		}
	    
	}


	register_taxonomy_for_object_type( 'category', 'ulpb_post' );

	register_taxonomy_for_object_type( 'post_tag', 'ulpb_post' );

	register_taxonomy_for_object_type( 'post_format', 'ulpb_post' );

	if (! get_option( 'cpt_reset_ulpb_pluginops', $default = false ) ) {
		add_option( 'cpt_reset_ulpb_pluginops', $value = true );
		flush_rewrite_rules( $hard = true );
	}

}


function ulpb_register_page_builder_post_types_with_landingpage() {


	$popbLandingpageUrlKeyword = get_option( 'popbLandingpageUrlKeyword', false );

	if (!isset($popbLandingpageUrlKeyword)) {
		$popbLandingpageUrlKeyword = 'landingpage';
	}

	if ($popbLandingpageUrlKeyword == '') {
		$popbLandingpageUrlKeyword = 'landingpage';
	}

	$labels_one = array(
		'name'                => __( 'Landing Pages', 'page-builder-add' ),
		'singular_name'       => __( 'Landing Page', 'page-builder-add' ),
		'all_items'       	  => __( 'Landing Pages', 'page-builder-add' ),
		'add_new'             => _x( 'Add New Page', 'page-builder-add', 'page-builder-add' ),
		'add_new_item'        => __( 'Add New Page', 'page-builder-add' ),
		'edit_item'           => __( 'Edit Page', 'page-builder-add' ),
		'new_item'            => __( 'New Page', 'page-builder-add' ),
		'view_item'           => __( 'View Page', 'page-builder-add' ),
		'search_items'        => __( 'Search Pages', 'page-builder-add' ),
		'not_found'           => __( 'No Pages found', 'page-builder-add' ),
		'not_found_in_trash'  => __( 'No Pages found in Trash', 'page-builder-add' ),
		'parent_item_colon'   => __( 'Parent Page:', 'page-builder-add' ),
		'menu_name'           => __( 'Landing Pages By PluginOps', 'page-builder-add' ),
	);

	$args_one = array(
		'labels'              => $labels_one,
		'hierarchical'        => false,
		'description'         => 'Add Pages',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => ULPB_PLUGIN_URL.'/images/dashboard/page-builder-templates-icon.png',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite' 			  => array('slug' => $popbLandingpageUrlKeyword),
		'capability_type'     => 'post',
		'supports'            => array(
			'title','revisions','thumbnail','page-attributes','common'
			)
	);

	register_post_type( 'ulpb_post', $args_one );

	$args = array(
    	'public'   => true,
	);
	$output = 'objects';
	$taxonomies = get_taxonomies( $args, $output );
	foreach  ( $taxonomies as $taxonomy ) {
	    register_taxonomy_for_object_type( $taxonomy->name, 'ulpb_post' );
	}

	if (! get_option( 'cpt_reset_ulpb_pluginops', $default = false ) ) {
		add_option( 'cpt_reset_ulpb_pluginops', $value = true );
		flush_rewrite_rules( $hard = true );
	}
}


function ulpb_disable_autosave_cpt(){
    global $post;
    global $pagenow;

    if ('post.php' == $pagenow || 'post-new.php' == $pagenow) {
    	
    
	    if(get_post_type($post->ID) === 'ulpb_post'){
	        wp_deregister_script('autosave');
	    }

	    $selectedPostTypes = get_option( 'page_builder_SupportedPostTypes' );

		if (!is_array($selectedPostTypes)) {
			$selectedPostTypes = array();
		}
		
		if (in_array($post->post_type , $selectedPostTypes, false) ) {

			$ispbactive = get_post_meta( $post->id, 'ulpb_page_builder_active', false );

			if ($ispbactive == true) {
				wp_deregister_script('autosave');
			}
			
		}

	}
}

function pbp_custom_remove_cpt_slug( $post_link, $post, $leavename ) {
 
    if ( 'ulpb_post' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }
 
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
 
    return $post_link;
}

function pbp_custom_parse_request_tricksy( $query ) {
 
    if ( ! $query->is_main_query() )
        return;
 
    if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }
 	
 	
    $postType_array =  array( 'post', 'ulpb_post', 'page', 'e-landing-page' );

    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', $postType_array );
    }
}


function load_admin_scripts( ) {

	global $wp_version;


	$screen_id = get_current_screen();

	$screenIDsToShow = array('ulpb_post','ulpb_global_rows');

	$POPB_data_nonce = wp_create_nonce( 'POPB_data_nonce' );

	$thisPostID = get_the_ID();

	if ( isset($_GET['thisPostID']) ) {
		$thisPostID = sanitize_text_field( esc_attr( $_GET['thisPostID'] ) );
	}



	if ($screen_id->id == 'ulpb_post_page_page-builder-new-landing-page') {
	
		if (in_array($screen_id->post_type  , $screenIDsToShow, false) ){


			$isPremActive = 'false';
			if ( function_exists('ulpb_available_pro_widgets') ) {
				$isPremActive = 'true';
			}

			$plugData = get_plugin_data(ULPB_PLUGIN_PATH.'/page-builder-add.php',false,true);

			if (!isset($plugData['Version'])) {
				$plugData['Version'] = '1.4.7.9';
			}

			$popbVersion = $plugData['Version'];

			if (isset( $_GET['thisPostType'] )) {
			  $thisPostType = sanitize_text_field( esc_attr($_GET['thisPostType']) );
			}else{
			  $thisPostType = get_post_type($thisPostID);
			}


			$pb_current_user = wp_get_current_user();


			
			wp_enqueue_script('jquery');

			wp_enqueue_script( 'jquery-ui-core' );

			wp_enqueue_script( 'jquery-ui-tooltip' );

			wp_enqueue_script( 'jquery-ui-slider' );

			wp_enqueue_script( 'jquery-ui-accordion' );

			wp_enqueue_script( 'jquery-ui-datepicker' );

			wp_enqueue_script( 'jquery-ui-button' );

			wp_enqueue_script( 'jquery-ui-tabs' );

			wp_enqueue_script( 'jquery-ui-draggable' );

			wp_enqueue_script( 'jquery-ui-resizable' );

			wp_enqueue_script( 'jquery-ui-droppable' );

			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_enqueue_script( 'jquery-ui-progressbar' );

			wp_enqueue_script( 'jquery-effects-core' );

			wp_enqueue_script( 'jquery-effects-shake' );

			wp_enqueue_script( 'media-upload');

			wp_enqueue_script( 'underscore');

			wp_enqueue_script( 'backbone');


			if (function_exists('wp_enqueue_editor')) {
				wp_enqueue_editor();
			}

			if (function_exists('wp_enqueue_media')) {
				wp_enqueue_media();
			}



			wp_register_script( 'popb_landingPage_initjs', ULPB_PLUGIN_URL.'/admin/scripts/init.js', array( ), false, false );

			wp_localize_script(
				'popb_landingPage_initjs',
				'popb_admin_vars_data',
				array(
					'page_ajax_url' => esc_attr(admin_url('admin-ajax.php')),
					'pluginops_nonce' => $POPB_data_nonce,
					'post_id' => $thisPostID,
					'isPremActive' => $isPremActive,
					'plugin_url' => ULPB_PLUGIN_URL,
					'plugin_version' => $plugData['Version'],
					'admin_url' => admin_url(),
					'site_url' => site_url(),
					'post_status' => get_post_status($thisPostID),
					'post_type' => $thisPostType,
					'user_email' => $pb_current_user->user_email,
					'templateLibActive' => 'true',
					'templateLibURL' => ULPB_PLUGIN_URL
				)
			);

			wp_enqueue_script( 'popb_landingPage_initjs' );

			$popb_pluginops_custom_fonts = get_option( 'popb_pluginops_custom_fonts', false );

			wp_register_script( 'popb_ajax_requests', ULPB_PLUGIN_URL.'/admin/scripts/ajax/ajax-requests.js', array( 'jquery' ), $popbVersion, false );

			wp_localize_script(
				'popb_ajax_requests',
				'popb_admin_url_data',
				array( 
					'page_ajax_url' => esc_attr(admin_url('admin-ajax.php')),
					'pluginops_nonce' => $POPB_data_nonce,
					'post_id' => $thisPostID,
					'customFonts' => $popb_pluginops_custom_fonts,
				)
			);

			wp_enqueue_script( 'popb_ajax_requests' );


			if (floatval($wp_version) < floatval('5.6') ) {
				wp_enqueue_script( 'popb-ui-checkbox', ULPB_PLUGIN_URL.'/js/Backbone-resources/checkbox.js', array(  ), false, true );
			}

			wp_enqueue_script( 'popb-builder-customUndo-script', ULPB_PLUGIN_URL.'/admin/scripts/undo-redo.js', array(), $popbVersion, true );


			wp_enqueue_script( 'wssf-backbone-builder-renderPageOps', ULPB_PLUGIN_URL.'/admin/scripts/renderPageOps.js', array(), $popbVersion, true );

			

			wp_enqueue_script( 'wssf-backbone-builder-collectionView', ULPB_PLUGIN_URL.'/js/Backbone-resources/backbone.collectionView.js', array(), $popbVersion, true );

			

			wp_enqueue_script( 'wssf-backbone-builder-pbb-model-1', ULPB_PLUGIN_URL.'/admin/scripts/pbb-model-1.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-pbb-model-2', ULPB_PLUGIN_URL.'/admin/scripts/pbb-model-2.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-script-bb3', ULPB_PLUGIN_URL.'/admin/scripts/bb3.js', array(), $popbVersion, true );

			

			wp_enqueue_script( 'wssf-backbone-builder-script-widget-render', ULPB_PLUGIN_URL.'/admin/scripts/widget-render.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-script-row-view', ULPB_PLUGIN_URL.'/admin/scripts/row-view.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-script-widget-view', ULPB_PLUGIN_URL.'/admin/scripts/widget-view.js', array(), $popbVersion, true );

			
			
			wp_localize_script( 'wssf-backbone-builder-script-widget-view', 'widgetViewLinks',array( 'templatesFolder' => ULPB_PLUGIN_URL.'/admin/scripts/templates/', 'pluginsUrl' => ULPB_PLUGIN_URL ) );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-script-save-page', ULPB_PLUGIN_URL.'/admin/scripts/save-page.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-script-new-row', ULPB_PLUGIN_URL.'/admin/scripts/new-row.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-script-side-panel', ULPB_PLUGIN_URL.'/admin/scripts/side-panel.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'popb_row_blocks', ULPB_PLUGIN_URL.'/admin/scripts/blocks/row-blocks.js', array( 'jquery' ), $popbVersion, true );

			

			wp_enqueue_script( 'wssf-backbone-builder-script-bb4', ULPB_PLUGIN_URL.'/admin/scripts/bb4.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-script_collectionView', ULPB_PLUGIN_URL.'/admin/scripts/pbb-CollectionView.js', array(), $popbVersion, true );

			
			
			wp_enqueue_script( 'wssf-backbone-builder-script-pbb-drag-n-drop', ULPB_PLUGIN_URL.'/admin/scripts/pbb-drag-n-drop.js', array(), $popbVersion, true );

			
			
			wp_enqueue_style( 'wssf-backbone-builder-jqueryUI-style', ULPB_PLUGIN_URL.'/js/Backbone-resources/jquery-ui.css' );

			
			
			wp_enqueue_style( 'wssf-adminUI-styling', ULPB_PLUGIN_URL.'/styles/admin-style.css', array(), $popbVersion );

			
			
			wp_enqueue_style( 'wssf-adminUI-animations', ULPB_PLUGIN_URL.'/public/templates/animate.min.css' );

			

			wp_enqueue_style( 'wssf-iris-picker-style', ULPB_PLUGIN_URL.'/js/color/spectrum.css' );

			
		   
		    wp_enqueue_script( 'wssf-color-picker-script', ULPB_PLUGIN_URL.'/js/color/alpha-picker.js', array(), $popbVersion, true );

		    

		    wp_enqueue_script( 'wssf-imgUpload-script', ULPB_PLUGIN_URL.'/js/image-upload.js', array(), $popbVersion, true );

		    
		   
		   	wp_enqueue_script( 'wssf-faIconPicker-script', ULPB_PLUGIN_URL.'/js/fontawesome-iconpicker.min.js', array(), $popbVersion, true );

		   	
		    
		    wp_enqueue_style( 'wssf-faIconPicker-styling', ULPB_PLUGIN_URL.'/js/fontawesome-iconpicker.min.css' );

		    

		    wp_enqueue_script( 'wssf-countdown-script', ULPB_PLUGIN_URL.'/js/countdown.js', array(), false, true );

		    

		    wp_enqueue_script( 'ulpb-countdowntimezone-script', ULPB_PLUGIN_URL.'/js/moment.min.js', array(), false, true );

		    
		    
		    wp_enqueue_script( 'ulpb-countdowntzdata-script', ULPB_PLUGIN_URL.'/js/moment-timezone-with-data-2010-2020.min.js', array(), false , true );

		    
		    
		    wp_enqueue_script( 'wssf-imageSliderWidget-script', ULPB_PLUGIN_URL.'/js/slider.min.js', array(), false, true );

		    

		    wp_enqueue_script( 'wssf-imageGalleryMasonry-script', ULPB_PLUGIN_URL.'/js/masonry.pkgd.min.js', array(), false, true );

		    

		    wp_enqueue_script( 'wssf-carousel-script', ULPB_PLUGIN_URL.'/public/scripts/owl-carousel/owl.carousel.js', array(), false, true );

		    
		    
		    wp_enqueue_style( 'wssf-carousel-styling', ULPB_PLUGIN_URL.'/public/scripts/owl-carousel/owl.carousel.css' );

		    
		    
		    wp_enqueue_style( 'wssf-carousel-theme', ULPB_PLUGIN_URL.'/public/scripts/owl-carousel/owl.theme.css' );

		    
		    
		    wp_enqueue_style( 'wssf-carousel-transitions', ULPB_PLUGIN_URL.'/public/scripts/owl-carousel/owl.transitions.css' );

		    

		    wp_enqueue_script( 'ulpb-font-picker', ULPB_PLUGIN_URL.'/js/font-picker.js', array(), false, true );

		    

		    wp_enqueue_script( 'ppb_pl_formDatabase_extension_script_enqueue', ULPB_PLUGIN_URL.'/integrations/form-builder-database'.'/table.js', array( 'jquery' ), false, true );

		    

		    wp_enqueue_script( 'popb_fajs', ULPB_PLUGIN_URL.'/js/fa.js', array( 'jquery' ), false, true );

		    

		    wp_enqueue_style( 'ppb_pl_wooStylescss', ULPB_PLUGIN_URL.'/styles/wooStyles.css' );

		    

		}

	}

	

	if ($screen_id->id == 'ulpb_post_page_page-builder-ulpb-form-submissions') {

		wp_enqueue_script('jquery');

		wp_enqueue_script( 'jquery-ui-core' );

		wp_enqueue_script( 'jquery-ui-tooltip' );

		wp_enqueue_script( 'jquery-ui-slider' );

		wp_enqueue_script( 'jquery-ui-accordion' );

		wp_enqueue_script( 'jquery-ui-effects' );

		wp_enqueue_script( 'ppb_pl_formDatabase_extension_script_enqueue', ULPB_PLUGIN_URL.'/integrations/form-builder-database'.'/table.js', array( 'jquery' ), false, true );

		wp_enqueue_style( 'wssf-adminUI-styling', ULPB_PLUGIN_URL.'/styles/admin-style.css' );

		wp_enqueue_style( 'wssf-backbone-builder-jqueryUI-style', ULPB_PLUGIN_URL.'/js/Backbone-resources/jquery-ui.css' );

		wp_register_script( 'ppb_formSubmissonssAjaxScript', ULPB_PLUGIN_URL.'/admin/scripts/ajax/form-submissions-ajax.js', array( 'jquery' ), false, true );

		wp_localize_script(
			'ppb_formSubmissonssAjaxScript',
			'popb_admin_url_data',
			array( 
				'form_subbmissions_page' => admin_url().'edit.php?post_type=ulpb_post&page=page-builder-ulpb-form-submissions',
				'form_submissions_ajax_url' => admin_url('admin-ajax.php'),
				'pluginops_nonce' => $POPB_data_nonce
			)
		);

		wp_enqueue_script( 'ppb_formSubmissonssAjaxScript' );

	}


	wp_register_script( 'ulpbExt_menu_old_forms_enqueue', ULPB_PLUGIN_URL.'/js/menu.js', array( 'jquery' ), false, true );

	if (  is_plugin_active( 'PluginOps-Extensions-Pack/extension-pack.php' ) ) {
	  	$smfb_extension_pack_active = 'true';
	}else{
		$smfb_extension_pack_active = 'false';
	}

	wp_localize_script( 'ulpbExt_menu_old_forms_enqueue', 'ulpb_oldf_site_url',  array( 'siteurl' => admin_url().'edit.php?post_type=subscribe_me_forms', 'premActive'=> $smfb_extension_pack_active, 'newformsurl' => admin_url().'edit.php?post_type=ulpb_post', ) );

	wp_enqueue_script( 'ulpbExt_menu_old_forms_enqueue' );

}



function deregister_unwanted_forced_scripts(){

	global $wp_scripts;
 	global $wp_styles;
 	global $pagenow;
	$screen_id = get_current_screen();

	if ($screen_id->id == 'ulpb_post_page_page-builder-new-landing-page') {


		$allowedScripts = array(
			'common',
			'admin-bar',
			'utils',
			'svg-painter',
			'wp-auth-check',
			'jquery',
			'jquery-ui-core',
			'jquery-ui-tooltip',
			'jquery-ui-slider',
			'jquery-ui-accordion',
			'jquery-ui-datepicker',
			'jquery-ui-button',
			'jquery-ui-tabs',
			'jquery-ui-draggable',
			'jquery-ui-resizable',
			'jquery-ui-droppable',
			'jquery-ui-sortable',
			'jquery-ui-progressbar',
			'media-upload',
			'underscore',
			'backbone',
			'popb_landingPage_initjs',
			'popb_ajax_requests',
			'popb-ui-checkbox',
			'wssf-backbone-builder-undo-script',
			'popb-builder-customUndo-script',
			'wssf-backbone-builder-collectionView',
			'wssf-backbone-builder-renderPageOps',
			'wssf-backbone-builder-pbb-model-1',
			'wssf-backbone-builder-pbb-model-2',
			'wssf-backbone-builder-script-bb3',
			'wssf-backbone-builder-script-widget-render',
			'wssf-backbone-builder-script-row-view',
			'wssf-backbone-builder-script-widget-view',
			'wssf-backbone-builder-script-save-page',
			'wssf-backbone-builder-script-new-row',
			'wssf-backbone-builder-script-side-panel',
			'wssf-backbone-builder-script-bb4',
			'wssf-backbone-builder-script_collectionView',
			'wssf-backbone-builder-script-pbb-drag-n-drop',
			'wssf-color-picker-script',
			'wssf-imgUpload-script',
			'wssf-faIconPicker-script',
			'wssf-countdown-script',
			'ulpb-countdowntimezone-script',
			'ulpb-countdowntzdata-script',
			'wssf-imageSliderWidget-script',
			'wssf-imageGalleryMasonry-script',
			'wssf-carousel-script',
			'ulpb-font-picker',
			'ulpb-pen-editor-js-script',
			'ulpbExt_menu_old_forms_enqueue',
			'ppb_pl_templates_pack_one_script_enqueue',
			'ppb_export_template_script_enqueue',
			'ppb_pl_formDatabase_extension_script_enqueue',
			'popb_fajs',
			'popb_row_blocks',
			'popbExt_menu_globalRow_enqueue',
			'ppb_pl_mailchimp_extension_script_enqueue',
			'media-editor',
			'media-audiovideo',
			'mce-view',
			'image-edit',
			'a8c_wpcom_masterbar_tracks_events',
			'a8c_wpcom_masterbar_overrides',
			'jetpack-jitm-new',
			'wpcom-notes-admin-bar',
			'wp-color-picker',
			'editor'
		);

		$allowedStyles = array(
			'admin-bar',
			'colors',
			'dashicons',
			'wp-auth-check',
			'wssf-backbone-builder-jqueryUI-style',
			'wssf-adminUI-styling',
			'wssf-adminUI-animations',
			'wssf-iris-picker-style',
			'wssf-faIconPicker-styling',
			'wssf-carousel-styling',
			'wssf-carousel-theme',
			'wssf-carousel-transitions',
			'ppb_pl_wooStylescss',
			'ulpb-pen-editor-js-style',
			'ie',
			'media-views',
			'imgareaselect',
			'a8c-wpcom-masterbar',
			'a8c-wpcom-masterbar-overrides',
			'a8c_wpcom_css_override',
			'noticons',
			'jetpack-icons',
			'jetpack-jitm-css',
			'wpcomsh-admin-style',
			'wpcom-notes-admin-bar',
			'wp-color-picker',
			'editor-buttons',
			'buttons'
		);

	 	foreach ($wp_styles->queue as $key => $value) {

	 		if ( in_array($value, $allowedStyles) ) {
	 		}else{
	 			wp_deregister_style($value);
	 		}
	 				
	 	}

	 	foreach ($wp_scripts->queue as $key => $value) {

	 		if ( in_array($value, $allowedScripts) ) {
	 		}else{
				wp_deregister_script($value);
	 		}
	 	}

	}
}

function wssf_custom_UI_without_metabox($post){
	global $post;

	$screen_id = get_current_screen();


	$selectedPostTypes = get_option( 'page_builder_SupportedPostTypes' );

	if (!is_array($selectedPostTypes)) {
		$selectedPostTypes = array();
	}
	
	if (in_array($screen_id->post_type  , $selectedPostTypes, false) ) {

		include_once(ULPB_PLUGIN_PATH.'/admin/views/admin-ui-pageType.php');

	}
	if ($screen_id->post_type === 'ulpb_post' || $screen_id->post_type === 'ulpb_global_rows'){
		include_once(ULPB_PLUGIN_PATH.'/admin/views/UI/admin-ui-redirect.php');
	}
	
} /// wssf_custom_UI_without_metabox ends here


function custom_UI_for_pages($post){
	global $post;
	$screen_id = get_current_screen();
	$selectedPostTypes = get_option( 'page_builder_SupportedPostTypes' );

	if (!is_array($selectedPostTypes)) {
		$selectedPostTypes = array('page');
	}

	if (in_array($screen_id->post_type  , $selectedPostTypes, false) ) {
		$checkPbActive = get_post_meta( $post->ID, 'ulpb_page_builder_active', true );

		$plugOps_pageBuilder_switch_nonce = wp_create_nonce( 'POPB_data_nonce' );
		?>
			<style type="text/css">
				.switch_button{
					text-decoration: none;
					background-color: #2196F3;
				    border-radius: 3px;
				    border: none;
				    padding: 10px 20px 10px 20px;
				    color: #FFF;
				    font-size: 16px;
				    float: left;
				    display: inline-block;
				    cursor: pointer;
				}
				.switch_button:hover{
					background-color: #4095d8;
				}
			</style>
			<div class="lpp_modal pb_loader_container">
			  <div class="pb_loader"></div>
			</div>
			
		<?php

		if ($checkPbActive === 'true') {
			
		}else{
			
		}
	}
	
} /// wssf_custom_UI_without_metabox ends here




function custom_UI_for_pages_script($current_page){


	global $post;

	$screen_id = get_current_screen();
	$selectedPostTypes = get_option( 'page_builder_SupportedPostTypes' );

	if( 'post-new.php' == $current_page || 'post.php' == $current_page  ) {
		
	}else{
		return;
	}

	if ($post == null) {
	//	return;
	}

	if (!is_array($selectedPostTypes)) {
		$selectedPostTypes = array('page');
	}

	if (in_array($screen_id->post_type  , $selectedPostTypes, false) ) {
		$checkPbActive = get_post_meta( $post->ID, 'ulpb_page_builder_active', true );


		$pluginOpsBuilderActiveScript = '';
		if ($checkPbActive == 'true') {
			
			$pluginOpsBuilderActiveScript = "

				setTimeout(function(){
		        	jQuery('.block-editor-block-list__layout').html(

		        		'<div style=\" margin:0 auto; max-width:600px; height:130px; background:#f3f2f2; padding-top:40px; text-align:center; \"> <div style=\" margin: 0 auto; float: unset; width: 350px; display:block; \" class=\"tab-pagebuilder switch_button\">Edit with PluginOps Page Builder</div> </div>'

		        	);
		        }, 1500);

			";

		}

		$plugOps_pageBuilder_switch_nonce = wp_create_nonce( 'POPB_data_nonce' );

		$submit_URl = admin_url('admin-ajax.php?action=ulpb_activate_pb_request&page_id='.$post->ID.'&ulpbActivate=ActivatePB').'&POPB_data_nonce='.$plugOps_pageBuilder_switch_nonce;
		$admin_url = admin_url();
		$postID = $post->ID;
		$redirectURL = admin_url()."edit.php?post_type=ulpb_post&page=page-builder-new-landing-page&thisPostID=".$post->ID."&thisPostType=".get_post_type( $post );

		wp_enqueue_script( 'switch_to_plugin_ops_script', '/main.js', array('jquery'), '1.0' );
		wp_add_inline_script('switch_to_plugin_ops_script',
			"

				(function($){
				    $(document).ready(function(){

				    	setTimeout(function(){
		            		$('.edit-post-header-toolbar').append('<div class=\"tab-pagebuilder switch_button\">Edit with PluginOps Page Builder</div>');
		            	}, 1000);

		            	setTimeout(function(){
		            		$('#wp-content-media-buttons').append('<div class=\"tab-pagebuilder switch_button\">Edit with PluginOps Page Builder</div>');
		            	}, 1000);

		            	$pluginOpsBuilderActiveScript

					    jQuery(document).on('click','.tab-pagebuilder', function(e)  {
					        var submit_URl = '$submit_URl';
					        var PBadmURL = '$admin_url';
					        var PB_ID = '$postID';
					        var result = '';
					        $.ajax({
					            url: submit_URl,
					            method: 'get',
					            data: '',
					            success: function(result){
					                if (result == 'Switched'){

					                   location.href = '$redirectURL';
					                }
					            }
					        });
					         
					        // Prevents default submission of the form after clicking on the submit button. 
					        return false;   
					    });
				    });

				})(jQuery);

			"
		);

		
	}
	
} /// wssf_custom_UI_without_metabox ends here










// Render Template
function ulpb_main_landingpage_html_template($single_template) {
	
    global $post;

    $defaultSingleTemplate = $single_template;

    $ulpb_template = ULPB_PLUGIN_PATH.'public/templates/template.php';


    if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
      	$landingPageAsComingSoonPage = get_option( 'landingPageAsComingSoonPage', false );
    	if ($landingPageAsComingSoonPage) {
    		if (isset($post->ID)) {
    			if ($landingPageAsComingSoonPage != $post->ID) {
	      			$this->enable_coming_soon_mode();
	      		}
    		}
	      		
      	}
  	}

  	
  	if ($post) {
  		if ($post->post_type == 'ulpb_post' || $post->post_type === 'ulpb_global_rows') {
	        $single_template = $ulpb_template;
	    }
  	}

  	if (is_search()) {
  		$single_template = $defaultSingleTemplate;
  	}
	  	
     
    return $single_template;
}



function remove_meta_boxes_all( $hidden, $screen, $use_defaults ){
    global $wp_meta_boxes;
    $cpt = 'ulpb_post'; // Modify this to your needs!

    if( $screen->id === 'ulpb_post_page_page-builder-new-landing-page' && isset( $wp_meta_boxes[$cpt] ) )
    {
        $tmp = array();
        foreach( (array) $wp_meta_boxes[$cpt] as $context_key => $context_item )
        {
            foreach( $context_item as $priority_key => $priority_item )
            {
                foreach( $priority_item as $metabox_key => $metabox_item )
                    $tmp[] = $metabox_key;
            }
        }
        $hidden = $tmp;  // Override the current user option here.
    }
    return $hidden;
}

/*
function add_pbp_tabs_to_dropdown( $pages ){
    $args = array(
        'post_type' => 'ulpb_post'
    );
    $items = get_posts($args);
    $pages = array_merge($pages, $items);

    return $pages;
}
*/



function replace_default_front_page() {

    $args = array(
        'offset'           => 0,
        'posts_per_page'   => 100,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'ulpb_post',
        'post_status'      => 'publish',
    );
    
    $ulpb_pages = get_posts( $args );

    if (!empty($ulpb_pages)) {
        foreach ($ulpb_pages as $post) {
            $currentID = $post->ID;
            $ulpb_is_front_page = get_post_meta( $currentID, 'ULPB_FrontPage', true );

            if ($ulpb_is_front_page === 'true') {
	            $ulpb_template_select = get_post_meta($currentID,'ULPB_FrontPage',true);
	            $ulpb_template = ULPB_PLUGIN_PATH.'public/templates/template.php';
	            
	            if ( is_front_page() ) {

	            	include($ulpb_template);
	            	exit();

	            }
    		}

   	 	}

    }

}


function ulpb_columns_admin($defaults) {
    $date = $defaults['date'];
    unset($defaults['date']);
    $defaults['ulpb_visitors']  = __('Unique Visitors','page-builder-add');
    $defaults['ulpb_front_page'] =  __('Front Page','page-builder-add');
    unset($defaults['categories']);
    unset($defaults['tags']);

    if ( is_plugin_active( 'PluginOps-Extensions-Pack/extension-pack.php' ) ) {
    	//$defaults['ulpb_template_shortcode']  = __('Template Shortcode','page-builder-add');
    }

    $defaults['date'] = $date;

    return $defaults;
}


function ulpb_column_visitors_data($column_name, $post_ID) {
    if ($column_name == 'ulpb_visitors') {
        $current_count = get_post_meta($post_ID,'ulpb_page_hit_counter',true);
        if (empty($current_count)) {
            $current_count = 0;
        }
        echo "<div style='padding: 7px 10px 8px 31px;background: #fff;border: 1px solid #D2D2D2;border-radius: 3px;width: 20%; min-width:100px;font-weight: bold; font-size:12px;' >$current_count - Visits</div>";
    }
}


function ulpb_front_page_column($column_name, $post_ID) {
    if ($column_name == 'ulpb_front_page') {
        $ulpb_is_front_page = get_post_meta($post_ID,'ULPB_FrontPage',true);
        if ($ulpb_is_front_page === 'true') {
            $is_landing_page = 'background:#8bc34a;';
        }else{
            $is_landing_page = 'background:#f44336;';
        }
        echo "<div style='width:30px; height:30px; border-radius:100px; $is_landing_page'></div>";
    }
}




function ulpb_menupages_add(){

	add_menu_page( 
		'PluginOps',
		__('PluginOps',
		'page-builder-add') ,
		'edit_pages',
		'pluginops',
		array($this,'ulpb_pageBuilder_dashboard_page'),
		$icon_url = ULPB_PLUGIN_URL.'/images/dashboard/page-builder-templates-icon.png',
		$position = null 
	);


	add_submenu_page(
		'edit.php?post_type=ulpb_post',
		__('Form Submissions','page-builder-add'),
		__('Form Submissions','page-builder-add'),
		'edit_pages',
		'page-builder-ulpb-form-submissions',
		array($this,'ulpb_pageBuilder_form_submissions_page')
	);


	add_submenu_page(
		'edit.php?post_type=ulpb_post',
		__('Tracking Codes','page-builder-add'),
		__('Tracking & Analytics','page-builder-add'),
		'edit_pages',
		'page-builder-tracking-ulpb',
		array($this,'ulpb_pageBuilder_trackingCodes_page')
	);


	add_submenu_page(
		'edit.php?post_type=ulpb_post',
		__('Page Builder Dashboard','page-builder-add'),
		__('Dashboard','page-builder-add'),
		'edit_pages',
		'page-builder-dashboard-ulpb',
		array($this,'ulpb_pageBuilder_dashboard_page')
	);


	add_submenu_page(
		'edit.php?post_type=ulpb_post',
		__('PluginOps Settings','page-builder-add'),
		 __('Settings','page-builder-add'),
		 'edit_pages',
		 'pluginops-settings',
		 array($this,'ulpb_pluginOps_settings_page')
	);
	

	add_submenu_page( 
		'pluginops',
		 __('PluginOps Settings','page-builder-add'),
		 __('Settings','page-builder-add'),
		 'edit_pages',
		 'pluginops-settings',
		 array($this,'ulpb_pluginOps_settings_page') 
	);

	add_submenu_page(
		'edit.php?post_type=ulpb_post',
		__('Edit Landing Page','page-builder-add'),
		__('Blank Page','page-builder-add'),
		'edit_pages',
		'page-builder-new-landing-page',
		array($this,'ulpb_pageBuilder_new_landingpage')
	);

	add_submenu_page(
		'edit.php?post_type=ulpb_post',
		__('Page Builder Extensions','page-builder-add'),
		__('Go Pro','page-builder-add'),
		'edit_pages',
		'page-builder-extensions-ulpb',
		array($this,'ulpb_pageBuilder_extensions_page')
	);

}

function ulpb_pageBuilder_new_landingpage(){
	include_once(ULPB_PLUGIN_PATH.'/admin/views/UI/admin-ui.php');
}

function ulpb_pluginOps_settings_page(){
	include_once(ULPB_PLUGIN_PATH.'/admin/views/Dashboard/settings-page.php');
}


function ulpb_pageBuilder_form_submissions_page(){
	include_once(ULPB_PLUGIN_PATH.'/admin/views/Dashboard/form-submissions.php');
}


function ulpb_pageBuilder_dashboard_page(){
	include_once(ULPB_PLUGIN_PATH.'/admin/views/Dashboard/admin-dashboard.php');
}

function ulpb_pageBuilder_trackingCodes_page(){
	include_once(ULPB_PLUGIN_PATH.'/admin/views/Dashboard/admin-tracking-code.php');
}

function ulpb_pageBuilder_extensions_page(){
	include_once(ULPB_PLUGIN_PATH.'/admin/views/Dashboard/admin-extensions.php');
}



function ulpb_pagebuilder_content_filter($content){

	global $post;

	if (function_exists('get_current_screen')) {
		$screenIdObject = get_current_screen();
	}
	
	$screen_id = '';
	if(isset($screenIdObject))
		$screen_id = $screenIdObject->id;


	$ulpb_is_active = 'false';
	if (isset($post->ID)) {
		$ulpb_is_active = get_post_meta($post->ID,'ulpb_page_builder_active',true);
	}
	
	if ($ulpb_is_active == 'true' && $screen_id != 'site-editor') {
		
		ob_start();
		include(ULPB_PLUGIN_PATH.'public/templates/template.php');
		
		$content = ob_get_contents();
		ob_end_clean();
		
		return do_shortcode($content) ;
		
	}else{
		return do_shortcode( $content );
	}


}


function ulpb_pagebuilder_replace_default_page_template( $template ) {
	
	global $post;

	if ( !empty($post) ) {
		$ulpb_is_active = get_post_meta($post->ID,'ulpb_page_builder_active',true);
		$loadThemeWrapper = get_post_meta($post->ID,'ULPB_loadThemeWrapper',true);

		if ($loadThemeWrapper == '') {
			$loadThemeWrapper = 'true';
		}

		if (!empty($ulpb_is_active) && $post->post_type == 'page') {


			if ($ulpb_is_active == 'true') {

				if ($loadThemeWrapper == 'false') {
					$template = ULPB_PLUGIN_PATH.'public/templates/template.php';
					add_action( 'wp_enqueue_scripts', array($this,'ulpb_page_builder_deregister_theme_styles_from_template'), PHP_INT_MAX );
				}
					
			}


		}

	
	}
	
	return $template;
}


function ulpb_page_builder_deregister_theme_styles_from_template() {

	global $wp_styles;

	foreach ( $wp_styles->queue as $handle ) {
		if ( strpos( $wp_styles->registered[ $handle ]->src, 'wp-content/themes' ) !== false ) {
			wp_dequeue_style($handle);
			wp_deregister_style($handle);
		}
	}
}













function pb_shortcode_sample_nav($atts, $content){
	if( current_user_can('editor') || current_user_can('administrator') ) {
	   ob_start();
	    
		  extract( shortcode_atts( array(

				'pb_menu' => '',
				'pb_logo_url' => '',
				'menucolor' => '',
				'menu_class' => '',
				'menu_font' => '',
				'menu_fonthovercolor' => '',
				'menu_fonthoverbgcolor' => '',
				'menu_fontsize' => '',
				
			), $atts ) );

		$menuName = esc_attr($pb_menu);
		$pageLogoUrl = esc_url($pb_logo_url);
		$menuColor = esc_attr($menucolor);
		$menufont = esc_attr($menu_font);
		$menufontHoverColor = esc_attr($menu_fonthovercolor);
		$menuFontHoverBgColor = esc_attr($menu_fonthoverbgcolor);
		$menuFontSize = esc_attr($menu_fontsize);

		switch ($menu_class) {
			case 'menu-style-1':
				include(ULPB_PLUGIN_PATH.'admin/views/menus/menu-style-1.php');
			break;
			case 'menu-style-2':
				include(ULPB_PLUGIN_PATH.'admin/views/menus/menu-style-2.php');
			break;
			case 'menu-style-3':
				include(ULPB_PLUGIN_PATH.'admin/views/menus/menu-style-3.php');
			break;
			case 'menu-style-4':
				include(ULPB_PLUGIN_PATH.'admin/views/menus/menu-style-4.php');
			break;
			default:
				include(ULPB_PLUGIN_PATH.'admin/views/menus/menu-style-1.php');
			break;
		}
		

		echo $this_widget_menu;
	   return ob_get_clean();

	}

}






} //class ends

?>