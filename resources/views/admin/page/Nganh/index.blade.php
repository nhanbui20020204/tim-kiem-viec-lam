@extends('admin.share.share_cuba.master')
@section('content')
    <div class="row" id="app">
        <div class="col-12 text-end mb-2">
            <button type="button" class="btn btn-outline-primary rounded-pill waves-effect py-2" data-bs-toggle="modal"
                data-bs-target="#themNganh"><i class="fa-solid fa-plus"></i> Thêm Mới</button>
        </div>
        <div class="col-12">
            <div class="modal fade" id="themNganh" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm Mới Ngành</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Tên ngành</label>
                                    <input v-on:keyup="nameToSlugCreate()" v-model="them_moi.ten_nganh" type="text"
                                        class="form-control mb-2" placeholder="Nhập vào tên ngành">
                                </div>
                                <div class="col">
                                    <label class="mb-2">Slug ngành</label>
                                    <input disabled v-model="slug" type="text" class="form-control mb-2"
                                        placeholder="Nhập vào slug ngành">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="mb-2">Khoa</label>
                                    <select v-model="them_moi.id_khoa" class="form-select">
                                        <template v-for="(va, ke) in ds_khoa">
                                            <option v-bind:value="va.id">@{{ va.ten_khoa }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="mb-2">Tình trạng</label>
                                    <select class="form-select mb-2" v-model="them_moi.is_open">
                                        <option value="0">Khoá</option>
                                        <option value="1">Hoạt động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" v-on:click="themNganh()">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2>Danh Sách Ngành</h2>
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
                                <input v-model="search" v-on:keyup.enter="timKiem()" v-on:blur="timKiem()" type="text"
                                    class="form-control" placeholder="Nhập vào thông tin cần tìm" aria-label="Amount">
                                <button v-on:click="timKiem()" class="btn btn-outline-primary waves-effect"
                                    type="button">Search !</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="danh_sach">
                                <thead>
                                    <tr>
                                        <th class="text-center text-nowrap">#</th>
                                        <th class="text-center text-nowrap">Tên ngành</th>
                                        <th class="text-center text-nowrap">Slug ngành</th>
                                        <th class="text-center text-nowrap">Khoa</th>
                                        <th class="text-center text-nowrap">Tình trạng</th>
                                        <th class="text-center text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value, key) in list_nganh">
                                        <tr>
                                            <th class="text-center text-center">@{{ key + 1 }}</th>
                                            <td class="text-nowrap text-center">@{{ value.ten_nganh }}</td>
                                            <td class="text-nowrap text-center">@{{ value.slug_nganh }}</td>
                                            <td class="text-nowrap text-center">@{{ value.ten_khoa }}</td>
                                            <td class="text-nowrap text-center">
                                                <template v-if="value.is_open == 1">
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
                                                    <p>Bạn có muốn xóa ngành <b>@{{ del.ten_nganh }}</b>
                                                        này không?</p>
                                                    <p><b>Lưu ý:</b> Thao tác này không thể hoàn tác!!!</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button v-on:click="deleteNganh()" data-bs-dismiss="modal"
                                                        type="button" class="btn btn-danger">Xác nhận xóa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                            <div class="modal fade" id="capNhatModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cập nhật</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="mb-2">Tên ngành</label>
                                                    <input v-on:keyup="nameToSlugUpdate()" v-model="edit.ten_nganh"
                                                        type="text" class="form-control mb-2"
                                                        placeholder="Nhập vào tên ngành">
                                                </div>
                                                <div class="col">
                                                    <label class="mb-2">Slug ngành</label>
                                                    <input disabled v-model="edit.slug_nganh" type="text"
                                                        class="form-control mb-2" placeholder="Nhập vào slug-ngành">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="mb-2">Khoa</label>
                                                    <select v-model="edit.id_khoa" class="form-select">
                                                        <template v-for="(va, ke) in ds_khoa">
                                                            <option v-bind:value="va.id">@{{ va.ten_khoa }}</option>
                                                        </template>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label class="mb-2">Tình trạng</label>
                                                    <select class="form-select mb-2" v-model="edit.is_open">
                                                        <option value="0">Khoá</option>
                                                        <option value="1">Hoạt động</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"
                                                v-on:click="updateNganh()">Update</button>
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
                list_nganh: [],
                them_moi: {},
                edit: {},
                del: {},
                search: '',
                ds_khoa: [],
                slug: '',
                slug_edit: '',
            },
            created() {
                this.loadData();
                this.loadKhoa();
            },
            methods: {
                themNganh() {
                    this.them_moi.slug_nganh = this.slug;
                    axios
                        .post('{{ Route('NganhCreate') }}', this.them_moi)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success("Đã thêm mới Ngành", "Thành công!");
                                this.loadData();
                                this.add = {};
                                $('#themNganh').modal('hide');
                            }
                        })
                        .catch((res) => {
                            var errrors = res.response.data.errors;
                            $.each(errrors, function(k, v) {
                                toastr.error(v[0], "Có lỗi!");
                            })
                        });
                },
                loadKhoa() {
                    axios
                        .get('{{ Route('dataKhoa') }}')
                        .then((res) => {
                            this.ds_khoa = res.data.data;
                        });
                },
                loadData() {
                    axios
                        .get('{{ Route('NganhData') }}')
                        .then(res => {
                            this.list_nganh = res.data.data;
                        })
                },
                doiTrangThai(state) {
                    axios
                        .post('{{ Route('NganhStatus') }}', state)
                        .then(res => {
                            toastr.success(res.data.message, 'Success');
                            this.loadData();
                        })
                },
                updateNganh() {
                    this.edit.slug_nganh = this.edit.slug_nganh;
                    axios
                        .post('{{ Route('NganhUpdate') }}', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success("Đã cập nhật Ngành", "Thành công!");
                                $('#capNhatModal').modal('hide');
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
                deleteNganh() {
                    axios
                        .post('{{ Route('NganhDelete') }}', this.del)
                        .then(res => {
                            toastr.success(res.data.message, 'Success');
                            $('#deleteModal').modal('hide');
                            this.loadData();
                        })
                },
                timKiem() {
                    var payload = {
                        value: this.search
                    }
                    axios
                        .post('{{ Route('NganhSearch') }}', payload)
                        .then(res => {
                            this.list_nganh = res.data.data;
                        })
                },
                nameToSlugCreate() {
                    this.slug = this.toSlug(this.them_moi.ten_nganh);
                },
                nameToSlugUpdate() {
                    this.edit.slug_nganh = this.toSlug(this.edit.ten_nganh);
                },
                toSlug(str) {
                    str = str.toLowerCase();
                    str = str
                        .normalize('NFD') // chuyển chuỗi sang unicode tổ hợp
                        .replace(/[\u0300-\u036f]/g, ''); // xóa các ký tự dấu sau khi tách tổ hợp
                    str = str.replace(/[đĐ]/g, 'd');
                    str = str.replace(/([^0-9a-z-\s])/g, '');
                    str = str.replace(/(\s+)/g, '-');
                    str = str.replace(/-+/g, '-');
                    str = str.replace(/^-+|-+$/g, '');
                    return str;
                },
            },
        });
    </script>
@endsection
