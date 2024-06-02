<?php
include 'database/koneksi.php';
include 'database/auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kliket - Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/faq.css">
    <link rel="stylesheet" href="css/font.css">
    
</head>
<body>
    <!-- Navbar -->
    <?php
    include 'navbar.php';
    ?>

    <div class="faq-container">
        <div class="faq-header">
            <h1>FAQs</h1>
        </div>
        <details>
            <summary>Apa itu Travel?</summary>
            <p>Travel adalah aktivitas yang melibatkan perpindahan dari satu tempat ke tempat lain, baik untuk tujuan rekreasi, bisnis, pendidikan, atau tujuan lainnya. Ini melibatkan transportasi, akomodasi, dan pengalaman baru di tempat yang dikunjungi.</p>
        </details>
        <details>
            <summary>Apakah situs web KliKer aman untuk digunakan pembayaran? </summary>
            <p>Ya, situs web kami dilengkapi dengan sistem keamanan yang canggih untuk melindungi informasi pribadi dan transaksi pembayaran pelanggan.</p>
        </details>
        <details>
            <summary>Apakah KliKer aman digunakan sebagai platform perjalanan?</summary>
            <p>KliKer adalah platform perjalanan yang aman dan dapat dipercaya, dengan penerapan sistem keamanan yang ketat dan penggunaan sertifikat SSL untuk melindungi informasi pribadi pelanggan. Dengan demikian, pengguna dapat merasa nyaman dan terjamin saat menggunakan KliKer untuk merencanakan perjalanan mereka.</p>
        </details>
    </div>

</body>
</html>
