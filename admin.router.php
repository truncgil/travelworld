<?php 
$depo = "aa/lib/elfinder/files/";
oturumAc();
if(getisset("table")) {
	oturum("table","table");
} 
if(getisset("tablesil")) {
	oturumSil("table");
} 
$i = get("i");
		switch($i) {
			case "siparisler" :
				bbaslik("Siparişler","Sitede Yer Alan Tüm Üyeler");
				$siparis = ksorgu("content","where type='SİPARİŞ' GROUP BY style ORDER BY id DESC");
				?>
				<input type="text" id="ara" placeholder="Ara..." class="form-control" />
				<script type="text/javascript">
				$(function(){
					$("#ara").keyup(function(){
						var input = $(this).val();
						console.log(input);
						//input = encodeURIComponent(input);
						input = input.replace("ı", "\\u0131").replace("İ", "\\u0130")
						.replace("ü", "\\u00FC").replace("Ü", "\\u00DC")
						.replace("ö", "\\u00F6").replace("Ö", "\\u00D6")
						.replace("ğ", "\\u011F").replace("Ğ", "\\u011E")
						.replace("ş", "\u015F").replace("Ş", "\\u015E")
						.replace("ç", "\\u00E7").replace("Ç", "\\u00C7")
						console.log(input);
						$("table tbody").load("?ajax=siparis_ara&&kr2="+encodeURIComponent(input.toLowerCase())+"&kr="+encodeURIComponent($(this).val()),function(){
							//alert("asd");
							$("[ajax_modal]").click(function(){
								var url = $(this).attr("href");
								$.get(url,function(d){
									$("#modal .modal-body").html(d);
									console.log(d);
									//trigger();
									
								})
								$("#modal").modal();
								return false;
							});
						}); //JSON.stringify(d),
					});
				});
				</script>
				<table class="table">
					<thead>
						<tr>
							<th>Sipariş Kodu</th>
							<th>Müşteri</th>
							<th>Tarih</th>
							<th>Sipariş Tutarı</th>
							<th>Ürün(ler)</th>
							<th>Durum</th>
							<th>İşlem</th>
						</tr>
					</thead>
					<tbody>
						<?php while($u = kd($siparis)) { 
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
					</tbody>
				</table>
				<?php
			break;
			case "uyeler" :
				bbaslik("Üyeler","Sitede Yer Alan Tüm Üyeler");
				$uyeler = ksorgu("uyeler","ORDER BY id DESC");
				?>
				<input type="text" id="ara" placeholder="Ara..." class="form-control" />
				<script type="text/javascript">
				$(function(){
					$("#ara").keyup(function(){
						var input = $(this).val();
						console.log(input);
						//input = encodeURIComponent(input);
						input = input.replace("ı", "\\u0131").replace("İ", "\\u0130")
						.replace("ü", "\\u00FC").replace("Ü", "\\u00DC")
						.replace("ö", "\\u00F6").replace("Ö", "\\u00D6")
						.replace("ğ", "\\u011F").replace("Ğ", "\\u011E")
						.replace("ş", "\u015F").replace("Ş", "\\u015E")
						.replace("ç", "\\u00E7").replace("Ç", "\\u00C7")
						console.log(input);
						$("table tbody").load("?ajax=uye_ara&&kr2="+encodeURIComponent(input.toLowerCase())+"&kr="+encodeURIComponent($(this).val()),function(){
							//alert("asd");
							$("[ajax_modal]").click(function(){
								var url = $(this).attr("href");
								$.get(url,function(d){
									$("#modal .modal-body").html(d);
									console.log(d);
									//trigger();
									
								})
								$("#modal").modal();
								return false;
							});
						}); //JSON.stringify(d),
					});
				});
				</script>
				<table class="table">
					<thead>
						<tr>
							<th>Adı</th>
							<th>Soyadı</th>
							<th>Mail Adresi</th>
							<th>İşlem</th>
						</tr>
					</thead>
					<tbody>
						<?php while($u = kd($uyeler)) { ?>
						<tr>
							<td><?php e($u['adi']) ?></td>
							<td><?php e($u['soyadi']) ?></td>
							<td><?php e($u['mail']) ?></td>
							<td><a href="?ajax=uye_detay&id=<?php e($u['id']) ?>" ajax_modal class="btn btn-primary">Detay</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php
			break;
			case "urunler":
				bbaslik("Ürünler","Sitede Yer Alan Tüm Ürünler");
				$urunler = ksorgu("content","WHERE type IN ('Ürün','Ürün Grubu') GROUP BY slug ORDER BY id DESC LIMIT 0,10");
				
			?>
				
				<input type="text" id="ara" placeholder="Ara..." class="form-control" />
				<script type="text/javascript">
				$(function(){
					$("#ara").keyup(function(){
						var input = $(this).val();
						console.log(input);
						//input = encodeURIComponent(input);
						input = input.replace("ı", "\\u0131").replace("İ", "\\u0130")
						.replace("ü", "\\u00FC").replace("Ü", "\\u00DC")
						.replace("ö", "\\u00F6").replace("Ö", "\\u00D6")
						.replace("ğ", "\\u011F").replace("Ğ", "\\u011E")
						.replace("ş", "\u015F").replace("Ş", "\\u015E")
						.replace("ç", "\\u00E7").replace("Ç", "\\u00C7")
						console.log(input);
						$("table tbody").load("?ajax=urun_ara&&kr2="+encodeURIComponent(input.toLowerCase())+"&kr="+encodeURIComponent($(this).val())); //JSON.stringify(d),
					});
				});
				</script>
				<table class="table">
					<thead>
						<tr>
							<th>Resim</th>
							<th>Ürün Adı</th>
							<th>H1</th>
							<th>Title</th>
							<th>Fiyatı</th>
							<th>Kategorisi</th>
							<th>İşlem</th>
						</tr>
					</thead>
					<tbody>
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
					</tbody>
				</table>
			<?php
			break;
			case "kategoriler":
				bbaslik("Kategoriler","Sitede Yer Alan Tüm Kategoriler");
				$urunler = ksorgu("content","WHERE type IN ('Ürün Kategorisi') GROUP BY slug ORDER BY id DESC LIMIT 0,10");
				
			?>
				
				<input type="text" id="ara" placeholder="Ara..." class="form-control" />
				<script type="text/javascript">
				$(function(){
					$("#ara").keyup(function(){
						var input = $(this).val();
						console.log(input);
						//input = encodeURIComponent(input);
						input = input.replace("ı", "\\u0131").replace("İ", "\\u0130")
						.replace("ü", "\\u00FC").replace("Ü", "\\u00DC")
						.replace("ö", "\\u00F6").replace("Ö", "\\u00D6")
						.replace("ğ", "\\u011F").replace("Ğ", "\\u011E")
						.replace("ş", "\u015F").replace("Ş", "\\u015E")
						.replace("ç", "\\u00E7").replace("Ç", "\\u00C7")
						console.log(input);
						$("table tbody").load("?ajax=kategori_ara&&kr2="+encodeURIComponent(input.toLowerCase())+"&kr="+encodeURIComponent($(this).val())); //JSON.stringify(d),
					});
				});
				</script>
				<table class="table">
					<thead>
						<tr>
							<th>Resim</th>
							<th>Kategori Adı</th>
							<th>Kategorisi</th>
							<th>İşlem</th>
						</tr>
					</thead>
					<tbody>
					<?php while($u = kd($urunler)) { ?>
						<tr>
							<td><?php if($u['pic']!="") { ?><img src="<?php r($u['pic'],64) ?>" style="width:64px" alt="" /><?php } ?></td>
							<td><a href="<?php url($u); ?>" target="_blank"><?php e($u['title']) ?></a></td>
							<td><a href="?i=sayfa&s=<?php e(cs($u['kid'])) ?>"><?php e(ct($u['kid'])) ?></a></td>
							<td><a href="?i=sayfa&s=<?php e($u['slug']) ?>&guncelleform" class="btn btn-primary"><i class="fa fa-link"></i></a></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			<?php
			break;
			case "yayin" :
			$icerik = ksorgu("content","WHERE y=0 AND bag IS NOT NULL")
				?>
				<div class="row drags">
				<?php while($i = kd($icerik)) { ?>			
					<?php 
						col("col-md-6 col-sm-12",$i);
					 ?>
				<?php } ?>
				</div>
				<?php
			break;
			case "type" : 
				bbaslik("İçerik Tipleri","Bu sayfada bir içerik kategorisine ait alt içeriklerin tiplerini belirtebilirsiniz");
				?>
					<form action="?tipEkle" method="post">
						<div class="row">

							<div class="col-md-12">
								<label for="">Tip Adı</label>
								<input type="text" class="form-control"  required name="tip_ad" id="" />
							</div>
							</div>
							<div class="row">
							<div class="col-md-12">
							
								<button clasS="btn btn-primary" type="submit">Ekle</button>
							</div>
							</div>
						</form>
						<div class="row">
						<?php $type = ksorgu("type","ORDER BY id DESC"); ?>
						<?php if($type!=0) { ?>
						<table class="table">
							<thead>
								<tr>
									<th>İçerik Tipi</th>
									<th>İşlem</th>
								</tr>
							</thead>
							<tbody>
						<?php while($s = kd($type)) { ?>
								<tr>
									
									<td><input type="text" class="iduzenle form-control"  tablo="type" d_alan="tip_ad" value="<?php e($s['tip_ad']) ?>" s_alan="id" s_kriter="<?php e($s['id']) ?>"  required name="deger" id="" /></td>
									<td><a href="?tipSil=<?php e($s['id']) ?>" teyit="Bu içerik tipini silmek istediğinizden emin misiniz?" class="btn btn-primary"><i class="fa fa-trash"></i></a></td>
								</tr>
						<?php } ?>
							</tbody>
						</table>
						<?php } ?>
						</div>
				<?php
			break;
			case "degerler" :
				bbaslik("Özellik Değerleri","Bu sayfada bir özelliğe ait alınabilecek değerleri oluşturabilirsiniz. Her değeri virgül ile ayırınız (Örn. kırmızı, mavi, yeşil)");
				?>
				<div class="row">
						<?php $sablon = ksorgu("sablon","ORDER BY id DESC"); ?>
						<?php while($s = kd($sablon)) { 
							$ozellik = explode(",",$s['deger']);
							foreach($ozellik AS $deger) {
								$deger = trim($deger);
								$varmi = ksorgu("sablon_deger","WHERE ozellik = '$deger'");
								if($varmi==0) {
									dEkle("sablon_deger",array(
										"ozellik" => $deger
									));
								}
							}
						}
						?>
						<?php $sablon_deger = ksorgu("sablon_deger","ORDER BY id DESC"); ?>
						<table class="table">
							<thead>
								<tr>
									<th width="40%">Özellikler</th>
									<th>Değerleri</th>
								</tr>
							</thead>
							<tbody>
						
						<?php while($s = kd($sablon_deger)) { ?>
								<tr>
									<td>
									<?php e($s['ozellik']) ?>
									</td>
									<td><input type="text" data-role="tagsinput" class="iduzenle form-control"  tablo="sablon_deger" d_alan="deger" value="<?php e($s['deger']) ?>" s_alan="id" s_kriter="<?php e($s['id']) ?>"  required name="deger" id="" /></td>
								</tr>
						<?php } ?>
							</tbody>
						</table>
						</div>
				<?php
			break;
			case "sablonlar" :
				bbaslik("Özellikler Şablonu","Bu sayfada bir içerik türüne ait alt özellikler şablonu oluşturabilir, özellikler formuna otomatik alan oluşturulmasını sağlayabilirsiniz");
				?>
					
						<?php col2("col-md-12"); ?>
						<div class="row">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#kategori">İçerik Kategorisine Göre</a></li>
							<li href=""><a data-toggle="tab" href="#tur">İçerik Türüne Göre</a></li>
						</ul>
						<div class="tab-content">
							<div id="kategori" class="tab-pane fade in active">
								<div class="row">
									<form action="?sablonEkle" method="post">
									<div class="col-md-3">
									<label for="">Şablonun uygulanacağı içerik kategorisi URL değeri</label>
									<input type="text" name="slug" class="form-control" />
									
									</div>
									<div class="col-md-9">
										<label for="">Alt Özellikler (Her Özelliği Virgülle ayırın)</label>
										<input type="text" class="form-control"  required name="deger" id="" />
									</div>
									<div class="col-md-12 form-group">
									<hr />
									<button clasS="btn btn-primary" type="submit">Ekle</button>
									</div>
									</form>
								</div>
							</div>
							<div id="tur" class="tab-pane fade in">
								<div class="row">
									<form action="?sablonEkle" method="post">
									<div class="col-md-3">
									<label for="">Şablonun uygulanacağı içerik türü</label>
									<select name="slug"  id="" required class="form-control">
									<?php $co = ksorgu("type"); ?> 
										<option value="">Seçiniz</option>
									<?php while($c = kd($co)) { ?>
										<option value="<?php e($c['slug']) ?>"><?php e($c['tip_ad']) ?></option>
									<?php } ?>
									</select>
									</div>
									<div class="col-md-9">
										<label for="">Alt Özellikler (Her Özelliği Virgülle ayırın)</label>
										<input type="text" class="form-control"  required name="deger" id="" />
									</div>
									<div class="col-md-12 form-group">
									<hr />
									<button clasS="btn btn-primary" type="submit">Ekle</button>
									</div>
									</form>
								</div>
							</div>
						</div>
							</div>
							<?php _col2(); ?>
							<div class="row">
							<div class="col-md-12">
							
								
							</div>
							</div>
						
						<div class="row">
						<?php $sablon = ksorgu("sablon","ORDER BY id DESC"); ?>
						<?php if($sablon!=0) { ?>
						<table class="table">
							<thead>
								<tr>
									<th width="40%">İçerik Kategorisi / Türü</th>
									<th>Özellikler</th>
									<th>İşlem</th>
								</tr>
							</thead>
							<tbody>
						<?php while($s = kd($sablon)) { ?>
								<tr>
									<td>
									<input type="text" class="iduzenle form-control"  tablo="sablon" d_alan="slug" value="<?php e($s['slug']) ?>" s_alan="id" s_kriter="<?php e($s['id']) ?>"  required name="slug" id="" />
									</td>
									<td><input type="text" class="iduzenle form-control"  tablo="sablon" d_alan="deger" value="<?php e($s['deger']) ?>" s_alan="id" s_kriter="<?php e($s['id']) ?>"  required name="deger" id="" /></td>
									<td><a href="?sablonSil=<?php e($s['id']) ?>" teyit="Bu şablonu silmek istediğinizden emin misiniz?" class="btn btn-primary"><i class="fa fa-trash"></i></a></td>
								</tr>
						<?php } ?>
							</tbody>
						</table>
						<?php } ?>
						</div>
							
				<?php
			break;
			case "ayarlar":
			bbaslik("Site Ayarları","Bu sayfada çalışmaya ait genel ayar değişkenlerini oluşturabilirsiniz.");
			?>
				<div class="row">
					<?php col2("col-md-12","Ayar Bilgisi Tablosu"); ?>
						<form action="?altEkle" method="post">
						<div class="col-md-4">
						<input type="hidden" name="slug" value="common_settings" />
						<select class="form-control" name="adet" id="adet">
						<?php for($k=1;$k<=10;$k++) { ?>
							<option value="<?php e($k) ?>"><?php e($k) ?></option>
						<?php } ?>
						</select>
						</div>
						<div class="col-md-4">
						<button class="btn btn-primary" type="submit"> Adet Yeni Ayar Bilgisi Ekle <i class="fa fa-plus"></i> </button>
						</div>
						</form>
					<table class="table">
						<thead>
							<tr>
								<th>Alan</th>
								<th>Değer</th>
								<th>İşlem</th>
							</tr>
						</thead>
						<tbody>
							<?php $other = ksorgu("other","WHERE cid = 'common_settings'"); ?>
							<?php while($o = kd($other)) { ?>
							<tr id="id-<?php e($o['id']) ?>">
								<td><input type="text" tablo="other" d_alan="alan" s_kriter="<?php e($o['id']) ?>" class="form-control iduzenle" value="<?php e2($o['alan']) ?>" /></td>
								<td>
								<?php if(isHTML($o['deger'])) { ?>
								<a class="btn btn-primary" href="?i=altDuzenle&id=<?php e($o['id']) ?>" title="Bu özelliği daha önce HTML olarak düzenlediniz."><i class="fa fa-code"></i></a>
								<?php } else { ?>
								<input type="text" tablo="other" d_alan="deger" s_kriter="<?php e($o['id']) ?>" class="form-control iduzenle" value="<?php e2(strip_tags($o['deger'])) ?>" />
								<?php } ?>
								</td>
								
								<td>
									<a href="?altSil=<?php e($o['id']) ?>" teyit="Bu bilgiyi kalıcı olarak kaldırmak istediğinizden emin misiniz?" ajax="#id-<?php e($o['id']) ?>" class="btn btn-primary"><i class="fa fa-trash"></i></a>
									<a title="Metin editörünü kullanarak düzenle" href="?i=altDuzenle&id=<?php e($o['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
									<a title="Metin editörü olmadan düzenle" href="?i=altDuzenle&id=<?php e($o['id']) ?>&noEditor" class="btn btn-primary"><i class="fa fa-code"></i></a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<?php _col2(); ?>
				</div>
			<?php
			break;
			case "altDuzenle" :
			$id = veri(get("id"));
			$i = kd(ksorgu("other","WHERE id=$id"));
			bbaslik("{$i['alan']} Alt İçeriğini Detaylı Düzenle"
			,"Bu alanda {$i['alan']} içeriğini detaylı olarak düzenleyebilirsiniz."
			);
			?>	<?php col2("col-md-9","Düzenleme Formu"); ?>
				<form action="?altGuncelle" method="post">
				<input type="hidden" name="cid" value="<?php e($i['cid']); ?>" />
				<input type="hidden" name="id" value="<?php e($i['id']); ?>" />
				<div class="row">
					<label for="">
						Alan: </label>
					<input type="text" class="form-control" name="alan" value="<?php e($i['alan']) ?>" id="" />
						<label for="">
						Değer: </label>
						<textarea name="deger" id="editor" onkeyup="guncelle()" cols="30" rows="10" class="<?php if(getisset("noEditor")) { e("form-control"); } else { e("ckeditor"); } ?>"><?php e($i['deger']) ?></textarea>
					</div>
					<div class="row">
						<?php bbaslik("<i class='fa fa-eye'></i> Önizleme") ?>
						<div class="onizle">
							<?php e($i['deger']); ?>
							<div class="clear"></div>
						</div>
					</div>
					<div class="row">
						<button class="btn btn-primary" type="submit">Güncelle</button>
					</div>
				</form>
				<?php if(getisset("noEditor")) { ?>
					<script>
					$(function(){				
					var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
						lineNumbers: true
					});
					editor.on("keydown", function(e){
						$(".onizle").html(e.getValue());
					});
					});
					</script>
				<?php } ?>
				<?php _col2(); ?>
				<?php col2("col-md-3","Diğer Alanlar"); ?>
				<?php 
				$diger = ksorgu("other","WHERE cid='{$i['cid']}' AND alan IS NOT NULL");
				while($d = kd($diger)) { ?>
					<div class="row"><a class="btn btn-primary col-md-12" href="?i=altDuzenle&id=<?php e($d['id']) ?>"><?php e($d['alan']) ?></a></div>
				<?php } ?>
				<?php _col2(); ?>
			<?php 
			break;
			case "profil" :
				$k = kd(kSorgu("uyeler",sprintf("WHERE id = %s",oturum("uid"))));
				bbaslik("Profil Ayarları","Bu bölümden hesabınızla ilgili profil ayarlarını yapılandırabilirsiniz.");
			?>
			
				<?php col2("col-md-6","Bilgileriniz") ?>
				<form action="?bilgiGuncelle" method="post">
				<?php if(oturumisset("guncelleHata")) { alert("Bilgiler Güncellendi");  oturumSil("guncelleHata");} ?>
					<div class="row"><label for="">Mail Adresi:</label><input type="mail" value="<?php e($k['mail']) ?>"  class="form-control" name="mail" id="" /></div>
					<div class="row"><label for="">Adı:</label><input type="text" value="<?php e($k['adi']) ?>"  class="form-control" name="adi" id="" /></div>
					<div class="row"><label for="">Soyadı:</label><input type="text" value="<?php e($k['soyadi']) ?>"  class="form-control" name="soyadi" id="" /></div>
					<button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i> Güncelle</button>
				</form>
				<?php _col2(); ?>
				<?php col2("col-md-6","Şifre Değiştir") ?>
				<form action="?sifreGuncelle" method="post">
				<?php if(oturumisset("sifreGuncelle")) { 
				if(oturumesit("sifreGuncelle","-1")) {
					alert("Eski şifrenizi hatalı girdiniz");
				} else {
					alert("Şifre Güncellendi");  oturumSil("sifreGuncelle");
				}
				} ?>
					<div class="row"><label for="">Eski Şifreniz:</label><input type="password" class="form-control" name="eskisifre" id="" /></div>
					<div class="row"><label for="">Şifreniz:</label><input type="password" class="form-control" name="sifre" id="" /></div>
					<div class="row"><label for="">Şifreniz (Tekrar):</label><input type="password" class="form-control" name="sifre2" id="" /></div>
					<button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i> Güncelle</button>
				</form>
				<?php _col2(); ?>
			
			<?php
			break;
			case "yeniDil" :
				bbaslik("Yeni Dil Ekle");
			?>
				<div class="row">
					<div class="col-md-6">
					<?php col2("col-md-12","Dil Ekleme Formu"); ?>
					<script type="text/javascript">
						$(function(){
							$(".flag").click(function(){
								$(".simge").attr("class","simge");
								$(".simge").addClass($(this).attr("class"));
								$("#kisa").val($(this).attr("class"));
							});
							$("#dilf").submit(function(){
								if($("#kisa").val()=="") {
									alert("Lütfen bir bayrak seçimi yapınız");
									return false;
								} else {
									return true;
								}
								
							});
						});
					</script>
						<form action="?yeniDilEkle" method="post" id="dilf">
							<div class="col-md-3"><div class="flag-wrapper"><div class="simge"></div></div></div>
							<div class="col-md-9">
							<div class="row">
								<input type="hidden" name="kisa" id="kisa" required />
								<label for="">Dil Adı (Görünen Ad:)<input type="text" name="isim" required class="form-control" /></label>
							</div>
							<div class="row">
								<button type="submit" class="btn btn-primary">Ekle</button>
							</div>
							</div>
						</form>
					<?php _col2(); ?>
					</div>
					<div class="col-md-6">
					<?php col2("Yeni Dil Ekle","Seçilebilir Bayraklar"); ?>
					<div class="row">
							
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ad" title="ad" id="ad"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ae" title="ae" id="ae"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-af" title="af" id="af"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ag" title="ag" id="ag"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ai" title="ai" id="ai"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-al" title="al" id="al"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-am" title="am" id="am"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ao" title="ao" id="ao"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-aq" title="aq" id="aq"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ar" title="ar" id="ar"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-as" title="as" id="as"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-at" title="at" id="at"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-au" title="au" id="au"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-aw" title="aw" id="aw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ax" title="ax" id="ax"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-az" title="az" id="az"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ba" title="ba" id="ba"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bb" title="bb" id="bb"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bd" title="bd" id="bd"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-be" title="be" id="be"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bf" title="bf" id="bf"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bg" title="bg" id="bg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bh" title="bh" id="bh"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bi" title="bi" id="bi"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bj" title="bj" id="bj"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bl" title="bl" id="bl"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bm" title="bm" id="bm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bn" title="bn" id="bn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bo" title="bo" id="bo"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bq" title="bq" id="bq"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-br" title="br" id="br"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bs" title="bs" id="bs"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bt" title="bt" id="bt"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bv" title="bv" id="bv"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bw" title="bw" id="bw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-by" title="by" id="by"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-bz" title="bz" id="bz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ca" title="ca" id="ca"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cc" title="cc" id="cc"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cd" title="cd" id="cd"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cf" title="cf" id="cf"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cg" title="cg" id="cg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ch" title="ch" id="ch"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ci" title="ci" id="ci"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ck" title="ck" id="ck"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cl" title="cl" id="cl"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cm" title="cm" id="cm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cn" title="cn" id="cn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-co" title="co" id="co"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cr" title="cr" id="cr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cu" title="cu" id="cu"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cv" title="cv" id="cv"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cw" title="cw" id="cw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cx" title="cx" id="cx"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cy" title="cy" id="cy"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-cz" title="cz" id="cz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-de" title="de" id="de"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-dj" title="dj" id="dj"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-dk" title="dk" id="dk"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-dm" title="dm" id="dm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-do" title="do" id="do"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-dz" title="dz" id="dz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ec" title="ec" id="ec"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ee" title="ee" id="ee"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-eg" title="eg" id="eg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-eh" title="eh" id="eh"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-er" title="er" id="er"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-es" title="es" id="es"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-et" title="et" id="et"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-fi" title="fi" id="fi"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-fj" title="fj" id="fj"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-fk" title="fk" id="fk"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-fm" title="fm" id="fm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-fo" title="fo" id="fo"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-fr" title="fr" id="fr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ga" title="ga" id="ga"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gb" title="gb" id="gb"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gd" title="gd" id="gd"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ge" title="ge" id="ge"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gf" title="gf" id="gf"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gg" title="gg" id="gg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gh" title="gh" id="gh"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gi" title="gi" id="gi"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gl" title="gl" id="gl"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gm" title="gm" id="gm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gn" title="gn" id="gn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gp" title="gp" id="gp"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gq" title="gq" id="gq"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gr" title="gr" id="gr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gs" title="gs" id="gs"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gt" title="gt" id="gt"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gu" title="gu" id="gu"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gw" title="gw" id="gw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-gy" title="gy" id="gy"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-hk" title="hk" id="hk"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-hm" title="hm" id="hm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-hn" title="hn" id="hn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-hr" title="hr" id="hr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ht" title="ht" id="ht"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-hu" title="hu" id="hu"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-id" title="id" id="id"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ie" title="ie" id="ie"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-il" title="il" id="il"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-im" title="im" id="im"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-in" title="in" id="in"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-io" title="io" id="io"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-iq" title="iq" id="iq"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ir" title="ir" id="ir"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-is" title="is" id="is"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-it" title="it" id="it"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-je" title="je" id="je"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-jm" title="jm" id="jm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-jo" title="jo" id="jo"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-jp" title="jp" id="jp"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ke" title="ke" id="ke"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-kg" title="kg" id="kg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-kh" title="kh" id="kh"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ki" title="ki" id="ki"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-km" title="km" id="km"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-kn" title="kn" id="kn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-kp" title="kp" id="kp"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-kr" title="kr" id="kr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-kw" title="kw" id="kw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ky" title="ky" id="ky"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-kz" title="kz" id="kz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-la" title="la" id="la"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-lb" title="lb" id="lb"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-lc" title="lc" id="lc"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-li" title="li" id="li"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-lk" title="lk" id="lk"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-lr" title="lr" id="lr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ls" title="ls" id="ls"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-lt" title="lt" id="lt"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-lu" title="lu" id="lu"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-lv" title="lv" id="lv"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ly" title="ly" id="ly"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ma" title="ma" id="ma"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mc" title="mc" id="mc"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-md" title="md" id="md"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-me" title="me" id="me"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mf" title="mf" id="mf"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mg" title="mg" id="mg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mh" title="mh" id="mh"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mk" title="mk" id="mk"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ml" title="ml" id="ml"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mm" title="mm" id="mm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mn" title="mn" id="mn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mo" title="mo" id="mo"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mp" title="mp" id="mp"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mq" title="mq" id="mq"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mr" title="mr" id="mr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ms" title="ms" id="ms"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mt" title="mt" id="mt"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mu" title="mu" id="mu"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mv" title="mv" id="mv"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mw" title="mw" id="mw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mx" title="mx" id="mx"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-my" title="my" id="my"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-mz" title="mz" id="mz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-na" title="na" id="na"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-nc" title="nc" id="nc"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ne" title="ne" id="ne"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-nf" title="nf" id="nf"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ng" title="ng" id="ng"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ni" title="ni" id="ni"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-nl" title="nl" id="nl"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-no" title="no" id="no"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-np" title="np" id="np"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-nr" title="nr" id="nr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-nu" title="nu" id="nu"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-nz" title="nz" id="nz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-om" title="om" id="om"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pa" title="pa" id="pa"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pe" title="pe" id="pe"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pf" title="pf" id="pf"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pg" title="pg" id="pg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ph" title="ph" id="ph"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pk" title="pk" id="pk"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pl" title="pl" id="pl"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pm" title="pm" id="pm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pn" title="pn" id="pn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pr" title="pr" id="pr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ps" title="ps" id="ps"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pt" title="pt" id="pt"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-pw" title="pw" id="pw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-py" title="py" id="py"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-qa" title="qa" id="qa"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-re" title="re" id="re"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ro" title="ro" id="ro"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-rs" title="rs" id="rs"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ru" title="ru" id="ru"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-rw" title="rw" id="rw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sa" title="sa" id="sa"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sb" title="sb" id="sb"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sc" title="sc" id="sc"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sd" title="sd" id="sd"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-se" title="se" id="se"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sg" title="sg" id="sg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sh" title="sh" id="sh"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-si" title="si" id="si"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sj" title="sj" id="sj"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sk" title="sk" id="sk"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sl" title="sl" id="sl"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sm" title="sm" id="sm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sn" title="sn" id="sn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-so" title="so" id="so"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sr" title="sr" id="sr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ss" title="ss" id="ss"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-st" title="st" id="st"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sv" title="sv" id="sv"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sx" title="sx" id="sx"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sy" title="sy" id="sy"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-sz" title="sz" id="sz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tc" title="tc" id="tc"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-td" title="td" id="td"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tf" title="tf" id="tf"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tg" title="tg" id="tg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-th" title="th" id="th"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tj" title="tj" id="tj"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tk" title="tk" id="tk"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tl" title="tl" id="tl"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tm" title="tm" id="tm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tn" title="tn" id="tn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-to" title="to" id="to"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tr" title="tr" id="tr"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tt" title="tt" id="tt"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tv" title="tv" id="tv"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tw" title="tw" id="tw"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-tz" title="tz" id="tz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ua" title="ua" id="ua"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ug" title="ug" id="ug"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-um" title="um" id="um"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-us" title="us" id="us"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-uy" title="uy" id="uy"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-uz" title="uz" id="uz"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-va" title="va" id="va"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-vc" title="vc" id="vc"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ve" title="ve" id="ve"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-vg" title="vg" id="vg"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-vi" title="vi" id="vi"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-vn" title="vn" id="vn"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-vu" title="vu" id="vu"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-wf" title="wf" id="wf"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ws" title="ws" id="ws"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-ye" title="ye" id="ye"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-yt" title="yt" id="yt"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-za" title="za" id="za"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-zm" title="zm" id="zm"></div></div></div>
						  <div class="col-md-1 col-sm-2 col-xs-3"><div class="flag-wrapper"><div class="img-thumbnail flag flag-icon-background flag-icon-zw" title="zw" id="zw"></div></div></div>
					</div>
					<?php _col2(); ?>
					
				</div>
				</div>
			<?php
			break;
			case "kelimeDetay" :
			$_GET['k'] = urldecode(get("k"));
			$kelime = veri(kelime(strip_tags(get("k")),2));
			bbaslik("$kelime kelimesini detaylı düzenle","Bu sayfada $kelime kelimesi için metin editörünü kullanarak diğer dillerde detaylı değişiklik yapabilirsiniz");
			?>
			<?php if(getisset("noEditor")) { ?>
				<a href="?i=kelimeDetay&k=<?php e(urlencode($_GET['k'])) ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Metin Editörünü Kullan</a>
			<?php } else { ?>
				<a href="?noEditor&i=kelimeDetay&k=<?php e(urlencode($_GET['k'])) ?>" class="btn btn-primary"><i class="fa fa-code"></i> HTML Kod Editörünü Kullan</a>
			<?php } ?>
			<form action="?kelimeDetayGuncelle" method="post">
			<input type="hidden" name="k" value="<?php e(urlencode(get("k"))); ?>" />
			<div class="row">
			
			</div>
			<div class="row">
			<?php $diller = ksorgu("diller"); ?>
			<?php while($d= kd($diller)) {
				?>
				<div class="col-md-6">
				<h4><i class="flag-icon flag-icon-<?php e($d['kisa']) ?>"></i> <?php e($d['isim']) ?></h4>
				<input type="hidden" name="id-<?php e($d['kisa']) ?>" value="<?php e(ti(get("k"),$d['kisa'])); ?>" />
				<textarea name="<?php e($d['kisa']) ?>" id="editor<?php e($d['kisa']) ?>" cols="30" rows="10" class="<?php if(getisset("noEditor")) { e("form-control"); } else { e("ckeditor"); } ?>"><?php if(tv(get("k"),$d['kisa'])!="") { e(tv(get("k"),$d['kisa'])); }else { e(get("k")); } ?></textarea>
				<?php if(getisset("noEditor")) { ?>
				<div style="border:dashed 2px #999;border-radius:10px;padding:10px;margin-top:10px;">
				<div class="onizle<?php e($d['kisa']) ?>"><?php if(tv(get("k"),$d['kisa'])!="") { e(tv(get("k"),$d['kisa'])); }else { e(get("k")); } ?></div>
				<div class="clearfix"></div>
				</div>
				<?php } ?>
				</div>
				<?php
			} ?>
			</div>
			<?php if(getisset("noEditor")) { ?>
					<script>
					$(function(){	
					<?php $diller = ksorgu("diller"); ?>
					<?php while($d = kd($diller)) { ?>
					var editor<?php e($d['kisa']) ?> = CodeMirror.fromTextArea(document.getElementById("editor<?php e($d['kisa']) ?>"), {
						lineNumbers: true
					});
					editor<?php e($d['kisa']) ?>.on("keydown", function(e){
						$(".onizle<?php e($d['kisa']) ?>").html(e.getValue());
					});
					<?php } ?>
					});
					</script>
				<?php } ?>
			<div class="row">
				<div class=" col-md-12">			
					<button class="btn btn-primary">Güncelle</button>
				</div>
			</div>
			</form>
			<?php
			break;
			case "ceviri_tablo" : 
			?>
				<div class="row firstRow">
					<div class="col-lg-9  col-md-8  col-sm-7">
						<div class="firstRowHeader">
							<h5><i class="fa fa-language"></i> Çeviri Tablosu</h5>
						</div>
						<ol class="breadcrumb">
							<li class="active">Ana Dizin</li>
						</ol>
					</div>
					<div class="col-lg-3   col-md-4  col-sm-5">
						
					</div>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>Kelime</th>
							<?php $diller =ksorgu("diller"); ?>
							<?php while($d = kd($diller)) {
								e("<th><i class='flag-icon flag-icon-{$d['kisa']}'></i> {$d['isim']}</th>");
							} ?>
							<th>İşlem</th>
						</tr>
					</thead>
					<tbody>
					<?php $translate = ksorgu("translate","WHERE TRIM(i) IS NOT NULL AND TRIM(i)<>'' GROUP BY i ORDER BY i ASC"); ?>
					<?php while($t = kd($translate)) {
					
					?>
					<?php 
							//if(!isHTML($t['i'])) {						
							?>
						<tr id="id-<?php e($t['id']); ?>">
							<td title="<?php e(strip_tags($t['i'])); ?>">
							
						
							
							<?php e(kelime(strip_tags($t['i']),3)); ?>
							</td>
							<?php $diller =ksorgu("diller"); ?>
							<?php while($d = kd($diller)) { ?>
							<td>
							<?php if(!isHTML(tv($t['i'],$d['kisa']))) { ?>
							<textarea name="" class="form-control iduzenle" tablo="translate" s_alan="id" s_kriter="<?php e(ti($t['i'],$d['kisa'])); ?>" d_alan="t" cols="30" rows="1"><?php e(strip_tags(tv($t['i'],$d['kisa']),"<p>")); ?></textarea>
							<?php } ?>
							</td>
							<?php } ?>
							<td>
								<a href="?&id=<?php e($t['id']); ?>&kelimeSil=<?php e(urlencode(strip_tags($t['i']))) ?>" teyit="<?php e(kelime(strip_tags($t['i']),10)) ?> çevirisini silmek istediğinizden emin misiniz?" ajax="#id-<?php e($t['id']) ?>" class="btn btn-primary"><i class="fa fa-trash"></i></a>
								<a href="?i=kelimeDetay&k=<?php e(urlencode($t['i'])) ?>" title="Detaylı Düzenle" class="btn btn-primary"><i class="fa fa-edit"></i></a>
								
							</td>
						</tr>
						<?php // } ?>
					<?php } ?>
					</tbody>
				</table>
			<?php
			break;
			case "dosya" : 
				?>
				
					<iframe style="    width: 94%;
    height: 100%;
    position: absolute;
    margin: 2%;" src="aa/lib/elfinder/elfinder.php" frameborder="0"></iframe>
				<?php
			break;
			default:
?>
			<div class="row firstRow">
					<div class="col-lg-12  col-md-12  col-sm-12">
						<div class="firstRowHeader">
							<h5>Tüm İçerikler</h5>
							<button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Ekle / <i class="fa fa-refresh"></i> Düzenle</button>

						</div>
						<ol class="breadcrumb">
							<li class="active">Ana Dizin</li>
						</ol>
					</div>
					<div class="col-lg-3   col-md-4  col-sm-5">
						
					</div>
				</div>
				<div class="col-md-12">
				<?php $icerik = contents_admin(); ?>
				<?php if($icerik!=0) { ?>
					<div class="row drags">
						
						<?php while($i = kd($icerik)) {
							col("col-md-6 col-lg-3",$i);
						} ?>
					</div>
				<?php } else {
					alert("Henüz hiçbir içerik eklenmedi");
				} ?>
				</div>
					<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
				<?php yeniIcerikFormu("col-md-12"); ?>
				<div class="clearfix"></div>
					</div></div></div></div>
<?php			
			break;
			case "icerikler" :
			?>
				<div class="row firstRow">
					<div class="col-lg-12  col-md-12  col-sm-12">
						<div class="firstRowHeader">
							<h5>Tüm İçerikler</h5>
							<button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Ekle / <i class="fa fa-refresh"></i> Düzenle</button>

						</div>
						<ol class="breadcrumb">
							<li class="active">Ana Dizin</li>
						</ol>
					</div>
					<div class="col-lg-3   col-md-4  col-sm-5">
						
					</div>
				</div>
				<div class="col-md-12">
				<?php $icerik = contents_admin(); ?>
				<?php if($icerik!=0) { ?>
					<div class="row drags">
						
						<?php while($i = kd($icerik)) {
							col("col-md-6 col-lg-3",$i);
						} ?>
					</div>
				<?php } else {
					alert("Henüz hiçbir içerik eklenmedi");
				} ?>
				</div>
					<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
				<?php yeniIcerikFormu("col-md-12"); ?>
				<div class="clearfix"></div>
					</div></div></div></div>

			<?php
			break;
			case "dil" : 
			$d = veri(get("d"));
			$d = kd(ksorgu("diller","WHERE kisa = $d"));
			?>
				<div class="row firstRow">
					<div class="col-lg-9  col-md-8  col-sm-7">
						<div class="firstRowHeader">
							<h5><i class="flag-icon flag-icon-<?php e2(get("d")) ?>"></i> <?php e($d['isim']) ?></h5>
						</div>
						<p><?php e($d['isim']) ?> çeviriyi bu sayfadan yapabilirsiniz.</p>
					</div>
				</div>

				<table class="table">
					<thead>
						<tr>
							<th>Kelime</th>
							<th>Çeviri</th>
							<th>İşlem</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$dil = veri(get("d"));
					$translate = ksorgu("translate","WHERE i IS NOT NULL AND dil = $dil GROUP BY i ORDER BY i ASC"); ?>
					<?php while($t = kd($translate)) { ?>
						<tr>
							<td title="<?php e(strip_tags($t['i'])); ?>"><?php e(kelime(strip_tags($t['i']),4)); ?></td>
							<td>
							<?php if(!isHTML(tv($t['i'],$t['dil']))) { ?>
							<textarea name="" class="form-control iduzenle" tablo="translate" s_alan="id" s_kriter="<?php e(ti($t['i'],$t['dil'])); ?>" d_alan="t"  cols="30" rows="1"><?php e(tv($t['i'],$t['dil'])); ?></textarea>
							<?php } ?>
							</td>
							<td>
								<a href="?i=kelimeDetay&k=<?php e(urlencode($t['i'])) ?>" title="Detaylı Düzenle" class="btn btn-primary"><i class="fa fa-edit"></i></a>
								
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			<?php
			break;
			case "sayfa" :
			$boyut=12;
			$c = kd(content_admin(get("s")));
			/*dGuncelle("content",array(
				"tkid" => hiyerarsisade($c['kid']),
				"type" => content_type(get("s"))
			),"id={$c['id']}");*/
				?>
				<?php $icerik = contents_admin(get("s")); ?>
				<div class="row firstRow">
					<div class="col-lg-12  col-md-8  col-sm-7">
						<div class="firstRowHeader">
							<h5><?php e($c['title']) ?></h5>
						</div>
						<?php if($icerik!=0) { ?>
						<button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Ekle / <i class="fa fa-refresh"></i> Düzenle</button>
						<?php } ?>
						<a href="<?php url($c); ?>" target="blank" class="btn btn-primary" style="float:right;" ><i class="fa fa-eye"></i> Sayfayı Gör</a>
						<?php echo hiyerarsi($c['slug']) ; ?>
					</div>
					
				</div>
				

  
				<div class="row">
					
					<?php if($icerik==0) { ?>
					  <?php col2("col-md-$boyut yeni"); ?>
						<div class="tabs-primary">
									<ul class="nav nav-tabs" role="tablist">
										<li class="<?php if(getisset("guncelleform")) { ?>active<?php } ?>"><a href="#tab_a4" data-toggle="tab" aria-expanded="false"><?php e($c['title']) ?> Bilgilerini Düzenle</a></li>
										<li class="<?php if(!getisset("guncelleform")) { ?>active<?php } ?>"><a href="#tab_b4" data-toggle="tab" aria-expanded="true"><?php e($c['title']) ?> Altına Yeni İçerik Ekle</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-content">
											<div class="tab-pane fade animated pulse <?php if(getisset("guncelleform")) { ?>active in <?php } ?>" id="tab_a4">
												<h6></h6>
												
												<form action="?guncelle=<?php e(get("s")) ?>" method="post" enctype="multipart/form-data" >
												
												<div class="row">
													<div class="col-md-9">
														<div class="col-md-4">
															<label for="">Başlık</label>
															<input type="text" name="title" value="<?php e2($c['title']) ?>" id="title2" required class="form-control" />
														</div>
														<div class="col-md-4">
															<label for="">URL <a href="#" id="slugguncelle" style="    padding: 0px;" class="btn btn-primary"><i style="font-size:12px" class="fa fa-refresh"></i></a></label>
															<input type="text" name="slug" value="<?php e($c['slug']) ?>" id="slug2" required class="form-control" />
														</div>
														<div class="col-md-4">
															<label for="">Kapak Resmi</label>
															<input type="file" name="pic" class="form-control" />
															
														</div>
														<?php if(strpos($c['tkid'],"'tur'"))  { 
														  ?>
 														<div class="col-md-6">
 															Tur Tarihi: 
 															<input type="date" required class="form-control" name="tarih" value="<?php e($c['tarih']) ?>" id="">
 														</div> 
														 <div class="col-md-6">
 															Fiyat: 
 															<input type="number" required step="any" class="form-control" name="fiyat" value="<?php e($c['fiyat']) ?>" id="">
 														</div>
														 <?php } ?>
														<div class="col-md-12">
															<hr />
															<input type="hidden" id="pic2" name="pic2" value="<?php e($c['pic2']); ?>" class="form-control" />
															<?php elfinderJS(); ?>
															
															<a href="#" id="elfinder_open" class="btn btn-primary"><i class="fa fa-file"></i> Detay Dosyaları Ekle</a>
															<div class="col-md-12"><div id="elfinder"></div></div>
															
															<hr />
															<style type="text/css">
															#secililer img {
																width:128px;
																height:128px;
															}
															</style>
															<div id="secililer">
																<?php $pic2 = explode(",",$c['pic2']);
																if(count($pic2)!=0) {
																	foreach($pic2 AS $p) {
																		if($p!="") {
																		e("<img src='$p' />");
																		}
																	}
																}
																?>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<label for="">Ek Dosyalar Dizini</label>
																
																<select name="alt_resim" id="" class="form-control">
																	<?php selectDirList($c['alt_resim']); ?>
																</select>
															</div>
															<div class="col-md-6">
																<label for="">Üst Kategori</label>
																<input type="text" name="kid" class="form-control"  value="<?php e($c['kid']) ?>" />
															</div>
															<div class="col-md-6">
																<label for="">Tip</label>
																<select name="type" id="" class="form-control">
																	<?php $tip = ksorgu("type"); ?>
																	<?php while($t = kd($tip)) { ?>
																		<option value="<?php e($t['slug']) ?>" <?php if($c['type']==$t['slug']) e("selected"); ?>><?php e($t['tip_ad']) ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<?php if($c['pic']!="") { ?> <img src="r.php?w=256&p=file/<?php e($c['pic']) ?>" width="100%" alt="" />
														<a href="?resimKaldir=<?php e($c['slug']) ?>" style="    position: absolute;
    right: 0px;
    top: -12px;
    font-size: 12px !important;
    border-radius: 100%;
    padding: 10px 5px;" teyit="Resmi kaldırmak istediğinizden emin misiniz?" class="btn btn-primary"><i class="fa fa-trash"></i></a><?php } ?>
														
														
													</div>
												</div>												
												<div class="row">
													<div class="col-md-12">
														<label for="">İçerik</label>
														<textarea name="html" id="editor" class="ckeditor" cols="45" rows="5"><?php e($c['html']) ?></textarea>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-12 ">
														<button type="submit" href="#" class="btn btn-primary"><i class="fa fa-refresh"></i> Bilgileri Güncelle</button>
													</div>
													
												</div>
												</form>
												<?php //print_r(json_decode($c['json'])); ?>
												<?php col2("col-md-12","{$c['title']} İçeriğinin Alt Özellikler"); ?>,
												<form action="?altEkle" method="post">
												<div class="col-md-4">
												<input type="hidden" name="slug" value="<?php e($c['slug']) ?>" />
												<select class="form-control" name="adet" id="adet">
												<?php for($k=1;$k<=10;$k++) { ?>
													<option value="<?php e($k) ?>"><?php e($k) ?></option>
												<?php } ?>
												</select>
												</div>
												<div class="col-md-4">
												<button class="btn btn-primary" type="submit"> Adet Yeni Alt İçerik Ekle <i class="fa fa-plus"></i> </button>
												</div>
												</form>
												<table class="table">
													<thead>
														<tr>
															<th>Alan</th>
															<th>Değer</th>
															<th>İşlem</th>
														</tr>
													</thead>
													<tbody>
														<!--<tr>
															<td>İlgili Üye</td>
															<td>
																<?php uye_isim($c['bag']) ?>
															</td>
														</tr> -->
														<?php 
														$c['type'] = trim($c['type']);
														//e($c['type']);
														$other = ksorgu("other","WHERE cid = '{$c['slug']}'"); 
														$sablon = kd(ksorgu("sablon","WHERE slug = '{$c['type']}'"));
													//	print_r($sablon);
														$sablon = explode(",",$sablon['deger']);
													//	print_r($sablon);
														?>
														<?php foreach($sablon AS $s) { 
															$s = trim($s);
															$o = cokd($c['slug'],$s);
															
														//	e($s);
															if($o['alan']=="") {
													//			e($s);
															//	e($c['slug']);
																dEkle("other",array(
																	"cid" => $c['slug'],
																	"alan" => $s
																));
																$o = cokd($c['slug'],$s);
															//	print_r($o);
															}
														?>
														<tr id="id-<?php e($o['id']) ?>">
															<td><?php e($o['alan']) ?></td>
															<td>
															<?php if(ishtml($o['deger'])) { ?>
															<a href="#" class="btn btn-primary"><i title="Bu özelliğin değeri HTML olarak kodlanmıştır. Sağ yanda bulunan düzenleme düğmelerini kullanınız" class="fa fa-code"></i></a>
															<?php } else { ?>
															<?php switch_alan($o); ?>
															<?php } ?>
															</td>
															<td>
																<a href="?altSil=<?php e($o['id']) ?>" teyit="Bu bilgiyi kalıcı olarak kaldırmak istediğinizden emin misiniz?" ajax="#id-<?php e($o['id']) ?>" class="btn btn-primary"><i class="fa fa-trash"></i></a>
																<a title="Metin editörüyle düzenle" href="?i=altDuzenle&id=<?php e($o['id']) ?>" class="btn btn-primary"><i class="fa fa-list-alt"></i></a>
																<a title="Metin editörü olmadan düzenle" href="?i=altDuzenle&id=<?php e($o['id']) ?>&noEditor" class="btn btn-primary"><i class="fa fa-edit"></i></a>
																
															</td>
														</tr>
														<?php } ?>
													</tbody>
												</table>
												<?php _col2(); ?>
											</div>
											<div class="tab-pane fade animated pulse <?php if(!getisset("guncelleform")) { ?>active in <?php } ?>" id="tab_b4">
												<h6></h6>
												
												<?php yeniIcerikFormu("col-md-12",$c['slug']); ?>
											</div>
											
										</div>
										<!-- tab content -->
									</div>
						</div>
					
					<?php _col2(); ?>
					<?php } ?>
					<?php if($icerik!=0) {
					
					?>
					<?php col2("col-md-12","{$c['title']} Alt İçerikleri") ?>
					
					<div class="row ">
					<div class="col-md-12">
						<a href="?i=sayfa&s=<?php e(get("s")) ?>&tablesil" class="btn btn-<?php if(!getisset("table")) e("primary"); else  e("info"); ?>" title=" Kutu Görünümü"><i class="fa fa-th"></i></a>
						<a href="?i=sayfa&s=<?php e(get("s")) ?>&table" class="btn btn-<?php if(getisset("table")) e("primary"); else  e("info"); ?>" title=" Tablo Görünümü"><i class="fa fa-list"></i></a>
					</div>
					</div>
					
					
					<?php 
					$othersay=3;
					if(oturumisset("table")) { ?>
						<table class="table">
							<thead>
								<tr>
									<th>Resim</th>
									<th>Başlık</th>
									<th>URL</th>
									<th>Tip</th>
									<th>Kategori</th>
									<?php $sablon = content_sablon($c['slug']);									
									$alt = kd(contents_admin($c['slug']));									
									$type_sablon = type_sablon($alt['type']);
									?>
									<?php 
									if(count($type_sablon)>$othersay) {
									for($k=0;$k<=$othersay;$k++) { ?>
									<th><?php e($type_sablon[$k]) ?></th>
									<?php }} ?>
									<?php
									if(count($sablon)>$othersay) {
									?>
									<?php for($k=0;$k<=$othersay;$k++) { ?>
									<th><?php e($sablon[$k]) ?></th>
									<?php } ?>
									<?php } ?>
									<th width="20%">
										İşlem
									</th>
									
								</tr>
							</thead>
							<tbody class="drags">
							<?php while($i = kd($icerik)) { ?>
							
								<tr class="drag" style="height:initial;" id="<?php e($i['id']) ?>">
									<td><?php if($i['pic']!="") { ?><img src="<?php r($i['pic'],64); ?>" alt="" /><?php } ?></td>
									<td><input type="text" tablo="content" d_alan="title" s_kriter="<?php e($i['id']) ?>" class="form-control iduzenle" value="<?php e($i['title']) ?>" /></td>
									<td><input type="text" tablo="content" d_alan="slug" s_kriter="<?php e($i['id']) ?>" class="form-control iduzenle" value="<?php e($i['slug']) ?>" /></td>
									<td><input type="text" tablo="content" d_alan="type" s_kriter="<?php e($i['id']) ?>" class="form-control iduzenle" value="<?php e($i['type']) ?>" /></td>
									<td><input type="text" tablo="content" d_alan="kid" s_kriter="<?php e($i['id']) ?>" class="form-control iduzenle" value="<?php e($i['kid']) ?>" /></td>
									<?php $sablon = content_sablon($c['slug']); 
									$alt = kd(contents_admin($c['slug']));	
									$type_sablon = type_sablon($alt['type']); ?>
									<?php
									if(count($type_sablon)>$othersay) { 
									for($k=0;$k<=$othersay;$k++) { 
									
										$o = @cokr2($i['slug'],trim($type_sablon[$k]));
										
									?>
									<td>
									<?php //print_r($o); ?>
										<?php switch_alan($o) ?>
									</td>
									<?php }
									} ?>
									<?php
									if(count($sablon)>$othersay) { 
									for($k=0;$k<=$othersay;$k++) { 
										$o = @cokr2($i['slug'],trim($sablon[$k]));
										
									?>
									<td>
										<?php switch_alan($o) ?>
									</td>
									<?php }
									} ?>
									<td>
										<a href="?sil=<?php e($i['id']) ?>" ajax="#<?php e($i['id']) ?>" teyit="içeriği silmek istediğinizden emin misiniz?" class="btn"><i class="fa fa-trash"></i></a>
										<a href="?cogalt=<?php e($i['slug']) ?>" teyit="<?php e($i['title']) ?> İçeriğini alt içerikleriyle beraber çoğaltmak istediğinizden emin misiniz?" class="btn"><i class="fa fa-files-o"></i></a>
										<a href="?i=sayfa&s=<?php e($i['slug']) ?>" title="<?php e($i['title']) ?> içeriğinin detaylı düzenle" class="btn"><i class="fa fa-external-link-square"></i></a>
									</td>
								</tr>
						
							<?php } ?>
							</tbody>
						</table>
					<?php } else { ?>
					<div class="row drags">
						<?php while($i = kd($icerik)) {
							col("col-md-6 col-sm-12 col-ls-3",$i);
						} ?>
					</div>
					<?php } ?>
					
					<?php _col2(); ?>
					<?php } else {
						$boyut=12;
						//alert("Bu alanda henüz içerik yok");
					} ?>
					
					<!-- Modal -->
					<?php if($icerik!=0) { ?>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
          <?php col2("col-md-$boyut yeni"); ?>
						<div class="tabs-primary">
									<ul class="nav nav-tabs" role="tablist">
										<li class="<?php if(getisset("guncelleform")) { ?>active<?php } ?>"><a href="#tab_a4" data-toggle="tab" aria-expanded="false"><?php e($c['title']) ?> Bilgilerini Düzenle</a></li>
										<li class="<?php if(!getisset("guncelleform")) { ?>active<?php } ?>"><a href="#tab_b4" data-toggle="tab" aria-expanded="true"><?php e($c['title']) ?> Altına Yeni İçerik Ekle</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-content">
											<div class="tab-pane fade animated pulse <?php if(getisset("guncelleform")) { ?>active in <?php } ?>" id="tab_a4">
												<h6></h6>
												
												<form action="?guncelle=<?php e(get("s")) ?>" method="post" enctype="multipart/form-data" >
												
												<div class="row">
													<div class="col-md-9">
														<div class="col-md-3">
															<label for="">Başlık</label>
															<input type="text" name="title" value="<?php e2($c['title']) ?>" id="title2" required class="form-control" />
														</div>
														<div class="col-md-3">
															<label for="">URL <a href="#" id="slugguncelle" style="    padding: 0px;" class="btn btn-primary"><i style="font-size:12px" class="fa fa-refresh"></i></a></label>
															<input type="text" name="slug" value="<?php e($c['slug']) ?>" id="slug2" required class="form-control" />
														</div>
														<div class="col-md-3">
															<label for="">Kapak Resmi</label>
															<input type="file" name="pic" class="form-control" />
														</div>
														<div class="col-md-3">
															<label for="">Detay Resim</label>
															<input type="file" name="pic2" class="form-control" />
														</div>
														<div class="row">
															<div class="col-md-6">
																<label for="">Ek Dosyalar Dizini</label>
																
																<select name="alt_resim" id="" class="form-control">
																	<?php selectDirList($c['alt_resim']); ?>
																</select>
															</div>
															<div class="col-md-6">
																<label for="">Üst Kategori</label>
																<input type="text" name="kid" class="form-control"  value="<?php e($c['kid']) ?>" />
															</div>
															<div class="col-md-6">
																<label for="">Tip</label>
																<select name="type" id="" class="form-control">
																	<?php $tip = ksorgu("type"); ?>
																	<?php while($t = kd($tip)) { ?>
																		<option value="<?php e($t['slug']) ?>" <?php if($c['type']==$t['slug']) e("selected"); ?>><?php e($t['tip_ad']) ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<?php if($c['pic']!="") { ?> <img src="r.php?w=256&p=file/<?php e($c['pic']) ?>" width="100%" alt="" />
														<a href="?resimKaldir=<?php e($c['slug']) ?>" style="    position: absolute;
    right: 0px;
    top: -12px;
    font-size: 12px !important;
    border-radius: 100%;
    padding: 10px 5px;" teyit="Resmi kaldırmak istediğinizden emin misiniz?" class="btn btn-primary"><i class="fa fa-trash"></i></a><?php } ?>
														
													</div>
												</div>												
												<div class="row">
													<div class="col-md-12">
														<label for="">İçerik</label>
														<textarea name="html" id="editor" class="ckeditor" cols="45" rows="5"><?php e($c['html']) ?></textarea>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-12 ">
														<button type="submit" href="#" class="btn btn-primary"><i class="fa fa-refresh"></i> Bilgileri Güncelle</button>
													</div>
													
												</div>
												</form>
												<?php //print_r(json_decode($c['json'])); ?>
												<?php col2("col-md-12","{$c['title']} İçeriğinin Alt Özellikler"); ?>,
												<form action="?altEkle" method="post">
												<div class="col-md-4">
												<input type="hidden" name="slug" value="<?php e($c['slug']) ?>" />
												<select class="form-control" name="adet" id="adet">
												<?php for($k=1;$k<=10;$k++) { ?>
													<option value="<?php e($k) ?>"><?php e($k) ?></option>
												<?php } ?>
												</select>
												</div>
												<div class="col-md-4">
												<button class="btn btn-primary" type="submit"> Adet Yeni Alt İçerik Ekle <i class="fa fa-plus"></i> </button>
												</div>
												</form>
												<table class="table">
													<thead>
														<tr>
															<th>Alan</th>
															<th>Değer</th>
															<th>İşlem</th>
														</tr>
													</thead>
													<tbody>
														<!--<tr>
															<td>İlgili Üye</td>
															<td>
																<?php uye_isim($c['bag']) ?>
															</td>
														</tr>-->
														<?php 
														$c['type'] = trim($c['type']);
														//e($c['type']);
														$other = ksorgu("other","WHERE cid = '{$c['slug']}'"); 
														$sablon = kd(ksorgu("sablon","WHERE slug = '{$c['type']}'"));
													//	print_r($sablon);
														$sablon = explode(",",$sablon['deger']);
													//	print_r($sablon);
														?>
														<?php foreach($sablon AS $s) { 
															$s = trim($s);
															$o = cokd($c['slug'],$s);
															
														//	e($s);
															if($o['alan']=="") {
													//			e($s);
															//	e($c['slug']);
																dEkle("other",array(
																	"cid" => $c['slug'],
																	"alan" => $s
																));
																$o = cokd($c['slug'],$s);
															//	print_r($o);
															}
														?>
														<tr id="id-<?php e($o['id']) ?>">
															<td><?php e($o['alan']) ?>
															</td>
															<td>
															<?php if(ishtml($o['deger'])) { ?>
															<a href="#" class="btn btn-primary"><i title="Bu özelliğin değeri HTML olarak kodlanmıştır. Sağ yanda bulunan düzenleme düğmelerini kullanınız" class="fa fa-code"></i></a>
															<?php } else { ?>
															<?php switch_alan($o); ?>
															<?php } ?>
															</td>
															<td>
																<a href="?altSil=<?php e($o['id']) ?>" teyit="Bu bilgiyi kalıcı olarak kaldırmak istediğinizden emin misiniz?" ajax="#id-<?php e($o['id']) ?>" class="btn btn-primary"><i class="fa fa-trash"></i></a>
																<a title="Metin editörüyle düzenle" href="?i=altDuzenle&id=<?php e($o['id']) ?>" class="btn btn-primary"><i class="fa fa-list-alt"></i></a>
																<a title="Metin editörü olmadan düzenle" href="?i=altDuzenle&id=<?php e($o['id']) ?>&noEditor" class="btn btn-primary"><i class="fa fa-edit"></i></a>
																
															</td>
														</tr>
														<?php } ?>
													</tbody>
												</table>
												<?php _col2(); ?>
											</div>
											<div class="tab-pane fade animated pulse <?php if(!getisset("guncelleform")) { ?>active in <?php } ?>" id="tab_b4">
												<h6></h6>
												<?php yeniIcerikFormu("col-md-12",$c['slug']); ?>
											</div>
											
										</div>
										<!-- tab content -->
									</div>
						</div>
					
					<?php _col2(); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
        </div>
      </div>
      
    </div>
  </div>
					<?php } ?>	
				</div>
				
				<?php
			break;
		}
		?>