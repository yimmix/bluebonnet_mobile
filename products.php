<?php 
	include_once("common_function.php");
	include_once("header.php");
	
	$product_obj  = new Products();
	$all_categories = $product_obj -> getAllMainCategories();
	
	if(isset($_REQUEST['ptype'])){
		$ptype = $_REQUEST['ptype'];
	 
	}else{
		$ptype = '';
	}
	$category = $product_obj->getCategoryName($ptype); 
	?>
	<div class="section-middle-white">
	<div class="section-middle-white-2">
	<?
		if(in_array($ptype,$all_categories)){
		
		$cat_id = array_search($ptype,$all_categories);
		$is_subcat_exit = $product_obj->checkIfSubCatExists($cat_id);
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 0;
		}
		$page_name = rtrim($_SERVER['PHP_SELF'], ".php"); 
		switch($is_subcat_exit){
			CASE 0:
				$paginate = new Pagination(); 
				$total_product = $product_obj->totalProductCnt($ptype);
				$product_lists = $product_obj->getProducts($page,$ptype);
				$pagination_str = $paginate->getPagination($total_product,$page_name,$page,$ptype);
				?>
				
					<? include_once("search_form.php");?>
					<div class="p-heading">PRODUCTS </div>
					<div class="line_break"></div>	
					<div class="product-cat-head"><?=$category?></div>
		
					<div class="line_break"></div>	
					<div style="margin:0 auto;width:98%">
		
					<?
						for($i=0; $i<count($product_lists);$i++){
		
					?>
					<div class="product-list">
						<div class="product-url"> <a href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" >
						<img src="<?=$product_lists["$i"]["filepath"]?>" title="<?=
chrToEntityConversion($product_lists["$i"]["product_name"])?>"  width="100%"  /></a> </div>
						<div class="product-name"><a style="text-decoration:none;font-size:10px;color:#000;" href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" ><?=strtoupper(chrToEntityConversion($product_lists["$i"]["product_name"]))?></a></div> 
					</div>
				<? 
				$i++;
				
				if(isset($product_lists["$i"]["product_id"])){
				?>
					<div class="product-list">
						<div class="product-url"> <a href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=$product_lists["$i"]["url_alias"]?>" >
						<img src="<?=$product_lists["$i"]["filepath"]?>" title="<?=chrToEntityConversion($product_lists["$i"]["product_name"])?>"  width="100%" /></a> </div>
						<div class="product-name"><a style="text-decoration:none;font-size:10px;color:#000;" href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" ><?=strtoupper(chrToEntityConversion($product_lists["$i"]["product_name"]))?></a></div> 
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
				break;	
			
			Default :
				
					$mainCatDesc = $product_obj->getCatDescName($cat_id);
					$short_desc = strip_tags($mainCatDesc['short_desc']);
					$short_desc = getSpecifiedCharFrmStr($short_desc,120);
					$subCatDetails =  $product_obj->getSubCategories($cat_id);
					
					?>
					<div class="pro-container">
						<div>	
							<div class="main-cat"><a href="<?=SITEPATH?>category_desc?cat_id=<?=$cat_id?>"><?=chrToEntityConversion($mainCatDesc['category_name'])?></a></div>
							<div class="product-short-desc"><?=chrToEntityConversion($short_desc)?>...<span class="read-more"><a href="<?=SITEPATH?>category_desc?cat_id=<?=$cat_id?>">&nbsp;READ MORE&nbsp;<img src="<?=SITEPATH?>images/read-more.jpg" alt="Read More" /></a></span></div>
							<div class="divider" > </div>
							
							<?
								for($i=0;$i< count($subCatDetails);$i++) {
										if($subCatDetails["$i"]["category_id"] == 44){
											continue;
										}
									?>
									<div>
										<div class="sub-cat-name"><a href="<?=SITEPATH?>product/<?=$subCatDetails["$i"]["path_url"]?>" ><?=chrToEntityConversion($subCatDetails["$i"]["category_name"])?></a> </div>
										<div class="arrow-img"><a href="<?=SITEPATH?>product/<?=$subCatDetails["$i"]["path_url"]?>" ><img src="<?=SITEPATH?><?=$product_obj->right_arrow?>" width="11" height="23" /></a></div>
									
									</div>
									
									<?
									if($i == count($subCatDetails)-1){
										break;
									}else {
										?>
										<div class ="divider" > </div>	
										<?
									}		
								}
							?>			
							
						</div>	
						
					</div>
				
<div style="height:35px;">  </div>					
					<?
		
				break;
		
		}
		
	 
	 ?>
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
