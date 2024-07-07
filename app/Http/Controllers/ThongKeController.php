<?php

namespace App\Http\Controllers;

use App\Models\CongTy;
use App\Models\BaiDangTieuChi;
use App\Models\MailLienHe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function thongKeSinhVienPhongVan(Request $request)
    {
        $khoa = Auth::guard('khoa')->user();
        $beginDate = Carbon::parse($request->begin);
        $endDate = Carbon::parse($request->end);
        $data = MailLienHe::join('sinh_viens', 'sinh_viens.id', 'mail_lien_hes.id_sinh_vien')
            ->where('sinh_viens.id_khoa', $khoa->id)
            ->select(
                DB::raw("DATE_FORMAT(mail_lien_hes.created_at, '%Y-%m') as thang"),
                DB::raw("COUNT(DISTINCT mail_lien_hes.id) as tai_khoan")
            )
            ->whereDate('mail_lien_hes.created_at', '>=', $beginDate)
            ->whereDate('mail_lien_hes.created_at', '<=', $endDate)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();
        $accout = [];
        $tai_khoan = [];
        foreach ($data as $item) {
            $accout[] = Carbon::parse($item->thang)->format('Y-m');
            $tai_khoan[] = $item->tai_khoan;
        }
        return response()->json([
            'status' => 1,
            'data' => $tai_khoan,
            'labels' => $accout,
        ]);
    }

    public function thongKeTieuChi(Request $request)
    {
        $beginDate = Carbon::parse($request->begin);
        $endDate = Carbon::parse($request->end);

        $data = BaiDangTieuChi::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as thang"),
            DB::raw("COUNT(id) as so_luong")
        )
            ->whereDate('bai_dang_tieu_chis.created_at', '>=', $beginDate)
            ->whereDate('bai_dang_tieu_chis.created_at', '<=', $endDate)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $labels = [];
        $so_luong = [];
        foreach ($data as $item) {
            $labels[] = Carbon::parse($item->thang)->format('Y-m');
            $so_luong[] = $item->so_luong;
        }

        return response()->json([
            'status' => 1,
            'data' => $so_luong,
            'labels' => $labels,
        ]);
    }

    public function index()
    {
        return view('Khoa.Thong_Ke.index');
    }

    public function viewSinhVienPhongVan()
    {
        return view('Khoa.Thong_Ke.sinhVienPhongVan');
    }
}
