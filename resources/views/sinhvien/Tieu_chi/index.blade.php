@extends('share_vue.master')
@section('content')
    <div class="row" id="app">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Danh Sách Tiêu Chí</h2>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <button class="btn btn-outline-primary waves-effect" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </button>
                        <input v-model="key_search" v-on:keyup.enter="timKiem()" type="text" class="form-control"
                            placeholder="Nhập vào thông tin cần tìm" aria-label="Amount">
                        <button v-on:click="timKiem()" class="btn btn-outline-primary waves-effect" type="button">Search
                            !</button>
                    </div>
                    <br>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle text-nowrap">#</th>
                                        <th class="text-center align-middle text-nowrap">Tên Tiêu Chí</th>
                                        <th class="text-center align-middle text-nowrap">Tên Công Ty</th>
                                        <th class="text-center align-middle text-nowrap">Danh Mục Skills</th>
                                        <th class="text-center align-middle text-nowrap">Tiền Lương</th>
                                        <th class="text-center align-middle text-nowrap">Số Lượng</th>
                                        <th class="text-center align-middle text-nowrap">Nội Dung Mô Tả</th>
                                        <th class="text-center align-middle text-nowrap"
                                            style="padding-right: 11rem;padding-left: 11rem;">Địa Chỉ</th>
                                        <th class="text-center align-middle text-nowrap">Ngày Bắt Đầu</th>
                                        <th class="text-center align-middle text-nowrap">Ngày Kết Thúc</th>
                                        <th class="text-center align-middle text-nowrap">Tình Trạng</th>
                                        <th class="text-center align-middle text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(value, key) in list">
                                        <td class="align-middle text-nowrap">@{{ key + 1 }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.tieu_chi?.tieu_de }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.tieu_chi?.ten_cong_ty }}</td>
                                        <td class="align-middle text-nowrap">
                                            <button type="button" @click="list_skill = value.list_skill"
                                                class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#skillModal">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </button>
                                        </td>
                                        <td class="align-middle text-nowrap">@{{ numberFormat(value.tieu_chi?.tien_luong) }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.tieu_chi?.so_luong }}</td>
                                        <td class="align-middle text-nowrap">
                                            <button type="button" @click="noi_dung = value.tieu_chi.noi_dung_mo_ta"
                                                class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="fa-solid fa-circle-info"></i>
                                            </button>
                                        </td>
                                        <td>@{{ value.tieu_chi?.dia_chi_cong_viec }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.tieu_chi?.ngay_bat_dau }}</td>
                                        <td class="align-middle text-nowrap">@{{ value.tieu_chi?.ngay_ket_thuc }}</td>

                                        <td class="text-nowrap align-middle text-center"
                                            @click="updateTinhTrang(value.tieu_chi)">
                                            <span v-if=" checkTinhTrang(value.tieu_chi) == 1 " class="btn btn-success">Đã
                                                ứng tuyển</span>
                                            <span v-else-if="checkTinhTrang(value.tieu_chi) == 0" class="btn btn-info">Tạm
                                                dừng ứng tuyển</span>
                                            <span v-else class="btn btn-secondary">Chưa ứng tuyển</span>
                                        </td>
                                        <td class="text-nowrap align-middle text-center">
                                            <button type="button" @click="ungTuyenTieuChi(value.tieu_chi)"
                                                class="btn btn-success">Ứng tuyển</button>
                                            <button type="button" @click="huyUngTuyenTieuChi(value.tieu_chi)"
                                                class="btn btn-danger">Huỷ ứng tuyển</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nội Dung</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" v-html="noi_dung"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Danh sách danh mục skill
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tên Skill</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(value, key) in list_skill">
                                                        <td>@{{ key + 1 }}</td>
                                                        <td>@{{ value.ten_skill }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
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
                noi_dung: {},
                list: [],
                tieu_chi: {},
                list_ung_tuyen: [],
                tinh_trang: 0,
                key_search: '',
                list_skill: [],
            },
            created() {
                this.loadDataTieuChi();
                this.loadDataUngTuyen();
            },
            methods: {
                loadDataTieuChi() {
                    axios
                        .get('{{ Route('dataTieuChiSinhVien') }}')
                        .then((res) => {
                            if (res.data.status) {
                                this.list = res.data.data;
                            }
                        });
                },
                ungTuyenTieuChi(payload) {
                    axios
                        .post('{{ Route('themMoiSinhVienUngTuyen') }}', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadDataUngTuyen();
                            } else {
                                toastr.info(res.data.message);
                                this.loadDataUngTuyen();
                            }
                        });
                },
                huyUngTuyenTieuChi(payload) {
                    axios
                        .post('{{ Route('xoaSinhVienUngTuyen') }}', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadDataUngTuyen();
                            }
                        });
                },
                updateTinhTrang(payload) {
                    if (!this.list_ung_tuyen || !this.list_ung_tuyen.some(item => item.id_tieu_chi === payload
                            .id)) {
                        toastr.error('Vui lòng ứng tuyển trước khi thay đổi tình trạng');
                        return;
                    }
                    axios
                        .post('{{ Route('statusUngTuyen') }}', payload)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadDataUngTuyen();
                            }
                        });
                },
                loadDataUngTuyen() {
                    axios
                        .post('{{ Route('dataUngTuyen') }}')
                        .then((res) => {
                            if (res.data.status) {
                                this.list_ung_tuyen = res.data.data;
                            }
                        });
                },
                checkTinhTrang(payload) {
                    const check = this.list_ung_tuyen.find(item => item.id_tieu_chi === payload.id);
                    if (check) {
                        if (check.tinh_trang === 1) return 1;
                        else return 0;
                    }
                    return -1;
                },
                numberFormat(number) {
                    return new Intl.NumberFormat('vi-VI', {
                        style: 'currency',
                        currency: 'VND'
                    }).format(number);
                },
            },
        });
    </script>
@endsection
