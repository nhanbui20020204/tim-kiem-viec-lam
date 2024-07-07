@extends('share_vue.master')
@section('content')
    <div id="app">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Thông Tin Cá Nhân</h4>
            </div>
            <div class="card-body py-2 my-25">

                <form class="validate-form mt-2 pt-50" novalidate="novalidate">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountFirstName">Tên Sinh Viên</label>
                            <input v-model="profile.ten_sinh_vien" type="text" class="form-control">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountEmail">Email</label>
                            <input v-model="profile.email" type="email" class="form-control" placeholder="Nhập vào email">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountPhoneNumber">Số Điện Thoại</label>
                            <input v-model="profile.so_dien_thoai" type="text" class="form-control account-number-mask"
                                placeholder="Nhập vào số điện thoại">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountAddress">Địa Chỉ</label>
                            <input v-model="profile.dia_chi" type="text" class="form-control"
                                placeholder="Nhập vào địa chỉ của bạn">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountAddress">Mã Sinh Viên</label>
                            <input v-model="profile.mssv" type="number" class="form-control"
                                placeholder="Nhập vào địa chỉ của bạn">
                        </div>

                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountAddress">Ngày Sinh</label>
                            <input v-model="profile.ngay_sinh" type="date" class="form-control"
                                placeholder="Nhập vào địa chỉ của bạn">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountAddress">Lớp Cố Vấn</label>
                            <input v-model="profile.lop_co_van" type="text" class="form-control"
                                placeholder="Nhập vào địa chỉ của bạn">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label>Giới Tính</label>
                            <select class="form-control" v-model="profile.gioi_tinh">
                                <option v-bind:value="1">Nam</option>
                                <option v-bind:value="0">Nữ</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountAddress">Mô Tả</label>
                            <textarea v-model="profile.mo_ta" class="form-control" name="" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountAddress">Skill</label>
                            <button type="button" id="" class="btn btn-primary d-block" data-bs-toggle="modal"
                                data-bs-target="#skillModal">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <button v-on:click="changeProfile()" type="button"
                            class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Lưu
                            Thông Tin</button>
                    </div>
                </form>
                <div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Danh Sách Danh Mục Skill
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bodered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>#</th>
                                            <th>Tên danh mục skill</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(v,k) in list_skill">
                                            <th>
                                                <input @change="toggleCheckbox(v.id)" type="checkbox"
                                                    :checked="skillExist(v.id)">
                                            </th>
                                            <th>@{{ k + 1 }}</th>
                                            <th>@{{ v.ten_skill }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                <button type="button" class="btn btn-primary" @click="handleSkill()">Xác
                                    nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Thay Đổi Mật Khẩu</h4>
            </div>
            <div class="card-body py-2 my-25">
                <div class="row">
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label">Mật Khẩu Mới</label>
                        <div class="input-group input-group-merge form-password-toggle mb-2">
                            <input v-model="password" type="password" class="form-control" id="basic-default-password1"
                                placeholder="Nhập vào mật khẩu mới" aria-describedby="basic-default-password1">
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-eye font-small-4">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg></span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label">Nhập lại Mật Khẩu Mới</label>
                        <div class="input-group input-group-merge form-password-toggle mb-2">
                            <input v-model="re_password" type="password" class="form-control"
                                id="basic-default-password1" placeholder="Nhập lại mật khẩu mới"
                                aria-describedby="basic-default-password1">
                            <span class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-eye font-small-4">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <button v-on:click="changePassword()" type="button"
                            class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Đổi Mật Khẩu</button>
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
                    profile: {},
                    password: '',
                    re_password: '',
                    list_skill: [],
                    list_skill_duoc_chon: [],
                },
                created() {
                    this.loadData();
                    this.loadSkill();
                    this.loadDataSkill();
                },
                methods: {
                    toggleCheckbox(skillId) {
                        if (this.skillExist(skillId)) {
                            this.list_skill_duoc_chon = this.list_skill_duoc_chon.filter(id => id !==
                                skillId);
                        } else {
                            this.list_skill_duoc_chon.push(skillId);
                        }
                    },
                    loadData() {
                        axios
                            .get('{{ Route('getProfileSinhVien') }}')
                            .then((res) => {
                                this.profile = res.data.data;
                            })
                    },
                    loadDataSkill() {
                        axios
                            .get('{{ Route('dataSkillSinhVien') }}')
                            .then((res) => {
                                this.list_skill_duoc_chon = res.data.data.map(item => item.id_skill);
                            })
                    },
                    loadSkill() {
                        axios
                            .get('{{ Route('dataSkillForSinhVien') }}')
                            .then((res) => {
                                this.list_skill = res.data.data;
                            })
                    },
                    skillExist(skillId) {
                        return this.list_skill_duoc_chon.some(skill => skill === skillId);
                    },
                    changeProfile() {
                        axios
                            .post('{{ Route('updateProfileSinhVien') }}', this.profile)
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
                    changePassword() {
                        var payload = {
                            'password': this.password,
                            're_password': this.re_password,
                        };
                        axios
                            .post('{{ Route('updatePasswordSinhVien') }}', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, 'Success');
                                    this.password = '';
                                    this.re_password = '';
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
                    handleSkill() {
                        if (this.list_skill_duoc_chon) {
                            this.updateSkill({
                                list_skill: this.list_skill_duoc_chon
                            });
                        } else {
                            this.createSkill({
                                list_skill: this.list_skill_duoc_chon
                            });
                        }
                    },
                    createSkill(payload) {
                        axios
                            .post('{{ Route('createSkillSinhVien') }}', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, 'Success');
                                    this.list_skill_duoc_chon = [];
                                    this.loadData();
                                    this.loadDataSkill();
                                    $('#skillModal').modal('hide');
                                } else {
                                    toastr.error(res.data.message, 'Error');
                                }
                            })
                    },
                    updateSkill(payload) {
                        axios
                            .post('{{ Route('updateSkillSinhVien') }}', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, 'Success');
                                    this.list_skill_duoc_chon = [];
                                    this.loadData();
                                    this.loadDataSkill();
                                    $('#skillModal').modal('hide');
                                } else {
                                    toastr.error(res.data.message, 'Error');
                                }
                            })
                    },
                },
            })
        });
    </script>
@endsection
