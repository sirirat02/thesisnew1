<?php
session_start();
include 'db.php';

/* ===============================
   GET PARAMS
=============================== */
$category_id = isset($_GET['category'])
    ? (int)$_GET['category']
    : 0;

$group_size = isset($_GET['group_size'])
    ? max((int)$_GET['group_size'], 1)
    : 1;

$days = isset($_GET['days'])
    ? max((int)$_GET['days'], 1)
    : 1;

/* ===============================
   SUITABILITY
=============================== */
if ($group_size >= 5) {
    $user_suitability = 'Group';
} elseif ($group_size >= 2) {
    $user_suitability = 'Couple';
} else {
    $user_suitability = 'Single';
}

/* ===============================
   LIMIT
=============================== */
$limit = min($days * 3, 12);

/* ===============================
   QUERY
=============================== */
$sql = "
SELECT
    p.*,
    c.name AS category_name,

    (
        (CASE
            WHEN p.category_id = ? THEN 50
            ELSE 0
        END)

        +

        (CASE
            WHEN p.suitability_group = ? THEN 25
            ELSE 0
        END)

        +

        COALESCE(p.popularity_score,0)

    ) AS matching_score

FROM places p

JOIN categories c
ON p.category_id = c.id

ORDER BY matching_score DESC

LIMIT ?
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "isi",
    $category_id,
    $user_suitability,
    $limit
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$num_rows = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="th">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
ผลลัพธ์แนะนำสถานที่ท่องเที่ยว
</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
.line-clamp-1{
    overflow:hidden;
    display:-webkit-box;
    -webkit-line-clamp:1;
    -webkit-box-orient:vertical;
}

.line-clamp-3{
    overflow:hidden;
    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
}
</style>

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

<?php
$page_title = 'ผลลัพธ์แนะนำสถานที่';
include __DIR__ . '/includes/nav.php';
?>

<main class="flex-1 w-full max-w-7xl mx-auto px-6 py-10">

<?php if ($num_rows == 0): ?>

<div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-lg p-10 text-center">

    <div class="w-24 h-24 bg-gray-100 rounded-full
                flex items-center justify-center
                mx-auto mb-6">

        <i class="fa-regular fa-face-sad-tear text-4xl text-gray-400"></i>

    </div>

    <h2 class="text-3xl font-bold mb-4">
        ไม่พบสถานที่
    </h2>

    <p class="text-gray-500 leading-8 mb-8">
        ลองเปลี่ยนหมวดหมู่ หรือค้นหาใหม่อีกครั้ง
    </p>

    <a href="recommend.php"
       class="inline-flex items-center gap-2
              bg-emerald-500 hover:bg-emerald-600
              text-white px-6 py-3 rounded-xl
              font-medium transition">

        <i class="fa-solid fa-arrow-rotate-left"></i>
        ค้นหาใหม่

    </a>

</div>

<?php else: ?>

<!-- HEADER -->
<div class="bg-white rounded-3xl shadow p-6 mb-8">

    <div class="flex flex-wrap justify-between items-center gap-5">

        <div>

            <h1 class="text-2xl font-bold mb-2">

                <i class="fa-solid fa-location-dot text-emerald-500"></i>
                สถานที่แนะนำสำหรับคุณ

            </h1>

            <p class="text-gray-500 text-sm">

                พบทั้งหมด
                <?= $num_rows ?>
                สถานที่แนะนำ

            </p>

        </div>

        <a href="recommend.php"
           class="bg-emerald-500 hover:bg-emerald-600
                  text-white px-5 py-3 rounded-xl
                  font-medium transition">

            <i class="fa-solid fa-magnifying-glass"></i>
            ค้นหาใหม่

        </a>

    </div>

</div>

<!-- GRID -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

<?php while ($row = mysqli_fetch_assoc($result)): ?>

<?php

/* ===============================
   IMAGE PATH FIX
=============================== */

$imagePath = 'images/no-image.jpg';

if (!empty($row['cover_image'])) {

    $dbImage = trim($row['cover_image']);

    // ถ้ามี uploads/ อยู่แล้ว
    if (
        strpos($dbImage, 'uploads/') === 0
    ) {

        $fullPath = $dbImage;

    } else {

        $fullPath = 'uploads/' . $dbImage;

    }

    // เช็คว่าไฟล์มีจริงไหม
    if (file_exists(__DIR__ . '/' . $fullPath)) {
        $imagePath = $fullPath;
    }
}

/* ===============================
   MATCH %
=============================== */

$match_percent = min(
    round(($row['matching_score'] / 85) * 100),
    100
);

?>

<a href="place.php?id=<?= $row['id'] ?>"
   class="group block bg-white rounded-3xl
          overflow-hidden shadow-lg
          hover:shadow-2xl hover:-translate-y-1
          transition duration-300">

    <!-- IMAGE -->
    <div class="relative overflow-hidden">

        <img
        src="<?= htmlspecialchars($imagePath) ?>"
        alt="<?= htmlspecialchars($row['name']) ?>"
        class="w-full h-64 object-cover bg-gray-200"
        loading="lazy">

        <!-- OVERLAY -->
        <div class="absolute inset-0
                    bg-gradient-to-t
                    from-black/60
                    via-black/10
                    to-transparent
                    opacity-0
                    group-hover:opacity-100
                    transition duration-300">
        </div>

        <!-- MATCH -->
        <div class="absolute top-4 left-4">

            <div class="bg-emerald-500 text-white
                        text-xs font-bold
                        px-3 py-1 rounded-full shadow">

                MATCH <?= $match_percent ?>%

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="p-6">

        <!-- CATEGORY -->
        <div class="mb-3">

            <span class="bg-emerald-50 text-emerald-700
                         text-xs px-3 py-1 rounded-full">

                <?= htmlspecialchars($row['category_name']) ?>

            </span>

        </div>

        <!-- TITLE -->
        <h2 class="text-2xl font-bold mb-2 line-clamp-1">

            <?= htmlspecialchars($row['name']) ?>

        </h2>

        <!-- LOCATION -->
        <div class="flex items-center gap-2
                    text-sm text-gray-500 mb-4">

            <i class="fa-solid fa-location-dot"></i>

            <?= htmlspecialchars($row['province']) ?>

        </div>

        <!-- DESCRIPTION -->
        <p class="text-sm text-gray-600
                  leading-7 line-clamp-3">

            <?= htmlspecialchars($row['description']) ?>

        </p>

    </div>

</a>

<?php endwhile; ?>

</div>

<?php endif; ?>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>