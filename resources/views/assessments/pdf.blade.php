<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXECUTIVE CAREER & PERSONALITY SCORECARD</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0mm;
        }
        * {
            box-sizing: border-box;
        }
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            width: 100%;
            height: 100%;
            background-color: #FFFFFF;
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 8pt;
            line-height: 1.25;
            color: #1E293B;
        }
        .master-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .sidebar {
            width: 27%;
            background-color: #0B132B;
            color: #FFFFFF;
            vertical-align: top;
            padding: 12px 10px;
            height: 285mm;
        }
        .content {
            width: 73%;
            background-color: #FFFFFF;
            color: #1E293B;
            vertical-align: top;
            padding: 10px 14px;
            height: 285mm;
        }
        .profile-card {
            background-color: #1C2541;
            border-radius: 4px;
            padding: 6px;
            margin-bottom: 8px;
            margin-top: 4px;
        }
        .profile-label {
            font-size: 7pt;
            color: #94A3B8;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
        }
        .profile-val {
            font-size: 8pt;
            color: #FFFFFF;
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
        }
        .profile-val:last-child {
            margin-bottom: 0;
        }
        .quote-box {
            border: 1px solid #D97706;
            border-radius: 4px;
            padding: 5px;
            background-color: rgba(217, 119, 6, 0.05);
            margin-top: 8px;
        }
        .quote-text {
            font-size: 6.8pt;
            font-style: italic;
            color: #F59E0B;
            line-height: 1.2;
        }
        .main-section-title {
            font-size: 8pt;
            font-weight: bold;
            color: #0B132B;
            text-transform: uppercase;
            border-bottom: 1.5px solid #E2E8F0;
            padding-bottom: 2px;
            margin-top: 6px;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }
        .score-row td {
            padding: 2px 3px;
            font-size: 7.2pt;
            border-bottom: 1px solid #F1F5F9;
        }
        .grid-box {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 4px;
            padding: 5px 6px;
            height: auto;
            min-height: 120px;
        }
        .grid-box-title {
            font-size: 7pt;
            font-weight: bold;
            color: #0B132B;
            text-transform: uppercase;
            margin-bottom: 3px;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 1px;
        }
        .grid-box-content {
            font-size: 6.8pt;
            color: #475569;
            line-height: 1.2;
        }
    </style>
