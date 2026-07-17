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
        $questionsData = [
            [
                'question_text' => 'Bagaimana Anda merespons jika melihat rekan satu tim mengalami burnout?',
                'options' => [
                    ['option_text' => 'Mengajaknya mengobrol secara personal untuk mendengarkan keluh kesahnya.'],
                    ['option_text' => 'Mengatur ulang pembagian tugas tim agar beban kerjanya berkurang secara terstruktur.'],
                    ['option_text' => 'Menganalisis penyebab utama burnout tersebut dengan meninjau proses kerja.'],
                    ['option_text' => 'Memberikan sesi sharing motivasi dan teknik mengelola stres kepada seluruh tim.']
                ]
            ],
            [
                'question_text' => 'Ketika harus menyampaikan umpan balik (feedback) negatif kepada bawahan, apa pendekatan Anda?',
                'options' => [
                    ['option_text' => 'Menyampaikannya dengan sangat hati-hati agar tidak menyinggung perasaan dan tetap mendukung mentalnya.'],
                    ['option_text' => 'Mengacu pada metrik kinerja objektif dan mendiskusikan rencana perbaikan karier formal.'],
                    ['option_text' => 'Menggali alasan di balik perilakunya dengan mengajukan pertanyaan mendalam tentang hambatan kerjanya.'],
                    ['option_text' => 'Membimbingnya secara langsung dengan mencontohkan tindakan yang benar dan memberikan modul latihan.']
                ]
            ],
            [
                'question_text' => 'Dalam menghadapi konflik antara dua anggota tim yang berselisih paham, Anda akan...',
                'options' => [
                    ['option_text' => 'Menjadi mediator yang netral untuk meredakan ketegangan emosional di antara mereka.'],
                    ['option_text' => 'Menyelesaikan konflik berdasarkan aturan/SOP perusahaan yang berlaku adil bagi kedua pihak.'],
                    ['option_text' => 'Mencari tahu akar permasalahan dengan mewawancarai pihak-pihak terkait secara objektif.'],
                    ['option_text' => 'Mengadakan sesi diskusi interaktif untuk menemukan jalan tengah yang disepakati bersama.']
                ]
            ],
            [
                'question_text' => 'Apa prioritas utama Anda saat menyusun rencana pelatihan (training) tahunan?',
                'options' => [
                    ['option_text' => 'Membantu memulihkan motivasi internal dan kesejahteraan psikologis karyawan.'],
                    ['option_text' => 'Menyelaraskan modul pelatihan dengan visi strategis dan KPI organisasi.'],
                    ['option_text' => 'Melakukan survei kebutuhan pelatihan berbasis data perilaku dan kompetensi.'],
                    ['option_text' => 'Merancang metode penyampaian materi yang interaktif, seru, dan mudah dipahami.']
                ]
            ],
            [
                'question_text' => 'Jika ditunjuk memimpin proyek baru, langkah pertama yang Anda lakukan adalah...',
                'options' => [
                    ['option_text' => 'Memastikan setiap anggota tim merasa nyaman dan saling terkoneksi satu sama lain.'],
                    ['option_text' => 'Menetapkan peran, tanggung jawab, dan target performa yang jelas bagi setiap orang.'],
                    ['option_text' => 'Melakukan riset komparatif dan mengumpulkan data sebelum memutuskan metode kerja.'],
                    ['option_text' => 'Mempersiapkan presentasi kick-off yang menginspirasi untuk membakar semangat tim.']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda mengevaluasi efektivitas suatu sistem kerja baru?',
                'options' => [
                    ['option_text' => 'Menanyakan kepada staf apakah sistem baru tersebut membuat mereka stres atau tidak.'],
                    ['option_text' => 'Mengukur metrik retensi staf dan efisiensi biaya operasional setelah implementasi.'],
                    ['option_text' => 'Menguji kegunaan (usability) sistem secara langsung lewat observasi perilaku pengguna.'],
                    ['option_text' => 'Menyelenggarakan workshop evaluasi untuk melatih staf memaksimalkan sistem tersebut.']
                ]
            ],
            [
                'question_text' => 'Topik bacaan apa yang paling menarik perhatian Anda di perpustakaan?',
                'options' => [
                    ['option_text' => 'Buku tentang psikoterapi, empati, dan cara memahami luka batin.'],
                    ['option_text' => 'Buku tentang strategi manajemen SDM, kepatuhan hukum kerja, dan rekrutmen.'],
                    ['option_text' => 'Jurnal ilmiah tentang analisis data kognitif dan metode riset perilaku manusia.'],
                    ['option_text' => 'Buku tentang teknik public speaking, kepemimpinan transformasional, dan coaching.']
                ]
            ],
            [
                'question_text' => 'Saat melihat alur kerja (workflow) yang tidak efisien, Anda cenderung...',
                'options' => [
                    ['option_text' => 'Mendengarkan keluhan rekan kerja tentang frustrasi yang mereka rasakan akibat alur tersebut.'],
                    ['option_text' => 'Merumuskan kebijakan baru untuk menata ulang pembagian wewenang dalam tim.'],
                    ['option_text' => 'Memetakan langkah demi langkah alur kerja tersebut untuk mengidentifikasi bottleneck.'],
                    ['option_text' => 'Membuat materi sosialisasi yang menarik untuk menjelaskan cara kerja yang lebih cepat.']
                ]
            ],
            [
                'question_text' => 'Ketika rekan kerja melakukan kesalahan fatal yang menghambat proyek, reaksi Anda adalah...',
                'options' => [
                    ['option_text' => 'Menenangkan dirinya terlebih dahulu agar tidak merasa bersalah secara berlebihan.'],
                    ['option_text' => 'Melaporkan kejadian tersebut sesuai prosedur dan mendiskusikan sanksi atau evaluasi formal.'],
                    ['option_text' => 'Mengkaji sistem penempatan kerja untuk mengetahui apakah ia ditempatkan di posisi yang salah.'],
                    ['option_text' => 'Mengadaan sesi mentoring khusus untuk mengajarinya cara memperbaiki kesalahan tersebut.']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda mendeskripsikan peran ideal Anda dalam sebuah organisasi?',
                'options' => [
                    ['option_text' => 'Menjadi pendengar setia dan penyembuh suasana kerja bagi siapa saja yang membutuhkan.'],
                    ['option_text' => 'Menjadi pengambil keputusan yang adil dalam penataan staf dan kebijakan karir.'],
                    ['option_text' => 'Menjadi analis yang memecahkan masalah kompleks lewat data riset yang valid.'],
                    ['option_text' => 'Menjadi komunikator yang menginspirasi dan melatih orang lain agar berkembang.']
                ]
            ],
            [
                'question_text' => 'Apa yang Anda lakukan ketika ada perubahan regulasi mendadak dari manajemen puncak?',
                'options' => [
                    ['option_text' => 'Membantu menenangkan kecemasan rekan kerja agar tidak panik menghadapi perubahan.'],
                    ['option_text' => 'Segera memperbarui draf kebijakan operasional agar tetap patuh pada regulasi baru.'],
                    ['option_text' => 'Menganalisis dampak regulasi tersebut terhadap perilaku produktivitas harian karyawan.'],
                    ['option_text' => 'Menyusun presentasi penjelasan regulasi baru tersebut agar mudah dipahami semua orang.']
                ]
            ],
            [
                'question_text' => 'Ketika Anda mengadakan sesi wawancara, apa yang paling Anda fokuskan?',
                'options' => [
                    ['option_text' => 'Membangun kenyamanan emosional agar calon karyawan bisa terbuka tentang dirinya.'],
                    ['option_text' => 'Mencocokkan kualifikasi calon karyawan dengan kebutuhan kompetensi organisasi.'],
                    ['option_text' => 'Mengamati detail mikro-ekspresi dan pola pikir logis dari jawaban mereka.'],
                    ['option_text' => 'Memberikan gambaran inspiratif tentang visi perusahaan dan memotivasi mereka untuk bergabung.']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda meningkatkan retensi (kebertahanan) karyawan di kantor?',
                'options' => [
                    ['option_text' => 'Meningkatkan program konseling internal dan kesejahteraan mental karyawan.'],
                    ['option_text' => 'Merancang jenjang karir yang jelas dan sistem reward yang kompetitif.'],
                    ['option_text' => 'Melakukan survei kepuasan kerja berkala untuk menemukan faktor penyebab resign.'],
                    ['option_text' => 'Menyediakan program pelatihan keterampilan berkelanjutan yang menarik minat mereka.']
                ]
            ],
            [
                'question_text' => 'Saat menyusun laporan hasil kerja akhir tahun, Anda lebih suka menyajikannya dengan...',
                'options' => [
                    ['option_text' => 'Menyisipkan testimoni perasaan dan tingkat kepuasan tim selama bekerja.'],
                    ['option_text' => 'Menyajikan matriks pencapaian KPI individu dan efektivitas organisasi.'],
                    ['option_text' => 'Menggunakan grafik analitis mendalam dan visualisasi data yang presisi.'],
                    ['option_text' => 'Menyampaikan poin-poin penting secara lisan dengan presentasi yang memukau.']
                ]
            ],
            [
                'question_text' => 'Ketika berdiskusi dalam kelompok kecil, kontribusi utama Anda biasanya berupa...',
                'options' => [
                    ['option_text' => 'Memastikan semua anggota merasa didengar dan dihargai pendapatnya.'],
                    ['option_text' => 'Mengarahkan diskusi agar tetap fokus pada tujuan dan waktu yang disepakati.'],
                    ['option_text' => 'Mempertanyakan asumsi awal dengan menyodorkan data atau fakta ilmiah alternatif.'],
                    ['option_text' => 'Menyederhanakan ide-ide rumit anggota kelompok menjadi kesimpulan yang menarik.']
                ]
            ],
            [
                'question_text' => 'Jika diminta merancang ruang kantor baru, aspek apa yang paling Anda perhatikan?',
                'options' => [
                    ['option_text' => 'Menyediakan area khusus relaksasi mental dan pojok curhat yang tenang.'],
                    ['option_text' => 'Mengoptimalkan tata letak meja kerja demi kelancaran koordinasi antar divisi.'],
                    ['option_text' => 'Menganalisis kebiasaan gerak staf saat bekerja untuk efisiensi ruang ergonomis.'],
                    ['option_text' => 'Membuat ruang kolaborasi kreatif yang dinamis dan memicu inspirasi diskusi.']
                ]
            ],
            [
                'question_text' => 'Bagaimana pendekatan Anda dalam mengajarkan keterampilan baru yang sulit kepada rekan kerja?',
                'options' => [
                    ['option_text' => 'Mendampingi proses belajarnya dengan sabar dan memberikan dorongan moral yang konstan.'],
                    ['option_text' => 'Menyediakan manual pelatihan terstruktur dengan indikator keberhasilan yang jelas.'],
                    ['option_text' => 'Memecah keterampilan tersebut menjadi bagian-bagian logis berdasarkan riset efektivitas.'],
                    ['option_text' => 'Mengadakan simulasi interaktif yang menarik agar ia bisa mempraktikkannya langsung.']
                ]
            ],
            [
                'question_text' => 'Saat menghadapi proyek dengan tenggat waktu sangat ketat, fokus Anda adalah...',
                'options' => [
                    ['option_text' => 'Menjaga keharmonisan dan level stres anggota tim agar tidak ada yang kelelahan.'],
                    ['option_text' => 'Membagi tugas berdasarkan spesialisasi masing-masing dan memantau progres harian.'],
                    ['option_text' => 'Mengkaji ulang metode kerja untuk menemukan cara tercepat secara ilmiah.'],
                    ['option_text' => 'Mengumpulkan tim secara berkala untuk menyuntikkan semangat kerja baru.']
                ]
            ],
            [
                'question_text' => 'Ketika mengamati performa kerja bawahan yang menurun drastis, tindakan pertama Anda adalah...',
                'options' => [
                    ['option_text' => 'Mengajaknya makan siang bersama untuk menanyakan apakah ia sedang memiliki masalah keluarga.'],
                    ['option_text' => 'Melakukan tinjauan KPI formal dan membuat rencana pembinaan karir terstruktur.'],
                    ['option_text' => 'Mengamati interaksinya dengan sistem kerja baru untuk mencari akar masalah teknis.'],
                    ['option_text' => 'Memberikannya sesi coaching pribadi untuk membangkitkan kembali visi kerjanya.']
                ]
            ],
            [
                'question_text' => 'Topik diskusi apa yang paling membuat Anda bersemangat saat menghadiri seminar?',
                'options' => [
                    ['option_text' => 'Kesejahteraan mental pekerja dan pentingnya empati di era modern.'],
                    ['option_text' => 'Peran kecerdasan buatan dalam memetakan efisiensi biaya SDM perusahaan.'],
                    ['option_text' => 'Metode riset terbaru tentang perilaku konsumen digital di era industri 4.0.'],
                    ['option_text' => 'Strategi komunikasi publik yang efektif untuk memimpin perubahan organisasi.']
                ]
            ],
            [
                'question_text' => 'Apa reaksi spontan Anda saat menemukan ada kesalahan data pada laporan yang telah disubmit?',
                'options' => [
                    ['option_text' => 'Menyampaikannya dengan lembut kepada pembuat laporan agar ia tidak terlalu tertekan.'],
                    ['option_text' => 'Segera menarik laporan tersebut dan mencatatnya sebagai bahan evaluasi sistem kerja.'],
                    ['option_text' => 'Menganalisis ulang seluruh dataset untuk menemukan letak ketidakkonsistenan angka.'],
                    ['option_text' => 'Menggunakan kesalahan tersebut sebagai studi kasus menarik untuk sesi pelatihan berikutnya.']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda ingin orang lain mengingat Anda di tempat kerja?',
                'options' => [
                    ['option_text' => 'Sebagai orang yang selalu peduli, ramah, dan siap membantu masalah emosional siapa saja.'],
                    ['option_text' => 'Sebagai pemimpin profesional yang adil, disiplin, dan mampu merancang karir staf.'],
                    ['option_text' => 'Sebagai analis cerdas yang berhasil membongkar akar masalah kompleks melalui data.'],
                    ['option_text' => 'Sebagai motivator ulung yang berhasil menginspirasi orang lain untuk tumbuh hebat.']
                ]
            ],
            [
                'question_text' => 'Apa kriteria lingkungan kerja ideal yang paling ingin Anda tempati?',
                'options' => [
                    ['option_text' => 'Suasana kekeluargaan yang erat, minim persaingan, dan saling dukung.'],
                    ['option_text' => 'Perusahaan besar dengan struktur karir jelas, SOP kokoh, dan stabilitas finansial.'],
                    ['option_text' => 'Laboratorium riset atau agensi inovatif yang berbasis data empiris.'],
                    ['option_text' => 'Pusat pelatihan yang dinamis dan dipenuhi oleh sesi diskusi interaktif.']
                ]
            ],
            [
                'question_text' => 'Saat merancang kuesioner evaluasi program kerja, fokus utama pertanyaan Anda adalah...',
                'options' => [
                    ['option_text' => 'Bagaimana perasaan peserta selama mengikuti program tersebut.'],
                    ['option_text' => 'Apakah program tersebut meningkatkan efisiensi operasional staf secara signifikan.'],
                    ['option_text' => 'Apakah butir-butir pertanyaan kuesioner memiliki validitas perilaku yang kuat.'],
                    ['option_text' => 'Bagaimana materi program tersebut bisa disampaikan dengan lebih menarik di masa depan.']
                ]
            ],
            [
                'question_text' => 'Bagaimana reaksi Anda saat menghadapi keluhan (complaint) pelanggan yang sangat marah?',
                'options' => [
                    ['option_text' => 'Mendengarkan keluhannya dengan empati penuh hingga emosinya mereda.'],
                    ['option_text' => 'Menyelesaikan keluhan tersebut berdasarkan garansi resmi perusahaan.'],
                    ['option_text' => 'Mencatat detail keluhan untuk menganalisis kelemahan desain sistem produk.'],
                    ['option_text' => 'Menjelaskan solusi alternatif secara lugas dan mengedukasi cara pencegahannya.']
                ]
            ],
            [
                'question_text' => 'Ketika merumuskan visi jangka panjang sebuah organisasi, Anda lebih condong berfokus pada...',
                'options' => [
                    ['option_text' => 'Membangun budaya organisasi yang ramah kesehatan mental karyawan.'],
                    ['option_text' => 'Mengembangkan struktur organisasi yang siap ekspansi dan stabil secara finansial.'],
                    ['option_text' => 'Melakukan riset mendalam tentang arah pergeseran teknologi global.'],
                    ['option_text' => 'Merancang program pemberdayaan kapasitas SDM secara berkala.']
                ]
            ],
            [
                'question_text' => 'Ketika tim Anda mengalami konflik internal yang panas, tindakan taktis pertama Anda adalah...',
                'options' => [
                    ['option_text' => 'Memanggil setiap pihak secara terpisah untuk memulihkan keharmonisan emosional.'],
                    ['option_text' => 'Melakukan mediasi berdasarkan kode etik perilaku karyawan perusahaan.'],
                    ['option_text' => 'Mengumpulkan data objektif tentang penyebab terjadinya konflik secara tidak memihak.'],
                    ['option_text' => 'Memimpin rapat rekonsiliasi bersama untuk memicu kolaborasi kreatif baru.']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda menumbuhkan kepercayaan (trust) dari bawahan Anda?',
                'options' => [
                    ['option_text' => 'Menjadi pendengar yang aman dan tidak menghakimi kesalahan pribadi mereka.'],
                    ['option_text' => 'Menunjukkan transparansi penilaian karir dan bersikap adil dalam penugasan.'],
                    ['option_text' => 'Menunjukkan kompetensi riset Anda yang didukung data ilmiah yang kuat.'],
                    ['option_text' => 'Menjadi mentor yang secara konsisten membimbing mereka menguasai ilmu baru.']
                ]
            ],
            [
                'question_text' => 'Apa yang paling Anda hindari saat memimpin sesi diskusi kelompok?',
                'options' => [
                    ['option_text' => 'Terjadinya ketegangan emosional yang menyakiti perasaan salah satu anggota.'],
                    ['option_text' => 'Diskusi yang melantur tanpa menghasilkan kesimpulan taktis yang produktif.'],
                    ['option_text' => 'Kesimpulan diskusi yang diambil tanpa didasari oleh data pendukung yang kuat.'],
                    ['option_text' => 'Suasana rapat yang membosankan dan kurang memicu partisipasi aktif peserta.']
                ]
            ],
            [
                'question_text' => 'Ketika mengevaluasi calon vendor baru, parameter terpenting bagi Anda adalah...',
                'options' => [
                    ['option_text' => 'Seberapa baik reputasi kepedulian sosial dan keramahan tim kerja mereka.'],
                    ['option_text' => 'Kesesuaian legalitas hukum dan stabilitas skala bisnis vendor tersebut.'],
                    ['option_text' => 'Hasil uji coba teknis dan keandalan data performa layanan mereka.'],
                    ['option_text' => 'Kemudahan materi penjelasan panduan layanan yang mereka sajikan.']
                ]
            ],
            [
                'question_text' => 'Jika Anda diminta menulis buku, topik apa yang paling ingin Anda bahas?',
                'options' => [
                    ['option_text' => 'Panduan memulihkan kelelahan batin dan membangun ketahanan emosi.'],
                    ['option_text' => 'Panduan menyusun arsitektur manajemen SDM untuk perusahaan startup.'],
                    ['option_text' => 'Metodologi melakukan analisis perilaku konsumen berbasis riset UX.'],
                    ['option_text' => 'Teknik berbicara di depan umum yang mampu memukau ribuan audiens.']
                ]
            ],
            [
                'question_text' => 'Apa langkah pertama Anda ketika mendeteksi adanya kemunduran produktivitas pada satu departemen?',
                'options' => [
                    ['option_text' => 'Mengadakan sesi konseling kelompok untuk mendengar keluhan suasana kerja mereka.'],
                    ['option_text' => 'Melakukan audit kepatuhan kerja dan meninjau kembali target KPI manajer terkait.'],
                    ['option_text' => 'Melakukan riset alur kerja untuk mendeteksi bottleneck sistem operasional.'],
                    ['option_text' => 'Menyelenggarakan sesi workshop motivasi untuk menyegarkan kembali semangat departemen.']
                ]
            ],
            [
                'question_text' => 'Ketika memandu karyawan baru yang kesulitan beradaptasi, pendekatan Anda adalah...',
                'options' => [
                    ['option_text' => 'Memberikan dukungan emosional konstan agar ia tidak merasa terisolasi.'],
                    ['option_text' => 'Mencocokkannya dengan program buddy system terstruktur dan mengenalkan regulasi kantor.'],
                    ['option_text' => 'Menganalisis gaya belajarnya untuk menyesuaikan metode orientasi kerja.'],
                    ['option_text' => 'Memberikan sesi presentasi pengenalan visi budaya perusahaan yang interaktif.']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda menyikapi kegagalan tim dalam mencapai target kuartalan?',
                'options' => [
                    ['option_text' => 'Merangkul tim agar mereka tidak terpuruk dan memulihkan mentalitas mereka.'],
                    ['option_text' => 'Mengevaluasi pembagian beban kerja dan menyusun draf strategi perbaikan target.'],
                    ['option_text' => 'Mengkaji ulang data estimasi target sebelumnya untuk mencari letak kesalahan proyeksi.'],
                    ['option_text' => 'Mengadakan sesi pembelajaran interaktif untuk mengevaluasi kesalahan taktis bersama.']
                ]
            ],
            [
                'question_text' => 'Apa yang Anda lakukan saat melihat rekan kerja diperlakukan tidak adil oleh atasan?',
                'options' => [
                    ['option_text' => 'Mendampinginya secara personal untuk memberikan dukungan mental penuh.'],
                    ['option_text' => 'Membantunya menyusun laporan keberatan formal sesuai mekanisme hukum perusahaan.'],
                    ['option_text' => 'Mengumpulkan kronologi kejadian secara objektif untuk menghindari bias penilaian.'],
                    ['option_text' => 'Menyarankannya mendiskusikan masalah tersebut secara komunikatif dengan atasan.']
                ]
            ],
            [
                'question_text' => 'Ketika merancang materi presentasi hasil riset, apa fokus utama Anda?',
                'options' => [
                    ['option_text' => 'Menyelipkan narasi humanis tentang kepuasan emosi responden.'],
                    ['option_text' => 'Menyusun alur presentasi yang logis, formal, dan sesuai standar eksekutif.'],
                    ['option_text' => 'Menyertakan grafik analisis statistika perilaku yang teruji validitasnya.'],
                    ['option_text' => 'Menggunakan analogi seru dan visual interaktif yang menarik perhatian audiens.']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda mengelola keseimbangan antara pekerjaan dan kehidupan pribadi (work-life balance)?',
                'options' => [
                    ['option_text' => 'Mendengarkan alarm tubuh Anda dan segera beristirahat saat emosi mulai jenuh.'],
                    ['option_text' => 'Membuat jadwal disiplin mingguan yang memisahkan waktu kerja dan keluarga secara kaku.'],
                    ['option_text' => 'Menganalisis produktivitas harian Anda untuk mengeliminasi aktivitas yang membuang waktu.'],
                    ['option_text' => 'Mengikuti kelas yoga, seminar kebugaran, atau komunitas berbagi cerita inspiratif.']
                ]
            ],
            [
                'question_text' => 'Apa tindakan Anda jika melihat salah satu anggota kelompok mendominasi jalannya rapat?',
                'options' => [
                    ['option_text' => 'Mendekatinya secara personal setelah rapat selesai agar ia lebih menghargai orang lain.'],
                    ['option_text' => 'Menerapkan aturan waktu bicara per orang sesuai agenda resmi rapat.'],
                    ['option_text' => 'Mencatat dominasinya sebagai bias data pendapat yang harus disaring.'],
                    ['option_text' => 'Menginterupsi secara halus untuk memberikan kesempatan bicara bagi anggota yang pasif.']
                ]
            ],
            [
                'question_text' => 'Saat merancang survei budaya organisasi, aspek apa yang paling ingin Anda potret?',
                'options' => [
                    ['option_text' => 'Tingkat kebahagiaan psikologis dan rasa aman emosional karyawan.'],
                    ['option_text' => 'Keseuaian perilaku kerja staf dengan nilai-nilai inti (core values) perusahaan.'],
                    ['option_text' => 'Pola interaksi karyawan saat menggunakan fasilitas sistem digital kantor.'],
                    ['option_text' => 'Efektivitas modul kepemimpinan manajer dalam memotivasi bawahannya.']
                ]
            ],
            [
                'question_text' => 'Ketika Anda terpilih sebagai karyawan terbaik, penghargaan apa yang paling membahagiakan Anda?',
                'options' => [
                    ['option_text' => 'Apresiasi tulus dari rekan kerja yang merasa terbantu oleh keberadaan Anda.'],
                    ['option_text' => 'Promosi kenaikan jabatan resmi dan fasilitas tunjangan yang lebih stabil.'],
                    ['option_text' => 'Kesempatan memimpin proyek riset inovasi baru yang didanai penuh oleh kantor.'],
                    ['option_text' => 'Kesempatan menjadi pembicara utama untuk membagikan kisah sukses Anda di depan publik.']
                ]
            ],
            [
                'question_text' => 'Bagaimana reaksi Anda jika sistem kerja yang Anda rancang ditolak oleh tim?',
                'options' => [
                    ['option_text' => 'Mendengar keluh kesah dan rasa frustrasi mereka untuk meredakan penolakan.'],
                    ['option_text' => 'Meninjau kembali kesesuaian sistem baru tersebut dengan regulasi kerja formal.'],
                    ['option_text' => 'Mengadakan uji coba terkontrol untuk mengumpulkan data kelemahan sistem secara nyata.'],
                    ['option_text' => 'Mengadakan sesi demo interaktif untuk melatih tim tentang kemudahan sistem tersebut.']
                ]
            ],
            [
                'question_text' => 'Apa langkah pertama Anda dalam merancang sistem penghargaan (reward system) baru?',
                'options' => [
                    ['option_text' => 'Memastikan reward tersebut memberikan kebahagiaan psikologis bagi staf.'],
                    ['option_text' => 'Menyelaraskan anggaran reward dengan performa keuangan jangka panjang bisnis.'],
                    ['option_text' => 'Meneliti korelasi antara kepuasan kerja dengan skema reward sebelumnya.'],
                    ['option_text' => 'Menyosialisasikan draf reward baru tersebut secara menarik agar memicu antusiasme karyawan.']
                ]
            ],
            [
                'question_text' => 'Ketika bawahan Anda membuat keputusan mandiri yang salah, apa sikap Anda?',
                'options' => [
                    ['option_text' => 'Menghibur hatinya agar tidak patah semangat, lalu mendiskusikan jalan keluarnya.'],
                    ['option_text' => 'Menegaskan kembali batas wewenang pengambilan keputusan sesuai SOP organisasi.'],
                    ['option_text' => 'Mengkaji variabel penyebab kesalahan keputusan tersebut untuk perbaikan sistem masa depan.'],
                    ['option_text' => 'Menjadikan kesalahan tersebut sebagai topik studi kasus pembelajaran dalam rapat evaluasi.']
                ]
            ],
            [
                'question_text' => 'Apa hal terpenting yang Anda pertimbangkan saat memilih program studi lanjutan?',
                'options' => [
                    ['option_text' => 'Kurikulum yang mengajarkan empati sosial dan pemahaman psikologi mendalam.'],
                    ['option_text' => 'Gelar yang diakui luas di industri dan memperkuat prospek karir manajerial.'],
                    ['option_text' => 'Ketersediaan laboratorium riset perilaku yang dilengkapi teknologi analisis terkini.'],
                    ['option_text' => 'Metode perkuliahan yang interaktif, penuh diskusi kelas, dan melatih presentasi.']
                ]
            ],
            [
                'question_text' => 'Bagaimana cara Anda memitigasi risiko terjadinya konflik kepentingan (conflict of interest) di tim?',
                'options' => [
                    ['option_text' => 'Membangun kesadaran moral pribadi secara interpersonal melalui keteladanan.'],
                    ['option_text' => 'Menyusun pakta integritas resmi dan kebijakan audit kepatuhan secara berkala.'],
                    ['option_text' => 'Menganalisis potensi benturan kepentingan melalui diagram relasi kerja tim.'],
                    ['option_text' => 'Mengadakan sesi edukasi interaktif tentang batas etika profesional kerja.']
                ]
            ],
            [
                'question_text' => 'Ketika ditugaskan memimpin proyek perubahan organisasi, langkah awal Anda adalah...',
                'options' => [
                    ['option_text' => 'Mendengarkan ketakutan karyawan tentang ketidakpastian masa depan akibat perubahan.'],
                    ['option_text' => 'Menyusun draf rencana transisi peran, tanggung jawab, dan target lini masa kerja.'],
                    ['option_text' => 'Melakukan survei kesiapan berubah karyawan berbasis instrumen perilaku.'],
                    ['option_text' => 'Menyampaikan pidato perubahan yang menginspirasi untuk menyatukan visi masa depan.']
                ]
            ],
            [
                'question_text' => 'Bagaimana pendekatan Anda saat menyusun materi pelatihan kepemimpinan?',
                'options' => [
                    ['option_text' => 'Menekankan pentingnya empati, kehangatan hubungan, dan kesehatan mental staf.'],
                    ['option_text' => 'Menekankan teknik supervisi target kerja, delegasi tugas, dan kedisiplinan organisasi.'],
                    ['option_text' => 'Menyertakan teori-teori kepemimpinan mutakhir berbasis riset akademis yang kuat.'],
                    ['option_text' => 'Merancang studi kasus diskusi kelompok kecil dan simulasi permainan peran (roleplay).']
                ]
            ],
            [
                'question_text' => 'Apa reaksi Anda ketika melihat pelanggaran etika ringan di lingkungan kerja?',
                'options' => [
                    ['option_text' => 'Mengajak pelanggar berdiskusi berdua untuk memahami latar belakang tindakannya.'],
                    ['option_text' => 'Memberikan teguran lisan formal sesuai aturan kedisiplinan perusahaan.'],
                    ['option_text' => 'Mencatat frekuensi pelanggaran etika tersebut untuk perbaikan sistem kontrol.'],
                    ['option_text' => 'Menjelaskan dampak buruk pelanggaran tersebut dalam sesi evaluasi tim mingguan.']
                ]
            ],
            [
                'question_text' => 'Bagaimana Anda merespons instruksi atasan yang Anda rasa kurang efektif?',
                'options' => [
                    ['option_text' => 'Mendiskusikan kekhawatiran Anda secara personal demi menjaga kenyamanan hubungan kerja.'],
                    ['option_text' => 'Meninjau kembali deskripsi pekerjaan Anda untuk melihat apakah instruksi tersebut masuk wewenang Anda.'],
                    ['option_text' => 'Menyodorkan data simulasi kegagalan teknis jika instruksi tersebut tetap dipaksakan berjalan.'],
                    ['option_text' => 'Mengusulkan opsi solusi teknis alternatif yang lebih efektif dalam sesi diskusi dua arah.']
                ]
            ],
            [
                'question_text' => 'Apa motivasi utama Anda untuk terus berkarya setiap hari?',
                'options' => [
                    ['option_text' => 'Keinginan tulus untuk menolong sesama manusia dan meringankan beban hidup mereka.'],
                    ['option_text' => 'Dorongan untuk membangun reputasi profesional, mengelola organisasi besar, dan memimpin perubahan.'],
                    ['option_text' => 'Rasa penasaran ilmiah untuk memecahkan teka-teki perilaku manusia dan misteri sistem kerja.'],
                    ['option_text' => 'Semangat untuk menyebarkan ilmu bermanfaat, melatih generasi penerus, dan menginspirasi publik.']
                ]
            ],
        ];

        // 4. Seed Questions and Options
        $professions = [
            'dokter_medis',
            'guru_pendidik',
            'software_engineer',
            'hr_talent',
            'konselor_psikolog',
            'financial_analyst',
            'arsitek_desainer',
            'entrepreneur',
            'legal_lawyer',
            'digital_marketer',
            'content_creator',
            'data_scientist'
        ];

        foreach ($questionsData as $index => $qData) {
            $question = Question::create([
                'course_id' => $course->id,
                'question_text' => $qData['question_text'],
                'order_number' => $index + 1
            ]);

            foreach ($qData['options'] as $oIndex => $oData) {
                // Assign professions in a round-robin balanced way
                $profIndex = ($index * 4 + $oIndex) % count($professions);
                $categoryResult = $professions[$profIndex];

                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $oData['option_text'],
                    'category_result' => $categoryResult
                ]);
            }
        }
    }
}
