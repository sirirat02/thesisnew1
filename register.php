<?php
session_start();

include __DIR__ . '/db.php';

$error   = "";
$success = "";

/*
 |----------------------------------------
 | REGISTER PROCESS
 |----------------------------------------
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username  = trim($_POST['username']  ?? '');
    $email     = trim($_POST['email']     ?? '');
    $full_name = trim($_POST['full_name'] ?? '');
    $password  = $_POST['password']         ?? '';
    $confirm   = $_POST['confirm_password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $error = " กรุณากรอกข้อมูลให้ครบ";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = " รูปแบบ Email ไม่ถูกต้อง";
    } elseif (strlen($password) < 6) {
        $error = " รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร";
    } elseif ($password !== $confirm) {
        $error = " รหัสผ่านยืนยันไม่ตรงกัน";
    } else {

        // ตรวจสอบ username / email ซ้ำ
        $sql = "SELECT id FROM users WHERE username = ? OR LOWER(email) = LOWER(?) LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->fetch_assoc()) {
            $error = " Username หรือ Email นี้ถูกใช้แล้ว";
            $stmt->close();
        } else {
            $stmt->close();

            //  insert user ใหม่ (role = user เสมอ)
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';

            $sql = "INSERT INTO users (username, email, password, role, full_name)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $username, $email, $hash, $role, $full_name);

            if ($stmt->execute()) {
                $success = " สมัครสมาชิกสำเร็จ! กำลังพาไปหน้า Login...";
                header("refresh:2; url=login.php");
            } else {
                $error = " เกิดข้อผิดพลาด: " . $conn->error;
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>สมัครสมาชิก</title>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<!-- BACK -->
<a href="index.php"
   class="fixed top-6 left-6 z-50 flex items-center gap-2
          rounded-full border border-white/40
          bg-white/10 px-5 py-2
          text-sm text-white backdrop-blur-md
          transition hover:bg-white/20 hover:border-white/70">
    <i class="fa-solid fa-arrow-left"></i>
    Back to Home
</a>

<div class="flex min-h-screen items-center justify-center bg-gray-900 bg-cover py-10"
     style="background-image:url('images/ThailandTravelNorthjpg.jpg')">

  <div class="rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">

      <div class="mb-8 flex flex-col items-center">
        <div class="w-20 h-20 rounded-full border-2 border-white flex items-center justify-center mb-4">
            <i class="fa-solid fa-user-plus text-4xl"></i>
        </div>
        <h1 class="text-2xl font-semibold">สมัครสมาชิก</h1>
        <span class="text-gray-300">สร้างบัญชีเพื่อเริ่มค้นหาสถานที่ท่องเที่ยว</span>
      </div>

      <?php if ($error): ?>
        <div class="mb-4 text-center text-red-400">
            <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="mb-4 text-center text-green-400">
            <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-4">
          <input
            class="w-full rounded-3xl bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-white placeholder-slate-200 outline-none"
            type="text"
            name="username"
            placeholder="Username"
            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
            required>
        </div>

        <div class="mb-4">
          <input
            class="w-full rounded-3xl bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-white placeholder-slate-200 outline-none"
            type="email"
            name="email"
            placeholder="Email"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
            required>
        </div>

        <div class="mb-4">
          <input
            class="w-full rounded-3xl bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-white placeholder-slate-200 outline-none"
            type="text"
            name="full_name"
            placeholder="ชื่อ-นามสกุล (ไม่บังคับ)"
            value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>">
        </div>

        <div class="mb-4">
          <input
            class="w-full rounded-3xl bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-white placeholder-slate-200 outline-none"
            type="password"
            name="password"
            placeholder="Password (อย่างน้อย 6 ตัวอักษร)"
            required>
        </div>

        <div class="mb-6">
          <input
            class="w-full rounded-3xl bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-white placeholder-slate-200 outline-none"
            type="password"
            name="confirm_password"
            placeholder="ยืนยัน Password"
            required>
        </div>

        <div class="flex justify-center mb-4">
          <button
            type="submit"
            class="rounded-3xl bg-yellow-400 px-10 py-2
                   text-black font-semibold shadow-xl
                   transition hover:bg-yellow-500">
            สมัครสมาชิก
          </button>
        </div>

        <div class="text-center text-sm text-gray-300">
          มีบัญชีอยู่แล้ว?
          <a href="login.php" class="text-yellow-400 hover:underline">เข้าสู่ระบบ</a>
        </div>
      </form>

    </div>
  </div>
</div>

</body>
</html>
