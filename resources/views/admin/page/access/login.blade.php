@extends('admin.share.share_login.master')
@section('noi_dung')
    <div id="app" class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            <h2 class="card-title fw-bold mb-1">Chào mừng đến với Admin Page</h2>
            <div class="mb-1">
                <label class="form-label" for="login-email">Tài Khoản</label>
                <input v-model="login.email" class="form-control" type="text" placeholder="Nhập vào tên tài khoản"
                    aria-describedby="login-email" autofocus="" tabindex="1" />
            </div>
            <div class="mb-1">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="login-password">Mật Khẩu</label><a
                        href="auth-forgot-password-cover.html"><small>Quên mật khẩu?</small></a>
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                    <input v-model="login.password" class="form-control form-control-merge" type="password"
                        placeholder="Nhập vào mật khẩu" aria-describedby="login-password" tabindex="2" /><span
                        class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
            </div>
            <div class="mb-1">
                <div class="form-check">
                    <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                    <label class="form-check-label" for="remember-me"> Ghi Nhớ</label>
                </div>
            </div>
            <button v-on:click="ac_login()" class="btn btn-primary w-100" tabindex="4">Đăng Nhập</button>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            new Vue({
                el: '#app',
                data: {
                    login: {},
                },
                methods: {
                    ac_login() {
                        axios
                            .post('{{ Route('actionLoginAdmin') }}', this.login)
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message);
                                    setTimeout(() => {
                                        window.location.replace('{{ Route('viewAdmin') }}');
                                    }, 500);
                                } else if (res.data.status == 2) {
                                    toastr.error(res.data.message);
                                } else if (res.data.status == 3) {
                                    toastr.warning(res.data.message);
                                } else {
                                    toastr.error(res.data.message);
                                }
                            });
                    },
                },
            });
        })
    </script>
@endsection
