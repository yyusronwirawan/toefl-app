<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Riwayat Ujian</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Riwayat Ujian</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Riwayat Latihan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="text-start">
                            <h5 class="mb-0">Informasi Ujian</h5>
                        </div>
                        <div class="ms-auto">
                            <a target="_blank" :href="`/user/grades/${grade.id}/certificate`" v-if="grade.exam.print_certificate == 1" class="btn btn-danger btn-sm mt-2 mt-lg-0 mx-1">Cetak Sertifikat</a>
                            <Link href="/user/grades" class="btn btn-primary btn-sm">Kembali</Link>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th width="170px">Kategori</th>
                                    <td width="10px">:</td>
                                    <td><span class="badge bg-primary">{{ grade.category.name }}</span></td>
                                </tr>
                                <tr>
                                    <th>Judul Ujian</th>
                                    <td>:</td>
                                    <td>{{ grade.exam.title }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Mulai</th>
                                    <td>:</td>
                                    <td>{{ formatDateWithTime(grade.start_time) }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu Selesai</th>
                                    <td>:</td>
                                    <td>{{ formatDateWithTime(grade.end_time) }}</td>
                                </tr>
                                <tr>
                                    <th>Nilai</th>
                                    <td>:</td>
                                    <td><h5>{{ grade.grade }}</h5></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="card" v-if="grade.grade_details && grade.exam.question_title.add_value_category == 1 && grade.exam.question_title.assessment_type == 1">
                <div class="card-header bg-primary mb-3">
                    <div class="d-flex justify-content-between">
                        <div class="text-start">
                            <h5 class="mb-0 text-white">Detail Nilai Per Kategori</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori Penilaian</th>
                                    <th>Total Benar</th>
                                    <th>Total Salah</th>
                                    <th>Nilai Konversi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="grade.grade_details.length" v-for="(gradeDetail, index) in grade.grade_details" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>{{ gradeDetail.grade_category_name }}</td>
                                    <td>{{ gradeDetail.total_correct }}</td>
                                    <td>{{ gradeDetail.total_wrong }}</td>
                                    <td>{{ gradeDetail.grade }}</td>
                                </tr>
                                <tr v-if="grade.grade_details.length">
                                    <th colspan="4">Nilai</th>
                                    <th>{{ grade.grade }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="card" v-if="grade.exam.show_ranking == 1">
                <div class="card-header bg-primary mb-3">
                    <div class="d-flex justify-content-between">
                        <div class="text-start">
                            <h5 class="mb-0 text-white">Ranking di Ujian ini</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Nama</th>
                                    <th>Provinsi</th>
                                    <th>Kota</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(rankingExam, index) in rankingExams.data" :key="index">
                                    <td>
                                        <span class="badge bg-primary">{{ ++index + (rankingExams.current_page - 1) * rankingExams.per_page }}</span>
                                    </td>
                                    <td>{{ rankingExam.user.name }}</td>
                                    <td>{{ rankingExam.user.student && rankingExam.user.student.province ? rankingExam.user.student.province.name :  '-' }}</td>
                                    <td>{{ rankingExam.user.student && rankingExam.user.student.city ? rankingExam.user.student.city.name :  '-' }}</td>
                                    <th>{{ rankingExam.grade }}</th>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="rankingExams.links" align="end" />

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

    //import component pagination
    import Pagination from '../../../../Components/Pagination.vue';

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
            Pagination
        },

        // props
        props: {
            grade: Object,
            rankingExams: Object,
            answers: Object,
        },
    }
</script>
