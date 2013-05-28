<?
		//error_reporting(E_ALL);
		//ini_set('display_errors',1);

		//get banner image details from its corresponding xml file 
		include_once("config.php");
		$xml = simplexml_load_file(BANNER);	
		$banner_imgs = array();
		$banner_ids = "[";
		foreach($xml as $banner_img_details) {
			
			$idAtt = (string)$banner_img_details['ID']; // thisis same as serial number
			$path = $banner_img_details->BannerPath;
			$start_date = $banner_img_details->StartDate;
			$end_date = $banner_img_details->EndDate;
			$name = $banner_img_details->Name;
			
			$status = $banner_img_details->Active;
			
			$banner_ids .= "'".$idAtt."',";
			$temp_array = array(id=>$idAtt,name=>"$name",path=>"$path",start_date=>"$start_date",end_date=>"$end_date",status=>"$status");
			$banner_imgs [] = $temp_array;
				
		}
		
		$banner_ids = rtrim($banner_ids, ","); 
		$banner_ids .= "]";
		


?>
<html>
<head>
<script type="text/javascript">
	function validateBannnerFrm() {
		//var img = document.getElementById("banner").value;
		var img = document.getElementById("banner").value;
		var start_date = document.getElementById("start_date").value;
		var end_date = document.getElementById("end_date").value;
		//var img_link = document.getElementById("img_link").value;
		//var err_msg = new Array();
		var err_msg = "";
		var i =0;
		if(img == '') {
			err_msg  = err_msg + '-Select image to be upload\n';
			i++;
		}
		/*
		if(img_link == '') {
			err_msg  = err_msg + '-Select url to link to image\n';
			i++;
		}
		*/
		if(start_date == "") {
			err_msg = err_msg + '-Enter start date!\n';
			i++;
		}
		if(end_date == "") {
			err_msg = err_msg + '-Enter end date!';
			
		}
		if(err_msg.length == 0){
			return true;
		}else {
			alert(err_msg);
			return false;		
		}	

	}
	
	function validateIntervalFrm(){
		var elem = document.getElementById("time_interval").value;
		if(elem == ''){
			alert("-Enter time interval in seconds");
			return false;
		
		}else {
			return true;
		
		}
	} 
</script>

<script type="text/javascript" src="js/banner.js" > </script>
<style type="text/css">
.clear {
	clear:both;
}
.input-container {
	margin:5px 0px;
	padding:5px 0px;
 }
.input-head {
	float:left;
	margin-left:70px;
	text-align:left;
	width:160px;
}
.input-type {
	float:left;
	width:244px;
}
.wht {
	background-color:#fff;
} 
.grn {
	background-color:#ACC67A;
}

.btn {	
	width:110px;
	height:38px;
	border:1px solid #000;
	line-height:36px;
	text-align:center;
	background-color:#595959;
	float:left;
	text-decoration:none;
	color:#ccc;
	text-align:center;
	}
 
.btn:hover {
	text-decoration:none;
	color:#000;
	text-align:center;
	background-color:#ccc;
	
	}


