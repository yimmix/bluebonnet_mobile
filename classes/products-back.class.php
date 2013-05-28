<?php

/*******************************************************************************
*  This class is used to get all product related datas.
*******************************************************************************/


	class Products extends SqlQuery{

		public $table = 'products';
		public $bread_crumb = "Products";
		public $right_arrow = "images/product/img-right.jpg";

		
		public function totalSubCatProduct($sub_cat_id) {
			$qry = "SELECT COUNT(*) AS num FROM  product_categories WHERE `category_id` = ".$sub_cat_id;
			//echo "cnt:".$cnt  = $this->cntNumRows($qry);exit;
			$rst = $this->dbQuery($qry);
		   if(!$rst){
				// sql execution error
				return 0;
			} else{
				$total_product = mysql_fetch_array($rst);
				$total_product = $total_product['num'];
				return $total_product;
				
			}	
		}
		
		//function to get option arry for serach filter
		public function getFilterOptions($page_cnt,$cond){
			
			$filter_arr  = array(30=>'Gluten Free',31=>'Healthy Heart Food',38=>'Kosher Dairy',39=>'Kosher Parve', 64=>'Vcap',7=>'Vegetarian');
			$filter_options = array();
			$qry = " SELECT  DISTINCT  p.*, pp.resource_id as main_picture_resource_id  from products p
			LEFT OUTER JOIN product_labels pl ON (pl.product_id = p.product_id) 
			LEFT OUTER JOIN labels l ON (l.label_id = pl.label_id) 
			LEFT OUTER JOIN product_pictures pp ON (pp.picture_id = p.main_picture) 
			LEFT OUTER JOIN suplement_facts sf ON (sf.product_id = p.product_id)  WHERE p.status='1' ";
						
			$this->end = 10;
			if($page_cnt == 0 || $page_cnt == 1){
				$this->start = 0;
			}else{
				$this->start = ($page_cnt-1)*10;
					
			}
			$qry .=	" ".$cond;
			$limit = " limit ".$this->start." , ".$this->end; 
			$order_by = " ORDER BY p.product_name ASC ";
			//$qry .= $order_by ." ".$limit; 
			$qry .= $order_by;
			
			$query = "SELECT DISTINCT label_id FROM product_labels WHERE product_id
			IN ( SELECT product_id FROM (".$qry.") p )";
			//echo $query;exit;
			$rst = $this->dbQuery($query);	
			$data_set = array(); 
			if(!$rst) {
			// sql execution error
		
			} else {
		
				while($rec = mysql_fetch_object($rst)) {
					if(array_key_exists ($rec->label_id ,$filter_arr ))
						$option_ids[] = $rec->label_id;
							
				}
				
				$counter = 0;
				if(in_array(30 ,$option_ids ))
				{
					$filter_options["$counter"] = array(30,$filter_arr["30"]);	
					$counter++;
				}	
				if(in_array(31 ,$option_ids ))
				{
					$filter_options["$counter"] = array(31,$filter_arr["31"]);	
					$counter++;
				}	
				
				if(in_array(38 ,$option_ids ))
				{
					$filter_options["$counter"] = array(38,$filter_arr["38"]);	
					$counter++;
				}	
				if(in_array(39 ,$option_ids ))
				{
					$filter_options["$counter"] = array(39,$filter_arr["39"]);	
					$counter++;
				}	

				if(in_array(64 ,$option_ids ))
				{
					$filter_options["$counter"] = array(64,$filter_arr["64"]);	
					$counter++;
				}	

				if(in_array(7 ,$option_ids ))
				{
					$filter_options["$counter"] = array(7,$filter_arr["7"]);	
					$counter++;
				}	
				unset($counter);	
								
			}
	
			return $filter_options;
		
		}
		
		//function to get the products count text 
		public function getProductCountsText($page_cnt,$total_count) {
			$this->end = 10;
			if($page_cnt == 0 || $page_cnt == 1){
				$this->start = 1;
				if($total_count <= $this->end ) {
					$this->end = $total_count;
				}
			
			}else{
					$this->start = (($page_cnt-1)*10) +1;
					
					if($total_count%10 == 0){
						$this->total_page = $total_count/10;
					}else {
						$this->total_page = ceil($total_count/10);
					}
					if($page_cnt == $this->total_page){
						$this->end = $this->start+($total_count - ($this->total_page-1)*10 - 1);
					}else{
						$this->end  = $this->start+($this->end-1);	
					}
				
			}
			
			$this->text = "Showing Item ".$this->start." - ".$this->end." of ".$total_count." products";
			return $this->text;
		}
		
		//public function to get products supplement facts serving size
		public function getServingSize($pid) {
			$qry  = "SELECT * FROM suplement_facts WHERE product_id=".$pid;
			$rst = $this->dbQuery($qry);	
			$serving_size = '';
			if(!$rst) {
				//sql execution error
		
			} else {
				$row = mysql_fetch_array($rst);
				$serving_size  = $row['serving_size'];
			}
			return $serving_size;
		}	
		
		//function to get products count while searching 
		public function  cntSearchedproduct($cond) {
			$qry = " SELECT  DISTINCT  p.*, pp.resource_id as main_picture_resource_id  from products p
				LEFT OUTER JOIN product_labels pl ON (pl.product_id = p.product_id) 
				LEFT OUTER JOIN labels l ON (l.label_id = pl.label_id) 
				LEFT OUTER JOIN product_pictures pp ON (pp.picture_id = p.main_picture) 
				LEFT OUTER JOIN suplement_facts sf ON (sf.product_id = p.product_id)  WHERE p.status='1' ";
			$qry .=	" ".$cond." AND p.product_name NOT LIKE 'Extreme Edge%'";
			return  $this->cntNumRows($qry);
					
		}
		
		//function for getting product searched details 
		public function getSearchedProductsDetail($page_cnt,$cond) {
		
			$qry = " SELECT  DISTINCT  p.*, pp.resource_id as main_picture_resource_id  from products p
			LEFT OUTER JOIN product_labels pl ON (pl.product_id = p.product_id) 
			LEFT OUTER JOIN labels l ON (l.label_id = pl.label_id) 
			LEFT OUTER JOIN product_pictures pp ON (pp.picture_id = p.main_picture) 
			LEFT OUTER JOIN suplement_facts sf ON (sf.product_id = p.product_id)  WHERE p.status='1' ";
						
			$this->end = 10;
			if($page_cnt == 0 || $page_cnt == 1){
				$this->start = 0;
			}else{
				$this->start = ($page_cnt-1)*10;
					
			}
			$qry .=	" ".$cond." AND p.product_name NOT LIKE 'Extreme Edge%'"; 
			$limit = " limit ".$this->start." , ".$this->end; 
			$order_by = " ORDER BY p.product_name ASC ";
			$qry .= $order_by ." ".$limit; 
			$rst = $this->dbQuery($qry);	
			$data_set = array(); 
			if(!$rst) {
			// sql execution error
		
			} else {
		
				while($rec = mysql_fetch_object($rst)) {
					//$path = $rec->path.'/'.$rec->filename;
					$path = $this->getProductImage($rec->product_id);
					$url_alias = str_replace(" ","_",$rec->product_name); 
					$temp_arr = array("product_id" => $rec->product_id,"product_name"=>$rec->product_name,"url_alias"=>$url_alias,"filepath"=>$path);
					
					$data_set[] = $temp_arr;
			
				}
			}
		
				return $data_set;		
		}			
			
		
		// function to get total products in a given category 
		public function totalProductCnt($ptype = '',$kwd = ''){
			if($ptype == ''){
				$qry = "SELECT COUNT(*) AS num FROM ".$this->table." p INNER JOIN products_thumb pt ON p.product_id = pt.product_id ";
				if($kwd != '') {
					$qry .= " WHERE p.product_desc LIKE '%".$kwd."%' ";
				}
			}else{
				
				$query  = mysql_query("SELECT category_id, category_name FROM categories WHERE url_name='".$ptype."'");
				$cat_id = mysql_result($query,0,category_id);
				$qry = "SELECT COUNT( * ) AS num FROM products p INNER JOIN products_thumb pt ON p.product_id = pt.product_id INNER JOIN product_categories pc ON pc.product_id = p.product_id WHERE pc.category_id ='".$cat_id."'";	
				if($kwd != '') {
					$qry .= " AND	p.product_desc LIKE '%".$kwd."%' ";
				}
			}
			//echo $qry;exit;
			$total_product = mysql_fetch_array(mysql_query($qry));
			$total_product = $total_product[num];
			return $total_product;
		}
		
		//function to get total products for vitamina and minerals 
		public function totalVitaminsMineralsCnt($ptype = ''){
			
			$qry = "SELECT COUNT(*) AS num FROM products p INNER JOIN products_thumb pt ON p.product_id = pt.product_id INNER JOIN product_categories pc ON pc.product_id = p.product_id WHERE pc.category_id in (SELECT  `category_id` FROM  `categories` WHERE  `parent_id` = ( SELECT  `category_id` FROM categories WHERE  `url_name` =  '".$ptype.
			"' ) )"; 
			
			$total_product = mysql_fetch_array(mysql_query($qry));
			$total_product = $total_product[num];
			return $total_product;
		
		
		}
		
		//function to get total products for vitamina and minerals 
		public function getVitaminMinerals($page,$ptype = ''){
			$this->end = 10;
			if($page_cnt == 0 || $page_cnt == 1){
				$this->start = 0;
			}else{
				$this->start = ($page_cnt-1)*10;
						
		   }
			$qry  =  "SELECT p.product_id, p.product_name, pp.resource_id, r.path,	r.filename FROM products p INNER JOIN products_thumb pt ON p.product_id = pt.product_id LEFT JOIN (SELECT * FROM  `product_pictures` WHERE  `product_id` IN (SELECT  `product_id` FROM products ) GROUP BY product_id) AS pp ON p.product_id = pp.product_id LEFT JOIN resources r ON pp.resource_id = r.resource_id INNER JOIN product_categories pc ON pc.product_id = p.product_id WHERE pc.category_id in (SELECT  `category_id` FROM  `categories` WHERE  `parent_id` = ( SELECT  `category_id` FROM categories WHERE  `url_name` =  '".$ptype."' ) ) ORDER BY p.product_name ASC limit ".$this->start." , ".$this->end;
		
		   $rst =  $this->dbQuery($qry);
		   if(!$rst){
				// sql execution error
			
			} else{
				while($rec = mysql_fetch_object($rst)){
					//$path = $rec->path.'/'.$rec->filename;
					$path = $this->getProductImage($rec->product_id);
					$url_alias = str_replace(" ","_",$rec->product_name); 
					$temp_arr = array("product_id" => $rec->product_id,"product_name"=>$rec->product_name,"url_alias"=>$url_alias,"filepath"=>$path);
					$data_set[] = $temp_arr;
				
				}
			}
		
			return $data_set;			
		
		}
		
		public function getSubCatProducts($page_cnt,$sub_cat_id) {
			$this->end = 10;
			if($page_cnt == 0 || $page_cnt == 1){
				$this->start = 0;
			}else{
				$this->start = ($page_cnt-1)*10;
						
			}			

			$data_set = array();
		 	$qry  = "SELECT p.product_id, p.product_name, pp.resource_id, r.path,	r.filename FROM products p INNER JOIN products_thumb pt ON pt.product_id = p.product_id INNER JOIN (SELECT * FROM  `product_pictures` WHERE  `product_id` IN (SELECT  `product_id` FROM products ) ) AS pp ON p.product_id = pp.product_id AND pp.picture_id = p.main_picture INNER JOIN resources r ON pp.resource_id = r.resource_id  INNER JOIN product_categories pc ON pc.product_id = p.product_id WHERE pc.category_id ='".$sub_cat_id."'"; 
		    $order_by = " ORDER BY p.product_name ASC ";
		    $limit = " limit ".$this->start." , ".$this->end;
			$qry .=  $order_by.$limit;
			
			$rst =  $this->dbQuery($qry);
			if(!$rst) {
				// sql execution error
			
			} else {
			
				while($rec = mysql_fetch_object($rst)) {
					//$path = $rec->path.'/'.$rec->filename;
					$path = $this->getProductImage($rec->product_id);
					$url_alias = str_replace(" ","_",$rec->product_name); 
					$temp_arr = array("product_id" => $rec->product_id,"product_name"=>$rec->product_name,"url_alias"=>$url_alias,"filepath"=>$path);
					
					$data_set[] = $temp_arr;
				
				}
			}
		
			return $data_set;
		
		}
		
		
		//function to get product details while listing 		
		public function getProducts($page_cnt,$ptype = '',$kwd=''){
			$this->end = 10;
			if($page_cnt == 0 || $page_cnt == 1){
				$this->start = 0;
			}else{
				$this->start = ($page_cnt-1)*10;
						
			}			

			$data_set = array();
		 	$qry  =  "SELECT p.product_id, p.product_name, pp.resource_id, r.path,r.filename FROM products p INNER JOIN products_thumb pt ON pt.product_id = p.product_id INNER JOIN (SELECT * FROM  `product_pictures` WHERE  `product_id` IN (SELECT  `product_id` FROM products )) AS pp ON p.product_id = pp.product_id AND pp.picture_id = p.main_picture INNER JOIN resources r ON pp.resource_id = r.resource_id "; 
			if($ptype != '' ){
			
				$rst  = $this->dbQuery("SELECT category_id, category_name FROM categories WHERE url_name ='".$ptype."'");
				
				$cat_id = $this->getColumnValue($rst,'category_id');	
				
				$qry  = "SELECT p.product_id, p.product_name, pp.resource_id, r.path,	r.filename FROM products p INNER JOIN products_thumb pt ON pt.product_id = p.product_id INNER JOIN (SELECT * FROM  `product_pictures` WHERE  `product_id` IN (SELECT  `product_id` FROM products ) ) AS pp ON p.product_id = pp.product_id AND pp.picture_id = p.main_picture INNER JOIN resources r ON pp.resource_id = r.resource_id  INNER JOIN product_categories pc ON pc.product_id = p.product_id WHERE pc.category_id ='".$cat_id."'"; 
	
			}
			 
		    $order_by = " ORDER BY p.product_name ASC ";
		    $limit = " limit ".$this->start." , ".$this->end;
			
			if($kwd != '') {
				$search = " AND p.product_desc like '%".$kwd."%'";
			}else {
				$search = "";
			}
			$qry .=  $search.$order_by.$limit;
			//echo $qry;exit; 
			
			$rst =  $this->dbQuery($qry);
			if(!$rst) {
				// sql execution error
			
			} else {
			
				while($rec = mysql_fetch_object($rst)) {
					//$path = $rec->path.'/'.$rec->filename;
					$path = $this->getProductImage($rec->product_id);
					$url_alias = str_replace(" ","_",$rec->product_name); 
					$temp_arr = array("product_id" => $rec->product_id,"product_name"=>$rec->product_name,"url_alias"=>$url_alias,"filepath"=>$path);
					
					$data_set[] = $temp_arr;
				
				}
			}
		
			return $data_set;
			
		}
		
		
		// getting breadcrum for a product 
		public function getProductBreadcrumb($product_id) {
			$qry  = "SELECT * FROM product_categories WHERE product_id=".$product_id;
			$rst =  $this->dbQuery($qry);
				
			if(!$rst) {
						
			} else {
				while($rec = mysql_fetch_object($rst)) {
								
					$categorie_ids[] = $rec->category_id;
				
				}
			}
			
			if(count($categorie_ids) > 1){
				if(in_array(42,$categorie_ids))	{
					$cat_id = 42;
				
				}else if(in_array(41,$categorie_ids) or in_array(10,$categorie_ids)) {
					$cat_id = 10;
				}
			
			 }else{
				$cat_id = $categorie_ids[0];		
		 	}
			
			$breadcrumb = $this->creatingBreadcrumbString($cat_id);
			return $breadcrumb; 
		}
		
		//function to check if a category has sub categories 
		public function checkIfSubCatExists($cat_id) {
			$qry  = "SELECT * FROM  `categories` WHERE  `parent_id`  = ".$cat_id;
			if($this->dbQuery($qry)) {
				$cnt = $this->cntNumRows($qry);
				//echo "cnt:".$cnt;exit;	
				if(!$cnt) {
					return 0;		
				}else {
					return $cnt;
				}	
			} else {
							
				return 0;
			}
			
		}
		//function to get main category name and description 
		public function getCatDescName($cat_id) {
			
			$qry  =  "SELECT c.category_name,p.content as short_desc FROM categories c INNER JOIN pages p ON c.url_name = p.url_slug WHERE c.category_id = ".$cat_id;
			
			$data  = $this->getSpecificRow($qry); 
			return $data;
		
		}
		
		// function to get subcategories under a main categories
		public function getSubCategories($cat_id) {
			$sub_cats  = array();
			$qry = "SELECT category_id,category_name,url_name,parent_id,sort_no ,path_url FROM categories WHERE  parent_id =".$cat_id."
			ORDER BY sort_no ASC ";
			
			$rst = $this->dbQuery($qry);
			if(!$rst) {
				//throw exception
			
			}else {
				while($row = mysql_fetch_array($rst)) {
				
					$sub_cats[] =  $row;
				
				}
			
			
			}
			return $sub_cats;
		
		}
		
		
		// functin to get url aliases of all main categories   
		public function  getAllMainCategories() {
			$all_cat_urls = array();
			$qry  = "SELECT category_id,category_name,url_name FROM  `categories` WHERE parent_id = 0 ORDER BY sort_no ASC";//exit;
			$rst =  $this->dbQuery($qry);
				
			if(!$rst) {
				// through exception	
				 		
			} else {
				while($rec = mysql_fetch_object($rst)) {
						
					$all_cat_urls["$rec->category_id"] = $rec->url_name;
				
				}
				
			}
			return $all_cat_urls;
		
		}
		
		// function to get all url aliaes of all sub categories
		public function getAllSubCategories() {
			
			$all_sub_cats = array();
			$qry  = "SELECT category_id,category_name,url_name FROM  `categories` WHERE parent_id != 0 ORDER BY sort_no ASC";
			$rst =  $this->dbQuery($qry);
				
			if(!$rst) {
				// through exception	
				 		
			} else {
				while($rec = mysql_fetch_object($rst)) {
						
					$all_sub_cats["$rec->category_id"] = $rec->url_name;
				
				}
			return $all_sub_cats;
		
			}
		}
		public function creatingBreadcrumbString($cat_id) {
		
			//get parent category id if exists
			 $rst2 = $this->dbQuery("SELECT parent_id,category_name FROM categories WHERE category_id=".$cat_id);
			 if(!$rst2) {
				// sql execution error
			
				} else {
					$parent_id = mysql_result($rst2,0,parent_id);
					if($parent_id !=0 ) {
						$sql = "SELECT c.`category_id` , c.`category_name` , p.`category_name` parent_category ,p.parent_id FROM categories c INNER JOIN categories p ON c.`parent_id` = p.`category_id` WHERE c.`category_id` =".$cat_id;
						$result =  $this->dbQuery($sql);
						$this->bread_crumb = $this->bread_crumb."/".mysql_result($result,0,parent_category)."/".mysql_result($result,0,category_name);
						$new_cat_id = mysql_result($result,0,parent_id);	
						if($new_cat_id == 0){
							return 	$this->bread_crumb;
						}else {
							
							$this->creatingBreadcrumbString($new_cat_id);
						}
						
					}else {
						
						return $this->bread_crumb."/".mysql_result($rst2,0,category_name);
					
					}
				}
			
		}
		
		
		//function to get product upc size tabs details 	
		public function getUpcSizes($product_id){
			$data_set = array();
			$qry = "SELECT package_product_no,package_qty,package_medium,package_notes  FROM product_packages WHERE product_id=".$product_id." ORDER BY package_product_no";
			$rst =  $this->dbQuery($qry);
			if(!$rst){
				// sql execution error
			
			} else{
			
				while($rec = mysql_fetch_array($rst)){
					
					$concate_rec  = "Product No. ".$rec['package_product_no']." - ".$rec['package_qty']." ".$rec['package_medium']." ".$rec['package_notes'];
					$data_set[] =  $concate_rec;
				
			  }
		
			}
			return $data_set;
	
		}
		
		//function to get product labels images 
		public function getProductLabels($product_id){
			$data_set = array();
			$qry  = "SELECT label_name,filename FROM  `labels` WHERE  `label_id` IN (
					SELECT label_id FROM product_labels WHERE product_id ='".$product_id."' ORDER BY  sort ASC)";
			$rst =  $this->dbQuery($qry);
			if(!$rst){
				// sql execution error
			
			}else{
				while($rec = mysql_fetch_array($rst)){
					$data_set[] =  $rec;
			   }
		
			}
			return $data_set;
	
		
		}
		
		//function to get products name and its description
		public function getProductNameDesc($product_id){
			$data_set = array();
			$qry  = "SELECT product_name,product_desc FROM products WHERE product_id='".$product_id."'";
			$rst =  $this->dbQuery($qry);
			if(!$rst){
				// sql execution error
			
			}else{
					$pname = mysql_result($rst,0,product_name); 	
					$pdesc = mysql_result($rst,0,product_desc); 	
					$data_set['product_name'] = $this->turnSpecialCharsToEntities($pname);
					$data_set['product_desc'] = $this->turnSpecialCharsToEntities($pdesc);
					
			   }
		
			return $data_set;
	
		}
		
		//function to get products supplement facts details
		public function getSupplementFacts($product_id){
			$data_set = array();
			$qry  = "SELECT footnotes,other_ingredients,contains,free_of,also_free_of,caution FROM suplement_facts WHERE product_id='".$product_id."'";
			$rst =  $this->dbQuery($qry);
			if(!$rst){
				// sql execution error
			
			}else{
					$other_ingredients = mysql_result($rst,0,other_ingredients); 	
					$contains = mysql_result($rst,0,contains); 
					$free_of = mysql_result($rst,0,free_of); 	
					$also_free_of = mysql_result($rst,0,also_free_of); 
					$caution = mysql_result($rst,0,caution); 	
					$data_set['other_ingredients'] = $other_ingredients;
					$data_set['contains'] = $contains;
					$data_set['free_of'] = $free_of;
					$data_set['also_free_of'] = $also_free_of;
					$data_set['caution'] = $caution;
										
			   }
			return $data_set;
		}
		
		//function to get products supplement facts image 
		public function getSupplementImage($product_id){
			$qry = "select concat('http://bluebonnet.clientdemos.net/',path,'/',filename) as supliment_image from resources where resource_id=(select picture_id from suplement_facts where product_id='".$product_id."')";
			$rst =  $this->dbQuery($qry);
			$suplement_image = '';
			if(!$rst){
				// sql execution error
			
			}else{
				$suplement_image = mysql_result($rst,0,supliment_image); 	
				
			}
			return $suplement_image;			
		
		}
	
		public function getSupplementFactId($pid) {
			$qry  = "SELECT suplement_fact_id FROM suplement_facts WHERE product_id=".$pid; 
			$rst = $this->dbQuery($qry); 
			if(!$rst){
				return null;
			}else {
				$supplement_fact_id = $this->getColumnValue($rst,0,suplement_fact_id);
				return $supplement_fact_id ;
				
			}
		
		
		
		}
				
		public function getSupFactDetail($pid) {
			//$supplement_fact_id = $this->getSupplementFactId($pid);	
			$qry = "SELECT * FROM  `suplement_fact_items` WHERE  `suplement_fact_id` = ".$pid." ORDER BY  `sort_no` ASC  "; 
			$rst = $this->dbQuery($qry); 
			if(!$rst){
				return null;
			}else {
				while($rec = mysql_fetch_array($rst)) {
					$sup_details[] = $rec;
				}
				return $sup_details;	
				
			}
		
		}
		
		//  function to all prodcut main categories 
		public function getAllProductCategories() {
			$product_details  = array();
			$qry = "SELECT * FROM  `categories` WHERE  `parent_id` =0
			ORDER BY  `sort_no` ASC ";
			//$prod_id_name  = array(42=>'New Products',8=>'Amino Acids & Protein Powders',11=>'Multiples & Prenatal',2=>'Vitamins',4=>'Minerals',19=>'Omega Fatty Acids',7=>'Antioxidants',20=>'Digestive Aids',23=>'Food Supplements & <br />Soy Products',26=>'Specialty Supplements',27=>'Herbal Products');
			$cat_desc = array(42=>'Check out our items',8=>'Building blocks of protein and protein',11=>'Vitamins are essential organic nutrients that...',2=>'Vitamins differ from macronutrients like carbohydrates, proteins ...',4=>'Dietary minerals serve a life sustaining function by ...',19=>'Modification of dietary fat intake can alter the...',7=>'Free radicals are by exposure to harmful...',20=>'Digestion starts the momment food comes in...',23=>'Food suplements are concentrated sources of ...',26=>'Speciality supplements are either single ingredients ...',27=>'The general role of herbs is to support and protect bodily');
			$cat_images = array(42=>'images/product/gifts.png',8=>'images/product/bonesteak.png',11=>'images/product/redapple.png',2=>'images/product/pills.png',4=>'images/product/rockr.png',19=>'images/product/fish.png',7=>'images/product/fruits.png',20=>'images/product/diagram.png',23=>'images/product/green.png',26=>'images/product/bodydiagram.png',27=>'images/product/morta.png');
			$rst  = $this->dbQuery($qry); 
			if(!$rst){
				return null;
			}else {
					while($rec = mysql_fetch_object($rst)) {
					
					$category_image = $cat_images["$rec->category_id"];
					$category_desc = $cat_desc["$rec->category_id"];
					$product_details[] = array('cat_id'=>$rec->category_id,"cat_name"=>"$rec->category_name","cat_desc"=>"$category_desc","cat_image"=>"$category_image","url_alias" =>"$rec->url_name");
					
				}
				return $product_details;
				
			}
		
		}
		//function to get category name for a given products from its product id
		public function getProductCategory($product_id){
		
			$qry = "SELECT c.category_name, c.parent_id, pc.category_id FROM product_categories pc INNER JOIN categories c ON c.category_id = pc.category_id
			WHERE pc.product_id ='".$product_id."'";
			
			$row_cnt = $this->cntNumRows($qry);
			if($row_cnt > 1){
				return "New Products";
			
			}else{
				$rst =  $this->dbQuery($qry);
				if(!$rst){
					// sql execution error
				
				}else{
					$cat_name = mysql_result($rst,0,category_name); 	
					return 	$cat_name;				
			   }
			
			}
		
		}
		
		//function to get product image from its id
		public function getProductImage($product_id){
			//$qry  = "SELECT r.path, r.filename FROM resources r  INNER JOIN  		product_pictures pp ON pp.resource_id = r.resource_id WHERE pp.product_id ='".$product_id."'";
			$qry = "SELECT * FROM products_thumb WHERE product_id=".$product_id;
			
			$rst =  $this->dbQuery($qry);
			if(!$rst){
				// sql execution error
			
			}else{
				$path = mysql_result($rst,0,thumb_path); 	
				//$filename = mysql_result($rst,0,filename);
				//$image_path = "http://192.168.13.107/bluebonnet"."/".$path;	 // for local
				//$image_path = "/".$path;	
				$image_path = $path;
				return 	$image_path;
		   }
		
		}
		
		// function to replace special characters 
		public function turnSpecialCharsToEntities($str) {
			$search_character = array(®,’,™,©,–,“,”);	
			$replace_character = array("&reg;","'","&trade;","&copy;","&ndash;","&quot;","&quot;");
			$modified_str = str_replace($search_character,$replace_character,$str);	
			return $modified_str;
		
		}

		
		//function to get product details on product detail page
		public function getProductDetails($product_id){
			
			$product_category  = $this->getProductCategory($product_id);
			$product_name_desc	= $this->getProductNameDesc($product_id);
			$produc_desc = 	$product_name_desc['product_desc'];						
			$product_name = $product_name_desc['product_name'];
			$url_alias = str_replace(" ","_",$product_name); 
			$product_image = $this->getProductImage($product_id);
			$data_set =  array('product_name'=>$product_name,'category'=>$product_category,'description'=>$produc_desc,'produc_image'=>$product_image,"url_alias"=>$url_alias);
			return $data_set;
		
		}
		
		// function to get category name by category url
		public function getCategoryName($ptype){
			$qry =  "SELECT category_id, category_name FROM categories WHERE url_name ='".$ptype."'";
			$rst =  $this->dbQuery($qry);
			if(!$rst){
				// sql execution error
				
			}else{
				$category_name = mysql_result($rst,0,category_name);
				return $category_name;
			}
			
		}
		
		
		//function to get sub category name by its id
		public function getSubCatName($sub_cat_id) {
			$qry =  "SELECT category_id, category_name FROM categories WHERE category_id = ".$sub_cat_id;
			$rst =  $this->dbQuery($qry);
			if(!$rst){
				// sql execution error
				
			}else{
				$category_name = mysql_result($rst,0,category_name);
				return $category_name;
			}
			
		
		}
		
		// storing and updating product images thumbs into a table 
		public function getProductThumbs(){
			$qry =  'SELECT p.product_id, CONCAT( "http://bluebonnet.clientdemos.net/", r.path,  "/", r.filename ) main_path FROM products p LEFT JOIN ( SELECT * FROM  `product_pictures` WHERE  `product_id` IN ( SELECT  `product_id` FROM products ) ) AS pp ON p.product_id = pp.product_id AND pp.picture_id = p.main_picture INNER JOIN resources r ON pp.resource_id = r.resource_id ORDER BY p.product_id ASC';
			
			$rst =  $this->dbQuery($qry);
			if(!$rst){
				// sql execution error
				return false;
			
			}else{
					while($rec = mysql_fetch_array($rst)){
						$sql1 = "SELECT * FROM `products_thumb` WHERE product_id = ".$rec['product_id'];
						$cnt = $this->cntNumRows($sql1);
						if(!$cnt) {
							$thumb_path = $this->generateThumb($rec['main_path'],'',79);
							
							if(!$this->dbQuery("INSERT INTO `products_thumb` VALUES('',".$rec['product_id'].",'".$thumb_path."',NOW())")){
								//something wrong happend while extractin gthumb path  
							}else {
								//thumb path inserted successfully
							} 
						
						}else {
							$sql2 = "SELECT * FROM `products_timestamp` WHERE product_id = ".$rec['product_id']." AND `entry_time` <> `update_time`";
							$cnt = $this->cntNumRows($sql2);
							if(!$cnt) {
								$thumb_path = $this->generateThumb($rec['main_path'],'',79);
								if(!$this->dbQuery("UPDATE TABLE `products_thumb` SET thumb_path ='".$thumb_path."', date_time = 'NOW()' WHERE product_id = ".$rec['product_id']." )")){
								//something wrong happend while extractin gthumb path  
							}else {
								//thumb path inserted successfully
							}
							}
						}
					
					}		
				return true;	
			   }
		
		}	

	}	

?> 
