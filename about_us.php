<?php 
	include_once("common_function.php");
	include_once("header.php");
	$page_titles = array('company'=>'about us','family'=>'the purple power','green_initiatives'=>'green/social initiatives','nature'=>'nature','science'=>'science','quality'=>'quality','truth'=>'truth','knowledge'=>'knowledge','needs'=>'needs','ingredients'=>'ingredients');
	 
	$page_index = array('company','family','green_initiatives','nature','science','quality','truth','knowledge','needs','ingredients');
	
	if(isset($_GET['page_name'])) {
		$cur_page = $_GET['page_name'];	
		
	}else {
		$cur_page = '';
	}
	if(array_key_exists($cur_page,$page_titles)) { 
		$title = $page_titles["$cur_page"];
	
	}else {
		$title = 'About us';
	}
	$next_page_index  = array_search($cur_page,$page_index)+1;
	$next_page_url =  $page_index["$next_page_index"];
	$next_page_title = $page_titles["$next_page_url"];
	
	// echo 'n-p-u:'.$next_page_url."<br/>";
	// echo "n-p-name :".$next_page_title."<br/>";
	// echo 'n-p-i:'.$next_page_index;
?>	
	<div class="section-middle-whitenew">
		
		<div class="new-pro-new">
			<p class="probtnp">About us</p>
		</div>
		<div class="navigation"> <span> <a href="<?=SITEPATH?>about/company">
  <? if($cur_page == 'company') echo '<b>Company</b>';else echo 'Company';?>
  </a></span>|<span><a href="<?=SITEPATH?>about/family">
  <? if($cur_page == 'family') echo '<b>the purple power </b>';else echo 'the purple power';?>
  </a></span>|<span><a href="<?=SITEPATH?>about/green_initiatives">
  <? if($cur_page == 'green_initiatives') echo '<b>green/social initiatives</b>';else echo 'green/social initiatives';?>
  </a></span>|<span><a href="<?=SITEPATH?>about/nature">
  <? if($cur_page == 'nature') echo '<b>nature</b>';else echo 'nature';?>
  </a></span>| <span><a href="<?=SITEPATH?>about/science">
  <? if($cur_page == 'science') echo '<b>science</b>';else echo 'science';?>
  </a></span>| <span><a href="<?=SITEPATH?>about/quality">
  <? if($cur_page == 'quality') echo '<b>quality</b>';else echo 'quality';?>
  </a></span>| <span><a href="<?=SITEPATH?>about/truth">
  <? if($cur_page == 'truth') echo '<b>truth</b>'; else echo 'truth';?>
  </a></span>| <span><a href="<?=SITEPATH?>about/knowledge">
  <? if($cur_page == 'knowledge') echo '<b>knowledge</b>'; else echo 'knowledge';?>
  </a></span>| <span><a href="<?=SITEPATH?>about/needs">
  <? if($cur_page == 'needs') echo '<b>Nutritional Needs</b>';else echo 'Nutritional Needs';?>
  </a></span>| <span><a href="<?=SITEPATH?>about/ingredients">
  <? if($cur_page == 'ingredients') echo '<b>Ingredients</b>';else echo 'Ingredients';?>
  </a></span> </div>
		<div class="space-frm-top">&nbsp;</div>
		<?
		switch($cur_page) {	
			CASE 'company' :
			?>
				<div class="abt-us-outer">Nutrition to the Fifth Power</div>
				<div class="about-div">
					<img src="<?=SITEPATH?>images/about.jpg" alt="about-us" width="100" height="120" style="float:left;margin-right:5px;" />
					<p>Bluebonnet Nutrition was founded in 1991 on the basic principle that we offer the cleanest, purest, most natural nutritional supplements offered exclusively through independent natural food retailers. Today, we are proud to say that we still honor this commitment and that our devotion is true and loyal.</p>
					<p>The landscape of nutrition is changing rapidly. However, Bluebonnet Nutrition is not simply changing with it. We&#39;re leading the way. Since the launch of our company in the heart of Sugar Land, Texas, we&#39;ve carefully sowed the seeds of success by our unwavering pledge to the five powers of Bluebonnet Nutrition: <b>Nature, Science, Quality, Truth and Knowledge</b> - one power for every petal of the Texas state flower from which we take our name.</p>	
					
				
				</div>
			<?
				break;	
			CASE 'family' :
				?>
				<div class="abt-us-outer">A Family Affair</div> 
				<div class="about-div">
					<img src="<?=SITEPATH?>images/CompanyFamily.jpg" alt="about-us" width="100%" height="220"  style="margin-bottom: 5px;" />
					<p>Bluebonnet Nutrition is a family-run, independent company similar to the independent natural product retailers we serve. The members of the Barrows family and the extended Bluebonnet family have been actively involved in the natural products industry for decades with the same business virtue of naturalness, purity, innovation, accessibility, integrity, loyalty and quality. We are driven by our close relationships with natural product retailers, who have knowledgeable staff to lead health-conscious consumers to those products that will specifically address their individual nutritional needs and health concerns. No other retail outlet can provide that level of service and expertise.</p>
					<h3 style="color:#80448C;margin-top:5px;margin-bottom:5px;">An Award-Winning Company</h3>
					<p>It was because of this commitment to the founding principals upon which the industry was founded that Bluebonnet Nutrition was awarded the first <strong><i>&#39;Manufacturer of the Year&#39;</i></strong> by Vitamin Retailer in 2006. In fact, Vitamin Retailer Magazine sought input from leading natural product retailers asking them to identify companies in the industry that exemplified the following criteria: leadership, noteworthy/distinctive product line, innovative product development, high-quality manufacturing standards, strong relationship with retailers, community outreach, trade association involvement, reputation, company growth rate, and financial standing. This award acknowledges the strength in the partnership between Bluebonnet and the natural product retailers we serve with a loyalty to the industry that is unrivaled.</p>
					<p>We&#39;ve been honored once again by natural products retailers nationwide as one of the top two supplement lines to receive the coveted 2009 Natural Choice Award from Whole Foods Magazine. In addition, Bluebonnet was awarded the 2009 Best of Supplements Award from Better Nutrition under the heart health category for our CellularActive&reg; CoQ10 Ubiquinol products. This journey to the top has not been by accident but by design. As a company, we have carefully plotted a path that specifically meets the needs of this industry and our customers. And we are extraordinarily grateful for being acknowledged for that commitment, as well as our dedication to state-of-the-art manufacturing, the environment, ecological preservation, social responsibility, energy conservation, waste reduction and most importantly providing the industry with the highest quality, natural and pure, gluten-free, kosher supplements on the market.</p>
					<h3 style="color:#80448C;margin-top:5px;margin-bottom:5px;">An Unrivaled Quality Value</h3>
					<p>The fact that Bluebonnet has been recognized once again by our cherished retailers in light of all of the positive efforts happening on our end is reassuring and extraordinarily gratifying. If you are wondering how Bluebonnet has achieved the level of success over our short 18-year history, we believe there are a multitude of reasons*. Whether it&#39;s selecting the best ingredients the Earth has to offer, or developing pure and unique, cutting-edge formulas based on science, or manufacturing and packaging to the highest eco-friendly and quality standards, or instituting &quot;green&quot; practices throughout our entire operations, or distributing to only natural food retailers, Bluebonnet Nutrition takes pride in every step of the process to guarantee that we deliver the most pure, potent, high-quality natural nutritional supplements available with as little impact on the environment as possible.</p>
					<p>So as a consumer of Bluebonnet products, you can be assured that your choice is a wise one&Scaron; one that packs the punch on natural quality and value. Your commitment to healthy living and intelligent nutritional choices has both short- and long-term health benefits. We are proud to be helping a generation of health-conscious consumers like you get even healthier, and we are grateful to you for making us an integral part of your daily healthcare regimen.</p>
				</div>
			<?
				break;	
			CASE 'green_initiatives' :
			?>
				<div class="abt-us-outer">Everything Purple Starts Off Green</div>
				<div class="about-div">
					<img src="<?=SITEPATH?>images/bluebonnet_green.jpg" alt="about-us" width="100" height="120" style="margin-right:5px;float:left" />
					<p>Environmental protection and stewardship are certainly buzzwords for the new millennium. But at Bluebonnet Nutrition, they have been part of our corporate culture since our company was founded in 1991. We believe we are citizens of the world. That companies &ndash; and individuals &ndash; must do what they can to preserve the Earth and its finite resources. We are serious about making the world a better place &ndash; for today and tomorrow &ndash; because the risks are real. In 2010, the world&#39;s population was estimated to be nearly seven billion and growing. At this rate, there will be nine billion people by the year 2050. Think of the natural resources needed to sustain this increase in population! Yet, our resources are dwindling.</p>
					<p>It&rsquo;s not enough to be environmentally and socially &ldquo;responsible.&rdquo; We must become activists. At Bluebonnet, that includes enterprise-wide &ldquo;green&rdquo; initiatives and environmentally sound manufacturing practices. Our actions represent a new generation of people who support sustainability, reduce dependency on fossil fuels, and give back to the world at large.</p>
					
				</div>
				
			<?	
				break;
			CASE 'nature' :
			?>
				<div class="abt-us-outer">The Best the Earth Can Offer</div>
				<div class="about-div">
					<img src="<?=SITEPATH?>images/naturepic.jpg" alt="nature" width="100" height="120" style="margin-right:5px;float:left;" />
					 <p>Our first commitment has always been to nature. Not only so we can identify nutrients that are good, pure and wholesome, but also so we can harness nature&#39;s power and benefit from its strength.</p>
					<p>We search the world for locations where climate, temperature and soil converge to grow the finest raw materials. Conducting frequent on-site inspections, our ingredient selections are never based on price, but instead on one simple criterion: Is it the best the Earth has to offer?</p>
					<p>To preserve nature&#39;s freshness, we purchase raw materials in small quantities. And when ingredients enter our warehouse, they are quarantined and sent to our on-site quality assurance laboratory to undergo raw material identification and microbial testing. If a nutrient does not meet our stringent quality standards, it cannot be used in Bluebonnet supplements.</p>
					
				</div>

				
			<?
				break;
			CASE 'science' :
			?>
				<div class="abt-us-outer">Innovation is Only Natural</div>
				<div class="about-div">
					<img src="<?=SITEPATH?>images/sciencepic.jpg" alt="science" width="100" height="120" style="margin-right:5px;float:left;" />
					 <p>With over 100 years of collective industry experience in nutritional science, our product development team is not only ensuring that Bluebonnet supplements are safe and efficacious, they&#39;re also committed to developing cleaner, more effective formulas. In fact, Bluebonnet has been the first to launch some of the industry&#39;s most innovative ingredients, such as ubiquinol, licorice flavonoid oil (Glavonoid&reg;), grape seed extract, vegetarian SOD (GliSODin&reg;) and nucleotides. And in a highly competitive, uninspired protein beverage market, we have included the latter two revolutionary ingredients in the most unique protein formulas to hit the market in years: Super Earth&reg; Phytonutrient Soy Protein Powder and Multi-Action Whey of Life&reg; Protein Powder.</p>
								
				</div>
	
				
			<?
				break;
			CASE 'quality' :
			?>
				<div class="abt-us-outer">Setting New Standards</div>
				<div class="about-div">
					<img src="<?=SITEPATH?>images/qualitypic.jpg" alt="about-us" width="100" height="120" style="margin-right:5px;float:left;" />
					<p>
					Quality may be the most overused word in the world today. Nonetheless, 
					for nutritional supplements, what could be more important? That is why we built our own 100,000 sq ft, state-of-the-art kosher manufacturing and distribution facility with earth-friendly, pharmaceutical-grade 
					systems that are setting new standards for quality assurance. Plus, we have also invested in the arduous process of kosher certifying our products. Since keeping kosher has become synonymous with eating foods 
					that have been manufactured at a higher standard, Bluebonnet products bearing the KOF-K emblem have been carefully supervised with each ingredient tracked to its origin and strict rules imposed on hygienic processes.
					</p>
					<p>
					In addition to applying kosher quality standards to our operation, our manufacturing process meets the rigorous model established by the U.S.Pharmacopoeia - even though we don't have to. By the time a Bluebonnet 
					supplement appears on a store shelf, it has been subjected to stringent examinations for potency, purity, uniformity, hardness, disintegration 
					and dissolution. And not just by in-house quality control technicians,but by respected independent laboratories. That is quality that will 
					last even after you have opened the bottle.
					</p>	
 					
				</div>

				
			<?
				break;
			CASE 'truth' :
			
			?>
				<div class="abt-us-outer">Just the Facts</div>
				<div class="about-div">
				<img src="<?=SITEPATH?>images/truthpic.jpg" alt="about-us" width="100" height="120" style="margin-right:5px;float:left;" />
				<p>There are so few absolute truths in the world today - except when it comes to nutritional supplements. Nutrients are either in the supplement or they are not. At Bluebonnet Nutrition, we make sure they are.</p>
				<p>Not only do we manufacture 90% of our products in-house, we employ a unique practice called &quot;content uniformity&quot; to ensure a consistent nutrient blend from batch to batch. It is part of Bluebonnet&#39;s commitment to the natural products industry, as well as our own principles.</p>
				<p>Before a Bluebonnet supplement arrives at a natural food store, it is analyzed and evaluated by lab technicians. Through HPLC assay tests, Bluebonnet documents with 100% accuracy that what is on the label is in the bottle. We even perform accelerated stability tests to ensure that potency levels will be maintained through the expiration date. Bottomline, on Bluebonnet labels, what you read is always what you get.</p>
					
				</div>

				
			<?
				break;
			CASE 'needs' :
			
			?>
				<div class="abt-us-outer">MEETING NUTRITIONAL NEEDS</div>
				<div class="about-div">
				<img src="<?=SITEPATH?>images/productline.jpg" alt="nutritional needs" width="100%" height="130" style="margin-right:5px;" />
				<p>Bluebonnet offers a complete line of natural vitamins, minerals, multiples, amino acids, proteins, herbal extracts, and specialty supplements, such as antioxidants, CoQ10/ubiquinol, glucosamine, omega fatty acids, fiber/digestive aids, probiotics and food supplements. All made without unnecessary colors, flavors, fillers, binders or excipients.</p>
				<p>Choose a &quot;delivery system&quot; that suits your lifestyle: caplets, mini-caplets, softgels, chewables, liquids, powders or Kosher vegetarian capsules. Your loyalty and trust in our nutritional supplements is greatly appreciated by the Bluebonnet family. Visit our website at www.bluebonnetnutrition.com where you will find a comprehensive online product database featuring a complete disclosure of ingredients and label information, as well as a store locator to help you find the natural food stores nearest you that carry Bluebonnet products.</p>
				
				</div>

				
			<?
				break;	
				
			CASE 'knowledge' :
				
			?>
				<div class="abt-us-outer">Everything You Need To Know</div>
				<div class="about-div">
					<img src="<?=SITEPATH?>images/knowledgeshop.jpg" alt="knowledgeshop" width="100" height="120" style="margin-right:5px;float:left;" />
					<p>It is one thing to purchase the most pure, potent, fast-absorbing, high-quality nutritional supplements on the market. It is quite another to know which ones are right for you. That is why you will find Bluebonnet nutritional supplements exclusively in natural food stores. These retailers are committed to healthy living and higher learning. They understand how nutrients function in the body and will help you make educated choices that meet your nutritional needs.
					</p>
					<p>Getting expert advice has never been more essential. The science of nutrition is constantly changing. And, there are so many nutritional supplements to choose from, you simply can't self-serve. By putting our faith - and our supplements - in natural food stores, we have made the intelligent choice, so you can too.
					</p>
					
				</div>

			<?
				break;
			CASE 'ingredients' :
				
			?>
				<div class="abt-us-outer">High quality branded ingredients</div>
				<div class="about-div">
					<div>Bluebonnet proudly incorporates these and many other high-quality branded ingredients into our premium product line: </div>
					<div style="margin-top:20px;"> </div>
					
				<?
				  
				  $label_dir = "labels/";	
				  $label_imgs = array('aji_pure.gif','albion_mineral.gif','betatene.gif','carni_pure.gif','celadrin.gif','chromax.gif','cinnulin_pf.gif','circumenc3complex.gif','earth_sweet.gif','epax.gif','ez_eyes.gif','floraglo.gif','glisodin.gif','indena.gif','kaneka_glavanoid.gif','kanekaq10.gif','kanekaqplus.gif','leci_ps.gif','lycomato.gif','neuromins_dha.gif','nzimes.gif','opti_berry.gif','opti_msm.gif','ostivone.gif','pureflex.gif','pycnogenol.gif','selenopure.gif','soylife.gif','suntheanine.gif','super_citrimax.gif','tryptopure.gif','vcap.gif');		
				  for($i= 0; $i< count($label_imgs);$i++) {
					
				 ?>	
					<div><div style="float:left;width:26%;margin:2px 5px 2px 5px;text-align:center;"><img src="<?=$label_dir.$label_imgs[$i];?>" /></div>
					<? if(isset($label_imgs[++$i])) { ?>		
					<div style="float:left;width:26%;margin:2px 5px 2px 16px;text-align:center;"><img src="<?=$label_dir.$label_imgs[$i];?>" /></div>
					<? } 
					if(isset($label_imgs[++$i])) { ?>
					<div style="float:left;width:26%;margin:2px 5px;text-align:center;"><img src="<?=$label_dir.$label_imgs[$i];?>" /></div></div>
					
							
				<?
					}
					echo "<div class='clear'>&nbsp;</div>";

					/*if($i == count($label_imgs)) { 
						echo "<div class='clear'>&nbsp;</div>";
						break;
					}else {
						echo "<div class='line_break'>&nbsp;</div>";
					}
					*/
				 }	
				
				?>
		
				</div>
				
			<?					
				break;
			default :
			?>
				<div class="abt-us-outer">Nutrition to the Fifth Power</div>
				<div class="about-div">
					<img src="<?=SITEPATH?>images/about.jpg" alt="about-us" width="100" height="120" style="margin-right:5px;float:left;" />
					<p>Bluebonnet Nutrition was founded in 1991 on the basic principle that we offer the cleanest, purest, most natural nutritional supplements offered exclusively through independent natural food retailers. Today, we are proud to say that we still honor this commitment and that our devotion is true and loyal.</p>
					<p>The landscape of nutrition is changing rapidly. However, Bluebonnet Nutrition is not simply changing with it. We&#39;re leading the way. Since the launch of our company in the heart of Sugar Land, Texas, we&#39;ve carefully sowed the seeds of success by our unwavering pledge to the five powers of Bluebonnet Nutrition: <b>Nature, Science, Quality, Truth and Knowledge</b> - one power for every petal of the Texas state flower from which we take our name.</p>	
			
				</div>
			<?
		}	
		?>
		<? if($cur_page != 'ingredients') { ?>
			<a href="<?=SITEPATH?>about/<?=$next_page_url?>" style="color:#fff;text-decoration:none;" class="abt-suple" style="color:#80448C;" ><?=$next_page_title?></a>
		   <div class="clear"></div>
		<?
			}
		?>	
	
		
		
	</div>
	
	<? include_once("footer.php") ?>
	