<?php
require 'db.php';

// Validasi parameter ID
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = intval($_GET['id']); // Pastikan ID adalah angka

// Ambil data anak berdasarkan ID
$result = $conn->query("SELECT * FROM children WHERE id_children = $id");

// Jika data tidak ditemukan, tampilkan pesan atau arahkan kembali
if ($result->num_rows == 0) {
    die("Child not found or invalid ID.");
}

$child = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input dari form
    $name = trim($_POST['name']);
    $age = intval($_POST['age']);
    $parent_name = trim($_POST['parent_name']);

    // Update data anak
    $stmt = $conn->prepare("UPDATE children SET name = ?, age = ?, parent_name = ? WHERE id_children = ?");
    $stmt->bind_param("sisi", $name, $age, $parent_name, $id);

    if ($stmt->execute()) {
        // Redirect jika berhasil
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Failed to update child.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Child</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Edit Child</h1>

    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($child['name']); ?>" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?= $child['age']; ?>" required>

        <label for="parent_name">Parent Name:</label>
        <input type="text" id="parent_name" name="parent_name" value="<?= htmlspecialchars($child['parent_name']); ?>" required>

        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
