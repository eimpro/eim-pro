<!DOCTYPE html>
<html>
<body>

<form method="post">
  <label for="url">أدخل رابط الصورة:</label><br>
  <input type="text" id="url" name="url"><br>
  <input type="submit" value="تحميل الصورة">
</form>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // رابط الصورة
    $url = $_POST["url"];

    // اسم الملف الذي سيتم حفظه
    $filename = __DIR__ . '/' . basename($url);

    // تحميل المحتوى من الرابط
    $content = file_get_contents($url);

    // حفظ المحتوى في ملف على الخادم
    file_put_contents($filename, $content);
}
?>

