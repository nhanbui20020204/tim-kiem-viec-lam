<?php

use App\Http\Controllers\AccessLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaiDangController;
use App\Http\Controllers\BangDiemController;
use App\Http\Controllers\CongTyController;
use App\Http\Controllers\BaiDangTieuChiController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\MailLienHeController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\QuyenController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\SinhVienDatYeuCauController;
use App\Http\Controllers\SinhVienUngTuyenController;
use App\Http\Controllers\SkillSinhVienController;
use App\Http\Controllers\SkillTieuChiController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ThongKeController;
use Illuminate\Support\Facades\Route;


Route::get('sinhvien/import', [BangDiemController::class, 'indexexcel']);
Route::post('sinhvien/import', [BangDiemController::class, 'importExcelData']);

Route::get('bangdiem/export', [BangDiemController::class, 'exportBangDiemExcel']);
Route::get('sinhvien/tieuchi/export/{id}', [BaiDangTieuChiController::class, 'exportFileSinhVien']);
Route::get('/', [AccessLoginController::class, 'index'])->name('lienHe');
Route::group(['prefix'  =>  '/'], function () {
    Route::get('/lienhe', [MailLienHeController::class, 'lien_he'])->name('lienHe');
    Route::post('/guilienhe', [MailLienHeController::class, 'gui_lien_he'])->name('createGuiMail');
    Route::get('/data', [MailLienHeController::class, 'dataGuiMail'])->name('DataGuiMail');
    Route::post('/status', [MailLienHeController::class, 'status'])->name('statusSinhVienMail');
    Route::post('/delete', [MailLienHeController::class, 'deleteGuiMail'])->name('deleteGuiMail');
    Route::post('/search', [MailLienHeController::class, 'searchGuiMail'])->name('searchGuiMail');
    Route::get('/thongbao', [MailLienHeController::class, 'thong_bao'])->name('thongBao');
});
Route::get('/active/{code}', [SinhVienController::class, 'activeAccount']);
Route::get('/activee/{code}', [CongTyController::class, 'activeAccount']);
Route::get('/activeee/{code}', [KhoaController::class, 'activeAccount']);
Route::group(['prefix'  =>  '/admin', 'middleware' => 'AdminMiddleware'], function () {
    Route::get('/', [TestController::class, 'index'])->name('');
    Route::get('/index', [AdminController::class, 'index'])->name('viewAdmin');
    Route::post('/create', [AdminController::class, 'create'])->name('AdminCreate');
    Route::get('/data', [AdminController::class, 'data'])->name('AdminData');
    Route::post('/delete', [AdminController::class, 'destroy'])->name('AdminDelete');
    Route::post('/update', [AdminController::class, 'update'])->name('AdminUpdate');
    Route::post('/status', [AdminController::class, 'status'])->name('AdminStatus');
    Route::post('/search', [AdminController::class, 'search'])->name('AdminSearch');
    Route::post('/doi-mat-khau', [AdminController::class, 'doiMatKhau'])->name('doiMatKhau');

    Route::group(['prefix'  =>  '/khoa'], function () {
        Route::get('/', [KhoaController::class, 'index'])->name('viewKhoa');
        Route::get('/data', [KhoaController::class, 'data'])->name('dataKhoa');
        Route::post('/create', [KhoaController::class, 'store'])->name('createKhoa');
        Route::post('/delete', [KhoaController::class, 'destroy'])->name('deleteKhoa');
        Route::post('/status', [KhoaController::class, 'status'])->name('statusKhoa');
        Route::post('/edit', [KhoaController::class, 'edit'])->name('editKhoa');
        Route::post('/update', [KhoaController::class, 'update'])->name('updateKhoa');
        // Route::post('/check-mail', [KhoaController::class, 'checkMail'])->name('checkMailKhoa');
        // Route::post('/check-mail-update', [KhoaController::class, 'checkMailUpdate'])->name('checkMailUpdateKhoa');
        Route::post('/search', [KhoaController::class, 'search'])->name('searchKhoa');
    });
    Route::group(['prefix'  =>  '/bang-diem'], function () {
        Route::get('/', [BangDiemController::class, 'index_admin']);
        Route::post('/create', [BangDiemController::class, 'create'])->name('createBangDiemAdmin');
        Route::get('/data', [BangDiemController::class, 'data'])->name('dataBangDiemAdmin');
        Route::post('/delete', [BangDiemController::class, 'destroy'])->name('deleteBangDiemAdmin');
        Route::post('/status', [BangDiemController::class, 'status'])->name('statusBangDiemAdmin');
        Route::post('/update', [BangDiemController::class, 'update'])->name('updateBangDiemAdmin');
        Route::post('/search', [BangDiemController::class, 'search'])->name('searchBangDiemAdmin');
        Route::post('/statusDuyet', [BangDiemController::class, 'statusDuyet'])->name('statusDuyetBangDiemAdmin');
    });
    Route::group(['prefix'  =>  '/cong-ty'], function () {
        Route::get('/', [CongTyController::class, 'indexAdmin'])->named('viewCongty');
        Route::get('/data', [CongTyController::class, 'dataAdmin'])->name('dataCongTy');
        Route::post('/create', [CongTyController::class, 'createAdmin'])->name('createCongTy');
        Route::post('/delete', [CongTyController::class, 'destroyAdmin'])->name('deleteCongTy');
        Route::post('/status', [CongTyController::class, 'statusAdmin'])->name('statusCongTy');
        Route::post('/update', [CongTyController::class, 'updateAdmin'])->name('updateCongTy');
        Route::post('/search', [CongTyController::class, 'searchAdmin'])->name('searchCongTy');

        Route::post('/check-slug', [CongTyController::class, 'checkSlug'])->name('checkSlugChuyenMuc');
        Route::post('/check-slug-update', [CongTyController::class, 'checkSlugUpdate'])->name('checkSlugUpdateChuyen');
    });
    Route::group(['prefix'  =>  '/tieu-chi'], function () {
        Route::get('/', [BaiDangTieuChiController::class, 'index_admin'])->name('viewTieuChi');;
        Route::post('/create', [BaiDangTieuChiController::class, 'createAdmin'])->name('createTieuChiAdmin');
        Route::get('/data', [BaiDangTieuChiController::class, 'dataAdmin'])->name('dataTieuChiAdmin');
        Route::post('/delete', [BaiDangTieuChiController::class, 'destroyAdmin'])->name('deleteTieuChiAdmin');
        Route::post('/status', [BaiDangTieuChiController::class, 'statusAdmin'])->name('statusTieuChiAdmin');
        Route::post('/update', [BaiDangTieuChiController::class, 'updateAdmin'])->name('updateTieuChiAdmin');
        Route::post('/statusDuyet', [BaiDangTieuChiController::class, 'statusDuyetAdmin'])->name('statusDuyetTieuChiAdmin');
        Route::post('/search', [BaiDangTieuChiController::class, 'searchAdmin'])->name('searchTieuChiAdmin');
    });
    Route::group(['prefix'  =>  '/sinh-vien'], function () {
        Route::get('/', [SinhVienController::class, 'index'])->name('viewSinhVien');
        Route::get('/data', [SinhVienController::class, 'data'])->name('dataSinhvien');
        Route::post('/create', [SinhVienController::class, 'store'])->name('createSinhvien');
        Route::post('/delete', [SinhVienController::class, 'destroy'])->name('deleteSinhvien');
        Route::post('/status', [SinhVienController::class, 'status'])->name('statusSinhvien');
        Route::post('/update', [SinhVienController::class, 'update'])->name('updateSinhvien');
        Route::post('/doi-mat-khau', [SinhVienController::class, 'doiMatKhau'])->name('doiMatKhau');
        Route::post('/search', [SinhVienController::class, 'search'])->name('searchSinhvien');
        Route::post('/edit', [SinhVienController::class, 'edit'])->name('editSinhvien');
    });
    Route::group(['prefix'  =>  '/nganh'], function () {
        Route::get('/', [NganhController::class, 'index']);
        Route::get('/data', [NganhController::class, 'data'])->name('NganhData');
        Route::post('/create', [NganhController::class, 'create'])->name('NganhCreate');
        Route::post('/delete', [NganhController::class, 'delete'])->name('NganhDelete');
        Route::post('/status', [NganhController::class, 'status'])->name('NganhStatus');
        Route::post('/update', [NganhController::class, 'update'])->name('NganhUpdate');
        Route::post('/search', [NganhController::class, 'search'])->name('NganhSearch');
    });

    Route::group(['prefix'  =>  '/skill'], function () {
        Route::get('/', [SkillController::class, 'index'])->name('Skill');
        Route::get('/data', [SkillController::class, 'data'])->name('dataSkill');
        Route::post('/create', [SkillController::class, 'store'])->name('createSkill');
        Route::post('/delete', [SkillController::class, 'destroy'])->name('deleteSkill');
        Route::post('/status', [SkillController::class, 'status'])->name('statusSkill');
        Route::post('/edit', [SkillController::class, 'edit'])->name('updateSkill');
        Route::post('/search', [SkillController::class, 'search'])->name('searchSkill');
    });

    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', [AdminController::class, 'index_profile'])->name('viewProfileAdmin');
        Route::get('/data', [AdminController::class, 'getProfile'])->name('getProfileAdmin');
        Route::post('/update', [AdminController::class, 'updateProfile'])->name('updateProfileAdmin');
        Route::post('/update-password', [AdminController::class, 'updatePassword'])->name('updatePasswordAdmin');
    });
    Route::group(['prefix' => '/quyen'], function () {
        Route::get('/', [QuyenController::class, 'index']);
        Route::get('/data', [QuyenController::class, 'getData']);
        Route::get('/data-action', [QuyenController::class, 'getAction']);

        Route::post('/create', [QuyenController::class, 'store']);
        Route::post('/delete', [QuyenController::class, 'destroy']);
        Route::post('/update', [QuyenController::class, 'update']);
        Route::post('/update-action', [QuyenController::class, 'updateAction']);
        Route::get('/update-status/{id}', [QuyenController::class, 'updateStatus']);
    });
});

