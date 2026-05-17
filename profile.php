<?php 
session_start();
include __DIR__ . '/db.php';

/* ===============================
   ตรวจสอบ login
=============================== */
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = (int)$_SESSION['user']['id'];
$success = "";
$error   = "";

/* ===============================
   UPDATE PROFILE
=============================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {

    $username  = trim($_POST['username']  ?? '');
    $email     = trim($_POST['email']     ?? '');
    $full_name = trim($_POST['full_name'] ?? '');

    /* ===============================
       UPLOAD IMAGE
    =============================== */
    $profile_image = null;

    if (!empty($_FILES['profile_image']['name'])) {

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        $file_name = $_FILES['profile_image']['name'];
        $tmp_name  = $_FILES['profile_image']['tmp_name'];

        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {

            $error = "รองรับเฉพาะไฟล์ JPG, PNG, WEBP";

        } else {

            $new_name = time() . '_' . rand(1000,9999) . '.' . $ext;

            if (!is_dir('uploads/profile')) {
                mkdir('uploads/profile', 0777, true);
            }

            move_uploaded_file(
                $tmp_name,
                'uploads/profile/' . $new_name
            );

            $profile_image = $new_name;
        }
    }

    if ($username === '' || $email === '') {

        $error = "กรุณากรอก Username และ Email";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "รูปแบบ Email ไม่ถูกต้อง";

    } else {

        /* ===============================
           CHECK DUPLICATE
        =============================== */
        $sql = "SELECT id FROM users
                WHERE (username = ? OR LOWER(email) = LOWER(?))
                AND id <> ?
                LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "ssi",
            $username,
            $email,
            $user_id
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_fetch_assoc($result)) {

            $error = "Username หรือ Email นี้ถูกใช้แล้ว";

            mysqli_stmt_close($stmt);

        } else {

            mysqli_stmt_close($stmt);

            /* ===============================
               UPDATE WITH IMAGE
            =============================== */
            if ($profile_image) {

                $sql = "
                    UPDATE users
                    SET
                        username = ?,
                        email = ?,
                        full_name = ?,
                        profile_image = ?
                    WHERE id = ?
                ";

                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_bind_param(
                    $stmt,
                    "ssssi",
                    $username,
                    $email,
                    $full_name,
                    $profile_image,
                    $user_id
                );

            } else {

                $sql = "
                    UPDATE users
                    SET
                        username = ?,
                        email = ?,
                        full_name = ?
                    WHERE id = ?
                ";

                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_bind_param(
                    $stmt,
                    "sssi",
                    $username,
                    $email,
                    $full_name,
                    $user_id
                );
            }

            if (mysqli_stmt_execute($stmt)) {

                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['email']    = $email;

                if ($profile_image) {
                    $_SESSION['user']['profile_image'] = $profile_image;
                }

                $success = "อัปเดตโปรไฟล์เรียบร้อย";

            } else {

                $error = "เกิดข้อผิดพลาด: " . mysqli_error($conn);

            }

            mysqli_stmt_close($stmt);
        }
    }
}

/* ===============================
   CHANGE PASSWORD
=============================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {

    $old_password     = $_POST['old_password']     ?? '';
    $new_password     = $_POST['new_password']     ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($old_password === '' || $new_password === '' || $confirm_password === '') {

        $error = "กรุณากรอกข้อมูลรหัสผ่านให้ครบ";

    } elseif (strlen($new_password) < 6) {

        $error = "รหัสผ่านใหม่ต้องมีอย่างน้อย 6 ตัวอักษร";

    } elseif ($new_password !== $confirm_password) {

        $error = "รหัสผ่านยืนยันไม่ตรงกัน";

    } else {

        $sql = "SELECT password FROM users WHERE id=? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $user_id);

        mysqli_stmt_execute($stmt);

        $row = mysqli_fetch_assoc(
            mysqli_stmt_get_result($stmt)
        );

        mysqli_stmt_close($stmt);

        if (!$row || !password_verify($old_password, $row['password'])) {

            $error = "รหัสผ่านเดิมไม่ถูกต้อง";

        } else {

            $hash = password_hash(
                $new_password,
                PASSWORD_DEFAULT
            );

            $sql  = "UPDATE users SET password=? WHERE id=?";

            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param(
                $stmt,
                "si",
                $hash,
                $user_id
            );

            if (mysqli_stmt_execute($stmt)) {

                $success = "เปลี่ยนรหัสผ่านเรียบร้อย";

            } else {

                $error = "เกิดข้อผิดพลาด: " . mysqli_error($conn);

            }

            mysqli_stmt_close($stmt);
        }
    }
}

/* ===============================
   GET USER
=============================== */
$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM users WHERE id=? LIMIT 1"
);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$data = mysqli_fetch_assoc(
    mysqli_stmt_get_result($stmt)
);

mysqli_stmt_close($stmt);

if (!$data) {
    die("ไม่พบข้อมูลผู้ใช้");
}

/* ===============================
   COUNT HISTORY
=============================== */
$count_history = 0;

$stmt = mysqli_prepare(
    $conn,
    "SELECT COUNT(*) AS total
     FROM search_history
     WHERE user_id=?"
);

mysqli_stmt_bind_param($stmt, "i", $user_id);

mysqli_stmt_execute($stmt);

$row = mysqli_fetch_assoc(
    mysqli_stmt_get_result($stmt)
);

$count_history = (int)($row['total'] ?? 0);

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="th">

<head>

<meta charset="UTF-8">

<title>
โปรไฟล์ของฉัน
</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

<?php
$page_title = 'โปรไฟล์ของฉัน';
include __DIR__ . '/includes/nav.php';
?>

