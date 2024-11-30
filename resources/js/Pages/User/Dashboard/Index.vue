<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Dashboard</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show py-2" v-if="totalTransactionDone == 0 && $page.props.setting.add_voucher_purchase == 1 && $page.props.auth.user.member_type == 2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bx-tag-alt'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-1 text-white">Selamat Datang {{ $page.props.auth.user.name }} di {{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }}</h6>
                        <div class="text-white">Sebelum mengikuti try out, silakan lakukan transaksi terlebih dahulu ya, agar kamu dapat mengikuti berbagai macam jenis tes yang tersedia.</div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4" v-if="transactionSummaries.length > 0">
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Transaksi Pending</p>
                                        <h4 class="my-1">{{ totalTransactionPending }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class="bx bxs-wallet"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Transaksi Dibayar</p>
                                        <h4 class="my-1">{{ totalTransactionPaid }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-success text-success ms-auto"><i class="bx bxs-wallet"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Transaksi Failed</p>
                                        <h4 class="my-1">{{ totalTransactionFailed }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class="bx bxs-wallet"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-3 border-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Transaksi Selesai</p>
                                        <h4 class="my-1">{{ totalTransactionDone }}</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-primary text-primary ms-auto"><i class="bx bxs-wallet"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card radius-10 border-top border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-3">Pengumuman</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Perihal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="!announcementSummaries.length">
                                    <td colspan="7" align="center">Data Pengumuman kosong</td>
                                </tr>
                                <tr v-for="(announcementSummary, index) in announcementSummaries" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>{{ announcementSummary.title }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <Link :href="`/user/announcements/${announcementSummary.id}`" class="ms-2"><i class='bx bx-grid-alt'></i></Link>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card radius-10 border-top border-0 border-3 border-danger" v-if="transactionSummaries.length > 0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-3">Summary Transaksi Terakhir</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Kategori</th>
                                    <th>Judul Ujian</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="!transactionSummaries.length">
                                        <td colspan="6" align="center">Tidak ada riwayat traksaksi</td>
                                    </tr>
                                    <tr v-for="(transactionSummary, index) in transactionSummaries" :key="index">
                                        <td>{{ ++index }}</td>
                                        <td>{{ transactionSummary.code }}</td>
                                        <td>{{ transactionSummary.created_at }}</td>
                                        <td>{{ transactionSummary.exam.category.name }}</td>
                                        <td>{{ transactionSummary.exam.title }}</td>
                                        <td>
                                            <span class="badge bg-warning" v-if="transactionSummary.transaction_status == 'pending'">Pending</span>
                                            <span class="badge bg-primary" v-if="transactionSummary.transaction_status == 'paid'">Paid</span>
                                            <span class="badge bg-danger" v-if="transactionSummary.transaction_status == 'failed'">Failed</span>
                                            <span class="badge bg-success" v-if="transactionSummary.transaction_status == 'done'">Done</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
    //import layout admin
    import LayoutUser from '../../../Layouts/Layout.vue';

    // import Link
    import { Link } from '@inertiajs/inertia-vue3';

    // import Head from Inertia
    import {
        Head
    } from '@inertiajs/inertia-vue3';

    export default {
        // layout
        layout: LayoutUser,
        // register components
        components: {
            Head,
            Link,
        },
        // props
        props: {
            totalTransactionPending: Object,
            totalTransactionPaid: Object,
            totalTransactionDone: Object,
            totalTransactionFailed: Object,
            transactionSummaries: Object,
            announcementSummaries: Object,
            categories: Object,
        },
    }
</script>
