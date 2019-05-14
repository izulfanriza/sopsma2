<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//akses index all user
// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('lupapassword', function(){
	return view('auth.lupapassword');
});

//memeriksa session
Route::group(['middleware' => 'web'], function () {
	Route::auth();
});

//akses home untuk user dan admin logged
Route::group(['middleware' => ['web','auth']], function()
{
	Route::get('/', function () {
    	return redirect('/tu/index');
	});
	Route::get('/home', 'HomeController@index');
	// Route::get('/home', function(){
	// 	if (Auth::user()->role == 'sarpras'){
	// 		return view('sarpras.index');
	// 	} elseif (Auth::user()->role == 'tu'){
	// 		return view('tu.index');
	// 	} elseif (Auth::user()->role == 'admin'){
	// 		return view('admin.index');
	// 	} else {
	// 		return view('superadmin.index');
	// 	}
	// });
});

Route::post('user/changepassword', 'GantiPasswordController@save');

//prefix untuk petugas sarpras
Route::group(['prefix' => 'sarpras'], function()
{
	Route::group(['middleware' => ['web', 'auth', 'sarpras']], function () {

		Route::get('index','SarprasController@index');

		Route::get('kelas', 'KelasController@index');
		Route::get('kelas/add', 'KelasController@getAdd');
		Route::get('kelas/delete/{id_kelas}', 'KelasController@getDelete');
		Route::get('kelas/edit/{id_kelas}', 'KelasController@getEdit');
		Route::post('kelas/update/{id_kelas}', 'KelasController@getUpdate');
		Route::get('kelas/lock/{id_kelas}', 'KelasController@getLock');
		Route::post('kelas/save', 'KelasController@getSave');
		Route::get('kelas/show/{id_kelas}','KelasController@getShow');
		Route::get('kelas/tambahsiswa/{id_kelas}','KelasController@getAddSiswa');
		// Route::get('kelas/addsiswa', 'KelasController@getAddSiswa');
		Route::post('kelas/savesiswa', 'KelasController@getSaveSiswa');
		Route::get('kelas/downloadkelas', 'KelasController@TemplateKelas');
		Route::post('kelas/import', 'KelasController@getImport');
		Route::get('kelas/downloadsiswa', 'KelasController@TemplateSiswaByKelas');
		Route::post('kelas/imp/{id_kelas}/import', 'KelasController@SaveSiswaImport');
		Route::get('kelas/lockall','KelasController@lockAll');

		Route::get('siswaaktif', 'SiswaController@aindex');
		Route::get('siswanonaktif', 'SiswaController@nindex');
		Route::get('siswa/add', 'SiswaController@getAdd');
		Route::get('siswa/delete/{nis}', 'SiswaController@getDelete');
		Route::get('siswa/edit/{nis}', 'SiswaController@getEdit');
		Route::post('siswa/update/{nis}', 'SiswaController@getUpdate');
		Route::get('siswa/lock/{nis}', 'SiswaController@getLock');
		Route::post('siswa/save', 'SiswaController@getSave');
		Route::get('siswa/show/{nis}', 'SiswaController@getShow');
		Route::get('siswa/addnonaktif', 'SiswaController@getAddNonaktif');
		Route::get('siswa/nonaktif/{nis}', 'SiswaController@getNonaktif');
		Route::get('siswa/downloadsiswa', 'SiswaController@TemplateSiswa');
		Route::post('siswa/import', 'SiswaController@getImport');
		Route::get('siswa/nexport', 'SiswaController@getNonExport');
		Route::get('siswa/hapusall','SiswaController@deleteAll');
		Route::post('siswa/nimport', 'SiswaController@getNonImport');


		Route::get('tahunajaran', 'TahunajaranController@index');
		Route::get('tahunajaran/add', 'TahunajaranController@getAdd');
		Route::get('tahunajaran/delete/{id_tahun_ajaran}', 'TahunajaranController@getDelete');
		Route::get('tahunajaran/edit/{id_tahun_ajaran}', 'TahunajaranController@getEdit');
		Route::post('tahunajaran/update/{id_tahun_ajaran}', 'TahunajaranController@getUpdate');
		Route::get('tahunajaran/lock/{id_tahun_ajaran}', 'TahunajaranController@getLock');
		Route::post('tahunajaran/save', 'TahunajaranController@getSave');
		Route::get('tahunajaran/use/{id_tahun_ajaran}', 'TahunajaranController@getUse');
		Route::get('tahunajaran/unuse/{id_tahun_ajaran}', 'TahunajaranController@getUnuse');


		Route::get('detailsiswa', 'DetailsiswaController@index');
		Route::get('detailsiswa1', 'DetailsiswaController@index1');
		Route::get('detailsiswa1-export', 'DetailsiswaController@export1');
		Route::post('detailsiswa1-import', 'DetailsiswaController@import1');
		Route::get('detailsiswa2', 'DetailsiswaController@index2');
		Route::get('detailsiswa2-export', 'DetailsiswaController@export2');
		Route::get('detailsiswa3', 'DetailsiswaController@index3');
		Route::get('detailsiswa3-export', 'DetailsiswaController@export3');
		Route::get('detailsiswa/add', 'DetailsiswaController@getAdd');
		Route::get('detailsiswa/delete/{id_detail_siswa}', 'DetailsiswaController@getDelete');
		Route::get('detailsiswa/edit/{id_detail_siswa}', 'DetailsiswaController@getEdit');
		Route::post('detailsiswa/update/{id_detail_siswa}', 'DetailsiswaController@getUpdate');
		Route::get('detailsiswa/lock/{id_detail_siswa}', 'DetailsiswaController@getLock');
		Route::post('detailsiswa/save', 'DetailsiswaController@getSave');
		Route::get('detailsiswa/lock/{id_detail_siswa}', 'DetailsiswaController@getLock');
		Route::get('detailsiswa/lockall','DetailsiswaController@lockAll');

		Route::get('tunggakan','TunggakanController@index');
		Route::post('tunggakan/cari','TunggakanController@search');
		Route::get('tunggakan/show/{id_detail_siswa}','TunggakanController@showDetail');
		Route::post('tunggakan/cetak','TunggakanController@cetak');


	});
});

