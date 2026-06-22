<?php
include __DIR__ . '/../db.php';

if (!isset($_GET['id'])) {
    die('ไม่พบ ID');
}

$id = (int)$_GET['id'];

/* =========================================
   GET PLACE
========================================= */
$data = $conn->query("
    SELECT *
    FROM places
    WHERE id = $id
")->fetch_assoc();

if (!$data) {
    die("ไม่พบข้อมูลสถานที่");
}

/* =========================================
   DELETE IMAGE
========================================= */
if (isset($_GET['delete_image'])) {

    $imageId = (int)$_GET['delete_image'];

    $imgQuery = $conn->query("
        SELECT *
        FROM place_images
        WHERE id = $imageId
        AND place_id = $id
    ");

    if ($imgQuery && $imgQuery->num_rows > 0) {

        $imgData = $imgQuery->fetch_assoc();

        $filePath = __DIR__ . '/../uploads/' . $imgData['image_name'];

        // ลบไฟล์จริง
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // ลบ DB
        $conn->query("
            DELETE FROM place_images
            WHERE id = $imageId
        ");
    }

    header("Location: /thesis/admin/edit_place.php?id=$id");
    exit;
}

/* =========================================
   DELETE COVER
========================================= */
if (isset($_GET['delete_cover'])) {

    if (!empty($data['cover_image'])) {

        $coverPath = __DIR__ . '/../uploads/' . $data['cover_image'];

        // ลบไฟล์จริง
        if (file_exists($coverPath)) {
            unlink($coverPath);
        }

        // ลบ DB
        $conn->query("
            UPDATE places
            SET cover_image = ''
            WHERE id = $id
        ");
    }

    header("Location: /thesis/admin/edit_place.php?id=$id");
    exit;
}

/* =========================================
   UPDATE
========================================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $province    = mysqli_real_escape_string($conn, $_POST['province']);
    $latitude    = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude   = mysqli_real_escape_string($conn, $_POST['longitude']);
    $category_id = (int)$_POST['category_id'];

    /* UPDATE PLACE */
    $sql = "
        UPDATE places SET
            name='$name',
            description='$description',
            province='$province',
            latitude='$latitude',
            longitude='$longitude',
            category_id='$category_id'
        WHERE id=$id
    ";

    if (!$conn->query($sql)) {
        die("SQL Error: " . $conn->error);
    }

    /* =========================================
       UPLOAD COVER IMAGE
    ========================================= */
    if (
        isset($_FILES['cover_image']) &&
        $_FILES['cover_image']['error'] === 0
    ) {

        $uploadDir = __DIR__ . '/../uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // ลบรูปเก่า
        if (!empty($data['cover_image'])) {

            $oldPath = $uploadDir . $data['cover_image'];

            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $imageName = $_FILES['cover_image']['name'];
        $tmpName   = $_FILES['cover_image']['tmp_name'];

        $safeName = preg_replace(
            '/[^a-zA-Z0-9\._-]/',
            '_',
            $imageName
        );

        $filename =
            time() .
            '_cover_' .
            rand(1000,9999) .
            '_' .
            $safeName;

        $target = $uploadDir . $filename;

        if (move_uploaded_file($tmpName, $target)) {

            $conn->query("
                UPDATE places
                SET cover_image = '$filename'
                WHERE id = '$id'
            ");
        }
    }

    /* =========================================
       UPLOAD MULTIPLE IMAGES
    ========================================= */
    if (!empty($_FILES['images']['name'][0])) {

        $uploadDir = __DIR__ . '/../uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

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

                    $conn->query("
                        INSERT INTO place_images
                        (
                            place_id,
                            image_name
                        )
                        VALUES
                        (
                            '$id',
                            '$filename'
                        )
                    ");
                }
            }
        }
    }

    header("Location: /thesis/admin/places.php");
    exit;
}

/* =========================================
   GET IMAGES
========================================= */
$images = $conn->query("
    SELECT *
    FROM place_images
    WHERE place_id = $id
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="th">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>แก้ไขสถานที่</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">

<!-- TOPBAR -->
<div class="bg-white shadow-sm border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-6 py-4
                flex items-center justify-between">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl
                        bg-blue-500 text-white
                        flex items-center justify-center">

                <i class="fa-solid fa-location-dot"></i>

            </div>

            <div>

                <h1 class="font-bold text-lg">
                    Travel Admin
                </h1>

                <p class="text-sm text-gray-500">
                    ระบบจัดการสถานที่ท่องเที่ยว
                </p>

            </div>

        </div>

        <div class="flex gap-2">

            <a href="/thesis/admin/places.php"
               class="bg-gray-100 hover:bg-gray-200
                      px-4 py-2 rounded-xl text-sm font-medium">

                <i class="fa-solid fa-arrow-left"></i>
                กลับ

            </a>

            <a href="/thesis/index.php"
               class="bg-blue-500 hover:bg-blue-600
                      text-white px-4 py-2 rounded-xl
                      text-sm font-semibold">

                <i class="fa-solid fa-house"></i>
                หน้าเว็บ

            </a>

        </div>

    </div>

</div>

<!-- CONTENT -->
<div class="max-w-5xl mx-auto px-6 py-10">

    <div class="mb-8">

        <h1 class="text-3xl font-bold mb-2">

            <i class="fa-solid fa-pen-to-square text-blue-500"></i>
            แก้ไขสถานที่

        </h1>

        <p class="text-gray-500">
            แก้ไขข้อมูลและรูปภาพของสถานที่ท่องเที่ยว
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
                value="<?= htmlspecialchars($data['name']) ?>"
                required
                class="w-full border border-gray-200 rounded-xl
                       px-4 py-3
                       focus:ring-2 focus:ring-blue-400
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
                required
                class="w-full border border-gray-200 rounded-xl
                       px-4 py-3
                       focus:ring-2 focus:ring-blue-400
                       focus:outline-none"><?= htmlspecialchars($data['description']) ?></textarea>

            </div>

            <!-- GRID -->
            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        จังหวัด
                    </label>

                    <input
                    type="text"
                    name="province"
                    value="<?= htmlspecialchars($data['province']) ?>"
                    required
                    class="w-full border border-gray-200 rounded-xl
                           px-4 py-3">

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Category ID
                    </label>

                    <input
                    type="number"
                    name="category_id"
                    value="<?= $data['category_id'] ?>"
                    required
                    class="w-full border border-gray-200 rounded-xl
                           px-4 py-3">

                </div>

            </div>

            <!-- LAT LNG -->
            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Latitude
                    </label>

                    <input
                    type="text"
                    name="latitude"
                    value="<?= htmlspecialchars($data['latitude']) ?>"
                    class="w-full border border-gray-200 rounded-xl
                           px-4 py-3">

                </div>

                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Longitude
                    </label>

                    <input
                    type="text"
                    name="longitude"
                    value="<?= htmlspecialchars($data['longitude']) ?>"
                    class="w-full border border-gray-200 rounded-xl
                           px-4 py-3">

                </div>

            </div>

            <!-- COVER IMAGE -->
            <div>

                <label class="block text-sm font-semibold mb-3">

                    <i class="fa-solid fa-image text-blue-500"></i>
                    Cover Image

                </label>

                <?php if (!empty($data['cover_image'])): ?>

                    <div class="relative w-full md:w-80">

                        <img
                        src="/thesis/uploads/<?= htmlspecialchars($data['cover_image']) ?>"
                        class="w-full h-52 object-cover
                               rounded-2xl border border-gray-200
                               shadow">

                        <!-- DELETE COVER -->
                        <a
                        href="?id=<?= $id ?>&delete_cover=1"
                        class="absolute top-3 right-3
                               bg-red-500 hover:bg-red-600
                               text-white w-10 h-10
                               rounded-full flex items-center
                               justify-center shadow-lg">

                            <i class="fa-solid fa-trash"></i>

                        </a>

                    </div>

                <?php else: ?>

                    <div class="w-full md:w-80 h-52 rounded-2xl
                                border-2 border-dashed border-gray-300
                                flex items-center justify-center
                                text-gray-400">

                        ไม่มี Cover Image

                    </div>

                <?php endif; ?>

                <input
                type="file"
                name="cover_image"
                accept="image/*"
                class="mt-4 block w-full text-sm text-gray-600
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-full file:border-0
                       file:text-sm file:font-semibold
                       file:bg-blue-500 file:text-white
                       hover:file:bg-blue-600">

            </div>

            <!-- CURRENT IMAGES -->
            <div>

                <h3 class="text-lg font-bold mb-4">

                    <i class="fa-regular fa-images text-blue-500"></i>
                    รูปภาพปัจจุบัน

                </h3>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                    <?php while($img = $images->fetch_assoc()): ?>

                        <div class="relative">

                            <img
                            src="/thesis/uploads/<?= htmlspecialchars($img['image_name']) ?>"
                            class="w-full h-40 object-cover rounded-2xl
                                   shadow border border-gray-200">

                            <!-- DELETE -->
                            <a
                            href="?id=<?= $id ?>&delete_image=<?= $img['id'] ?>"
                            class="absolute top-2 right-2
                                   bg-red-500 hover:bg-red-600
                                   text-white w-10 h-10
                                   rounded-full flex items-center
                                   justify-center shadow-lg">

                                <i class="fa-solid fa-trash"></i>

                            </a>

                        </div>

                    <?php endwhile; ?>

                </div>

            </div>

            <!-- UPLOAD -->
            <div>

                <label class="block text-sm font-semibold mb-3">

                    <i class="fa-solid fa-cloud-arrow-up text-blue-500"></i>
                    เพิ่มรูปภาพใหม่

                </label>

                <input
                type="file"
                name="images[]"
                multiple
                accept="image/*"
                class="block w-full text-sm text-gray-600
                       file:mr-4 file:py-2 file:px-4
                       file:rounded-full file:border-0
                       file:text-sm file:font-semibold
                       file:bg-blue-500 file:text-white
                       hover:file:bg-blue-600">

            </div>

            <!-- BUTTON -->
            <div class="pt-4">

                <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600
                       text-white px-6 py-3 rounded-xl
                       font-semibold transition">

                    <i class="fa-solid fa-floppy-disk"></i>
                    บันทึกการแก้ไข

                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>