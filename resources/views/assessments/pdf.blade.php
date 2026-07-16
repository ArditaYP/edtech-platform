<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXECUTIVE CAREER & PERSONALITY SCORECARD</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 12mm 15mm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1E293B;
            margin: 0;
            padding: 0;
            line-height: 1.4;
            background-color: #FFFFFF;
            font-size: 11px;
        }
        .page-wrapper {
            border: 2px solid #0F172A;
            padding: 3px;
            height: 260mm;
            box-sizing: border-box;
        }
        .page-inner {
            border: 1px solid #D97706;
            padding: 16px;
            height: 252mm;
            box-sizing: border-box;
            position: relative;
        }
        .header-logo {
            font-size: 13px;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: 0.5px;
        }
        .header-logo span {
            color: #D97706;
        }
        .header-title {
            text-align: right;
            font-size: 13px;
            font-weight: bold;
            color: #0F172A;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .divider-navy {
            height: 3px;
            background-color: #0F172A;
            margin-bottom: 2px;
        }
        .divider-gold {
            height: 1px;
            background-color: #D97706;
            margin-bottom: 12px;
        }
        .profile-bar {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 12px;
        }
        .profile-table {
            width: 100%;
            border-collapse: collapse;
        }
        .profile-label {
            color: #64748B;
            text-transform: uppercase;
            font-size: 8px;
            font-weight: bold;
            display: block;
            margin-bottom: 2px;
        }
        .profile-value {
            font-size: 10.5px;
            font-weight: bold;
            color: #0F172A;
        }
        .status-badge {
            background-color: #ECFDF5;
            color: #10B981;
            font-weight: bold;
            border: 1px solid #10B981;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8.5px;
            display: inline-block;
            text-transform: uppercase;
        }
        .highlight-banner {
            background-color: #0F172A;
            border-left: 4px solid #D97706;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 15px;
            color: #FFFFFF;
        }
        .highlight-label {
            font-size: 9px;
            font-weight: bold;
            color: #D97706;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .highlight-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 4px;
        }
        .highlight-desc {
            font-size: 10px;
            color: #E2E8F0;
            line-height: 1.4;
        }
        .column-title {
            font-size: 11px;
            font-weight: bold;
            color: #0F172A;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 4px;
            margin-bottom: 10px;
        }
        .bar-bg {
            background-color: #E2E8F0;
            border-radius: 6px;
            height: 8px;
            width: 90%;
            overflow: hidden;
            display: inline-block;
            vertical-align: middle;
        }
        .bar-fill {
            height: 8px;
            border-radius: 6px;
        }
        .insight-box {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 6px;
            padding: 10px;
            margin-top: 12px;
        }
        .insight-title {
            font-size: 9.5px;
            font-weight: bold;
            color: #0F172A;
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }
        .insight-list {
            margin: 0;
            padding: 0 0 0 14px;
            font-size: 9.5px;
            color: #475569;
            line-height: 1.45;
        }
        .footer-container {
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
        }
        .footer-line {
            height: 1px;
            background-color: #E2E8F0;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="page-wrapper">
        <div class="page-inner">

            <!-- Header Section -->
            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom: 10px;">
                <tr>
                    <td style="width: 55%; vertical-align: middle;">
                        <div class="header-logo">INSTITUT PSIKOMETRI <span>&amp; PENGEMBANGAN KARIR</span></div>
                        <div style="font-size: 8px; color: #64748B; letter-spacing: 1px; margin-top: 2px; text-transform: uppercase; font-weight: bold;">
                            Official Assessment Institution
                        </div>
                    </td>
                    <td style="width: 45%; text-align: right; vertical-align: middle;">
                        <div class="header-title">EXECUTIVE CAREER &amp; PERSONALITY SCORECARD</div>
                    </td>
                </tr>
            </table>

            <div class="divider-navy"></div>
            <div class="divider-gold"></div>

            <!-- Participant Profile Bar -->
            <div class="profile-bar">
                <table class="profile-table">
                    <tr>
                        <td style="width: 28%; border-right: 1px solid #E2E8F0; padding-right: 8px; vertical-align: top;">
                            <span class="profile-label">Nama Lengkap Siswa</span>
                            <span class="profile-value">{{ $user->name }}</span>
                        </td>
                        <td style="width: 28%; border-right: 1px solid #E2E8F0; padding: 0 8px; vertical-align: top;">
                            <span class="profile-label">Email / ID Siswa</span>
                            <span class="profile-value" style="font-size: 9.5px;">{{ $user->email }}</span>
                        </td>
                        <td style="width: 24%; border-right: 1px solid #E2E8F0; padding: 0 8px; vertical-align: top;">
                            <span class="profile-label">Tanggal Asesmen</span>
                            <span class="profile-value">{{ $result->created_at->format('d M Y - H:i') }}</span>
                        </td>
                        <td style="width: 20%; padding-left: 8px; text-align: right; vertical-align: top;">
                            <span class="profile-label">Status Asesmen</span>
                            <span class="status-badge">Verified</span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Top Result Highlight Box -->
            <div class="highlight-banner">
                <div class="highlight-label">REKOMENDASI KARIR DOMINAN</div>
                <div class="highlight-title">{{ $top['title'] }}</div>
                <div class="highlight-desc">{{ $top['desc'] }}</div>
            </div>

            <!-- Main Content (2-Column Grid Table) -->
            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom: 5px;">
                <tr>
                    <!-- Kolom Kiri: Visualisasi Grafik (45%) -->
                    <td style="width: 45%; vertical-align: top; padding-right: 15px;">
                        <div class="column-title">Radar Keseimbangan Potensi</div>
                        <div style="text-align: center; margin-top: 5px;">
                            @if($radarChartBase64)
                                <img src="{{ $radarChartBase64 }}" style="width: 195px; height: 195px; display: inline-block;" />
                            @else
                                <div style="width: 195px; height: 195px; border: 1px dashed #CBD5E1; line-height: 195px; color: #94A3B8; font-size: 10px; display: inline-block;">
                                    Grafik Radar Tidak Tersedia
                                </div>
                            @endif
                        </div>
                    </td>

                    <!-- Kolom Rencana: Score Breakdown & Insight (55%) -->
                    <td style="width: 55%; vertical-align: top; padding-left: 15px;">
                        <div class="column-title">Distribusi Persentase Kecocokan</div>

                        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; font-size: 10px; margin-top: 5px;">
                            @foreach($percentages as $catKey => $val)
                                @php
                                    $catInfo = $categoryDetails[$catKey] ?? ['title' => ucfirst($catKey)];
                                    $colors = [
                                        'konselor' => '#10B981',
                                        'hr' => '#3B82F6',
                                        'ux_researcher' => '#F59E0B',
                                        'trainer' => '#8B5CF6'
                                    ];
                                    $barColor = $colors[$catKey] ?? '#3B82F6';
                                @endphp
                                <tr style="border-bottom: 1px solid #F1F5F9;">
                                    <td style="padding: 6px 0; width: 45%; font-weight: bold; color: #334155;">
                                        {{ $catInfo['title'] }}
                                    </td>
                                    <td style="padding: 6px 0; width: 40%; vertical-align: middle;">
                                        <div class="bar-bg">
                                            <div class="bar-fill" style="background-color: {{ $barColor }}; width: {{ $val }}%;"></div>
                                        </div>
                                    </td>
                                    <td style="padding: 6px 0; width: 15%; text-align: right; font-weight: bold; color: #0F172A; font-size: 10.5px;">
                                        {{ $val }}%
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        <!-- Key Dynamics Insight -->
                        <div class="insight-box">
                            <div class="insight-title">Key Dynamics Insight</div>
                            <ul class="insight-list">
                                <li style="margin-bottom: 4px;">{{ $top['insight'] }}</li>
                                <li>Optimalkan potensi kerja Anda dengan memanfaatkan preferensi dominan Anda sebagai seorang <strong>{{ $top['title'] }}</strong>.</li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Section: Analisis Blind Spot & Area Kelemahan -->
            <div style="background-color: #FFFBEB; border: 1.5px solid #D97706; border-radius: 6px; padding: 12px; margin-top: 10px;">
                <div style="font-size: 11px; font-weight: bold; color: #D97706; text-transform: uppercase; margin-bottom: 6px; letter-spacing: 0.5px;">
                    ⚠️ ANALISIS BLIND SPOT &amp; AREA KELEMAHAN
                </div>

                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; font-size: 9.5px; line-height: 1.45;">
                    <tr>
                        <td style="width: 50%; vertical-align: top; padding-right: 12px; border-right: 1px dashed #F59E0B;">
                            <div style="font-weight: bold; color: #78350F; margin-bottom: 2px;">Kelemahan Utama (Blind Spot):</div>
                            <div style="color: #451A03;">{{ $weaknessAnalysis['top_blind_spot'] }}</div>
                        </td>
                        <td style="width: 50%; vertical-align: top; padding-left: 12px;">
                            <div style="font-weight: bold; color: #78350F; margin-bottom: 2px;">Area Pengembangan Terendah:</div>
                            <div style="color: #451A03;">{{ $weaknessAnalysis['development_area'] }}</div>
                        </td>
                    </tr>
                </table>

                <div style="margin-top: 8px; padding-top: 6px; border-top: 1px solid #F59E0B; font-size: 9.5px; color: #78350F; line-height: 1.45;">
                    <span style="font-weight: bold;">Actionable Advice (Saran Perbaikan):</span>
                    @foreach($weaknessAnalysis['actionable_advice'] as $advice)
                        &bull; {{ $advice }} &nbsp;&nbsp;
                    @endforeach
                </div>
            </div>

            <!-- Footer Section -->
            <div class="footer-container">
                <div class="footer-line"></div>
                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <!-- Kiri: QR Code (simulated) -->
                        <td style="width: 55%; vertical-align: middle;">
                            <table cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                <tr>
                                    <td style="padding-right: 10px; vertical-align: middle;">
                                        <!-- Simulated QR Code using inline SVG -->
                                        <svg width="40" height="40" viewBox="0 0 45 45" style="display: block;">
                                            <rect x="0" y="0" width="45" height="45" fill="#F1F5F9"/>
                                            <rect x="2" y="2" width="12" height="12" fill="#0F172A"/>
                                            <rect x="4" y="4" width="8" height="8" fill="#F1F5F9"/>
                                            <rect x="31" y="2" width="12" height="12" fill="#0F172A"/>
                                            <rect x="33" y="4" width="8" height="8" fill="#F1F5F9"/>
                                            <rect x="2" y="31" width="12" height="12" fill="#0F172A"/>
                                            <rect x="4" y="33" width="8" height="8" fill="#F1F5F9"/>
                                            <rect x="20" y="20" width="5" height="5" fill="#0F172A"/>
                                            <rect x="25" y="25" width="5" height="5" fill="#0F172A"/>
                                            <rect x="15" y="15" width="5" height="5" fill="#0F172A"/>
                                            <rect x="30" y="30" width="10" height="5" fill="#0F172A"/>
                                            <rect x="35" y="35" width="5" height="5" fill="#0F172A"/>
                                        </svg>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div style="font-size: 8.5px; font-weight: bold; color: #0F172A; text-transform: uppercase;">
                                            SYSTEM VERIFICATION
                        </div>
                                        <div style="font-size: 8px; color: #64748B; margin-top: 1px; line-height: 1.2;">
                                            Scan barcode ini untuk memverifikasi keaslian sertifikasi dan keabsahan hasil psikometri secara resmi.
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <!-- Kanan: Tanda Tangan & Cap -->
                        <td style="width: 45%; text-align: right; vertical-align: middle;">
                            <div style="display: inline-block; text-align: center; margin-right: 5px;">
                                <span style="font-size: 7.5px; color: #64748B; display: block; margin-bottom: 2px;">Direktur Lembaga,</span>
                                @if($signatureBase64)
                                    <img src="{{ $signatureBase64 }}" style="width: 90px; height: 32px; display: inline-block; vertical-align: middle;" />
                                @endif
                                <div style="font-size: 8.5px; font-weight: bold; color: #0F172A; margin-top: 2px; text-decoration: underline;">
                                    Dr. Aris Sudrajat, M.Psi.
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
