@extends('admin.share.share_login.master')
@section('noi_dung')
    <div id="app" class="d-flex col-lg-5 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            <h2 class="card-title fw-bold mb-1">Đăng Ký Công Ty 🚀</h2>
            <form class="auth-register-form mt-2">
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="ten_cong_ty">Tên công ty</label>
                        <input id="ten_cong_ty" class="form-control"v-model='add.ten_cong_ty' v-on:keyup="nameToSlugCreate()"
                            type="text" placeholder="Nhập họ và tên...." tabindex="1" />

                    </div>
                    <div class="col">
                        <label class="form-label" for="">Slug công ty</label>
                        <input class="form-control"v-model='add.slug_cong_ty' type="text" disabled />
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="so_dien_thoai">Số điện thoại</label>
                        <input id="so_dien_thoai" class="form-control form-control-merge" v-model='add.so_dien_thoai'
                            type="tel" name="register-password" placeholder="0123456789" tabindex="3" />
                    </div>
                    <div class="col">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" class="form-control" v-model='add.email' type="text"
                            placeholder="email@gmail.com" tabindex="2" />
                    </div>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="dia_chi">Địa chỉ</label>
                    <input id="dia_chi" class="form-control"v-model='add.dia_chi' type="text"
                        placeholder="Nhập địa chỉ...." tabindex="1" />
                </div>
                {{-- <div class="mb-1">
                    <label class="form-label" for="register-username">Fax</label>
                    <input class="form-control"v-model='add.fax' type="text" />
                </div> --}}
                <div class="mb-1">
                    <label class="form-label" for="link">Link Website</label>
                    <input id="link" class="form-control"v-model='add.website' type="text" />
                </div>

                <div class="row mb-1">
                    <div class="col">
                        <label class="form-label" for="password">Mật Khẩu</label>
                        <input id="password" class="form-control form-control-merge" v-model='add.password' type="password"
                            placeholder="············" tabindex="3" />
                    </div>
                    <div class="col">
                        <label class="form-label" for="re-password">Nhập Lại Mật
                            Khẩu</label>
                        <input id="re-password" class="form-control form-control-merge" v-model='add.re_password'
                            type="password" placeholder="············" tabindex="3" />
                    </div>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="mo_ta">Mô tả</label>
                    <textarea id="mo_ta" v-model="add.mo_ta" class="form-control" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Mô tả..."></textarea>
                </div>
                <div class="mb-1">
                    <label class="form-label" for="hinh_anh">Hình ảnh</label>
                    <input class="form-control" v-on:change="getFile($event)" type="file" />
                </div>

                <button type="button" class="btn btn-primary w-100" tabindex="5" v-on:click="dangKi()">Đăng Ký</button>
            </form>
            <p class="text-center mt-2"><span>Bạn Đã Có Tài Khoản ?</span><a href="/cong-ty/login"><span>&nbsp;Đăng
                        Nhập</span></a></p>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new Vue({
            el: '#app',
            data: {
                add: {},

            },
            created() {

            },
            methods: {
                getFile(e) {
                    this.add.hinh_anh = e.target.files[0];
                },
                validateEmail(email) {
                    const pattern = /^\w+@[a-zA-Z0-9-]+(\.[a-zA-Z]{2,}){1,3}$/;
                    return pattern.test(email);
                },
                dangKi() {

                    if (!this.validateEmail(this.add.email)) {
                        toastr.error('Format email is wrong!!', 'Error');
                        return;
                    } else {
                        const formData = new FormData();
                        for (let key in this.add) {
                            formData.append(key, this.add[key]);
                        }
                        axios
                            .post('/cong-ty/register', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then((res) => {
                                if (res.data.status == 1) {
                                    toastr.success(res.data.message);
                                    window.location.href('/cong-ty/login')
                                } else {
                                    toastr.error(res.data.message);
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0]);
                                });
                            });
                    }
                },
                nameToSlugCreate() {
                    this.add.slug_cong_ty = this.toSlug(this.add.ten_cong_ty);
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
            },
        });
    </script>
@endsection