// Sinh Viên
Route::get('/confirm-phong-van/{id}/{id_tieu_chi}/{tinh_trang}', [SinhVienController::class, 'confirmPhongVan']);
Route::group(['prefix'  =>  '/ung-tuyen'], function () {
    Route::post('/create', [SinhVienUngTuyenController::class, 'create'])->name('themMoiSinhVienUngTuyen');
    Route::post('/delete', [SinhVienUngTuyenController::class, 'destroy'])->name('xoaSinhVienUngTuyen');
    Route::post('/status', [SinhVienUngTuyenController::class, 'status'])->name('statusUngTuyen');
    Route::post('/data', [SinhVienUngTuyenController::class, 'data'])->name('dataUngTuyen');
});
Route::group(['prefix'  =>  '/sinh-vien', 'middleware' => 'SinhVienMiddleware'], function () {
    Route::group(['prefix'  =>  '/bang-diem'], function () {
        Route::get('/', [BangDiemController::class, 'index'])->name('BANGDIEM');
        Route::post('/create', [BangDiemController::class, 'create'])->name('createBangDiem');
        Route::get('/data', [BangDiemController::class, 'data'])->name('dataBangDiem');
        Route::post('/status', [BangDiemController::class, 'status'])->name('statusBangDiem');
        Route::post('/statusDuyet', [BangDiemController::class, 'statusDuyet'])->name('statusDuyetBangDiem');
        Route::post('/update', [BangDiemController::class, 'update'])->name('updateBangDiem');
        Route::post('/delete', [BangDiemController::class, 'destroy'])->name('deleteBangDiem');
        Route::post('/search', [BangDiemController::class, 'search'])->name('searchBangDiem');
    });
    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', [SinhVienController::class, 'index_profile'])->name('viewProfileSinhVien');
        Route::get('/data', [SinhVienController::class, 'getProfile'])->name('getProfileSinhVien');
        Route::post('/update', [SinhVienController::class, 'updateProfile'])->name('updateProfileSinhVien');
        Route::post('/update-password', [SinhVienController::class, 'updatePassword'])->name('updatePasswordSinhVien');
    });
    Route::group(['prefix'  =>  '/tieu-chi'], function () {
        Route::get('/', [SinhVienDatYeuCauController::class, 'index_sinh_vien']);
        Route::get('/data', [BaiDangTieuChiController::class, 'dataTieuChiSinhVien'])->name('dataTieuChiSinhVien');
    });
    Route::group(['prefix'  =>  '/skill'], function () {
        Route::get('/data', [SkillController::class, 'data'])->name('dataSkillForSinhVien');
    });


    Route::group(['prefix'  =>  '/danh-gia'], function () {
        Route::get('/', [DanhGiaController::class, 'index_sinh_vien_danh_gia'])->name('indexDanhGiaSinhVien');;
        Route::get('/data', [DanhGiaController::class, 'data'])->name('dataDanhGia');
        Route::post('/create', [DanhGiaController::class, 'create'])->name('createDanhgia');
        Route::post('/status', [DanhGiaController::class, 'status'])->name('statusDanhGia');
        Route::post('/statusDuyet', [DanhGiaController::class, 'statusDuyet'])->name('statusDuyetDanhGia');
        Route::post('/update', [DanhGiaController::class, 'update'])->name('updateDanhgia');
        Route::post('/delete', [DanhGiaController::class, 'destroy'])->name('deleteDanhGia');
        Route::get('/dataNganh', [DanhGiaController::class, 'dataDanhgiaNganh'])->name('NganhDataDanhgia');
        Route::get('/dataKhoa', [DanhGiaController::class, 'dataDanhgiaKhoa'])->name('KhoaDataDanhgia');
        Route::get('/dataCongty', [DanhGiaController::class, 'dataDanhgiaCongty'])->name('CongtyDataDanhgia');
    });
});

