<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Data kategori (contoh)
$categories = [
    ['id' => 1, 'photo' => 'ft1.jpeg', 'name' => 'Baby Care', 'description' => 'Care services for infants aged 0-2 years.', 'price' => '$100/month'],
    ['id' => 2, 'photo' => 'ft2.jpeg', 'name' => 'Toddler Activities', 'description' => 'Educational and fun activities for toddlers aged 2-4 years.', 'price' => '$150/month'],
    ['id' => 3, 'photo' => 'ft3.jpeg', 'name' => 'Preschool Programs', 'description' => 'Structured learning programs for children aged 4-6 years.', 'price' => '$200/month'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Happy Kids Daycare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        img {
            width: 100px;
            height: auto;
        }
        .btn {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            color: white;
        }
        .btn-add {
            background-color: #28a745;
        }
        .btn-edit {
            background-color: #007bff;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.webp" alt="Logo Happy Kids Daycare" style="width: 100px;">
        <h1>Categories</h1>
        <nav>
            <a href="index.php">Home</a> | 
            <a href="dashboard.php">Dashboard</a> | 
            <a href="categories.php">Categories</a> | 
            <form method="POST" action="dashboard.php" style="display:inline;">
                <button type="submit" name="logout">Logout</button>
            </form>
        </nav>
    </header>

    <main>
        <section>
            <h2>Our Categories</h2>
            <p>Browse through our available daycare services and programs:</p>

            <!-- Button Add -->
            <button class="btn btn-add">
                <a href="categories-entry.php">Tambah Data</a>
            </button>

            <!-- Categories Table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Categories</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($category['id']); ?></td>
                            <td><img src="images/<?php echo htmlspecialchars($category['photo']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>"></td>
                            <td><?php echo htmlspecialchars($category['name']); ?></td>
                            <td><?php echo htmlspecialchars($category['description']); ?></td>
                            <td><?php echo htmlspecialchars($category['price']); ?></td>
                            <td>
                                <button class="btn btn-edit"><a href="categories-edit.php?id=<?php echo $category['id']; ?>">Edit</a></button>
                                <button class="btn btn-delete" onclick="deleteCategory(<?php echo $category['id']; ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Happy Kids Daycare. All rights reserved.</p>
    </footer>

    <script>
        function deleteCategory(id) {
            if (confirm('Are you sure you want to delete this category?')) {
                // Logic for deleting can be implemented here
                alert('Category ID ' + id + ' deleted!');
            }
        }
    </script>
</body>
</html>

