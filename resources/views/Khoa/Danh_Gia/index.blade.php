@extends('share_khoa.master')
@section('content')
    <div class="row" id="app">

        <div class="col-12">
            <div class="card border-danger border-bottom border-3 border-0">
                <div class="card-header">
                    <h6>Thông tin bảng điểm</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Công Ty</th>
                                    <th class="text-center align-middle text-nowrap">Tên Sinh Viên</th>
                                    <th class="text-center align-middle text-nowrap">Tên Ngành</th>
                                    <th class="text-center align-middle text-nowrap">Mô Tả</th>
                                    <th class="text-center align-middle text-nowrap">Số sao</th>
                                    <th class="text-center align-middle text-nowrap">Duyệt</th>
                                    <th class="text-center align-middle text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(value, key) in list">
                                    <tr>
                                        <th class="text-center align-middle">@{{ key + 1 }}</th>
                                        <td class="align-middle text-nowrap">@{{ value.ten_sinh_vien }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.ten_cong_ty }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.ten_nganh }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.mo_ta }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.so_sao }}</td>
                                        <td class="align-middle text-nowrap">
                                            <template v-if="value.is_duyet == 1">
                                                <button v-on:click="doiTrangThai(value)" class="btn btn-warning"
                                                    style="width: 160px">Đã Duyệt</button>
                                            </template>

                                            <template v-else>
                                                <button v-on:click="doiTrangThai(value)" class="btn btn-danger"
                                                    style="width: 160px">Chưa Duyệt</button>
                                            </template>
                                        </td>

                                        <td class="text-center align-middle text-nowrap">
                                            <button class="edit btn btn-info m-1"
                                                v-on:click="edit = Object.assign({}, value)" data-bs-toggle="modal"
                                                data-bs-target="#editModal">Cập Nhật</button>
                                            <button class="del btn btn-danger m-1" v-on:click="del = value"
                                                data-bs-toggle="modal" data-bs-target="#delModal">Xóa Bỏ</button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Đánh giá</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div
                                            class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-dark">Warning Alerts</h6>
                                                    <div class="text-dark text-wrap">Bạn có chắc chắn muốn xóa Đánh giá
                                                        này không!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button v-on:click="xoaBangDiem()" type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Xác Nhận Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Đánh Giá</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <label class="mb-2">Mô Tả</label>
                                            <input v-model="edit.mo_ta" type="text" class="form-control mb-2">
                                        </div>
                                        <div>
                                            <label class="mb-2">Số sao</label>
                                            <select v-model="edit.so_sao" class="form-select">
                                                <template v-for="num in 5">
                                                    <option :value="num">@{{ num }}</option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" v-on:click="capNhatBangDiem()">Save
                                            changes</button>
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
                them_moi: {
                    'id_duyet': 1
                },
                list_sinh_vien: [],
                list: [],
                edit: {},
                del: {},
                key_search: '',
                ds_nganh: [],
                list_khoa: [],
                list_nganh: [],
            },
            created() {
                this.loadData();
            },
            methods: {
                doiTrangThai(value) {
                    axios
                        .post('{{ Route('statusDuyetDanhGiaKhoa') }}', value)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
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
                loadData() {
                    axios
                        .get('{{ Route('dataDanhGiaKhoa') }}')
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                themMoi() {
                    axios
                        .post('{{ Route('createDanhGiaKhoa') }}', this.them_moi)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                this.them_moi = {};
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
                xoaBangDiem() {
                    axios
                        .post('{{ Route('deleteDanhGiaKhoa') }}', this.del)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        });
                },
                capNhatBangDiem() {
                    axios
                        .post('{{ Route('updateDanhGiaKhoa') }}', this.edit)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.loadData();
                                $('#editModal').modal('hide');
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        });
                },
            },
        });
    </script>
@endsection
