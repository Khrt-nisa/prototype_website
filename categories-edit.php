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

// Ambil data kategori berdasarkan ID
$result = $conn->query("SELECT * FROM categories WHERE id_categories = $id");
$category = $result->fetch_assoc();

// Proses pembaruan kategori
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);

    // Proses upload foto baru
    $photo = $category['photo']; // Tetap gunakan foto lama jika tidak ada file baru
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'images/';
        $photo = basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $photo);
    }

    // Update data kategori di database
    $stmt = $conn->prepare("UPDATE categories SET name = ?, description = ?, price = ?, photo = ? WHERE id_categories = ?");
    $stmt->bind_param('ssssi', $name, $description, $price, $photo, $id);
    if ($stmt->execute()) {
        header('Location: categories.php');
        exit();
    } else {
        echo "Error updating category: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Happy Kids Daycare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS untuk memastikan ukuran gambar sama */
        .kegiatan img {
            width: 300px; /* Atur ukuran lebar */
            height: 200px; /* Atur ukuran tinggi */
            object-fit: cover; /* Memastikan gambar tetap proporsional */
            margin: 10px;
        }
        header {
            background-color: #4CAF50;
            padding: 20px;
            text-align: center;
            color: white;
        }

        header h1 {
            margin: 0;
        }

        header img {
            width: 100px;
            vertical-align: middle;
            margin-right: 10px;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        nav form button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        nav form button:hover {
            background-color: #c0392b;
        }

        main {
            padding: 20px;
            background-color: white;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input, form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            width: 100%;
        }

        form button:hover {
            background-color: #2980b9;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #2c3e50;
            color: white;
            margin-top: 20px;
        }

        .dashboard-nav {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }

        .dashboard-nav a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
        }

        .dashboard-nav a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.webp" alt="Logo Happy Kids Daycare">
        <h1>Edit Category</h1>
        <nav>
            <a href="index.php">Home</a> | 
            <form method="POST" style="display:inline;">
                <button type="submit" name="logout">Logout</button>
            </form>
        </nav>
    </header>

    <main>
      <form method="POST" enctype="multipart/form-data">
        <label for="name">Category Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name'] ?? ''); ?>" required><br>

         <label for="description">Description:</label>
         <textarea id="description" name="description" required><?php echo htmlspecialchars($category['description'] ?? ''); ?></textarea><br>

         <label for="price">Price:</label>
         <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($category['price'] ?? ''); ?>" required><br>

         <label for="photo">Photo:</label>
         <input type="file" id="photo" name="photo"><br>

         <button type="submit">Update Category</button>
</form>

    </main>

    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>
</body>
</html> 



