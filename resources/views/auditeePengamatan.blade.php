<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hasil Pengamatan</title>
    {{-- Link CSS --}}
    @include('Layouts.css')
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .sub-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            width: 100%;
            margin-bottom: 20px;
        }

        .info td {
            padding: 3px 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .header-container {
            display: flex;
            width: 100%;
            border: 2px solid #000;
        }

        .judulKanan {
            border-left: 2px solid #000;
            padding: 10px;
        }

        .judulKiri {
            width: 60%;
            font-weight: bold;
            text-align: center;
            height: 88px;
        }

        .judulKanan {
            width: 40%;
            font-size: 12px;
            position: absolute;
            top: 0;
            right: 0;
        }

        .judulKanan p {
            margin: 4px 0;
        }
    </style>


</head>

<body>

    {{-- Bagian Header --}}
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


    <h2 style="text-align:center; margin-bottom:10px; margin-top:20px;">HASIL PENGAMATAN INTERNAL AUDIT</h2>

    {{-- Data Utama --}}
    @if ($auditeePengamatan->count() > 0)
        <p><strong>Kategori :</strong> {{ $auditeePengamatan->first()->kategori }}</p>
        <p><strong>Departemen :</strong> {{ $auditeePengamatan->first()->lokasi }}</p>
        <p><strong>Tanggal Pelaksana :</strong>
            {{ \Carbon\Carbon::parse($auditeePengamatan->first()->tanggal)->translatedFormat('d F Y') }}
        </p>
    @endif

    {{-- Table Temuan --}}
    <table>
        <thead>
            <tr>
                <th>Hasil Pengamatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($auditeePengamatan as $i => $data)
                <tr>
                    <td>{!! nl2br(e($data->catatan)) !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="col-lg-12">
        @foreach ($auditeePengamatan as $i => $data)
        <div class="row">
            <div class="col-lg-6">
                <p>Auditor</p>
                @if ($auditeePengamatan->first()->auditor && $auditeePengamatan->first()->auditor->fotoTtd)
                    <img src="{{ public_path('uploads/ttd/' . $auditeePengamatan->first()->auditor->fotoTtd) }}"
                        alt="Tanda Tangan Auditor" width="120">
                @endif
                <p><strong>{{ $auditeePengamatan->first()->auditor->name ?? '-' }}</strong></p>
                <p>{{ $auditeePengamatan->first()->auditor->jabatan ?? '-' }}</p>
            </div>

            <div class="col-lg-6">
                <p>Auditee</p>
                @if ($auditeePengamatan->first()->auditee && $auditeePengamatan->first()->auditee->fotoTtd)
                    <img src="{{ public_path('uploads/ttd/' . $auditeePengamatan->first()->auditee->fotoTtd) }}"
                        alt="Tanda Tangan Auditee" width="120">
                @endif
                <p><strong>{{ $auditeePengamatan->first()->auditee->name ?? '-' }}</strong></p>
                <p>{{ $auditeePengamatan->first()->auditee->jabatan ?? '-' }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Footer --}}

    <div class="footer">
        <p style="font-weight: 700">Catatan :</p>
        <ol>
            <li>Hasil pengamatan memuat temuan sifatnya conformances, non conformances dan observasi selama audit
                berlangsung</li>
            <li>Bila memungkinkan, bukti-bukti hasil temuan sangat diharapkan untuk memudahkan penelusuran ulang
                (traceability) dan meyakinkan terjadinyapenyimpangan yang ditemukan sewaktu audit</li>
        </ol>

    </div>

</body>

</html>
