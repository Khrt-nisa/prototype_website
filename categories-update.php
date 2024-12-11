<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Proses hanya metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    if (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price'])) {
        die('Invalid input. All fields are required.');
    }

    $id = (int) $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'happydaycare');
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    // Proses upload foto (jika ada file baru)
    $photo = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'images/';
        // Pastikan direktori ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0775, true); // Buat direktori jika belum ada
        }

        $upload_file = $upload_dir . basename($_FILES['photo']['name']);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file)) {
            $photo = basename($_FILES['photo']['name']);
        } else {
            die('File upload failed. Check folder permissions.');
        }
    }

    // SQL Update
    $query = "UPDATE categories SET name = ?, description = ?, price = ?, photo = ? WHERE id_categories = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param('sssii', $name, $description, $price, $photo, $id);
        if ($stmt->execute()) {
            echo "Data kategori berhasil diperbarui: ID = $id, Name = $name, Price = $price.";
        } else {
            echo "Error updating category: " . $stmt->error;
        }
        $stmt->close();
    } else {
        die('Error preparing statement: ' . $conn->error);
    }

    $conn->close();
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    die('Invalid request.');
}


