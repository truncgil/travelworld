<?php if($c['fiyat']!="")  { 
  ?>
 <form action="?payment" method="post">
         <h2><?php e2("Online Rezervasyon") ?></h2>
         <p><?php e2("Her bir kişi için ayrı form doldurunuz. ") ?>
            <br> <div class="alert alert-primary"><?php e2(" Kişi başı ücret") ?>: <?php e($c['fiyat']) ?> ₺ </div></p>
         <?php e2("Doğum Tarihi") ?>
         <input type="date" name="dog_tar" class="form-control" required id="">
         <?php e2("İsim") ?>
         <input type="text" name="adi" class="form-control" required id="">
         <?php e2("Soyadı") ?>
         <input type="text" name="soyadi" class="form-control" required id="">
         <?php e2("TC Kimlik No") ?>
         <input type="number" minlength="11" maxlength="11" name="tckimlik" class="form-control" required id="">
         <?php e2("Telefon") ?>
         <input type="number" name="telefon" class="form-control" required id="">
         
         <button class="btn btn-primary mt-5"><?php e2("Ödeme Adımına Geç") ?></button>
 
 </form>  
 <?php } ?>