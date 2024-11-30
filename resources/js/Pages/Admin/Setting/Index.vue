<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Setting</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Setting</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <form @submit.prevent="submit" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" class="form-control" v-model="form.app_name" :class="{ 'is-invalid': errors.app_name }" placeholder="Nama Aplikasi">
                            <div v-if="errors.app_name" class="invalid-feedback">
                                {{ errors.app_name }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control" v-model="form.app_url" :class="{ 'is-invalid': errors.app_url }" placeholder="Link">
                            <div v-if="errors.app_url" class="invalid-feedback">
                                {{ errors.app_url }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Nomor Whatsapp</label>
                            <input type="text" class="form-control" v-model="form.whatsapp_number" :class="{ 'is-invalid': errors.whatsapp_number }" placeholder="Nomor Whatsapp">
                            <div v-if="errors.whatsapp_number" class="invalid-feedback">
                                {{ errors.whatsapp_number }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Token Whatsapp (Untuk Notifikasi)</label>
                            <input type="text" class="form-control" v-model="form.whatsapp_token" :class="{ 'is-invalid': errors.whatsapp_token }" placeholder="Token Whatsapp">
                            <div v-if="errors.whatsapp_token" class="invalid-feedback">
                                {{ errors.whatsapp_token }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" v-model="form.address" :class="{ 'is-invalid': errors.address }" placeholder="Alamat" rows="5"></textarea>
                            <div v-if="errors.address" class="invalid-feedback">
                                {{ errors.address }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Logo</label>
                            <input type="file" class="form-control" @input="form.logo = $event.target.files[0]" :class="{ 'is-invalid': errors.logo }" placeholder="logo">
                            <div v-if="errors.logo" class="invalid-feedback">
                                {{ errors.logo }}
                            </div>
                            <br>
                            <div v-if="setting.logo">
                                <img  v-bind:src="'/storage/upload_files/settings/' + setting.logo" style="width:120px;"/>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <label class="form-label">Aktifkan Verifikasi User</label>
                            <select v-model="form.add_activation_user" :class="{ 'is-invalid': errors.add_activation_user }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.add_activation_user" class="invalid-feedback">
                                {{ errors.add_activation_user }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Aktifkan Pembelian Voucher</label>
                            <select v-model="form.add_voucher_purchase" :class="{ 'is-invalid': errors.add_voucher_purchase }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.add_voucher_purchase" class="invalid-feedback">
                                {{ errors.add_voucher_purchase }}
                            </div>
                        </div>
                        <div class="col-12" >
                            <label class="form-label">Akses Login</label>
                            <select v-model="form.login_type" :class="{ 'is-invalid': errors.login_type }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Email</option>
                                <option value="2">Username</option>
                                <option value="3">Email / Username</option>
                            </select>
                            <div v-if="errors.login_type" class="invalid-feedback">
                                {{ errors.login_type }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Aktifkan Form Registrasi Peserta</label>
                            <select v-model="form.add_user_registration" :class="{ 'is-invalid': errors.add_user_registration }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.add_user_registration" class="invalid-feedback">
                                {{ errors.add_user_registration }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tipe Member Saat Awal Registrasi</label>
                            <select v-model="form.registration_member_type" :class="{ 'is-invalid': errors.registration_member_type }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Member Gratis Try Out</option>
                                <option value="2">Member Try Out Berbayar</option>
                            </select>
                            <div v-if="errors.registration_member_type" class="invalid-feedback">
                                {{ errors.registration_member_type }}
                            </div>
                        </div>
                        <div class="col-12" >
                            <label class="form-label">Zona Waktu</label>
                            <select v-model="form.timezone" :class="{ 'is-invalid': errors.timezone }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="Asia/Jakarta">WIB (Waktu Indonesia Barat)</option>
                                <option value="Asia/Makassar">WITA (Waktu Indonesia Tengah)</option>
                                <option value="Asia/Jayapura">WIT (Waktu Indonesia Timur)</option>
                            </select>
                            <div v-if="errors.timezone" class="invalid-feedback">
                                {{ errors.timezone }}
                            </div>
                        </div>
                        <div class="col-12" >
                            <label class="form-label">Tipe Sistem Blokir Ujian</label>
                            <select v-model="form.block_system_type" :class="{ 'is-invalid': errors.block_system_type }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ujian Diblokir Setelah Mencapai Limit Keluar</option>
                                <option value="2">Hanya Sebagai Peringatan Agar Peserta Tidak Keluar Sesi Ujian</option>
                            </select>
                            <div v-if="errors.block_system_type" class="invalid-feedback">
                                {{ errors.block_system_type }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">TinyMCE - API Key</label>
                            <input type="text" class="form-control" v-model="form.tinymce_api_key" :class="{ 'is-invalid': errors.tinymce_api_key }" placeholder="TinyMCE - API Key">
                            <div v-if="errors.tinymce_api_key" class="invalid-feedback">
                                {{ errors.tinymce_api_key }}
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm btn-sm px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
    //import layout admin
    import LayoutAdmin from '../../../Layouts/Layout.vue';

    // import Link
    import { Link } from '@inertiajs/inertia-vue3';

    //import reactive
    import { reactive } from 'vue';

    // import Swal
    import Swal from 'sweetalert2';

    // import Head from Inertia
    import {
        Head
    } from '@inertiajs/inertia-vue3';

    import { Inertia } from '@inertiajs/inertia';

    export default {
        // layout
        layout: LayoutAdmin,

        // register components
        components: {
            Link,
            Head,
        },

        //props
        props: {
            errors: Object,
            setting: Object
        },

        // initialization composition API
        setup(props) {
            const form = reactive({
                app_name: props.setting.app_name,
                app_url: props.setting.app_url,
                whatsapp_number: props.setting.whatsapp_number,
                whatsapp_token: props.setting.whatsapp_token,
                logo: props.setting.logo,
                signed_name: props.setting.signed_name,
                signed_image: props.setting.signed_image,
                address: props.setting.address,
                add_activation_user: props.setting.add_activation_user ?? '',
                add_voucher_purchase: props.setting.add_voucher_purchase ?? '',
                login_type: props.setting.login_type ?? '',
                add_user_registration: props.setting.add_user_registration ?? '',
                registration_member_type: props.setting.registration_member_type ?? '',
                timezone: props.setting.timezone ?? '',
                block_system_type: props.setting.block_system_type ?? '',
                tinymce_api_key: props.setting.tinymce_api_key ?? '',
            });

            // submit method
            const submit = () => {
                // send data to server
                Inertia.post(`/admin/settings`, {
                    forceFormData: true,
                    // data
                    app_name: form.app_name,
                    app_url: form.app_url,
                    whatsapp_number: form.whatsapp_number,
                    whatsapp_token: form.whatsapp_token,
                    signed_name: form.signed_name,
                    signed_image: form.signed_image,
                    logo: form.logo,
                    address: form.address,
                    add_activation_user: form.add_activation_user,
                    add_voucher_purchase: form.add_voucher_purchase,
                    login_type: form.login_type,
                    add_user_registration: form.add_user_registration,
                    registration_member_type: form.registration_member_type,
                    timezone: form.timezone,
                    block_system_type: form.block_system_type,
                    tinymce_api_key: form.tinymce_api_key,
                }, {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Setting Berhasil Diupdate!.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    },
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
