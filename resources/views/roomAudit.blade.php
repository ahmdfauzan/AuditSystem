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
                            Room Audit
                        </div>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            @foreach ($listRoom as $data)
                                <div class="col-lg-4 auditRoom mt-4">
                                    <div class="row kotak rounded-3 p-3 h-100 d-flex">
                                        <div
                                            class="col-lg-4 col-sm-4 col-4 mt-4 d-flex align-items-center justify-content-center">
                                            @if ($data->namaAudit == 'Sistem Management K3')
                                                <img src="{{ asset('admin/assets/img/iconSMK3.png') }}" width="120px"
                                                    alt="">
                                            @elseif ($data->namaAudit == 'Sistem Management Mutu')
                                                <img src="{{ asset('admin/assets/img/iconSMM.png') }}" width="120px"
                                                    alt="">
                                            @elseif ($data->namaAudit == 'Sistem Management Keamanan Pangan')
                                                <img src="{{ asset('admin/assets/img/iconSMKP.png') }}" width="120px"
                                                    alt="">
                                            @elseif ($data->namaAudit == 'Sistem Management Jaminan Halal')
                                                <img src="{{ asset('admin/assets/img/iconSJH.png') }}" width="120px"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('admin/assets/img/iconAudit.png') }}" width="120px"
                                                    alt="">
                                            @endif
                                        </div>

                                        <div class="col-lg-8 col-sm-8 col-8 d-flex flex-column justify-content-between">
                                            <div>
                                                <h4 class="text-uppercase">{{ $data->namaAudit }}</h4>
                                                <p>
                                                    Audit akan dimulai pada tanggal
                                                    <span>
                                                        {{ \Carbon\Carbon::parse($data->tglMulai)->translatedFormat('d F Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($data->tglSelesai)->translatedFormat('d F Y') }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div>
                                                <a href="{{ route('roomAudit.detail', $data->id) }}"
                                                    class="btn btn-warning">Mulai</a>
                                                {{-- @if ($data->niks->contains('nik', auth()->user()->nik))
                                                @else
                                                    <button class="btn btn-secondary" disabled>Tidak ada akses</button>
                                                @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
