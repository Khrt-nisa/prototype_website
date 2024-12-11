<?php
session_start();

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
    <title>Print Categories</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        img {
            width: 100px;
        }
    </style>
</head>
<body>
    <h1>Daftar Kategori</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Categories</th>
                <th>Description</th>
                <th>Price</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        window.print(); // Cetak otomatis saat halaman diakses
        window.onafterprint = () => window.close(); // Tutup tab setelah cetak
    </script>
</body>
</html>

