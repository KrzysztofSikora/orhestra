<?php 
$postid=$post->ID;
$lksg_Gallery_Settings = "lksg_Gallery_Settings_".$postid;
$lksg_Gallery_Settings = unserialize(get_post_meta( $postid, $lksg_Gallery_Settings, true));
if($lksg_Gallery_Settings['wgp_Color'] && $lksg_Gallery_Settings['lk_gallery_title'])
{
	$wgp_Color	            =$lksg_Gallery_Settings['wgp_Color'];
	$lk_show_Gallery_title	=$lksg_Gallery_Settings['lk_gallery_title'];
	$lk_show_image_label	=$lksg_Gallery_Settings['lk_show_image_label'];
	$lk_show_gallery_layout	=$lksg_Gallery_Settings['lk_Gallery_Layout'];
	$lk_label_Color			=$lksg_Gallery_Settings['lk_label_Color'];
	$lk_desc_font_Color		=$lksg_Gallery_Settings['lk_desc_font_Color'];
	$lk_btn_Color			=$lksg_Gallery_Settings['lk_btn_Color'];
	$lk_btn_font_Color		=$lksg_Gallery_Settings['lk_btn_font_Color'];
	$lk_font_style 			=$lksg_Gallery_Settings['lk_font_style'];
	$lk_Custom_CSS			=$lksg_Gallery_Settings['lk_Custom_CSS'];
	$lk_show_img_desc       =$lksg_Gallery_Settings['lk_show_img_desc'];
	$lk_Light_Box      	    =$lksg_Gallery_Settings['lk_Light_Box'];
	$lk_open_link 		    =$lksg_Gallery_Settings['lk_open_link'];
	$lk_button_title		=$lksg_Gallery_Settings['lk_button_title'];

}else{
	$wgp_Color					="#FFFFFF";
	$lk_show_Gallery_title		="Yes";
	$lk_show_image_label		="Yes";
	$lk_show_gallery_layout		="3";
	$lk_label_Color			    ="#000000";
	$lk_desc_font_Color			="#000000";
	$lk_btn_Color			    ="#31a3dd";
	$lk_btn_font_Color			="#FFFFFF";
	$lk_font_style				="Courgette";
	$lk_Custom_CSS				="";
	$lk_show_img_desc			="Yes";
	$lk_Light_Box				="lightbox3";
	$lk_open_link            	="_blank";
	$lk_button_title			="Zoom";
}	

?>

