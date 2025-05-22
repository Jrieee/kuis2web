<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0e7ff, #f0f4ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 420px;
        }

        .container img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .button {
            display: inline-block;
            margin: 10px 8px;
            padding: 12px 24px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }

            .container img {
                width: 100px;
                height: 100px;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat datang, <?= htmlspecialchars($user['name']) ?>!</h2>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <img src="uploads/<?= htmlspecialchars($user['photo']) ?>" alt="Foto Profil">

        <div>
            <a href="user.php" class="button">Manajemen User</a>
            <a href="logout.php" class="button">Logout</a>
        </div>
    </div>
</body>
</html>
