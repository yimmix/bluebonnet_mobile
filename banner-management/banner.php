<?
	//print_r($_POST);
	//exit;
	$action = $_POST['action'];
	$node_id = $_POST['node_id'];
	//echo $node_id ;exit;
	
	switch($action) {
	
		CASE "update" :
			$s_date = $_POST['s_date'];
			$e_date = $_POST['e_date'];
			$banner_link = $_POST['banner_link'];
			$status = '';
			if($_POST['status'] == 1) {
				$status = 'True';	
			}else {
				$status = 'False';	
			}
			$doc = new DOMDOcument; 
			$doc->load("banner.xml");
			$xpath = new DOMXpath($doc); 
			$result = $xpath->query(sprintf('/banners/banner[@ID="%s"]', $node_id));
			if (!$result || $result->length !== 1) {
				throw new Exception(sprintf('Item with id "%s" does not exists or is not unique.', $node_id));
			}
			$item = $result->item(0);
			$sDate = $xpath->query('./StartDate', $item)->item(0);
			$sDate->nodeValue = $s_date;
			$bLink= $xpath->query('./BannerLink', $item)->item(0);
			$bLink->nodeValue = $banner_link;
			
			$eDate = $xpath->query('./EndDate', $item)->item(0);
			$eDate->nodeValue = $e_date;
			$active = $xpath->query('./Active', $item)->item(0);
			$active->nodeValue = $status;
			$ret_value = $doc->save("banner.xml");
			if($ret_value){
				echo 1;
			}else {
				echo 0;
			}
			exit;		
		CASE "delete" :
			
			$doc = new DOMDocument; 
			$doc->load('banner.xml');
			$thedocument = $doc->documentElement;
			//this gives you a list of the messages
			$list = $thedocument->getElementsByTagName('banner');

			//figure out which ones you want -- assign it to a variable (ie: $nodeToRemove )
			$nodeToRemove = null;
			foreach ($list as $domElement){
				$attrValue = $domElement->getAttribute('ID');
				if ($attrValue == $node_id) {
					$nodeToRemove = $domElement; //will only remember last one- but this is just an example :)
				}
			}
			//Now remove it.
			if ($nodeToRemove != null)
			$ret_value = $thedocument->removeChild($nodeToRemove);
			$doc->save("banner.xml");
			if($ret_value != null) {
				echo 1;
			}else {
				echo 0;
			}
			exit;	
		}
	
	

?>