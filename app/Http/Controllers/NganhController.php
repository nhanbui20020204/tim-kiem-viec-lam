<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\createNganhRequest;
use App\Http\Requests\User\updateNganhRequest;
use App\Models\Nganh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class NganhController extends Controller
{
    public function index()
    {
        $check = $this->checkRule_get(35);
        if (!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin');
        }
        return view('admin.page.Nganh.index');
    }

    public function data()
    {
        $khoa = Auth::guard('khoa')->user();
        if($khoa){
            $data = Nganh::where('nganhs.id_khoa',$khoa->id)
                        ->join('khoas','nganhs.id_khoa','khoas.id')
                        ->select('nganhs.*','khoas.ten_khoa')
                        ->get();
        }
        else{

            $data = Nganh::join('khoas','nganhs.id_khoa','khoas.id')
                            ->select('nganhs.*','khoas.ten_khoa')
                            ->get();
        }
        return response()->json([
            'status'    => true,
            'data'      => $data,
        ]);
    }

    public function create(createNganhRequest $request)
    {
        $check = $this->checkRule_post(36);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $data               = $request->all();
        $data['password']     = bcrypt($request->password);
        Nganh::create($data);

        return response()->json([
            'status'    => true
        ]);
    }

    public function status(Request $request)
    {
        $check = $this->checkRule_post(38);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $nganh = Nganh::find($request->id);
        if ($nganh) {
            $nganh->is_open = $nganh->is_open == 0 ? 1 : 0;
            $nganh->save();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã thay đổi trạng thái'
            ]);
        }
    }

    public function update(updateNganhRequest $request)
    {
        $check = $this->checkRule_post(39);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $nganh   = Nganh::find($request->id);
        if ($nganh) {
            $data   = $request->all();
            $nganh->update($data);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật Ngành thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không tồn tại!'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $check = $this->checkRule_post(37);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $nganh = Nganh::find($request->id);
        if ($nganh) {
            $nganh->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xoá thành công'
            ]);
        }
    }

    public function search(Request $request)
    {
        $value = '%' . $request->value . '%';
        $data  = Nganh::where('ten_nganh', 'like', $value)
            ->orWhere('slug_nganh', 'like', $value)
            ->get();
        return response()->json([
            'data'  => $data
        ]);
    }
}