// Công ty

Route::group(['prefix' => '/cong-ty', 'middleware' => 'CongTyMiddleware'], function () {
    Route::get('/', [CongTyController::class, 'index_CongTy']);
    Route::group(['prefix'  =>  '/ung-tuyen'], function () {
        Route::post('/data', [SinhVienUngTuyenController::class, 'data'])->name('dataUngTuyenSinhVien');
    });
    // Route của tiêu chí
    Route::group(['prefix'  =>  '/tieu-chi'], function () {
        Route::get('/', [BaiDangTieuChiController::class, 'index'])->name('viewTieuChi');;
        Route::post('/create', [BaiDangTieuChiController::class, 'create'])->name('createTieuChi');
        Route::get('/data', [BaiDangTieuChiController::class, 'data'])->name('dataTieuChi');
        Route::post('/info', [BaiDangTieuChiController::class, 'info'])->name('dataTieuChiInfo');
        Route::post('/status', [BaiDangTieuChiController::class, 'status'])->name('statusTieuChi');
        Route::post('/statusDuyet', [BaiDangTieuChiController::class, 'statusDuyet'])->name('statusDuyetTieuChi');
        Route::post('/update', [BaiDangTieuChiController::class, 'update'])->name('updateTieuChi');
        Route::post('/delete', [BaiDangTieuChiController::class, 'destroy'])->name('deleteTieuChi');
        Route::post('/search', [BaiDangTieuChiController::class, 'search'])->name('searchTieuChi');
    });
    Route::get('/nganh/data', [NganhController::class, 'data'])->name('NganhDataCongTy');

    Route::get('/danh-muc/data', [SkillController::class, 'data'])->name('dataSkillCongTy');


    Route::group(['prefix' => '/profile'], function () {
        // Lấy thông tin của profile đang login
        Route::get('/', [CongTyController::class, 'index_profile'])->name('viewProfileCongty');
        Route::post('/data', [CongTyController::class, 'getProfile'])->name('getProfileCongty');
        Route::post('/update', [CongTyController::class, 'updateProfile'])->name('updateProfileCongty');
        Route::post('/update-password', [CongTyController::class, 'updatePassword'])->name('updatePasswordCongty');
    });
    Route::group(['prefix'  =>  '/sinh-vien-dat-yeu-cau'], function () {
        Route::post('/data', [SinhVienDatYeuCauController::class, 'getDataDatYeuCau'])->name('getDataDatYeuCau');
    });
});

