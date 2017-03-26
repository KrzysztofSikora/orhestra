<?php 
/**
 * Plugin Name: Gallery Pro 
 * Version: 1.4.5
 * Description: Gallery Pro is an Responsive plug-in with lot's of features and options for customizes the images for different views.
 * Author: Weblizar
 * Author URI: http://weblizar.com/plugins/
 * Plugin URI: https://wordpress.org/plugins/gallery-pro/
 */

/**
 * Constant Variable
 */
define("WL_GP_TEXTDOMAIN","weblizar-gp" );
define("WGP_PLUGIN_URL", plugin_dir_url(__FILE__));

register_activation_hook(__FILE__,'lk_DefaultSettingsPro');
function lk_DefaultSettingsPro(){
	$lk_defaultsetting=base64_encode(serialize(array(
		'wgp_Color'					=>"#e3e3e3",
		'lk_show_Gallery_title'		=>"Yes",
		'lk_show_image_label'		=>"Yes",
		'lk_show_gallery_layout'	=>"3",
		'lk_label_Color'			=>"#666",
		'lk_desc_font_Color'		=>"#777777",
		'lk_btn_Color'			    =>"#428bca",
		'lk_btn_font_Color'			=>"#FFF",
		'lk_font_style'				=>"Courgette",
		'lk_Custom_CSS'				=>"",
		'lk_show_img_desc'			=>"Yes",
		'lk_Light_Box'				=>"lightbox3",
		'lk_open_link'            	=>"_blank",
		'lk_button_title'			=>"Zoom"
		)));
	add_action("lksg_setting",$lk_defaultsetting);
}
/**
* Crop Images In Desire Format
*/
add_image_size('lksg_gallery_admin_thumb',300, 300, array( 'top', 'center' ));
add_image_size('lksg_gallery_admin_medium',400, 400, array( 'top', 'center' ));
add_image_size('lksg_gallery_admin_large',500, 500, array( 'top', 'center' ));
add_image_size('lksg_gallery_admin_medium_auto',400, 9999, array( 'top', 'center' ));
add_image_size('lksg_gallery_admin_large_auto',500, 9999, array( 'top', 'center' ));

function admin_content_GP_144936() { 
	if(get_post_type()=="acme_product") { ?>
		<style>
		.wlTBlock{
			background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('<?php echo IMGF_PLUGIN_URL.'/images/bg2.jpg'; ?>') no-repeat fixed;
			background-position: 50% 0 !important;
			padding: 27px 0 23px 0;
			margin-left: -20px;
			font-family: Myriad Pro ;
			cursor: pointer;
			text-align: center;
		}
		.wlTBlock .wlTBig{
			color: white;
			font-size: 30px;
			font-weight: bolder;
			padding: 0 0 15px 0;
		}
		.wlTBlock .wlTBig .dashicons{
			font-size: 40px;
			position: absolute;
			margin-left: -45px;
			margin-top: -10px;
		}
		.wlTBlock .WlTSmall{
			font-weight: bolder;
			color: white;
			font-size: 18px;
			padding: 0 0 15px 15px;
		}

		.wlTBlock a{
		text-decoration: none;
		}
		@media screen and ( max-width: 600px ) {
			.wlTBlock{ padding-top: 60px; margin-bottom: -50px; }
			.wlTBlock .WlTSmall { display: none; }
			
		}
		</style>
		<div class="wlTBlock ">
			<a href="https://weblizar.com/plugins/gallery-pro/" target="_new">
				<div class="wlTBig"><span class="dashicons dashicons-cart"></span>Get Pro version Only In $9 (Offer For Limited Time)</div>
				<div class="WlTSmall">with PRO version you get more advanced functionality and even more flexibility in settings </div>
			</a>
		</div>
		<?php
	}
}
add_action('in_admin_header','admin_content_GP_144936');




add_action('admin_menu', 'submenu_SettingsPage');
function submenu_SettingsPage() {
	add_submenu_page('edit.php?post_type=acme_product', 'Pro Screenshots', 'Help and Support', 'administrator', 'lksg_gallery_pro', 'lksg_get_image_gallery_pro_page_function');
	add_submenu_page('edit.php?post_type=acme_product', 'Pro Screenshots', 'Pro Screenshots', 'administrator', 'lksg_gallery_Pro_Screenshots', 'lksg_get_image_gallery_Pro_Screenshots_function');
	add_submenu_page('edit.php?post_type=acme_product', 'Pro Screenshots', 'Our Products', 'administrator', 'lksg_gallery_pro_product', 'lksg_get_image_gallery_pro_product_function');
}

