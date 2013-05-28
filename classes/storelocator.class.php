<?
	class StoreLocator extends SqlQuery {
		
		var $table  = 'stores';
		var $default_lat = "";
		var $default_long = "";
		
		public function getLatLong($zip_code) {
		
			$url = "http://maps.google.com/maps/geo?q=".$zip_code."&output=xml&oe=utf8&sensor=false";	
			$xml = simplexml_load_file($url);
			$status = $xml->Response->Status->code;
			
			if ($status=='200') { 
				foreach ($xml->Response->Placemark as $node) { 
					
						$address = $node->address;
						$quality = $node->AddressDetails['Accuracy'];
						$coordinates = $node->Point->coordinates;
						//echo ("Quality: $quality. $address. $coordinates<br/>");
						$lat_long_arr  = explode(",",$coordinates);
				}
			}else { 
				$lat_long_arr = "";
			}
			
			
			return $lat_long_arr;
		
		}
		
		public function cntTotalStores($zip_code,$dist_range) {
			//echo $zip_code.",".$dist_range;exit;
			$zip_code = mysql_real_escape_string($zip_code);
			$dist_range = mysql_real_escape_string($dist_range);
			$lat_long_arr  = $this->getLatLong($zip_code);
			if(!empty($lat_long_arr)){
				if($zip_code == "" or $dist_range  == "") {
					return 0;
				}else {
					//$lat_long_sql = "SELECT latitude,longitude FROM stores where zip=".$zip_code." limit 1";
					
					//$lat_long_sql = "SELECT latitude,longitude FROM stores where zip='".$zip_code."' OR store_name='".$zip_code."' OR address='".$zip_code."' or city='".$zip_code."' limit 1";
					//echo $lat_long_sql; 
					//exit;
					
					//$rst  = $this->dbQuery($lat_long_sql);
					// $lat =  mysql_result($rst,0,latitude);
					// $long = mysql_result($rst,0,longitude);
					$long  =  $lat_long_arr[0];
					$lat = $lat_long_arr[1];
					$qry = "SELECT *,(((acos(sin((".$lat."*pi()/180)) * sin((`Latitude`*pi()/180))+cos((".$lat."*pi()/180)) * cos((`Latitude`*pi()/180)) * cos(((".$long."- `Longitude`)*pi()/180))))*180/pi())*60*1.1515) as distance FROM `stores` HAVING distance <= ".$dist_range." ORDER BY distance ASC " ;
					$total_records = $this->cntNumRows($qry);
					return $total_records;
					
				}
			}else {
				return 0;			
			}
		}
		
		public function getTotalStores($zip_code,$dist_range,$page) {
			//echo "zip-code:".$zip_code."--distance-".$dist_range;exit;
			$this->end = 10;
			if($page == 0 || $page == 1){
				$this->start = 0;
			}else{
				$this->start = ($page-1)*10;
						
			}	
			//$xmlDom  = "http://maps.google.com/maps/geo?q=".$zip_code."&output=xml&oe=utf8&sensor=false&key=9G7bey8_JXxQP6rxl.fBFGgCdNjoDMACQA";
			/*$url = "http://maps.google.com/maps/geo?q=".$zip_code."&output=xml&oe=utf8&sensor=false";	
			$xml = simplexml_load_file($url);
			$status = $xml->Response->Status->code;
			
			if ($status=='200') { 
				foreach ($xml->Response->Placemark as $node) { 
					
						$address = $node->address;
						$quality = $node->AddressDetails['Accuracy'];
						$coordinates = $node->Point->coordinates;
						//echo ("Quality: $quality. $address. $coordinates<br/>");
				}
			}else { 
				echo ("The address $adr could not be geocoded<br/>");
			}
			*/
			//$lat_long_arr  = explode(",",$coordinates);
			$lat_long_arr  = $this->getLatLong($zip_code);
			if(!empty($lat_long_arr)){
			//print_r($lat_long_arr);
			$zip_code = mysql_real_escape_string($zip_code);
			$dist_range = mysql_real_escape_string($dist_range);
			if($zip_code == "" or $dist_range  == "") {
				return "";
			}else {
				
				$data_set = array();
							
				$long  =  $lat_long_arr[0];
				$lat = $lat_long_arr[1];
			
				//echo $qry = "SELECT *,(((acos(sin((".$lat."*pi()/180)) * sin((`Latitude`*pi()/180))+cos((".$lat."*pi()/180)) * cos((`Latitude`*pi()/180)) * cos(((".$long."- `Longitude`)*pi()/180))))*180/pi())*60*1.1515) as distance FROM `stores` HAVING distance <= ".$dist_range." ORDER BY distance ASC LIMIT ".$this->start." , ".$this->end ;
				$qry = "SELECT *,(((acos(sin((".$lat."*pi()/180)) * sin((`Latitude`*pi()/180))+cos((".$lat."*pi()/180)) * cos((`Latitude`*pi()/180)) * cos(((".$long."- `Longitude`)*pi()/180))))*180/pi())*60*1.1515) as distance FROM `stores` HAVING distance <= ".$dist_range." ORDER BY distance ASC LIMIT ".$this->start." , ".$this->end ;
				$rst = $this->dbQuery($qry);
				if(mysql_num_rows($rst)){
					
					//echo count(mysql_num_rows($rst));
					$_store_locators  = "["; 
					$counter = 1;
					$all_locators = array();
					//echo "1";exit;
					while ($row = mysql_fetch_assoc($rst)){
						// echo "<pre/>";
						// print_r($row);exit;
						$this->default_lat = $row['latitude']; 
						$this->default_long = $row['longitude'];
						$all_locators[] =  array("name"=>addslashes($row['store_name']),"address"=>addslashes($row['address']),"city"=>addslashes($row['city']),"state"=> addslashes($row['state']),"zip"=>$row['zip'],"phone"=>addslashes($row['phone']),"lat"=>$row['latitude'],"long"=>$row['longitude']); 
						if($counter == mysql_num_rows($rst)){
							$_store_locators .= "{ title:'".addslashes($row['store_name'])."',position : new google.maps.LatLng(".$row['latitude'].", ".$row['longitude'].")}";
							break;
					 }
					
						$_store_locators .= "{ title:'".addslashes($row['store_name'])."',position : new google.maps.LatLng(".$row['latitude'].", ".$row['longitude'].")},"; 
									
						$counter++;
					}
					$_store_locators .= "]";
					
					//echo "store-locators:".$_store_locators;exit;
					unset($counter);	
					$data_set['store_markers'] = $_store_locators;
					$data_set['all_locators'] = $all_locators;		
					return $data_set; 
				}else {
					//echo "sfsf";exit;
					return "";
		
				}	
			 }
			}else
			{
				return "";
			}
		}
		
		public function getStoreDetails($lat,$long) {
			
			$latitude = mysql_real_escape_string($lat);
			$longitude = mysql_real_escape_string($long);
			
			$qry = "SELECT *,(((acos(sin((".$latitude."*pi()/180)) * sin((`Latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`Latitude`*pi()/180)) * cos(((".$longitude."- `Longitude`)*pi()/180))))*180/pi())*60*1.1515) as distance FROM `stores` WHERE latitude=".$latitude." AND longitude=".$longitude;
			//exit;	
			//$total_records = $this->cntNumRows($qry);
			//return $total_records;
			$rst = $this->dbQuery($qry);
			
			if(mysql_num_rows($rst)){
			//echo count(mysql_num_rows($rst));
				$_store_locators  = "["; 
				$counter = 1;
				$all_locators = array();
				
				while ($row = @mysql_fetch_assoc($rst)){
					$this->default_lat = $row['latitude']; 
					$this->default_long = $row['longitude'];
					$all_locators[] =  array("name"=>addslashes($row['store_name']),"address"=>addslashes($row['address']),"city"=>addslashes($row['city']),"state"=> addslashes($row['state']),"zip"=>$row['zip'],"phone"=>addslashes($row['phone']),"lat"=>$row['latitude'],"long"=>$row['longitude']); 
					if($counter == mysql_num_rows($rst)){
						$_store_locators .= "{ title:'".addslashes($row['store_name'])."',position : new google.maps.LatLng(".$row['latitude'].", ".$row['longitude'].")}";
						break;
				 }
				
					$_store_locators .= "{ title:'".addslashes($row['store_name'])."',position : new google.maps.LatLng(".$row['latitude'].", ".$row['longitude'].")},"; 
								
					$counter++;
				}
				$_store_locators .= "]";
				unset($counter);	
				$data_set['store_markers'] = $_store_locators;
				$data_set['all_locators'] = $all_locators;		
				return $data_set; 
			}else {
				return "";
		
			}	
		
		}
		
 }		
		

?>