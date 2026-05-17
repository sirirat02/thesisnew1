<?php

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>แม่ฮ่องสอน - สถานที่ท่องเที่ยว</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body{
    background:#f4fff7;
    font-family:'Segoe UI', sans-serif;
}

/* HERO */
.hero{
    height:420px;
    background:
    linear-gradient(rgba(0,0,0,.50), rgba(0,0,0,.50)),
    url('images/pngtree-mexican-sunflowers-in-a-mae-hong-son-province-field-at-sunset-photo-image_27248806.jpg');
    background-size:cover;
    background-position:center;
}

/* CARD */
.main-card{
    border:none;
    border-radius:22px;
}

/* PLACE CARD */
.place-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:.25s;
}

.place-card:hover{
    transform:translateY(-3px);
}

/* IMAGE */
.place-img{
    width:100%;
    height:250px;
    object-fit:cover;
}

/* TITLE */
.section-title{
    color:#166534;
    font-weight:800;
}

/* TEXT */
.place-text{
    color:#6b7280;
    line-height:1.8;
    font-size:15px;
}

/* BADGE */
.place-badge{
    font-size:13px;
    padding:8px 14px;
}

/* PAGINATION */
.page-btn{
    width:45px;
    height:45px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
}

/* ACTIVITY */
.activity-card{
    border-radius:18px;
    background:white;
    transition:.25s;
}

.activity-card:hover{
    transform:translateY(-3px);
}

</style>

</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm py-3">

    <div class="container position-relative">

        <!-- LEFT -->
        <button onclick="history.back()"
                class="btn btn-outline-light btn-sm position-absolute start-0">
            <i class="fa-solid fa-arrow-left"></i>
            กลับ
        </button>

        <!-- CENTER -->
        <span class="navbar-brand mx-auto fw-bold">
            จังหวัดแม่ฮ่องสอน
        </span>

        <!-- RIGHT -->
        <a href="recommend.php"
           class="btn btn-light btn-sm position-absolute end-0 text-success fw-semibold">
            <i class="fa-solid fa-location-dot me-1"></i>
            เริ่มต้น
        </a>

    </div>

</nav>

<!-- ================= HERO ================= -->
<section class="hero d-flex align-items-center text-center text-white">

    <div class="container">

        <span class="badge bg-success rounded-pill px-4 py-2 mb-3">
            <i class="fa-solid fa-location-dot me-1"></i>
            จังหวัดแม่ฮ่องสอน
        </span>

        <h1 class="display-4 fw-bold mb-3">
            เที่ยวแม่ฮ่องสอน
        </h1>

        <p class="lead col-lg-7 mx-auto">
            เมืองสามหมอก ดินแดนแห่งขุนเขา
            ธรรมชาติ และวัฒนธรรมอันสงบงาม
        </p>

    </div>

</section>

<!-- ================= INTRO ================= -->
<section class="container my-5">

    <div class="card main-card shadow-sm">

        <div class="card-body p-4 p-lg-5">

            <div class="d-flex align-items-center mb-4">

                <div class="bg-success-subtle text-success rounded-circle
                            d-flex align-items-center justify-content-center me-3"
                     style="width:65px;height:65px;">

                    <i class="fa-solid fa-cloud fs-3"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-1">
                        ทำความรู้จักแม่ฮ่องสอน
                    </h2>

                    <div class="text-muted">
                        เมืองแห่งสายหมอกและภูเขา
                    </div>

                </div>

            </div>

            <p class="place-text mb-3">
                แม่ฮ่องสอนเป็นจังหวัดที่มีธรรมชาติอุดมสมบูรณ์
                รายล้อมด้วยภูเขาสลับซับซ้อน
                อากาศเย็นสบาย และมีทะเลหมอกสวยงามตลอดปี
            </p>

            <p class="place-text mb-0">
                นักท่องเที่ยวสามารถสัมผัสวัฒนธรรมท้องถิ่น
                วิถีชีวิตเรียบง่าย ชมธรรมชาติ
                และพักผ่อนท่ามกลางบรรยากาศเงียบสงบ
                ได้อย่างเต็มที่
            </p>

        </div>

    </div>

