@extends('share_khoa.master')
@section('content')
    <div class="row" id="app">
        <div class="col">
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
                                    <th class="text-center align-middle text-nowrap">Hình Ảnh</th>
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
                                        <td>
                                            <span v-if="value.hinh_anh === ''">Đang cập nhật</span>
                                            <span v-else>
                                                <img style="width: 150px;" v-bind:src="value.hinh_anh" alt="">
                                            </span>
                                        </td>
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Bảng Điểm</h1>
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
                                                    <div class="text-dark text-wrap">Bạn có chắc chắn muốn xóa bảng điểm
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
                                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Bảng Điểm</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="mb-2">Mã Môn</label>
                                        <input v-model="edit.ma_mon" type="text" class="form-control mb-2"
                                            placeholder="Nhập vào mã môn">
                                        <label class="mb-2">Tên môn</label>
                                        <input v-model="edit.ten_mon" type="text" class="form-control mb-2"
                                            placeholder="Nhập vào tên môn">
                                        <label class="mb-2">Điểm Số</label>
                                        <input v-model="edit.diem_so" type="number" class="form-control mb-2"
                                            placeholder="Nhập vào điểm gốc">
                                        <label class="mb-2">Điểm Chữ</label>
                                        <input v-model="edit.diem_chu" type="text" class="form-control mb-2"
                                            placeholder="Nhập vào điểm chữ">
                                        {{-- <form action="upload.php" method="post" enctype="multipart/form-data">
                                        Chọn ảnh để tải lên:
                                        <input v-on:change="getFile($event)" type="file" name="hinh_anh" id="hinh_anh" v-model="edit.hinh_anh">
                                    </form> --}}
                                        <label class="mb-2">Duyệt</label>
                                        <select v-model="edit.is_duyet" class="form-select mb-2">
                                            <option value="1">Duyệt</option>
                                            <option value="0">Chưa Duyệt</option>
                                        </select>
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
                    'id_duyet': 1
                },
                list_sv: [],
                list: [],
                edit: {},
                del: {},
                key_search: '',
                ds_nganh: [],
                hinh_anh: "",
            },
            created() {
                this.loadData();
                // this.loadDataSinhVien();
            },
            methods: {
                getFile(e) {
                    this.hinh_anh = e.target.files[0];
                },
                doiTrangThai(value) {
                    axios
                        .post('{{ Route('statusBangDiemKhoa') }}', value)
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
                        .get('{{ Route('dataSinhvienKhoa') }}')
                        .then((res) => {
                            this.list_sv = res.data.data;
                        });
                },
                loadData() {
                    var link = window.location.search;
                    var arr = link.split('');
                    var id = Number(arr[arr.length - 1]);
                    axios
                        .post('{{ Route('dataBangDiemKhoa') }}', {
                            id
                        })
                        .then((res) => {
                            this.list = res.data.data;
                        });
                },
                themMoi() {
                    const payload = new FormData();
                    // payload.append('hinh_anh', this.hinh_anh);
                    payload.append('ma_mon', this.them_moi.ma_mon);
                    payload.append('ten_mon', this.them_moi.ten_mon);
                    payload.append('diem_so', this.them_moi.diem_so);
                    payload.append('diem_chu', this.them_moi.diem_chu);
                    axios
                        .post('{{ Route('createBangDiemKhoa') }}', payload, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
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
                        .post('{{ Route('deleteBangDiemKhoa') }}', this.del)
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
                        .post('{{ Route('updateBangDiemKhoa') }}', this.edit)
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
