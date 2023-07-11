<?php
$coursemax_options = coursemax_theme_options();

$banner_title = $coursemax_options['banner_title'];
$banner_desc = $coursemax_options['banner_desc'];

$banner_height = $coursemax_options['banner_height'];
$banner_bg_image = $coursemax_options['banner_bg_image'];
if(!empty($banner_bg_image)){
    $background_style = "style='background-image:url(".esc_url($banner_bg_image).")'";
}
else{
    $background_style = '';
}
if($banner_height){
    $height= $banner_height."px";
}

?>




<div class="hero-section" style="height: <?php echo esc_html($height); ?>; ">
	
     <div class="image" data-type="background" data-speed="2"  <?php echo wp_kses_post($background_style); ?>></div>
	 <div class="container">
    <div class="stuff" data-type="content">
	<h1><?php echo esc_html($banner_title); ?></h1>
		        <p><?php echo esc_html($banner_desc); ?></p>
		        
       
    </div>
				</div>
</div>


