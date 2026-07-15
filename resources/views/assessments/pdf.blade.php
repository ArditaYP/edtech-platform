<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat & Laporan Asesmen Psikologi</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #334155;
            margin: 0;
            padding: 0;
            font-size: 14px;
            line-height: 1.5;
        }
        .header-table {
            width: 100%;
            border-bottom: 3px solid #4f46e5;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo-text {
            font-size: 24px;
            font-weight: bold;
            color: #1e293b;
        }
        .logo-accent {
            color: #4f46e5;
        }
        .report-title {
            text-align: right;
            font-size: 12px;
            font-weight: bold;
            color: #64748b;
            letter-spacing: 1px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 30px;
        }
        .info-label {
            font-size: 11px;
            color: #64748b;
            font-weight: bold;
            text-transform: uppercase;
            padding-bottom: 5px;
        }
        .info-value {
            font-size: 15px;
            color: #0f172a;
            font-weight: bold;
        }
        .highlight-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 6px solid #4f46e5;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 35px;
        }
        .highlight-title {
            font-size: 13px;
            font-weight: bold;
            color: #4f46e5;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .highlight-value {
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 12px;
        }
        .highlight-desc {
            font-size: 13px;
            color: #475569;
            line-height: 1.6;
        }
        .section-title {
            font-size: 15px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .breakdown-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        .breakdown-table th {
            background-color: #f1f5f9;
            text-align: left;
            padding: 10px 12px;
            font-size: 12px;
            color: #475569;
            font-weight: bold;
            border-bottom: 2px solid #cbd5e1;
        }
        .breakdown-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }
        .bar-bg {
            background-color: #e2e8f0;
            border-radius: 10px;
            height: 10px;
            width: 100%;
        }
        .bar-fill {
            height: 10px;
            border-radius: 10px;
        }
        .bar-fill-konselor { background-color: #10b981; }
        .bar-fill-hr { background-color: #3b82f6; }
        .bar-fill-ux_researcher { background-color: #f59e0b; }
        .bar-fill-trainer { background-color: #8b5cf6; }
        .footer-table {
            width: 100%;
            margin-top: 50px;
        }
        .signature-title {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 50px;
        }
        .signature-name {
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
        }
        .signature-role {
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td>
                <span class="logo-text">Edtech<span class="logo-accent">Platform</span></span>
            </td>
            <td class="report-title">
                OFFICIAL PSYCHOMETRIC & CAREER ASSESSMENT REPORT
            </td>
        </tr>
    </table>

    <!-- User & Test Info -->
    <table class="info-table">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <div class="info-label">Nama Peserta</div>
                <div class="info-value">{{ $user->name }}</div>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <div class="info-label">Tanggal Asesmen</div>
                <div class="info-value">{{ $result->created_at->format('d M Y - H:i') }}</div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 15px;">
                <div class="info-label">Judul Asesmen</div>
                <div class="info-value">{{ $course->title }}</div>
            </td>
        </tr>
    </table>

    <!-- Highlight Box -->
    @php
        $categoryDetails = [
            'konselor' => [
                'title' => 'Konselor / Psikolog Kerja',
                'desc' => 'Anda memiliki empati yang luar biasa tinggi dan sangat suka menolong individu mengurai hambatan emosional maupun kejenuhan kerja. Karir ideal Anda berpusat pada konseling karir, bimbingan akademis, atau psikologi klinis organisasi.',
                'bar_class' => 'bar-fill-konselor'
            ],
            'hr' => [
                'title' => 'HR & Talent Acquisition Specialist',
                'desc' => 'Kekuatan Anda terletak pada kemampuan manajerial, penataan staf yang adil, serta penyelarasan talenta dengan arah bisnis organisasi. Karir ideal Anda adalah bidang Rekrutmen (Talent Acquisition), Generalist HR, maupun Hubungan Industrial.',
                'bar_class' => 'bar-fill-hr'
            ],
            'ux_researcher' => [
                'title' => 'UI/UX Behavior Researcher',
                'desc' => 'Anda didorong oleh rasa ingin tahu ilmiah tentang mengapa manusia berperilaku demikian di depan sistem kerja. Karir ideal Anda adalah sebagai UX Researcher, Analis Perilaku Pengguna, atau Konsultan Riset Pasar.',
                'bar_class' => 'bar-fill-ux_researcher'
            ],
            'trainer' => [
                'title' => 'Trainer & People Developer',
                'desc' => 'Anda senang memandu forum, mengedukasi kelompok besar, dan menyederhanakan konsep rumit menjadi materi yang menginspirasi. Karir ideal Anda adalah Corporate Trainer, Guru/Dosen Profesional, atau Konsultan People Development.',
                'bar_class' => 'bar-fill-trainer'
            ]
        ];

        $top = $categoryDetails[$result->top_category] ?? $categoryDetails['hr'];
    @endphp

    <div class="highlight-box">
        <div class="highlight-title">Rekomendasi Karir Utama</div>
        <div class="highlight-value">{{ $top['title'] }}</div>
        <div class="highlight-desc">
            {{ $top['desc'] }}
        </div>
    </div>

    <!-- Breakdown Section -->
    <div class="section-title">Breakdown Kecocokan Bidang Karir</div>
    <table class="breakdown-table">
        <thead>
            <tr>
                <th style="width: 40%;">Bidang Karir / Profesi</th>
                <th style="width: 45%;">Tingkat Kecocokan</th>
                <th style="width: 15%; text-align: right;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result->percentages_payload as $catKey => $val)
                @php
                    $catInfo = $categoryDetails[$catKey] ?? $categoryDetails['hr'];
                @endphp
                <tr>
                    <td style="font-weight: bold; color: #1e293b;">{{ $catInfo['title'] }}</td>
                    <td>
                        <div class="bar-bg">
                            <div class="bar-fill {{ $catInfo['bar_class'] }}" style="width: {{ $val }}%;"></div>
                        </div>
                    </td>
                    <td style="text-align: right; font-weight: bold; color: #1e293b;">{{ $val }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signature area -->
    <table class="footer-table">
        <tr>
            <td style="width: 60%; vertical-align: bottom; font-size: 11px; color: #94a3b8; line-height: 1.4;">
                Dokumen ini diterbitkan secara elektronik dan sah oleh Edtech Platform.<br>
                Verifikasi keaslian dapat dilakukan melalui sistem basis data Edtech Platform.
            </td>
            <td style="width: 40%; text-align: right;">
                <div class="signature-title">Mengetahui,</div>
                <div style="margin-bottom: 15px;">
                    <span style="border: 2px solid #10b981; color: #10b981; font-weight: bold; padding: 5px 10px; border-radius: 6px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">
                        VERIFIED SECURE
                    </span>
                </div>
                <div class="signature-name">Tim Asesmen Psikologi</div>
                <div class="signature-role">Edtech Platform Indonesia</div>
            </td>
        </tr>
    </table>

</body>
</html>
