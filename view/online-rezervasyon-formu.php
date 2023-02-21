<?php if($c['fiyat']!="")  { 
  ?>
 <form action="?payment" method="post">
         <h2>Online Rezervasyon</h2>
         <p>Her bir kişi için ayrı form doldurunuz. 
            <br> <div class="alert alert-primary"> Kişi başı ücret: <?php e($c['fiyat']) ?> ₺ </div></p>
         Doğum Tarihi
         <input type="date" name="dog_tar" class="form-control" required id="">
         İsim
         <input type="text" name="adi" class="form-control" required id="">
         Soyadı
         <input type="text" name="soyadi" class="form-control" required id="">
         TC Kimlik No:
         <input type="number" minlength="11" maxlength="11" name="tckimlik" class="form-control" required id="">
         Telefon
         <input type="number" name="telefon" class="form-control" required id="">
         
         <button class="btn btn-primary mt-5">Ödeme Adımına Geç</button>
 
 </form>  
 <?php } ?>