<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Data Peserta</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Peserta</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Peserta</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center">
                        <div class="ms-auto">
                            <Link href="/admin/students" class="btn btn-primary btn-sm mt-2 mt-lg-0">Kembali</Link>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <br>
                        <div v-if="$page.props.session.error" class="alert alert-danger border-0 alert-dismissible fade show">
                            <i class="fa fa-exclamation-triangle"></i>  {{ $page.props.session.error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <div v-if="$page.props.session.success" class="alert alert-success border-0 alert-dismissible fade show">
                            <i class="fa fa-exclamation-triangle"></i>  {{ $page.props.session.success }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>:</td>
                                    <td>{{ student.user.name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{ student.user.email }}</td>
                                </tr>
                                <tr>
                                    <th>Status Akun</th>
                                    <td>:</td>
                                    <td><span class="badge bg-primary">{{ student.user.is_active == 1 ? 'Aktif' : 'Non-Aktif' }}</span></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>:</td>
                                    <td>{{ student.gender == "M" ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Hp (WA)</th>
                                    <td>:</td>
                                    <td>{{ student.phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>:</td>
                                    <td>{{ student.province.name }}</td>
                                </tr>
                                <tr>
                                    <th>Kota/Kab</th>
                                    <td>:</td>
                                    <td>{{ student.city.name }}</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>:</td>
                                    <td>{{ student.district.name }}</td>
                                </tr>
                                <tr>
                                    <th>Desa/Kel</th>
                                    <td>:</td>
                                    <td>{{ student.village.name }}</td>
                                </tr>
                                <tr>
                                    <th>Status Member</th>
                                    <td>:</td>
                                    <td>{{ student.is_member == 0 ? 'Non-member' : 'Member' }}</td>
                                </tr>
                                <tr v-if="student.is_member == 0">
                                    <th>Kirim Reminder Member</th>
                                    <td>:</td>
                                    <td><Link :href="`/admin/users/${student.user_id}/member-reminder`" class="btn btn-success btn-sm">Kirim Reminder</Link></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
    //import layout admin
    import LayoutAdmin from '../../../../Layouts/Layout.vue';

    // import Link
    import { Link } from '@inertiajs/inertia-vue3';

    // import Head from Inertia
    import {
        Head
    } from '@inertiajs/inertia-vue3';

    export default {
        // layout
        layout: LayoutAdmin,

        // register components
        components: {
            Link,
            Head,
        },

        // props
        props: {
            student: Object
        },
    }
</script>
