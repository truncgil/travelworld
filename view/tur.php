<div id="page_caption" class="hasbg parallax"
			data-image="<?php r($c['pic'],1920) ?>"
			data-width="1600" data-height="1200">
			<div class="page_title_wrapper">
				<h1><?php e($c['title']) ?></h1>
			</div>
			<div class="parallax_overlay_header"></div>
		</div>
		
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
				<div class="card mx-auto" 
				<?php if(isMobile())  { 
				  ?>
 				style="margin-top:50px;" 
				 <?php } else {
					 ?>
					 style="margin-top:550px;" 
					 <?php 
				 } ?>
				>
						<div class="card-body">
							<?php if(getisset("payment")) {
								include("paytr.php");
							} else  { 
							  ?>
 							<form action="?payment" method="post">
 									<h2>Online Rezervasyon</h2>
 									Doğum Tarihi
 									<input type="date" name="dog_tar" class="form-control" required id="">
 									İsim
 									<input type="text" name="adi" class="form-control" required id="">
 									Soyadı
 									<input type="text" name="soyadi" class="form-control" required id="">
 									TC Kimlik No:
 									<input type="number" minlength="11" maxlength="11" name="tckimlik" class="form-control" required id="">
 									Telefon
 									<input type="number" name="telefon" class="form-control" required id="">
 									
 									<button class="btn btn-primary mt-5">Ödeme Adımına Geç</button>
 
 							</form> 
							 <?php } ?>
						</div>
					</div>
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

	<script>
		$(function(){
			$(".icerik table").wrap('<div class="table-responsive"></div>');
			
		});
		
	</script>