<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Testimonial;
use App\Models\AlumniProject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 0. Seed Demo Users
        User::factory()->create([
            'name' => 'Admin Edtech',
            'email' => 'admin@edtech.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Siswa Demo',
            'email' => 'siswa@edtech.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // 1. Seed Categories
        $categories = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'icon' => 'code-bracket',
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'icon' => 'device-phone-mobile',
            ],
            [
                'name' => 'Cloud Computing',
                'slug' => 'cloud-computing',
                'icon' => 'cloud',
            ],
            [
                'name' => 'Artificial Intelligence',
                'slug' => 'artificial-intelligence',
                'icon' => 'cpu-chip',
            ],
        ];

        $categoryModels = [];
        foreach ($categories as $category) {
            $categoryModels[$category['slug']] = Category::create($category);
        }

        // 2. Seed Courses (min 8 data)
        $courses = [
            // Web Development Courses
            [
                'category_id' => $categoryModels['web-development']->id,
                'title' => 'Kuasai Laravel 11 & Livewire 3 dari Nol',
                'slug' => 'kuasai-laravel-11-livewire-3-dari-nol',
                'description' => 'Pelajari framework PHP terpopuler di dunia untuk membangun aplikasi web modern, aman, dan reaktif dengan cepat menggunakan Livewire v3 dan Tailwind CSS.',
                'level' => 'Pemula',
                'duration_hours' => 40,
                'rating' => 4.8,
                'total_students' => 1240,
                'image_path' => 'courses/laravel-livewire.jpg',
                'price' => 699000,
                'learning_paths' => ['Fullstack Web Developer', 'Backend Engineer'],
                'topics' => ['PHP', 'Laravel 11', 'Livewire 3', 'Tailwind CSS', 'Alpine.js'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Source Code Proyek Riil', 'Grup Telegram Premium', 'Review Code dari Mentor'],
                'promo_title' => 'Diskon Peluncuran 50%',
                'promo_end_date' => now()->addDays(14)->toDateString(),
            ],
            [
                'category_id' => $categoryModels['web-development']->id,
                'title' => 'Modern Web Development dengan React dan Next.js',
                'slug' => 'modern-web-development-dengan-react-dan-next-js',
                'description' => 'Bangun aplikasi single-page (SPA) dan server-side rendered (SSR) berskala produksi menggunakan React 19, Next.js 15, dan Tailwind CSS.',
                'level' => 'Menengah',
                'duration_hours' => 35,
                'rating' => 4.9,
                'total_students' => 850,
                'image_path' => 'courses/react-next.jpg',
                'price' => 799000,
                'learning_paths' => ['Frontend Developer', 'Fullstack JavaScript Developer'],
                'topics' => ['React 19', 'Next.js 15', 'TypeScript', 'Tailwind CSS', 'NextAuth'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Tugas Ulasan Mentor', 'Grup Diskusi Komunitas'],
                'promo_title' => 'Promo Spesial Next.js 15',
                'promo_end_date' => now()->addDays(7)->toDateString(),
            ],
            [
                'category_id' => $categoryModels['web-development']->id,
                'title' => 'RESTful API Development dengan Node.js & Express',
                'slug' => 'restful-api-development-dengan-node-js-express',
                'description' => 'Langkah praktis mendesain dan membuat arsitektur backend API yang aman, cepat, terdokumentasi dengan Swagger, dan terintegrasi ke database SQL/NoSQL.',
                'level' => 'Menengah',
                'duration_hours' => 28,
                'rating' => 4.6,
                'total_students' => 410,
                'image_path' => 'courses/nodejs-api.jpg',
                'price' => 599000,
                'learning_paths' => ['Backend Engineer', 'Fullstack JavaScript Developer'],
                'topics' => ['Node.js', 'Express', 'MongoDB', 'PostgreSQL', 'Swagger API', 'JWT Auth'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Panduan Deploy Production', 'Panduan Dokumentasi Postman'],
                'promo_title' => null,
                'promo_end_date' => null,
            ],

            // Mobile Development Courses
            [
                'category_id' => $categoryModels['mobile-development']->id,
                'title' => 'Pembangunan Aplikasi Mobile Multiplatform dengan Flutter',
                'slug' => 'pembangunan-aplikasi-mobile-multiplatform-dengan-flutter',
                'description' => 'Buat aplikasi mobile indah, mulus, dan berperforma tinggi untuk Android dan iOS sekaligus hanya dengan satu codebase menggunakan SDK Flutter dan bahasa Dart.',
                'level' => 'Pemula',
                'duration_hours' => 45,
                'rating' => 4.7,
                'total_students' => 960,
                'image_path' => 'courses/flutter-multiplatform.jpg',
                'price' => 649000,
                'learning_paths' => ['Mobile Developer', 'Flutter Specialist'],
                'topics' => ['Dart', 'Flutter SDK', 'BloC State Management', 'Firebase Integration', 'App Store Deploy'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Review Code Proyek Akhir', 'Aset Desain Figma Gratis'],
                'promo_title' => 'Diskon Akhir Pekan',
                'promo_end_date' => now()->addDays(2)->toDateString(),
            ],
            [
                'category_id' => $categoryModels['mobile-development']->id,
                'title' => 'Native iOS Apps Development dengan Swift & SwiftUI',
                'slug' => 'native-ios-apps-development-dengan-swift-swiftui',
                'description' => 'Belajar mendesain, membuat layout deklaratif, mengelola state, dan mempublikasikan aplikasi iOS native berkualitas App Store menggunakan Swift dan SwiftUI.',
                'level' => 'Mahir',
                'duration_hours' => 50,
                'rating' => 4.9,
                'total_students' => 185,
                'image_path' => 'courses/swift-swiftui.jpg',
                'price' => 899000,
                'learning_paths' => ['iOS Developer', 'Apple Platform Specialist'],
                'topics' => ['Swift Language', 'SwiftUI', 'CoreData', 'Combine Framework', 'App Store Connect'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Mock Interview Kerja', 'Konsultasi CV Portofolio'],
                'promo_title' => null,
                'promo_end_date' => null,
            ],

            // Cloud Computing Courses
            [
                'category_id' => $categoryModels['cloud-computing']->id,
                'title' => 'AWS Cloud Practitioner & SysOps Administrator',
                'slug' => 'aws-cloud-practitioner-sysops-administrator',
                'description' => 'Pahami infrastruktur dasar Amazon Web Services (AWS), manajemen resource EC2/S3, VPC, keamanan jaringan, serta deployment arsitektur serverless.',
                'level' => 'Pemula',
                'duration_hours' => 30,
                'rating' => 4.7,
                'total_students' => 530,
                'image_path' => 'courses/aws-cloud.jpg',
                'price' => 749000,
                'learning_paths' => ['Cloud Engineer', 'DevOps Specialist'],
                'topics' => ['AWS EC2', 'Amazon S3', 'VPC Networking', 'IAM Security', 'AWS Lambda'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Voucher Ujian Sertifikasi AWS', 'Panduan Hands-on Lab'],
                'promo_title' => 'Persiapan Sertifikasi AWS',
                'promo_end_date' => now()->addDays(5)->toDateString(),
            ],
            [
                'category_id' => $categoryModels['cloud-computing']->id,
                'title' => 'Kubernetes & Docker: DevOps Tools Masterclass',
                'slug' => 'kubernetes-docker-devops-tools-masterclass',
                'description' => 'Implementasikan pipeline CI/CD modern, kontainerisasi aplikasi mikro dengan Docker, dan orkestrasi container secara otomatis menggunakan Kubernetes.',
                'level' => 'Mahir',
                'duration_hours' => 42,
                'rating' => 4.8,
                'total_students' => 320,
                'image_path' => 'courses/kubernetes-docker.jpg',
                'price' => 849000,
                'learning_paths' => ['DevOps Engineer', 'Site Reliability Engineer'],
                'topics' => ['Docker Containers', 'Kubernetes Clusters', 'Helm Charts', 'GitHub Actions', 'Prometheus & Grafana'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Simulasi Ujian CKA', 'Lab Terraform Gratis'],
                'promo_title' => null,
                'promo_end_date' => null,
            ],

            // Artificial Intelligence Courses
            [
                'category_id' => $categoryModels['artificial-intelligence']->id,
                'title' => 'Pengenalan Machine Learning dengan Python & Scikit-Learn',
                'slug' => 'pengenalan-machine-learning-dengan-python-scikit-learn',
                'description' => 'Masuki dunia kecerdasan buatan melalui pemahaman algoritma regresi, klasifikasi, pembersihan data (preprocessing), dan implementasi model ML menggunakan Python.',
                'level' => 'Menengah',
                'duration_hours' => 38,
                'rating' => 4.6,
                'total_students' => 670,
                'image_path' => 'courses/machine-learning.jpg',
                'price' => 699000,
                'learning_paths' => ['Data Scientist', 'AI Engineer'],
                'topics' => ['Python Programming', 'Pandas & NumPy', 'Scikit-Learn', 'Supervised Learning', 'Data Preprocessing'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Dataset Riil Industri', 'Pendampingan Karir Data Science'],
                'promo_title' => 'Diskon Khusus AI 30%',
                'promo_end_date' => now()->addDays(8)->toDateString(),
            ],
            [
                'category_id' => $categoryModels['artificial-intelligence']->id,
                'title' => 'Deep Learning & Computer Vision menggunakan PyTorch',
                'slug' => 'deep-learning-computer-vision-menggunakan-pytorch',
                'description' => 'Latih model neural network Anda sendiri untuk mendeteksi objek, klasifikasi citra, estimasi pose, dan pemrosesan video tingkat lanjut menggunakan PyTorch.',
                'level' => 'Mahir',
                'duration_hours' => 48,
                'rating' => 4.9,
                'total_students' => 215,
                'image_path' => 'courses/pytorch-vision.jpg',
                'price' => 949000,
                'learning_paths' => ['AI Researcher', 'Computer Vision Engineer'],
                'topics' => ['Neural Networks', 'CNN Architecture', 'PyTorch Framework', 'OpenCV Integration', 'Model Optimization'],
                'benefits' => ['Akses Selamanya', 'Sertifikat Kompetensi', 'Akses Server GPU Google Colab', 'Mentorship Proyek Riset'],
                'promo_title' => null,
                'promo_end_date' => null,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        // 3. Seed Testimonials (min 5 data)
        $testimonials = [
            [
                'student_name' => 'Budi Santoso',
                'role' => 'Junior Web Developer',
                'company' => 'Tokopedia',
                'quote' => 'Belajar di Edtech Platform membuka jalan karir saya. Materi Laravel dan React yang diajarkan sangat praktis dan sesuai dengan standar industri startup saat ini.',
                'avatar_path' => 'avatars/budi.jpg',
            ],
            [
                'student_name' => 'Siti Rahma',
                'role' => 'Mobile Developer',
                'company' => 'Gojek',
                'quote' => 'Kelas Flutter-nya luar biasa! Instruktur menjelaskan konsep state management Bloc dan Riverpod yang rumit dengan analogi yang sangat mudah dicerna.',
                'avatar_path' => 'avatars/siti.jpg',
            ],
            [
                'student_name' => 'Aditya Pratama',
                'role' => 'DevOps Engineer',
                'company' => 'Doku',
                'quote' => 'Materi Kubernetes dan AWS sangat mendalam dan penuh dengan praktik lab. Berkat kelas ini, saya berhasil lulus ujian sertifikasi AWS Certified Solutions Architect.',
                'avatar_path' => 'avatars/aditya.jpg',
            ],
            [
                'student_name' => 'Dewi Lestari',
                'role' => 'AI Researcher',
                'company' => 'BRIN',
                'quote' => 'Kurikulum Machine Learning dan PyTorch di sini terstruktur dengan rapi. Teori dasar digabungkan dengan hands-on coding yang membantu penyelesaian riset akademik saya.',
                'avatar_path' => 'avatars/dewi.jpg',
            ],
            [
                'student_name' => 'Rian Hidayat',
                'role' => 'Fullstack Engineer',
                'company' => 'Bukalapak',
                'quote' => 'Saya mendapatkan banyak insight baru tentang clean code, design pattern, dan optimasi database di kelas tingkat lanjut Laravel. Sangat menolong pekerjaan harian saya.',
                'avatar_path' => 'avatars/rian.jpg',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        // 4. Seed Alumni Projects (min 3 data)
        $alumniProjects = [
            [
                'title' => 'PeduliTani - Smart Agriculture Tracker',
                'student_name' => 'Budi Santoso & Tim',
                'description' => 'Aplikasi web pemantau kelembapan tanah, suhu udara, dan kesehatan tanaman berbasis Internet of Things (IoT). Dilengkapi dashboard visual interaktif real-time menggunakan Laravel Livewire dan Chart.js.',
                'thumbnail_path' => 'alumni/pedulitani.jpg',
                'demo_url' => 'https://demo.pedulitani-tracker.example.com',
            ],
            [
                'title' => 'GoMed - On-Demand Medicine Delivery App',
                'student_name' => 'Siti Rahma',
                'description' => 'Prototipe aplikasi pemesanan dan pengiriman obat online secara instan. Dikembangkan untuk Android dan iOS menggunakan Flutter, terintegrasi dengan Google Maps API untuk pelacakan kurir, serta backend Firebase.',
                'thumbnail_path' => 'alumni/gomed.jpg',
                'demo_url' => 'https://gomed-delivery.example.net',
            ],
            [
                'title' => 'SignLanguageAI - Penerjemah Bahasa Isyarat Real-Time',
                'student_name' => 'Dewi Lestari',
                'description' => 'Aplikasi web bertenaga kecerdasan buatan (AI) yang mendeteksi gerakan tangan bahasa isyarat melalui kamera laptop dan menerjemahkannya ke teks bahasa Indonesia secara instan menggunakan PyTorch dan OpenCV.',
                'thumbnail_path' => 'alumni/signlanguageai.jpg',
                'demo_url' => 'https://sign-language-ai-demo.example.org',
            ],
        ];

        foreach ($alumniProjects as $project) {
            AlumniProject::create($project);
        }

        $this->call([
            PsychologySeeder::class,
        ]);
    }
}
