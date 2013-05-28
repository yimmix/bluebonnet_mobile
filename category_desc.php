<?php 
	include_once("common_function.php");
	include_once("header.php");
	
	$product_obj  = new Products();
	if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])) {
		$cat_id = $_GET['cat_id']; 
		$mainCatDesc = $product_obj->getCatDescName($cat_id);
		$catName = $mainCatDesc['category_name'];
		$cat_content = $mainCatDesc['short_desc'];
	?>
		<div class="section-middle-whitenew">
			<? include_once("search_form.php");?>
			<div class="p-heading">PRODUCTS </div>
			<div class="line_break"></div>	
			<div class="category_head"><?=$catName?></div>
			<div class="line_break"></div>
			<? 
				$domDocument = new DOMDocument;
				$domDocument->loadHTML($cat_content);
				//code for removing table data
				$domNodeList = $domDocument->getElementsByTagname('table');
				
				foreach($domNodeList as $domElement) {
					$domElement->parentNode->removeChild($domElement);
				}
				//code fo removing h3 
				$domNodeList2 = $domDocument->getElementsByTagname('h3');
				foreach($domNodeList2 as $domElement) {
					$domElement->parentNode->removeChild($domElement);
				}
				//code for removing paging div
				$xPath = new DOMXPath($domDocument);
				$nodes = $xPath->query('//*[@class="paging_bar"]');
				if($nodes->item(0)) {
					$nodes->item(0)->parentNode->removeChild($nodes->item(0));
				}
				
				$net_content = $domDocument->saveHTML();
				//code for removing parenthesis text
				$net_content = preg_replace("#\((.*?)\)#","",$net_content);
				$net_content = preg_replace("/<img[^>]+\>/i", "", $net_content); 
				echo chrToEntityConversion($net_content);
			?>
			
		</div>
	
	<? 
	}else{
		echo '<div class="line_break"></div>';
		echo "Sorry no match Found!";
	
	}
	include_once("footer.php");

?>

