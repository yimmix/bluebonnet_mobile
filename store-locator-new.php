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
    <div class="section-2">
      <div class="new-pro">
        <p class="probtnp"> store locator </p>
      </div>
      
      <div class="headin-text-1">
      <!--- store locator --->
      <div class="main-slocator">
		<form name="store_locator" id="store_locator" action="/bluebonnet/store_locator_result" >	
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
				<option value="1">1</option>
		        <option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
			
			</select>
			</div>
            <div class="t3-slocator">Miles</div>           
       		</div>
      </div>
      <div class="clear"></div>
      <div class="t1-slocator" style="text-align:center; margin-top:10px; font-size:13px;">
        or use phone's current location
        </div>
        <div id="err"></div>
        <div class="btnbg-slocator"><div class="btn-slocator-txt"><input type="button" value= "locate store" onclick="javascript:getStoreLocator();" />  </div>      
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