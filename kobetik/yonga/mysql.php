<?php
$baglanti = @mysql_pconnect($sunucu, $kullanici, $parola) or trigger_error(mysql_error(),E_USER_ERROR);

if (!function_exists("veri")) {
function veri($theValue, $theType="yazi", $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "yazi":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "hok":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
  	  $theValue = htmlspecialchars($theValue);
      break;
    case "uzun":
    case "sayi":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "cift":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "tarih":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "tanimsiz":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php 
function tirnak_sil($data){
  $data = str_replace('"',"&quot;",$data);
  $data = str_replace("'","&#39;",$data);
  return $data;
}
 ?>
<?php function formEkle($tablo,$dizi) {
	$ayri = 0;
	foreach ($dizi as $anahtar => $deger) {
		
	switch ($tip) {
		case "yazı":
			$tip = "text";
		break;
		case "parola":
			$tip = "password";
		break;
		case "kutu":
			$tip = "textarea";
			$ayri = 1;
		break;
		case "menü":
			$tip = "select";
			$ayri = 1;
		break;
		case "tarih":
			$tip = "text";
		break;

	}
}
}
 ?>
 <?php function input_ajax($adres,$sinif=".input_d",$debug="") { ?>
<script language="javascript1.1" type="text/javascript">
$(function(){
						   $(<?php echo veri($sinif); ?>).blur(function(){
														
													   var yer = $(this);
																yer.fadeTo("normal",0.5);
																yer.attr("disabled","disabled");
																var jtablo = yer.attr("tablo"); //tablo adi
																var jd_alan = yer.attr("d_alan"); //SET alan adi
																var js_alan = yer.attr("s_alan"); // WHERE alan adi
																var js_kriter = yer.attr("s_kriter"); // sorgu WHere alan degeri
																var jd_kriter = $(this).val(); // degistirilen SET alan degeri
																console.log(parseFloat(jd_kriter));
																$.post(<?php echo veri($adres); ?>,{
																	   tablo : jtablo,
																	   d_alan : jd_alan,
																	   s_alan : js_alan,
																	   s_kriter : js_kriter,
																	   d_kriter : jd_kriter
																	   },function(data){
																	   <?php if ($debug!="") {  ?>
																		   alert(data);
																		   <?php } ?>
																		   //alert(data);
																		   yer.fadeTo("normal",1);
																		   yer.removeAttr("disabled");
																		   });
													   }); 
						   $(<?php echo veri($sinif); ?>).change(function(){
														
													   var yer = $(this);
																yer.fadeTo("normal",0.5);
																yer.attr("disabled","disabled");
																var jtablo = yer.attr("tablo"); //tablo adi
																var jd_alan = yer.attr("d_alan"); //SET alan adi
																var js_alan = yer.attr("s_alan"); // WHERE alan adi
																var js_kriter = yer.attr("s_kriter"); // sorgu WHere alan degeri
																var jd_kriter = $(this).val(); // degistirilen SET alan degeri
																console.log(parseFloat(jd_kriter));
																$.post(<?php echo veri($adres); ?>,{
																	   tablo : jtablo,
																	   d_alan : jd_alan,
																	   s_alan : js_alan,
																	   s_kriter : js_kriter,
																	   d_kriter : jd_kriter
																	   },function(data){
																	   <?php if ($debug!="") {  ?>
																		   alert(data);
																		   <?php } ?>
																		   //alert(data);
																		   yer.fadeTo("normal",1);
																		   yer.removeAttr("disabled");
																		   });
													   }); 
													   });
</script>													

<?php } ?>
<?php function dSil($tablo, $kriter) {
	global $veritabani;
	global $baglanti;
	$toplamKriter = "";
	foreach ($kriter as $anahtar => $deger) {
		if (is_string($deger)) {
			$deger = veri($deger);
		}
		$toplamKriter .= $anahtar . "=" . $deger . " AND ";
	}
	$toplamKriter = substr($toplamKriter,0,strlen($toplamKriter)-5);
    $silSQL = sprintf("DELETE FROM %s WHERE %s",
											$tablo,
											$toplamKriter);
	return $silSQL;
    mysql_select_db($veritabani, $baglanti);
    $sonuc = mysql_query($silSQL, $baglanti) or die(mysql_error());
} ?>
<?php function hangi($dizi) {
	$ifade = "WHERE ";
	foreach ($dizi as $anahtar => $deger) {
		$ifade .= $anahtar . "";
		for ($k=0;$k<count($deger);$k++) {
			$ifade .= $deger[$k] . " ";
		}

	}
	return $ifade;
	}
	?>
<?php function dKriter($dizi) {
	$toplamKriter ="";
	foreach ($dizi as $anahtar => $deger) {
		$toplamKriter .= $anahtar . "";
		for ($k=0;$k<count($deger);$k++) {
			$toplamKriter .= $deger[$k] . " ";
		}

	}
	return $toplamKriter;
} ?>
<?php function dGuncelle($tablo,$set,$where) {
	global $veritabani;
	global $baglanti;
	$toplamSet = "";
	$toplamWhere = "";
	$deger = "";
	$k = 0;
	foreach ($set as $anahtar => $deger) {
		if (is_string($deger)) {
			$deger = veri($deger);
			//echo $deger;
		}
		$toplamSet .= $anahtar . "=" . $deger . ",";
		
	}
	if (is_array($where)) {
		foreach ($where as $anahtar => $deger) {
			if (is_string($deger)) {
				$deger = veri($deger);
			}
			$toplamWhere .= $anahtar . "=" . tirnak_sil($deger) . " AND ";
		}
	$toplamWhere = substr($toplamWhere,0,strlen($toplamWhere)-5);
	} else {
		$toplamWhere = $where;
	}
	$toplamSet = substr($toplamSet,0,strlen($toplamSet)-1);
	$guncelleSQL = sprintf("UPDATE %s SET %s WHERE %s",
					 $tablo,
					  $toplamSet,
					   $toplamWhere);
	//return $guncelleSQL;
  mysql_select_db($veritabani, $baglanti);
  $Sonuc = mysql_query($guncelleSQL, $baglanti) or die(mysql_error());
  trigger($tablo,$set,"guncelle");
}
?>
<?php function trigger($tablo,$array,$islem) {
	/*
	dEkle("log",array(
		"title" => "$tablo $islem yapıldı",
		"text" => @json_encode($array),
		"date" => simdi()
	),false,"a");
	*/
	//include("/../../trigger.php");
	//e($tablo);
} ?>
<?php function dEkle($tablo, $bilgiler,$debug=false,$trigger="") {
	global $veritabani;
	global $baglanti;
	$toplamAlan = "";
	$toplamVeri = "";
	foreach ($bilgiler as $anahtar => $deger) { //anahtar değerleri alalım
		$toplamAlan .= $anahtar . ",";
	}


	foreach ($bilgiler as $anahtar => $deger) { // her anahtara ait değerleri alalım
		if (is_string($deger)) {
			$deger = veri($deger);
		}
		$toplamVeri .= $deger . ",";
	}
	$toplamAlan = substr($toplamAlan,0,strlen($toplamAlan)-1);
	$toplamVeri = substr($toplamVeri,0,strlen($toplamVeri)-1);

    $ekleSQL = sprintf("INSERT INTO %s (%s) VALUES (%s)",$tablo,$toplamAlan,$toplamVeri);
	if($trigger=="") {
		trigger($tablo,$bilgiler,"ekle");
	}
	if($debug==true) {
	return $ekleSQL;
	} else {
		mysql_select_db($veritabani, $baglanti);
		$sonuc = mysql_query($ekleSQL, $baglanti) or die(mysql_error());
		$sorgu = kd(sorgu("SELECT MAX(id) AS son FROM $tablo"));
		return $sorgu['son'];
	}
	
} ?>
<?php
function ekle($tablo,$alan,$veri) {
	global $veritabani;
	global $baglanti;
  $ekleSQL = sprintf("INSERT INTO %s (%s) VALUES (%s)",$tablo,$alan,$veri);

  mysql_select_db($veritabani, $baglanti);
  $sonuc = mysql_query($ekleSQL, $baglanti) or die(mysql_error());

}
?>
<?php 
function sToplam($sorgu) { //bir sorgunun toplam satır sayısını döndürür
	return @mysql_num_rows($sorgu);
}
 ?>
<?php
function toplam($tablo,$kriter="") {
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("SELECT COUNT(*) AS toplam FROM %s",$tablo);
if ($kriter!="") {
	$sorgu = sprintf("%s WHERE %s",$sorgu, $kriter);
}
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
$row_sorgu = mysql_fetch_assoc($sorgu);
return $row_sorgu['toplam'];
}

?>
<?php function alansorgu($sorgu,$alan) {
	global $veritabani;
	global $baglanti;
	mysql_select_db($veritabani, $baglanti);
	$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
	$as = mysql_fetch_assoc($sorgu);
	$totalRows_sorgu = mysql_num_rows($sorgu);
	if ($totalRows_sorgu==0) {
		return 0;
	} else {
		return $as[$alan];
	}


	?>
<?php }?>
<?php
function sil($tablo,$kriter) {
	global $veritabani;
	global $baglanti;
  $silSQL = sprintf("DELETE FROM %s WHERE %s",
											$tablo,
											$kriter);

  mysql_select_db($veritabani, $baglanti);
  $sonuc = mysql_query($silSQL, $baglanti) or die(mysql_error());
  trigger($tablo,$kriter,"sil");
}
?>
<?php
function guncelle($tablo,$set,$where) {
	global $veritabani;
	global $baglanti;
  $guncelleSQL = sprintf("UPDATE %s SET %s WHERE %s",
					 $tablo,
					  $set,
					   $where);
  mysql_select_db($veritabani, $baglanti);
  $Sonuc = mysql_query($guncelleSQL, $baglanti) or die(mysql_error());
}
?>
<?php
function hit($tablo,$alan,$where) {
	global $veritabani;
	global $baglanti;
  $guncelleSQL = sprintf("UPDATE %s SET %s WHERE %s",
					 $tablo,
					   "$alan = $alan + 1",
					   $where);
  mysql_select_db($veritabani, $baglanti);
  $Sonuc = mysql_query($guncelleSQL, $baglanti) or die(mysql_error());
}
?>
<?php function sirala($dizi) {
	$ifade = "ORDER BY ";
	foreach ($dizi as $anahtar => $deger) {
		switch ($deger) {
			case "artan" : 
				$deger = "ASC";
			break;
			case "azalan" :
				$deger = "DESC";
			break;
		}
		$ifade .= $anahtar . " " . $deger . ", ";
	}
	$ifade = substr($ifade,0,strlen($ifade)-2);
	return $ifade;
} ?>
<?php
function select($alanlar,$tablo,$diger="",$baslangic=0,$bitis=0) {
	global $veritabani;
	global $baglanti;
	$limit = "";
	$orderby = "";
	if ($diger!=""){
		$orderby = $diger;
	}
	if ($bitis!=0) {
		$limit = sprintf(" LIMIT %s, %s",$baslangic, $bitis);
	}
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("SELECT %s FROM %s %s",$alanlar,$tablo,$diger);
$sorgu = mysql_query($sorgu . $limit, $baglanti) or die(mysql_error());
$totalRows_sorgu = mysql_num_rows($sorgu);
if ($totalRows_sorgu==0) {
	return 0;
} else {
	return $sorgu;
}
}
?><?php
function idSorgu($tablo,$id) { //bir tablodaki id alanına değer gönderir tekil sorgulamaları kısaltmak içindir.
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("SELECT * FROM %s WHERE id = %s",$tablo,$id);
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
$totalRows_sorgu = mysql_num_rows($sorgu);
if ($totalRows_sorgu==0) {
	return 0;
} else {
	return $sorgu;
}
}
?><?php
function kSorgu($tablo,$diger="",$baslangic=0,$bitis=0) {
	global $veritabani;
	global $baglanti;
	$limit = "";
	$orderby = "";
	if ($diger!=""){
		$orderby = $diger;
	}
	if ($bitis!=0) {
		$limit = sprintf(" LIMIT %s, %s",$baslangic, $bitis);
	}
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("SELECT * FROM %s %s",$tablo,$diger);
$sorgu = mysql_query($sorgu . $limit, $baglanti) or die(mysql_error());
$totalRows_sorgu = mysql_num_rows($sorgu);
if ($totalRows_sorgu==0) {
	return 0;
} else {
	return $sorgu;
	
}
trigger($tablo,$diger,"sorgu");
}
?><?php
function sorgu($sorgu,$baslangic=0,$bitis=0) {
	global $veritabani;
	global $baglanti;
	$limit = "";
	if ($bitis!=0) {
		$limit = sprintf(" LIMIT %s, %s",$baslangic, $bitis);
	}
mysql_select_db($veritabani, $baglanti);
$sorgu = mysql_query($sorgu . $limit, $baglanti) or die(mysql_error());
$totalRows_sorgu = mysql_num_rows($sorgu);
if ($totalRows_sorgu==0) {
	return 0;
} else {
	return $sorgu;
}
trigger($sorgu,$diger,"sorgu");
}

?>
<?php
function toplamkayit($dizi) {
	return @mysql_num_rows($dizi);
}
?>
<?php
function kd($dizi) {
	return @mysql_fetch_assoc($dizi);
}
?>

<?php
function enbuyuk($tablo,$kriter="") {
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
if ($kriter!="") {
$sorgu = sprintf("SELECT MAX(%s) AS en_buyuk FROM %s",$kriter, $tablo);
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
$row_sorgu = mysql_fetch_assoc($sorgu);
return $row_sorgu['en_buyuk'];
} else {
	return "Tablo alan kriteri girilmediğinden işlem yapılmadı";
}
}

?>
<?php
function enkucuk($tablo,$kriter="") {
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
if ($kriter!="") {
$sorgu = sprintf("SELECT MIN(%s) AS en_kucuk FROM %s",$kriter, $tablo);
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
$row_sorgu = mysql_fetch_assoc($sorgu);
return $row_sorgu['en_kucuk'];
} else {
	return "Tablo alan kriteri girilmediğinden işlem yapılmadı";
}
}

?>
<?php
function kisa_sorgu($tablo,$kriter="") {
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("SELECT * FROM %s",$tablo);
if ($kriter!="") {
	$sorgu = sprintf("%s WHERE %s",$sorgu, $kriter);
}
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
return $sorgu;
}
?>
<?php
function birlestir($tablo,$diger="") {
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("SELECT * FROM %s",$tablo);
if ($diger!="") {
	$sorgu = sprintf("%s %s",$sorgu, $diger);
}
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
return $sorgu;
}
?>
<?php
function solb($tablo,$cengel) {
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("LEFT JOIN %s ON %s",$tablo, $cengel);
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
return $sorgu;
}
?>
<?php
function sagb($tablo,$cengel) {
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("RIGHT JOIN %s ON %s",$tablo, $cengel);
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
return $sorgu;
}
?>
<?php
function icb($tablo,$cengel) {
	global $veritabani;
	global $baglanti;
mysql_select_db($veritabani, $baglanti);
$sorgu = sprintf("INNER JOIN %s ON %s",$tablo, $cengel);
$sorgu = mysql_query($sorgu, $baglanti) or die(mysql_error());
return $sorgu;
}
?>