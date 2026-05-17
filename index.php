<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Welcome to Northern Thailand</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-800">

<!-- ================= NAVBAR ON HERO ================= -->
<nav class="absolute top-0 left-0 w-full z-20">

  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between text-white">

    <!-- Logo -->
    <div class="text-lg font-bold">
      <img src="images/LogoImage11.png" class="h-20 w-auto">
    </div>

    <!-- MENU -->
    <ul class="hidden md:flex items-center gap-8 font-medium">

      <!-- ABOUT -->
      <li>
        <a href="about.php"
           class="hover:text-yellow-400 transition">
          About
        </a>
      </li>

      <!-- DROPDOWN -->
      <li class="relative group cursor-pointer">

        <span class="hover:text-yellow-400 transition">
          สถานที่ท่องเที่ยว
          <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
        </span>

        <ul class="absolute top-8 left-0 w-44
                  bg-black/90 rounded-lg shadow-lg
                  opacity-0 invisible
                  group-hover:opacity-100
                  group-hover:visible
                  transition-all duration-200">

          <li>
            <a href="chaingmai.php"
               class="block px-4 py-2 hover:bg-white/10">
              เชียงใหม่
            </a>
          </li>

          <li>
            <a href="chiangrai.php"
               class="block px-4 py-2 hover:bg-white/10">
              เชียงราย
            </a>
          </li>

          <li>
            <a href="tak.php"
               class="block px-4 py-2 hover:bg-white/10">
              ตาก
            </a>
          </li>

          <li>
            <a href="phayao.php"
               class="block px-4 py-2 hover:bg-white/10">
              พะเยา
            </a>
          </li>

          <li>
            <a href="maehongson.php"
               class="block px-4 py-2 hover:bg-white/10">
              แม่ฮ่องสอน
            </a>
          </li>

        </ul>
      </li>

      <!-- ================= USER SYSTEM ================= -->

      <?php if (!isset($_SESSION['user'])): ?>

        <!-- ยังไม่ Login -->

        <li>
          <a href="login.php"
             class="inline-flex items-center gap-2
                    border border-white
                    px-5 py-2 rounded-lg
                    text-white font-medium
                    hover:bg-gray-200 hover:text-black
                    transition">

            <i class="fa-solid fa-user"></i>
            Login

          </a>
        </li>

        <li>
          <a href="register.php"
             class="inline-flex items-center gap-2
                    bg-yellow-400 text-black
                    px-5 py-2 rounded-lg
                    font-medium
                    hover:bg-yellow-500
                    transition">

            <i class="fa-solid fa-user-plus"></i>
            Register

          </a>
        </li>

      <?php else: ?>

        <?php

          // ================= USER DATA =================
          $username = $_SESSION['user']['username'] ?? 'User';

          $profile_image = $_SESSION['user']['profile_image'] ?? '';

          $role = $_SESSION['user']['role'] ?? 'user';

          /*
            FIX PATH รูปโปรไฟล์
          */

          if (!empty($profile_image)) {

              // ถ้าเป็นแค่ชื่อไฟล์
              if (
                  !str_contains($profile_image, 'uploads/')
                  &&
                  !str_contains($profile_image, 'http')
              ) {
                  $profile_image = 'uploads/profiles/' . $profile_image;
              }
          }

        ?>

        <!-- USER DROPDOWN -->
        <li class="relative group">

          <button
            class="inline-flex items-center gap-3
                   border border-white
                   px-4 py-2
                   rounded-full
                   text-white font-medium
                   hover:bg-gray-200 hover:text-black
                   transition">

            <!-- PROFILE IMAGE -->
            <?php if (!empty($profile_image)): ?>

              <img
                src="<?= htmlspecialchars($profile_image) ?>"
                alt="Profile"
                class="w-10 h-10 rounded-full object-cover border-2 border-white"

                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
              >

              <!-- fallback icon -->
              <div
                class="w-10 h-10 rounded-full
                       bg-white/20
                       hidden
                       items-center justify-center
                       border border-white">

                <i class="fa-solid fa-user"></i>

              </div>

            <?php else: ?>

              <!-- ถ้าไม่มีรูป -->
              <div
                class="w-10 h-10 rounded-full
                       bg-white/20
                       flex items-center justify-center
                       border border-white">

                <i class="fa-solid fa-user"></i>

              </div>

            <?php endif; ?>

            <!-- USERNAME -->
            <span>
              <?= htmlspecialchars($username) ?>
            </span>

            <i class="fa-solid fa-chevron-down text-xs"></i>

          </button>

          <!-- ================= DROPDOWN MENU ================= -->

          <ul class="absolute right-0 mt-2 w-56
                    bg-black/90 rounded-lg shadow-lg
                    opacity-0 invisible
                    group-hover:opacity-100
                    group-hover:visible
                    transition-all duration-200 overflow-hidden">

            <!-- PROFILE -->
            <li>
              <a href="profile.php"
                 class="block px-4 py-3 hover:bg-white/10">

                <i class="fa-solid fa-user me-2"></i>
                โปรไฟล์ของฉัน

              </a>
            </li>

            <!-- HISTORY -->
            <li>
              <a href="history.php"
                 class="block px-4 py-3 hover:bg-white/10">

                <i class="fa-solid fa-clock-rotate-left me-2"></i>
                ประวัติการค้นหา

              </a>
            </li>

            <!-- ================= ADMIN BUTTON ================= -->

            <?php if ($role === 'admin'): ?>

              <li>
                <a href="admin/places.php"
                   class="block px-4 py-3
                          text-yellow-300
                          hover:bg-yellow-400/20">

                  <i class="fa-solid fa-shield-halved me-2"></i>
                  ระบบผู้ดูแล

                </a>
              </li>

            <?php endif; ?>

            <!-- LOGOUT -->
            <li>
              <a href="logout.php"
                 class="block px-4 py-3
                        text-red-400
                        hover:bg-white/10">

                <i class="fa-solid fa-right-from-bracket me-2"></i>
                Logout

              </a>
            </li>

          </ul>

        </li>

      <?php endif; ?>

    </ul>

  </div>

