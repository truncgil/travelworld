  <?php 
  
  $ara = ksorgu("content","where kid='{$c['slug']}' AND y=1 ORDER BY s"); ?>
  

  
  <!-- Begin content -->
  <div id="page_content_wrapper" style="margin-top:100px;" class="fullwidth">

      <div class="page_title_wrapper pt-0 w-100 t-center">
          
		  
		  <section class="default-section" style="padding-top: 20px !important;">
			<div class="container">
				<h1><?php e2($c['title']) ?></h1>
				<div class="row" style="width: 100%;">
				<?php 
				while($t = kd($ara)){
				?>
				<!---->
					<div class="col-12 col-xs-12 col-sm-6 col-md-4 ">
					<a class="tur-link" href="<?php e($t['slug']) ?>">
						<div class="w-100-h-auto rect-box bg-cover" style="background-image: url(<?php r($t['pic'],512) ?>);"></div>
						<?php 
						$firsat = cokr($t['slug'],"Fırsat Yazısı");
						$indirim = cokr($t['slug'],"İndirim");
						if($indirim!="" || $indirim!=0) { ?>
						<div class="tour_sale">
							<div class="tour_sale_text">İNDİRİM<br>%<?php e($indirim) ?></div>
						</div>
						<?php } 
						if($firsat!="") {
						?>
						<div class="tour_sale">
							<div class="tour_sale_text"><?php e2($firsat) ?></div>
						</div>
						<?php } ?>
						<div class="thumb_title">
							<div class="tour_country tur-ulke" style="color: #b63327;">
								<?php cok($t['slug'],"Tarih") ?> 
							</div>
							<a href="<?php e($t['slug']); ?>">
								<h3 class="tur-baslik" style="font-weight: bold;"><?php e($t['title']) ?></h3>
							</a>
						</div>
						<div class="row">
							<div class="col-7 col-xs-7">
								<div class="tur-excert">
							<?php 
							$satir = explode(",",strip_tags(cokr($t['slug'],"Açıklama")));
							foreach($satir AS $s) {
								if(trim($s)!="") {		
								?>
									<i class="fa fa-map-marker"></i><?php e2(trim($s)) ?><br>
								<?php } ?>
							<?php } ?>
						</div>
							</div>
							<div class="col-5 col-xs-5">
								<div class="tur-meta" style="width: 100%;">
							<div class="tur-days">
								<?php cok($t['slug'],"Gün") ?></div>
							<div class="tur_price" style="width: 100% !important;">
								<?php $fiyat = cokr($t['slug'],"Fiyat") ?>
								<?php if($indirim!="" || $indirim!=0) { ?>
									<del class="color-red"><?php e(round($fiyat+$fiyat*($indirim/100),2)) ?> TL</del>
								<?php } ?>
								<span style="font-weight: bold;"><?php e($fiyat) ?></span>
							</div>
						</div>
							</div>
						</div>
						
						
						
						
					</a>
					</div>
				<!--/-->
				<?php
				}
				?>
				
				</div>
			</div>
		  </section>
			
			
		
          <!-- Begin content -->
          <div class="inner container">

              <div class="inner_wrapper">

                  <div id="page_main_content" class="sidebar_content full_width">

                      <!--
                      <div class="page_content_wrapper">
                          <form id="tour_search_form" name="tour_search_form" method="get" action="ara">
                              <div class="tour_search_wrapper">
                                  <div class="one_fourth">
                                      <label for="keyword">Gidiş Yeri</label>
                                      <input id="keyword" name="q" type="text"
                                          placeholder="Şehir, bölge veya anahtar kelime">
                                  </div>
                                  <div class="one_fourth">
                                      <label for="start_date">Tarih</label>
                                      <div class="start_date_input">
                                          <input id="start_date" name="start_date" type="text" placeholder="Gidiş">
                                          <input id="start_date_raw" name="start_date_raw" type="hidden">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <div class="end_date_input">
                                          <input id="end_date" name="end_date" type="text" placeholder="Dönüş">
                                          <input id="end_date_raw" name="end_date_raw" type="hidden">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                  </div>
                                  <div class="one_fourth">
                                      <label for="budget">Maks Bütçe</label>
                                      <input id="budget" name="budget" type="text" placeholder="TL Örn. 200">
                                  </div>
                                  <div class="one_fourth last">
                                      <input id="tour_search_btn" type="submit" value="Ara">
                                  </div>
                              </div>
                          </form>
                      </div>
                        -->
                      <div id="portfolio_filter_wrapper" class="three_cols gallery section content clearfix">





                          <?php while($t = kd($ara)){  
								tur_item($t); 
						  } ?>

                      </div>


                  </div>
              </div>
          </div>
      </div>


  </div>