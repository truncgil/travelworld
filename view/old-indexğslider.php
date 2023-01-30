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
                    <img class="w-full-h-auto" src="assets/images/right-chevron.svg" alt="İleri">
					<span class="sr-only">İleti</span>
				</div>
			</a>
	
		</section>
		<!-- /Slider -->