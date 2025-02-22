<?php
// تأكد من تضمين ملف CSS لأيقونات Bootstrap
$bootstrapIconsCss = file_get_contents('assets/vendor/bootstrap-icons/bootstrap-icons.css');

// استخدم التعبير العادي للبحث عن أسماء الأيقونات في ملف CSS
preg_match_all('/\.bi-(.*?):before/', $bootstrapIconsCss, $matches);

// $matches[1] ستحتوي على جميع أسماء الأيقونات
$iconNames = $matches[1];
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Bootstrap Icons</title>
    <!-- تأكد من تضمين ملف CSS لأيقونات Bootstrap -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <h1>Bootstrap Icons</h1>
    <div class="container">
        <?php foreach($iconNames as $iconName): ?>
            <i class="bi bi-<?php echo $iconName; ?>"></i> <?php echo $iconName; ?><br>
        <?php endforeach; ?>
    </div>
</body>
</html>

