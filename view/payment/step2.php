<style>
    .bilgi-form h2 {
        font-size:16px
    }
    .kimlik {
        border:solid 1px #999;
        padding:10px;
        margin-top:10px;
        margin-bottom:10px;
        border-radius: 10px;

    }
</style>
<form action="?t=<?php e(get("t")) ?>&step=3" method="post" class="bilgi-form" id="bilgi-form">
    <input type="hidden" name="yetiskin" value="<?php e(post("yetiskin")) ?>">
    <input type="hidden" name="cocuk" value="<?php e(post("cocuk")) ?>">
    <input type="hidden" name="bebek" value="<?php e(post("bebek")) ?>">
    <input type="hidden" name="telefon" value="<?php e(post("telefon")) ?>">
    <input type="hidden" name="email" value="<?php e(post("email")) ?>">
    <input type="hidden" name="adres" value="<?php e(post("adres")) ?>">

    <?php for($k=1;$k<=post("yetiskin");$k++) {
        $type = "yetiskin";
         ?>
         <div class="kimlik">
            <h2><?php e($k) ?>. Yetişkin Kimlik Bilgileri</h2>
            <div class="row">
                <?php include("form.php") ?>
            </div>
         </div>

         <?php 
    } ?>
    <?php if(!postesit("cocuk",0))  { 
        $type = "cocuk";
      ?>
     <?php for($k=1;$k<=post("cocuk");$k++) {
          ?>
          <div class="kimlik">
            <h2><?php e($k) ?>. <?php e(yasConverter($type)) ?> Kimlik Bilgileri</h2>
            <div class="row">
                <?php include("form.php") ?>
            </div>
          </div>
 
          <?php 
     } ?>
  
     <?php } ?>

     <?php if(!postesit("bebek",0))  { 
        $type = "bebek";
      ?>
     <?php for($k=1;$k<=post("bebek");$k++) {
          ?>
          <div class="kimlik">
            <h2><?php e($k) ?>. <?php e(yasConverter($type)) ?> Kimlik Bilgileri</h2>
            <div class="row">
                <?php include("form.php") ?>
            </div>
          </div>
 
          <?php 
     } ?>
  
     <?php } ?>
     <button class="btn btn-primary send d-none">send</button>

</form>