<?php 
	include_once("common_function.php");
	include_once("header.php");
	$product_obj  = new Products();
	
	$get_all_cats =  $product_obj->getAllProductCategories();	
	//echo "<pre/>";print_r($get_all_cats);exit;
		
?>

	<div class="section-mid">
		<div class="section-middle-pro">
			<div class="new-pro-master">
				<div class="new-pro-new" style="margin-top:-2px;" >
						<p class="probtnp"> PRODUCTS </p>
				</div>
<!-- 	
<ul>
	  <li style="margin-top:20px;"> <h5><a href="<?=SITEPATH?>products/new_products/">new products</a></h5> </li>
	  <li> <h5><a href="<?=SITEPATH?>products/freeform_amino_acids/">amino acids</h5></a></li>
	  <li> <h5><a href="<?=SITEPATH?>products/hq_protein_powders/">protein</h5></a></li>
	  <li> <h5><a href="<?=SITEPATH?>products/multivitamin_mineral_formulas">multiples</h5></a></li>
	  <li> <h5><a href="<?=SITEPATH?>products/vitamins">vitamins</h5></a></li>
	  <li> <h5><a href="<?=SITEPATH?>products/minerals">minerals</h5></a></li>
	  <li> <h5><a href="<?=SITEPATH?>products/all_products">more...</h5></a></li>
</ul> -->
			<?
			if(count($get_all_cats)){
				echo '<div class="pro-container">';
				for($i= 0; $i < count($get_all_cats);$i++ ){
					$is_subcat_exit = $product_obj->checkIfSubCatExists($get_all_cats["$i"]["cat_id"]);
				?>
				
						
				<div style="margin-top:4px; ">	
				
							
					<div style="float:left;width:15%; margin-left:4%; padding-top:3px;"> <a href="<?=SITEPATH?>products/<?=$get_all_cats["$i"]["url_alias"]?>" style="text-decoration:none;color:#C0C0C0 !important"><img src="<?=SITEPATH?><?=$get_all_cats["$i"]["cat_image"]?>" width="42" height="40" /></a> </div>
					<div style="float:left;color:#C0C0C0;font-size:16px;margin-left:10px;width:58%;  padding:5px 0 5px 0;">
						<a href="<?=SITEPATH?>products/<?=$get_all_cats["$i"]["url_alias"]?>" style="text-decoration:none; color:#bb25d6 !important;"><?=$get_all_cats["$i"]["cat_name"]?></a>
						
						<br/>
						<div style="height:7px;"> </div>
						
						<a href="<?=SITEPATH?>products/<?=$get_all_cats["$i"]["url_alias"]?>" style="text-decoration:none; font-size:12px; color:#808080 !important"><?=$get_all_cats["$i"]["cat_desc"]?></a>
						
						
					</div>
					<div style="float:right; margin-left:5%; width:10%; margin-top:4px;"> <a href="<?=SITEPATH?>products/<?=$get_all_cats["$i"]["url_alias"]?>" style="text-decoration:none;color:#bb25d6 !important"><img src="<?=SITEPATH?><?=$product_obj->right_arrow?>" width="11" height="23" /></a></div>
					<div class="clear"> </div>
				</div>	
					
					
					<div style="background-color: #808080;height: 1px;
	width: 92%;margin: 5px auto;clear :both;" > </div>
					
				<?	
				}	
				echo '</div>';
			}else {
				
				// no categories found under database
	
			}

		 
			?>
			</div>
		</div>
	</div>
<?php include_once("footer.php");?>
	