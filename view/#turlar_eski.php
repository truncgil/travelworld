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

	<div class="page_title_wrapper pt-50 w-100 t-center">
		<div id="crumbs" class="tr-crumbs">
			<a href="./">Anasayfa</a> /
			<span class="current">Turlar</span>
		</div>
		<!-- Begin content -->
		<div class="inner">

			<div class="inner_wrapper">

				<div id="page_main_content" class="sidebar_content full_width">


					
					
					<div class="container-fluid" style="padding-right: 0;">
						<div class="row" style="width: 100%;">
						
						<?php $turlar = contents("turlar"); $i = 1; while($t = kd($turlar)) {  ?>
							<div class="col-12 col-xs-12 col-sm-6 col-md-4 <?php if($i % 3 == 0) echo 'pr-md-0'; ?> turs mt-20" style="padding-left: 0;">
								<a href="#" class="w-100-h-auto">
									<div class="w-100 h-10rem bg-cover" style="background-image: url(<?php r($t['pic'],512) ?>);">
										<img class="dis-none" src="<?php r($t['pic'],512) ?>" alt="<?php e($t['title']) ?>">
									</div>
								</a>
								<div class="content">
									<div class="row" style="width: 100%;">
										<div class="col-8 col-xs-8">
											<div class="country"><?php e($t['title']) ?></div>
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

					<div id="portfolio_filter_wrapper" class="three_cols gallery section content clearfix">


					
					<?php $turlar = contents("turlar"); while($t = kd($turlar)) {  ?>
						<div class="element portfolio3filter_wrapper">

							<div class="one_third gallery3 filterable gallery_type animated2" data-id="post-2">

								<a href="#" class="w-100-h-auto">
									<div class="w-100 h-10rem bg-cover" style="background-image: url(<?php r($t['pic'],512) ?>);">
										<img class="dis-none" src="<?php r($t['pic'],512) ?>" alt="<?php e($t['title']) ?>">
									</div>
									
								</a>


								<div class="thumb_content classic tur-content">
									<div class="thumb_title">
										<div class="tour_country">
											<?php e($t['title']) ?> </div>
										<a href="#">
											<h3><?php cok($t['slug'],"Ülke") ?></h3>
										</a>
									</div>
									<div class="thumb_meta">
										<div class="tour_days">
											<?php cok($t['slug'],"Gün") ?></div>
										<div class="tour_price">
											<?php cok($t['slug'],"Fiyat") ?> </div>
									</div>
									<br class="clear">
									<div class="tur-excert">
										<?php 
										$satir = explode(",",strip_tags(cokr($t['slug'],"Açıklama")));
										foreach($satir AS $s) {
											if(trim($s)!="") {		
											?>
												<i class="fa fa-map-marker"></i><?php e(trim($s)) ?><br>
											<?php } ?>
										<?php } ?>
									</div>
								</div>
							</div>

						</div>

					<?php } ?>
						


						


						



						


						


						

					</div>


				</div>
			</div>
		</div>
	</div>
	<br class="clear"><br>


</div>
