<?php 
$c = $t;
$user_basket = [
    ['Yetişkin', $c['fiyat'], post("yetiskin")],
    ['6-11 Yaş Çocuk', $c['fiyat2'], post("cocuk")],
    ['2-5 Yaş Çocuk', $c['fiyat3'], post("bebek")],
];

$_POST['adi'] = post("yetiskin_1_adi");
$_POST['soyadi'] = post("yetiskin_1_soyadi");
$_POST['toplam'] = $toplam;
$kid = get("t");
$merchant_oid = rand();

dekle("odemeler", [
    'html' => json_encode($_POST, JSON_UNESCAPED_UNICODE),
    'slug' => $merchant_oid,
    'date' => simdi(),
    'fiyat' => $toplam,
    'datals' => 'Ödeme Bekliyor',
    'kid' => $kid 
]);

$payment_amount = $toplam * 100;
$email = post("email");

include("view/paytr.php");
?>