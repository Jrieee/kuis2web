<?php
include 'config.php';
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f4f9;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .btn-add {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
        }

        thead {
            background-color: #f0f4ff;
        }

        th {
            color: #333;
        }

        td, th {
            vertical-align: middle;
        }

        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-edit {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-edit:hover {
            text-decoration: underline;
        }

        .btn-delete {
            color: #dc3545;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border-bottom: 1px solid #ddd;
            }

            td {
                padding: 10px 0;
                display: flex;
                justify-content: space-between;
                border: none;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #666;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Daftar Pengguna</h2>

    <a href="user_add.php" class="btn btn-primary btn-add">+ Tambah User</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="Nama"><?= htmlspecialchars($row['name']) ?></td>
                    <td data-label="Email"><?= htmlspecialchars($row['email']) ?></td>
                    <td data-label="Foto">
                        <img src="uploads/<?= htmlspecialchars($row['photo']) ?>" alt="Foto">
                    </td>
                    <td data-label="Aksi">
                        <a href="user_edit.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a> |
                        <a href="user_delete.php?id=<?= $row['id'] ?>" class="btn-delete"
                           onclick="return confirm('Hapus pengguna ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
