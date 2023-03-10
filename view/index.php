
		<!-- Slider -->
		<?php if(isMobile()) { ?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
			<div class="owl-carousel" style="margin-top:62px;">
			<?php $slider = contents("mobile-slider");
			while($s = kd($slider)) {
				?>
				<img src="<?php r($s['pic'],512) ?>" alt="<?php e($s['title']) ?>">
				<?php 
			}
			?>
			</div>
			<script>
				$(function(){
					$(".owl-carousel").owlCarousel({
						items : 1,
						loop: true
					});
				});
			</script>
		<?php } else { ?>
		<section class="carousel slide carousel-fade h-100vh" id="mainSlider" data-ride="carousel">
			<ol class="carousel-indicators">
			<?php $slider = contents("slider"); 
			$k = 0;
			while($s = kd($slider)) { ?>
				<li data-target="#mainSlider" data-slide-to="<?php echo $k; ?>" <?php if($k == 0){ ?> class="active" <?php } ?>>
					<div></div>
				</li>
			<?php $k++; } ?>
			</ol>
			<div class="carousel-inner h-100vh" role="listbox">
 			<?php $slider = contents("slider"); 
 			$k = 0;
 			while($s = kd($slider)) { ?>
 				<div class="carousel-item <?php if($k==0) e("active"); ?> container-fluid h-100vh parallax-section"
                     style="background-image:url(<?php r($s['pic'],1920) ?>);">
                     <a href="<?php cok($s['slug'], 'link'); ?>" class="no-underline-on-hover">
 					<div class="row">
 	
 						<div class="col-12 col-md-10 offset-md-1">
 							<div class="row mt-40vh mt-md-70vh">
 							<?php $satir = explode("\n", strip_tags($s['html'])); ?>
 								<p class="first-line first-of-first color-white white-text-shadow fs-0p7rem w-full t-center animated bounceInDown delay-1s t-underline t-italic t-uppercase">
 									<?php e($satir[0]); ?>
 								</p>
 								<h2 class="first-line color-white white-text-shadow fs-4rem w-full animated bounceInLeft delay-2s t-uppercase t-center">
 									<?php e($s['title']) ?>
 								</h2>
 								<p class="first-line color-white white-text-shadow fs-0p7rem w-50p m-0-auto animated bounceInRight delay-2s t-center">
 									<?php e($satir[2]); ?>
 								</p>
 							</div>
 						</div>
 	
                     </div>
                 </a>
 				</div>
 			<?php $k++; } ?> 
			 
			
			</div>
			<a class="carousel-control-prev" href="#mainSlider" role="button" data-slide="prev">
				<div class="carousel-nav-icon">
					<img class="w-full-h-auto" src="assets/images/left-chevron.svg" alt="Geri">
					<span class="sr-only">Geri</span>
				</div>
			</a>
			<a class="carousel-control-next" href="#mainSlider" role="button" data-slide="next">
				<div class="carousel-nav-icon">
                    <img class="w-full-h-auto" src="assets/images/right-chevron.svg" alt="??leri">
					<span class="sr-only">??leti</span>
				</div>
			</a>
	
		</section>
		<!-- /Slider -->
		<?php } ?>

		<div class="ppb_wrapper  ">
			<div class="one pp_tour_search d-none">
				<div class="page_content_wrapper">
					<form id="tour_search_form" name="tour_search_form" method="get"
						action="ara">
						<div class="tour_search_wrapper">
							<div class="one_fourth">
								<label for="keyword">Gidi?? Yeri</label>
								<input id="keyword" name="q" type="text" placeholder="??ehir, b??lge veya anahtar kelime">
							</div>
							<div class="one_fourth">
								<label for="start_date">Tarih</label>
								<div class="start_date_input">
									<input id="start_date" name="start_date" type="text" placeholder="Gidi??">
									<input id="start_date_raw" name="start_date_raw" type="hidden">
									<i class="fa fa-calendar"></i>
								</div>
								<div class="end_date_input">
									<input id="end_date" name="end_date" type="text" placeholder="D??n????">
									<input id="end_date_raw" name="end_date_raw" type="hidden">
									<i class="fa fa-calendar"></i>
								</div>
							</div>
							<div class="one_fourth">
								<label for="budget">Maks B??t??e</label>
								<input id="budget" name="budget" type="text" placeholder="TL ??rn. 200">
							</div>
							<div class="one_fourth last">
								<input id="tour_search_btn" type="submit" value="Ara">
							</div>
						</div>
					</form>
				</div>
			</div>

			<!-- En iyi f??rsatlar -->
			<div class="ppb_tour one withpadding " style="border-top:1px solid #e1e1e1;">
				<div class="page_content_wrapper full_width" style="text-align:center">
					<h2 class="ppb_title"><span class="renk-1"><?php set('Anasayfa Birinci B??l??m Ba??l??k 1'); ?></span> <span class="renk-2"><?php set('Anasayfa Birinci B??l??m Ba??l??k 2'); ?></span></h2>

					<div class="page_caption_desc" style="color: #000 !important;"><?php set('Anasayfa Birinci B??l??m K??rm??z?? A????klama'); ?></div>
					<div class="portfolio_filter_wrapper three_cols fullwidth shortcode gallery section content clearfix index_wrapper">
						<?php $turlar = contents("turlar");  ?>
						<?php while($t =kd($turlar)){ 
						?>
							<!-- Tur -->
							
							<div class="element portfolio3filter_wrapper" style="min-height: 0 !important; height: auto !important;">
								<?php if(cokr($t['slug'], 'F??rsat Yaz??s??') != '' && !empty(cokr($t['slug'], 'F??rsat Yaz??s??'))){ ?>
								<div class="tarih-band"><?php cok($t['slug'],'F??rsat Yaz??s??'); ?></div>
								<?php } ?>
								<div class="one_third gallery3 filterable gallery_type animated1">
									<a href="<?php e($t['slug']) ?>">
										<div class="bg-cover en-iyi-tur" style="background-image: url(<?php r($t['pic'],512) ?>);">
											<img class="d-none" src="<?php r($t['pic'],512) ?>" alt="<?php e($t['title']) ?>">
										</div>
										
									</a>
									<div class="thumb_content fullwidth ">
										<div class="thumb_title">
											<div class="tour_country">
												<?php 
													//cok($t['slug'],"??lke")
													//e(kelime(strip_tags($t['html']),5));
												?>
											</div>
											<h3><a class="cust-link" href="<?php e($t['slug']) ?>"><?php e($t['title']) ?></a></h3>
											<span style="font-size: 0.8rem; color: white !important; text-decoration: underline;">
												<?php cok($t['slug'], 'Tarih'); ?>
											</span>
										</div>
										<div class="thumb_meta">
											<div class="tour_days">
												<?php cok($t['slug'],"G??n") ?>
											</div>
											<div class="tour_price">
												<?php $indirim = cokr($t['slug'],"??ndirim"); ?>
												<?php $fiyat = cokr($t['slug'], "Fiyat"); ?>
												<?php 
													if($indirim != '' && $indirim != 0){
												?>
													<del class="color-red"><?php e(round($fiyat+$fiyat*($indirim/100),2)) ?> TL</del>
												<?php
													}
												?>
												<?php cok($t['slug'],"Fiyat") ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Tur -->
						<?php
						 } ?>
						
						
						
						
						
					</div>
				</div>
			</div>

			<div class="one withsmallpadding fullwidth mb-40">
				<div class="page_content_wrapper">
					<div class="container">
						<div class="row">
							<h2 class="ppb_title w-full t-center mb-40"><?php set('G??r????ler Ba??l??k'); ?></h2>
							<div class="carousel slide w-full" data-ride="carousel" id="testimonialSliderCustom">
								<div class="carousel-inner t-center">
								<?php $k = 0; $gorusler = contents("musteri-gorusleri"); while($g = kd($gorusler)) { ?>
									<div class="carousel-item <?php if($k==0) echo "active"; ?> col-10 offset-1 col-md-4 offset-md-4 t-center">
										<h4 class="w-full t-center"><?php e($g['title']) ?></h4>
										<p class="w-full t-center	">
											<?php e(strip_tags($g['html'])) ?>
										</p>
										<p class="fs-0p8rem w-full t-center">
											<?php cok($g['slug'],"Ad Soyad") ?>
											<br>
											<span class="fs-0p7rem"><?php cok($g['slug'],"??nvan") ?></span>
										</p>

									</div>
								<?php $k++; } ?>
								
                                </div>
                                <a class="carousel-control-prev" href="#testimonialSliderCustom" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true">
                                        <i class="fa fa-chevron-left" style="color: #333; font-size: 2rem;"></i>
                                    </span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                <a class="carousel-control-next" href="#testimonialSliderCustom" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true">
                                        <i class="fa fa-chevron-right" style="color: #333; font-size: 2rem;"></i>
                                    </span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <?php /*
								 <ol class="cust carousel-indicators mt-50">
								 <?php for($a = 0;$a<=$k;$a++) { ?>
									<li data-target="#testimonialSliderCustom" data-slide-to="<?php e($a) ?>" <?php if($a==0) { ?>class="active"<?php } ?>></li>
								 <?php } ?>
                                </ol>
                                */ ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="one withsmallpadding withbg fullwidth parallax d-none d-md-block" style="height:600px;"
				data-image="<?php $as = ksorgu('content',"WHERE slug='tanitim-resmi'"); $a = kd($as); r($a['pic'],1920); ?>"
				data-width="1600" data-height="1200">
				<div class="page_content_wrapper"></div>
			</div>
			<div class="one withsmallpadding ">
			<?php $abt = c("anasayfa-bir-tur"); ?>
				<div class="page_content_wrapper">
					<p></p>
					<div style="text-align:center">
						<h2 class="ppb_title"><?php e($abt['title']) ?></h2>
						<div class="page_caption_desc"></div>
					</div>
					<?php e($abt['html']) ?>
					<p>
					</p>
				</div>
			</div>
			<div class="one withsmallpadding withbg parallax "
				data-image="https://themegoods-cdn-pzbycso8wng.stackpathdns.com/altair/demo/wp-content/uploads/2014/10/1600x1200-12.jpg"
				data-width="1600" data-height="1200">
				<div class="page_content_wrapper" style="text-align:center">
					<h2 class="ppb_title">Neden Biz?</h2>
					<div style="height:20px"></div><br>
					<div class="service_content_wrapper ">
					
						<div class="one_third ">
							<div class="service_wrapper">
								<div class="service_icon"><i class="fa fa-star"></i></div>
								<div class="service_title">
									<h3><?php set("Neden Biz Ba??l??k 1") ?></h3>
									<div class="service_content"><?php set("Neden Biz A????klama 1") ?>
										<br><br>
										<a href="hakkinda">Daha Fazla</a></div>
								</div>
							</div>
						</div>
						<div class="one_third ">
							<div class="service_wrapper">
								<div class="service_icon"><i class="fa fa-globe"></i></div>
								<div class="service_title">
									<h3><?php set("Neden Biz Ba??l??k 2") ?></h3>
									<div class="service_content"><?php set("Neden Biz A????klama 2") ?>
										<br><br>
										<a href="hakkinda">Daha Fazla</a></div>
								</div>
							</div>
						</div>
						<div class="one_third last ">
							<div class="service_wrapper">
								<div class="service_icon"><i class="fa fa-thumbs-up"></i></div>
								<div class="service_title">
									<h3><?php set("Neden Biz Ba??l??k 3") ?></h3>
									<div class="service_content"><?php set("Neden Biz A????klama 3") ?>
										<br><br>
										<a href="hakkinda">Daha Fazla</a></div>
								</div>
							</div>
						</div><br class="clear"><br>
					</div><br class="clear">
				</div>
			</div>
			<div class="one withsmallpadding " style="background:#f3f3f3;">
				<div class="page_content_wrapper">
					<p></p>
					<div class="one_fourth">
						<div class="animate_counter_wrapper"><i class="fa fa-smile-o"></i><br>
							<div id="15665488502014898562" class="odometer" style="font-size:44px;line-height:44px;"><?php set("Mutlu M????teri Saya??") ?>
							</div>
							<div class="count_separator"><span></span></div>
							<div class="counter_subject">Mutlu M????teri</div>
						</div>
					</div>
					<div class="one_fourth">
						<div class="animate_counter_wrapper"><i class="fa fa-bus"></i><br>
							<div id="15665488501467459013" class="odometer" style="font-size:44px;line-height:44px;"><?php set("Tur Saya??") ?>
							</div>
							<div class="count_separator"><span></span></div>
							<div class="counter_subject">Tur</div>
						</div>
					</div>
					<div class="one_fourth">
						<div class="animate_counter_wrapper"><i class="fa fa-briefcase"></i><br>
							<div id="1566548850575211780" class="odometer" style="font-size:44px;line-height:44px;"><?php set("Yolculuk Saya??") ?>
							</div>
							<div class="count_separator"><span></span></div>
							<div class="counter_subject">Yolculuk</div>
						</div>
					</div>
					<div class="one_fourth last">
						<div class="animate_counter_wrapper"><i class="fa fa-comments-o"></i><br>
							<div id="1566548850948178997" class="odometer" style="font-size:44px;line-height:44px;"><?php set("Destek Hizmeti Saya??") ?>
							</div>
							<div class="count_separator"><span></span></div>
							<div class="counter_subject">Destek Hizmeti</div>
						</div>
					</div>
					<p>
					</p>
				</div>
			</div>
			<div class="one withsmallpadding withbg "
				style="background-image:url(assets/images/1600x1200-15.jpg);background-size:cover;margin-top:-1px;">
				<div class="page_content_wrapper fullwidth" style="text-align:center">
					<h2 class="ppb_title"><?php set('Anasayfa Haberler Ba??l??k'); ?></h2>
					<div class="page_caption_desc"><?php set('Anasayfa Haberler A????klama'); ?></div>
					<div id="blog_grid_wrapper" class="sidebar_content full_width ppb_blog_posts"
						style="text-align:left">
						<?php $haberler = contents("haberler"); while($h = kd($haberler)) { ?>
						<!-- Haber -->
						<div id="post-2720" class="post type-post hentry status-publish">
							<div class="post_wrapper grid_layout"
								style="background-image:url('<?php r($h['pic'],512) ?>');">
								<div class="parallax_overlay_header"></div>
								<div class="grid_wrapper">
									<div class="post_header grid"><a href="iletisim"
											title="Standard Blog Post With Image">
											<h6><?php e($h['title']) ?></h6>
										</a>
										<div class="post_detail">
											<?php e(tt($h['date'])); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<!-- /Haber -->
						
					</div><br class="clear">
				</div>
			</div>
		</div>


	</div>