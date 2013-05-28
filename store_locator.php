<?php
	include_once("common_function.php");
	include_once("header.php");

?>
   <script type="text/javascript" >
	function getStoreLocator() {
		
		var zip_name  = document.getElementById("near").value;
		
		var radius_range  = document.getElementById("distance").value;
		
		if(zip_name != '' && radius_range != '') {
			//document.forms["store_locator"].submit();
			document.getElementById("store_locator").submit();
		}else {
			
			//document.getElementById("err").style.border = "1px solid red";
			//document.getElementById("err").style.width = "200px";
			document.getElementById("err").setAttribute('class', 'err-msg')
			document.getElementById("err").innerHTML = 'Please fill up both the fields!';
		
		}
	
	}
	
 
 </script>
  
  <div class="clear"> </div>
  <div class="section-middle-pro-2">
    <div class="section-2q">
      <!--<div class="new-pro">
        <p class="probtnp"> store locator </p>
      </div>-->
	  <div class="new-pro-new">
        <p class="probtnp"> store locator </p>
      </div>
      
      <div class="headin-text-1">
      <!--- store locator --->
      <div class="main-slocator">
		<form name="store_locator" id="store_locator" action="<?=SITEPATH?>store_locator_result" >	
      	<div class="t1-slocator" style="text-align:center;">
        enter zip code or city
        </div>
      	<div class="combox-slocator">
      	<input name="near"  id="near" type="text"  class="filed1" />
      	</div>
        
        <div class="combox-slocator">
        	<div style="width:190px; margin:0 auto;">
            <div class="t2-slocator">radius</div>
            <div style="float:left;">
           			
				<select name="distance" id="distance"  class="selectyze5">
					<option value="">--</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="15">20</option>
					<option value="15">50</option>
					<option value="15">100</option>					
				</select>
			</div>
            <div class="t3-slocator" style="padding-top:9px;color:#3E3B3C !important;">Miles</div>           
       		</div>
      </div>
      <div class="clear"></div>
      <div class="t1-slocator" style="text-align:center; margin-top:10px; font-size:13px;">
        or use phone's current location
        </div>
        <div id="err">      
        </div>
        <div class="btnbg-slocator">
		<a href="javascript:void(0)" class="btn-slocator-txt" style="float:left; padding-left:19px" onclick="javascript:getStoreLocator()">store locator</a>      
        </div>
		
        </form>
      </div>
      <!--- /store locator --->     
      </div>
      
      <div class="clear"></div>
    </div>
   </div>
   
<?php 
include_once("footer.php");

?>