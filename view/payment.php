
<div id="page_content_wrapper" class="fullwidth " style="margin-top:100px">
    <div class="container mb-5 mt-5">
		
			
				<h1>Rezervasyon yapacağınız kişiler ve iletişim bilgileriniz.</h1>
				<div class="row">
					<div class="col-md-4">
						<div style="height:440px">
							<div id="portfolio_filter_wrapper" style="width:300px;margin:0 auto;height:440px !important;" class=" gallery section content clearfix">
								<?php $t = c(get("t"));
								?>
								<?php tur_item($t);  ?>
							</div>
						</div>
						<?php if(getisset("step")) {
							$toplam = 0;
							 
							 
							 ?>
							 <table class="table">
<?php 
if(postesit("yetiskin",1)) {
	$yetiskinFiyat = $t['fiyat_tek'];
} else {
	$yetiskinFiyat = $t['fiyat'];

}
$ara_toplam = $yetiskinFiyat * post("yetiskin");
$toplam += $ara_toplam;
?>
									<tr>
										<td><?php echo post("yetiskin") ?> x <?php e2("Yetişkin") ?> (<?php e(para($yetiskinFiyat)) ?>) </td>
										<td><?php e(para($ara_toplam)) ?></td>
									</tr> 
									<?php if(!postesit("cocuk",0))  { 
										$ara_toplam = $t['fiyat2'] * post("cocuk");
										$toplam += $ara_toplam;
									  ?>
 									<tr>
 										<td><?php echo post("cocuk") ?> x <?php e2(yasConverter("cocuk")) ?> (<?php e(para($t['fiyat2'])) ?>)</td>
 										<td><?php e(para($ara_toplam)) ?></td>
 									</tr>  
									 <?php } ?>
									 <?php if(!postesit("bebek",0))  { 
										$ara_toplam = $t['fiyat3'] * post("bebek");
										$toplam += $ara_toplam;
									   ?>
 									<tr>
 										<td><?php echo post("bebek") ?> x <?php e2(yasConverter("bebek")) ?> (<?php e(para($t['fiyat3'])) ?>)</td>
 										<td><?php e(para($ara_toplam)) ?></td>
 									</tr>  
									  <?php } ?>
									<tr>
										<td><?php e2("Toplam") ?></td>
										<td><?php e(para($toplam)) ?></td>
									</tr>
									
							 </table>
								<?php if(getesit("step","2"))  { 
								  ?>		
 							<div class="btn btn-success btn-block odeme-yap" style="position: relative;
    z-index: 1000000000;" onclick="$('.send').trigger('click');"><?php e2("Ödeme Yap") ?></div> 
								 <?php } ?>
										
							 <?php 
						} ?>
					</div>
					<div class="col-md-8">
					<?php if(getisset("step")) {
							include("payment/step". get("step") . ".php");
						} else  { 
						?>
						<form action="?t=<?php e(get("t")) ?>&step=2" method="post">
							<div class="row">
								<div class="col-md-4">
									<p><?php e2("Yetişkin Sayısı") ?></p>
									<input type="number" name="yetiskin" required value="2" min="1" id="" class="form-control">
								</div>
								<div class="col-md-4">
									<p><?php e2(yasConverter("cocuk")) ?> <?php e2("Sayısı") ?></p>
									<input type="number" name="cocuk" value="0" min="0" id="" class="form-control">
								</div>
								<div class="col-md-4">
									<p><?php e2(yasConverter("bebek")) ?> <?php e2("Sayısı") ?></p>
									<input type="number" name="bebek" value="0" min="0" id="" class="form-control">
								</div>
								<div class="col-md-6">
									<?php e2("Telefon Numaranız") ?>
									<input type="number" name="telefon" required class="form-control" required id="">
								</div>
								<div class="col-md-6">
									<?php e2("E-Posta Adresiniz") ?>
									<input type="text" name="email" required class="form-control" required id="">
								</div>
								<div class="col-md-12">
									<?php e2("Adresiniz") ?>
									<textarea name="adres" id="" required cols="30" rows="10" class="form-control"></textarea>
								</div>
								<div class="col-12">
									<button class="btn btn-primary mt-5"><?php e2("İlerle") ?></button>
								</div>
							</div>
						</form> 
						<?php } ?>
					</div>
				</div>	
				
				
			
		 
    </div>
</div>