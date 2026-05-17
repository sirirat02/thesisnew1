<?php
include 'db.php';

/* ===============================
   GET ID
=============================== */
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die('ไม่พบสถานที่');
}

/* ===============================
   GET PLACE
=============================== */
$sql = "
    SELECT 
        p.*,
        c.name AS category_name
    FROM places p
    JOIN categories c
        ON p.category_id = c.id
    WHERE p.id = ?
    LIMIT 1
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    die('ไม่มีข้อมูลสถานที่');
}

$place = mysqli_fetch_assoc($result);

/* ===============================
   GET IMAGES
=============================== */
$images = $conn->query("
    SELECT *
    FROM place_images
    WHERE place_id = $id
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="th">

<head>

<meta charset="UTF-8">

<title>
    <?= htmlspecialchars($place['name']) ?>
</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">

<!-- NAV -->
<?php
$page_title = $place['name'];
include __DIR__ . '/includes/nav.php';
?>

<main class="max-w-6xl mx-auto px-4 py-8">

    <!-- BACK -->
    <div class="mb-6">

        <a href="javascript:history.back()"
           class="inline-flex items-center gap-2
                  bg-white hover:bg-gray-50
                  border border-gray-200
                  px-4 py-2 rounded-xl
                  text-sm font-medium
                  transition shadow-sm">

            <i class="fa-solid fa-arrow-left"></i>
            กลับ

        </a>

    </div>

    <!-- IMAGE SLIDER -->
    <div class="relative mb-6">

        <div id="slider"
             class="flex overflow-x-auto snap-x snap-mandatory
                    rounded-3xl shadow-lg scroll-smooth
                    scrollbar-hide bg-black">

            <?php if ($images->num_rows > 0): ?>

                <?php while($img = $images->fetch_assoc()): ?>

                    <div class="min-w-full snap-start relative">

                        <img
                        src="uploads/<?= htmlspecialchars($img['image_name']) ?>"
                        class="w-full h-[260px] md:h-[420px]
                               object-cover"
                        alt="">

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="min-w-full">

                    <div class="w-full h-[260px] md:h-[420px]
                                bg-gray-300
                                flex items-center justify-center">

                        <div class="text-center text-gray-600">

                            <i class="fa-regular fa-image text-5xl mb-3"></i>

                            <div>
                                ไม่มีรูปภาพ
                            </div>

                        </div>

                    </div>

                </div>

            <?php endif; ?>

        </div>

        <!-- BUTTON -->
        <button onclick="slidePrev()"
                class="absolute left-3 top-1/2 -translate-y-1/2
                       bg-white/80 hover:bg-white
                       w-10 h-10 rounded-full shadow
                       transition">

            <i class="fa-solid fa-chevron-left"></i>

        </button>

        <button onclick="slideNext()"
                class="absolute right-3 top-1/2 -translate-y-1/2
                       bg-white/80 hover:bg-white
                       w-10 h-10 rounded-full shadow
                       transition">

            <i class="fa-solid fa-chevron-right"></i>

        </button>

    </div>

    <!-- CONTENT -->
    <div class="bg-white rounded-3xl shadow-lg p-6 md:p-8">

        <!-- TITLE -->
        <div class="mb-5">

            <div class="flex flex-wrap gap-2 mb-4">

                <span class="bg-emerald-100 text-emerald-700
                             px-4 py-2 rounded-full text-sm font-medium">

                    <i class="fa-solid fa-location-dot me-1"></i>

                    <?= htmlspecialchars($place['province']) ?>

                </span>

                <span class="bg-gray-100 text-gray-700
                             px-4 py-2 rounded-full text-sm">

                    <?= htmlspecialchars($place['category_name']) ?>

                </span>

            </div>

            <h1 class="text-3xl md:text-4xl font-bold leading-tight">

                <?= htmlspecialchars($place['name']) ?>

            </h1>

        </div>

        <!-- DESCRIPTION -->
        <div class="border-t border-gray-100 pt-6">

            <h2 class="text-xl font-bold mb-4">

                <i class="fa-solid fa-circle-info text-emerald-500"></i>
                รายละเอียดสถานที่

            </h2>

            <div class="text-gray-600 leading-8 text-[15px]">

                <?= nl2br(htmlspecialchars($place['description'])) ?>

            </div>

        </div>

        <!-- INFO SECTION -->
        <div class="border-t border-gray-100 pt-8 mt-8">

            <h2 class="text-xl font-bold mb-6">

                <i class="fa-solid fa-map-location-dot text-emerald-500"></i>
                ข้อมูลเพิ่มเติม

            </h2>

            <div class="grid md:grid-cols-2 gap-5">

                <!-- จังหวัด -->
                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-12 h-12 rounded-xl
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center">

                            <i class="fa-solid fa-location-dot"></i>

                        </div>

                        <div>

                            <div class="text-sm text-gray-400">
                                จังหวัด
                            </div>

                            <div class="font-semibold text-lg">
                                <?= htmlspecialchars($place['province']) ?>
                            </div>

                        </div>

                    </div>

                    <p class="text-sm text-gray-500 leading-6">
                        สถานที่แห่งนี้ตั้งอยู่ในจังหวัด
                        <?= htmlspecialchars($place['province']) ?>
                        ซึ่งเป็นอีกหนึ่งจุดหมายยอดนิยมของนักท่องเที่ยว
                    </p>

                </div>

                <!-- CATEGORY -->
                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-12 h-12 rounded-xl
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center">

                            <i class="fa-solid fa-tag"></i>

                        </div>

                        <div>

                            <div class="text-sm text-gray-400">
                                ประเภทสถานที่
                            </div>

                            <div class="font-semibold text-lg">
                                <?= htmlspecialchars($place['category_name']) ?>
                            </div>

                        </div>

                    </div>

                    <p class="text-sm text-gray-500 leading-6">
                        เหมาะสำหรับผู้ที่ชื่นชอบการท่องเที่ยวแนว
                        <?= htmlspecialchars($place['category_name']) ?>
                        และต้องการสัมผัสบรรยากาศใหม่ ๆ
                    </p>

                </div>

                <!-- PRICE -->
                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-12 h-12 rounded-xl
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center">

                            <i class="fa-solid fa-coins"></i>

                        </div>

                        <div>

                            <div class="text-sm text-gray-400">
                                ค่าใช้จ่ายเริ่มต้น
                            </div>

                            <div class="font-semibold text-lg">

                                <?=
                                !empty($place['min_price'])
                                ? number_format($place['min_price']) . ' บาท'
                                : 'ไม่มีค่าใช้จ่าย'
                                ?>

                            </div>

                        </div>

                    </div>

                    <p class="text-sm text-gray-500 leading-6">
                        เหมาะสำหรับนักท่องเที่ยวที่ต้องการวางแผนงบประมาณล่วงหน้า
                    </p>

                </div>

                <!-- SUITABILITY -->
                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-12 h-12 rounded-xl
                                    bg-emerald-100 text-emerald-600
                                    flex items-center justify-center">

                            <i class="fa-solid fa-users"></i>

                        </div>

                        <div>

                            <div class="text-sm text-gray-400">
                                เหมาะสำหรับ
                            </div>

                            <div class="font-semibold text-lg">

                                <?php
                                $suitability = (int)($place['suitability_group'] ?? 0);

                                switch ($suitability) {

                                    case 1:
                                        echo 'เดินทางคนเดียว';
                                        break;

                                    case 2:
                                        echo 'คู่รัก / กลุ่มเล็ก';
                                        break;

                                    case 3:
                                        echo 'ครอบครัว / กลุ่มใหญ่';
                                        break;

                                    default:
                                        echo 'ทุกคน';
                                        break;
                                }
                                ?>

                            </div>

                        </div>

                    </div>

                    <p class="text-sm text-gray-500 leading-6">
                        ระบบวิเคราะห์ว่าสถานที่แห่งนี้เหมาะกับรูปแบบการเดินทางประเภทนี้มากที่สุด
                    </p>

                </div>

            </div>

        </div>

        <!-- CTA -->
        <div class="border-t border-gray-100 pt-8 mt-8 text-center">

            <h3 class="text-2xl font-bold mb-3">
                พร้อมออกเดินทางแล้วหรือยัง?
            </h3>

            <p class="text-gray-500 mb-6">
                ค้นหาสถานที่อื่น ๆ ที่เหมาะกับงบประมาณและสไตล์ของคุณได้ทันที
            </p>

            <a href="recommend.php"
               class="inline-flex items-center gap-3
                      bg-emerald-500 hover:bg-emerald-600
                      text-white px-6 py-3 rounded-2xl
                      font-semibold transition shadow-lg">

                <i class="fa-solid fa-magnifying-glass"></i>

                ค้นหาสถานที่เพิ่มเติม

            </a>

        </div>

    </div>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script>

const slider = document.getElementById('slider');

let currentIndex = 0;

const slides = slider.children;

/* ===============================
   NEXT
=============================== */
function slideNext(){

    currentIndex++;

    if(currentIndex >= slides.length){
        currentIndex = 0;
    }

    slider.scrollTo({
        left: slider.clientWidth * currentIndex,
        behavior: 'smooth'
    });
}

/* ===============================
   PREV
=============================== */
function slidePrev(){

    currentIndex--;

    if(currentIndex < 0){
        currentIndex = slides.length - 1;
    }

    slider.scrollTo({
        left: slider.clientWidth * currentIndex,
        behavior: 'smooth'
    });
}

</script>

</body>
</html>