</section>

<!-- ================= PLACES ================= -->
<section class="container mb-5">

    <div class="card main-card shadow-sm">

        <div class="card-body p-4 p-lg-5">

            <!-- TITLE -->
            <div class="text-center mb-5">

                <h2 class="section-title mb-3">
                    สถานที่ท่องเที่ยวแนะนำ
                </h2>

                <p class="text-muted">
                    รวม 10 สถานที่ยอดนิยมในจังหวัดแม่ฮ่องสอน
                </p>

            </div>

            <!-- ================= PAGE 1 ================= -->
            <?php if($page == 1): ?>

            <!-- PLACE 1 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/pangoog.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-success rounded-pill place-badge mb-3">
                                ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                ปางอุ๋ง
                            </h3>

                            <p class="place-text">
                                ปางอุ๋งเป็นอ่างเก็บน้ำกลางหุบเขา
                                รายล้อมด้วยป่าสนและทะเลหมอกยามเช้า
                                จนได้รับฉายาว่า “สวิตเซอร์แลนด์เมืองไทย”
                                เหมาะสำหรับการกางเต็นท์และพักผ่อนท่ามกลางธรรมชาติ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 2 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/doigomu.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                วัดชื่อดัง
                            </span>

                            <h3 class="fw-bold mb-3">
                                วัดพระธาตุดอยกองมู
                            </h3>

                            <p class="place-text">
                                วัดพระธาตุดอยกองมูเป็นวัดคู่บ้านคู่เมืองแม่ฮ่องสอน
                                ตั้งอยู่บนยอดเขา สามารถชมวิวเมืองและภูเขาได้อย่างสวยงาม
                                โดยเฉพาะช่วงพระอาทิตย์ตกที่ได้รับความนิยมมาก
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 3 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/suthohphe.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                วิถีชีวิต
                            </span>

                            <h3 class="fw-bold mb-3">
                                สะพานซูตองเป้
                            </h3>

                            <p class="place-text">
                                สะพานไม้ไผ่กลางทุ่งนาที่ยาวที่สุดแห่งหนึ่งในประเทศไทย
                                เชื่อมระหว่างหมู่บ้านกับวัดภูสมะ
                                มีบรรยากาศเงียบสงบและเหมาะกับการเดินเล่นยามเช้า
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 4 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/banrakthai.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-danger rounded-pill place-badge mb-3">
                                วัฒนธรรม
                            </span>

                            <h3 class="fw-bold mb-3">
                                บ้านรักไทย
                            </h3>

                            <p class="place-text">
                                บ้านรักไทยเป็นหมู่บ้านจีนยูนนานริมทะเลสาบ
                                โดดเด่นด้วยไร่ชา บ้านดิน และบรรยากาศเย็นสบาย
                                เหมาะสำหรับจิบชาและพักผ่อนท่ามกลางสายหมอก
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 5 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/thamrot.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                ผจญภัย
                            </span>

                            <h3 class="fw-bold mb-3">
                                ถ้ำลอด
                            </h3>

                            <p class="place-text">
                                ถ้ำลอดเป็นถ้ำหินปูนขนาดใหญ่ที่มีลำน้ำไหลผ่าน
                                นักท่องเที่ยวสามารถล่องแพไม้ไผ่
                                เพื่อชมความงดงามของหินงอกหินย้อยภายในถ้ำได้
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <?php endif; ?>

            <!-- ================= PAGE 2 ================= -->
            <?php if($page == 2): ?>

            <!-- PLACE 6 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/paimemorial.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-secondary rounded-pill place-badge mb-3">
                                เช็กอิน
                            </span>

                            <h3 class="fw-bold mb-3">
                                สะพานประวัติศาสตร์ปาย
                            </h3>

                            <p class="place-text">
                                สะพานเหล็กเก่าแก่สมัยสงครามโลกครั้งที่ 2
                                กลายเป็นแลนด์มาร์กยอดนิยมของอำเภอปาย
                                เหมาะสำหรับเดินเล่นและถ่ายภาพบรรยากาศย้อนยุค
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 7 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/yunlai.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                จุดชมวิว
                            </span>

                            <h3 class="fw-bold mb-3">
                                จุดชมวิวหยุนไหล
                            </h3>

                            <p class="place-text">
                                จุดชมวิวทะเลหมอกชื่อดังของอำเภอปาย
                                สามารถมองเห็นวิวภูเขาและหมู่บ้านได้อย่างสวยงาม
                                เหมาะสำหรับชมพระอาทิตย์ขึ้นในยามเช้า
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 8 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/namhu.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-success rounded-pill place-badge mb-3">
                                ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                น้ำพุร้อนท่าปาย
                            </h3>

                            <p class="place-text">
                                น้ำพุร้อนธรรมชาติท่ามกลางป่าไม้
                                มีบ่อน้ำร้อนอุณหภูมิสูงและลำธารให้นักท่องเที่ยวแช่เท้า
                                เหมาะสำหรับการพักผ่อนและสัมผัสธรรมชาติ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 9 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/paiwalking.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                ถนนคนเดิน
                            </span>

                            <h3 class="fw-bold mb-3">
                                ถนนคนเดินปาย
                            </h3>

                            <p class="place-text">
                                ถนนคนเดินชื่อดังของอำเภอปาย
                                เต็มไปด้วยร้านอาหาร คาเฟ่
                                ของฝาก และดนตรีสดในบรรยากาศสบาย ๆ
                                เหมาะสำหรับเดินเล่นช่วงกลางคืน
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 10 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/MaeHongSon/morpaeng.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                น้ำตก
                            </span>

                            <h3 class="fw-bold mb-3">
                                น้ำตกหมอแปง
                            </h3>

                            <p class="place-text">
                                น้ำตกธรรมชาติยอดนิยมใกล้อำเภอปาย
                                มีแอ่งน้ำใสและโขดหินธรรมชาติ
                                เหมาะสำหรับเล่นน้ำ พักผ่อน
                                และสัมผัสธรรมชาติอย่างใกล้ชิด
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <?php endif; ?>

            <!-- ================= PAGINATION ================= -->
            <div class="d-flex justify-content-center gap-3 mt-5">

                <a href="?page=1"
                   class="btn <?= $page == 1 ? 'btn-success' : 'btn-outline-success' ?> page-btn">
                    1
                </a>

                <a href="?page=2"
                   class="btn <?= $page == 2 ? 'btn-success' : 'btn-outline-success' ?> page-btn">
                    2
                </a>

            </div>

        </div>

    </div>

