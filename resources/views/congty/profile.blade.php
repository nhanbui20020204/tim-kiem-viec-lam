@extends('share_congty.master')
@section('content')
    <div id="app">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Thông Tin Cá Nhân</h4>
            </div>
            <div class="card-body py-2 my-25">
                <!-- header section -->
                <div>
                    <a href="#" class="my-10">
                        <img v-bind:src="profile.hinh_anh" id="account-upload-img" class="uploadedAvatar rounded me-50"
                            alt="profile image" height="100" width="100">
                    </a>
                    <input type="file" class="form-control mt-2" placeholder="Nhập vào địa chỉ của bạn">
                </div>
                <!--/ header section -->

                <!-- form -->
                <form class="validate-form mt-2 pt-50" novalidate="novalidate">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountFirstName">Tên Công Ty</label>
                            <input v-on:keyup="nameToSlugCreate()" v-model="profile.ten_cong_ty" type="text"
                                class="form-control" placeholder="Nhập vào họ của bạn">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountLastName">Slug Công Ty</label>
                            <input v-model="profile.slug_cong_ty" type="text" class="form-control" disabled>
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
                            <label class="form-label" for="accountAddress">Fax</label>
                            <input v-model="profile.fax" type="text" class="form-control"
                                placeholder="Nhập vào địa chỉ của bạn">
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label" for="accountAddress">Mô tả</label>
                            <textarea v-model="profile.mo_ta" class="form-control" name="" id="" cols="20" rows="5"></textarea>
                        </div>
                        <div class="col-12">
                            <button v-on:click="changeProfile()" type="button"
                                class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Lưu
                                Thông Tin</button>
                        </div>
                    </div>
                </form>
                <!--/ form -->
            </div>
        </div>
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Thay Đổi Mật Khẩu</h4>
            </div>
            <div class="card-body py-2 my-25">
                <form id="formAccountDeactivation" class="validate-form" novalidate="novalidate">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label">Mật Khẩu Mới</label>
                            <div class="input-group input-group-merge form-password-toggle mb-2">
                                <input type="password" class="form-control" v-model="password"
                                    placeholder="Nhập vào mật khẩu mới">

                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-1">
                            <label class="form-label">Nhập lại Mật Khẩu Mới</label>
                            <div class="input-group input-group-merge form-password-toggle mb-2">
                                <input type="password" class="form-control" v-model="re_password"
                                    placeholder="Nhập lại mật khẩu mới">

                            </div>
                        </div>
                        <div class="col-12">
                            <button v-on:click="changePassword()" type="button"
                                class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Lưu
                                Mật Khẩu</button>
                        </div>
                    </div>
                </form>
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
                    hinh_anh: '',
                    password: '',
                    re_password: '',
                },
                created() {
                    this.loadProfile();
                },
                methods: {
                    loadProfile() {
                        axios
                            .post('{{ Route('getProfileCongty') }}')
                            .then((res) => {
                                this.profile = res.data.data;
                                this.hinh_anh = res.data.data.hinh_anh;
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    },
                    changeProfile() {
                        axios
                            .post('{{ Route('updateProfileCongty') }}', this.profile)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.loadProfile();
                                } else {
                                    toastr.error(res.data.message);
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0], "Error");
                                });
                            });
                    },
                    changePassword() {
                        var payload = {
                            'password': this.password,
                            're_password': this.re_password,

                        };
                        axios
                            .post('{{ Route('updatePasswordCongty') }}', payload)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message);
                                    this.password = '';
                                    this.re_password = '';
                                } else {
                                    toastr.error(res.data.message);
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0], "Error");
                                });
                            });
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
                    nameToSlugCreate() {
                        this.profile.slug_cong_ty = this.toSlug(this.profile.ten_cong_ty);
                    },
                },
            });
        });
    </script>
@endsection
