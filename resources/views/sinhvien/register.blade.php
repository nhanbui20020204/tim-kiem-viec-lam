@extends('admin.share.share_login.master')
@section('noi_dung')
    <div id="app" class="d-flex col-lg-5 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            <h2 class="card-title fw-bold mb-1">Đăng Ký Sinh Viên 🚀</h2>
            <form class="auth-register-form mt-2">
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="register-username">Tên Sinh Viên</label>
                        <input class="form-control"v-model='add.ten_sinh_vien' v-on:keyup="nameToSlugCreate()" type="text"
                            placeholder="Nhập họ và tên...." tabindex="1" />

                    </div>
                    <div class="col">
                        <label class="form-label" for="register-username">Mã Số Sinh Viên</label>
                        <input class="form-control"v-model='add.mssv' type="text" />
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="register-password">Số điện thoại</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" v-model='add.so_dien_thoai' type="tel"
                                name="register-password" placeholder="0123456789" tabindex="3" />
                        </div>

                    </div>
                    <div class="col">
                        <label class="form-label" for="register-email">Email</label>
                        <input class="form-control" v-model='add.email' type="text" placeholder="email@gmail.com"
                            tabindex="2" />

                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="register-password">Khoa</label>
                        <select v-model="add.id_khoa" class="form-select" @change="getDataNganh($event.target.value)">
                            <option value="#">Vui lòng chọn</option>
                            <template v-for="(v,k) in list_khoa">
                                <option v-bind:value="v.id">@{{ v.ten_khoa }}</option>
                            </template>
                        </select>

                    </div>
                    <div class="col">
                        <label class="form-label" for="register-email">Ngành</label>
                        <select v-model="add.id_nganh" class="form-select">
                            <option value="#">Vui lòng chọn</option>
                            <template v-for="(v,k) in list_nganh">
                                <option v-bind:value="v.id">@{{ v.ten_nganh }}</option>
                            </template>
                        </select>

                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="register-password">Giới Tính</label>
                        <select v-model="add.gioi_tinh" class="form-select">
                            <option value="#">Vui lòng chọn</option>
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>

                    </div>
                    <div class="col">
                        <label class="form-label" for="register-username">Lớp Cố Vấn</label>
                        <input class="form-control"v-model='add.lop_co_van' type="text" placeholder="Nhập lớp cố vấn...."
                            tabindex="1" />

                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="register-username">Địa chỉ</label>
                        <input class="form-control"v-model='add.dia_chi' type="text" placeholder="Nhập địa chỉ...."
                            tabindex="1" />

                    </div>
                    <div class="col">
                        <label class="form-label" for="register-username">Ngày Sinh</label>
                        <input class="form-control"v-model='add.ngay_sinh' type="date" placeholder="Nhập lớp cố vấn...."
                            tabindex="1" />

                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="register-password">Mật Khẩu</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" v-model='add.password' type="password"
                                placeholder="············" tabindex="3" />
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label" for="register-password">Nhập Lại Mật
                            Khẩu</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" v-model='add.re_password' type="password"
                                placeholder="············" tabindex="3" />
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="register-username">Mô tả</label>
                    <textarea v-model="add.mo_ta" class="form-control" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Nhập mô tả...."></textarea>
                </div>


                <button type="button" class="btn btn-primary w-100" tabindex="5" v-on:click="dangKi()">Đăng
                    Ký</button>
            </form>
            <p class="text-center mt-2"><span>Bạn Đã Có Tài Khoản ?</span><a href="/sinh-vien/login"><span>&nbsp;Đăng
                        Nhập</span></a></p>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                add: {
                    id_khoa: '#',
                    id_nganh: '#',
                    gioi_tinh: '#'
                },
                list_khoa: [],
                list_nganh: [],
            },
            created() {
                this.getDataKhoa();
            },
            methods: {
                validateEmail(email) {
                    const pattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|[^.]+\.edu\.vn)$/;
                    return pattern.test(email);
                },
                dangKi() {
                    if (!this.validateEmail(this.add.email)) {
                        toastr.error('Format email is wrong!!', 'Error');
                        return;
                    } else
                        axios
                        .post('/sinh-vien/register', this.add)
                        .then((res) => {
                            if (res.data.status == 1) {
                                toastr.success(res.data.message);
                                location.href('/sinh-vien/login')
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
                getDataKhoa() {
                    axios
                        .get('{{ Route('dataKhoaDangKy') }}')
                        .then((res) => {
                            this.list_khoa = res.data.khoa;
                        });
                },
                getDataNganh(id) {
                    axios
                        .post('{{ Route('dataNganhDangKy') }}', {
                            id
                        })
                        .then((res) => {
                            this.list_nganh = res.data.nganh;
                        });
                }
            },
        });
    </script>
@endsection