</nav>

<!-- ================= HERO ================= -->

<section class="relative h-[90vh] bg-cover bg-center"
         style="background-image:url('images/Thailand_Travel_North_Doi-Ang-Khang_Chiang-Mai_1.jpg')">

  <div class="absolute inset-0 bg-black/50"></div>

  <div class="relative z-10 flex h-full flex-col
              items-center justify-center
              text-center text-white px-6">

    <h1 class="text-5xl font-bold mb-4 drop-shadow-lg">
      Welcome to Northern Thailand Travel Recommender
    </h1>

    <p class="text-xl mb-8 text-gray-200">
      เที่ยว 5 ดินแดนแห่งภูเขา วัฒนธรรม และธรรมชาติที่งดงาม
    </p>

    <a href="recommend.php"
       class="inline-flex items-center gap-3
              bg-white/10 text-white
              border border-white/60
              backdrop-blur-md
              px-8 py-4 rounded-full
              font-semibold text-lg
              hover:bg-white hover:text-black
              transition duration-300">

      <i class="fa-solid fa-location-dot"></i>
      เริ่มต้นการเดินทาง

    </a>

  </div>

</section>


<!-- ================= PROVINCES ================= -->

<style>
  /* Animation การ hover */
  .reveal {
    opacity: 0;
    transform: translateY(60px);
    transition: all 0.9s ease;
  }

  .reveal.active {
    opacity: 1;
    transform: translateY(0);
  }

  /* delay */
  .delay-1 { transition-delay: 0.1s; }
  .delay-2 { transition-delay: 0.2s; }
  .delay-3 { transition-delay: 0.3s; }
  .delay-4 { transition-delay: 0.4s; }
  .delay-5 { transition-delay: 0.5s; }
