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
	<h3>PENDAFTARAN SKCK ONLINE</h3>
	<div class="colored-line">
	</div>

    <script>
        $(function ()
        {
        	var form = $("#form_registrasi");
			form.validate({
			    errorPlacement: function errorPlacement(error, element) { element.before(error); }
			});

            form.children("div").steps({
                headerTag: "h2",
                bodyTag: "section",
                transitionEffect: "slideLeft",
			    onStepChanging: function (event, currentIndex, newIndex)
			    {
			        if (currentIndex > newIndex) {
			            return true;
			        } else {
				        form.validate().settings.ignore = ":disabled,:hidden";
				        return form.valid();
			        }
			    },
			    onFinishing: function (event, currentIndex)
			    {
			        form.validate().settings.ignore = ":disabled";
			        return form.valid();
			    },
                onFinished: function (event, currentIndex)
			    {
			        document.theForm.submit();
			    }
            });
        });
    </script>
    <form action="function.php?a=save" enctype="multipart/form-data" method="POST" name="theForm" id="form_registrasi">
	    <div id="wizard">
        	<style type="text/css">
        		table thead tr td.text_left {
        			text-align: left;
        		}

        		table tbody tr td.text_left {
        			text-align: left;
        		}
        	</style>
        	<script type="text/javascript">
				$(".kewaraganegaraan").change(function() {
				    var selectedValue = this.value;
				    $.ajax({
				        url: 'function.php?a=kewaraganegaraan',
				        type: 'POST',
				        data: {option : selectedValue},
				        success: function(result) {
				            console.log("Data sent!");
				        	$("#jenis_identitas").html(result);
				        }
				    });

				    if(selectedValue == "1"){
				    	$("#no_kitas_kitap").val("");
				    	$("#no_kitas_kitap").attr( "readonly", "true" );

				    	$("#dok_kitas_kitap").val("");
				    	$("#dok_kitas_kitap").removeAttr( "required" );
				    	$("#dok_kitas_kitap").hide();
				    } else {
				    	$("#no_kitas_kitap").val("");
				    	$("#no_kitas_kitap").removeAttr( "readonly" );

				    	$("#dok_kitas_kitap").val("");
				    	$("#dok_kitas_kitap").show();
				    	$("#dok_kitas_kitap").attr( "required", "true" );
				    }
				});

				$("#jenis_identitas").change(function() {
				    var selectedValue = this.value;

				    if(selectedValue == "3"){
				    	$("#no_ktp").val("");
				    	$("#no_ktp").attr( "readonly", "true" );
				    	$("#no_ktp").removeAttr( "required" );
				    } else {
				    	$("#no_ktp").val("");
				    	$("#no_ktp").attr( "required", "true" );
				    	$("#no_ktp").removeAttr( "readonly" );
				    }
				});

				$("#no_ktp").blur(function() {
				    var selectedValue = this.value;
				    $.ajax({
				        url: 'http://localhost/skck/services/public/api/registrasi/'+selectedValue,
				        type: 'GET',
				        success: function(result) {
				            console.log("Data sent!");
				        	$("#pre_date").val(result.data.tanggal_lahir);
				    		$("#tanggal_lahir").val(result.data.tanggal_lahir);
				        }
				    });
				});

				$("#pre_date").change(function() {
				    var selectedValue = this.value;
				    $("#tanggal_lahir").val(selectedValue);
			    	$("#tanggal_lahir").attr( "readonly", "true" );
				});
			</script>


	        <h2>Informasi Umum</h2>
	        <section>
	        	<table width="100%" class="table">
	        		<thead>
	        			<tr>
	        				<td colspan="2" class="text_left"><b>Data Kewarganegaraan</b></td>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<tr>
	        				<td class="text_left" width="300">1. Kewarganegawaan</td>
	        				<td class="text_left">
	        					<div class="row">
									<div class="col-md-7">
										<label class="radio-inline">
											<input type="radio" name="kewaraganegaraan" value="1" class="kewaraganegaraan" required>
											WNI
											</label>
										<label class="radio-inline">
											<input type="radio" name="kewaraganegaraan" value="2" class="kewaraganegaraan" required>
											WNA
										</label>
									</div>
	        					</div>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left">2. Identitas </td>
	        				<td>
	        					<select name="jenis_identitas" class="form-control" id="jenis_identitas" required>
	        						<option value=""> - Pilih Jenis Identitas - </option>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left">3. Nomor KITAS / KITAP</td>
	        				<td><input type="text" name="no_kitas_kitap" class="form-control" placeholder="NO KITAS / KITAB" id="no_kitas_kitap" /></td>
	        			</tr>
	        			<tr>
	        				<td class="text_left">4. Nomor KTP</td>
	        				<td><input type="text" name="no_ktp" class="form-control" placeholder="NO KTP" id="no_ktp" /></td>
	        			</tr>
	        			<tr>
	        				<td class="text_left">5. Tangga Lahir</td>
	        				<td><input type="date" name="tanggal_lahir" class="form-control" id="pre_date" required /></td>
	        			</tr>
	        		</tbody>
	        	</table>
	        </section>

	        <h2> Upload Dokumen</h2>
	        <section>
	        	<table width="100%" class="table">
	        		<thead>
	        			<tr>
	        				<td colspan="2" class="text_left"><b>Dokumen Pendukung</b></td>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<tr>
	        				<td class="text_left" width="400">1. KTP</td>
	        				<td><input type="file" name="lampiran_ktp" class="form-control" required /></td>
	        			</tr>
	        			<tr>
	        				<td class="text_left">2. KITAS / KITAP </td>
	        				<td><input type="file" name="lampiran_kitas_kitap" class="form-control" id="dok_kitas_kitap" required /></td>
	        			</tr>
	        			<tr>
	        				<td class="text_left">3. Kartu Keluarga ( KK )</td>
	        				<td><input type="file" name="lampiran_kk" class="form-control" required /></td>
	        			</tr>
	        			<tr>
	        				<td class="text_left">4. Akta Kelahiran</td>
	        				<td><input type="file" name="lampiran_akta_lahir" class="form-control" required /></td>
	        			</tr>
	        		</tbody>
	        	</table>
	        	<script type="text/javascript">
					$("#prov").change(function() {
					    var selectedValue = this.value;
					    $.ajax({
					        url: 'function.php?a=kab',
					        type: 'POST',
					        data: {option : selectedValue},
					        success: function(result) {
					            console.log("Data sent!");
					        	$("#kab").html(result);
					        }
					    });
					});

					$("#kab").change(function() {
					    var selectedValue = this.value;
					    $.ajax({
					        url: 'function.php?a=kec',
					        type: 'POST',
					        data: {option : selectedValue},
					        success: function(result) {
					            console.log("Data sent!");
					        	$("#kec").html(result);
					        }
					    });
					});

					$("#kec").change(function() {
					    var selectedValue = this.value;
					    $.ajax({
					        url: 'function.php?a=kel',
					        type: 'POST',
					        data: {option : selectedValue},
					        success: function(result) {
					            console.log("Data sent!");
					        	$("#kel").html(result);
					        }
					    });
					});
				</script>
	        	<table width="100%" class="table">
	        		<thead>
	        			<tr>
	        				<td colspan="2" class="text_left"><b>Polres yang dituju</b></td>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<tr>
	        				<td class="text_left" width="400">Provinsi</td>
	        				<td class="text_left">
	        					<select name="prov" class="form-control" id="prov" required>
	        						<option value=""> - Pilih Provinsi - </option>
	        						<?php
	        							$result = $mysqli->query("SELECT * FROM provinces");
									    while ($row = $result->fetch_object()){
									        echo '<option value="'.$row->id.'"  style="text-align: left;"> '.$row->name.' </option>';
									    }
									    // Free result set
									    $result->close();
	        						?>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left">Kabupaten / Kota</td>
	        				<td class="text_left">
	        					<select name="kab" class="form-control" id="kab" required>
	        						<option value=""> - Pilih Kabupaten / Kota - </option>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td colspan="2" class="text_left"> <p class="info"><b><i>Keterangan : Dokumen asli harap dibawa untuk proses validasi data anda</i></b></p>
	        				</td>
	        			</tr>
	        		</tbody>
	        	</table>
	        </section>
	        
	        <h2> Data Pemohon</h2>
	        <section>
	        	<table width="100%" class="table">
	        		<tbody>
	        			<tr>
	        				<td class="text_left" width="300">1. Nama</td>
	        				<td class="text_left">
	        					<input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required />
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left" width="300">2. Tempat / Tanggal Lahir</td>
	        				<td class="text_left">
	        					<div class="row">
									<div class="col-md-6"><input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required /></div>
									<div class="col-md-6"><input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required /></div>
	        					</div>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left" width="300">3. Jenis Kelamin</td>
	        				<td class="text_left">
								  <label class="radio-inline">
								    <input type="radio" name="jk" value="L" required>
								    Laki - Laki
								  </label>
								  <label class="radio-inline">
								    <input type="radio" name="jk" value="P" required>
								    Perempuan
								  </label>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left" width="300">4. Alamat</td>
	        				<td class="text_left">
	        					<div class="row">
									<div class="col-md-6"><textarea class="form-control" name="alamat" placeholder="Alamat Lengkap" required></textarea></div>
									<div class="col-md-3"><input type="text" class="form-control" name="rt" placeholder="RT" required /></div>
									<div class="col-md-3"><input type="text" class="form-control" name="rw" placeholder="RW" required /></div>
	        					</div>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left" width="300">5. Kecamatan / Kelurahan</td>
	        				<td class="text_left">
	        					<div class="row">
									<div class="col-md-6">
			        					<select name="kec" class="form-control" id="kec" required>
			        						<option value=""> - Pilih Kecamatan - </option>
			        					</select>
									</div>
									<div class="col-md-6">
			        					<select name="kel" class="form-control" id="kel" required>
			        						<option value=""> - Pilih Kelurahan - </option>
			        					</select>
									</div>
	        					</div>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left" width="300">6. Agama / Pekerjaan</td>
	        				<td class="text_left">
	        					<div class="row">
									<div class="col-md-6">
			        					<select name="agama" class="form-control" required>
			        						<option value=""> - Pilih Agama - </option>
			        						<option value="1"> ISLAM </option>
			        						<option value="2"> KATOLIK </option>
			        						<option value="3"> PROTESTAN </option>
			        						<option value="4"> HINDU </option>
			        						<option value="5"> BUDHA </option>
			        					</select>
									</div>
									<div class="col-md-6"><input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" required /></div>
	        					</div>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left" width="300">7. Rumus Sidik Jari ( Kanan / Kiri )</td>
	        				<td class="text_left">
	        					<div class="row">
									<div class="col-md-6">
										<input type="text" class="form-control" name="jari_kanan" placeholder="Jari Kanan" />
									</div>
									<div class="col-md-6">
										<input type="text" class="form-control" name="jari_kiri" placeholder="Jari Kiri" />
									</div>
	        					</div>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left" width="300">8. Nomor PassPort</td>
	        				<td class="text_left">
	        					<input type="text" class="form-control" name="no_passport" placeholder="no_passport" />
	        				</td>
	        			</tr>
	        			<tr>
	        				<td class="text_left" width="300">9. Keterangan Lainnya</td>
	        				<td class="text_left">
	        					<input type="text" class="form-control" name="keterangan" placeholder="Keterangan" />
	        				</td>
	        			</tr>
	        		</tbody>
	        	</table>
	        </section>
	    </div>
    </form>
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