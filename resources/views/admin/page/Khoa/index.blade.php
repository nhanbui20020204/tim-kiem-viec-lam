@extends('admin.share.share_cuba.master')
@section('content')
    <div id="app" class="row">
        <div class="col-12 text-end mb-2">
            <button type="button" class="btn btn-outline-primary rounded-pill py-2 waves-effect" data-bs-toggle="modal"
                data-bs-target="#createModal"><i class="fa-solid fa-plus"></i> Thêm Mới</button>
        </div>
        <div class="col-12">
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Thêm Mới Khoa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-1">
                                        <label class="form-label">Tên khoa</label>
                                        <input v-model="add.ten_khoa" type="text" class="form-control"
                                            placeholder="Nhập tên Khoa">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-1">
                                        <label class="form-label">Số Điện Thoại</label>
                                        <input v-model="add.so_dien_thoai" type="text" class="form-control"
                                            placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-1">
                                        <label class="form-label">Địa Chỉ</label>
                                        <input v-model="add.dia_chi" type="text" class="form-control"
                                            placeholder="Nhập Địa Chỉ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label class="form-label">Email</label>
                                        <input v-model="add.email" type="email" class="form-control"
                                            placeholder="Nhập Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label class="form-label">Password</label>
                                        <input v-model="add.password" type="text" class="form-control"
                                            placeholder="Nhập password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label class="form-label">Tình Trạng</label>
                                        <select v-model="add.is_active" class="form-select">
                                            <option value="#">Vui lòng chọn</option>
                                            <option value="-1">Bị khóa</option>
                                            <option value="0">Chưa kích hoạt</option>
                                            <option value="1">Hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <label class="form-label">Website</label>
                                        <input v-model="add.link_website" type="text" class="form-control"
                                            placeholder="Nhập password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="themMoi" v-on:click="themMoi()" class="btn btn-primary"
                                data-bs-dismiss="modal">Thêm
                                Mới Khoa</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Danh Sách Khoa</h2>

                    {{-- <div class="row">
                        <th class="sidebar-list"><a class="sidebar-link sidebar-title link-nav" href="/admin/nganh"><i
                                    data-feather="airplay"></i><span>Ngành</span></a></th>
                        <th><a class="d-flex align-items-center" href="http://127.0.0.1:8000/admin/bang-diem"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="bangdiem">Bảng Điểm</span></a>
                        </th>
                    </div> --}}

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
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center text-nowrap">#</th>
                                        <th class="text-center text-nowrap">Tên Khoa</th>
                                        <th class="text-center text-nowrap">Số Điện Thoại</th>
                                        <th class="text-center text-nowrap">Địa Chỉ</th>
                                        <th class="text-center text-nowrap">Email</th>
                                        <th class="text-center text-nowrap">Website</th>
                                        <th class="text-center text-nowrap">Tình Trạng</th>
                                        <th class="text-center text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value, key) in list">
                                        <tr>
                                            <th class="text-center">@{{ key + 1 }}</th>
                                            <td class="text-nowrap text-center">@{{ value.ten_khoa }}</td>
                                            <td class="text-nowrap text-center">@{{ value.so_dien_thoai }}</td>
                                            <td class="text-nowrap text-center">@{{ value.dia_chi }}</td>
                                            <td class="text-nowrap text-center">@{{ value.email }}</td>
                                            <td class="text-nowrap text-center">@{{ value.link_website }}</td>
                                            <td class="text-nowrap text-center">
                                                <template v-if="value.is_active == 0">
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-warning"
                                                        style="width: 160px">Chưa
                                                        kích hoạt</button>
                                                </template>
                                                <template v-else-if="value.is_active == 1">
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-success"
                                                        style="width: 160px">Hoạt
                                                        động</button>
                                                </template>
                                                <template v-else>
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-danger"
                                                        style="width: 160px">Bị
                                                        khóa</button>
                                                </template>
                                            </td>
                                            <td class="text-nowrap text-center">
                                                <button class="btn">
                                                    <i v-on:click="edit = Object.assign({}, value)"
                                                        class="fa-solid fa-pen-to-square fa-2x text-info"
                                                        data-bs-toggle="modal" data-bs-target="#updateModal"></i>
                                                </button>
                                                <button class="btn">
                                                    <i v-on:click="del = value"
                                                        class="fa-solid fa-trash fa-2x text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật Khoa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Tên Khoa</label>
                                                        <input v-model="edit.ten_khoa" type="text"
                                                            class="form-control" placeholder="Nhập tên khoa">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Số Điện Thoại</label>
                                                        <input v-model="edit.so_dien_thoai" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Địa chỉ</label>
                                                        <input v-model="edit.dia_chi" class="form-control"
                                                            type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Email</label>
                                                        <input v-model="edit.email" type="email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Website</label>
                                                        <input v-model="edit.link_website" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Tình Trạng</label>
                                                        <select v-model="edit.is_active" class="form-select">
                                                            <option value="#">Vui lòng chọn</option>
                                                            <option value="-1">Bị khóa</option>
                                                            <option value="0">Chưa kích hoạt</option>
                                                            <option value="1">Hoạt động</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button id="capNhat" v-on:click="update()" type="button"
                                                class="btn btn-primary" data-bs-dismiss="modal">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xóa Khoa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có muốn xóa Khoa <b>@{{ del.ten_khoa }}</b>
                                                này không?</p>
                                            <p><b>Lưu ý:</b> Thao tác này không thể hoàn tác!!!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button v-on:click="destroy()" data-bs-dismiss="modal" type="button"
                                                class="btn btn-danger">Xác nhận xóa</button>
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
        $(document).ready(function() {
            new Vue({
                el: '#app',
                data: {
                    list: [],
                    key_search: '',
                    add: {
                        is_active: '#'
                    },
                    del: {},
                    edit: {
                        is_active: '#'
                    },
                },
                created() {
                    this.getData();
                },
                methods: {
                    getData() {
                        axios
                            .get('{{ Route('dataKhoa') }}')
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    timKiem() {
                        var payload = {
                            'gia_tri': this.key_search
                        };
                        axios
                            .post('{{ Route('searchKhoa') }}', payload)
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    doiTrangThai(payload) {
                        axios
                            .post('{{ Route('statusKhoa') }}', payload)
                            .then((res) => {
                                toastr.success("Đã đổi trạng thái", "Thành Công!");
                                this.getData();
                            });
                    },
                    validateEmail(email) {
                        const pattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|[^.]+\.edu\.vn)$/;
                        return pattern.test(email);
                    },
                    themMoi() {
                        if (!this.validateEmail(this.add.email)) {
                            toastr.error('Format email is wrong!!', 'Error');
                            return;
                        } else
                            axios
                            .post('{{ Route('createKhoa') }}', this.add)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success("Đã thêm mới Khoa", "Thành công!");
                                    this.getData();
                                    this.add = {};
                                    $('#createModal').modal('hide');
                                }
                            })
                            .catch((res) => {
                                var errrors = res.response.data.errors;
                                $.each(errrors, function(k, v) {
                                    toastr.error(v[0], "Có lỗi!");
                                })
                            })
                    },
                    destroy() {
                        axios
                            .post('{{ Route('deleteKhoa') }}', this.del)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success("Đã xóa Khoa", "Thành công!");
                                    this.getData();
                                }
                            })
                            .catch((res) => {
                                var errrors = res.response.data.errors;
                                $.each(errrors, function(k, v) {
                                    toastr.error(v[0], "Có lỗi!");
                                })
                            });
                    },
                    update() {
                        if (!this.validateEmail(this.edit.email)) {
                            toastr.error('Format email is wrong!!', 'Error');
                            return;
                        } else
                            axios
                            .post('{{ Route('updateKhoa') }}', this.edit)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success("Đã cập nhật Khoa", "Thành công!");
                                    this.getData();
                                    $('#updateModal').modal('hide');
                                } else {
                                    toastr.error(res.data.message, "Lỗi");
                                }
                            })
                            .catch((res) => {
                                var errrors = res.response.data.errors;
                                $.each(errrors, function(k, v) {
                                    toastr.error(v[0], "Có lỗi!");
                                })
                            });
                    },
                    mau_xanh() {
                        $("#themMoi").removeClass("btn-danger");
                        $("#themMoi").addClass("btn-primary");
                        $("#themMoi").removeAttr("disabled");
                        $("#themMoi").text("Thêm Mới Khoa")
                    },

                    mau_do() {
                        $("#themMoi").removeClass("btn-primary");
                        $("#themMoi").addClass("btn-danger");
                        $("#themMoi").attr("disabled", true);
                        $("#themMoi").text("Thêm Mới Khoa")
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
                    },
                },
            });
        })
    </script>
@endsection
