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
                            <h4>Surat Keluar</h4>
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
                                                data-bs-target="#tambahSurat" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><span
                                                        class="d-flex align-items-center gap-2"><i
                                                            class="icon-base bx bx-plus icon-sm"></i> <span
                                                            class="d-none d-sm-inline-block">Tambah
                                                            No Surat</span></span></span></button>
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


                                <form action="/tambahSurat" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="tambahSurat" tabindex="-1" aria-hidden="true">
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
                                                        <label class="form-label">Kode Form</label>
                                                        <input type="text" required name="kodeForm" id="kodeForm"
                                                            class="form-control" placeholder="Masukkan Kode Form">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">No Terbitan</label>
                                                        <input type="text" required name="noTerbitan" id="noTerbitan"
                                                            class="form-control" placeholder="Masukkan No Terbitan">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Efektif</label>
                                                        <input type="date" required name="tglEfektif" id="tglEfektif"
                                                            class="form-control" placeholder="Masukkan Tanggal Efektif">
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
                                <h4 class="ms-4 mt-3">List No Surat</h4>
                                <div class="table-container">
                                    <table class="table table-bordered table-hover">
                                        <thead class="freezeTab" style="background-color: #12B5D2 ">
                                            <tr style="color: white">
                                                <th>Kode Form</th>
                                                <th>No Terbitan</th>
                                                <th>Tanggal Efektif</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tableBody">
                                            @foreach ($suratKeluar as $data)
                                                <tr>
                                                    <td>{{ $data->kodeForm }} </td>
                                                    <td>{{ $data->noTerbitan }} </td>
                                                    <td>{{ $data->tglEfektif }} </td>
                                                    <td>
                                                        <form action="{{ route('deleteSurat', $data->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-primary"
                                                                onclick="return confirm('Yakin ingin menghapus Cabang ini?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
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
