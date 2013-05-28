<? 	
	//define('SITEPATH','/'); relative path not working on local so replace it with below line 
	define('SITEPATH','');  	
	include_once('common_function.php');
	$banners_img =  get_banner_imgs_href('img');
	$result_img_arr = "[";
	$img_link_arr = "[";
	$banner_rotator_time =  get_banner_rotation_time();
	if(empty($banners_img)) {
		$default_banner_img = 'banner-management/images/11.jpg';
	
	}else {
		$temp_arr = explode(",",$banners_img);
		$default_banner_img = $temp_arr[0];		
		$result_img_arr .= $banners_img;	
		$result_img_arr .= "]";
	}
	
	$banners_img_href = get_banner_imgs_href('href');
	if(empty($banners_img_href)) {
		$default_img_href = '';
	
	}else {
		$temp_arr = explode(",",$banners_img_href);
		$default_banner_link = $temp_arr[0];		
		$img_link_arr .= $banners_img_href;	
		$img_link_arr .= "]";
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="width=device-width, maximum-scale=1.0" name="viewport">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1" />
	<? 
	if(basename($_SERVER['PHP_SELF']) == 'product_details.php' && isset($_REQUEST['pid'])) {
		$pid = $_REQUEST['pid'];
		$product_obj  = new Products();
		$product_details = $product_obj->getProductDetails($pid);
		$title = $product_details['product_name'];
		$desc = getSpecifiedCharFrmStr($product_details['description']);	
		$img  = $product_details['produc_image'];
		$cur_url = getCurrentPageUrl();	
		$url_com = parse_url($cur_url);
		$host_name = $url_com['scheme']."://".$url_com['host']; 
		$dir_sep = SITEPATH?'':'/'; 
		$img2= trim($host_name.$dir_sep.$img);
		echo "<meta property='og:title' content='".$title."' />";
		echo "<meta property='og:image' content='".$img2."' />";
		echo "<meta property='og:description' content='".$desc."' />";
		
	}else {
		echo "<meta property='og:title' content='test' />";
		
	}
	?>	
	<base href="/" />
	<title>Bluebonnet - Mobile Website</title>
	<link rel="stylesheet" href="<?=SITEPATH?>css/style.css" />
	<link rel="stylesheet" href="<?=SITEPATH?>css/stylesheet.css" />
	<link rel="stylesheet" type="text/css" href="<?=SITEPATH?>css/sliderman1.css" />
	<link rel="stylesheet" href="<?=SITEPATH?>css/Selectyze.jquery.css" type="text/css" />    
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>	
	<script type="text/javascript" src="<?=SITEPATH?>js/google-map.js"></script>
	<script type="text/javascript" src="<?=SITEPATH?>js/sliderman.1.3.js"></script>
	<script src="<?=SITEPATH?>js/js-image-slider.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=SITEPATH?>js/jquery/jquery-select-menu.js"></script>
	<script type="text/javascript" src="<?=SITEPATH?>js/jquery/Selectyze.jquery.js"></script>
	<script type="text/javascript">
	
		$(document).ready(function(){
			$('.selectyze5').Selectyze({
				theme : 'css3'
			});
			
		});
		
		function showHideIcon() {
			var cur_elem = document.getElementById('social-icons');
			if(cur_elem.style.display == 'none') {
				cur_elem.style.display = 'block';
			}else {
				cur_elem.style.display = 'none';
			}
		
		}
		
	</script>

<!--  sytle for banner management -->	
<style type="text/css">
	#bannerContainer {
	  width: 100%;
	   
	  border:1px solid #424242;

	}
	#bannerContainer img {
		 
		margin:0px auto;

	}
	
	.banner_buttons {
		margin: 0 3px;
		padding-top: 5px;

	}

</style>
<!--  sytle for banner -->
	<?php 
		if(!empty($banners_img)) { ?>
	<!--  script for banner  -->
	
	<script type="text/javascript">
	var img_arr = <?=$result_img_arr?>;
	// img preloading 
	for(var x = 0; x < img_arr.length; x++) {
		var image = new Image();
		image.src = img_arr[x];
	}
	//preloading active non active img icons
	var acive = new Image();
	acive.src = "img/nav_active.gif"; 
	var non_active = new Image();
	non_active.src = "img/nav.gif";

	var href_arr = <?=$img_link_arr?>;
	var img_len =  img_arr.length; 
	var start= 0;
	var last = img_len -1;
	var default_banner = 0;
	
	function place_icons() {
		var img_icons = '<span id="icon0" style="margin-left:2px;"><img src= "img/nav_active.gif" alt="" class="banner_buttons" /></span>';
		for(i=0;i<img_len-1;i++){	
			var j = i+1;
			img_icons  = img_icons + '<span id="icon'+j+'" style="margin-left:2px;" ><img src= "img/nav.gif" alt="" class="banner_buttons" /></span>';	
		}
		document.getElementById("banner_icons").innerHTML = img_icons;
	}
	
</script>
	<?	
		}
	?>	
<!--   script for banner ends -->

	
</head>
<?php 
if(strpos($_SERVER['PHP_SELF'], 'index.php')) {
	


}

?>
<body  <? if(!empty($banners_img)) { ?> onload="javascript:place_icons();" <? } ?> >
<div class="wraper" style="min-width:320px; max-width:100%; margin:0px auto;">
	<!--- header --->
	 <div class="mainheader">
		<div class="logo"><a href="<?=SITEPATH?>"><img src="<?=SITEPATH?>images/logo.png" width="187" height="88" alt="logo" /></a></div>
        
		<div class="mainsocial">
		 
		   <div class="socialbox1">    
					 
					 <div class="btn1"> <a href="<?=SITEPATH?>search_products/"><img src="<?=SITEPATH?>images/search-bluebonnet.png" alt="search" width="27" height="26" /></a></div>
					 <div class="btn1"> <a href="http://link.brightcove.com/services/player/bcpid1450537862001?bckey=AQ~~,AAABSLEHQiE~,9jNr4k-ib9apPWDB6MdzgMwK02tj6J1N&bctid=1784859081001" target="_blank" ><img src="<?=SITEPATH?>images/youtube.png" alt="search" width="27" height="26" /></a></div>
					 <div class="btn1"> <a href="https://www.facebook.com/pages/Bluebonnet-Nutrition/173426126116"><img src="<?=SITEPATH?>images/facebook-icon.png" alt="facebook" /></a></div>
					 <div class="btn1"> <a href="https://twitter.com/#!/BluebonnetNutri"><img src="<?=SITEPATH?>images/twitter-icon.png" alt="tweeter" /></a></div>
					 <div class="btn1"> <a href="<?=SITEPATH?>"><img src="<?=SITEPATH?>images/home-icon.png" alt="home" /></a></div>
					 <div class="btn1"><img src="<?=SITEPATH?>images/back-btn.png" alt="back"  onclick="history.go(-1);return false;" /></div>
					 
		   </div>
				
			<div class="socialbox2">
				<img src="<?=SITEPATH?>images/new-header-image.png" alt="logo" align="right" />
			</div>
		</div>
	 </div>   
    <!--- /header --->