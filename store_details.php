<?php
	include_once("common_function.php");
	include_once("header.php");
	$store_obj = new StoreLocator(); 
	$default_lat = $_GET['lat'];
	$default_long = $_GET['long'];
	$get_store_det = $store_obj->getStoreDetails($default_lat,$default_long);

	if(!empty($get_store_det)) {
	//echo "<pre/>";print_r($get_store_det); exit;
	$all_locator = $get_store_det['all_locators'];
	//echo "<pre/>";print_r($all_locator); exit;
	$store_marker = $get_store_det['store_markers'];

?>
	<div class="section-middle-white">
	   <div class="new-pro-new">
         <p class="probtnp"> store locator </p>
       </div>
		<div id="map" style="margin:0 auto;width:98%;height:250px;"></div>
	<? 
	if(!empty($all_locator)){
		echo '<div style="width:98%;margin:0 auto;margin-top:10px;">';
		foreach($all_locator as $store) {	
		
		?>
		<div class='store-locator-heading'><a href="<?=SITEPATH?>store_details?lat=<?=$store['lat']?>&long=<?=$store['long']?>"><?=strtoupper(stripslashes($store['name']))?></a></div>
		<div class='store-locator-detail'><?=strtoupper($store['address'])?></div>
		<div class='store-locator-detail'><?=strtoupper($store['city'])?>&nbsp;(<?=strtoupper($store['state'])?>)</div>
		<div class='store-locator-detail'><?=strtoupper($store['zip'])?></div>
		<div class='store-locator-detail'><?=strtoupper($store['phone'])?></div>
		<br/>
		
		<?
		}
		echo '</div>';	
     }	
	  ?>	

	<script type="text/javascript">
		<?
		if(isset($store_marker)) { ?>
		var markers = <?=$store_marker?>;
		
		 init_map("map", <?=$default_lat?>, <?=$default_long?>, 11);
		 <? } ?>
	
		
	</script>
	
<? } else {
	echo "Result not found !";
}
include_once('footer.php');
?>