Route::group(['prefix'  =>  '/skill-tieu-chi'], function () {
    Route::post('/data', [SkillTieuChiController::class, 'data'])->name('dataSkillTieuChi');
});
// Khoa
Route::group(['prefix' => '/khoa', 'middleware' => 'KhoaMiddleware'], function () {
    Route::get('/', [KhoaController::class, 'index_khoa']);
    Route::group(['prefix' => '/profile'], function () {
        // Lấy thông tin của profile đang login
        Route::get('/', [KhoaController::class, 'index_profile'])->name('viewProfileKhoa');
        Route::get('/data', [KhoaController::class, 'getProfile'])->name('getProfileKhoa');
        Route::post('/update', [KhoaController::class, 'updateProfile'])->name('updateProfileKhoa');
        Route::post('/update-password', [KhoaController::class, 'updatePassword'])->name('updatePasswordKhoa');
    });
    Route::group(['prefix'  =>  '/thong-ke'], function () {
        Route::get('/', [ThongKeController::class, 'index'])->name('index');
        Route::post('/tieu-chi', [ThongKeController::class, 'thongKeTieuChi'])->name('thongKeTieuChi');
        Route::get('/sinh-vien-phong-van', [ThongKeController::class, 'viewSinhVienPhongVan'])->name('viewThongKeSinhVienPhongVan');
        Route::post('/sinh-vien-phong-van', [ThongKeController::class, 'thongKeSinhVienPhongVan'])->name('thongKeSinhVienPhongVan');
    });
    Route::group(['prefix'  =>  '/sinh-vien'], function () {
        Route::get('/', [SinhVienController::class, 'index'])->name('viewSinhVien');
        Route::get('/', [SinhVienController::class, 'index_khoa']);
        Route::get('/data', [SinhVienController::class, 'data'])->name('dataSinhvienKhoa');
        Route::post('/create', [SinhVienController::class, 'storeSinhVienKhoa'])->name('createSinhvienKhoa');
        Route::post('/search', [SinhVienController::class, 'search'])->name('searchSinhvienKhoa');
        Route::post('/status', [SinhVienController::class, 'status'])->name('statusSinhvienKhoa');
        Route::post('/delete', [SinhVienController::class, 'destroy'])->name('deleteSinhvienKhoa');
        Route::post('/update', [SinhVienController::class, 'updateSinhVienKhoa'])->name('updateSinhvienKhoa');
        Route::post('/doi-mat-khau', [SinhVienController::class, 'doiMatKhau'])->name('doiMatKhauKhoa');

        Route::post('/sinh-vien-du-dieu-kien', [SinhVienController::class, 'sinhVienDuDieuKien'])->name('sinhVienDuDieuKien');
        Route::post('/add-sinh-vien-du-dieu-kien', [SinhVienController::class, 'addSinhVienDuDieuKien'])->name('addSinhVienDuDieuKien');
    });
    Route::group(['prefix'  =>  '/bang-diem'], function () {
        Route::get('/', [BangDiemController::class, 'index_khoa'])->name('BANGDIEMKHOA');
        Route::post('/create', [BangDiemController::class, 'create'])->name('createBangDiemKhoa');
        Route::post('/data', [BangDiemController::class, 'data'])->name('dataBangDiemKhoa');
        Route::post('/status', [BangDiemController::class, 'status'])->name('statusBangDiemKhoa');
        Route::post('/statusDuyet', [BangDiemController::class, 'statusDuyet'])->name('statusDuyetBangDiemKhoa');
        Route::post('/update', [BangDiemController::class, 'update'])->name('updateBangDiemKhoa');
        Route::post('/delete', [BangDiemController::class, 'destroy'])->name('deleteBangDiemKhoa');
        Route::post('/search', [BangDiemController::class, 'search'])->name('searchBangDiemKhoa');
    });
    Route::group(['prefix'  =>  '/tieu-chi'], function () {
        Route::get('/', [BaiDangTieuChiController::class, 'index_khoa']);
        Route::post('/create', [BaiDangTieuChiController::class, 'create'])->name('createTieuChiKhoa');
        Route::get('/data', [BaiDangTieuChiController::class, 'dataTieuChiKhoa'])->name('dataTieuChiKhoa');
        Route::post('/status', [BaiDangTieuChiController::class, 'status'])->name('statusTieuChiKhoa');
        Route::post('/statusDuyet', [BaiDangTieuChiController::class, 'statusDuyet'])->name('statusDuyetTieuChiKhoa');
        Route::post('/update', [BaiDangTieuChiController::class, 'update'])->name('updateTieuChiKhoa');
        Route::post('/delete', [BaiDangTieuChiController::class, 'destroy'])->name('deleteTieuChiKhoa');
        Route::post('/search', [BaiDangTieuChiController::class, 'search'])->name('searchTieuChiKhoa');
    });
    Route::get('/nganh/data', [NganhController::class, 'data'])->name('NganhDataKhoa');
    Route::get('/data', [SkillController::class, 'data'])->name('dataSkillKhoa');

    Route::group(['prefix'  =>  '/danh-gia'], function () {
        Route::get('/', [DanhGiaController::class, 'index_khoa'])->name('DanhGiaKHOA');
        Route::post('/create', [DanhGiaController::class, 'create'])->name('createDanhGiaKhoa');
        Route::get('/data', [DanhGiaController::class, 'data'])->name('dataDanhGiaKhoa');
        Route::post('/status', [DanhGiaController::class, 'status'])->name('statusDanhGiaKhoa');
        Route::post('/statusDuyet', [DanhGiaController::class, 'statusDuyet'])->name('statusDuyetDanhGiaKhoa');
        Route::post('/update', [DanhGiaController::class, 'update'])->name('updateDanhGiaKhoa');
        Route::post('/delete', [DanhGiaController::class, 'destroy'])->name('deleteDanhGiaKhoa');
        Route::post('/search', [DanhGiaController::class, 'search'])->name('searchDanhGiaKhoa');
    });
    // Route::get('/khoa/data', [KhoaController::class, 'data'])->name('dataKhoakhoa');

});