</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"start_date",
			//dateFormat:"%d-%M-%Y"
			dateFormat : "%Y-%m-%d" // used the formate for date change
			
		});
		new JsDatePick({
			useMode:2,
			target:"end_date",
			//dateFormat:"%d-%M-%Y"
			dateFormat : "%Y-%m-%d" // used the formate for date change
			
		});
	};
	 
	function cancel_update(id) {
		
		document.getElementById("start_date_"+id).disabled = true;
		document.getElementById("end_date_"+id).disabled = true;
		document.getElementById("status_"+id).disabled = true;
		document.getElementById("banner_link_"+id).disabled = true;
		document.getElementById("edit_update_"+id).innerHTML;
		var edit_btn  = '<a href="javascript:void(0)" onClick="javascript:make_editable('+id+');">Edit</a>';
		//var cancel =  '<a href="javascript:void(0)" onClick="javascript:cancel_update('+id+');">Cancel</a>';
		document.getElementById("edit_update_"+id).innerHTML = edit_btn;
		setTimeout("window.location.href=location.href",300);
	}
		 
	function update_node(id) {
		
		var http  = ajaxFunction();
		var s_date = document.getElementById("start_date_"+id).value;
		var e_date = document.getElementById("end_date_"+id).value;
		var banner_link = document.getElementById("banner_link_"+id).value;
		var status = document.getElementById("status_"+id);
		
		
		if(status.checked== 1){
			status = 1;
		}else {
			status = 0;
		}
		
		var url = "banner.php";
		var params = "s_date="+s_date+"&e_date="+e_date+"&status="+status+"&banner_link="+banner_link+"&node_id="+id+"&action=update";
		
		http.open("POST", url, true);

		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", params.length);
		//http.setRequestHeader("Connection", "close");

		http.onreadystatechange = function() {//Call a function when the state changes.
				if(http.readyState == 4 && http.status == 200) {
					//alert(http.responseText);
					if(http.responseText == 1) {
						document.getElementById("errSuccMsg").innerHTML= 'Banner Image updated successfully'; 		
						setTimeout("window.location.href=location.href",1000);						
					}
						
			}
		}
		http.send(params);

	}
	function make_editable(id) {
		
		var s_date = document.getElementById("start_date_"+id);
		var e_date = document.getElementById("end_date_"+id);
		var status = document.getElementById("status_"+id);
		var b_link = document.getElementById("banner_link_"+id);
				
		s_date.disabled = false;
		e_date.disabled = false;
		status.disabled = false;
		b_link.disabled = false;
		new JsDatePick({
			useMode:2,
			target:"start_date_"+id,
			//dateFormat:"%d-%M-%Y"
			dateFormat : "%Y-%m-%d" // used the formate for date change
			
		});
		new JsDatePick({
			useMode:2,
			target:"end_date_"+id,
			//dateFormat:"%d-%M-%Y"
			dateFormat : "%Y-%m-%d" // used the formate for date change
			
		});
		
		var all_ids = <?=$banner_ids?>;
		//alert(all_ids);
		for(var i=0; i<all_ids.length;i++ ){  
			if(id ==  all_ids[i]){
				
			}else {
				document.getElementById("start_date_"+all_ids[i]).disabled = true;
				document.getElementById("end_date_"+all_ids[i]).disabled = true;
				document.getElementById("status_"+all_ids[i]).disabled = true;
				document.getElementById("banner_link_"+all_ids[i]).disabled = true;
				var edit_btn  = '<a href="javascript:void(0)" onClick="javascript:make_editable('+all_ids[i]+');">Edit</a>';
				document.getElementById("edit_update_"+all_ids[i]).innerHTML = edit_btn;
			}	
			
		}  
		
		var temp_content = document.getElementById("edit_update_"+id).innerHTML;
		var up_btn  = '<a href="javascript:void(0)" onClick="javascript:update_node('+id+');">Update</a>';
		var cancel =  '<a href="javascript:void(0)" onClick="javascript:cancel_update('+id+');">Cancel</a>';
		document.getElementById("edit_update_"+id).innerHTML = up_btn+"&nbsp;"+cancel;

	}
	
	function delete_node(id) {
		
		if(confirm("Are you sure?")) {
			
			var http  = ajaxFunction();
			var url = "banner.php";
			var params = "node_id="+id+"&action=delete";
			http.open("POST", url, true);

			//Send the proper header information along with the request
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			
			http.onreadystatechange = function() {//Call a function when the state changes.
				if(http.readyState == 4 && http.status == 200) {
					//alert(http.responseText);
					if(http.responseText == 1) {
						document.getElementById("errSuccMsg").innerHTML= 'Banner Image deleted successfully'; 		
						setTimeout("window.location.href=location.href",1000);						
					}
				}
			}	
			http.send(params);
		}else {
			//do nothing 	
		}
	
	}
