@extends('share_vue.master')

@section('content')
    <div class="row" id="app">
        <div class="col-4">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-header mt-2">
                    <h6>Đánh Giá</h6>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <div class="mb-2">
                            <label>Công ty</label>
                            <select v-model="them_moi.id_cong_ty" class="form-select">
                                <template v-for="(value, key) in list_cong_ty">
                                    <option v-bind:value="value.id">@{{ value.ten_cong_ty }}</option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="mb-2">Mô Tả</label>
                        <textarea v-model="them_moi.mo_ta" type="text" class="form-control mb-2"></textarea>
                    </div>
                    <div>
                        <label class="mb-2">Số sao</label>
                        <select v-model="them_moi.so_sao" class="form-select">
                            <template v-for="num in 5">
                                <option :value="num">@{{ num }}</option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button v-on:click="themMoi()" class="btn btn-primary">Thêm Mới Đánh giá</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-danger border-bottom border-3 border-0">
                <div class="card-header">
                    <h6>Thông tin Đánh giá</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle text-nowrap">#</th>
                                    <th class="text-center align-middle text-nowrap">Tên Công Ty</th>
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
                                        <td class="align-middle text-nowrap">@{{ value.ten_cong_ty }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.mo_ta }}</td>
                                        <td class="align-middle text-nowrap">
                                            <span v-for="star in value.so_sao" :key="star" class="star">
                                                <i class="fa-solid fa-star"></i>
                                            </span>
                                            <span v-for="star in (5-value.so_sao)" :key="star" class="star">
                                                <i class="fa-regular fa-star"></i>
                                            </span>
                                        </td>
                                        <td class="align-middle text-nowrap">
                                            <span v-if="value.is_duyet==1">Đã Duyệt</span>
                                            <span v-else>Đang Chờ Duyệt</span>

                                        </td>

                                        <td class="text-center align-middle text-nowrap">
                                            <button class="edit btn btn-info m-1" v-on:click="edit = value"
                                                data-bs-toggle="modal" data-bs-target="#editModal">Cập Nhật</button>
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Đánh Giá</h1>
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
                                                    <div class="text-dark text-wrap">Bạn có chắc chắn muốn xóa đánh giá
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
                                            <label class="mb-2">Mô Tả</label>
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
                                        <button type="button" class="btn btn-primary"
                                            v-on:click="capNhatBangDiem()">Save
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

                },
                list: [],
                edit: {},
                del: {},
                key_search: '',
                list_cong_ty: [],
            },
            created() {
                this.loadData();
                this.getCongty();
            },
            methods: {
                getCongty() {
                    axios
                        .get('{{ Route('CongtyDataDanhgia') }}')
                        .then((res) => {
                            this.list_cong_ty = res.data.data;
                        });
                },
                loadData() {
                    axios
                        .get('{{ Route('dataDanhGia') }}')
                        .then((res) => {
                            this.list = res.data.data;

                            if (res.data.status == 0) {
                                toastr.error(res.data.message);
                                this.loadData();

                            }
                        });
                },
                themMoi() {
                    console.log(this.them_moi);
                    axios
                        .post('{{ Route('createDanhgia') }}', this.them_moi)
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
                        .post('{{ Route('deleteDanhGia') }}', this.del)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, 'Success');
                                $('#delModal').modal('hide');

                                this.loadData();
                            } else if (res.data.status == 2) {
                                toastr.info(res.data.message);
                                $('#delModal').modal('hide');

                                this.loadData();
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        });
                },
                capNhatBangDiem() {
                    axios
                        .post('{{ Route('updateDanhgia') }}', this.edit)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message, 'Success');
                                $('#editModal').modal('hide');
                                this.loadData();
                            } else if (res.data.status == 2) {
                                toastr.info(res.data.message);
                                $('#editModal').modal('hide');

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
