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
                            <h4>Hasil Pengamatan</h4>
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

                            <div class="hasilPengamatan mb-4">
                                <!-- Modal Error -->
                                <h4 class="ms-4 mt-3">Data Hasil Pengamatan</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #12B5D2 ">
                                            <tr style="color: white">
                                                <th>Sistem Management</th>
                                                <th>Lokasi Audit</th>
                                                <th>Auditor</th>
                                                <th>Tanggal</th>
                                                <th>Catatan</th>
                                                <th>Action</th>
                                                <th>Status</th>
                                                <th>Lihat PDF</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($auditeePengamatan as $data)
                                                <tr>
                                                    <td>{{ $data->roomAudit ? $data->roomAudit->namaAudit : '-' }}</td>
                                                    <td>{{ $data->lokasi }}</td>
                                                    <td>{{ $data->tanggal }}</td>
                                                    <td>{{ $data->kategori }}</td>
                                                    <td>{{ Str::words($data->catatan, 10, '...') }}</td>

                                                    <td>
                                                        <form action="{{ route('pengamatan.approval', $data->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status_final" value="approved">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary w-100 mb-1">
                                                                Approve
                                                            </button>
                                                        </form>

                                                        {{-- <form action="{{ route('pengamatan.approval', $data->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status_final" value="rejected">
                                                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                                                Reject
                                                            </button>
                                                        </form> --}}
                                                    </td>
                                                    <td>{{ $data->status_final }} </td>
                                                    {{-- <td>
                                                        @if ($data->status_final == 'approved')
                                                            <a href="{{ route('auditeePengamatan.pdf', $data->id) }}"
                                                                class="btn btn-danger mb-3" target="_blank">
                                                                Export PDF
                                                            </a>
                                                        @endif
                                                    </td> --}}
                                                    {{-- Tombol Preview --}}
                                                    <td>
                                                        @if ($data->status_final == 'approved')
                                                            <a href="{{ route('auditeePengamatan.preview', $data->id) }}"
                                                                class="btn btn-sm btn-primary w-100" target="_blank">
                                                                <i class="bx bx-show"></i> Preview
                                                            </a>
                                                        @endif
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
