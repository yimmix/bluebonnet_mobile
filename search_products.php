<?php 
		include_once("common_function.php");
		include_once("header.php");

		$cond = "";
		$filter_options = array();
		$page_name = rtrim($_SERVER['PHP_SELF'], ".php"); 
		if($_GET['page']) {
			$page  = $_GET['page'];
		}else {
			$page = 0;		
		}
		if(isset($_GET['kwd'])) {
			$kwd = trim($_GET['kwd']);

		}else {
			$kwd = '';
		}
		$page_name = $page_name."?"."kwd=".$kwd;
		$lab_cnt = 0;
		if(isset($_GET['label_30'])) {
			$label_30 = $_GET['label_30'];
			$page_name .= "&label_30=".$_GET['label_30'];
			$val = 30;
			$cond .= " AND P.product_id IN 
	(SELECT product_id from product_labels where label_id= ".$val;
			$lab_cnt++;
		}
		if(isset($_GET['label_31'])) {
			$label_31 = $_GET['label_31'];
			$page_name .= "&label_31=".$_GET['label_31'];
			$val = 31;
			$cond .= " AND P.product_id IN 
	(SELECT product_id from product_labels where label_id=".$val;
			$lab_cnt++;
		}
		if(isset($_GET['label_38'])) {
			$label_38 = $_GET['label_38'];
			$page_name .= "&label_38=".$_GET['label_38'];		
			$val = 38;
			$cond .= " AND P.product_id IN 
	(SELECT product_id from product_labels where label_id=".$val;
			$lab_cnt++;

		}
		if(isset($_GET['label_39'])) {
			$label_39 = $_GET['label_39'];
			$page_name .= "&label_39=".$_GET['label_39'];	
			$val = 39;
			$cond .= " AND P.product_id IN 
	(SELECT product_id from product_labels where label_id=".$val;
			$lab_cnt++;
		}
		if(isset($_GET['label_64'])) {
			$label_64 = $_GET['label_64'];
			$page_name .= "&label_64=".$_GET['label_64'];	
			$val = 64;
			$cond .= " AND P.product_id IN 
	(SELECT product_id from product_labels where label_id=".$val;
			$lab_cnt++;
		}
		if(isset($_GET['label_7'])){
			$label_7 = $_GET['label_7'];
			$page_name .= "&label_7=".$_GET['label_7'];	
			$val = 7;
			$cond .= " AND P.product_id IN 
	(SELECT product_id from product_labels where label_id=".$val;
			$lab_cnt++;
		}
		for($i=0;$i<$lab_cnt;$i++) {
			$cond .= " )";
		
		}
		
		/*if(!empty($kwd)) {
			$cond .= " AND p.product_desc like '%".$kwd."%'";	
		}
		*/
		?>
			<div class="section-middle-white">
			<div class="section-middle-white-2">
		<?
		$paginate = new Pagination(); 
		$product_obj  = new Products();
		
		$total_product = $product_obj->cntSearchedproduct($cond,$kwd);
		if($total_product > 0){
		
		$product_lists = $product_obj->getSearchedProductsDetail($page,$cond,$kwd);
		$filter_options = $product_obj->getFilterOptions($page,$cond,$kwd);
		$pagination_str = $paginate->getStorePagination($total_product,$page_name,$page);
		$product_to_frm_text = $product_obj->getProductCountsText($page,$total_product);
		
		?>
		
	
			<div class="p-heading">PRODUCTS</div>
			<div class="line_break"></div>	
			
			<div>
				<div id="search-frm-div">
					<form method="get" action="<?=SITEPATH?>search_products" id="form_search" name="form_search">
				 
							<div class ="search-head">Search: </div>
							
							<div style="margin-left:9px;float:left;"><input type="text"  name="kwd" class="search-field" value="<?=$kwd?>" size="23px" ></div>
							<div style="margin-left:5px;float:left;"><input type="image" src="<?=SITEPATH?>images/bt_go.gif"></div>
							<div class="clear"></div>
										
				 
					</form>
				
				
				</div>
				
				<div >
				<div class="filter_head">Filter: </div>
				<div class="filter-opt">
				<form method="GET" action="" name="filter_frm" id="filter_frm" >
					
					<input type="hidden" value="<? if(isset($_GET['kwd'])) echo $_GET['kwd'];?>" name="kwd">
					<input type="hidden" value="<? if(isset($_GET['x'])) echo $_GET['x'];?>" name="x">
					<input type="hidden" value="<? if(isset($_GET['y'])) echo $_GET['y'];?>" name="y">
					<ul id="filter_list">
						<? 
							//print_r($filter_options);
						if(empty($filter_options)) {
						?>
						<li> <input type="checkbox" value="t" name="label_30" id="label_30" <? if(isset($_GET['label_30']) && $_GET['label_30'] == 't') echo "checked=checked";?>>
						<label for="label_30">Gluten Free</label></li>
						<li> <input type="checkbox" value="t" name="label_31" id="label_31" <? if(isset($_GET['label_31']) && $_GET['label_31'] == 't') echo "checked=checked";?>>
						<label for="label_31">Healthy Heart Food</label></li>
						<li> <input type="checkbox" value="t" name="label_38" id="label_38" <? if(isset($_GET['label_38']) && $_GET['label_38'] == 't') echo "checked=checked";?>>
						<label for="label_38">Kosher Dairy</label></li>
						<li> <input type="checkbox" value="t" name="label_39" id="label_39" <? if(isset($_GET['label_39']) && $_GET['label_39'] == 't') echo "checked=checked";?> > 
						<label for="label_39">Kosher Parve</label></li>
						<li> <input type="checkbox" value="t" name="label_64" id="label_64" <? if(isset($_GET['label_64']) && $_GET['label_64'] == 't') echo "checked=checked";?>> 
						<label for="label_64">Vcap</label></li>
						<li> <input type="checkbox" value="t" name="label_7" id="label_7" <? if(isset($_GET['label_7']) && $_GET['label_7'] == 't') echo "checked=checked";?>> 
						<label for="label_7">Vegetarian</label></li>
						<? 
						}else {
								
								if(!empty($filter_options)){
									for($i=0; $i< count($filter_options);$i++){
									?>
									<li> <input type="checkbox" value="t" name="label_<?=$filter_options["$i"]["0"]?>" id="label_<?=$filter_options["$i"]["0"]?>" <? if(isset($_GET["label_".$filter_options["$i"]["0"]]) && $_GET["label_".$filter_options["$i"]["0"]] == 't') echo "checked=checked";?>>
									<label for="label_<?=$filter_options["$i"]["0"]?>"><?=$filter_options["$i"]["1"]?></label></li>
									<?
							
									}
								}
							}	
					?>	
					</ul>
					<p class="submit-filter">
					 <input type="submit" value="Filter" name="bt_filter" id="bt_filter">
					</p>
				</form>	
				</div>
				</div>
			</div>	
		<div class="clear;">&nbsp;</div>
		

		<div class="line_break"></div>	
		<div style="margin:0 auto;width:98%">
		<div class="show-item"><?=$product_to_frm_text?></div>
		<?
			//echo $pagination_str;
			for($i=0; $i<count($product_lists);$i++){
				
				?>
					<div style="width:48%;float:left">
						<div style="30%; float:left; margin-left:10%;"> <a href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" >
						<img src="<?=$product_lists["$i"]["filepath"]?>" title="<?=chrToEntityConversion($product_lists["$i"]["product_name"])?>"  width="100%"  /></a> </div>
						<div style="70%; clear:both; max-width:100px; margin-left:2%; text-align:center;"><a style="text-decoration:none;color:#000;font-size:11px;"href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" ><?=strtoupper(chrToEntityConversion($product_lists["$i"]["product_name"]))?></a></div> 
					</div>
				<? 
				$i++;
				
				if(isset($product_lists["$i"]["product_id"])){
				?>
					<div style="width:48%;float:left">
						<div style="30%; float:left; margin-left:10%;"> <a href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" >
						<img src="<?=$product_lists["$i"]["filepath"]?>" title="<?=chrToEntityConversion($product_lists["$i"]["product_name"])?>"  width="100%"  /></a> </div>
						<div style="70%; clear:both; max-width:100px; margin-left:2%; text-align:center;"><a style="text-decoration:none;color:#000;font-size:11px;" href="<?=SITEPATH?>product/<?=$product_lists["$i"]["product_id"]?>/<?=rawurlencode($product_lists["$i"]["url_alias"])?>" ><?=strtoupper(chrToEntityConversion($product_lists["$i"]["product_name"]))?></a></div> 
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
			<div class="p-heading">PRODUCTS</div>
			<div class="line_break"></div>	
			<div class="section-middle">
				<div>Search did not found any result </div>
				<ul>
					<li style="margin-left:25px;">Try to modify your search criteria</li>
				</ul>	
			</div>
		<?
		}
		
	?>
	</div>
	<? include_once("footer.php");?>	
