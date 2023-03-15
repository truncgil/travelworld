<?php include("tema.php");
oturumAc();
if(oturumisset("uid")) {
	$uid = oturum("uid");
} else {
	oturum("uid",session_id());
	$uid = oturum("uid");
}
$u = u($uid);
if(getisset("ajax")) {
	switch(get("ajax")) {
		case "count" :
		
		if(!getesit("link","")) {
			$kr = veri("%".get("link")."%");
			print_r($_GET);
			$kim = kd(ksorgu("content","WHERE json LIKE $kr"));
			$kim['view'] = $kim['view'] +1;
			dGuncelle("content",array(
				"view" => $kim['view']
			),"json LIKE $kr");
			yonlendir(get("link"));
		} else {
			yonlendir("index");
		}
		break;
		case "LIKE" :
			$uid = oturum("uid");
			$slug = veri(get("slug"));
			$varmi = ksorgu("content","WHERE type='LIKE' AND uid='$uid' AND bag=$slug");
			if($varmi==0) {
				
				dEkle("content",array(
					"bag" => get("slug"),
					"slug" => randomPassword(),
					"uid" => $uid,
					"type" => "LIKE"
				));
			}
			likeUpdate();
		break;
		case "UNLIKE" :
			$uid = oturum("uid");
			$slug = veri(get("slug"));
			$varmi = ksorgu("content","WHERE type='LIKE' AND uid='$uid' AND bag=$slug");
			if($varmi==0) {		
				sil("content","type='LIKE' AND uid='$uid' AND bag=$slug");
			}
			likeUpdate();
		break;
		case "SOZLESME" : 
			$sozlesme = set("Satış Sözleşmesi","r");
			e($sozlesme);
		break;
		case "SIPARIS_LIST" :
		if(!getesit("sid","")) {
			$id = veri(get("sid"));
			$kriter = "AND style=$id";
			$limit = "";
		} else {
			$kriter = "";
			$limit = "LIMIT 0,10";
		}
		if(getisset("kr")) {
			$kr = veri("%{$_GET['kr']}%");
			$kr2 = veri("%".slug(get("kr"))."%");
			$kr3 = veri(get("kr"));
			$kr4 = veri(get("kr")."%");
			//e($kr2);
			$kriter = " AND (style LIKE $kr OR json LIKE $kr OR id LIKE $kr3 OR bag LIKE $kr2 OR json LIKE $kr2)";
			$limit = "LIMIT 0,10";
		}
		if(getisset("tarih")) {
			$yil = veri(get("tarih"),"sayi");
			$kriter = "AND YEAR(date)=YEAR($yil)";
			if(getesit("tarih","tumu")) {
				$kriter = "";
				$limit = "LIMIT 0,10";
			}
			if(getesit("tarih","buay")) {
				$kriter = "AND MONTH(date)=MONTH(NOW())";
				$limit = "";
			}
			if(getesit("tarih","buyil")) {
				$kriter = "AND YEAR(date)=YEAR(NOW())";
				$limit = "";
			}
			
		}
		
		?>
		<?php $siparisler = ksorgu("content","WHERE type='SİPARİŞ' AND uid = '$uid' $kriter ORDER BY id DESC $limit");
					while($s = kd($siparisler)) {
					siparis_item($s);
					} ?>
		<?php
		break;
		case "ADRESBILGI" :
		$slug = veri(get("aid"));
		$adres = kd(ksorgu("content","WHERE type='ADRES' AND uid = '$uid' AND slug= $slug"));
		$j = json_decode($adres['json'],true);
		?>
		<div class="col-xs-6"><div class="form-group"><input type="text" required name="adi" value="<?php @e($j['adi'])  ?>" placeholder="<?php e2("Adınız") ?>" id="" /></div></div>
		<div class="col-xs-6"><div class="form-group"><input type="text" required name="soyadi" value="<?php @e($j['soyadi'])  ?>" placeholder="<?php e2("Soyadınız") ?>" id="" /></div></div>
		<div class="col-xs-6"><div class="form-group"><input type="text" name="firma" value="<?php @e($j['firma'])  ?>" placeholder="<?php e2("Firma Ünvanı") ?>" id="" /></div></div>
		<div class="col-xs-6"><div class="form-group"><input type="text" required name="mail" value="<?php @e($u['mail'])  ?>" placeholder="<?php e2("Mail Adresi") ?>" id="" /></div></div>
		<div class="col-xs-12"><div class="form-group"><input type="text" name="adres" value="<?php @e($j['adres'])  ?>" required placeholder="<?php e2("Adresiniz") ?>" id="" /></div></div>
		<div class="col-xs-6"><div class="form-group"><input type="text" name="ilce" value="<?php @e($j['ilce'])  ?>" required placeholder="<?php e2("İlçe") ?>" id="" /></div></div>
		<div class="col-xs-6"><div class="form-group">
			<select  name="il" required id="">
				<option value="">İl</option>
			<?php $il = ksorgu("il","ORDER BY id ASC");
				while($i = kd($il)) {
			?>
				<option value="<?php e($i['il_adi']) ?>" <?php if($i['il_adi']==$j['il']) e("selected"); ?>><?php e($i['il_adi']) ?></option>
				<?php } ?>
			</select>
		</div></div>
		<div class="col-xs-6"><div class="form-group"><input type="text" name="vergi_no" value="<?php @e($j['vergi_no'])  ?>" placeholder="<?php e2("Vergi/Vatandaşlık Numarası") ?>" id="" /></div></div>
		<div class="col-xs-6"><div class="form-group"><input type="text" name="ulke" placeholder="<?php e2("Ülke") ?>" value="Türkiye" readonly id="" /></div></div>
		<div class="col-xs-6"><div class="form-group"><input type="text" name="telefon" value="<?php @e($j['telefon'])  ?>" placeholder="<?php e2("Telefon") ?>" id="" /></div></div>
		<div class="col-xs-6"><div class="form-group"><input type="text" name="faks" value="<?php @e($j['faks'])  ?>" placeholder="<?php e2("Faks") ?>" id="" /></div></div>
		<?php
		break;
		case "CREATE" : 
			$mail = veri(post("mail"));
			$varmi = ksorgu("uyeler","WHERE mail = $mail");
			if($varmi==0) {
				$sifre = randomPassword();
				//Bilgilerle üyeliği oluştur
				$id = dEkle("uyeler",array(
				"adi" => post("adi"),
				"soyadi" => post("soyadi"),
				"mail" => post("mail"),
				"sifre" => kripto($sifre),
				"ilk_sifre" => $sifre
				));
			
				//mevcut sepeti kullanıcıya ata
				dGuncelle("content",array(
					"uid" => $id
				),"uid = '$uid' AND type='SEPET'");
				oturum("uid",$id);
				yonlendir("profil");
			}
		break;
		case "LOGIN" :
			$mail = veri(post("mail"));
			$sifre = veri(kripto(post("sifre")));	
			$varmi = ksorgu("uyeler","WHERE mail = $mail AND sifre = $sifre");
			if($varmi!=0) {
				$u = kd($varmi);
				//mevcut sepeti kullanıcıya ata
				dGuncelle("content",array(
					"uid" => $u['id']
				),"uid = '$uid' AND type='SEPET'");
				oturum("uid",$u['id']);	
				if($u['ilk_sifre']=="") {
					yonlendir("profil");
				} else {
					yonlendir("sifre-degistir");
				}
			} else {
				yonlendir("giris");
			}
		break;
		case "SEPET_SIL" : 
			$id = veri(get("id"));
			sil("content","type='SEPET' and uid='$uid' AND bag = $id");
			$sepet = kd(sorgu("SELECT SUM(fiyat) AS toplam, COUNT(*) sayi FROM content WHERE type='SEPET' AND uid = '$uid'"));
			if($sepet['sayi']==0) {
				e("0");
			}
		break;
		case "SEPET_SIL2" : 
			$id = veri(get("id"));
			sil("content","type='SEPET' and uid='$uid' AND id = $id");
			$sepet = kd(sorgu("SELECT SUM(fiyat) AS toplam, COUNT(*) sayi FROM content WHERE type='SEPET' AND uid = '$uid'"));
			if($sepet['sayi']==0) {
				e("0");
			}
			e("ok");
			yonlendir("sepet");
		break;
		case "SEPET_ADD":
		$u = c(post("id"));
		
			dEkle("content",array(
				"kid" => "SEPET",
				"type" => "SEPET",
				"bag" => $u['slug'],
				"fiyat" => $u['fiyat'],
				"uid" => $uid,
				"date" => simdi()
			));
		break;
		case "SEPET_TOTAL" :
		$sepet = kd(sorgu("SELECT SUM(fiyat) AS toplam, COUNT(*) sayi FROM content WHERE type='SEPET' AND uid = '$uid'"));
			if($sepet['sayi']==0) {
				e2("Sepetinizde ürün yok");
			} else {
				$toplam = para($sepet['toplam']);
				e("{$sepet['sayi']} ürün(ler) - $toplam");
			}
		break;
		case "SEPET_MENU" :
		$sepet = sorgu("SELECT *,COUNT(bag) sayi FROM content WHERE type='SEPET' AND uid='$uid' GROUP BY bag");
		
		?>
		<script type="text/javascript">
		$(function(){
			$(".sil").click(function(){
				var n = $(this).parent().parent();
				var id = $(this).attr("data-id");
				$.get("core.php?ajax=SEPET_SIL",{
					id : id
				},function(d){
					n.remove();
					console.log(d);
					if(d.trim()=="0") {
						$("#cart >div").load("core.php?ajax=SEPET_MENU");
					}
					$("#cart-total").load("core.php?ajax=SEPET_TOTAL");
				});
				
			});
			
		});
		</script>
		<?php if($sepet!=0) { ?>
                    <ul class="dropdown-menu pull-right cart-dropdown-menu" style="
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.41);
    border: none;width: 440px;    max-width: 150%;">
					
                        <li>
                            <table class="table table-striped">
                                <tbody>
								<?php 
								$gtoplam=0;
								while($s = kd($sepet)) { 
									$u = c($s['bag']);
									 $gtoplam += $s['sayi'] * $s['fiyat'];
								?>
                                    <tr>
                                        <td class="text-center"><a href="#"><img class="img-thumbnail" title="Ürün Adı" alt="Ürün Adı" src="<?php r($u['pic'],60); ?>" style="width:60px"></a></td>
                                        <td class="text-left"><a href="#"><?php e($u['title']) ?></a></td>
                                        <td class="text-right">x <?php e($s['sayi']) ?></td>
                                        <td class="text-right"><i class="fa fa-try"></i><?php e($s['fiyat']) ?></td>
                                        <td class="text-center"><button class="btn btn-danger btn-xs sil" title="<?php e2("Sil") ?>" data-id="<?php e($s['bag']) ?>" type="button"><i class="fa fa-times"></i></button></td>
                                    </tr>
								<?php } ?>
                                </tbody>
                            </table>
                        </li>
                        <li>
                            <div class="cl-effect-3">
                                <table class="table table-bordered ">
                                    <tbody>
                                        <tr>
                                            <td class="text-right"><strong>Alt Toplam</strong></td>
                                            <td class="text-right"><?php e(para($gtoplam-$gtoplam*set("KDV","r")/100)); ?></td>
                                        </tr>
										<!--
                                        <tr>
                                            <td class="text-right"><strong>İskonto (-2,00)</strong></td>
                                            <td class="text-right"><i class="fa fa-try"></i>250,00</td>
                                        </tr>
										-->
                                        <tr>
                                            <td class="text-right"><strong>KDV (<?php set("KDV","r") ?>%)</strong></td>
                                            <td class="text-right"><?php echo para($gtoplam*set("KDV","r")/100); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Toplam</strong></td>
                                            <td class="text-right"><?php e(para($gtoplam)); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="text-right "> 
								<span class="btn-checkout"><a href="sepet"><strong><i class="fa fa-shopping-cart"></i> <?php e2("Sepete Git") ?></strong></a></span> 
								<span class="btn-checkout"><a href="checkout"><strong><i class="fa fa-share"></i> <?php e2("Alışverişi Tamamla") ?></strong></a></span> 
								</p>
                            </div>
                        </li>
					
                    </ul>
					<?php } ?>
		<?php
		break;
		case "SEARCH" :
			
			$kr = veri("%{$_GET['kr']}%");
			$kr2 = veri("%".slug(get("kr"))."%");
			$kr3 = veri(get("kr"));
			//e($kr);
			//print_R($_GET);
			$sorgu = ksorgu("content","WHERE 
				type IN('Ürün','Ürün Kategorisi','Ürün Grubu') 
				AND y=1
				AND 
					(
						title LIKE $kr OR 
						slug LIKE $kr2 OR 
						json LIKE $kr
					)
				GROUP BY slug
				ORDER BY case when title = $kr3 then 1 else 2 end,
				id ASC
				LIMIT 0,5
				");
				$json = array();
				$k = 0;
				//e($sorgu);
				while($s = kd($sorgu)) {
					//print_R($s);
					$json[$k]['title'] = $s['title'];
					$json[$k]['slug'] = $s['slug'];
					$json[$k]['type'] = $s['type'];
					$json[$k]['info'] = kelime(strip_tags(html_entity_decode($s['html'],ENT_QUOTES,"UTF-8")),10);
					if($s['pic']==""){
						$resim = "image/inter.jpg";
					} else {
						$resim = $s['pic'];
					}
					$json[$k]['pic'] = $resim;
					$k++;
				}
				$sorgu = ksorgu("feeds","WHERE (
					title LIKE $kr OR
					link LIKE $kr2 OR
					description LIKE $kr
				)
				ORDER BY case when title = $kr3 then 1 else 2 end, id ASC LIMIT 0,5 
				");
				while($s = kd($sorgu)) {
					//print_R($s);
					$json[$k]['title'] = $s['title'];
					$json[$k]['slug'] = $s['link'];
					$json[$k]['type'] = "Blog Yazısı";
					$json[$k]['info'] = kelime($s['description'],10);
					if($s['img']==""){
						$resim = "image/inter.jpg";
					} else {
						$resim = $s['img'];
					}
					$json[$k]['pic'] = $resim;
					$k++;
				}
				
				$json = json_encode($json);
				header('Content-Type: application/json');
				e($json);
		break;
	}
		
}
exit();
 ?>