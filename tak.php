<?php

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ตาก - สถานที่ท่องเที่ยว</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

body{
    background:#f0f9ff;
    font-family:'Segoe UI', sans-serif;
}

/* HERO */
.hero{
    height:420px;
    background:
    linear-gradient(rgba(0,0,0,.50), rgba(0,0,0,.50)),
    url('images/tak/thi-lo-su.jpg');
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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm py-3">

    <div class="container position-relative">

        <!-- LEFT -->
        <button onclick="history.back()"
                class="btn btn-outline-light btn-sm position-absolute start-0">
            <i class="fa-solid fa-arrow-left"></i>
            กลับ
        </button>

        <!-- CENTER -->
        <span class="navbar-brand mx-auto fw-bold">
            จังหวัดตาก
        </span>

        <!-- RIGHT -->
        <a href="recommend.php"
           class="btn btn-light btn-sm position-absolute end-0 text-primary fw-semibold">
            <i class="fa-solid fa-location-dot me-1"></i>
            เริ่มต้น
        </a>

    </div>

</nav>

<!-- ================= HERO ================= -->
<section class="hero d-flex align-items-center text-center text-white">

    <div class="container">

        <span class="badge bg-primary rounded-pill px-4 py-2 mb-3">
            <i class="fa-solid fa-location-dot me-1"></i>
            จังหวัดตาก
        </span>

        <h1 class="display-4 fw-bold mb-3">
            เที่ยวตาก
        </h1>

        <p class="lead col-lg-7 mx-auto">
            ดินแดนแห่งขุนเขา น้ำตก และธรรมชาติอันยิ่งใหญ่
            เหมาะสำหรับสายผจญภัยและรักธรรมชาติ
        </p>

    </div>

</section>

<!-- ================= INTRO ================= -->
<section class="container my-5">

    <div class="card main-card shadow-sm">

        <div class="card-body p-4 p-lg-5">

            <div class="d-flex align-items-center mb-4">

                <div class="bg-primary-subtle text-primary rounded-circle
                            d-flex align-items-center justify-content-center me-3"
                     style="width:65px;height:65px;">

                    <i class="fa-solid fa-mountain fs-3"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-1">
                        ทำความรู้จักจังหวัดตาก
                    </h2>

                    <div class="text-muted">
                        เมืองแห่งธรรมชาติและการผจญภัย
                    </div>

                </div>

            </div>

            <p class="place-text mb-3">
                จังหวัดตากเป็นจังหวัดทางภาคเหนือตอนล่าง
                ที่มีธรรมชาติอุดมสมบูรณ์ รายล้อมด้วยภูเขา
                น้ำตก และผืนป่าขนาดใหญ่
                รวมถึงเป็นที่ตั้งของน้ำตกทีลอซู
                น้ำตกชื่อดังระดับประเทศ
            </p>

            <p class="place-text mb-0">
                เหมาะสำหรับนักท่องเที่ยวที่ชื่นชอบการเดินป่า
                แคมป์ปิ้ง ล่องเรือ และการท่องเที่ยวเชิงอนุรักษ์
                พร้อมสัมผัสวิถีชีวิตเรียบง่ายท่ามกลางธรรมชาติ
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
                    รวม 10 สถานที่ยอดนิยมในจังหวัดตาก
                </p>

            </div>

            <!-- ================= PAGE 1 ================= -->
            <?php if($page == 1): ?>

            <!-- PLACE 1 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/thi-lo-su.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                น้ำตกทีลอซู
                            </h3>

                            <p class="place-text">
                                น้ำตกทีลอซูเป็นหนึ่งในน้ำตกที่ใหญ่และสวยที่สุดของประเทศไทย
                                ตั้งอยู่ในเขตรักษาพันธุ์สัตว์ป่าอุ้มผาง
                                โดดเด่นด้วยสายน้ำขนาดใหญ่และธรรมชาติที่อุดมสมบูรณ์
                                เหมาะสำหรับนักท่องเที่ยวสายผจญภัยและรักธรรมชาติ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 2 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/bhumibol-dam.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                แลนด์มาร์ก
                            </span>

                            <h3 class="fw-bold mb-3">
                                เขื่อนภูมิพล
                            </h3>

                            <p class="place-text">
                                เขื่อนคอนกรีตโค้งแห่งแรกของประเทศไทย
                                รายล้อมด้วยวิวอ่างเก็บน้ำขนาดใหญ่และภูเขา
                                เหมาะสำหรับการพักผ่อน ล่องเรือ
                                และชมวิวธรรมชาติอันเงียบสงบ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 3 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/umphang.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                อุ้มผาง
                            </h3>

                            <p class="place-text">
                                อำเภอเล็กกลางหุบเขาที่เต็มไปด้วยธรรมชาติและป่าไม้สมบูรณ์
                                เป็นศูนย์กลางการท่องเที่ยวผจญภัยของจังหวัดตาก
                                มีอากาศเย็นสบายและเส้นทางธรรมชาติที่สวยงาม
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 4 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/doi-tu-le.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                จุดชมวิว
                            </span>

                            <h3 class="fw-bold mb-3">
                                ดอยทูเล
                            </h3>

                            <p class="place-text">
                                จุดชมวิวทะเลหมอกชื่อดังของจังหวัดตาก
                                สามารถชมพระอาทิตย์ขึ้นและวิวภูเขาสลับซับซ้อนได้อย่างสวยงาม
                                เหมาะสำหรับสายเดินป่าและแคมป์ปิ้ง
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 5 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/taksin-shrine.webp"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-danger rounded-pill place-badge mb-3">
                                ประวัติศาสตร์
                            </span>

                            <h3 class="fw-bold mb-3">
                                ศาลสมเด็จพระเจ้าตากสินมหาราช
                            </h3>

                            <p class="place-text">
                                สถานที่ศักดิ์สิทธิ์สำคัญของจังหวัดตาก
                                ที่ผู้คนให้ความเคารพศรัทธา
                                เหมาะสำหรับการกราบไหว้และเรียนรู้ประวัติศาสตร์ไทย
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
                        <img src="images/tak/mae-kasa-hot-spring.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                น้ำพุร้อน
                            </span>

                            <h3 class="fw-bold mb-3">
                                น้ำพุร้อนแม่กาษา
                            </h3>

                            <p class="place-text">
                                แหล่งท่องเที่ยวธรรมชาติชื่อดังที่มีบ่อน้ำพุร้อนกลางแจ้ง
                                เหมาะสำหรับการแช่น้ำพักผ่อนและชมบรรยากาศธรรมชาติ
                                ท่ามกลางอากาศเย็นสบาย
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 7 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/mae-nga-waterfall.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                น้ำตกธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                น้ำตกแม่กาษา
                            </h3>

                            <p class="place-text">
                                น้ำตกธรรมชาติท่ามกลางป่าเขา
                                มีน้ำไหลตลอดปีและบรรยากาศร่มรื่น
                                เหมาะสำหรับการพักผ่อน เล่นน้ำ และสัมผัสธรรมชาติอย่างใกล้ชิด
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 8 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/mokro-thai.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                จุดชมวิว
                            </span>

                            <h3 class="fw-bold mb-3">
                                ม่อนหมอกตะวัน
                            </h3>

                            <p class="place-text">
                                จุดชมทะเลหมอกและพระอาทิตย์ขึ้นที่มีชื่อเสียงของตาก
                                รายล้อมด้วยภูเขาและอากาศเย็นสบาย
                                เหมาะสำหรับสายถ่ายภาพและกางเต็นท์พักแรม
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 9 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/lan-sang.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                อุทยานธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                อุทยานแห่งชาติลานสาง
                            </h3>

                            <p class="place-text">
                                อุทยานแห่งชาติที่มีน้ำตก ลำธาร และเส้นทางศึกษาธรรมชาติ
                                บรรยากาศร่มรื่นเหมาะสำหรับการพักผ่อน
                                และเดินเที่ยวชมธรรมชาติในวันหยุด
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 10 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/tak/rim-mei-market.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-danger rounded-pill place-badge mb-3">
                                วัฒนธรรม
                            </span>

                            <h3 class="fw-bold mb-3">
                                ตลาดริมเมย
                            </h3>

                            <p class="place-text">
                                ตลาดชายแดนชื่อดังของอำเภอแม่สอด
                                เต็มไปด้วยสินค้า อาหาร และวัฒนธรรมท้องถิ่น
                                เหมาะสำหรับการเดินเล่น ชิมอาหาร และซื้อของฝาก
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <?php endif; ?>

            <!-- ================= PAGINATION ================= -->
            <div class="d-flex justify-content-center gap-3 mt-5">

                <a href="?page=1"
                   class="btn <?= $page == 1 ? 'btn-primary' : 'btn-outline-primary' ?> page-btn">
                    1
                </a>

                <a href="?page=2"
                   class="btn <?= $page == 2 ? 'btn-primary' : 'btn-outline-primary' ?> page-btn">
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

                        <div class="text-primary fs-1 mb-3">
                            <i class="fa-solid fa-camera"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            ถ่ายภาพธรรมชาติ
                        </h5>

                        <p class="place-text mb-0">
                            เก็บภาพน้ำตก ภูเขา และทะเลหมอก
                            ท่ามกลางธรรมชาติอันสวยงามของจังหวัดตาก
                        </p>

                    </div>

                </div>

                <!-- CARD 2 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-primary fs-1 mb-3">
                            <i class="fa-solid fa-tent"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            แคมป์ปิ้งและเดินป่า
                        </h5>

                        <p class="place-text mb-0">
                            สัมผัสธรรมชาติกลางขุนเขา
                            พร้อมผจญภัยในเส้นทางธรรมชาติชื่อดัง
                        </p>

                    </div>

                </div>

                <!-- CARD 3 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-primary fs-1 mb-3">
                            <i class="fa-solid fa-landmark"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            เรียนรู้ประวัติศาสตร์
                        </h5>

                        <p class="place-text mb-0">
                            เยี่ยมชมสถานที่สำคัญและเรียนรู้
                            เรื่องราวประวัติศาสตร์ของจังหวัดตาก
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-primary text-light text-center py-4">

    © 2026 เที่ยวภาคเหนือ | จังหวัดตาก

</footer>

</body>
</html>