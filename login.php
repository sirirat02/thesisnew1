<?php
session_start();

include __DIR__ . '/db.php';

$error = "";

/*
 |----------------------------------------
 | LOGIN PROCESS
 |----------------------------------------
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login    = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login === '' || $password === '') {
        $error = " กรุณากรอก Username / Email และ Password";
    } else {

        $sql = "
            SELECT id, username, email, password, role
            FROM users
            WHERE username = ?
               OR LOWER(email) = LOWER(?)
            LIMIT 1
        ";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $error = " SQL Error";
        } else {

            $stmt->bind_param("ss", $login, $login);
            $stmt->execute();
            $result = $stmt->get_result();
            $user   = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {

                //  เก็บ session
                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'email'    => $user['email'],
                    'role'     => $user['role']
                ];

                //  redirect ตาม role
                if ($user['role'] === 'admin') {
                    header("Location: admin/places.php");
                } else {
                    header("Location: index.php");
                }
                exit;

            } else {
                $error = " Username / Email หรือ Password ไม่ถูกต้อง";
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
<title>เข้าสู่ระบบ</title>

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

<div class="flex h-screen items-center justify-center bg-gray-900 bg-cover"
     style="background-image:url('images/ThailandTravelNorthjpg.jpg')">

  <div class="rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">

      <div class="mb-8 flex flex-col items-center">
        <div class="w-20 h-20 rounded-full border-2 border-white flex items-center justify-center mb-4">
            <i class="fa-regular fa-circle-user text-5xl"></i>
        </div>
        <h1 class="text-2xl font-semibold">Login</h1>
        <span class="text-gray-300">เข้าสู่ระบบเพื่อใช้งาน</span>
      </div>

      <?php if ($error): ?>
        <div class="mb-4 text-center text-red-400">
            <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-4">
          <input
            class="w-full rounded-3xl bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-white placeholder-slate-200 outline-none"
            type="text"
            name="username"
            placeholder="Username หรือ Email"
            required>
        </div>

        <div class="mb-6">
          <input
            class="w-full rounded-3xl bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-white placeholder-slate-200 outline-none"
            type="password"
            name="password"
            placeholder="Password"
            required>
        </div>

        <div class="flex justify-center mb-4">
          <button
            type="submit"
            class="rounded-3xl bg-yellow-400 px-10 py-2
                   text-black font-semibold shadow-xl
                   transition hover:bg-yellow-500">
            Login
          </button>
        </div>

        <div class="text-center text-sm text-gray-300">
          ยังไม่มีบัญชี?
          <a href="register.php" class="text-yellow-400 hover:underline">สมัครสมาชิก</a>
        </div>
      </form>

    </div>
  </div>
</div>

</body>
</html>
