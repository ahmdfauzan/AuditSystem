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
                            <h4>Data Cabang</h4>
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
                                                data-bs-target="#modalCabang" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><span
                                                        class="d-flex align-items-center gap-2"><i
                                                            class="icon-base bx bxs-folder icon-sm"></i> <span
                                                            class="d-none d-sm-inline-block">Import Data
                                                        </span></span></span></button>
                                            <button class="mb-3 btn create-new btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#tambahCabang" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><span
                                                        class="d-flex align-items-center gap-2"><i
                                                            class="icon-base bx bx-plus icon-sm"></i> <span
                                                            class="d-none d-sm-inline-block">Tambah
                                                            Cabang</span></span></span></button>
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

                                {{-- Tambahan supaya modal otomatis muncul kalau ada error --}}
                                @if ($errors->any())
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                                            errorModal.show();
                                        });
                                    </script>
                                @endif


                                <form action="/tambahCabang" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="tambahCabang" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1"> Tambah Cabang
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Cabang</label>
                                                        <input type="text" required name="cabang" id="cabang"
                                                            class="form-control" placeholder="Masukkan Cabang">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Divisi</label>
                                                        <select id="divisi" name="divisi" class="form-control"
                                                            required>
                                                            <option value="">-- Pilih Divisi --</option>
                                                            <option value="Noodle">Noodle</option>
                                                            <option value="Food">Food</option>
                                                            <option value="Drink">Drink</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Kode Cabang</label>
                                                        <input type="number" required id="kode_cabang" name="kode_cabang"
                                                            class="form-control" placeholder="Masukkan Kode Cabang">
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
                                <form action="/importCabang" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="modalCabang" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1"> Import Data
                                                        Cabang</h5>
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
                                <h4 class="ms-4 mt-3">Master Data Cabang</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #12B5D2 ">
                                            <tr style="color: white">
                                                <th>Nama Cabang</th>
                                                <th>Divisi</th>
                                                <th>Kode Cabang</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($dataCabang as $data)
                                                <tr>
                                                    <td>{{ $data->cabang }} </td>
                                                    <td>{{ $data->divisi }} </td>
                                                    <td>{{ $data->kode_cabang }} </td>
                                                    <td>
                                                        <form action="{{ route('deleteCabang', $data->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                onclick="return confirm('Yakin ingin menghapus Cabang ini?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>

                                                        <button class="btn btn-sm btn-primary"> <a href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editCabang{{ $data->id }}">
                                                                <i class="bx bx-edit btn-primary"></i>
                                                            </a></button>
                                                    </td>

                                                </tr>
                                                {{-- Modal Edit --}}
                                                <div class="modal fade" id="editCabang{{ $data->id }}"
                                                    tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('cabang.update', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Cabang</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Cabang</label>
                                                                        <input type="text" name="cabang"
                                                                            class="form-control"
                                                                            value="{{ $data->cabang }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Divisi</label>
                                                                        <select name="divisi" class="form-control"
                                                                            required>
                                                                            <option value="Noodle"
                                                                                {{ $data->dept == 'Noodle' ? 'selected' : '' }}>
                                                                                Noodle
                                                                            </option>
                                                                            <option value="Food"
                                                                                {{ $data->dept == 'Food' ? 'selected' : '' }}>
                                                                                Food</option>
                                                                            <option value="Drink"
                                                                                {{ $data->dept == 'Drink' ? 'selected' : '' }}>
                                                                                Drink</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Kode Cabang</label>
                                                                        <input type="text" name="kode_cabang"
                                                                            class="form-control"
                                                                            value="{{ $data->kode_cabang }}" required>
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
