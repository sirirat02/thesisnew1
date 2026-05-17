<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>About Us | Northern Thailand Travel Recommendation</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="relative min-h-screen bg-cover bg-center bg-no-repeat"
      style="background-image: url('images/ThailandTravelNorthjpg.jpg');">

<!-- ================= OVERLAY ================= -->
<div class="absolute inset-0 bg-gradient-to-b
            from-black/70
            via-emerald-950/70
            to-emerald-950/90">
</div>

<!-- ================= CONTENT WRAPPER ================= -->
<div class="relative z-10">

<!-- ================= NAVBAR ================= -->
<nav class="bg-emerald-950/70 backdrop-blur-md border-b border-white/10">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center">

        <!-- BACK -->
        <button onclick="history.back()"
                class="flex items-center gap-2
                       text-white text-sm
                       hover:text-emerald-300
                       transition">

            <i class="fa-solid fa-arrow-left"></i>
            กลับ

        </button>

        <!-- TITLE -->
        <h1 class="mx-auto text-lg font-semibold tracking-wide text-white">
            About Website
        </h1>

    </div>

</nav>

<!-- ================= HERO ================= -->
<section class="pt-20 pb-14 max-w-4xl mx-auto px-6 text-center text-white">

    <span class="inline-flex items-center gap-2
                 bg-white/10 backdrop-blur-md
                 border border-white/20
                 px-5 py-2 rounded-full
                 text-sm font-medium mb-6">

        <i class="fa-solid fa-earth-asia text-emerald-300"></i>
        Northern Thailand Travel

    </span>

    <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-6">

        ระบบแนะนำการท่องเที่ยว
        <span class="block text-emerald-300 mt-2">
            ภาคเหนือประเทศไทย
        </span>

    </h2>

    <p class="text-gray-200 text-lg leading-8 max-w-3xl mx-auto">

        เว็บไซต์นี้ถูกพัฒนาขึ้นเพื่อช่วยให้ผู้ใช้งาน
        สามารถค้นหาสถานที่ท่องเที่ยวในภาคเหนือได้ง่ายขึ้น
        พร้อมรวมข้อมูลสถานที่สำคัญ คาเฟ่ จุดชมวิว
        และแหล่งท่องเที่ยวธรรมชาติไว้ในที่เดียว

    </p>

</section>

<!-- ================= ABOUT ================= -->
<section class="max-w-5xl mx-auto px-6 mb-10">

    <div class="bg-white/95 backdrop-blur-md
                rounded-3xl
                shadow-2xl
                p-8 md:p-10">

        <div class="flex items-center gap-4 mb-6">

            <div class="w-14 h-14 rounded-2xl
                        bg-emerald-500 text-white
                        flex items-center justify-center shadow-lg">

                <i class="fa-solid fa-circle-info text-xl"></i>

            </div>

            <div>

                <h3 class="text-2xl font-bold text-gray-800">
                    เกี่ยวกับเว็บไซต์
                </h3>

                <p class="text-gray-500 text-sm">
                    About Northern Thailand Recommendation
                </p>

            </div>

        </div>

        <div class="space-y-5 text-gray-700 leading-8">

            <p>
                ระบบแนะนำการท่องเที่ยวนี้จัดทำขึ้นเพื่อรวบรวมข้อมูล
                สถานที่ท่องเที่ยวในภาคเหนือของประเทศไทย
                ให้ผู้ใช้งานสามารถเลือกค้นหา
                และดูข้อมูลสถานที่ที่น่าสนใจได้สะดวกมากยิ่งขึ้น
            </p>

            <p>
                ภายในเว็บไซต์มีการรวบรวมข้อมูลสถานที่ท่องเที่ยว
                จากหลายจังหวัด เช่น เชียงใหม่ เชียงราย พะเยา
                แม่ฮ่องสอน และตาก
                ทั้งในรูปแบบธรรมชาติ วัด คาเฟ่
                และสถานที่ยอดนิยมต่าง ๆ
            </p>

            <p>
                เว็บไซต์ถูกออกแบบให้ใช้งานง่าย
                เพื่อช่วยให้ผู้ใช้งานสามารถวางแผนการเดินทาง
                และค้นหาสถานที่ที่เหมาะกับความสนใจของตนเองได้รวดเร็วขึ้น
            </p>

        </div>

    </div>

