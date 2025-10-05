<!doctype html>

<html lang="en" class="layout-menu-fixed layout-compact" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Sistem Audit</title>

    <meta name="description" content="" />

    {{-- Link CSS --}}
    @include('Layouts.css')
</head>
<style>
    .hasilPengamatan h4 {
        font-weight: 700;
    }

    .hasilPengamatan table td {
        padding-right: 30px !important;
    }
</style>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Navigation / Aside --}}
            @include('Layouts.navigation')

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base bx bx-menu icon-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center me-auto text-primary judulData">
                            <h4>Hasil Audit</h4>
                        </div>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">

                            {{-- Pop Up Info --}}
                            @include('Layouts.popup')

                            <div class="hasilPengamatan">
                                <!-- Modal Error -->
                                <h4 class="ms-4 mt-5">Data Hasil Temuan</h4>
                                <div class="table-container ms-5">
                                    <table>
                                        <tr>
                                            <td>Sistem Management</td>
                                            <td>:</td>
                                            <td> {{ $data->hasilPengamatan->roomAudit->namaAudit ?? '-' }} </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Auditee</td>
                                            <td>:</td>
                                            <td> {{ $data->hasilPengamatan->auditee->name ?? '-' }} </td>
                                        </tr>
                                        <tr>
                                            <td>Nama Auditor</td>
                                            <td>:</td>
                                            <td> {{ $data->hasilPengamatan->auditor->name ?? '-' }} </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Audit</td>
                                            <td>:</td>
                                            <td> {{ $data->tanggal ?? '-' }} </td>
                                        </tr>
                                        <tr>
                                            <td>Temuan</td>
                                            <td>:</td>
                                            <td> {!! nl2br(e($data->deskripsi ?? '-')) !!} </td>
                                        </tr>
                                        <tr>
                                            <td>Foto Temuan</td>
                                            <td>:</td>
                                            <td>
                                                @foreach ($data->fotos as $foto)
                                                    <img src="{{ asset('uploads/foto/' . $foto->foto) }}"
                                                        width="150">
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi Audit</td>
                                            <td>:</td>
                                            <td> {{ $data->lokasi }} </td>
                                        </tr>
                                        <tr>
                                            <td>Krisis</td>
                                            <td>:</td>
                                            <td> {{ $data->krisis }} </td>
                                        </tr>
                                        <tr>
                                            <td>Prosedure</td>
                                            <td>:</td>
                                            <td> {{ $data->prosedure }} </td>
                                        </tr>
                                        <tr>
                                            <td>Elemen</td>
                                            <td>:</td>
                                            <td> {{ $data->elemen }} </td>
                                        </tr>
                                    </table>
                                </div>

                                <h4 class="ms-4 mt-5">Klarifikasi Temuan</h4>
                                <div class="table-container ms-5 mb-5">
                                    <table>
                                        <tr>
                                            <td>Identifikasi Penyebab</td>
                                            <td>:</td>
                                            <td> {!! nl2br(e($data->penyelesaian->identifikasi ?? '-')) !!} </td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan Langsung</td>
                                            <td>:</td>
                                            <td> {!! nl2br(e($data->penyelesaian->tindakanlangsung ?? '-' )) !!} </td>
                                        </tr>
                                        <tr>
                                            <td>Perbaikan</td>
                                            <td>:</td>
                                            <td> {!! nl2br(e($data->penyelesaian->perbaikan ?? '-')) !!} </td>
                                        </tr>
                                        <tr>
                                            <td>Target Perbaikan</td>
                                            <td>:</td>
                                            <td> {{ $data->penyelesaian->targetPerbaikan ?? '-' }} </td>
                                        </tr>
                                        <tr>
                                            <td>Foto Penyelesaian</td>
                                            <td>:</td>
                                            <td>
                                                @foreach ($data->penyelesaian->fotoPenyelesaian ?? [] as $foto)
                                                    <img src="{{ asset('uploads/foto/' . $foto->foto) }}"
                                                        width="150">
                                                @endforeach
                                            </td>
                                        </tr>
                                    </table>
                                    <form action="{{ route('temuan.approve', $data->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm mt-5"
                                            onclick="return confirm('Apakah Anda yakin ingin menyetujui temuan ini?')">
                                            Approved
                                        </button>
                                    </form>
                                    <a href="{{ route('temuan.revisi', $data->id) }}" class="btn btn-sm mt-5"
                                        style="background-color: #D7B73B; color:#fff;">
                                        Revisi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            {{-- @include('Layouts.footer') --}}
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    {{-- JS Script --}}
    @include('Layouts.javascript')

    {{-- Load Nama Auditee --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nikAuditee').on('keyup', function() {
                let nik = $(this).val();
                if (nik.length > 3) { // minimal 4 digit baru cek
                    $.ajax({
                        url: "{{ url('/auditee/find') }}/" + nik,
                        type: "GET",
                        success: function(response) {
                            if (response.success) {
                                $('#namaAuditee').val(response.name);
                                $('#errorNik').addClass('d-none').text('');
                            } else {
                                $('#namaAuditee').val('');
                                $('#errorNik').removeClass('d-none').text(response.message);
                            }
                        },
                        error: function() {
                            $('#namaAuditee').val('');
                            $('#errorNik').removeClass('d-none').text(
                                'Terjadi kesalahan, coba lagi.');
                        }
                    });
                } else {
                    $('#namaAuditee').val('');
                    $('#errorNik').addClass('d-none').text('');
                }
            });
        });
    </script>

</body>

</html>
