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
                                <div class="container py-4">

                                    <h4 class="mb-4 text-center fw-bold text-primary">Form Revisi Temuan</h4>

                                    {{-- Bagian Hasil Temuan --}}
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-info text-white">
                                            <strong>Data Hasil Temuan</strong>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('temuan.updateRevisi', $temuan->id) }}"
                                                method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $temuan->deskripsi) }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Krisis</label>
                                                    <input type="text" name="krisis" class="form-control"
                                                        value="{{ old('krisis', $temuan->krisis) }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Lokasi</label>
                                                    <input type="text" name="lokasi" class="form-control"
                                                        value="{{ old('lokasi', $temuan->lokasi) }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Prosedur</label>
                                                    <input type="text" name="prosedure" class="form-control"
                                                        value="{{ old('prosedure', $temuan->prosedure) }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Elemen</label>
                                                    <input type="text" name="elemen" class="form-control"
                                                        value="{{ old('elemen', $temuan->elemen) }}">
                                                </div>

                                                {{-- Bagian Hasil Penyelesaian --}}
                                                <div class="card mt-4 border-primary">
                                                    <div class="card-header bg-primary text-white">
                                                        <strong>Data Hasil Penyelesaian</strong>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Identifikasi</label>
                                                            <textarea name="identifikasi" class="form-control" rows="3">{{ old('identifikasi', $temuan->penyelesaian->identifikasi ?? '') }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Tindakan Langsung</label>
                                                            <textarea name="tindakanlangsung" class="form-control" rows="3">{{ old('tindakanlangsung', $temuan->penyelesaian->tindakanlangsung ?? '') }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Perbaikan</label>
                                                            <textarea name="perbaikan" class="form-control" rows="3">{{ old('perbaikan', $temuan->penyelesaian->perbaikan ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-4 d-flex gap-2">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        Simpan Revisi
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        onclick="history.back()">
                                                        Kembali
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

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
