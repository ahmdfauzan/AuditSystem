@if (session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="successToast" class="toast border-0" role="alert" aria-live="assertive" aria-atomic="true"
            style="background-color: #75dbed; color: #000;">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastEl = document.getElementById('successToast');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>
@endif

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header">
                <h5 class="modal-title">Terjadi Kesalahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
