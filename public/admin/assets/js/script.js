document.addEventListener("DOMContentLoaded", function() {
    const gmbr = document.querySelector(".gmbr");
    const textJudul = document.querySelector(".textJudul");
    const textJudul2 = document.querySelector(".textJudul2");

    // Langkah 1: Tampilkan gambar (gmbr) dan textJudul
    // Ini sudah dihandle oleh CSS dengan opacity: 1 secara default.

    // Langkah 2: Setelah beberapa saat, sembunyikan textJudul dan tampilkan textJudul2
    setTimeout(() => {
        // Mulai proses fade out untuk textJudul
        textJudul.classList.remove("fade-in"); // Jika Anda menggunakan kelas ini
        textJudul.classList.add("fade-out");

        // Tunggu hingga transisi fade out selesai (misalnya 1 detik, sesuai transisi CSS)
        setTimeout(() => {
            // Sembunyikan textJudul secara permanen
            textJudul.classList.add("hidden");

            // Tampilkan textJudul2 dan mulai proses fade-in
            textJudul2.classList.remove("hidden"); // Hapus hidden agar elemen terlihat
            textJudul2.classList.remove("fade-out"); // Pastikan tidak ada kelas fade-out
            textJudul2.classList.add("fade-in"); // Tambahkan kelas fade-in
        }, 1000); // 1000ms = durasi transisi fade-out
    }, 3000); // Waktu tunggu awal sebelum transisi dimulai (3 detik)
});
