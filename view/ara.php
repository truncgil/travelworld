  <?php 
  $q = veri("%{$_GET['q']}%");
  $ara = ksorgu("content","where y=1 AND type='Tur' AND (title LIKE $q)"); ?>
    <div id="page_caption" class="hasbg parallax"
			data-image="assets/images/1600x1200-12.jpg"
			data-width="1600" data-height="1200">
			<div class="page_title_wrapper">
				<h1><?php e(get("q")) ?> Arama Sonuçları</h1>
				<div id="crumbs"><a href="./">Anasayfa</a> / <span class="current"><?php e(get("q")) ?> </span>
				</div>
			</div>
			<div class="parallax_overlay_header"></div>
		</div>

		<!-- Begin content -->
		<div id="page_content_wrapper" class="hasbg fullwidth">

            <div class="page_title_wrapper pt-50 w-100 t-center">
				<div id="crumbs" class="tr-crumbs">
                    <a href="./">Anasayfa</a> / 
                    <span class="current"><?php e(get("q")) ?> </span>
			</div>
			<div class="one pp_tour_search">
				<div class="page_content_wrapper">
					<form id="tour_search_form" name="tour_search_form" method="get"
						action="ara">
						<div class="tour_search_wrapper">
							<div class="one_fourth">
								<label for="keyword">Gidiş Yeri</label>
								<input id="keyword" name="q" value="<?php echo get("q"); ?>" type="text" placeholder="Şehir, bölge veya anahtar kelime">
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
			</div>
			<div class="clearfix"></div>
			<!-- Begin content -->
				<div class="inner container">

			<div class="inner_wrapper row custom-row">

					<div id="page_main_content" class="sidebar_content full_width">

                        <!--
						<div class="page_content_wrapper">
							<form id="tour_search_form" name="tour_search_form" method="get"
								action="ara">
								<div class="tour_search_wrapper">
                                    <div class="one_fourth">
                                        <label for="keyword">Gidiş Yeri</label>
                                        <input id="keyword" name="q" type="text" placeholder="Şehir, bölge veya anahtar kelime">
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