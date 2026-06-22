<?php

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>พะเยา - สถานที่ท่องเที่ยว</title>

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
    url('images/phayao/kwan-phayao.jpg');
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
            จังหวัดพะเยา
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
            จังหวัดพะเยา
        </span>

        <h1 class="display-4 fw-bold mb-3">
            เที่ยวพะเยา
        </h1>

        <p class="lead col-lg-7 mx-auto">
            เมืองสงบกลางขุนเขา เต็มไปด้วยธรรมชาติ
            วัฒนธรรม และวิถีชีวิตล้านนา
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

                    <i class="fa-solid fa-water fs-3"></i>

                </div>

                <div>

                    <h2 class="fw-bold mb-1">
                        ทำความรู้จักพะเยา
                    </h2>

                    <div class="text-muted">
                        เมืองแห่งธรรมชาติและสโลว์ไลฟ์
                    </div>

                </div>

            </div>

            <p class="place-text mb-3">
                พะเยาเป็นจังหวัดเล็ก ๆ ทางภาคเหนือของประเทศไทย
                ที่เต็มไปด้วยความสงบ ธรรมชาติสวยงาม
                และวัฒนธรรมล้านนาอันเป็นเอกลักษณ์
            </p>

            <p class="place-text mb-0">
                จังหวัดพะเยามีทั้งทะเลสาบขนาดใหญ่ ภูเขา วัดเก่าแก่
                และแหล่งท่องเที่ยวธรรมชาติที่เหมาะกับการพักผ่อน
                และใช้ชีวิตแบบสโลว์ไลฟ์
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
                    รวม 10 สถานที่ยอดนิยมในจังหวัดพะเยา
                </p>

            </div>

            <!-- ================= PAGE 1 ================= -->
            <?php if($page == 1): ?>

            <!-- PLACE 1 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/kwan-phayao.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                แลนด์มาร์ก
                            </span>

                            <h3 class="fw-bold mb-3">
                                กว๊านพะเยา
                            </h3>

                            <p class="place-text">
                                กว๊านพะเยาเป็นทะเลสาบน้ำจืดขนาดใหญ่
                                และเป็นสัญลักษณ์สำคัญของจังหวัดพะเยา
                                เหมาะสำหรับเดินเล่น ปั่นจักรยาน
                                และชมพระอาทิตย์ตกริมกว๊าน
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 2 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/wat-analayo.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                วัดชื่อดัง
                            </span>

                            <h3 class="fw-bold mb-3">
                                วัดอนาลโยทิพยาราม
                            </h3>

                            <p class="place-text">
                                วัดอนาลโยทิพยารามตั้งอยู่บนภูเขา
                                สามารถมองเห็นวิวกว๊านพะเยาได้อย่างสวยงาม
                                เหมาะสำหรับการไหว้พระ ทำสมาธิ
                                และชมธรรมชาติ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 3 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/phu-lang-ka.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                ธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                ภูลังกา
                            </h3>

                            <p class="place-text">
                                ภูลังกาเป็นจุดชมทะเลหมอกและพระอาทิตย์ขึ้นชื่อดัง
                                มีวิวภูเขาสลับซับซ้อนและอากาศเย็นสบาย
                                เหมาะสำหรับสายธรรมชาติและการถ่ายภาพ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 4 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/wat-sri-khom-kham.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                วัฒนธรรม
                            </span>

                            <h3 class="fw-bold mb-3">
                                วัดศรีโคมคำ
                            </h3>

                            <p class="place-text">
                                วัดศรีโคมคำเป็นวัดสำคัญของจังหวัดพะเยา
                                ประดิษฐานพระเจ้าตนหลวง
                                พระพุทธรูปคู่บ้านคู่เมืองที่ชาวพะเยาเคารพศรัทธา
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 5 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/phu-sang-waterfall.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-danger rounded-pill place-badge mb-3">
                                น้ำตกธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                น้ำตกภูซาง
                            </h3>

                            <p class="place-text">
                                น้ำตกภูซางเป็นน้ำตกน้ำอุ่นแห่งเดียวในภาคเหนือ
                                รายล้อมด้วยป่าไม้ธรรมชาติ
                                เหมาะสำหรับการพักผ่อนและท่องเที่ยวเชิงธรรมชาติ
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
                        <img src="images/phayao/doi-pha-nang.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                จุดชมวิว
                            </span>

                            <h3 class="fw-bold mb-3">
                                ดอยภูนาง
                            </h3>

                            <p class="place-text">
                                ดอยภูนางเป็นอุทยานแห่งชาติที่มีธรรมชาติอุดมสมบูรณ์
                                เหมาะสำหรับการเดินป่า ชมวิวภูเขา
                                และสัมผัสอากาศบริสุทธิ์ท่ามกลางธรรมชาติ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 7 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/magic-mountain.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-info rounded-pill place-badge mb-3">
                                คาเฟ่วิวภูเขา
                            </span>

                            <h3 class="fw-bold mb-3">
                                Magic Mountain Cafe
                            </h3>

                            <p class="place-text">
                                คาเฟ่ชื่อดังบนภูเขาที่มองเห็นวิวทะเลหมอกได้อย่างสวยงาม
                                เหมาะสำหรับจิบกาแฟ พักผ่อน
                                และชมวิวธรรมชาติในบรรยากาศเงียบสงบ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 8 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/wat-tilok.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-primary rounded-pill place-badge mb-3">
                                วัดโบราณ
                            </span>

                            <h3 class="fw-bold mb-3">
                                วัดติโลกอาราม
                            </h3>

                            <p class="place-text">
                                วัดโบราณกลางกว๊านพะเยาที่มีอายุกว่า 500 ปี
                                นักท่องเที่ยวสามารถนั่งเรือไปสักการะ
                                และชมบรรยากาศกลางน้ำได้อย่างสวยงาม
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 9 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/chiang-kham.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-warning text-dark rounded-pill place-badge mb-3">
                                ชุมชนท้องถิ่น
                            </span>

                            <h3 class="fw-bold mb-3">
                                เชียงคำ
                            </h3>

                            <p class="place-text">
                                อำเภอเชียงคำเป็นพื้นที่ที่มีวัฒนธรรมไทลื้อโดดเด่น
                                มีตลาดพื้นเมือง อาหารท้องถิ่น
                                และวิถีชีวิตเรียบง่ายที่น่าสนใจ
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- PLACE 10 -->
            <div class="card place-card shadow-sm mb-4">

                <div class="row g-0">

                    <div class="col-lg-5">
                        <img src="images/phayao/doi-nok.jpg"
                             class="place-img">
                    </div>

                    <div class="col-lg-7">

                        <div class="card-body p-4">

                            <span class="badge bg-danger rounded-pill place-badge mb-3">
                                ชมธรรมชาติ
                            </span>

                            <h3 class="fw-bold mb-3">
                                ดอยหนอก
                            </h3>

                            <p class="place-text">
                                ดอยหนอกเป็นจุดชมวิวและเส้นทางเดินป่ายอดนิยม
                                ของนักท่องเที่ยวสายผจญภัย
                                สามารถชมทะเลหมอกและวิวภูเขาได้อย่างสวยงาม
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
                            ชมวิวกว๊านพะเยา
                            ทะเลหมอก และภูเขาที่สวยงาม
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
                            สโลว์ไลฟ์และคาเฟ่
                        </h5>

                        <p class="place-text mb-0">
                            เดินเล่นริมกว๊าน
                            นั่งคาเฟ่ และพักผ่อนในบรรยากาศสงบ
                        </p>

                    </div>

                </div>

                <!-- CARD 3 -->
                <div class="col-md-4">

                    <div class="activity-card shadow-sm p-4 h-100">

                        <div class="text-primary fs-1 mb-3">
                            <i class="fa-solid fa-leaf"></i>
                        </div>

                        <h5 class="fw-bold mb-3">
                            ท่องเที่ยวธรรมชาติ
                        </h5>

                        <p class="place-text mb-0">
                            สำรวจภูเขา น้ำตก
                            และเส้นทางธรรมชาติของภาคเหนือ
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-primary text-light text-center py-4">

    © 2026 เที่ยวภาคเหนือ | จังหวัดพะเยา

</footer>

</body>
</html>