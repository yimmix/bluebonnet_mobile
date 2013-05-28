<?php 
	include_once("header.php");
	include_once("common_function.php");
	if(isset($_REQUEST['pid'])){
		$pid = $_REQUEST['pid'];

	}
	
?>
	
	<div class="section-middle-sup">
	<?php
	$product_obj  = new Products();
	$product_details = $product_obj->getProductDetails($pid);
	$product_image = $product_obj->getProductImage($pid);
	$product_sup_image = $product_obj->getSupplementImage($pid);
	
	$sup_details = $product_obj->getSupFactDetail($pid);
	$serving_size = $product_obj->getServingSize($pid); 	
	$breadCrumb = $product_obj->getProductBreadcrumb($pid);
	if(!is_null($sup_details)) {
	
	?>
	
	  <div class="sectiomiddle-pro">
		<div class="section-2q">
		<? include_once("search_form.php");?>
		<div class="p-heading">PRODUCTS </div>
		<div class="line_break"></div>	
		<div class="new-pro-new">
			<div class="probtnp"><?=$product_details['category']?></div>
		</div>
		 <div style="color:#9364AA; font-family:Trebuchet MS,Georgia,Arial,Helvetica; font-size:12px;margin-left:2%;margin-top:5px;"><?=$breadCrumb?></div>  
		  <div class="headin-text-1"> 
		  <img src="<?=$product_details['produc_image']?>"  class="inner-image" title="<?=$product_details['product_name']?>" />
			<h3 style="font-size:14px;"> <?=$product_details['product_name']?></h3>
			
		  </div>
		  <div class="clear"></div>
		  <div class="pad-top-bot"><b>Supplement Facts</b></div>
		  <div class="pad-top-bot"><? if(!empty($serving_size)) echo '<b>Serving size '.$serving_size."</b>"; ?></div>
		   <hr class="thick-hr" />
		  <div><div style="width:45%;float:left" class="pad-top-bot" ><b>Amount
Per Serving</b></div><div style="width:10%;float:left;">&nbsp;</div><div style="width:30%;float:right;text-align:right;margin-right:5px;"><b>% Daily
Value</b></div></div>
		  <hr class="thin-hr" />	
		  <?
			for($i=0; $i<count($sup_details);$i++) {
				
				if($sup_details["$i"]["isbreak"] == 1) {
					
					echo '<hr class="thick-hr" />';
					continue;	
				}	
								
				if(!empty($sup_details["$i"]["section_name"])) { 
				

				?>	
				   <div class="pad-top-bot"><b><?=$sup_details["$i"]["section_name"]?></b></div>
				   <hr class="line-separator" />
				<?
					continue;	
				}
				
				
				?>			
				<div> 
					<? if($sup_details["$i"]["indent"] == 1) {
						$ingredint_text = $sup_details["$i"]["ingredient_text"];
						if(!empty($sup_details["$i"]["ingredient_text_2"])) {
							$ingredint_text .= $sup_details["$i"]["ingredient_text_2"];
						}
						echo "<div style='width:50%;float:left;' class='pad-top-bot' >".$ingredint_text."</div>";
						
					} else { ?>
						<div style="width:50%;float:left;" class="pad-top-bot" >
						<? $ingredint_text2 = $sup_details["$i"]["ingredient_text"];
							if(!empty($sup_details["$i"]["ingredient_text_2"])) {
								$ingredint_text2 .= $sup_details["$i"]["ingredient_text_2"];
							}
						echo $ingredint_text2;?></div> 
						
					<? }
					
					?>
					
				<? if(!empty($sup_details["$i"]["qty"])) {
							if(!empty($sup_details["$i"]["unit"])) { 
							$unit = $sup_details["$i"]["unit"];
						
						}
						?>
							<div style="width:10%;float:left;text-align:right;" class="pad-top-bot"> 
								
							  <? 
							  $temp = isset($unit)?$unit:'';
							  $exp = '/^[0-9,\.]+$/';
							  echo $sup_details["$i"]['qty'];
							  if(!empty($sup_details["$i"]['qty']) && preg_match($exp,$sup_details["$i"]['qty'],$a)) {
									//print_r($a);
									echo $temp;
							  }
							  ?>	
							</div> 
						<? } if(!empty($sup_details["$i"]['dvp'])) {?>	
							<div style="width:27%;float:left;text-align:right;margin-right:2px;" class="pad-top-bot" ><?=$sup_details["$i"]['dvp']?></div> 
						<? } ?>	
				</div>	
				<?
				if($sup_details[$i+1]["isbreak"] != 1) { ?>	
				<hr class="line-separator" />
				
				<?
				}
			}


		 ?>	
		<div class="clear"> </div>
				
		  <div class="suple" ><a href="<?=SITEPATH?>product/<?=$pid?>/<?=rawurlencode($product_details['url_alias'])?>">PRODUCT PAGE</a></div>
	  
		  <div class="clear"> </div>
	  
		</div>
	</div>
	
	<? } else {
		echo '<div class="line_break"></div>';
		echo "<div style='color:#EB0B0B;margin-left:20px;margin-bottom:20px;'>Sorry No data match the given criteria!</div>";
	}
	?>
	</div>
	<?php include_once("footer.php");?>