</script>
</head>
<body>
  <div style="width:100%; height:40px; background-color:#424242; border:1px solid #000;margin-bottom:10px;font-family:Verdana, Geneva, sans-serif; font-size:11px;">
	<a href="/" style="text-decoration:none;"> <div class="btn"> Home  </div></a>
	<a href="" style="text-decoration:none;"><div class="btn"> Manage Banner </div></a>
  </div>
	<?php
		
		//get banner image details from its corresponding xml file 
		include_once("config.php");
		$xml = simplexml_load_file(BANNER);	
		$banner_imgs = array();
		
		foreach($xml as $banner_img_details) {
			//	accessing the attribute value , the cast to string is very import 
			//	when accessing a attribute of a node  otherwise we saw some funcky behaviour
			$idAtt = (string)$banner_img_details['ID']; // thisis same as serial number
			$path = $banner_img_details->BannerPath;
			$start_date = $banner_img_details->StartDate;
			$end_date = $banner_img_details->EndDate;
			$name = $banner_img_details->Name;
			$banner_link = $banner_img_details->BannerLink;
			$status = $banner_img_details->Active;
			$temp_array = array(id=>$idAtt,name=>"$name",path=>"$path",banner_link=>"$banner_link",start_date=>"$start_date",end_date=>"$end_date",status=>"$status");
			$banner_imgs [] = $temp_array;
				
		}

		if(isset($_REQUEST['submit'])) {
			
			//include_once('common-functions.php');			
			if ($_FILES["banner"]["error"] > 0){
				echo "Apologies, an error has occurred.";
				
			}
			else {
				$uploadDir = 'images/';
				$fileName = $_FILES['banner']['name'];
				$filePath = $uploadDir . $fileName;
			
				if(!move_uploaded_file($_FILES["banner"]["tmp_name"],
			  $filePath)) {
					echo "file upload error";
			  
				}else {
					
					$now = date("Y-m-d");
					$img_link = $_REQUEST['img_link'];
					$s_date = $_REQUEST['start_date'];
					$e_date 	= $_REQUEST['end_date'];
					$active_status = ($_REQUEST['banner_status'] == 'on') ? 'True' : 'False';
					$xmlFileName = 'banner.xml';
					
					if(file_exists($xmlFileName)) {
						//$xml = simplexml_load_string($xmlFileName);
						$xml = new DOMDocument;
						$xml->load($xmlFileName);
						$xml->formatOutput = true;
						$xml->preserveWhiteSpace = false;
						//$xpath = new DOMXPath($doc);
						$nodeCnt = $xml->getElementsByTagName('banner')->length;
						if($nodeCnt == 0) {
						
							$s_num = 0;
						}else {
							$xmlobj = simplexml_load_file($xmlFileName);
							$last_banner = $xmlobj->banner[$nodeCnt-1]; // gets the last banner element
							$sl = $last_banner->SL;  // get serial number of last baner  node
							$s_num = $sl;
						
						}
						
						$s_num = $s_num+1;
						// get document element
						$root   = $xml->documentElement;
						$serial_num = $xml->createElement("SL");
						$serial_num->appendChild( 
							$xml->createTextNode($s_num) 
						);
						$start_date = $xml->createElement("StartDate"); 
						$start_date->appendChild( 
							$xml->createTextNode($s_date)
						);
						$end_date = $xml->createElement("EndDate"); 
						$end_date->appendChild( 
						$xml->createTextNode($e_date)
						);
						$banner_name = $xml->createElement("Name");
						$banner_name->appendChild( 
							$xml->createTextNode($fileName) 
						);
						$banner_path = $xml->createElement("BannerPath");
						$banner_path->appendChild( 
							$xml->createTextNode($filePath) 
						);
						//$img_link
						$banner_link = $xml->createElement("BannerLink");
						$banner_link->appendChild( 
							$xml->createTextNode($img_link) 
						);
						$creation_date = $xml->createElement("CreationDate");
						$creation_date->appendChild( 
							$xml->createTextNode($now) 
						);
						$status = $xml->createElement("Active");
						$status->appendChild( 
							$xml->createTextNode($active_status) 
						);
						$banner = $xml->createElement("banner"); 
						$domAttribute = $xml->createAttribute('ID');	
						$domAttribute->value = $s_num; // setting id to the banner element 
						$banner->appendChild($domAttribute);
						$banner->appendChild($serial_num);
						$banner->appendChild($start_date);
						$banner->appendChild($end_date);
						$banner->appendChild($banner_name);
						$banner->appendChild($banner_path);
						$banner->appendChild($banner_link);
						$banner->appendChild($creation_date);
						$banner->appendChild($status);
						$root->appendChild($banner);
						//$xml->save($xmlFileName); 
						if(!$xml->save($xmlFileName)){
							
						
						}else {
							echo "<div style='color:red;text-align:center;'>New banner image added successfully</div>";
								?>
									<script type="text/javascript">
										setTimeout("window.location.href=location.href",1000);						
									</script>
								<?		
						}		
						
					}else {
						$domtree = new DOMDocument('1.0', 'UTF-8');
						//create the root element of the xml tree 
						$xmlRoot = $domtree->createElement("banners");
						$xmlRoot = $domtree->appendChild($xmlRoot);
						$banner = $domtree->createElement("banner"); 
						$domAttribute = $domtree->createAttribute('ID');	
						$domAttribute->value = 1; // hardcoded  for first element
						$banner->appendChild($domAttribute);
						$xmlRoot->appendChild($banner ); 
						$serial_num = $domtree->createElement("SL"); 
						$serial_num->appendChild( 
							$domtree->createTextNode('1') 
						);
						$banner->appendChild($serial_num); 
						$start_date = $domtree->createElement("StartDate"); 
						$start_date->appendChild( 
							$domtree->createTextNode($s_date)
						);
						$banner->appendChild($start_date); 
						$end_date = $domtree->createElement("EndDate"); 
						$end_date->appendChild( 
						$domtree->createTextNode($e_date)
						);
						$banner->appendChild($end_date); 
						$banner_name = $domtree->createElement("Name");
						$banner_name->appendChild( 
							$domtree->createTextNode($fileName) 
						);
						$banner->appendChild($banner_name); 
						$banner_path = $domtree->createElement("BannerPath");
						$banner_path->appendChild( 
							$domtree->createTextNode($filePath) 
						);
						$banner->appendChild($banner_path); 
						
						$banner_link = $domtree->createElement("BannerLink");
						$banner_link->appendChild( 
							$xml->createTextNode($img_link) 
						);
						$banner->appendChild($banner_link);
										
						$creation_date = $domtree->createElement("CreationDate");
						$creation_date->appendChild( 
							$domtree->createTextNode($now) 
						);
						$banner->appendChild($creation_date); 
						$status = $domtree->createElement("Active");
						$status->appendChild( 
							$domtree->createTextNode($active_status) 
						);
						$banner->appendChild($status); 
						if(!$domtree->save($xmlFileName)){
							
						
						}else {
							
							echo "<div style='color:red;text-align:center;'>New banner image added successfully</div>";
								?>
									<script type="text/javascript">
										setTimeout("window.location.href=location.href",1000);						
									</script>
								<?		
						}		
						
						}
						
					}
			
				}
			}
	
	if(isset($_REQUEST['save'])) {
		$now = date("Y-m-d");
		$s_date = $_REQUEST['time_interval'];
		$s_date = $s_date * 1000; // time in mili seconds
		$file_name = "banner_interval.xml";
		if(file_exists($file_name)) {
			
		
		}
		$dom_tree = new DOMDocument('1.0', 'UTF-8');
		//create the root element of the xml tree 
		$xml = $dom_tree->createElement("Intervals");
		$xml = $dom_tree->appendChild($xml);
		$interval = $dom_tree->createElement("interval"); 
		$interval->appendChild( 
			$dom_tree->createTextNode($s_date) 
		);	
		$xml->appendChild($interval); 
		if(!$dom_tree->save($file_name)){
						
						
		}else {
				echo "<div style='color:red;text-align:center;'>Time interval updated successfully</div>";
		}
	}
	?>

	<div style="width:90%; margin:0 auto; border:0px solid #7B8B5B;background-color:#ACC67A; font-family:verdana; font-size:12px;"> 
		<form name="bannerFrm" id="bannerFrm" action="" method="post" enctype="multipart/form-data" onsubmit="javascript:return validateBannnerFrm();">
			<div style="width:80%;margin:0 auto;" >
				<div class="input-container">
					<div class="input-head"> Upload Image</div>
					<div class="input-type" ><input type="file" name="banner" id="banner" /></div>
					<div style="text-align:left; margin-left:10px;color:red; font-size:10px; line-height:28px;">* Image should be 1024*764.   </div>	
					<div class="clear"> </div>
				</div>
				<div class="input-container">
					<div class="input-head" >Image Link</div>
					<div class="input-type"><input type="text" id="img_link" name="img_link" size="35" /></div>
					<div class="clear"> </div>
				</div>
				<div class="input-container">
					<div class="input-head" >Start Date(YYYY-MM-DD)</div>
					<div class="input-type"><input type="text" id="start_date" name="start_date" /></div>
					<div class="clear"> </div>
				</div>
				<div class="input-container">
					<div class="input-head">End Date(YYYY-MM-DD)</div>
					<div class="input-type"><input type="text" id="end_date" name="end_date" /></div>
					<div class="clear"> </div>
				</div>		
				<div class="input-container">
					<div class="input-head">Active</div>
					<div class="input-type"><input type="checkbox" name="banner_status" id="banner_status" checked="checked" /></div>
					<div class="clear"> </div>
				</div>
				
				<div style="float:right; margin-right:210px;"><input type="submit" name="submit" value="Upload" ></div>		
				<div style="clear:both;">				
			</div>
			</div>
		</form>
	</div>	
	
	<!-- <div style="width:90%;margin:0 auto;background-color:#f3f3f3; height:15px;"> </div> -->
	<div style="width:90%;margin:10 auto;background-color:#ACC67A;"> 
		<form name="intervalFrm" id="intervalFrm" action="" method="post"  onsubmit="javascript: return validateIntervalFrm();">
			<div class="input-container">
					<div class="input-head" >Time Interval(Second)</div>
					<div class="input-type"><input type="text" id="time_interval" name="time_interval" /></div>
					<div class="input-type"><input type="submit" name="save" value="Save" ></div>
					<div class="clear"> </div>
			</div>
		</form>	
	</div>
	
	<? 
		if(is_array($banner_imgs) && !empty($banner_imgs)) {
			?>
			<div id="errSuccMsg" style="width:90%;margin:0 auto;color:red;text-align:center;"> </div>	
			<div style="width:90%;margin:0 auto;background-color:#999;"> 
				<table style="border: 1px solid #7B8B5B; width:100%;" cellpadding="1" cellspacing="1">
					<tr style="background-color:#79A12B;text-align:center;"><td width="6%">S No.</td><td width="10%">Name</td><td width="24%">Image</td> <td width="27%"> Link </td> <td width="10%">Start Date</td><td width="10%">End Date</td><td width="5%">Active</td><td width="8%">Action</td></tr>
					<?php
					for($i=0;$i<count($banner_imgs);$i++) {
						//print_r($banner_imgs);exit;
						$j = $i+1;
						if($j%2 == 0) {
							$class= "grn";
						}else {
							$class= "wht";	
						}
					
					?>
						<tr class="<?=$class?>">
							<td width="4%"><?=$j?></td>
							<td width="14%"><?=$banner_imgs[$i]['name']?></td>
							<td width="26%"><img src="<?=$banner_imgs[$i]['path']?>" alt="Banner Image" width="100%" height="" /></td>
							<td width="26%"><input type="text" name="banner_link_<?=$banner_imgs[$i]['id']?>" id="banner_link_<?=$banner_imgs[$i]['id']?>" value="<?=$banner_imgs[$i]['banner_link']?>" size="30" disabled="disabled" /> </td>
							<td width="10%"><input type="text" name="start_date_<?=$banner_imgs[$i]['id']?>" id="start_date_<?=$banner_imgs[$i]['id']?>" value="<?=$banner_imgs[$i]['start_date']?>" size="10" disabled="disabled" /></td>
							<td width="10%"><input type="text" name="end_date_<?=$banner_imgs[$i]['id']?>" id="end_date_<?=$banner_imgs[$i]['id']?>" value="<?=$banner_imgs[$i]['end_date']?>" size="10" disabled="disabled" /></td>
							<td width="4%"><input type="checkbox" id="status_<?=$banner_imgs[$i]['id']?>" name="status_<?=$banner_imgs[$i]['id']?>"  disabled="disabled"  <? if($banner_imgs[$i]['status'] == 'True') { echo "checked='checked'";}?> /></td>
							<td width="6%" ><div id="action" style="float:left;"><div id="delete_<?=$banner_imgs[$i]['id']?>"><a href="javascript:void(0);" onClick="javascript:delete_node(<?=$banner_imgs[$i]['id']?>)">Delete</a></div>&nbsp;<div id="edit_update_<?=$banner_imgs[$i]['id']?>" style="float:left;"> <a href="javascript:void(0);" onClick="make_editable(<?=$banner_imgs[$i]['id']?>)" >Edit</a></div></td>
						</tr>
					
					<? 
					  }
					?>
				</table>
			</div>
		<?
		}
	?>

	
</body>
</html>