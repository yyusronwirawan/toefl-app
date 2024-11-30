<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Data Voucher</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Voucher</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pembelian Voucher</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h4 class="mb-0 text-uppercase text-center">Pilih Voucher Sesuai Targetmu....</h4>
            <br>
            <h6 class="text-center">Scroll kebawah untuk melihat lebih banyak voucher</h6>
            <hr/>
            <div v-if="!vouchers.length">
                <div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12">
                    <div class="col">
                        <div class="card border-bottom border-3 border-0">
                            <div class="card-body">
                                <h5 class="card-title text-center">Voucher Belum Tersedia.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section: Pricing table -->
            <div class="pricing-table">
                <div v-if="$page.props.session.error" class="alert alert-danger border-0">
                    {{ $page.props.session.error }}
                </div>
                <div class="row row-cols-1 row-cols-lg-3">
                    <!-- Free Tier -->
                    <div class="col" v-for="(voucher, index) in vouchers" :key="index">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-header bg-primary py-3" v-if="voucher.category.name == 'TOEFL'">
                                <h5 class="card-title text-white text-center">{{ voucher.code }}</h5><br>
                                <h5 class="text-white text-center"><s>Rp.{{ formatPrice(voucher.price_before_discount) }}</s> <span class="badge bg-warning text-dark">{{ formatPrice((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100)}}%</span></h5>
                                <h6 class="card-price text-white text-center">Rp.{{ formatPrice(voucher.price_after_discount) }}<span class="term">/{{voucher.active_period}} {{ voucher.type }}</span></h6>
                            </div>
                            <div class="card-header bg-danger py-3" v-if="voucher.category.name == 'TOEIC'">
                                <h5 class="card-title text-white text-center">{{ voucher.code }}</h5><br>
                                <h5 class="text-white text-center"><s>Rp.{{ formatPrice(voucher.price_before_discount) }}</s> <span class="badge bg-warning text-dark">{{ formatPrice((voucher.price_before_discount - voucher.price_after_discount) / voucher.price_before_discount * 100)}}%</span></h5>
                                <h6 class="card-price text-white text-center">Rp.{{ formatPrice(voucher.price_after_discount) }}<span class="term">/{{voucher.active_period}} {{ voucher.type }}</span></h6>
                            </div>
                            <div class="card-body">
                                <h6 class="text-center">{{ voucher.name }}</h6>
                                <hr>
                                <div v-html="voucher.description" style="min-height:175px;"></div>
                                <hr>
                                <div v-if="voucher.user_limit && voucher.user_limit > voucher.voucher_selected_transacation_count">
                                    <h6 class="text-center">Tersisa {{ voucher.user_limit - voucher.voucher_selected_transacation_count }} kuota dari {{ voucher.user_limit }}</h6>
                                    <hr>
                                </div>
                                <div class="d-grid">
                                    <a href="#" @click.prevent="buyVoucher(voucher.id, voucher.category_id)" class="btn btn-outline-primary px-5 radius-30">Pilih Paket</a>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <!-- Section: Pricing table -->
        </div>
    </div>
    <!--end page wrapper -->
    <!--end page wrapper -->
</template>

<script>
    //import layout admin
    import LayoutUser from '../../../../Layouts/Layout.vue';

    // import Link
    import { Link } from '@inertiajs/inertia-vue3';

    //import sweet alert2
    import Swal from 'sweetalert2';

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
        },

        // props
        props: {
            vouchers: Object
        },

        setup() {
            const buyVoucher = (id, category_id) => {
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
                        Inertia.get(`/user/vouchers/${id}/buy?category_id=${category_id}`);
                        // Swal.fire({
                        //     title: 'Success!',
                        //     text: 'Pembelian Voucher Berhasil.',
                        //     icon: 'success',
                        //     timer: 1000,
                        //     showConfirmButton: false,
                        // });
                    }
                })
            }

            return {
                buyVoucher
            }
        },

        data() {
            return {
                colors: ['danger', 'primary', 'warning', 'success'],
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
