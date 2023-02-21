<?php
//json update
$content = ksorgu("content","WHERE json IS NULL");
while($c = kd($content)) {
	cju2($c['slug']);
}

function geri($get){
	yonlendir("admin.php?$get");
}


function yenislug($kriter) {
	$slug = veri(slug($kriter));
	$varmi =ksorgu("content","WHERE slug=$slug");
	if($varmi==0) {
		return slug($kriter);
	} else {
		return slug($kriter.rand(0,999));
	}
}
if(getisset("tipEkle")) {
	
	post("slug",post("tip_ad"));
	dEkle("type",$_POST);
	geri("i=type");
}
if(getisset("tipSil")) {
	$id = veri(get("tipSil"));
	sil("type","id=$id");
	geri("i=type");
}
if(getisset("sablonEkle")) {
	dEkle("sablon",$_POST);
	geri("i=sablonlar");
}
if(getisset("sablonSil")) {
	$id = veri(get("sablonSil"));
	sil("sablon","id=$id");
	geri("i=sablonlar");
}
if(getisset("ara")) {
	$i = veri(post("search"));
	$varmi = ksorgu("content","WHERE slug = $i OR title=$i");
	if($varmi!=0) {
		$v =kd($varmi);
		$str="";
		$varmi2 = contents($v['slug']);
		if($varmi2==0) {
			$str="&guncelleform";
		}
		geri("i=sayfa&s={$v['slug']}$str");
	} else {
		$i = veri("%{$_POST['search']}%");
		$varmi = ksorgu("content","WHERE slug LIKE $i OR title LIKE $i");
		if($varmi!=0) {
						
		$v =kd($varmi);
		$varmi2 = contents($v['slug']);
			if($varmi2==0) {
				$str="&guncelleform";
			}
			geri("i=sayfa&s={$v['slug']}$str");
		}
	}
}
if(getisset("googleSonuc")) {
	$kriter = get("googleSonuc");
	if($kriter!="") {
		googleSearch($kriter);
		googleSearch($kriter,4);
		googleSearch($kriter,8);
	}
	exit();
}
if(getisset("kelimeSil")) {
	$i = veri(urldecode(get("kelimeSil")));
	$i2 = veri(get("id"));
	//e($i);
	$kim = kd(ksorgu("translate","WHERE id=$i2"));
	
	sil("translate","i=$i");
	sil("translate","i='{$kim['i']}'");
	exit();
}
//if(!oturumesit("Seviye2","Yonetici")) yonlendir("index.php");
if(getisset("sira")) {
	$id = veri(post("id"));
	e("$id :".post("index"));
	foreach($_POST['dizi'] AS $alan => $deger) {
		e(" : {$deger[0]}");
		dGuncelle("content",array(
			"s" => $alan
		),"id={$deger[0]}");
	}
	
	
	exit();
}
/*
if(getisset("sira")) {
	$id = veri(post("id"));
	e("$id :".post("index"));
	dGuncelle("content",array(
		"s" => post("index")
	),"id=$id");
	exit();
}
*/
function tumunuSil($slug) {
	if($slug!="") {
	$content = contents_admin($slug);
	if($content!=0) {
		while($c = kd($content)) {
			$varmi = ksorgu("content","WHERE pic='{$c['pic']}' AND id<>{$c['id']}"); //başkası bu görseli kullanıyor mu?
			if($varmi==0) {
				@unlink("file/{$c['pic']}");
			}
			sil("content","id={$c['id']}");
			tumunuSil($c['slug']);
		}
	}
	}
}
if(getisset("sifreGuncelle")) {
	$uid= oturum("uid");
	$sifre = veri(kripto(post("eskisifre")));
	$dogrumu=ksorgu("uyeler","WHERE id = $uid AND sifre = $sifre");
	if($dogrumu!=0):
	if($_POST['sifre']==$_POST['sifre2'] && $_POST['sifre']!="") {
		dGuncelle("uyeler",array(
			"sifre" => kripto(trim(post("sifre")))
		),
			"id=$uid"
		);
		oturum("sifreGuncelle","1");
	} else {
		oturum("sifreGuncelle","0");
	}
	else : 
		oturum("sifreGuncelle","-1");
	endif;
	$sonuc = 1;
	geri("i=profil");
}
if(getisset("altGuncelle")) {
	$cid = veri(post("cid"));
	$id = veri(post("id"));
	$geri = post("cid");
	$alan = veri(post("alan"));
	unset($_POST['cid']);
	dGuncelle("other",$_POST,"id=$id");
	cju($id);
	if($geri=="common_settings") {
		geri("i=ayarlar"); 
	} else {
		geri("i=sayfa&s=$geri&guncelleform#other");
	}
}
if(getisset("altSil")) {
	$id=veri(get("altSil"));
	$kim = kd(ksorgu("other","WHERE id = $id"));
	$diger = kd(ksorgu("other","WHERE cid = '{$kim['cid']}' AND id<>$id"));
	e($diger['id']);
	sil("other","id=$id");
	cju(veri($diger['id'])); //sildikten sonra diğer alanlarla json verisini güncelle
	e("success");
	exit();
}
if(getisset("bilgiGuncelle")) {
	$uid = oturum("uid");
	$mail = veri(post("mail"));
	$varmi = ksorgu("uyeler","WHERE mail = $mail AND id<>$uid"); //mail adresinin tekerrürünü engel
	if($varmi==0) :
	$_POST['user'] = kripto(post("mail"));
	dguncelle("uyeler",$_POST," id = $uid");
	$u = kd(ksorgu("uyeler","WHERE id =$uid"));
	oturum("pFiMail", $u['mail']);
	oturum("pFiUser", $u['user']);
	oturum("Seviye2",$u['seviye']);
	oturum("adi", $u['adi']);
	oturum("soyadi", $u['soyadi']);
		oturum("guncelleHata","0");
	else :
		oturum("guncelleHata","1");
	endif;
	$sonuc=1;
	geri("i=profil");
}
if(getisset("cogalt")) {
	$id = veri(get("cogalt"));
	$c = kd(content_admin(get("cogalt")));
	$c['slug'] = yenislug($c['title']); 
	$other = ksorgu("other","WHERE cid = $id"); //bu içeriğe ait diğer alt içerikler
	while($o =kd($other)) {
		$o['cid'] = $c['slug'];
		unset($o['id']);
		dEkle("other",array_filter($o));
	}
	unset($c['id']);
	print_R($c);
	print_r(array_filter($c));
	dEkle("content",array_filter($c));
	$icerik = contents_admin(get("cogalt"));
	while($i = kd($icerik)) {
		unset($i['id']);
		$i['slug'] = yenislug($i['title']);
		$i['kid'] = $c['slug'];
		dEkle("content",array_filter($i));
		$other = ksorgu("other","WHERE cid = '{$i['slug']}'"); //bu içeriğe ait diğer alt içerikler
		if($other!="") {
		while($o =kd($other)) {
			unset($o['id']);
			$o['cid'] = $i['slug'];
			dEkle("other",array_filter($o));
		}
		}
		
	}
	if($c['kid']!="") {
		geri("i=sayfa&s=".$c['kid']);
	} else {
		geri("i=icerikler");
	}
}
if(getisset("dilSil")) {
	$id = veri(get("dilSil"));
	sil("diller","id=$id");
}
if(getisset("yeniDilEkle")){
	
	$kisa = explode("-",post("kisa"));
	$kisa = $kisa[5];
	$_POST['kisa'] = $kisa;
	$dil = veri(post("kisa"));
	$kelimeler = ksorgu("translate","GROUP BY i");
	while($k = kd($kelimeler)) {
		$i = veri($k['i']);
		
		$varmi = ksorgu("translate","WHERE i=$i AND dil=$dil");
		if($varmi==0) {
		dEkle("translate",array(
			"i" => $k['i'],
			"dil" => post("kisa")
		));
		}
	}
	$varmi = ksorgu("diller","WHERE kisa=$dil");
	if($varmi==0) {
	dEkle("diller",$_POST);
	print_r($_POST);
	}
	geri("i=ceviri_tablo");
}
if(getisset("kelimeDetayGuncelle")) {
	$diller = ksorgu("diller");
	////$k = post("k");
	
	$_POST['k'] = urlencode(post("k"));
	while($d = kd($diller)) {
		$id = veri(post("id-".$d['kisa']));
		dGuncelle("translate",array(
			"dil" => $d['kisa'],
			"t" => post($d['kisa'])
		),"id = $id");
		e("ok ");
	}
	ob_start();
	geri("i=kelimeDetay&k={$_POST['k']}");
	print_r($_POST);
	exit();
}
if(getisset("ajax")) {
	switch ($_GET['ajax']) {
		case "siparis_detay" : 
		$s = c(get("id"));
		$json = json_decode($s['json'],true);
		//print_r($s);
		if($s['alt']=="") {
			$s['alt'] = "Onay Bekliyor";
		}
		?>
		<?php 
			
			$durum = kd(ksorgu("sablon","WHERE slug='Durum'"));
			$durum = explode(",",$durum['deger']);
			//print_r($durum);
		?>
		<div class="col-md-6">
			<p>Sipariş Kodu: <?php e($s['slug']) ?></p>
			<p>Müşteri: <?php uye_isim($s['uid']) ?></p>
			<p>Tarih: <?php e($s['date']) ?></p>
		</div>
		<div class="col-md-6" style="text-align:right;">
			<i class="fa fa-credit-card"></i> Ödeme Şekli: <?php 
			if($json['odeme']=="kk") e("Kredi Kartı"); else e("Havale");
			?>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th>Görsel</th>
					<th>Ürün Adı</th>
					<th>Fiyat</th>
				</tr>
			</thead>
			<tbody>
			<?php $urunler = ksorgu("content","WHERE style='{$s['style']}'"); ?>
			<?php while($u2 = kd($urunler)) { 
				$urun = c($u2['bag']); //Ürüne ait bilgiler
			?>
				<tr>
					<td><img src="<?php r($urun['pic'],64); ?>" style="width:64px" alt="" /></td>
					<td><?php e($urun['title']) ?></td>
					<td><?php e(para($u2['fiyat'])) ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<h4 style="text-align:right;font-size:18px;">Sipariş Tutarı: <?php echo para($json['total']) ?></h4>
		<?php //print_r($json); ?>
		<label for="">Sipariş Durumu: </label>
		<?php input_ajax("?ajax=input",".iduzenle"); ?>
		<select name="" id="" class="form-control iduzenle" tablo="content" d_alan="alt" s_alan="id" s_kriter="<?php e($s['id']) ?>">
			<option value="">Seçiniz</option>
		<?php 
			
			foreach($durum AS $d){
				$d = trim($d);
			?>
			<option value="<?php e($d) ?>" <?php if($s['alt']==$d) e("selected"); ?>><?php e($d) ?></option>
			<?php } ?>
		</select>
		<fieldset>
		<?php $a2 = $json; ?>
				<legend><?php e($s['title']) ?> Adres Bilgisi</legend>
				<div class="col-xs-12"><div class="form-group"><input type="text" class="form-control" name="adres" value="<?php @e($a2['adres']); ?>" placeholder="<?php e2("Adresiniz") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group"><input type="text" class="form-control" name="ilce" value="<?php @e($a2['ilce']); ?>" placeholder="<?php e2("İlçe") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group">
					<select  name="il" required class="form-control"id="">
						<option value="">İl</option>
					<?php $il = ksorgu("il","ORDER BY id ASC");
						while($i = kd($il)) {
					?>
						<option value="<?php e($i['il_adi']) ?>"  <?php if($i['il_adi']==@$a2['il']) e("selected"); ?>><?php e($i['il_adi']) ?></option>
						<?php } ?>
					</select>
				</div></div>
				<div class="col-xs-6"><div class="form-group"><input class="form-control" type="text" value="<?php @e($a2['vergi_no']); ?>" name="vergi_no" placeholder="<?php e2("Vergi/Vatandaşlık Numarası") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group"><input  class="form-control" type="text" value="<?php @e($a2['ulke']); ?>" name="ulke" placeholder="<?php e2("Ülke") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group"><input class="form-control" type="text" value="<?php @e($a2['telefon']); ?>" name="telefon" placeholder="<?php e2("Telefon") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group"><input class="form-control" type="text" value="<?php @e($a2['faks']); ?>" name="faks" placeholder="<?php e2("Faks") ?>" id="" /></div></div>
			</fieldset>
		<?php
		break;
		case "mail_kontrol" : 
			$mail = veri(get("mail"));
			$varmi = ksorgu("uyeler","WHERE mail = $mail");
			if($varmi==0) {
				return 0;
			} else {
				return 1;
			}
		break;
		case "uye_detay":
		
		if(getisset("guncelle")) {
			
			$kim = veri(get("guncelle"));
			post("sifre",kripto(post("ilk_sifre")));
			postGuncelle("uyeler","id=$kim");
			yonlendir("?i=uyeler");
		}
		if(getisset("adres_guncelle")) {
			$id = veri(get("adres_guncelle"));
			$json = json_encode($_POST);
			dGuncelle("content",array(
				"json" => $json
			),"id=$id");
			yonlendir("?i=uyeler");
		}
		$id = veri(get("id"));
		$u = u(get("id"));
		?>
		<form action="?ajax=uye_detay&guncelle=<?php e(get("id")); ?>" method="post">
		<fieldset>
			<legend>Kişisel Bilgiler</legend>
		
			<label for="">Adı: <input type="text" name="adi" required value="<?php e($u['adi']); ?>" id="" class="form-control" /></label>
			<label for="">Soyadı: <input type="text" name="soyadi" required value="<?php e($u['soyadi']); ?>" id="" class="form-control" /></label>
			<label for="">Mail Adresi: <input type="text" name="mail" required value="<?php e($u['mail']); ?>" id="mail" class="form-control" /></label>
			<div class="form-group">
			
			<label for="">Kurtarma Şifresi: </label><input type="text" name="ilk_sifre" value="<?php e($u['ilk_sifre']); ?>" id="ilk_sifre" class="form-control" /> <a href="#" style="    float: right;
    position: relative;
    top: -34px;" class="btn btn-primary" onclick="$('#ilk_sifre').val(Math.round(Math.random()*10000000000));"><i class="fa fa-refresh"></i></a>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Güncelle</button>
			</div>
		</fieldset>
		</form>
		<?php $adres = ksorgu("content","where type='ADRES' AND uid='{$u['id']}'"); ?>
		<?php while($a = kd($adres)) { 
		$a2 = json_decode($a['json'],true);
		?>
		<form action="?ajax=uye_detay&adres_guncelle=<?php e($a['id']) ?>" method="post">
			<fieldset>
				<legend><?php e($a['title']) ?> Adres Bilgisi</legend>
				<div class="col-xs-12"><div class="form-group"><input type="text" class="form-control" name="adres" value="<?php @e($a2['adres']); ?>" placeholder="<?php e2("Adresiniz") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group"><input type="text" class="form-control" name="ilce" value="<?php @e($a2['ilce']); ?>" placeholder="<?php e2("İlçe") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group">
					<select  name="il" required class="form-control"id="">
						<option value="">İl</option>
					<?php $il = ksorgu("il","ORDER BY id ASC");
						while($i = kd($il)) {
					?>
						<option value="<?php e($i['il_adi']) ?>"  <?php if($i['il_adi']==@$a2['il']) e("selected"); ?>><?php e($i['il_adi']) ?></option>
						<?php } ?>
					</select>
				</div></div>
				<div class="col-xs-6"><div class="form-group"><input class="form-control" type="text" value="<?php @e($a2['vergi_no']); ?>" name="vergi_no" placeholder="<?php e2("Vergi/Vatandaşlık Numarası") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group"><input  class="form-control" type="text" value="<?php @e($a2['ulke']); ?>" name="ulke" placeholder="<?php e2("Ülke") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group"><input class="form-control" type="text" value="<?php @e($a2['telefon']); ?>" name="telefon" placeholder="<?php e2("Telefon") ?>" id="" /></div></div>
				<div class="col-xs-6"><div class="form-group"><input class="form-control" type="text" value="<?php @e($a2['faks']); ?>" name="faks" placeholder="<?php e2("Faks") ?>" id="" /></div></div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary"><?php e($a['title']) ?> Adresini Güncelle</button>
				</div>
			</fieldset>
		</form>
		<?php } ?>
		<?php
		break;
		case "uye_ara" :
	//	header('Content-type: application/json');
			$kr = veri("%".get("kr")."%");
			$kr2 = veri("%".slug(get("kr"))."%");
			$kr3 = veri("%".get("kr")."%");
			$uyeler = ksorgu("uyeler","WHERE 
		
				(
					adi LIKE $kr OR 
					
					soyadi LIKE $kr OR 
					CONCAT_WS('', adi, soyadi) LIKE $kr

				) 
			ORDER BY id DESC 
			LIMIT 0,10");
			
		?>
		
		<?php while($u = kd($uyeler)) { ?>
			<tr>
				<td><?php e($u['adi']) ?></td>
				<td><?php e($u['soyadi']) ?></td>
				<td><?php e($u['mail']) ?></td>
				<td><a ajax_modal href="?ajax=uye_detay&id=<?php e($u['id']) ?>" class="btn btn-primary">Detay</a></td>
			</tr>
		<?php } ?>
		<?php
		break; ?>
		<?php
		case "urun_ara" :
	//	header('Content-type: application/json');
			$kr = veri("%".get("kr")."%");
			$kr2 = veri("%".slug(get("kr"))."%");
			$kr3 = veri("%".get("kr")."%");
			$urunler = ksorgu("content","WHERE 
			type IN ('Ürün','Ürün Grubu') 
			AND 
				(
					title LIKE $kr OR 
					
					fiyat LIKE $kr OR 
					kid LIKE $kr2 OR 
					slug LIKE $kr OR 
					json LIKE $kr3
				) 
			ORDER BY id DESC 
			LIMIT 0,10");
			
		?>
		
		<?php while($u = kd($urunler)) { ?>
			<tr>
				<td><img src="<?php r($u['pic'],64) ?>" style="width:64px" alt="" /></td>
				<td><a href="<?php url($u); ?>" target="_blank"><?php e($u['title']) ?></a></td>
				<td><?php cok($u['slug'],"H1") ?></td>
				<td><?php cok($u['slug'],"Title") ?></td>
				<td><?php e($u['fiyat']) ?></td>
				<td><a href="?i=sayfa&s=<?php e(cs($u['kid'])) ?>"><?php e(ct($u['kid'])) ?></a></td>
				<td><a href="?i=sayfa&s=<?php e($u['slug']) ?>&guncelleform" class="btn btn-primary"><i class="fa fa-link"></i></a></td>
			</tr>
		<?php } ?>
		<?php
		case "siparis_ara" :
	//	header('Content-type: application/json');
			$kr = veri("%".get("kr")."%");
			$kr2 = veri("%".slug(get("kr"))."%");
			$kr3 = veri("%".get("kr")."%");
			$urunler = ksorgu("content","WHERE 
			type IN ('SİPARİŞ') 
			AND 
				(
					title LIKE $kr OR 
					
					fiyat LIKE $kr OR 
					kid LIKE $kr2 OR 
					slug LIKE $kr OR 
					json LIKE $kr3
				) 
			ORDER BY id DESC 
			LIMIT 0,10");
			
		?>
		
		<?php while($u = kd($urunler)) { 
		$j = json_decode($u['json'],true);
		?>
			<tr>
							<td><?php e($u['style']); ?></td>
							<td><a href="?ajax=uye_detay&id=<?php e($u['uid']); ?>" ajax_modal><?php uye_isim($u['uid']) ?></a></td>
							<td><?php e(tt($u['date'])); ?> (<?php e(zf($u['date'])) ?>)</td>
							<td><?php @e(para($j['total'])); ?></td>
							<td>
								<?php $siparisler = ksorgu("content","WHERE style='{$u['style']}' ORDER BY id ASC"); 
								while($s = kd($siparisler)) {
									$urun  = c($s['bag']);
									e("<a href='?i=sayfa&s={$urun['slug']}&guncelleform' target='_blank'>{$urun['title']}</a> <br />");
								}
							?></td>
							<td>
							<?php ed($u['alt'],"Onay Bekliyor"); ?>
								
							</td>
							<td>
							
							<a href="?ajax=siparis_detay&id=<?php e($u['id']) ?>" ajax_modal class="btn btn-primary">Detay</a></td>
				</tr>
		<?php } ?>
		<?php
		break;
		case "kategori_ara" :
	//	header('Content-type: application/json');
			$kr = veri("%".get("kr")."%");
			$kr2 = veri("%".slug(get("kr"))."%");
			$kr3 = veri("%".get("kr")."%");
			$urunler = ksorgu("content","WHERE 
			type IN ('Ürün Kategorisi') 
			AND 
				(
					title LIKE $kr OR 
					
					fiyat LIKE $kr OR 
					kid LIKE $kr2 OR 
					slug LIKE $kr OR 
					json LIKE $kr3
				) 
			ORDER BY id DESC 
			LIMIT 0,10");
			
		?>
		
		<?php while($u = kd($urunler)) { ?>
			<tr>
				<td><?php if($u['pic']) { ?><img src="<?php r($u['pic'],64) ?>" style="width:64px" alt="" /><?php } ?></td>
				<td><a href="<?php url($u); ?>" target="_blank"><?php e($u['title']) ?></a></td>
				<td><a href="?i=sayfa&s=<?php e(cs($u['kid'])) ?>"><?php e(ct($u['kid'])) ?></a></td>
				<td><a href="?i=sayfa&s=<?php e($u['slug']) ?>&guncelleform" class="btn btn-primary"><i class="fa fa-link"></i></a></td>
			</tr>
		<?php } ?>
		<?php
		break;
		case "input" :
		if(oturumkontrol("Yonetici")) {
			$d_alan = post("d_alan");
			$s_kriter = post("s_kriter");
			$d_kriter = post("d_kriter");
			$tablo = post("tablo");
			print_r($_POST);
			dGuncelle($tablo,array(
							$d_alan => "$d_kriter"
					),"id = $s_kriter");
			
			switch($tablo) {
				case "other" :
					$veri = oc($s_kriter);
					
					cju($s_kriter);
					while($v = kd($veri)) {
						if($v['alan']=="Fiyatı") { cou($v['cid'],"fiyat",$v['deger']); }
						if($v['alan']=="Eski Fiyatı") { cou($v['cid'],"efiyat",$v['deger']); }
						if($v['alan']=="KDV") { cou($v['cid'],"kdv",$v['deger']); }
						if($v['alan']=="İskonto") { cou($v['cid'],"isk",$v['deger']); }
						if($v['alan']=="Taksitli Fiyatı") { cou($v['cid'],"tfiyat",$v['deger']); }
					}
		//			if($alanlar[$k]=="Taksitli Fiyatı") { post("tfiyat",$degerler[$k]); }
		//			if($alanlar[$k]=="Eski Fiyatı") { post("efiyat",$degerler[$k]); }
		//			if($alanlar[$k]=="KDV") { post("kdv",$degerler[$k]); }
		//			if($alanlar[$k]=="İskonto") { post("isk",$degerler[$k]); }
				break;
			}
			e("ok");
		}
		break;
		case "ozellikler" :
			$id = veri(get("id"));
			$sablon = kd(ksorgu("sablon","WHERE slug = $id")); 
			if($sablon['deger']!="") {$sablon = explode(",",$sablon['deger']); }else { $sablon="";}//print_r($sablon);
			?>
			<?php if($sablon!="") { ?>
			<table class="table">
				<thead>
					<tr>
						<th>Alan</th>
						<th>Değer</th>
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$k =0;
					foreach($sablon AS $alan) { ?>
						
						<?php if($alan!="") { ?>
						<?php if(trim($alan)=="İçerik Bağlantısı") { ?>
							<td><input type="text" name="alan[]" class="form-control" value="<?php e(trim($alan)) ?>" /></td>
							<td>
							<select name="deger[]"  id="" required class="form-control">
								<?php $co = ksorgu("content"); ?> 
									<option value="">Seçiniz</option>
								<?php while($c = kd($co)) { ?>
									<option value="<?php e($c['slug']) ?>"><?php if($c['kid']!="") e(ct($c['kid']) ." > "); ?> <?php e($c['title']) ?></option>
								<?php } ?>
							</select>
							</td>
						<?php } else { ?>
						<tr>
							<td><input type="text" name="alan[]" class="form-control" value="<?php e(trim($alan)) ?>" /></td>
							<td>
							<?php $alan = trim($alan); $deger = kd(ksorgu("sablon_deger","WHERE ozellik='$alan'"));
							$typene = ksorgu("sablon_type","WHERE  deger LIKE '%$alan%'");
								if($typene==0) {
									$t = "text";
								} else {
									$t = kd($typene);
									$t = $t['type'];
								}
							if($deger['deger']!="") {
								$degerler = explode(",",$deger['deger']);
								switch($t) {
									default:
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
									break;
									case "radio" : 
									?>
									<?php foreach($degerler AS $deger) { ?>
									<?php if($deger!="") { ?>
										<label><input type="radio" name="deger[<?php e($k) ?>]" value="<?php e(trim($deger)) ?>" id="" /><?php e(trim($deger)) ?></label>
									<?php } ?>
									<?php } ?>
									<?php
									$k++;
									break;
								}
								?>
								
								<?php
							} else {
								
								e('<input type="'.$t.'" step="0.01" name="deger[]" class="form-control"  id="" />');
							}
							?>
							
							</td>
						</tr>
						<?php } ?>
						<?php } ?>
						<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			<?php
		break;
	}
	exit();
}
if(getisset("altEkle")) {
	$adet = post("adet");
	for($k=1;$k<=$adet;$k++) {
	dEkle("other",array(
		"cid" => post("slug")
	));
	}
	if($_POST['slug']=="common_settings") {
		geri("i=ayarlar"); 
	} else {
		geri("i=sayfa&s={$_POST['slug']}&guncelleform#other");
	}
	
	
}

if(getisset("sil")) {
	$id = veri(get("sil"));
	$kim  =kd(ksorgu("content","WHERE id=$id"));
	$varmi = ksorgu("content","WHERE pic='{$kim['pic']}' AND id<>$id"); //başkası bu görseli kullanıyor mu?
	if($varmi==0) {
		@unlink("file/{$kim['pic']}");
	}
	tumunuSil($kim['slug']);
	sil("content","id=$id");
	if($kim['kid']=="") {
		yonlendir("admin?i=icerikler");
	} else {
		yonlendir("admin?i=sayfa&s={$kim['kid']}");
	}
	
	exit();
}
if(getisset("ekle")) {
	print_R($_POST);
	unset($_POST['serchfrom']);
	unset($_POST['serchcol']);
	if(postesit("title","")) {
		$title = "Adsız başlık ". rand(1111,9999);
		$_POST['title'] = $title;
		$_POST['slug'] = slug($title);
		
	}
	contentUpload("pic");
	if($_POST['pic']=="") {
		$resim = explode(",",post("pic2"));
		post("pic",$resim[0]);
	}
	//contentUpload("pic2");
	//postyukle("pic","file/");
	posttarih("date");
	$alanlar = $_POST['alan'];
	$degerler = $_POST['deger'];
	print_r($degerler);
	$toplam = count($alanlar);
	e($toplam);
	if($toplam!=0) {
	for($k=0;$k<$toplam;$k++) {
		if(trim(@$alanlar[$k])!="") {
		switch($alanlar[$k]) {
			case "Firma" : 
				$_POST['bag'] = trim($degerler[$k]);
			break;
			default:
			break;
		}
		if($alanlar[$k]=="Fiyatı") { post("fiyat",$degerler[$k]); }
		if($alanlar[$k]=="Taksitli Fiyatı") { post("tfiyat",$degerler[$k]); }
		if($alanlar[$k]=="Eski Fiyatı") { post("efiyat",$degerler[$k]); }
		if($alanlar[$k]=="KDV") { post("kdv",$degerler[$k]); }
		if($alanlar[$k]=="İskonto") { post("isk",$degerler[$k]); }
		dEkle("other",array(
			"cid" => post("slug"),
			"alan" => trim($alanlar[$k]),
			"deger" => trim($degerler[$k])
		));
		}
		
	}
	}
	unset($_POST['alan']);
	unset($_POST['deger']);
	
	/*$_POST['code'] = str_replace("<!--?php","<?php",$_POST['code']);
	$_POST['code'] = str_replace("?-->","?>",$_POST['code']);*/
	$_POST['tkid'] = hiyerarsisade($_POST['kid']);
	/*$type=content_type(post("kid"));
	if($type!="") {
	$_POST['type'] = $type ;
	}*/
	dGuncelle("content",array( // üst kategorinin slug değerini boşalt
		"type" => ""
	),"slug='{$_POST['kid']}'");
	e($_POST['type']);
	print_r($_POST);
	
	dEkle("content",$_POST);
	cju2(post("slug"));
	if(!postesit("kid","")) {
		geri("i=sayfa&s={$_POST['kid']}");
	} else {
		geri("i=icerikler");
	}
	
}
if(getisset("multiUpload")) {
	//print_r($_FILES['pics']);
	$a = array();
	for($k=0;$k<count($_FILES['pics']['tmp_name']);$k++) {
		$date=date_create(simdi());
		$link = date_format($date,"Y/m");
		dizin($link);
		//e($link);
		$isim = kripto($link.$_FILES['pics']['name'][$k].rand(11111,99999)); //benzersiz kriptolama
		//e($isim);
		$yer = "$link/$isim.jpg";
		//e($yer);
		if(move_uploaded_file($_FILES['pics']['tmp_name'][$k], "file/$yer")) {
		//	e("ok");
		array_push($a,$yer);
		}
	}
	e(json_encode($a));
	exit();
	
}

if(getisset("autocomplete")) {
	$kriter = veri("%".trim(strip_tags($_GET['term']))."%");
	$sorgu = ksorgu("galerikategori","WHERE isim LIKE $kriter");
	$k=0;
	while($s = kd($sorgu)) {
		$dizi[$k]['value']=$s['isim'];
		$dizi[$k]['id']=(int)$s['id'];
		$k++;
	}
	//print_r($dizi);
	echo json_encode($dizi);
	exit();
}
if(getisset("resimKaldir")) {
	$id = veri(get("resimKaldir"));
	dGuncelle("content",array(
		"pic" => ""
	),"slug = $id");
	geri("i=sayfa&s={$_GET['resimKaldir']}");
}
if(getisset("resimKaldir2")) {
	$id = veri(get("resimKaldir2"));
	dGuncelle("content",array(
		"pic2" => ""
	),"slug = $id");
	geri("i=sayfa&s={$_GET['resimKaldir']}");
}
if(getisset("guncelle")) {
	contentUpload("pic");
	//contentUpload("pic2");
	posttarih("date");
	unset($_POST['serchfrom']);
	unset($_POST['serchcol']);
	$id = veri(get("guncelle"));
	dGuncelle("content",$_POST,"slug=$id");
	//alt seviyedekileri de güncelle
	dGuncelle("content",array(
		"kid" => post("slug")
	),"kid=$id");
		geri("i=sayfa&s={$_POST['slug']}&guncelleform");
	//other ları da güncelle
	dGuncelle("other",array(
		"cid" => post("slug")
	),"cid=$id");
	cju2(post("slug"));
	
}
if(getisset("yayin")) {
	$d = veri(get("yayin"),"sayi");
	$id = veri(get("id"));
	print_r($_GET);
	dGuncelle("content",array(
		"y" => $d
	),"id=$id");
	exit();
}
if(getisset("slug")) {
	$slug = veri(slug(post("deger")));
	$varmi =ksorgu("content","WHERE slug=$slug");
	if($varmi==0) {
		e(slug(post("deger")));
	} else {
		e(slug(post("deger").rand(0,999)));
	}
	exit();
}
 ?>