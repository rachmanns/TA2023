<?php

use App\Http\Controllers\bidum\anggaran\PaguAnggaranController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\bidum\master\JabatanController;
use App\Http\Controllers\bidum\master\KesatuanController;
use App\Http\Controllers\bidum\master\KorpsController;
use App\Http\Controllers\bidum\master\PakaianController;
use App\Http\Controllers\bidum\master\PangkatController;
use App\Http\Controllers\bidum\master\TandaJasaController;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\dukkesops\CalendarDukkesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\StrukturDobekkesController;
use App\Http\Controllers\StrukturKermabaktikesController;
use App\Http\Controllers\StrukturDukkesopsController;
use App\Http\Controllers\StrukturLavibiovakController;
use App\Http\Controllers\StrukturMatfaskesController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\StrukturUmumController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\TenagaMedisController;
use App\Http\Controllers\CustomersController,
    App\Http\Controllers\CompanysController,
    Illuminate\Support\Facades\Route,
    App\Http\Controllers\UsersController,
    App\Http\Controllers\RoleController,
    App\Http\Controllers\YankesinController,
    App\Http\Controllers\yankesin\DashboardController as DashboardYankesinController,
    App\Http\Controllers\AngkatanController,
    App\Http\Controllers\KomandoController,
    App\Http\Controllers\SubKomandoController,
    App\Http\Controllers\RefrensiController,
    //  App\Http\Controllers\Auth\Auth,
    App\Http\Controllers\PermissionsController;
use App\Http\Controllers\dukkesops\BekkesPenugasanController;
use App\Http\Controllers\matfaskes\kegiatan\PengadaanController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/main-dashboard', [App\Http\Controllers\HomeController::class, 'main_dashboard']);


