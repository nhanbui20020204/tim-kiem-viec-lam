@extends('share_congty.master')
@section('content')
    <div class="row" id="app">
        <div class="col-12 text-end mb-2">
            <button type="button" class="btn btn-outline-primary rounded-pill waves-effect py-2" data-bs-toggle="modal"
                data-bs-target="#themTieuChiModal"><i class="fa-solid fa-plus"></i> Thêm Mới Tiêu Chí</button>
        </div>
        <div class="modal fade" id="themTieuChiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Tiêu Chí</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="mt-2">Tên Tiêu Đề</label>
                                <input v-model="add.tieu_de" type="text" class="form-control"
                                    placeholder="Nhập vào tên tiêu đề">
                            </div>
                            <div class="col-md-4">
                                <label class="mt-2">Tiền Lương</label>
                                <input v-model="add.tien_luong" type="text" class="form-control"
                                    placeholder="Nhập vào tiền lương ">
                            </div>
                            <div class="col-md-4">
                                <label class="mt-2">Địa Chỉ Công Việc</label>
                                <input v-model="add.dia_chi_cong_viec" type="text" class="form-control"
                                    placeholder="Nhập vào đại chỉ ">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="mt-2">Ngày Bắt Đầu</label>
                                <input v-model="add.ngay_bat_dau" type="date" class="form-control"
                                    placeholder="Nhập vào ngày bắt đầu">
                            </div>
                            <div class="col-md-4">
                                <label class="mt-2">Ngày Kết Thúc </label>
                                <input v-model="add.ngay_ket_thuc" type="date" class="form-control"
                                    placeholder="Nhập vào ngày kết thúc">
                            </div>
                            <div class="col-md-4">
                                <label class="mt-2">Điểm Yêu Cầu</label>
                                <input v-model="add.diem_yeu_cau" type="text" class="form-control"
                                    placeholder="Nhập vào điểm yêu cầu ">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="mt-2">Tình Trạng</label>
                                <select v-model="add.is_open" class="form-select">
                                    <option value="1">Đang hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="mt-2">Ngành</label>
                                <select v-model="add.id_nganh" class="form-select">
                                    <template v-for="(va, ke) in ds_nganh">
                                        <option v-bind:value="va.id">@{{ va.ten_nganh }}
                                        </option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="mt-2">Số Lượng</label>
                                <input class="form-control" v-model="add.so_luong" type="number">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="skill" class="mt-2" for="">Danh mục Skill</label>
                                <button type="button" id="skill" @click="" class="btn btn-primary d-block"
                                    data-bs-toggle="modal" data-bs-target="#addSkillModal">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                            </div>
                            <div class="col-md-8">
                                <label class="mt-2" for="">Mô Tả</label>
                                <textarea v-model="add.noi_dung_mo_ta" class="form-control" name="" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="addSkillModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách Danh Mục Skill</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bodered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th>Tên danh mục skill</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(v,k) in list_DM">
                                                <th>
                                                    <input type="checkbox" name="" {{-- checked="list_skill_chon.some(item => item === v.id)" --}}
                                                        @click="handleAddSkill(v)" id="">
                                                </th>
                                                <th>@{{ k + 1 }}</th>
                                                <th>@{{ v.ten_skill }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Thoát</button>
                                    <button type="button" class="btn btn-primary" @click="handleSubmit()">Xác
                                        nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button v-on:click="themMoi()" type="button" class="btn btn-primary">Thêm Mới</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Danh Sách Tiêu Chí</h2>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <button class="btn btn-outline-primary waves-effect" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                        <input v-model="key_search" v-on:keyup.enter="timKiem()" type="text" class="form-control"
                            placeholder="Nhập vào thông tin cần tìm" aria-label="Amount">
                        <button v-on:click="timKiem()" class="btn btn-outline-primary waves-effect" type="button">Search
                            !</button>
                    </div>
                    <br>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle text-nowrap">#</th>
                                        <th class="text-center align-middle text-nowrap">Tên Tiêu Chí</th>
                                        <th class="text-center align-middle text-nowrap">Danh Mục</th>
                                        <th class="text-center align-middle text-nowrap">Điểm Yêu Cầu</th>
                                        <th class="text-center align-middle text-nowrap">Nội Dung Mô Tả</th>
                                        <th class="text-center align-middle text-nowrap">Tiền Lương</th>
                                        <th class="text-center align-middle text-nowrap"
                                            style="padding-right: 11rem;padding-left: 11rem;">Địa Chỉ</th>
                                        <th class="text-center align-middle text-nowrap">Ngày Bắt Đầu</th>
                                        <th class="text-center align-middle text-nowrap">Ngày Kết Thúc</th>
                                        <th class="text-center align-middle text-nowrap">Sinh Viên</th>
                                        <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                        <th class="text-center align-middle text-nowrap">Duyệt</th>
                                        <th class="text-center align-middle text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(value, key) in list">
                                        <td class="align-middle text-nowrap">@{{ key + 1 }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.tieu_de }}</td>
                                        <td class="align-middle text-nowrap">
                                            <button class="btn btn-primary " data-bs-toggle="modal"
                                                @click="loadDataMoiTieuChi(value)" data-bs-target="#SkillTieuChiModal"><i
                                                    class="fa-solid fa-comment"></i></button>
                                        </td>
                                        <td class="align-middle text-nowrap">@{{ value.diem_yeu_cau }}</td>
                                        <th scope="col">
                                            <div class="text-center align-middle">
                                                <button v-on:click="noi_dung= value.noi_dung_mo_ta"
                                                    class="btn btn-primary " data-bs-toggle="modal"
                                                    data-bs-target="#MotaNganModal"><i
                                                        class="fa-solid fa-comment"></i></button>
                                            </div>
                                            <div class="modal fade" id="MotaNganModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Mô tả công việc
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" v-html="noi_dung"></div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <td class=" align-middle text-nowrap">@{{ numberFormat(value.tien_luong) }}</td>
                                        <td>@{{ value.dia_chi_cong_viec }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.ngay_bat_dau }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.ngay_ket_thuc }}</td>
                                        <td class="align-middle text-nowrap">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" @click="getSinhVien(value)">
                                                <i class="fa-solid fa-list"></i>
                                        </td>
                                        <td class="text-nowrap align-middle text-center">
                                            <button v-on:click="doiTrangThai(value)" v-if="value.is_open == 1"
                                                class="btn btn-success">Đang Hoạt Động</button>
                                            <button v-on:click="doiTrangThai(value)" v-else class="btn btn-danger">Dừng
                                                Hoạt Động</button>
                                        </td>
                                        <td class="text-center align-middle text-nowrap">
                                            <span v-if="value.is_duyet == 1">Đã Duyệt</span>
                                            <span v-else>Chưa Duyệt</span>
                                        </td>
                                        <td class="text-nowrap align-middle text-center">
                                            <button class="btn px-0"><i v-on:click="edit = Object.assign({}, value)"
                                                    class="fa-solid fa-pen-to-square fa-2x text-info"
                                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                                    @click="loadDataMoiTieuChi(value)"
                                                    style="margin-right: 10px"></i></button>
                                            <button class="btn px-0"><i v-on:click="del = value"
                                                    class="fa-solid fa-trash fa-2x text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delModal"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="modal fade" id="SkillTieuChiModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách Danh Mục Skill
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bodered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên danh mục skill</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(v,k) in list_skill">
                                                        <th>@{{ k + 1 }}</th>
                                                        <th>@{{ v.ten_skill }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách Sinh Viên</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <h4>Danh sách sinh viên được gửi từ Khoa</h4>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="align-middle text-nowrap">Tên Sinh Viên</th>
                                                            <th class="align-middle text-nowrap">Email</th>
                                                            <th class="align-middle text-nowrap">Số Điện Thoại</th>
                                                            <th class="align-middle text-nowrap">Địa Chỉ</th>
                                                            <th class="align-middle text-nowrap">Bảng Điểm</th>
                                                            <th class="align-middle text-nowrap">Skills</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(value,key) in list_sv">
                                                            <td class="align-middle text-nowrap">
                                                                <span
                                                                    v-if="list_sv_phong_van.some(item => item.id === value.id)"
                                                                    style="text-transform: capitalize;font-style: italic;font-size: 12px;">Đã
                                                                    gửi</span>
                                                                <input v-else type="checkbox"
                                                                    @change="toggleCheckbox(value.id)"
                                                                    :checked="sinhVienExist(value.id)">
                                                            </td>
                                                            <td class="align-middle text-nowrap">@{{ value.ten_sinh_vien }}
                                                            </td>
                                                            <td class="align-middle text-nowrap">@{{ value.email }}
                                                            </td>
                                                            <td class="align-middle text-nowrap">@{{ value.so_dien_thoai }}
                                                            </td>
                                                            <td class="align-middle text-nowrap">@{{ value.dia_chi }}
                                                            </td>
                                                            <td class="align-middle text-nowrap">
                                                                <i v-on:click="list_bang_diem_sinh_vien = value.list_diems"
                                                                    class="fa-solid fa-circle-info fa-2x text-info"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#BangDiemSinhVienModal"></i>
                                                            </td>
                                                            <td class="align-middle text-nowrap">
                                                                <i v-on:click="list_skill_sinh_vien = value.list_skills"
                                                                    class="fa-solid fa-book fa-2x text-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#SkillSinhVienModal"></i>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row mt-2">
                                                <h4>Danh sách sinh viên ứng tuyển</h4>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="align-middle text-nowrap">Tên Sinh Viên</th>
                                                            <th class="align-middle text-nowrap">Email</th>
                                                            <th class="align-middle text-nowrap">Số Điện Thoại</th>
                                                            <th class="align-middle text-nowrap">Địa Chỉ</th>
                                                            <th class="align-middle text-nowrap">Bảng Điểm</th>
                                                            <th class="align-middle text-nowrap">Skills</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(value,key) in list_sv_ung_tuyen">
                                                            <td class="align-middle text-nowrap">
                                                                <span
                                                                    v-if="list_sv_phong_van.some(item => item.id === value.id)"
                                                                    style="text-transform: capitalize;font-style: italic;font-size: 12px;">Đã
                                                                    gửi email</span>
                                                                <input v-else type="checkbox"
                                                                    @change="toggleCheckbox(value.id)"
                                                                    :checked="sinhVienExist(value.id)">
                                                            </td>
                                                            <td class="align-middle text-nowrap">@{{ value.ten_sinh_vien }}
                                                            </td>
                                                            <td class="align-middle text-nowrap">@{{ value.email }}
                                                            </td>
                                                            <td class="align-middle text-nowrap">@{{ value.so_dien_thoai }}
                                                            </td>
                                                            <td class="align-middle text-nowrap">@{{ value.dia_chi }}
                                                            </td>
                                                            <td class="align-middle text-nowrap align-middle">
                                                                <i v-on:click="list_bang_diem_sinh_vien = value.list_diems"
                                                                    class="fa-solid fa-circle-info fa-2x text-info"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#BangDiemSinhVienModal"></i>
                                                            </td>
                                                            <td class="align-middle text-nowrap align-middle">
                                                                <i v-on:click="list_skill_sinh_vien = value.list_skills"
                                                                    class="fa-solid fa-book fa-2x text-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#SkillSinhVienModal"></i>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                            <div class="d-flex gap-3">
                                                <form id="exportForm"
                                                    :action="'{{ url('/sinhvien/tieuchi/export/') }}/' + this.tieu_chi.id"
                                                    method="GET" enctype="multipart/form-data">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Export</button>
                                                </form>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#noiDungPhongVanModal">Send
                                                    Mail</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="noiDungPhongVanModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin phỏng vấn</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="mt-2">Nội dung</label>
                                                    <input v-model="thong_tin.noi_dung" class="form-control"
                                                        placeholder="Nhập vào nội dung">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="mt-2">Địa chỉ</label>
                                                    <input v-model="thong_tin.dia_chi" class="form-control"
                                                        placeholder="Nhập vào địa chỉ">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="mt-2">Thời gian</label>
                                                    <input v-model="thong_tin.thoi_gian" class="form-control"
                                                        placeholder="Nhập vào khoảng thời gian">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                            <button type="button" class="btn btn-primary"
                                                @click="sendMailPhongVan()">Xác nhận</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" modal fade" id="SkillSinhVienModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách Danh Mục Skill
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bodered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên danh mục skill</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(v,k) in list_skill_sinh_vien">
                                                        <th>@{{ k + 1 }}</th>
                                                        <th>@{{ v }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="BangDiemSinhVienModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Bảng Điểm</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bodered text-center">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th class="text-nowrap">Mã môn học</th>
                                                        <th class="text-nowrap">Tên môn học</th>
                                                        <th class="text-nowrap">Điểm</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(v,k) in list_bang_diem_sinh_vien">
                                                        <th>@{{ k + 1 }}</th>
                                                        <th>@{{ v.ma_mon }}</th>
                                                        <th>@{{ v.ten_mon }}</th>
                                                        <th>@{{ v.diem_so }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th>ĐTB:</th>
                                                        <th>@{{ Math.round(this.list_bang_diem_sinh_vien?.reduce((prev, score) => prev + score.diem_so, 0) / this.list_bang_diem_sinh_vien.length * 100) / 100 }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xóa Tiêu Chí</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có muốn xóa tiêu đề <b>@{{ del.tieu_de }}</b>
                                                này không?</p>
                                            <p><b>Lưu ý:</b> Thao tác này không thể hoàn tác!!!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button v-on:click="xoaTieuChi()" data-bs-dismiss="modal" type="button"
                                                class="btn btn-danger">Xác nhận xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Tiêu Chí</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="mt-2">Tên Tiêu Đề</label>
                                                    <input v-model="edit.tieu_de" type="text" class="form-control"
                                                        placeholder="Nhập vào tên tiêu đề">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mt-2">Tiền Lương</label>
                                                    <input v-model="edit.tien_luong" type="text" class="form-control"
                                                        placeholder="Nhập vào tiền lương ">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mt-2">Địa Chỉ Công Việc</label>
                                                    <input v-model="edit.dia_chi_cong_viec" type="text"
                                                        class="form-control" placeholder="Nhập vào đại chỉ ">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="mt-2">Ngày Bắt Đầu</label>
                                                    <input v-model="edit.ngay_bat_dau" type="date"
                                                        class="form-control" placeholder="Nhập vào ngày bắt đầu">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mt-2">Ngày Kết Thúc </label>
                                                    <input v-model="edit.ngay_ket_thuc" type="date"
                                                        class="form-control" placeholder="Nhập vào ngày kết thúc">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mt-2">Điểm Yêu Cầu</label>
                                                    <input v-model="edit.diem_yeu_cau" type="text"
                                                        class="form-control" placeholder="Nhập vào điểm yêu cầu ">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="mt-2">Tình Trạng</label>
                                                    <select v-model="edit.is_open" class="form-select">
                                                        <option value="1">Đang hoạt động</option>
                                                        <option value="0">Không hoạt động</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mt-2">Ngành</label>
                                                    <select v-model="edit.id_nganh" class="form-select">
                                                        <template v-for="(va, ke) in ds_nganh">
                                                            <option v-bind:value="va.id">@{{ va.ten_nganh }}
                                                            </option>
                                                        </template>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mt-2">Số Lượng</label>
                                                    <input class="form-control" v-model="edit.so_luong" type="number">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="mt-2">Skills</label>
                                                    <button type="button" id="" class="btn btn-primary d-block"
                                                        data-bs-toggle="modal" data-bs-target="#editSkill">
                                                        <i class="fa-solid fa-circle-info"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-8">
                                                    <label class="mt-2" for="">Mô Tả</label>
                                                    <textarea v-model="edit.noi_dung_mo_ta" class="form-control" name="" id="" cols="30"
                                                        rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button v-on:click="capNhatTieuChi()" type="button"
                                                class="btn btn-primary">Cập Nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="editSkill" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách Danh Mục Skill
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bodered">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>#</th>
                                                        <th>Tên danh mục skill</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(v,k) in list_DM">
                                                        <th>
                                                            <input v-model="list_skill_chon[k]" type="checkbox"
                                                                name="" :id="'checkbox-' + v.id">
                                                        </th>
                                                        <th>@{{ k + 1 }}</th>
                                                        <th>@{{ v.ten_skill }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                            <button type="button" class="btn btn-primary" @click="handleEditSkill()">Xác
                                                nhận</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                add: {

                },
                id: 0,
                list: [],
                edit: {},
                del: {},
                tieu_chi: {},
                thong_tin: {
                    thoi_gian: '',
                    dia_chi: '',
                    noi_dung: ''
                },
                key_search: '',
                ds_nganh: [],
                list_DM: [],
                noi_dung: {},
                list_sv: [],
                list_skill: [],
                list_skill_chon: [],
                list_skill_duoc_chon: [],
                list_bang_diem_sinh_vien: [],
                list_skill_sinh_vien: [],
                list_sv_duoc_chon: [],
                list_sv_phong_van: [],
                list_sv_ung_tuyen: [],
            },
            created() {
                this.loadData();
                this.loadNganh();
                this.loadSkill();
                this.dataSendMail();
            },
            methods: {
                handleAddSkill(v) {
                    if (!this.list_skill_chon.includes(v.id)) {
                        this.list_skill_chon.push(v.id);
                    } else {
                        this.list_skill_chon.filter(item => item !== v.id);
                    }
                },
                handleSubmit() {
                    this.add.list_skill = this.list_skill_chon;
                    $('#addSkillModal').modal('hide');
                },
                handleEditSkill() {
                    for (const key in this.list_skill_chon) {
                        if (this.list_skill_chon[key] === true) {
                            for (const k in this.list_DM) {
                                if (k === key) this.list_skill_chon[key] = this.list_DM[k].id;
                            }
                        }
                    }
                    this.edit = {
                        ...this.edit,
                        list_skill: this.list_skill_chon
                    };
                    console.log(this.edit);
                    $('#editSkill').modal('hide');
                },
                getSinhVien(value) {
                    this.id = value.id;
                    axios
                        .post('{{ Route('getDataDatYeuCau') }}', value)
                        .then((res) => {
                            this.list_sv = res.data.data;
                            this.dataSinhVienUngTuyen(value);
                            this.tieu_chi = value;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                loadSkill() {
                    axios
                        .get('{{ Route('dataSkillCongTy') }}')
                        .then((res) => {
                            this.list_DM = res.data.data;
                        });
                },
                timKiem() {
                    var payload = {
                        value: this.key_search
                    }
                    axios
                        .post('{{ Route('searchTieuChi') }}', payload)
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                loadNganh() {
                    axios
                        .get('{{ Route('NganhDataCongTy') }}')
                        .then((res) => {
                            this.ds_nganh = res.data.data;
                        });
                },
                loadData() {
                    axios
                        .get('{{ Route('dataTieuChi') }}')
                        .then((res) => {
                            this.list = res.data.data;
                            if (res.data.status == 0) {
                                toastr.error(res.data.message);
                            }
                        });
                },
                loadDataMoiTieuChi(payload) {
                    axios
                        .post('{{ Route('dataTieuChiInfo') }}', payload)
                        .then((res) => {
                            this.list_skill = res.data.data;
                            this.list_skill_chon = this.list_DM.filter(skill => this.list_skill.some(
                                selected => selected.id_skill === skill.id));
                            this.list_skill_chon = this.list_skill_chon.map(item => item.id);
                        });
                },
                isChecked(skillId) {
                    return this.list_skill_chon.some(skill => skill.id === skillId);
                },
                themMoi() {
                    axios
                        .post('{{ Route('createTieuChi') }}', this.add)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success("Đã thêm mới Tiêu chí", "Thành công!");
                                this.loadData();
                                this.add = {};
                                $('#themTieuChiModal').modal('hide');
                            }
                        })
                        .catch((res) => {
                            var errrors = res.response.data.errors;
                            $.each(errrors, function(k, v) {
                                toastr.error(v[0], "Có lỗi!");
                            })
                        });
                },
                xoaTieuChi() {
                    axios
                        .post('{{ Route('deleteTieuChi') }}', this.del)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#delModal').modal('hide');
                                this.loadData();
                            } else if (res.data.status == 2) {
                                toastr.info(res.data.message);
                                $('#delModal').modal('hide');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            var errrors = res.response.data.errors;
                            $.each(errrors, function(k, v) {
                                toastr.error(v[0], "Có lỗi!");
                            })
                        });
                },
                capNhatTieuChi() {
                    console.log({
                        ...this.edit,
                        list_skill: this.list_skill.map(item => item.id_skill)
                    });
                    axios
                        .post('{{ Route('updateTieuChi') }}', {
                            ...this.edit,
                            list_skill: this.list_skill.map(item => item.id_skill)
                        })
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                $('#editModal').modal('hide');
                                this.loadData();
                            } else if (res.data.status == 2) {
                                toastr.info(res.data.message);
                                $('#editModal').modal('hide');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            var errrors = res.response.data.errors;
                            $.each(errrors, function(k, v) {
                                toastr.error(v[0], "Có lỗi!");
                            })
                        });
                },
                doiTrangThai(payload) {
                    axios
                        .post('{{ Route('statusTieuChi') }}', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        });
                },
                doiTrangThaiDuyet(payload) {
                    axios
                        .post('{{ Route('statusDuyetTieuChi') }}', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.timKiem();
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        });
                },
                sinhVienExist(id) {
                    return this.list_sv_duoc_chon.some(sv => sv === id);
                },
                toggleCheckbox(svId) {
                    if (this.sinhVienExist(svId)) {
                        this.list_sv_duoc_chon = this.list_sv_duoc_chon.filter(id => id !== svId);
                    } else {
                        this.list_sv_duoc_chon.push(svId);
                    }
                },
                dataSinhVienUngTuyen(payload) {
                    axios
                        .post('{{ Route('dataUngTuyenSinhVien') }}', payload)
                        .then((res) => {
                            this.list_sv_ung_tuyen = res.data.data;
                        });
                },
                dataSendMail() {
                    axios
                        .get('{{ Route('DataGuiMail') }}')
                        .then((res) => {
                            this.list_sv_phong_van = res.data.data;
                        });
                },
                sendMailPhongVan() {
                    var payload = {
                        list_sv: this.list_sv_duoc_chon,
                        id_tieu_chi: this.id,
                        ...this.thong_tin,
                    }
                    axios
                        .post('{{ Route('createGuiMail') }}', payload)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                this.list_sv_duoc_chon = [];
                                this.list =
                                    this.thong_tin = {};
                                this.dataSendMail();
                                $('#exampleModal').modal('hide');
                                $('#noiDungPhongVanModal').modal('hide');
                            } else if (res.data.status == 0) {
                                toastr.info(res.data.message, 'Info');
                                this.list_sv_duoc_chon = [];
                                this.thong_tin = {};
                                $('#noiDungPhongVanModal').modal('hide');
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                },
                // exportFileSinhVien() {
                //     axios
                //         .get(`/sinhvien/tieuchi/export`, this.tieu_chi)
                //         .then(res => {
                //             toastr.success('Get sinh viên thành công');
                //         })
                // },
                numberFormat(number) {
                    return new Intl.NumberFormat('vi-VI', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(number);
                },
            },
        });
    </script>
@endsection
