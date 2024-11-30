<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Soal</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Try Out</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Soal</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <Link :href="`/user/categories`" class="btn btn-primary btn-sm mt-2 mt-lg-0">Kembali</Link>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr/>
            <div v-if="!exams.data.length">
                <div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12">
                    <div class="col">
                        <div class="card border-bottom border-3 border-0">
                            <div class="card-body">
                                <h5 class="card-title text-center">Soal Belum Tersedia.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="$page.props.session.error" class="alert alert-danger border-0">
                {{ $page.props.session.error }}
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3" v-for="(exam, index) in exams.data" :key="index">
                    <div class="card border-bottom border-3 border-0">
                        <div class="p-2">
                            <img  v-bind:src="'/storage/upload_files/categories/' + exam.category.thumbnail" class="card-img"/>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">{{ exam.title }}</h6>
                            <p class="card-text">Kerjakan Soal Sesuai Perintah Yang Ada Dalam Informasi.</p>
                            <hr>
                            <div class="text-center" v-if="$page.props.auth.user.member_type == 2 && $page.props.setting.add_voucher_purchase == 1">
                                <div v-if="exam.transaction.length > 0">
                                    <h5><span class="badge badge-pill bg-primary ms-1">Enrolled</span></h5>
                                </div>
                                <div v-else>
                                    <h5><span class="badge badge-pill bg-danger ms-1">Rp. {{ formatPrice(exam.price) }}</span></h5>
                                </div>
                                <hr>
                            </div>
                            <div class="text-center">
                                <div v-if="exam.transaction.length > 0 || $page.props.auth.user.member_type == 1 || $page.props.setting.add_voucher_purchase == 0">
                                    <Link :href="`/user/categories/${exam.category_id}/exams/${exam.id}`" class="btn btn-outline-primary w-100 btn-sm">Kerjakan Soal</Link>
                                </div>
                                <div v-else>
                                    <a href="#" @click.prevent="buyExam(exam.id)" class="btn btn-outline-primary w-100 btn-block btn-sm">Beli Paket Try Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="exams.data.length">
                <div class="col">
                    <Pagination :links="exams.links" align="center" />
                    <br>
                    <br>
                </div>
            </div>

            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
    //import layout admin
    import LayoutUser from '../../../../Layouts/Layout.vue';

    //import component pagination
    import Pagination from '../../../../Components/Pagination.vue';

    //import sweet alert2
    import Swal from 'sweetalert2';

    // import Link
    import { Link } from '@inertiajs/inertia-vue3';

    import { Inertia } from '@inertiajs/inertia';

    // import Head from Inertia
    import {
        Head
    } from '@inertiajs/inertia-vue3';


    export default {
        // layout
        layout: LayoutUser,

        // register components
        components: {
            Link,
            Head,
            Pagination
        },

        // props
        props: {
            exams: Object
        },
        setup() {
            const buyExam = (id) => {
                Swal.fire({
                    title: 'Apakah Anda yakin akan membeli paket ini ?',
                    text: "jika membeli paket ini, silakan lakukan konfirmasi",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        Inertia.get(`/user/transactions/exams/${id}/buy`);
                    }
                })
            }

            return {
                buyExam
            }
        },
        methods: {
            formatPrice(value) {
                let val = (value/1).toFixed().replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        }
    }
</script>
