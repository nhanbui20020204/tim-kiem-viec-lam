<?php

namespace App\Http\Controllers;

use App\Models\SkillSinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillSinhVienController extends Controller
{
    public function create(Request $request)
    {
        $sinhVien = Auth::guard('sinhvien')->user();
        foreach ($request->list_skill as $k => $v) {
            SkillSinhVien::create([
                'id_sinh_vien' => $sinhVien->id,
                'id_skill'  => $v,
            ]);
        }
        return response()->json([
            'status'    => true,
            'message'   => 'Thêm skill cho sinh viên thành công'
        ]);
    }
    public function data()
    {
        $sinhVien = Auth::guard('sinhvien')->user();
        $data = SkillSinhVien::where('id_sinh_vien', $sinhVien->id)->get();
        return response()->json([
            'status'    => true,
            'data'   => $data
        ]);
    }
    public function update(Request $request)
    {
        $list_skill = $request->list_skill;
        $sinhVien = Auth::guard('sinhvien')->user();
        $existingSkills = SkillSinhVien::where('id_sinh_vien', $sinhVien->id)->pluck('id_skill')->toArray();

        // Tìm ra các ID kỹ năng mới (tức là các ID kỹ năng từ front-end mà chưa có trong cơ sở dữ liệu)
        $newSkills = array_diff($list_skill, $existingSkills);

        // Tìm ra các ID kỹ năng cần xoá (tức là các ID kỹ năng trong cơ sở dữ liệu mà không có trong mảng từ front-end)
        $skillsToDelete = array_diff($existingSkills, $list_skill);

        // Thêm các kỹ năng mới vào cơ sở dữ liệu
        foreach ($newSkills as $newSkillId) {
            SkillSinhVien::create([
                'id_skill' => $newSkillId,
                'id_sinh_vien' => $sinhVien->id
            ]); // Hoặc bất kỳ quá trình tạo mới nào phù hợp với ứng dụng của bạn
        }
        SkillSinhVien::whereIn('id_skill', $skillsToDelete)->delete();
        return response()->json([
            'status'    => 1,
            'message'   => 'Đã cập nhật skill thành công!'
        ]);
    }
}
