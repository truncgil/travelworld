asdsad

<div id="page_caption" class="hasbg parallax" data-image="assets/images/1600x1200-12.jpg" data-width="1600"
	data-height="1200">
	<div class="page_title_wrapper">
		<h1>Turlar</h1>
		<div id="crumbs">
			<a href="./">Anasayfa</a> /
			<span class="current">Turlar</span>

		</div>
	</div>
	<div class="parallax_overlay_header"></div>
</div>

<!-- Begin content -->
<div id="page_content_wrapper" class="hasbg fullwidth">

	<div class="page_title_wrapper pt-0 w-100 t-center">
		<!--
		<div id="crumbs" class="tr-crumbs">
			<a href="./">Anasayfa</a> /
			<span class="current">Turlar</span>
		</div>
		-->
		<!-- Begin content -->
		<div class="inner">

			<div class="inner_wrapper">

				<div id="page_main_content" class="sidebar_content full_width" style="padding-top: 0 !important;">
					<h2 class="ppb_title d-none"><span class="renk-1"><?php set('Anasayfa Birinci Bölüm Başlık 1'); ?></span> <span class="renk-2"><?php set('Anasayfa Birinci Bölüm Başlık 2'); ?></span></h2>

					<div class="page_caption_desc" style="color: #000 !important; margin-bottom: 0 !important;"><?php set('Anasayfa Birinci Bölüm Kırmızı Açıklama'); ?></div>

					
					 
					<div class="container custom-container" style="padding-right: 0;">
						<div class="row custom-row">
						<h2 class="default-section-title"><?php set('Turlar Sayfası Başlık'); ?></h2>
						
						<div id="portfolio_filter_wrapper" class="three_cols gallery section content clearfix">




						<?php  $turlar = contents("turlar"); ?>
                          <?php while($t = kd($turlar)){  
								tur_item($t); 
						  } ?>

                      </div>
						<?php $turlar = 0;// contents("turlar"); $i = 1; 
						while($t = kd($turlar)) {  ?>
							<div class="col-12 col-xs-12 col-sm-6 col-md-4 <?php if($i % 3 == 0) echo 'pr-md-0'; ?> turs mt-20 custom-turs" style="padding-left: 0;">
								<a href="<?php e($t['slug']); ?>" class="w-100-h-auto">
									
									<div class="w-100 h-15rem bg-cover" style="background-image: url(<?php r($t['pic'],512) ?>);">
										<?php $indirim = cokr($t['slug'], 'İndirim'); ?>
										<?php if(cokr($t['slug'], 'Fiyat') != '' && !empty(cokr($t['slug'], 'Fiyat')) && $indirim != "" && $indirim!=0){ ?>
											<div class="tarih-band" style="font-size: 0.8rem;">
											
											
												<?php $fiyat = cokr($t['slug'],"Fiyat"); $indirim = cokr($t['slug'], 'İndirim'); ?>
												<?php if($indirim!="" || $indirim!=0) { ?>
													<del class="color-white"><?php e(round($fiyat+$fiyat*($indirim/100),2)) ?> TL</del>
												<?php } ?>
												<span style="font-weight: bold; color: #fff;"><?php e($fiyat) ?></span>
											
											
											</div>
										<?php } elseif(cokr2($t['slug'], 'Fırsat Yazısı') != '' && !empty(cokr2($t['slug'], 'Fırsat Yazısı'))){
										?>
											
											<div class="tarih-band" style="font-size: 0.8rem;">
											
											
												
												<span style="font-weight: bold; color: #fff;"><?php cok2($t['slug'], 'Fırsat Yazısı'); ?></span>
											
											
											</div>
											
										<?php
										} ?>
										<img class="dis-none" src="<?php r($t['pic'],512) ?>" alt="<?php e2($t['title']) ?>">
									</div>
								</a>
								<div class="content">
									<div class="row" style="width: 100%;">
										<div class="col-8 col-xs-8">
											<div class="country <?php if($i % 3 == 1) echo 'pl-5-turs'; ?>" ><?php e2($t['title']) ?></div>
											<div class="col-12 col-xs-12" style="text-align: justify; font-size: .8rem; font-style: italic; padding: 0 !important;">
											<?php cok($t['slug'], 'Tarih'); ?>
											</div>
											
												
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
										<div class="col-4 col-xs-4" style="padding-right: 0;">
											
												<div class="w-100">
													<div class="days">
														<?php cok($t['slug'],"Gün") ?>
													</div>
												</div>
												<div class="w-100">
													<div class="price">
														<?php cok($t['slug'],"Fiyat") ?>
													</div>
												</div>
											
										</div>
										
									</div>
									
								</div>
								
							</div>
						<?php $i +=1; } ?>
						</div>
					</div>

					


				</div>
			</div>
		</div>
	</div>
	<br class="clear"><br>


</div>
