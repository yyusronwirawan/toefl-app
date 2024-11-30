<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam\Exam;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::insert([
            [
                "id" => "49e1686d-0433-4d68-8040-9019ce3ef0e2",
                "created_at" => "2023-05-26 14:17:08",
                "updated_at" => "2023-10-27 14:15:30",
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "question_title_id" => "7c050e8e-20dd-4538-8d51-2eb51ff303c9",
                "template_id" => "f4428762-435c-42c8-914e-b70d50a35b35",
                "title" => "Try Out TOEFL 1",
                "price" => 99000,
                "duration_type" => 2,
                "duration" => null,
                "description" => "<ol>\n<li><em>Login pada sistem tes online sesuai dengan email dan password yang sudah didaftarkan.</em></li>\n<li><em>Durasi tes akan berlangsung sesuai dengan durasi yang tertera. Waktu tes akan tampil di layar komputer dan menghitung mundur saat soal tes mulai diakses. Butir soal akan muncul di layar komputer satu per satu.</em></li>\n<li><em>Menjawab soal tes dapat dilakukan dengan 2 cara: memilih jawaban benar menggunakan mouse atau memilih jawaban benar dengan menekan keyboard (huruf A atau B, C, D).</em></li>\n<li><em>Jika terjadi salah pilih jawaban, peserta dapat memperbaiki jawaban dengan cara mengganti pilihan dengan jawaban yang dianggap benar. Jawaban Anda otomatis akan diganti dengan pilihan jawaban yang terakhir. Mengganti jawaban beberapa kali dapat dilakukan dan tidak mengurangi nilai peserta, namun harus dipertimbangkan waktunya.</em></li>\n<li><em>Untuk memudahkan peserta mengidentifikasi kelengkapan jawaban, soal-soal yang belum dijawab ditandai dengan warna merah pada sisi kanan layar. Indikator Soal Ujian tersebut akan otomatis berubah menjadi warna hijau setelah peserta menjawab soal.</em></li>\n<li><em>Aplikasi TOEFL akan berhenti secara otomatis ketika waktu tes berakhir (hitungan mundur menjadi angka 0).</em></li>\n</ol>",
                "random_question" => 0,
                "random_answer" => 0,
                "show_answer" => 1,
                "show_question_number_navigation" => 1,
                "show_question_number" => 1,
                "next_question_automatically" => 1,
                "show_prev_next_button" => 1,
                "type_option" => 1,
                "button_type_finish" => 1,
                "repeat_the_exam" => 1,
                "print_certificate" => 1,
            ],
            [
                "id" => "779c5aae-fef1-4aa6-8f4c-4f3f100b3947",
                "created_at" => "2023-05-27 22:18:53",
                "updated_at" => "2023-10-27 14:15:38",
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "question_title_id" => "7c050e8e-20dd-4538-8d51-2eb51ff303c9",
                "template_id" => "f4428762-435c-42c8-914e-b70d50a35b35",
                "title" => "Try Out TOEFL 2",
                "price" => 129000,
                "duration_type" => 2,
                "duration" => null,
                "description" => "<ol>\n<li><em>Login pada sistem tes online sesuai dengan email dan password yang sudah didaftarkan.</em></li>\n<li><em>Durasi tes akan berlangsung sesuai dengan durasi yang tertera. Waktu tes akan tampil di layar komputer dan menghitung mundur saat soal tes mulai diakses. Butir soal akan muncul di layar komputer satu per satu.</em></li>\n<li><em>Menjawab soal tes dapat dilakukan dengan 2 cara: memilih jawaban benar menggunakan mouse atau memilih jawaban benar dengan menekan keyboard (huruf A atau B, C, D).</em></li>\n<li><em>Jika terjadi salah pilih jawaban, peserta dapat memperbaiki jawaban dengan cara mengganti pilihan dengan jawaban yang dianggap benar. Jawaban Anda otomatis akan diganti dengan pilihan jawaban yang terakhir. Mengganti jawaban beberapa kali dapat dilakukan dan tidak mengurangi nilai peserta, namun harus dipertimbangkan waktunya.</em></li>\n<li><em>Untuk memudahkan peserta mengidentifikasi kelengkapan jawaban, soal-soal yang belum dijawab ditandai dengan warna merah pada sisi kanan layar. Indikator Soal Ujian tersebut akan otomatis berubah menjadi warna hijau setelah peserta menjawab soal.</em></li>\n<li><em>Aplikasi TOEFL akan berhenti secara otomatis ketika waktu tes berakhir (hitungan mundur menjadi angka 0).</em></li>\n</ol>",
                "random_question" => 0,
                "random_answer" => 0,
                "show_answer" => 1,
                "show_question_number_navigation" => 1,
                "show_question_number" => 1,
                "next_question_automatically" => 1,
                "show_prev_next_button" => 1,
                "type_option" => 1,
                "button_type_finish" => 1,
                "repeat_the_exam" => 1,
                "print_certificate" => 1,
            ],
            [
                "id" => "a532aeb8-33d6-4f44-97cb-e7a4f4248467",
                "created_at" => "2023-05-27 22:19:32",
                "updated_at" => "2023-10-27 14:15:56",
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "question_title_id" => "7c050e8e-20dd-4538-8d51-2eb51ff303c9",
                "template_id" => "f4428762-435c-42c8-914e-b70d50a35b35",
                "title" => "Try Out TOEFL 4",
                "price" => 199000,
                "duration_type" => 2,
                "duration" => null,
                "description" => "<ol>\n<li><em>Login pada sistem tes online sesuai dengan email dan password yang sudah didaftarkan.</em></li>\n<li><em>Durasi tes akan berlangsung sesuai dengan durasi yang tertera. Waktu tes akan tampil di layar komputer dan menghitung mundur saat soal tes mulai diakses. Butir soal akan muncul di layar komputer satu per satu.</em></li>\n<li><em>Menjawab soal tes dapat dilakukan dengan 2 cara: memilih jawaban benar menggunakan mouse atau memilih jawaban benar dengan menekan keyboard (huruf A atau B, C, D).</em></li>\n<li><em>Jika terjadi salah pilih jawaban, peserta dapat memperbaiki jawaban dengan cara mengganti pilihan dengan jawaban yang dianggap benar. Jawaban Anda otomatis akan diganti dengan pilihan jawaban yang terakhir. Mengganti jawaban beberapa kali dapat dilakukan dan tidak mengurangi nilai peserta, namun harus dipertimbangkan waktunya.</em></li>\n<li><em>Untuk memudahkan peserta mengidentifikasi kelengkapan jawaban, soal-soal yang belum dijawab ditandai dengan warna merah pada sisi kanan layar. Indikator Soal Ujian tersebut akan otomatis berubah menjadi warna hijau setelah peserta menjawab soal.</em></li>\n<li><em>Aplikasi TOEFL akan berhenti secara otomatis ketika waktu tes berakhir (hitungan mundur menjadi angka 0).</em></li>\n</ol>",
                "random_question" => 0,
                "random_answer" => 0,
                "show_answer" => 1,
                "show_question_number_navigation" => 1,
                "show_question_number" => 1,
                "next_question_automatically" => 1,
                "show_prev_next_button" => 1,
                "type_option" => 1,
                "button_type_finish" => 1,
                "repeat_the_exam" => 1,
                "print_certificate" => 1,
            ],
            [
                "id" => "e88a77af-b26c-4939-8ce3-3e0d9b5f62ec",
                "created_at" => "2023-05-27 22:19:13",
                "updated_at" => "2023-10-27 14:15:48",
                "category_id" => "f968e7a3-74ed-4090-b9bc-99e7c36f2a69",
                "question_title_id" => "7c050e8e-20dd-4538-8d51-2eb51ff303c9",
                "template_id" => "f4428762-435c-42c8-914e-b70d50a35b35",
                "title" => "Try Out TOEFL 3",
                "price" => 149000,
                "duration_type" => 2,
                "duration" => null,
                "description" => "<ol>\n<li><em>Login pada sistem tes online sesuai dengan email dan password yang sudah didaftarkan.</em></li>\n<li><em>Durasi tes akan berlangsung sesuai dengan durasi yang tertera. Waktu tes akan tampil di layar komputer dan menghitung mundur saat soal tes mulai diakses. Butir soal akan muncul di layar komputer satu per satu.</em></li>\n<li><em>Menjawab soal tes dapat dilakukan dengan 2 cara: memilih jawaban benar menggunakan mouse atau memilih jawaban benar dengan menekan keyboard (huruf A atau B, C, D).</em></li>\n<li><em>Jika terjadi salah pilih jawaban, peserta dapat memperbaiki jawaban dengan cara mengganti pilihan dengan jawaban yang dianggap benar. Jawaban Anda otomatis akan diganti dengan pilihan jawaban yang terakhir. Mengganti jawaban beberapa kali dapat dilakukan dan tidak mengurangi nilai peserta, namun harus dipertimbangkan waktunya.</em></li>\n<li><em>Untuk memudahkan peserta mengidentifikasi kelengkapan jawaban, soal-soal yang belum dijawab ditandai dengan warna merah pada sisi kanan layar. Indikator Soal Ujian tersebut akan otomatis berubah menjadi warna hijau setelah peserta menjawab soal.</em></li>\n<li><em>Aplikasi TOEFL akan berhenti secara otomatis ketika waktu tes berakhir (hitungan mundur menjadi angka 0).</em></li>\n</ol>",
                "random_question" => 0,
                "random_answer" => 0,
                "show_answer" => 1,
                "show_question_number_navigation" => 1,
                "show_question_number" => 1,
                "next_question_automatically" => 1,
                "show_prev_next_button" => 1,
                "type_option" => 1,
                "button_type_finish" => 1,
                "repeat_the_exam" => 1,
                "print_certificate" => 1,
            ]
        ]);
    }
}
