<?php

namespace App\Http\Controllers;

use App\Models\BangDiem;
use App\Models\SinhVienDatYeuCau;
use App\Models\SinhVienUngTuyen;
use App\Models\Skill;
use App\Models\SkillSinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SinhVienUngTuyenController extends Controller
{
    public function create(Request $request)
    {
        $sinh_vien = Auth::guard('sinhvien')->user();
        $id_tieu_chi = $request->id;
        $bangDiems = BangDiem::where('id_sinh_vien', $sinh_vien->id)->where('is_duyet', 1)->get();
        $skills = SkillSinhVien::where('id_sinh_vien', $sinh_vien->id)->get();
        if (count($bangDiems) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa nhập bảng điểm hoặc bảng điểm chưa được duyệt',
            ]);
        }
        if (count($skills) == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa nhập danh mục skills',
            ]);
        }
        $tieu_chi_ung_tuyen = SinhVienUngTuyen::where('id_tieu_chi', $id_tieu_chi)
            ->where('id_sinh_vien', $sinh_vien->id)
            ->first();
        $sinh_vien_dat_yc = SinhVienDatYeuCau::where('id_sinh_vien', $sinh_vien->id)->first();
        if ($tieu_chi_ung_tuyen) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn Đã ứng tuyển tiêu chí này trước đó',
            ]);
        }
        if ($sinh_vien_dat_yc) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn đã nằm trong danh sách sinh viên được gửi từ khoa',
            ]);
        }
        SinhVienUngTuyen::create([
            'id_sinh_vien'  => $sinh_vien->id,
            'id_tieu_chi'   => $id_tieu_chi,
            'tinh_trang'    => 1
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Bạn Đã ứng tuyển thành công',
            'bang_diem' => empty($bangDiems)
        ]);
    }

    public function status(Request $request)
    {
        $sinh_vien = Auth::guard('sinhvien')->user();
        $sinhVienUngTuyen = SinhVienUngTuyen::where('id_tieu_chi', $request->id)
            ->where('id_sinh_vien', $sinh_vien->id)
            ->first();
        if ($sinhVienUngTuyen->tinh_trang == 1) {
            $sinhVienUngTuyen->tinh_trang = 0;
        } else if ($sinhVienUngTuyen->tinh_trang == 0) {
            $sinhVienUngTuyen->tinh_trang = 1;
        }
        $sinhVienUngTuyen->save();
        return response()->json([
            'status' => true,
            'message' => 'Bạn Đã thay đổi trình trạng ứng tuyển thành công',
        ]);
    }

    public function data(Request $request)
    {
        $sinh_vien = Auth::guard('sinhvien')->user();
        $id_tieu_chi = $request->id;
        if ($id_tieu_chi) {
            $list_sv_ung_tuyen = SinhVienUngTuyen::where('id_tieu_chi', $id_tieu_chi)
                ->join('sinh_viens', 'sinh_viens.id', 'sinh_vien_ung_tuyens.id_sinh_vien')
                ->select('sinh_viens.*')
                ->get();
            $data = [];

            foreach ($list_sv_ung_tuyen as $sinhVien) {
                $skills = Skill::join('skill_sinh_viens', 'skills.id', 'skill_sinh_viens.id_skill')
                    ->where('skill_sinh_viens.id_sinh_vien', $sinhVien->id)
                    ->pluck('skills.ten_skill')
                    ->toArray();

                $bangDiems = BangDiem::where('id_sinh_vien', $sinhVien->id)
                    ->where('is_duyet', 1)
                    ->get();
                $data[] = [
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
                'status' => true,
                'data' => $data,
            ]);
        } else if ($sinh_vien) {
            $data = SinhVienUngTuyen::where('id_sinh_vien', $sinh_vien->id)->get();
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $sinh_vien = Auth::guard('sinhvien')->user();
        $sinhVienUngTuyen = SinhVienUngTuyen::where('id_tieu_chi', $request->id)
            ->where('id_sinh_vien', $sinh_vien->id)
            ->first();
        $sinhVienUngTuyen->delete();
        return response()->json([
            'status' => true,
            'message'   => 'Hủy ứng tuyển thành công'
        ]);
    }
}
