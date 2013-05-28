<?php
	/**
	*	You can made this file as a cron job or can run manually
	*   whenever you add/edit or delete products
	*   However its better to do manually instead of making it automatic 
	*   by scheduled jobs(cron jobs)
	*   we are using this site as a reference http://bluebonnet.clientdemos.net
	*   So if things would seems not working  replace http://bluebonnet.clientdemos.net 
	*   with the actual site
	*/
	
	include_once("common_function.php");
	include_once("header.php");
	//script execution persists upto any time limit now
	ini_set('max_execution_time', 0);
	
	$obj = new ThumbGenerator();
	//storing products thumbs from main product image path to our local thumb folder
	?>
	
	 <!--- middle part --->
	<div class="clear">
            </div>
    <div class="maincontainer">
	
	<?php
	
	if($obj -> getProductThumbs()) {
	
		echo "<div >Thank You, Product thumbs generated successfully.</div>";
	
	}
	
	?>
	 </div>
    <!--- middle part --->
	<? 
		include_once("footer.php");

	?>

