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
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 8pt;
            line-height: 1.3;
            color: #1E293B;
            background-color: #FFFFFF;
        }
        .profile-card {
            background-color: #1C2541;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 10px;
            margin-top: 5px;
        }
        .profile-label {
            font-size: 7.5pt;
            color: #94A3B8;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
        }
        .profile-val {
            font-size: 8.5pt;
            color: #FFFFFF;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .profile-val:last-child {
            margin-bottom: 0;
        }
        .quote-box {
            border: 1px solid #D97706;
            border-radius: 4px;
            padding: 6px;
            background-color: rgba(217, 119, 6, 0.05);
            margin-top: 10px;
        }
        .quote-text {
            font-size: 7pt;
            font-style: italic;
            color: #F59E0B;
            line-height: 1.25;
        }
        .main-section-title {
            font-size: 8.5pt;
            font-weight: bold;
            color: #0B132B;
            text-transform: uppercase;
            border-bottom: 1.5px solid #E2E8F0;
            padding-bottom: 2px;
            margin-top: 8px;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }
        .score-row td {
            padding: 3px 4px;
            font-size: 7.5pt;
            border-bottom: 1px solid #F1F5F9;
        }
        .grid-box {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 4px;
            padding: 6px 8px;
            height: 95px;
        }
        .grid-box-title {
            font-size: 7.5pt;
            font-weight: bold;
            color: #0B132B;
            text-transform: uppercase;
            margin-bottom: 4px;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 2px;
        }
        .grid-box-content {
            font-size: 7pt;
            color: #475569;
            line-height: 1.25;
        }
    </style>
