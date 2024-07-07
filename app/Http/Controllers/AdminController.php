<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Profile\updatePasswordSinhVienRequest;
use App\Http\Requests\Admin\Profile\updateProfileSinhVienRequest;
use App\Http\Requests\updateMatKhauAdminRequest;
use App\Http\Requests\User\createAdminRequest;
use App\Http\Requests\User\updateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function actionRegister(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        Admin::create($data);
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã thêm mới tài khoản!',
        ]);
    }

    public function viewRegister()
    {
        return view('admin.page_admin.register');
    }

    public function actionLogin(Request $request)
    {
        $check = Auth::guard('admin')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);
        if ($check) {
            return response()->json([
                'status'    => 1,
                'message'   => 'Đã đăng nhập thành công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Tài khoản hoặc mật khẩu không đúng!',
            ]);
        }
    }
    public function actionLogout()
    {
        Auth::guard('admin')->logout();
        return redirect("/admin/login");
    }

    public function viewLogin()
    {
        return view('admin.page.access.login');
    }
    public function index()
    {
        $check = $this->checkRule_get(1);
        if (!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin');
        }
        return view('admin.page.admin.index');
    }

    public function data()
    {
        $data = Admin::leftjoin('quyens', 'admins.id_quyen', 'quyens.id')
            ->select('admins.*', 'quyens.ten_quyen')
            ->get();
        return response()->json([
            'data'  => $data,
        ]);
    }

    public function create(createAdminRequest $request)
    {
        $check = $this->checkRule_post(2);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        Admin::create($data);

        return response()->json([
            'status'    => true
        ]);
    }

    public function status(Request $request)
    {
        $check = $this->checkRule_post(3);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $admin = Admin::where('id', $request->id)->first();
        $login_id = Auth::guard('admin')->user();
        if ($login_id->id == $request->id) {
            return response()->json(['status' => 0, 'message' => 'Bạn không thể hủy chính mình']);
        }
        if ($admin) {
            if ($admin->is_active == 1) {
                $admin->is_active = 0;
            } else {
                $admin->is_active = 1;
            }
            $admin->save();
            return response()->json([
                'status'    => true,
                'message'   => 'Đổi trạng thái thành công'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Thay đổi thất bại'
            ]);
        }
    }

    public function update(updateAdminRequest $request)
    {
        $check = $this->checkRule_post(5);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $admin  = Admin::where('id', $request->id)->first();
        $login_id = Auth::guard('admin')->user();
        if ($login_id->id == $request->id && $request->is_active == 0) {
            return response()->json(['status' => 0, 'message' => 'Bạn không thể hủy chính mình']);
        }
        if ($admin) {

            $admin->update($request->all());

            return response()->json([
                'status'    => true,
                'message'   => 'Đã cập nhật Admin',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Đã có lỗi',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $check = $this->checkRule_post(4);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $admin = Admin::where('id', $request->id)->first();
        $login_id = Auth::guard('admin')->user();
        if ($login_id->id == $request->id) {
            return response()->json(['status' => 0, 'message' => 'Bạn không thể hủy chính mình']);
        }
        if ($admin) {
            $admin->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xoá thành công'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không tồn tại Admin này'
            ]);
        }
    }

    public function search(Request $request)
    {
        $value = '%' . $request->value . '%';
        $data  = Admin::where('ho_va_ten', 'like', $value)
            ->orWhere('so_dien_thoai', 'like', $value)
            ->orWhere('email', 'like', $value)
            ->get();
        return response()->json([
            'data'  => $data
        ]);
    }
    public function doiMatKhau(updateMatKhauAdminRequest $request)
    {
        $check = $this->checkRule_post(17);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $admin = Admin::where('id', $request->id)->first();
        if ($admin) {
            $data['password'] = bcrypt($request->new_password);
            $admin->update($data);
            return response()->json([
                'status'    => true,
                'message'   => 'Cập Nhật Mật Khẩu Thành Công !'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không tồn tại Admin'
            ]);
        }
    }
    public function index_profile()
    {
        return view('admin.page.Profile.index');
    }
    public function getProfile()
    {
        $user = Auth::guard('admin')->user();
        return response()->json([
            'data'    => $user,

        ]);
    }
    public function updateProfile(updateProfileSinhVienRequest $request)
    {
        $user = Auth::guard('admin')->user();
        $admin = Admin::where('id', $user->id)->first();

        if ($admin) {
            $data = $request->all();
            $admin->update();
            return response()->json([
                'status'    => 1,
                'message'   => 'Cập Nhật Thông Tin Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Có Lỗi',
            ]);
        }
    }
    public function updatePassword(updatePasswordSinhVienRequest $request)
    {
        $user = Auth::guard('admin')->user();
        $admin = Admin::where('id', $user->id)->first();
        if ($admin) {
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $admin->update($data);
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
}
