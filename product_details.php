<?php 
	include_once("common_function.php");
	include_once("header.php");
	// product_details is set in header part
	$cur_url = getCurrentPageUrl();		
	if(isset($_REQUEST['pid'])){
		$pid = $_REQUEST['pid'];
	}
	
	$paginate = new Pagination(); 
	$product_obj  = new Products();
	$breadCrumb = $product_obj->getProductBreadcrumb($pid);
	$product_name = chrToEntityConversion($product_details['product_name']);
	$host_name = $url_com['scheme']."://".$url_com['host']; 
	$currenT_page = $url_com['path'];
	$dir_sep = SITEPATH?'':'/'; 
	$prod_img_path = urlencode(trim($host_name.$dir_sep.$product_details['produc_image']));
?>

	<div>
		<div class="contact-midle">
			<? include_once("search_form.php");?>
			<div class="p-heading">PRODUCTS </div>
			<div class="line_break"></div>	
		
		  <div class="breadcrum"><?=chrToEntityConversion($breadCrumb)?></div>
		 <div class="new-pro-new">
        <p class="probtnp"><?=chrToEntityConversion($product_details['category'])?></p>
      </div>
		  <div class="headin-text-1"> 
		  <a href="<?=$currenT_page?>"><img src="<?=$product_details['produc_image']?>"  class="inner-image" title="<?=chrToEntityConversion($product_details['product_name'])?>"  /></a>
			<h3 style="font-size:14px;margin-bottom:10px;"> <a href="<?=$currenT_page?>" style="text-decoration:none;color:#000;"><?=chrToEntityConversion($product_details['product_name'])?></a></h3>
			<span style="color:#424242;"><?=chrToEntityConversion($product_details['description'])?></span>
		  </div>
		  <div class="clear"></div>
		
		  <div class="socio">  <div class="share"><b>SHARE : </b>
			<div id="social-icons" style="display:none;margin-top:10px;">
				<div style="text-align:left;padding:2px 0px 0px 3%" id="fb-root" ><fb:like href="<?=urlencode($cur_url)?>" layout="button_count" ref="mobile_pd" send="false" show_faces="true"></fb:like></div>
				<script type="text/javascript">
					(function(d, s, id) 
					{
					  var js, fjs = d.getElementsByTagName(s)[0];  
					  if (d.getElementById(id)) 
					  {
						return;
					  }  
					  js = d.createElement(s); 
					  js.id = id;
					  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);  
					}
					(document, 'script', 'facebook-jssdk'));
				</script>
				
				<div style="text-align:left; padding:2px 0px 0px 3%" ><div id="fb-root"></div><fb:send href="<?=
				$cur_url?>"></fb:send></div>

				<div style="text-align:left; padding:2px 0px 0px 3%"  > <a href="http://twitter.com/home/?status=<?=urlencode($cur_url)?>" target="_blank"><img src="<?=SITEPATH?>images/Tweet.gif" alt="Share on Twitter"></a></div>
				<div style="text-align:left;  padding:2px 0px 0px 3%;"  ><g:plusone size="medium" count="true" href="<?=$cur_url?>"></g:plusone></div>
				<div style="text-align:left;padding:2px 0px 0px 3%;">
				<script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>	
					<a href="http://pinterest.com/pin/create/button/?url=<?=urlencode($cur_url)?>&media=<?=$prod_img_path?>&description=<?=urlencode($product_name)?>" class="pin-it-button" count-layout="horizontal" target="_blank" ><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a> 
				</div>		
				<script>
					(function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					})();
				</script>
			</div>
		  </div> 
		  
		  <div style="float:right;"><img src="<?=SITEPATH?>images/social.png"  onclick="javascript:showHideIcon();" /></a></div>
		  </div>
		 
		  <div class="clear"> </div>
		  <div style="width:119px; height:35px; margin:10px 10px 0 0; float:right;"><a href="<?=SITEPATH?>store_locator"><img src = "<?=SITEPATH?>images/buy.png" /></a></div>
				
				<div class="clear"> </div>
				
		  <div class="suple" ><a href="<?=SITEPATH?>suppliment_facts/<?=$pid?>">Supplements facts</a></div>
	  
		  <div class="clear"> </div>
	  
		</div>
	</div>
	
	<?php include_once("footer.php");?>