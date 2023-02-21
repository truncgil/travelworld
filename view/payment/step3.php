<?php 
$c = $t;
$user_basket = [
    ['Yetişkin', $c['fiyat'], post("yetiskin")],
    ['Çocuk', $c['fiyat2'], post("cocuk")],
    ['Bebek', $c['fiyat3'], post("bebek")],
];

$_POST['adi'] = post("yetiskin_1_adi");
$_POST['soyadi'] = post("yetiskin_1_soyadi");
$payment_amount = $toplam * 100;
$email = post("email");

include("view/paytr.php");
?>