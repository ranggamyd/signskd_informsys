<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        table th {
            text-align: left
        }

        .footer {
            text-align: center;
            width: 40%;
            margin: 25px 0 0 auto;
        }
    </style>
</head>

<body>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/kop_surat.jpg'))) }}"
        style="width: 100%; margin-bottom: 0;">
    <div class="header">
        <h2 style="text-decoration: underline; margin-bottom: 0;">Surat Keterangan Dokter</h2>
        <h3 style="text-decoration: underline; margin-top: 0;">No. {{ $skd->no_surat }}</h3>
    </div>
    <div class="content">
        <p>Dengan ini menerangkan bahwa berdasarkan hasil pemeriksaan yang telah dilakukan kepada pasien:</p>
        <table>
            <tr>
                <th>NIK</th>
                <td>:</td>
                <td>{{ $skd->patient->nik }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>:</td>
                <td>{{ $skd->patient->nama }}</td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td>:</td>
                <td>{{ $skd->patient->pekerjaan }}</td>
            </tr>
            <tr>
                <th>Diagnosa</th>
                <td>:</td>
                <td>{{ $skd->diagnosa }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td>{{ $skd->patient->alamat }}</td>
            </tr>
        </table>
        <p style="margin-bottom: 0;">Diberikan istirahat selama {{ date('d M Y', strtotime($skd->tanggal_masuk)) }}
            sampai
            {{ date('d M Y', strtotime($skd->tanggal_keluar)) }}.</p>
        <p style="margin-top: 0;">Demikian surat keterangan ini diberikan untuk diketahui dan dipergunakan seperlunya.
        </p>
    </div>
    <div class="footer">
        {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/kop_surat.jpg'))) }}"
            style="width: 100%; margin-bottom: 0;"> --}}
        {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(256)->generate($hash)) !!} "> --}}
        <p>Kuningan, {{ date('d M Y') }}</p>
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
        <p>{{ $skd->doctor->nama }}</p>
    </div>
</body>

</html>
