<template>
    <Head>
        <title>{{ $page.props.setting.app_name ?? 'Atur Setting Terlebih Dahulu' }} - Tambah Kategori Penilaian</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Kategori Penilaian</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Kategori Penilaian</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center">
                        <div class="ms-auto">
                            <Link href="/admin/templates" class="btn btn-primary btn-sm mt-2 mt-lg-0">Kembali</Link>
                        </div>
                    </div>
                    <form @submit.prevent="submit" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Template</label>
                            <input type="text" class="form-control" v-model="form.name" :class="{ 'is-invalid': errors.name }" placeholder="Nama">
                            <div v-if="errors.name" class="invalid-feedback">
                                {{ errors.name }}
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Ukuran</label>
                            <select v-model="form.size" :class="{ 'is-invalid': errors.size }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">A4</option>
                            </select>
                            <div v-if="errors.size" class="invalid-feedback">
                                {{ errors.size }}
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Orientasi</label>
                            <select v-model="form.orientation" :class="{ 'is-invalid': errors.orientation }" class="form-select">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Landscape</option>
                                <option value="2">Portrait</option>
                            </select>
                            <div v-if="errors.orientation" class="invalid-feedback">
                                {{ errors.orientation }}
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm px-5">Simpan dan Buat Template</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-top border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-3">Variable yang bisa disematkan dalam sertifikat</h6>
                        </div>
                    </div>
                    <div class="table-responsive mb-3">
                        <table class="table mb-0 table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="15px">No</th>
                                    <th width="350px">Nama Variable</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{name}</td>
                                    <td>Menampilkan Nama Peserta</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>{date_of_birth}</td>
                                    <td>Menampilkan Tanggal Lahir Peserta (format: d/m/Y)</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>{gender}</td>
                                    <td>Menampilkan Jenis Kelamin Peserta (Male / Female)</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>{student_number}</td>
                                    <td>Menampilkan ID pendaftaran peserta dengan format tanggal (yyyymmdd) pendaftaran + id increment peserta contoh: 2010052905</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>{exam_date}</td>
                                    <td>Menampilkan Tanggal Ujian Peserta</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>{total_score}</td>
                                    <td>Menampilkan Total Nilai Tes</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>{valid_until}</td>
                                    <td>Masa Berlaku Sertifikat (format : d/m/Y)</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>{province}</td>
                                    <td>Provinsi Peserta</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>{city}</td>
                                    <td>Kota/Kab Peserta</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>{district}</td>
                                    <td>Kecamatan Peserta</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>{village}</td>
                                    <td>Desa/Kelurahan Peserta</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div v-for="(category, index) in categories" :key="index" class="table-responsive mb-3">
                        <table class="table mb-0 table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="15px">No</th>
                                    <th width="350px">Variable {{ category.name }}</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(value_category, index) in category.value_category" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ value_category.variable }}</td>
                                    <td>Menampilkan Nilai {{ value_category.name }}</td>
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
            categories: Object
        },

        // initialization composition API
        setup() {
            const form = reactive({
                name: '',
                size: '',
                orientation: '',
            });

            // submit method
            const submit = () => {
                // send data to server
                Inertia.post('/admin/templates', {
                    // data
                    name: form.name,
                    size: form.size,
                    orientation: form.orientation,
                }, {
                    onSuccess: () => {
                        //show success alert
                        Swal.fire({
                            title: 'Success!',
                            text: 'Data Template Berhasil Dibuat, silakan untuk membuat template',
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
