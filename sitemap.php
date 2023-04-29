<?php 
set_time_limit(0);
include("tema.php"); 
header('Content-type: text/xml'); 
$url = "https://gezidunyasi.com.tr"."/";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"> 

	<?php
	if(getisset("t")) {
		$tip = veri(get("t"));
		$tip = "AND type=$tip";
	} else {
		$tip ="AND type IN('Tur', 'Tur Kategorisi', 'Sayfa', 'Menü', 'Diğer')";
	} 
	$content = ksorgu("content","where slug IS NOT NULL $tip AND y=1");
	?>
	<?php while($c = kd($content)) { ?>
	<url>
		<loc><?php e($url) ?><?php e($c['slug']) ?></loc>
		<?php if($c['pic']!="") { 
		if(strpos($c['pic'],"http")!==false) $url ="";
		
		$c['pic'] = htmlentities($c['pic']);
		$c['title']  = hok($c['title']);
		?>
		<image:image>
		  <image:loc><?php e($url) ?>file/<?php e($c['pic']) ?></image:loc>
		  <image:caption><?php e($c['title']) ?></image:caption>
		  <image:title><?php e($c['title']) ?></image:title>
		</image:image>
		<?php } ?>
		<lastmod><?php echo date("Y-m-d") ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.5</priority>
	</url>
	<?php } ?>
</urlset>

<?php //finish(); ?>