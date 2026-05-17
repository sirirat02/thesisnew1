<?php
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { die('ไม่พบสถานที่'); }

$sql = "SELECT p.*, c.name AS category_name FROM places p 
        JOIN categories c ON p.category_id = c.id 
        WHERE p.id = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) { die('ไม่มีข้อมูลสถานที่'); }
$place = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($place['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .place-card {
            max-width: 800px;
            margin: 0 auto 40px auto;
            background: white;
            border-radius: 16px; /* ปรับความมนให้เข้ากับปุ่ม Bootstrap */
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #eee;
        }
        .cover-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    
    <div class="max-w-[800px] mx-auto">
        <a href="javascript:history.back()" class="btn btn-outline-secondary mb-4">
            <i class="fa-solid fa-arrow-left"></i> กลับ
        </a>
    </div>

    <article class="place-card">
        <?php if (!empty($place['cover_image'])): ?>
            <img src="uploads/<?= htmlspecialchars($place['cover_image']) ?>" class="cover-img">
        <?php else: ?>
            <div class="cover-img bg-secondary d-flex align-items-center justify-content-center text-white">
                <i class="fa-regular fa-image fa-3x"></i>
            </div>
        <?php endif; ?>

        <div class="p-4 p-md-5">
            <div class="mb-4">
                <h1 class="fw-bold h2 mb-2"><?= htmlspecialchars($place['name']) ?></h1>
                <div class="d-flex gap-2 align-items-center">
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill">
                        <i class="fa-solid fa-location-dot me-1"></i>
                        <?= htmlspecialchars($place['province']) ?>
                    </span>
                    <span class="badge bg-secondary px-3 py-2 rounded-pill">
                        <?= htmlspecialchars($place['category_name']) ?>
                    </span>
                </div>
            </div>

            <hr class="my-4 text-muted opacity-25">

            <div class="row">
                <div class="col-12">
                    <h5 class="fw-bold mb-3">รายละเอียดสถานที่</h5>
                    <p class="text-secondary lh-lg">
                        <?= nl2br(htmlspecialchars($place['description'])) ?>
                    </p>
                </div>
         
        </div>
    </article>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
