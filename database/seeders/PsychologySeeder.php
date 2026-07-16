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

        // 2. Create or Update the Special Assessment Course
        $course = Course::updateOrCreate([
            'slug' => 'tes-asesmen-psikologi-temukan-karir-idealmu'
        ], [
            'category_id' => $category->id,
            'title' => 'Tes Asesmen Psikologi: Temukan Karir Idealmu',
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

        // Clean up old questions and options associated with this course to prevent duplicates
        $course->questions()->delete();

        // 3. Define 50 realistic psychology questions and option mappings
        // A -> 'konselor', B -> 'hr', C -> 'ux_researcher', D -> 'trainer'
        $questionsData = [
            [
                'question_text' => 'Bagaimana Anda merespons jika melihat rekan satu tim mengalami burnout?',
                'options' => [
                    ['option_text' => 'Mengajaknya mengobrol secara personal untuk mendengarkan keluh kesahnya.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengatur ulang pembagian tugas tim agar beban kerjanya berkurang secara terstruktur.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis penyebab utama burnout tersebut dengan meninjau proses kerja.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memberikan sesi sharing motivasi dan teknik mengelola stres kepada seluruh tim.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika harus menyampaikan umpan balik (feedback) negatif kepada bawahan, apa pendekatan Anda?',
                'options' => [
                    ['option_text' => 'Menyampaikannya dengan sangat hati-hati agar tidak menyinggung perasaan dan tetap mendukung mentalnya.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengacu pada metrik kinerja objektif dan mendiskusikan rencana perbaikan karier formal.', 'category_result' => 'hr'],
                    ['option_text' => 'Menggali alasan di balik perilakunya dengan mengajukan pertanyaan mendalam tentang hambatan kerjanya.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Membimbingnya secara langsung dengan mencontohkan tindakan yang benar dan memberikan modul latihan.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Dalam menghadapi konflik antara dua anggota tim yang berselisih paham, Anda akan...',
                'options' => [
                    ['option_text' => 'Menjadi mediator yang netral untuk meredakan ketegangan emosional di antara mereka.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyelesaikan konflik berdasarkan aturan/SOP perusahaan yang berlaku adil bagi kedua pihak.', 'category_result' => 'hr'],
                    ['option_text' => 'Mencari tahu akar permasalahan dengan mewawancarai pihak-pihak terkait secara objektif.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengadakan sesi diskusi interaktif untuk menemukan jalan tengah yang disepakati bersama.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa prioritas utama Anda saat menyusun rencana pelatihan (training) tahunan?',
                'options' => [
                    ['option_text' => 'Membantu memulihkan motivasi internal dan kesejahteraan psikologis karyawan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyelaraskan modul pelatihan dengan visi strategis dan KPI organisasi.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan survei kebutuhan pelatihan berbasis data perilaku dan kompetensi.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Merancang metode penyampaian materi yang interaktif, seru, dan mudah dipahami.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Jika ditunjuk memimpin proyek baru, langkah pertama yang Anda lakukan adalah...',
                'options' => [
                    ['option_text' => 'Memastikan setiap anggota tim merasa nyaman dan saling terkoneksi satu sama lain.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menetapkan peran, tanggung jawab, dan target performa yang jelas bagi setiap orang.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan riset komparatif dan mengumpulkan data sebelum memutuskan metode kerja.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mempersiapkan presentasi kick-off yang menginspirasi untuk membakar semangat tim.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda mengevaluasi efektivitas suatu sistem kerja baru?',
                'options' => [
                    ['option_text' => 'Menanyakan kepada staf apakah sistem baru tersebut membuat mereka stres atau tidak.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengukur metrik retensi staf dan efisiensi biaya operasional setelah implementasi.', 'category_result' => 'hr'],
                    ['option_text' => 'Menguji kegunaan (usability) sistem secara langsung lewat observasi perilaku pengguna.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyelenggarakan workshop evaluasi untuk melatih staf memaksimalkan sistem tersebut.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Topik bacaan apa yang paling menarik perhatian Anda di perpustakaan?',
                'options' => [
                    ['option_text' => 'Buku tentang psikoterapi, empati, dan cara memahami luka batin.', 'category_result' => 'konselor'],
                    ['option_text' => 'Buku tentang strategi manajemen SDM, kepatuhan hukum kerja, dan rekrutmen.', 'category_result' => 'hr'],
                    ['option_text' => 'Jurnal ilmiah tentang analisis data kognitif dan metode riset perilaku manusia.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Buku tentang teknik public speaking, kepemimpinan transformasional, dan coaching.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat melihat alur kerja (workflow) yang tidak efisien, Anda cenderung...',
                'options' => [
                    ['option_text' => 'Mendengarkan keluhan rekan kerja tentang frustrasi yang mereka rasakan akibat alur tersebut.', 'category_result' => 'konselor'],
                    ['option_text' => 'Merumuskan kebijakan baru untuk menata ulang pembagian wewenang dalam tim.', 'category_result' => 'hr'],
                    ['option_text' => 'Memetakan langkah demi langkah alur kerja tersebut untuk mengidentifikasi bottleneck.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Membuat materi sosialisasi yang menarik untuk menjelaskan cara kerja yang lebih cepat.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika rekan kerja melakukan kesalahan fatal yang menghambat proyek, reaksi Anda adalah...',
                'options' => [
                    ['option_text' => 'Menenangkan dirinya terlebih dahulu agar tidak merasa bersalah secara berlebihan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Melaporkan kejadian tersebut sesuai prosedur dan mendiskusikan sanksi atau evaluasi formal.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengkaji sistem penempatan kerja untuk mengetahui apakah ia ditempatkan di posisi yang salah.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengadakan sesi mentoring khusus untuk mengajarinya cara memperbaiki kesalahan tersebut.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda mendeskripsikan peran ideal Anda dalam sebuah organisasi?',
                'options' => [
                    ['option_text' => 'Menjadi pendengar setia dan penyembuh suasana kerja bagi siapa saja yang membutuhkan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menjadi pengambil keputusan yang adil dalam penataan staf dan kebijakan karir.', 'category_result' => 'hr'],
                    ['option_text' => 'Menjadi analis yang memecahkan masalah kompleks lewat data riset yang valid.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menjadi komunikator yang menginspirasi dan melatih orang lain agar berkembang.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa yang Anda lakukan ketika ada perubahan regulasi mendadak dari manajemen puncak?',
                'options' => [
                    ['option_text' => 'Membantu menenangkan kecemasan rekan kerja agar tidak panik menghadapi perubahan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Segera memperbarui draf kebijakan operasional agar tetap patuh pada regulasi baru.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis dampak regulasi tersebut terhadap perilaku produktivitas harian karyawan.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyusun presentasi penjelasan regulasi baru tersebut agar mudah dipahami semua orang.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika Anda mengadakan sesi wawancara, apa yang paling Anda fokuskan?',
                'options' => [
                    ['option_text' => 'Membangun kenyamanan emosional agar calon karyawan bisa terbuka tentang dirinya.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mencocokkan kualifikasi calon karyawan dengan kebutuhan kompetensi organisasi.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengamati detail mikro-ekspresi dan pola pikir logis dari jawaban mereka.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memberikan gambaran inspiratif tentang visi perusahaan dan memotivasi mereka untuk bergabung.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda meningkatkan retensi (kebertahanan) karyawan di kantor?',
                'options' => [
                    ['option_text' => 'Meningkatkan program konseling internal dan kesejahteraan mental karyawan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Merancang jenjang karir yang jelas dan sistem reward yang kompetitif.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan survei kepuasan kerja berkala untuk menemukan faktor penyebab resign.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyediakan program pelatihan keterampilan berkelanjutan yang menarik minat mereka.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat menyusun laporan hasil kerja akhir tahun, Anda lebih suka menyajikannya dengan...',
                'options' => [
                    ['option_text' => 'Menyisipkan testimoni perasaan dan tingkat kepuasan tim selama bekerja.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyajikan matriks pencapaian KPI individu dan efektivitas organisasi.', 'category_result' => 'hr'],
                    ['option_text' => 'Menggunakan grafik analitis mendalam dan visualisasi data yang presisi.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyampaikan poin-poin penting secara lisan dengan presentasi yang memukau.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika berdiskusi dalam kelompok kecil, kontribusi utama Anda biasanya berupa...',
                'options' => [
                    ['option_text' => 'Memastikan semua anggota merasa didengar dan dihargai pendapatnya.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengarahkan diskusi agar tetap fokus pada tujuan dan waktu yang disepakati.', 'category_result' => 'hr'],
                    ['option_text' => 'Mempertanyakan asumsi awal dengan menyodorkan data atau fakta ilmiah alternatif.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyederhanakan ide-ide rumit anggota kelompok menjadi kesimpulan yang menarik.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Jika diminta merancang ruang kantor baru, aspek apa yang paling Anda perhatikan?',
                'options' => [
                    ['option_text' => 'Menyediakan area khusus relaksasi mental dan pojok curhat yang tenang.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengoptimalkan tata letak meja kerja demi kelancaran koordinasi antar divisi.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis kebiasaan gerak staf saat bekerja untuk efisiensi ruang ergonomis.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Membuat ruang kolaborasi kreatif yang dinamis dan memicu inspirasi diskusi.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana pendekatan Anda dalam mengajarkan keterampilan baru yang sulit kepada rekan kerja?',
                'options' => [
                    ['option_text' => 'Mendampinginya dengan sabar hingga ia merasa percaya diri untuk mencoba sendiri.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menjadwalkan sesi mentoring terstruktur sesuai dengan kurikulum kompetensi divisi.', 'category_result' => 'hr'],
                    ['option_text' => 'Memecah keterampilan tersebut menjadi bagian-bagian logis berdasarkan riset kognitif.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengadakan workshop interaktif penuh praktik langsung dengan metode yang seru.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat rekan satu tim terlihat tidak bersemangat karena masalah pribadi, Anda akan...',
                'options' => [
                    ['option_text' => 'Mengajaknya minum kopi bersama untuk mendengarkan curahan hatinya secara privat.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengingatkannya secara profesional tentang batasan performa kerja yang harus dijaga.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengamati apakah masalah pribadinya memengaruhi fokus kognitifnya saat bekerja.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memberikan kata-kata motivasi atau video inspiratif untuk menaikkan mood kerjanya.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa langkah Anda ketika proses rekrutmen karyawan baru dirasa terlalu lama?',
                'options' => [
                    ['option_text' => 'Memastikan pelamar tidak merasa terabaikan dengan mengirim pesan personal yang ramah.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengevaluasi alur koordinasi antar manajer untuk mempercepat persetujuan berkas.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan audit komprehensif pada setiap tahapan seleksi untuk membuang langkah sia-sia.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Melatih tim HR agar lebih terampil dalam melakukan teknik screening cepat.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika meluncurkan program kesejahteraan karyawan (employee wellness program), fokus Anda adalah...',
                'options' => [
                    ['option_text' => 'Menyediakan layanan psikolog klinis gratis untuk mengatasi masalah kesehatan mental.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyelaraskan program tersebut dengan anggaran perusahaan agar bernilai investasi tinggi.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan riset pasar internal untuk mengetahui kebutuhan paling mendesak dari karyawan.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengadakan webinar kesehatan interaktif dengan pembicara terkenal untuk memicu antusiasme.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Dalam merespons kritik pedas dari klien, tindakan pertama Anda adalah...',
                'options' => [
                    ['option_text' => 'Memvalidasi kekecewaan klien secara emosional agar suasana mendingin.', 'category_result' => 'konselor'],
                    ['option_text' => 'Meninjau kontrak kerja untuk melihat kewajiban hukum dan batas tanggung jawab kita.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis detail kesalahan sistem yang dilaporkan klien untuk dicarikan solusinya.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengajak klien berdiskusi langsung dalam rapat klarifikasi yang solutif dan edukatif.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda menyikapi anggota tim yang memiliki gaya belajar lambat?',
                'options' => [
                    ['option_text' => 'Memberikan dukungan moral agar ia tidak merasa minder atau tertekan di tim.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyesuaikan target kinerjanya sementara waktu sambil memantau perkembangannya.', 'category_result' => 'hr'],
                    ['option_text' => 'Meneliti hambatan belajar yang ia alami agar dapat mendesain ulang instruksi tugas.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Membuat rangkuman materi visual atau tutorial video pendek untuk membantunya belajar.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat merancang survei kepuasan pelanggan, Anda lebih mementingkan...',
                'options' => [
                    ['option_text' => 'Menyediakan kolom terbuka bagi pelanggan untuk mengekspresikan perasaan mereka.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyelaraskan hasil kepuasan dengan evaluasi kinerja tim layanan pelanggan.', 'category_result' => 'hr'],
                    ['option_text' => 'Memastikan instrumen pertanyaan terbebas dari bias kognitif dan mudah dipahami.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyebarkan hasil survei tersebut dalam bentuk infografis yang menarik bagi seluruh tim.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa yang paling Anda nikmati dari aktivitas kerja kelompok?',
                'options' => [
                    ['option_text' => 'Rasa kebersamaan, kehangatan hubungan, dan saling mendukung satu sama lain.', 'category_result' => 'konselor'],
                    ['option_text' => 'Kejelasan struktur kerja di mana masing-masing anggota tahu persis apa tugasnya.', 'category_result' => 'hr'],
                    ['option_text' => 'Proses bertukar pikiran yang logis, mendalam, dan menantang asumsi lama.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Kesempatan mempresentasikan hasil diskusi di depan umum dengan penuh percaya diri.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika Anda ditugaskan memecahkan masalah penurunan kinerja divisi, Anda akan...',
                'options' => [
                    ['option_text' => 'Mengadakan sesi konseling kelompok untuk mengurai kelelahan mental kolektif tim.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengevaluasi kesesuaian keahlian staf (job-fit) dengan posisi kerja mereka saat ini.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengumpulkan data aktivitas harian staf untuk mendeteksi inefisiensi operasional.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Membuat modul pelatihan baru untuk meng-upgrade skill praktis anggota divisi tersebut.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda membujuk manajemen agar menyetujui anggaran proyek baru Anda?',
                'options' => [
                    ['option_text' => 'Menyampaikan dampak emosional positif proyek tersebut bagi kebahagiaan karyawan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menunjukkan analisis laba-rugi (ROI) yang matang serta kontribusinya pada tujuan bisnis.', 'category_result' => 'hr'],
                    ['option_text' => 'Menyajikan data riset kebutuhan pasar yang akurat dan hasil uji coba berskala kecil.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Melakukan presentasi persuasif yang dinamis dengan visualisasi rencana yang menarik.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Jika Anda melihat adanya ketimpangan gender/latar belakang dalam promosi karir di kantor, Anda akan...',
                'options' => [
                    ['option_text' => 'Menawarkan ruang bercerita bagi karyawan yang merasa dirugikan demi meringankan beban mental.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengusulkan pembaruan kebijakan promosi jabatan yang objektif dan bebas diskriminasi.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan analisis statistik data promosi masa lalu untuk membuktikan bias sistematis.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyelenggarakan program edukasi keberagaman (diversity training) bagi jajaran manajer.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika Anda merasa jenuh dengan rutinitas kerja harian, apa yang biasanya Anda lakukan?',
                'options' => [
                    ['option_text' => 'Mengambil cuti untuk melakukan refleksi diri, meditasi, atau menemui konselor pribadi.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mencari tantangan baru dengan mendaftar rotasi posisi atau proyek antar departemen.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis faktor apa yang membuat Anda jenuh dan mendesain ulang kebiasaan kerja.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengikuti kursus/seminar baru untuk menambah wawasan dan keterampilan di bidang lain.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat membimbing siswa magang, pendekatan utama Anda adalah...',
                'options' => [
                    ['option_text' => 'Memastikan mereka merasa diterima dengan hangat dan tidak merasa canggung di kantor.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menjelaskan deskripsi pekerjaan secara formal serta mengawasi kedisiplinan kerja mereka.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengamati metode kerja mereka untuk memahami cara berpikir generasi baru.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengajarkan teknik-teknik praktis kerja secara bertahap melalui simulasi tugas nyata.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda bereaksi terhadap kegagalan besar dari suatu proyek tim?',
                'options' => [
                    ['option_text' => 'Menguatkan hati anggota tim agar tidak saling menyalahkan dan tetap bersemangat.', 'category_result' => 'konselor'],
                    ['option_text' => 'Melakukan audit kegagalan untuk melihat kepatuhan anggota terhadap rencana awal.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis data kegagalan secara menyeluruh untuk menemukan letak kesalahan teknis.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengubah kegagalan tersebut menjadi studi kasus pembelajaran bersama untuk proyek depan.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa fokus Anda saat merancang onboarding program untuk karyawan baru?',
                'options' => [
                    ['option_text' => 'Membantu mereka beradaptasi secara psikologis dan merasa diterima di lingkungan baru.', 'category_result' => 'konselor'],
                    ['option_text' => 'Memperkenalkan regulasi perusahaan, sistem gaji, dan struktur organisasi formal.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan peninjauan apakah proses penyampaian informasi onboarding berjalan efisien.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memberikan pelatihan singkat yang interaktif mengenai skill dasar harian kantor.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Jika rekan kerja merasa terintimidasi oleh cara bicara pimpinan yang keras, Anda akan...',
                'options' => [
                    ['option_text' => 'Menjadi tempatnya mencurahkan kesedihan dan membantunya memulihkan rasa percaya diri.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyarankan pelaporan formal jika tindakan pimpinan sudah mengarah pada pelecehan.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis pola komunikasi pimpinan tersebut untuk mencari cara interaksi yang efektif.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memberikan tips praktis atau teknik asertif dalam berkomunikasi dengan atasan galak.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat Anda menyelenggarakan webinar online, apa indikator utama kesuksesan acara bagi Anda?',
                'options' => [
                    ['option_text' => 'Adanya tanggapan emosional yang menyentuh hati dari para peserta di kolom chat.', 'category_result' => 'konselor'],
                    ['option_text' => 'Jumlah peserta yang hadir memenuhi kuota target pendaftaran yang ditentukan.', 'category_result' => 'hr'],
                    ['option_text' => 'Tingkat retensi perhatian peserta dari awal hingga akhir acara berdasarkan data analitik.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Antusiasme peserta dalam sesi tanya jawab interaktif dan evaluasi kepuasan materi.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa yang Anda lakukan ketika melihat konflik kepentingan di antara para pengambil kebijakan?',
                'options' => [
                    ['option_text' => 'Melakukan pendekatan persuasif secara personal untuk menyelaraskan ego masing-masing.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menegakkan aturan kode etik kerja dan hukum formal yang mengikat semua pihak.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengurai perbedaan pendapat tersebut ke dalam matriks perbandingan logika bisnis.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memfasilitasi forum mediasi yang terstruktur agar keputusan bersama bisa disosialisasikan.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika merancang instruksi penggunaan (user manual) produk baru, Anda memprioritaskan...',
                'options' => [
                    ['option_text' => 'Nada bahasa yang ramah, hangat, dan tidak membingungkan pengguna pemula.', 'category_result' => 'konselor'],
                    ['option_text' => 'Kesesuaian manual dengan standar kepatuhan hukum konsumen yang berlaku.', 'category_result' => 'hr'],
                    ['option_text' => 'Kemudahan alur langkah demi langkah berdasarkan uji coba langsung ke pengguna.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Desain visual yang menarik dilengkapi video tutorial interaktif agar mudah ditiru.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat Anda harus memotong anggaran tim Anda sendiri, bagaimana Anda melakukannya?',
                'options' => [
                    ['option_text' => 'Berdiskusi dari hati ke hati dengan tim untuk meminimalkan dampak psikologis kecemasan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Memangkas pengeluaran secara merata berdasarkan analisis kontribusi performa program.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis efisiensi biaya setiap program untuk mencari pos mana yang paling tidak produktif.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengadakan sesi brainstorming dengan tim untuk melatih kreativitas kerja hemat.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika Anda diminta memberikan pidato pembuka di acara tahunan kantor, Anda akan...',
                'options' => [
                    ['option_text' => 'Menyampaikan rasa terima kasih yang tulus atas kerja keras dan pengorbanan semua staf.', 'category_result' => 'konselor'],
                    ['option_text' => 'Memaparkan pencapaian target tahunan organisasi dan rencana strategis tahun depan.', 'category_result' => 'hr'],
                    ['option_text' => 'Membagikan tren data industri masa depan serta tantangan analitis yang akan dihadapi.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memberikan pidato motivasi yang energik dan membakar semangat juang semua hadirin.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana tindakan Anda menghadapi anggota tim yang tidak mau menerima umpan balik?',
                'options' => [
                    ['option_text' => 'Mengajaknya bicara santai untuk menguak ketakutan atau ego defensif di balik sikapnya.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mencatat penolakan tersebut ke dalam file penilaian performa kerjanya secara resmi.', 'category_result' => 'hr'],
                    ['option_text' => 'Menguji apakah metode penyampaian umpan balik kita selama ini kurang tepat bagi dirinya.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Melakukan demonstrasi langsung tentang bagaimana saran perbaikan tersebut bisa mempermudah kerjanya.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika perusahaan ingin beralih sepenuhnya ke sistem kerja remote (WFH), Anda akan menyarankan...',
                'options' => [
                    ['option_text' => 'Memperbanyak ruang berkumpul virtual informal agar karyawan tidak merasa kesepian.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyusun kebijakan dan SOP komprehensif mengenai jam kerja serta absensi remote.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan riset produktivitas karyawan sebelum dan sesudah uji coba WFH.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyelenggarakan pelatihan penggunaan tools kolaborasi digital bagi seluruh karyawan.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa reaksi pertama Anda ketika terpilih menerima penghargaan "Karyawan Terbaik"?',
                'options' => [
                    ['option_text' => 'Merasa terharu dan bersyukur karena usaha tulus Anda dihargai oleh orang lain.', 'category_result' => 'konselor'],
                    ['option_text' => 'Melihat penghargaan tersebut sebagai batu loncatan karir untuk naik jabatan berikutnya.', 'category_result' => 'hr'],
                    ['option_text' => 'Memikirkan variabel performa apa saja yang membuat Anda terpilih dibanding yang lain.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menggunakan momen tersebut untuk membagikan tips sukses Anda kepada rekan-rekan kerja.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat merancang kuesioner penilaian kinerja 360 derajat di kantor, fokus Anda adalah...',
                'options' => [
                    ['option_text' => 'Memastikan kerahasiaan penilaian agar penilai merasa aman memberikan feedback jujur.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyelaraskan kuesioner dengan standar kompetensi resmi dari departemen SDM.', 'category_result' => 'hr'],
                    ['option_text' => 'Menguji reliabilitas dan validitas butir pertanyaan agar hasil penilaian akurat.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Memastikan kuesioner diisi dengan antusias melalui penjelasan video petunjuk pengisian.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda merangkul karyawan baru yang sangat pemalu di kantor?',
                'options' => [
                    ['option_text' => 'Mendekatinya secara perlahan dan menemaninya saat makan siang agar ia merasa nyaman.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menugaskan rekan kerja senior sebagai buddy/mentor resminya selama masa orientasi.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengamati pola komunikasinya untuk mengetahui jenis tugas apa yang paling ia sukai.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengajaknya berpartisipasi aktif dalam game kelompok seru saat acara keakraban kantor.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika target proyek divisi Anda gagal tercapai, tindakan apa yang Anda prioritaskan?',
                'options' => [
                    ['option_text' => 'Membantu meredakan kekecewaan dan rasa frustrasi tim agar mental mereka tidak drop.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengevaluasi kembali alokasi sumber daya manusia dan efektivitas kerja masing-masing staf.', 'category_result' => 'hr'],
                    ['option_text' => 'Mencari tahu variabel pengganggu mana yang paling memengaruhi kegagalan lewat data log kerja.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Membuat program perbaikan kompetensi intensif untuk mengejar ketertinggalan skill.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat Anda harus memimpin proyek kolaborasi antar perusahaan, Anda akan memulai dengan...',
                'options' => [
                    ['option_text' => 'Membangun chemistry, rasa saling percaya, dan hubungan baik dengan perwakilan mitra.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyepakati Memorandum of Understanding (MoU) dan pembagian wewenang yang mengikat secara hukum.', 'category_result' => 'hr'],
                    ['option_text' => 'Melakukan analisis kelayakan komprehensif serta studi kasus kemitraan serupa sebelumnya.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengadakan lokakarya bersama untuk menyamakan persepsi visi proyek dengan cara interaktif.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa pandangan Anda tentang pentingnya "work-life balance" (keseimbangan hidup dan kerja)?',
                'options' => [
                    ['option_text' => 'Hal mutlak demi menjaga kewarasan emosional dan kesehatan mental jangka panjang.', 'category_result' => 'konselor'],
                    ['option_text' => 'Faktor penting untuk menekan angka absensi karyawan dan meningkatkan loyalitas organisasi.', 'category_result' => 'hr'],
                    ['option_text' => 'Variabel psikometris yang terbukti meningkatkan kualitas fokus kognitif saat bekerja.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Tema pelatihan yang sangat bagus untuk diajarkan kepada staf agar produktivitas melonjak.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Ketika merancang antarmuka sistem pengajuan cuti karyawan, prioritas utama Anda adalah...',
                'options' => [
                    ['option_text' => 'Menambahkan pesan ramah otomatis yang mendoakan agar liburan karyawan menyenangkan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Memastikan alur persetujuan cuti berjenjang terhubung langsung dengan sistem absensi HR.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengurangi jumlah klik dan kerumitan pengisian formulir agar ramah bagi pengguna.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyediakan video panduan singkat beranimasi menarik tentang cara menggunakan sistem tersebut.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda menyikapi desas-desus atau gosip miring yang beredar di kantor?',
                'options' => [
                    ['option_text' => 'Menenangkan rekan kerja yang menjadi korban gosip agar ia merasa memiliki dukungan moral.', 'category_result' => 'konselor'],
                    ['option_text' => 'Menyelidiki kebenaran informasi tersebut secara diam-diam demi menjaga integritas divisi.', 'category_result' => 'hr'],
                    ['option_text' => 'Menganalisis mengapa gosip tersebut bisa menyebar luas dan bagaimana pola sosialnya.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengadakan sesi forum internal terbuka untuk meluruskan kesalahpahaman secara transparan.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Saat Anda diminta mendesain program sertifikasi profesi baru, langkah awal Anda adalah...',
                'options' => [
                    ['option_text' => 'Menyelaraskan modul agar beban belajar tidak membuat peserta stres berkepanjangan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Mengajukan akreditasi program ke lembaga sertifikasi resmi tingkat nasional.', 'category_result' => 'hr'],
                    ['option_text' => 'Mengidentifikasi kompetensi inti melalui analisis mendalam kebutuhan industri terkini.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Menyusun kurikulum pengajaran yang interaktif disertai kriteria kelulusan yang menantang.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Jika atasan Anda memberikan instruksi kerja yang tidak masuk akal secara teknis, Anda akan...',
                'options' => [
                    ['option_text' => 'Menyampaikan keberatan Anda dengan bahasa yang santun agar tidak menyinggung harga diri atasan.', 'category_result' => 'konselor'],
                    ['option_text' => 'Meninjau kembali deskripsi pekerjaan Anda untuk melihat apakah instruksi tersebut masuk wewenang Anda.', 'category_result' => 'hr'],
                    ['option_text' => 'Menyodorkan data simulasi kegagalan teknis jika instruksi tersebut tetap dipaksakan berjalan.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Mengusulkan opsi solusi teknis alternatif yang lebih efektif dalam sesi diskusi dua arah.', 'category_result' => 'trainer']
                ]
            ],
            [
                'question_text' => 'Apa motivasi utama Anda untuk terus berkarya setiap hari?',
                'options' => [
                    ['option_text' => 'Keinginan tulus untuk menolong sesama manusia dan meringankan beban hidup mereka.', 'category_result' => 'konselor'],
                    ['option_text' => 'Dorongan untuk membangun reputasi profesional, mengelola organisasi besar, dan memimpin perubahan.', 'category_result' => 'hr'],
                    ['option_text' => 'Rasa penasaran ilmiah untuk memecahkan teka-teki perilaku manusia dan misteri sistem kerja.', 'category_result' => 'ux_researcher'],
                    ['option_text' => 'Semangat untuk menyebarkan ilmu bermanfaat, melatih generasi penerus, dan menginspirasi publik.', 'category_result' => 'trainer']
                ]
            ],
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
