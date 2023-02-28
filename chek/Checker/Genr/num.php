<?php
ini_set('max_execution_time', 3000);

if (isset($_POST['from'])) {


$max =$_POST['from'];

function randtel(){

$max =$_POST['from'];
$code_contry =$_POST['code_contry'];
$dcHcanada = explode(',', $code_contry);
  // $dcHcanada = array('+33603xxxxxx','+33606xxxxxx','+33607xxxxxx','+33608xxxxxx','+33630xxxxxx','+33643xxxxxx','+33653xxxxxx','+33660xxxxxx','+33661xxxxxx' ,'+33670xxxxxx' ,'+33670xxxxxx','+33672xxxxxx','+33626xxxxxx','+33622xxxxxx','+33624xxxxxx','+33651xxxxxx','+33668xxxxxx','+33666xxxxxx','+33672xxxxxx','+33676xxxxxx','+33680xxxxxx','+33681xxxxxx','+33682xxxxxx','+33688xxxxxx' );
$nmra = $dcHcanada[array_rand($dcHcanada)];
//$nmra = "+"."1604xxxxxxx";//canda
//$nmra = "+"."974xxxxxxxx"; //qatar

$var = explode("x", $nmra);
$ch7almnx = sizeof($var)-1;
 $xto= substr(str_shuffle("123456789012345678901234567890"), 0, sizeof($var)-1);

 $return = str_replace(' ', '', "+".$var[-0].$xto);
 return  $return;


}
for ($i=0; $i < $max ; $i++) { 


echo randtel()."\n";


}

}

?>
