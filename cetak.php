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
     
</head>

<body>
<section>
<div class="container">
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
			<a href="#" class="btn btn-primary hidden-print" onclick="javascript:window.print();">CETAK</a>
			<br/>
			<?php
		} else {
			echo "Data Tidak Ditemukan";
		}
	?>
	<br/>
</div> <!-- /END CONTAINER -->
</section>
</body>
</html>
<?php
$mysqli->close();
?>