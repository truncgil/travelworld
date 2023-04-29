<?php 
//tüm other değişkenlerini cache almaya yarar tek seferde sorguyu çok boyutlu diziye alıp işi bitiriyoruz
$other = ksorgu("other","ORDER BY id DESC");
$other_array = array();
while($o = kd($other)) {
	$other_array[$o['cid']][$o['alan']] = $o['deger'];
}
//sil("content","slug IS NULL AND type <>'SEPET'");

oturumAc();

if(getisset("dil")) {
	if(!getesit("dil","tr")) {
	$dil = veri(get("dil"));
	$varmi = ksorgu("diller","WHERE kisa = $dil");
	if($varmi!=0) {
		oturum("dil",get("dil"));
	} 
	} else {
		oturum("dil","tr");
	}
	
}
if(!oturumisset("dil")) {
	oturum("dil","tr");
}

function yasConverter($type) {
	$type2 = "Yetişkin";
	if($type=="cocuk") $type2 = "6-11 Yaş Çocuk";
	if($type=="bebek") $type2 = "2-5 Yaş Çocuk";
	return $type2;
}
function tur_item($t) {
	$indirim = cokr($t['slug'], 'İndirim');
	?>
	<div class="element portfolio3filter_wrapper">

							<div class="one_third gallery3 filterable gallery_type animated2" data-id="post-<?php e($t['id']) ?>">

								<a href="<?php e($t['slug']) ?>" style="display:block;overflow:hidden; background-image: url(<?php r($t['pic'],512) ?>); background-repeat: no-repeat; background-size: cover;" class="square-box">
									<img class="dis-none" src="<?php r($t['pic'],512) ?>" alt="<?php e($t['title']) ?>">
								</a>
<?php 
$firsat = cokr($t['slug'],"Fırsat Yazısı"); 
if($indirim!="" || $indirim!=0) { ?>
								<div class="tour_sale">
									<div class="tour_sale_text">İNDİRİM</div>
									%<?php e($indirim) ?>
									
								</div>
<?php } 
if($firsat!="") {
 ?>
							<div class="tour_sale">
									<div class="tour_sale_text"><?php e($firsat) ?></div>
									
									
								</div>
<?php } ?>
								<div class="thumb_content classic" style="overflow:hidden; height:auto;">
									<div class="thumb_title">
										<div class="tour_country">
											<?php cok($t['slug'],"Ülke") ?> </div>
										<a href="<?php e($t['slug']); ?>">
											<h3><?php e($t['title']) ?></h3>
										</a>
									</div>
									<div class="thumb_meta">
										<div class="tour_days">
											<?php cok($t['slug'],"Gün") ?></div>
										<div class="tour_price">
										<?php $fiyat = cokr($t['slug'],"Fiyat") ?>
										
										<?php if($indirim!="" || $indirim!=0) { ?>
											
											<del class="color-red" style="font-size: .8rem;"><?php e(round($fiyat+$fiyat*($indirim/100),2)) ?> TL</del>
										<?php } ?>
										<?php e($fiyat) ?>
											 </div>
											
									</div>
									<br class="clear">
									<div class="tour_excerpt"><?php $satir = explode(",",strip_tags(cokr($t['slug'],"Açıklama")));
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
	<?php
}
function blogcaro($c) {
	?>
<?php $kr = "'%{$c['title']}%'";
		$blog = ksorgu("feeds","WHERE title LIKE $kr OR description LIKE $kr OR encoded LIKE $kr ORDER BY rand() LIMIT 0,10");
		if($blog==0) {
			$kr = explode(" ",$c['title']);
			$kr = "'%{$kr[0]}%'";
			$blog = ksorgu("feeds","WHERE title LIKE $kr OR description LIKE $kr OR encoded LIKE $kr ORDER BY rand() LIMIT 0,10");
		}
	if($blog!=0) {
		?>
	<h2 style="font-size:20px;"><a target="_blank" href="<?php set("Blog Link") ?>"><?php set("Blog Başlık") ?>
		<img src="<?php set("Blog Resim") ?>" style="    float: right;
    width: 67px;" alt="" /></a>
		<div class="clearfix"></div>
	</h2>
	<div class="caro3 kategori-list">
		<?php 
		
		while($b = kd($blog)) {
			?>
			<a href="<?php e($b['link']) ?>" target="_blank">
			<div class="kutu" style="background:url('<?php e($b['img']) ?>');    background-size: cover !important;">
				<span><?php e($b['title']) ?></span>
			</div>	
			
			</a>
			<?php
		}
		?>
	</div>
<?php } ?>
	<?php
}
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
require("aa/lib/mail/include/class.php");
function mailGonder($mail,$konu,$mesaj){
$header = set("Mail Üst Bilgi",1);
$footer = set("Mail Alt Bilgi",1);
$mail_adresiniz	= set("Core Mail",1);
$mail_sifreniz	= set("Şifre",1);
$gidecek_adres	= $mail;

///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////

$mail = new PHPMail();
$mail->Host       = set("SMTP",1);
$mail->SMTPAuth   = true;
$mail->Username   = $mail_adresiniz;
$mail->Password   = $mail_sifreniz;
$mail->IsSMTP();
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;         
$mail->IsHTML(true);
$mail->AddAddress($gidecek_adres);
$mail->From       = $mail_adresiniz;
$mail->FromName   = "Turia";
$mail->Subject    = $konu;
$mail->Body       = $header . $mesaj . $footer;
$mail->AltBody    = "";
	if(!$mail->Send()) {
	
	echo	 $mail->ErrorInfo;
	} else {
		return 1;
	}
}
 ?>
 <?php function siparis_item($s) { ?>
 	<div class="satir">
						
						<div class="col-md-12">
							
							<hr />
							<div class="col-md-9">
							
							<?php $c = c($s['bag']);
							
							$j = json_decode($s['json'],true);
							//print_R($j);
							?>
							<strong ><a style="font-size:16px !important;" href="<?php url($c) ?>"><img src="<?php r($c['pic'],200); ?>" style="
							padding:10px;width:200px;float:left;    margin: 0px 10px 10px 10px; border:dashed 1px #c9c9c9" alt="" />
							<?php
								e($c['title']);
								?>
							</a></strong>
							<div class="col-md-7">
							<div><?php e2("Ödeme Şekli :") ?> <?php if($j['odeme']=="kk") e2("Kredi Kartı"); else e2("Havale"); ?></a></strong></div>
							<div><?php e2("Sipariş Kodu :") ?> <strong><a href="profil?siparis_detay=<?php e($s['style']); ?>"><?php ed($s['id'],"") ?></a></strong></div>
							<div><?php e2("Sipariş Durumu :") ?> <strong><?php ed($s['alt'],"Beklemede") ?></strong></div>
							<div><?php e2("Adres :") ?> <strong><?php ed($j['adres'],""); ?></strong></div>
							<div><?php e2("İlçe / İl :") ?> <strong><?php e("{$j['ilce']} / {$j['il']}"); ?></strong></div>
							<div><?php e2("Telefon :") ?> <strong><?php ed("{$j['telefon']}","Girilmemiş"); ?></strong></div>
							</div>
							</div>
							<div class="col-md-3">
								<a href="#" class="btn btn-inter" style="    font-size: 20px !important;
    background: #4ca907 !important;"><?php e(para($s['fiyat'])) ?></a>
								<a href="profil?siparis_detay=<?php e($s['style']); ?>" class="btn btn-inter"><i class="fa fa-info-circle"></i> <?php e2("Sipariş Detayı") ?></a>
								<!--<a href="#" class="btn btn-inter"><i class="fa fa-undo"></i> <?php e2("Kolay İade") ?></a>-->
								<a href="#" class="btn btn-inter"><i class="fa fa-comment"></i> <?php e2("Müşteri Hizmetleri") ?></a>
								<a href="?siparis_iptal=<?php e($s['id']); ?>" class="btn btn-inter" onclick="return confirm('Siparişi iptal etmek istediğinizden emin misiniz?',this)"><i class="fa fa-times"></i> <?php e2("Sipariş İptali") ?></a>
							</div>
							<div class="col-md-12" style="margin-bottom:10px;">
							<div class="clearfix"></div>
							
							<a href="#" class="btn"><i class="fa fa-truck"></i> <?php e2("Kargo Takip: ") ?><?php ed($s['yer'],"Henüz bilgi yok") ?></a>
							<a href="#" class="btn" title="<?php e2("Sipariş veriliş tarihi") ?>"><i class="fa fa-calendar"></i> <?php e2(tt($s['date'])) ?></a>
							<a href="SOZLESME" modal class="btn" ><i class="fa fa-print"></i> <?php e2("Satış Sözleşmesi") ?></a>
							<?php if($j['odeme']=="kk") { ?>
							<?php if($s['alt']=="") { ?>
							<a href="sanal_pos?basket=<?php e($s['style']) ?>" class="btn" ><i class="fa fa-print"></i> <?php e2("Ödeme Yap") ?></a><?php } ?><?php } ?>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
 <?php } ?>
 <?php function product_resim($slug) {
	 $resim = kd(ksorgu("content","WHERE slug='$slug'"));
	 if($resim['pic2']!="") {
		$resim = explode(",",$resim['pic2']);
		return $resim;
	 } else {
		 return 0;
	 }
 } ?>
 <?php function pagination($s,$ss) {
	 global $_GET;
	 if(!getisset("s")){
		 $_GET['s']=1;
	 }
	 ?>
	<div class="category-page-wrapper">
        <div class="result-inner"><?php e("$ss Sayfadan {$_GET['s']}. Sayfa") ?></div>
        <div class="pagination-inner">
          <ul class="pagination">
		  <?php 
		  if($s<10) {
			  $bas = 1;
			  $son = 10;
		  } else {
			  $bas = $s-7;
			  $son = $s+5;
		  }
		  if($son>$ss) {
			  $son =$ss;
		  }
		  $diger="";
		  if(getisset("fiyat")) {
			  $diger .="&fiyat={$_GET['fiyat']}";
		  }
		  for($k=$bas;$k<=$son;$k++) { ?>
		  <li <?php if($k==$s-1) { ?>class="active"<?php } ?>> <a href="?s=<?php e($k); ?><?php echo $diger ?>"><span><?php e($k) ?></span></a></li>
		  <?php } ?>
          </ul>
        </div>
      </div>
	 <?php
	 
 } ?>
 <?php function score_match($kriter) {
	 $deger = kd(sorgu("SELECT MAX(view) as mak, MIN(view) as min FROM content $kriter"));
	 $fark = $deger['mak'] -$deger['min'];
	 
	 return $fark; 
	 
 } ?>
 <?php function score_level($fark,$c) {
	 return 5*$c['view']/$fark;
 } ?>
 <?php function onceki($s=1,$class="col-md-4") {
	 global $_GET;
	 $diger="";
	  if(getisset("fiyat")) {
		  $diger .="&fiyat={$_GET['fiyat']}";
	  }
	  if(getisset("fiyat_sirala")) {
		   $diger .="&fiyat_sirala={$_GET['fiyat_sirala']}";
	  }
	  if(getisset("ad_sirala")) {
		   $diger .="&ad_sirala={$_GET['ad_sirala']}";
	  }
	  if(getisset("like")) {
		   $diger .="&like={$_GET['like']}";
	  }
	 ?>
 <div class="<?php e($class); ?>">
 <div class="item">
 <div class="product-thumb">
 <a href="?s=<?php e($s); ?><?php echo $diger ?>" style="height:266px;" >
		<span style="font-size: 60px;
    padding: 12.6% 10px;
    display: block;
    text-align: center;
    /* border: dashed 5px #c9c9c9; */
    line-height: initial;
    font-weight: bold;
    color: #a5a5a5;"><?php e2("Önceki Sayfa") ?></span>	
</a>
</div>		
</div>
</div>
	 <?php
 } ?>
 <?php function sonraki($s=1,$class="col-md-4") {
	 global $_GET;
	 $diger="";
	  if(getisset("fiyat")) {
		  $diger .="&fiyat={$_GET['fiyat']}";
	  }
	  if(getisset("fiyat_sirala")) {
		   $diger .="&fiyat_sirala={$_GET['fiyat_sirala']}";
	  }
	  if(getisset("ad_sirala")) {
		   $diger .="&ad_sirala={$_GET['ad_sirala']}";
	  }
	  if(getisset("like")) {
		   $diger .="&like={$_GET['like']}";
	  }
	 ?>
 <div class="<?php e($class); ?>">
 <div class="item">
 <div class="product-thumb">
 <a href="?s=<?php e($s); ?><?php echo $diger ?>" style="height:266px;" >
		<span style="font-size: 60px;
    padding: 12.6% 10px;
    display: block;
    text-align: center;
    /* border: dashed 5px #c9c9c9; */
    line-height: initial;
    font-weight: bold;
    color: #a5a5a5;"><?php e2("Sonraki Sayfa") ?></span>	
</a>
</div>		
</div>
</div>
	 <?php
 } ?>
 <?php function likeUpdate() {
	 $like = sorgu("select count(*) as toplam, bag from content WHERE type='LIKE' group by bag");
	 while($l = kd($like)) {
		 dGuncelle("content",array(
			"score" => $l['toplam']
		 ),"slug='{$l['bag']}'");
	 }
 } ?>
 <?php function product_item($l,$class="col-md-4",$alt="ok") { global $uid; ?>
 <div class="<?php e($class); ?>">
 <div class="item">
								<div class="product-thumb">
<?php $toplam= toplam("content","type='LIKE' AND bag='{$l['slug']}'") ?>
<?php $begendimmi = ksorgu("content","where type='LIKE' AND bag ='{$l['slug']}' AND uid = '$uid'");
if($begendimmi==0) {$begen=0;} else {$begen=1;}
 ?>
									<?php if($alt=="ok") { ?><like begen="<?php e($begen); ?>" slug="<?php e($l['slug']) ?>"><i class="fa fa-heart<?php if($begen==0) e("-o"); ?>"></i> <?php if($toplam!=0) { ?><span><?php e($toplam); ?></span><?php } ?></like><?php } ?>
									<?php if($alt=="ok") { ?><?php if($l['comment']!="") { ?><comment style="top: 50px;
    color: black;"><i class="fa fa-comments"></i> <span style="font-size: 12px;
    left: -8px;
    text-align: center;
    width: 123%;"><?php e($l['comment']); ?></span></comment><?php } ?><?php } ?>
									<a href="<?php url($l) ?>" itemscope itemtype="http://schema.org/Product" <?php //if($alt=="") e("style='height:180px'") ?>>
										<div class="image product-imageblock" style="background:url('<?php r($l['pic'],400); ?>') center no-repeat;height:187px" alt="<?php e($l['title']) ?>" title="<?php e($l['title']) ?>">
											
											<!--<div class="button-group">
												<button type="button" class="wishlist" data-toggle="tooltip" title="Favorilere Ekle" ><i class="fa fa-heart-o"></i></button>
												<button type="button" class="addtocart-btn" >Sepete ekle</button>
												<button type="button" class="compare" data-toggle="tooltip" title="Bu ürünü karşılaştır" ><i class="fa fa-exchange"></i></button>
												</div>-->
										</div>
										<?php if($alt!="") { ?>
										<div class="resimler">
										<?php 
											$resimler = product_resim($l['slug']);
											if($resimler!=0) {
											?>
										<div class="caro2" style="margin:0px;background:rgba(255,255,255,1);padding:5px;box-shadow:0px 0px 10px #fff;">
														<div data-img="<?php r($l['pic'],400); ?>" style="background:url('<?php r($l['pic'],72); ?>') no-repeat center;width:66px;height:48px;float:left;background-size:cover"></div>
											<?php 
												
													foreach($resimler AS $r) {
														?>
														<div data-img="<?php r($r,400); ?>" style="background:url('<?php r($r,72) ?>') no-repeat center;width:66px;height:48px;float:left;background-size:cover"></div>
														<?php
														
													}
												?>
										</div>
										<?php } ?>
										</div>
										<?php } ?>
										<div class="caption product-detail">
										
											<div class="rating" id="rate" onload="" data-score="<?php e($l['score']) ?>"></div>
											<h4 class="product-name"><a href="<?php url($l) ?>" title="<?php e($l['title']) ?>"><?php e($l['title']) ?></a></h4>
											<p class="price product-price"><?php e(para($l['fiyat'])) ?></p>
										</div>
										
									</a>
								</div>
							</div>
							</div>
 <?php } ?>
 <?php function avatar($u) {
	 ?>
	<div class="col-sm-4 col-md-3 col-lg-2">
		<div class="profile_avatar">
			<img src="<?php r($u['resim'],128) ?>" alt="avatar" class=" img-responsive">
			<a href="profile.html?id=<?php e($u['id']) ?>"><?php e($u['adi']) ?></a>
		</div>
	</div>

	 <?php
 } ?>
 <?php function n($mail,$konu,$mesaj) {
	 return mailGonder($mail,$konu,$mesaj);
 } ?>
 <?php function view($file) {
	 global $c;
	 global $uid;
	if(file_exists("view/$file.php")) {
		
		include("view/$file.php");
	 } else {
		 include("view/default.php");
	 }
 } ?>
<?php function uye($user,$pass) {
	$user = veri($user);
	$pass = veri(kripto($pass));
	$u = ksorgu("uyeler","WHERE mail = $user AND sifre = $pass");
	if($u==0) {
		return 0;
	} else {
		return kd($u);
	}
} ?>
<?php function u($id) {
	$id = veri($id);
	$u = ksorgu("uyeler","WHERE id = $id");
	if($u==0) {
		return 0;
	} else {
		return kd($u);
	}
} ?>
<?php function profilPic($u,$css="",$size=114) {
	?>
	<?php if($u['resim']!="") { ?>
		<img src="<?php r($u['resim'],$size); ?>" alt="avatar" class="<?php e($css) ?> img-responsive">
	<?php } else { ?>
		<img src="assets/pic.png" alt="avatar" class="<?php e($css) ?> img-responsive">
	<?php } ?>
	<?php
} ?>
<?php function refresh($s=3,$url="") {
	if($url=="") $urlt=""; else $urlt=";URL=$url";
	e("<meta http-equiv='refresh' content='$s$urlt'>");
} ?>
<?php function oturumNe() {
	global $_SESSION;
	oturumAc();
	if(!oturumisset("uid")) {
		yonlendir("index");
	} else {
		$uid = veri(oturum("uid"));
		return kd(ksorgu("uyeler","WHERE id=$uid"));
	}
	
} ?>
<?php function oturumKontrol($seviye="") {
	global $_SESSION;
	oturumAc();
	if($seviye=="") {
		if(!oturumisset("uid")) {
			return 0;
		} else {
			return 1;
		}
	} else {
		if(!oturumisset("uid")) {
			return 0;
		} else {
			$id = veri(oturum("uid"));
			$seviye2 = kd(ksorgu("uyeler","WHERE id =$id"));
			if($seviye2['seviye']==$seviye) {
				return 1;
			} else {
				return 0;
			}
		}
	}
	
} ?>
 <?php function other($cid,$where="") {
	 return ksorgu("other","WHERE cid = '$cid' $where");
 } ?>
 <?php function other_array($cid,$where="") {
	 $other = ksorgu("other","WHERE cid = '$cid' $where");
	 $array = array();
	 while($o =kd($other)) {
		 array_push($array,$o);
	 }
	 return $array;
 } ?>
 <?php function ozet($c=array(),$sayi=10) {
	 e2(kelime(strip_tags($c['html']),$sayi));
 } ?>
 <?php function cd($slug,$type="*.jpg") { //content directory
	global $depo; //elfinder depo
	$c = c($slug);
	$dir = $c['alt_resim'];
	$dir = "$depo/$dir/";
	return glob($dir.$type, GLOB_BRACE);
 } ?>
 <?php function c($slug) {
	 return kd(content_admin($slug));
 } ?>
 <?php function ci($cid,$w=1920) { //content image
	 $c = kd(content_admin($cid));
	 e("r.php?w=$w&p=file/{$c['pic']}");
 } ?>
 <?php function cir($cid,$w=1920) { //content image
	 $c = kd(content_admin($cid));
	 return "r.php?w=$w&p=file/{$c['pic']}";
 } ?>
 <?php function cir2($cid) { //content image
	 $varmi = content_admin($cid);
	 if($varmi==0) {
		 dEkle("content",array(
			"slug" => $cid,
			"title" => $cid,
		 ));
	 }
	 $c = kd(content_admin($cid));
	 return "file/{$c['pic']}";
 } ?>
 <?php function ct($cid) { //content title
	 $c = kd(content_admin($cid));
	 e2($c['title']);
 } ?>
 <?php function cs($cid) { //content slug
	 $c = kd(content_admin($cid));
	 e($c['slug']);
 } ?>
 <?php function url($c=array()) {
	 e($c['slug'] ."");
 }  ?>
 <?php function meta($c=array()) {
	 if(isset($c['slug'])) {
		 $link = "/{$c['slug']}.html";
		 $title= e2($c['title'],1);
		 $content = substr(strip_tags($c['html']),0,180);
		 if($c['pic']!="") {
			$img = "/file/" . $c['pic'] ;
			
		 } else {
			$img = "/" . cir2("og_image") ;
			
		 }
		 $kelime = cokr($c['slug'],"Anahtar Kelimeler");
		 if($kelime!="") {
			 $keywords = $kelime;
		 } else {
			 $keywords = set("Anahtar Kelimeler",1);
		 }
	 } else {
		 $link = "";
		 $img = "/" . cir2("og_image") ;
		 $title=set("Başlık",1);
		 $content = set("Açıklama",1);
		 $keywords = set("Anahtar Kelimeler",1);
	 }
	 ?>
	 <title><?php if(isset($c['title'])) e2($c['title']); else set("Başlık"); ?></title>

		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="<?php e($content); ?>">
		<meta name="keywords" content="<?php e($keywords) ?>" />
		<link rel="shortcut icon" type="image/png" href="<?php e(cir2("favicon")) ?>" />
		<meta name="author" content="<?php set("url") ?>">
		<!-- Twitter Card data -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:title" content="<?php e($title); ?>">
		<meta name="twitter:description" content="<?php e($content) ?>">
		<meta name="twitter:creator" content="@truncgilT">
		<meta name="twitter:image" content="<?php set("url"); ?><?php e($img) ?>">
		<meta property="og:image:type" content="image/jpeg" /> 
		<meta property="og:image:width" content="400" /> 
		<meta property="og:image:height" content="300" />
		<!-- Open Graph data -->
		<meta property="og:title" content="<?php e($title); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php set("url"); ?><?php e($link) ?>" />
		<meta property="og:image" content="<?php set("url"); ?><?php e($img) ?>" />
		<meta property="og:description" content="<?php e($content) ?>" /> 
		<meta property="og:site_name" content="<?php e($title); ?>" />
		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="aa/flag/css/flag-icon.min.css" />
	 <?php
 } ?>
 <?php 
function cl_http($url) {
  $U = explode(' ',$url);

  $W =array();
  foreach ($U as $k => $u) {
if (stristr($u,'http') || (count(explode('.',$u)) > 1)) {
  unset($U[$k]);
  return cl_http( implode(' ',$U));
}
}
  return implode(' ',$U);
}
 ?>
 <?php 
 $translate_sorgu = ksorgu("translate");
 $translate = array();
 $var = array();
 while($t = kd($translate_sorgu)) {
	// if($t['t']=="") $t['t'] = 0;
	array_push($var,$t['md5'].$t['dil']);
	if($t['t']!="") {
	 
		 $translate[$t['md5']][$t['dil']] = $t['t'];
	 
	} else {
 //	print2($t); exit();
	 //	$translate[$t['md5']][$t['dil']] = $t['i'];
	}
	 
 }
 //print_r($var); exit();
 function e2($deger,$r="") {
    oturumAc();
    global $translate;
    global $var;
    //$translate = $_SESSION['translate'];
    if(oturumisset("dil")) { //dil seçimi yapılmışsa
        $i2 = md5($deger);
        $dil2 = oturum("dil");
        $dil = veri(oturum("dil")); // dil hangisi
        $i = veri($deger);
        //verilen ifade ilgili dilde var mı
        //if(!oturumesit("dil","tr")) {
    //  e($i2);
        if(isset($translate[$i2][$dil2])) {
            $t = $translate[$i2][$dil2];
            if($t!="") { //verilen ifadenin çevirisi yapılmış mı?
                if($r=="") {
                    echo $t;
                } else {
                    return $t;
                }
            } else {
                if($r=="") {
                    echo $deger;
                } else {
                    return $deger;
                }
            }
        } else {
            if($dil2!="") {
                if(trim($deger)!="") {
                    if(!in_array(md5($deger).$dil2,$var)) {
                        //$diller = ksorgu("diller");
                    //  echo "$dil2 $deger eklenecek";
                        dEkle("translate",array(
                            "dil" => $dil2,
                            "md5" => md5($deger),
                            "i" => "$deger"
                        ));
                        /*
                        while($d=kd($diller)) {
                            $dil = veri($d['kisa']);
                            dEkle("translate",array(
                                "dil" => $d['kisa'],
                                "md5" => md5($deger),
                                "i" => "$deger"
                            ));

                        }
                        */
                    }
                }


            }
            if($r=="") {
                echo $deger;
            } else {
                return $deger;
            }
        }



    } else {
        if($r=="") {
            echo $deger;
        } else {
            return $deger;
        }
    } //oi
} //f ?>

<?php function r($img,$size="1024",$dir="file") { 
if(!file_exists($dir."/".$img)) {
	
	e($img);
} else {
	if(strpos($img,"elfinder")!=0) {
		e("r.php?w=$size&p=$img");
	} elseif(strpos("edia/",$img)) {
		e("$img");
	} else {
		e("r.php?w=$size&p=$dir/$img");
	}
	
}
}
 ?>
 <?php $yok = ksorgu("content","WHERE slug IS NULL");
while($y =kd($yok)) {
	dGuncelle("content",array (
		"slug" => slug($y['title'])
	),"id={$y['id']}");
}
 ?>

<?php function r2($img,$size="1024",$dir="file/") { 
	e("r.php?h=$size&p=$dir/$img");
}
 ?>
<?php function ll($s="",$f=""){
	$diller = ksorgu("diller","ORDER BY id ASC");
	e("<ul class='diller $s'>");
		e("<li><a href='?dil=tr' class='$f'><i class='flag-icon flag-icon-tr'></i></a></li>");
	while($d = kd($diller)) {
		e("<li><a href='?dil={$d['kisa']}' class='$f'><i class='flag-icon flag-icon-{$d['kisa']}'></i></a></li>");
	}
	e("</ul>");
	
} ?>
 <?php function wl($varsayilan="tr") {  //what language
	 oturumAc();
	 global $_SESSION;
	 if(oturumisset("dil")) {
		 e(oturum("dil"));
	 } else {
		 e($varsayilan);
		 oturum("dil",$varsayilan);
	 }
	 
 } ?>
<?php 
function ara($bas, $son, $icerik)
{
    @preg_match_all('/' . preg_quote($bas, '/') .
    '(.*?)'. preg_quote($son, '/').'/i', $icerik, $m);
    return $m;
}  
function ara2($icerik)
{
   preg_match_all( '/{{(.+?)\}}/', $icerik, $blocks );
    return $blocks;
}  
 ?>
 <?php 
function isHTML($string){
 return $string != strip_tags($string) ? true:false;
}
 ?>
 <?php function set($alan,$return="") {
	 $varmi =ksorgu("other","WHERE alan = '$alan' AND cid = 'common_settings'");
	 if($varmi!=0) {
	 $ayar = kd($varmi);
	// print_r($ayar);
	 if($return=="") {
	//	 e($ayar['deger']);
		 e2($ayar['deger']);
	 } else {
		 return $ayar['deger'];
	 } } else {
		 dEkle("other",array(
			"alan" => $alan,
			"cid" => "common_settings"
		 ));
	 } 
	 
	 
 } ?>
 <?php function setlist($slug,$where="") {
	 $list =ksorgu("other","WHERE cid = '$slug' $where");
	 return $list;
 } ?>
 <?php function setc($slug,$alan,$return="") {
	 $varmi =ksorgu("other","WHERE alan = '$alan' AND cid = '$slug'");
	 if($varmi!=0) {
		 $ayar = kd($varmi);
		// print_r($ayar);
		 if($return=="") {
		//	 e($ayar['deger']);
			 e2($ayar['deger']);
		 } else {
			
			 return $ayar['deger'];
		 } 
	 } else {
		 $varmi2 = content($slug);
		 if($varmi2==0) {
			 dEkle("content",array(
				"slug" => $slug,
				"title" => $slug
			 ));
		 }
		 dEkle("other",array(
			"alan" => $alan,
			"cid" => $slug
		 ));
	 } 
	 
	 
 } ?>
 <?php 
	
	function cok($id,$key) { //content other key echo
	   global $other_array;
	   // $kim = kd(ksorgu("other","WHERE cid = '$id' AND alan='$key'"));
	   // e($kim['deger']);
	   e($other_array[$id][$key]);
	} 
	?>
	<?php function cokd($id,$key) { //content other key echo
		global $other_array;
		$key = trim($key);
		$kim = kd(ksorgu("other","WHERE cid = '$id' AND alan='$key'"));
		return $kim;
	   //return $other_array[$id][$key];
	} ?>
	<?php function cok2($id,$key) { //content other key echo
		global $other_array;
		//$kim = kd(ksorgu("other","WHERE cid = '$id' AND alan='$key'"));
		//e2($kim['deger']);
		e2($other_array[$id][$key]);
	} ?>
	<?php function cokr($id,$key) { //content other key return
		global $other_array;
	   // $kim = kd(ksorgu("other","WHERE cid = '$id' AND alan='$key'"));
	   // return $kim['deger'];
		return $other_array[$id][$key];
	} ?>
 <?php function cokr2($id,$key) { //content other key return
	 $kim = kd(ksorgu("other","WHERE cid = '$id' AND alan='$key'"));
	 return $kim;
 } ?>
 <?php function cou($slug,$alan,$deger) { //content only update
	$slug = veri($slug);
	dGuncelle("content",array($alan => $deger),"slug=$slug");
 } ?>
 <?php function oc($id) { //othercontent
	$kim = kd(ksorgu("other","WHERE id = $id"));
	$veri = ksorgu("other","WHERE cid = '{$kim['cid']}'");
	return $veri;
 } ?>
 <?php function cju($id) { //content json update
	$kim = kd(ksorgu("other","WHERE id = $id"));
	e($id);
	print_r($kim);
	$veri = ksorgu("other","WHERE cid = '{$kim['cid']}'");//ilgili şahsın verilerini al
	$json =array();
	$k=0;
	
	while($v = kd($veri)) { //verileri bir dizide toparla ve 
		//$json[$k][$v['alan']] = $v['alan'];
		//$json[$k][$v['deger']] = $v['deger'];
		array_push($json,"{$v['alan']} : {$v['deger']}");
		$k++;
	}
	//print_r($json);
	e($kim['cid']);
	if($kim['cid']!="common_settings") {
	//	$json = json_encode($json);
		$json = implode("|",$json);
		dGuncelle("content",array( // ve content json a yaz
		"json" => $json
		),"slug = '{$kim['cid']}'");
	}
 } ?>
 <?php function cju2($slug) { //content json update

	$veri = ksorgu("other","WHERE cid = '$slug'");//ilgili şahsın verilerini al
	$json =array();
	$k=0;
	
	while($v = kd($veri)) { //verileri bir dizide toparla ve 
		//$json[$k][$v['alan']] = $v['alan'];
		//$json[$k][$v['deger']] = $v['deger'];
	array_push($json,"{$v['alan']} : {$v['deger']}");
		$k++;
	}
	//print_r($json);
//	$json = json_encode($json);
	$json = implode("|",$json);
	e($json);
	dGuncelle("content",array( // ve content json a yaz
	"json" => $json
	),"slug = '$slug'");
 } ?>
 <?php function tv($ifade,$dil) {
     if(trim($ifade)!="") {
     $i = veri($ifade);
     $varmi = ksorgu("translate","WHERE (md5 = $i) AND dil = '$dil' limit 1");
         if($varmi!=0) { //buldun mu
            $trans = kd($varmi);
             return $trans['t'];
         }
     }
 } ?>
 <?php function ti($ifade,$dil) {
     $i = veri($ifade);
	 $q = "WHERE md5 = $i AND dil = '$dil' limit 1";
	 $sorgu = ksorgu("translate",$q);
	 if($sorgu==0) {

		$id = dEkle("translate", array(
			'md5' => $ifade,
			'dil' => $dil
		));
	 } else {
		$trans = kd($sorgu);
		$id = $trans['id'];
	 }
     

     return $id;
 } ?>
<?php 
function google($title,$start=0) {
	if($title!="") {
		$title = urlencode($title);
		$json = file_get_contents("http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=$title&start=$start");
		$obj = json_decode($json);
		return $obj->responseData->results;
	}
}
 ?>
 <?php function bbaslik($title,$detay="") {
	 ?>
<div class="row firstRow">
	<div class="col-lg-9  col-md-8  col-sm-7">
		<div class="firstRowHeader">
			<h5><?php e($title) ?></h5>
		</div>
		<p><?php e($detay) ?></p>
	</div>
	<div class="col-lg-3   col-md-4  col-sm-5">
		
	</div>
</div>	 
	 <?php
 } ?>
<?php function layerslider($slug,$style="") {
	?>
	<?php $slider=kd(content($slug)); ?>
	<div class="ls-wp-container layerslider noback" style="<?php e(cok($slug,"style")); ?>">
	<?php $slides = contents($slug); ?>
	<?php while($s = kd($slides)) { ?>
		<?php if($s['code']!="") { //code bilgisine yığın layerslider bilgisi girilmesi için
			e($s['code']);
		} else { ?>
			<a href="<?php cok($s['slug'],"link"); ?>" target="_blank" class="ls-slide" data-ls="<?php e(cok($s['slug'],"data-ls")); ?>">
				<?php if($s['pic']!="") { ?>
					<img src="r.php?w=1200&p=file/<?php e($s['pic']) ?>" class="ls-bg" alt="" />
				<?php } ?>
				<?php $layers = contents($s['slug']); ?>
				<?php while($l = kd($layers)) { ?>
					<div class="ls-l" style="<?php e(cok($l['slug'],"style")); ?>" alt="<?php e(cok($l['slug'],"alt")); ?>" data-ls="<?php e(cok($l['slug'],"data-ls")); ?>">
						<?php if($l['pic']) {
							?>
							<img src="file/<?php e($l['pic']) ?>" style="max-width:1200px !important;" alt="" />
							<?php
						} ?>
						<?php e($l['html']); ?>
					</div>
				<?php } ?>
			</a>
		<?php } ?>
	<?php } ?>
	</div>
	<?php
	
} ?>
<?php function layerslider2($slug) {
	?>
	<?php $slider=kd(content($slug)); ?>
	<div class="ls-wp-container layerslider noback" style="<?php e($slider['style']); ?>">
	<?php $slides = contents($slug); ?>
	<?php while($s = kd($slides)) { ?>
		<?php if($s['code']!="") { //code bilgisine yığın layerslider bilgisi girilmesi için
			e($s['code']);
		} else { ?>
			<div class="ls-slide" data-ls="<?php e($s['datals']) ?>">
				<?php if($s['pic']!="") { ?>
					<img src="../r.php?w=1920&p=file/<?php e($s['pic']) ?>" class="ls-bg" alt="" />
				<?php } ?>
				<?php $layers = contents($s['slug']); ?>
				<?php while($l = kd($layers)) { ?>
					<div class="ls-l" style="<?php e($l['style']) ?>" alt="<?php e($l['alt']) ?>" data-ls="<?php e($l['datals']) ?>">
						<?php if($l['pic']) {
							?>
							<img src="../file/<?php e($l['pic']) ?>" alt="" />
							<?php
						} ?>
						<?php e($l['html']); ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	<?php } ?>
	</div>
	<?php
	
} ?>

<?php function bg($url) {
	echo "<style type='text/css'>
	content{
		background:url($url) !important;
		background-size: cover !important;
	}
		</style>";
} ?>
<?php function bg2($url) {
	echo "<style type='text/css'>
	.ui-page { 
		background:url($url) !important;
		background-size: cover !important;
	}
		</style>";
} ?>
<?php function title($isim,$kat="") {
	$isim2 = explode(".",$isim);
	return "{$isim2[0]}";
} ?>

<?php function galeri2($isim,$kat) {
	$isim = veri($isim);
	$galeri = kd(ksorgu("galerikategori","WHERE isim=$isim"));
	$galericerik = ksorgu("galeriicerik","WHERE gid='{$galeri['id']}' ORDER BY sira ASC");
	//e("<div class='caro'>");
	
	while($g = kd($galericerik)) {
		$title="";// title($g['url'],$kat);
		e("<a  title='$title' href='r.php?p=pfi-galeri-icerik/{$g['url']}&w=1024' data-lightbox='galeri' class='urun'>
				<img src='r.php?p=pfi-galeri-icerik/{$g['url']}&h=350' />
				<h2>$title</h2>
			</a>");
	}
	//e("</div>");
	
} ?>
<?php function galericaro($isim) {
	$isim = veri($isim);
	$galeri = kd(ksorgu("galerikategori","WHERE isim=$isim"));
	$galericerik = ksorgu("galeriicerik","WHERE gid='{$galeri['id']}' ORDER BY sira ASC");
	e("<div class='caro'>");
	while($g = kd($galericerik)) {
		$title="";// title($g['url'],$kat);
		e("
				<img src='../r.php?p=pfi-galeri-icerik/{$g['url']}&h=550' style='width:80%;max-width:550px;margin:0 auto;display:block;' />
		 ");
	}
	e("</div>");
	
} ?>

<?php function galeri3($isim) {
	$isim = veri($isim);
	$galeri = kd(ksorgu("galerikategori","WHERE isim=$isim"));
	$galericerik = ksorgu("galeriicerik","WHERE gid='{$galeri['id']}' ORDER BY sira ASC");
	e("<div class=\"galeri\">");
	while($g = kd($galericerik)) {
		$title= title($g['url'],$kat);
		e("<a title='$title' href='#{$g['id']}' data-rel='popup' data-position-to='window' data-transition='fade' class='ui-btn ui-btn-inline' data-lightbox='galeri'><img src='../r.php?p=pfi-galeri-icerik/{$g['url']}&w=141&h=120' /></a>");
		e("
		<div data-role='popup'  id='{$g['id']}' data-overlay-theme='b' data-theme='b' data-corners='false'>
		    <a href='#' data-rel='back' class='ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right'>Kapat</a>
			<a href='../pfi-galeri-icerik/{$g['url']}' data-ajax='false'><img  class='popphoto' src='../r.php?p=pfi-galeri-icerik/{$g['url']}&h=512' style='max-height:512px;margin:0 auto;display:block' ></a>
			
		</div>
		");
	}
	e("</div>");
	
} ?>
<?php 
function tkid($id,$static=""){
if($static!="") :
	static $toplam;
else :
	$toplam = "";
endif;
$sorgu = ksorgu("urun_kategori","WHERE ust=$id");
	if($sorgu!=0) :
	while($s = kd($sorgu)) {
		$toplam .= $s['id'] . ",";
		tkid($s['id']);
	}
	endif;
	$sonuc = substr($toplam,0,strlen($toplam)-1);
	if($sonuc!="") {
		return $id . "," . $sonuc;
	} else {
		return $id;
	}
} ?>
<?php 
$breadcrumb="";
function breadcrumb($id) {
global $breadcrumb;
	$kat = kd(ksorgu("content","WHERE slug='$id'"));
	$isim = $kat['title'];
	$slug = $kat['slug'];
		$breadcrumb =  "<li><a href='?i=sayfa&s=$slug'>$isim</a></li>" . $breadcrumb;
	if($kat['kid']!="") {
		breadcrumb($kat['kid']);
	} else {
	//	$breadcrumb = "<li><a href='urunler.php'>Ürünler</a></li>" . $breadcrumb;
	}
	return $breadcrumb;
}
 ?>
<?php 
 function elfinderJS() {
	 ?>
	 <!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="aa/lib/elfinder/css/jquery-ui.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="aa/lib/elfinder/css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" href="aa/lib/elfinder/css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script src="aa/lib/elfinder/js/elfinder.min.js"></script>

		<!-- GoogleDocs Quicklook plugin for GoogleDrive Volume (OPTIONAL) -->
		<!--<script src="js/extras/quicklook.googledocs.js"></script>-->

		<!-- elFinder translation (OPTIONAL) -->
		<!--<script src="js/i18n/elfinder.ru.js"></script>-->
		<script src="aa/lib/elfinder/js/i18n/elfinder.tr.js"></script>
		<script type="text/javascript" charset="utf-8">
			// Documentation for client options:
			// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
			function getUrlParam(paramName) {
					var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
					var match = window.location.search.match(reParam) ;

					return (match && match.length > 1) ? match[1] : '' ;
				}

			$(document).ready(function() {
				var funcNum = getUrlParam('CKEditorFuncNum');
				var tikla = 0;
				function dosyalar() {
					var dosyalar = [];
					$("#secililer img").each(function() {
						console.log($(this).attr("src"));
						dosyalar.push($(this).attr("src"));
					});
					$("#pic2").val(dosyalar.join());
					return dosyalar.join();
				}
				function dosyalar2() {
					var dosyalar2 = [];
					$("#secililer2 img").each(function() {
						console.log($(this).attr("src"));
						dosyalar2.push($(this).attr("src"));
					});
					$("#pic3").val(dosyalar2.join());
					return dosyalar2.join();
				}
				$("form").submit(function(){
					$('#elfinder').remove(); 
					$('#elfinder2').remove(); 
					console.log("ok");
					//return false;
				});
				$("#secililer,#secililer2").sortable({
					stop: function( ) {
						console.log(dosyalar());
					}			
				});
				$("#secililer img").click(function(){
					if(confirm("Dosyayı çıkartmak istediğinizden emin misiniz")) {
						$(this).remove();
					}
					console.log(dosyalar());
				});
				$("#secililer2 img").click(function(){
					if(confirm("Dosyayı çıkartmak istediğinizden emin misiniz")) {
						$(this).remove();
					}
					console.log(dosyalar2());
				});
				$("#elfinder_open").click(function(){
					if(tikla==0) {
						$('#elfinder').elfinder({
							url : 'aa/lib/elfinder/php/connector.minimal.php',  // connector URL (REQUIRED)
							lang: 'tr',                    // language (OPTIONAL)
							getFileCallback : function(file) {
							//	window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
							//	window.close();
								console.log(file);

								$.each(file,function(a,b) {
									console.log(b.name);
									var yol = "media/";
									var path = b.path.replace("files\\","");
									var n = $("<img src='"+yol+path+"'  alt='' />");
									$("#secililer").append(n); 
									n.click(function(){
										if(confirm("Dosyayı çıkartmak istediğinizden emin misiniz")) {
											$(this).remove();
										}
										console.log(dosyalar());
									});
									$("#secililer").sortable({
										stop: function( ) {
											console.log(dosyalar());
										}			
									});
								});
								dosyalar();
							},
							
							commandsOptions : {
								 getfile: {
									multiple: true
								 }
							},
							resizable: false
						});
					}
				});
				$("#elfinder_open2").click(function(){
					if(tikla==0) {
						$('#elfinder2').elfinder({
							url : 'aa/lib/elfinder/php/connector.minimal.php',  // connector URL (REQUIRED)
							lang: 'tr',                    // language (OPTIONAL)
							getFileCallback : function(file) {
							//	window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
							//	window.close();
								console.log(file);

								$.each(file,function(a,b) {
									console.log(b.name);
									var yol = "media/";
									var path = b.path.replace("files\\","");
									var n = $("<img src='"+yol+path+"'  alt='' />");
									$("#secililer2").append(n); 
									n.click(function(){
										if(confirm("Dosyayı çıkartmak istediğinizden emin misiniz")) {
											$(this).remove();
										}
										console.log(dosyalar2());
									});
									$("#secililer2").sortable({
										stop: function( ) {
											console.log(dosyalar2());
										}			
									});
								});
								dosyalar2();
							},
							
							commandsOptions : {
								 getfile: {
									multiple: true
								 }
							},
							resizable: false
						});
					}
				});
				
			});
		</script>
	 <?php
 }
 ?>
<?php 
$breadcrumb2="";
function breadcrumb2($id) {
global $breadcrumb2;
	$kat = kd(ksorgu("content","WHERE slug='$id'"));
	$isim = $kat['title'];
	$slug = $kat['slug'];
		$breadcrumb2 =  "<li><a href='$slug'>$isim</a></li>" . $breadcrumb2;
	if($kat['kid']!="") {
		breadcrumb2($kat['kid']);
	} else {
	//	$breadcrumb = "<li><a href='urunler.php'>Ürünler</a></li>" . $breadcrumb;
	}
	return $breadcrumb2;
}
 ?>

<?php function content($slug,$where="") {
	$content = ksorgu("content","WHERE y=1 AND slug='$slug' $where");
	return $content;
} ?>
<?php function content_admin($slug,$where="") {
	$content = ksorgu("content","WHERE slug='$slug' OR id='$slug' $where");
	return $content;
} ?>
<?php function content_id($id,$where="") {
	$content = ksorgu("content","WHERE y=1 AND id='$id' $where");
	return $content;
} ?>
<?php function contents($slug="",$where="",$limit="0,100000") {
	if($slug=="") {
		$content = ksorgu("content","WHERE y=1 AND kid IS NULL $where ORDER BY s ASC LIMIT $limit");
	} else {
		$content = ksorgu("content","WHERE y=1 AND kid='$slug' $where ORDER BY s ASC LIMIT $limit");
	}
	
	return $content;
} ?>
<?php function arrayc($slug="",$where="",$limit="0,100") {
	//if($slug=="") {
	//	$content = ksorgu("content","WHERE y=1 AND kid IS NULL $where ORDER BY s ASC LIMIT $limit");
	//} else {
		$content = ksorgu("content","WHERE y=1 AND kid='$slug' $where ORDER BY s ASC LIMIT $limit");
//	}
	$array = array();
	while($c = kd($content)) {
		array_push($array,$c);
	}
	return $array;
} ?>
<?php function file_type($file,$array=array()) {
	$allowed =  $array;
	$filename = $_FILES[$file]['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed) ) {
		return 0;
	} else {
		return 1;
	}
} ?>
<?php function bag($bag,$sira=0) {
	$bag = explode(",",$bag);
	return @$bag[$sira];
} ?>
<?php function array_type($type="",$limit="0,100",$bag="",$where="",$kat="",$y="1",$order="") {
	
	if($bag=="") $bagt=""; else $bagt="AND bag = '$bag'";
	if($order=="") $ordert="date DESC, s ASC"; else $ordert=$order;
	if($kat=="") $katt=""; else $katt="AND tkid LIKE '%$kat%'";
	
	$content = ksorgu("content","WHERE y IN($y) AND type='$type' $bagt $where $katt ORDER BY $ordert LIMIT $limit");
	$array = array();
	while($c = kd($content)) {
		array_push($array,$c);
	}
	return $array;
} ?>
<?php function my_type($type="",$bag="", $where="",$y="1,0") {
	$content = ksorgu("content","WHERE y IN($y) AND type='$type' AND (bag='$bag' OR bag LIKE '$bag,%' OR bag LIKE '%,$bag') ORDER BY date DESC, s ASC");
	$array = array();
	while($c = kd($content)) {
		array_push($array,$c);
	}
	return $array;
} ?>
<?php function bilgi($text) {
	return e("<div class='row'><div class='btn btn-warning btn-block'>$text</div></div>");
} ?>
<?php function array_type2($type="",$limit="0,100",$bag="") {
	$content = ksorgu("content","WHERE type='$type' AND bag = '$bag' ORDER BY s ASC LIMIT $limit");
	$array = array();
	while($c = kd($content)) {
		array_push($array,$c);
	}
	return $array;
} ?>
<?php function item_sablon($b = array()) { ?>
<div class="col-md-4">
<div class="item-ads-grid">
   <!-- <div class="item-badge-grid featured-ads">
		<a href="#">Sponsorlu</a>
	</div>-->
	<div class="item-img-grid">
		<?php if($b['pic']!="") { ?><img alt="" src="<?php r($b['pic'],256) ?>" class="img-responsive img-center"><?php } ?>
	</div>
	<div class="item-title">
		<a href="<?php url($b) ?>"><h4><?php e2($b['title']) ?></h4></a>
	</div>
	<div class="item-meta">
		<ul>
			<li class="item-date"><i class="fa fa-clock-o"></i> <?php echo tt($b['date']) ?></li>
			<li class="item-cat"><i class="fa fa-bars"></i> <?php ct($b['kid']) ?></li>
			<li class="item-location"><a href="category.html"><i class="fa fa-map-marker"></i> <?php cok($b['slug'],"Şehir") ?></a></li>
			<li class="item-type"><i class="fa fa-bookmark"></i> New</li>
		</ul>
	</div>
   
</div>
</div>
<?php } ?>
<?php function array_join($join="",$limit="0,100") {
	$content = ksorgu("content","WHERE y=1 AND join='$join' ORDER BY s ASC LIMIT $limit");
	$array = array();
	while($c = kd($content)) {
		array_push($array,$c);
	}
	return $array;
} ?>
<?php 
$seviye =0;
function seviye($slug) { //bir içeriğin kaçıncı seviye olduğunu döndürür
global $seviye;
	$c = kd(content($slug));
	if($c['kid']!="") { //eğer üstü varsa
		$seviye++;
		seviye($c['kid']);
	}
	return $seviye;
} ?>
<?php function contents_all2($slug="",$where="",$limit="0,100") {
	$content = ksorgu("content","WHERE y=1 AND tkid LIKE '%$slug%' $where ORDER BY s ASC LIMIT $limit");
	return $content;
} ?>
<?php function contents_level($slug="",$where="",$limit="0,100",$level=1) {
	$array = array();
	$content = ksorgu("content","WHERE y=1 AND tkid LIKE '%$slug%' $where ORDER BY s ASC LIMIT $limit");
	while($c = kd($content)) {
		if(seviye($c['slug'])>$level) {
		array_push($array,$c);
		}
	}
	return $array;
} ?>
<?php function total_all($slug="",$where="") {
	$content = ksorgu("content","WHERE y=1 AND tkid LIKE '%$slug%' $where ORDER BY s ASC ");
	return sToplam($content);
} ?>
<?php function contents_all($slug="",$where="",$limit="0,100") {
	$content = ksorgu("content","WHERE y=1 AND tkid LIKE \"%,'$slug'\" $where ORDER BY s ASC LIMIT $limit");
	if($content==0) $content = ksorgu("content","WHERE y=1 AND kid='$slug' $where ORDER BY s ASC LIMIT $limit");
	$array = array();
	while($c = kd($content)) {
		$varmi = contents($c['slug']);
		if($varmi ==0) { //alt elemanı yoksa
			array_push($array,$c);
		}
	}
	return $array;
} ?>
<?php 
function contents_cat($slug="",$where="",$limit="0,100") {
	$array = array();
	$content = ksorgu("content","WHERE y=1 AND tkid LIKE \"%,'$slug'\" $where ORDER BY s ASC LIMIT $limit");
	if($content==0) $content = ksorgu("content","WHERE y=1 AND kid='$slug' $where ORDER BY s ASC LIMIT $limit");
	
	while($c = kd($content)) {
		$varmi = contents($c['slug']);
		if($varmi !=0) { //alt elemanı varsa
			array_push($array,$c);
			//contents_cat($c['slug']);
		}
	}
	return $array;
} ?>
<?php function table($table,$where,$limit="0,100") {
	$table = ksorgu("$table","$where $limit");
	$array = array();
	while($t = kd($table)) {
		array_push($array,$t);
	}
	return $array;
} ?>
<?php function contents_admin($slug="",$where="",$limit="0,100") {
	if($slug=="") {
		$content = ksorgu("content","WHERE kid IS NULL $where ORDER BY s ASC LIMIT $limit");
	} else {
		$content = ksorgu("content","WHERE kid='$slug' $where ORDER BY s ASC LIMIT $limit");
	}
	
	return $content;
} ?>
<?php function contents2($slug,$where="",$limit="0,100") {
	$content = ksorgu("content","WHERE y=1 AND kid IN ($slug) $where ORDER BY s ASC LIMIT $limit");
	return $content;
} ?>

<?php function anamenu($slug,$alt=false){
	global $uzanti;
	$content = contents($slug);
	if($content!=0) {
		while($c = kd($content)) {
			e("<li><a href='{$c['slug']}.$uzanti'>{$c['title']}</a>");
				if($alt==true) {
					e("<ul>").anamenu($c['slug'],true).e("</ul>");
				}
			e("</li>");
		}
	}
} ?>
<?php function col2($boyut="col-md-3",$title="") { ?>
<div class="<?php e($boyut) ?>">
	<div class="panel panel-default drag">
	<?php if($title!="") { ?>
		<div class="panel-heading clearfix ">
			<div class="panel-heading-title pull-left">
				<h6><?php e($title) ?></h6>
			</div>
		</div>
	<?php } ?>
	<div class="panel-body clearfix">
<?php } ?>
<?php function _col2() {
	?>
</div>
</div>		
</div>		
<?php
} ?>
<?php function selectDirList($secili="") {
	global $depo;
	$dir = new DirectoryIterator($depo);
		e("<option value='' selected>Dizin Yok</option>");

	foreach ($dir as $fileinfo) {
		if ($fileinfo->isDir() && !$fileinfo->isDot()) {
			$alt_dir = new DirectoryIterator($depo ."/" . $fileinfo->getFilename());
			e("<optgroup label='{$fileinfo->getFilename()}'>");
			$select ="";
			if($fileinfo->getFilename()==$secili) {
						$select ="selected";
					}
			echo "<option value='{$fileinfo->getFilename()}' $select>{$fileinfo->getFilename()} (Ana Dizin)</option>";
			foreach ($alt_dir as $fileinfo2) {
				if ($fileinfo2->isDir() && !$fileinfo2->isDot()) {
					$select ="";
					if("{$fileinfo->getFilename()}/{$fileinfo2->getFilename()}"==$secili) {
						$select ="selected";
					}
					echo "<option value='{$fileinfo->getFilename()}/{$fileinfo2->getFilename()}' $select>{$fileinfo->getFilename()}/{$fileinfo2->getFilename()}</option>";
				}
			
			}
			e("</optgroup>");
	}

	}

} ?>
<?php 
$cat =array();
function content_cat($slug) {
	global $cat;
	$ne = contents($slug);
	if($ne!=0) {
		array_push($cat,$slug);
		while($n = kd($ne)) {
			content_cat($n['slug']);
		}
	} else {
		return implode(",",$cat);
	}
} ?>
<?php function content_sablon($slug) { ?>
<?php 
$tkid = kd(content_admin($slug));
$kid = $tkid['kid'];
$tkid = $tkid['tkid'];
if($tkid!="") {
	$tkidsql = " OR slug IN ($tkid)";
} else {
	$tkidsql = "";
}
if($kid!="") {
	$kidsql  ="OR slug = '$kid'";
} else {
	$kidsql = "";
}

$sablon = kd(ksorgu("sablon","WHERE slug = '$slug' $kidsql $tkidsql ORDER BY slug='$slug',slug='$kid' DESC")); 
	if($sablon['deger']!="") {$sablon = explode(",",$sablon['deger']); }else { $sablon="";}//print_r($sablon);
	return $sablon;
}
?>
<?php function type_sablon($type) {
	$sablon = kd(ksorgu("sablon","WHERE slug = '$type'")); 
	if($sablon['deger']!="") {$sablon = explode(",",$sablon['deger']); }else { $sablon="";}//print_r($sablon);
	return $sablon;
}
?>
<?php function content_update($slug,$a = array()) {
	dGuncelle("content",$a,"slug='$slug'");
} ?>
<?php function content_type($slug) { ?>
<?php 
$tkid = kd(content_admin($slug));
$kid = $tkid['kid'];
$tkid = $tkid['tkid'];
if($tkid!="") {
	$tkidsql = " OR slug IN ($tkid)";
} else {
	$tkidsql = "";
}
if($kid!="") {
	$kidsql  ="OR slug = '$kid'";
} else {
	$kidsql = "";
}
$sablon = kd(ksorgu("type","WHERE slug = '$slug' $kidsql $tkidsql ORDER BY slug='$slug',slug='$kid' DESC")); 
	
	return $sablon['tip_ad'];
?>
<?php } ?>
<?php 
$k=0;
function switch_alan($o) { global $k; ?>
<?php
	
	$alan = trim($o['alan']); $deger = kd(ksorgu("sablon_deger","WHERE ozellik='$alan'"));
	if($deger['deger']!="") {
		$degerler = explode(",",$deger['deger']);
		$typene = ksorgu("sablon_type","WHERE  deger LIKE '%{$o['alan']}%'");
		if($typene==0) {
			$t = "text";
		} else {
			$t = kd($typene);
			$t = $t['type'];
		}
		switch($t) {
			default:
			?>
		<select name="deger[]"  id="" tablo="other" d_alan="deger" s_alan="id" s_kriter="<?php e($o['id']) ?>" class="iduzenle form-control">
		<option value="">Seçiniz</option>
		<?php 
		
		foreach($degerler AS $deger) { ?>
			
		<?php if($deger!="") { ?>
			<option value="<?php e(trim($deger)) ?>" <?php if($o['deger']==trim($deger)) e("selected"); ?>><?php e(trim($deger)) ?></option>
		<?php } ?>
		<?php } ?>
		</select>	
			<?php
			break;
			case "radio" : 
			
			?>
			<?php foreach($degerler AS $deger) { ?>
			<?php if($deger!="") { ?>
				<label><input type="radio" tablo="other" d_alan="deger" s_alan="id" s_kriter="<?php e($o['id']) ?>" class="iduzenle"  name="deger[<?php e($k) ?>]" value="<?php e(trim($deger)) ?>" id=""  <?php if($o['deger']==trim($deger)) e("checked"); ?>/><?php e(trim($deger)) ?></label>
			<?php } ?>
			<?php } ?>
			<?php
			$k++;
			break;
		}
	} else {
		$typene = ksorgu("sablon_type","WHERE  deger LIKE '%{$o['alan']}%'");
		if($typene==0) {
			$t = "text";
		} else {
			$t = kd($typene);
			$t = $t['type'];
		}
		?>
		<input type="<?php e($t); ?>" tablo="other" d_alan="deger" s_kriter="<?php e($o['id']) ?>" class="form-control iduzenle" value="<?php e($o['deger']) ?>" />
		
	 <?php } ?>
	
	
<?php } ?>

<?php function yeniIcerikFormu($boyut = "col-md-6",$slug="") {
	//$type = content_type($slug);
//e($type);
	//if($type=="") $type="İçerik";
	?>
<?php col2($boyut,"Bu Alana Yeni İçerik Ekle"); ?>
				<form action="?ekle" method="post" enctype="multipart/form-data" >	
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-3">
								<label for="">Başlık</label>
								<input type="text" name="title" id="title" required class="form-control" />
							</div>
							<div class="col-md-3">
								<label for="">URL</label>
								<input type="text" name="slug" id="slug" required class="form-control" />
							</div>
							<div class="col-md-3">
								<label for="">Kapak Resmi</label>
								<input type="file" name="pic" class="form-control" />
							</div>
							<div class="col-md-12">
															<hr />
															<input type="hidden" id="pic3" name="pic2" class="form-control" />
															<?php elfinderJS(); ?>
															
															<a href="#" id="elfinder_open2" class="btn btn-primary"><i class="fa fa-file"></i> Detay Dosyaları Ekle</a>
															<div class="col-md-12"><div id="elfinder2"></div></div>
															
															<hr />
															<style type="text/css">
															#secililer2 img {
																width:128px;
																height:128px;
															}
															</style>
															<div id="secililer2">
																
															</div>
														</div>
							<div class="row">
								<div class="col-md-6">
									<label for="">Ek Dosyalar Dizini</label>
									<select name="alt_resim" id="" class="form-control">
									<?php 
										selectDirList();
									?>
									</select>
								</div>
								<div class="col-md-3">
									<label for="">Üst Kategori</label>
									<input type="text" name="kid" value="<?php e($slug) ?>" class="form-control" />
								</div>
								<div class="col-md-3">
									<label for="">Tip</label>
									<select name="type" id="type" class="form-control">
									<?php $tip = ksorgu("type"); ?>
									<?php while($t = kd($tip)) { ?>
										<option value="<?php e($t['slug']) ?>"><?php e($t['tip_ad']) ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
						</div>
						
					</div>												
					<div class="row">
						<div class="col-md-12">
							<label for="">İçerik</label>
							<textarea name="html" id="editor" class="ckeditor" cols="45" rows="5"></textarea>
						</div>
					</div>
					<div class="row">
					<?php 
					$tkid = kd(content_admin($slug));
					$kid = $tkid['kid'];
					$tkid = $tkid['tkid'];
					if($tkid!="") {
						$tkidsql = " OR slug IN ($tkid)";
					} else {
						$tkidsql = "";
					}
					if($kid!="") {
						$kidsql  ="OR slug = '$kid'";
					} else {
						$kidsql = "";
					}
					$sablon = kd(ksorgu("sablon","WHERE slug = '$slug' $kidsql $tkidsql ORDER BY slug='$slug',slug='$kid' DESC")); 
						if($sablon['deger']!="") {$sablon = explode(",",$sablon['deger']); }else { $sablon="";}//print_r($sablon);
					?>
					<div id="ozellikler"></div>
					<?php if($sablon!="") { ?>
					<table class="table">
					<thead>
						<tr>
							<th>Alan</th>
							<th>Değer</th>
						</tr>
					</thead>
					<tbody>
						<!--<tr>
							<td>İlgili Üye</td>
							<td>
								<select name="deger[]" id="" class="form-control">
									<?php foreach(array_type("Firma") AS $f) { ?>
										<option value="<?php e($f['slug']) ?>"><?php e($f['title']) ?></option>
									<?php } ?>
										<option value="" selected>Seçiniz</option>
								</select>
							</td>
						</tr>-->
						<?php foreach($sablon AS $alan) { ?>
						<?php if($alan!="") { ?>
						<tr>
							<td><input type="text" name="alan[]" class="form-control" value="<?php e(trim($alan)) ?>" /></td>
							<td>
							<?php $alan = trim($alan); $deger = kd(ksorgu("sablon_deger","WHERE ozellik='$alan'"));
							if($deger['deger']!="") {
								$degerler = explode(",",$deger['deger'])
								?>
								<select name="deger[]" id="" class="form-control">
								<option value="">Seçiniz</option>
								<?php foreach($degerler AS $deger) { ?>
									
								<?php if($deger!="") { ?>
									<option value="<?php e(trim($deger)) ?>"><?php e(trim($deger)) ?></option>
								<?php } ?>
								<?php } ?>
								</select>
								<?php
							} else {
								$typene = ksorgu("sablon_type","WHERE  deger LIKE '%$alan%'");
								if($typene==0) {
									$t = "text";
								} else {
									$t = kd($typene);
									$t = $t['type'];
								}
								e('<input type="'.$t.'" name="deger[]" class="form-control"  id="" />');
							 } ?>
							</td>
						</tr>
						<?php } ?>
						<?php } ?>
					</tbody>
					</table>
					<?php } ?>
					</div>
					<div class="row">
						<div class="col-md-12 ">
							<button type="submit" href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Ekle</button>
						</div>
						
					</div>
					
					
					
					
					</form>
					<?php _col2(); ?>
	<?php
} ?>
<?php function uyeler($seviye="") {
	$array = array();
	if($seviye!="") $seviyet = ""; else $seviyet="WHERE seviye='$seviye'";
	$uyeler = ksorgu("uyeler");
	
} ?>
<?php function uyeler_array($seviye="") {
	$array = array();
	if($seviye!="") $seviyet = ""; else $seviyet="WHERE seviye='$seviye'";
	$uyeler = ksorgu("uyeler","$seviyet");
	while($u = kd($uyeler)) {
		array_push($array,$u);
	}
	return $array;
} ?>

<?php function uye_isim($id) {
	$id2 = @implode(",",$id);
	if(is_array($id2)) {
	$id = $id2[0];
	}
	$u = kd(ksorgu("uyeler","WHERE id = '$id'"));
	echo "{$u['adi']} {$u['soyadi']}";
} ?>
<?php function alert($icerik) {
	?>
	<div class="alert alert-primary" role="alert">
		<?php e($icerik) ?>
	</div>
	<?php
} ?>
<?php function pelinom5() {
	e('<div style="    background: #008DD2 url(aa/pelinom.png) center center no-repeat;
    line-height: 78px;
    height: 162px;
    margin: -10px;
    position: absolute;
    width: 100%;
    height: 100%;">
	</div>');
} ?>
<?php function col($boyut="col-md-3",$a = array()) {
	global $_GET;
	/*if(!isset($a['icon'])) {
		$a['icon'] ="pencil";
	}*/
	//r.php?w=512&p=file/
	?>
<div class="<?php e($boyut) ?>" id="id-<?php e($a['id']) ?>" >
	<div class="panel panel-default drag" id="<?php e($a['id']) ?>" style="background:url(r.php?w=512&p=file/<?php e($a['pic']) ?>) 90% center no-repeat white;background-size: contain;">
		<div class="panel-heading clearfix ">
			<div class="panel-heading-title pull-left">
			<?php $varmi = contents($a['slug']);
					$str = "";
				if($varmi==0) {
					$str = "&guncelleform";
				}
			?>
				<h6><a href="?i=sayfa&s=<?php e($a['slug']) ?><?php e($str); ?>"><i class="fa fa-<?php if(strpos($a['type'],"Kategori")==true) e("folder"); else e("file");					?>"></i> <?php e2($a['title']) ?></a></h6>
			</div>
			<!--panel-heading-title-->
			<div class="panel-heading-buttons pull-right">
				<div class="bs-example">
					<p class="clearfix">
						
						<a ajax="#id-<?php e($a['id']) ?>" teyit="<?php e($a['title']) ?> içeriğini gerçekten silmek istediğinizden emin misiniz?" href="?sil=<?php e($a['id']) ?>" class="btn"> <i class="fa fa-times"></i></a>
						<a href="?cogalt=<?php e($a['slug']) ?>" teyit="<?php e($a['title']) ?> İçeriğini alt içerikleriyle beraber çoğaltmak istediğinizden emin misiniz?" class="btn"><i class="fa fa-files-o"></i></a>
						<a class="btn"> <?php e(toplam("content","kid = '{$a['slug']}'")); ?></a>
				</p></div>
			</div>
			<!--panel-heading-buttons-->
		</div>
		<div class="panel-body clearfix" >
		<?php if(isset($a['pic'])) { ?>
			
		<?php } ?>
			<div class="amsterdamContent">
				<div class="amsterdamButtonPlaseholder">
					
				</div>

				<?php if($a['html']!="") { 
				//	e(kelime(strip_tags($a['html']),30));
				 } ?>
			</div>
			<div class="buttonWrapper">
				<button type="button" id="<?php e($a['id']) ?>" deger="<?php e($a['y']); ?>" class="yayin btn <?php if($a['y']==0) e("btn-danger"); else e("btn-success"); ?>  buttonsRoundedLarge float-button-light waves-effect waves-button waves-float waves-light"><i class="fa fa-wifi"></i></button>
			</div>
		</div>
	</div>
	<!--panel-body-->
</div>	
	<?php
} ?>
<?php 
$hiyerarsi="";
$k = 0;
function hiyerarsi($id) {
global $k;
global $hiyerarsi;
	$kat = kd(ksorgu("content","WHERE slug='$id'"));
	$isim = $kat['title'];
	$a = $kat['slug'];
	if($k==0) {
		$hiyerarsi =  "<li>$isim</li>" . $hiyerarsi;
	} else {
		$hiyerarsi =  "<li><a href='?i=sayfa&s=$a'>$isim</a></li>" . $hiyerarsi;
	}
		
	if($kat['kid']!="") {
		$k++;
		hiyerarsi($kat['kid']);
	}
	return "
		<ol class='breadcrumb'>
			<li><a href='?i=icerikler'>Anasayfa</a></li>
			$hiyerarsi
		</ol>";
}
 ?>
<?php 
$hiyerarsi2="";
function hiyerarsi_web($id) {
global $hiyerarsi;
global $uzanti;
	$kat = kd(ksorgu("content","WHERE slug='$id'"));
	$isim = $kat['title'];
	$a = $kat['slug'];
	if($kat['kid']!="") {
		$hiyerarsi =  "<a class='dugme' href='$a.$uzanti'>$isim</a> " . $hiyerarsi;
	}
	if($kat['kid']!="") {
		hiyerarsi_web($kat['kid']);
	}
	return "<div class='butonset'>$hiyerarsi</div>";
}
 ?>
 <?php function katisset($ara,$slug) {
	 $sonuc = hiyerarsisade($slug);
	 if(strpos($sonuc,$ara)!==false) {
		 return 1;
	 } else {
		 return 0;
	 }
 }  ?>
 <?php 
$hiyerarsisade=array();
function hiyerarsisade($id) {
global $hiyerarsisade;
	$kat = kd(ksorgu("content","WHERE slug='$id'"));
	$isim = $kat['title'];
	$a = $kat['slug'];
		array_push($hiyerarsisade,veri($a));
	if($kat['kid']!="") {
		hiyerarsisade($kat['kid']);
	}
	return implode(",",$hiyerarsisade);
	$hiyerarsisade=array();
}
$breadcrumbs=array();
$k = 0;
function breadcrumbs($id) {
global $breadcrumbs;
global $k;
	$kat = kd(ksorgu("content","WHERE slug='$id'"));
	$isim = $kat['title'];
	$a = $kat['slug'];
		$breadcrumbs[$k]['title'] = $kat['title'];
		$breadcrumbs[$k]['slug'] = $kat['slug'];
	if($kat['kid']!="") {
		$k++;
		breadcrumbs($kat['kid']);
	}
	return array_reverse($breadcrumbs);
}
$altkat=array();
function altkat($id) {
global $altkat;
	$kat = ksorgu("content","WHERE kid='$id'");
	while($k = kd($kat)) {
		array_push($altkat,veri($k['slug']));
	}
	return implode($altkat,",");
}
 ?>
<?php 
$hiyerarsi3="";
function hiyerarsi_web2($id) {
global $hiyerarsi3;
global $uzanti;
	$kat = kd(ksorgu("content","WHERE slug='$id'"));
	$isim = $kat['title'];
	$a = $kat['slug'];
	if($kat['kid']!="") {
		$hiyerarsi3 =  "<a href='$a.$uzanti' class='ui-btn ui-btn-inline' data-theme='b'>$isim</a>" . $hiyerarsi3;
	}
	if($kat['kid']!="") {
		hiyerarsi_web2($kat['kid']);
	}
	return "<a href='index' class='ui-btn ui-btn-inline'><i class='fa fa-home'></i></a>$hiyerarsi3";
}
 ?>
<?php 
function dizin($link) {
	$link = explode("/",$link);
	//array_pop($link);
	$t = "file/";
	foreach($link AS $l) {
		$t .= $l . "/";
		@mkdir($t);
	}
	
}
function contentUpload($post) {
	if($_FILES[$post]['name']!="") {
	$date=date_create(simdi());
	$link = date_format($date,"Y/m");
	//e($link);
	dizin($link);
	$file = yukle($post,"file/".$link);
	$_POST[$post] = $link ."/" . $file;
	}
	
}
function contentUpload2($post,$isim) {
	$date=date_create(simdi());
	$link = date_format($date,"Y/m");
	//e($link);
	dizin($link);
	$isim = kripto($isim.rand(11111,99999)).".jpg";
	if(move_uploaded_file($post, "file/".$link)) {
		e("ok");
	}
	return "$link/$isim";
	
}
function content_user($slug,$y="0,1") {
	oturumAc();
	global $_SESSION;
	$uid = $_SESSION['uid'];
	
	$c = kd(ksorgu("content","WHERE y IN ($y) AND (slug = '$slug' OR id = '$slug') AND bag = $uid"));
	return $c;
}
function unsetpost($post) {
	global $_POST;
	unset($_POST[$post]);
}
function postEkle($tablo) {
	global $_POST;
	 dEkle($tablo,$_POST);
	 return post("slug");
}
function postGuncelle($tablo,$where) {
	global $_POST;
	 dGuncelle($tablo,$_POST,"$where");
}
function postyukle($post,$dizin) {
	if($_FILES[$post]['name']!="") {
		$_POST[$post] = yukle($post,$dizin);
	}
}
function posttarih($post) {
	$_POST[$post] = simdi();
}
function zftr($d2){
 $d1 = date('Y-m-d H:i:s');
 
    if(!is_int($d1)) $d1=strtotime($d1);
    if(!is_int($d2)) $d2=strtotime($d2);
    $d=abs($d1-$d2);
if ($d1-$d2<0) {
$ifade = "sonra";
} else {
$ifade = "önce";
 }
$once = " "; 
    if($d>=(60*60*24*365))    $sonuc  = $once . floor($d/(60*60*24*365)) . " yıl $ifade";
    else if($d>=(60*60*24*30))     $sonuc = $once . floor($d/(60*60*24*30)) . " ay $ifade";
    else if($d>=(60*60*24*7))  $sonuc  = $once . floor($d/(60*60*24*7)) . " hafta $ifade";
    else if($d>=(60*60*24))    $sonuc  = $once . floor($d/(60*60*24)) . " gün $ifade";
    else if($d>=(60*60))   $sonuc = $once . floor($d/(60*60)) . " saat $ifade";
    else if($d>=60) $sonuc  = $once . floor($d/60)  . " dakika $ifade";
	else $sonuc = "Az $ifade";
 
    return $sonuc;
}
function zfen($d2){
 $d1 = date('Y-m-d H:i:s');
 
    if(!is_int($d1)) $d1=strtotime($d1);
    if(!is_int($d2)) $d2=strtotime($d2);
    $d=abs($d1-$d2);
if ($d1-$d2<0) {
$ifade = "left";
} else {
$ifade = "ago";
 }
$once = " "; 
    if($d>=(60*60*24*365))    $sonuc  = $once . floor($d/(60*60*24*365)) . " year $ifade";
    else if($d>=(60*60*24*30))     $sonuc = $once . floor($d/(60*60*24*30)) . " month $ifade";
    else if($d>=(60*60*24*7))  $sonuc  = $once . floor($d/(60*60*24*7)) . " week $ifade";
    else if($d>=(60*60*24))    $sonuc  = $once . floor($d/(60*60*24)) . " day $ifade";
    else if($d>=(60*60))   $sonuc = $once . floor($d/(60*60)) . " hour $ifade";
    else if($d>=60) $sonuc  = $once . floor($d/60)  . " minute $ifade";
	else $sonuc = "Few $ifade";
 
    return $sonuc;
}
function zfar($d2){
 $d1 = date('Y-m-d H:i:s');
 
    if(!is_int($d1)) $d1=strtotime($d1);
    if(!is_int($d2)) $d2=strtotime($d2);
    $d=abs($d1-$d2);
if ($d1-$d2<0) {
$ifade = "فيما بعد";
} else {
$ifade = "قبل";
 }
$once = " "; 
    if($d>=(60*60*24*365))    $sonuc  = $once . floor($d/(60*60*24*365)) . " عام $ifade";
    else if($d>=(60*60*24*30))     $sonuc = $once . floor($d/(60*60*24*30)) . " شهر $ifade";
    else if($d>=(60*60*24*7))  $sonuc  = $once . floor($d/(60*60*24*7)) . " أسبوع $ifade";
    else if($d>=(60*60*24))    $sonuc  = $once . floor($d/(60*60*24)) . " يوم $ifade";
    else if($d>=(60*60))   $sonuc = $once . floor($d/(60*60)) . " ساعة $ifade";
    else if($d>=60) $sonuc  = $once . floor($d/60)  . " دقيقة $ifade";
	else $sonuc = "القليل $ifade";
 
    return $sonuc;
}

?>
<?php function jd($d){
return json_decode($d['deger'],true);
} ?>
<?php function via($islem,$url="") { 
	global $via; 
	if($url==""){
		$adres =""; 
	}else {
		$adres = "&y=$url";
	} 
	echo $via.$islem.$adres; 
} ?>
