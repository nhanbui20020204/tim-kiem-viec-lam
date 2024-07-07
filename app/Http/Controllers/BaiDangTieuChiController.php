<?php

namespace App\Http\Controllers;

use App\Exports\sinhVienExport;
use App\Http\Requests\CongTy\TieuChi\createTieuChiRequest;
use App\Http\Requests\User\createCongTyTCRequest;
use App\Http\Requests\User\updateCongTyTCRequest;
use App\Models\BaiDangTieuChi;
use App\Models\BangDiem;
use App\Models\Khoa;
use App\Models\Nganh;
use App\Models\SinhVienDatYeuCau;
use App\Models\SinhVienUngTuyen;
use App\Models\Skill;
use App\Models\SkillSinhVien;
use App\Models\SkillTieuChi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BaiDangTieuChiController extends Controller
{
    public function dataAdmin()
    {
        $data = BaiDangTieuChi::join('nganhs', 'bai_dang_tieu_chis.id_nganh', 'nganhs.id')
            ->join('skills', 'bai_dang_tieu_chis.id_skill', 'skills.id')
            ->select('bai_dang_tieu_chis.*', 'nganhs.ten_nganh', 'skills.ten_skill')
            ->get();
        // dd($data->toArray());
        return response()->json([
            'data'  => $data,
        ]);
    }

    public function createAdmin(createCongTyTCRequest $request)
    {
        $check = $this->checkRule_post(24);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $data               = $request->all();
        $data['id_cong_ty']   = 1;
        $data['password']     = bcrypt($request->password);
        BaiDangTieuChi::create($data);

        return response()->json([
            'status'    => true
        ]);
    }

    public function statusAdmin(Request $request)
    {
        $check = $this->checkRule_post(26);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $bai_dang_tieu_chis = BaiDangTieuChi::where('id', $request->id)->first();
        if ($bai_dang_tieu_chis) {
            if ($bai_dang_tieu_chis->is_open == 1) {
                $bai_dang_tieu_chis->is_open = 0;
            } else {
                $bai_dang_tieu_chis->is_open = 1;
            }
            $bai_dang_tieu_chis->save();
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
    public function statusDuyetAdmin(Request $request)
    {
        $check = $this->checkRule_post(28);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $bai_dang_tieu_chis = BaiDangTieuChi::where('id', $request->id)->first();
        if ($bai_dang_tieu_chis) {
            if ($bai_dang_tieu_chis->is_duyet == 1) {
                $bai_dang_tieu_chis->is_duyet = 0;
            } else {
                $bai_dang_tieu_chis->is_duyet = 1;
            }
            $bai_dang_tieu_chis->save();
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

    public function updateAdmin(updateCongTyTCRequest $request)
    {
        $check = $this->checkRule_post(27);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $congTyTC   = BaiDangTieuChi::find($request->id);
        if ($congTyTC) {
            $data   = $request->all();
            $congTyTC->update($data);

            return response()->json([
                'status'    => 1,
                'message'   => 'Đã cập nhật Tiêu chí thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => 0,
                'message'   => 'Không tồn tại!'
            ]);
        }
    }

    public function destroyAdmin(Request $request)
    {
        $check = $this->checkRule_post(25);
        if (!$check) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn không có quyền truy cập chức năng này!',
            ]);
        }
        $bai_dang_tieu_chis = BaiDangTieuChi::where('id', $request->id)->first();
        if ($bai_dang_tieu_chis) {
            $bai_dang_tieu_chis->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xoá thành công'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Không tồn tại bai_dang_tieu_chis này'
            ]);
        }
    }

    public function searchAdmin(Request $request)
    {
        $value = '%' . $request->value . '%';
        $data  = BaiDangTieuChi::where('tieu_de', 'like', $value)
            ->orWhere('dia_chi_cong_viec', 'like', $value)
            ->join('nganhs', 'bai_dang_tieu_chis.id_nganh', 'nganhs.id')
            ->join('skills', 'bai_dang_tieu_chis.id_skill', 'skills.id')
            ->select('bai_dang_tieu_chis.*', 'nganhs.ten_nganh', 'skills.ten_skill')
            ->get();
        return response()->json([
            'data'  => $data
        ]);
    }
    public function index_admin()
    {
        $check = $this->checkRule_get(23);
        if (!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin');
        }
        return view('admin.page.Tieu_chi.index');
    }

    public function index()
    {
        return view('congty.Tieu_chi.index');
    }
    public function index_khoa()
    {
        return view('Khoa.Tieu_chi.index');
    }

    public function data()
    {
        $congTy = Auth::guard('congty')->user();
        if ($congTy) {
            $data = BaiDangTieuChi::where('id_cong_ty', $congTy->id)
                // ->join('skills', 'bai_dang_tieu_chis.id_skill', 'skills.id')
                // ->select('bai_dang_tieu_chis.*', 'skills.ten_skill')
                ->get();
        }
        return response()->json([
            'status'    => true,
            'data'      => $data,
        ]);
    }

    public function dataTieuChiKhoa()
    {
        $khoa = Auth::guard('khoa')->user();
        $data = BaiDangTieuChi::join('nganhs', 'bai_dang_tieu_chis.id_nganh', '=', 'nganhs.id')
            ->join('khoas', 'nganhs.id_khoa', '=', 'khoas.id')
            ->where('khoas.id', $khoa->id)
            ->select('bai_dang_tieu_chis.*', 'khoas.ten_khoa', 'nganhs.ten_nganh')
            ->get();
        return response()->json([
            'status'    => true,
            'data'      => $data,
        ]);
    }

    public function dataTieuChiSinhVien()
    {
        $sinhVien = Auth::guard('sinhvien')->user();
        $listTC = BaiDangTieuChi::where('id_nganh', $sinhVien->id_nganh)
            ->where('is_duyet', 1)
            ->join('cong_ties', 'cong_ties.id', 'bai_dang_tieu_chis.id_cong_ty')
            ->select('bai_dang_tieu_chis.*', 'cong_ties.ten_cong_ty')
            ->get();
        $data = [];
        foreach ($listTC as $TC) {
            $list_skill = SkillTieuChi::where('id_tieu_chi', $TC->id)
                ->join('skills', 'skills.id', 'skill_tieu_chis.id_skill')
                ->select('skills.id', 'skills.ten_skill')
                ->get();
            $data[] = [
                'id'            => $TC->id,
                'tieu_chi'      => $TC,
                'list_skill'    => $list_skill
            ];
        }
        return response()->json([
            'status'    => true,
            'data'      => $data,
        ]);
    }

    public function create(createTieuChiRequest $request)
    {
        $congTy = Auth::guard('congty')->user();
        $data               = $request->all();
        $data['id_cong_ty']   = $congTy->id;
        unset($data['list_skill']);
        $newBaiDang = BaiDangTieuChi::create($data);
        foreach ($request->list_skill as $k => $v) {
            SkillTieuChi::create([
                'id_tieu_chi' => $newBaiDang->id,
                'id_skill'  => $v,
            ]);
        }
        return response()->json([
            'status'    => true
        ]);
    }

    public function status(Request $request)
    {
        $bai_dang_tieu_chis = BaiDangTieuChi::where('id', $request->id)->first();
        if ($bai_dang_tieu_chis) {
            if ($bai_dang_tieu_chis->is_open == 1) {
                $bai_dang_tieu_chis->is_open = 0;
            } else {
                $bai_dang_tieu_chis->is_open = 1;
            }
            $bai_dang_tieu_chis->save();
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
    public function statusDuyet(Request $request)
    {
        $bai_dang_tieu_chis = BaiDangTieuChi::where('id', $request->id)->first();
        if ($bai_dang_tieu_chis) {
            if ($bai_dang_tieu_chis->is_duyet == 1) {
                $bai_dang_tieu_chis->is_duyet = 0;
            } else {
                $bai_dang_tieu_chis->is_duyet = 1;
            }
            $bai_dang_tieu_chis->save();
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

    public function update(updateCongTyTCRequest $request)
    {
        $data   = $request->all();
        $list_skill = array_filter($request->list_skill, function ($value) {
            return $value !== null;
        });
        array_values($list_skill);
        unset($request->list_skill);
        $congTy = Auth::guard('congty')->user();
        $congTyTC   = BaiDangTieuChi::find($request->id);
        if ($congTy) {
            if ($congTyTC) {
                if ($congTyTC->is_duyet == 1) {
                    return response()->json([
                        'status'    => 2,
                        'message'   => 'Tiêu Chí Này Đã Duyệt!' . '<br>' . 'Vui Liên Hệ Khoa Hoặc Admin Để Cập Nhật!',
                    ]);
                } else {
                    $congTyTC->update($data);

                    $existingSkills = SkillTieuChi::where('id_tieu_chi', $request->id)->pluck('id_skill')->toArray();

                    $newSkills = array_diff($list_skill, $existingSkills);

                    $skillsToDelete = array_diff($existingSkills, $list_skill);

                    foreach ($newSkills as $newSkillId) {
                        SkillTieuChi::create([
                            'id_skill' => $newSkillId,
                            'id_tieu_chi' => $request->id
                        ]);
                    }

                    SkillTieuChi::whereIn('id_skill', $skillsToDelete)->delete();

                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Đã cập nhật Tiêu chí thành công!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Không tồn tại!'
                ]);
            }
        } else {
            if ($congTyTC) {
                $congTyTC->update($data);

                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật Tiêu chí thành công!'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Không tồn tại!'
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {
        $congTy = Auth::guard('congty')->user();
        $congTyTC   = BaiDangTieuChi::find($request->id);
        if ($congTy) {
            if ($congTyTC) {
                if ($congTyTC->is_duyet == 1) {
                    return response()->json([
                        'status'    => 2,
                        'message'   => 'Tiêu Chí Này Đã Duyệt!' . '<br>' . 'Vui Liên Hệ Khoa Hoặc Admin Để Xóa!',
                    ]);
                } else {
                    $congTyTC->delete();
                    SkillTieuChi::where('id_tieu_chi', $request->id)->delete();
                    SinhVienDatYeuCau::where('id_tieu_chi', $request->id)->delete();
                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Đã xóa Tiêu chí thành công!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Không tồn tại!'
                ]);
            }
        } else {
            if ($congTyTC) {
                $congTyTC->delete();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa Tiêu chí thành công!'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Không tồn tại!'
                ]);
            }
        }
    }

    public function search(Request $request)
    {
        $congTy = Auth::guard('congty')->user();
        $khoa = Auth::guard('khoa')->user();

        $value = '%' . $request->value . '%';
        if ($congTy) {
            $data  = BaiDangTieuChi::where('bai_dang_tieu_chis.id_cong_ty', $congTy->id)
                ->join('skills', 'bai_dang_tieu_chis.id_skill', 'skills.id')
                ->where(function ($query) use ($value) {
                    $query->where('tieu_de', 'like', $value)
                        ->orWhere('tien_luong', 'like', $value)
                        ->orWhere('skills.ten_skill', 'like', $value)
                        ->orWhere('dia_chi_cong_viec', 'like', $value);
                })
                ->select('bai_dang_tieu_chis.*', 'skills.ten_skill')

                ->get();
        } else if ($khoa) {
            $data = BaiDangTieuChi::join('skills', 'bai_dang_tieu_chis.id_skill', 'skills.id')
                ->join('nganhs', 'bai_dang_tieu_chis.id_nganh', '=', 'nganhs.id')
                ->join('khoas', 'nganhs.id_khoa', '=', 'khoas.id')
                ->where('khoas.id', $khoa->id)
                ->where(function ($query) use ($value) {
                    $query->where('tieu_de', 'like', $value)
                        ->orWhere('tien_luong', 'like', $value)
                        ->orWhere('skills.ten_skill', 'like', $value)
                        ->orWhere('dia_chi_cong_viec', 'like', $value)
                        ->orWhere('nganhs.ten_nganh', 'like', $value);
                })
                ->select('bai_dang_tieu_chis.*', 'khoas.ten_khoa', 'skills.ten_skill', 'nganhs.ten_nganh')
                ->get();
        } else {
            $data  = BaiDangTieuChi::where('tieu_de', 'like', $value)
                ->orWhere('tien_luong', 'like', $value)
                ->orWhere('skills.ten_skill', 'like', $value)
                ->orWhere('dia_chi_cong_viec', 'like', $value)
                ->select('bai_dang_tieu_chis.*', 'skills.ten_skill')
                ->get();
        }
        return response()->json([
            'data'  => $data
        ]);
    }
    public function info(Request $request)
    {
        // $data = BaiDangTieuChi::find($request->id);
        $data = SkillTieuChi::where('id_tieu_chi', $request->id)
            ->join('skills', 'skills.id', '=', 'skill_tieu_chis.id_skill')
            ->select('skill_tieu_chis.id_skill', 'skills.ten_skill')
            ->get();
        return response()->json([
            'data'  => $data
        ]);
    }

    public function exportFileSinhVien($id)
    {
        $id_tieu_chi = $id;
        $list_sv_ung_tuyen = SinhVienUngTuyen::where('id_tieu_chi', $id_tieu_chi)
            ->join('sinh_viens', 'sinh_viens.id', 'sinh_vien_ung_tuyens.id_sinh_vien')
            ->select('sinh_viens.*')
            ->get();
        $list_sv_dat_yc = SinhVienDatYeuCau::where('id_tieu_chi', $id_tieu_chi)
            ->join('sinh_viens', 'sinh_viens.id', 'sinh_vien_dat_yeu_caus.id_sinh_vien')
            ->select('sinh_viens.*')
            ->get();
        $data = [];

        foreach ($list_sv_ung_tuyen as $sinhVien) {
            $skills = SkillSinhVien::where('id_sinh_vien', $sinhVien->id)
                ->pluck('id_skill as id')
                ->toArray();
            $khoa = Khoa::find($sinhVien->id_khoa);
            $nganh = Nganh::find($sinhVien->id_nganh);

            $bangDiems = BangDiem::where('id_sinh_vien', $sinhVien->id)
                ->where('is_duyet', 1)
                ->get();
            $tongDiem = $bangDiems->sum('diem_so');
            if (!$tongDiem) $tongDiem = 0;

            $soLuong = $bangDiems->count();
            if (!$soLuong) $soLuong = 1;


            $diemTrungBinh = $tongDiem / $soLuong;
            $data[] = [
                'id'                => $sinhVien->id,
                'ten_sinh_vien'     => $sinhVien->ten_sinh_vien,
                'email'             => $sinhVien->email,
                'mssv'              => $sinhVien->mssv,
                'lop_co_van'        => $sinhVien->lop_co_van,
                'so_dien_thoai'     => $sinhVien->so_dien_thoai,
                'dia_chi'           => $sinhVien->dia_chi,
                'khoa'              => $khoa->ten_khoa,
                'nganh'             => $nganh->ten_nganh,
                'list_skills'       => $skills,
                'diem_trung_binh'   => $diemTrungBinh
            ];
        }
        foreach ($list_sv_dat_yc as $sinhVien) {
            $skills = SkillSinhVien::where('id_sinh_vien', $sinhVien->id)
                ->pluck('id_skill as id')
                ->toArray();

            $khoa = Khoa::find($sinhVien->id_khoa);
            $nganh = Nganh::find($sinhVien->id_nganh);

            $bangDiems = BangDiem::where('id_sinh_vien', $sinhVien->id)
                ->where('is_duyet', 1)
                ->get();
            $tongDiem = $bangDiems->sum('diem_so');
            if (!$tongDiem) $tongDiem = 0;

            $soLuong = $bangDiems->count();
            if (!$soLuong) $soLuong = 1;
            $diemTrungBinh = $tongDiem / $soLuong;
            $data[] = [
                'id'                => $sinhVien->id,
                'ten_sinh_vien'     => $sinhVien->ten_sinh_vien,
                'mssv'              => $sinhVien->mssv,
                'email'             => $sinhVien->email,
                'so_dien_thoai'     => $sinhVien->so_dien_thoai,
                'dia_chi'           => $sinhVien->dia_chi,
                'lop_co_van'        => $sinhVien->lop_co_van,
                'khoa'              => $khoa->ten_khoa,
                'nganh'             => $nganh->ten_nganh,
                'list_skills'       => $skills,
                'diem_trung_binh'   => $diemTrungBinh
            ];
        }
        // $ids = array_unique(array_column($data, 'id'));

        // $sinhVienList = array_values(array_intersect_key($data, array_flip($ids)));

        return Excel::download(new sinhVienExport($data), 'sinhvien.xlsx');
    }
}
