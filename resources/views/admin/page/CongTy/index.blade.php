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
                            <h5 class="modal-title" id="exampleModalLabel"> Thêm Mới Công Ty</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-1">
                                        <label class="form-label">Tên Công Ty</label>
                                        <input v-model="add.ten_cong_ty" v-on:keyup="nameToSlugCreate()" type="text"
                                            class="form-control" placeholder="Nhập tên công ty">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-1">
                                        <label class="form-label">Slug Công Ty</label>
                                        <input disabled v-model="add.slug_cong_ty" type="text" class="form-control"
                                            placeholder="Nhập slug công ty">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-1">
                                        <label class="form-label">Địa Chỉ</label>
                                        <input v-model="add.dia_chi" type="email" class="form-control"
                                            placeholder="Nhập Địa Chỉ">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-1">
                                        <label class="form-label">Số Điện Thoại</label>
                                        <input v-model="add.so_dien_thoai" type="text" class="form-control"
                                            placeholder="Nhập số điện thoại">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label class="form-label">Email</label>
                                            <input v-model="add.email" type="email" class="form-control"
                                                placeholder="Nhập Email">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label class="form-label">Password</label>
                                            <input v-model="add.password" type="text" class="form-control"
                                                placeholder="Nhập password">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label class="form-label">Mô tả</label>
                                            <input v-model="add.mo_ta" type="text" class="form-control"
                                                placeholder="Nhập mô tả">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label class="form-label">Link Website</label>
                                            <input v-model="add.website" type="text" class="form-control"
                                                placeholder="Nhập link website">
                                        </div>
                                    </div>
                                    <div class="col-4">
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
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label class="form-label">Hình ảnh</label>
                                            <input v-on:change="getFile($event)" type="file" class="form-control" />
                                        </div>
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
                    <h2>Danh Sách Công Ty</h2>
                    {{-- <th class="dropdown nav-item"><a class=" nav-link d-flex align-items-center"
                            href="/admin/tieu-chi"><i data-feather="package"></i><span data-i18n="Apps">Tiêu
                                Chí</span></a>
                    </th> --}}
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
                                        <th class="text-center text-nowrap">Tên Công Ty</th>
                                        <th class="text-center text-nowrap"
                                            style="padding-right: 11rem;padding-left: 11rem;">Địa Chỉ</th>
                                        <th class="text-center text-nowrap">Số Điện Thoại</th>
                                        <th class="text-center text-nowrap">Hình Ảnh</th>
                                        <th class="text-center text-nowrap">Email</th>
                                        <th class="text-center text-nowrap">Mô Tả</th>
                                        <th class="text-center text-nowrap"
                                            style="padding-right: 11rem;padding-left: 11rem;">Link Website</th>
                                        <th class="text-center text-nowrap">Tình Trạng</th>
                                        <th class="text-center text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value, key) in list">
                                        <tr>
                                            <th class="text-center">@{{ key + 1 }}</th>
                                            <td class="text-nowrap text-center">@{{ value.ten_cong_ty }}</td>
                                            <td>@{{ value.dia_chi }}</td>
                                            <td class="text-nowrap text-end">@{{ value.so_dien_thoai }}</td>
                                            <td class="text-nowrap text-center">
                                                <img class="img-fluid" v-bind:src="value.hinh_anh" alt="">
                                            </td>
                                            <td class="text-nowrap text-center">@{{ value.email }}</td>
                                            <td class="text-nowrap text-center"><button type="button"
                                                    class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" @click="mo_ta = value">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </button></td>
                                            <td>@{{ value.website }}</td>
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
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mô Tả</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @{{ mo_ta.mo_ta }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật Công Ty</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Tên Công Ty</label>
                                                        <input v-model="edit.ten_cong_ty" v-on:keyup="nameToSlugUpdate()"
                                                            type="text" class="form-control"
                                                            placeholder="Nhập tên công ty">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Slug Công Ty</label>
                                                        <input disabled v-model="edit.slug_cong_ty" type="text"
                                                            class="form-control" placeholder="Nhập slug công ty">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="mb-1">
                                                        <label class="form-label">Địa Chỉ</label>
                                                        <input v-model="edit.dia_chi" type="email" class="form-control"
                                                            placeholder="Nhập Địa Chỉ">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label class="form-label">Email</label>
                                                            <input v-model="edit.email" type="email"
                                                                class="form-control" placeholder="Nhập Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label class="form-label">Mô tả</label>
                                                            <input v-model="edit.mo_ta" type="text"
                                                                class="form-control" placeholder="Nhập mô tả">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label class="form-label">Số Điện Thoại</label>
                                                            <input v-model="edit.so_dien_thoai" type="text"
                                                                class="form-control" placeholder="Nhập số điện thoại">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="mb-1">
                                                            <label class="form-label">Link Website</label>
                                                            <input v-model="edit.website" type="text"
                                                                class="form-control" placeholder="Nhập link website">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label class="form-label">Tình Trạng</label>
                                                            <select v-model="edit.is_active" class="form-select">
                                                                <option value="-1">Bị khóa</option>
                                                                <option value="1">Hoạt động</option>
                                                                <option value="0">Chưa kích hoạt</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label class="form-label">Hình ảnh</label>
                                                            <img v-bind:src="edit.hinh_anh"
                                                                style="width: 50px;height: 50px;" alt="">
                                                            <input type="file" class="form-control"
                                                                v-on:change="getFileEdit($event)">
                                                        </div>
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
                        'ten_cong_ty': '',
                        'slug_cong_ty': '',
                        'dia_chi': '',
                        'so_dien_thoai': '',
                        'hinh_anh': '',
                        'email': '',
                        'mo_ta': '',
                        'password': '',
                        'is_active': '#'
                    },
                    del: {},
                    edit: {},
                    mo_ta: {},
                },
                created() {
                    this.getData();
                },
                methods: {
                    getFile(e) {
                        this.add.hinh_anh = e.target.files[0];
                    },
                    getFileEdit(e) {
                        this.edit.hinh_anh = e.target.files[0];
                    },
                    checkSlugUpdate() {
                        axios
                            .post(' {{ Route('checkSlugUpdateChuyen') }} ', this.edit)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, "Thành công!");
                                } else {
                                    toastr.error(res.data.message, "Có lỗi!");
                                }
                            });
                    },
                    getData() {
                        axios
                            .get('{{ Route('dataCongTy') }}')
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    timKiem() {
                        var payload = {
                            'gia_tri': this.key_search
                        };
                        axios
                            .post('{{ Route('searchCongTy') }}', payload)
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    doiTrangThai(payload) {
                        axios
                            .post('{{ Route('statusCongTy') }}', payload)
                            .then((res) => {
                                this.timKiem();
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
                        } else {
                            const formData = new FormData();
                            for (let key in this.add) {
                                formData.append(key, this.add[key]);
                            }
                            axios
                                .post('{{ Route('createCongTy') }}', formData, {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                })
                                .then((res) => {
                                    if (res.data.status) {
                                        toastr.success("Đã thêm mới Công Ty", "Thành công!");
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
                                });
                        }
                    },
                    destroy() {
                        axios
                            .post('{{ Route('deleteCongTy') }}', this.del)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success("Đã xóa Công Ty", "Thành công!");
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
                        } else {
                            const formData = new FormData();
                            for (let key in this.edit) {
                                formData.append(key, this.edit[key]);
                            }
                            axios
                                .post('{{ Route('updateCongTy') }}', formData, {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                })
                                .then((res) => {
                                    if (res.data.status == 1) {
                                        toastr.success("Đã cập nhật Công Ty",
                                            "Thành công!");
                                        this.getData();
                                        $('#editModal').modal('hide');
                                    } else {
                                        toastr.error(res.data.message, "Có lỗi!");
                                    }
                                })
                                .catch((res) => {
                                    var errrors = res.response.data.errors;
                                    $.each(errrors, function(k, v) {
                                        toastr.error(v[0], "Có lỗi!");
                                    })
                                });
                        }
                    },
                    toSlug(str) {
                        str = str.toLowerCase();
                        str = str
                            .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                            .replace(/[\u0300-\u036f]/g,
                                ''); // xóa các ký tự dấu sau khi tách tổ hợp
                        str = str.replace(/[đĐ]/g, 'd');
                        str = str.replace(/([^0-9a-z-\s])/g, '');
                        str = str.replace(/(\s+)/g, '-');
                        str = str.replace(/-+/g, '-');
                        str = str.replace(/^-+|-+$/g, '');
                        return str;
                    },
                    nameToSlugCreate() {
                        this.add.slug_cong_ty = this.toSlug(this.add.ten_cong_ty);
                    },
                    nameToSlugUpdate() {
                        this.edit.slug_cong_ty = this.toSlug(this.edit.ten_cong_ty);
                    },
                },
            });
        })
    </script>
@endsection
