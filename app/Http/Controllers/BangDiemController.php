<?php

namespace App\Http\Controllers;

use App\Exports\BangDiemExport;
use App\Http\Requests\Admin\BangDiem\BangDiemRequest;
use App\Http\Requests\User\createBangDiemRequest;
use App\Http\Requests\User\updateBangDiemRequest;
use App\Models\BangDiem;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;

class BangDiemController extends Controller
{

    public function indexexcel(Request $request)
    {
        $bang_diems = BangDiem::all();
        // $sinhVien = Auth::guard('sinhvien')->user();
        // if ($sinhVien) {
        //     $dataA = BangDiem::where('id_sinh_vien', $sinhVien->id)
        //         ->join('sinh_viens', 'bang_diems.id_sinh_vien', 'sinh_viens.id')
        //         ->select('bang_diems.*', 'sinh_viens.ten_sinh_vien')
        //         ->get();
        // } else if ($request->id) {
        //     $dataA = BangDiem::where('id_sinh_vien', $request->id)
        //         ->join('sinh_viens', 'bang_diems.id_sinh_vien', 'sinh_viens.id')
        //         ->select('bang_diems.*', 'sinh_viens.ten_sinh_vien')
        //         ->get();
        // } else {
        //     $dataA = BangDiem::join('sinh_viens', 'bang_diems.id_sinh_vien', 'sinh_viens.id')
        //         ->select('bang_diems.*', 'sinh_viens.ten_sinh_vien')
        //         ->get();
        // }
        // return response()->json([
        //     'dataA'  => $dataA,
        // ]);
        return view('sinhvien.page.import', compact('bang_diems'));
    }

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new CustomerImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Imported Successfully');
    }

    public function exportBangDiemExcel()
    {
        $data = [
            ['CS 211', 'Lập Trình Cơ Sở'],
            ['IS 301', 'Cơ Sở Dữ Liệu'],
            ['CS 311', 'Lập Trình Hướng Đối Tượng'],
            ['CR 424', 'Lập Trình Ứng Dụng cho các Thiết Bị Di Động'],
            ['CS 252', 'Mạng Máy Tính'],
            ['CS 303', 'Phân Tích & Thiết Kế Hệ Thống'],
            ['IS 401', 'Hệ Quản Trị Cơ Sở Dữ Liệu'],
            ['CS 316', 'Giới Thiệu Cấu Trúc Dữ Liệu & Giải Thuật'],
            ['CS 353', 'Phân Tích & Thiết Kế Hướng Đối Tượng'],
            ['CS 417', 'Trí Tuệ Nhân Tạo (Biểu Diễn & Giải Thuật)'],
            ['CS 420', 'Hệ Phân Tán (J2EE, .NET)'],
            ['CS 462', 'Kiểm Thử & Đảm Bảo Chất Lượng Phần Mềm'],
            ['CS 464', 'Lập Trình Ứng Dụng .NET'],
            ['CS 403', 'Công Nghệ Phần Mềm'],
            ['CS 445', 'Đồ Án Chuyên Ngành: Tích Hợp Hệ Thống (COTS)'],
        ];
        return Excel::download(new BangDiemExport($data), 'bangdiem.xlsx');
    }
    public function index_khoa()
    {
        return view('Khoa.Bang_Diem.index');
    }
    public function index_admin()
    {
        $check = $this->checkRule_get(12);
        if (!$check) {
            toastr()->error('Bạn không có quyền truy cập chức năng này!');
            return redirect('/admin');
        }
        return view('admin.page.Bang_diem.index');
    }

    public function getLinkUpdateAVT($folder, $file)
    {
        $root_path = public_path();

        $file_extension = $file->getClientOriginalExtension();

        $file_name = Str::slug($file->getClientOriginalName()) . "." . $file_extension;

        $link = '/' . $folder . '/';

        $path = $root_path . '/' . $link;

        $file->move($path, $file_name);

        return $link . $file_name;
    }

    public function create(BangDiemRequest $request)
    {

        $data = $request->all();
        $sinhVien = Auth::guard('sinhvien')->user();
        $khoa = Auth::guard('khoa')->user();

        if ($sinhVien) {
            if (isset($data['hinh_anh'])) {
                $file = $request->file('hinh_anh');
                $avatar = $this->getLinkUpdateAVT('image-bang-diem', $file);
                $data['hinh_anh'] = $avatar;
            }
            $data['id_sinh_vien'] = $sinhVien->id;
            $data['is_duyet'] = 0;

            BangDiem::create($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Tạo điểm sinh viên thành công!',
            ]);
        } elseif ($khoa) {
            BangDiem::create($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Tạo điểm sinh viên thành công!',
            ]);
        } else {

            $check = $this->checkRule_post(13);
            if (!$check) {
                return response()->json([
                    'status'  => 0,
                    'message' => 'Bạn không có quyền truy cập chức năng này!',
                ]);
            }

            BangDiem::create($data);
            return response()->json([
                'status'    => 1,
                'message'   => 'Tạo điểm sinh viên thành công!',
            ]);
        }
    }
    public function data(Request $request)
    {
        $sinhVien = Auth::guard('sinhvien')->user();
        if ($sinhVien) {
            $data = BangDiem::where('id_sinh_vien', $sinhVien->id)
                ->join('sinh_viens', 'bang_diems.id_sinh_vien', 'sinh_viens.id')
                ->select('bang_diems.*', 'sinh_viens.ten_sinh_vien')
                ->get();
        } else if ($request->id) {
            $data = BangDiem::where('id_sinh_vien', $request->id)
                ->join('sinh_viens', 'bang_diems.id_sinh_vien', 'sinh_viens.id')
                ->select('bang_diems.*', 'sinh_viens.ten_sinh_vien')
                ->get();
        } else {
            $data = BangDiem::join('sinh_viens', 'bang_diems.id_sinh_vien', 'sinh_viens.id')
                ->select('bang_diems.*', 'sinh_viens.ten_sinh_vien')
                ->get();
        }
        return response()->json([
            'data'  => $data,
        ]);
    }
    public function index()
    {
        return view('sinhvien.Bang_diem.index');
    }

    public function status(Request $request)
    {

        $khoa = Auth::guard('khoa')->user();
        if ($khoa) {

            $bangdiem = BangDiem::where('id', $request->id)->first();
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
            $bangdiem = BangDiem::where('id', $request->id)->first();
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
    public function statusDuyet(Request $request)
    {
        // $check = $this->checkRule_post(17);
        // if (!$check) {
        //     return response()->json([
        //         'status'  => 0,
        //         'message' => 'Bạn không có quyền truy cập chức năng này!',
        //     ]);
        // }
        $bangdiem = BangDiem::where('id', $request->id)->first();
        if ($bangdiem) {
            if ($bangdiem->is_duyet == 1) {
                $bangdiem->is_duyet = 0;
            } else {
                $bangdiem->is_duyet = 1;
            }
            $bangdiem->save();
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

    public function update(updateBangDiemRequest $request)
    {
        $data = $request->all();
        $sinhVien = Auth::guard('sinhvien')->user();
        $khoa = Auth::guard('khoa')->user();
        $bangdiem = BangDiem::where('id', $request->id)->first();
        if (isset($data['hinh_anh'])) {
            $file = $request->file('hinh_anh');
            $avatar = $this->getLinkUpdateAVT('image-bang-diem', $file);
            $data['hinh_anh'] = $avatar;
        }
        if ($sinhVien) {
            if ($bangdiem) {
                if ($bangdiem->is_duyet == 1) {
                    return response()->json([
                        'status'    => 2,
                        'message'   => 'Bảng Điểm Đã Duyệt Bạn Không Thể Cập Nhật!' . '<br>' . 'Vui Lòng Liên Hệ Khoa Của Bạn Để Sửa Điểm!',
                    ]);
                } else {
                    $bangdiem->update($data);
                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Đã cập nhật thành công!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Điểm Không Tồn Tại'
                ]);
            }
        } elseif ($khoa) {
            if ($bangdiem) {
                $bangdiem->update($data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật thành công'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Điểm Không Tồn Tại'
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
            if ($bangdiem) {
                $bangdiem->update($data);
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã cập nhật thành công'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Điểm Không Tồn Tại'
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {

        $sinhVien = Auth::guard('sinhvien')->user();
        $khoa = Auth::guard('khoa')->user();
        $bangdiem = BangDiem::where('id', $request->id)->first();
        if ($sinhVien) {
            if ($bangdiem) {
                if ($bangdiem->is_duyet == 1) {
                    return response()->json([
                        'status'    => 2,
                        'message'   => 'Bảng Điểm Đã Duyệt Bạn Không Xóa!' . '<br>' . 'Vui Lòng Liên Hệ Khoa!',
                    ]);
                } else {
                    $bangdiem->delete();
                    return response()->json([
                        'status'    => 1,
                        'message'   => 'Đã xóa thành công!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Điểm Không Tồn Tại'
                ]);
            }
        } elseif ($khoa) {
            if ($bangdiem) {
                $bangdiem->delete();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa thành công'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Điểm Không Tồn Tại'
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
            if ($bangdiem) {
                $bangdiem->delete();
                return response()->json([
                    'status'    => 1,
                    'message'   => 'Đã xóa thành công'
                ]);
            } else {
                return response()->json([
                    'status'    => 0,
                    'message'   => 'Bảng Điểm Không Tồn Tại'
                ]);
            }
        }
    }

    // public function search(Request $request)
    // {
    //     $value = '%' . $request->value . '%';
    //     $data  = BangDiem::where('tieu_de', 'like', $value)
    //         ->orWhere('dia_chi_cong_viec', 'like', $value)
    //         ->get();
    //     return response()->json([
    //         'data'  => $data
    //     ]);
    // }


}
