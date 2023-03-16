
		
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
						<div class="card-body text-center">
							<?php if($c['fiyat']!="") {
								 ?>
								<a href="payment?t=<?php e($c['slug']) ?>" class="">
									<img src="data:image/jpeg;base64,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" alt="">
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