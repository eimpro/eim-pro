

// الملف الثاني: upload_images.php
<?php
include 'db_connection.php';

$productID = $_GET['product']; // هنا نستقبل معرف المنتج من الملف الأول

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $imageID = $_POST['delete'];
        $stmt = $conn->prepare("SELECT ImageURL FROM ProductImages WHERE ID = ?");
        $stmt->bind_param("i", $imageID);
        $stmt->execute();
        $imageURL = $stmt->get_result()->fetch_assoc()['ImageURL'];
        unlink($imageURL);  // Delete the actual file

        $stmt = $conn->prepare("DELETE FROM ProductImages WHERE ID = ?");
        $stmt->bind_param("i", $imageID);
        $stmt->execute();
        echo "<div class='alert alert-success'>The image has been deleted successfully!</div>";
    } else {
        $target_dir = "imgpro/";

        for($i=0; $i<count($_FILES["images"]["name"]); $i++) {
            if ($_FILES["images"]["size"][$i] > 0) {  // Check if the file is not empty
                $target_file = $target_dir . basename($_FILES["images"]["name"][$i]);
                move_uploaded_file($_FILES["images"]["tmp_name"][$i], $target_file);

                if (file_exists($target_file)) {
                    echo "<div class='alert alert-success'>The file ". htmlspecialchars(basename($_FILES["images"]["name"][$i])). " has been uploaded.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
                }

                $stmt = $conn->prepare("INSERT INTO ProductImages (ProductID, ImageURL) VALUES (?, ?)");
                $stmt->bind_param("is", $productID, $target_file);
                $stmt->execute();
            }
        }

        echo "<div class='alert alert-success'>The images have been uploaded successfully!</div>";
    }
}

echo '<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Upload Product Images</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<h1 class="text-center mt-5">Upload Product Images</h1>';

echo '<form action="" method="post" enctype="multipart/form-data" class="mt-5">';
echo '<div class="form-group">
        <label for="images">Select images to upload:</label>';
echo '<input type="file" name="images[]" id="images" multiple class="form-control-file">';
echo '</div><button type="submit" class="btn btn-primary">Upload Images</button>';
echo '</form>';

$stmt = $conn->prepare("SELECT * FROM ProductImages WHERE ProductID = ?");
$stmt->bind_param("i", $productID);
$stmt->execute();
$images = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

echo '<table class="table mt-5"><thead><tr><th scope="col">#</th><th scope="col">Image</th><th scope="col">Actions</th></tr></thead><tbody>';
foreach($images as $image) {
    echo '<tr><th scope="row">' . htmlspecialchars($image['ID']) . '</th><td><img src="' . htmlspecialchars($image['ImageURL']) . '" width="100"></td><td><form action="" method="post"><button type="submit" name="delete" value="' . htmlspecialchars($image['ID']) . '" class="btn btn-danger">Delete</button></form></td></tr>';
}
echo '</tbody></table>';

echo '</div></body></html>';

$conn->close();
?>