</head>
<body>

    <table class="master-table" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <!-- KOLOM KIRI (Sidebar - 27%) -->
            <td class="sidebar">
                <div style="font-size: 10pt; font-weight: 800; text-transform: uppercase; color: #FFFFFF; letter-spacing: 0.5px;">
                    IMT
                </div>
                <div style="font-size: 6.5pt; color: #94A3B8; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 1px; margin-bottom: 8px;">
                    Laporan Asesmen Karir
                </div>

                <div style="font-size: 7.5pt; font-weight: bold; color: #D97706; text-transform: uppercase; border-bottom: 1px solid #1E293B; padding-bottom: 2px; margin-top: 6px;">
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

                <div style="font-size: 7.5pt; font-weight: bold; color: #D97706; text-transform: uppercase; border-bottom: 1px solid #1E293B; padding-bottom: 2px; margin-top: 6px; margin-bottom: 4px;">
                    Tentang Asesmen
                </div>
                <div style="font-size: 6.8pt; color: #CBD5E1; text-align: justify; line-height: 1.25;">
                    Asesmen ini mengukur kecenderungan perilaku, motivasi kerja, dan orientasi karir berdasarkan 50 pertanyaan situational judgment. Laporan ini memberikan analisis objektif mengenai potensi kepemimpinan, kompetensi komunikasi, serta area pengembangan diri untuk mengoptimalkan karir masa depan secara berkelanjutan.
                </div>

                <div class="quote-box">
                    <div class="quote-text">
                        "{{ $top['quote'] ?? 'Satu-satunya kegagalan dalam hidup adalah ketika Anda berhenti mencoba belajar.' }}"
                    </div>
                </div>
            </td>

            <!-- KOLOM KANAN (Main Content - 73%) -->
            <td class="content">
                <!-- Top Section -->
                <div style="background-color: #0F172A; color: #FFFFFF; border-left: 3px solid #D97706; border-radius: 4px; padding: 6px 10px; margin-bottom: 6px;">
                    <div style="font-size: 6.5pt; color: #D97706; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                        Rekomendasi Karir &amp; Arketipe Dominan
                    </div>
                    <div style="font-size: 10.5pt; font-weight: bold; color: #FFFFFF; margin: 1px 0 2px 0;">
                        {{ $top['title'] }}
                    </div>
                    <div style="font-size: 7.5pt; color: #E2E8F0; line-height: 1.2;">
                        {{ $top['desc'] }}
                    </div>
                </div>

                <!-- Center Chart Area -->
                <div class="main-section-title">Visualisasi Potensi &amp; Legenda Skor</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; margin-bottom: 4px;">
                    <tr>
                        <!-- Chart (left 48%) -->
                        <td width="48%" valign="middle" align="center" style="padding-right: 6px;">
                            @if($radarChartBase64)
                                <img src="{{ $radarChartBase64 }}" width="180" style="display: block; margin: 0 auto;">
                            @else
                                <div style="width: 180px; height: 140px; border: 1px dashed #CBD5E1; line-height: 140px; color: #94A3B8; font-size: 7pt; text-align: center;">
                                    Grafik Radar Tidak Tersedia
                                </div>
                            @endif
                        </td>
                        <!-- Legends (right 52%) -->
                        <td width="52%" valign="top" style="padding-left: 6px;">
                            <div style="font-size: 7pt; font-weight: bold; color: #0B132B; margin-bottom: 3px; text-transform: uppercase;">
                                Distribusi Persentase Kecocokan
                            </div>
                            <table width="100%" cellpadding="0" cellspacing="0" class="score-row" style="border-collapse: collapse;">
                                @php
                                    $progressColors = ['#D97706', '#3B82F6', '#10B981', '#8B5CF6'];
                                @endphp
                                @foreach($topCareers as $idx => $career)
                                    <tr>
                                        <td style="font-weight: bold; color: #334155; width: 45%; font-size: 6.8pt; padding: 3px 0;">
                                            {{ $career['label'] }}
                                        </td>
                                        <td style="width: 40%; vertical-align: middle; padding: 0 4px;">
                                            <div style="background-color: #E2E8F0; border-radius: 3px; height: 6px; width: 100%;">
                                                <div style="background-color: {{ $progressColors[$idx] ?? '#64748B' }}; border-radius: 3px; height: 6px; width: {{ $career['score'] }}%;"></div>
                                            </div>
                                        </td>
                                        <td style="font-weight: bold; text-align: right; color: #0F172A; width: 15%; font-size: 7pt; padding: 3px 0;">
                                            {{ number_format($career['score'], 0) }}%
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- Interpretasi Potensi -->
                <div class="main-section-title">Interpretasi Potensi &amp; Kekuatan Karakter</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; font-size: 7.2pt; width: 100%;">
                    <thead>
                        <tr style="background-color: #F8FAFC; border-bottom: 1.5px solid #E2E8F0;">
                            <th align="left" style="padding: 3px; font-weight: bold; color: #475569; width: 25%;">Profesi Teratas</th>
                            <th align="left" style="padding: 3px; font-weight: bold; color: #475569; width: 50%;">Deskripsi Karakter &amp; Orientasi</th>
                            <th align="left" style="padding: 3px; font-weight: bold; color: #475569; width: 25%;">Kekuatan Utama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topCareers as $career)
                            @php
                                $detail = $categoryDetails[$career['key']] ?? [];
                                $shortTitle = str_replace(['THE ', '™'], '', $detail['title'] ?? $career['label']);
                                $shortTitle = explode('&', $shortTitle)[0];
                            @endphp
                            <tr style="border-bottom: 1px solid #F1F5F9;">
                                <td style="padding: 3px; font-weight: bold; color: #0B132B;">{{ $career['label'] }}</td>
                                <td style="padding: 3px; color: #475569; font-size: 6.8pt; line-height: 1.2;">{{ $detail['desc'] ?? '' }}</td>
                                <td style="padding: 3px; font-weight: 600; color: #D97706;">{{ trim($shortTitle) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Rencana Pengembangan Diri -->
                <div class="main-section-title">Rencana Pengembangan Diri</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; margin-top: 3px;">
                    <tr>
                        <!-- Col 1: Blind Spot Utama -->
                        <td width="33%" valign="top" style="padding-right: 4px;">
                            <div class="grid-box" style="border-top: 3px solid #D97706; background-color: #FFFBEB; min-height: 120px;">
                                <div class="grid-box-title" style="color: #B45309;">⚠️ Blind Spot Utama</div>
                                <div class="grid-box-content" style="color: #78350F;">
                                    {{ $weaknessAnalysis['top_blind_spot'] }}
                                </div>
                            </div>
                        </td>
                        <!-- Col 2: Area Kekurangan -->
                        <td width="34%" valign="top" style="padding: 0 2px;">
                            <div class="grid-box" style="border-top: 3px solid #E11D48; background-color: #FFF1F2; min-height: 120px;">
                                <div class="grid-box-title" style="color: #9F1239;">🔴 Area Kekurangan</div>
                                <div class="grid-box-content" style="color: #4C0519;">
                                    {{ $deficitText }}
                                </div>
                            </div>
                        </td>
                        <!-- Col 3: Langkah Perbaikan -->
                        <td width="33%" valign="top" style="padding-left: 4px;">
                            <div class="grid-box" style="border-top: 3px solid #059669; background-color: #ECFDF5; min-height: 120px;">
                                <div class="grid-box-title" style="color: #065F46;">🟢 Langkah Perbaikan</div>
                                <div class="grid-box-content" style="color: #022C22; font-size: 6.6pt;">
                                    <ul style="margin: 0; padding-left: 8px;">
                                        @foreach($weaknessAnalysis['actionable_advice'] as $advice)
                                            <li style="margin-bottom: 2px;">{{ $advice }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Baris Tanda Tangan (Seksi Footer Terpisah) -->
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 8px; border-top: 1px solid #E2E8F0; padding-top: 6px;">
                    <tr>
                        <td width="55%" valign="bottom" style="font-size: 6.5pt; color: #64748B; line-height: 1.2;">
                            Dokumen ini diterbitkan secara elektronik dan sah oleh Edtech Platform Indonesia.<br>
                            Verifikasi keabsahan hasil psikometri secara resmi.
                        </td>
                        <td width="45%" align="right" valign="bottom" style="padding-right: 4px;">
                            <div style="display: inline-block; text-align: center;">
                                <span style="font-size: 6.5pt; color: #64748B; display: block; margin-bottom: 1px;">Denpasar, Bali</span>
                                @if($signatureBase64)
                                    <img src="{{ $signatureBase64 }}" style="width: 75px; height: 22px; display: inline-block; vertical-align: middle;" />
                                @endif
                                <div style="font-size: 8pt; font-weight: bold; color: #0F172A; text-decoration: underline; margin-top: 1px;">
                                    Ketut Wiratama., SS., MM., MNLP., RFP., CI., CEI., CBT
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
