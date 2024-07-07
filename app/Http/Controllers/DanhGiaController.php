<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateDanhgiaRequest;
use App\Models\CongTy;
use App\Models\DanhGia;
use App\Models\MailLienHe;
use App\Models\Nganh;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhGiaController extends Controller
{


    public function index_sinh_vien_danh_gia()
    {
        // $sinhVien = Auth::guard('sinhvien')->user();
        // $id_congty_tc = SinhVienDatYeuCau::where('id_sinh_vien', $sinhVien->id)
        //     ->join('id_tieu_chi', 'sinh_vien_dat_yeu_caus.id_tieu_chi', 'bai_dang_tieu_chis.id')
        //     ->select('sinh_vien_dat_yeu_caus.id_tieu_chi')
        //     ->get();
        // $congty = BaiDangTieuChi::where('id', $id_congty_tc)
        //     ->select('id_cong_ty')
        //     ->get();
        return view('sinhvien.Danh_gia.index');
    }

    public function index_khoa()
    {
        return view('Khoa.Danh_Gia.index');
    }



    public function create(CreateDanhgiaRequest $request)
    {

        $data = $request->all();
        $sinhVien = Auth::guard('sinhvien')->user();
        $khoa = Auth::guard('khoa')->user();

        if ($sinhVien) {
            $data['id_sinh_vien'] = $sinhVien->id;
            $data['is_duyet'] = 0;

            DanhGia::create($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Tạo đánh giá thành công!',
            ]);
        } else if ($khoa) {
            DanhGia::create($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Tạo đánh giá thành công!',
            ]);
        } else {

            $check = $this->checkRule_post(13);
            if (!$check) {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Bạn không có quyền truy cập chức năng này!',
                ]);
            }

            DanhGia::create($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Tạo đánh giá thành công!',
            ]);
        }
    }

    public function data()
    {
        $sinhVien = Auth::guard('sinhvien')->user();
        $khoa = Auth::guard('khoa')->user();
        if ($sinhVien) {
            $data = [];
            $sinhVienDanhGia = DanhGia::where('id_sinh_vien', $sinhVien->id)->get();
            foreach ($sinhVienDanhGia as $sv) {
                $dataCT = CongTy::where('id', $sv->id_cong_ty)->first();

                $data[] = [
                    'id'            => $sv->id,
                    'id_cong_ty'    => $dataCT->id,
                    'id_sinh_vien'  => $sinhVien->id,
                    'ten_cong_ty'   => $dataCT->ten_cong_ty,
                    'mo_ta'         => $sv->mo_ta,
                    'so_sao'        => $sv->so_sao,
                    'is_duyet'      => $sv->is_duyet
                ];
            }
            return response()->json([
                'data'  => $data,
            ]);
        } else if ($khoa) {
            $listSinhVien = SinhVien::where('id_khoa', $khoa->id)
                ->pluck('sinh_viens.id')
                ->toArray();
            $listDanhGia = DanhGia::pluck('danh_gias.id_sinh_vien')->toArray();
            $existedSinhVien = array_values(array_intersect($listSinhVien, $listDanhGia));
            $data = [];
            foreach ($existedSinhVien as $sv) {
                $sinhVien = SinhVien::where('id', $sv)->first();
                $dataNganh = Nganh::where('id', $sinhVien->id_nganh)->first();
                $dataCongTy = DanhGia::where('id_sinh_vien', $sv)
                    ->join('cong_ties', 'cong_ties.id', 'danh_gias.id_cong_ty')
                    ->select('cong_ties.ten_cong_ty', 'cong_ties.id as congtyId', 'danh_gias.*')
                    ->first();
                $data[] = [
                    'id'                => $dataCongTy->id,
                    'id_sinh_vien'      => $sinhVien->id,
                    'ten_sinh_vien'     => $sinhVien->ten_sinh_vien,
                    'id_cong_ty'        => $dataCongTy->congtyId,
                    'ten_cong_ty'       => $dataCongTy->ten_cong_ty,
                    'ten_nganh'         => $dataNganh->ten_nganh,
                    'mo_ta'             => $dataCongTy->mo_ta,
                    'is_duyet'          => $dataCongTy->is_duyet,
                    'so_sao'            => $dataCongTy->so_sao
                ];
            }
            return response()->json([
                'data'     => $data,
            ]);
        }
    }
    // dd($data->toArray());

    public function statusDuyet(Request $request)
    {
        // $check = $this->checkRule_post(17);
        // if (!$check) {
        //     return response()->json([
        //         'status'  => 0,
        //         'message' => 'Bạn không có quyền truy cập chức năng này!',
        //     ]);
        // }
        $danhgia = DanhGia::where('id', $request->id)->first();
        if ($danhgia) {
            if ($danhgia->is_duyet == 1) {
                $danhgia->is_duyet = 0;
            } else {
                $danhgia->is_duyet = 1;
            }
            $danhgia->save();
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

    public function status(Request $request)
    {

        $khoa = Auth::guard('khoa')->user();
        if ($khoa) {

            $bangdiem = DanhGia::where('id', $request->id)->first();
            if ($bangdiem) {
                if ($bangdiem->is_duyet == 1) {
                    $bangdiem->is_duyet = 0;
                } else {
                    $bangdiem->is_duyet = 1;
                }
                $bangdiem->save();
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
        } else {
            $check = $this->checkRule_post(15);
            if (!$check) {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Bạn không có quyền truy cập chức năng này!',
                ]);
            }
            $bangdiem = DanhGia::where('id', $request->id)->first();
            if ($bangdiem) {
                if ($bangdiem->is_duyet == 1) {
                    $bangdiem->is_duyet = 0;
                } else {
                    $bangdiem->is_duyet = 1;
                }
                $bangdiem->save();
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
    }

    public function update(Request $request)
    {

        $data = $request->all();
        $sinhVien = Auth::guard('sinhvien')->user();
        $khoa = Auth::guard('khoa')->user();
        $danhgia = DanhGia::where('id', $request->id)->first();

        if ($sinhVien) {
            if ($danhgia) {
                if ($danhgia->is_duyet == 1) {
                    return response()->json([
                        'status'    => 2,
                        'message'   => 'Bảng Đánh giá Đã Duyệt Bạn Không Thể Cập Nhật!' . '<br>' . 'Vui Lòng Liên Hệ Khoa Của Bạn Để Sửa Đánh giá!',
                    ]);
                } else {
                    $danhgia->update($data);
                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Đã cập nhật thành công!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Đánh giá Không Tồn Tại'
                ]);
            }
        } elseif ($khoa) {
            if ($danhgia) {
                $danhgia->update($data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật thành công'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Đánh giá Không Tồn Tại'
                ]);
            }
        } else {
            $check = $this->checkRule_post(16);
            if (!$check) {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Bạn không có quyền truy cập chức năng này!',
                ]);
            }
            if ($danhgia) {
                $danhgia->update($data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật thành công'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Đánh giá Không Tồn Tại'
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {

        $sinhVien = Auth::guard('sinhvien')->user();
        $khoa = Auth::guard('khoa')->user();
        $danhgia = DanhGia::where('id', $request->id)->first();
        if ($sinhVien) {
            if ($danhgia) {
                if ($danhgia->is_duyet == 1) {
                    return response()->json([
                        'status'    => 2,
                        'message'   => 'Đánh giá Đã Duyệt Bạn Không Xóa!' . '<br>' . 'Vui Lòng Liên Hệ Khoa!',
                    ]);
                } else {
                    $danhgia->delete();
                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Đã xóa thành công!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Đánh giá Không Tồn Tại'
                ]);
            }
        } elseif ($khoa) {
            if ($danhgia) {
                $danhgia->delete();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa thành công'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Đánh giá Không Tồn Tại'
                ]);
            }
        } else {
            $check = $this->checkRule_post(14);
            if (!$check) {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Bạn không có quyền truy cập chức năng này!',
                ]);
            }
            if ($danhgia) {
                $danhgia->delete();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa thành công'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Đánh giá Không Tồn Tại'
                ]);
            }
        }
    }
    public function dataDanhgiaCongty()
    {
        $sinhVien = Auth::guard('sinhvien')->user();
        $data = MailLienHe::where('id_sinh_vien', $sinhVien->id)
            ->where('tinh_trang', 1)
            ->where('is_accept', 1)
            ->get();
        $congTyData = [];
        foreach ($data as $congty) {
            // Truy vấn SQL để lấy danh sách tên kỹ năng của sinh viên
            $dataCT = CongTy::where('id', $congty->id_cong_ty)->first();

            $congTyData[] = $dataCT;
        }
        return response()->json([
            'data'  => $congTyData,
        ]);
    }
    public function dataDanhgiaSinhvien()
    {
        $data = SinhVien::all();
        return response()->json([
            'data'  => $data,
        ]);
    }
}
