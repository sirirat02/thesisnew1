<?php
include '../db.php';

/* =========================
   SUMMARY
========================= */

$totalPlaces = $conn->query("
SELECT COUNT(*) total
FROM places
")->fetch_assoc()['total'] ?? 0;

$totalUsers = $conn->query("
SELECT COUNT(*) total
FROM users
")->fetch_assoc()['total'] ?? 0;

$totalRecommend = $conn->query("
SELECT COUNT(*) total
FROM recommendation_logs
")->fetch_assoc()['total'] ?? 0;

$totalProvince = $conn->query("
SELECT COUNT(DISTINCT province) total
FROM places
")->fetch_assoc()['total'] ?? 0;


/* =========================
   TOP 5 PLACES
========================= */

$topPlaces = $conn->query("
SELECT
    p.name,
    COUNT(*) total
FROM recommendation_logs r
JOIN places p ON p.id = r.place_id
GROUP BY r.place_id
ORDER BY total DESC
LIMIT 5
");

/* =========================
   TOP STYLE
========================= */

$topStyles = $conn->query("
SELECT
    style_name,
    COUNT(*) total
FROM recommendation_logs
WHERE style_name IS NOT NULL
AND style_name <> ''
GROUP BY style_name
ORDER BY total DESC
LIMIT 5
");

$styleLabels = [];
$styleValues = [];

$styleResult = $conn->query("
SELECT
    style_name,
    COUNT(*) total
FROM recommendation_logs
WHERE style_name IS NOT NULL
AND style_name <> ''
GROUP BY style_name
ORDER BY total DESC
");

while($row = $styleResult->fetch_assoc()){

    $styleLabels[] = $row['style_name'];
    $styleValues[] = $row['total'];

}

$mostStyle = $conn->query("
SELECT
    style_name,
    COUNT(*) total
FROM recommendation_logs
WHERE style_name IS NOT NULL
AND style_name <> ''
GROUP BY style_name
ORDER BY total DESC
LIMIT 1
")->fetch_assoc();
/* =========================
   CHART
========================= */

$chartLabels = [];
$chartValues = [];

$result = $conn->query("
SELECT
    DATE(created_at) day,
    COUNT(*) total
FROM recommendation_logs
GROUP BY DATE(created_at)
ORDER BY day
");

while($row = $result->fetch_assoc()){
    $chartLabels[] = $row['day'];
    $chartValues[] = $row['total'];
}

$placeLabels = [];
$placeValues = [];

$topPlacesChart = $conn->query("
SELECT
    p.name,
    COUNT(*) total
FROM recommendation_logs r
JOIN places p ON p.id = r.place_id
GROUP BY r.place_id
ORDER BY total DESC
LIMIT 5
");

while($row = $topPlacesChart->fetch_assoc()){

    $placeLabels[] = $row['name'];
    $placeValues[] = $row['total'];

}

?>

<!DOCTYPE html>
<html lang="th">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-slate-100">

<!-- SIDEBAR -->

<body class="bg-slate-100">

<!-- SIDEBAR -->

<div class="fixed left-0 top-0 w-64 h-screen bg-gradient-to-b from-emerald-600 via-green-700 to-emerald-900 text-white shadow-2xl">

<!-- LOGO -->

<div class="p-6 border-b border-white/10">

    <div class="flex items-center gap-3">

        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur">

            <i class="fas fa-mountain text-xl"></i>

        </div>

        <div>

            <h1 class="text-2xl font-bold">
                Dashboard
            </h1>

            <p class="text-xs text-green-100">
                Tourism Recommendation
            </p>

        </div>

    </div>

</div>

<!-- MENU -->

<nav class="p-4 space-y-3">

    <!-- Dashboard -->

    <a href="dashboard.php"
       class="group flex items-center gap-4 p-4 rounded-2xl bg-white/15 hover:bg-white/25 transition-all duration-300 shadow">

        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">

            <i class="fas fa-chart-line"></i>

        </div>

        <span class="font-medium">
            Dashboard
        </span>

    </a>

    <!-- Places -->

    <a href="places.php"
       class="group flex items-center gap-4 p-4 rounded-2xl hover:bg-white/10 transition-all duration-300">

        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">

            <i class="fas fa-map-marker-alt"></i>

        </div>

        <span class="font-medium">
            จัดการสถานที่
        </span>

    </a>
    

</nav>

<!-- FOOTER -->

<div class="absolute bottom-0 left-0 right-0 p-5 border-t border-white/10">

    <div class="text-center text-sm text-green-100">

        <i class="fas fa-tree mr-1"></i>
        Northern Thailand Travel System

    </div>

</div>


</div>


<!-- CONTENT -->

<div class="ml-64 p-8">

    <div class="mb-8">

        <span class="text-green-600 text-sm font-semibold uppercase tracking-wider">
            Admin Dashboard
        </span>

        <h2 class="text-4xl font-bold text-gray-800 mt-1">
            Dashboard
        </h2>

        <p class="text-gray-500 mt-2">
            สรุปข้อมูลระบบแนะนำสถานที่ท่องเที่ยว
        </p>

    </div>

    <!-- CARDS -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500 text-sm">
                        สถานที่ทั้งหมด
                    </p>

                    <h3 class="text-3xl font-bold">
                        <?= $totalPlaces ?>
                    </h3>
                </div>

                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500 text-sm">
                        สมาชิกทั้งหมด
                    </p>

                    <h3 class="text-3xl font-bold">
                        <?= $totalUsers ?>
                    </h3>
                </div>

                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-green-600 text-xl"></i>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500 text-sm">
                        การแนะนำทั้งหมด
                    </p>

                    <h3 class="text-3xl font-bold">
                        <?= $totalRecommend ?>
                    </h3>
                </div>

                <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500 text-sm">
                        จังหวัดทั้งหมด
                    </p>

                    <h3 class="text-3xl font-bold">
                        <?= $totalProvince ?>
                    </h3>
                </div>

                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-map text-purple-600 text-xl"></i>
                </div>

            </div>

        </div>

</div>


    <!-- CHART + TOP -->

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">

        <!-- แนวโน้มการใช้งาน -->

        <div class="bg-white rounded-3xl shadow-lg p-6">

            <h3 class="text-xl font-bold mb-4">
                แนวโน้มการใช้งานระบบ
            </h3>

            <div class="h-[350px]">
                <canvas id="usageChart"></canvas>
            </div>

        </div>

        <!-- กราฟวงกลม -->

        <div class="bg-white rounded-3xl shadow-lg p-6">

            <h3 class="text-xl font-bold mb-4">
                สไตล์การท่องเที่ยวยอดนิยม
            </h3>

            <div class="relative h-[420px]">
                <canvas id="styleChart"></canvas>
            </div>

        </div>

    </div>
    <!-- TOP SECTION -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- TOP PLACE -->

        <div class="bg-white rounded-3xl shadow-lg p-6">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h3 class="text-xl font-bold text-gray-800">
                        Top 5 สถานที่ยอดนิยม
                    </h3>

                    <p class="text-sm text-gray-500">
                        สถานที่ที่ถูกแนะนำมากที่สุด
                    </p>

                </div>

                <div class="w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i class="fas fa-map-marker-alt text-blue-600"></i>

                </div>

            </div>

            <div style="height:320px">

                <canvas id="placeChart"></canvas>

            </div>

        </div>

    <!-- TOP STYLE -->

    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h3 class="text-xl font-bold text-gray-800">
                    Top 5 สไตล์ยอดนิยม
                </h3>

                <p class="text-sm text-gray-500">
                    รูปแบบการท่องเที่ยวที่ผู้ใช้นิยม
                </p>

            </div>

            <div class="w-12 h-12 rounded-2xl bg-purple-100 flex items-center justify-center">

                <i class="fas fa-chart-pie text-purple-600"></i>

            </div>

        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-100">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-4 py-3 text-sm font-semibold text-gray-600">
                            สไตล์
                        </th>

                        <th class="text-center px-4 py-3 text-sm font-semibold text-gray-600">
                            จำนวนครั้ง
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php mysqli_data_seek($topStyles, 0); ?>

                    <?php
                    $rank = 1;
                    while($style = $topStyles->fetch_assoc()):
                    ?>

                    <tr class="border-t hover:bg-gray-50 transition">

                        <td class="px-4 py-4">

                            <div class="flex items-center gap-3">

                                <span class="
                                w-8 h-8
                                rounded-full
                                bg-purple-100
                                text-purple-700
                                text-sm
                                font-bold
                                flex
                                items-center
                                justify-center
                                ">
                                    <?= $rank ?>
                                </span>

                                <span class="font-medium text-gray-700">
                                    <?= htmlspecialchars($style['style_name']) ?>
                                </span>

                            </div>

                        </td>

                        <td class="text-center font-bold text-purple-600">

                            <?= number_format($style['total']) ?>

                        </td>

                    </tr>

                    <?php
                    $rank++;
                    endwhile;
                    ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
<script>

const labels = <?= json_encode($chartLabels, JSON_UNESCAPED_UNICODE); ?>;
const totals = <?= json_encode($chartValues, JSON_UNESCAPED_UNICODE); ?>;

const styleLabels = <?= json_encode($styleLabels, JSON_UNESCAPED_UNICODE); ?>;
const styleValues = <?= json_encode($styleValues, JSON_UNESCAPED_UNICODE); ?>;
const placeLabels = <?= json_encode($placeLabels, JSON_UNESCAPED_UNICODE); ?>;
const placeValues = <?= json_encode($placeValues, JSON_UNESCAPED_UNICODE); ?>;

console.log(labels);
console.log(totals);


/* ======================
   STYLE CHART
====================== */

if(document.getElementById('styleChart')){

    new Chart(document.getElementById('styleChart'),{

        type:'doughnut',

        data:{
            labels:styleLabels,

            datasets:[{
                data:styleValues,

                backgroundColor:[
                    '#3b82f6',
                    '#8b5cf6',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#06b6d4'
                ]
            }]
        },

        options:{
            responsive:true,
            maintainAspectRatio:false,

            plugins:{
                legend:{
                    position:'bottom'
                }
            }
        }

    });

}

/* ======================
   USAGE CHART
====================== */
new Chart(document.getElementById('usageChart'), {

    type:'line',

    data:{
        labels:labels,
        datasets:[{
            label:'จำนวนการแนะนำ',
            data:totals,
            borderColor:'#2563eb',
            backgroundColor:'rgba(37,99,235,.15)',
            fill:true,
            tension:0.4
        }]
    },

    options:{
        responsive:true,
        maintainAspectRatio:false, // สำคัญ

        scales:{
            y:{
                beginAtZero:true
            }
        }
    }
});

/* ======================
   PLACE CHART
====================== */
if(document.getElementById('placeChart')){

    new Chart(document.getElementById('placeChart'),{

        type:'bar',

        data:{
            labels:placeLabels,

            datasets:[{
                label:'จำนวนครั้ง',
                data:placeValues,
                backgroundColor:'#3b82f6',
                borderRadius:10
            }]
        },

        options:{
            responsive:true,
            maintainAspectRatio:false,

            plugins:{
                legend:{
                    display:false
                }
            },

            scales:{
                y:{
                    beginAtZero:true
                }
            }
        }
    });
}

</script>
</body>
</html>