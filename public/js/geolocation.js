document.addEventListener("DOMContentLoaded", function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Kirimkan data ini ke server
            fetch('/restricted', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ latitude, longitude })
            })
            .then(response => response.text())
            .then(data => {
                document.body.innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }, function(error) {
            console.error('Error getting location:', error);
            alert('Gagal mendapatkan lokasi. Pastikan fitur lokasi aktif.');
        });
    } else {
        alert('Geolocation tidak didukung oleh browser ini.');
    }
});
