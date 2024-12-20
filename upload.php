<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header>
    <nav>
        <a href="index.php">Image Gallery</a>
        <a href="upload.php">Upload Image</a>
        <a href="delete.php">Delete Images</a>
    </nav>
    </header>

    <h1>Upload Image</h1>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="image">Select Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        // Check if it is an image
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            echo "<p>The image was successfully uploaded!</p>";
        } else {
            echo "<p>Error uploading the image.</p>";
        }
    }
    ?>
</body>
</html>