</style>

<section id="provinces"
         class="py-20 bg-gradient-to-b from-emerald-50 via-white to-emerald-100">

  <div class="max-w-7xl mx-auto px-6">

    <!-- TITLE -->
    <div class="text-center mb-14 reveal">

      <span class="inline-block bg-emerald-100 text-emerald-700
                   px-4 py-2 rounded-full text-sm font-semibold mb-4">

        ✨ จังหวัดแนะนำ

      </span>

      <h2 class="text-4xl font-bold text-gray-800 mb-4">
        5 จังหวัดภาคเหนือที่น่าเที่ยว
      </h2>

      <p class="text-gray-600 max-w-2xl mx-auto">
        สัมผัสธรรมชาติ วัฒนธรรม และเสน่ห์ล้านนา
        ผ่านจังหวัดยอดนิยมของภาคเหนือประเทศไทย
      </p>

    </div>

    <!-- CARDS -->
    <div class="flex flex-wrap justify-center gap-8">

      <!-- Chiang Mai -->
      <a href="chaingmai.php"
         class="reveal delay-1 group w-full sm:w-[47%] lg:w-[30%]
                bg-white rounded-3xl overflow-hidden
                shadow-md hover:shadow-2xl
                transition duration-300
                hover:-translate-y-2">

        <div class="relative overflow-hidden">

          <img src="images/chiangmai.jpg"
               class="h-60 w-full object-cover
                      group-hover:scale-105 transition duration-500">

          <div class="absolute inset-0 bg-gradient-to-t
                      from-black/60 to-transparent"></div>

          <div class="absolute bottom-4 left-4 text-white">

            <h3 class="text-2xl font-bold">
              เชียงใหม่
            </h3>

            <p class="text-sm text-gray-200 mt-1">
              เมืองแห่งวัฒนธรรม คาเฟ่ และภูเขา
            </p>

          </div>

        </div>

        <div class="p-6 text-center">

          <div class="flex items-center justify-center gap-2
                      text-emerald-600 mb-4 text-sm font-medium">

            <i class="fa-solid fa-location-dot"></i>
            จังหวัดยอดนิยมของภาคเหนือ

          </div>

          <button
            class="inline-flex items-center justify-center gap-3
                   bg-emerald-500 hover:bg-emerald-600
                   text-white px-6 py-3 rounded-xl
                   font-semibold transition">

            ดูสถานที่ท่องเที่ยว
            <i class="fa-solid fa-arrow-right"></i>

          </button>

        </div>

      </a>

      <!-- Chiang Rai -->
      <a href="chiangrai.php"
         class="reveal delay-2 group w-full sm:w-[47%] lg:w-[30%]
                bg-white rounded-3xl overflow-hidden
                shadow-md hover:shadow-2xl
                transition duration-300
                hover:-translate-y-2">

        <div class="relative overflow-hidden">

          <img src="images/chiangrai.webp"
               class="h-60 w-full object-cover
                      group-hover:scale-105 transition duration-500">

          <div class="absolute inset-0 bg-gradient-to-t
                      from-black/60 to-transparent"></div>

          <div class="absolute bottom-4 left-4 text-white">

            <h3 class="text-2xl font-bold">
              เชียงราย
            </h3>

            <p class="text-sm text-gray-200 mt-1">
              ดินแดนศิลปะ วัดสวย และสายหมอก
            </p>

          </div>

        </div>

        <div class="p-6 text-center">

          <div class="flex items-center justify-center gap-2
                      text-emerald-600 mb-4 text-sm font-medium">

            <i class="fa-solid fa-location-dot"></i>
            เมืองศิลปะและธรรมชาติ

          </div>

          <button
            class="inline-flex items-center justify-center gap-3
                   bg-emerald-500 hover:bg-emerald-600
                   text-white px-6 py-3 rounded-xl
                   font-semibold transition">

            ดูสถานที่ท่องเที่ยว
            <i class="fa-solid fa-arrow-right"></i>

          </button>

        </div>

      </a>

      <!-- Phayao -->
      <a href="phayao.php"
         class="reveal delay-3 group w-full sm:w-[47%] lg:w-[30%]
                bg-white rounded-3xl overflow-hidden
                shadow-md hover:shadow-2xl
                transition duration-300
                hover:-translate-y-2">

        <div class="relative overflow-hidden">

          <img src="images/phayao.jpg"
               class="h-60 w-full object-cover
                      group-hover:scale-105 transition duration-500">

          <div class="absolute inset-0 bg-gradient-to-t
                      from-black/60 to-transparent"></div>

          <div class="absolute bottom-4 left-4 text-white">

            <h3 class="text-2xl font-bold">
              พะเยา
            </h3>

            <p class="text-sm text-gray-200 mt-1">
              เมืองสงบริมกว๊านพะเยา
            </p>

          </div>

        </div>

        <div class="p-6 text-center">

          <div class="flex items-center justify-center gap-2
                      text-emerald-600 mb-4 text-sm font-medium">

            <i class="fa-solid fa-location-dot"></i>
            เมืองสโลว์ไลฟ์ภาคเหนือ

          </div>

          <button
            class="inline-flex items-center justify-center gap-3
                   bg-emerald-500 hover:bg-emerald-600
                   text-white px-6 py-3 rounded-xl
                   font-semibold transition">

            ดูสถานที่ท่องเที่ยว
            <i class="fa-solid fa-arrow-right"></i>

          </button>

        </div>

      </a>

      <!-- Mae Hong Son -->
      <a href="maehongson.php"
         class="reveal delay-4 group w-full sm:w-[47%] lg:w-[30%]
                bg-white rounded-3xl overflow-hidden
                shadow-md hover:shadow-2xl
                transition duration-300
                hover:-translate-y-2">

        <div class="relative overflow-hidden">

          <img src="images/maehongson.webp"
               class="h-60 w-full object-cover
                      group-hover:scale-105 transition duration-500">

          <div class="absolute inset-0 bg-gradient-to-t
                      from-black/60 to-transparent"></div>

          <div class="absolute bottom-4 left-4 text-white">

            <h3 class="text-2xl font-bold">
              แม่ฮ่องสอน
            </h3>

            <p class="text-sm text-gray-200 mt-1">
              เมืองกลางหุบเขา วิถีชีวิตเรียบง่าย
            </p>

          </div>

        </div>

        <div class="p-6 text-center">

          <div class="flex items-center justify-center gap-2
                      text-emerald-600 mb-4 text-sm font-medium">

            <i class="fa-solid fa-location-dot"></i>
            ธรรมชาติและวัฒนธรรม

          </div>

          <button
            class="inline-flex items-center justify-center gap-3
                   bg-emerald-500 hover:bg-emerald-600
                   text-white px-6 py-3 rounded-xl
                   font-semibold transition">

            ดูสถานที่ท่องเที่ยว
            <i class="fa-solid fa-arrow-right"></i>

          </button>

        </div>

      </a>

      <!-- Tak -->
      <a href="tak.php"
         class="reveal delay-5 group w-full sm:w-[47%] lg:w-[30%]
                bg-white rounded-3xl overflow-hidden
                shadow-md hover:shadow-2xl
                transition duration-300
                hover:-translate-y-2">

        <div class="relative overflow-hidden">

          <img src="images/tak.jpg"
               class="h-60 w-full object-cover
                      group-hover:scale-105 transition duration-500">

          <div class="absolute inset-0 bg-gradient-to-t
                      from-black/60 to-transparent"></div>

          <div class="absolute bottom-4 left-4 text-white">

            <h3 class="text-2xl font-bold">
              ตาก
            </h3>

            <p class="text-sm text-gray-200 mt-1">
              ธรรมชาติ น้ำตก และป่าเขา
            </p>

          </div>

        </div>

        <div class="p-6 text-center">

          <div class="flex items-center justify-center gap-2
                      text-emerald-600 mb-4 text-sm font-medium">

            <i class="fa-solid fa-location-dot"></i>
            สายธรรมชาติห้ามพลาด

          </div>

          <button
            class="inline-flex items-center justify-center gap-3
                   bg-emerald-500 hover:bg-emerald-600
                   text-white px-6 py-3 rounded-xl
                   font-semibold transition">

            ดูสถานที่ท่องเที่ยว
            <i class="fa-solid fa-arrow-right"></i>

          </button>

        </div>

      </a>

    </div>

  </div>

