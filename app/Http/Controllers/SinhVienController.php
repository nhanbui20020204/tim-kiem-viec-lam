<?php

namespace App\Http\Controllers;

use App\Http\Requests\doiMatKhauSinhVienRequest;
use App\Http\Requests\Khoa\Profile\updatePasswordProfileKhoaRequest;
use App\Http\Requests\SinhVien\Auth\dangKySinhVienRequest;
use App\Http\Requests\SinhVien\Profile\updateProfileSinhVienRequest;
use App\Http\Requests\storeSinhVienKhoaRequest;
use App\Http\Requests\updateSinhVienAdminRequest;
use App\Http\Requests\updateSinhVienKhoaRequest;
use App\Http\Requests\User\createSinhVienRequest;
use App\Mail\ActiveMail;
use App\Models\BaiDangTieuChi;
use App\Models\BangDiem;
use App\Models\Khoa;
use App\Models\MailLienHe;
use App\Models\Nganh;
use App\Models\SinhVien;
use App\Models\SinhVienDatYeuCau;
use App\Models\Skill;
use App\Models\SkillTieuChi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class SinhVienController extends Controller
{
    public function index_khoa()
    {
        return view('Khoa.Sinh_vien.index');
    }
    public function doiMatKhau(doiMatKhauSinhVienRequest $request)
    {

        $khoa = Auth::guard('khoa')->user();
        $sinhVien = SinhVien::where('id', $request->id)->first();
        if ($khoa) {

            if ($sinhVien) {
                $data = $request->all();
                // $data['password']     = bcrypt($request->password);
                // $data['password'] = $request->new_password;
                $data['password'] = bcrypt($request->new_password);
                $sinhVien->update($data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đổi mật khẩu thành công!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Sinh viên không tồn tại',
                ]);
            }
        } else {
            $check = $this->checkRule_post(34);
            if (!$check) {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Bạn không có quyền truy cập chức năng này!',
                ]);
            }
            if ($sinhVien) {
                $data = $request->all();
                // $data['password']     = bcrypt($request->password);

                $data['password'] = bcrypt($request->new_password);
                $sinhVien->update($data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đổi mật khẩu thành công!',
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Sinh viên không tồn tại',
                ]);
            }
        }
    }
    public function actionRegister(dangKySinhVienRequest $request)
    {
        $now        = Carbon::now();
        $so_nam    = $now->diffInYears($request->ngay_sinh);
        if ($so_nam < 18) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn chưa đủ tuổi!',
            ]);
        }
        $data                   = $request->all();
        $data['ten_sinh_vien']            = $request['ten_sinh_vien'];
        $data['hash_active']    = Str::uuid();
        $data['password']       = bcrypt($request->password);
        SinhVien::create($data);
        $dataA['link']          =   'http://127.0.0.1:8000' . '/active/' . $data['hash_active'];
        $dataA['ten_sinh_vien']      =   $request->ten_sinh_vien;

        Mail::to($request->email)->send(new ActiveMail($dataA));

        return response()->json([
            'status'    => 1,
            'message'   => 'Bạn vui lòng kiểm tra email để kích hoạt tài khoản!',
        ]);
    }
    public function activeAccount($code)
    {
        $sinhVien   =   SinhVien::where('hash_active', $code)->first();

        if ($sinhVien) {
            $sinhVien->is_active    = 1;
            $sinhVien->hash_active  = NULL;
            $sinhVien->save();
            toastr()->success('Đã kích hoạt tài khoản thành công!');
            return redirect('/sinh-vien/login');
        } else {
            toastr()->error('Liên kết không tồn tại!');
            return redirect('/');
        }
    }
    public function viewRegister()
    {
        return view('sinhvien.register');
    }
    public function actionLogin(Request $request)
    {
        $check_1 = Auth::guard('sinhvien')->attempt(['email'  => $request->email, 'password' => $request->password]);
        if ($check_1) {
            $sinhVien   =   Auth::guard('sinhvien')->user();
            if ($sinhVien->is_active == -1) {
                Auth::guard('sinhvien')->logout();

                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản đã bị khoá. Vui lòng thử lại sau!',
                ]);
            } else if ($sinhVien->is_active == 0) {
                Auth::guard('sinhvien')->logout();

                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản chưa được kích hoạt. Vui lòng thử lại sau!',
                ]);
            }
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã đăng nhập thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Tài khoản hoặc mật khẩu không đúng',
            ]);
        }
    }
    public function viewLogin()
    {
        return view('sinhvien.login');
    }
    public function actionLogout()
    {
        Auth::guard('sinhvien')->logout();
        return redirect('/');
    }
    public function dataKhoa()
    {
        $khoa = Khoa::get();
        return response()->json([
            'khoa'   => $khoa,
        ]);
    }
    public function dataNganh(Request $request)
    {
        $nganh = Nganh::where('id_khoa', $request->id)->get();
        return response()->json([
            'nganh'   => $nganh,
        ]);
    }
    public function index()
    {
        $check = $this->checkRule_get(29);
        if (!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin');
        }
        return view('admin.page.SinhVien.index');
    }
    public function data()
    {
        $khoa = Auth::guard('khoa')->user();
        // Kiểm tra xem khoa có đăng đăng nhập hay không. Nếu có thì lấy theo khoa, không thì lấy admin
        if ($khoa) {
            $data      = SinhVien::where('sinh_viens.id_khoa', $khoa->id)
                ->join('khoas', 'sinh_viens.id_khoa', 'khoas.id')
                ->join('nganhs', 'sinh_viens.id_nganh', 'nganhs.id')
                ->select('sinh_viens.*', 'khoas.ten_khoa', 'nganhs.ten_nganh')
                ->get();
        } else {
            $data      = SinhVien::join('khoas', 'sinh_viens.id_khoa', 'khoas.id')
                ->join('nganhs', 'sinh_viens.id_nganh', 'nganhs.id')
                ->select('sinh_viens.*', 'khoas.ten_khoa', 'nganhs.ten_nganh')
                ->get();
        }

        return response()->json([
            'data' => $data,
        ]);
    }
    public function search(Request $request)
    {
        $gia_tri = '%' . $request->gia_tri . '%';
        $khoa = Auth::guard('khoa')->user();
        if ($khoa) {
            $data     = SinhVien::where('sinh_viens.id_khoa', $khoa->id)
                ->join('khoas', 'sinh_viens.id_khoa', 'khoas.id')
                ->join('nganhs', 'sinh_viens.id_nganh', 'nganhs.id')
                ->where(function ($query)  use ($gia_tri) {
                    $query->where('sinh_viens.ten_sinh_vien', 'like', $gia_tri)
                        ->orWhere('khoas.ten_khoa', 'like', $gia_tri)
                        ->orWhere('nganhs.ten_nganh', 'like', $gia_tri);
                })
                ->select('sinh_viens.*', 'khoas.ten_khoa', 'nganhs.ten_nganh')
                ->get();
        } else {
            $data    =  SinhVien::join('khoas', 'sinh_viens.id_khoa', 'khoas.id')
                ->join('nganhs', 'sinh_viens.id_nganh', 'nganhs.id')
                ->where('sinh_viens.ten_sinh_vien', 'like', $gia_tri)
                ->orWhere('nganhs.ten_nganh', 'like', $gia_tri)
                ->orWhere('khoas.ten_khoa', 'like', $gia_tri)

                ->select('sinh_viens.*', 'khoas.ten_khoa', 'nganhs.ten_nganh')
                ->get();
        }


        return response()->json([
            'data' => $data,
        ]);
    }
    public function status(Request $request)
    {
        $khoa = Auth::guard('khoa')->user();
        if ($khoa) {
            $sinhVien = SinhVien::where('id', $request->id)
                ->first();
            if ($sinhVien) {
                if ($sinhVien->is_active < 1) {
                    $sinhVien->is_active = $sinhVien->is_active + 1;
                } else {
                    $sinhVien->is_active = -1;
                }
                $sinhVien->save();

                return response()->json([
                    'status' => 1,
                    'message' => 'Đã Đổi Trạng Thái Thành Công',
                ]);
            } else {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Sinh Viên Không Tồn Tại!',
                ]);
            }
        } else {
            $check = $this->checkRule_post(32);
            if (!$check) {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Bạn không có quyền truy cập chức năng này!',
                ]);
            }
            $sinhVien = SinhVien::where('id', $request->id)
                ->first();
            if ($sinhVien) {
                if ($sinhVien->is_active < 1) {
                    $sinhVien->is_active = $sinhVien->is_active + 1;
                } else {
                    $sinhVien->is_active = -1;
                }
                $sinhVien->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Đã Đổi Trạng Thái Thành Công',
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Sinh Viên Không Tồn Tại!',
                ]);
            }
        }
    }
    public function store(createSinhVienRequest $request)
    {
        $check = $this->checkRule_post(30);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $now    = Carbon::now();
        $so_nam = $now->diffInYears($request->ngay_sinh);
        if ($so_nam < 18) {
            return response()->json([
                'status'    => false,
                'message'   => 'Bạn chưa đủ tuổi!',
            ]);
        }
        $data                 = $request->all();
        $data['password']     = bcrypt($request->password);
        SinhVien::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Đã Thêm Mới Thành Công',
        ]);
    }
    public function storeSinhVienKhoa(storeSinhVienKhoaRequest $request)
    {
        $now        = Carbon::now();
        $so_nam    = $now->diffInYears($request->ngay_sinh);
        if ($so_nam < 18) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn chưa đủ tuổi!',
            ]);
        }
        $khoa = Auth::guard('khoa')->user();
        $data                 = $request->all();
        $data['password']     = bcrypt($request->password);
        $data['id_khoa']      = $khoa->id;
        $sinhVien   = SinhVien::where('id', $request->id)
            ->first();
        if ($sinhVien) {
            $sinhVien->create($data);
            return response()->json([
                'status' => true,
                'message' => 'Đã Cập Nhật Thành Công',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Sinh Viên Không Tồn Tại!',
            ]);
        }
    }
    public function edit(Request $request)
    {
        $sinhVien = SinhVien::where('id', $request->id)
            ->first();

        if ($sinhVien) {
            return response()->json([
                'status'    => true,
                'data'      => $sinhVien,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Dữ liệu không chính xác!',
            ]);
        }
    }
    public function update(updateSinhVienAdminRequest $request)
    {
        $check = $this->checkRule_post(33);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $now        = Carbon::now();
        $so_nam    = $now->diffInYears($request->ngay_sinh);
        if ($so_nam < 18) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn chưa đủ tuổi!',
            ]);
        }
        $data       = $request->all();
        $sinhVien   = SinhVien::where('id', $request->id)->first();
        $existEmail = SinhVien::where('email', $request->email)->where('email', '<>', $sinhVien->email)->first();
        if ($existEmail) {
            return response()->json([
                'status' => false,
                'message' => 'Email đã tồn tại. Vui lòng thử lại!',
            ]);
        }
        $existMssv = SinhVien::where('mssv', $request->mssv)->where('mssv', '<>', $sinhVien->mssv)->first();
        if ($existMssv) {
            return response()->json([
                'status' => false,
                'message' => 'Mssv đã tồn tại. Vui lòng thử lại!',
            ]);
        }
        if ($sinhVien) {
            $sinhVien->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Đã Cập Nhật Thành Công',
            ]);
        } else {
            return response()->json([
                'status'  => 0,
                'message' => 'Sinh Viên Không Tồn Tại!',
            ]);
        }
    }
    public function updateSinhVienKhoa(updateSinhVienKhoaRequest $request)
    {
        $now        = Carbon::now();
        $so_nam    = $now->diffInYears($request->ngay_sinh);
        if ($so_nam < 18) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn chưa đủ tuổi!',
            ]);
        }
        $khoa = Auth::guard('khoa')->user();
        $data       = $request->all();

        $data['password']     = bcrypt($request->password);
        $data['id_khoa']      = $khoa->id;
        $sinhVien   = SinhVien::where('id', $request->id)
            ->first();
        if ($sinhVien) {
            $sinhVien->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Đã Cập Nhật Thành Công',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Sinh Viên Không Tồn Tại!',
            ]);
        }
    }
    public function destroy(Request $request)
    {

        $khoa = Auth::guard('khoa')->user();
        $sinhVien  = SinhVien::where('id', $request->id)
            ->first();
        if ($khoa) {

            if ($sinhVien) {
                $sinhVien->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Đã Xóa Sinh Viên Thành Công',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Sinh Viên Không Tồn Tại!',
                ]);
            }
        } else {

            if ($sinhVien) {
                $sinhVien->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Đã Xóa Sinh Viên Thành Công',
                ]);
            } else {
                $check = $this->checkRule_post(31);
                if (!$check) {
                    return response()->json([
                        'status'  => 0,
                        'message' => 'Bạn không có quyền truy cập chức năng này!',
                    ]);
                }
                return response()->json([
                    'status' => false,
                    'message' => 'Sinh Viên Không Tồn Tại!',
                ]);
            }
        }
    }
    public function index_sinhvien()
    {
        return view('sinhvien.page.index');
    }
    public function index_profile()
    {
        return view('sinhvien.profile');
    }
    public function getProfile()
    {
        $user = Auth::guard('sinhvien')->user();
        $data = SinhVien::where('id', $user->id)->first();
        return response()->json([
            'data' => $data,
        ]);
    }
    public function updateProfile(updateProfileSinhVienRequest $request)
    {
        $now        = Carbon::now();
        $so_nam    = $now->diffInYears($request->ngay_sinh);
        if ($so_nam < 18) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Bạn chưa đủ tuổi!',
            ]);
        }
        $khoa = Auth::guard('khoa')->user();
        $data       = $request->all();
        $data['password']     = bcrypt($request->password);
        $data['id_khoa']      = $khoa->id;
        $sinhVien   = SinhVien::where('id', $request->id)
            ->first();
        if ($sinhVien) {
            $sinhVien->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Đã Cập Nhật Thành Công',
            ]);
        } else {
            return response()->json([
                'status'  => 0,
                'message' => 'Sinh Viên Không Tồn Tại!',
            ]);
        }
    }
    public function updatePassword(updatePasswordProfileKhoaRequest $request)
    {
        $user = Auth::guard('sinhvien')->user();
        $sinhVien = SinhVien::where('id', $user->id)->first();
        if ($sinhVien) {
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $sinhVien->update($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Đổi Mật Khẩu Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có Lỗi',
            ]);
        }
    }
    public function sinhVienDuDieuKien(Request $request)
    {
        $diem_yeu_cau = $request->diem_yeu_cau;
        $id_tieu_chi = $request->id;
        $khoa = Auth::guard('khoa')->user();
        $list_skill_tieu_chi = SkillTieuChi::where('id_tieu_chi', $id_tieu_chi)
            ->join('skills', 'skills.id', 'skill_tieu_chis.id_tieu_chi')
            ->pluck('ten_skill')
            ->toArray();
        $sinhViens = SinhVien::where('sinh_viens.is_active', 1)
            ->where('sinh_viens.id_khoa', $khoa->id)
            ->get();
        $sinhVienData = [];

        foreach ($sinhViens as $sinhVien) {
            $skills = Skill::join('skill_sinh_viens', 'skills.id', 'skill_sinh_viens.id_skill')
                ->where('skill_sinh_viens.id_sinh_vien', $sinhVien->id)
                ->pluck('skills.ten_skill')
                ->toArray();

            $bangDiems = BangDiem::where('id_sinh_vien', $sinhVien->id)
                ->where('is_duyet', 1)
                ->get();

            $sinhVienData[] = [
                'id'            => $sinhVien->id,
                'id_khoa'       => $sinhVien->id_khoa,
                'ten_sinh_vien' => $sinhVien->ten_sinh_vien,
                'list_skills'   => $skills,
                'list_diems'    => $bangDiems
            ];
        }

        usort($sinhVienData, function ($a, $b) use ($list_skill_tieu_chi, $diem_yeu_cau) {
            // Tính điểm trung bình từ list_diems
            $averageScoreA = $a['list_diems']->avg('diem_so');
            $averageScoreB = $b['list_diems']->avg('diem_so');

            // Đếm số lượng kỹ năng của sinh viên có trong list_skill_tieu_chi
            $matchedSkillsCountA = count(array_intersect($a['list_skills'], $list_skill_tieu_chi));
            $matchedSkillsCountB = count(array_intersect($b['list_skills'], $list_skill_tieu_chi));

            // Nếu điểm trung bình của sinh viên A lớn hơn B, đặt A trước B
            if ($averageScoreA > $averageScoreB) {
                return -1;
            } elseif ($averageScoreA < $averageScoreB) {
                return 1;
            }

            // Nếu điểm trung bình bằng nhau, ưu tiên sinh viên có số lượng kỹ năng trùng khớp nhiều hơn
            if ($matchedSkillsCountA > $matchedSkillsCountB) {
                return -1;
            } else if ($matchedSkillsCountA < $matchedSkillsCountB) {
                return 1;
            }

            // Nếu cả điểm trung bình và số lượng kỹ năng trùng khớp đều bằng nhau, giữ nguyên vị trí
            return 0;
        });
        return response()->json([
            'data'    =>  $sinhVienData,
            'id_tieu_chi' => $id_tieu_chi,
        ]);
    }
    public function addSinhVienDuDieuKien(Request $request)
    {
        $list_sinh_vien = [];
        $tieu_chis = BaiDangTieuChi::where('id', $request->id_tieu_chi)->first();
        foreach ($request->list_sv as $key => $value) {
            if (isset($value['check']) && $value['check'] == true) {
                $bangDiems = BangDiem::where('id_sinh_vien', $value['id'])->where('is_duyet', 1)->pluck('diem_so')->toArray();
                if (empty($bangDiems)) {
                    return response()->json([
                        'status' => -1,
                        'message' => 'Sinh viên' . $value['ten_sinh_vien'] . ' chưa nhập bảng điểm hoặc bảng điểm chưa được duyệt',
                        'bang_diem' => $bangDiems
                    ]);
                }
                $dtbSV = array_sum($bangDiems) / count($bangDiems);
                if ($dtbSV < $tieu_chis->diem_yeu_cau) {
                    return response()->json([
                        'status' => -1,
                        'message' => 'Điểm của sinh viên' . $value['ten_sinh_vien'] . ' thấp hơn điểm yêu cầu'
                    ]);
                }
                array_push($list_sinh_vien, $value);
            }
        }
        if (count($list_sinh_vien) > 0) {
            $sinhVienDaGuiYeuCau =  [];
            foreach ($list_sinh_vien as $k => $v) {
                $sinhVienDatYeuCau = SinhVienDatYeuCau::where('id_tieu_chi', $request->id_tieu_chi)
                    ->where('id_sinh_vien', $v['id'])
                    ->first();
                if (!$sinhVienDatYeuCau) {
                    SinhVienDatYeuCau::create([
                        'id_tieu_chi' => $request->id_tieu_chi,
                        'id_sinh_vien'  => $v['id'],
                        'id_khoa'       => $v['id_khoa'],
                        'is_chon'       => 1,
                    ]);
                } else {
                    $sinhVienDaGuiYeuCau[] = $v['id'];
                }
            }
            if (count($sinhVienDaGuiYeuCau) > 0) {
                foreach ($sinhVienDaGuiYeuCau as $key => $value) {
                    $sinhVien = SinhVien::where('id', $value)->first();
                    $tenSinhVienArray[] = $sinhVien->ten_sinh_vien;
                }
                $chuoiSinhVien = implode('<br>', $tenSinhVienArray);

                return response()->json([
                    'status' => 2,
                    'message' => 'Bạn Đã Gửi Sinh Viên: ' . '<b>' . $chuoiSinhVien . '</b>',
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'message' => 'Gửi Sinh Viên Thành Công',
                ]);
            }
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Vui Lòng Chọn Sinh Viên!',
            ]);
        }
    }

    public function confirmPhongVan(Request $request, $id, $id_tieu_chi, $tinh_trang)
    {
        $mail_lien_he = MailLienHe::where('id_sinh_vien', $id)
            ->where('id_tieu_chi', $id_tieu_chi)
            ->first();
        if (!$mail_lien_he) {
            toastr()->error('Email phỏng vấn đã hết hạn hoặc đã bị xoá');
            return redirect('/sinh-vien/login');
        }
        $mail_lien_he->tinh_trang = $tinh_trang * 1;
        if ($tinh_trang * 1 === -1) {
            $mail_lien_he->is_accept = -2;
        }
        if ($tinh_trang * 1 === 1) {
            $mail_lien_he->is_accept = 0;
        }
        $mail_lien_he->save();
        if ($tinh_trang * 1 == 1) {
            toastr()->success('Đã xác nhận phỏng vấn');
        } else {
            toastr()->success('Đã từ chối xác nhận phỏng vấn');
        }
        return redirect('/sinh-vien/login');
    }
}
