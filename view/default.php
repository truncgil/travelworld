
<?php if($c['type'] == 'Tur Kategorisi'){ ?>
<div id="page_caption" class="hasbg parallax" data-image="assets/images/1600x1200-12.jpg" data-width="1600"
	data-height="1200">
	<div class="page_title_wrapper">
		<h1><?php e($c['title']); ?></h1>
		<div id="crumbs">
			<a href="./">Anasayfa</a> /
			<span class="current"><?php e($c['title']); ?></span>

		</div>
	</div>
	<div class="parallax_overlay_header"></div>
</div>

<!-- Begin content -->
<div id="page_content_wrapper" class="hasbg fullwidth">

	<div class="page_title_wrapper pt-50 w-100 t-center">
		<div id="crumbs" class="tr-crumbs">
			<a href="./">Anasayfa</a> /
			<span class="current"><?php e($c['title']); ?></span>
		</div>
		<!-- Begin content -->
		<div class="inner container">

			<div class="inner_wrapper row ">

				<div id="page_main_content" class="sidebar_content full_width">

                    <!-- 
					<div class="page_content_wrapper">
						<form id="tour_search_form" name="tour_search_form" method="get"
							action="#">
							<div class="tour_search_wrapper">
								<div class="one_fourth">
									<label for="keyword">Gidiş Yeri</label>
									<input id="keyword" name="keyword" type="text"
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


					
					<?php $turlar = ksorgu('content',"WHERE type='tur' AND y=1 ORDER BY title"); while($tur = kd($turlar)){ ?>
						<div class="element portfolio3filter_wrapper">

							<div class="one_third gallery3 filterable gallery_type animated2" data-id="post-2">

								<a href="<?php e($slug); ?>">
									<img src="<?php r($tur['pic'],564); ?>" alt="<?php e($tur['title']); ?>">
								</a>


								<div class="thumb_content classic">
									<div class="thumb_title">
										<div class="tour_country">
											Turkey </div>
										<a href="#">
											<h3>Grand Turkey</h3>
										</a>
									</div>
									<div class="thumb_meta">
										<div class="tour_days">
											8 Days </div>
										<div class="tour_price">
											2000 TL </div>
									</div>
									<br class="clear">
									<div class="tour_excerpt"><i class="fa fa-map-marker"></i>&nbsp;4-5 Stars Hotel
										for all trips<br>
										<i class="fa fa-map-marker"></i>&nbsp;Chill out on historical town and
										city<br>
										<i class="fa fa-map-marker"></i>&nbsp;Sail the biggest lake of Turkey<br>
										<i class="fa fa-map-marker"></i>&nbsp;100% Satisfaction guarantee</div>
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
<?php } 


else{ ?>
		<?php 
		if($c['slug'] != 'ucak-bileti' && $c['slug'] != 'otel'){
		?>
		<div id="page_caption" class="hasbg parallax"
			data-image="<?php r($c['pic'],1920) ?>"
			data-width="1600" data-height="1200">
			<div class="page_title_wrapper">
				<h1><?php e($c['title']) ?></h1>
			</div>
			<div class="parallax_overlay_header"></div>
		</div>
		<?php } ?>
		<?php
		$custom_bg = '';
		$page_content_wrapper_margin = '';
		if($c['slug'] == 'ucak-bileti' || $c['slug'] == 'otel'){
			$custom_bg = 'style="background-image: url(file/'.$c['pic'].'); background-size: cover; background-repeat: no-repeat;"';
			$page_content_wrapper_margin = 'style="margin-top: 100px !important;"';
		}
		?>
		<!-- Begin content -->
		<div id="page_content_wrapper" class="hasbg" <?php echo $page_content_wrapper_margin; ?>>
            <div class="page_title_wrapper w-100 t-center">
				
			<div class="inner">
				<!-- Begin main content -->
				<div class="inner_wrapper">
					<div class="sidebar_content full_width">
						<?php
						if($c['slug'] != 'ucak-bileti' && $c['slug'] != 'otel'){
						?>
						
						<div style="text-align:center">
							<?php 
								$str = $c['title'];
								$len = mb_strlen($str, 'UTF-8');
								$result = [];
								for ($i = 0; $i < $len; $i++) {
									$result[] = mb_substr($str, $i, 1, 'UTF-8');
								}
								$a = $result;
								$a_first = floor(count($a) / 2);
								$a_second = count($a) - $a_first;
								$fstr = implode(array_slice($result, 0, $a_first));
								$sstr = implode(array_slice($result, $a_first, $a_second));

								
								
							?>
							<h2 class="ppb_title d-none"><span class="renk-1"><?php e($fstr); ?></span> <span class="renk-2"><?php e($sstr); ?></span></h2>
							
						</div>
						<?php } ?>
						<div class="icerik">
                           <?php e($c['html']) ?>
                        </div>
					</div>
				</div>
				<!-- End main content -->
			</div>
		</div>
		<br class="clear"><br><br>


	</div>
<?php } ?>