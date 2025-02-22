<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>التصنيفات</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <?php
   
    include 'db_connection.php';

    // إذا تم إرسال النموذج، أدخل التصنيف الجديد أو قم بتحديث التصنيف الحالي
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $category_name = $_POST['category_name'];
      $category_id = $_POST['category_id'];

      if ($category_id) {
        // تحديث التصنيف
        $sql = "UPDATE Categories SET CategoryName = '$category_name' WHERE ID = $category_id";
      } else {
        // إدخال التصنيف الجديد
        $sql = "INSERT INTO Categories (CategoryName) VALUES ('$category_name')";
      }

      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    // جلب التصنيفات
    $sql = "SELECT * FROM Categories";
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
        <h1 class="text-center mt-5">إضافة تصنيف</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="mt-5">
            <input type="hidden" name="category_id" id="category_id">
            <div class="form-group">
                <label for="category_name">اسم التصنيف:</label>
                <input type="text" name="category_name" id="category_name" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary" id="submit_button">إرسال</button>
        </form>

        <h2 class="text-center mt-5">التصنيفات الموجودة</h2>
        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">اسم التصنيف</th>
              <th scope="col">الإجراءات</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($categories as $category): ?>
              <tr>
                <th scope="row"><?php echo $category['ID']; ?></th>
                <td><?php echo $category['CategoryName']; ?></td>
                <td>
                  <button class="btn btn-primary edit-button" data-id="<?php echo $category['ID']; ?>" data-name="<?php echo $category['CategoryName']; ?>">تعديل</button>
                  <button class="btn btn-danger delete-button" data-id="<?php echo $category['ID']; ?>">حذف</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>

    <!-- يجب أن يكون هذا في نهاية الجسم -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
      $('.edit-button').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#category_id').val(id);
        $('#category_name').val(name);
        $('#submit_button').text('تعديل');
      });

      $('.delete-button').on('click', function() {
        var id = $(this).data('id');

        if (confirm('هل أنت متأكد أنك تريد حذف هذا التصنيف؟')) {
          $.ajax({
            url: 'delete_category.php',
            type: 'POST',
            data: { id: id },
            success: function(result) {
              location.reload();
            }
          });
        }
      });
    });
    </script>
</body>
</html>

