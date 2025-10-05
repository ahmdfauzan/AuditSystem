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
                            <h4>Data User</h4>
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
                                                data-bs-target="#tambahUser" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><span
                                                        class="d-flex align-items-center gap-2"><i
                                                            class="icon-base bx bx-plus icon-sm"></i> <span
                                                            class="d-none d-sm-inline-block">Tambah
                                                            User</span></span></span></button>
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


                                <form action="/tambahUser" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="tambahUser" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1"> Tambah User
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Username</label>
                                                        <input type="text" required name="name" id="name"
                                                            class="form-control" placeholder="Masukkan Username">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" required id="email" name="email"
                                                            class="form-control" placeholder="Masukkan Email">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" required id="password" name="password"
                                                            class="form-control" placeholder="Masukkan Password">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Level</label>
                                                        <select id="level" name="level" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih Level --</option>
                                                            <option value="Master">Master</option>
                                                            <option value="leadAuditor">Lead Auditor</option>
                                                            <option value="mr">Management Representative</option>
                                                            <option value="Auditor">Auditor</option>
                                                            <option value="Auditee">Auditee</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3" id="sistemManagementDiv"
                                                        style="display: none;">
                                                        <label class="form-label">Sistem Management</label>
                                                        <select id="sistemManagement" name="sistemManagement"
                                                            class="form-control">
                                                            <option value="">-- Pilih --</option>
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
                                                            <option value="Sistem Management Mutu">Sistem Manajemen
                                                                Mutu</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nik</label>
                                                        <input type="number" required id="nik" name="nik"
                                                            class="form-control" placeholder="Masukkan Nik">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Departemen</label>
                                                        <select id="dept" name="dept" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih Departemen --</option>
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
                                                    <div class="mb-3">
                                                        <label class="form-label">Cabang</label>
                                                        <select id="cabang" name="cabang" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih Cabang --</option>
                                                            @foreach ($dataCabang as $data)
                                                                <option value="{{ $data->cabang }}">{{ $data->cabang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Kode Cabang</label>
                                                        <input type="text" id="kode_cabang" name="kode_cabang"
                                                            class="form-control" readonly>
                                                    </div>
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
                                <h4 class="ms-4 mt-3">Daftar User</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #12B5D2 ">
                                            <tr style="color: white">
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Nik</th>
                                                <th>Cabang</th>
                                                <th>Kode Cabang</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($dataUser as $data)
                                                <tr>
                                                    <td>{{ $data->name }} </td>
                                                    <td>{{ $data->email }} </td>
                                                    <td>{{ $data->level }} </td>
                                                    <td>{{ $data->nik }} </td>
                                                    <td>{{ $data->cabang }} </td>
                                                    <td>{{ $data->kode_cabang }} </td>
                                                    <td>
                                                        <form action="{{ route('deleteUser', $data->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                onclick="return confirm('Yakin ingin menghapus User ini?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>

                                                        <button class="btn btn-sm btn-primary"> <a href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editUser{{ $data->id }}">
                                                                <i class="bx bx-edit btn-primary"></i>
                                                            </a></button>
                                                    </td>

                                                </tr>
                                                {{-- Modal Edit --}}
                                                <div class="modal fade" id="editUser{{ $data->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('user.update', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit User</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Username</label>
                                                                        <input type="text" required name="name"
                                                                            id="name" class="form-control"
                                                                            value="{{ old('name', $data->name) }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Email</label>
                                                                        <input type="email" required id="email"
                                                                            name="email" class="form-control"
                                                                            value="{{ old('email', $data->email) }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Password</label>
                                                                        <input type="password" id="password"
                                                                            name="password" class="form-control"
                                                                            placeholder="Kosongkan jika tidak ingin ubah password">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Level</label>
                                                                        <select id="level" name="level"
                                                                            class="form-control" required>
                                                                            <option value="">-- Pilih Level --
                                                                            </option>
                                                                            <option value="Master"
                                                                                {{ $data->level == 'Master' ? 'selected' : '' }}>
                                                                                Master</option>
                                                                            <option value="Admin"
                                                                                {{ $data->level == 'Admin' ? 'selected' : '' }}>
                                                                                Admin</option>
                                                                            <option value="Auditor"
                                                                                {{ $data->level == 'Auditor' ? 'selected' : '' }}>
                                                                                Auditor</option>
                                                                            <option value="Auditee"
                                                                                {{ $data->level == 'Auditee' ? 'selected' : '' }}>
                                                                                Auditee</option>
                                                                            <option value="leadAuditor"
                                                                                {{ $data->level == 'leadAuditor' ? 'selected' : '' }}>
                                                                                Lead Auditor</option>
                                                                            <option value="mr"
                                                                                {{ $data->level == 'mr' ? 'selected' : '' }}>
                                                                                Management Representative</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3" id="sistemManagementDiv"
                                                                        style="display: none;">
                                                                        <label class="form-label">Sistem
                                                                            Management</label>
                                                                        <select id="sistemManagement"
                                                                            name="sistemManagement"
                                                                            class="form-control">
                                                                            <option value="">-- Pilih --</option>
                                                                            <option value="Sistem Management K3"
                                                                                {{ $data->sistemManagement == 'Sistem Management K3' ? 'selected' : '' }}>
                                                                                Sistem Management K3</option>
                                                                            <option value="Sistem Management Lingkungan"
                                                                                {{ $data->sistemManagement == 'Sistem Management Lingkungan' ? 'selected' : '' }}>
                                                                                Sistem Management Lingkungan</option>
                                                                            <option value="Sistem Management Energi"
                                                                                {{ $data->sistemManagement == 'Sistem Management Energi' ? 'selected' : '' }}>
                                                                                Sistem Management Energi</option>
                                                                            <option value="Sistem Management Keamanan Pangan"
                                                                                {{ $data->sistemManagement == 'Sistem Management Keamanan Pangan' ? 'selected' : '' }}>
                                                                                Sistem Management Keamanan Pangan</option>
                                                                            <option value="Sistem Management Jaminan Halal"
                                                                                {{ $data->sistemManagement == 'Sistem Management Jaminan Halal' ? 'selected' : '' }}>
                                                                                Sistem Management Jaminan Halal</option>
                                                                            <option value="Sistem Management Mutu"
                                                                                {{ $data->sistemManagement == 'Sistem Management Mutu' ? 'selected' : '' }}>
                                                                                Sistem Management Mutu</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Departemen</label>
                                                                        <select id="dept" name="dept"
                                                                            class="form-control" required>
                                                                            <option value="">-- Pilih Departemen
                                                                                --
                                                                            </option>
                                                                            <option value="HR"
                                                                                {{ $data->dept == 'HR' ? 'selected' : '' }}>
                                                                                HR</option>
                                                                            <option value="Teknik"
                                                                                {{ $data->dept == 'Teknik' ? 'selected' : '' }}>
                                                                                Teknik</option>
                                                                            <option value="Warehouse"
                                                                                {{ $data->dept == 'Warehouse' ? 'selected' : '' }}>
                                                                                Warehouse</option>
                                                                            <option value="Accounting"
                                                                                {{ $data->dept == 'Accounting' ? 'selected' : '' }}>
                                                                                Accounting</option>
                                                                            <option value="Produksi"
                                                                                {{ $data->dept == 'Produksi' ? 'selected' : '' }}>
                                                                                Produksi</option>
                                                                            <option value="PPIC"
                                                                                {{ $data->dept == 'PPIC' ? 'selected' : '' }}>
                                                                                PPIC</option>
                                                                            <option value="Purchasing"
                                                                                {{ $data->dept == 'Purchasing' ? 'selected' : '' }}>
                                                                                Purchasing</option>
                                                                            <option value="Marketing"
                                                                                {{ $data->dept == 'Marketing' ? 'selected' : '' }}>
                                                                                Marketing</option>
                                                                            <option value="Distribusi"
                                                                                {{ $data->dept == 'Distribusi' ? 'selected' : '' }}>
                                                                                Distribusi</option>

                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nik</label>
                                                                        <input type="number" required id="nik"
                                                                            name="nik" class="form-control"
                                                                            value="{{ old('nik', $data->nik) }}">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Cabang</label>
                                                                        <select id="cabang" name="cabang"
                                                                            class="form-control" required>
                                                                            <option value="">-- Pilih Cabang --
                                                                            </option>
                                                                            @foreach ($dataCabang as $cabang)
                                                                                <option value="{{ $cabang->cabang }}"
                                                                                    {{ $data->cabang == $cabang->cabang ? 'selected' : '' }}>
                                                                                    {{ $cabang->cabang }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kode Cabang</label>
                                                                        <input type="text" id="kode_cabang"
                                                                            name="kode_cabang" class="form-control"
                                                                            value="{{ old('kode_cabang', $data->kode_cabang) }}"
                                                                            readonly>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Batal
                                                                    </button>
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

    {{-- Script Autoload --}}
    <script>
        $(document).ready(function() {
            $('#cabang').on('change', function() {
                var cabang = $(this).val();
                if (cabang) {
                    $.ajax({
                        url: '/get-kode-cabang/' + cabang,
                        type: 'GET',
                        success: function(data) {
                            if (data) {
                                $('#kode_cabang').val(data.kode_cabang);
                            } else {
                                $('#kode_cabang').val('');
                            }
                        }
                    });
                } else {
                    $('#kode_cabang').val('');
                }
            });
        });
    </script>

    <script>
        document.getElementById('level').addEventListener('change', function() {
            const sistemManagementDiv = document.getElementById('sistemManagementDiv');
            if (this.value === 'leadAuditor' || this.value === 'mr') {
                sistemManagementDiv.style.display = 'block';
            } else {
                sistemManagementDiv.style.display = 'none';
                document.getElementById('sistemManagement').value = ""; // reset pilihan
            }
        });
    </script>

</body>

</html>
