<?php
$mysqli = new mysqli("localhost", "root", "", "skck");
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$a = isset($_GET['a']) ? $_GET['a']:null;
$option = isset($_POST['option']) ? $_POST['option']:null;

switch ($a) {
	case 'kab':
		$result = $mysqli->query("SELECT * FROM regencies WHERE province_id = '$option' ORDER BY name ASC");
		echo '<option value=""> - Pilih Kabupaten / Kota - </option>';
		while ($row = $result->fetch_object()){
			echo '<option value="'.$row->id.'"  style="text-align: left;"> '.$row->name.' </option>';
		}
		$result->close();
		break;
	
	case 'kec':
		$result = $mysqli->query("SELECT * FROM districts WHERE regency_id = '$option' ORDER BY name ASC");
		echo '<option value=""> - Pilih Kecamatan - </option>';
		while ($row = $result->fetch_object()){
			echo '<option value="'.$row->id.'"  style="text-align: left;"> '.$row->name.' </option>';
		}
		$result->close();
		break;
	
	case 'kel':
		$result = $mysqli->query("SELECT * FROM villages WHERE district_id = '$option' ORDER BY name ASC");
		echo '<option value=""> - Pilih Kelurahan / Desa - </option>';
		while ($row = $result->fetch_object()){
			echo '<option value="'.$row->id.'"  style="text-align: left;"> '.$row->name.' </option>';
		}
		$result->close();
		break;
	
	case 'kewaraganegaraan':
		echo '<option value=""> - Pilih Jenis Identitas - </option>';
		if($option == 1){
			echo '<option value="1"> E-KTP </option>';
			echo '<option value="2"> NON E-KTP </option>';
		} else if($option){
			echo '<option value="3"> KITAS </option>';
			echo '<option value="4"> KITAP </option>';
		}
		break;
	
	case 'save':

		$nomor_registrasi = time()."-".$_POST['kel'];
		$lampiran_identitas = "";
		$filename_identitas = $nomor_registrasi."-lampiran_kitas_kitap-".$_FILES['lampiran_kitas_kitap']['name'];
		if(move_uploaded_file($_FILES['lampiran_kitas_kitap']['tmp_name'], "upload/".$filename_identitas)){
			$lampiran_identitas = $filename_identitas;
		}

		$lampiran_pengantar = "";
		$filename_pengantar = $nomor_registrasi."-lampiran_ktp-".$_FILES['lampiran_ktp']['name'];
		if(move_uploaded_file($_FILES['lampiran_ktp']['tmp_name'], "upload/".$filename_pengantar)){
			$lampiran_pengantar = $filename_pengantar;
		}

		$lampiran_kk = "";
		$filename_kk = $nomor_registrasi."-lampiran_kk-".$_FILES['lampiran_kk']['name'];
		if(move_uploaded_file($_FILES['lampiran_kk']['tmp_name'], "upload/".$filename_kk)){
			$lampiran_kk = $filename_kk;
		}

		$lampiran_akta_lahir = "";
		$filename_akta = $nomor_registrasi."-lampiran_akta_lahir-".$_FILES['lampiran_akta_lahir']['name'];
		if(move_uploaded_file($_FILES['lampiran_akta_lahir']['tmp_name'], "upload/".$filename_akta)){
			$lampiran_akta_lahir = $filename_akta;
		}

		$Q = "INSERT INTO skck.registrasi (
			  nomor_registrasi,
			  kewaraganegaraan,
			  jenis_identitas,
			  no_kitas_kitap,
			  no_ktp,
			  nama_lengkap,
			  tempat_lahir,
			  tanggal_lahir,
			  jk,
			  alamat,
			  rt,
			  rw,
			  kel,
			  kec,
			  kab,
			  prov,
			  agama,
			  pekerjaan,
			  jari_kanan,
			  jari_kiri,
			  no_passport,
			  keterangan,
			  lampiran_kitas_kitap,
			  lampiran_ktp,
			  lampiran_kk,
			  lampiran_akta_lahir,
			  date_created
			)  VALUES (
			    '$nomor_registrasi',
			    '".$_POST['kewaraganegaraan']."',
			    '".$_POST['jenis_identitas']."',
			    '".$_POST['no_kitas_kitap']."',
			    '".$_POST['no_ktp']."',
			    '".$_POST['nama_lengkap']."',
			    '".$_POST['tempat_lahir']."',
			    '".$_POST['tanggal_lahir']."',
			    '".$_POST['jk']."',
			    '".$_POST['alamat']."',
			    '".$_POST['rt']."',
			    '".$_POST['rw']."',
			    '".$_POST['kel']."',
			    '".$_POST['kec']."',
			    '".$_POST['kab']."',
			    '".$_POST['prov']."',
			    '".$_POST['agama']."',
			    '".$_POST['pekerjaan']."',
			    '".$_POST['jari_kanan']."',
			    '".$_POST['jari_kiri']."',
			    '".$_POST['no_passport']."',
			    '".$_POST['keterangan']."',
			    '".$lampiran_identitas."',
			    '".$lampiran_pengantar."',
			    '".$lampiran_kk."',
			    '".$lampiran_akta_lahir."',
			    '".date("Y-m-d H:i:s")."'
			  )";
			// echo $Q;die();
			$mysqli->query($Q);
			header('location:resi.php?data='.$nomor_registrasi);
		break;
	
	default:
		# code...
		break;
}
$mysqli->close();
?>