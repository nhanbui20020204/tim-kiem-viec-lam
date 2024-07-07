@extends('admin.share.share_cuba.master')
@section('content')
    <div class="row" id="app">
        <div class="col-12 text-end mb-2">
            <button type="button" class="btn btn-outline-primary rounded-pill waves-effect py-2" data-bs-toggle="modal"
                data-bs-target="#themAccModal"><i class="fa-solid fa-plus"></i> Thêm Mới</button>
        </div>
        <div class="col-12">
            <div class="modal fade" id="themAccModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Tài Khoản Mới</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Họ Và Tên</label>
                                    <input v-model="them_moi.ho_va_ten" type="text" class="form-control mb-2"
                                        placeholder="Nhập vào họ và tên">
                                </div>
                                <div class="col">
                                    <label class="mb-2">Email</label>
                                    <input v-model="them_moi.email" type="text" class="form-control mb-2"
                                        placeholder="Nhập vào email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Mật Khẩu</label>
                                    <input v-model="them_moi.password" type="password" class="form-control mb-2"
                                        placeholder="Nhập vào mật khẩu">
                                </div>
                                <div class="col">
                                    <label class="mb-2">Quyền</label>
                                    <select class="form-select mb-2" v-model="them_moi.id_quyen">
                                        <option value="0">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Số Điện Thoại</label>
                                    <input v-model="them_moi.so_dien_thoai" type="text" class="form-control mb-2"
                                        placeholder="Nhập vào số điện thoại">
                                </div>
                                <div class="col">
                                    <label class="mb-2">Tình trạng</label>
                                    <select v-model="them_moi.is_open" class="form-select mb-2">
                                        <option value="1" selected>Hoạt động</option>
                                        <option value="0">Khoá</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="themTaiKhoan" v-on:click="themTaiKhoan()" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Danh Sách Admin</h2>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="danh_sach">
                                <thead>
                                    <tr>
                                        <th class="text-center text-nowrap">#</th>
                                        <th class="text-center text-nowrap">Họ và tên</th>
                                        <th class="text-center text-nowrap">Email</th>
                                        <th class="text-center text-nowrap">Số Điện Thoại</th>
                                        <th class="text-center text-nowrap">Mật Khẩu</th>
                                        <th class="text-center text-nowrap">Quyền</th>
                                        <th class="text-center text-nowrap">Tình Trạng</th>
                                        <th class="text-center text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value, key) in list_admin">
                                        <tr>
                                            <th class="text-center text-center">@{{ key + 1 }}</th>
                                            <td class="text-nowrap text-center">@{{ value.ho_va_ten }}</td>
                                            <td class="text-nowrap text-center">@{{ value.email }}</td>
                                            <td class="text-nowrap text-center">@{{ value.so_dien_thoai }}</td>
                                            <td class="text-nowrap text-center">
                                                <button type="button" class="btn btn-primary" v-on:click="new_pass=value"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="fa-solid fa-lock"></i>
                                                </button>

                                            </td>
                                            <td class="text-nowrap text-center">
                                                <span v-if="value.id_quyen==0">Master</span>
                                                <span v-else>@{{ value.ten_quyen }}</span>
                                            </td>
                                            <td class="text-nowrap text-center">
                                                <template v-if="value.is_active == 1">
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-success"
                                                        style="width: 120px">Hoạt
                                                        động</button>
                                                </template>
                                                <template v-else>
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-danger"
                                                        style="width: 120px">Bị
                                                        khóa</button>
                                                </template>
                                            </td>
                                            <td class="text-center text-nowrap">
                                                <button class="btn px-0"><i v-on:click="edit = Object.assign({}, value)"
                                                        class="fa-solid fa-pen-to-square fa-2x text-info"
                                                        data-bs-toggle="modal" data-bs-target="#capNhatModal"
                                                        style="margin-right: 10px"></i></button>
                                                <button class="btn px-0"><i v-on:click="del = value"
                                                        class="fa-solid fa-trash fa-2x text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"></i></button>
                                            </td>
                                        </tr>
                                    </template>
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xóa Admin</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bạn có muốn xóa admin <b>@{{ del.ho_va_ten }}</b>
                                                        này không?</p>
                                                    <p><b>Lưu ý:</b> Thao tác này không thể hoàn tác!!!</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button v-on:click="deleteTaiKhoan()" data-bs-dismiss="modal"
                                                        type="button" class="btn btn-danger">Xác nhận xóa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Đổi Mật Khẩu</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="password" v-model="new_pass.new_password" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                            <button type="button" class="btn btn-primary" v-on:click="doiMatKhau()">Đổi
                                                Mật Khẩu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="capNhatModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col">
                                                <label class="mb-2">Họ Và Tên</label>
                                                <input v-model="edit.ho_va_ten" type="text" class="form-control mb-2"
                                                    placeholder="Nhập vào họ và tên">
                                            </div>
                                            <div class="col">
                                                <label class="mb-2">Email</label>
                                                <input v-model="edit.email" type="text" class="form-control mb-2"
                                                    placeholder="Nhập vào email">
                                            </div>

                                            <div class="col">
                                                <label class="mb-2">Quyền</label>
                                                <select class="form-select mb-2" v-model="edit.id_quyen">
                                                    <option value="0">Admin</option>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label class="mb-2">Số Điện Thoại</label>
                                                <input v-model="edit.so_dien_thoai" type="text"
                                                    class="form-control mb-2" placeholder="Nhập vào số điện thoại">
                                            </div>
                                            <div class="col">
                                                <label class="mb-2">Tình trạng</label>
                                                <select class="form-select mb-2" v-model="edit.is_open">
                                                    <option value="1">Hoạt động</option>
                                                    <option value="0">Khoá</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button id="capNhat" class="btn btn-primary"
                                                v-on:click="updateTaiKhoan()">Update</button>
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
                list_admin: [],
                them_moi: {
                    'email': '',
                    'password': '',
                    'ho_va_ten': '',
                    'so_dien_thoai': '',
                    'id_quyen': '',
                    'is_open': '',
                },
                new_pass: {},
                edit: {},
                del: {},
                search: '',
            },
            created() {
                this.loadData();
            },
            methods: {
                doiMatKhau() {
                    axios
                        .post('{{ Route('doiMatKhau') }}', this.new_pass)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.new_pass.new_password = '';
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
                themTaiKhoan() {
                    axios
                        .post('{{ Route('AdminCreate') }}', this.them_moi)
                        .then((res) => {
                            if (res.data.status) {
                                // toastr.success(res.data.message);
                                toastr.success("Đã thêm mới Admin", "Thành công!");

                                this.loadData();
                                this.them_moi = {};
                                $('#themAccModal').modal('hide');
                            }
                        })
                        .catch((res) => {
                            var errrors = res.response.data.errors;
                            $.each(errrors, function(k, v) {
                                toastr.error(v[0], "Có lỗi!");
                            })

                        });
                },
                loadData() {
                    axios
                        .get('{{ Route('AdminData') }}')
                        .then(res => {
                            this.list_admin = res.data.data;
                        })
                },
                doiTrangThai(state) {
                    axios
                        .post('{{ Route('AdminStatus') }}', state)
                        .then(res => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, 'Success');
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
                updateTaiKhoan() {
                    axios
                        .post('{{ Route('AdminUpdate') }}', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, "Thành công!");
                                this.loadData();
                                $('#capNhatModal').modal('hide');
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
                deleteTaiKhoan() {
                    axios
                        .post('{{ Route('AdminDelete') }}', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success("Đã xóa Admin", "Thành công!");
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
                timKiem() {
                    var payload = {
                        value: this.search
                    }
                    axios
                        .post('{{ Route('AdminSearch') }}', payload)
                        .then(res => {
                            this.list_admin = res.data.data;
                        })
                }
                /*mau_xanh() {
                        $("#themTaiKhoan").removeClass("btn-danger");
                        $("#themTaiKhoan").addClass("btn-primary");
                        $("#themTaiKhoan").removeAttr("disabled");
                        $("#themTaiKhoan").text("Thêm Mới Admin")
                    },

                mau_do() {
                        $("#themTaiKhoan").removeClass("btn-primary");
                        $("#themTaiKhoan").addClass("btn-danger");
                        $("#themTaiKhoan").attr("disabled", true);
                        $("#themTaiKhoan").text("Thêm Mới Admin")
                    },
                mau_xanh_update() {
                        $("#capNhat").removeClass("btn-danger");
                        $("#capNhat").addClass("btn-primary");
                        $("#capNhat").removeAttr("disabled");
                        $("#capNhat").text("Cập nhật")
                    },
                mau_do_update() {
                        $("#capNhat").removeClass("btn-primary");
                        $("#capNhat").addClass("btn-danger");
                        $("#capNhat").attr("disabled", true);
                        $("#capNhat").text("Cập nhật")
                    },*/
            },
        });
    </script>
@endsection
