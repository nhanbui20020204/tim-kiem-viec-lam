@extends('share_congty.master')
@section('content')
    <div class="row" id="app">
        <div class="col-12 text-end mb-2">
            <button type="button" class="btn btn-outline-primary round waves-effect" data-bs-toggle="modal"
                data-bs-target="#createModal"><i class="fa-solid fa-plus"></i> Thêm Mới</button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Danh Sách Sinh Viên Đã Mail</h2>
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
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Sinh Viên</th>
                                    <th class="text-center align-middle text-nowrap">Email</th>
                                    <th class="text-center align-middle text-nowrap">Số Điện Thoại</th>
                                    <th class="text-center align-middle text-nowrap">Địa Chỉ</th>
                                    <th class="text-center align-middle text-nowrap">Thời Gian</th>
                                    <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                    <th class="text-center align-middle text-nowrap">Nội Dung</th>
                                    <th class="text-center align-middle text-nowrap">Tình trạng nhân viên</th>
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
                                        <td class=" align-middle text-nowrap">@{{ value.thoi_gian }}</td>
                                        <td class="text-center align-middle text-nowrap">
                                            <button v-if="value.tinh_trang == 1" class="btn btn-success">Đã xác nhận phỏng
                                                vấn</button>
                                            <button v-else-if="value.tinh_trang == -1" class="btn btn-danger">Đã từ chối
                                                phỏng
                                                vấn</button>
                                            <button v-else class="btn btn-warning">Đang đợi phản hồi</button>
                                        </td>
                                        <td class="text-center align-middle text-nowrap">
                                            <i v-on:click="noi_dung = value.noi_dung"
                                                class="fa-solid fa-circle-info fa-2x text-info" data-bs-toggle="modal"
                                                data-bs-target="#noiDungModal"></i>
                                        </td>
                                        <td class="text-center align-middle text-nowrap">
                                            <button @click="doiTrangThai(value)" v-if=" value.is_accept==1"
                                                class="btn btn-success">Đã được nhận</button>
                                            <button @click="doiTrangThai(value)" v-else-if="value.is_accept == 0"
                                                class="btn btn-warning">Đang phỏng vấn</button>
                                            <button @click="doiTrangThai(value)" v-else-if="value.is_accept == -2"
                                                class="btn btn-secondary">Từ chối
                                                phỏng
                                                vấn</button>
                                            <button @click="doiTrangThai(value)" v-else class="btn btn-danger">Không được
                                                nhận</button>
                                        </td>
                                        <td class="text-center align-middle text-nowrap">
                                            <i data-bs-toggle="modal" data-bs-target="#delModal" v-on:click="del = value"
                                                class="fa-solid fa-trash fa-2x text-danger"></i>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <div class="modal fade" id="noiDungModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nội dung
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @{{ noi_dung }}
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Gửi Mail</h1>
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
                        "tinh_trang": 1,
                    },
                    noi_dung: '',
                    list: [],
                    edit: {},
                    del: {},
                    slug: '',
                    slug_edit: '',
                    key_search: '',
                },
                created() {
                    this.loadData();
                },
                methods: {
                    timKiem() {
                        var payload = {
                            'gia_tri': this.key_search,
                        };
                        axios
                            .post('{{ Route('searchGuiMail') }}', payload)
                            .then((res) => {
                                this.list = res.data.data;
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    doiTrangThai(payload) {
                        axios
                            .post('{{ Route('statusSinhVienMail') }}', payload)
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
                            .post('{{ Route('deleteGuiMail') }}', this.del)
                            .then((res) => {
                                if (res.data.status) {
                                    this.loadData();
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
                            .get('{{ Route('DataGuiMail') }}')
                            .then((res) => {
                                this.list = res.data.data;
                            });
                    },
                },
            });
        </script>
    @endsection
