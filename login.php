<?php include("admin.inc.php");
if(getisset("kaydol")) {
	$varmi = ksorgu("uyeler");
	if($varmi==0) {
		$s1 = post("sifre");
		$s2 = post("sifre2");
		if($s1==$s2) {
			dEkle("uyeler",array(
				"user" => kripto(post("mail")),
				"mail" => post("mail"),
				"seviye" => "Yonetici",
				"sifre" => kripto(post("sifre")),
			));
			yonlendir("login.php");
		} else {
			yonlendir("login.php?error=Şifreler Uyuşmuyor");
		}
	}
}
if(getisset("login")) {
	oturumAc();
		if(isset($_SESSION['oturumHata']) && $_SESSION['oturumHata']>10){ //eğer oturum hatası 4 ten büyük olmadığı durumlarda
			$girisYasak = 0;
			yonlendir("login.php?hata=izinYok");
		}
		if(!isset($girisYasak)) {
			$uye = kSorgu("uyeler",
				sprintf("WHERE user = %s AND sifre = %s", //kullanıcı adını ve şifrenin kriptolanmış şeklini kontrol et
					veri(kripto(trim(post("mail")))),
					veri(kripto(post("sifre")))
				)
			);
			$u = kd($uye);
			if (!isset($_SESSION['oturumHata'])) { //daha önce hata değişkeni oluşturulmamışsa
			oturum("oturumHata",0); //oluştur
			
			}
			if($uye!=0) { //eğer böyle bir üye varsa
				oturumAc(); //oturum değişkenlerini yaz
				oturum("uid", $u['id']);
				oturum("pFiMail", $u['mail']);
				oturum("pFiUser", $u['user']);
				oturum("Seviye2",$u['seviye']);
				oturum("adi", $u['adi']);
				oturum("soyadi", $u['soyadi']);
				oturum("Seviye","peyamFi");
				oturumSil("kayitTamam");				
				$sonuc = 1;
				yonlendir("admin.php");
			} else { //eğer böyle bir üye yoksa
				$sonuc = 0;
				$hata=oturum("oturumHata"); //son oturum hata değerini al
				$hata++; // hata değerini bir arttır
				oturum("oturumHata",$hata); //hata değerini yaz
				yonlendir("login.php?hata=$hata");
				if (isset($_GET['y'])){
					//$url = $_GET['y'] . "&sonuc=0";
					
				} else {
					//$url = $_SERVER['REQUEST_URI'] . "&sonuc=0";
					//yonlendir("pfi-uye-formu.php?giris");
					
				}
				
			}
			}
}

?>
<?php p_ust("Giriş Yap") ?>
<style type="text/css">
body {
	    background: #008DD2;
}
</style>	
<?php 
$varmi = ksorgu("uyeler");
if($varmi!=0) { ?>
<form action="?login" method="post">
<div class="registrationWrapper clearfix">
		<div class="registrationContent">
			<div class="registrationHeader">
				<img src="aa/pelinom2.png" style="    margin: 0 auto;
    display: block;" alt="" />
				<p style="    margin: 0;
    padding: 0;
    font-size: 20px;">Giriş Yap</p>
			</div>
			<!--registrationHeader-->
			<br>
			<div class="row inputWrapper ">
				<div class="col-md-12 ">
					<div class="left-inner-addon ">
						<i class="fa fa-user"></i>
						<input type="text" name="mail" class="form-control" placeholder="Kullanıcı Adı">
					</div>
				</div>
				<br>
				<br>
				<br>
				<div class="col-md-12">
					<div class="left-inner-addon ">
						<i class="fa fa-key"></i>
						<input type="password" name="sifre" class="form-control" placeholder="Şifre">
					</div>
				</div>
			</div>
			<div class="registrationButtonPlaseholder">
				<button type="submit" class="btn btn-info btn-df float-button-light">GİRİŞ YAP</button>
				<a type="submit" href="index" class="btn btn-primary btn-df float-button-light">SİTEYE DÖN</a>
			</div>
			
		</div>
		<!--registrationContent-->
	</div>
	<!--registrationWrapper-->
</form>
<?php } else { ?>
<form action="?kaydol" method="post">
	<div class="registrationWrapper clearfix">
		<div class="registrationContent">
			<div class="registrationHeader">
				<img src="aa/pelinom2.png" style="    margin: 0 auto;
    display: block;" alt="" />
				<p style="    margin: 0;
    padding: 0;
    font-size: 20px;">Yeni Kayıt</p>
			</div>
			
			<!--registrationHeader-->
			<br>
			<div class="row">
			<?php if(getisset("error")) alert(get("error")); ?>
			<div class="clearfix"></div>
			</div>
			<div class="row inputWrapper ">
				<div class="col-md-12 ">
					<div class="left-inner-addon ">
						<i class="fa fa-user"></i>
						<input type="text" name="mail" class="form-control" placeholder="Kullanıcı Adı">
					</div>
				</div>
				<div class="col-md-12">
					<div class="left-inner-addon ">
						<i class="fa fa-key"></i>
						<input type="password" name="sifre" class="form-control" placeholder="Şifre">
					</div>
				</div>
				<div class="col-md-12">
					<div class="left-inner-addon ">
						<i class="fa fa-key"></i>
						<input type="password" name="sifre2" class="form-control" placeholder="Şifre (Tekrar)">
					</div>
				</div>
			</div>
			<div class="registrationButtonPlaseholder">
				<button type="submit" class="btn btn-info btn-df float-button-light">KAYDOL</button>
				<a type="submit" href="index" class="btn btn-primary btn-df float-button-light">SİTEYE DÖN</a>
			</div>
			
		</div>
		<!--registrationContent-->
	</div>
	<!--registrationWrapper-->
</form>
<?php } ?>
	<script type="text/javascript" src="aa/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="aa/lib/waves/waves.min.js"></script>
	<script src="aa/js/bootstrap.min.js"></script>
	<script>
		Waves.attach('.float-button-light', ['waves-button', 'waves-float', 'waves-light']);
		Waves.init();
	</script>	
<?php p_alt(); ?>
