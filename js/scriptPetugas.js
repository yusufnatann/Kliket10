function updateStatus(button, status) {
    var yakin = confirm("Apakah yakin ingin mengubah status menjadi " + status + "?");
    if (yakin) {
        // Dapatkan baris tabel tempat tombol diklik
        var row = button.parentElement.parentElement;
        
        // Dapatkan tiketID dari kolom yang sesuai dalam baris tersebut
        var tiketID = row.cells[3].innerText;
        
        // Lakukan aksi untuk memperbarui status kehadiran (misalnya mengirim permintaan AJAX ke server)
        // Contoh sederhana: memperbarui status di baris tabel
        row.querySelector('.status').innerText = status;
        
        // Kirim permintaan AJAX untuk memperbarui status di database (jika diperlukan)
        var xhr = new XMLHttpRequest();
        // xhr.open("POST", "updateStatus.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("tiketID=" + tiketID + "&status=" + status);
        
        // xhr.onload = function() {
        //     if (xhr.status == 200) {
        //         alert("Status berhasil diperbarui");
        //     } else {
        //         alert("Terjadi kesalahan saat memperbarui status");
        //     }
        // };
    }
}
