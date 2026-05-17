<?php
session_start();

/* ลบข้อมูล session ทั้งหมด */
$_SESSION = [];

/* ทำลาย session */
session_destroy();

/* กลับหน้าแรก */
header("Location: index.php");
exit;
