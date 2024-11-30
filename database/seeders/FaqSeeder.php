<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterData\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::insert([
            [
                "id" => "7be4cf4d-6ea4-4bbf-a185-01c39ecbf9e8",
                "created_at" => "2023-05-28 10:38",
                "updated_at" => "2023-05-28 10:38:40",
                "question" => "Apa itu tes TOEFL ?",
                "answer" => "<p>Tes Bahasa Inggris sebagai Bahasa Asing (TOEFL) adalah tes kemampuan bahasa Inggris. Ini terutama digunakan oleh penutur bahasa Inggris non-pribumi saat mendaftar ke perguruan tinggi di luar negeri, di mana bahasa Inggris adalah mode komunikasi standar.</p>"
            ],
            [
                "id" => "e435733c-3205-4bb0-a3e1-2897dfaa30e4",
                "created_at" => "2023-05-28 10:38",
                "updated_at" => "2023-05-28 10:38:56",
                "question" => "Berapa biaya untuk mengikuti Ujian TOEFL?",
                "answer" => "<p>US$205</p>"
            ],
            [
                "id" => "f96edbb8-e23f-4cae-b600-dc8b9e054793",
                "created_at" => "2023-05-28 10:39",
                "updated_at" => "2023-05-28 10:39:16",
                "question" => "Apakah Toefl lebih sulit daripada ielts?",
                "answer" => "<p>Baik ujian IELTS maupun TOEFL membutuhkan latihan yang konsisten. Namun, banyak peserta tes merasa TOEFL relatif lebih sulit.</p>"
            ],
            [
                "id" => "a811dce1-8303-415a-ad73-f1cd80013ed8",
                "created_at" => "2023-05-28 10:39",
                "updated_at" => "2023-05-28 10:39:27",
                "question" => "Apakah paspor diperlukan untuk Ujian TOEFL?",
                "answer" => "<p>Ya, kandidat harus memiliki paspor yang masih berlaku pada saat mengikuti ujian</p>"
            ],
            [
                "id" => "df039c93-8ef1-4d25-a379-a042022aebb5",
                "created_at" => "2023-05-28 10:39",
                "updated_at" => "2023-05-28 10:39:41",
                "question" => "Berapa lama skor TOEFL valid?",
                "answer" => "<p>Skor TOEFL berlaku selama dua tahun sejak hari hasil dikeluarkan. Jika seorang Peserta ingin membuktikan kelayakan mereka setelah dua tahun, mereka harus mengikuti ujian kembali.</p>"
            ],
            [
                "id" => "60c77769-f45b-4966-8e12-4bae20f8f59b",
                "created_at" => "2023-05-28 10:39",
                "updated_at" => "2023-05-28 10:39:51",
                "question" => "Bisakah saya mengikuti Ujian TOEFL dari rumah?",
                "answer" => "<p>Peserta yang lebih suka mengikuti tes di rumah daripada pergi ke pusat tes dapat mengikuti TOEFL iBT. Konten tes serupa dengan format pena-dan-kertas, dan kandidat akan diawasi oleh pengawas manusia secara online melalui Proctor.</p>"
            ],
            [
                "id" => "81f07a86-f6c2-4d20-be09-8c0def005423",
                "created_at" => "2023-05-28 10:40",
                "updated_at" => "2023-05-28 10:40:08",
                "question" => "Apa yang terjadi jika saya gagal dalam Tes TOEFL?",
                "answer" => "<p>Tidak ada skor kelulusan minimum untuk TOEFL. Namun, setiap universitas memiliki persyaratan khusus. Jika Anda gagal memenuhi standar universitas/perguruan tinggi yang Anda pilih, Anda harus mengulang ujian.</p>"
            ],
            [
                "id" => "7901de32-bc2c-4df0-9fe3-07c4f5ff3c15",
                "created_at" => "2023-05-28 10:40",
                "updated_at" => "2023-05-28 10:40:25",
                "question" => "Berapa kali saya bisa mengikuti Tes TOEFL?",
                "answer" => "<p>Tidak ada batasan berapa kali Anda dapat mengikuti tes ini.</p>"
            ],
            [
                "id" => "0341c73a-6b54-4a65-8e2a-c09be8ed6ef3",
                "created_at" => "2023-05-28 10:41",
                "updated_at" => "2023-05-28 10:41:14",
                "question" => "Negara mana saja yang menerima sertifikasi ujian TOEFL?",
                "answer" => "<p>Sertifikasi TOEFL dianggap valid di lebih dari 11.000 institusi dan lebih dari 150 negara. Hal ini diakui oleh negara-negara seperti Inggris, AS, Australia dan Kanada.</p>"
            ],
            [
                "id" => "3701510d-630f-4102-b23d-a56e013334af",
                "created_at" => "2023-05-28 10:41",
                "updated_at" => "2023-05-28 10:41:36",
                "question" => "IELTS vs TOEFL - mana yang lebih mudah",
                "answer" => "<p>Baik ujian&nbsp;<a href=\"https://www.aeccglobal.co.id/id/english-proficiency-tests/ielts/exam-overview/\" target=\"_blank\" rel=\"noopener noreferrer\"><strong>IELTS</strong></a>&nbsp;maupun TOEFL membutuhkan latihan yang konsisten. Namun, banyak peserta tes merasa TOEFL relatif lebih sulit.</p>"
            ],
            [
                "id" => "5380914c-edb1-4352-9114-c3170e12d430",
                "created_at" => "2023-05-28 10:41",
                "updated_at" => "2023-05-28 10:41:50",
                "question" => "Bagaimana cara saya mendaftar TOEFL?",
                "answer" => "<p>Anda dapat mendaftar untuk ujian secara online, tatap muka, melalui telepon dan surat.</p>"
            ]
        ]);
    }
}
