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
                            <h4>Data Auditor</h4>
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
                                            <button class="me-3 mb-3 btn create-new btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalAuditor" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><span
                                                        class="d-flex align-items-center gap-2"><i
                                                            class="icon-base bx bxs-folder icon-sm"></i> <span
                                                            class="d-none d-sm-inline-block">Import Data
                                                        </span></span></span></button>
                                            <button class="mb-3 btn create-new btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#tambahAuditor" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><span
                                                        class="d-flex align-items-center gap-2"><i
                                                            class="icon-base bx bx-plus icon-sm"></i> <span
                                                            class="d-none d-sm-inline-block">Tambah
                                                            Auditor</span></span></span></button>
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

                                <form action="/tambahAuditor" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="tambahAuditor" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1"> Tambah Auditor
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" required name="name" id="name"
                                                            class="form-control" placeholder="Masukkan Nama">
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
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jabatan</label>
                                                        <input type="text" required id="jabatan" name="jabatan"
                                                            class="form-control" placeholder="Masukkan Jabatan">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Foto Tanda Tangan</label>
                                                        <input type="file" name="fotoTtd" id="fotoTtd"
                                                            class="form-control" accept="image/*">
                                                        <small class="text-muted">Opsional, boleh dikosongkan</small>
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
                                <form action="/importAuditor" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="modalAuditor" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1"> Import Data
                                                        Auditor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <input type="file" name="file"
                                                                class="form-control" />
                                                        </div>
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
                                <h4 class="ms-4 mt-3">Master Data Auditor</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #12B5D2 ">
                                            <tr style="color: white">
                                                <th>Nama</th>
                                                <th>Nik</th>
                                                <th>Departemen</th>
                                                <th>Jabatan</th>
                                                <th>Kode Cabang</th>
                                                @if(in_array(auth()->user()->level, ['Auditee', 'Master', 'Auditor']))
                                                <th>Action</th>
                                                @endif
                                                <th>Upload TTD</th>
                                                <th>Foto TTD</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($dataAuditor as $data)
                                                <tr>
                                                    <td>{{ $data->name }} </td>
                                                    <td>{{ $data->nik }} </td>
                                                    <td>{{ $data->dept }} </td>
                                                    <td>{{ $data->jabatan }} </td>
                                                    <td>{{ $data->id_cabang }} </td>
                                                   @if(in_array(auth()->user()->level, ['Auditee', 'Master', 'Auditor']))
                                                    <td>
                                                        <form action="{{ route('deleteAuditor', $data->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                onclick="return confirm('Yakin ingin menghapus auditor ini?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>

                                                        <button class="btn btn-sm btn-primary"> <a href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editAuditor{{ $data->id }}">
                                                                <i class="bx bx-edit btn-primary"></i>
                                                            </a></button>
                                                    </td>
                                                    @endif
                                                    <td>
                                                        {{-- Upload Foto TTD --}}
                                                        <form action="{{ route('updateFotoAuditor', $data->id) }}"
                                                            method="POST" enctype="multipart/form-data"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="file" name="fotoTtd" accept="image/*"
                                                                style="display:none;"
                                                                id="fotoTtdInput{{ $data->id }}"
                                                                onchange="this.form.submit()">
                                                            <button type="button" class="btn btn-sm btn-warning"
                                                                onclick="document.getElementById('fotoTtdInput{{ $data->id }}').click();">
                                                                <i class="bx bx-upload"></i> Upload Tanda Tangan
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        @if ($data->fotoTtd)
                                                            <img src="{{ asset('uploads/ttd/' . $data->fotoTtd) }}"
                                                                alt="TTD" width="80">
                                                        @else
                                                            <span class="text-muted">Belum ada TTD</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                                {{-- Modal Edit --}}
                                                <div class="modal fade" id="editAuditor{{ $data->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('auditor.update', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Auditor</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nama</label>
                                                                        <input type="text" name="name"
                                                                            class="form-control"
                                                                            value="{{ $data->name }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nik</label>
                                                                        <input type="number" name="nik"
                                                                            class="form-control"
                                                                            value="{{ $data->nik }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Departemen</label>
                                                                        <select name="dept" class="form-control"
                                                                            required>
                                                                            <option value="HR"
                                                                                {{ $data->dept == 'HR' ? 'selected' : '' }}>
                                                                                HR
                                                                            </option>
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
                                                                                PPIC
                                                                            </option>
                                                                            <option value="Purchasing"
                                                                                {{ $data->dept == 'Purchasing' ? 'selected' : '' }}>
                                                                                Purchasing</option>
                                                                            <option value="Marketing"
                                                                                {{ $data->dept == 'Marketing' ? 'selected' : '' }}>
                                                                                Marketing</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Jabatan</label>
                                                                        <input type="text" name="jabatan"
                                                                            class="form-control"
                                                                            value="{{ $data->jabatan }}" required>
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

</body>

</html>
