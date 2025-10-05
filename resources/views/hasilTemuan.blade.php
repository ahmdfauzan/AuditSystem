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

                            <div class="hasilPengamatan">
                                <!-- Modal Error -->
                                <h4 class="ms-4 mt-3">Data Hasil Pengamatan</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #12B5D2 ">
                                            <tr style="color: white">
                                                <th>ID Temuan</th>
                                                <th>Deskripsi</th>
                                                <th>Tanggal</th>
                                                <th>Hasil Pengamatan</th>
                                                <th>Foto</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($temuan as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->deskripsi }}</td>
                                                    <td>{{ $data->tanggal }}</td>
                                                    <td>{{ $data->hasilPengamatan->deskripsi ?? '-' }}</td>
                                                    <td>
                                                        @foreach ($data->fotos as $foto)
                                                            <img src="{{ asset('uploads/foto/' . $foto->foto) }}"
                                                                alt="Foto Temuan" width="100" class="me-2 mb-2">
                                                        @endforeach
                                                    </td>


                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            {{-- Tombol Delete --}}
                                                            <form action="" method="POST"
                                                                style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-primary w-100"
                                                                    onclick="return confirm('Yakin ingin menghapus data pengamatan ini?')">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>

                                                            {{-- Tombol Edit Catatan --}}
                                                            <button type="button" class="btn btn-sm btn-primary w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editCatatan">
                                                                <i class="bx bx-edit"></i>
                                                            </button>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        {{-- Tombol Temuan --}}
                                                        <button onclick=""
                                                            type="button" class="btn btn-sm btn-primary w-100">
                                                            Isi Form Temuan
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
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
