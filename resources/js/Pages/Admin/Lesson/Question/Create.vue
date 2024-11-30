<template>
    <Head>
        <title>{{ $page.props.app_name }} - Tambah Soal</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Soal</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Soal</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <!-- {{  errors }} -->
            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center">
                        <div class="ms-auto">
                            <Link :href="`/admin/question-titles/${questionTitle.id}/questions`" class="btn btn-primary btn-sm mt-2 mt-lg-0">Kembali</Link>
                        </div>
                    </div>
                    <form @submit.prevent="submit" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Tipe</label>
                            <select v-model="form.type" :class="{ 'is-invalid': errors.type }" class="form-select">
                                <option value="1">Pertanyaan (Question)</option>
                                <option value="2">Petunjuk (Direction)</option>
                            </select>
                            <div v-if="errors.type" class="invalid-feedback">
                                {{ errors.type }}
                            </div>
                        </div>
                        <div v-if="questionTitle.add_value_category == 1 && questionTitle.assessment_type == 1" class="col-12">
                            <label class="form-label">Kategori Penilaian</label>
                            <select v-model="form.value_category_id" :class="{ 'is-invalid': errors.value_category_id }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option v-for="(valueCategory, index) in valueCategories" :key="index" :value="valueCategory.id">
                                    {{ valueCategory.name }}
                                </option>
                            </select>
                            <div v-if="errors.value_category_id" class="invalid-feedback">
                                {{ errors.value_category_id }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tambah Audio</label>
                            <select v-model="form.audio_input" :class="{ 'is-invalid': errors.audio_input }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                            <div v-if="errors.audio_input" class="invalid-feedback">
                                {{ errors.audio_input }}
                            </div>
                        </div>
                        <div class="col-12" v-if="form.audio_input == 1">
                            <label class="form-label">Audio</label>
                            <input type="file" class="form-control" @input="form.audio = $event.target.files[0]" :class="{ 'is-invalid': errors.audio }" placeholder="Audio">
                            <div v-if="errors.audio" class="invalid-feedback">
                                {{ errors.audio }}
                            </div>
                        </div>
                        <div class="col-12" v-if="form.audio_input == 1">
                            <label class="form-label">Batasan Audio Bisa Diputar</label>
                            <input type="number" class="form-control" v-model="form.audio_played_limit" :class="{ 'is-invalid': errors.audio_played_limit }" placeholder="Batasan Audio Bisa Diputar">
                            <div v-if="errors.audio_played_limit" class="invalid-feedback">
                                {{ errors.audio_played_limit }}
                            </div>
                        </div>
                        <div v-if="form.type == 2" class="col-12">
                            <label class="form-label"><b>Direction</b></label>
                            <Editor
                                api-key="sy5v0kqs49ugpsv8snsegptqrxysapo4zq1yn9ob0spq2gyx"
                                v-model="form.direction"
                                :init="{
                                    automatic_uploads: true,
                                    height: 400,
                                    external_plugins: {
                                        'tiny_mce_wiris' : '/assets/plugins/wiris/mathtype-tinymce5/plugin.min.js'
                                    },
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                    ],
                                    draggable_modal: true,
                                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                                    image_advtab: true,
                                    image_title: true,
                                    automatic_uploads: true,
                                    images_upload_url: '/upload',
                                    file_picker_types: 'image',
                                    file_picker_callback: function(cb, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');
                                        input.onchange = function() {
                                            var file = this.files[0];

                                            var reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = function () {
                                                var id = 'blobid' + (new Date()).getTime();
                                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                                var base64 = reader.result.split(',')[1];
                                                var blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);
                                                cb(blobInfo.blobUri(), { title: file.name });
                                            };
                                        };
                                        input.click();
                                    }
                                }"
                            />
                            <div v-if="errors.direction">
                                {{ errors.direction }}
                            </div>
                        </div>
                        <div class="col-12" v-if="form.type == 1 && form.audio_input == 1">
                            <label class="form-label">Batas Waktu Menjawab (Detik), Input 0 Jika Tidak Ada Batasan</label>
                            <input type="number" class="form-control" v-model="form.audio_answer_time" :class="{ 'is-invalid': errors.audio_answer_time }" placeholder="Batas Waktu Menjawab Sesudah Audio Di Putar">
                            <div v-if="errors.audio_answer_time" class="invalid-feedback">
                                {{ errors.audio_answer_time }}
                            </div>
                        </div>
                        <div v-if="form.type == 1" class="col-12">
                            <label class="form-label"><b>Soal</b></label>
                            <Editor
                                api-key="sy5v0kqs49ugpsv8snsegptqrxysapo4zq1yn9ob0spq2gyx"
                                v-model="form.question"
                                :init="{
                                    automatic_uploads: true,
                                    height: 400,
                                    external_plugins: {
                                        'tiny_mce_wiris' : '/assets/plugins/wiris/mathtype-tinymce5/plugin.min.js'
                                    },
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                    ],
                                    draggable_modal: true,
                                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | rtl ltr |tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                                    image_advtab: true,
                                    image_title: true,
                                    automatic_uploads: true,
                                    images_upload_url: '/upload',
                                    file_picker_types: 'image',
                                    file_picker_callback: function(cb, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');
                                        input.onchange = function() {
                                            var file = this.files[0];

                                            var reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = function () {
                                                var id = 'blobid' + (new Date()).getTime();
                                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                                var base64 = reader.result.split(',')[1];
                                                var blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);
                                                cb(blobInfo.blobUri(), { title: file.name });
                                            };
                                        };
                                        input.click();
                                    }
                                }"
                            />
                            <div v-if="errors.question">
                                {{ errors.question }}
                            </div>
                        </div>

                        <hr>

                        <div v-if="1 <= questionTitle.total_choices && form.type == 1" class="col-12">
                            <label class="form-label"><b>Pilihan A</b></label>
                            <Editor
                                api-key="sy5v0kqs49ugpsv8snsegptqrxysapo4zq1yn9ob0spq2gyx"
                                v-model="form.option_1"
                                :init="{
                                    automatic_uploads: true,
                                    height: 400,
                                    external_plugins: {
                                        'tiny_mce_wiris' : '/assets/plugins/wiris/mathtype-tinymce5/plugin.min.js'
                                    },
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                    ],
                                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | rtl ltr | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                                    image_advtab: true,
                                    image_title: true,
                                    automatic_uploads: true,
                                    images_upload_url: '/upload',
                                    file_picker_types: 'image',
                                    file_picker_callback: function(cb, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');
                                        input.onchange = function() {
                                            var file = this.files[0];
                                            var reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = function () {
                                                var id = 'blobid' + (new Date()).getTime();
                                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                                var base64 = reader.result.split(',')[1];
                                                var blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);
                                                cb(blobInfo.blobUri(), { title: file.name });
                                            };
                                        };
                                        input.click();
                                    }
                                }"
                            />
                            <div v-if="errors.option_1">
                                {{ errors.option_1 }}
                            </div>
                        </div>

                        <div v-if="2 <= questionTitle.total_choices && form.type == 1" class="col-12">
                            <label class="form-label"><b>Pilihan B</b></label>
                            <Editor
                                api-key="sy5v0kqs49ugpsv8snsegptqrxysapo4zq1yn9ob0spq2gyx"
                                v-model="form.option_2"
                                :init="{
                                    automatic_uploads: true,
                                    height: 400,
                                    external_plugins: {
                                        'tiny_mce_wiris' : '/assets/plugins/wiris/mathtype-tinymce5/plugin.min.js'
                                    },
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                    ],
                                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | rtl ltr | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                                    image_advtab: true,
                                    image_title: true,
                                    automatic_uploads: true,
                                    images_upload_url: '/upload',
                                    file_picker_types: 'image',
                                    file_picker_callback: function(cb, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');
                                        input.onchange = function() {
                                            var file = this.files[0];

                                            var reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = function () {
                                                var id = 'blobid' + (new Date()).getTime();
                                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                                var base64 = reader.result.split(',')[1];
                                                var blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);
                                                cb(blobInfo.blobUri(), { title: file.name });
                                            };
                                        };
                                        input.click();
                                    }
                                }"
                            />
                            <div v-if="errors.option_2">
                                {{ errors.option_2 }}
                            </div>
                        </div>

                        <div v-if="3 <= questionTitle.total_choices && form.type == 1" class="col-12">
                            <label class="form-label"><b>Pilihan C</b></label>
                            <Editor
                                api-key="sy5v0kqs49ugpsv8snsegptqrxysapo4zq1yn9ob0spq2gyx"
                                v-model="form.option_3"
                                :init="{
                                    automatic_uploads: true,
                                    height: 400,
                                    external_plugins: {
                                        'tiny_mce_wiris' : '/assets/plugins/wiris/mathtype-tinymce5/plugin.min.js'
                                    },
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                    ],
                                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | rtl ltr | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                                    image_advtab: true,
                                    image_title: true,
                                    automatic_uploads: true,
                                    images_upload_url: '/upload',
                                    file_picker_types: 'image',
                                    file_picker_callback: function(cb, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');
                                        input.onchange = function() {
                                            var file = this.files[0];

                                            var reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = function () {
                                                var id = 'blobid' + (new Date()).getTime();
                                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                                var base64 = reader.result.split(',')[1];
                                                var blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);
                                                cb(blobInfo.blobUri(), { title: file.name });
                                            };
                                        };
                                        input.click();
                                    }
                                }"
                            />
                            <div v-if="errors.option_3">
                                {{ errors.option_3 }}
                            </div>
                        </div>

                        <div v-if="4 <= questionTitle.total_choices && form.type == 1" class="col-12">
                            <label class="form-label"><b>Pilihan D</b></label>
                            <Editor
                                api-key="sy5v0kqs49ugpsv8snsegptqrxysapo4zq1yn9ob0spq2gyx"
                                v-model="form.option_4"
                                :init="{
                                    automatic_uploads: true,
                                    height: 400,
                                    external_plugins: {
                                        'tiny_mce_wiris' : '/assets/plugins/wiris/mathtype-tinymce5/plugin.min.js'
                                    },
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                    ],
                                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | rtl ltr | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                                    image_advtab: true,
                                    image_title: true,
                                    automatic_uploads: true,
                                    images_upload_url: '/upload',
                                    file_picker_types: 'image',
                                    file_picker_callback: function(cb, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');
                                        input.onchange = function() {
                                            var file = this.files[0];

                                            var reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = function () {
                                                var id = 'blobid' + (new Date()).getTime();
                                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                                var base64 = reader.result.split(',')[1];
                                                var blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);
                                                cb(blobInfo.blobUri(), { title: file.name });
                                            };
                                        };
                                        input.click();
                                    }
                                }"
                            />
                            <div v-if="errors.option_4">
                                {{ errors.option_4 }}
                            </div>
                        </div>

                        <div v-if="5 <= questionTitle.total_choices && form.type == 1" class="col-12">
                            <label class="form-label"><b>Pilihan E</b></label>
                            <Editor
                                api-key="sy5v0kqs49ugpsv8snsegptqrxysapo4zq1yn9ob0spq2gyx"
                                v-model="form.option_5"
                                :init="{
                                    automatic_uploads: true,
                                    height: 400,
                                    external_plugins: {
                                        'tiny_mce_wiris' : '/assets/plugins/wiris/mathtype-tinymce5/plugin.min.js'
                                    },
                                    plugins: [
                                        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                        'searchreplace wordcount visualblocks visualchars code fullscreen',
                                        'insertdatetime media nonbreaking save table contextmenu directionality',
                                        'emoticons template paste textcolor colorpicker textpattern imagetools'
                                    ],
                                    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | rtl ltr | tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry',
                                    image_advtab: true,
                                    image_title: true,
                                    automatic_uploads: true,
                                    images_upload_url: '/upload',
                                    file_picker_types: 'image',
                                    file_picker_callback: function(cb, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');
                                        input.onchange = function() {
                                            var file = this.files[0];

                                            var reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onload = function () {
                                                var id = 'blobid' + (new Date()).getTime();
                                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                                var base64 = reader.result.split(',')[1];
                                                var blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);
                                                cb(blobInfo.blobUri(), { title: file.name });
                                            };
                                        };
                                        input.click();
                                    }
                                }"
                            />
                            <div v-if="errors.option_5">
                                {{ errors.option_5 }}
                            </div>
                        </div>

                        <div v-if="form.type == 1" class="col-12">
                            <label class="form-label"><b>Jawaban</b></label>
                            <select v-model="form.answer" :class="{ 'is-invalid': errors.answer }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">C</option>
                                <option value="4">D</option>
                                <option value="5">E</option>
                            </select>
                            <div v-if="errors.answer" class="invalid-feedback">
                                {{ errors.answer }}
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

    export default {
        // layout
        layout: LayoutAdmin,

        // register components
        components: {
            Link,
            Head,
            Editor,
        },

        //props
        props: {
            errors: Object,
            questionTitle: Object,
            valueCategories: Object,
            optionAlphabet: Array,
        },
        // initialization composition API
        setup(props) {
            const form = reactive({
                value_category_id: '',
                audio_input: '',
                audio: '',
                audio_played_limit: '',
                audio_answer_time: '',
                question: '',
                option_1: '',
                option_2: '',
                option_3: '',
                option_4: '',
                option_5: '',
                answer: '',
                type: 1,
                direction: '',
            });

            // submit method
            const submit = () => {
                // send data to server
                Inertia.post(`/admin/question-titles/${props.questionTitle.id}/questions`, {
                    forceFormData: true,
                    // data
                    add_value_category: props.questionTitle.add_value_category,
                    question_title_id: props.questionTitle.id,
                    value_category_id: form.value_category_id,
                    audio_input: form.audio_input,
                    audio: form.audio,
                    audio_played_limit: form.audio_played_limit,
                    audio_answer_time: form.audio_answer_time,
                    question: form.question,
                    option_1: form.option_1,
                    option_2: form.option_2,
                    option_3: form.option_3,
                    option_4: form.option_4,
                    option_5: form.option_5,            
                    answer: form.answer,
                    type: form.type,
                    direction: form.direction,
                }, {
                    onSuccess: (response) => {
                        console.log(response);
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Data Berhasil Disimpan!.',
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
