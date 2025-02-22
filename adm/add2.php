<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>المنتج</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        textarea {
            min-height: 200px;
        }
    </style>
</head>
<body>
    <?php
   
    include 'db_connection.php';

    // جلب الميزات
    $sql = "SELECT ID, Feature FROM Features";
    $result = $conn->query($sql);

    $features = [];
    if ($result->num_rows > 0) {
      // جلب البيانات لكل صف
      while($row = $result->fetch_assoc()) {
        $features[] = $row;
      }
    } else {
      echo "0 results";
    }

    // جلب التصنيفات
    $sql = "SELECT ID, CategoryName FROM Categories";
    $result = $conn->query($sql);

    $categories = [];
    if ($result->num_rows > 0) {
      // جلب البيانات لكل صف
      while($row = $result->fetch_assoc()) {
        $categories[] = $row;
      }
    } else {
      echo "0 results";
    }

    $conn->close();
    ?>
    
    <div class="container">
        <h1 class="text-center mt-5">إضافة منتج</h1>
        <form action="insert_product.php" method="post" enctype="multipart/form-data" class="mt-5">
            <div class="form-group">
                <label for="product_name">اسم المنتج:</label>
                <input type="text" name="product_name" id="product_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="product_description">وصف المنتج:</label>
                <textarea name="product_description" id="product_description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="product_price">سعر المنتج:</label>
                <input type="text" name="product_price" id="product_price" class="form-control">
            </div>
            <div class="form-group">
                <label for="product_icon">أيقونة المنتج:</label>
                <input type="file" name="product_icon" id="product_icon" class="form-control-file">
            </div>

            <?php foreach($features as $feature): ?>
              <div class="form-check">
                <input type="checkbox" id="<?php echo 'feature_' . $feature['ID']; ?>" name="feature_ids[]" value="<?php echo $feature['ID']; ?>" class="form-check-input">
                <label for="<?php echo 'feature_' . $feature['ID']; ?>" class="form-check-label"><?php echo $feature['Feature']; ?></label>
              </div>
            <?php endforeach; ?>

            <div class="form-group">
                <label for="category_id">تصنيف المنتج:</label>
                <select name="category_id" id="category_id" class="form-control">
                  <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['ID']; ?>"><?php echo $category['CategoryName']; ?></option>
                  <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="whats">رابط الواتساب:</label>
                <input type="text" name="whats" id="whats" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">إرسال</button>
        </form>
    </div>

    <!-- يجب أن يكون هذا في نهاية الجسم -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