Route::group(['prefix'  =>  '/skill-tieu-chi'], function () {
    Route::post('/info', [SkillTieuChiController::class, 'info'])->name('dataTieuChiInfoMain');
});

Route::group(['prefix'  =>  '/skill-sinh-vien'], function () {
    Route::post('/create', [SkillSinhVienController::class, 'create'])->name('createSkillSinhVien');
    Route::get('/data', [SkillSinhVienController::class, 'data'])->name('dataSkillSinhVien');
    Route::post('/update', [SkillSinhVienController::class, 'update'])->name('updateSkillSinhVien');
});


Route::get('/admin/login', [AdminController::class, 'viewLogin'])->name('viewLoginAdmin');
Route::post('/admin/login', [AdminController::class, 'actionLogin'])->name('actionLoginAdmin');
Route::get('/admin/logout', [AdminController::class, 'actionLogout']);


Route::get('/cong-ty/login', [CongTyController::class, 'viewLogin'])->name('viewLoginCongty');
Route::post('/cong-ty/login', [CongTyController::class, 'actionLogin'])->name('actionLoginCongty');
Route::get('/cong-ty/register', [CongTyController::class, 'viewRegister'])->name('viewRegister');
Route::post('/cong-ty/register', [CongTyController::class, 'actionRegister'])->name('viewRegister');
Route::get('/cong-ty/logout', [CongTyController::class, 'actionLogout'])->name('');



