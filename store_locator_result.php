<?php
	include_once("common_function.php");
	include_once("header.php");
	$page_name = rtrim($_SERVER['PHP_SELF'], ".php"); 
 	if($_GET['page']) {
		$page  = $_GET['page'];
	}else {
		$page = 0;		
	}
	if($_GET['near'] && !empty($_GET['near'])) {
		$near = $_GET['near'];	
	}else {
		$near = "";
	}
	if($_GET['distance'] && !empty($_GET['distance'])) {
		$distance = $_GET['distance'];	
	
    }else {
		$distance = "";
	}	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 0;
	}
	$store_page = $page_name."?"."near=".$near."&distance=".$distance; 
	$store_obj = new StoreLocator(); 
	$pagObj = new Pagination(); 
	$total_count = $store_obj->cntTotalStores($near,$distance); 
	$pagination = $pagObj ->getStorePagination($total_count,$store_page,$page);
	$get_stores_det = $store_obj->getTotalStores($near,$distance,$page);
	if(!empty($get_stores_det)) {
	$all_locators = $get_stores_det['all_locators'];
	$store_markers = $get_stores_det['store_markers'];
	//echo $store_markers; exit;
	$default_lat = $store_obj->default_lat;
	$default_long = $store_obj->default_long;
	
 ?>
	<div class="section-middle-white">
		<div class="section-2q">
		<div class="new-pro-new">
        <p class="probtnp"> store locator </p>
      </div>
		<div id="map" style="margin:0 auto;width:98%;height:250px;"></div> 
		<?=$pagination?>
	
	<?
		if(!empty($all_locators)){
			echo '<div style="width:98%;margin:0 auto;margin-top:10px;">';
			$counter = 1;
			foreach($all_locators as $store) {	
				if($counter > count($all_locators)) {
				break;
			}
			?>
			<div class="<? if($counter %2 != 0) echo 'odd';else echo 'even';?>">
				<div class='store-locator-heading'><span><?=$counter?>.</span><span style="margin-left:5px;"><a href="<?=SITEPATH?>store_details.php?lat=<?=$store['lat']?>&long=<?=$store['long']?>"><?=strtoupper(stripslashes($store['name']))?></a></span></div>
				<div class='store-locator-detail'><a href="<?=SITEPATH?>store_details.php?lat=<?=$store['lat']?>&long=<?=$store['long']?>" style="text-decoration:none;color:#000;"><?=strtoupper($store['address'])?>&nbsp;(<?=strtoupper($store['city'])?></a>)</div>
				<div class='store-locator-detail'><?=strtoupper($store['phone'])?></div>
			</div>
				
			<?
			$counter ++;	
			}
		 echo '</div>';	
		 unset($counter);
		}	
	?>
	
</div>
		<script type="text/javascript">
			<?
			if(isset($store_markers)) { ?>
			var markers = <?=$store_markers?>;
			
			 init_map("map", <?=$default_lat?>, <?=$default_long?>, 11);
			 <? } ?>
		
			
		</script>
		<? } else {
			?>
			<div class="section-middle">
				<div class='line_break'>&nbsp;</div>
				<div style="margin-left:20px;color:#FF0000;" >Sorry Search did not found any result! </div>
							
			</div>
		<?	
		}

	 include_once("footer.php");

?>
	