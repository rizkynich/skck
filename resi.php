<?php
$mysqli = new mysqli("localhost", "root", "", "skck");
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="description" content="Pembuatan SKCK Online Polda Metro Jaya">
<meta name="keywords" content="Pembuatan SKCK Online">
<meta name="author" content="Polda Metro Jaya">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- SITE TITLE -->
<title>SKCK - Kepolisian</title>

<!-- =========================
      FAV AND TOUCH ICONS  
============================== -->
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

<!-- =========================
     STYLESHEETS   
============================== -->
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- FONT ICONS -->
<!-- IonIcons -->
<link rel="stylesheet" href="assets/ionicons/css/ionicons.css">

<!-- Font Awesome 
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
-->

<!-- Elegant Icons -->
<link rel="stylesheet" href="assets/elegant-icons/style.css">
<!--[if lte IE 7]><script src="assets/elegant-icons/lte-ie7.js"></script><![endif]-->



<!-- CAROUSEL AND LIGHTBOX -->
<link rel="stylesheet" href="css/owl.theme.css">
<link rel="stylesheet" href="css/owl.carousel.css">
<link rel="stylesheet" href="css/nivo-lightbox.css">
<link rel="stylesheet" href="css/nivo_themes/default/default.css">

<!-- COLORS -->
<link rel="stylesheet" href="css/colors/orange.css"> <!-- DEFAULT COLOR/ CURRENTLY USING -->

<!-- CUSTOM STYLESHEETS -->
<link rel="stylesheet" href="css/styles.css">

<!-- RESPONSIVE FIXES -->
<link rel="stylesheet" href="css/responsive.css">

<!-- STEPS STYLE FIXES -->
<link rel="stylesheet" href="css/jquery.steps.css">

<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.steps.js"></script>

<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
<![endif]-->

<!-- ****************
      After neccessary customization/modification, Please minify HTML/CSS according to http://browserdiet.com/en/ for better performance
     **************** -->
     
</head>

<body>

<!-- =========================
     PRE LOADER       
============================== -->
<div class="preloader">
  <div class="status">&nbsp;</div>
</div>

<!-- =========================
     HEADER   
============================== -->
<header id="home">

<!-- COLOR OVER IMAGE -->
<div class="color-overlay">
	
	<div class="navigation-header">
		
		<!-- STICKY NAVIGATION -->
		<div class="navbar navbar-inverse bs-docs-nav navbar-fixed-top sticky-navigation">
			<div class="container">
				<div class="navbar-header">
					
					<!-- LOGO ON STICKY NAV BAR -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#landx-navigation">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><img src="images/logo-dark.png" alt=""></a>
					
				</div>
				
				<!-- NAVIGATION LINKS -->
				<div class="navbar-collapse collapse" id="landx-navigation">
					<ul class="nav navbar-nav navbar-right main-navigation">
						<li><a href="/skck/index.php">Home</a></li>
						<li><a href="/skck/index.php#section1">Data Pendukung</a></li>
						<li><a href="/skck/index.php#section2">Tentang SKCK</a></li>
						<li><a href="/skck/index.php#section3">Syarat & Ketentuan</a></li>
						<li><a href="/skck/index.php#section4">Kontak</a></li>
					</ul>
				</div>
				
			</div>
			<!-- /END CONTAINER -->
			
		</div>
		
		<!-- /END STICKY NAVIGATION -->
		
	</div>
	
</div>

</header>



<!-- =========================
     SECTION 1   
============================== -->
<section>

