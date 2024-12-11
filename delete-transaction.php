<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Proses penghapusan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['id'];

    // Baca data dari file JSON
    $file = 'transactions.json';
    $transactions = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    // Filter data untuk menghapus transaksi
    $transactions = array_filter($transactions, function ($transaction) use ($id) {
        return $transaction['id'] !== $id;
    });

    // Simpan kembali data yang sudah difilter
    file_put_contents($file, json_encode(array_values($transactions), JSON_PRETTY_PRINT));

    // Redirect ke halaman transaksi
    header('Location: transaction.php');
    exit();
}
?>
