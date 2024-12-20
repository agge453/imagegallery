<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <link rel="stylesheet" href="CSS/style.css?v=1.0">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Image Gallery</a>
            <a href="upload.php">Upload Images</a>
            <a href="delete.php">Delete Images</a>
        </nav>
    </header>

    <h1>Image Gallery</h1>
    <div class="gallery">
        <?php
        $dir = 'uploads/';
        $images = array_values(array_diff(scandir($dir), array('.', '..')));

        foreach ($images as $index => $image) {
            $imagePath = $dir . $image;
            echo "<a href='?view=$index'><img src='$imagePath' alt='Image'></a>";
        }
        ?>
    </div>

    <?php
    if (isset($_GET['view'])) {
        $currentIndex = intval($_GET['view']);
        $currentImage = $images[$currentIndex];

        // Calculate the previous and next images
        $prevIndex = ($currentIndex > 0) ? $currentIndex - 1 : count($images) - 1;
        $nextIndex = ($currentIndex < count($images) - 1) ? $currentIndex + 1 : 0;

        echo "
        <div class='lightbox'>
            <div class='lightbox-content'>
                <img src='$dir$currentImage' alt='Large Image'>
                <button class='close-btn' onclick='closeLightbox()'>×</button>
                <a href='?view=$prevIndex' class='prev-btn'>&lt;</a>
                <a href='?view=$nextIndex' class='next-btn'>&gt;</a>
            </div>
        </div>
        ";
    }
    ?>
    <script>
        function closeLightbox() {
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>
