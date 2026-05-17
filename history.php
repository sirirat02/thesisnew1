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

/* ===============================
   DELETE (single)
=============================== */
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $stmt = mysqli_prepare(
        $conn,
        "DELETE FROM search_history WHERE id=? AND user_id=?"
    );
    mysqli_stmt_bind_param($stmt, "ii", $delete_id, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: history.php");
    exit;
}

/* ===============================
   CLEAR ALL
=============================== */
if (isset($_GET['clear']) && $_GET['clear'] === '1') {
    $stmt = mysqli_prepare($conn, "DELETE FROM search_history WHERE user_id=?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: history.php");
    exit;
}

/* ===============================
   GET HISTORY
=============================== */
$sql = "
    SELECT 
        h.*,
        p.name AS place_name,
        c.name AS category_name
    FROM search_history h
    LEFT JOIN places p ON h.place_id = p.id
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE h.user_id = ?
    ORDER BY h.created_at DESC
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num_rows = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ประวัติการค้นหา</title>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

<?php
$page_title = 'ประวัติการค้นหาของฉัน';
include __DIR__ . '/includes/nav.php';
?>

<main class="flex-1 w-full max-w-5xl mx-auto px-6 py-10">

  <!-- HEADER -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h2 class="text-2xl font-bold">
        <i class="fa-solid fa-clock-rotate-left text-emerald-500"></i>
        ประวัติการค้นหา
      </h2>
      <p class="text-gray-500 text-sm mt-1">
        ทั้งหมด <?= $num_rows ?> รายการ
      </p>
    </div>

    <div class="flex gap-2">
      <a href="recommend.php"
         class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
        <i class="fa-solid fa-plus me-1"></i> ค้นหาใหม่
      </a>
      <?php if ($num_rows > 0): ?>
        <a href="?clear=1"
           onclick="return confirm('ลบประวัติทั้งหมดจริงไหม?')"
           class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
          <i class="fa-solid fa-trash me-1"></i> ล้างทั้งหมด
        </a>
      <?php endif; ?>
    </div>
  </div>

  <?php if ($num_rows === 0): ?>

    <div class="bg-white rounded-2xl shadow p-12 text-center">
      <i class="fa-solid fa-folder-open text-5xl text-gray-300 mb-4"></i>
      <h3 class="text-lg font-semibold text-gray-600 mb-2">ยังไม่มีประวัติการค้นหา</h3>
      <p class="text-sm text-gray-500 mb-6">
        เริ่มต้นค้นหาสถานที่ท่องเที่ยวที่เหมาะกับคุณได้เลย
      </p>
      <a href="recommend.php"
         class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-full font-semibold transition">
        <i class="fa-solid fa-magnifying-glass me-1"></i> เริ่มค้นหา
      </a>
    </div>

  <?php else: ?>

    <div class="space-y-3">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <?php
            $cost_per_person = $row['group_size'] > 0
                ? floor($row['budget_total'] / $row['group_size'])
                : 0;

            // build URL ไป result.php (ค้นหาซ้ำ)
            $rerun_url = 'result.php?' . http_build_query([
                'category'     => $row['category_id'],
                'budget_total' => $row['budget_total'],
                'group_size'   => $row['group_size'],
                'days'         => $row['planning_days']
            ]);
        ?>

        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-5
                    border-l-4 border-emerald-400">

          <div class="flex items-start justify-between gap-4 flex-wrap">

            <!-- LEFT: details -->
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-2 mb-2">
                <span class="bg-emerald-100 text-emerald-700 text-xs font-semibold px-2 py-1 rounded">
                  <?= htmlspecialchars($row['travel_style']) ?>
                </span>
                <?php if (!empty($row['category_name'])): ?>
                  <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">
                    <?= htmlspecialchars($row['category_name']) ?>
                  </span>
                <?php endif; ?>
                <span class="text-xs text-gray-400">
                  <i class="fa-regular fa-clock"></i>
                  <?= date('d/m/Y H:i', strtotime($row['created_at'])) ?>
                </span>
              </div>

              <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                <div>
                  <div class="text-gray-400 text-xs">จำนวนวัน</div>
                  <div class="font-semibold">
                    <i class="fa-regular fa-calendar"></i>
                    <?= (int)$row['planning_days'] ?> วัน
                  </div>
                </div>
                <div>
                  <div class="text-gray-400 text-xs">จำนวนคน</div>
                  <div class="font-semibold">
                    <i class="fa-solid fa-users"></i>
                    <?= (int)$row['group_size'] ?> คน
                  </div>
                </div>
                <div>
                  <div class="text-gray-400 text-xs">งบรวม</div>
                  <div class="font-semibold">
                    <i class="fa-solid fa-coins"></i>
                    <?= number_format($row['budget_total']) ?> ฿
                  </div>
                </div>
                <div>
                  <div class="text-gray-400 text-xs">เฉลี่ย/คน</div>
                  <div class="font-semibold text-emerald-600">
                    <?= number_format($cost_per_person) ?> ฿
                  </div>
                </div>
              </div>
            </div>

            <!-- RIGHT: actions -->
            <div class="flex flex-col gap-2 shrink-0">
              <a href="<?= $rerun_url ?>"
                 class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg text-xs font-medium transition text-center">
                <i class="fa-solid fa-rotate-right me-1"></i> ค้นหาซ้ำ
              </a>
              <a href="?delete=<?= $row['id'] ?>"
                 onclick="return confirm('ลบรายการนี้?')"
                 class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg text-xs font-medium transition text-center">
                <i class="fa-solid fa-trash me-1"></i> ลบ
              </a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

  <?php endif; ?>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>

</body>
</html>