</section>

<!-- ================= DETAILS ================= -->
<section class="max-w-5xl mx-auto px-6 pb-20">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- CARD -->
        <div class="bg-white/95 backdrop-blur-md
                    rounded-3xl p-7 shadow-xl">

            <div class="w-14 h-14 rounded-2xl
                        bg-emerald-500 text-white
                        flex items-center justify-center
                        shadow-lg mb-5">

                <i class="fa-solid fa-location-dot text-xl"></i>

            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-3">
                ค้นหาสถานที่ท่องเที่ยว
            </h3>

            <p class="text-gray-600 leading-7">
                รวมข้อมูลสถานที่ท่องเที่ยวชื่อดังในภาคเหนือ
                ทั้งภูเขา จุดชมวิว วัด และธรรมชาติ
                เพื่อให้ผู้ใช้งานสามารถค้นหาได้ง่ายขึ้น
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white/95 backdrop-blur-md
                    rounded-3xl p-7 shadow-xl">

            <div class="w-14 h-14 rounded-2xl
                        bg-orange-500 text-white
                        flex items-center justify-center
                        shadow-lg mb-5">

                <i class="fa-solid fa-camera text-xl"></i>

            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-3">
                คาเฟ่และจุดเช็กอิน
            </h3>

            <p class="text-gray-600 leading-7">
                แนะนำคาเฟ่ยอดนิยม
                และสถานที่ถ่ายรูปสวย ๆ
                ที่เหมาะสำหรับการพักผ่อนและท่องเที่ยว
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white/95 backdrop-blur-md
                    rounded-3xl p-7 shadow-xl">

            <div class="w-14 h-14 rounded-2xl
                        bg-cyan-500 text-white
                        flex items-center justify-center
                        shadow-lg mb-5">

                <i class="fa-solid fa-route text-xl"></i>

            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-3">
                วางแผนการเดินทาง
            </h3>

            <p class="text-gray-600 leading-7">
                ช่วยให้ผู้ใช้งานสามารถเลือกสถานที่ท่องเที่ยว
                และวางแผนการเดินทางได้สะดวกมากยิ่งขึ้น
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white/95 backdrop-blur-md
                    rounded-3xl p-7 shadow-xl">

            <div class="w-14 h-14 rounded-2xl
                        bg-amber-500 text-white
                        flex items-center justify-center
                        shadow-lg mb-5">

                <i class="fa-solid fa-book-open text-xl"></i>

            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-3">
                เรื่องราวภาคเหนือ
            </h3>

            <p class="text-gray-600 leading-7">
                รวมบทความและเรื่องราวเกี่ยวกับวัฒนธรรม
                ธรรมชาติ และเสน่ห์ของภาคเหนือประเทศไทย
            </p>

        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-emerald-950/80 backdrop-blur-md
               border-t border-white/10
               text-gray-300 py-10 text-center">

    <h3 class="text-2xl font-bold text-white mb-3">
        Northern Thailand Travel
    </h3>

    <p class="text-emerald-200 mb-5">
        Discover • Plan • Travel
    </p>

    <div class="flex justify-center gap-5 text-lg mb-5">

        <a href="#" class="hover:text-emerald-300 transition">
            <i class="fa-brands fa-facebook"></i>
        </a>

        <a href="#" class="hover:text-emerald-300 transition">
            <i class="fa-brands fa-instagram"></i>
        </a>

        <a href="#" class="hover:text-emerald-300 transition">
            <i class="fa-brands fa-youtube"></i>
        </a>

    </div>

    <p class="text-sm text-gray-400">
        © <?= date('Y') ?> Northern Thailand Travel Recommendation
    </p>

</footer>

</div>
</body>
</html>