Route::get('/khoa/login', [KhoaController::class, 'viewLogin'])->name('viewLoginKhoa');
Route::post('/khoa/login', [KhoaController::class, 'actionLogin'])->name('actionLoginKhoa');
Route::get('/khoa/register', [KhoaController::class, 'viewRegister'])->name('viewRegister');
Route::post('/khoa/register', [KhoaController::class, 'actionRegister'])->name('viewRegister');
Route::get('/khoa/logout', [KhoaController::class, 'actionLogout'])->name('');


Route::get('/sinh-vien/login', [SinhVienController::class, 'viewLogin'])->name('viewLoginSinhVien');
Route::post('/sinh-vien/login', [SinhVienController::class, 'actionLogin'])->name('actionLoginSinhVien');
Route::get('/data-khoa', [SinhVienController::class, 'dataKhoa'])->name('dataKhoaDangKy');
Route::post('/data-nganh', [SinhVienController::class, 'dataNganh'])->name('dataNganhDangKy');


Route::get('/sinh-vien/register', [SinhVienController::class, 'viewRegister'])->name('viewRegister');
Route::post('/sinh-vien/register', [SinhVienController::class, 'actionRegister'])->name('viewRegister');
Route::get('/sinh-vien/logout', [SinhVienController::class, 'actionLogout'])->name('');
