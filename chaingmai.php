<?php

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>เชียงใหม่ - สถานที่ท่องเที่ยว</title>

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
    url('images/chaingmai/บ้านแม่กำปอง.jpg');
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
            จังหวัดเชียงใหม่
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
            จังหวัดเชียงใหม่
        </span>

        <h1 class="display-4 fw-bold mb-3">
            เที่ยวเชียงใหม่
        </h1>

        <p class="lead col-lg-7 mx-auto">
            เมืองแห่งวัฒนธรรมล้านนา ธรรมชาติ ภูเขา คาเฟ่
            และสถานที่ท่องเที่ยวชื่อดังของภาคเหนือ
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

                    <i class="fa-solid fa-mountain-city fs-3"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-1">
                        ทำความรู้จักเชียงใหม่
                    </h2>

                    <div class="text-muted">
                        เมืองท่องเที่ยวอันดับหนึ่งของภาคเหนือ
                    </div>

                </div>

            </div>

            <p class="place-text mb-3">
                เชียงใหม่เป็นจังหวัดที่มีชื่อเสียงด้านการท่องเที่ยวมากที่สุดแห่งหนึ่งของประเทศไทย
                เต็มไปด้วยวัดวาอารามเก่าแก่ ธรรมชาติอันสวยงาม
                รวมถึงวัฒนธรรมล้านนาที่มีเอกลักษณ์เฉพาะตัว
            </p>

            <p class="place-text mb-0">
                นักท่องเที่ยวสามารถเที่ยวได้หลากหลายรูปแบบ
                ไม่ว่าจะเป็นสายธรรมชาติ สายคาเฟ่ สายถ่ายรูป
                หรือสายทำบุญ ทำให้เชียงใหม่เป็นเมืองที่สามารถเที่ยวได้ตลอดทั้งปี
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
                    รวม 10 สถานที่ยอดนิยมในจังหวัดเชียงใหม่
                </p>

            </div>

            <!-- ================= PAGE 1 ================= -->
            <?php if($page == 1): ?>

            <!-- PLACE 1 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingmai/doisuthap.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                วัดคู่เมือง
                            </span>

                            <h3 class="fw-bold mb-3">
                                วัดพระธาตุดอยสุเทพ
                            </h3>

                            <p class="place-text">
                                วัดพระธาตุดอยสุเทพ เป็นวัดคู่บ้านคู่เมืองเชียงใหม่ที่ตั้งอยู่บนดอยสุเทพ 
                                โดดเด่นด้วยพระธาตุสีทองอร่ามและจุดชมวิวที่สามารถมองเห็นตัวเมืองเชียงใหม่ได้อย่างสวยงาม 
                                เหมาะสำหรับการสักการะและชมบรรยากาศธรรมชาติบนภูเขา
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 2 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingmai/nimman.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-danger rounded-pill place-badge mb-3">
                                ไลฟ์สไตล์
                            </span>

                            <h3 class="fw-bold mb-3">
                                ถนนนิมมานเหมินทร์
                            </h3>

                            <p class="place-text">
                                ถนนนิมมานเหมินทร์ เป็นย่านยอดนิยมของเชียงใหม่ที่เต็มไปด้วยคาเฟ่ ร้านอาหาร และร้านค้าไลฟ์สไตล์มากมาย 
                                บรรยากาศทันสมัยและคึกคัก เหมาะสำหรับการเดินเล่น ถ่ายภาพ และพักผ่อนในสไตล์เมืองเชียงใหม่ยุคใหม่
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 3 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingmai/ch2.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                วัฒนธรรม
                            </span>

                            <h3 class="fw-bold mb-3">
                                เมืองเก่าเชียงใหม่
                            </h3>

                            <p class="place-text">
                                เมืองเก่าเชียงใหม่ เป็นย่านประวัติศาสตร์สำคัญที่เต็มไปด้วยวัดเก่าแก่ กำแพงเมือง และคูเมืองโบราณ 
                                สะท้อนเสน่ห์ของอาณาจักรล้านนา เหมาะสำหรับการเดินเที่ยวชมวัฒนธรรมและวิถีชีวิตดั้งเดิมของเชียงใหม่
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 4 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingmai/monjam.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                ม่อนแจ่ม
                            </h3>

                            <p class="place-text">
                                ม่อนแจ่ม เป็นจุดชมวิวธรรมชาติยอดนิยมของเชียงใหม่ มีอากาศเย็นสบายตลอดปี โดดเด่นด้วยวิวภูเขา ทะเลหมอก และแปลงดอกไม้สีสันสวยงาม 
                                เหมาะสำหรับการพักผ่อนและชมวิวท่ามกลางธรรมชาติ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 5 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingmai/unnamed.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                อนุรักษ์สัตว์
                            </span>

                            <h3 class="fw-bold mb-3">
                                ปางช้าง
                            </h3>

                            <p class="place-text">
                                ปางช้าง เป็นแหล่งท่องเที่ยวเชิงอนุรักษ์ที่เปิดโอกาสให้นักท่องเที่ยวได้เรียนรู้วิถีชีวิตและการดูแลช้างอย่างใกล้ชิด มีกิจกรรมให้อาหาร อาบน้ำช้าง และเดินชมธรรมชาติ 
                                เหมาะสำหรับผู้ที่ต้องการสัมผัสความน่ารักของช้างไทยในบรรยากาศธรรมชาติ
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
                        <img src="images/chaingmai/บ้านแม่กำปอง.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                หมู่บ้านธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                บ้านแม่กำปอง
                            </h3>

                            <p class="place-text">
                                บ้านแม่กำปอง เป็นหมู่บ้านเล็กกลางหุบเขาที่มีอากาศเย็นสบายตลอดปี โดดเด่นด้วยธรรมชาติ วิถีชีวิตเรียบง่าย และลำธารที่ไหลผ่านหมู่บ้าน เหมาะสำหรับการพักผ่อน จิบกาแฟ และสัมผัสบรรยากาศเงียบสงบท่ามกลางป่าเขา
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 7 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingmai/wualai.png"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-danger rounded-pill place-badge mb-3">
                                ถนนคนเดิน
                            </span>

                            <h3 class="fw-bold mb-3">
                                ถนนคนเดินวัวลาย
                            </h3>

                            <p class="place-text">
                                ถนนคนเดินวัวลาย เป็นถนนคนเดินชื่อดังของเชียงใหม่ที่มีเอกลักษณ์ด้านงานหัตถกรรมและเครื่องเงิน นักท่องเที่ยวสามารถเลือกซื้อของพื้นเมือง ชิมอาหารเหนือ และชมการแสดงพื้นบ้าน ท่ามกลางบรรยากาศคึกคักในยามค่ำคืน
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 8 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingmai/qeen.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                สวนธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                สวนพฤกษศาสตร์สมเด็จพระนางเจ้าสิริกิติ์
                            </h3>

                            <p class="place-text">
                                สวนพฤกษศาสตร์สมเด็จพระนางเจ้าสิริกิติ์ เป็นสวนพฤกษศาสตร์ขนาดใหญ่ของจังหวัดเชียงใหม่ รวบรวมพรรณไม้ไทยและพืชหายากจากทั่วโลกไว้ท่ามกลางธรรมชาติอันร่มรื่น โดดเด่นด้วยเส้นทางเดินลอยฟ้าเหนือยอดไม้และโรงเรือนจัดแสดงพรรณไม้เมืองร้อน เหมาะสำหรับการพักผ่อน เดินชมธรรมชาติ และเรียนรู้ด้านพฤกษศาสตร์ท่ามกลางอากาศเย็นสบาย

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 9 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images\chaingmai\GRAPHonenimman-Resize-4.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                คาเฟ่ชื่อดัง
                            </span>

                            <h3 class="fw-bold mb-3">
                                Graph Cafe
                            </h3>

                            <p class="place-text">
                                Graph Cafe เป็นคาเฟ่ชื่อดังของเชียงใหม่ที่โดดเด่นด้านกาแฟสเปเชียลตี้และการตกแต่งสไตล์มินิมอล บรรยากาศอบอุ่นและเงียบสงบ เหมาะสำหรับนั่งพักผ่อน ทำงาน หรือจิบกาแฟคุณภาพในบรรยากาศสบาย ๆ ใจกลางเมืองเชียงใหม่

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 10 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/chaingmai/orxmbyfs3FDOgi22h2X-o.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                คาเฟ่ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                No.39 Cafe
                            </h3>

                            <p class="place-text">
                                No.39 Cafe เป็นคาเฟ่บรรยากาศธรรมชาติชื่อดังของเชียงใหม่ โดดเด่นด้วยสระน้ำสีฟ้ากลางร้านและการตกแต่งสไตล์มินิมอล เหมาะสำหรับนั่งพักผ่อน ถ่ายภาพ และจิบกาแฟท่ามกลางบรรยากาศเงียบสงบและร่มรื่น


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
                            <i class="fa-solid fa-landmark"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            ไหว้พระและเรียนรู้วัฒนธรรม
                        </h5>

                        <p class="place-text mb-0">
                            เยี่ยมชมวัดสำคัญและเรียนรู้ประวัติศาสตร์ล้านนา
                            ผ่านสถาปัตยกรรมและวิถีชีวิตท้องถิ่น
                        </p>

                    </div>

                </div>

                <!-- CARD 2 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-primary fs-1 mb-3">
                            <i class="fa-solid fa-mug-hot"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            คาเฟ่และไลฟ์สไตล์
                        </h5>

                        <p class="place-text mb-0">
                            เดินเล่นคาเฟ่ชื่อดังของเชียงใหม่
                            พร้อมถ่ายภาพและพักผ่อนในบรรยากาศสบาย ๆ
                        </p>

                    </div>

                </div>

                <!-- CARD 3 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-primary fs-1 mb-3">
                            <i class="fa-solid fa-mountain"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            ธรรมชาติและภูเขา
                        </h5>

                        <p class="place-text mb-0">
                            ชมทะเลหมอก เดินป่า และสัมผัสอากาศบริสุทธิ์
                            ท่ามกลางธรรมชาติของภาคเหนือ
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-primary text-light text-center py-4">

    © 2026 เที่ยวภาคเหนือ | จังหวัดเชียงใหม่

</footer>

</body>
</html>