</head>
<body>

    <table width="100%" cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse; table-layout: fixed;">
        <tr>
            <!-- KOLOM KIRI (Sidebar - 27%) -->
            <td width="27%" valign="top" style="background-color: #0B132B; color: #FFFFFF; padding: 15px 12px; height: 297mm; box-sizing: border-box;">
                <div style="font-size: 10.5pt; font-weight: 800; text-transform: uppercase; color: #FFFFFF; letter-spacing: 0.5px;">
                    INSTITUT <span style="color: #D97706;">PSIKOMETRI</span>
                </div>
                <div style="font-size: 7pt; color: #94A3B8; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 2px; margin-bottom: 12px;">
                    Laporan Asesmen Karir
                </div>
                
                <div style="font-size: 8pt; font-weight: bold; color: #D97706; text-transform: uppercase; border-bottom: 1px solid #1E293B; padding-bottom: 2px; margin-top: 10px;">
                    Profil Peserta
                </div>
                
                <div class="profile-card">
                    <span class="profile-label">Nama Lengkap</span>
                    <span class="profile-val">{{ $user->name }}</span>
                    
                    <span class="profile-label">Tanggal Lahir</span>
                    <span class="profile-val">18 Agustus 2002</span>
                    
                    <span class="profile-label">Jenis Kelamin</span>
                    <span class="profile-val">Laki-laki</span>
                    
                    <span class="profile-label">Pekerjaan</span>
                    <span class="profile-val">Mahasiswa / Siswa</span>
                    
                    <span class="profile-label">Tanggal Tes</span>
                    <span class="profile-val">{{ $result->created_at->format('d M Y') }}</span>
                    
                    <span class="profile-label">ID Laporan</span>
                    <span class="profile-val">RP-{{ $result->id }}-{{ $result->created_at->format('Ymd') }}</span>
                </div>
                
                <div style="font-size: 8pt; font-weight: bold; color: #D97706; text-transform: uppercase; border-bottom: 1px solid #1E293B; padding-bottom: 2px; margin-top: 10px; margin-bottom: 6px;">
                    Tentang Asesmen
                </div>
                <div style="font-size: 7pt; color: #CBD5E1; text-align: justify; line-height: 1.3;">
                    Asesmen ini mengukur kecenderungan perilaku, motivasi kerja, dan orientasi karir berdasarkan 50 pertanyaan situational judgment. Laporan ini memberikan analisis objektif mengenai potensi kepemimpinan, kompetensi komunikasi, serta area pengembangan diri untuk mengoptimalkan karir masa depan secara berkelanjutan.
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
            
            <!-- KOLOM KANAN (Main Content - 73%) -->
            <td width="73%" valign="top" style="padding: 12px 16px; background-color: #FFFFFF; height: 297mm; box-sizing: border-box;">
                <!-- Top Section -->
                <div style="background-color: #0F172A; color: #FFFFFF; border-left: 4px solid #D97706; border-radius: 4px; padding: 8px 12px; margin-bottom: 8px;">
                    <div style="font-size: 7pt; color: #D97706; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                        Rekomendasi Karir &amp; Arketipe Dominan
                    </div>
                    <div style="font-size: 11pt; font-weight: bold; color: #FFFFFF; margin: 1px 0 2px 0;">
                        {{ $top['title'] }}
                    </div>
                    <div style="font-size: 8pt; color: #E2E8F0; line-height: 1.25;">
                        {{ $top['desc'] }}
                    </div>
                </div>
                
                <!-- Center Chart Area -->
                <div class="main-section-title">Visualisasi Potensi &amp; Legenda Skor</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; margin-bottom: 6px;">
                    <tr>
                        <!-- Chart (left 48%) -->
                        <td width="48%" valign="middle" align="center" style="padding-right: 8px;">
                            @if($radarChartBase64)
                                <img src="{{ $radarChartBase64 }}" width="170" style="display: block; margin: 0 auto;">
                            @else
                                <div style="width: 170px; height: 155px; border: 1px dashed #CBD5E1; line-height: 155px; color: #94A3B8; font-size: 7.5pt; text-align: center;">
                                    Grafik Radar Tidak Tersedia
                                </div>
                            @endif
                        </td>
                        <!-- Legends (right 52%) -->
                        <td width="52%" valign="top" style="padding-left: 8px;">
                            <div style="font-size: 7.5pt; font-weight: bold; color: #0B132B; margin-bottom: 3px; text-transform: uppercase;">
                                Skor Dimensi Kepribadian
                            </div>
                            <table width="100%" cellpadding="0" cellspacing="0" class="score-row" style="border-collapse: collapse;">
                                @php
                                    $dimDetails = [
                                        'Security' => ['color' => '#10B981', 'desc' => 'Kestabilan, kepatuhan SOP & regulasi.'],
                                        'Contribution' => ['color' => '#3B82F6', 'desc' => 'Manajemen staf & kepemimpinan.'],
                                        'Growth' => ['color' => '#F59E0B', 'desc' => 'Riset kognitif & analisis data.'],
                                        'Significance' => ['color' => '#8B5CF6', 'desc' => 'Public speaking & pengajaran.'],
                                        'Connection' => ['color' => '#EC4899', 'desc' => 'Dukungan emosional & empati tim.']
                                    ];
                                @endphp
                                @foreach($scores as $dim => $score)
                                    <tr>
                                        <td style="font-weight: bold; color: #334155; width: 33%;">
                                            <span style="display: inline-block; width: 5px; height: 5px; background-color: {{ $dimDetails[$dim]['color'] }}; border-radius: 50%; margin-right: 3px; vertical-align: middle;"></span>
                                            {{ $dim }}
                                        </td>
                                        <td style="color: #64748B; font-size: 7pt; width: 52%;">
                                            {{ $dimDetails[$dim]['desc'] }}
                                        </td>
                                        <td style="font-weight: bold; text-align: right; color: #0F172A; width: 15%;">
                                            {{ $score }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
                
                <!-- Interpretasi Potensi -->
                <div class="main-section-title">Interpretasi Potensi &amp; Kekuatan Karakter</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; font-size: 7.5pt; width: 100%;">
                    <thead>
                        <tr style="background-color: #F8FAFC; border-bottom: 1.5px solid #E2E8F0;">
                            <th align="left" style="padding: 4px; font-weight: bold; color: #475569; width: 22%;">Dimensi</th>
                            <th align="left" style="padding: 4px; font-weight: bold; color: #475569; width: 53%;">Interpretasi Skor</th>
                            <th align="left" style="padding: 4px; font-weight: bold; color: #475569; width: 25%;">Rekomendasi Kekuatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #F1F5F9;">
                            <td style="padding: 4px; font-weight: bold; color: #0B132B;">Security</td>
                            <td style="padding: 4px; color: #475569; font-size: 7.2pt;">Mencerminkan kebutuhan stabilitas regulasi, minim risiko, dan konsistensi kerja.</td>
                            <td style="padding: 4px; font-weight: 600; color: #10B981;">Patuh SOP &amp; Presisi</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #F1F5F9;">
                            <td style="padding: 4px; font-weight: bold; color: #0B132B;">Contribution</td>
                            <td style="padding: 4px; color: #475569; font-size: 7.2pt;">Mencerminkan dorongan memimpin tim, pembagian staf, dan keputusan taktis.</td>
                            <td style="padding: 4px; font-weight: 600; color: #3B82F6;">Manajerial &amp; Delegasi</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #F1F5F9;">
                            <td style="padding: 4px; font-weight: bold; color: #0B132B;">Growth</td>
                            <td style="padding: 4px; color: #475569; font-size: 7.2pt;">Mencerminkan minat riset ilmiah, data kognitif, dan analisis alur sistem.</td>
                            <td style="padding: 4px; font-weight: 600; color: #F59E0B;">Riset &amp; Analisis Logis</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #F1F5F9;">
                            <td style="padding: 4px; font-weight: bold; color: #0B132B;">Significance</td>
                            <td style="padding: 4px; color: #475569; font-size: 7.2pt;">Mencerminkan minat menyebarkan wawasan, public speaking, dan memandu forum.</td>
                            <td style="padding: 4px; font-weight: 600; color: #8B5CF6;">Public Speaking &amp; Training</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #F1F5F9;">
                            <td style="padding: 4px; font-weight: bold; color: #0B132B;">Connection</td>
                            <td style="padding: 4px; color: #475569; font-size: 7.2pt;">Mencerminkan kepedulian sosial, kemampuan konseling, dan mediasi konflik tim.</td>
                            <td style="padding: 4px; font-weight: 600; color: #EC4899;">Empati &amp; Konseling</td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Rencana Pengembangan Diri & Tanda Tangan (TTD) -->
                <div class="main-section-title">Rencana Pengembangan Diri</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; margin-top: 4px;">
                    <tr>
                        <!-- Col 1: Blind Spot -->
                        <td width="33%" valign="top" style="padding-right: 6px;">
                            <div class="grid-box" style="border-top: 3px solid #D97706; background-color: #FFFBEB;">
                                <div class="grid-box-title" style="color: #B45309;">⚠️ Blind Spot Utama</div>
                                <div class="grid-box-content" style="color: #78350F; font-size: 7pt; line-height: 1.25;">
                                    {{ $weaknessAnalysis['top_blind_spot'] }}
                                </div>
                            </div>
                        </td>
                        <!-- Col 2: Langkah Praktis -->
                        <td width="34%" valign="top" style="padding: 0 3px;">
                            <div class="grid-box" style="border-top: 3px solid #10B981;">
                                <div class="grid-box-title" style="color: #047857;">💡 Langkah Praktis</div>
                                <div class="grid-box-content" style="font-size: 7pt; line-height: 1.25;">
                                    <ul style="margin: 0; padding-left: 10px;">
                                        @foreach($weaknessAnalysis['actionable_advice'] as $advice)
                                            <li style="margin-bottom: 2px;">{{ $advice }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </td>
                        <!-- Col 3: Wawasan Utama -->
                        <td width="33%" valign="top" style="padding-left: 6px;">
                            <div class="grid-box" style="border-top: 3px solid #3B82F6;">
                                <div class="grid-box-title" style="color: #1D4ED8;">🚀 Wawasan Utama</div>
                                <div class="grid-box-content" style="font-size: 7pt; line-height: 1.25;">
                                    {{ $weaknessAnalysis['development_area'] }}
                                    <div style="margin-top: 4px; font-weight: bold; color: #1E293B; font-size: 6.8pt;">Gaya Kerja: {{ $top['insight'] }}</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                
                <!-- Baris Tanda Tangan (Seksi Footer Terpisah) -->
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 15px; border-top: 1px solid #E2E8F0; padding-top: 6px;">
                    <tr>
                        <td valign="middle" style="font-size: 6.5pt; color: #94A3B8; line-height: 1.2;">
                            Dokumen ini diterbitkan secara elektronik dan sah oleh Edtech Platform Indonesia.<br>
                            Verifikasi keabsahan hasil psikometri secara resmi.
                        </td>
                        <td align="right" width="40%" valign="bottom" style="padding-right: 5px;">
                            <div style="display: inline-block; text-align: center;">
                                <span style="font-size: 7pt; color: #64748B; display: block; margin-bottom: 1px;">Denpasar, Bali</span>
                                @if($signatureBase64)
                                    <img src="{{ $signatureBase64 }}" style="width: 75px; height: 24px; display: inline-block; vertical-align: middle;" />
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

</body>
</html>
