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
                            <h4>Data Room</h4>
                        </div>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">
                            <div class="card-datatable text-nowrap">
                                <div id="DataTables_Table_0_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                                    <div class="row card-header flex-column flex-md-row pb-0">
                                        <div
                                            class="d-md-flex justify-content-between align-items-center dt-layout-end col-md-auto ms-auto mt-0">
                                            <button class="mb-3 btn create-new btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#buatRoom" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><span
                                                        class="d-flex align-items-center gap-2"><i
                                                            class="icon-base bx bx-plus icon-sm"></i> <span
                                                            class="d-none d-sm-inline-block">Buat
                                                            Room Audit</span></span></span></button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Pop Up Info --}}
                                @include('Layouts.popup')
                                <!-- Modal Error -->
                                <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content border-danger">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Terjadi Kesalahan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <form action="{{ route('buatRoom') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="buatRoom" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1"> Buat Room
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Audit</label>
                                                        <select id="namaAudit" name="namaAudit" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih Audit --</option>
                                                            <option value="Sistem Management K3">Sistem Management K3
                                                            </option>
                                                            <option value="Sistem Management Lingkungan">Sistem
                                                                Management Lingkungan</option>
                                                            <option value="Sistem Management Energi">Sistem Management
                                                                Energi</option>
                                                            <option value="Sistem Management Keamanan Pangan">Sistem
                                                                Manajemen Keamanan Pangan</option>
                                                            <option value="Sistem Management Jaminan Halal">Sistem
                                                                Manajemen Jaminan Halal</option>
                                                            <option value="Sistem Management Mutu">Sistem Manajemen Mutu
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Mulai</label>
                                                        <input type="date" required id="tglMulai" name="tglMulai"
                                                            class="form-control" placeholder="Masukkan Tanggal Mulai">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Selesai</label>
                                                        <input type="date" required id="tglSelesai" name="tglSelesai"
                                                            class="form-control" placeholder="Masukkan Tanggal Selesai">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Kode Room</label>
                                                        {{-- Hilangkan input manual, cukup hidden --}}
                                                        <input type="hidden" id="kodeRoom" name="kodeRoom">
                                                        <input type="text" class="form-control"
                                                            value="Akan otomatis terisi" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Sandi Room</label>
                                                        <input type="password" required id="sandiRoom"
                                                            name="sandiRoom" class="form-control"
                                                            placeholder="Masukkan Sandi Room">
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                        <label class="form-label">Id Cabang</label>
                                                        <input type="text" id="id_cabang" name="id_cabang"
                                                            class="form-control" placeholder="Masukkan Sandi Room">
                                                    </div> --}}

                                                    {{-- New --}}
                                                    {{-- <div class="mb-3">
                                                        <label class="form-label">NIK yang Bisa Akses</label>
                                                        <div id="nik-wrapper">
                                                            <div class="input-group mb-2">
                                                                <input type="text" name="niks[]"
                                                                    class="form-control" placeholder="Masukkan NIK"
                                                                    required>
                                                                <button type="button"
                                                                    class="btn btn-danger btn-remove-nik">-</button>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-sm"
                                                            id="addNikBtn">+ Tambah NIK</button>
                                                    </div> --}}
                                                    {{-- <div class="mb-3">
                                                        <label class="form-label">NIK</label>
                                                        <input type="number" id="nik" name="nik"
                                                            class="form-control" placeholder="Masukkan NIK">
                                                    </div> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <h4 class="ms-4 mt-3">List Room Audit</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #12B5D2 ">
                                            <tr style="color: white">
                                                <th>Nama Sistem Audit</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Kode Room</th>
                                                <th>Sandi Room</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($dataRoom as $data)
                                                <tr>
                                                    <td>{{ $data->namaAudit }} </td>
                                                    <td>{{ $data->tglMulai }} </td>
                                                    <td>{{ $data->tglSelesai }} </td>
                                                    <td>{{ $data->kodeRoom }} </td>
                                                    <td>{{ $data->sandiRoom }} </td>
                                                    <td>
                                                        <form action="{{ route('deleteRoom', $data->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                onclick="return confirm('Yakin ingin menghapus Auditee ini?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>

                                                        <button class="btn btn-sm btn-primary"> <a href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editRoom{{ $data->id }}">
                                                                <i class="bx bx-edit btn-primary"></i>
                                                            </a></button>
                                                    </td>

                                                </tr>
                                                {{-- Modal Edit --}}
                                                <div class="modal fade" id="editRoom{{ $data->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('room.update', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Room</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nama Audit</label>
                                                                        <select id="namaAudit" name="namaAudit"
                                                                            class="form-control" required>
                                                                            <option value="">-- Pilih Audit --
                                                                            </option>
                                                                            <option value="Sistem Management K3"
                                                                                {{ $data->namaAudit == 'Sistem Management K3' ? 'selected' : '' }}>
                                                                                Sistem Management K3</option>
                                                                            <option
                                                                                value="Sistem Management Lingkungan"
                                                                                {{ $data->namaAudit == 'Sistem Management Lingkungan' ? 'selected' : '' }}>
                                                                                Sistem Management Lingkungan</option>
                                                                            <option value="Sistem Management Energi"
                                                                                {{ $data->namaAudit == 'Sistem Management Energi' ? 'selected' : '' }}>
                                                                                Sistem Management Energi</option>
                                                                            <option
                                                                                value="Sistem Management Keamanan Pangan"
                                                                                {{ $data->namaAudit == 'Sistem Management Keamanan Pangan' ? 'selected' : '' }}>
                                                                                Sistem Manajemen Keamanan Pangan
                                                                            </option>
                                                                            <option
                                                                                value="Sistem Management Jaminan Halal"
                                                                                {{ $data->namaAudit == 'Sistem Management Jaminan Halal' ? 'selected' : '' }}>
                                                                                Sistem Manajemen Jaminan Halal</option>
                                                                            <option value="Sistem Management Mutu"
                                                                                {{ $data->namaAudit == 'Sistem Management Mutu' ? 'selected' : '' }}>
                                                                                Sistem Manajemen Mutu</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tanggal Mulai</label>
                                                                        <input type="date" name="tglMulai"
                                                                            class="form-control"
                                                                            value="{{ $data->tglMulai }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tanggal
                                                                            Selesai</label>
                                                                        <input type="date" name="tglSelesai"
                                                                            class="form-control"
                                                                            value="{{ $data->tglSelesai }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kode Room</label>
                                                                        <input type="hidden" name="kodeRoom"
                                                                            value="{{ $data->kodeRoom }}">
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $data->kodeRoom }}" readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Sandi Room</label>
                                                                        <input type="password" id="sandiRoom"
                                                                            name="sandiRoom" class="form-control"
                                                                            placeholder="Masukkan sandi baru (opsional)">
                                                                        <small class="text-muted">Kosongkan jika tidak
                                                                            ingin mengganti sandi</small>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <input disabled type="text"
                                                                            name="id_cabang" hidden class="form-control"
                                                                            value="{{ $data->id_cabang }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
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

    {{-- JS Nik di Add Room --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('nik-wrapper');
            const addBtn = document.getElementById('addNikBtn');

            // fungsi tambah field nik
            addBtn.addEventListener('click', function() {
                const div = document.createElement('div');
                div.classList.add('input-group', 'mb-2');
                div.innerHTML = `
            <input type="text" name="niks[]" class="form-control" placeholder="Masukkan NIK" required>
            <button type="button" class="btn btn-danger btn-remove-nik">-</button>
        `;
                wrapper.appendChild(div);

                div.querySelector('.btn-remove-nik').addEventListener('click', function() {
                    div.remove();
                });
            });

            // event untuk hapus NIK pertama
            document.querySelectorAll('.btn-remove-nik').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });
        });
    </script>


</body>

</html>
