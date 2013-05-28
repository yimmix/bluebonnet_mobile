<?php
// getting host name 
/*	function getHostName() {
		$hostName = $_SERVER['SERVER_NAME'];
		$hostSlices = explode(".",$hostName);
		if($hostSlices[0]=="www"){
			array_shift($hostSlices);
		}
		$domain = join(".",$hostSlices);
		return $domain;
   	}*/
	
	

	//Disable error reporting
		error_reporting(1);
	
	
	function __autoload($class_name) {
	
		try {

			$filename = strtolower($class_name) .'.class'.'.php';

			$file = 'classes/'. $filename;		

			if (file_exists($file))

				include_once($file);

			else

			throw new Exception('Class '.$class_name . ' not found!');

		}

		catch(Exception $e) {

			echo $e->getMessage();

			exit(0);

		}

	}
	
	/*
		// code for creating products thumbnail 
		
		ini_set('max_execution_time', 0);
		
		if(!isset($thumb_generated)) {
			
			//$obj = new ThumbGenerator();
			//$obj -> getProductThumbs();
			//$thumb_generated = 1;
		
		}
	
	*/
	
	//function to calculate the specified character without word break
	function getSpecifiedCharFrmStr($str,$word_limit=60) {
		//echo "1";exit;
		if(strlen($str) <= $word_limit) {
			return $str;
		}else {
			$temp_pos = strpos($str, ' ', $word_limit); // calculate position of first space after the word limit 
			return substr($str, 0, $temp_pos);
		}	
			
	}
	
	// getting current page url 
	function getCurrentPageUrl() {
		$page_url = 'http';
		if ($_SERVER["HTTPS"] == "on") {$page_url .= "s";}
		$page_url .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $page_url;
	}
		
	// array for searching special character 
		$search_character = array(®,’,'™',©,–,“,”,"<p> </p>","•");
		
	// replacement array for special characters 	
		$replace_character = array("&reg;","'","&trade;","&copy;","&ndash;","&quot;","&quot;","<p>&nbsp;</p>",".");
		
		
	// function for replacing special characters to their entity equivalent 	
		function chrToEntityConversion($str) {
			global $search_character;
			global $replace_character;
			$modified_str = str_replace($search_character,$replace_character,$str);	
			return $modified_str;
		
		}
		
		function get_banner_imgs_href($case){
		$banners_img_path = "banner-management/";
		$banner_xml_path  = $banners_img_path."banner.xml"; 
		if(file_exists($banner_xml_path)) {	
			$xml = simplexml_load_file($banner_xml_path);	
			$banner_imgs = array();
			$result_arr = "[";
			$today = date("Y-m-d");
			$result_set = '';
			$todays_timestamp = strtotime($today);

			switch($case){
				
				CASE "img" :
					$temp = '';
					//$path_cnt = 0; //path counter to get 
					foreach($xml as $banner_img_details) {
						$end_date = $banner_img_details->EndDate;
						$end_date = strtotime($end_date);
						if($end_date - $todays_timestamp >= 0 ){
							$path = $banner_img_details->BannerPath;
							$status = $banner_img_details->Active;
							if($status == 'True') {
								$path = $banners_img_path.$banner_img_details->BannerPath;
								$temp .= "'".$path."',";
							}else {
								continue;
							 }	
							
						}
					
					}
				$temp = rtrim($temp, ","); 	
				$temp = trim($temp);
				if(empty($temp))	{ // default banner images
					//$result_arr .= "'img/11.jpg','img/dummy.jpg','img/purple22.jpg','img/dummy2.jpg'";
					$result_set = '';
				}else {
					$result_set = $temp;
					
				}
				break;
			
				CASE "href" :
						$temp = '';
						foreach($xml as $banner_img_details) {
							$end_date = $banner_img_details->EndDate;
							$end_date = strtotime($end_date);
							if($end_date - $todays_timestamp >= 0 ){
								//$path = $banner_img_details->BannerLink;
								$status = $banner_img_details->Active;
								if($status == 'True') {
									$link = $banner_img_details->BannerLink;
								$temp .= "'".$link."',";
							}else {
								continue;
							 }	
							
						}
					
					 }
					 $temp = rtrim($temp, ","); 	
					 $temp = trim($temp);
					 if(empty($temp))	{ // default banner images
						$result_set = '';
					 }else {
						$result_set .= $temp;
						//$result_arr .= "]";
					 }
					 break;
				
				}
				return $result_set;	

			}else
			{
				return '' ; // returning empty string if file doed not exit
			
			}
		
		}
		function get_banner_rotation_time() {
			
			$banner_interval_path  = "banner-management/banner_interval.xml";
			if(file_exists($banner_interval_path)){
				$xml = simplexml_load_file($banner_interval_path);
				return $xml->interval;
			}else {
				
				return 2000; // return default values	
			
			}
		
		}
				
		
?>