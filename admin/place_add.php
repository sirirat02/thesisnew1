<?php
include __DIR__ . '/../db.php';

/* ===============================
   INSERT
=============================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $province    = mysqli_real_escape_string($conn, $_POST['province']);
    $latitude    = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude   = mysqli_real_escape_string($conn, $_POST['longitude']);
    $category_id = (int)$_POST['category_id'];

    /* ===============================
       INSERT PLACE
    =============================== */
    $sql = "
        INSERT INTO places
        (
            name,
            description,
            province,
            latitude,
            longitude,
            category_id
        )
        VALUES
        (
            '$name',
            '$description',
            '$province',
            '$latitude',
            '$longitude',
            '$category_id'
        )
    ";

    if (!$conn->query($sql)) {
        die("SQL Error: " . $conn->error);
    }

    $place_id = $conn->insert_id;

    /* ===============================
       UPLOAD MULTIPLE IMAGES
       รูปแรก = COVER IMAGE
    =============================== */
    if (!empty($_FILES['images']['name'][0])) {

        $uploadDir = __DIR__ . '/../uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $firstImage = null;

        foreach ($_FILES['images']['name'] as $key => $imageName) {

            if ($_FILES['images']['error'][$key] === 0) {

                $tmpName = $_FILES['images']['tmp_name'][$key];

                $safeName = preg_replace(
                    '/[^a-zA-Z0-9\._-]/',
                    '_',
                    $imageName
                );

                $filename =
                    time() .
                    '_' .
                    rand(1000,9999) .
                    '_' .
                    $safeName;

                $target = $uploadDir . $filename;

                if (move_uploaded_file($tmpName, $target)) {

                    // รูปแรก = cover
                    if ($firstImage === null) {
                        $firstImage = $filename;
                    }

                    // insert db
                    $conn->query("
                        INSERT INTO place_images
                        (
                            place_id,
                            image_name
                        )
                        VALUES
                        (
                            '$place_id',
                            '$filename'
                        )
                    ");
                }
            }
        }

        /* ===============================
           UPDATE COVER IMAGE
        =============================== */
        if ($firstImage !== null) {

            $safeCover = mysqli_real_escape_string(
                $conn,
                $firstImage
            );

            $conn->query("
                UPDATE places
                SET cover_image = '$safeCover'
                WHERE id = '$place_id'
            ");
        }
    }

    header("Location: places.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">

<head>

<meta charset="UTF-8">

<title>เพิ่มสถานที่</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">

<!-- TOPBAR -->
<div class="bg-white shadow-sm border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-6 py-4
                flex items-center justify-between flex-wrap gap-4">

        <!-- LEFT -->
        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-2xl
                        bg-emerald-500 text-white
                        flex items-center justify-center shadow">

                <i class="fa-solid fa-location-dot"></i>

            </div>

            <div>

                <h1 class="text-lg font-bold">
                    Travel Admin
                </h1>

                <p class="text-sm text-gray-500">
                    ระบบจัดการสถานที่ท่องเที่ยว
                </p>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="flex gap-2">

            <a href="/thesis/admin/places.php"
               class="bg-gray-100 hover:bg-gray-200
                      px-4 py-2 rounded-xl
                      text-sm font-medium transition">

                <i class="fa-solid fa-arrow-left"></i>
                กลับ

            </a>

            <a href="/thesis/index.php"
               class="bg-emerald-500 hover:bg-emerald-600
                      text-white px-4 py-2 rounded-xl
                      text-sm font-semibold transition shadow">

                <i class="fa-solid fa-house"></i>
                หน้าเว็บ

            </a>

        </div>

    </div>

</div>

<!-- CONTENT -->
<div class="max-w-4xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="mb-8">

        <h2 class="text-3xl font-bold mb-2">

            <i class="fa-solid fa-plus text-emerald-500"></i>
            เพิ่มสถานที่ท่องเที่ยว

        </h2>

        <p class="text-gray-500">
            เพิ่มข้อมูลสถานที่ใหม่เข้าสู่ระบบ
        </p>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form method="post"
              enctype="multipart/form-data"
              class="space-y-6">

            <!-- NAME -->
            <div>

                <label class="block text-sm font-semibold mb-2">
                    ชื่อสถานที่
                </label>

                <input
                type="text"
                name="name"
                required
                placeholder="เช่น ภูชี้ฟ้า"
                class="w-full border border-gray-200
                       rounded-2xl px-4 py-3
                       focus:ring-2 focus:ring-emerald-400
                       focus:outline-none">

            </div>

            <!-- DESCRIPTION -->
            <div>

                <label class="block text-sm font-semibold mb-2">
                    รายละเอียด
                </label>

                <textarea
                name="description"
                rows="5"
                placeholder="รายละเอียดสถานที่ท่องเที่ยว..."
                class="w-full border border-gray-200
                       rounded-2xl px-4 py-3
                       focus:ring-2 focus:ring-emerald-400
                       focus:outline-none"></textarea>

            </div>

            <!-- GRID -->
            <div class="grid md:grid-cols-2 gap-5">

                <!-- PROVINCE -->
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        จังหวัด
                    </label>

                    <input
                    type="text"
                    name="province"
                    placeholder="เช่น เชียงราย"
                    class="w-full border border-gray-200
                           rounded-2xl px-4 py-3
                           focus:ring-2 focus:ring-emerald-400
                           focus:outline-none">

                </div>

                <!-- CATEGORY -->
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Category ID
                    </label>

                    <input
                    type="number"
                    name="category_id"
                    placeholder="เช่น 1"
                    class="w-full border border-gray-200
                           rounded-2xl px-4 py-3
                           focus:ring-2 focus:ring-emerald-400
                           focus:outline-none">

                </div>

            </div>

            <!-- LAT LNG -->
            <div class="grid md:grid-cols-2 gap-5">

                <!-- LAT -->
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Latitude
                    </label>

                    <input
                    type="text"
                    name="latitude"
                    placeholder="18.7883"
                    class="w-full border border-gray-200
                           rounded-2xl px-4 py-3
                           focus:ring-2 focus:ring-emerald-400
                           focus:outline-none">

                </div>

                <!-- LNG -->
                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Longitude
                    </label>

                    <input
                    type="text"
                    name="longitude"
                    placeholder="98.9853"
                    class="w-full border border-gray-200
                           rounded-2xl px-4 py-3
                           focus:ring-2 focus:ring-emerald-400
                           focus:outline-none">

                </div>

            </div>

            <!-- IMAGE -->
            <div>

                <label class="block text-sm font-semibold mb-3">

                    <i class="fa-regular fa-images text-emerald-500"></i>
                    รูปภาพสถานที่

                </label>

                <div class="border-2 border-dashed border-emerald-300
                            rounded-3xl p-10
                            bg-emerald-50">

                    <div class="text-center mb-6">

                        <i class="fa-regular fa-image
                                  text-5xl text-emerald-400 mb-4"></i>

                        <h3 class="font-bold text-lg mb-2">
                            อัปโหลดรูปภาพสถานที่
                        </h3>

                        <p class="text-sm text-gray-500">
                            สามารถเลือกรูปได้หลายรูปพร้อมกัน
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            รูปแรกจะถูกใช้เป็น Cover Image อัตโนมัติ
                        </p>

                    </div>

                    <!-- FILE INPUT -->
                    <input
                    type="file"
                    id="imageInput"
                    name="images[]"
                    multiple
                    accept="image/*"
                    class="block w-full text-sm text-gray-600
                           file:mr-4 file:py-3 file:px-5
                           file:rounded-full file:border-0
                           file:text-sm file:font-semibold
                           file:bg-emerald-500
                           file:text-white
                           hover:file:bg-emerald-600">

                    <!-- PREVIEW -->
                    <div id="previewContainer"
                         class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">
                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex items-center gap-3 pt-4">

                <button
                type="submit"
                class="bg-emerald-500 hover:bg-emerald-600
                       text-white px-6 py-3 rounded-2xl
                       font-semibold transition shadow">

                    <i class="fa-solid fa-floppy-disk"></i>
                    บันทึกสถานที่

                </button>

                <a href="/thesis/admin/places.php"
                   class="bg-gray-200 hover:bg-gray-300
                          text-gray-700 px-6 py-3
                          rounded-2xl font-semibold transition">

                    ยกเลิก

                </a>

            </div>

        </form>

    </div>

</div>

<script>
const imageInput = document.getElementById('imageInput');
const previewContainer = document.getElementById('previewContainer');

let selectedFiles = [];

imageInput.addEventListener('change', function(e) {

    const files = Array.from(e.target.files);

    files.forEach(file => {
        selectedFiles.push(file);
    });

    renderPreview();
});

function renderPreview() {

    previewContainer.innerHTML = '';

    const dataTransfer = new DataTransfer();

    selectedFiles.forEach((file, index) => {

        dataTransfer.items.add(file);

        const reader = new FileReader();

        reader.onload = function(e) {

            const div = document.createElement('div');

            div.className = 'relative group';

            div.innerHTML = `
                <img
                    src="${e.target.result}"
                    class="w-full h-40 object-cover rounded-2xl shadow border border-gray-200">

                <button
                    type="button"
                    onclick="removeImage(${index})"
                    class="absolute top-2 right-2
                           bg-red-500 hover:bg-red-600
                           text-white w-10 h-10 rounded-full
                           flex items-center justify-center
                           shadow-lg opacity-0
                           group-hover:opacity-100 transition">

                    <i class="fa-solid fa-trash"></i>

                </button>

                ${index === 0 ? `
                    <div class="absolute bottom-2 left-2
                                bg-emerald-500 text-white
                                text-xs px-3 py-1 rounded-full shadow">
                        Cover
                    </div>
                ` : ''}
            `;

            previewContainer.appendChild(div);
        };

        reader.readAsDataURL(file);
    });

    imageInput.files = dataTransfer.files;
}

function removeImage(index) {

    selectedFiles.splice(index, 1);

    renderPreview();
}
</script>

</body>
</html>