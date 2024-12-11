<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Proses form tambah transaksi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    // Baca data transaksi yang ada dari file JSON
    $file = 'transactions.json';
    $transactions = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Dapatkan ID baru untuk transaksi
    $new_id = count($transactions) + 1;

    // Tambahkan transaksi baru ke array
    $new_transaction = [
        'id' => $new_id,
        'category' => $category,
        'description' => $description,
        'amount' => $amount,
        'date' => $date
    ];

    // Simpan transaksi baru ke file JSON
    $transactions[] = $new_transaction;
    file_put_contents($file, json_encode($transactions, JSON_PRETTY_PRINT));

    // Redirect ke halaman transactions.php setelah berhasil menambah transaksi
    header('Location: transaction.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Transaction - Happy Kids Daycare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.webp" alt="Logo Happy Kids Daycare" style="width: 100px;">
        <h1>Add New Transaction</h1>
    </header>

    <main>
        <form method="POST" action="transaction-entry.php">
            <label for="category">Category:</label><br>
            <input type="text" id="category" name="category" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" required></textarea><br><br>

            <label for="amount">Amount:</label><br>
            <input type="number" id="amount" name="amount" required><br><br>

            <label for="date">Date:</label><br>
            <input type="date" id="date" name="date" required><br><br>

            <button type="submit">Add Transaction</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>
</body>
</html>