<div class="container">
	<br/>
	<h3>RESI SKCK ONLINE</h3>
	<div class="colored-line">
	</div>
	<style type="text/css">
		table thead tr td.text_left {
			text-align: left;
		}

		table tbody tr td.text_left {
			text-align: left;
		}
	</style>
	<?php

		$Q = "SELECT A.*, B.name as provinsi, C.name AS kabupaten, D.name AS kecamatan, E.name AS kelurahan FROM registrasi AS A 
			LEFT JOIN provinces AS B ON A.prov = B.id 
			LEFT JOIN regencies AS C ON A.kab = C.id 
			LEFT JOIN districts AS D ON A.kec = D.id 
			LEFT JOIN villages AS E ON A.kel = E.id 
			WHERE nomor_registrasi = '".$_GET['data']."'";
		$result = $mysqli->query($Q);

		if(mysqli_num_rows($result) > 0){
			$row = $result->fetch_object();

			#generate QRCode
			#include('phpqrcode/qrlib.php');
	        $data = "http://localhost/skck/resi.php?data=".$_GET['data'];
	        $filename = "tmp/".$_GET['data'].'.png';
		     
		    // generating 
		    // QRcode::png($data, $filename, QR_ECLEVEL_H, 3); 

			include('phpbarcode/code128.class.php');
			$barcode = new phpCode128('SKCK-'.$_GET['data'].'-ONLINE', 150, 'c:\windows\fonts\verdana.ttf', 18);
			$barcode->saveBarcode($filename);

			?>
			<div style="border: 1px solid #000;background-color: #eee;padding: 10px;color:#000;">
				<table width="100%">
					<thead>
						<tr style="border-bottom: 1px solid #000;">
							<td><img src="images/logo-dark.png" class="img-responsive"></td>
							<td></td>
							<td style="text-align: right;">
								<b>NOMOR REGISTRASI : <?php echo $row->nomor_registrasi;?></b> <br/>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="3">
								<table width="100%">
									<tbody>
										<tr>
											<td width="200" class="text_left">NAMA LENGKAP</td>
											<td width="10">:</td>
											<td class="text_left"><?php echo strtoupper($row->nama_lengkap);?></td>
											<td rowspan="7" style="text-align: right;"><img src="<?php echo $filename;?>"></td>
										</tr>
										<tr>
											<td width="200" class="text_left">ALAMAT</td>
											<td width="10">:</td>
											<td class="text_left"><?php echo strtoupper($row->alamat);?></td>
										</tr>
										<tr>
											<td width="200" class="text_left">RT / RW </td>
											<td width="10">:</td>
											<td class="text_left"><?php echo strtoupper($row->rt).'/'.strtoupper($row->rw);?></td>
										</tr>
										<tr>
											<td width="200" class="text_left">KELURAHAN / DESA </td>
											<td width="10">:</td>
											<td class="text_left"><?php echo strtoupper($row->kelurahan);?></td>
										</tr>
										<tr>
											<td width="200" class="text_left">KECAMATAN </td>
											<td width="10">:</td>
											<td class="text_left"><?php echo strtoupper($row->kecamatan);?></td>
										</tr>
										<tr>
											<td width="200" class="text_left">KABUPATEN / KOTA</td>
											<td width="10">:</td>
											<td class="text_left"><?php echo strtoupper($row->kabupaten);?></td>
										</tr>
										<tr>
											<td width="200" class="text_left">KETERANGAN</td>
											<td width="10">:</td>
											<td class="text_left"><?php echo strtoupper($row->keterangan);?></td>
										</tr>
									</tbody>
								</table>

							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr style="border-top: 1px solid #000;">
							<td colspan="3"><b><i>** <?php echo strtoupper("Bebas Pungli , anti korupsi, cepat, tepat, tranparan, dan accountable");?> **</i></b></td>
						</tr>
					</tfoot>
				</table>
			</div>
			<br/>
			<a href="cetak.php?data=1476903952-3202190006" class="btn btn-primary" target="_blank">CETAK</a>
			<br/>
			<?php
		} else {
			echo "Data Tidak Ditemukan";
		}
	?>
	<br/>
</div> <!-- /END CONTAINER -->
</section>



<!-- =========================
     SECTION 8 - CTA  
============================== -->
<section class="cta-section" id="section4">
<div class="color-overlay">
	
	<div class="container">
		
		<h4>Kami siap memberikan yang terbaik </h4>
		<h2>Untuk kepentingan Masyarakat</h2>
			
				<center><img src="images/Lambang_Polri.png" class="img-responsive"></center>
		
				
	</div>  <!-- /END CONTAINER -->
</div>  <!-- /END COLOR OVERLAY -->

</section>


<!-- =========================
     SECTION 10 - FOOTER 
============================== -->
<footer class="bgcolor-2">
<div class="container">
	
	<div class="footer-logo">
		<img src="images/logo-dark.png" alt="">
	</div>
	
	<div class="copyright">
		 ©2015 Kepolisian Republik Indonesia.
	</div>
	
	<ul class="social-icons">
		<li><a href=""><span class="social_facebook_square"></span></a></li>
		<li><a href=""><span class="social_twitter_square"></span></a></li>
		<li><a href=""><span class="social_pinterest_square"></span></a></li>
		<li><a href=""><span class="social_googleplus_square"></span></a></li>
		<li><a href=""><span class="social_instagram_square"></span></a></li>
		<li><a href=""><span class="social_linkedin_square"></span></a></li>
	</ul>
	
</div>
</footer>


<!-- =========================
     SCRIPTS   
============================== -->

<script>
/* =================================
   LOADER                     
=================================== */
// makes sure the whole site is loaded
jQuery(window).load(function() {
	"use strict";
        // will first fade out the loading animation
	jQuery(".status").fadeOut();
        // will fade out the whole DIV that covers the website.
	jQuery(".preloader").delay(1000).fadeOut("slow");
})

</script>

<script src="js/bootstrap.min.js"></script>
<script src="js/retina-1.1.0.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.localScroll.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/simple-expand.min.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/jquery.fitvids.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/custom.js"></script>
<!-- ****************
      After neccessary customization/modification, Please minify JavaScript/jQuery according to http://browserdiet.com/en/ for better performance
     **************** -->
</body>
</html>
<?php
$mysqli->close();
?>