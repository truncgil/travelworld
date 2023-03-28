
		<!-- Slider -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
		

		<?php if(isMobile()) { ?>
			<div class="owl-carousel owl-theme" style="margin-top:62px;">
			<?php $slider = contents("mobile-slider");
			while($s = kd($slider)) {
				?>
				<a href="<?php cok($s['slug'],"link") ?>">

				<img data-src="<?php r($s['pic'],512) ?>" class="owl-lazy" alt="<?php e($s['title']) ?>">
				</a>
				<?php 
			}
			?>
			</div>
			<script>
				$(function(){
					$(".owl-carousel").owlCarousel({
						items : 1,
						loop: true,
						dots: true,
						//nav: true,
						autoplay:true,
						lazyLoad: true,
						autoplayTimeout:3000,
						autoplayHoverPause:false
					});
				});
			</script>
		<?php } else { ?>
			<div class="owl-carousel owl-theme" style="margin-top:62px;">
			<?php $slider = contents("slider");
			while($s = kd($slider)) {
				?>
				<a href="<?php cok($s['slug'],"link") ?>">
					<img data-src="<?php r($s['pic'],1920) ?>" class="owl-lazy" alt="<?php e($s['title']) ?>">
				</a>
				<?php 
			}
			?>
			</div>
			<script>
				$(function(){
					$(".owl-carousel").owlCarousel({
						items : 1,
						loop: true,
						dots: true,
						//nav: true,
						autoplay:true,
						lazyLoad: true,
						autoplayTimeout:3000,
						autoplayHoverPause:false
					});
				});
			</script>
		
		<?php } ?>

		<div class="ppb_wrapper">
			<div class="  mb-5 ">
				<div class="page_content_wrapper">
					<form id="" name="" method="get"
						action="ara">
						<label for="keyword"><?php e2("Gidiş Yeri") ?></label>
						<div class="input-group">
							<input id="keyword" class="form-control" name="q" type="text" placeholder="<?php e2("Şehir, bölge veya anahtar kelime") ?>">
							<button class="btn btn-primary"><i class="fa fa-search"></i></button>
						</div>
					</form>
				</div>
			</div>

			<!-- En iyi fırsatlar -->
			<div class="ppb_tour one withpadding " style="border-top:1px solid #e1e1e1;">
				<div class="page_content_wrapper full_width" style="text-align:center">
					<h2 class="ppb_title"><span class="renk-1"><?php set('Anasayfa Birinci Bölüm Başlık 1'); ?></span> <span class="renk-2"><?php set('Anasayfa Birinci Bölüm Başlık 2'); ?></span></h2>

					<div class="page_caption_desc" style="color: #000 !important;"><?php set('Anasayfa Birinci Bölüm Kırmızı Açıklama'); ?></div>
					<div class="portfolio_filter_wrapper three_cols fullwidth shortcode gallery section content clearfix index_wrapper">
						<?php $turlar = contents("turlar");  ?>
						<?php while($t =kd($turlar)){ 
						?>
							<!-- Tur -->
							
							<div class="element portfolio3filter_wrapper" style="min-height: 0 !important; height: auto !important;">
								<?php if(cokr($t['slug'], 'Fırsat Yazısı') != '' && !empty(cokr($t['slug'], 'Fırsat Yazısı'))){ ?>
								<div class="tarih-band"><?php cok($t['slug'],'Fırsat Yazısı'); ?></div>
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
													//cok($t['slug'],"Ülke")
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
												<?php cok($t['slug'],"Gün") ?>
											</div>
											<div class="tour_price">
												<?php $indirim = cokr($t['slug'],"İndirim"); ?>
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
							<h2 class="ppb_title w-full t-center mb-40"><?php set('Görüşler Başlık'); ?></h2>
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
											<span class="fs-0p7rem"><?php cok($g['slug'],"Ünvan") ?></span>
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
									<h3><?php set("Neden Biz Başlık 1") ?></h3>
									<div class="service_content"><?php set("Neden Biz Açıklama 1") ?>
										<br><br>
										<a href="hakkinda">Daha Fazla</a></div>
								</div>
							</div>
						</div>
						<div class="one_third ">
							<div class="service_wrapper">
								<div class="service_icon"><i class="fa fa-globe"></i></div>
								<div class="service_title">
									<h3><?php set("Neden Biz Başlık 2") ?></h3>
									<div class="service_content"><?php set("Neden Biz Açıklama 2") ?>
										<br><br>
										<a href="hakkinda">Daha Fazla</a></div>
								</div>
							</div>
						</div>
						<div class="one_third last ">
							<div class="service_wrapper">
								<div class="service_icon"><i class="fa fa-thumbs-up"></i></div>
								<div class="service_title">
									<h3><?php set("Neden Biz Başlık 3") ?></h3>
									<div class="service_content"><?php set("Neden Biz Açıklama 3") ?>
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
							<div id="15665488502014898562" class="odometer" style="font-size:44px;line-height:44px;"><?php set("Mutlu Müşteri Sayaç") ?>
							</div>
							<div class="count_separator"><span></span></div>
							<div class="counter_subject">Mutlu Müşteri</div>
						</div>
					</div>
					<div class="one_fourth">
						<div class="animate_counter_wrapper"><i class="fa fa-bus"></i><br>
							<div id="15665488501467459013" class="odometer" style="font-size:44px;line-height:44px;"><?php set("Tur Sayaç") ?>
							</div>
							<div class="count_separator"><span></span></div>
							<div class="counter_subject">Tur</div>
						</div>
					</div>
					<div class="one_fourth">
						<div class="animate_counter_wrapper"><i class="fa fa-briefcase"></i><br>
							<div id="1566548850575211780" class="odometer" style="font-size:44px;line-height:44px;"><?php set("Yolculuk Sayaç") ?>
							</div>
							<div class="count_separator"><span></span></div>
							<div class="counter_subject">Yolculuk</div>
						</div>
					</div>
					<div class="one_fourth last">
						<div class="animate_counter_wrapper"><i class="fa fa-comments-o"></i><br>
							<div id="1566548850948178997" class="odometer" style="font-size:44px;line-height:44px;"><?php set("Destek Hizmeti Sayaç") ?>
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
					<h2 class="ppb_title"><?php set('Anasayfa Haberler Başlık'); ?></h2>
					<div class="page_caption_desc"><?php set('Anasayfa Haberler Açıklama'); ?></div>
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