<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Login</title>
    </Head>

    <div class="section-authentication-cover">
        <div class="">
            <div class="row g-0">
                <!-- <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                    <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                        <div class="card-body">
                            <img src="/assets/images/login-images/login-cover.svg" class="img-fluid auth-img-cover-login" width="650" alt=""/>
                        </div>
                    </div>
                </div> -->

                <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                <img src="/assets/images/login-images/login-cover.svg" class="img-fluid auth-img-cover-login" width="650" alt=""/>
                </div>

                <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                        <div class="card-body">
                            <div class="">
                                <div class="text-center" v-if="$page.props.setting && $page.props.setting.logo">
                                    <img v-bind:src="'/storage/upload_files/settings/' + $page.props.setting.logo" style="height:90px;"/>
                                </div>
                                <br>
                                <h6 class="font-weight-bold text-center">Test of English Proficiency (TEP)</h6>

                                <h5 class="font-weight-bold mt-3">Login</h5>
                                <p class="text-muted">Silakan login dengan email dan password yang sudah anda daftarkan.</p>
                                <div class="form-body">
                                    <form @submit.prevent="submit" class="row g-3">
                                        <div class="mb-3 mt-0">
                                            <div v-if="$page.props.session.error" class="alert alert-danger border-0">
                                                <i class="fa fa-exclamation-triangle"></i>  <div v-html="$page.props.session.error"></div>
                                            </div>

                                            <div v-if="$page.props.session.success" class="alert alert-success border-0">
                                                <i class="fa fa-exclamation-triangle"></i> <div v-html="$page.props.session.success"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">{{ $page.props.setting.login_type == 3 ? 'Email / Username' : ($page.props.setting.login_type == 2 ? 'Username' : 'Email') }}</label>
                                            <input type="text" v-model="form.email" :class="{ 'is-invalid': errors.email }" class="form-control" :placeholder="$page.props.setting.login_type == 3 ? 'Email / Username' : ($page.props.setting.login_type == 2 ? 'Username' : 'Email')">
                                            <div v-if="errors.email" class="invalid-feedback">
                                                {{ errors.email }}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Password</label>
                                            <input type="password" v-model="form.password" :class="{ 'is-invalid': errors.password }" class="form-control" placeholder="Password">
                                            <div v-if="errors.password" class="invalid-feedback">
                                                {{ errors.password }}
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-end">
                                            <Link href="/user/forgot-password">Lupa Password ?</Link>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Sign in</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-center">
                                                <div v-if="$page.props.setting.add_user_registration == 1">
                                                    <p class="mb-0"> Belum punya akun ? <Link href="/register">Daftar disini</Link></p><br>
                                                </div>
                                                <a :href="`https://wa.me/${$page.props.setting.whatsapp_number}?text=${encodeURI('Hallo, Admin. saya ingin bertanya....')}`" target="_blank">Klik Untuk Menghubungi Admin</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end row-->
        </div>
    </div>

</template>

<script>
    //import layout
    import LayoutAuth from '../../Layouts/Auth.vue';

    // import Head form Inertia
    import { Head } from '@inertiajs/inertia-vue3';

    //import reactive
    import { reactive } from 'vue';

    // import link
    import { Link } from '@inertiajs/inertia-vue3';

    //import inertia adapter
    import { Inertia } from '@inertiajs/inertia';

    export default {
        // layout
        layout: LayoutAuth,

        components: {
            Head,
            Link
        },

        //props
        props: {
            errors: Object,
            session: Object
        },

        setup() {
            const form = reactive({
                email: '',
                password: ''
            });

            // submit method
            const submit = () => {
                // send data to server
                Inertia.post('/login', {
                    // data
                    email: form.email,
                    password: form.password,
                });
            }

            // return form state and submit method
            return {
                form,
                submit,
            }
        }
    }
</script>
