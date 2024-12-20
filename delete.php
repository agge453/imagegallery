<?php
session_start();

// Admin credentials
$adminPassword = 'admin123';

if (!isset($_SESSION['logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && $_POST['password'] === $adminPassword) {
        $_SESSION['logged_in'] = true;
    } else {
        echo "<form method='POST' class='login-form'>
                <h2>Admin Login</h2>
                <input type='password' name='password' placeholder='Password' required>
                <button>Login</button>
              </form>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $fileToDelete = 'uploads/' . basename($_POST['delete']);
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo "<p class='success-msg'>The image was successfully deleted!</p>";
    } else {
        echo "<p class='error-msg'>Error: The file was not found.</p>";
    }
}

$images = array_diff(scandir('uploads'), array('.', '..'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Management</title>
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
    <main>
        <div class="admin-container">
            <h1>Image Management - Delete</h1>
            <ul class="image-list">
                <?php foreach ($images as $image): ?>
                    <li class="image-item">
                        <span><?php echo $image; ?></span>
                        <form method="POST" class="delete-form" style="display:inline;">
                            <button type="submit" name="delete" value="<?php echo $image; ?>" class="delete-btn">Delete</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
</body>
</html>
