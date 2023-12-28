<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belanja App</title>
</head>
<body>

<?php
// Fungsi untuk mendapatkan harga barang berdasarkan kode barang
function getHargaBarang($kodeBarang) {
    $daftarBarang = array(
        "BRG001" => array("nama" => "topi", "harga" => 15000),
        "BRG002" => array("nama" => "tshirt", "harga" => 96000),
        "BRG003" => array("nama" => "jeans", "harga" => 320000),
        // Tambahkan barang lain sesuai kebutuhan
    );

    return $daftarBarang[$kodeBarang];
}

// Fungsi untuk menghitung total per barang
function hitungTotalPerBarang($jumlah, $harga) {
    return $jumlah * $harga;
}

// Fungsi untuk menghitung diskon
function hitungDiskon($total) {
    return ($total > 500000) ? 0.05 * $total : 0;
}

// Menangani form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kodeBarang = $_POST["kode_barang"];
    $jumlahBeli = $_POST["jumlah_beli"];

    // Dapatkan informasi barang
    $barang = getHargaBarang($kodeBarang);

    // Hitung total per barang
    $totalBarang = hitungTotalPerBarang($jumlahBeli, $barang["harga"]);

    // Hitung diskon
    $diskon = hitungDiskon($totalBarang);

    // Hitung total semua yang harus dibayar
    $totalSemua = $totalBarang - $diskon;
?>

    <h2>Detail Transaksi</h2>
    <p>Kode Barang: <?php echo $kodeBarang; ?></p>
    <p>Nama Barang: <?php echo $barang["nama"]; ?></p>
    <p>Jumlah: <?php echo $jumlahBeli; ?></p>
    <p>Harga: Rp <?php echo $barang["harga"]; ?></p>
    <p>Total per Barang: Rp <?php echo $totalBarang; ?></p>
    <p>Diskon: Rp <?php echo $diskon; ?></p>
    <p>Total yang Harus Dibayar: Rp <?php echo $totalSemua; ?></p>

<?php
} else {
    // Jika halaman baru dibuka, tampilkan form input
?>
    <h2>Form Transaksi</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="kode_barang">Kode Barang:</label>
        <input type="text" name="kode_barang" required>

        <label for="jumlah_beli">Jumlah Beli:</label>
        <input type="number" name="jumlah_beli" required>

        <button type="submit">Hitung Transaksi</button>
    </form>
<?php
}
?>

</body>
</html>
