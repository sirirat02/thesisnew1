<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Welcome | WebProject</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="overflow-hidden">

<!-- ================= ADMIN LOGIN ================= -->
<!-- <div class="fixed top-5 right-6 z-50 text-white">
<?php if (!isset($_SESSION['user'])): ?>
    <a href="login.php"
       class="flex items-center gap-2 text-sm opacity-80
              hover:opacity-100 hover:text-yellow-400 transition">
        <i class="fa-regular fa-user"></i> Admin Login
    </a>
<?php else: ?>
    <a href="post_add.php"
       class="flex items-center gap-2 text-sm opacity-90
              hover:opacity-100 hover:text-yellow-400 transition">
        <i class="fa-solid fa-user-gear"></i> Admin Panel
    </a>
<?php endif; ?>
</div> -->

<!-- ================= HERO SLIDER ================= -->
<section class="relative h-screen w-screen overflow-hidden">

    <!-- SLIDER -->
    <div id="carousel"
         class="flex h-full transition-transform duration-1000 ease-in-out">

        <?php
        $images = [
            "images/Thailand_Travel_North_Doi-Ang-Khang_Chiang-Mai_1.jpg",
            "images/Thailand_Travel_North_Doi-Inthanon-National-Park_Chiang-Mai_1.jpg",
            "images/Thailand_Travel_North_Doi-Inthanon-National-Park_Chiang-Mai_2.jpg",
            "images/Thailand_Travel_North_Phu-Chi-Fa_Chiang-Rai_3.jpg",
            "images/ThailandTravelNorthjpg.jpg"
        ];
        foreach ($images as $img):
        ?>
        <div class="min-w-full h-full bg-cover bg-center"
             style="background-image:url('<?= $img ?>')">
        </div>
        <?php endforeach; ?>

    </div>

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-center">
        <div class="px-6 max-w-3xl text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                Welcome to Northern Thailand Travel Recommender
            </h1>

            <p class="text-lg text-gray-200 mb-10 leading-relaxed">
                 เที่ยว 5 ดินแดนแห่งภูเขา วัฒนธรรม และธรรมชาติที่งดงาม <br>
                
            </p>

            <a href="index.php"
                class="inline-flex items-center gap-3
                        bg-white/10 text-white
                        border border-white/60
                        backdrop-blur-md
                        px-8 py-4 rounded-full
                        font-semibold text-lg
                        hover:bg-white hover:text-black
                        transition duration-300">
                <i class="fa-solid fa-arrow-right"></i>
                เข้าสู่เว็บไซต์
            </a>
        </div>
    </div>

</section>

<!-- ================= SCRIPT ================= -->
<script>
let index = 0;
const carousel = document.getElementById("carousel");
const total = carousel.children.length;

function slideNext() {
    index = (index + 1) % total;
    carousel.style.transform = `translateX(-${index * 100}%)`;
}

setInterval(slideNext, 5000);
</script>

</body>
</html>
