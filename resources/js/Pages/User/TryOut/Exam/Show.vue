<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Ujian</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Ujian</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Ujian</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <Link :href="`/user/categories/${exam.category_id}/exams`" class="btn btn-primary btn-sm mt-2 mt-lg-0">Kembali</Link>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="row">
                <div class="col-lg-12">
                    <div v-if="$page.props.session.error" class="alert alert-danger border-0">
                        <div v-html="$page.props.session.error"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="mb-0 text-white">Informasi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <div v-html="exam.description"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5 class="mb-0 text-white">Deskripsi Ujian</h5>
                        </div>
                        <div class="card-body">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $page.props.auth.user.name }}</td>
                                    </tr>

                                    <tr>
                                        <th width="300px">Email</th>
                                        <td width="2px">:</td>
                                        <td>{{ $page.props.auth.user.email ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td>:</td>
                                        <td>{{ $page.props.auth.user.username ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td>:</td>
                                        <td><span class="badge bg-primary">{{ exam.category.name }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Judul Ujian</th>
                                        <td>:</td>
                                        <td>{{ exam.title }}</td>
                                    </tr>
                                    <tr v-if="exam.exam_start_time">
                                            <th>Waktu Akses Mulai Latihan</th>
                                            <td>:</td>
                                            <td>{{ formatDateWithTimeHourMinute(exam.exam_start_time) }}</td>
                                        </tr>
                                        <tr v-if="exam.exam_end_time">
                                            <th>Waktu Berakhir Akses Latihan</th>
                                            <td>:</td>
                                            <td>{{ formatDateWithTimeHourMinute(exam.exam_end_time) }}</td>
                                        </tr>
                                    <tr>
                                        <td colspan="3">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div v-if="!grade">
                                                <div v-if="exam.exam_start_time || exam.exam_end_time">
                                                    <Link v-if="isExamActive($page.props.setting.timezone)" :href="`/user/exams/${exam.id}/exam-start`" class="btn btn-sm btn-primary">Mulai Kerjakan</Link>
                                                    <span v-else class="badge bg-danger">Latihan Soal Tidak Bisa di Akses</span>
                                                </div>
                                                <div v-else>
                                                    <Link :href="`/user/exams/${exam.id}/exam-start`" class="btn btn-sm btn-primary">Mulai Kerjakan</Link>
                                                </div>
                                            </div>
                                            <div v-else-if="grade && grade.is_finished == 0">
                                                <Link :href="`/user/exams/${exam.id}/exam-start`" class="btn btn-sm btn-warning">Lanjut Mengerjakan</Link>
                                            </div>
                                            <div v-else-if="grade && grade.is_finished == 1">
                                                <a href="#" @click.prevent="repeatExam()" class="btn btn-sm btn-secondary m-1" v-if="exam.repeat_the_exam == 1">Ulangi</a>
                                                <Link :href="`/user/grades/${grade.id}`" class="btn btn-sm btn-success m-1">Hasil</Link>
                                                <Link :href="`/user/grades/${grade.id}/questions`" v-if="exam.show_answer_discussion == 1" class="btn btn-sm btn-primary m-1">Pembahasan</Link>
                                            </div>
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
    import LayoutAdmin from '../../../../Layouts/Layout.vue';

    // import Link
    import { Link } from '@inertiajs/inertia-vue3';

    import moment from 'moment-timezone';

    // import Head from Inertia
    import {
        Head
    } from '@inertiajs/inertia-vue3';

    //import sweet alert2
    import Swal from 'sweetalert2';

    import { Inertia } from '@inertiajs/inertia';

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
            exam: Object,
            grade: Object,
        },
        setup(props) {
            const repeatExam = () => {
                Swal.fire({
                    title: 'Konfirmasi Ulangi Pengerjaan',
                    text: "Mengulangi Ujian Dapat Mempengaruhi Nilai Anda.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ulangi Ujian'
                })
                .then((result) => {
                    if (result.isConfirmed) {

                        Inertia.get(`/user/exams/${props.exam.id}/exam-start?repeat=1`);

                        Swal.fire({
                            title: 'Success!',
                            text: 'Silakan Untuk Mengerjakan Kembali.',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false,
                        });
                    }
                })
            }

            const isExamActive = (timezone) => {
                const now = moment().tz(timezone);
                const startTime = moment(props.exam.exam_start_time);
                const endTime = moment(props.exam.exam_end_time);
                return (
                    (props.exam.exam_start_time && now.isSameOrAfter(startTime) && props.exam.exam_end_time && now.isSameOrBefore(endTime)) ||
                    (props.exam.exam_start_time && now.isSameOrAfter(startTime) && (props.exam.exam_end_time == null || props.exam.exam_end_time == undefined)) ||
                    (props.exam.exam_end_time && now.isSameOrBefore(endTime) && (props.exam.exam_start_time == null || props.exam.exam_start_time == undefined))
                );
            }

            return {
                repeatExam,
                isExamActive  
            }
        }
    }
</script>
