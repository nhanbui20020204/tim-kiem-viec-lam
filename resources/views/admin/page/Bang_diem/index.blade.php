@extends('admin.page.admin.index')
@section('content')
<div class="row" id="app">
    <div class="col-4">
        <div class="card border-primary border-bottom border-3 border-0">
            <div class="card-header">
                <h6>Bảng Điểm </h6>
            </div>
            <div class="card-body">
                <label class="mb-2">Mã Môn</label>
                <input v-model="them_moi.ma_mon" type="text" class="form-control mb-2" placeholder="Nhập vào mã môn">
                <label class="mb-2">Tên môn</label>
                <input v-model="them_moi.ten_mon" type="text" class="form-control mb-2" placeholder="Nhập vào tên môn">
                <label class="mb-2">Điểm Số</label>
                <input v-model="them_moi.diem_so" type="number" class="form-control mb-2" placeholder="Nhập vào điểm gốc">
                <label class="mb-2">Điểm Chữ</label>
                <input v-model="them_moi.diem_chu" type="text" class="form-control mb-2" placeholder="Nhập vào điểm chữ">
                <label class="mb-2">Sinh Viên</label>
                <select v-model="them_moi.id_sinh_vien" class="form-select mb-2">
                    <template v-for="(value,key) in list_sv">
                        <option v-bind:value="value.id">@{{ value.ten_sinh_vien }}</option>
                    </template>
                </select>
                <label class="mb-2">Duyệt</label>
                <select v-model="them_moi.id_duyet" class="form-select mb-2">
                    <option value="1" selected>Duyệt</option>
                    <option value="0">Chưa Duyệt</option>
                </select>
            </div>
            <div class="card-footer text-end">
                <button v-on:click="themMoi()" class="btn btn-primary">Thêm Mới Bảng Điểm</button>
            </div>
        </div>
    </div>
    <div class="col-8">
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
                                <th class="text-center align-middle text-nowrap">Mã môn</th>
                                <th class="text-center align-middle text-nowrap">Tên môn</th>
                                <th class="text-center align-middle text-nowrap">Tên Sinh Viên</th>
                                <th class="text-center align-middle text-nowrap">Điểm Số</th>
                                <th class="text-center align-middle text-nowrap">Điểm Chữ</th>
                                <th class="text-center align-middle text-nowrap">Duyệt</th>
                                <th class="text-center align-middle text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(value, key) in list">
                                <tr>
                                    <th class="text-center align-middle">@{{ key + 1 }}</th>
                                    <td class="align-middle text-nowrap">@{{ value.ma_mon }}</td>
                                    <td class="align-middle text-nowrap text-center">@{{ value.ten_mon }}</td>
                                    <td class="align-middle text-nowrap text-center">@{{ value.ten_sinh_vien }}</td>
                                    <td class="align-middle text-nowrap">@{{ value.diem_so }}</td>
                                    <td class="align-middle text-nowrap">@{{ value.diem_chu }}</td>
                                    <td class="align-middle text-nowrap">
                                        <template v-if="value.is_duyet == 1">
                                            <button v-on:click="doiTrangThai(value)" class="btn btn-warning" style="width: 160px">Đã Duyệt</button>
                                        </template>

                                        <template v-else>
                                            <button v-on:click="doiTrangThai(value)" class="btn btn-danger" style="width: 160px">Chưa Duyệt</button>
                                        </template>
                                    </td>

                                    <td class="text-center align-middle text-nowrap">
                                        <button class="edit btn btn-info m-1" v-on:click="edit = value" data-bs-toggle="modal" data-bs-target="#editModal">Cập Nhật</button>
                                        <button class="del btn btn-danger m-1" v-on:click="del = value" data-bs-toggle="modal" data-bs-target="#delModal">Xóa Bỏ</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                    <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Bảng Điểm</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-dark">Warning Alerts</h6>
                                                <div class="text-dark text-wrap">Bạn có chắc chắn muốn xóa bảng điểm
                                                    này không!</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button v-on:click="xoaBangDiem()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Xác Nhận Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Bảng Điểm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="mb-2">Mã Môn</label>
                                    <input v-model="edit.ma_mon" type="text" class="form-control mb-2" placeholder="Nhập vào mã môn">
                                    <label class="mb-2">Tên môn</label>
                                    <input v-model="edit.ten_mon" type="text" class="form-control mb-2" placeholder="Nhập vào tên môn">
                                    <label class="mb-2">Điểm Số</label>
                                    <input v-model="edit.diem_so" type="number" class="form-control mb-2" placeholder="Nhập vào điểm gốc">
                                    <label class="mb-2">Điểm Chữ</label>
                                    <input v-model="edit.diem_chu" type="text" class="form-control mb-2" placeholder="Nhập vào điểm chữ">
                                    <label class="mb-2">Sinh Viên</label>
                                    <select v-model="edit.id_sinh_vien" class="form-select mb-2">
                                        <template v-for="(value,key) in list_sv">
                                            <option v-bind:value="value.id">@{{ value.ten_sinh_vien }}</option>
                                        </template>
                                    </select>
                                    <label class="mb-2">Duyệt</label>
                                    <select v-model="edit.is_duyet" class="form-select mb-2">
                                        <option value="1">Duyệt</option>
                                        <option value="0">Chưa Duyệt</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            list_sv: [],
            list: [],
            edit: {},
            del: {},
            key_search: '',
            ds_nganh: [],
        },
        created() {
            this.loadData();
            this.loadDataSinhVien();
        },
        methods: {
            doiTrangThai(value) {
                axios
                    .post('{{Route("statusBangDiemAdmin")}}', value)
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
    loadDataSinhVien() {
        axios
            .get('{{ Route("dataSinhvien")}}')
            .then((res) => {
                this.list_sv = res.data.data;
            });
    },
    loadData() {
        axios
            .get('/admin/bang-diem/data')
            .then((res) => {
                this.list = res.data.data;
            });
    },
    themMoi() {
        axios
            .post('{{ Route("createBangDiemAdmin")}}', this.them_moi)
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
            .post('{{ Route("deleteBangDiemAdmin")}}', this.del)
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
    capNhatBangDiem() {
        axios
            .post('{{ Route("updateBangDiemAdmin")}}', this.edit)
            .then((res) => {
                if (res.data.status) {
                    toastr.success(res.data.message, 'Success');
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
