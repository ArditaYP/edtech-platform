<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;

class PsychologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create or retrieve Psychology Category
        $category = Category::firstOrCreate([
            'slug' => 'psikologi-karir'
        ], [
            'name' => 'Psikologi & Karir',
            'icon' => 'user'
        ]);

        // 2. Create the Special Assessment Course
        $course = Course::create([
            'category_id' => $category->id,
            'title' => 'Tes Asesmen Psikologi: Temukan Karir Idealmu',
            'slug' => 'tes-asesmen-psikologi-temukan-karir-idealmu',
            'description' => 'Temukan potensi tersembunyi dan jalur karir ideal Anda melalui asesmen psikologi kerja terstruktur ini.',
            'level' => 'Pemula',
            'duration_hours' => 2,
            'rating' => 4.9,
            'total_students' => 1250,
            'price' => 150000,
            'is_assessment' => true,
            'learning_paths' => ['Karir & Pengembangan Diri'],
            'topics' => ['Psikologi', 'Karir', 'Asesmen'],
            'benefits' => [
                'Hasil asesmen detail & terperinci',
                'Rekomendasi karir spesifik',
                'Bimbingan personalisasi karir'
            ]
        ]);

        // 3. Define 10 realistic psychology questions and option mappings
        $questionsData = [
            [
                'question_text' => 'Bagaimana Anda biasanya merespons ketika rekan kerja Anda sedang mengalami stres atau konflik emosional?',
                'options' => [
                    ['option_text' => 'Mendengarkan dengan penuh empati dan membantunya mengurai emosinya.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menganalisis dampaknya terhadap produktivitas tim dan mencarikan solusi objektif.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengamati bahasa tubuhnya untuk memahami akar kecemasan yang ia hadapi.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memberikan motivasi positif dan menyarankan langkah-langkah praktis menghadapinya.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa fokus utama Anda ketika sedang merancang sebuah program pelatihan baru untuk tim kerja?',
                'options' => [
                    ['option_text' => 'Memastikan emosi dan kesiapan mental setiap peserta didukung secara terapeutik.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyelaraskan silabus pelatihan dengan kompetensi inti yang dibutuhkan organisasi.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan riset perilaku pengguna untuk menemukan modul paling efektif.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Membangun dinamika kelompok yang interaktif dan memicu antusiasme belajar.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika menghadapi masalah dalam sistem kerja tim, apa tindakan awal Anda?',
                'options' => [
                    ['option_text' => 'Mengajak bicara dari hati ke hati untuk mengetahui perasaan anggota tim.', 'category_result' => 'konselor'],
                    ['option_text' => 'Meninjau kembali kebijakan perusahaan dan SOP penempatan staf.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan observasi mendalam tentang bagaimana pengguna sistem berinteraksi dengan alur kerja.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Membuat sesi lokakarya / workshop cepat guna memetakan ide pemecahan masalah.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Proyek seperti apa yang paling membuat Anda merasa puas dan termotivasi saat bekerja?',
                'options' => [
                    ['option_text' => 'Membantu individu mengatasi hambatan mental pribadi untuk mencapai kesuksesan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Merekrut talenta terbaik dan menempatkan mereka di posisi yang tepat.', 'category_result' => 'hr'],
                    ['option_text' => 'Menemukan wawasan baru tentang perilaku manusia melalui data dan wawancara.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menginspirasi dan melatih kelompok orang agar memiliki keterampilan baru.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda mengevaluasi tingkat keberhasilan dari suatu inisiatif baru di kantor?',
                'options' => [
                    ['option_text' => 'Melihat peningkatan kesejahteraan psikologis dan kedamaian iklim kerja.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengukur tingkat retensi karyawan dan tingkat kepatuhan terhadap aturan.', 'category_result' => 'hr'],
                    ['option_text' => 'Menguji kepuasan, kemudahan, dan kegunaan nyata dari sistem tersebut bagi staf.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengamati peningkatan kemampuan kerja nyata staf setelah inisiatif dijalankan.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa kekuatan terbesar Anda dalam sesi komunikasi berkelompok?',
                'options' => [
                    ['option_text' => 'Menciptakan ruang aman di mana semua orang merasa dihargai dan didengar.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menengahi perdebatan secara objektif dan mengarahkan pada kebijakan yang adil.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengajukan pertanyaan kritis yang menggali motif tersembunyi dari pendapat orang lain.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyampaikan materi rumit dengan gaya bahasa yang mudah dipahami dan menarik.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika merancang survei umpan balik (feedback) karyawan, apa aspek terpenting bagi Anda?',
                'options' => [
                    ['option_text' => 'Menyediakan ruang untuk curahan hati yang jujur tentang kesehatan mental mereka.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengukur kepatuhan performa karyawan terhadap target kinerja tahunan.', 'category_result' => 'hr'],
                    ['option_text' => 'Meminimalisasi bias pertanyaan untuk mendapatkan validitas data perilaku.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mencari tahu area keahlian mana yang ingin mereka pelajari selanjutnya.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda memotivasi karyawan yang sedang kehilangan semangat kerjanya?',
                'options' => [
                    ['option_text' => 'Memberikan sesi konseling pribadi untuk menyembuhkan luka mental atau kejenuhan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menawarkan insentif baru, kenaikan karir, atau rotasi kerja demi penyegaran.', 'category_result' => 'hr'],
                    ['option_text' => 'Mempelajari rutinitas harian mereka guna mengidentifikasi hambatan fungsional.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengajak mereka mengikuti program coaching yang interaktif dan membangun motivasi.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika mengamati sebuah rapat tim, apa yang paling menarik perhatian Anda?',
                'options' => [
                    ['option_text' => 'Dinamika empati dan ekspresi perasaan antar anggota rapat.', 'category_result' => 'konselor'],
                    ['option_text' => 'Kesesuaian kontribusi peserta rapat terhadap struktur organisasi mereka.', 'category_result' => 'hr'],
                    ['option_text' => 'Pola interaksi dan cara peserta rapat merespons alat presentasi yang digunakan.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Bagaimana cara pimpinan rapat membimbing dan mengedukasi peserta rapat.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa topik buku pengembangan diri yang paling sering Anda baca?',
                'options' => [
                    ['option_text' => 'Kesehatan Mental, Konseling Terapi, dan Empati.', 'category_result' => 'konselor'],
                    ['option_text' => 'Manajemen SDM, Hukum Ketenagakerjaan, dan Rekrutmen Efektif.', 'category_result' => 'hr'],
                    ['option_text' => 'Psikologi Kognitif, Metode Penelitian Sosial, dan Perilaku Konsumen.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Seni Berbicara di Depan Umum, Kepemimpinan, dan Teknik Pengajaran Interaktif.', 'category_result' => 'trainer']
                ]
            ]
        ];

        // 4. Seed Questions and Options
        foreach ($questionsData as $index => $qData) {
            $question = Question::create([
                'course_id' => $course->id,
                'question_text' => $qData['question_text'],
                'order_number' => $index + 1
            ]);

            foreach ($qData['options'] as $oData) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $oData['option_text'],
                    'category_result' => $oData['category_result']
                ]);
            }
        }
    }
}
