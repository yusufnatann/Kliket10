<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket</title>
    <style>
        /* Tambahkan gaya sesuai kebutuhan */
        .cons {
            padding: 20px;
        }
        .boxs {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .row, .row2 {
            margin-bottom: 15px;
        }
        .row div, .row2 div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="cons">
        <img src="img/background_pesan.png" class="bg_pesan" alt="Background Pesan Tiket">
        <div class="boxs">
            <div class="boxxs">
                <h1 class="pesan-title">Cari Tiket</h1>
                <p class="pesan-sub">Atur jadwal keberangkatan anda!</p>
            </div>
            <div class="bbox">
                <form action="">
                    <div class="row">
                        <div class="terminal-asal">
                            <p>Terminal Asal</p>
                            <select name="asal" id="asal">
                                <option value="">Pilih Terminal Asal</option>
                            </select>
                        </div>

                        <div class="terminal-tujuan">
                            <p>Terminal Tujuan</p>
                            <select name="tujuan" id="tujuan">
                                <option value="">Pilih Terminal Tujuan</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row2">
                        <div class="tanggal-berangkat">
                            <p>Tanggal Keberangkatan</p>
                            <input type="date" name="tanggal" id="tanggal">
                        </div>
            
                        <div class="jam-berangkat">
                            <p>Jam Keberangkatan</p>
                            <input type="time" name="jam" id="jam">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('getRutes.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data fetched:', data); // Debugging log
                    const asalSelect = document.getElementById('asal');
                    const tujuanSelect = document.getElementById('tujuan');

                    data.forEach(rute => {
                        console.log('Adding option:', rute); // Debugging log

                        // Menambahkan opsi ke terminal asal
                        const optionAsal = document.createElement('option');
                        optionAsal.value = rute.ruteID;
                        optionAsal.textContent = rute.asal;
                        asalSelect.appendChild(optionAsal);

                        // Menambahkan opsi ke terminal tujuan
                        const optionTujuan = document.createElement('option');
                        optionTujuan.value = rute.ruteID;
                        optionTujuan.textContent = rute.asal; // Menggunakan terminal yang sama untuk tujuan
                        tujuanSelect.appendChild(optionTujuan);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
</body>
</html>
