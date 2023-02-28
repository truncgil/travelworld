<?php 
include("tema.php");
//print_r($_GET);
oturumAc();
if(oturumisset("uid")) {
	$uid = oturum("uid");
	$varmi = ksorgu("uyeler","WHERE id = '$uid'");
	if($varmi!=0) {
		$u = kd($varmi);
	}
} else {
	oturum("uid",session_id());
}
$c = c(get("id"));
if(!getesit("id","ara")) {
	if(!getesit("id","index")) {
		if($c['title']=="") yonlendir("index");

	}	
}

if($c['type']=="Ürün") {
	$_GET['id'] = "urun"; 
	$_GET['id2'] = $c['id']; 
}
if($c['type']=="Tur") {
	$_GET['id'] = "tur"; 
	$_GET['id2'] = $c['id']; 
}
if($c['type']=="Tur Kategorisi") {
	$_GET['id'] = "tur-kategorisi"; 
	$_GET['id2'] = $c['id']; 
}
if($c['slug']=="turlar") {
	$_GET['id'] = "turlar"; 
	$_GET['id2'] = $c['id'];
}
if($c['type']=="Ürün Grubu") { 
	//e("ok"); 
	$_GET['id'] = "urun"; 
	$_GET['id2'] = $c['id']; 
}
if($c['type']=="Ürün Kategorisi") {
	$_GET['id'] ="kategori";
	$_GET['id2'] =$c['id'];
	//e("ok");
}
//print_r($c);
//e($c['type']);
//print_r($_GET);
oturumAc();
if(oturumisset("uid")) {
	$uid = oturum("uid");
} else {
	$uid = NULL;
}

switch($_GET['id']) {
	case "profil" : 
		$c =array(
			"title" => "Profile"
		);
	break;
	case "iletisim.aspx" : 
		yonlendir("iletisim");
	break;
	case "admin" :
		yonlendir("admin.php");
	break;
	case "login" :
		yonlendir("login.php");
	break;

}
if($c['title']=="") {
	$c['title'] = set("Başlık","r");
}
start($c);
?>
<?php if(oturumisset("uid")) {
	if(oturumkontrol("Yonetici")) {
		if(isset($c['slug'])) {
		?>
		<?php
		}
	}
	
} ?>
<?php
	
		view(get("id"));
	
finish();
?>


