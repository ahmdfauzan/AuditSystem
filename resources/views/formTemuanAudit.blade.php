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
                            <h4>Form Temuan Audit</h4>
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
                            <div class="formPengamatan">
                                <div class="card-body">
                                    <h5 class="mb-4">FORM TEMUAN AUDIT</h5>
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    {{-- Kamera Add --}}
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
                                            <div class="form-text">Ambil foto menggunakan kamera.</div>

                                            {{-- hidden input untuk menyimpan hasil foto --}}
                                            <input type="hidden" name="foto[]" class="fotoInput">

                                            <div class="photoPreview mt-2"></div>
                                        </div>
                                    </template>


                                    <form action="{{ route('createTemuan') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_hasilpengamatan"
                                            value="{{ $hasilPengamatan->id }}">

                                        <div class="mb-3">
                                            <label>Deskripsi Temuan</label>
                                            <textarea name="deskripsi" class="form-control" required></textarea>
                                        </div>

                                        <div class="mb-6">
                                            <label class="form-label">Kriterian Temuan</label>
                                            <select name="krisis" class="form-control" required>
                                                <option value="">-- Pilih Tingkat Krisis --</option>
                                                <option value="Kritis">Kritis</option>
                                                <option value="Mayor">Mayor</option>
                                                <option value="Minor">Minor</option>
                                                <option value="Observasi">Observasi</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Lokasi Audit</label>
                                            <select id="lokasi" name="lokasi" class="form-control" required>
                                                <option value="">-- Pilih Lokasi Audit --</option>
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

                                        <div class="mb-6">
                                            <label class="form-label">Prosedure</label>
                                            <select name="prosedure" class="form-control" required>
                                                <option value="">-- Pilih Prosedure --</option>
                                                <option value="Prosedure 01">Prosedure 01</option>
                                                <option value="Prosedure 02">Prosedure 02</option>
                                            </select>
                                        </div>

                                        <div class="mb-6">
                                            <label class="form-label">Elemen</label>
                                            <select name="elemen" class="form-control" required>
                                                <option value="">-- Pilih Elemen --</option>
                                                <option value="Elemen 01">Elemen 01</option>
                                                <option value="Elemen 02">Elemen 02</option>
                                            </select>
                                        </div>

                                        {{-- Tempat kumpulan kamera --}}
                                        <div id="cameraContainer"></div>

                                        <button type="button" id="addCamera" class="btn btn-secondary mt-4">+ Tambah
                                            Foto</button>

                                        <button type="submit" class="btn btn-primary mt-4">Simpan Temuan</button>
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

    <script>
        let streamMap = new Map(); // simpan stream per kamera

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

            // Start default camera
            startCamera(video, "user", uniqueKey);

            // Ubah kamera
            cameraSelect.addEventListener("change", function() {
                startCamera(video, this.value, uniqueKey);
            });

            // Ambil foto
            snap.addEventListener("click", function() {
                const ctx = canvas.getContext("2d");
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                const dataURL = canvas.toDataURL("image/jpeg", 0.7);

                fotoInput.value = dataURL;
                preview.innerHTML = `<img src="${dataURL}"
                                alt="Captured"
                                style="width:120px;height:90px;margin:5px;"
                                class="border rounded">`;
            });

            document.getElementById("cameraContainer").appendChild(clone);
        });
    </script>




</body>

</html>
