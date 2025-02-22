<?php

include 'db_connection.php';
// جلب البيانات من نموذج POST
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_price = $_POST['product_price'];
$product_icon = $_FILES['product_icon']['name'];
$whats = $_POST['whats'];
$category_id = $_POST['category_id']; // جلب معرف التصنيف
$feature_ids = $_POST['feature_ids']; // جلب معرفات المميزات

// تحديد مسار التحميل
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["product_icon"]["name"]);

// تحميل الملف
if (move_uploaded_file($_FILES["product_icon"]["tmp_name"], $target_file)) {
  echo "The file ". htmlspecialchars( basename( $_FILES["product_icon"]["name"])). " has been uploaded.";
} else {
  echo "Sorry, there was an error uploading your file.";
}

// إدخال المنتج الجديد
$sql = "INSERT INTO Products (Name, Description, Price, Icon, whats, CategoryID) VALUES ('$product_name', '$product_description', '$product_price', '$product_icon', '$whats', '$category_id')";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
  echo "New record created successfully. Last inserted ID is: " . $last_id;

  // إدخال المميزات للمنتج
  foreach ($feature_ids as $feature_id) {
    $sql = "INSERT INTO Product_Features (ProductID, FeatureID) VALUES ('$last_id', '$feature_id')";
    if ($conn->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
