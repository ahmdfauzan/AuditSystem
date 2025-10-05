{{-- Navigation --}}
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <span class="text-primary">
                    <img src="{{ asset('admin/assets/img/iconAudit.png') }}" width="30px" alt="">
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">IMPACT-D</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left d-block d-xl-none align-middle" style="padding-top:2px; padding-left:2px"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Components -->
        @if (in_array(auth()->user()->level, ['Auditor', 'Master', 'Auditee']))
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Master Data</span></li>
        <!-- Pages -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div class="text-truncate" data-i18n="Account Settings">Master Data</div>
            </a>
        @endif
            <ul class="menu-sub">
                @if (in_array(auth()->user()->level, ['Auditor', 'Master', 'Auditee']))
                    <li class="menu-item">
                        <a href="{{ url('/MD-Auditor') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="Account">Data Auditor</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ url('/MD-Auditee') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="Account">Data Auditee</div>
                        </a>
                    </li>
                @endif
                @if (in_array(auth()->user()->level, ['Master', 'PD1']))
                <li class="menu-item">
                    <a href="{{ url('/MD-Cabang') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Account">Data Cabang</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/MD-SuratKeluar') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="Account">Surat Keluar</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @if (in_array(auth()->user()->level, ['Master', 'PD1']))
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Hak Akses</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="{{ url('/daftarUser') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div class="text-truncate" data-i18n="Basic">Daftar User</div>
            </a>
        </li>
        @endif

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Sistem Audit</span></li>
        @if (in_array(auth()->user()->level, ['Master', 'leadAuditor']))
        <li class="menu-item">
            <a href="{{ url('/dataRoom') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-server"></i>
                <div class="text-truncate" data-i18n="Basic">Data Audit</div>
            </a>
        </li>
        @endif
        @if (in_array(auth()->user()->level, ['Master', 'leadAuditor', 'Auditor']))
        <li class="menu-item">
            <a href="{{ url('/listRoom') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-badge-check"></i>
                <div class="text-truncate" data-i18n="Basic">Room Audit</div>
            </a>
        </li>
        @endif

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Notification</span></li>
        <li class="menu-item">
            <a href="{{ url('/dataRoom') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-info-square"></i>
                <div class="text-truncate" data-i18n="Basic">Informasi</div>
            </a>
        </li>

        <li class="menu-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="border: none" class="menu-link"
                    onclick="return confirm('Apakah Anda yakin ingin keluar dari website?')">
                    <i class="menu-icon tf-icons bx bx-exit"></i>
                    <div class="text-truncate" data-i18n="Basic">Logout</div>
                </button>
            </form>
        </li>

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Form Hasil Audit</span></li>
        @if (in_array(auth()->user()->level, ['Master', 'Auditee', 'MR']))
        <li class="menu-item">
            <a href="{{ url('/auditeePengamatan') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-server"></i>
                <div class="text-truncate" data-i18n="Basic">Data Hasil Pengamatan</div>
            </a>
        </li>
        @endif
        @if (in_array(auth()->user()->level, ['Master', 'Auditee']))
        <li class="menu-item">
            <a href="{{ url('/auditeePenyelesaian') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-book-content"></i>
                <div class="text-truncate" data-i18n="Basic">Data Hasil Temuan</div>
            </a>
        </li>
        @endif

        @if (in_array(auth()->user()->level, ['Master', 'leadAuditor']))
        <li class="menu-item">
            <a href="{{ url('/hasilAudit') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-book-bookmark"></i>
                <div class="text-truncate" data-i18n="Basic">Data Hasil Audit</div>
            </a>
        </li>
        @endif



    </ul>
</aside>