</section>

<!-- ================= STORIES ================= -->

<section class="py-20 bg-white">

  <div class="max-w-7xl mx-auto px-6">

    <div class="text-center mb-12 reveal">

      <h2 class="text-4xl font-bold text-gray-800 mb-4">
        เรื่องเล่าน่ารู้ภาคเหนือ
      </h2>

      <p class="text-gray-600">
        เกร็ดเล็ก ๆ ที่ทำให้การเดินทางมีความหมายมากขึ้น
      </p>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- STORY -->
      <a href="stories/cafe-chiangmai.php"
         class="reveal delay-1 bg-emerald-50 hover:bg-emerald-100
                rounded-3xl p-8
                transition duration-300
                shadow-sm hover:shadow-lg">

        <div class="text-emerald-600 text-3xl mb-4">
          <i class="fa-solid fa-mug-hot"></i>
        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-3">
          วัฒนธรรมคาเฟ่เชียงใหม่
        </h3>

        <p class="text-gray-600">
          เพราะจังหวะชีวิตที่ช้าลง
          กาแฟจึงกลายเป็นส่วนหนึ่งของวัน
        </p>

      </a>

      <!-- STORY -->
      <a href="stories/sea-of-fog.php"
         class="reveal delay-2 bg-emerald-50 hover:bg-emerald-100
                rounded-3xl p-8
                transition duration-300
                shadow-sm hover:shadow-lg">

        <div class="text-emerald-600 text-3xl mb-4">
          <i class="fa-solid fa-cloud"></i>
        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-3">
          ทำไมถึงมีทะเลหมอก ?
        </h3>

        <p class="text-gray-600">
          ภูเขา ความชื้น และอากาศเย็น
          คือเสน่ห์ของธรรมชาติภาคเหนือ
        </p>

      </a>

      <!-- STORY -->
      <a href="stories/lanna-culture.php"
         class="reveal delay-3 bg-emerald-50 hover:bg-emerald-100
                rounded-3xl p-8
                transition duration-300
                shadow-sm hover:shadow-lg">

        <div class="text-emerald-600 text-3xl mb-4">
          <i class="fa-solid fa-landmark"></i>
        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-3">
          เสน่ห์วัดล้านนา
        </h3>

        <p class="text-gray-600">
          ความเรียบง่ายที่ซ่อนความงดงาม
          และวัฒนธรรมอันลึกซึ้ง
        </p>

      </a>

    </div>

  </div>

</section>

<!-- ================= SCRIPT ================= -->

<script>
  const reveals = document.querySelectorAll('.reveal');

  function revealOnScroll() {

    reveals.forEach((element) => {

      const windowHeight = window.innerHeight;
      const elementTop = element.getBoundingClientRect().top;

      if (elementTop < windowHeight - 100) {
        element.classList.add('active');
      }

    });

  }

  window.addEventListener('scroll', revealOnScroll);

  revealOnScroll();
</script>



<!-- ================= FOOTER ================= -->

<footer class="bg-emerald-700 text-white py-10 text-center">

  <p class="text-lg font-semibold">
     Tourism Recommendation System
  </p>

  <p class="text-sm text-emerald-100 mt-2">
    Discover • Travel • Experience
  </p>

</footer>

</body>
</html>