<input type="hidden" id="lksg_action" name="lksg_action" value="wl-wrgf-save-settings">
<table class=" form-table" >
	<tr>
		<th><label><?php _e('Show Gallery Title', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			<input type="radio" name="lk-show-gallery-title" id="lk-show-gallery-title" value="Yes" <?php if($lk_show_Gallery_title=="Yes") {echo "checked";} ?>><i class="fa fa-check fa-2x"></i> 
			<input type="radio" name="lk-show-gallery-title" id="lk-show-gallery-title" value="no" <?php if($lk_show_Gallery_title=="no") {echo "checked";} ?>><i class="fa fa-times fa-2x" ></i>
			<p><?php _e('Select Yes/No option to hide or show gallery title', WL_GP_TEXTDOMAIN ); ?></p>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Show Image Label', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			<input type="radio" name="lk-show-image-label" id="lk-show-image-label" value="Yes" <?php if($lk_show_image_label=="Yes") {echo "checked";} ?>><i class="fa fa-check fa-2x"></i> 
			<input type="radio" name="lk-show-image-label" id="lk-show-image-label" value="no" <?php if($lk_show_image_label=="no") {echo "checked";} ?>>
			<i class="fa fa-times fa-2x"></i>
			<p><?php _e('Select Yes/No option to hide or show gallery label', WL_GP_TEXTDOMAIN ); ?></p>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Show Image Description', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			<input type="radio" name="lk_show_img_desc" id="lk_show_img_desc" value="Yes" <?php if($lk_show_img_desc=="Yes") {echo "checked";} ?>><i class="fa fa-check fa-2x"></i> 
			<input type="radio" name="lk_show_img_desc" id="lk_show_img_descc" value="no" <?php if($lk_show_img_desc=="no") {echo "checked";} ?>>
			<i class="fa fa-times fa-2x"></i>
			<p><?php _e('Select Yes/No option to hide or show gallery description', WL_GP_TEXTDOMAIN ); ?></p>
		</td>
	</tr>
	<tr>
		<th scope="row"><label><?php _e('Open Link', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			<input type="radio" name="lk_open_link" id="lk_open_link" value="_self" <?php if($lk_open_link == '_self' ) { echo "checked"; } ?>> <?php _e('In Same Tab', WL_GP_TEXTDOMAIN ); ?> 
			<input type="radio" name="lk_open_link" id="lk_open_link" value="_blank" <?php if($lk_open_link == '_blank' ) { echo "checked"; } ?>> <?php _e('In New Tab', WL_GP_TEXTDOMAIN ); ?>
			<p class="description">
				<?php _e('Select option to open link in save tab or in new tab', WL_GP_TEXTDOMAIN ); ?>.
			</p>
		</td>
	</tr>		

	<tr>
		<th><label><?php _e('Gallery Layout', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			<select name="lk-gallery-layout" id="lk-gallery-layout">
				<optgroup label="Select Gallery Layout">					
					<option value="2" <?php if($lk_show_gallery_layout=="2") {echo "selected";} ?>><?php _e('Two Column', WL_GP_TEXTDOMAIN ); ?></option>
					<option value="3" <?php if($lk_show_gallery_layout=="3") {echo "selected";} ?>><?php _e('Three Column', WL_GP_TEXTDOMAIN ); ?></option>
					<option value="4" <?php if($lk_show_gallery_layout=="4") {echo "selected";} ?>><?php _e('Four Column', WL_GP_TEXTDOMAIN ); ?></option>
				</optgroup>
			</select>
			<p><?php _e('Choose a column layout for image gallery', WL_GP_TEXTDOMAIN ); ?>. <a href="https://weblizar.com/plugins/gallery-pro/" target="_new">(Get More Layout)</a></p>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Image Background Color', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>

			<input type="radio" name="wgp_Color" id="wgp_Color" value="#ddd" <?php if($wgp_Color == '#ddd' ) { echo "checked"; } ?>><label style="color:#ddd;"><?php _e('Color 1', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;
			<input type="radio" name="wgp_Color" id="wgp_Color" value="#f4edaa" <?php if($wgp_Color == '#f4edaa' ) { echo "checked"; } ?>><label style="color:#f4edaa;"><?php _e('Color 2', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;				
			<input type="radio" name="wgp_Color" id="wgp_Color" value="#FFFFFF" <?php if($wgp_Color == '#FFFFFF' ) { echo "checked"; } ?>><label><?php _e('White', WL_GP_TEXTDOMAIN ); ?></label>
			<p class="description">
				<?php _e('Select any color to apply on image background', WL_GP_TEXTDOMAIN ); ?>.
				<a href="https://weblizar.com/plugins/gallery-pro/" target="_new"(Get Unlimited Color Scheme)</a>
			</p>
		</td>
	</tr>	

	<tr>
		<th><label><?php _e('Image Label Color', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>	
			<input type="radio" name="lk_label_Color" id="lk_label_Color" value="#000000" <?php if($lk_label_Color == '#000000' ) { echo "checked"; } ?>><label style="color:#000000;"><?php _e('Color 1', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;
			<input type="radio" name="lk_label_Color" id="lk_label_Color" value="#31a3dd" <?php if($lk_label_Color == '#31a3dd' ) { echo "checked"; } ?>><label style="color:#31a3dd;"><?php _e('Color 2', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;				
			<input type="radio" name="lk_label_Color" id="lk_label_Color" value="#FFFFFF" <?php if($lk_label_Color == '#FFFFFF' ) { echo "checked"; } ?>><label><?php _e('White', WL_GP_TEXTDOMAIN ); ?></label>
			<p class="description">
				<?php _e('Select any color to apply on image Label', WL_GP_TEXTDOMAIN ); ?>.
				<a href="https://weblizar.com/plugins/gallery-pro/" target="_new">(Get Unlimited Color Scheme For Label)</a>
			</p>
		</td>
	</tr>

	<tr>
		<th><label><?php _e('Description Font Color', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>	
			<input type="radio" name="lk_desc_font_Color" id="lk_desc_font_Color" value="#000000" <?php if($lk_desc_font_Color == '#000000' ) { echo "checked"; } ?>><label style="color:#000000;"><?php _e('Color 1', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;
			<input type="radio" name="lk_desc_font_Color" id="lk_desc_font_Color" value="#dd4242" <?php if($lk_desc_font_Color == '#dd4242' ) { echo "checked"; } ?>><label style="color:#dd4242;"><?php _e('Color 2', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;				
			<input type="radio" name="lk_desc_font_Color" id="lk_desc_font_Color" value="#FFFFFF" <?php if($lk_desc_font_Color == '#FFFFFF' ) { echo "checked"; } ?>><label><?php _e('White', WL_GP_TEXTDOMAIN ); ?></label>
			
			<p class="description">
				<?php _e('Select any color to apply on image description font color', WL_GP_TEXTDOMAIN ); ?>.
				<a href="https://weblizar.com/plugins/gallery-pro/" target="_new">(Get Unlimited Color Scheme For Description)</a>
			</p>
		</td>
	</tr>
	<tr>
		<th><label><?php _e('Button Background Color', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>	
			<input type="radio" name="lk_btn_Color" id="lk_btn_Color" value="#31a3dd" <?php if($lk_btn_Color == '#31a3dd' ) { echo "checked"; } ?>><label style="color:#31a3dd;"><?php _e('Color 1', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;			
			<input type="radio" name="lk_btn_Color" id="lk_btn_Color" value="#dd4242" <?php if($lk_btn_Color == '#dd4242' ) { echo "checked"; } ?>><label style="color:#dd4242;"><?php _e('Color 2', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;
			<input type="radio" name="lk_btn_Color" id="lk_btn_Color" value="#FFF" <?php if($lk_btn_Color == '#FFF' ) { echo "checked"; } ?>><label style=""><?php _e('White', WL_GP_TEXTDOMAIN ); ?></label>
			<p class="description">
				<?php _e('Select any color to apply on button background color.', WL_GP_TEXTDOMAIN ); ?>
				<a href="https://weblizar.com/plugins/gallery-pro/" target="_new">(Get Unlimited Color Scheme For Button)</a>
			</p>
		</td>
	</tr>	
	<tr>
		<th><label><?php _e('Button Font Color', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>	
			<input type="radio" name="lk_btn_font_Color" id="lk_btn_font_Color" value="#dd4242" <?php if($lk_btn_font_Color == '#dd4242' ) { echo "checked"; } ?>><label style="color:#dd4242;"><?php _e('Color 1', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;
			<input type="radio" name="lk_btn_font_Color" id="lk_btn_font_Color" value="#000000" <?php if($lk_btn_font_Color == '#000000' ) { echo "checked"; } ?>><label style="color:#000000;"><?php _e('Color 2', WL_GP_TEXTDOMAIN ); ?></label>&nbsp;&nbsp;&nbsp;
			<input type="radio" name="lk_btn_font_Color" id="lk_btn_font_Color" value="#FFFFFF" <?php if($lk_btn_font_Color == '#FFFFFF' ) { echo "checked"; } ?>><label><?php _e('White', WL_GP_TEXTDOMAIN ); ?></label>
			
			<p class="description">
				<?php _e('Select any color to apply on button font color.', WL_GP_TEXTDOMAIN ); ?>
				<a href="https://weblizar.com/plugins/gallery-pro/" target="_new">(Get Unlimited Color Scheme For Button Font)</a>
			</p>
		</td>
	</tr>
	
	<tr>
		<th scope="row"><?php _e('Font Style', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			<select name="lk_font_style" id="lk_font_style">
				<optgroup label="Default Fonts">
					<option value="Arial" <?php selected($lk_font_style, 'Arial' ); ?>>Arial</option>
					<option value="_arial_black" <?php selected($lk_font_style, '_arial_black' ); ?>>Arial Black</option>
					<option value="Courier New" <?php selected($lk_font_style, 'Courier New' ); ?>>Courier New</option>
					<option value="georgia" <?php selected($lk_font_style, 'Georgia' ); ?>>Georgia</option>
					<option value="grande" <?php selected($lk_font_style, 'Grande' ); ?>>Grande</option>
					<option value="_helvetica_neue" <?php selected($lk_font_style, '_helvetica_neue' ); ?>>Helvetica Neue</option>
					<option value="_impact" <?php selected($lk_font_style, '_impact' ); ?>>Impact</option>
					<option value="_lucida" <?php selected($lk_font_style, '_lucida' ); ?>>Lucida</option>
					<option value="_lucida" <?php selected($lk_font_style, '_lucida' ); ?>>Lucida Grande</option>
					<option value="_OpenSansBold" <?php selected($lk_font_style, 'OpenSansBold' ); ?>>OpenSansBold</option>
					<option value="_palatino" <?php selected($lk_font_style, '_palatino' ); ?>>Palatino</option>
					<option value="_sans" <?php selected($lk_font_style, '_sans' ); ?>>Sans</option>
					<option value="_sans" <?php selected($lk_font_style, 'Sans-Serif' ); ?>>Sans-Serif</option>
					<option value="_tahoma" <?php selected($lk_font_style, '_tahoma' ); ?>>Tahoma</option>
					<option value="_times"<?php selected($lk_font_style, '_times' ); ?>>Times New Roman</option>
					<option value="_trebuchet" <?php selected($lk_font_style, 'Trebuchet' ); ?>>Trebuchet</option>
					<option value="_verdana" <?php selected($lk_font_style, '_verdana' ); ?>>Verdana</option>
				</optgroup>
				
			</select>
			<p class="description">
				<?php _e('Choose a caption font style', WL_GP_TEXTDOMAIN ); ?>.
				<a href="https://weblizar.com/plugins/gallery-pro/" target="_new">(Get 500+ Google Font Style)</a>
			</p>
		</td>
	</tr>
	<tr>
		<th scope="row"><label><?php _e('Button Title', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			
			<input type="text" name="lk_button_title" id="lk_button_title" value="<?php echo esc_attr($lk_button_title); ?>"/> 
			<button id="lk_btn_default_value"><?php _e('Default', WL_GP_TEXTDOMAIN ); ?></button> 
			<p class="description">
				<?php _e('Write button title', WL_GP_TEXTDOMAIN ); ?>.
			</p>
		</td>
	</tr>		
	<tr>
		<th scope="row"><label><?php _e('Light Box Styles', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			
			<select name="lk_Light_Box" id="lk_Light_Box">
				<optgroup label="Select Light Box Styles">
					<option value="lightbox3" <?php if($lk_Light_Box == 'lightbox3') echo "selected=selected"; ?>>Swipe Box</option>
				</optgroup>
			</select>
			<p class="description">
				<?php _e('Choose an image Title style.', WL_GP_TEXTDOMAIN ); ?>
				<a href="https://weblizar.com/plugins/gallery-pro/" target="_new">(Get More Lightbox)</a>
			</p>
		</td>
	</tr>
	
	<tr >
		<th scope="row"><label><?php _e('Custom CSS', WL_GP_TEXTDOMAIN ); ?></label></th>
		<td>
			<textarea id="lk_Custom_CSS" name="lk_Custom_CSS" type="text" class="" style="width:80%"><?php echo esc_attr($lk_Custom_CSS); ?></textarea>
			<p class="description">
				<?php _e('Enter any custom css you want to apply on this gallery', WL_GP_TEXTDOMAIN ); ?>.<br>
				<?php _e('Note: Please Do Not Use', WL_GP_TEXTDOMAIN ); ?> <b>Style</b> <?php _e('Tag With Custom CSS', WL_GP_TEXTDOMAIN ); ?>.
			</p>
		</td>
	</tr>
</table>
<?php
?>
<script type="text/javascript">
jQuery(function(){
	jQuery("#lk_btn_default_value").click(function(e){
		e.preventDefault();
		jQuery("#lk_button_title").attr("value","Zoom");
	});
});
</script>