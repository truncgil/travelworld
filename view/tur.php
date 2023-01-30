<?php $ust = c($c['kid']); ?>

<div id="page_caption" class="hasbg parallax fullscreen notransparent"
			data-image="<?php r($c['pic'],1920) ?>"
			data-width="1600" data-height="1200">
			<div class="page_title_wrapper">
				<div class="tour_country_subheader"><?php cok($c['slug'],"Ülke") ?></div><br class="clear">
				<h1><?php e($c['title']) ?></h1>
			</div>
			<div class="parallax_overlay_header"></div>
		</div>

		<!-- Begin content -->
		<div id="page_content_wrapper" class="hasbg fullwidth fullscreen ">
            <div class="page_title_wrapper pt-10 w-100 t-center">
				
            
            <div class="inner">

				<!-- Begid Main content -->
				<div class="inner_wrapper">

                    <!-- 
					<div class="tour_meta_wrapper">
						<div class="page_content_wrapper">
							<div class="one_fifth">
								<div class="tour_meta_title">Tarih</div>
								<div class="tour_meta_value"><?php cok($c['slug'],"Tarih") ?></div>
							</div>
							<div class="one_fifth">
								<div class="tour_meta_title">Süre</div>
								<div class="tour_meta_value"><?php cok($c['slug'],"Süre") ?></div>
							</div>
							<div class="one_fifth">
								<div class="tour_meta_title">Fiyat</div>
								<div class="tour_meta_value">
                                    <span class="tour_discount_price"><?php cok($c['slug'],"Fiyat") ?></span></div>
							</div>
							<div class="one_fifth">
								<div class="tour_meta_title">Bölge</div>
								<div class="tour_meta_value"><?php cok($c['slug'],"Bölge") ?></div>
							</div>
							<div class="one_fifth last">
								<a id="tour_book_btn" class="button center" href="iletisim">Yer ayır</a>
							</div>
						</div>
					</div>
                    -->
					<div class="sidebar_content full_width">

						<div class="page_content_wrapper">
							<div style="text-align:center">
								<h2 class="ppb_title hidden"><?php e($c['title']); ?></h2>
								<div class="page_caption_desc"><?php cok($c['slug'],'Tur Programı'); ?></div>
							</div>
							<div class="icerik her-turlu-icerik whole-table-100p tablolu-icerik">
								<?php e($c['html']) ?>
                            </div>
							<!--
							<p>
                                <img class="w-full-h-auto" src="assets/images/1600x1200-2.jpg" alt="Karadeniz Batum Turu">
                            </p>
							-->
                            <br>
							<div style="text-align:center">
								<!--<h2 class="ppb_title">Tur Programı</h2>-->
								<div class="page_caption_desc"><?php cok($c['slug'],"Açıklama") ?></div>
							</div>
							<div class="tur-programi">
                                <?php //cok($c['slug'],"Tur Programı"); ?>
                            </div>

							
						</div>
						
						
						<?php if($c['pic2']!="") { ?>
				<div class="container mb-50">
					<div class="row tr-image-cards" style="position: relative; width: 100%;">
						<?php
						$path = "aa/lib/elfinder/files/turlar/{$c['slug']}";
						mkdir($path,0777,true);
						$galeri = explode(",",$c['pic2']);//glob("$path/*.*"); 
					
						foreach($galeri AS $g){  ?>
						<!-- pic2 -->
						<div class="col-6 col-xs-6 col-sm-4 col-md-3 col-lg-2 card-item p-0">
							<a class="wh-full fancy-gallery" data-fancybox="gallery" href="<?php e($g) ?>" title="<?php e($c['title']) ?>">
								<div class="card-image-outer">
									<div class="card-image square-box bg-cover" style="background-image:url(<?php e($g) ?>);"></div>
								</div>
							</a>
						</div>
						<!-- /pic2 -->
						<?php  } ?>
					</div>
				</div>
				<?php } ?> 
				
			
						<div class="tour_call_to_action parallax"
							style="background-image:url('<?php r($c['pic'],1920) ?>');">
							<div class="parallax_overlay_header tour"></div>

							<div class="tour_call_to_action_box">
								<div class="tour_call_to_action_price"> 
                                </div>
								<div class="tour_call_to_action_book">Yer ayırın</div>
								<a id="call_to_action_tour_book_btn" href="iletisim#siziArayalim" class="button">Yer Ayır</a>
							</div>
						</div>

						

<?php $tur = kd(ksorgu("content","where kid='Turlar' ORDER BY rand() LIMIT 1"));  ?>
<?php $tur2 = kd(ksorgu("content","where kid='Turlar' ORDER BY rand() LIMIT 1"));  ?>
						
					</div>
					
				

				</div>

			</div>
			<!-- End main content -->

		</div>

		


	<span id="turSayfasiSpan"></span>
	</div>
	
	<script type="text/javascript">
	
	</script>