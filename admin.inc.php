
<?php 
include("bd.php"); 
function p_ust($title="") {
	?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php e($title) ?></title>
	<link href="aa/css/bootstrap.min.css" rel="stylesheet">
	<link href="aa/css/font-awesome.min.css" rel="stylesheet">
	<link href="aa/lib/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="aa/css/scss/style.min.css" rel="stylesheet">
	<link href="aa/lib/expandingSearchBar/component.css" rel="stylesheet">
	<link href="aa/lib/customScrollbar/jquery.mCustomScrollbar.min.css" rel="stylesheet">
	<link href="aa/lib/hover/hover.css" rel="stylesheet">
	<link href="aa/lib/waves/waves.css" rel="stylesheet">
	<link rel="icon" href="aa/favicon.png" type="image/png" />
	<link rel="shortcut icon" href="<?php ci("favicon",64) ?>" type="image/png" />
	<link href="aa/lib/icheck/skins/all.css" rel="stylesheet">
	<link href="aa/lib/animateCss/animate.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="aa/flag/css/flag-icon.min.css" />
	
	<!-- Bootstrap -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="aa/lib/html5shiv/html5shiv.min.js"></script>
		<script src="aa/lib/respondjs/respond.min.js"></script>
	<![endif]-->

	<script type="text/javascript" src="aa/js/jquery-1.11.3.min.js"></script>
	<script src="aa/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="aa/lib/sparklineChart/sparkline.min.js"></script>
	<script type="text/javascript" src="aa/lib/sparklineChart/sparklineant.js"></script>
	<script type="text/javascript" src="aa/lib/expandingSearchBar/uisearch.js"></script>
	<script type="text/javascript" src="aa/lib/expandingSearchBar/classie.js"></script>

	<script type="text/javascript" src="aa/lib/metisMenu/metisMenu.min.js"></script>

	<script type="text/javascript" src="aa/lib/jquery-ui/jquery-ui.js"></script>
	<script type="text/javascript" src="aa/js/buttonsFunctions.js"></script>
	<script type="text/javascript" src="aa/js/functions.js"></script>	
	<script src="aa/lib/codemirror/lib/codemirror.js"></script>
	<link rel="stylesheet" href="aa/lib/codemirror/lib/codemirror.css">
	<script src="aa/lib/codemirror/mode/javascript/javascript.js"></script>
	<?php input_ajax("?ajax=input",".iduzenle"); ?>
	<?php  //jquery_ka(); ?>
	<?php include("admin.js.php"); ?>
<link href="aa/lib/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
 <script src="aa/lib/fileinput/js/fileinput.js" type="text/javascript"></script>


		<script type="text/javascript" src="aa/lib/ckeditor/ckeditor.js"></script>
	<?php
} ?>
<?php function p_header() {
	?>
	
	<div class="preloader">
		<div class="la-ball-pulse la-2x">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
	<div id="modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
		<a href="#" id="evet" class="btn btn-primary">Evet</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
      </div>
    </div>

  </div>
</div>
	<header>
		<div id="headerMain">
			<div id="header">
				<div class="nawbarMain  headerWrapper clearfix">
					<div class="nawbarMainLeft ">
						
						<div class="nawbarMainButtonWrapper">
							<button id="menuIcon" class="hamburger">
								<span></span>
							</button>
						</div>
						<div class="headerLogo">
							<img src="aa/favicon.png" style="width: 57px;
    position: absolute;
    padding: 10px;
    left: 5px;
    top: 3px;" alt="" />
						</div>
						<!--headerLogo-->
					</div>
					<!--nawbarMainLeft-->
					<div class="nawbarMainRight">
						<ul class="nawbarMainMenu">
							<li><a href="index" target="_blank" id="toggle-link" title="Web Sitesine Dön" class="hvr-rectangle-out"><i class="fa fa-globe"></i> </a></li>
							<li><a href="?cikis=1" id="toggle-link" title="Oturumu Kapat" teyit="Oturumu kapatmak üzeresiniz?" class="hvr-rectangle-out"><i class="fa fa-sign-out"></i> </a></li>
						</ul>
						<div class="dropdown nawbarMainMenuSmallLeft">
							<span class="dropdown-toggle dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button">
                                <i class="fa fa-ellipsis-v"></i>
                                </span>
							<ul class="dropdown-menu">
								<li><a href="index" target="_blank" id="" class="reminderIcon"><span class="headerMenuIconIndigo"><i class="fa fa-globe"></i></span>Web Sitesine Dön</a></li>
								<li><a href="?cikis=1" id="" class="reminderIcon"><span class="headerMenuIconIndigo"><i class="fa fa-sign-out"></i></span>Oturumu Kapat</a></li>
							</ul>
						</div>
					</div>
					<!--nawbarMainRight-->
					<div id="sb-search" class="sb-search">
						<form action="?ara" method="post">
							<input class="sb-search-input" placeholder="Bir İçerik Ara..." type="search" value="" name="search" id="search">
							<input class="sb-search-submit" type="submit" value="">
							<span class="sb-icon-search"></span>
						</form>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="mainWrapper">
	
	<?php
} ?>
<?php function p_side(){
	?>
	
		<div id="sideBarWrapper">
			<div id="sideBarContent">
				<div id="bar" class="sideBar sideBarDark">
					<!-- start sitebar-->
					<div class="sideBarUser">
						<div class="sideBarUserConteiner">
							<a href="admin"><img style="    height: 45px;
    margin: 0 auto;
    display: block;" src="aa/pelinom.png" alt="" /></a>
						</div>
						<!--sideBarUserConteiner-->
					</div>
					<div id="menuContent">
						<div id="menuSize">
							<aside class="sidebar">
								<nav class="sidebar-nav">
								<?php include("admin.menu.php"); ?>
									</nav>
							</aside>
						</div>
						<!--menuSize-->
					</div>
					<!--	menuContent-->


					
				</div>
				<!--menuSize-->
			</div>
			<!--sideBar-->
		</div>
		<!--sideBarContent-->
	
	<?php
} ?>
<?php function p_main() {
	?>
<div id="mainWrapper" class="mainConteiner column">
	<div class="mainConteinerConten">
		<div class="container-fluid footerfix">
		<?php include("admin.router.php"); ?>
		</div>
	</div>
</div>
			
	<?php
} ?>
<?php function p_alt(){
	?>
	</div>
<div class="modal modal-default fade bs-example-modal-sm" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Dikkat</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hayır</button>
				<a href="#" id="evet" class="btn btn-default">Evet</a>
			</div>
		</div>
	</div>
</div>
	<!--mainConteinerConten-->
	</body>
</html>
	<?php
} ?>
