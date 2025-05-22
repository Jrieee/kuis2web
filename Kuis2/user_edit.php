<?php
include 'config.php';
$id = $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $photo_name = $user['photo'];
    if ($_FILES['photo']['name']) {
        $photo_name = basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $photo_name);
    }

    $sql = "UPDATE users SET name=?, email=?, photo=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $photo_name, $id);
    $stmt->execute();

    header("Location: user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #f8f9fa);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 500px;
        }

        .form-title {
            text-align: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 500;
            margin-top: 10px;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        .user-photo {
            display: block;
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
            margin-top: 10px;
            border: 2px solid #dee2e6;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            font-weight: 500;
            padding: 12px;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .back-link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h4 class="form-title"><i class="bi bi-pencil-square me-2"></i>Edit Data User</h4>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Ubah Foto (opsional)</label>
            <input type="file" class="form-control" id="photo" name="photo">
            <img src="uploads/<?= htmlspecialchars($user['photo']) ?>" alt="Foto User" class="user-photo">
        </div>

        <button type="submit" class="btn btn-warning w-100 mt-3"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
    </form>

    <div class="back-link mt-3">
        <a href="user.php"><i class="bi bi-arrow-left-circle"></i> Kembali ke daftar user</a>
    </div>
</div>

</body>
</html>
