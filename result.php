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
   MAIN RECOMMEND QUERY
=============================== */
$sql = "

SELECT
    p.*,
    c.name AS category_name

FROM places p

JOIN categories c
ON p.category_id = c.id

WHERE p.category_id = ?

ORDER BY
    CASE
        WHEN p.suitability_group = ? THEN 0
        ELSE 1
    END,
    COALESCE(p.popularity_score,0) DESC,
    RAND()

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

/* ===============================
   ADDITIONAL RECOMMEND
=============================== */

$extra_sql = "

SELECT
    p.*,
    c.name AS category_name

FROM places p

JOIN categories c
ON p.category_id = c.id

WHERE p.category_id != ?

ORDER BY
    COALESCE(p.popularity_score,0) DESC,
    RAND()

LIMIT 3

";

$extra_stmt = mysqli_prepare($conn, $extra_sql);

mysqli_stmt_bind_param(
    $extra_stmt,
    "i",
    $category_id
);

mysqli_stmt_execute($extra_stmt);

$extra_result = mysqli_stmt_get_result($extra_stmt);

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

                ระบบเลือกสถานที่จาก
                สไตล์การท่องเที่ยว
                และรูปแบบการเดินทางของคุณ

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

<!-- MAIN RECOMMEND -->
<div class="mb-12">

    <div class="flex items-center gap-3 mb-6">

        <div class="w-12 h-12 rounded-2xl
                    bg-emerald-100 text-emerald-600
                    flex items-center justify-center">

            <i class="fa-solid fa-star"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold">
                สถานที่ที่เหมาะกับคุณ
            </h2>

            <p class="text-sm text-gray-500">
                คัดเลือกจากข้อมูลที่กรอกในฟอร์ม
            </p>

        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <?php while ($row = mysqli_fetch_assoc($result)): ?>

    <?php

    /* ===============================
       IMAGE
    =============================== */

    $imagePath = 'images/no-image.jpg';

    if (!empty($row['cover_image'])) {

        $dbImage = trim($row['cover_image']);

        if (strpos($dbImage, 'uploads/') === 0) {

            $fullPath = $dbImage;

        } else {

            $fullPath = 'uploads/' . $dbImage;

        }

        if (file_exists(__DIR__ . '/' . $fullPath)) {

            $imagePath = $fullPath;

        }

    }

    /* ===============================
       TAGS
    =============================== */

    $recommend_tags = [];

    if ($row['category_id'] == $category_id) {

        $recommend_tags[] =
            'ตรงกับสไตล์ที่เลือก';

    }

    if (
        $row['suitability_group']
        == $user_suitability
    ) {

        $recommend_tags[] =
            'เหมาะกับรูปแบบการเดินทาง';

    }

    if (
        (int)$row['popularity_score'] >= 20
    ) {

        $recommend_tags[] =
            'สถานที่ยอดนิยม';

    }

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

            <!-- TAGS -->
            <div class="flex flex-wrap gap-2 mt-4">

            <?php foreach ($recommend_tags as $tag): ?>

                <span
                class="bg-emerald-50
                       text-emerald-700
                       text-xs
                       px-3 py-1
                       rounded-full">

                    <?= htmlspecialchars($tag) ?>

                </span>

            <?php endforeach; ?>

            </div>

        </div>

    </a>

    <?php endwhile; ?>

    </div>

</div>

<!-- EXTRA RECOMMEND -->
<div>

    <div class="flex items-center gap-3 mb-6">

        <div class="w-12 h-12 rounded-2xl
                    bg-orange-100 text-orange-500
                    flex items-center justify-center">

            <i class="fa-solid fa-compass"></i>

        </div>

        <div>

            <h2 class="text-2xl font-bold">
                สถานที่แนะนำเพิ่มเติม
            </h2>

            <p class="text-sm text-gray-500">
                เผื่อคุณอยากลองสถานที่แนวอื่นเพิ่มเติม
            </p>

        </div>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <?php while ($extra = mysqli_fetch_assoc($extra_result)): ?>

    <?php

    $extraImage = 'images/no-image.jpg';

    if (!empty($extra['cover_image'])) {

        $dbImage = trim($extra['cover_image']);

        if (strpos($dbImage, 'uploads/') === 0) {

            $fullPath = $dbImage;

        } else {

            $fullPath = 'uploads/' . $dbImage;

        }

        if (file_exists(__DIR__ . '/' . $fullPath)) {

            $extraImage = $fullPath;

        }

    }

    ?>

    <a href="place.php?id=<?= $extra['id'] ?>"
       class="group block bg-white rounded-3xl
              overflow-hidden shadow-lg
              hover:shadow-2xl hover:-translate-y-1
              transition duration-300">

        <img
        src="<?= htmlspecialchars($extraImage) ?>"
        alt="<?= htmlspecialchars($extra['name']) ?>"
        class="w-full h-64 object-cover bg-gray-200"
        loading="lazy">

        <div class="p-6">

            <span class="bg-orange-50 text-orange-600
                         text-xs px-3 py-1 rounded-full">

                <?= htmlspecialchars($extra['category_name']) ?>

            </span>

            <h2 class="text-2xl font-bold mt-3 mb-2 line-clamp-1">

                <?= htmlspecialchars($extra['name']) ?>

            </h2>

            <div class="flex items-center gap-2
                        text-sm text-gray-500 mb-4">

                <i class="fa-solid fa-location-dot"></i>

                <?= htmlspecialchars($extra['province']) ?>

            </div>

            <p class="text-sm text-gray-600
                      leading-7 line-clamp-3">

                <?= htmlspecialchars($extra['description']) ?>

            </p>

        </div>

    </a>

    <?php endwhile; ?>

    </div>

</div>

<?php endif; ?>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>