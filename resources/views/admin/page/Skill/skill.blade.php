@extends('admin.share.share_cuba.master')
@section('content')
    <div id="app" class="row">
        <div class="col-12 text-end mb-2">
            <button type="button" class="btn btn-outline-primary rounded-pill waves-effect py-2" data-bs-toggle="modal"
                data-bs-target="#createModal"><i class="fa-solid fa-plus"></i> Thêm Mới</button>
        </div>
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2>Thêm mới danh mục Skills</h2>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>

                                                </thead>
                                                <tbody>
                                                    <div class="mb-1">
                                                        <label class="form-label">Tên Skils</label>
                                                        <input v-on:keyup="nameToSlugCreate()" v-model="add.ten_skill"
                                                            type="text" class="form-control"
                                                            placeholder="Nhập tên danh mục">
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label">Slug danh Skils</label>
                                                        <input disabled v-model="slug" type="text" class="form-control"
                                                            placeholder="Nhập slug danh mục">
                                                    </div>
                                                    <div class="mb-1">
                                                        <label class="form-label">Tình Trạng</label>
                                                        <select v-model="add.tinh_trang" class="form-select">
                                                            <option value="1">Hoạt động</option>
                                                            <option value="0">Chưa kích hoạt</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button v-on:click="themMoi()"
                                                            class="btn btn-primary"data-bs-dismiss="modal">Thêm Mới
                                                            Skils</button>
                                                    </div>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Danh Sách Danh Mục</h2>
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
                                <input v-model="key_search" v-on:keyup.enter="timKiem()" type="text" class="form-control"
                                    placeholder="Nhập vào thông tin cần tìm" aria-label="Amount">
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
                                        <th class="text-center text-nowrap">STT</th>
                                        <th class="text-center text-nowrap">Tên Skils</th>
                                        <th class="text-center text-nowrap">Slug Skils</th>
                                        <th class="text-center text-nowrap">Tình Trạng</th>
                                        <th class="text-center text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(value, key) in list">
                                        <tr>
                                            <th class="text-center">@{{ key + 1 }}</th>
                                            <td class="text-nowrap">@{{ value.ten_skill }}</td>
                                            <td class="text-nowrap">@{{ value.slug_skill }}</td>
                                            <td class="text-nowrap text-center">
                                                {{-- <button class="btn btn-warning"style="width: 160px"></button> --}}
                                                <template v-if="value.tinh_trang == 0">
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-warning"
                                                        style="width: 160px">Chưa
                                                        kích hoạt</button>
                                                </template>
                                                <template v-else-if="value.tinh_trang== 1">
                                                    <button v-on:click="doiTrangThai(value)" class="btn btn-success"
                                                        style="width: 160px">Hoạt
                                                        động</button>
                                                </template>
                                            </td>
                                            <td class="text-nowrap align-middle text-center">
                                                <button class="btn px-0"><i
                                                        v-on:click="edit =  value ; slug_edit = edit.slug_skill"
                                                        class="fa-solid fa-pen-to-square fa-2x text-info"
                                                        data-bs-toggle="modal" data-bs-target="#updateModal"
                                                        style="margin-right: 10px"></i></button>
                                                <button class="btn px-0"><i v-on:click="del = value"
                                                        class="fa-solid fa-trash fa-2x text-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"></i></button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Xóa Danh Mục</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có muốn xóa danh mục <b>@{{ del.ten_skill }}</b>
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
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật Danh Mục</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-1">
                                        <label class="form-label">Tên Skils</label>
                                        <input v-on:keyup="nameToSlugUpdate()" v-model="edit.ten_skill" type="text"
                                            class="form-control" placeholder="Nhập tên danh mục">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Slug Skils</label>
                                        <input disabled v-model="slug_edit" type="text" class="form-control"
                                            placeholder="Nhập slug danh mục">
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label">Tình Trạng</label>
                                        <select v-model="edit.tinh_trang" class="form-select">
                                            <option value="1">Hoạt động</option>
                                            <option value="0">Chưa kích hoạt</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button v-on:click="capnhat()"type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Cập nhật</button>
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
                        'ten_skill': '',
                        'slug_skill': '',
                        'tinh_trang': 1,
                    },
                    del: {},
                    edit: {},
                    slug: '',
                    slug_edit: '',
                    list_khoa: [],
                },
                created() {
                    this.loadData();
                },
                methods: {
                    loadData() {
                        axios
                            .get('{{ Route('dataSkill') }}')
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    themMoi() {
                        this.add.slug_skill = this.slug;
                        console.log(this.add);
                        axios
                            .post('{{ Route('createSkill') }}', this.add)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success("Đã thêm mới Danh Mục", "Thành công!");
                                    this.loadData();
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
                    },
                    destroy() {
                        axios
                            .post('{{ Route('deleteSkill') }}', this.del)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, 'Success');
                                    $('#deleteModal').modal('hide');
                                    this.timKiem();
                                } else {
                                    toastr.error(res.data.message, 'Error');
                                }
                            });
                    },
                    capnhat() {
                        this.edit.slug_skill = this.slug_edit;
                        axios
                            .post('{{ Route('updateSkill') }}', this.edit)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success("Đã cập nhật Danh Mục", "Thành công!");
                                    $('#updateModal').modal('hide');
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
                            .post('{{ Route('statusSkill') }}', payload)
                            .then((res) => {
                                this.timKiem();
                                toastr.warning("Đã đổi trạng thái", "Thành Công!")
                            });
                    },
                    timKiem() {
                        var payload = {
                            'gia_tri': this.key_search
                        };
                        axios
                            .post('{{ Route('searchSkill') }}', payload)
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                    nameToSlugCreate() {
                        this.slug = this.toSlug(this.add.ten_skill);
                    },
                    nameToSlugUpdate() {
                        this.slug_edit = this.toSlug(this.edit.ten_skill);
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
        })
    </script>
@endsection
