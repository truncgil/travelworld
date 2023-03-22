<?php 
switch ($type) {
    case 'yetiskin':
            $min = "-11 years";
            $max = "-120 years";
        break;
    case 'cocuk':
            $min = "-6 years";
            $max = "-11 years";
        break;
    case 'bebek':
            $min = "0 years";
            $max = "-5 years";
        break;
    
    default:
        # code...
        break;
}
$min = date("Y-m-d",strtotime($min));
$max = date("Y-m-d",strtotime($max));
?>
<div class="col-md-3">
    Doğum Tarihi
    <input type="date" name="<?php e($type) ?>_<?php e($k) ?>_dog_tar" min="<?php e($max) ?>" max="<?php e($min) ?>" class="form-control" required id="">
</div>
<div class="col-md-3">
    İsim
    <input type="text" name="<?php e($type) ?>_<?php e($k) ?>_adi" class="form-control" required id="">
</div>
<div class="col-md-3">
    Soyadı
    <input type="text" name="<?php e($type) ?>_<?php e($k) ?>_soyadi" class="form-control" required id="">
</div>
<div class="col-md-3">
    TC Kimlik No:
    <input type="number" min="11" max="11" name="<?php e($type) ?>_<?php e($k) ?>_tckimlik" class="form-control" required id="">
</div>
