<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'happydaycare');
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$id = (int) $_GET['id'];

// Hapus kategori berdasarkan ID
$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->bind_param('i', $id);
if ($stmt->execute()) {
    header('Location: categories.php');
    exit();
} else {
    echo "Error deleting category: " . $conn->error;
}
?>