//prefix untuk petugas tu
Route::group(['prefix' => 'tu'], function()
{
	Route::group(['middleware' => ['web', 'auth', 'tu']], function () {

	    Route::get('index','TuController@index');

	    Route::get('transaksi', 'TransaksiController@index');
	    Route::post('transaksi/proses','TransaksiController@getProses');
		Route::get('transaksi/bayar/{nis}/{bulan}', 'TransaksiController@getBayar');
		Route::get('transaksi/prosess/bayar/{nis}/{bulan}', 'TransaksiController@getBayar');
		Route::get('transaksi/cetak/{id_transaksi}', 'KwitansiController@print');
		Route::get('transaksi/prosess/cetak/{id_transaksi}', 'KwitansiController@print');
		Route::get('transaksi/prosess/{id_detail_siswa}','TransaksiController@getProsess');
		Route::get('transaksi/prosess/email/{id_detail_siswa}/{id_transaksi}','TransaksiController@sendEmail');
		Route::get('transaksi/show/{id_transaksi}', 'TransaksiController@getShow');
		Route::get('transaksi/email/{id_detail_siswa}/{id_transaksi}', 'TransaksiController@sendEmail');

		Route::get('rekap','RekapController@index');
		Route::post('search','RekapController@search');
		Route::get('rekap/riwayat','RekapController@getRiwayat');
		Route::get('rekap/{id_transaksi}','RekapController@update');
		Route::get('rekap/show/{tgl_rekap}/{id_petugas}','RekapController@getShow');

		Route::get('setor','SetorController@index');
		Route::get('setor/riwayat','SetorController@getRiwayat');
		Route::get('setor/proses','SetorController@getProses');
		Route::get('setor/show/{tgl_setor}/{id_petugas}','SetorController@getShow');
		Route::get('setor/cetak/{tanggal_setor}/{id_petugas_setor}','SetorController@getCetak');
	});
});


//prefix untuk admin
Route::group(['prefix' => 'admin'], function()
{
	Route::group(['middleware' => ['web', 'auth', 'admin']], function () {

	    Route::get('index','AdminController@index');

	    Route::get('users','AdminController@getUsers');
	    Route::get('users/add','AdminController@getAdd');
	    Route::get('users/delete/{id}','AdminController@getDelete');
	    Route::post('users/save', 'AdminController@getSave');
	    Route::get('users/show/{id}','AdminController@getShow');
	    Route::get('users/edit/{id}','AdminController@getEdit');
	    Route::get('users/resetpassword/{id}','AdminController@getResetPassword');
	    Route::post('users/updatepassword/{id}','AdminController@getUpdatePassword');
	    Route::post('users/update/{id}','AdminController@getUpdate');

	    Route::get('kelas','AdminController@getKelas');
	    Route::get('kelas/unlock/{id_kelas}','AdminController@unlockKelas');

	    Route::get('tahunajaran','AdminController@getTahunajaran');
	    Route::get('tahunajaran/unlock/{id_tahun_ajaran}','AdminController@unlockTahunajaran');

	    Route::get('detailsiswa','AdminController@getDetailsiswa');
	    Route::get('detailsiswa/unlock/{id_detail_siswa}','AdminController@unlockDetailsiswa');

	    Route::get('transaksi','AdminController@getTransaksi');
	    Route::get('transaksi/delete/{id_transaksi}','AdminController@deleteTransaksi');

	});
});


//prefix untuk superadmin
Route::group(['prefix' => 'superadmin'], function()
{
	Route::group(['middleware' => ['web', 'auth', 'superadmin']], function () {

	    Route::get('index','SuperadminController@index');

		Route::get('admin','SuperadminController@getAdmin');	
		Route::get('admin/add','SuperadminController@getAdd');	
		Route::post('admin/save','SuperadminController@getSave');
		Route::get('admin/delete/{id}','SuperadminController@getDelete');
		Route::get('admin/show/{id}','SuperadminController@getShow');
	    Route::get('admin/resetpassword/{id}','SuperadminController@getResetPassword');
	    Route::post('admin/updatepassword/{id}','SuperadminController@getUpdatePassword');
	    Route::get('admin/edit/{id}','SuperadminController@getEdit');
	    Route::post('admin/update/{id}','SuperadminController@getUpdate');
	    Route::get('admin/gantisuperadmin/{id}','SuperadminController@getSuperadmin');

	    Route::get('users','SuperadminController@getUsers');
	    Route::get('users/add','SuperadminController@getAddUser');
	    Route::get('users/delete/{id}','SuperadminController@getDeleteUser');
	    Route::post('users/save','SuperadminController@getSaveUser');
	    Route::get('users/show/{id}','SuperadminController@getShowUser');
	    Route::get('users/edit/{id}','SuperadminController@getEditUser');
	    Route::get('users/resetpassword/{id}','SuperadminController@getResetPasswordUser');
	    Route::post('users/updatepassword/{id}','SuperadminController@getUpdatePasswordUser');
	    Route::post('users/update/{id}','SuperadminController@getUpdateUser');

	    // Route::get('gantipassword')

	});
});