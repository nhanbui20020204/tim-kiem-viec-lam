<?php

namespace App\Http\Controllers;

use App\Mail\ActiveGuiMail;
use App\Models\MailLienHe;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class MailLienHeController extends Controller
{
    public function deleteGuiMail(Request $request)
    {
        $data = $request->all();
        $CongTy = Auth::guard('congty')->user();
        $CongTy = MailLienHe::where('id_sinh_vien', $request->id)->first();
        if ($CongTy) {
            $CongTy->delete($data);
            return response()->json([
                'status' => 1,
                'message' => "Đã xóa thành công",
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => "Có lỗi xảy ra vui lòng thử lại",
            ]);
        }
    }
    public function status(Request $request)
    {
        $mailLienHe = MailLienHe::where('id_sinh_vien', $request->id)->where('id_tieu_chi', $request->id_tieu_chi)->first();
        if ($mailLienHe->tinh_trang === -1) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Sinh viên đã từ chối phỏng vấn. Không thể đổi trạng thái nhân viên'
            ]);
        }
        if ($mailLienHe) {
            if ($mailLienHe->is_accept == 0) {
                $mailLienHe->is_accept = 1;
            } else if ($mailLienHe->is_accept == -1) {
                $mailLienHe->is_accept = 0;
            } else {
                $mailLienHe->is_accept = -1;
            }
        }
        $mailLienHe->save();
        return response()->json([
            'status' => true,
            'message' => "Đã thay đổi tình trạng",
        ]);
    }
    public function dataSinhVien()
    {
        $sinhVien = SinhVien::get();
        return response()->json([
            'sinhVien'   => $sinhVien,
        ]);
    }
    public function dataGuiMail()
    {
        $congTy = Auth::guard('congty')->user();
        $data = MailLienHe::where('mail_lien_hes.id_cong_ty', $congTy->id)
            ->join('sinh_viens', 'sinh_viens.id', 'mail_lien_hes.id_sinh_vien')
            ->join('bai_dang_tieu_chis', 'bai_dang_tieu_chis.id', 'mail_lien_hes.id_tieu_chi')
            ->select('sinh_viens.*', 'bai_dang_tieu_chis.tieu_de', 'bai_dang_tieu_chis.id as id_tieu_chi', 'tinh_trang', 'is_accept', 'noi_dung', 'thoi_gian')
            ->get();
        return response()->json([
            'data'  => $data,
        ]);
    }

    public function gui_lien_he(Request $request)
    {
        $list_sv = $request->list_sv;
        $congTy = Auth::guard('congty')->user();
        $id_tieu_chi = $request->id_tieu_chi;
        $listSVs = MailLienHe::where('id_tieu_chi', $id_tieu_chi)->pluck('id_sinh_vien')->toArray();

        $newSVs = array_diff($list_sv, $listSVs);
        $existSVs = array_intersect($list_sv, $listSVs);
        if ($existSVs) {
            return response()->json([
                'status'    => 0,
                'message'   => 'Tồn tại sinh viên đã được gửi mail',
            ]);
        }
        foreach ($newSVs as $sv) {
            MailLienHe::create([
                'id_sinh_vien'  => $sv,
                'id_cong_ty'    => $congTy->id,
                'id_tieu_chi'   => $id_tieu_chi,
                'noi_dung'      => $request->noi_dung,
                'thoi_gian'     => $request->thoi_gian,
                'tinh_trang'    => -1,
                'is_accept'     => 0,
            ]);
            $sinhVien = SinhVien::where('id', $sv)->first();
            $sinhVien->noi_dung = $request->noi_dung;
            $sinhVien->dia_chi = $request->dia_chi;
            $sinhVien->thoi_gian = $request->thoi_gian;
            $sinhVien->link_dong_y = "http://127.0.0.1:8000/confirm-phong-van/" . $sinhVien->id . "/" . $id_tieu_chi . "/1";
            $sinhVien->link_tu_choi = "http://127.0.0.1:8000/confirm-phong-van/" . $sinhVien->id . "/" . $id_tieu_chi . "/-1";
            $sinhVien->ten_cong_ty = $congTy->ten_cong_ty;
            $sinhVien->website = $congTy->website;
            Mail::to($sinhVien->email)->send(new ActiveGuiMail($sinhVien));
        }
        return response()->json([
            'status'    => 1,
            'message'   => 'Bạn đẫ gửi email phỏng vấn thành công!',
        ]);
    }
    public function lien_he()
    {
        return view('congty.Lien_he.index');
    }
}
