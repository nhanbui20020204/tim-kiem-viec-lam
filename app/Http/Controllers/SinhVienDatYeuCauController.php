<?php

namespace App\Http\Controllers;

use App\Models\BangDiem;
use App\Models\SinhVienDatYeuCau;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SinhVienDatYeuCauController extends Controller
{
    public function index_sinh_vien()
    {
        return view('sinhvien.Tieu_chi.index');
    }
    public function data()
    {
        $sinhVien = Auth::guard('sinhvien')->user();
        $data = SinhVienDatYeuCau::where('id_sinh_vien', $sinhVien->id)
            ->join('bai_dang_tieu_chis', 'sinh_vien_dat_yeu_caus.id_tieu_chi', 'bai_dang_tieu_chis.id')
            ->select('bai_dang_tieu_chis.*')
            ->get();
        return response()->json([
            'status' => 1,
            'data'  => $data,
        ]);
    }
    public function getDataDatYeuCau(Request $request)
    {
        $data = $request->all();
        $sinhVienDatYeuCaus = SinhVienDatYeuCau::where('sinh_vien_dat_yeu_caus.id_tieu_chi', $data['id'])
            ->join('sinh_viens', 'sinh_vien_dat_yeu_caus.id_sinh_vien', 'sinh_viens.id')
            ->select('sinh_viens.*')
            ->get();
        $sinhVienData = [];

        // Lặp qua từng sinh viên để lấy danh sách kỹ năng của họ
        foreach ($sinhVienDatYeuCaus as $sinhVien) {
            // Truy vấn SQL để lấy danh sách tên kỹ năng của sinh viên
            $skills = Skill::join('skill_sinh_viens', 'skills.id', 'skill_sinh_viens.id_skill')
                ->where('skill_sinh_viens.id_sinh_vien', $sinhVien->id)
                ->pluck('skills.ten_skill')
                ->toArray();

            $bangDiems = BangDiem::where('id_sinh_vien', $sinhVien->id)
                ->where('is_duyet', 1)
                ->get();
            // Tạo một mảng mới chứa thông tin sinh viên và danh sách kỹ năng của họ
            $sinhVienData[] = [
                'id'            => $sinhVien->id,
                'email'         => $sinhVien->email,
                'so_dien_thoai' => $sinhVien->so_dien_thoai,
                'dia_chi'       => $sinhVien->dia_chi,
                'id_khoa'       => $sinhVien->id_khoa,
                'ten_sinh_vien' => $sinhVien->ten_sinh_vien,
                'list_skills'   => $skills,
                'list_diems'    => $bangDiems
            ];
        }
        return response()->json([
            'data'  => $sinhVienData
        ]);
    }
}
