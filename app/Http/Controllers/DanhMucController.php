<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\createSkillRequest;
use App\Http\Requests\User\updateSkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return view('admin.page.Skill.Skill');
    }

    public function data()
    {
        $data = Skill::all();

        return response()->json([
            'data'     => $data,
        ]);
        // bai_dang_tieu_chis đâu có cái ni đau
        // $bai_dang_tieu_chis = Auth::guard('congty')->user();
        // if($bai_dang_tieu_chis){
        //     $data = Skill::where('skills.id',$bai_dang_tieu_chis->id)
        //                 ->join('bai_dang_tieu_chis','skills.id','bai_dang_tieu_chis.id_skill')
        //                 ->select('skills.*','bai_dang_tieu_chis.id_skill')
        //                 ->get();
        // }
        // else{

        //     $data = Skill::join('bai_dang_tieu_chis','skills.id','bai_dang_tieu_chis.id_skill')
        //                     ->select('skills.*','bai_dang_tieu_chis.id_skill')
        //                     ->get();
        // }
        // return response()->json([
        //     'status'    => true,
        //     'data'      => $data,
        // ]);
    }

    public function store(createSkillRequest $request)
    {
        $data               = $request->all();
        $data['password']     = bcrypt($request->password);
        Skill::create($data);

        return response()->json([
            'status'    => true
        ]);
    }

    public function destroy(Request $request)
    {
        $Skill = Skill::where('id', $request->id)
            ->first();
        if ($Skill) {
            $Skill->delete();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa danh mục thành công',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Danh mục không tồn tại',
            ]);
        }
    }

    public function edit(updateSkillRequest $request)
    {
        $Skill   = Skill::find($request->id);
        if ($Skill) {
            $data   = $request->all();
            $Skill->update($data);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật Danh Mục thành công!'
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
        $Skill  = Skill::where('id', $request->id)->first();
        if ($Skill) {
            if ($Skill->tinh_trang == 1) {
                $Skill->tinh_trang = 0;
            } else if ($Skill->tinh_trang == 0) {
                $Skill->tinh_trang = 1;
            }
            $Skill->save();
        }
    }

    public function search(Request $request)
    {
        $gia_tri    = '%' . $request->gia_tri . '%';

        $data       = Skill::where('ten_skill', 'like', $gia_tri)
            ->orWhere('slug_skill', 'like', $gia_tri)
            ->get();
        return response()->json([
            'data'     => $data,
        ]);
    }
}
