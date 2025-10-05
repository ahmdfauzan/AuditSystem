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
                            <h4>Form Pengamatan</h4>
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



                            <div class="formPengamatan">
                                <div class="card-body">
                                    <h5 class="mb-4">FORM HASIL PENGAMATAN</h5>
                                    <form action="{{ route('hasilpengamatan.storePengamatan', $room->id) }}" method="POST">
                                        @csrf

                                        <div class="mb-6">
                                            <label class="form-label">Kategori</label>
                                            <select name="kategori" class="form-control" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                <option value="IQA">IQA</option>
                                                <option value="IFSA">IFSA</option>
                                                <option value="IEA">IEA</option>
                                                <option value="IHA">IHA</option>
                                                <option value="ISHA">ISHA</option>
                                                <option value="IE nA">IE nA</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Lokasi Audit</label>
                                            <select id="lokasi" name="lokasi" class="form-control" required>
                                                <option value="">-- Pilih Lokasi Audit --</option>
                                                <option value="HR">HR</option>
                                                <option value="Teknik">Teknik</option>
                                                <option value="Warehouse">Warehouse</option>
                                                <option value="Accounting">Accounting</option>
                                                <option value="Produksi">Produksi</option>
                                                <option value="PPIC">PPIC</option>
                                                <option value="Purchasing">Purchasing</option>
                                                <option value="Marketing">Marketing</option>
                                                <option value="Distribusi">Distribusi</option>
                                            </select>
                                        </div>

                                        <div class="mb-6">
                                            <label class="form-label">Nik Auditee</label>
                                            <input type="number" class="form-control" name="nikAuditee" id="nikAuditee"
                                                required>

                                            <label class="form-label">Nama Auditee</label>
                                            <input type="text" class="form-control" name="namaAuditee"
                                                id="namaAuditee" readonly>
                                            <small id="errorNik" class="text-danger d-none"></small>
                                        </div>

                                        <div class="mb-6">
                                            <label class="form-label">Catatan</label>
                                            <textarea class="form-control" name="catatan" required></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-4">Send</button>
                                    </form>

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
