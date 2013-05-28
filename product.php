<?php 
	include_once("common_function.php");
	include_once("header.php");

	$product_obj  = new Products();
		if(isset($_REQUEST['cat'])){
		$cat = $_REQUEST['cat'];
	 
	}else{
		$cat = '';
	}
	if(isset($_REQUEST['sub_cat'])){
		$sub_cat = $_REQUEST['sub_cat'];
	 
	}else{
		$sub_cat = '';
	}
	$all_sub_categories = $product_obj -> getAllSubCategories();
	$sub_cat_id = array_search($sub_cat,$all_sub_categories);
	$subCatName = $product_obj ->getSubCatName($sub_cat_id);

	$ptype = $cat."/".$sub_cat;
	if(in_array($sub_cat,$all_sub_categories)){
		
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 0;
		}
		$page_name = rtrim($_SERVER['PHP_SELF'], ".php"); 
		$paginate = new Pagination(); 
		$total_product = $product_obj->totalSubCatProduct($sub_cat_id);
		$product_lists = $product_obj->getSubCatProducts($page,$sub_cat_id);
		$pagination_str = $paginate->getPagination($total_product,$page_name,$page,$ptype);
	
		?>
		<div class="section-middle-white">
			<div class="section-middle-white-2">
				<? include_once("search_form.php");?>
				<div class="p-heading">PRODUCTS</div>
				<div class="line_break"></div>	
	
				<div style="color:#9364AA; font-family:Trebuchet MS,Georgia,Arial,Helvetica;margin-left:1%;margin-top:10px;text-transform:uppercase;"><?=chrToEntityConversion($subCatName)?></div>
		
				<div class="line_break"></div>	
				<div style="margin:0 auto;width:98%">
		
				<?
				for($i=0; $i<count($product_lists);$i++){
		
				?>
					<div style="width:48%;float:left">
						<div style="30%; float:left; margin-left:10%;"> <a href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" >
						<img src="<?=$product_lists["$i"]["filepath"]?>" title="<?=chrToEntityConversion($product_lists["$i"]["product_name"])?>"  width="100%"  /></a> </div>
						<div style="70%; clear:both; max-width:100px; margin-left:2%; text-align:center;"><a style="text-decoration:none;font-size:10px;color:#000;" href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" > <?=strtoupper(chrToEntityConversion($product_lists["$i"]["product_name"]))?></a> </div> 
					</div>
				<? 
				$i++;
				
				if(isset($product_lists["$i"]["product_id"])){
				?>
					<div style="width:48%;float:left">
						<div style="30%; float:left; margin-left:10%;"> <a href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" >
						<img src="<?=$product_lists["$i"]["filepath"]?>" title="<?=chrToEntityConversion($product_lists["$i"]["product_name"])?>"  width="100%"  /></a> </div>
						<div style="70%; clear:both; max-width:100px; margin-left:2%; text-align:center;"> <a style="text-decoration:none;font-size:10px;color:#000;" href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" ><?=strtoupper(chrToEntityConversion($product_lists["$i"]["product_name"]))?></a> </div> 
					</div>
									
				<?
				}
				if(($i == count($product_lists)-1) && empty($pagination_str)) { 
					echo "<div class='clear'>&nbsp;</div>";
					break;
				}else
				 {
					echo "<div class='line_break'>&nbsp;</div>";
				 }
			}	
			
			?>
			</div>
				<?=$pagination_str;?>
			</div>
		
		<?
		}else {
		?>
			<div class="section-middle">
				<div>Search did not found any result </div>
				<ul>
					<li>Try to modify your serach criteria</li>
				</ul>	
			</div>
		<?
		}
		
	?>
	</div>
	<? include_once("footer.php");?>	