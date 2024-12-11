<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Proses penyimpanan data jika formulir disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan data POST ada dan tidak kosong sebelum diproses
    $parent_name = isset($_POST['parent_name']) ? htmlspecialchars($_POST['parent_name']) : '';
    $child_name = isset($_POST['child_name']) ? htmlspecialchars($_POST['child_name']) : '';
    $category_id = isset($_POST['category_id']) ? (int) $_POST['category_id'] : 0;
    $amount = isset($_POST['amount']) ? (float) $_POST['amount'] : 0;
    $date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '';

    // Validasi input
    if (empty($parent_name) || empty($child_name) || empty($category_id) || empty($amount) || empty($date)) {
        die('Semua field harus diisi.');
    }

    if ($amount <= 0) {
        die('Jumlah pembayaran harus lebih besar dari 0.');
    }

    // File JSON untuk menyimpan transaksi
    $file = 'transactions.json';
    $transactions = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Tambahkan transaksi baru
    $transactions[] = [
        'id' => count($transactions) + 1,
        'parent_name' => $parent_name,
        'child_name' => $child_name,
        'category_id' => $category_id,
        'amount' => $amount,
        'date' => $date
    ];

    // Simpan kembali ke file JSON
    file_put_contents($file, json_encode($transactions, JSON_PRETTY_PRINT));

    // Redirect ke halaman daftar transaksi dengan pesan sukses
    header('Location: transaction.php?success=true');
    exit();
}

// Data kategori (contoh)
$categories = [
    1 => 'Baby Care',
    2 => 'Toddler Activities',
    3 => 'Preschool Programs'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entry Transaksi - Happy Kids Daycare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Entry Transaksi</h1>
        <nav>
            <a href="index.php">Home</a> |
            <a href="dashboard.php">Dashboard</a> |
            <a href="transaction.php">Transaksi</a> |
            <form method="POST" action="dashboard.php" style="display:inline;">
                <button type="submit" name="logout">Logout</button>
            </form>
        </nav>
    </header>

    <main>
        <form action="transaction-entry.php" method="POST">
            <label for="parent_name">Nama Orang Tua:</label>
            <input type="text" id="parent_name" name="parent_name" placeholder="Masukkan nama orang tua" required>

            <label for="child_name">Nama Anak:</label>
            <input type="text" id="child_name" name="child_name" placeholder="Masukkan nama anak" required>

            <label for="category_id">Kategori Layanan:</label>
            <select id="category_id" name="category_id" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($categories as $id => $name): ?>
                    <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($name); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="amount">Jumlah Pembayaran:</label>
            <input type="number" id="amount" name="amount" step="0.01" placeholder="Masukkan jumlah pembayaran" required>

            <label for="date">Tanggal Transaksi:</label>
            <input type="date" id="date" name="date" required>

            <button type="submit">Simpan Transaksi</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>
</body>
</html>
