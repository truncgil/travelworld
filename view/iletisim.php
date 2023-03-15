 <div id="page_caption" class="hasbg parallax"
			data-image="assets/images/1600x1200-12.jpg"
			data-width="1600" data-height="1200">
			<div class="page_title_wrapper">
				<h1><?php e2("İletişim") ?></h1>
			</div>
			<div class="parallax_overlay_header"></div>
		</div>

		<!-- Begin content -->
		<div id="page_content_wrapper" class="hasbg ">
            <div class="page_title_wrapper w-100 t-center">
				
			<div class="inner">
				<!-- Begin main content -->
				<div class="inner_wrapper">
					<div class="sidebar_content full_width">

						<div style="text-align:center">
							<?php 
								$str = "İLETİŞİM";
								$len = mb_strlen($str, 'UTF-8');
								$result = [];
								for ($i = 0; $i < $len; $i++) {
									$result[] = mb_substr($str, $i, 1, 'UTF-8');
								}
								$a = $result;
								$a_first = floor(count($a) / 2);
								$a_second = count($a) - $a_first;
								$fstr = implode(array_slice($result, 0, $a_first));
								$sstr = implode(array_slice($result, $a_first, $a_second));

								
								
							?>
							<h2 class="ppb_title d-none"><span class="renk-1"><?php e($fstr); ?></span> <span class="renk-2"><?php e($sstr); ?></span></h2>

						</div>
						<div class="icerik">
                            <div class="container">
                                <div class="row mt-30">
                                    <div class="col-12 col-md-6">
                                        <table class="contact-table">
                                            <tr>
                                                <td class="contact-icon">
                                                    <i class="fa fa-phone"></i>
                                                </td>
                                                <td>
                                                    <a href="tel:<?php set('Birinci Telefon'); ?>"><?php set('Birinci Telefon Gösterim'); ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="contact-icon">
                                                    <i class="fa fa-phone"></i>
                                                </td>
                                                <td>
                                                    <a href="tel:<?php set('İkinci Telefon'); ?>"><?php set('İkinci Telefon Gösterim'); ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="contact-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </td>
                                                <td>
                                                    <a href="mailto:<?php set('E-Posta'); ?>"><?php set('E-Posta'); ?></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="contact-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </td>
                                                <td>
													<a href="https://g.page/gezidunyasi_tr?share">
                                                    <?php set('Açık Adres'); ?>
													</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="contact-icon">
                                                    <i class="fa fa-globe"></i>
                                                </td>
                                                <td>
                                                    <a href="https://<?php set('Web Sitesi'); ?>">
                                                        <?php set('Web Sitesi'); ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-6 mt-10-xs-else-md">
                                        <iframe class="iframe-map-larger" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12734.086060011217!2d37.3682083!3d37.0688841!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb2101f0ad277f1c!2sTuria%20Turizm%20%7C%20Gezi%20D%C3%BCnyas%C4%B1%20Seyahat%20Acentas%C4%B1%20%7C%20Gaziantep!5e0!3m2!1str!2str!4v1566627236516!5m2!1str!2str" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                    </div>
                                    <div class="col-12 mt-20" id="siziArayalim">
									        <?php 
if(getisset("ekle")) {
    //exit();
	dEkle("content",array(
		"kid"=>"İLETİŞİM",
		"slug"=>"İLETİŞİM",
		"type"=>"İLETİŞİM",
		"date" => simdi(),
		"json" => json_encode($_POST)
	));
	$html = "";
	foreach($_POST AS $alan => $deger) {
		$html .= "$alan : $deger <br />";
	}
	mailGonder(set("Admin Mail",1),"Mesajınız Var",$html);
	bilgi("Bilgileriniz kaydedildi. En kısa zamanda tarafınıza iletişime geçilecektir");
}

 ?>

                                        <h3 class="w-full t-center"><?php e2("Sizi Arayalım") ?></h3>
                                        <form action="?ekle" method="POST">
                                            <div class="form-group">
                                                <label for="ad"><?php e2("Adınız") ?></label>
                                                <input type="text" name="ad" id="ad" class="form-control" placeholder="Adınız ve Soyadınız">
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><?php e2("E-Mail") ?></label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail Adresiniz">
                                            </div>
                                            <div class="form-group">
                                                <label for="telefon"><?php e2("Telefon") ?></label>
                                                <input type="tel" name="telefon" id="telefon" class="form-control" placeholder="Telefon Numaranız">
                                            </div>
                                            <div class="form-group">
                                                <label for="mesaj"><?php e2("Mesajınız") ?></label>
                                                <textarea name="mesaj" id="mesaj" class="form-control" placeholder="İletmek istediğiniz mesaj"></textarea>
                                            </div>
                                            <div class="f-right">
                                                <button type="submit" class="btn btn-primary"><?php e2("Gönder") ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
				<!-- End main content -->
			</div>
		</div>
		<br class="clear"><br><br>


	</div>