<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>คาเฟ่เชียงใหม่ ทำไมถึงมีเสน่ห์</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gradient-to-b from-blue-50 via-white to-blue-100 text-gray-800">

<!-- ================= HERO ================= -->
<section class="relative h-[55vh] bg-cover bg-center"
         style="background-image:url('images/cafe_chiangmai.jpg')">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- CONTENT -->
    <div class="relative z-10 h-full flex items-center justify-center text-center px-6">

        <div>

            <span class="inline-block bg-blue-500/90 text-white
                         px-5 py-2 rounded-full text-sm font-semibold mb-5">

                ☕ เรื่องเล่าภาคเหนือ

            </span>

            <h1 class="text-white text-4xl md:text-5xl font-bold mb-4">
                คาเฟ่เชียงใหม่
            </h1>

            <p class="text-gray-200 text-lg max-w-2xl mx-auto leading-relaxed">
                เพราะบางครั้ง “กาแฟ”
                ก็เป็นมากกว่าเครื่องดื่ม
                แต่คือช่วงเวลาที่ได้พักใจ
            </p>

        </div>

    </div>

</section>

<!-- ================= CONTENT ================= -->
<section class="max-w-5xl mx-auto px-6 pb-16 -mt-16 relative z-20">

    <div class="bg-white/95 backdrop-blur-sm
                rounded-3xl shadow-xl overflow-hidden border border-blue-100">

        <!-- HEADER -->
        <div class="bg-blue-50 border-b border-blue-100 px-8 py-6">

            <h2 class="text-2xl font-bold text-blue-700">
                เสน่ห์ของคาเฟ่เชียงใหม่
            </h2>

            <p class="text-gray-600 mt-2">
                พื้นที่เล็ก ๆ ที่เต็มไปด้วยธรรมชาติ ศิลปะ และวิถีชีวิตเรียบง่าย
            </p>

        </div>

        <!-- BODY -->
        <div class="p-8 md:p-10">

            <p class="text-gray-600 leading-relaxed text-lg mb-8">
                คาเฟ่เชียงใหม่ไม่ได้เป็นแค่ร้านกาแฟ
                แต่คือพื้นที่พักใจ ที่ผสมผสานธรรมชาติ
                ศิลปะ และวิถีชีวิตช้า ๆ เข้าด้วยกัน
                หลายร้านถูกออกแบบให้กลมกลืนกับต้นไม้ ภูเขา
                และบรรยากาศเงียบสงบของเมืองเหนือ
            </p>

            <!-- IMAGES -->
            <div class="grid md:grid-cols-2 gap-6 my-10">

                <img src="images/MooH11.jpg"
                     class="rounded-2xl h-72 w-full object-cover shadow-md hover:scale-[1.02] transition duration-300"
                     alt="">

                <img src="images/see-you-soon.jpg"
                     class="rounded-2xl h-72 w-full object-cover shadow-md hover:scale-[1.02] transition duration-300"
                     alt="">

            </div>

            <!-- TITLE -->
            <div class="mb-6">

                <span class="inline-block bg-blue-100 text-blue-700
                             px-4 py-2 rounded-full text-sm font-semibold mb-4">

                     เอกลักษณ์ของเชียงใหม่

                </span>

                <h2 class="text-3xl font-bold text-gray-800">
                    ทำไมคาเฟ่เชียงใหม่ถึงไม่เหมือนที่อื่น
                </h2>

            </div>

            <!-- LIST -->
            <div class="grid md:grid-cols-3 gap-5 mb-10">

                <!-- ITEM -->
                <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100">

                    <div class="text-blue-600 text-2xl mb-4">
                        <i class="fa-solid fa-mountain-sun"></i>
                    </div>

                    <h3 class="font-semibold text-lg mb-2">
                        ธรรมชาติรอบตัว
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        คาเฟ่หลายแห่งตั้งอยู่ท่ามกลางภูเขา
                        ป่าไม้ และทุ่งนา
                        ให้ความรู้สึกสงบและผ่อนคลาย
                    </p>

                </div>

                <!-- ITEM -->
                <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100">

                    <div class="text-blue-600 text-2xl mb-4">
                        <i class="fa-solid fa-palette"></i>
                    </div>

                    <h3 class="font-semibold text-lg mb-2">
                        งานออกแบบมีเอกลักษณ์
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        การตกแต่งเน้นความเรียบง่าย
                        ใช้วัสดุธรรมชาติ
                        และสร้างบรรยากาศอบอุ่นสไตล์ล้านนา
                    </p>

                </div>

                <!-- ITEM -->
                <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100">

                    <div class="text-blue-600 text-2xl mb-4">
                        <i class="fa-solid fa-mug-hot"></i>
                    </div>

                    <h3 class="font-semibold text-lg mb-2">
                        จังหวะชีวิตที่ช้าลง
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed">
                        ผู้คนไม่เร่งรีบ
                        ทำให้การนั่งจิบกาแฟ
                        กลายเป็นช่วงเวลาที่มีความหมาย
                    </p>

                </div>

            </div>

            <!-- QUOTE -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600
                        text-white rounded-3xl p-8 text-center shadow-lg">

                <p class="text-xl md:text-2xl font-light leading-relaxed">
                    “บางร้านไม่ได้ขายแค่กาแฟ
                    แต่ขายความรู้สึกที่อยากกลับมาอีกครั้ง”
                </p>

            </div>

            <!-- BACK BUTTON -->
            <div class="text-center mt-10">

                <a href="../index.php"
                   class="inline-flex items-center gap-3
                          bg-blue-500 hover:bg-blue-600
                          text-white px-8 py-4
                          rounded-2xl font-semibold
                          transition shadow-lg">

                    <i class="fa-solid fa-arrow-left"></i>
                    กลับหน้าแรก

                </a>

            </div>

        </div>

    </div>

</section>

</body>
</html>