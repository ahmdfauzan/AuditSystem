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

                            <div class="hasilPengamatan mb-4">
                                <!-- Modal Error -->
                                <h4 class="ms-4 mt-3">Data Hasil Pengamatan</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #12B5D2 ">
                                            <tr style="color: white">
                                                <th>Sistem Management</th>
                                                <th>Lokasi Audit</th>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Catatan</th>
                                                <th>Action</th>
                                                <th>Masukan Temuan</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($dataPengamatan as $data)
                                                <tr>
                                                    <td>{{ $data->namaAudit_asli }}</td>
                                                    <td>{{ $data->lokasi }}</td>
                                                    <td>{{ $data->tanggal }}</td>
                                                    <td>{{ $data->kategori }}</td>
                                                    <td>{{ Str::words($data->catatan, 20, '...') }}</td>


                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            {{-- Tombol Delete --}}
                                                            <form
                                                                action="{{ route('hasilpengamatan.destroy', [$data->id, $room->id]) }}"
                                                                method="POST" style="display:inline;">
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
                                                                data-bs-target="#editCatatan{{ $data->id }}">
                                                                <i class="bx bx-edit"></i>
                                                            </button>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        {{-- Tombol Temuan --}}
                                                        <button
                                                            onclick="window.location='{{ route('formTemuan', $data->id) }}'"
                                                            type="button" class="btn btn-sm btn-primary w-100">
                                                            Isi Form Temuan
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        {{-- Modal Edit --}}
                                        @foreach ($dataPengamatan as $data)
                                            <!-- Modal Edit Catatan -->
                                            <div class="modal fade" id="editCatatan{{ $data->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Catatan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form
                                                            action="{{ route('hasilpengamatan.updateCatatan', [$data->id, $room->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label>Catatan</label>
                                                                    <textarea name="catatan" class="form-control" required>{{ old('catatan', $data->catatan) }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </table>
                                </div>
                            </div>

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
                                            @foreach ($temuan as $id => $listTemuan)
                                                @php $first = $listTemuan->first(); @endphp
                                                <tr>

                                                    <td>{{ Str::words($first->deskripsi, 20, '...') }}</td>
                                                    <td>{{ $first->namaAuditee }}</td>
                                                    <td>{{ $first->lokasi }}</td>
                                                    <td>{{ $first->krisis }}</td>
                                                    <td>{{ $first->prosedure }}</td>
                                                    <td>{{ $first->elemen }}</td>
                                                    <td>{{ $first->tanggal }}</td>
                                                    <td>
                                                        @foreach ($listTemuan as $foto)
                                                            @if ($foto->foto_temuan)
                                                                <img src="{{ asset('uploads/foto/' . $foto->foto_temuan) }}"
                                                                    width="100" class="me-2 mb-2">
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('temuan.delete', $first->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-primary btn-sm"
                                                                onclick="return confirm('Yakin ingin menghapus Temuan ini?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @foreach ($dataPengamatan as $data)
                                    {{-- Tombol Selesaikan --}}
                                    <form action="{{ route('temuan.selesaikan', $data->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary btn-sm mt-4 w-100"
                                            onclick="return confirm('Yakin ingin menyelesaikan Temuan ini?')">
                                            Selesaikan Temuan
                                        </button>
                                    </form>
                                @endforeach

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