function lksg_get_image_gallery_pro_page_function() {	
	require_once("gallery-pro-help-and-support.php");
}

function lksg_get_image_gallery_pro_product_function() {
	wp_enqueue_style('lksg-boot-strap-admin', WGP_PLUGIN_URL.'css/bootstrap-admin.css');
	require_once("our_product.php");
}

function lksg_get_image_gallery_Pro_Screenshots_function() {
	wp_enqueue_style('lksg-font-awesome-5', WGP_PLUGIN_URL.'css/font-awesome-latest/css/font-awesome.min.css');
    wp_enqueue_style('lksg-pricing-table-css',WGP_PLUGIN_URL.'css/pricing-table.css');
    wp_enqueue_style('lksg-boot-strap-admin',WGP_PLUGIN_URL.'css/bootstrap-admin.css');
	require_once("get-gallery-pro-weblizar.php");
}

class lksg{
	private static $instance;
	private $admin_thumbnail_size = 150;
	private $thumbnail_size_w = 150;
	private $thumbnail_size_h = 150;
	var $counter;

	public static function forge() {
		if (!isset(self::$instance)) {
			$className = __CLASS__;
			self::$instance = new $className;
		}
		return self::$instance;
	}
	private function __construct() {
		$this->counter = 0;
		add_action('admin_enqueue_scripts', array(&$this,'my_style_files'));
		add_action('wp_enqueue_scripts', array(&$this,'frant_display_style'));
		if(is_admin())
		{
			add_action('plugins_loaded', array(&$this, 'GetReadyTranslation'));
			add_action( 'init', array(&$this,'my_cpt'));
			add_action('wp_ajax_lksgallery_get_thumbnail', array(&$this,'lks_ajax_get_thumb'));

			add_action('add_meta_boxes',array(&$this, 'add_custom_meta_box'));
			add_action('save_post',array(&$this,'lksg_add_image_meta_box_save'));
			add_action('save_post',array(&$this,'lksg_settings_meta_save'));
			add_action('admin_init',array(&$this, 'add_custom_meta_box'));
		}
	}
	
