@extends('share_khoa.master')
@section('content')
<div class="row" id="app">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>Danh Sách Tiêu Chí</h2>
            </div>
            <div class="card-body">
                <div class="input-group">
                    <button class="btn btn-outline-primary waves-effect" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                    <input v-model="key_search" v-on:keyup.enter="timKiem()" type="text" class="form-control" placeholder="Nhập vào thông tin cần tìm" aria-label="Amount">
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
                                    <th class="text-center align-middle text-nowrap">Ngành</th>
                                    <th class="text-center align-middle text-nowrap">Skills</th>
                                    <th class="text-center align-middle text-nowrap">Tiền Lương</th>
                                    <th class="text-center align-middle text-nowrap">Số Lượng</th>
                                    <th class="text-center align-middle text-nowrap">Nội Dung Mô Tả</th>
                                    <th class="text-center align-middle text-nowrap" style="padding-right: 11rem;padding-left: 11rem;">Địa Chỉ</th>
                                    <th class="text-center align-middle text-nowrap">Ngày Bắt Đầu</th>
                                    <th class="text-center align-middle text-nowrap">Ngày Kết Thúc</th>
                                    <th class="text-center align-middle text-nowrap">Thêm Sinh Viên</th>
                                    {{-- <th class="text-center align-middle text-nowrap">Tình Trạng</th> --}}
                                    <th class="text-center align-middle text-nowrap">Duyệt</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value, key) in list">
                                    <td class="align-middle text-nowrap">@{{ key + 1 }}</td>
                                    <td class="align-middle text-nowrap">@{{ value.tieu_de }}</td>
                                    <td class="align-middle text-nowrap">@{{ value.ten_nganh }}</td>
                                    <td class="align-middle text-nowrap">
                                        <button type="button" @click="loadDataMoiTieuChi(value)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#skillModal">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </button>
                                    </td>
                                    <td class="align-middle text-nowrap">@{{ numberFormat(value.tien_luong) }}</td>
                                    <td class="align-middle text-nowrap">@{{ value.so_luong }}</td>
                                    <td class="align-middle text-nowrap">
                                        <button type="button" @click=" noi_dung = value.noi_dung_mo_ta" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </button>
                                    </td>
                                    <td>@{{ value.dia_chi_cong_viec }}</td>
                                    <td class="align-middle text-nowrap">@{{ value.ngay_bat_dau }}</td>
                                    <td class="align-middle text-nowrap">@{{ value.ngay_ket_thuc }}</td>
                                    <td class="align-middle text-nowrap">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSinhVienModal" @click=" loadSinhVien(value)">
                                            Add
                                        </button>
                                    </td>
                                    {{-- <td class="text-nowrap align-middle text-center">
                                            <button v-on:click="doiTrangThai(value)" v-if="value.is_open == 1"
                                                class="btn btn-success">Đang Hoạt Động</button>
                                            <button v-on:click="doiTrangThai(value)" v-else class="btn btn-danger">Dừng
                                                Hoạt Động</button>
                                        </td> --}}
                                    <td class="text-center align-middle text-nowrap">
                                        <button v-on:click="doiTrangThaiDuyet(value)" v-if="value.is_duyet == 1" class="btn btn-success">Đã Duyệt</button>
                                        <button v-on:click="doiTrangThaiDuyet(value)" v-else class="btn btn-danger">Chưa
                                            Duyệt</button>
                                    </td>
                                    <td class="text-nowrap align-middle text-center">
                                        {{-- <button class="btn px-0"><i v-on:click="edit = Object.assign({}, value)"
                                                    class="fa-solid fa-pen-to-square fa-2x text-info" data-bs-toggle="modal"
                                                    data-bs-target="#editModal" style="margin-right: 10px"></i></button> --}}
                                        <button class="btn px-0"><i v-on:click="del = value" class="fa-solid fa-trash fa-2x text-danger" data-bs-toggle="modal" data-bs-target="#delModal"></i></button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Xóa Tiêu Chí</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có muốn xóa tiêu đề <b>@{{ del.tieu_de }}</b>
                                                    này không?</p>
                                                <p><b>Lưu ý:</b> Thao tác này không thể hoàn tác!!!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button v-on:click="xoaTieuChi()" data-bs-dismiss="modal" type="button" class="btn btn-danger">Xác nhận xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                        <div class="modal modal-xl fade" id="addSinhVienModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách Sinh Viên</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bodered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>#</th>
                                                    <th>Tên Sinh Viên</th>
                                                    <th>Bảng Điểm</th>
                                                    <th>Skills</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(v,k) in list_sv">
                                                    <th>
                                                        <input v-model="v.check" type="checkbox" name="" id="">
                                                    </th>
                                                    <th>@{{ k + 1 }}</th>
                                                    <th>@{{ v.ten_sinh_vien }}</th>
                                                    <th>
                                                        <button class="btn btn-info" data-bs-toggle="modal" @click="loadBangDiemSinhVien(v.list_diems)" data-bs-target="#thongTinSinhVienModal">
                                                            <i class="fa-solid fa-circle-info"></i>
                                                        </button>
                                                    </th>
                                                    <th>
                                                        <button class="btn btn-info" data-bs-toggle="modal" @click="loadSkillSinhVien(v.list_skills)" data-bs-target="#skillSinhVienModal">
                                                            <i class="fa-solid fa-circle-info"></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                        <button type="button" class="btn btn-primary" @click="addSinhVien()">Gửi
                                            Sinh Viên</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="skillSinhVienModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách Skills</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bodered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên Skill</th>
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách skill</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bodered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên Skill</th>
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="thongTinSinhVienModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bảng Điểm</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bodered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên môn học</th>
                                                    <th>Điểm Số</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(v,k) in list_bang_diem">
                                                    <th>@{{ k + 1 }}</th>
                                                    <th>@{{ v.ten_mon }}</th>
                                                    <th>@{{ v.diem_so }}</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>@{{ this.list_bang_diem.reduce((prev, value) => prev + value.diem_so, 0) / this.list_bang_diem.length }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nội Dung</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div v-html="noi_dung"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Cập Nhật </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="mb-2">Tên Tiêu Đề</label>
                                                    <input v-model="edit.tieu_de" type="text" class="form-control"
                                                        placeholder="Nhập vào tên tiêu đề">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mb-2">Tiền Lương</label>
                                                    <input v-model="edit.tien_luong" type="text" class="form-control"
                                                        placeholder="Nhập vào tiền lương ">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="mb-2">Địa Chỉ Công Việc</label>
                                                    <input v-model="edit.dia_chi_cong_viec" type="text"
                                                        class="form-control" placeholder="Nhập vào đại chỉ ">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="mb-2">Ngày Bắt Đầu</label>
                                                    <input v-model="edit.ngay_bat_dau" type="date"
                                                        class="form-control" placeholder="Nhập vào ngày bắt đầu">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="mb-2">Ngày Kết Thúc </label>
                                                    <input v-model="edit.ngay_ket_thuc" type="date"
                                                        class="form-control" placeholder="Nhập vào ngày kết thúc">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="mb-2">Duyệt</label>
                                                    <select v-model="edit.is_duyet" class="form-select">
                                                        <option value="1">Duyệt</option>
                                                        <option value="0">Không duyệt</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="mb-2">Tình Trạng</label>
                                                    <select v-model="edit.is_open" class="form-select">
                                                        <option value="1">Đang hoạt động</option>
                                                        <option value="0">Không hoạt động</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="mb-2">Ngành</label>
                                                    <select v-model="edit.id_nganh" class="form-select">
                                                        <template v-for="(va, ke) in ds_nganh">
                                                            <option v-bind:value="va.id">@{{ va.ten_nganh }}
                        </option>
                        </template>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">Danh Mục</label>
                        <select v-model="edit.id_nganh" class="form-select">
                            <template v-for="(va, ke) in list_danh_muc">
                                <option v-bind:value="va.id">@{{ va.ten_skill }}
                                </option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="">Mô Tả</label>
                    <textarea v-model="edit.noi_dung_mo_ta" class="form-control" name="" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button v-on:click="capNhatTieuChi()" type="button" class="btn btn-primary">Cập Nhật Tiêu Chí</button>
            </div>
        </div>
    </div>
</div> --}}
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
            add: {},
            list: [],
            edit: {},
            del: {},
            key_search: '',
            ds_nganh: [],
            list_skill: [],
            noi_dung: '',
            list_sv: [],
            so_luong: 0,
            id_tieu_chi: 0,
            list_bang_diem: [],
            list_skill_sinh_vien: [],
        },
        created() {
            this.loadData();
            this.loadNganh();
            this.loadSkill();
            // this.loadSinhVien();
        },
        methods: {
            loadSkillSinhVien(value) {
                this.list_skill_sinh_vien = value;
            },
            loadBangDiemSinhVien(value) {
                this.list_bang_diem = value;
            },
            addSinhVien() {
                var payload = {
                    'list_sv': this.list_sv,
                    'id_tieu_chi': this.id_tieu_chi,
                };
                const tieu_chi = this.list.find(item => item.id === payload.id_tieu_chi);
                if (tieu_chi.is_duyet === 0) {
                    toastr.error('Vui lòng duyệt tiêu chí trước khi thêm sinh viên');
                    return;
                }
                axios
                    .post('{{ Route("addSinhVienDuDieuKien") }}', payload)
                    .then((res) => {
                        if (res.data.status == 1) {
                            toastr.success(res.data.message);
                            $('#addSinhVienModal').modal('hide');
                        } else if (res.data.status == 2) {
                            toastr.info(res.data.message);
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            },
            loadDataMoiTieuChi(payload) {
                axios
                    .post('{{ Route("dataTieuChiInfoMain") }}', payload)
                    .then((res) => {
                        this.list_skill = res.data.data;
                    });
            },
            loadSinhVien(value) {
                axios
                    .post('{{ Route("sinhVienDuDieuKien") }}', value)
                    .then((res) => {
                        this.list_sv = res.data.data;
                        this.id_tieu_chi = res.data.id_tieu_chi;
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0], 'Error');
                        });
                    });
            },
            loadSkill() {
                axios
                    .get('{{ Route("dataSkillKhoa") }}')
                    .then((res) => {
                        this.list_danh_muc = res.data.data;
                    });
            },
            timKiem() {
                var payload = {
                    value: this.key_search
                }
                axios
                    .post('{{ Route("searchTieuChiKhoa") }}', payload)
                    .then((res) => {
                        this.list = res.data.data;
                    });
            },
            loadNganh() {
                axios
                    .get('{{ Route("NganhDataKhoa") }}')
                    .then((res) => {
                        this.ds_nganh = res.data.data;
                    });
            },
            loadData() {
                axios
                    .get('{{ Route("dataTieuChiKhoa") }}')
                    .then((res) => {
                        this.list = res.data.data;
                        if (res.data.status == 0) {
                            toastr.error(res.data.message);
                        }
                    });
            },
            themMoi() {
                axios
                    .post('{{ Route("createTieuChiKhoa") }}', this.add)
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
                    .post('{{ Route("deleteTieuChiKhoa") }}', this.del)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message, 'Success');
                            $('#delModal').modal('hide');
                            this.loadData();
                        } else {
                            toastr.error(res.data.message, 'Error');
                        }
                    });
            },
            capNhatTieuChi() {
                axios
                    .post('{{ Route("updateTieuChiKhoa") }}', this.edit)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success("Đã cập nhật Tiêu chí", "Thành công!");
                            $('#editModal').modal('hide');
                            this.loadData();
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
                    .post('{{ Route("statusDuyetTieuChiKhoa") }}', payload)
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
                    .post('{{ Route("statusDuyetTieuChiKhoa") }}', payload)
                    .then((res) => {
                        if (res.data.status) {
                            toastr.success(res.data.message, 'Success');
                            this.loadData();
                        } else {
                            toastr.error(res.data.message, 'Error');
                        }
                    });
            },
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