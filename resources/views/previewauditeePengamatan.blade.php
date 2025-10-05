<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Preview Hasil Pengamatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin: 10px;
            /* tengah di halaman */
            padding: 20px;
            width: 210mm;
            height: 297mm;
            border: double 4px #000;
            box-sizing: border-box;
            background: white;
        }


        .header-container {
            display: flex;
            width: 100%;
            margin-bottom: 20px;
        }

        .judulKiri,
        .judulKanan {
            border: 1px solid #000;
            padding: 10px;
        }

        .judulKiri {
            width: 60%;
            text-align: center;
            font-weight: bold;
        }

        .judulKanan {
            width: 40%;
        }

        .judulKanan p {
            margin: 5px 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        .signature {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .signature div {
            width: 45%;
            text-align: center;
        }

        .signature img {
            width: 120px;
            height: auto;
        }

        .export-btn {
            margin-top: 20px;
            text-align: right;
        }

        .export-btn a {
            background-color: #d9534f;
            color: #fff;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
        }

        .auditorTtd .namaAuditor {
            display: inline-block;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            min-width: 150px;
            text-align: center;
            "

        }
    </style>
</head>

<body>

    {{-- Header Atas --}}
    <div class="header-container">
        <div class="judulKiri">
            <div>PT INDOFOOD CBP SUKSES MAKMUR Tbk</div>
            <div>DIVISI NOODLE - PABRIK MAKASSAR</div>
        </div>
        <div class="judulKanan">
            @foreach ($suratKeluar as $surat)
                <p>Kode Form : {{ $surat->kodeForm }}</p>
                <p>No. Terbitan : {{ $surat->noTerbitan }}</p>
                <p>Tgl. Efektif : {{ $surat->tglEfektif }}</p>
            @endforeach
        </div>
    </div>

    <h2>HASIL PENGAMATAN INTERNAL AUDIT</h2>

    @if ($auditeePengamatan->count() > 0)
        <p><strong>Kategori :</strong> {{ $auditeePengamatan->first()->kategori }}</p>
        <p><strong>Departemen :</strong> {{ $auditeePengamatan->first()->lokasi }}</p>
        <p><strong>Tanggal Pelaksana :</strong>
            {{ \Carbon\Carbon::parse($auditeePengamatan->first()->tanggal)->translatedFormat('d F Y') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Hasil Pengamatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auditeePengamatan as $data)
                <tr>
                    <td>{!! nl2br(e($data->catatan)) !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Tanda Tangan --}}
    <div class="signature">
        <div style="text-align:center; margin-top:10px;">
            <p><strong>Auditor</strong></p>

            @if ($auditeePengamatan->first()->auditor && $auditeePengamatan->first()->auditor->fotoTtd)
                <img src="{{ asset('uploads/ttd/' . $auditeePengamatan->first()->auditor->fotoTtd) }}"
                    alt="Tanda Tangan Auditor" style="width:120px; height:auto;">
            @else
                <p><em>Tidak ada tanda tangan</em></p>
            @endif

            {{-- Garis bawah nama --}}
            <div style="border-bottom:1px solid #000; width:70%; margin:5px auto 2px auto;">
                <strong>{{ $auditeePengamatan->first()->auditor->name ?? '&nbsp;' }}</strong>
            </div>

            <p>{{ $auditeePengamatan->first()->auditor->jabatan ?? '-' }}</p>
        </div>

        <div style="text-align:center; margin-top:10px;">
            <p><strong>Auditee</strong></p>

            @if ($auditeePengamatan->first()->auditee && $auditeePengamatan->first()->auditee->fotoTtd)
                <img src="{{ asset('uploads/ttd/' . $auditeePengamatan->first()->auditee->fotoTtd) }}"
                    alt="Tanda Tangan Auditee" style="width:120px; height:auto;">
            @else
                <p><em>Tidak ada tanda tangan</em></p>
            @endif

            {{-- Garis bawah nama --}}
            <div style="border-bottom:1px solid #000; width:70%; margin:5px auto 2px auto;">
                <strong>{{ $auditeePengamatan->first()->auditee->name ?? '&nbsp;' }}</strong>
            </div>

            <p>{{ $auditeePengamatan->first()->auditee->jabatan ?? '-' }}</p>
        </div>
    </div>

    {{-- Footer --}}

    <div class="footer">
        <p style="font-weight: 700; margin-top: 40px">Catatan :</p>
        <ol>
            <li>Hasil pengamatan memuat temuan sifatnya conformances, non conformances dan observasi selama audit
                berlangsung</li>
            <li>Bila memungkinkan, bukti-bukti hasil temuan sangat diharapkan untuk memudahkan penelusuran ulang
                (traceability) dan meyakinkan terjadinyapenyimpangan yang ditemukan sewaktu audit</li>
        </ol>
    </div>


</body>

</html>