	public function GetReadyTranslation() {
		load_plugin_textdomain(WL_GP_TEXTDOMAIN, FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
	}
	
	public function frant_display_style() {
		wp_enqueue_style('mystyle-5',WGP_PLUGIN_URL.'css/display_frant_css.css');
		wp_enqueue_style('mystyle-6',WGP_PLUGIN_URL.'css/bootstrap.css');				
		wp_enqueue_style('mystyle-8',WGP_PLUGIN_URL.'js/grid-folio/jquery.wm-gridfolio-1.0.min.css');
		wp_enqueue_script( 'jquery');	
		wp_enqueue_script('myscript-3',WGP_PLUGIN_URL.'js/grid-folio/jquery.wm-gridfolio-1.0.min.js');

		/**
         * Load Light Box 1 Swipebox JS CSS
         */
		wp_enqueue_style('wl-lksg-swipe-css', WGP_PLUGIN_URL.'lightbox/swipebox/css/swipebox.css');
		wp_enqueue_script('wl-lksg-swipe-js',WGP_PLUGIN_URL.'lightbox/swipebox/js/jquery.swipebox.js');   
	}
	
	public function my_style_files() {
		wp_enqueue_script( 'jquery');
		wp_enqueue_media();	
		wp_enqueue_script('media-upload');	
		wp_enqueue_style( 'wp-color-picker' );	
		wp_enqueue_style('mystyle-3',WGP_PLUGIN_URL.'css/font-awesome-latest/css/font-awesome.min.css');
		wp_enqueue_style('mystyle-4',WGP_PLUGIN_URL.'css/my_style.css');
		wp_enqueue_script( 'myscript-1',WGP_PLUGIN_URL.'js/my_script.js');			
		wp_enqueue_script( 'color-picker-script', WGP_PLUGIN_URL.'js/wl-color-picker.js', array( 'wp-color-picker' ), false, true );
	}
	
	public function add_custom_meta_box() {
		add_meta_box('custom_meta_box', 'Photo Gallery shortcode',array(&$this, 'meta_box_function'),
			'acme_product','side','low');

		add_meta_box('custom_meta_rate', 'Show us some love, Rate Us',array(&$this, 'meta_box_function_rate'),
			'acme_product','side','low');

		add_meta_box('custom_meta_upgrade_version', 'Upgrade To Pro Version',array(&$this, 'meta_box_function_upgrade'),
			'acme_product','side','low');

		add_meta_box('custom_meta_Pro_Features', 'Pro Features',array(&$this, 'meta_box_function_Pro_Features'),
			'acme_product','side','low');

		add_meta_box('add_img_box','Add Images',array(&$this,'add_image_meta_box'),'acme_product','normal','low');

		add_meta_box('gallery_setting','Apply Setting On Photo Gallery',array(&$this,'setting_meta_box_function'),'acme_product','normal','low');
	}
	public function meta_box_function() { 
		?>
		<p><?php _e('Use below shortcode in any Page/Post to publish your gallery', WL_GP_TEXTDOMAIN ); ?></p>
		<input  type="text" value="<?php echo "[WG id=".get_the_ID()."]"; ?>" readonly />
		<?php 
	}

	public function meta_box_function_rate() {
		?>		
		<div align="center">
			<p>Please Review & Rate Us On WordPress</p>
			<a class="lk_upgrade-to-pro-demo faglk-rate-us" style=" text-decoration: none; height: 40px; width: 40px;" href="https://wordpress.org/plugins/gallery-pro/" target="_blank">
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
			</a>
		</div>
		<div class="lk_upgrade-to-pro-demo" style="text-align:center;margin-bottom:10px;margin-top:10px;">
			<a href="https://wordpress.org/plugins/gallery-pro/" target="_blank" class="button button-primary button-hero">RATE US</a>
		</div>
		<?php
	}

	public function meta_box_function_upgrade() {
		?>
		<div class="lk_upgrade-to-pro-demo" style="text-align:center;margin-bottom:10px;margin-top:10px;">
			<a href="http://demo.weblizar.com/flickr-album-gallery-pro/"  target="_new" class="button button-primary button-hero">View Live Demo</a>
		</div>
		<div class="lk_upgrade-to-pro-admin-demo" style="text-align:center;margin-bottom:10px;">
			<a href="http://demo.weblizar.com/gallery-pro-by-weblizar/" target="_new" class="button button-primary button-hero">View Admin Demo</a>
		</div>
		<div class="lk_upgrade-to-pro" style="text-align:center;margin-bottom:10px;">
			<a href="https://weblizar.com/plugins/gallery-pro/" target="_new" class="button button-primary button-hero">Upgarde To Pro</a>
		</div>
		<?php
	}
	
	public function meta_box_function_Pro_Features() {
		?>
		<ul style="">
			<li class="plan-feature">Responsive Design</li>
			<li class="plan-feature">10 Gallery Layout</li>			
			<li class="plan-feature">Youtube/Vimeo Video</li>
			<li class="plan-feature">Extrenal Link </li>
			<li class="plan-feature">Image Description </li>
			<li class="plan-feature">Custom Button Name </li>
			<li class="plan-feature">Label/Description and Button Color Change </li>
			<li class="plan-feature">Background Color Change</li>
			<li class="plan-feature">All Gallery Shortcode</li>
			<li class="plan-feature">Each Gallery has Unique Shortcode</li>			
			<li class="plan-feature">500+ of Font Style</li>
			<li class="plan-feature">4 types Of Lightbox Integrated</li>
			<li class="plan-feature">Drag and Drop image Position</li>
			<li class="plan-feature">Multiple Image uploader</li>
			<li class="plan-feature">Shortcode Button on post or page</li>
			<li class="plan-feature">Unique settings for each gallery</li>
			<li class="plan-feature">Hide/Show gallery Title and label</li>
			<li class="plan-feature">Google Fonts</li>	
		</ul>
	<?php 
	}

	public function setting_meta_box_function($post) {
		require_once('gallery-pro-setting.php');

	}
	public function add_image_meta_box($post) {
		?>
		<div class="image_countainer">				
			<input type="hidden" id="lksg_wl_action" name="lksg_wl_action" value="lksg-save-settings">
			<ul class="clearfix" id="lksgallery_thumbs">
				<?php 
				$id=$post->ID;
				$lksg_AllPhotosDetails = unserialize(base64_decode(get_post_meta( $id, 'lksg_all_photos_details', true)));
				$TotalImg =  get_post_meta( $id, 'lksg_total_images_count', true );
				//print_r($lksg_AllPhotosDetails);

				if($TotalImg)
				{
					foreach($lksg_AllPhotosDetails as $data)
					{
						$name=$data['lksg_image_label'];
						$url_c=$data['lksg_image_url'];
						$lksg_img_thumb=$data['lksg_img_thumb'];
						$lksg_img_medium=$data['lksg_img_medium'];
						$lksg_img_large=$data['lksg_img_large'];
						$lksg_img_medium_auto=$data['lksg_img_medium_auto'];
						$lksg_img_large_auto=$data['lksg_img_large_auto'];
						$img_desc=$data['img_desc'];
						$lksg_video_link=$data['lksg_video_link'];
						$lksg_external_link=$data['lksg_external_link'];
						$lksg_portfolio_type=$data['lksg_portfolio_type'];
						?>
						<li class="choose_image_entry">
							<a href="" class="lksgallery_remove_image"><img src="<?php echo WGP_PLUGIN_URL.'images/Close-icon.png'; ?>"></a>
							<img src="<?php echo esc_url($lksg_img_thumb); ?>">
							<input type="text" name="lksg_image_url[]" id="lksg_image_url[]" value="<?php echo esc_url($url_c); ?>" readonly="readonly" style="display:none;" />
							<input type="text" id="lksg_img_thumb[]" name="lksg_img_thumb[]" class="lksg_label_text"  value="<?php echo esc_url($lksg_img_thumb); ?>"  readonly="readonly" style="display:none;" />
							<input type="text" id="lksg_img_medium[]" name="lksg_img_medium[]" class="lksg_label_text"  value="<?php echo esc_url($lksg_img_medium); ?>"  readonly="readonly" style="display:none;" />
							<input type="text" id="lksg_img_large[]" name="lksg_img_large[]" class="lksg_label_text"  value="<?php echo esc_url($lksg_img_large); ?>"  readonly="readonly" style="display:none;" />
							<input type="text" id="lksg_img_medium_auto[]" name="lksg_img_medium_auto[]" class="lksg_label_text"  value="<?php echo esc_url($lksg_img_medium_auto); ?>"  readonly="readonly" style="display:none;" />
							<input type="text" id="lksg_img_large_auto[]" name="lksg_img_large_auto[]" class="lksg_label_text"  value="<?php echo esc_url($lksg_img_large_auto); ?>"  readonly="readonly" style="display:none;" />


							<select name="lksg_portfolio_type[]" id="lksg_portfolio_type[]" style="width:100%;">
								<optgroup label="Select Type">
									<option value="image" <?php selected($lksg_portfolio_type, 'image' ); ?>><i class="fa fa-image"></i>Image </option>
									<option value="video" <?php selected($lksg_portfolio_type, 'video' ); ?>><i class="fa fa-youtube-play">Video </option>
									<option value="link" <?php selected($lksg_portfolio_type, 'link' ); ?>><i class="fa fa-link"></i>Link</option>
								</optgroup>
							</select>
							<label><?php _e('Label', WL_GP_TEXTDOMAIN ); ?></label>
							<input type="text" placeholder="<?php _e('Enter Image label', WL_GP_TEXTDOMAIN ); ?>" name="lksg_image_label[]" class="lksg_label_text" value="<?php echo esc_attr($name); ?>">

							<label><?php _e('Video URL', WL_GP_TEXTDOMAIN ); ?> <a href="http://weblizar.com/get-youtube-vimeo-video-url/" target="_blank"><strong><?php _e('Help', WL_GP_TEXTDOMAIN ); ?></strong></a></label>
							<input type="text" id="lksg_video_link[]" name="lksg_video_link[]" placeholder="<?php _e('Enter Youtube/Vimeo Video URL', WL_GP_TEXTDOMAIN ); ?>" class="pgpp_label_text" value="<?php echo esc_url($lksg_video_link); ?>">

							<label><?php _e('Link', WL_GP_TEXTDOMAIN ); ?></label>
							<input type="text" id="lksg_external_link[]" name="lksg_external_link[]" placeholder="<?php _e('Enter Link URL', WL_GP_TEXTDOMAIN ); ?>" class="lksg_label_text" value="<?php echo esc_url($lksg_external_link); ?>">

							<label><?php _e('Description', WL_GP_TEXTDOMAIN ); ?></label>
							<textarea name="img_desc[]" id="img_desc[]" placeholder="<?php _e('Description', WL_GP_TEXTDOMAIN ); ?>"><?php echo esc_attr($img_desc); ?></textarea>
						</li>
						<?php
					}
				}else{
					$TotalImg=0;
				}
				?>
			</ul>
			<div id="clearfix"></div>

		</div> 

		<div class="add_new_img"  data-uploader_title="Upload Image" data-uploader_button_text="Select">
			<div class="dashicons dashicons-plus"></div>
			<p>
				<?php _e('Add New Image', WL_GP_TEXTDOMAIN ); ?>
			</p>

		</div>
		<div style="margin:13px 0 13px 13px;">
			<input type="button" id="all_delete_btn" value="Delete All" rel="">
		</div>
		<p><strong><?php _e('Tips', WL_GP_TEXTDOMAIN ); ?>:</strong> <?php _e('Plugin crop images with same size thumbnails. So, please upload all gallery images using Add New Image button. Dont use/add pre-uploaded images which are uploaded previously using Media/Post/Page.', WL_GP_TEXTDOMAIN ); ?></p>
		<div style="text-align:left;color:#F8504B !important;">
			<p>Please Review & Rate Us On WordPress</p>
			<a class="upgrade-to-pro-demo fag-rate-us" style=" text-decoration: none; height: 40px; width: 40px;" href="https://wordpress.org/plugins/gallery-pro/" target="_blank">
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
			</a>
		</div>
		<div class="upgrade-to-pro-demo" style="text-align:left;margin-bottom:10px;margin-top:10px;color:#F8504B !important;">
			<a href="https://wordpress.org/plugins/gallery-pro/" target="_blank" class="button button-primary button-hero">RATE US</a>
		</div>
		<?php
	}

	public function my_cpt() {
		$labels = array(
			'name'               => _x( 'Gallery Pro', 'post type general name'),
			'singular_name'      => _x( 'Gallery Pro ', 'post type singular name'),
			'menu_name'          => _x( 'Gallery Pro ', 'admin menu' ),
			'name_admin_bar'     => _x( 'Gallery Pro ', 'add new on admin bar'),
			'add_new'            => __( 'Add New Gallery', WL_GP_TEXTDOMAIN ),
			'add_new_item'       => __( 'Add New Gallery', WL_GP_TEXTDOMAIN ),
			'new_item'           => __( 'New Gallery', WL_GP_TEXTDOMAIN ),
			'edit_item'          => __( 'Edit Gallery', WL_GP_TEXTDOMAIN ),
			'view_item'          => __( 'View Gallery', WL_GP_TEXTDOMAIN ),
			'all_items'          => __( 'All Galleries', WL_GP_TEXTDOMAIN ),
			'search_items'       => __( 'Search Galleries', WL_GP_TEXTDOMAIN ),
			'parent_item_colon'  => __( 'Parent Galleries:', WL_GP_TEXTDOMAIN ),
			'not_found'          => __( 'No Galleries found.', WL_GP_TEXTDOMAIN ),
			'not_found_in_trash' => __( 'No Galleries found in Trash.', WL_GP_TEXTDOMAIN )
			);

$args = array(
	'labels'             => $labels,
	'description'        => __( 'Description', WL_GP_TEXTDOMAIN ),
	'public'             => false,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'menu_icon'          => 'dashicons-format-gallery',
	'rewrite'            => array( 'slug' => 'gallery' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
	'hierarchical'       => false,
	'menu_position'      => 67,
	//'taxonomies'         =>  array('category'),
	'supports'           => array( 'title' )
	);

	register_post_type( 'acme_product', $args );
	add_filter( 'manage_edit-acme_product_columns', array(&$this, 'acme_product_columns' )) ;
	add_action( 'manage_acme_product_posts_custom_column', array(&$this, 'acme_product_manage_columns' ), 10, 2 );
}

function acme_product_columns( $columns ){
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Gallery', WL_GP_TEXTDOMAIN ),
		'shortcode' => __( 'Gallery Shortcode', WL_GP_TEXTDOMAIN ),
		'date' => __( 'Date', WL_GP_TEXTDOMAIN )
		);
	return $columns;
}

function acme_product_manage_columns( $column, $post_id ){
	global $post;
	switch( $column ) {
		case 'shortcode' :
		echo '<input type="text" value="[WG id='.$post_id.']" readonly="readonly" />';
		break;
		default :
		break;
	}
}

public function lks_admin_thumb($id)
{
	$img1=wp_get_attachment_image_src($id,'lksg_image_admin_original',true);
	$img_thumb=wp_get_attachment_image_src($id,'lksg_gallery_admin_thumb',true);
	$img_medium=wp_get_attachment_image_src($id,'lksg_gallery_admin_medium',true);
	$img_large=wp_get_attachment_image_src($id,'lksg_gallery_admin_large',true);
	$img_medium_auto=wp_get_attachment_image_src($id,'lksg_gallery_admin_medium_auto',true);
	$img_large_auto=wp_get_attachment_image_src($id,'lksg_gallery_admin_large_auto',true);	
	
	$u_string=substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
	?>	
	<li class="choose_image_entry">
		<a href="" class="lksgallery_remove_image">
			<img src="<?php echo WGP_PLUGIN_URL.'images/Close-icon.png'; ?>"></a>
			<img src="<?php echo $img_thumb[0]; ?>">
			<input type="text" id="lksg_image_url[]" name="lksg_image_url[]"  value="<?php echo esc_url($img1[0]); ?>" readonly="readonly" style="display:none;" />
			<input type="text" id="lksg_img_thumb[]" name="lksg_img_thumb[]" class="lksg_label_text"  value="<?php echo esc_url($img_thumb[0]); ?>"  readonly="readonly" style="display:none;" />
			<input type="text" id="lksg_img_medium[]" name="lksg_img_medium[]" class="lksg_label_text"  value="<?php echo esc_url($img_medium[0]); ?>"  readonly="readonly" style="display:none;" />
			<input type="text" id="lksg_img_large[]" name="lksg_img_large[]" class="lksg_label_text"  value="<?php echo esc_url($img_large[0]); ?>"  readonly="readonly" style="display:none;" />
			<input type="text" id="lksg_img_medium_auto[]" name="lksg_img_medium_auto[]" class="lksg_label_text"  value="<?php echo esc_url($img_medium_auto[0]); ?>"  readonly="readonly" style="display:none;" />
			<input type="text" id="lksg_img_large_auto[]" name="lksg_img_large_auto[]" class="lksg_label_text"  value="<?php echo esc_url($img_large_auto[0]); ?>"  readonly="readonly" style="display:none;" />


			<select name="lksg_portfolio_type[]" id="lksg_portfolio_type[]" style="width:100%;">
				<optgroup label="Select Type">
					<option value="image" selected="selected"><i class="fa fa-image"></i><?php _e('Image', WL_GP_TEXTDOMAIN ); ?> </option>
					<option value="video"><i class="fa fa-youtube-play"></i><?php _e('Video', WL_GP_TEXTDOMAIN ); ?></option>
					<option value="link"><i class="fa fa-link"></i><?php _e('Link', WL_GP_TEXTDOMAIN ); ?></option>
				</optgroup>
			</select>

			<label><?php _e('Label', WL_GP_TEXTDOMAIN ); ?></label>
			<input type="text" placeholder="Enter Image label" name="lksg_image_label[]" class="lksg_label_text">

			<label><?php _e('Video URL', WL_GP_TEXTDOMAIN ); ?> <a href="http://weblizar.com/get-youtube-vimeo-video-url/" target="_blank"><strong><?php _e('Help', WL_GP_TEXTDOMAIN ); ?></strong></a></label>
			<input type="text" id="lksg_video_link[]" name="lksg_video_link[]" placeholder="<?php _e('Enter Youtube/Vimeo Video URL', WL_GP_TEXTDOMAIN ); ?>" class="pgpp_label_text">

			<label><?php _e('Link', WL_GP_TEXTDOMAIN ); ?></label>
			<input type="text" id="lksg_external_link[]" name="lksg_external_link[]" placeholder="<?php _e('Enter Link URL', WL_GP_TEXTDOMAIN ); ?>" class="lksg_label_text">

			<label><?php _e('Description', WL_GP_TEXTDOMAIN ); ?></label>
			<textarea name="img_desc[]" id="img_desc[]" placeholder="<?php _e('Description', WL_GP_TEXTDOMAIN ); ?>"></textarea>

		</li>
		<?php
	}

	public function lks_ajax_get_thumb() {
		echo $this->lks_admin_thumb($_POST['imageid']);
		die();
	}

	public function lksg_add_image_meta_box_save($postid) {
		if(isset($postid) && isset($_POST['lksg_wl_action'])) {
			$total_img=count($_POST['lksg_image_url']);
			$img_array=array();

			if($total_img) {
				for($i=0; $i < $total_img; $i++) {
					$img_label 		= stripslashes( sanitize_text_field( $_POST['lksg_image_label'][$i]));
					$url 			=sanitize_text_field($_POST['lksg_image_url'][$i] );
					$lksg_img_thumb		=sanitize_text_field( $_POST['lksg_img_thumb'][$i] );
					$lksg_img_medium	=sanitize_text_field( $_POST['lksg_img_medium'][$i] );
					$lksg_img_large		=sanitize_text_field( $_POST['lksg_img_large'][$i] );
					$lksg_img_medium_auto	=sanitize_text_field( $_POST['lksg_img_medium_auto'][$i] );
					$lksg_img_large_auto	=sanitize_text_field( $_POST['lksg_img_large_auto'][$i] );
					$lksg_video_link 	=sanitize_text_field( $_POST['lksg_video_link'][$i] );
					$lksg_external_link 	=sanitize_text_field( $_POST['lksg_external_link'][$i] );
					$img_desc 		=sanitize_text_field( $_POST['img_desc'][$i] );
					$lksg_portfolio_type 	=sanitize_text_field( $_POST['lksg_portfolio_type'][$i] );
					
					$img_array[]=array(
						'lksg_image_label' 		=>$img_label,
						'lksg_image_url' 		=> $url,
						'lksg_img_thumb' 		=> $lksg_img_thumb,
						'lksg_img_medium' 		=> $lksg_img_medium,
						'lksg_img_large' 		=> $lksg_img_large,
						'lksg_img_medium_auto' 	=> $lksg_img_medium_auto,
						'lksg_img_large_auto'	=> $lksg_img_large_auto,
						'lksg_video_link'		=>$lksg_video_link,
						'lksg_external_link'	=>$lksg_external_link,
						'lksg_portfolio_type'	=>$lksg_portfolio_type,
						'img_desc'				=>$img_desc
						);
					update_post_meta($postid, 'lksg_all_photos_details', base64_encode(serialize($img_array)));
					update_post_meta($postid, 'lksg_total_images_count', $total_img);
				}
			} else {
				$total_img=0;
				$img_array[]=array();
				update_post_meta($postid, 'lksg_all_photos_details', base64_encode(serialize($img_array)));
				update_post_meta($postid, 'lksg_total_images_count', $total_img);
			}
		}
	}

	public function lksg_settings_meta_save($PostID) {
		if(isset($PostID) && isset($_POST['lksg_action'])) {
			$lk_gallery_title 		=	sanitize_option ( 'lk-show-gallery-title', $_POST['lk-show-gallery-title'] );
			$lk_show_image_label 	=	sanitize_option ( 'lk-show-image-label', $_POST['lk-show-image-label'] );
			$lk_Gallery_Layout  	=	sanitize_option ( 'lk-gallery-layout', $_POST['lk-gallery-layout'] );
			$wgp_Color				=	sanitize_option ( 'wgp_Color', $_POST['wgp_Color'] );
			$lk_label_Color			=	sanitize_option ( 'lk_label_Color', $_POST['lk_label_Color'] );
			$lk_desc_font_Color		=	sanitize_option ( 'lk_desc_font_Color', $_POST['lk_desc_font_Color'] );
			$lk_btn_Color			=	sanitize_option ( 'lk_btn_Color', $_POST['lk_btn_Color'] );
			$lk_btn_font_Color		=	sanitize_option ( 'lk_btn_font_Color', $_POST['lk_btn_font_Color'] );
			$lk_font_style			=	sanitize_option ( 'lk_font_style', $_POST['lk_font_style'] );
			$lk_Custom_CSS			=	sanitize_text_field( $_POST['lk_Custom_CSS'] );
			$lk_show_img_desc		=	sanitize_option ( 'lk_show_img_desc', $_POST['lk_show_img_desc'] );
			$lk_Light_Box		    =	sanitize_option ( 'lk_Light_Box', $_POST['lk_Light_Box'] );
			$lk_open_link 			=	sanitize_option ( 'lk_open_link', $_POST['lk_open_link'] );
			$lk_button_title		=	sanitize_option ( 'lk_button_title', $_POST['lk_button_title'] );

			$lk_setting_array=serialize(array(
				'lk_gallery_title'=>$lk_gallery_title,
				'lk_show_image_label'=>$lk_show_image_label,
				'lk_Gallery_Layout'=>$lk_Gallery_Layout,
				'wgp_Color'=>$wgp_Color,
				'lk_label_Color'=>$lk_label_Color,
				'lk_desc_font_Color'=>$lk_desc_font_Color,
				'lk_btn_Color'=>$lk_btn_Color,
				'lk_btn_font_Color'=>$lk_btn_font_Color,
				'lk_font_style'=>$lk_font_style,
				'lk_Custom_CSS'=>$lk_Custom_CSS,
				'lk_show_img_desc'=>$lk_show_img_desc,
				'lk_Light_Box'=>$lk_Light_Box,
				'lk_open_link'=>$lk_open_link,
				'lk_button_title'=>$lk_button_title	
				));
			$lksg_Gallery_Settings = "lksg_Gallery_Settings_".$PostID;
			update_post_meta($PostID,$lksg_Gallery_Settings,$lk_setting_array);
		}
	}
}
global $lksg;
$lksg = lksg::forge();

require_once("gallery-shortcode.php");

add_action('media_buttons_context', 'lksg_custom_button',17);
add_action('admin_footer', 'lksg_inline_popup_content');
function lksg_custom_button($context) {  
	$btnimg = WGP_PLUGIN_URL.'/images/Photos-icon.png';  
	$lksgcontainer_id = 'lksg_div';
	//append the icon
	$context .= '<a class="button button-primary thickbox"  title="'."Select Gallery to insert into post".'"  
	href="#TB_inline?width=400&inlineId='.$lksgcontainer_id.'">
	<span class="wp-media-buttons-icon" style="background: url('.$btnimg.'); background-repeat: no-repeat; background-position: left bottom;"></span>
	Gallery Pro Shortcode</a>';
	return $context;
}

function lksg_inline_popup_content() { ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#lksg_galleryinsert').on('click', function() {				
			var id = jQuery('#lksg-gallery-select option:selected').val();				
			window.send_to_editor('<p>[WG id=' + id + ']</p>');
			tb_remove();
		})
	});
	</script>
	<div id="lksg_div" style="display:none;">
		<h2><?php _e('Select Gallery To Insert Into Post', WL_GP_TEXTDOMAIN ); ?></h2>
		<?php 
		$all_posts = wp_count_posts( 'acme_product')->publish;
		$args = array('post_type' => 'acme_product', 'posts_per_page' =>$all_posts);
		global $lksg_galleries;
		$lksg_galleries = new WP_Query( $args );			
		if( $lksg_galleries->have_posts() ) { ?>	
		<select id="lksg-gallery-select">
			<?php
			while ( $lksg_galleries->have_posts() ) : $lksg_galleries->the_post(); ?>
			<option value="<?php echo esc_attr(get_the_ID()); ?>"><?php the_title(); ?></option>
			<?php
			endwhile; 
			?>
		</select>
		<button class='button primary' id='lksg_galleryinsert'><?php _e('Insert Gallery Shortcode', WL_GP_TEXTDOMAIN ); ?></button>
		<?php
	} else { 
		_e('No Gallery found', WL_GP_TEXTDOMAIN );
	}
	?>
</div>
<?php
}
?>