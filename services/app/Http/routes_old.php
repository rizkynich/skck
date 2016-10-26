<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $app->get('/', function () use ($app) {
//     return $app->welcome();
// });

$app->get('/',function () use ($app){
	return $app->welcome();
});

$app->group([
    'prefix' => 'api/simpadu', 
    'namespace' => 'App\Api\Simpadu'], function() use($app) {

    // login routers
    $app->get('login', 'Login@index');
    $app->post('login', 'Login@doAuth');

    // user routers
    $app->get('users', 'Users@listData');
    $app->get('user/{kodePelabuhan}', 'Users@listByOwner');
    $app->post('user/detail', 'Users@userDetail');
    $app->post('user/approve', 'Users@approveUser');
    $app->post('user/unapprove', 'Users@unapproveUser');

    // menu routers
    $app->get('menus', 'Menus@listData');
    $app->post('menu/edit', 'Menus@edit');
    $app->post('menu/updateMenu', 'Menus@updateMenu');

    // menuaccess routers
    $app->get('menuaccess', 'MenuAccess@listData');
    $app->post('menuaccess/getMenuAccess', 'MenuAccess@getMenuAccess');
    $app->post('menuaccess/updateMenuAccess', 'MenuAccess@updateMenuAccess');
    $app->post('menuaccess/getMyMenuAccess', 'MenuAccess@getMyMenuAccess');
    
    // menuaccess routers
    $app->get('menuroles', 'MenuRoles@listData');

    // menuaccess routers
    $app->get('roles', 'Roles@listData');

    $app->post('pmkus', 'Pmku@listingData');
    $app->get('pmku/tipeusaha', 'Pmku@tipeUsaha');
    $app->post('pmku/save', 'Pmku@saveData');
    $app->post('pmku/edit', 'Pmku@editData');
    $app->post('pmku/update', 'Pmku@updateData');
    $app->post('pmku/delete', 'Pmku@deleteData');
    $app->post('pmku/office/save', 'Pmku@officeSave');
    $app->post('pmku/office/provinsi', 'Pmku@loadProvinsi');
    $app->post('pmku/office/detail', 'Pmku@loadOffice');
    $app->post('pmku/perusahaan/detail', 'Pmku@perusahaanDetail');
    $app->post('pmku/perusahaan/suratperintah', 'Pmku@suratPerintah');
    $app->post('pmku/perusahaan/pmkuprint', 'Pmku@pmkuPrint');

    // user routers
    $app->get('registrasi', 'RegistrasiUsers@listData');
    $app->get('registrasi/{kodePelabuhan}', 'RegistrasiUsers@listByOwner');
    $app->post('registrasi/detail', 'RegistrasiUsers@userDetail');
    $app->post('registrasi/approve', 'RegistrasiUsers@approveUser');
    $app->post('registrasi/unapprove', 'RegistrasiUsers@unapproveUser');
    
    // sps integrasi routers
    $app->post('simpadu', 'Simpadus@listingData');
    $app->post('simpadu/completion', 'Simpadus@completionDataPkk');
    $app->post('spsintegrasi', 'Simpadus@spsIntegrasi');

    // status done
    $app->post('pkk', 'Pkk@listingData');
    $app->post('pkk/detail', 'Pkk@detail');
    $app->post('pkk/completion', 'Pkk@completion');
    $app->post('pkk/verify', 'Pkk@verify');
    $app->post('pkk/nopkk', 'Pkk@bynopkk');

    // status done
    $app->post('lkk', 'Lkk@listingData');
    $app->post('lkk/completion', 'Lkk@completion');
    $app->post('lkk/detail', 'Lkk@detail');
    $app->post('lkk/verify', 'Lkk@verify');

    // status done
    $app->post('masatambat', 'Masatambat@listingData');
    $app->post('masatambat/completion', 'Masatambat@completion');
    $app->post('masatambat/detail', 'Masatambat@detail');
    $app->post('masatambat/verify', 'Masatambat@verify');

    // status 
    $app->post('pindah', 'Pindah@listingData');
    $app->post('pindah/completion', 'Pindah@completion');
    $app->post('pindah/detail', 'Pindah@detail');
    $app->post('pindah/verify', 'Pindah@verify');

    // status done
    $app->post('lk3', 'Lk3@listingData');
    $app->post('lk3/completion', 'Lk3@completion');
    $app->post('lk3/detail', 'Lk3@detail');
    $app->post('lk3/verify', 'Lk3@verify');

    // status done
    $app->post('lab', 'Lab@listingData');
    $app->post('lab/completion', 'Lab@completion');
    $app->post('lab/detail', 'Lab@detail');
    $app->post('lab/verify', 'Lab@verify');

    $app->post('rkbm', 'Rkbm@listingData');
    $app->post('rkbm/completion', 'Rkbm@completion');
    $app->post('rkbm/detail', 'Rkbm@detail');
    $app->post('rkbm/verify', 'Rkbm@verify');
    $app->post('rkbm/verified', 'Rkbm@verified');
    $app->post('rkbm/tkbm', 'Rkbm@detailTkbm');
    $app->post('rkbm/amprag', 'Rkbm@detailAmprag');

    $app->post('tkbm', 'Tkbm@listingData');
    $app->post('tkbm/completion', 'Tkbm@completion');
    $app->post('tkbm/detail', 'Tkbm@detail');
    $app->post('tkbm/verify', 'Tkbm@verify');

    $app->post('amprag', 'Amprag@listingData');
    $app->post('amprag/completion', 'Amprag@completion');
    $app->post('amprag/detail', 'Amprag@detail');
    $app->post('amprag/verify', 'Amprag@verify');

    $app->post('timesheet', 'Timesheet@listingData');
    $app->post('timesheet/completion', 'Timesheet@completion');
    $app->post('timesheet/detail', 'Timesheet@detail');
    $app->post('timesheet/verify', 'Timesheet@verify');

    $app->post('dailyreport', 'Timesheet@listingData');
    $app->post('dailyreport/completion', 'Timesheet@completion');
    $app->post('dailyreport/detail', 'Timesheet@detail');
    $app->post('dailyreport/verify', 'Timesheet@verify');

    // status done
    $app->post('bb', 'bb@listingData');
    $app->post('bb/completion', 'bb@completion');
    $app->post('bb/detail', 'bb@detail');
    $app->post('bb/verify', 'bb@verify');

    // status done
    $app->post('gandeng', 'Gandeng@listingData');
    $app->post('gandeng/completion', 'Gandeng@completion');
    $app->post('gandeng/detail', 'Gandeng@detail');
    $app->post('gandeng/verify', 'Gandeng@verify');

    // status done
    $app->post('alihmuat', 'Alihmuat@listingData');
    $app->post('alihmuat/completion', 'Alihmuat@completion');
    $app->post('alihmuat/detail', 'Alihmuat@detail');
    $app->post('alihmuat/verify', 'Alihmuat@verify');

    $app->post('kecelakaan', 'Kecelakaan@listingData');
    $app->post('kecelakaan/completion', 'Kecelakaan@completion');
    $app->post('kecelakaan/detail', 'Kecelakaan@detail');
    $app->post('kecelakaan/verify', 'Kecelakaan@verify');

    // status done
    $app->post('bunker', 'Bunker@listingData');
    $app->post('bunker/completion', 'Bunker@completion');
    $app->post('bunker/detail', 'Bunker@detail');
    $app->post('bunker/verify', 'Bunker@verify');

    $app->post('gladak', 'Gladak@listingData');
    $app->post('gladak/completion', 'Gladak@completion');
    $app->post('gladak/detail', 'Gladak@detail');
    $app->post('gladak/verify', 'Gladak@verify');

    // status done
    $app->post('salvage', 'Salvage@listingData');
    $app->post('salvage/completion', 'Salvage@completion');
    $app->post('salvage/detail', 'Salvage@detail');
    $app->post('salvage/verify', 'Salvage@verify');

    $app->post('lasdarat', 'Lasdarat@listingData');
    $app->post('lasdarat/completion', 'Lasdarat@completion');
    $app->post('lasdarat/detail', 'Lasdarat@detail');
    $app->post('lasdarat/verify', 'Lasdarat@verify');

    $app->post('ppk', 'Ppk@listingData');
    $app->post('ppk/completion', 'Ppk@completion');
    $app->post('ppk/detail', 'Ppk@detail');
    $app->post('ppk/verify', 'Ppk@verify');

});


$app->group(['prefix' => 'api/sps','namespace' => 'App\Api\sps'], function() use($app) {
    
	// sps
	$app->get('sps','Sps@listData');
	$app->get('sps/{id}','Sps@getById');
	$app->post('sps/queuekeagenan','Sps@getQueueKeagenan');
	$app->post('sps/updateagen','Sps@updateAgen');
	$app->post('sps/queue','Sps@getQueue');
	$app->post('sps/numqueue','Sps@getNumQueue');
	$app->post('sps','Sps@save');
	$app->post('sps/update_status','Sps@updateStatus');
	$app->post('sps/nomorsps','Sps@getByNomorLayananSPS');
	$app->post('sps/nomorproduk','Sps@getByNomorProduk');
	$app->put('sps/{id}','Sps@update');
	$app->delete('sps/{id}','Sps@delete');

	// warta kapal
	$app->get('wartakapal','WartaKapal@listData');
	$app->get('wartakapal/{id}','WartaKapal@getById');
	$app->post('wartakapal/nomorsps','WartaKapal@getByNomorLayananSPS');
	$app->post('wartakapal/nomorspslist','WartaKapal@getByNomorLayananSPSList');
	$app->post('wartakapal','WartaKapal@save');
	$app->put('wartakapal/{id}','WartaKapal@update');

	// Awak Kapal
	$app->get('awakkapal','AwakKapal@listData');
	$app->get('awakkapal/{id}','AwakKapal@getById');
	$app->post('awakkapal/nomorsps','AwakKapal@getByNomorLayananSPS');
	$app->post('awakkapal/nomorspslist','AwakKapal@getByNomorLayananSPSList');
	$app->post('awakkapal','AwakKapal@save');
	$app->put('awakkapal/{id}','AwakKapal@update');

	// Barang Berbahaya
	$app->get('barangberbahaya','BarangBerbahaya@listData');
	$app->get('barangberbahaya/{id}','BarangBerbahaya@getById');
	$app->post('barangberbahaya/nomorsps','BarangBerbahaya@getByNomorLayananSPS');
	$app->post('barangberbahaya/nomorspslist','BarangBerbahaya@getByNomorLayananSPSList');
	$app->post('barangberbahaya','BarangBerbahaya@save');
	$app->put('barangberbahaya/{id}','BarangBerbahaya@update');

	// Cemar
	$app->get('cemar','Cemar@listData');
	$app->get('cemar/{id}','Cemar@getById');
	$app->post('cemar/nomorsps','Cemar@getByNomorLayananSPS');
	$app->post('cemar/nomorspslist','Cemar@getByNomorLayananSPSList');
	$app->post('cemar','Cemar@save');
	$app->put('cemar/{id}','Cemar@update');

	// dokumen kapal
	$app->get('dokumenkapal','DokumenKapal@listData');
	$app->get('dokumenkapal/{id}','DokumenKapal@getById');
	$app->post('dokumenkapal/tandapendaftaran','DokumenKapal@getByTandaPendaftaran');
	$app->post('dokumenkapal','DokumenKapal@save');
	$app->put('dokumenkapal/{id}','DokumenKapal@update');

	// Kewajiban
	$app->get('kewajiban','Kewajiban@listData');
	$app->get('kewajiban/{id}','Kewajiban@getById');
	$app->post('kewajiban/nomorsps','Kewajiban@getByNomorLayananSPS');
	$app->post('kewajiban/nomorspslist','Kewajiban@getByNomorLayananSPSList');
	$app->post('kewajiban','Kewajiban@save');
	$app->put('kewajiban/{id}','Kewajiban@update');

	// Muatan
	$app->get('muatan','Muatan@listData');
	$app->get('muatan/{id}','Muatan@getById');
	$app->post('muatan/nomorsps','Muatan@getByNomorLayananSPS');
	$app->post('muatan/nomorspslist','Muatan@getMuatanByNomorLayananSPSList');
	$app->post('muatan','Muatan@save');
	$app->put('muatan/{id}','Muatan@update');

	// Penumpang
	$app->get('penumpang','Penumpang@listData');
	$app->get('penumpang/{id}','Penumpang@getById');
	$app->post('penumpang/nomorsps','Penumpang@getByNomorLayananSPS');
	$app->post('penumpang/nomorspslist','Penumpang@getByNomorLayananSPSList');
	$app->post('penumpang','Penumpang@save');
	$app->put('penumpang/{id}','Penumpang@update');

	// SPB
	$app->get('spb','Spb@listData');
	$app->get('spb/{id}','Spb@getById');
	$app->post('spb/nomorsps','Spb@getByNomorLayananSPS');
	$app->post('spb/nomorspslist','Spb@getByNomorLayananSPSList');
	$app->post('spb','Spb@save');
    $app->post('spb/jasa_labuh','Spb@jasa_labuh');
    $app->post('spb/spb_update','Spb@spb_update');
	$app->put('spb/{id}','Spb@update');

	// SpbAsal
	$app->get('spbasal','SpbAsal@listData');
	$app->get('spbasal/{id}','SpbAsal@getById');
	$app->post('spbasal/nomorsps','SpbAsal@getByNomorLayananSPS');
	$app->post('spbasal/nomorspslist','SpbAsal@getSpbAsalByNomorLayananSPSList');
	$app->post('spbasal','SpbAsal@save');
	$app->put('spbasal/{id}','SpbAsal@update');

	// SPM
	$app->get('spm','Spm@listData');
	$app->get('spm/{id}','Spm@getById');
	$app->post('spm/nomorsps','Spm@getByNomorLayananSPS');
	$app->post('spm','Spm@save');
	$app->put('spm/{id}','Spm@update');

	// SPOG
	$app->get('spog','Spog@listData');
	$app->get('spog/{id}','Spog@getById');
	$app->post('spog/nomorsps','Spog@getByNomorLayananSPS');
	$app->post('spog','Spog@save');
	$app->put('spog/{id}','Spog@update');
	$app->post('spog/updatesb','Spog@updatesb');
});

$app->group([
    'prefix' => 'api/general', 
    'namespace' => 'App\Api\general'], function() use($app) {

    #pelabuhan
    $app->get('pelabuhan', 'Pelabuhan@listData');
    $app->get('pelabuhan/kode/{kodePelabuhan}', 'Pelabuhan@getByKode');
    $app->get('pelabuhan/notifikasi', 'Pelabuhan@notifikasi');
    
    #dermaga
    $app->get('dermaga', 'Dermaga@listData');
    $app->get('dermaga/kode/{kode}', 'Dermaga@getByKode');
    $app->get('dermaga/kode_pelabuhan/{kodePelabuhan}', 'Dermaga@getByPelabuhan');

    #pelabuhan
    $app->get('authrule', 'Authrule@listData');
    $app->get('authrule/kode/{kode}', 'Authrule@getByKode');

    #perusahaan
    $app->get('perusahaan', 'Perusahaan@listData');
    $app->get('perusahaan/kode/{kodePerusahaan}', 'Perusahaan@getByKode');

    #notification
    $app->get('notification', 'Notification@user_notif');

    #kantor
    $app->get('kantor', 'Kantor@listData');
    $app->get('kantor/kode/{kode}', 'Kantor@getByKode');
    $app->get('kantor/prupel/{perusahaan}/{pelabuhan}', 'Kantor@getByKodePerusahaanAndPelabuhan');

    #syarat kelengkapan dokumen
    $app->get('syarat', 'Syarat@listData');
    $app->get('syarat/kode_layanan/{kode_layanan}', 'Syarat@getByKodeLayanan');
    $app->get('syarat/kode_layanan_bb/{kode_layanan}/{klas_bb}', 'Syarat@getByKodeLayananBB');
});
