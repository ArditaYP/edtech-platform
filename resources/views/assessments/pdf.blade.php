<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXECUTIVE CAREER & PERSONALITY SCORECARD</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #FFFFFF;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1E293B;
            font-size: 8.5pt;
            line-height: 1.25;
            -webkit-print-color-adjust: exact;
        }
        .page-container {
            width: 210mm;
            height: 297mm;
            box-sizing: border-box;
            overflow: hidden;
            page-break-after: always;
        }
        .main-table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .sidebar {
            width: 28%;
            background-color: #0B132B;
            color: #FFFFFF;
            vertical-align: top;
            padding: 20px 12px;
            height: 297mm;
            box-sizing: border-box;
        }
        .content {
            width: 72%;
            background-color: #FFFFFF;
            color: #1E293B;
            vertical-align: top;
            padding: 20px 22px;
            height: 297mm;
            box-sizing: border-box;
        }
        /* Sidebar Styling */
        .sidebar-title {
            font-size: 11pt;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #FFFFFF;
            text-transform: uppercase;
        }
        .sidebar-title span {
            color: #D97706;
        }
        .sidebar-subtitle {
            font-size: 7.5pt;
            color: #94A3B8;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 3px;
            margin-bottom: 20px;
        }
        .section-header {
            font-size: 8.5pt;
            font-weight: bold;
            color: #D97706;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            border-bottom: 1px solid #1E293B;
            padding-bottom: 3px;
            margin-top: 15px;
        }
        .profile-card {
            background-color: #1C2541;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 15px;
        }
        .profile-item {
            margin-bottom: 8px;
        }
        .profile-item:last-child {
            margin-bottom: 0;
        }
        .profile-label {
            font-size: 7pt;
            color: #94A3B8;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
        }
        .profile-val {
            font-size: 8.5pt;
            color: #FFFFFF;
            font-weight: bold;
        }
        .about-text {
            font-size: 7.5pt;
            color: #CBD5E1;
            text-align: justify;
            margin-bottom: 12px;
        }
        .quote-box {
            border: 1px solid #D97706;
            border-radius: 6px;
            padding: 8px;
            background-color: rgba(217, 119, 6, 0.05);
            margin-top: 15px;
        }
        .quote-text {
            font-size: 7.5pt;
            font-style: italic;
            color: #F59E0B;
            line-height: 1.3;
        }
        
        /* Main Content Styling */
        .archetype-banner {
            background-color: #0F172A;
            color: #FFFFFF;
            border-left: 4px solid #D97706;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 15px;
        }
        .archetype-label {
            font-size: 7.5pt;
            color: #D97706;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .archetype-title {
            font-size: 13pt;
            font-weight: 800;
            color: #FFFFFF;
            margin: 2px 0 4px 0;
        }
        .archetype-desc {
            font-size: 8.5pt;
            color: #E2E8F0;
            line-height: 1.3;
        }
        
        .main-section-title {
            font-size: 9.5pt;
            font-weight: bold;
            color: #0B132B;
            text-transform: uppercase;
            border-bottom: 2px solid #E2E8F0;
            padding-bottom: 3px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        .dimension-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }
        .dimension-table th {
            background-color: #F8FAFC;
            color: #475569;
            font-weight: bold;
            text-align: left;
            padding: 5px;
            border-bottom: 1.5px solid #E2E8F0;
        }
        .dimension-table td {
            padding: 6px 5px;
            border-bottom: 1px solid #F1F5F9;
            vertical-align: top;
        }
        .dimension-name {
            font-weight: bold;
            color: #0B132B;
        }
        .score-badge {
            background-color: #0F172A;
            color: #D97706;
            font-weight: bold;
            padding: 1px 5px;
            border-radius: 3px;
            font-size: 7.5pt;
        }
        
        .grid-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .grid-col {
            width: 33.33%;
            vertical-align: top;
            box-sizing: border-box;
        }
        .grid-box {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            padding: 8px 10px;
            height: 105px;
        }
        .grid-box-title {
            font-size: 8pt;
            font-weight: bold;
            color: #0B132B;
            text-transform: uppercase;
            margin-bottom: 5px;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 2px;
        }
        .grid-box-content {
            font-size: 7.5pt;
            color: #475569;
            line-height: 1.35;
        }
        .grid-box-content ul {
            margin: 0;
            padding-left: 12px;
        }
        
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            border-top: 1px solid #E2E8F0;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="page-container">
        <table class="main-table" cellpadding="0" cellspacing="0">
            <tr>
                <!-- KOLOM KIRI (Sidebar - 28%) -->
                <td class="sidebar">
                    <div class="sidebar-title">INSTITUT <span>PSIKOMETRI</span></div>
                    <div class="sidebar-subtitle">Laporan Asesmen Karir</div>
                    
                    <div class="section-header">Profil Peserta</div>
                    <div class="profile-card">
                        <div class="profile-item">
                            <span class="profile-label">Nama Lengkap</span>
                            <span class="profile-val">{{ $user->name }}</span>
                        </div>
                        <div class="profile-item">
                            <span class="profile-label">Tanggal Lahir</span>
                            <span class="profile-val">18 Agustus 2002</span>
                        </div>
                        <div class="profile-item">
                            <span class="profile-label">Jenis Kelamin</span>
                            <span class="profile-val">Laki-laki</span>
                        </div>
                        <div class="profile-item">
                            <span class="profile-label">Pekerjaan</span>
                            <span class="profile-val">Mahasiswa / Siswa</span>
                        </div>
                        <div class="profile-item">
                            <span class="profile-label">Tanggal Tes</span>
                            <span class="profile-val">{{ $result->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="profile-item">
                            <span class="profile-label">ID Laporan</span>
                            <span class="profile-val">RP-{{ $result->id }}-{{ $result->created_at->format('Ymd') }}</span>
                        </div>
                    </div>
                    
                    <div class="section-header">Tentang Asesmen</div>
                    <div class="about-text">
                        Asesmen psikometri ini mengukur kecenderungan perilaku, motivasi kerja, dan orientasi karir berdasarkan 50 pertanyaan situational judgment. Laporan ini memberikan analisis objektif tentang potensi kepemimpinan, komunikasi, serta area pengembangan diri untuk mengoptimalkan karir masa depan.
                    </div>
                    
                    <div class="quote-box">
                        @php
                            $quotes = [
                                'hr' => 'Kepemimpinan bukan tentang berada di atas, melainkan tentang menumbuhkan potensi terbaik dari orang-orang di sekitar Anda.',
                                'konselor' => 'Empati adalah pintu gerbang untuk memahami dinamika terdalam manusia di tempat kerja.',
                                'ux_researcher' => 'Data memberi tahu kita APA yang terjadi, tetapi pemahaman perilaku memberi tahu kita MENGAPA itu terjadi.',
                                'trainer' => 'Mengajar orang lain adalah investasi terbaik untuk masa depan organisasi.'
                            ];
                            $activeQuote = $quotes[$result->top_category] ?? $quotes['hr'];
                        @endphp
                        <div class="quote-text">
                            "{{ $activeQuote }}"
                        </div>
                    </div>
                </td>
                
                <!-- KOLOM KANAN (Main Content - 72%) -->
                <td class="content">
                    <!-- Top Banner Arketipe -->
                    <div class="archetype-banner">
                        <div class="archetype-label">Rekomendasi Karir &amp; Arketipe Dominan</div>
                        <div class="archetype-title">{{ $top['title'] }}</div>
                        <div class="archetype-desc">{{ $top['desc'] }}</div>
                    </div>
                    
                    <!-- Center Radar Visual -->
                    <div class="main-section-title">Visualisasi Potensi &amp; Legenda Skor</div>
                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom: 12px;">
                        <tr>
                            <td style="width: 50%; text-align: center; vertical-align: middle;">
                                @if($radarChartBase64)
                                    <img src="{{ $radarChartBase64 }}" style="width: 210px; height: 195px; display: inline-block;" />
                                @else
                                    <div style="width: 210px; height: 195px; border: 1px dashed #CBD5E1; line-height: 195px; color: #94A3B8; font-size: 8pt; display: inline-block;">
                                        Grafik Radar Tidak Tersedia
                                    </div>
                                @endif
                            </td>
                            <td style="width: 50%; vertical-align: top; padding-left: 10px;">
                                <div style="font-size: 8pt; font-weight: bold; color: #0B132B; margin-bottom: 5px; text-transform: uppercase;">
                                    Skor Dimensi Kepribadian
                                </div>
                                <table width="100%" cellpadding="0" cellspacing="0" style="font-size: 8pt; border-collapse: collapse;">
                                    @php
                                        $dimDetails = [
                                            'Security' => ['color' => '#10B981', 'desc' => 'Kestabilan, kepatuhan SOP & regulasi.'],
                                            'Contribution' => ['color' => '#3B82F6', 'desc' => 'Manajemen staf, delegasi & kepemimpinan.'],
                                            'Growth' => ['color' => '#F59E0B', 'desc' => 'Riset kognitif & pemecahan masalah data.'],
                                            'Significance' => ['color' => '#8B5CF6', 'desc' => 'Komunikasi publik & pengaruh edukatif.'],
                                            'Connection' => ['color' => '#EC4899', 'desc' => 'Dukungan emosional & empati mendalam.']
                                        ];
                                    @endphp
                                    @foreach($scores as $dim => $score)
                                        <tr style="border-bottom: 1px solid #F1F5F9;">
                                            <td style="padding: 4px 0; font-weight: bold; color: #334155; width: 35%;">
                                                <span style="display: inline-block; width: 6px; height: 6px; background-color: {{ $dimDetails[$dim]['color'] }}; border-radius: 50%; margin-right: 4px;"></span>
                                                {{ $dim }}
                                            </td>
                                            <td style="padding: 4px 0; color: #64748B; font-size: 7.5pt; width: 50%;">
                                                {{ $dimDetails[$dim]['desc'] }}
                                            </td>
                                            <td style="padding: 4px 0; font-weight: bold; text-align: right; color: #0F172A; width: 15%;">
                                                {{ $score }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <!-- Breakdown 5 Dimensi & Kekuatan -->
                    <div class="main-section-title">Interpretasi Potensi &amp; Kekuatan Karakter</div>
                    <table class="dimension-table">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Dimensi</th>
                                <th style="width: 50%;">Interpretasi Skor</th>
                                <th style="width: 25%;">Rekomendasi Kekuatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="dimension-name">Security</td>
                                <td>Menunjukkan kebutuhan individu akan kejelasan regulasi, lingkungan kerja yang minim risiko, dan konsistensi operasional organisasi.</td>
                                <td style="font-weight: 600; color: #10B981;">Patuh Aturan &amp; Presisi</td>
                            </tr>
                            <tr>
                                <td class="dimension-name">Contribution</td>
                                <td>Menunjukkan dorongan memimpin, mengambil keputusan taktis tim, rekrutmen, dan penyelarasan arah strategis kerja.</td>
                                <td style="font-weight: 600; color: #3B82F6;">Kepemimpinan &amp; Delegasi</td>
                            </tr>
                            <tr>
                                <td class="dimension-name">Growth</td>
                                <td>Mencerminkan rasa penasaran ilmiah, keinginan menganalisis alur kerja sistem, dan pemecahan masalah berbasis fakta.</td>
                                <td style="font-weight: 600; color: #F59E0B;">Riset &amp; Analisis Logis</td>
                            </tr>
                            <tr>
                                <td class="dimension-name">Significance</td>
                                <td>Menunjukkan motivasi untuk mentransfer ilmu, melatih forum kelompok besar, dan membimbing kemajuan keterampilan orang lain.</td>
                                <td style="font-weight: 600; color: #8B5CF6;">Public Speaking &amp; Melatih</td>
                            </tr>
                            <tr>
                                <td class="dimension-name">Connection</td>
                                <td>Menggambarkan kedalaman kepedulian sosial, kemampuan konseling interpersonal, dan penyembuhan mentalitas burnout tim.</td>
                                <td style="font-weight: 600; color: #EC4899;">Empati &amp; Konseling</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Actionable Advice Grid (3 Kolom Bottom Section) -->
                    <div class="main-section-title" style="margin-top: 15px;">Rencana Pengembangan Diri</div>
                    <table class="grid-table" cellpadding="0" cellspacing="0">
                        <tr>
                            <!-- Kolom 1: Peluang Bertumbuh -->
                            <td class="grid-col" style="padding-right: 6px;">
                                <div class="grid-box" style="border-top: 3px solid #D97706; background-color: #FFFBEB;">
                                    <div class="grid-box-title" style="color: #B45309;">⚠️ Blind Spot Utama</div>
                                    <div class="grid-box-content" style="color: #78350F; font-size: 7.2pt;">
                                        {{ $weaknessAnalysis['top_blind_spot'] }}
                                    </div>
                                </div>
                            </td>
                            <!-- Kolom 2: Langkah Praktis -->
                            <td class="grid-col" style="padding: 0 3px;">
                                <div class="grid-box" style="border-top: 3px solid #10B981;">
                                    <div class="grid-box-title" style="color: #047857;">💡 Langkah Praktis</div>
                                    <div class="grid-box-content" style="font-size: 7pt;">
                                        <ul style="padding-left: 10px;">
                                            @foreach($weaknessAnalysis['actionable_advice'] as $advice)
                                                <li style="margin-bottom: 2px;">{{ $advice }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <!-- Kolom 3: Wawasan Utama -->
                            <td class="grid-col" style="padding-left: 6px;">
                                <div class="grid-box" style="border-top: 3px solid #3B82F6;">
                                    <div class="grid-box-title" style="color: #1D4ED8;">🚀 Wawasan Utama</div>
                                    <div class="grid-box-content" style="font-size: 7.2pt;">
                                        {{ $weaknessAnalysis['development_area'] }}
                                        <div style="margin-top: 4px; font-weight: bold; color: #1E293B;">Gaya Kerja: {{ $top['insight'] }}</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <!-- Footer Section -->
                    <table class="footer-table" width="100%">
                        <tr>
                            <td style="font-size: 7pt; color: #94A3B8; vertical-align: middle;">
                                Laporan Eksekutif Asesmen Psikometri Resmi • Berbasis Sains &amp; Algoritma Kepribadian Terpercaya
                            </td>
                            <td style="text-align: right; vertical-align: middle; width: 40%;">
                                <div style="display: inline-block; text-align: center;">
                                    @if($signatureBase64)
                                        <img src="{{ $signatureBase64 }}" style="width: 80px; height: 26px; display: inline-block; vertical-align: middle;" />
                                    @endif
                                    <div style="font-size: 7.5pt; font-weight: bold; color: #0F172A; text-decoration: underline; margin-top: 1px;">
                                        Dr. Aris Sudrajat, M.Psi.
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
