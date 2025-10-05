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
                            <h4>Form Penyelesaian</h4>
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
                                <div class="mt-3" style="margin-left: 23px">
                                    <a href="{{ url()->previous() }}" class="btn btn-primary"> <i
                                            class="fa fa-step-backward"></i> Kembali</a>
                                </div>
                                <h4 class="ms-4 mt-4">Data Temuan</h4>
                                <div class="table-container">
                                    <div class="card p-4">
                                        <p><strong>Deskripsi: </strong> <br> {!! nl2br(e($temuan->deskripsi ?? '-')) !!}</p>
                                        <p><strong>Nama Auditee :</strong> {{ $temuan->hasilPengamatan->namaAuditee ?? '-' }}</p>
                                        <p><strong>Nama Auditor :</strong> {{ $temuan->hasilPengamatan->auditor->name ?? '-' }}</p>

                                        @if ($temuan->fotos->isNotEmpty())
                                            @foreach ($temuan->fotos as $foto)
                                                <img src="{{ asset('uploads/foto/' . $foto->foto) }}" width="150"
                                                    class="rounded shadow mb-2">
                                            @endforeach
                                        @else
                                            <p class="text-muted">Tidak ada foto</p>
                                        @endif

                                    </div>
                                </div>


                                <div class="container mt-4">
                                    <h5 class="mb-4">Form Penyelesaian Temuan</h5>

                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    {{-- Template kamera --}}
                                    <template id="cameraTemplate">
                                        <div class="camera-block border p-2 mb-3 rounded">
                                            <label class="form-label">Ambil Foto</label>
                                            <div>
                                                <select class="cameraSelect form-select mb-2">
                                                    <option value="user">Kamera Depan</option>
                                                    <option value="environment">Kamera Belakang</option>
                                                </select>
                                                <video class="video" width="320" height="240" autoplay></video>
                                                <br>
                                                <button type="button" class="snap btn btn-primary mt-2">Ambil
                                                    Foto</button>
                                                <canvas class="canvas" width="320" height="240"
                                                    style="display:none;"></canvas>
                                            </div>
                                            <input type="hidden" name="foto[]" class="fotoInput">
                                            <div class="photoPreview mt-2"></div>
                                        </div>
                                    </template>

                                    <form action="{{ route('storePenyelesaian') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="temuan_id" value="{{ $temuan->id }}">

                                        <div class="mb-3">
                                            <label for="identifikasi" class="form-label">Identifikasi Masalah</label>
                                            <textarea class="form-control" name="identifikasi" id="identifikasi" rows="3" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tindakanlangsung" class="form-label">Tindakan Langsung</label>
                                            <textarea class="form-control" name="tindakanlangsung" id="tindakanlangsung" rows="3" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="perbaikan" class="form-label">Rencana Perbaikan Agar Tidak Terulang</label>
                                            <textarea class="form-control" name="perbaikan" id="perbaikan" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="targetPerbaikan" class="form-label">Target Perbaikan</label>
                                            <input type="date" name="targetPerbaikan" class="form-control" required>
                                        </div>

                                        {{-- Tempat kamera --}}
                                        <div id="cameraContainer"></div>

                                        <button type="button" id="addCamera" class="btn btn-secondary mt-2">+ Tambah
                                            Foto</button>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Kirim Penyelesaian</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">Kembali</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

    {{-- Script Kamera --}}
    <script>
        let streamMap = new Map();

        function startCamera(videoElem, facingMode = "user", key) {
            if (streamMap.has(key)) {
                streamMap.get(key).getTracks().forEach(track => track.stop());
            }

            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode
                    }
                })
                .then(stream => {
                    videoElem.srcObject = stream;
                    streamMap.set(key, stream);
                })
                .catch(err => {
                    console.error("Tidak bisa mengakses kamera:", err);
                    alert("Pastikan perangkat mendukung kamera dan izinkan akses kamera.");
                });
        }

        document.getElementById("addCamera").addEventListener("click", function() {
            const template = document.getElementById("cameraTemplate");
            const clone = template.content.cloneNode(true);

            const video = clone.querySelector(".video");
            const canvas = clone.querySelector(".canvas");
            const snap = clone.querySelector(".snap");
            const cameraSelect = clone.querySelector(".cameraSelect");
            const fotoInput = clone.querySelector(".fotoInput");
            const preview = clone.querySelector(".photoPreview");

            const uniqueKey = Date.now() + Math.random();

            startCamera(video, "user", uniqueKey);

            cameraSelect.addEventListener("change", function() {
                startCamera(video, this.value, uniqueKey);
            });

            snap.addEventListener("click", function() {
                const ctx = canvas.getContext("2d");
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                const dataURL = canvas.toDataURL("image/jpeg", 0.8);

                fotoInput.value = dataURL;
                preview.innerHTML = `<img src="${dataURL}"
                alt="Captured"
                style="width:120px;height:90px;margin:5px;"
                class="border rounded shadow-sm">`;
            });

            document.getElementById("cameraContainer").appendChild(clone);
        });
    </script>

</body>

</html>
