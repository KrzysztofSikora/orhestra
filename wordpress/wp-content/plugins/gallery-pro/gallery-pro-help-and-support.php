<div class="row-fluid pricing-table pricing-three-column" style="margin-top: 10px; display:block; width:100%; overflow:hidden; background:white; box-shadow: 0 0 5px hsla(0, 0%, 20%, 0.3);padding-bottom:70px">
	<div class="plan-name" style="margin-top:20px;text-align: center;">
        <h2 style="font-weight: bold;font-size: 36px;padding-top: 30px;padding-bottom: 10px;color:#D9534F;">Gallery Pro</h2>
		<h6 style="font-size: 21px;padding-top: 10px;padding-bottom: 10px;margin-left:11px;font-family: Open Sans,sans-serif;
    line-height: 1.6em;">Gallery Pro is an Responsive plug-in with lot's of features and options for customizes the images for different views.</h6>
    </div>
	<hr>
	<div class="purchase_btn_div" style="margin-top:20px; margin-left:30px;">
		<h2 style="font-weight: bold;font-size: 24px;padding-top: 30px;">View Support Docs or Open a Ticket</h2>	
		<a id="btn-support" style= "margin-right:10px; margin-left:40px; margin-top:30px; text-decoration:none;" href="https://weblizar.com/forum/" target="_new" class="btn btn-primary btn-lg">View Support Docs or Open a Ticket</a>		
	</div>
	<hr>

	<hr>
	<div style="margin-top:30px;margin-left:30px;">
		<h2 style="font-weight: bold;font-size: 28px;padding-top: 30px;">Share Us Your Suggestion</h2>
		<h6 style="font-size: 18px;padding-top: 10px;padding-bottom: 10px;line-height:50px;">If you have any suggestion or features in your mind then please share us. We will try our best to add them in this plugin.</h6>
	</div>
	<hr>
	<div style="margin-top:30px;margin-left:30px;">
		<h2 style="font-weight: bold;font-size: 28px;padding-top:10px;">Language Contribution </h2>
		<h6 style="font-size: 18px;padding-top: 20px;padding-bottom: 10px;line-height:30px;margin-left:30px;">Translate this plugin into your language <br> Question : How to convert Plguin into My Language ? <br> Answer : Contact as to lizarweb@gmail.com  for translate this plugin into your language.</h6>
		
	</div>
	<hr>
	<div style="margin-top:30px;margin-left:30px;">
		<h2 style="font-weight: bold;font-size: 28px;padding-top:10px;">Change Old Server Image URL</h2>
		<form action="" method="post">
			<input type="submit" value="Change image URL" name= "lksgchangeurl" style= "margin-top:10px; margin-right:10px; margin-left:30px; background:#31B0D5; text-decoration:none;" class="btn btn-primary btn-lg">
			
			<h6 style="font-size: 22px;padding-top: 10px;padding-bottom: 10px;line-height:40px"><b>Note:</b> Use this option after import <b>Portfolio Settings</b> to change old server image url to new server image url.</h6>
		</form>
	</div>
</div>
<?php 
if(isset($_REQUEST['lksgchangeurl']))
{
	$lk_all_posts=wp_count_posts('acme_product')->publish;
	$args=array('post_type' => 'acme_product', 'posts_per_page' =>$lk_all_posts);

	global $lk_galleries;
	$lk_galleries= new WP_Query($args);

	while($lk_galleries->have_posts()) : $lk_galleries->the_post();

	$lk_id=get_the_ID();
	$lk_AllPhotosDetails = unserialize(base64_decode(get_post_meta( $lk_id, 'lksg_all_photos_details', true)));
	$total_img=get_post_meta($lk_id,'lksg_total_images_count',true);
	
	if($total_img)
	{
		foreach($lk_AllPhotosDetails as $lk_singlePhotosDetails)
		{
			$name					=$lk_singlePhotosDetails['lksg_image_label'];
			$img_url 				=$lk_singlePhotosDetails['lksg_image_url'];
			$img_thumb 				=$lk_singlePhotosDetails['lksg_img_thumb'];
			$img_medium 			=$lk_singlePhotosDetails['lksg_img_medium'];
			$img_large 				=$lk_singlePhotosDetails['lksg_img_large'];
			$img_medium_auto 		=$lk_singlePhotosDetails['lksg_img_medium_auto'];
			$img_large_auto 		=$lk_singlePhotosDetails['lksg_img_large_auto'];
			$video_link 			=$lk_singlePhotosDetails['lksg_video_link'];
			$external_link 			=$lk_singlePhotosDetails['lksg_external_link'];
			$portfolio_type 		=$lk_singlePhotosDetails['lksg_portfolio_type'];
			$img_desc 				=$lk_singlePhotosDetails['img_desc'];

			$upload_folder=wp_upload_dir();

			$data_url=$img_url;
			if(strpos($data_url, 'uploads')!==false)
			{
				list($other_path,$img_path)=explode("uploads", $data_url);
				$img_url=$upload_folder['baseurl'].$img_path;
			}

			$data_url=$img_thumb;
			if(strpos($data_url, 'uploads')!==false)
			{
				list($other_path,$img_path)=explode("uploads", $data_url);
				$img_thumb=$upload_folder['baseurl'].$img_path;
			}

			$data_url=$img_medium;
			if(strpos($data_url, 'uploads')!==false)
			{
				list($other_path,$img_path)=explode("uploads", $data_url);
				$img_medium=$upload_folder['baseurl'].$img_path;
			}

			$data_url=$img_large;
			if(strpos($data_url, 'uploads')!==false)
			{
				list($other_path,$img_path)=explode("uploads", $data_url);
				$img_large=$upload_folder['baseurl'].$img_path;
			}

			$data_url=$img_medium_auto;
			if(strpos($data_url, 'uploads')!==false)
			{
				list($other_path,$img_path)=explode("uploads", $data_url);
				$img_medium_auto=$upload_folder['baseurl'].$img_path;
			}

			$data_url=$img_large_auto;
			if(strpos($data_url, 'uploads')!==false)
			{
				list($other_path,$img_path)=explode("uploads", $data_url);
				$img_large_auto=$upload_folder['baseurl'].$img_path;
			}

			
			$image_array[]=array(
				'lksg_image_label'		=>$name,
				'lksg_image_url'		=>$img_url,
				'lksg_img_thumb'		=>$img_thumb,
				'lksg_img_medium'		=>$img_medium,
				'lksg_img_large'		=>$img_large,
				'lksg_img_medium_auto'	=>$img_medium_auto,
				'lksg_img_large_auto'	=>$img_large_auto,
				'lksg_video_link'		=>$video_link,
				'lksg_external_link'	=>$external_link,
				'lksg_portfolio_type'	=>$portfolio_type,
				'img_desc'				=>$img_desc,
				

				);

			update_post_meta($lk_id, 'lksg_all_photos_details', base64_encode(serialize($image_array)));
		}
	}
	
	endwhile;
	
}

?>