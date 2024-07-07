<?php

namespace App\Http\Controllers;

use App\Http\Requests\CongTy\Auth\dangKyCongTyRequest;
use App\Http\Requests\CongTy\Profile\updatePorfilePasswordRequest;
use App\Http\Requests\CongTy\Profile\updatePorfileTieuChiRequest;
use App\Http\Requests\updateCongTyRequest as RequestsUpdateCongTyRequest;
use App\Http\Requests\User\createCongTyRequest;
use App\Http\Requests\User\updateCongTyRequest;
use App\Mail\ActiveMailCty;
use App\Models\CongTy;
use App\Models\BaiDangTieuChi;
use App\Models\MailLienHe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


use function Symfony\Component\String\b;

class CongTyController extends Controller
{
    public function getLinkUpdateAVT($folder, $file)
    {
        $root_path = public_path();

        $file_extension = $file->getClientOriginalExtension();

        $file_name = Str::slug($file->getClientOriginalName()) . "." . $file_extension;

        $link = '/' . $folder . '/';

        $path = $root_path . '/' . $link;

        $file->move($path, $file_name);

        return $link . $file_name;
    }
    public function checkSlugUpdate(Request $request)
    {
        $CongTy = CongTy::where('slug_cong_ty', $request->slug_cong_ty)
            ->where('id', '<>', $request->id)
            ->get();
        if (count($CongTy) > 0) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên công ty không thể sử dụng',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Có thể sử dụng tên công ty này',
            ]);
        }
    }
    public function checkSlug(Request $request)
    {
        $CongTy = CongTy::where('slug_cong_ty', $request->slug_cong_ty)
            ->get();
        if (count($CongTy) > 0) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên công ty không thể sử dụng',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Có thể sử dụng tên chuyên mục này',
            ]);
        }
    }
    public function searchAdmin(Request $request)
    {
        $check = $this->checkRule_post(23);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $gia_tri    = '%' . $request->gia_tri . '%';

        $data = CongTy::where('ten_cong_ty', 'like', $gia_tri)
            ->orWhere('dia_chi', 'like', $gia_tri)
            ->orWhere('so_dien_thoai', 'like', $gia_tri)
            ->orWhere('email', 'like', $gia_tri)
            ->orWhere('fax', 'like', $gia_tri)
            ->get();
        return response()->json([
            'data'     => $data,
        ]);
    }
    public function updateAdmin(RequestsUpdateCongTyRequest $request)
    {
        $check = $this->checkRule_post(22);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $CongTy   = CongTy::find($request->id);
        if ($CongTy) {
            $data   = $request->all();
            $existEmail = CongTy::where('email', $request->email)->where('email', '<>', $CongTy->email)->first();
            if ($existEmail) {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Email đã tồn tại. Vui lòng thử lại sau!'
                ]);
            }
            $file = $request->file('hinh_anh');
            if ($file) {
                if (isset($data['hinh_anh'])) {
                    $avatar = $this->getLinkUpdateAVT('image-avatar-cong-ty', $file);
                    $data['hinh_anh'] = $avatar;
                }
            }
            $CongTy->update($data);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật thành công!',
                'file'      => $request
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không tồn tại!'
            ]);
        }
    }
    public function statusAdmin(Request $request)
    {
        $check = $this->checkRule_post(21);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $CongTy = CongTy::where('id', $request->id)->first();
        if ($CongTy) {
            if ($CongTy->is_active < 1) {
                $CongTy->is_active = $CongTy->is_active + 1;
            } else {
                $CongTy->is_active = -1;
            }
            $CongTy->save();
            return response()->json([
                'status'    => true,
                'message'   => 'Đổi trạng thái thành công'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Thay đổi thất bại'
            ]);
        }
    }
    public function destroyAdmin(Request $request)
    {
        $check = $this->checkRule_post(20);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $CongTy = CongTy::where('id', $request->id)->first();
        if ($CongTy) {
            $CongTy->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xoá thành công'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Không tồn tại Công Ty này'
            ]);
        }
    }
    public function dataAdmin()
    {
        $data = CongTy::all();
        return response()->json([
            'data'  => $data,
        ]);
    }
    public function createAdmin(createCongTyRequest $request)
    {
        $check = $this->checkRule_post(19);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        if (isset($data['hinh_anh'])) {
            $file = $request->file('hinh_anh');
            $avatar = $this->getLinkUpdateAVT('image-avatar-cong-ty', $file);
            $data['hinh_anh'] = $avatar;
        }
        CongTy::create($data);

        return response()->json([
            'status'    => true
        ]);
    }
    public function indexAdmin()
    {
        $check = $this->checkRule_get(18);
        if (!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin');
        }
        return view('admin.page.CongTy.index');
    }
    public function actionRegister(dangKyCongTyRequest $request)
    {
        $data                   = $request->all();
        if (isset($data['hinh_anh'])) {
            $file = $request->file('hinh_anh');
            $avatar = $this->getLinkUpdateAVT('image-bang-diem', $file);
            $data['hinh_anh'] = $avatar;
        }
        $data['hash_active']    = Str::uuid();
        $data['password']       = bcrypt($request->password);

        CongTy::create($data);

        $dataA['link']          =   'http://127.0.0.1:8000' . '/activee/' . $data['hash_active'];
        $dataA['ten_cong_ty']   =   $request->ten_cong_ty;

        Mail::to($request->email)->send(new ActiveMailCty($dataA));

        return response()->json([
            'status'    => 1,
            'message'   => 'Bạn vui lòng kiểm tra email để kích hoạt tài khoản!',
        ]);
    }
    public function viewRegister()
    {
        return view('congty.register');
    }
    public function actionLogin(Request $request)
    {
        $check_1 = Auth::guard('congty')->attempt(['email'  => $request->email, 'password' => $request->password]);
        if ($check_1) {
            $CongTy   =   Auth::guard('congty')->user();
            if ($CongTy->is_active == 0) {
                Auth::guard('congty')->logout();

                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản chưa được kích hoạt. Vui lòng thử lại sau!',
                ]);
            } else if ($CongTy->is_active == -1) {
                Auth::guard('congty')->logout();

                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản đã bị khoá. Vui lòng thử lại sau!',
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
    public function activeAccount($code)
    {
        $CongTy   =   CongTy::where('hash_active', $code)->first();

        if ($CongTy) {
            $CongTy->is_active    = 1;
            $CongTy->hash_active  = NULL;
            $CongTy->save();
            toastr()->success('Đã kích hoạt tài khoản thành công!');
            return redirect('/cong-ty/login');
        } else {
            toastr()->error('Liên kết không tồn tại!');
            return redirect('/');
        }
    }
    public function viewLogin()
    {
        return view('congty.login');
    }
    public function index()
    {
        return view('admin.page.CongTy.index');
    }
    public function data()
    {
        $data   = CongTy::all();

        return response()->json([
            'status'    => 1,
            'data'      => $data,
        ]);
    }
    public function create(createCongTyRequest $request)
    {
        $data   = $request->all();
        $data['password'] = bcrypt($data['password']);
        CongTy::create($data);
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã thêm mới công ty thành công!',
        ]);
    }
    public function delete(Request $request)
    {
        $CongTy   = CongTy::find($request->id);

        if ($CongTy) {
            $CongTy->delete();
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã xóa công ty thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Công Ty không tồn tại!'
            ]);
        }
    }
    public function update(updateCongTyRequest $request)
    {
        $CongTy   = CongTy::find($request->id);
        if ($CongTy) {
            $data   = $request->all();
            $CongTy->update($data);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không tồn tại!'
            ]);
        }
    }
    public function status(Request $request)
    {
        $CongTy   = CongTy::find($request->id);
        if ($CongTy) {
            if ($CongTy->is_active == 1) {
                $CongTy->is_active = 0;
            } else {
                $CongTy->is_active = 1;
            }
            $CongTy->save();

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật trạng thái!'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không tồn tại!'
            ]);
        }
    }
    public function search(Request $request)
    {
        $gia_tri    = '%' . $request->value . '%';

        $data       = CongTy::where('ten_cong_ty', 'like', $gia_tri)
            ->get();
        return response()->json([
            'data'     => $data,
        ]);
    }
    public function searchGuiMail(Request $request)
    {
        $gia_tri    = '%' . $request->gia_tri . '%';

        $data       = MailLienHe::where('ho_va_ten', 'like', $gia_tri)
            ->orWhere('email', 'like', $gia_tri)
            ->orWhere('so_dien_thoai', 'like', $gia_tri)
            ->orWhere('dia_chi', 'like', $gia_tri)
            ->get();
        return response()->json([
            'data'     => $data,
        ]);
    }
    public function statusDuyet(Request $request)
    {
        $bai_dang_tieu_chis = BaiDangTieuChi::where('id', $request->id)->first();
        if ($bai_dang_tieu_chis) {
            if ($bai_dang_tieu_chis->is_duyet == 1) {
                $bai_dang_tieu_chis->is_duyet = 0;
            } else {
                $bai_dang_tieu_chis->is_duyet = 1;
            }
            $bai_dang_tieu_chis->save();
            return response()->json([
                'status'    => true,
                'message'   => 'Đổi trạng thái duyệt thành công'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Thay đổi thất bại'
            ]);
        }
    }
    public function destroy(Request $request)
    {
        $bai_dang_tieu_chis = BaiDangTieuChi::where('id', $request->id)->first();
        if ($bai_dang_tieu_chis) {
            $bai_dang_tieu_chis->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xoá thành công'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Không tồn tại công ty này'
            ]);
        }
    }
    public function index_CongTy()
    {
        return view('congty.Tieu_chi.index');
    }
    public function index_profile()
    {
        return view('congty.profile');
    }
    public function getProfile()
    {
        $CongTy = Auth::guard('congty')->user();

        return response()->json([
            'data'      => $CongTy,
        ]);
    }
    public function updateProfile(updatePorfileTieuChiRequest $request)
    {
        $CongTy = CongTy::where('id', $request->id)->first();
        // dd($data);
        if ($CongTy) {
            $data   = $request->all();
            $CongTy->update($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Cập Nhật Thông Tin Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Công Ty Không Tồn Tại',
            ]);
        }
    }
    public function updatePassword(updatePorfilePasswordRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $auth = Auth::guard('congty')->user();
        $CongTy = CongTy::where('id', $auth->id)->first();
        if ($CongTy) {
            $CongTy->update($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Đổi Mật Khẩu Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có Lỗi!',
            ]);
        }
    }
    public function actionLogout()
    {
        Auth::guard('congty')->logout();
        return redirect('/');
    }
}
