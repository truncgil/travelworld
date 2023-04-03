<?php 
include("bd.php"); ?>
<?php function start($c="") { ?>
	
<!DOCTYPE html>
<html lang="<?php wl() ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php meta($c); ?>
	<link rel="shortcut icon" href="assets/images/favicon.png">
	<link rel="stylesheet" id="wp-block-library-css" href="assets/css/style.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="wc-block-style-css" href="assets/css/style.css" type="text/css" media="all">
	<link rel="stylesheet" id="rs-plugin-settings-css" href="assets/css/settings.css" type="text/css" media="all">
	<link rel="stylesheet" id="woocommerce-layout-css" href="assets/css/woocommerce-layout.css" type="text/css" media="all">
	<link rel="stylesheet" id="woocommerce-smallscreen-css" href="assets/css/woocommerce-smallscreen.css" type="text/css" media="only screen and (max-width: 768px)">
	<link rel="stylesheet" id="woocommerce-general-css" href="assets/css/woocommerce.css" type="text/css" media="all">
	<link rel="stylesheet" id="animation.css-css" href="assets/css/animation.css" type="text/css" media="all">
	<link rel="stylesheet" id="jquery-ui-css" href="assets/css/jquery-ui-1.8.24.custom.css" type="text/css" media="all">
	<link rel="stylesheet" id="magnific-popup-css" href="assets/css/magnific-popup.css" type="text/css" media="all">
	<link rel="stylesheet" id="flexslider-css" href="assets/css/flexslider.css" type="text/css" media="all">
	<link rel="stylesheet" id="mediaelement-css" href="assets/css/mediaelementplayer-legacy.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="tooltipster-css" href="assets/css/tooltipster.css" type="text/css" media="all">
	<link rel="stylesheet" id="parallax-css" href="assets/css/parallax.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="flexslider-css-css" href="assets/css/flexslider.css" type="text/css" media="all">
	<link rel="stylesheet" id="supersized-css" href="assets/css/supersized.css" type="text/css" media="all">
	<link rel="stylesheet" id="odometer-theme-css" href="assets/css/odometer-theme-minimal.css" type="text/css" media="all">
	<link rel="stylesheet" id="screen-css-css" href="assets/css/screen.css" type="text/css" media="all">
	<link rel="stylesheet" id="fontawesome-css" href="assets/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="custom_css-css" href="custom-css.php" type="text/css" media="all">
	<link rel="stylesheet" id="google_font1-css" href="assets/css/css_1.css" type="text/css" media="all">
	<link rel="stylesheet" id="responsive-css" href="assets/css/grid.css" type="text/css" media="all">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

	 <!-- <link rel="stylesheet" type="text/css" href="assets/css/additionals.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/truncgil.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

	 <!--<script type="text/javascript" src="assets/js/jquery.js"></script> -->
	<script type="text/javascript" src="assets/js/jquery-migrate.min.js"></script>
	
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
	 <!-- <script type="text/javascript" src="assets/js/additionals.js"></script> -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
	<script type="text/javascript" src="assets/js/custom2.js"></script>
	<script type="text/javascript" src="assets/js/custom.js"></script>
	<style>
		body {
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		}
	</style>
</head>

<body >


        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>
                </div>
              </nav> -->



    <header class="main-header mt-0 mt-md-30">
        <div class="container-fluid">
            <div class="row">
                
                    <nav class="navbar navbar-expand-lg fixed-top navbar-light col-12 col-md-12 bg-white">
                        
                                <div class="col-6 col-lg-2">
                                    <a href="./" class="navbar-brand wh-full">
                                        <img class="w-full-h-auto" src="assets/images/logo.svg" alt="Gezi Dünyası">
                                    </a>
                                </div>
                                <div class="col-6 d-block d-lg-none">
                                    <button class="navbar-toggler f-right" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle Navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="collapse navbar-collapse" id="mainMenu">
                                        <ul class="navbar-nav mr-auto t-center just-m-0-auto" id="navbarUl">
                                            <li class="nav-item active">
                                                <a href="./" class="nav-link">
													<i class="fa fa-home fs-1p3rem"></i>
												</a>
                                            </li>
											<?php $menu = contents("menu"); while($m =kd($menu)) { ?>
											<?php 
											if($m['slug'] == 'arac-kiralama'){
											?>
											<?php $alt = contents($m['slug']); ?>
                                            <!-- Dropdown Link -->
                                            <li class="nav-item <?php if($alt!=0) e("dropdown"); ?>">
												<?php 
													if($m['slug'] == 'hac-umre'){
														$link = '15-ve-25-gunluk-umre-turlari855';
													}else{
														$link = $m['slug'];
													}
												?>
                                                <a href="http://turia.com.tr/router.php?id=arac-kiralama" class="nav-link" <?php if(! isMobile()) { if($alt!=0) { ?>id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>>
                                                 <?php e2($m['title']) ?><?php if($alt!=0) { ?><i class="fa fa-chevron-down mleft-5"></i> <?php } } ?> 
                                                </a>
												<?php if($alt!=0 && $m['slug'] != 'hac-umre') { ?>
														<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
														<?php while($a = kd($alt)) { ?>

															<a href="http://turia.com.tr/router.php?id=arac-kiralama" class="dropdown-item"><?php e2($a['title']) ?></a>
														<?php } ?>
														</div>
												<?php } ?>
                                            </li>
                                            <!-- /Dropdown Link -->
											<?php
											}
											else{
											?>
											<?php $alt = contents($m['slug']); ?>
                                            <!-- Dropdown Link -->
                                            <li class="nav-item <?php if($alt!=0) e("dropdown"); ?>">
												<?php 
													if($m['slug'] == 'hac-umre'){
														$link = '15-ve-25-gunluk-umre-turlari855';
													}else{
														$link = $m['slug'];
													}
												?>
                                                <a href="<?php e($link); ?>" class="nav-link" <?php if($alt!=0) { ?>id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>>
                                                   <?php e2($m['title']) ?><?php if($alt != 0){ ?><i class="fa fa-chevron-down mleft-5"></i><?php } ?>
                                                </a>
												<?php if($alt!=0 && $m['slug'] != 'hac-umre') { ?>
														<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
														<?php while($a = kd($alt)) { ?>

															<a href="<?php e($a['slug']) ?>" class="dropdown-item"><?php e2($a['title']) ?></a>
														<?php } ?>
														</div>
												<?php } ?>
                                            </li>
                                            <!-- /Dropdown Link -->
											<?php } } ?>
											<li class="nav-item dropdown">
<?php $selectedLang = oturum("dil");
if($selectedLang=="tr") $selectedLang = "Türkçe";
if($selectedLang=="gb") $selectedLang = "English";
if($selectedLang=="ru") $selectedLang = "Русский";
if($selectedLang=="sa") $selectedLang = "عربي";
 ?>
                                                <a href="#" class="nav-link" <?php if(! isMobile()) { ?>id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>>
                                                <?php e($selectedLang) ?><i class="fa fa-chevron-down mleft-5"></i>
                                                </a>

                                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">


                                                            <a href="?dil=tr" class="dropdown-item"><?php e2("Türkçe") ?></a>
                                                            <a href="?dil=gb" class="dropdown-item"><?php e2("English") ?></a>
                                                            <a href="?dil=ru" class="dropdown-item"><?php e2("Русский") ?></a>
                                                            <a href="?dil=sa" class="dropdown-item"><?php e2("عربي") ?></a>

                                                        </div>

                                            </li>
                                        </ul>
										<form method="GET" action="ara" class="form-inline d-none">
											<div class="w-auto h-auto m-0-auto">
												<input style="float: left;" name="q" id="searchInput" class="form-control m-0-auto m-md-unset" type="search" placeholder="Ara..." aria-label="Search" data-visible="false">
												<button id="searchButton" type="submit" class="search-button">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</form>
                                    </div>
                                </div>
                                <div class="d-none t-center">
                                    <a href="./" class="wh-full">
                                        <img class="w-75p h-auto" src="assets/images/turia.png" alt="Turia">
                                    </a>
                                </div>
                        
                    </nav>
                
            </div>
        </div>
    </header>
	
	<?php
		$custom_bg = '';
		if($c['slug'] == 'ucak-bileti' || $c['slug'] == 'otel'){
			$custom_bg = 'style="background-image: url(file/'.$c['pic'].');" class="custom-bg"';
		}
	?>
	<!-- Begin template wrapper -->
	<div id="wrapper" <?php echo $custom_bg; ?>>
		
<?php } ?>

<?php function finish() { ?>
<a class="fx-whatsapp" title="WhatsApp'tan iletişime geçin" href="https://api.whatsapp.com/send?phone=<?php set('WhatsApp İletişim Numarası(+90 ile giriniz)'); ?>&text=<?php set('WhatsApp İletişim Metni'); ?>">
	<img src="assets/images/whatsapp.png">
</a>
<div class="footer_bar ">
		<div id="footer" class>
			<ul class="sidebar_widget four">
            <div class="container-fluid">
                <div class="row">
                    
               <div class="col-12 col-md-10 offset-md-1">
                <div class="row">
                    
                
                

				<li id="text-2" class="col-12 col-md-3">
					<div class="textwidget">
						<div style="text-align:left;margin-top:10px;">
							<a href="./" class="w-full-h-auto">
								<img src="assets/images/logo.svg" alt="Gezi Dünyası" class="w-full-h-auto main-logo">
							</a>
							<p></p>
							<div style="margin-top:10px;">
							<?php set("Açıklama") ?></div>
						</div>
					</div>
				</li>
				<li id="text-3" class="col-12 col-md-3">
					<h2 class="widgettitle">İletişim</h2>
					<div class="textwidget">
						<ul class="address">
							<li>
								<i class="fa fa-map-marker"></i>
								<?php set('Açık Adres'); ?>
							</li>
							<li>
								<i class="fa fa-phone"></i>
								<a href="tel:<?php set('Birinci Telefon'); ?>"><?php set('Birinci Telefon Gösterim'); ?></a>
							</li>
							<li>
								<i class="fa fa-mobile"></i>
								<a href="tel:<?php set('İkinci Telefon'); ?>"><?php set('İkinci Telefon Gösterim'); ?></a>
							</li>
							<li><i class="fa fa-envelope"></i>
								<a href="mailto:<?php set('E-Posta'); ?>"><?php set('E-Posta'); ?></a>
							</li>
							<li><i class="fa fa-globe"></i>
								<a href="https://<?php set('Web Sitesi'); ?>"><?php set('Web Sitesi'); ?></a>
							</li>
						</ul>
					</div>
				</li>
				<li id="recent-posts-6" class="col-12 col-sm-6 col-md-3">
					<h2 class="widgettitle">Turlar</h2>
					<ul>
					<?php $turlar = ksorgu("content","where kid='turlar' AND y=1 ORDER BY RAND() DESC limit 5"); while($t = kd($turlar)) { ?>
						<li>
							<a href="<?php e($t['slug']) ?>"><?php e2($t['title']) ?></a>
						</li>
					<?php } ?>
					
						
					</ul>
				</li>
				<li id="tag_cloud-5" class="col-12 col-md-3">
					<h2 class="widgettitle">Konum</h2>
					<div class="w-full-h-auto">
						<iframe class="iframe-map-smaller" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12734.086060011217!2d37.3682083!3d37.0688841!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb2101f0ad277f1c!2sTuria%20Turizm%20%7C%20Gezi%20D%C3%BCnyas%C4%B1%20Seyahat%20Acentas%C4%B1%20%7C%20Gaziantep!5e0!3m2!1str!2str!4v1566601704440!5m2!1str!2str" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
					</div>
                </li>
                <div class="col-12">
                    <p class="t-center pt-20 color-white">GEZİ DÜNYASI BİR <img src="assets/images/turia.png" class="h-3rem w-auto" alt="Turia"> TURİZM SEYAHAT TAŞ. TİC. LTD. ŞTİ. KURULUŞUDUR</p>
                </div>
            </div>
            </div>
            </div>
            </div>
			</ul>

			<br class="clear">
		</div>

		<div class="footer_bar_wrapper ">
			<div class="social_wrapper">
				<ul>
					<li class="facebook"><a class="facebook" href="<?php set("facebook") ?>"><i class="fa fa-facebook"></i></a></li>
					<li class="twitter"><a class="twitter" href="<?php set("twitter") ?>"><i class="fa fa-twitter"></i></a></li>
					<li class="youtube"><a class="youtube" title="Youtube" href="<?php set("youtube") ?>"><i class="fa fa-youtube"></i></a></li>
					<li class="instagram"><a class="instagram" title="Instagram" href="<?php set("instagram") ?>"><i class="fa fa-instagram"></i></a></li>
				</ul>
			</div>
			<div id="copyright">© Copyright <a href="https://www.turia.com.tr/">Turia Turizm</a>. Designed by <a href="https://www.truncgil.com.tr/" class="truncgil">Trunçgil Teknoloji</a></div><br class="clear">
			<div id="toTop" class="to-top-btn"><i class="fa fa-angle-up"></i></div>
		</div>
	</div>


	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"></script>
	<script>
		$(function(){
			$(".tckimlik").mask('00000000000');
		});
	</script>
	<script type="text/javascript" src="assets/js/jquery.blockUI.min.js"></script>
	<script type="text/javascript" src="assets/js/add-to-cart.min.js"></script>
	<script type="text/javascript" src="assets/js/js.cookie.min.js"></script>
	<script type="text/javascript" src="assets/js/woocommerce.min.js"></script>
	<script type="text/javascript" src="assets/js/cart-fragments.min.js"></script>
	<script type="text/javascript" src="assets/js/js.js"></script>
	<script type="text/javascript" src="assets/js/parallax.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.easing.js"></script>
	<script type="text/javascript" src="assets/js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="assets/js/waypoints.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.isotope.js"></script>
	<script type="text/javascript" src="assets/js/jquery.masory.js"></script>
	<script type="text/javascript" src="assets/js/jquery.tooltipster.min.js"></script>
	<script type="text/javascript" src="assets/js/custom_plugins.js"></script>
	<script type="text/javascript" src="assets/js/custom.js"></script>
	<script type="text/javascript" src="assets/js/wp-embed.min.js"></script>
	<script type="text/javascript" src="assets/js/core.min.js"></script>
	<script type="text/javascript" src="assets/js/datepicker.min.js"></script>
	<script type="text/javascript" src="assets/js/custom-date.js"></script>
	<script type="text/javascript" src="assets/js/jquery.flexslider-min.js"></script>

	<script type="text/javascript" src="assets/js/odometer.min.js"></script>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y46H3XXD78">
	</script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-Y46H3XXD78');
	</script>

</body>

</html>

<?php } ?>