Route::post('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);


// Route::get('/struktur_umum', function () {
//     return view('umum.struktur_organisasi', ['active_menu' => 'struktur_umum']);
// });
Route::get('/struktur_umum', [StrukturUmumController::class, 'index']);
Route::get('/struktur_organisasi_bangkes', [StrukturUmumController::class, 'bangkes']);

Route::group(['middleware' => ['auth']], function () {


    Route::get('/secret-auth', function () {

        if (Auth::user()->roles->pluck('secret_access')[0]) return view('secretpage.secret-login');
        else return redirect()->route("secret.forbidden");
    });

    Route::get('/secret-forbidden', function () {
        return view('secretpage.secret-forbiden');
    })->name("secret.forbidden");

    Route::resource('roles/auth', RoleController::class);
    Route::resource('users/auth', UsersController::class);
    Route::resource('customers/auth', CustomersController::class);

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    Route::get('/dashboard_bidum', function () {
        return view('bidum.bidang_umum.dashboard', ['active_menu' => 'dashboard_bidum']);
    });

    Route::get('/dashboard_personil', function () {
        return view('bidum.personil.dashboard_personil', ['active_menu' => 'dashboard_personil']);
    });

    Route::get('/dashboard_anggaran', function () {
        return view('bidum.anggaran.dashboard_anggaran', ['active_menu' => 'dashboard_anggaran']);
    });

    Route::get('/document_not_found', function () {
        return view('document_not_found', ['active_menu' => 'document_not_found']);
    });

    // Route Users
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create']);
    Route::post('/users/store', [UsersController::class, 'store']);
    Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
    Route::post('/users/update/{id}', [UsersController::class, 'update']);
    Route::delete('/users/delete/{id}', [UsersController::class, 'destroy']);

    Route::post('/roles/perm/store/{id}', [RoleController::class, 'permStore']);
    Route::get('/roles/perm/{id}', [RoleController::class, 'perm'])->name('rhp');


    // Route Roles
    Route::get('/roles/list', [RoleController::class, 'get_role_ajax']);
    Route::resource('/roles', RoleController::class)->except('create', 'show');

    // Route Permissions
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionsController::class, 'create']);
    Route::post('/permissions/store', [PermissionsController::class, 'store']);
    Route::get('/permissions/edit/{id}', [PermissionsController::class, 'edit']);
    Route::post('/permissions/update/{id}', [PermissionsController::class, 'update']);
    Route::delete('/permissions/delete/{id}', [PermissionsController::class, 'destroy']);

    // Route Customers
    Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomersController::class, 'create']);
    Route::post('/customers/store', [CustomersController::class, 'store']);
    Route::get('/customers/edit/{id}', [CustomersController::class, 'edit']);
    Route::post('/customers/update/{id}', [CustomersController::class, 'update']);
    Route::delete('/customers/delete/{id}', [CustomersController::class, 'destroy']);
    Route::get('/customers/view/{id}', [CustomersController::class, 'show']);

    // Route Events
    Route::prefix('events')->group(function () {
        Route::get('/', [EventsController::class, 'index'])->name('events.index');
        Route::get('/dor', [EventsController::class, 'dor']);
        Route::get('/create', [EventsController::class, 'create']);
        Route::post('/store', [EventsController::class, 'store']);
        Route::get('/edit/{id}', [EventsController::class, 'edit']);
        Route::post('/update/{id}', [EventsController::class, 'update']);
        Route::delete('/delete/{id}', [EventsController::class, 'destroy']);
    });

    Route::prefix('refrensi')->group(function () {
        Route::get('/provinsi', [RefrensiController::class, 'select_provinsi']);
        // Route::get('/kotakab', [RefrensiController::class, 'select_kotakab']);
        Route::get('/kota-kab/{parent}', [RefrensiController::class, 'select_kotakab']);
    });

    Route::prefix('master')->group(function () {

        Route::prefix('angkatan')->group(function () {
            Route::get('/', [AngkatanController::class, 'index'])->name('angkatan.index');
            Route::post('/store', [AngkatanController::class, 'store']);
            Route::get('/edit/{id}', [AngkatanController::class, 'edit']);
            Route::post('/update/{id}', [AngkatanController::class, 'update']);
            Route::delete('/delete/{id}', [AngkatanController::class, 'destroy']);
            Route::get('/list', [AngkatanController::class, 'get_list']);
            Route::get('/select', [AngkatanController::class, 'select']);
        });

        Route::prefix('kesatuan')->group(function () {
            Route::get('/', [KesatuanController::class, 'index'])->name('kesatuan.index');
            Route::post('/store', [KesatuanController::class, 'store'])->name('kesatuan.store');
            Route::get('/edit/{kesatuan}', [KesatuanController::class, 'edit'])->name('kesatuan.edit');
            Route::put('/update/{kesatuan}', [KesatuanController::class, 'update'])->name('kesatuan.update');
            Route::delete('/delete/{kesatuan}', [KesatuanController::class, 'destroy']);
            Route::get('/list', [KesatuanController::class, 'list'])->name('kesatuan.list');
        });

        Route::prefix('komando')->group(function () {
            Route::get('/', [KomandoController::class, 'index'])->name('komando.index');
            Route::post('/store', [KomandoController::class, 'store']);
            Route::get('/edit/{id}', [KomandoController::class, 'edit']);
            Route::post('/update/{id}', [KomandoController::class, 'update']);
            Route::delete('/delete/{id}', [KomandoController::class, 'destroy']);
            Route::get('/list', [KomandoController::class, 'get_list']);
            Route::get('/select/{parent?}', [KomandoController::class, 'select']);
        });

        Route::prefix('korps')->group(function () {
            Route::get('/', [KorpsController::class, 'index'])->name('korps.index');
            Route::post('/store', [KorpsController::class, 'store'])->name('korps.store');
            Route::get('/edit/{korps}', [KorpsController::class, 'edit'])->name('korps.edit');
            Route::put('/update/{korps}', [KorpsController::class, 'update'])->name('korps.update');
            Route::delete('/delete/{korps}', [KorpsController::class, 'destroy']);
            Route::get('/list', [KorpsController::class, 'list'])->name('korps.list');
        });

        Route::prefix('tanda-jasa')->group(function () {
            Route::get('/', [TandaJasaController::class, 'index'])->name('tanda_jasa.index');
            Route::post('/store', [TandaJasaController::class, 'store'])->name('tanda_jasa.store');
            Route::get('/edit/{tanda_jasa}', [TandaJasaController::class, 'edit'])->name('tanda_jasa.edit');
            Route::put('/update/{tanda_jasa}', [TandaJasaController::class, 'update'])->name('tanda_jasa.update');
            Route::delete('/delete/{tanda_jasa}', [TandaJasaController::class, 'destroy']);
            Route::get('/list', [TandaJasaController::class, 'list'])->name('tanda_jasa.list');
        });

        Route::prefix('jabatan')->group(function () {
            Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index');
            Route::post('/store', [JabatanController::class, 'store'])->name('jabatan.store');
            Route::get('/edit/{jabatan}', [JabatanController::class, 'edit'])->name('jabatan.edit');
            Route::put('/update/{jabatan}', [JabatanController::class, 'update'])->name('jabatan.update');
            Route::delete('/delete/{jabatan}', [JabatanController::class, 'destroy']);
            Route::get('/list', [JabatanController::class, 'list'])->name('jabatan.list');
        });

        Route::prefix('pangkat')->group(function () {
            Route::get('/', [PangkatController::class, 'index'])->name('pangkat.index');
            Route::post('/store', [PangkatController::class, 'store'])->name('pangkat.store');
            Route::get('/edit/{pangkat}', [PangkatController::class, 'edit'])->name('pangkat.edit');
            Route::put('/update/{pangkat}', [PangkatController::class, 'update'])->name('pangkat.update');
            Route::delete('/delete/{pangkat}', [PangkatController::class, 'destroy']);
            Route::get('/list', [PangkatController::class, 'list'])->name('pangkat.list');
            Route::get('next-pangkat/{kode_matra}', [PangkatController::class, 'next_pangkat'])->name('pangkat.next_pangkat');
        });

        Route::prefix('pakaian')->group(function () {
            Route::get('/', [PakaianController::class, 'index'])->name('pakaian.index');
            Route::post('/store', [PakaianController::class, 'store'])->name('pakaian.store');
            Route::get('/edit/{pakaian}', [PakaianController::class, 'edit'])->name('pakaian.edit');
            Route::put('/update/{pakaian}', [PakaianController::class, 'update'])->name('pakaian.update');
            Route::delete('/delete/{pakaian}', [PakaianController::class, 'destroy']);
            Route::get('/list', [PakaianController::class, 'list'])->name('pakaian.list');
        });

        Route::prefix('subkomando')->group(function () {
            Route::get('/', [SubKomandoController::class, 'index'])->name('subkomando.index');
            Route::post('/store', [SubKomandoController::class, 'store']);
            Route::get('/edit/{id}', [SubKomandoController::class, 'edit']);
            Route::post('/update/{id}', [SubKomandoController::class, 'update']);
            Route::delete('/delete/{id}', [SubKomandoController::class, 'destroy']);
            Route::get('/list', [SubKomandoController::class, 'get_list']);
            Route::get('/select/{parent?}', [SubKomandoController::class, 'select']);
        });
    });
    // Route Company
    Route::get('/companys/index', [CompanysController::class, 'index'])->name('companys.index');
    Route::get('/companys/create', [CompanysController::class, 'create']);
    Route::post('/companys/store', [CompanysController::class, 'store']);
    Route::get('/companys/edit/{id}', [CompanysController::class, 'edit']);
    Route::post('/companys/update/{id}', [CompanysController::class, 'update']);
    Route::delete('/companys/delete/{id}', [CompanysController::class, 'destroy']);
    Route::get('/companys/view/{id}', [CompanysController::class, 'show']);

    Route::prefix('pagu-anggaran')->name('pagu_anggaran.')->group(function () {
        Route::get('/', [PaguAnggaranController::class, 'index'])->name('index');
        Route::get('/daftar', [PaguAnggaranController::class, 'daftar_anggaran'])->name('daftar');
        Route::post('/excel/import', [PaguAnggaranController::class, 'import_excel'])->name('excel_import');
        Route::get('/excel/export', [PaguAnggaranController::class, 'export_excel'])->name('excel_export');
    });

    Route::get('/import_revisi', function () {
        return view('bidum.anggaran.daftar_pagu.import_revisi', ['active_menu' => 'daftar_pagu']);
    });

    // Realisasi Anggaran
    Route::get('/realisasi', function () {
        return view('bidum.anggaran.realisasi_harian.index', ['active_menu' => 'realisasi_harian']);
    });
    Route::get('/import_realisasi', function () {
        return view('bidum.anggaran.realisasi_harian.import_realisasi', ['active_menu' => 'realisasi_harian']);
    });
    Route::get('/daftar_realisasi', function () {
        return view('bidum.anggaran.realisasi_harian.daftar_realisasi', ['active_menu' => 'realisasi_harian']);
    });

    // Data Personil
    Route::get('/personil', function () {
        return view('bidum.personil.data_personil.index', ['active_menu' => 'data_personil']);
    });
    Route::get('/detail_personil', function () {
        return view('bidum.personil.data_personil.show', ['active_menu' => 'data_personil']);
    });
    Route::get('/import_personil', function () {
        return view('bidum.personil.data_personil.import_personil', ['active_menu' => 'data_personil']);
    });
    Route::get('/create_personil', function () {
        return view('bidum.personil.data_personil.create', ['active_menu' => 'data_personil']);
    });
    Route::get('/cetak_rh', function () {
        return view('bidum.personil.data_personil.cetak_rh', ['active_menu' => 'data_personil']);
    });
    Route::get('/cetak_nominatif', function () {
        return view('bidum.personil.data_personil.cetak_nominatif', ['active_menu' => 'data_personil']);
    });

    // Modal Revisi
    Route::get('/modal', function () {
        return view('modal');
    });

    // Covid Report
    Route::get('/bor_covid', function () {
        return view('rumah_sakit.covid_report.bor_covid', ['active_menu' => 'covid_report']);
    });

    Route::get('/pasien_covid', function () {
        return view('rumah_sakit.covid_report.pasien_covid', ['active_menu' => 'pasien_covid']);
    });

    // Alkes
    Route::get('/alkes_rs', function () {
        return view('rumah_sakit.alkes_rs.index', ['active_menu' => 'alkes_rs']);
    });

    // Dashboard Yankesin
    Route::get('/dashboard_yankesin', [DashboardYankesinController::class, 'dashboard_yankesin']);
    Route::get('/struktur_organisasi_yankesin', function () {
        return view('yankesin.struktur_organisasi', ['active_menu' => 'struktur_organisasi_yankesin']);
    });
    Route::post('/toggleCovidReport', [YankesinController::class, 'toggleCovidReport']);

    // BOR Yankesin
    Route::get('/bor_yankesin/{id?}', [DashboardYankesinController::class, 'dashboard_bor']);

    // Dashboard Nakes
    Route::get('/dashboard_nakes', [DashboardYankesinController::class,  'dashboard_nakes']);

    // Dashboard Fasilitas
    Route::get('/dashboard_fasilitas', [DashboardYankesinController::class,  'dashboard_fasilitas']);

    // Bidlog
    Route::get('/bidlog', function () {
        return view('bidum.logistik.dashboard', ['active_menu' => 'dashboard_bidlog']);
    });

    // Aset Transaksi Masuk
    Route::get('/import_aset_pengadaan_pusat', function () {
        return view('bidum.logistik.transaksi_masuk.aset.import_data_pusat', ['active_menu' => 'aset_masuk']);
    });
    Route::get('/import_aset_pengadaan_daerah', function () {
        return view('bidum.logistik.transaksi_masuk.aset.import_data_daerah', ['active_menu' => 'aset_masuk']);
    });
    Route::get('/import_aset_transfer', function () {
        return view('bidum.logistik.transaksi_masuk.aset.import_data_transfer', ['active_menu' => 'aset_masuk']);
    });
    Route::get('/import_aset_hibah', function () {
        return view('bidum.logistik.transaksi_masuk.aset.import_data_hibah', ['active_menu' => 'aset_masuk']);
    });
    Route::get('/input_dokumen_tm_aset', function () {
        return view('bidum.logistik.transaksi_masuk.aset.input_dokumen_tm', ['active_menu' => 'aset_masuk']);
    });
    Route::get('/input_barang_aset', function () {
        return view('bidum.logistik.transaksi_masuk.aset.input_barang', ['active_menu' => 'aset_masuk']);
    });

    // Persediaan Transaksi Masuk
    Route::get('/import_persediaan_pengadaan_pusat', function () {
        return view('bidum.logistik.transaksi_masuk.persediaan.import_data_pusat', ['active_menu' => 'persediaan_masuk']);
    });
    Route::get('/import_persediaan_pengadaan_daerah', function () {
        return view('bidum.logistik.transaksi_masuk.persediaan.import_data_daerah', ['active_menu' => 'persediaan_masuk']);
    });
    Route::get('/import_persediaan_transfer', function () {
        return view('bidum.logistik.transaksi_masuk.persediaan.import_data_transfer', ['active_menu' => 'persediaan_masuk']);
    });
    Route::get('/import_persediaan_hibah', function () {
        return view('bidum.logistik.transaksi_masuk.persediaan.import_data_hibah', ['active_menu' => 'persediaan_masuk']);
    });
    Route::get('/input_dokumen_tm_persediaan', function () {
        return view('bidum.logistik.transaksi_masuk.persediaan.input_dokumen_tm', ['active_menu' => 'persediaan_masuk']);
    });
    Route::get('/input_barang_persediaan', function () {
        return view('bidum.logistik.transaksi_masuk.persediaan.input_barang', ['active_menu' => 'persediaan_masuk']);
    });

    Route::get('/struktur_personil', [StrukturUmumController::class, 'personil']);

    Route::get('/struktur_anggaran', [StrukturUmumController::class, 'anggaran']);

    Route::get('/struktur_logistik', [StrukturUmumController::class, 'logistik']);

    Route::get('/struktur_taud', [StrukturUmumController::class, 'taud']);

    // Matfaskes
    Route::get('/barang_donasi', function () {
        return view('matfaskes.barang_donasi.index', ['active_menu' => 'barang_donasi']);
    });
    Route::get('/empty_barang_donasi', function () {
        return view('matfaskes.barang_donasi.empty_barang', ['active_menu' => 'barang_donasi']);
    });
    Route::get('/daftar_barang_donasi', function () {
        return view('matfaskes.barang_donasi.daftar_barang', ['active_menu' => 'barang_donasi']);
    });
    Route::get('/struktur_organisasi_matfaskes', [StrukturMatfaskesController::class, 'index']);

    // Dobekkes
    Route::get('/struktur_organisasi_dobekkes', [StrukturDobekkesController::class, 'index']);

    // Kermabaktikes
    Route::get('/struktur_organisasi_kerma', [StrukturKermabaktikesController::class, 'index']);

    // Data Bilateral
    Route::get('/dashboard_bilateral', function () {
        return view('kermabaktikes.kerma.luar_negeri.dashboard_bilateral', ['active_menu' => 'dashboard_bilateral']);
    });
    // Route::get('/detail_dashboard_usibdd', function () {

    // });
    Route::get('/detail_dashboard_thainesia', function () {
        return view('kermabaktikes.kerma.luar_negeri.detail_thainesia', ['active_menu' => 'dashboard_bilateral']);
    });
    Route::get('/edit_bilateral', function () {
        return view('kermabaktikes.kerma.luar_negeri.bilateral.edit', ['active_menu' => 'data_bilateral']);
    });
    Route::get('/detail_usibdd', function () {
        return view('kermabaktikes.kerma.luar_negeri.bilateral.detail_usibdd', ['active_menu' => 'data_bilateral']);
    });
    Route::get('/detail_thainesia', function () {
        return view('kermabaktikes.kerma.luar_negeri.bilateral.detail_thainesia', ['active_menu' => 'data_bilateral']);
    });
    Route::get('/tambah_kegiatan_bilateral', function () {
        return view('kermabaktikes.kerma.luar_negeri.bilateral.tambah_kegiatan', ['active_menu' => 'data_bilateral']);
    });

    Route::get('/edit_non_bilateral', function () {
        return view('kermabaktikes.kerma.luar_negeri.non_bilateral.edit', ['active_menu' => 'data_non_bilateral']);
    });
    Route::get('/detail_non_bilateral', function () {
        return view('kermabaktikes.kerma.luar_negeri.non_bilateral.show', ['active_menu' => 'data_non_bilateral']);
    });
    Route::get('/tambah_kegiatan_non_bilateral', function () {
        return view('kermabaktikes.kerma.luar_negeri.non_bilateral.tambah_kegiatan', ['active_menu' => 'data_non_bilateral']);
    });

    Route::prefix('template')->name('template.')->group(function () {
        Route::get('detail_barang', [TemplateController::class, 'detail_barang']);
        Route::get('pagu_awal', [TemplateController::class, 'pagu_awal']);
        Route::get('pendidikan-dukkesops', [TemplateController::class, 'pendidikan_dukkesops']);
        Route::get('werving-dukkesops', [TemplateController::class, 'werving_dukkesops']);
        Route::get('satgas-dukkesops', [TemplateController::class, 'satgas_dukkesops']);
        Route::get('detail-bekkes', [TemplateController::class, 'detail_bekkes']);
        Route::get('bekkes-satgas', [BekkesPenugasanController::class, 'download']);
    });

    // Lafibiovak
    Route::get('/dashboard_lafi', 'App\Http\Controllers\lafibiovak\DashboardController@dashboard');
    Route::get('/struktur_organisasi_lavibiovak', [StrukturLavibiovakController::class, 'index']);
    Route::get('/jalur_company', function () {
        return view('lafibiovak.jalur_company', ['active_menu' => 'jalur_company']);
    });

    // Dukkesops
    Route::get('/struktur_organisasi_dukkesops', [StrukturDukkesopsController::class, 'index']);

    // Pendidikan
    Route::get('/pendidikan', function () {
        return view('dukkesops.rikujikkes.pendidikan.index', ['active_menu' => 'pendidikan']);
    });
    Route::get('/tambah_rikkes_pendidikan', function () {
        return view('dukkesops.rikujikkes.pendidikan.create', ['active_menu' => 'pendidikan']);
    });
    Route::get('/hasil_rikkes_pendidikan', function () {
        return view('dukkesops.rikujikkes.pendidikan.hasil_rikkes', ['active_menu' => 'pendidikan']);
    });
    Route::get('/preview_rikkes_pendidikan', function () {
        return view('dukkesops.rikujikkes.pendidikan.preview', ['active_menu' => 'pendidikan']);
    });

    // Pendidikan
    Route::get('/anggaran', function () {
        return view('dukkesops.anggaran.index', ['active_menu' => 'anggaran']);
    });
    Route::get('/tambah_anggaran', function () {
        return view('dukkesops.anggaran.create', ['active_menu' => 'anggaran']);
    });

    // Satgas DN
    Route::get('/satgas_dn', function () {
        return view('dukkesops.bekkes.satgas_dn.index', ['active_menu' => 'satgas_dn']);
    });

    // Satgas LN
    Route::get('/satgas_ln', function () {
        return view('dukkesops.bekkes.satgas_ln.index', ['active_menu' => 'satgas_ln']);
    });

    // Taud
    Route::prefix('taud')->name('taud.')->group(function () {
        Route::get('bbm/list', 'App\Http\Controllers\taud\BBMController@list');
        Route::resource('bbm', 'App\Http\Controllers\taud\BBMController');
        Route::get('ranmor/list', 'App\Http\Controllers\taud\RanmorController@list');
        Route::resource('ranmor', 'App\Http\Controllers\taud\RanmorController');
        Route::get('dashboard', 'App\Http\Controllers\taud\TaudController@index');
        Route::get('dashboard/data', 'App\Http\Controllers\taud\TaudController@data');
        Route::get('dashboard/bbm', 'App\Http\Controllers\taud\TaudController@bbm');
    });

    // Bangkes
    // Dashboard Sistoda
    Route::get('/dashboard_sistoda', function () {
    });

    // Jadwal Supervisi
    Route::get('/jadwal_supervisi', function () {
    });
    Route::get('/tambah_jadwal_supervisi', function () {
    });
    Route::get('/edit_jadwal_supervisi', function () {
        return view('bangkes.subbid_sistoda.jadwal_supervisi.edit', ['active_menu' => 'jadwal_supervisi']);
    });
    Route::get('/detail_panitia_eksternal', function () {
        return view('bangkes.subbid_sistoda.jadwal_supervisi.panitia_eksternal', ['active_menu' => 'jadwal_supervisi']);
    });
    Route::get('/detail_jadwal_supervisi', function () {
        return view('bangkes.subbid_sistoda.jadwal_supervisi.detail_supervisi', ['active_menu' => 'jadwal_supervisi']);
    });

    // Paramedis
    Route::get('/paramedis', function () {
    });
    Route::get('/tambah_paramedis', function () {
    });
    Route::get('/edit_paramedis', function () {
        return view('bangkes.subbid_sdm.paramedis.edit', ['active_menu' => 'paramedis']);
    });

    // Patubel
    Route::get('/edit_patubel', function () {
        return view('bangkes.subbid_sdm.pendidikan.patubel.edit', ['active_menu' => 'patubel']);
    });
    Route::get('/tmt_patubel', function () {
        return view('bangkes.subbid_sdm.pendidikan.patubel.tmt', ['active_menu' => 'patubel']);
    });

    // Lulusan
    Route::get('/lulusan', function () {
        return view('bangkes.subbid_sdm.pendidikan.lulusan.index', ['active_menu' => 'lulusan']);
    });
    Route::get('/tambah_lulusan', function () {
        return view('bangkes.subbid_sdm.pendidikan.lulusan.create', ['active_menu' => 'lulusan']);
    });
    Route::get('/edit_lulusan', function () {
        return view('bangkes.subbid_sdm.pendidikan.lulusan.edit', ['active_menu' => 'lulusan']);
    });

    // Selesai Internship

    Route::get('/tambah_selesai_internship', function () {
        return view('bangkes.subbid_sdm.internship.selesai.create', ['active_menu' => 'selesai_internship']);
    });

    // Struktur Jenis Paramedis
    Route::get('/jenis_paramedis', function () {
        return view('bangkes.master_data.spesialis.jenis_paramedis.index', ['active_menu' => 'jp']);
    });

    Route::get('/jenis_paramedis/create', function () {
        return view('bangkes.master_data.spesialis.jenis_paramedis.create', ['active_menu' => 'jp']);
    });

    // Pelatihan
    Route::get('/jenis_pelatihan', function () {
        return view('bangkes.master_data.jenis_pelatihan.index', ['active_menu' => 'jenis_pelatihan']);
    });

    // Data Request
    Route::get('/data_request', function () {
        return view('rumah_sakit.data_request.index', ['active_menu' => 'data_request']);
    });

    // Profile
    Route::get('/profile', function () {
        return view('umum.profile');
    });
    Route::post('/profile', 'App\Http\Controllers\UsersController@update_profile');

    Route::get('/data_regulasi', function () {
        return view('bangkes.subbid_sistoda.regulasi.data_regulasi', ['active_menu' => 'data_regulasi']);
    });

    Route::get('/tambah_regulasi', function () {
        return view('bangkes.subbid_sistoda.regulasi.tambah_regulasi', ['active_menu' => 'data_regulasi']);
    });

    Route::get('/detail_regulasi', function () {
        return view('bangkes.subbid_sistoda.regulasi.detail_regulasi', ['active_menu' => 'data_regulasi']);
    });
    Route::get('/regulasi_taud', function () {
        return view('taud.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_taud']);
    });
    Route::get('/regulasi_bidum', function () {
        return view('bidum.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_bidum']);
    });
    Route::get('/regulasi_yankesin', function () {
        return view('yankesin.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_yankesin']);
    });
    Route::get('/regulasi_matfaskes', function () {
        return view('matfaskes.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_matfaskes']);
    });
    Route::get('/regulasi_kerma', function () {
        return view('kermabaktikes.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_kerma']);
    });
    Route::get('/regulasi_dukkesops', function () {
        return view('dukkesops.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_dukkesops']);
    });
    Route::get('/regulasi_dobekkes', function () {
        return view('dobekkes.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_dobekkes']);
    });
    Route::get('/regulasi_lafibiovak', function () {
        return view('lafibiovak.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_lafibiovak']);
    });
    Route::get('/regulasi_bangkes', function () {
        return view('bangkes.subbid_sistoda.regulasi.daftar_regulasi', ['active_menu' => 'regulasi_bangkes']);
    });

    Route::get('/data_fasilitas_rs', function () {
        return view('yankesin.data_fasilitas.fasilitas_rs', ['active_menu' => 'data_fasilitas_rs']);
    });
    Route::get('/data_fasilitas_ambulance', function () {
        return view('yankesin.data_fasilitas.fasilitas_ambulance', ['active_menu' => 'data_fasilitas_ambulance']);
    });

    Route::prefix('/org_personil')->group(function () {
        Route::get('/', [StrukturOrganisasiController::class, 'index']);
        Route::get('/personil', [StrukturOrganisasiController::class, 'personil']);
        Route::get('/jabatan', [StrukturOrganisasiController::class, 'jabatan']);
        Route::get('/preview/{id}', [StrukturOrganisasiController::class, 'preview']);
        Route::get('/chart/{id}', [StrukturOrganisasiController::class, 'chart']);
        Route::post('/store', [StrukturOrganisasiController::class, 'store']);
        Route::get('/list', [StrukturOrganisasiController::class, 'list']);
        Route::get('/edit/{id}', [StrukturOrganisasiController::class, 'edit']);
        Route::post('/update/{id}', [StrukturOrganisasiController::class, 'update']);
        Route::delete('/delete/{id}', [StrukturOrganisasiController::class, 'delete']);
    });

    Route::get('/struktur-organisasi/{id}', [StrukturOrganisasiController::class, 'struktur_organisasi']);

    Route::get('/sebaran_fasilitas_faskes', [DashboardYankesinController::class,  'sebaran_fasilitas_faskes']);

    Route::get('/detail_pos_satgas', function () {
        return view('dukkesops.pos_satgas.detail', ['active_menu' => 'pos_satgas']);
    });

    // Route::get('/data_posyandu', function () {

    // });

    Route::get('/aturan_bekkes', function () {
        return view('dukkesops.aturan_bekkes.index', ['active_menu' => 'aturan_bekkes']);
    });
    Route::get('/tambah_aturan_bekkes', function () {
        return view('dukkesops.aturan_bekkes.form', ['active_menu' => 'aturan_bekkes']);
    });

    Route::get('/kalender_dn', function () {
        return view('dukkesops.kalender_ops.kalender_dn', ['active_menu' => 'kalender_dn']);
    });
    Route::get('/tambah_kalender_dn', function () {
        return view('dukkesops.kalender_ops.form_dn', ['active_menu' => 'kalender_dn']);
    });





    Route::get('/tambah_kalender_ln', function () {
        return view('dukkesops.kalender_ops.form_ln', ['active_menu' => 'kalender_ln']);
    });
    Route::get('/report_bekkes', function () {
        return view('dukkesops.kalender_ops.report_bekkes', ['active_menu' => 'report_bekkes']);
    });

    // Rikujikkes Satgas
    Route::get('/rikujikkes_satgas_ln', function () {
        return view('dukkesops.rikujikkes.seleksi_satgas_ln.menu', ['active_menu' => 'seleksi_satgas_ln']);
    });
    Route::get('/rikkes_satgas_ln_pratugas', function () {
        return view('dukkesops.rikujikkes.seleksi_satgas_ln.hasil_rikkes_pratugas', ['active_menu' => 'seleksi_satgas_ln']);
    });

    Route::get('/satgas_ln_purnatugas', function () {
        return view('dukkesops.rikujikkes.satgas_ln_purnatugas.index', ['active_menu' => 'seleksi_satgas_ln']);
    });
    Route::get('/tambah_satgas_ln_purnatugas', function () {
        return view('dukkesops.rikujikkes.satgas_ln_purnatugas.create', ['active_menu' => 'seleksi_satgas_ln']);
    });
    Route::get('/rikkes_satgas_ln_purnatugas', function () {
        return view('dukkesops.rikujikkes.satgas_ln_purnatugas.hasil_rikkes', ['active_menu' => 'seleksi_satgas_ln']);
    });

    Route::get('/rikujikkes_satgas_dn', function () {
        return view('dukkesops.rikujikkes.seleksi_satgas_ln.menu_dn', ['active_menu' => 'seleksi_satgas_dn']);
    });
    Route::get('/satgas_dn_pratugas', function () {
        return view('dukkesops.rikujikkes.satgas_dn_pratugas.index', ['active_menu' => 'seleksi_satgas_dn']);
    });
    Route::get('/tambah_satgas_dn_pratugas', function () {
        return view('dukkesops.rikujikkes.satgas_dn_pratugas.create', ['active_menu' => 'seleksi_satgas_dn']);
    });
    Route::get('/rikkes_satgas_dn_pratugas', function () {
        return view('dukkesops.rikujikkes.satgas_dn_pratugas.hasil_rikkes', ['active_menu' => 'seleksi_satgas_dn']);
    });

    Route::get('/satgas_dn_purnatugas', function () {
        return view('dukkesops.rikujikkes.satgas_dn_purnatugas.index', ['active_menu' => 'seleksi_satgas_dn']);
    });
    Route::get('/tambah_satgas_dn_purnatugas', function () {
        return view('dukkesops.rikujikkes.satgas_dn_purnatugas.create', ['active_menu' => 'seleksi_satgas_dn']);
    });
    Route::get('/rikkes_satgas_dn_purnatugas', function () {
        return view('dukkesops.rikujikkes.satgas_dn_purnatugas.hasil_rikkes', ['active_menu' => 'seleksi_satgas_dn']);
    });

    Route::get('/master_tipe_pos', function () {
        return view('dukkesops.tipe_pos.index', ['active_menu' => 'master_tipe_pos']);
    });

    Route::get('/rotasi_satgas_dn', function () {
        return view('dukkesops.rotasi_satgas.dalam_negeri.index', ['active_menu' => 'rotasi_satgas_dn']);
    });
    Route::get('/tambah_rotasi_satgas_dn', function () {
        return view('dukkesops.rotasi_satgas.dalam_negeri.form', ['active_menu' => 'rotasi_satgas_dn']);
    });
    Route::get('/edit_data_rotasi_dn', function () {
        return view('dukkesops.rotasi_satgas.dalam_negeri.edit_data_rotasi', ['active_menu' => 'rotasi_satgas_dn']);
    });
    Route::get('/preview_rotasi_satgas_dn', function () {
        return view('dukkesops.rotasi_satgas.dalam_negeri.preview', ['active_menu' => 'rotasi_satgas_dn']);
    });

    Route::get('/rotasi_satgas_ln', function () {
        return view('dukkesops.rotasi_satgas.luar_negeri.index', ['active_menu' => 'rotasi_satgas_ln']);
    });
    Route::get('/tambah_rotasi_satgas_ln', function () {
        return view('dukkesops.rotasi_satgas.luar_negeri.form', ['active_menu' => 'rotasi_satgas_ln']);
    });
    Route::get('/edit_data_rotasi_ln', function () {
        return view('dukkesops.rotasi_satgas.luar_negeri.edit_data_rotasi', ['active_menu' => 'rotasi_satgas_ln']);
    });
    Route::get('/detail_personil_rotasi_ln', function () {
        return view('dukkesops.rotasi_satgas.luar_negeri.detail_personil', ['active_menu' => 'rotasi_satgas_ln']);
    });
    Route::get('/tambah_personil_rotasi_ln', function () {
        return view('dukkesops.rotasi_satgas.luar_negeri.tambah_personil', ['active_menu' => 'rotasi_satgas_ln']);
    });

    Route::get('/edit_data_satgas_operasi', function () {
        return view('dukkesops.bekkes.satgas_new.edit', ['active_menu' => 'bekkes_dn_dukkesops']);
    });
    Route::get('/bekkes_ln', function () {
        return view('dukkesops.bekkes.satgas_new.index', ['active_menu' => 'bekkes_ln_dukkesops']);
    });

    Route::get('/daftar_anggaran_dukkesops', function () {
        return view('dukkesops.anggaran.daftar_anggaran', ['active_menu' => 'anggaran']);
    });
    Route::get('/detail_daftar_anggaran', function () {
        return view('dukkesops.anggaran.detail_daftar_anggaran', ['active_menu' => 'anggaran']);
    });

    Route::get('/bekkes_dn_dobek', function () {
        return view('dobekkes.bekkes.satgas_ops.index', ['active_menu' => 'bekkes_dn_dobek']);
    });
    Route::get('/bekkes_ln_dobek', function () {
        return view('dobekkes.bekkes.satgas_ops.index', ['active_menu' => 'bekkes_ln_dobek']);
    });
    Route::get('/update_status', function () {
        return view('dobekkes.bekkes.satgas_ops.create', ['active_menu' => 'bekkes_dn_dobek']);
    });
});
