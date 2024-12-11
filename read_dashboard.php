<?php
require 'db.php'; // Tambahkan ini untuk koneksi ke database

// Ambil data anak dari database
$result = $conn->query("SELECT * FROM children");
?>

<section>
    <h3>Your Children</h3>
    <a href="add_child.php" style="text-decoration: none; color: white; background: #4CAF50; padding: 5px 10px; border-radius: 5px;">Add New Child</a>
    <table border="1" cellspacing="0" cellpadding="10" style="margin-top: 20px; width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Parent Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($child = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $child['id_children']; ?></td>
                    <td><?= htmlspecialchars($child['name']); ?></td>
                    <td><?= $child['age']; ?></td>
                    <td><?= htmlspecialchars($child['parent_name']); ?></td>
                    <td>
                        <a href="edit_child.php?id=<?= $child['id_children']; ?>">Edit</a> | 
                        <a href="delete_child.php?id=<?= $child['id_children']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>
