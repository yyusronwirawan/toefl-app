<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Try Out</title>
    </Head>

    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded fixed-top rounded-0 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <!-- <img src="/assets/images/logo-img.png" width="140" alt="" /> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"> <a class="nav-link" aria-current="page" href="/user/dashboard"><i class='bx bx-home-alt me-1'></i>Home</a></li>
                    <li class="nav-item"> <Link class="nav-link" href="/logout" method="POST"><i class='bx bx-log-out-circle'></i>Logout</Link></li>
                </ul>
            </div>
        </div>
    </nav>
    <!--start page wrapper -->
    <div class="container" style="margin-top: 100px;margin-bottom: 100px;">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12" :class="exam.show_question_number_navigation == 1 && questionLists[indexPage]['type'] == 1 ? 'col-lg-8' : 'col-lg-12'">
                <div class="card">
                    <div class="card-header bg-primary mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <div v-if="exam.show_question_number == 1">
                                    <h4 class="mb-0 text-white"><span class="badge bg-danger" v-if="questionLists[indexPage]['type'] == 1">Question {{ questionLists[indexPage]['navigation_order'] }}</span></h4>
                                    <h4 class="mb-0 text-white"><span class="badge bg-danger" v-if="questionLists[indexPage]['type'] == 2">Directions</span></h4>
                                </div>
                            </div>
                            <div class="text-end">
                                <VueCountdown :transform="transform" :time="duration" @progress="handleChangeDuration" @end="showModalEndTimeExam = true" v-slot="{ hours, minutes, seconds }">
                                    <h4 class="mb-0 text-white">
                                        <span class="badge bg-danger">{{ hours }} : {{ minutes }} : {{ seconds }}</span>
                                    </h4>
                                </VueCountdown>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div v-if="questionLists[indexPage]">
                            <div v-if="questionLists[indexPage]['audio_input'] == 1">
                                    <div style="min-height: 75px;" class="text-center">
                                        <p>Audio play limit : {{ questionLists[indexPage]['audio_played_limit'] - getAudioPlayedLimit(questionLists[indexPage]['question_id']) <= 0 ? 0 : questionLists[indexPage]['audio_played_limit'] - getAudioPlayedLimit(questionLists[indexPage]['question_id'])  }}</p>
                                        <div v-if="questionLists[indexPage]['audio_played_limit'] == (getAudioPlayedLimit(questionLists[indexPage]['question_id']))">
                                            <VueCountdown v-if="questionLists[indexPage]['audio_answer_time'] > 0" :transform="transform" :time="questionLists[indexPage]['audio_answer_time']" @progress="handleChangeDurationListening" @end="endedAudio(questionLists[indexPage]['question_id'], 'nextPage')" v-slot="{ hours, minutes, seconds }">
                                                <p><b>Time Remaining</b></p>
                                                <h5 class="mb-0 text-white">
                                                    <span class="badge bg-danger">{{ hours }}</span> :
                                                    <span class="badge bg-danger">{{ minutes }}</span> :
                                                    <span class="badge bg-danger">{{ seconds }}</span>
                                                </h5>
                                            </VueCountdown>
                                        </div>
                                        <div v-if="(questionLists[indexPage]['audio_answer_time'] == 0 && getAudioPlayedLimit(questionLists[indexPage]['question_id']) == questionLists[indexPage]['audio_played_limit']) || getAudioPlayedLimit(questionLists[indexPage]['question_id']) > questionLists[indexPage]['audio_played_limit']">
                                            <audio controls controlsList="noremoteplayback nodownload noplaybackrate">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                        <div v-if="getAudioPlayedLimit(questionLists[indexPage]['question_id']) < questionLists[indexPage]['audio_played_limit']" class="text-center" id="audioDiv">
                                            <button id="playButtonAudio" v-on:click="playAudio" class="btn btn-secondary btn-sm" style="display:none; position:absolute; z-index: 1;margin-top:10px;margin-left:15px; height:36px;width: 36px;border-radius: 50%;"><i class="bx bx-play"></i></button>
                                            <audio id="myAudio" v-on:playing="removePause" controls v-bind:autoplay="true" controlsList="noremoteplayback nodownload" v-on:ended="endedAudio(questionLists[indexPage]['question_id'])" v-bind:src="'/storage/upload_files/questions/' + questionLists[indexPage]['audio']">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>
                                    <hr style="border:1px solid red;">
                                </div>
                            <div v-if="questionLists[indexPage]['type'] == 1">
                                <div v-html="questionLists[indexPage]['question']" class="prevent-select"></div>
                            </div>
                            <div v-if="questionLists[indexPage]['type'] == 2">
                                <div v-html="questionLists[indexPage]['direction']" class="prevent-select"></div>
                            </div>
                            <table>
                                <tbody v-if="exam.type_option == 1 && questionLists[indexPage]['type'] == 1">
                                    <tr v-for="(answer, index) in (questionLists[indexPage]['answer_order'].split(','))" :key="index">
                                        <span>
                                            <td width="50" style="padding: 10px;">
                                                <button v-if="answer == getMyAnswer(questionLists[indexPage]['question_id'])"  @click="submitAnswer(questionLists[indexPage]['question_id'], answer)" class="btn btn-success text-white">{{ options[index] }}</button>
                                                <button v-else @click="submitAnswer(questionLists[indexPage]['question_id'], answer)" class="btn btn-outline-primary w-100 no-click-effect">{{ options[index] }}</button>
                                            </td>
                                            <td style="padding: 10px;">
                                                <p class="prevent-select" v-if="exam.show_answer == 1" v-html="questionLists[indexPage]['option_' + answer]"></p>
                                            </td>
                                        </span>
                                    </tr>
                                </tbody>
                                <tbody v-if="exam.type_option == 2">
                                    <tr v-for="(answer, index) in (questionLists[indexPage]['answer_order'].split(','))" :key="index"  v-if="exam.show_answer == 1">
                                        <td width="30">
                                            <p>{{ options[index] }}.</p>
                                        </td>
                                        <td>
                                            <p v-html="questionLists[indexPage]['option_'+answer]"></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <br> -->
                        </div>
                        <div v-else>
                            <div class="alert alert-danger border-0 shadow">
                                <i class="fa fa-exclamation-triangle"></i> Question Not Found!.
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-3 m-3" v-if="exam.type_option == 2">
                        <span v-for="(answer, index) in questionLists[indexPage]['answer_order'].split(',')" :key="index">
                            <button v-if="answer == getMyAnswer(questionLists[indexPage]['question_id'])"  @click="submitAnswer(questionLists[indexPage]['question_id'], answer)" class="btn btn-secondary text-dark px-lg-5 px-md-5 mb-1 mx-1 rounded-3 no-click-effect-section" style="background-color: #ccc;">{{ options[index] }}</button>
                            <button v-else @click="submitAnswer(questionLists[indexPage]['question_id'], answer)" class="btn btn-secondary px-lg-5 px-md-5 mb-1 rounded-3 mx-1 text-dark no-click-effect-section" style="background-color: #ccc;">{{ options[index] }}</button>
                        </span>
                    </div>
                    <div class="card-footer" style="min-height: 60px;">
                        <div class="d-flex justify-content-between">
                            <div class="text-start">
                                <div  v-if="exam.show_prev_next_button == 1">
                                    <button v-if="indexPage > 0" @click="prevPage()" type="button" class="btn btn-primary me-3">Previous</button>
                                    <button v-if="indexPage < Object.keys(questionLists).length - 1" @click="nextPage()" type="button" class="btn btn-success">Next</button>
                                </div>
                            </div>
                            <div class="text-center" v-if="exam.show_question_number_navigation == 0">
                                <div v-if="exam.button_type_finish == 1">
                                    <button v-if="section == lastSection" @click="showModalEndExam = true" class="btn btn-danger btn-md border-0 shadow w-100">End Exam</button>
                                    <button v-else @click="endExam" class="btn btn-danger btn-md border-0 shadow w-100">Next Section</button>
                                </div>
                                <div v-else>
                                    <button v-if="section == lastSection && indexPage >= Object.keys(questionLists).length - 1" @click="showModalEndExam = true" class="btn btn-danger btn-md border-0 shadow w-100">Akhiri Try Out</button>
                                    <button v-if="section < lastSection && indexPage >= Object.keys(questionLists).length - 1"  @click="endExam" class="btn btn-danger btn-md border-0 shadow w-100">Lanjut Bagian Berikutnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="exam.show_question_number_navigation == 1 && questionLists[indexPage]['type'] == 1" class="col-md-12 col-sm-12 col-xs-12" :class="{ 'col-lg-4': exam.show_question_number_navigation == 1}">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="mb-0 text-white">Question Navigation</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mb-3">
                        <div v-for="(question, index) in questionLists" :key="index">
                            <div v-if="question.type == 1" style="width: 20%; float: left;">
                                <div style="padding: 2px;">
                                    <button @click="clickQuestion(index)" v-if="index == indexPage" class="btn btn-primary w-100"><span style="font-size:11px; font-weight: 500;">{{ question.navigation_order }}</span></button>
                                    <button @click="clickQuestion(index)" v-if="index != indexPage && getMyAnswer(question.question_id) == 0" class="btn btn-light w-100"><span style="font-size:11px; font-weight: 500;">{{ question.navigation_order }}</span></button>
                                    <button @click="clickQuestion(index)" v-if="index != indexPage && getMyAnswer(question.question_id) != 0" class="btn btn-success w-100"><span style="font-size:11px; font-weight: 500;">{{ question.navigation_order }}</span></button>
                                </div>
                            </div>
                            <div v-if="question.type == 2" style="width: 100%; float: left;">
                                <div style="padding: 3px;">
                                    <button v-if="index == indexPage" class="btn btn-warning w-100"><small>Directions</small></button>
                                    <button v-if="index != indexPage" class="btn btn-outline-warning w-100"><small>Directions</small></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="min-height: 60px;">

                        <div v-if="exam.button_type_finish == 1">
                            <button v-if="section == lastSection" @click="showModalEndExam = true" class="btn btn-danger btn-md border-0 shadow w-100">End Exam</button>
                            <button v-else @click="endExam" class="btn btn-danger btn-md border-0 shadow w-100">Next Section</button>
                        </div>
                        <div v-else>
                            <button v-if="section == lastSection && indexPage >= Object.keys(questionLists).length - 1" @click="showModalEndExam = true" class="btn btn-danger btn-md border-0 shadow w-100">Akhiri Try Out</button>
                            <button v-if="section < lastSection && indexPage >= Object.keys(questionLists).length - 1"  @click="endExam" class="btn btn-danger btn-md border-0 shadow w-100">Lanjut Bagian Berikutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

    <!-- modal akhiri Try Out -->
    <div v-if="showModalEndExam" class="modal fade" :class="{ 'show': showModalEndExam }" tabindex="-1" aria-hidden="true" style="display:block;" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">End of Try Out ?</h5>
                </div>
                <div class="modal-body">
                    After ending a Try Out, you cannot return to this Try Out again. Are you sure you want to end Try Out ?
                </div>
                <div class="modal-footer">
                    <button @click="endExam" type="button" class="btn btn-primary">End Exam</button>
                    <button @click="showModalEndExam = false" type="button" class="btn btn-secondary">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal waktu Try Out berakhir -->
    <div v-if="showModalEndTimeExam" class="modal fade" :class="{ 'show': showModalEndTimeExam }" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" style="display:block;" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="section == lastSection" class="modal-title">Waktu Habis !</h5>
                    <h5 v-else class="modal-title">
                        Lanjut ke bagian selanjutnya dalam hitungan :
                    </h5>
                </div>
                <div class="modal-body">
                    <div v-if="section == lastSection">Waktu Try Out sudah berakhir!. Klik <strong class="fw-bold">Ya</strong> untuk mengakhiri Try Out.</div>
                    <div v-else>
                        <div class="text-center">
                            <VueCountdown :time="5000" @progress="handleChangeDuration" @end="endExam" v-slot="{ hours, minutes, seconds }">
                                <h2 class="mb-0 text-white">
                                    <span class="badge bg-danger">{{ seconds }}</span>
                                </h2>
                            </VueCountdown>
                        </div>
                    </div>
                </div>
                <div v-if="section == lastSection" class="modal-footer">
                    <button @click="endExam" type="button" class="btn btn-primary">Ya</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    //import layout admin
    import LayoutUser from '../../../../Layouts/LayoutUser.vue';

    import axios from 'axios';
    
    import {
        Head,
        Link
    } from '@inertiajs/inertia-vue3';

    //import ref
    import {
        ref
    } from 'vue';

    //import VueCountdown
    import VueCountdown from '@chenfengyuan/vue-countdown';

    //import inertia adapter
    import {
        Inertia
    } from '@inertiajs/inertia';

    //import sweet alert2
    import Swal from 'sweetalert2';

    export default {
        //layout
        layout: LayoutUser,

        //register components
        components: {
            Head,
            Link,
            VueCountdown,
        },

        //props
        props: {
            id: String,
            page: Number,
            exam: Object,
            setting: Object,
            duration: Object,
            questionLists: Object,
            section: Number,
            lastSection: Number,
            grade: Object,
            indexPage: Object,
        },

        setup(props) {            
            var indexPage;

            var storedIndexPage = props.exam.id != localStorage.getItem("examId") || props.grade.user_id != localStorage.getItem("userId") ? null : localStorage.getItem("indexPage");

            if (storedIndexPage !== null) {
                indexPage = ref(storedIndexPage);
                } else {
                indexPage = ref(props.indexPage);
            }

            let options = ["A", "B", "C", "D", "E"];

            if(props.exam.id != localStorage.getItem("examId") || props.grade.user_id != localStorage.getItem("userId")) {
                localStorage.setItem("examId", props.exam.id);
                localStorage.setItem("userId", props.grade.user_id);
                localStorage.setItem("myAnswers", []);
            }

            const storedArray = localStorage.getItem("myAnswers");
            let myAnswers = storedArray ? JSON.parse(storedArray) : [];
            
            localStorage.setItem("myAnswers", JSON.stringify(myAnswers));
            localStorage.setItem("examId", props.exam.id);

            const counter = ref(0);
            const counterListening = ref(0);

            const duration = ref(props.duration);

            const handleChangeDuration = (() => {
                duration.value = duration.value - 1000;
                counter.value = counter.value + 1;
            });

            const handleChangeDurationListening = (() => {
                props.questionLists[indexPage.value].audio_answer_time = props.questionLists[indexPage.value].audio_answer_time - 1000;
                counterListening.value = counterListening.value + 1;
            });
            const prevPage = (() => {
                indexPage.value = parseInt(indexPage.value) - 1;
            });

            const nextPage = (() => {
                indexPage.value = parseInt(indexPage.value) + 1;
            });

            const clickQuestion = ((index) => {
                indexPage.value = index;
            });

            const getAudioPlayedLimit = ((question_id) => {
                const item = myAnswers.find(item => item.question_id === question_id);
                return item ? item.audio_played : 0;
            });

            const getMyAnswer = ((question_id) => {
                const item = myAnswers.find(item => item.question_id === question_id);
                return item ? item.answer : 0;
            });

            const removePause = (() => {
                $('#playButtonAudio').hide();
            })

            const playAudio = (() => {
                var play = document.getElementById("myAudio"); 
                play.play();
            })

            let answeredQuestionsCount = 0;

            const submitAnswer = (question_id, answer) => {
                const value = { question_id: question_id, answer: answer, audio_played: 0 };
                const index = myAnswers.findIndex(item => item.question_id === value.question_id);

                if (index !== -1) {
                    myAnswers[index].answer = value.answer;
                } else {
                    myAnswers.push(value);
                }

                try {
                    if (answeredQuestionsCount % 20 === 0) {
                        checkConnection();
                    }

                    localStorage.setItem("indexPage", indexPage.value);
                    localStorage.setItem("myAnswers", JSON.stringify(myAnswers));

                    answeredQuestionsCount++;

                    if (indexPage.value < Object.keys(props.questionLists).length - 1) {
                        nextPage();
                    }
                } catch (error) {
                    Swal.fire({
                        title: 'Error',
                        text: "Submit Jawaban Error, silakan lakukan refresh dan pastikan perangkat terhubungan dengan jaringan." + error,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Refresh',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            };

            const endedAudio = (question_id, description = '') => {

                const value = { question_id: question_id, answer: 0, audio_played: getAudioPlayedLimit(question_id) + 1 };
                const index = myAnswers.findIndex(item => item.question_id === value.question_id);

                if (index !== -1) {
                    myAnswers[index].audio_played = value.audio_played;
                } else {
                    myAnswers.push(value);
                }

                localStorage.setItem("myAnswers", JSON.stringify(myAnswers));

                if(getAudioPlayedLimit(question_id) < props.questionLists[indexPage.value]['audio_played_limit']) {
                    $('#playButtonAudio').show();
                } else {
                    
                }

                if(description == 'nextPage') {
                    nextPage();
                }
            };

            const showModalEndExam      = ref(false);
            const showModalEndTimeExam  = ref(false);

            const checkConnection = () => {
                axios.get('/check-connection').then(response => {
                    console.log('ada');
                }).catch(error => {
                    console.log(error);
                    Swal.fire({
                        title: 'Error',
                        text: "Submit Jawaban Error, silakan lakukan refresh dan pastikan perangkat terhubungan dengan jaringan.\n" + error,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Refresh',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                });
            }
            const endExam = ((block = '') => {

                checkConnection();

                if(props.section == props.lastSection || block == 'block') {
                    Inertia.post(`/user/exams/${props.exam.id}/exam-end`, {
                        exam_id: props.exam.id,
                        grade_id: props.grade.id,
                        myAnswers: myAnswers
                    },{
                        onSuccess: () => {
                            if(block == 'block') {
                                Swal.fire({
                                    title: 'UJIAN DIBLOKIR KARENA SUDAH MELEWATI BATAS TOLERANSI.',
                                    text: "Anda tidak dapat melanjutkan ujian, silakan hubungi admin",
                                    icon: 'warning',
                                    showCancelButton: false,
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'Mengerti',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            } else {
                                localStorage.removeItem("indexPage");
                                Swal.fire({
                                    title: 'Success..',
                                    text: "Ujian Anda Selesai, Semoga Mendapatkan Nilai Terbaik.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Tutup',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            }
                        },
                    });
                } else {
                    Inertia.get(`/user/exams/${props.exam.id}/grades/${props.grade.id}/sections/${props.section + 1}?nextsection=1`);
                    localStorage.removeItem("indexPage");
                    Swal.fire({
                        title: 'Success!',
                        text: 'Lanjut Ke Kolom Berikutnya.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });

            const confirm = (() => {
                if(props.grade.is_blocked != 1) {
                    if(props.setting.block_system_type == 1) {
                        let total_tolerance = parseInt(props.grade.total_tolerance) > 0 ? parseInt(props.grade.total_tolerance) - 1 : 0;
                        let tolerance = total_tolerance == 0 ? 'Tolerasi habis, ' : 'Toleransi Tersisa '+ total_tolerance +' kali lagi, ';
                        Swal.fire({
                            title: 'UJIAN AKAN DI DIBLOKIR JIKA ANDA MENINGGALKAN SESI UJIAN',
                            text: tolerance +" jika toleransi habis anda tidak dapat melanjutkan ujian dan harus menghubungi admin",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Mengerti',
                            allowOutsideClick: false
                        })
                        .then((result) => {
                            if (result.isConfirmed) {
                                Inertia.post(`/user/exams/${props.exam.id}/decrement-tolerance`, {
                                    grade_id: props.grade.id,
                                },{
                                    onSuccess: () => {
                                        location.reload();
                                    },
                                });  
                            }
                        })
                    } else {
                        Swal.fire({
                            title: 'Peringatan',
                            text: "Hindari Membuka Tab atau Aplikasi Lain Selama Ujian. Fokuslah Pada Pertanyaan Selama Ujian Berlangsung.",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Mengerti',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    }
                }
            });
            
            if(props.exam.total_tolerance != null) {
                window.addEventListener("blur", confirm);
            }

            if(props.grade.is_blocked == 1) {
                Swal.fire({
                    title: 'Ujian di Blokir',
                    text: "Masukan Kode Untuk Membuka Blokir",
                    input: 'text',
                    icon: 'error',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonText: 'Buka Blokir',
                    showLoaderOnConfirm: true,
                    preConfirm: (token) => {
                        axios.get(`/user/exams/${props.exam.id}/grades/${props.grade.id}/unblocked`, {
                            params: {
                                token: token
                            }
                        })
                        .then(response => {
                            if(response.data.success == true) {
                                Swal.fire({
                                    title: 'Blokir Berhasil Dibuka',
                                    text: 'Silakan Lanjut Mengerjakan Soal.',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Oke',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            } else {
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.data.message,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ulangi',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            }
                        })
                        .catch(error => {
                            console.error('Request failed:', error);
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                    },
                })
            }

            return {
                indexPage,
                options,
                removePause,
                playAudio,
                duration,
                handleChangeDuration,
                handleChangeDurationListening,
                prevPage,
                nextPage,
                clickQuestion,
                submitAnswer,
                getMyAnswer,
                showModalEndExam,
                showModalEndTimeExam,
                endExam,
                confirm,
                checkConnection,
                endedAudio,
                getAudioPlayedLimit
            }
        },
        methods: {
            transform(props) {
                Object.entries(props).forEach(([key, value]) => {
                    const digits = value < 10 ? `0${value}` : value;
                    props[key] = `${digits}`;
                });

                return props;
            },
        },
    }
</script>

<style>
    .modal-header {
        text-align: center;
    }

    audio::-webkit-media-controls-current-time-display, -webkit-media-controls-current-time-display {
        margin-left:70px;
    }

    audio::-webkit-media-controls-timeline, -webkit-media-controls-timeline {
        display:none;
    }

    audio::-webkit-media-controls-time-remaining-display, -webkit-media-controls-time-remaining-display {
        margin-right:15px;
    }

    audio::-webkit-media-controls-play-button, -webkit-media-controls-play-button {
        /* margin-right:15px; */
        display:none;
    }

    /* audio::-webkit-media-controls-play-button, -webkit-media-controls-play-button {
        display: none;
    } */

    .prevent-select {
        -webkit-user-select: none; /* Safari */
        -ms-user-select: none; /* IE 10 and IE 11 */
        user-select: none; /* Standard syntax */
    }

    .unselectable {
        -webkit-user-select: none;
        -webkit-touch-callout: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .no-click-effect:active,

    .no-click-effect:focus {
        outline: none; 
        box-shadow: none; 
        border: none;
        background:#fff;
        border:1px solid #008cff;
        color:#008cff;
    }

    .no-click-effect-section:active,
    
    .no-click-effect-section:focus {
        outline: none; 
        box-shadow: none; 
        border: none;
        background:#fff;
        border:1px solid #51585e;
        color:#51585e;
    }

</style>
