<?php	
	include_once("header.php");
?>
<div style="min-width:320px; max-width:98%; margin:0px auto;">
	<div style="margin: 0px auto; width:100%;margin-bottom:10px;">
        <div id="slider_container_1">
            <div id="SliderName">
              <a href="http://www.betternutrition.com/best-of-supplements-2011/features/featurearticles/1136" class="anchor-decoartion-none"> <img src="<?=SITEPATH?>img/11.jpg" /> </a>
		<a href="<?=SITEPATH?>about/green_initiatives" class="anchor-decoartion-none"><img src="<?=SITEPATH?>img/purple22.jpg" /></a>
              <a href="http://www.betternutrition.com/best-of-supplements-2011/features/featurearticles/1136" class="anchor-decoartion-none"> <img src="<?=SITEPATH?>img/11.jpg" /> </a>
		<a href="<?=SITEPATH?>about/green_initiatives" class="anchor-decoartion-none"><img src="<?=SITEPATH?>img/purple22.jpg" /></a>

	
            </div>
            <div class="clear">
            </div>
            <div id="SliderNameNavigation">
            </div>
            <div class="clear">
            </div>

            <script type="text/javascript">

                // we created new effect and called it 'demo01'. We use this name later.
                Sliderman.effect({ name: 'demo01', cols: 10, rows: 5, delay: 10, fade: true, order: 'straight_stairs' });

                var demoSlider = Sliderman.slider({ container: 'SliderName', width: 100, height: 150, effects: 'demo01',
                    display: {
                        pause: true, // slider pauses on mouseover
                        autoplay: 1000, // 3 seconds slideshow
                        //always_show_loading: 200, // testing loading mode
                        //description: { background: '#ffffff', opacity: 0.5, height: 50, position: 'bottom' }, // image description box settings
                        //loading: { background: '#000000', opacity: 0.2, image: 'img/loading.gif' }, // loading box settings
                        //buttons: { opacity: 1, prev: { className: 'SliderNamePrev', label: '' }, next: { className: 'SliderNameNext', label: ''} }, // Next/Prev buttons settings
                        navigation: { container: 'SliderNameNavigation', label: '&nbsp;'} // navigation (pages) settings
                    }
                });

            </script>

        </div>
    </div>
	
    <!--- middle part --->
	<div class="clear">
            </div>
    <div class="maincontainer">
		<!-- banner -->
			
		
	<div class="clear">
            </div>
   		<div class="Sboxmain1">
	
        <div class="innermain">
			<a href="<?=SITEPATH?>about/company"><div class="abt-btn"><p>ABOUT US</p></div></a>
            <a href="<?=SITEPATH?>product_types"><div class="pro-btn"><p>PRODUCTS</p></div></a>
            <a href="<?=SITEPATH?>contact_us"><div class="cont-btn"><p>CONTACT US</p></div></a>
            <a href="<?=SITEPATH?>store_locator"><div class="sloc-btn"><p>STORE LOCATOR</p></div></a>
         </div>
      </div>
    </div>
    <!--- middle part --->
	</div>
<? 
	include_once("footer.php");

?>