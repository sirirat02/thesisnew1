<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ทำไมถึงมีทะเลหมอก</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-emerald-50 text-gray-800">

<!-- ================= HERO IMAGE ================= -->
<section class="relative h-[50vh] bg-cover bg-center"
 style="background-image:url('images/sea_of_fog.webp')">

  <!-- overlay -->
  <div class="absolute inset-0 bg-emerald-950/60"></div>

  <div class="relative z-10 h-full flex items-center justify-center text-center px-6">

    <div>

      <span class="inline-block bg-emerald-500/90
                   text-white px-5 py-2 rounded-full
                   text-sm font-medium mb-5 shadow-lg">

        เรื่องเล่าธรรมชาติภาคเหนือ

      </span>

      <h1 class="text-4xl md:text-5xl font-bold text-white drop-shadow-lg">
        ทำไมถึงมีทะเลหมอก ?
      </h1>

    </div>

  </div>

</section>

<!-- ================= CONTENT ================= -->
<section class="max-w-4xl mx-auto px-6 py-16
                bg-white shadow-xl
                -mt-20 rounded-[2rem]
                relative z-10
                border border-emerald-100">

  <p class="text-gray-700 mb-6 leading-relaxed text-lg">
    ทะเลหมอก คือหนึ่งในภาพธรรมชาติที่หลายคนหลงรัก
    โดยเฉพาะในภาคเหนือของประเทศไทย
    ที่สามารถพบเห็นได้บ่อย
    ในช่วงเช้าตรู่ของฤดูหนาวและฤดูฝน
  </p>

  <p class="text-gray-700 mb-6 leading-relaxed">
    ทะเลหมอกเกิดจากการรวมตัวของความชื้นในอากาศ
    เมื่ออุณหภูมิลดลงในช่วงเช้า
    โดยเฉพาะในพื้นที่ภูเขาสูง
    ความชื้นจะควบแน่นกลายเป็นละอองหมอกลอยต่ำ
    ปกคลุมหุบเขาราวกับทะเลสีขาว
  </p>

  <!-- IMAGE -->
  <img src="images/h.jpg"
       class="rounded-3xl my-8 w-full h-[420px]
              object-cover shadow-md"
       alt="ทะเลหมอกยามเช้า">

  <p class="text-gray-700 mb-8 leading-relaxed">
    ภาคเหนือมีทั้งภูเขา ความชื้น และอากาศเย็น
    จึงเป็นพื้นที่ที่เหมาะกับการเกิดทะเลหมอกมากที่สุด
    ภาพที่เห็นไม่ใช่เรื่องบังเอิญ
    แต่คือผลลัพธ์ของธรรมชาติที่ทำงานร่วมกันอย่างสมดุล
  </p>

  <!-- ================= INFO BOX ================= -->
  <div class="bg-emerald-50
              border-l-4 border-emerald-500
              p-6 rounded-2xl mb-8">

    <h3 class="font-bold text-emerald-700 mb-3 text-lg">
      📌 รู้ไว้ก่อนออกเดินทาง
    </h3>

    <ul class="text-gray-700 space-y-2 leading-relaxed">

      <li>• เวลาที่เหมาะที่สุด: 05:30 – 07:00 น.</li>

      <li>• ฤดูที่พบได้บ่อย: พ.ย. – ก.พ.</li>

      <li>• จุดยอดนิยม: ดอยอินทนนท์, ภูทับเบิก, ดอยอ่างขาง</li>

    </ul>

  </div>

  <!-- BUTTON -->
  <div class="mt-10">

    <a href="../index.php"
       class="inline-flex items-center gap-3
              bg-emerald-500 hover:bg-emerald-600
              text-white px-8 py-4
              rounded-full font-semibold text-lg
              transition shadow-lg">

      <i class="fa-solid fa-arrow-left"></i>
      กลับหน้าแรก

    </a>

  </div>

</section>

</body>
</html>