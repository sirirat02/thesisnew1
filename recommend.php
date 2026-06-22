<?php
session_start();
include 'db.php';

/* ===============================
   HANDLE FORM SUBMIT
=============================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $planning_days = max(
        (int)($_POST['planning_days'] ?? 1),
        1
    );

    $group_size = max(
        (int)($_POST['group_size'] ?? 1),
        1
    );

    $budget_total = max(
        (int)($_POST['budget_total'] ?? 100),
        100
    );

    $travel_style =
        trim($_POST['travel_style'] ?? '');

    /* ===============================
       VALIDATE
    =============================== */
    $errors = [];

    if ($planning_days < 1) {
        $errors[] = 'จำนวนวันต้องมากกว่า 0';
    }

    if ($group_size < 1) {
        $errors[] = 'จำนวนคนต้องมากกว่า 0';
    }

    if ($budget_total < 100) {
        $errors[] = 'งบประมาณต้องไม่น้อยกว่า 100 บาท';
    }

    if ($travel_style === '') {
        $errors[] = 'กรุณาเลือกสไตล์การท่องเที่ยว';
    }

    /* ===============================
       ERROR
    =============================== */
    if (!empty($errors)) {

        $_SESSION['form_errors'] = $errors;

        $_SESSION['old_form'] = [

            'planning_days' => $planning_days,
            'group_size'    => $group_size,
            'budget_total'  => $budget_total,
            'travel_style'  => $travel_style

        ];

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    /* ===============================
       FIND CATEGORY
    =============================== */
    $category_id = null;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id
         FROM categories
         WHERE name = ?
         LIMIT 1"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $travel_style
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {

        $category_id = (int)$row['id'];

    }

    mysqli_stmt_close($stmt);

    /* ===============================
       CATEGORY NOT FOUND
    =============================== */
    if ($category_id === null) {

        header(
            "Location: recommend.php?error=category_not_found"
        );

        exit;
    }

    /* ===============================
       SAVE HISTORY
    =============================== */
    if (isset($_SESSION['user'])) {

        $user_id =
            (int)$_SESSION['user']['id'];

        $sql = "
            INSERT INTO search_history
            (
                user_id,
                planning_days,
                group_size,
                budget_total,
                travel_style,
                category_id
            )
            VALUES (?, ?, ?, ?, ?, ?)
        ";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "iiiisi",
            $user_id,
            $planning_days,
            $group_size,
            $budget_total,
            $travel_style,
            $category_id
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

    /* ===============================
       SAVE LAST FORM
    =============================== */
    $_SESSION['old_form'] = [

        'planning_days' => $planning_days,
        'group_size'    => $group_size,
        'budget_total'  => $budget_total,
        'travel_style'  => $travel_style

    ];

    /* ===============================
       REDIRECT RESULT
    =============================== */
    header("Location: result.php?" . http_build_query([

        'category'     => $category_id,
        'budget_total' => $budget_total,
        'group_size'   => $group_size,
        'days'         => $planning_days

    ]));

    exit;
}

/* ===============================
   OLD FORM DATA
=============================== */
$old = $_SESSION['old_form'] ?? [];

?>

<!DOCTYPE html>
<html lang="th">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
    แนะนำสถานที่ท่องเที่ยวภาคเหนือ
</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="min-h-screen flex flex-col
             bg-cover bg-center bg-no-repeat"

style="background-image:
url('images/ThailandTravelNorthjpg.jpg');">

<?php
$page_title = 'แนะนำสถานที่ท่องเที่ยวภาคเหนือ';
$nav_transparent = true;

include __DIR__ . '/includes/nav.php';
?>

<!-- MAIN -->
<main class="flex-1 flex items-center justify-center
             px-4 py-10">

    <div class="w-full max-w-lg
                bg-white/95 backdrop-blur-sm
                rounded-3xl shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="px-6 py-5 border-b
                    text-center bg-blue-50">

            <h1 class="text-2xl font-bold text-blue-700">

                ✨ แนะนำสถานที่ท่องเที่ยวภาคเหนือ

            </h1>

            <p class="text-sm text-gray-600 mt-2">

                กรอกข้อมูลเพื่อให้ระบบวิเคราะห์แนวทางการท่องเที่ยว

            </p>

        </div>

        <!-- ERROR -->
        <?php if (!empty($_SESSION['form_errors'])): ?>

            <div class="mx-6 mt-5
                        bg-red-50 border border-red-200
                        text-red-700 rounded-xl p-4 text-sm">

                <ul class="list-disc pl-5 space-y-1">

                    <?php foreach ($_SESSION['form_errors'] as $error): ?>

                        <li>

                            <?= htmlspecialchars($error) ?>

                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

            <?php unset($_SESSION['form_errors']); ?>

        <?php endif; ?>

        <!-- FORM -->
        <div class="px-6 py-6">

            <form method="post"
                  id="travelForm"
                  class="space-y-5 text-sm">

                <!-- DAYS -->
                <div>

                    <label class="block mb-2
                                  font-medium text-gray-700">

                        เที่ยวกี่วัน

                    </label>

                    <input
                        type="number"
                        name="planning_days"
                        required
                        min="1"

                        value="<?= htmlspecialchars($old['planning_days'] ?? '') ?>"

                        class="w-full border border-gray-300
                               rounded-xl px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-400">

                </div>

                <!-- GROUP -->
                <div>

                    <label class="block mb-2
                                  font-medium text-gray-700">

                        เดินทางกี่คน

                    </label>

                    <input
                        type="number"
                        name="group_size"
                        required
                        min="1"

                        value="<?= htmlspecialchars($old['group_size'] ?? '') ?>"

                        class="w-full border border-gray-300
                               rounded-xl px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-400">

                </div>

                <!-- BUDGET -->
                <div>

                    <label class="block mb-2
                                  font-medium text-gray-700">

                        งบประมาณรวม (บาท)

                    </label>

                    <input
                        type="number"
                        name="budget_total"
                        required
                        min="100"
                        step="100"

                        value="<?= htmlspecialchars($old['budget_total'] ?? '') ?>"

                        class="w-full border border-gray-300
                               rounded-xl px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-400">

                </div>

                <!-- STYLE -->
                <div>

                    <label class="block mb-2
                                  font-medium text-gray-700">

                        สไตล์การท่องเที่ยว 

                    </label>

                    <select
                        name="travel_style"
                        required

                        class="w-full border border-gray-300
                               rounded-xl px-4 py-3
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-400">

                        <option value="">
                            -- เลือกสไตล์การท่องเที่ยว --
                        </option>

                        <option value="ธรรมชาติ"
                        <?= (($old['travel_style'] ?? '') === 'ธรรมชาติ') ? 'selected' : '' ?>>

                            ธรรมชาติ

                        </option>

                        <option value="ภูเขา"
                        <?= (($old['travel_style'] ?? '') === 'ภูเขา') ? 'selected' : '' ?>>

                            ภูเขา

                        </option>

                        <option value="วัฒนธรรม"
                        <?= (($old['travel_style'] ?? '') === 'วัฒนธรรม') ? 'selected' : '' ?>>

                            วัฒนธรรม

                        </option>

                        <option value="คาเฟ่"
                        <?= (($old['travel_style'] ?? '') === 'คาเฟ่') ? 'selected' : '' ?>>

                            คาเฟ่

                        </option>

                        <option value="เมือง"
                        <?= (($old['travel_style'] ?? '') === 'เมือง') ? 'selected' : '' ?>>

                            เมือง

                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    id="submitBtn"

                    class="w-full
                           bg-blue-500 hover:bg-blue-600
                           transition duration-200
                           text-white py-3 rounded-full
                           font-bold text-base shadow-md">

                    <i class="fa-solid fa-map-location-dot mr-2"></i>

                    แนะนำสถานที่

                </button>

            </form>

        </div>

    </div>

</main>

<!-- LOADING -->
<div id="loadingScreen"

     class="hidden fixed inset-0 z-50
            bg-black/60 backdrop-blur-sm
            flex items-center justify-center">

    <div class="bg-white rounded-3xl
                px-10 py-8 shadow-2xl
                text-center max-w-sm w-full">

        <div class="flex justify-center mb-5">

            <div class="w-16 h-16 border-4
                        border-blue-200
                        border-t-blue-500
                        rounded-full animate-spin">
            </div>

        </div>

        <h2 class="text-xl font-bold
                   text-blue-600 mb-2">

            กรุณารอสักครู่...

        </h2>

        <p class="text-gray-500 text-sm">

            ระบบกำลังค้นหาสถานที่ที่เหมาะกับคุณ

        </p>

    </div>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const form =
        document.getElementById('travelForm');

    const loadingScreen =
        document.getElementById('loadingScreen');

    const submitBtn =
        document.getElementById('submitBtn');

    // ซ่อน loading ตอนเปิดหน้า
    loadingScreen.classList.add('hidden');

    // แก้ browser cache
    window.addEventListener('pageshow', function () {

        loadingScreen.classList.add('hidden');

        submitBtn.disabled = false;

    });

    // submit
    form.addEventListener('submit', function () {

        loadingScreen.classList.remove('hidden');

        submitBtn.disabled = true;

    });

});

</script>

</body>
</html>