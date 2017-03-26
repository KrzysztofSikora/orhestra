<?php 
add_shortcode('WG','lksg_shortcode');
function lksg_shortcode($Id) {
	ob_start();	
	$my_CPT_Name = "acme_product";
	$lk_AllGalleries = array( 'p' => $Id['id'], 'post_type' => $my_CPT_Name, 'orderby' => 'ASC');
	$loop = new WP_Query( $lk_AllGalleries );

	while ( $loop->have_posts() ) : $loop->the_post();
	if(!isset($lk_AllGalleries['p'])) {
		$lk_AllGalleries['p'] = "";
		$wgp_Color					="#FFFFFF";
		$lk_gallery_title			="Yes";
		$lk_show_image_label 		="Yes";
		$lk_Gallery_Layout			="3";
		$lk_label_Color 			="#000000";
		$lk_desc_font_Color			="#777777";
		$lk_btn_Color			    ="#31a3dd";
		$lk_btn_font_Color			="#FFFFFF";
		$lk_font_style				="Courgette";
		$lk_Custom_CSS				="";
		$lk_show_image_desc			="Yes";
		$lk_Light_Box				="lightbox3";
		$lk_open_link            	="_blank";
		$lk_button_title			="Zoom";
	} else {
		$lksg_Id=$lk_AllGalleries['p'];
		$lksg_Gallery_Settings = "lksg_Gallery_Settings_".$lksg_Id;
		$lksg_Gallery_setting = unserialize(get_post_meta( $lksg_Id,$lksg_Gallery_Settings, true));
		if(count($lksg_Gallery_setting)) {
			$lk_gallery_title 		=		$lksg_Gallery_setting['lk_gallery_title'];
			$lk_show_image_label 	=		$lksg_Gallery_setting['lk_show_image_label'];
			$lk_Gallery_Layout		=		$lksg_Gallery_setting['lk_Gallery_Layout'];
			$wgp_Color		 		=		$lksg_Gallery_setting['wgp_Color'];
			$lk_label_Color         =       $lksg_Gallery_setting['lk_label_Color'];
			$lk_desc_font_Color     =       $lksg_Gallery_setting['lk_desc_font_Color'];
			$lk_btn_Color		    =       $lksg_Gallery_setting['lk_btn_Color'];
			$lk_btn_font_Color		=       $lksg_Gallery_setting['lk_btn_font_Color'];
			$lk_font_style			=       $lksg_Gallery_setting['lk_font_style'];
			$lk_Custom_CSS			=       $lksg_Gallery_setting['lk_Custom_CSS'];
			$lk_show_img_desc		=       $lksg_Gallery_setting['lk_show_img_desc'];
			$lk_Light_Box			=       $lksg_Gallery_setting['lk_Light_Box'];
			$lk_open_link			=       $lksg_Gallery_setting['lk_open_link'];
			$lk_button_title		=       $lksg_Gallery_setting['lk_button_title'];
		}
	}

	if($lk_gallery_title=="Yes") { ?>
		<div style="font-weight: bolder; padding-bottom:10px; border-bottom:2px solid #cccccc; margin-bottom:20px; font-size:24px; ">
			<?php echo get_the_title($lksg_Id); ?>
		</div>
		<?php
	}

	$lksg_AllPhotosDetails = unserialize(base64_decode(get_post_meta( $lksg_Id, 'lksg_all_photos_details', true)));
	$TotalImg =  get_post_meta( $lksg_Id, 'lksg_total_images_count', true );
	$i=1;
	?>
	
	<style type="text/css">
	
	
	.gp_container<?php echo $lksg_Id;?> .lksg_desc_para<?php echo $lksg_Id;?>,
	.gp_container<?php echo $lksg_Id;?> .lksg_label_color<?php echo $lksg_Id;?>,
	.gp_container<?php echo $lksg_Id;?> .btn-desc<?php echo $lksg_Id;?>{
		font-family:<?php echo $lk_font_style;?>!important;
	}
	.gp_container<?php echo $lksg_Id;?> .btn-desc<?php echo $lksg_Id;?>{
		color: black!important;
		background:<?php echo $lk_btn_Color; ?>!important;
		border-color:<?php echo $lk_btn_Color; ?>!important;
		color:<?php echo $lk_btn_font_Color; ?>!important;
	}
	.gp_container<?php echo $lksg_Id;?> .btn-desc<?php echo $lksg_Id;?>:hover{
		opacity: 0.6;
		color: black;
	}
	.gp_container<?php echo $lksg_Id;?> .read_more_btn{
		font-size: 20px;
		display: block;
		float: right;
	}
	.gp_container<?php echo $lksg_Id;?> .lksg_label_color<?php echo $lksg_Id;?>{
		margin-top: 10px!important;
		margin-bottom: 10px!important;
		padding-right: 36px !important;
		color:<?php echo $lk_label_Color; ?>!important;
	}
	.gp_container<?php echo $lksg_Id;?> .close_img{
		height: 10px!important;
	}
	.gp_container<?php echo $lksg_Id;?> .wmg-details-content<?php echo $lksg_Id;?>{
		background:<?php echo $wgp_Color; ?>!important;
	}
	.gp_container<?php echo $lksg_Id;?> .wmg-arrow{
		border-bottom-color:<?php echo $wgp_Color; ?>!important;
	}
	.gp_container<?php echo $lksg_Id;?> .lksg_desc_para<?php echo $lksg_Id;?>{
		color:<?php echo $lk_desc_font_Color; ?>!important;
	}
	.gp_container<?php echo $lksg_Id;?> .wmg-thumbnail {
		background:#FFF;
		color: black;			
	}
	.gp_container<?php echo $lksg_Id;?> .dec-content{
		padding-bottom: 1px!important;
	}
	.wmg-thumbnail-content
       {
        overflow:visible !important;
       }
	<?php echo $lk_Custom_CSS; ?>
	</style>
	<div class="wmg-container gp_container<?php echo $lksg_Id;?>" id="my-grid<?php echo $lksg_Id;?>" style="padding-bottom: 11px; ">
		<?php 
		if($TotalImg) {
			foreach($lksg_AllPhotosDetails as $data) {
				$name=$data['lksg_image_label'];
				$url=$data['lksg_image_url'];
				$img_thumb=$data['lksg_img_thumb'];
				$img_medium=$data['lksg_img_medium'];
				$img_large=$data['lksg_img_large'];
				$img_medium_auto=$data['lksg_img_medium_auto'];
				$img_large_auto=$data['lksg_img_large_auto'];
				$img_desc=$data['img_desc'];
				$lksg_video_link=$data['lksg_video_link'];
				$lksg_external_link=$data['lksg_external_link'];
				$lksg_portfolio_type=$data['lksg_portfolio_type'];
				$i++;
				?>
				<div class="wmg-item"  style="padding:20px;" >

					<div class="wmg-thumbnail">
						<div class="wmg-thumbnail-content">
							<!-- exemplo de conteudo para thumbnail -->
							<img src="<?php if($lk_Gallery_Layout>=2 &&  $lk_Gallery_Layout<=4){echo esc_attr($img_large);} ?>" alt="image" style="  width: 100%;
							height: 100%;">
							<!-- fim do exemplo -->
						</div>
						<div class="wmg-arrow"></div>
					</div>

					<div class="wmg-details" style="height:435!important;">
						<span class="wmg-close">
							<!--<img class="close_img" src="<?php echo esc_url( WGP_PLUGIN_URL.'images/close.png' ); ?>">--></span>
							<div class="wmg-details-content<?php echo $lksg_Id;?> " style="">

								<!-- exemplo de coteúdo para detail -->
								<div class="containe exemplo">                            
									<div class="row clearfix" id="image_show_disc" style="margin-left:0;">                                
										<div class	="col-md-6" style="padding: 10px;  
										">
										<?php 
										if($lksg_portfolio_type=="image")
										{
											$h_url=$url;
											?>
											<img src="<?php echo esc_attr($img_large);?>" class="gall-img-responsive" alt="<?php echo esc_attr($name); ?>">                                     
										</div>                   
										<div class="col-md-6 dec-content" >
											<h2 class="lksg_label_color<?php echo $lksg_Id;?>"><?php if($lk_show_image_label=='Yes'){echo $name;}  ?></h2>


											<p class="lksg_desc_para<?php echo esc_attr($lksg_Id);?>" style="padding-right: 33px; text-align: justify; padding-right: 55px;">	
												<?php if($lk_show_img_desc=='Yes'){if(strlen($img_desc)>=400){echo substr($img_desc,0,400);
													?><a href="" class="read_more_btn"></a><?php
												}else{echo esc_attr($img_desc);}}  ?>

											</p>
											<a href="<?php echo esc_url($url);?>" title="<?php echo esc_attr($name); ?>"
												<?php if($lk_Light_Box=='lightbox3'){echo "class='btn btn-primary btn-lg btn-desc$lksg_Id my_swipebox$lksg_Id'";}else if($lk_Light_Box=='lightbox2'){echo "class='btn btn-primary btn-lg btn-desc$lksg_Id' data-rel='prettyPhoto[portfolio]'";}else if($lk_Light_Box=='lightbox1'){echo "class='btn btn-primary btn-lg  btn-desc$lksg_Id lksg_nivobox$lksg_Id'";}else if($lk_Light_Box=='lightbox4'){echo "class='btn btn-primary btn-lg  btn-desc$lksg_Id lksg_fancybox-media$lksg_Id' data-fancybox-group='gallery'";} ?>
												><?php echo $lk_button_title ?></a>
												<?php
											}
											else if($lksg_portfolio_type=="video") {
												$h_url=$lksg_video_link;										

												?>
												<img src="<?php echo esc_attr($img_large);?>" class="gall-img-responsive" alt="<?php echo esc_attr($name); ?>">																				

											</div>                   
											<div class="col-md-6 dec-content" >
												<h2 class="lksg_label_color<?php echo esc_attr($lksg_Id);?>"><?php if($lk_show_image_label=='Yes'){echo esc_attr($name);}  ?></h2>


												<p class="lksg_desc_para<?php echo $lksg_Id;?>" style="padding-right: 33px; text-align: justify; padding-right: 55px;">	
													<?php if($lk_show_img_desc=='Yes'){if(strlen($img_desc)>=400){echo substr($img_desc,0,400);?><a href="" class="read_more_btn"></a><?php	}else{echo esc_attr($img_desc);}}  ?>

												</p>
												<a href="<?php echo esc_url($h_url);?>" title="<?php echo esc_attr($name); ?>" <?php if($lk_Light_Box=='lightbox3'){echo "class='btn btn-primary btn-lg btn-desc$lksg_Id my_swipebox$lksg_Id'";}else if($lk_Light_Box=='lightbox2'){ echo "class='btn btn-primary btn-lg  btn-desc$lksg_Id' data-rel='prettyPhoto[portfolio]'";} else if($lk_Light_Box=='lightbox1'){echo "class='btn btn-primary btn-lg  btn-desc$lksg_Id lksg_nivobox$lksg_Id'";}else if($lk_Light_Box=='lightbox4'){echo "class='btn btn-primary btn-lg  btn-desc$lksg_Id lksg_fancybox-media$lksg_Id' data-fancybox-group='gallery'";} ?>>
													<?php echo $lk_button_title ?>
												</a>
													<?php																						
												}
												else if($lksg_portfolio_type=="link") {
													$h_url=$lksg_external_link;
												?>
													<img src="<?php echo esc_attr($img_large);?>" class="gall-img-responsive" alt="<?php echo esc_attr($name); ?>">                                     
												</div>                   
												<div class="col-md-6 dec-content" >
													<h2 class="lksg_label_color<?php echo esc_attr($lksg_Id);?>"><?php if($lk_show_image_label=='Yes'){echo esc_attr($name);}  ?></h2>


													<p class="lksg_desc_para<?php echo esc_attr($lksg_Id);?>" style="padding-right: 33px; text-align: justify; padding-right: 55px;">	
														<?php if($lk_show_img_desc=='Yes'){if(strlen($img_desc)>=400){echo substr($img_desc,0,400);?><a href="" class="read_more_btn"></a><?php }else{echo esc_attr($img_desc);}}  ?>

													</p>
													<a href="<?php echo esc_url($h_url);?>" title="<?php echo esc_attr($name); ?>" class='btn btn-primary btn-lg btn-desc<?php echo esc_attr($lksg_Id);?>'  target="<?php echo esc_attr($lk_open_link); ?>" id="same_page"><?php echo esc_attr($lk_button_title) ?></a>

													<?php
												}
												?>
											</div>
										</div>
									</div>
									<!-- fim do exemplo -->
								</div>
							</div>
				</div><!-- .wmg-item -->
						<?php 
			}
		}
		?>
	</div>

	<script type="text/javascript">
	jQuery(function(){
		var n="<?php echo $lk_Gallery_Layout; ?>";
		jQuery('#my-grid'+<?php echo $lksg_Id;?>).WMGridfolio({
			thumbnail : {
				columns :n,
			}
		});
	});

	jQuery(function(){
		jQuery('.my_swipebox'+<?php echo $lksg_Id;?>).swipebox({
			hideBarsDelay:0,
			hideCloseButtonOnMobile : false,
		});
	});
	</script>
	<?php
	endwhile;
	wp_reset_query();
	return ob_get_clean();
}
?>