function updateStatus(button, status) {
    // Mendapatkan elemen <td> status di baris yang sama dengan tombol yang diklik
    var row = button.parentNode.parentNode;
    var statusCell = row.querySelector('.status');
    // Mengubah teks elemen status sesuai dengan parameter status
    statusCell.textContent = status;
}