</section>

<!-- ================= ACTIVITIES ================= -->
<section class="container mb-5">

    <div class="card main-card shadow-sm">

        <div class="card-body p-4 p-lg-5">

            <h2 class="fw-bold text-center mb-5">
                กิจกรรมที่ไม่ควรพลาด
            </h2>

            <div class="row g-4">

                <!-- CARD 1 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-success fs-1 mb-3">
                            <i class="fa-solid fa-camera"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            ถ่ายภาพทะเลหมอก
                        </h5>

                        <p class="place-text mb-0">
                            ชมวิวภูเขาและทะเลหมอกยามเช้า
                            ในบรรยากาศเงียบสงบของแม่ฮ่องสอน
                        </p>

                    </div>

                </div>

                <!-- CARD 2 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-success fs-1 mb-3">
                            <i class="fa-solid fa-mug-hot"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            สโลว์ไลฟ์และคาเฟ่
                        </h5>

                        <p class="place-text mb-0">
                            จิบชา เดินเล่นริมทะเลสาบ
                            และสัมผัสวิถีชีวิตเรียบง่ายของชุมชน
                        </p>

                    </div>

                </div>

                <!-- CARD 3 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-success fs-1 mb-3">
                            <i class="fa-solid fa-mountain"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            ธรรมชาติและผจญภัย
                        </h5>

                        <p class="place-text mb-0">
                            สำรวจภูเขา น้ำตก ถ้ำ
                            และเส้นทางธรรมชาติที่สวยงามของภาคเหนือ
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-success text-light text-center py-4">

    © 2026 เที่ยวภาคเหนือ | จังหวัดแม่ฮ่องสอน

</footer>

</body>
</html>