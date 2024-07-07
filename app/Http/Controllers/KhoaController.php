<?php

namespace App\Http\Controllers;

use App\Http\Requests\dangKyKhoaRequest;
use App\Http\Requests\Khoa\Profile\updatePasswordProfileKhoaRequest;
use App\Http\Requests\User\createKhoaRequest;
use App\Http\Requests\User\updateKhoaRequest;
use App\Mail\ActiveMailKhoa;
use App\Models\CongTy;
use App\Models\Khoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class KhoaController extends Controller
{
    public function actionRegister(dangKyKhoaRequest $request)
    {
        $data                   = $request->all();
        $data['ten_khoa']            = $request['ten_khoa'];
        $data['hash_active']    = Str::uuid();
        $data['password']       = bcrypt($request->password);
        Khoa::create($data);
        $dataA['link']          =    'http://127.0.0.1:8000' . '/activeee/' . $data['hash_active'];
        $dataA['ten_khoa']      =   $request->ten_khoa;
        Mail::to($request->email)->send(new ActiveMailKhoa($dataA));
        return response()->json([
            'status'    => 1,
            'message'   => 'Bạn vui lòng kiểm tra email để kích hoạt tài khoản!',
        ]);
    }
    public function viewRegister()
    {
        return view('Khoa.register');
    }

    public function actionLogin(Request $request)
    {
        $check_1 = Auth::guard('khoa')->attempt(['email'  => $request->email, 'password' => $request->password]);
        if ($check_1) {
            $khoa   =   Auth::guard('khoa')->user();
            if ($khoa->is_active == -1) {
                Auth::guard('khoa')->logout();

                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản đã bị khoá. Vui lòng thử lại sau!',
                ]);
            } else if ($khoa->is_active == 0) {
                Auth::guard('khoa')->logout();

                return response()->json([
                    'status'    => 0,
                    'message'   => 'Tài khoản chưa được active. Vui lòng thử lại sau!',
                ]);
            } else
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
    public function dataNganhKhoa()
    {
        $congty = CongTy::get();
        return response()->json([
            'congty'   => $congty,
        ]);
    }
    public function viewLogin()
    {
        return view('Khoa.login');
    }

    public function index()
    {
        $check = $this->checkRule_get(6);
        if (!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin');
        }
        return view('admin.page.Khoa.index');
    }

    public function data()
    {
        $data   = Khoa::get();

        return response()->json([
            'data'     => $data,
        ]);
    }

    public function store(createKhoaRequest $request)
    {
        $check = $this->checkRule_post(7);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $data               = $request->all();
        $data['password']     = bcrypt($request->password);
        Khoa::create($data);

        return response()->json([
            'status'    => true
        ]);
    }

    public function status(Request $request)
    {
        $check = $this->checkRule_post(9);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $khoa  = Khoa::where('id', $request->id)->first();
        if ($khoa) {
            if ($khoa->is_active < 1) {
                $khoa->is_active = $khoa->is_active + 1;
            } else {
                $khoa->is_active = -1;
            }
            $khoa->save();
        }
    }

    public function update(updateKhoaRequest $request)
    {
        $check = $this->checkRule_post(10);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $khoa  = Khoa::where('id', $request->id)->first();
        $existEmail = Khoa::where('email', $request->email)->where('email', '<>', $khoa->email)->first();
        if ($existEmail) {
            return response()->json([
                'status'  => 0,
                'message' => 'Email này đã tồn tại. Vui lòng thử email!',
            ]);
        }
        if ($khoa) {
            $khoa->update([
                'ten_khoa'          =>  $request->ten_khoa,
                'so_dien_thoai'     =>  $request->so_dien_thoai,
                'dia_chi'           =>  $request->dia_chi,
                'email'             =>  $request->email,
                'password'          =>  $request->password,
                'link_website'      =>  $request->link_website,
                'is_active'         =>  $request->is_active,
            ]);

            return response()->json([
                'status'    => true,
                'message'   => 'Đã cập nhật Khoa',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khoa không tồn tại',
            ]);
        }
    }
    public function activeAccount($code)
    {
        $khoa   =   Khoa::where('hash_active', $code)->first();
        if ($khoa) {
            $khoa->is_active    = 1;
            $khoa->hash_active  = NULL;
            $khoa->save();
            toastr()->success('Đã kích hoạt tài khoản thành công!');
            return redirect('/khoa/login');
        } else {
            toastr()->error('Liên kết không tồn tại!');
            return redirect('/');
        }
    }

    public function destroy(Request $request)
    {
        $check = $this->checkRule_post(8);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $khoa = Khoa::where('id', $request->id)
            ->first();

        if ($khoa) {
            $khoa->delete();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa Khoa thành công',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khoa không tồn tại',
            ]);
        }
    }

    public function edit(Request $request)
    {
        $khoa = Khoa::where('id', $request->id)
            ->first();

        if ($khoa) {
            return response()->json([
                'status'    => true,
                'data'      => $khoa,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Dữ liệu không chính xác!',
            ]);
        }
    }
    public function checkMail(Request $request)
    {
        $khoa = Khoa::where('email', $request->email)
            ->get();
        if (count($khoa) > 0) {
            return response()->json([
                'status'    => false,
                'message'   => 'Email đã tồn tại',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Có thể sử dụng email này',
            ]);
        }
    }

    public function checkMailUpdate(Request $request)
    {
        $khoa = Khoa::where('email', $request->email)
            ->where('id', '<>', $request->id)
            ->get();
        if (count($khoa) > 0) {
            return response()->json([
                'status'    => false,
                'message'   => 'Email đã tồn tại',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Có thể sử dụng email này',
            ]);
        }
    }

    public function search(Request $request)
    {
        $check = $this->checkRule_post(11);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $gia_tri    = '%' . $request->gia_tri . '%';


        $data   = Khoa::where('khoas.ten_khoa', 'like', $gia_tri)
            ->orWhere('khoas.so_dien_thoai', 'like', $gia_tri)
            ->orWhere('khoas.dia_chi', 'like', $gia_tri)
            ->orWhere('khoas.email', 'like', $gia_tri)
            ->get();
        return response()->json([
            'data'     => $data,
        ]);
    }

    public function index_profile()
    {
        return view('Khoa.profile_khoa');
    }

    public function getProfile()
    {
        $khoa = Auth::guard('khoa')->user();

        return response()->json([
            'data'      => $khoa,    //res.data.data
        ]);
    }
    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $khoa = Khoa::where('id', $data['id'])->first();
        if ($khoa) {
            $khoa->update($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Cập Nhật Khoa Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Khoa Không Tồn Tại!',
            ]);
        }
    }
    public function updatePassword(updatePasswordProfileKhoaRequest $request)
    {
        $auth = Auth::guard('khoa')->user();
        $khoa = Khoa::where('id', $auth->id)->first();
        if ($khoa) {
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $khoa->update($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Cập Nhật Mật Khẩu Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có lỗi!',
            ]);
        }
    }
    public function index_khoa()
    {
        return view('admin.page.Khoa.index');
    }
    public function actionLogout()
    {
        Auth::guard('khoa')->logout();
        return redirect('/');
    }
}
