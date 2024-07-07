@extends('share_khoa.master')
@section('content')
    <div class="row" id="app">
        <div class="col-12 text-end mb-2">
            <button type="button" class="btn btn-outline-primary round waves-effect" data-bs-toggle="modal"
                data-bs-target="#createModal"><i class="fa-solid fa-plus"></i> Thêm Mới</button>
        </div>
        <div class="col-12">
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Thêm Mới Sinh Viên</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Tên Sinh Viên</label>
                                        <input v-model="add.ten_sinh_vien" type="text" class="form-control"
                                            placeholder="Nhập vào tên sinh viên">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Email</label>
                                        <input v-model="add.email" type="text" class="form-control"
                                            placeholder="Nhập vào email">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-1">
                                        <label class="form-label">Password</label>
                                        <input v-model="add.password" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Số Điện Thoại</label>
                                        <input v-model="add.so_dien_thoai" type="number" class="form-control"
                                            placeholder="Nhập vào số điện thoại">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Địa Chỉ</label>
                                        <input v-model="add.dia_chi" type="text" class="form-control"
                                            placeholder="Nhập vào địa chỉ">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Ngành</label>
                                        <select v-model="add.id_nganh" class="form-select">
                                            <option value="">Vui Lòng Chọn</option>
                                            <template v-for="(value, key) in list_nganh">
                                                <option v-bind:value="value.id">@{{ value.ten_nganh }}</option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Mã Số Sinh Viên</label>
                                        <input v-model="add.mssv" type="number" class="form-control"
                                            placeholder="Nhập vào mã số sinh viên">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Lớp cố vấn</label>
                                        <input v-model="add.lop_co_van" type="text" class="form-control"
                                            placeholder="Nhập vào lớp cố vấn">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Giới Tính</label>
                                        <select v-model="add.gioi_tinh" class="form-control">
                                            <option value="">Vui Lòng Chọn</option>
                                            <option value="1">Nam</option>
                                            <option value="0">Nữ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Ngày Sinh</label>
                                        <input v-model="add.ngay_sinh" type="date" class="form-control"
                                            placeholder="Nhập vào ngày sinh">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-2">
                                        <label>Tình trạng</label>
                                        <select v-model="add.is_active" class="form-select">
                                            <option value="">Vui Lòng Chọn</option>
                                            <option value="-1">Bị khoá</option>
                                            <option value="1">Hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" cols="30" rows="5" v-model="add.mo_ta"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="themMoi()" class="btn btn-primary">Thêm Mới Sinh Viên</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Danh Sách Sinh Viên</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="input-group">
                                <button class="btn btn-outline-primary waves-effect" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                                <input v-model="key_search" v-on:keyup.enter="timKiem()" type="text"
                                    class="form-control" placeholder="Nhập vào thông tin cần tìm" aria-label="Amount">
                                <button v-on:click="timKiem()" class="btn btn-outline-primary waves-effect"
                                    type="button">Search !</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Sinh Viên</th>
                                    <th class="text-center align-middle text-nowrap">Email</th>
                                    <th class="text-center align-middle text-nowrap">Số Điện Thoại</th>
                                    <th class="text-center align-middle text-nowrap">Địa Chỉ</th>
                                    <th class="text-center align-middle text-nowrap">Khoa</th>
                                    <th class="text-center align-middle text-nowrap">Ngành</th>
                                    <th class="text-center align-middle text-nowrap">Mã Số Sinh Viên</th>
                                    <th class="text-center align-middle text-nowrap">Giới Tính</th>
                                    <th class="text-center align-middle text-nowrap">Ngày Sinh</th>
                                    <th class="text-center align-middle text-nowrap">Đổi Mật Khẩu</th>
                                    <th class="text-center align-middle text-nowrap">Bảng điểm</th>
                                    <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list">
                                    <tr>
                                        <th class="text-center align-middle text-nowrap">@{{ key + 1 }}</th>
                                        <td class=" align-middle text-nowrap">@{{ value.ten_sinh_vien }}</td>
                                        <td class=" align-middle text-nowrap">@{{ value.email }}</td>
                                        <td class="text-end align-middle text-nowrap">@{{ value.so_dien_thoai }}</td>
                                        <td class=" align-middle text-nowrap">@{{ value.dia_chi }}</td>
                                        {{-- <td class=" align-middle text-nowrap">
                                    <button v-if="value.id_khoa == 0"
                                        class="btn btn-info">CNTT</button>
                                    <button v-else class="btn btn-danger">Quản Trị Kinh Doanh</button>
                                </td> --}}
                                        <td class=" align-middle text-nowrap">@{{ value.ten_khoa }}</td>
                                        <td class=" align-middle text-nowrap">@{{ value.ten_nganh }}</td>
                                        <td class="text-center align-middle text-nowrap">@{{ value.mssv }}</td>
                                        <td class="text-center align-middle text-nowrap">
                                            <button v-if="value.gioi_tinh == 1" class="btn btn-info">Nam</button>
                                            <button v-else class="btn btn-danger">Nữ</button>
                                        </td>
                                        <td class="text-center align-middle text-nowrap">@{{ value.ngay_sinh }}</td>
                                        <td class="text-center align-middle text-nowrap">
                                            <button type="button" @click="newpass=value" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <i class="fa-solid fa-lock"></i>
                                            </button>
                                        </td>
                                        <td class="text-center align-middle text-nowrap">
                                            <form action="/khoa/bang-diem" method="GET">
                                                <input type="text" hidden name="sinh-vien" v-bind:value="value.id" />
                                                <button type="submit" class="btn btn-warning">
                                                    Bảng điểm
                                                </button>
                                            </form>
                                            <!-- <a v-bind:href="'/khoa/bang-diem/' + value.id" type="button">Bảng Điểm</a> -->
                                        </td>
                                        <td class="text-center align-middle text-nowrap">
                                            <button v-on:click="changeStatus(value)" v-if="value.is_active == 0"
                                                class="btn btn-warning">Tạm Tắt</button>
                                            <button v-on:click="changeStatus(value)" v-else class="btn btn-success">Hiển
                                                Thị</button>
                                        </td>
                                        <td class="text-center align-middle text-nowrap">
                                            <i data-bs-toggle="modal" data-bs-target="#editModal"
                                                v-on:click="edit = Object.assign({}, value); "
                                                class="fa-solid fa-pen-to-square fa-2x text-info"
                                                style="margin-right: 10px">
                                            </i>
                                            <i data-bs-toggle="modal" data-bs-target="#delModal"
                                                v-on:click="del = Object.assign({}, value)"
                                                class="fa-solid fa-trash fa-2x text-danger"></i>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="password" v-model="newpass.new_password" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Thoát</button>
                                        <button type="button" @click="doiMatKhau()" class="btn btn-primary">Xác
                                            Nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Sinh Viên</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn chắc chắn muốn xóa <b class="text-danger">@{{ del.ten_sinh_vien }}</b> khỏi danh
                                        sách?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button v-on:click="xoaSinhVien()" type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Xác Nhận Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Sinh Viên</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Tên Sinh Viên</label>
                                                    <input v-model="edit.ten_sinh_vien" type="text"
                                                        class="form-control" placeholder="Nhập vào tên sinh viên">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Email</label>
                                                    <input v-model="edit.email" type="text" class="form-control"
                                                        placeholder="Nhập vào email">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Số Điện Thoại</label>
                                                    <input v-model="edit.so_dien_thoai" type="text"
                                                        class="form-control" placeholder="Nhập vào số điện thoại">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Mã Số Sinh Viên</label>
                                                    <input v-model="edit.mssv" type="number" class="form-control"
                                                        placeholder="Nhập vào mã số sinh viên">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Địa Chỉ</label>
                                                    <input v-model="edit.dia_chi" type="text" class="form-control"
                                                        placeholder="Nhập vào địa chỉ">
                                                </div>
                                            </div>
                                            {{-- <div class="col-3">
                                            <div class="mb-2">
                                                <label>Khoa</label>
                                                <select v-model="edit.id_khoa" class="form-select">
                                                    <option value="">Vui Lòng Chọn</option>
                                                    <template v-for="(value, key) in list_khoa">
                                                        <option v-bind:value="value.id">@{{ value.ten_khoa }}
                                </option>
                                </template>
                                </select>
                            </div>
                        </div> --}}
                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Ngành</label>
                                                    <select v-model="edit.id_nganh" class="form-select">
                                                        <option value="">Vui Lòng Chọn</option>
                                                        <template v-for="(value, key) in list_nganh">
                                                            <option v-bind:value="value.id">@{{ value.ten_nganh }}
                                                            </option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Lớp cố vấn</label>
                                                    <input v-model="edit.lop_co_van" type="text" class="form-control"
                                                        placeholder="Nhập vào lớp cố vấn">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Giới Tính</label>
                                                    <select v-model="edit.gioi_tinh" class="form-control">
                                                        <option value="">Vui Lòng Chọn</option>
                                                        <option value="0">Nam</option>
                                                        <option value="1">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Ngày Sinh</label>
                                                    <input v-model="edit.ngay_sinh" type="date" class="form-control"
                                                        placeholder="Nhập vào ngày sinh">
                                                </div>
                                            </div>
                                            {{-- <div class="col-3">
                                        <div class="mb-2">
                                            <label>Tình Trạng</label>
                                            <select v-model="edit.is_active" class="form-control">
                                                <option value="0">Tạm Tắt</option>
                                                <option value="1">Hiển Thị</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                            <div class="col-3">
                                                <div class="mb-2">
                                                    <label>Tình trạng</label>
                                                    <select v-model="edit.is_active" class="form-control">
                                                        <option value="">Vui Lòng Chọn</option>
                                                        <option value="-1">Bị khoá</option>
                                                        <option value="1">Hoạt động</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-2">
                                                    <label>Mô tả</label>
                                                    <textarea class="form-control" cols="30" rows="5" v-model="edit.mo_ta"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button v-on:click="updateSinhVien()" type="button" class="btn btn-primary">Cập
                                            Nhật</button>
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
                    'id_khoa': "",
                    "gioi_tinh": "",
                },
                list: [],
                edit: {},
                del: {},
                slug: '',
                slug_edit: '',
                key_search: '',
                list_khoa: [],
                list_nganh: [],
                newpass: {},
            },
            created() {
                this.loadData();
                this.getNganh();
            },
            methods: {
                doiMatKhau() {
                    axios
                        .post('{{ Route('doiMatKhauKhoa') }}', this.newpass)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.newpass.new_password = {};
                                $("#exampleModal").modal('hide');

                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                getNganh() {
                    axios
                        .get('{{ Route('NganhDataKhoa') }}')
                        .then((res) => {
                            this.list_nganh = res.data.data;
                        });
                },
                timKiem() {
                    var payload = {
                        'gia_tri': this.key_search,
                    };
                    axios
                        .post('{{ Route('searchSinhvienKhoa') }}', payload)
                        .then((res) => {
                            this.list = res.data.data;
                            // console.log(this.list);
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                updateSinhVien() {
                    axios
                        .post('{{ Route('updateSinhvienKhoa') }}', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadData();
                                $("#editModal").modal('hide');
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                changeStatus(value) {
                    axios
                        .post('{{ Route('statusSinhvienKhoa') }}', value)
                        .then((res) => {
                            if (res.data.status) {
                                this.loadData();
                                toastr.success(res.data.message);
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },


                xoaSinhVien() {
                    axios
                        .post('{{ Route('deleteSinhvienKhoa') }}', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                this.timKiem();
                                toastr.success(res.data.message);
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },

                loadData() {
                    axios
                        .get('{{ Route('dataSinhvienKhoa') }}')
                        .then((res) => {
                            this.list = res.data.data;

                        });
                },
                themMoi() {
                    axios
                        .post('{{ Route('createSinhvienKhoa') }}', this.add)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.add = {};
                                $("#createModal").modal('hide');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((res) => {
                            var errrors = res.response.data.errors;
                            $.each(errrors, function(k, v) {
                                toastr.error(v[0], "Có lỗi!");
                            })
                        });
                },
            },
        });
    </script>
@endsection
