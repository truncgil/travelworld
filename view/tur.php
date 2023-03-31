
		
		<?php
		$custom_bg = '';
		$page_content_wrapper_margin = 'style="margin-top: -400px !important;"';
		if($c['slug'] == 'ucak-bileti' || $c['slug'] == 'otel'){
			$custom_bg = 'style="background-image: url(file/'.$c['pic'].'); background-size: cover; background-repeat: no-repeat;"';
			$page_content_wrapper_margin = 'style="margin-top: 0px !important;"';
		}
		?>
		<!-- Begin content -->
		<div id="page_content_wrapper" <?php echo $page_content_wrapper_margin; ?>>
            <div class="page_title_wrapper w-100 t-center">
				
			<div class="inner">
				<h1><?php e2($c['title']) ?></h1>
				<!-- Begin main content -->
				<div class="inner_wrapper">
				<div class="card mx-auto" 
				<?php if(isMobile())  { 
				  ?>
 				style="margin-top:365px;" 
				 <?php } else {
					 ?>
					 style="margin-top:550px;" 
					 <?php 
				 } ?>
				>
						<div class="">
							<?php if($c['fiyat']!="") {
								 ?>
								 <style>
									.to-top-btn {
    padding: 10px 23px 10px 10px !important;
    bottom: 129px !important;
    right: 10px !important;
}
@media screen and (max-width:768px) {
	.payment-btn {
		width:200px
	}
}
								 </style>
								<a href="payment?t=<?php e($c['slug']) ?>" style="        position: fixed;
    right: 20px;
    bottom: 10px;
    z-index: 1000;
    width: 91px;
	" class="payment-btn">
									<img src="<?php ci("rezervasyon-butonu",91) ?>" width="91" alt="">
								</a>

								 <?php 
							} ?>
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
                           <?php e2($c['html']) ?>
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