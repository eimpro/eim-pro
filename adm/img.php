// الملف الأول: select_product.php
<?php
include 'db_connection.php';

$stmt = $conn->prepare("SELECT * FROM Products");
$stmt->execute();
$products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

echo '<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Select a Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<h1 class="text-center mt-5">Select a Product</h1>';

echo '<form action="upload_images.php" method="get" class="mt-5">'; // هنا نستخدم طريقة GET لإرسال معرف المنتج إلى الملف الثاني
echo '<div class="form-group">
        <label for="product">Select a product:</label>';
echo '<select id="product" name="product" class="form-control">';

foreach($products as $product) {
    echo '<option value="' . htmlspecialchars($product['ID']) . '">' . htmlspecialchars($product['Name']) . '</option>';
}

echo '</select></div>';
echo '<button type="submit" class="btn btn-primary">Go to Upload Images</button>'; // هذا الزر سيقوم بتحويل المستخدم إلى الملف الثاني مع معرف المنتج
echo '</form>';

echo '</div></body></html>';

$conn->close();
?>
