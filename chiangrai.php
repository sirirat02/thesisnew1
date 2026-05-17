<?php

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>เชียงราย - สถานที่ท่องเที่ยว</title>

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
    url('images/chaingrai/สวนแม่ฟ้าหลวง.jpg');
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
            จังหวัดเชียงราย
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
            จังหวัดเชียงราย
        </span>

        <h1 class="display-4 fw-bold mb-3">
            เที่ยวเชียงราย
        </h1>

        <p class="lead col-lg-7 mx-auto">
            เมืองแห่งศิลปะ วัฒนธรรมล้านนา
            ธรรมชาติ และทะเลหมอกแห่งภาคเหนือ
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

                    <i class="fa-solid fa-mountain-city fs-3"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-1">
                        ทำความรู้จักเชียงราย
                    </h2>

                    <div class="text-muted">
                        จังหวัดเหนือสุดของประเทศไทย
                    </div>

                </div>

            </div>

            <p class="place-text mb-3">
                เชียงรายเป็นจังหวัดที่โดดเด่นด้านศิลปะ วัฒนธรรมล้านนา
                และธรรมชาติอันสวยงาม เต็มไปด้วยวัดชื่อดัง
                จุดชมทะเลหมอก และสถานที่ท่องเที่ยวเชิงวัฒนธรรม
                ที่มีเอกลักษณ์เฉพาะตัว
            </p>

            <p class="place-text mb-0">
                นักท่องเที่ยวสามารถเที่ยวได้หลากหลายรูปแบบ
                ไม่ว่าจะเป็นสายธรรมชาติ สายถ่ายภาพ
                สายทำบุญ หรือสายคาเฟ่
                ทำให้เชียงรายเป็นอีกจังหวัดยอดนิยมของภาคเหนือ
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
                    รวม 10 สถานที่ยอดนิยมในจังหวัดเชียงราย
                </p>

            </div>

            <!-- ================= PAGE 1 ================= -->
            <?php if($page == 1): ?>

            <!-- PLACE 1 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/watrongkhunpng.png"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                วัดชื่อดัง
                            </span>

                            <h3 class="fw-bold mb-3">
                                วัดร่องขุ่น
                            </h3>

                            <p class="place-text">
                                วัดร่องขุ่น เป็นวัดสีขาวอันโดดเด่นที่ออกแบบโดย
                                อาจารย์เฉลิมชัย โฆษิตพิพัฒน์
                                โดดเด่นด้วยศิลปะร่วมสมัยที่ผสมผสานแนวคิดทางพระพุทธศาสนา
                                และกลายเป็นแลนด์มาร์กสำคัญของจังหวัดเชียงราย
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 2 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/watrong.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                ศิลปะล้านนา
                            </span>

                            <h3 class="fw-bold mb-3">
                                วัดร่องเสือเต้น
                            </h3>

                            <p class="place-text">
                                วัดร่องเสือเต้น เป็นวัดสีน้ำเงินที่มีเอกลักษณ์โดดเด่น
                                ด้วยลวดลายศิลปะล้านนาประยุกต์สีฟ้าและทอง
                                ภายในประดิษฐานพระพุทธรูปสีขาวขนาดใหญ่
                                เหมาะสำหรับการสักการะและถ่ายภาพ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 3 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/phuchefah.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                ภูชี้ฟ้า
                            </h3>

                            <p class="place-text">
                                ภูชี้ฟ้า เป็นจุดชมวิวทะเลหมอกและพระอาทิตย์ขึ้นที่มีชื่อเสียงของเชียงราย
                                สามารถมองเห็นวิวภูเขาและชายแดนประเทศลาวได้อย่างสวยงาม
                                โดยเฉพาะช่วงฤดูหนาวที่ได้รับความนิยมอย่างมาก
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 4 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/singhapark1.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                ครอบครัว
                            </span>

                            <h3 class="fw-bold mb-3">
                                สิงห์ปาร์ค เชียงราย
                            </h3>

                            <p class="place-text">
                                สิงห์ปาร์ค เชียงราย เป็นแหล่งท่องเที่ยวเชิงเกษตรขนาดใหญ่
                                รายล้อมด้วยไร่ชาและธรรมชาติสีเขียว
                                มีกิจกรรมหลากหลาย เช่น ปั่นจักรยาน
                                ชมฟาร์ม และถ่ายภาพวิวภูเขา
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 5 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/shamthong.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-danger rounded-pill place-badge mb-3">
                                ประวัติศาสตร์
                            </span>

                            <h3 class="fw-bold mb-3">
                                สามเหลี่ยมทองคำ
                            </h3>

                            <p class="place-text">
                                สามเหลี่ยมทองคำ เป็นจุดบรรจบของแม่น้ำโขงและแม่น้ำรวก
                                ซึ่งเชื่อมชายแดนไทย ลาว และเมียนมา
                                นักท่องเที่ยวสามารถล่องเรือ
                                และเรียนรู้ประวัติศาสตร์ของพื้นที่แห่งนี้ได้
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
                        <img src="images/chaingrai/สวนแม่ฟ้าหลวง.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4"> 

                            <span class="badge bg-success rounded-pill place-badge mb-3">
                                สวนดอกไม้
                            </span>

                            <h3 class="fw-bold mb-3">
                                สวนแม่ฟ้าหลวง
                            </h3>

                            <p class="place-text">
                                สวนแม่ฟ้าหลวง เป็นสวนดอกไม้และสวนพฤกษศาสตร์ชื่อดัง
                                ตั้งอยู่บนดอยตุง รายล้อมด้วยอากาศเย็นสบาย
                                เหมาะสำหรับเดินชมดอกไม้และพักผ่อนท่ามกลางธรรมชาติ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 7 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/ดอยตุง.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                จุดชมวิว
                            </span>

                            <h3 class="fw-bold mb-3">
                                ดอยตุง
                            </h3>

                            <p class="place-text">
                                ดอยตุง เป็นแหล่งท่องเที่ยวธรรมชาติยอดนิยมของเชียงราย
                                มีอากาศเย็นตลอดปี โดดเด่นด้วยวิวภูเขา
                                สวนดอกไม้ และพระตำหนักดอยตุง
                                เหมาะสำหรับการพักผ่อนและชมวิวธรรมชาติ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 8 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/บ้านดำ.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-dark rounded-pill place-badge mb-3">
                                ศิลปะร่วมสมัย
                            </span>

                            <h3 class="fw-bold mb-3 text-dark">
                                บ้านดำ
                            </h3>

                            <p class="place-text">
                                บ้านดำ เป็นพิพิธภัณฑ์ศิลปะชื่อดังของเชียงราย
                                ที่สร้างโดยอาจารย์ถวัลย์ ดัชนี
                                โดดเด่นด้วยสถาปัตยกรรมสีดำและงานศิลปะที่มีเอกลักษณ์เฉพาะตัว
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 9 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/chivitthamma.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                คาเฟ่ชื่อดัง
                            </span>

                            <h3 class="fw-bold mb-3">
                                Chivit Thamma Da Coffee House
                            </h3>

                            <p class="place-text">
                                คาเฟ่บรรยากาศอบอุ่นริมแม่น้ำกก
                                ตกแต่งสไตล์อังกฤษวินเทจ
                                เหมาะสำหรับนั่งพักผ่อน จิบกาแฟ
                                และถ่ายภาพในบรรยากาศเงียบสงบ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 10 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingrai/lalitta.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                คาเฟ่ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                Lalitta Cafe
                            </h3>

                            <p class="place-text">
                                Lalitta Cafe เป็นคาเฟ่บรรยากาศธรรมชาติ
                                โดดเด่นด้วยน้ำตกจำลองและสวนสีเขียวร่มรื่น
                                เหมาะสำหรับการพักผ่อน ถ่ายภาพ
                                และสัมผัสบรรยากาศสดชื่นท่ามกลางธรรมชาติ
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
                            ถ่ายภาพและชมวิว
                        </h5>

                        <p class="place-text mb-0">
                            เก็บภาพวัดสวย วิวภูเขา
                            และทะเลหมอกอันสวยงามของเชียงราย
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
                            คาเฟ่และสโลว์ไลฟ์
                        </h5>

                        <p class="place-text mb-0">
                            นั่งคาเฟ่ท่ามกลางธรรมชาติ
                            พร้อมพักผ่อนในบรรยากาศเงียบสงบ
                        </p>

                    </div>

                </div>

                <!-- CARD 3 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-success fs-1 mb-3">
                            <i class="fa-solid fa-landmark"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            เรียนรู้วัฒนธรรม
                        </h5>

                        <p class="place-text mb-0">
                            เยี่ยมชมวัด ศิลปะล้านนา
                            และแหล่งประวัติศาสตร์สำคัญของภาคเหนือ
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-success text-light text-center py-4">

    © 2026 เที่ยวภาคเหนือ | จังหวัดเชียงราย

</footer>

</body>
</html>