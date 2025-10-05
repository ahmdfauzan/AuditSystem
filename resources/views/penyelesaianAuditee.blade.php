@php
    use Illuminate\Support\Str;
@endphp
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
                            <h4>Data Hasil Temuan</h4>
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
                            <div class="hasilTemuan">
                                <h4 class="ms-4 mt-4">Data Hasil Temuan</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #348391 ">
                                            <tr style="color: white">
                                                <th>Temuan</th>
                                                <th>Nama Auditee</th>
                                                <th>Lokasi Audit</th>
                                                <th>Tingkat Temuan</th>
                                                <th>Prosedure</th>
                                                <th>Elemen</th>
                                                <th>Tanggal</th>
                                                <th>Foto</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($temuan as $data)
                                                <tr>
                                                    <td>{{ Str::words($data->deskripsi_pengamatan, 20, '...') }}</td>
                                                    <td>{{ $data->namaAuditee ?? '-' }}</td>
                                                    <td>{{ $data->lokasi }}</td>
                                                    <td>{{ $data->krisis }}</td>
                                                    <td>{{ $data->prosedure }}</td>
                                                    <td>{{ $data->elemen }}</td>
                                                    <td>{{ $data->tanggal }}</td>
                                                    <td>
                                                        @if ($data->fotos->isNotEmpty())
                                                            @foreach ($data->fotos as $foto)
                                                                <img src="{{ asset('uploads/foto/' . $foto->foto) }}"
                                                                    width="100" class="me-2 mb-2 rounded shadow">
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">Tidak ada foto</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('formPenyelesaian', ['id' => $data->id]) }}"
                                                            class="btn btn-primary btn-sm">
                                                            Jawab Temuan
                                                        </a>
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
