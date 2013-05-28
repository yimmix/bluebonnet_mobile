<?	
	include_once("header.php");
?>
<div style="min-width:320px; max-width:100%; margin:0px auto;" >

    <!--- middle part --->
	<div class="clear">
            </div>
    <div class="maincontainer">
		<!-- banner -->
	<? //=$default_banner_img?>
	<div id="forBanner">
	 
		<div id="bannerContainer" >
			<a href=<?=$default_banner_link?> id="banner_href"> 
			<img src=<?=$default_banner_img?>  style="min-width:287px; width:100%; max-height:345px;" id="banner-img"  height="150"/>						
			</a>
			
			
			<div style="background-color:#EBEBEB; padding: 2px 0 2px 0;width:100%; height:20px;text-align:center;"> 
				<div style="margin:0px auto; width:200px; color:#000;" id="banner_icons">
					
				</div>
			</div>  
			
		</div>
		 
	</div>		
		
	<div class="clear">
            </div>
   		<div class="Sboxmain1">
	
        <div class="innermain">
			<a href="<?=SITEPATH?>about/company"><div class="abt-btn"><p>ABOUT US</p></div></a>
            <a href="<?=SITEPATH?>product_types"><div class="pro-btn"><p>PRODUCTS</p></div></a>
            <a href="<?=SITEPATH?>contact_us"><div class="cont-btn"><p>CONTACT US</p></div></a>
            <a href="<?=SITEPATH?>store_locator"><div class="sloc-btn"><p>STORE LOCATOR</p></div></a>
         </div>
      </div>
    </div>
    <!--- middle part --->
	</div>
<? 
	include_once("footer.php");

?>