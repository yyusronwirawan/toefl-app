<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }}  - Tambah Ujian</title>
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
                            <li class="breadcrumb-item active" aria-current="page">Tambah Ujian</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center">
                        <div class="ms-auto">
                            <Link href="/admin/exams" class="btn btn-primary btn-sm mt-2 mt-lg-0">Kembali</Link>
                        </div>
                    </div>
                    <form @submit.prevent="submit" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Kategori Peminatan</label>
                            <select  @change="questionTitleData" v-model="form.category_id" :class="{ 'is-invalid': errors.category_id }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option v-for="(category, index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                            </select>
                            <div v-if="errors.category_id" class="invalid-feedback">
                                {{ errors.category_id }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Paket Soal</label>
                            <select v-model="form.question_title_id" :class="{ 'is-invalid': errors.question_title_id }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option v-for="questionTitle in form.questionTitles" :value="questionTitle.id">{{ questionTitle.name }}</option>
                            </select>
                            <div v-if="errors.question_title_id" class="invalid-feedback">
                                {{ errors.question_title_id }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Template Sertifikat</label>
                            <select v-model="form.template_id" :class="{ 'is-invalid': errors.template_id }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option v-for="template in templates" :value="template.id">{{ template.name }}</option>
                            </select>
                            <div v-if="errors.template_id" class="invalid-feedback">
                                {{ errors.template_id }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Jenis Waktu Ujian</label>
                            <select v-model="form.duration_type" :class="{ 'is-invalid': errors.duration_type }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Satu Waktu</option>
                                <option value="2">Waktu Per Section</option>
                            </select>
                            <div v-if="errors.duration_type" class="invalid-feedback">
                                {{ errors.duration_type }}
                            </div>
                        </div>
                        <div class="col-12" v-if="form.duration_type == 1">
                            <label class="form-label">Durasi Seluruh Ujian (Menit)</label>
                            <input type="number" class="form-control" v-model="form.duration" :class="{ 'is-invalid': errors.duration }" placeholder="Durasi">
                            <div v-if="errors.duration" class="invalid-feedback">
                                {{ errors.duration }}
                            </div>
                        </div>
                        <div v-if="form.duration_type == 2" v-for="(valueCategory, index) in form.valueCategories" :key="index" class="col-12">
                            <label class="form-label">Durasi {{ valueCategory.name }} (Menit)</label>
                            <input type="number" class="form-control" v-model="form.duration_section[index]" placeholder="Durasi">
                            <div v-if="errors.duration_section + '.' + index" class="invalid-feedback">
                                {{ errors.duration_section + '.' + index }}
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Judul Ujian</label>
                            <input type="text" class="form-control" v-model="form.title" :class="{ 'is-invalid': errors.title }" placeholder="Judul Ujian">
                            <div v-if="errors.title" class="invalid-feedback">
                                {{ errors.title }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" v-model="form.price" :class="{ 'is-invalid': errors.price }" placeholder="Harga">
                            <div v-if="errors.price" class="invalid-feedback">
                                {{ errors.price }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Ujian</label>
                            <Editor
                                :api-key="$page.props.setting.tinymce_api_key"
                                v-model="form.description"
                                :init="{
                                    images_upload_url: '/upload',
                                    automatic_uploads: true,
                                    height: 400,
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                    ],
                                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons',
                                    image_advtab: true,
                                }"
                            />
                            <div v-if="errors.description">
                                {{ errors.description }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Soal Acak</label>
                            <select v-model="form.random_question" :class="{ 'is-invalid': errors.random_question }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.random_question" class="invalid-feedback">
                                {{ errors.random_question }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Jawaban Acak</label>
                            <select v-model="form.random_answer" :class="{ 'is-invalid': errors.random_answer }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.random_answer" class="invalid-feedback">
                                {{ errors.random_answer }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tampilkan Jawaban</label>
                            <select v-model="form.show_answer" :class="{ 'is-invalid': errors.show_answer }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.show_answer" class="invalid-feedback">
                                {{ errors.show_answer }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tampilkan Navigasi Nomor Soal</label>
                            <select v-model="form.show_question_number_navigation" :class="{ 'is-invalid': errors.show_question_number_navigation }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.show_question_number_navigation" class="invalid-feedback">
                                {{ errors.show_question_number_navigation }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tampilkan Nomor Soal</label>
                            <select v-model="form.show_question_number" :class="{ 'is-invalid': errors.show_question_number }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.show_question_number" class="invalid-feedback">
                                {{ errors.show_question_number }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pertanyaan Selanjutnya Secara Otomatis</label>
                            <select v-model="form.next_question_automatically" :class="{ 'is-invalid': errors.next_question_automatically }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.next_question_automatically" class="invalid-feedback">
                                {{ errors.next_question_automatically }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tampilkan Button Sebelum & Selanjutnya</label>
                            <select v-model="form.show_prev_next_button" :class="{ 'is-invalid': errors.show_prev_next_button }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                            <div v-if="errors.show_prev_next_button" class="invalid-feedback">
                                {{ errors.show_prev_next_button }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tipe Pilihan Ganda</label>
                            <select v-model="form.type_option" :class="{ 'is-invalid': errors.type_option }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Button Option dan Soal Menyatu (Normal)</option>
                            </select>
                            <div v-if="errors.type_option" class="invalid-feedback">
                                {{ errors.type_option }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tampilan Button Akhiri Ujian / Sesi Selanjutnya</label>
                            <select v-model="form.button_type_finish" :class="{ 'is-invalid': errors.button_type_finish }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ditampilkan Pada Setiap Soal</option>
                                <option value="2">Hanya Ditampilkan Pada Soal Terakhir</option>
                            </select>
                            <div v-if="errors.button_type_finish" class="invalid-feedback">
                                {{ errors.button_type_finish }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Peserta Dapat Mengulangi Ujian</label>
                            <select v-model="form.repeat_the_exam" :class="{ 'is-invalid': errors.repeat_the_exam }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <div v-if="errors.repeat_the_exam" class="invalid-feedback">
                                {{ errors.repeat_the_exam }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Peserta Dapat Mencetak Sertifikat</label>
                            <select v-model="form.print_certificate" :class="{ 'is-invalid': errors.print_certificate }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <div v-if="errors.print_certificate" class="invalid-feedback">
                                {{ errors.print_certificate }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Masa Berlaku Sertifikat (Kosongkan Jika Tidak Ada)</label>
                            <div class="input-group">
                                <input type="number" class="form-control" v-model="form.valid_until" :class="{ 'is-invalid': errors.valid_until }" placeholder="Masa Berlaku" min="1">
                                <span class="input-group-text" id="basic-addon2">Tahun</span>
                            </div>
                            <div v-if="errors.valid_until" class="invalid-feedback">
                                {{ errors.valid_until }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tampilkan Ranking Ujian</label>
                            <select v-model="form.show_ranking" :class="{ 'is-invalid': errors.show_ranking }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <div v-if="errors.show_ranking" class="invalid-feedback">
                                {{ errors.show_ranking }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Waktu Akses Mulai Ujian (Optional)</label>
                            <input type="datetime-local" class="form-control" v-model="form.exam_start_time" :class="{ 'is-invalid': errors.exam_start_time }" placeholder="Waktu Mulai Ujian">
                            <div v-if="errors.exam_start_time" class="invalid-feedback">
                                {{ errors.exam_start_time }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Waktu Berakhir Akses Ujian (Optional)</label>
                            <input type="datetime-local" class="form-control" v-model="form.exam_end_time" :class="{ 'is-invalid': errors.exam_end_time }" placeholder="Waktu Selesai Ujian">
                            <div v-if="errors.exam_end_time" class="invalid-feedback">
                                {{ errors.exam_end_time }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Maksimal Toleransi Keluar Tes (Kosongkan Jika Tidak Ada)</label>
                            <input type="number" class="form-control" v-model="form.total_tolerance" :class="{ 'is-invalid': errors.total_tolerance }" placeholder="Maksimal Toleransi Keluar Tes" min="0">
                            <div v-if="errors.total_tolerance" class="invalid-feedback">
                                {{ errors.total_tolerance }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Status Ujian</label>
                            <select v-model="form.exam_status" :class="{ 'is-invalid': errors.exam_status }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="active">Aktive</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div v-if="errors.exam_status" class="invalid-feedback">
                                {{ errors.exam_status }}
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm px-5">Submit</button>
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
    import LayoutAdmin from '../../../../Layouts/Layout.vue';

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

    //import tinyMCE
    import Editor from '@tinymce/tinymce-vue';

    //import axios
    import axios from 'axios';

    export default {
        // layout
        layout: LayoutAdmin,

        // register components
        components: {
            Link,
            Head,
            Editor
        },

        //props
        props: {
            errors: Object,
            categories: Object,
            templates: Object,
        },

        // initialization composition API
        setup() {
            const form = reactive({
                category_id: '',
                question_title_id: '',
                template_id: '',
                title: '',
                duration: '',
                description: '',
                random_question: '',
                random_answer: '',
                show_answer: '',
                show_question_number_navigation: '',
                show_question_number: '',
                next_question_automatically: '',
                show_prev_next_button: '',
                type_option: '',
                price: '',
                duration_type: '',
                value_category_id:'',
                button_type_finish: '',
                repeat_the_exam: '',
                print_certificate: '',
                valid_until: '',
                show_ranking: '',
                exam_start_time: '',
                exam_end_time: '',
                total_tolerance: '',
                exam_status: '',
                duration_section: [],

                // get form API
                questionTitles: [],
                valueCategories: [],
            });

            const questionTitleData = () => {
                form.question_title_id = '';
                axios.get(`/admin/categories/${form.category_id}/question-titles`).then(response => {
                    form.questionTitles = response.data;
                }).catch(error => console.error(error));

                form.value_category_id = '';
                axios.get(`/admin/categories/${form.category_id}/value-categories`).then(response => {
                    form.valueCategories = response.data;
                }).catch(error => console.error(error));
            }

            // submit method
            const submit = () => {
                console.log(form.duration_section);
                // send data to server
                Inertia.post('/admin/exams', {
                    // data
                    category_id: form.category_id,
                    question_title_id: form.question_title_id,
                    template_id: form.template_id,
                    title: form.title,
                    duration: form.duration,
                    description: form.description,
                    random_question: form.random_question,
                    random_answer: form.random_answer,
                    show_answer: form.show_answer,
                    show_question_number_navigation: form.show_question_number_navigation,
                    show_question_number: form.show_question_number,
                    next_question_automatically: form.next_question_automatically,
                    show_prev_next_button: form.show_prev_next_button,
                    type_option: form.type_option,
                    price: form.price,
                    duration_type: form.duration_type,
                    duration_section: form.duration_section,
                    button_type_finish: form.button_type_finish,
                    repeat_the_exam: form.repeat_the_exam,
                    print_certificate: form.print_certificate,
                    valid_until: form.valid_until,
                    show_ranking: form.show_ranking,
                    exam_start_time: form.exam_start_time,
                    exam_end_time: form.exam_end_time,
                    total_tolerance: form.total_tolerance,
                    exam_status: form.exam_status,
                }, {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Ujian Berhasil Disimpan!.',
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
                questionTitleData,
            }
        }
    }
</script>
