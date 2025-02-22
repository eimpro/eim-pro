<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدخال الميزة</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">إدخال الميزة</h2>

        <!-- هذا هو النموذج الذي يستخدم المستخدم لإدخال الميزة -->
        <form id="featureForm" method="post" class="mt-5">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
                <label for="feature">الميزة:</label>
                <input type="text" id="feature" name="feature" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">الوصف:</label>
                <input type="text" id="description" name="description" class="form-control">
            </div>
            <button type="submit" id="submitButton" class="btn btn-primary">إرسال</button>
        </form> 

        <h2 class="text-center mt-5">قائمة الميزات</h2>

        <!-- هذا هو الجدول الذي ستظهر فيه الميزات -->
        <table id="featuresTable" class="table table-striped mt-3">
            <!-- هنا ستظهر الميزات -->
        </table>

        <?php
        // معلومات الاتصال بقاعدة البيانات

        include 'db_connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['feature']) && !empty($_POST['description'])) {
                // استلام البيانات من النموذج
                $id = $_POST['id'];
                $feature = $_POST['feature'];
                $description = $_POST['description'];

                // إدخال بيانات الميزة في جدول الميزات
                if (empty($id)) {
                    $sql = "INSERT INTO Features (Feature, Description) VALUES ('$feature', '$description')";
                } else {
                    $sql = "UPDATE Features SET Feature='$feature', Description='$description' WHERE ID=$id";
                }
                
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>تم تحديث الميزة بنجاح.</div>";
                    // تحديث قائمة الميزات بعد تحديث ميزة
                    echo "<script>updateFeaturesList();</script>";
                } else {
                    echo "<div class='alert alert-danger'>خطأ: " . $sql . "<br>" . $conn->error . "</div>";
                }
            }
        }
        ?>
    </div>

    <!-- يجب أن يكون هذا في نهاية الجسم -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
    // هذه الدالة تقوم بتحديث قائمة الميزات
    function updateFeaturesList() {
      // استدعاء الميزات من جدول الميزات
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // تحديث Data Grid View بالميزات
          document.getElementById("featuresTable").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "get_features.php", true);
      xhttp.send();
    }

    // تحديث قائمة الميزات عند تحميل الصفحة
    updateFeaturesList();

    // هذه الدالة تقوم بتعبئة النموذج بالبيانات المراد تعديلها
    function editFeature(id, feature, description) {
      document.getElementById('id').value = id;
      document.getElementById('feature').value = feature;
      document.getElementById('description').value = description;
      document.getElementById('submitButton').textContent = 'تحديث';
    }
    </script>
</body>
</html>