<main class="flex-1 w-full max-w-5xl mx-auto px-6 py-10">

<?php if ($error): ?>

<div class="mb-5 bg-red-100 text-red-700 border border-red-200 px-4 py-3 rounded-xl">
    <?= htmlspecialchars($error) ?>
</div>

<?php endif; ?>

<?php if ($success): ?>

<div class="mb-5 bg-green-100 text-green-700 border border-green-200 px-4 py-3 rounded-xl">
    <?= htmlspecialchars($success) ?>
</div>

<?php endif; ?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- LEFT -->
    <div class="bg-white rounded-3xl shadow-lg p-6 text-center">

        <!-- PROFILE IMAGE -->
        <div class="w-28 h-28 mx-auto mb-4 rounded-full overflow-hidden border-4 border-emerald-100 shadow">

            <?php if (!empty($data['profile_image'])): ?>

                <img
                src="uploads/profile/<?= htmlspecialchars($data['profile_image']) ?>"
                class="w-full h-full object-cover">

            <?php else: ?>

                <div class="w-full h-full bg-gray-200 flex items-center justify-center">

                    <i class="fa-solid fa-user text-4xl text-gray-500"></i>

                </div>

            <?php endif; ?>

        </div>

        <h2 class="text-xl font-bold">
            <?= htmlspecialchars($data['username']) ?>
        </h2>

        <p class="text-gray-500 text-sm mb-4">
            <?= htmlspecialchars($data['email']) ?>
        </p>

        <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold
        <?= $data['role'] === 'admin'
            ? 'bg-yellow-100 text-yellow-700'
            : 'bg-emerald-100 text-emerald-700'
        ?>">

            <?= htmlspecialchars($data['role']) ?>

        </div>

        <hr class="my-6">

        <!-- HISTORY -->
        <a href="history.php"
           class="flex items-center justify-between
                  px-4 py-3 rounded-xl
                  bg-gray-50 hover:bg-emerald-50
                  transition mb-3">

            <span>
                <i class="fa-solid fa-clock-rotate-left me-2"></i>
                ประวัติการค้นหา
            </span>

            <span class="bg-emerald-500 text-white text-xs px-2 py-1 rounded-full">
                <?= $count_history ?>
            </span>

        </a>

        <!-- RECOMMEND -->
        <a href="recommend.php"
           class="flex items-center justify-between
                  px-4 py-3 rounded-xl
                  bg-gray-50 hover:bg-emerald-50
                  transition mb-3">

            <span>
                <i class="fa-solid fa-location-dot me-2"></i>
                ค้นหาสถานที่
            </span>

            <i class="fa-solid fa-arrow-right"></i>

        </a>

        <!-- ADMIN BUTTON -->
        <?php if ($data['role'] === 'admin'): ?>

        <a href="admin/places.php"
           class="flex items-center justify-between
                  px-4 py-3 rounded-xl
                  bg-yellow-50 hover:bg-yellow-100
                  border border-yellow-200
                  transition">

            <span class="font-medium text-yellow-800">
                <i class="fa-solid fa-gear me-2"></i>
                จัดการสถานที่
            </span>

            <i class="fa-solid fa-arrow-right text-yellow-700"></i>

        </a>

        <?php endif; ?>

    </div>

    <!-- RIGHT -->
    <div class="md:col-span-2 space-y-6">

        <!-- PROFILE -->
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <h3 class="text-lg font-bold mb-5">

                <i class="fa-solid fa-user-pen text-emerald-500 me-2"></i>
                ข้อมูลส่วนตัว

            </h3>

            <form method="post"
                  enctype="multipart/form-data"
                  class="space-y-4">

                <!-- IMAGE -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        รูปโปรไฟล์
                    </label>

                    <input
                    type="file"
                    name="profile_image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="w-full border rounded-xl px-3 py-2">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Username
                    </label>

                    <input
                    type="text"
                    name="username"
                    required
                    value="<?= htmlspecialchars($data['username']) ?>"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                    type="email"
                    name="email"
                    required
                    value="<?= htmlspecialchars($data['email']) ?>"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        ชื่อ - นามสกุล
                    </label>

                    <input
                    type="text"
                    name="full_name"
                    value="<?= htmlspecialchars($data['full_name'] ?? '') ?>"
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-300">

                </div>

                <button
                type="submit"
                name="update_profile"
                class="bg-emerald-500 hover:bg-emerald-600
                       text-white px-6 py-3 rounded-xl
                       font-medium transition">

                    <i class="fa-solid fa-floppy-disk me-2"></i>
                    บันทึกข้อมูล

                </button>

            </form>

        </div>

        <!-- PASSWORD -->
        <div class="bg-white rounded-3xl shadow-lg p-6">

            <h3 class="text-lg font-bold mb-5">

                <i class="fa-solid fa-lock text-emerald-500 me-2"></i>
                เปลี่ยนรหัสผ่าน

            </h3>

            <form method="post" class="space-y-4">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        รหัสผ่านเดิม
                    </label>

                    <input
                    type="password"
                    name="old_password"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        รหัสผ่านใหม่
                    </label>

                    <input
                    type="password"
                    name="new_password"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-300">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        ยืนยันรหัสผ่านใหม่
                    </label>

                    <input
                    type="password"
                    name="confirm_password"
                    required
                    class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-300">

                </div>

                <button
                type="submit"
                name="change_password"
                class="bg-gray-900 hover:bg-black
                       text-white px-6 py-3 rounded-xl
                       font-medium transition">

                    <i class="fa-solid fa-key me-2"></i>
                    เปลี่ยนรหัสผ่าน

                </button>

            </form>

        </div>

    </div>

</div>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>