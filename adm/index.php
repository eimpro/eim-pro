<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        #iframe {
            width: 100%;
            height: calc(100vh - 56px); /* Subtract the height of the navbar */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">لوحة التحكم</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="add_fac.php" target="iframe">إدخال الميزة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add2.php" target="iframe">إضافة منتج</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="img.php" target="iframe">رفع صور المنتج</a>
                </li>

 <li class="nav-item">
                    <a class="nav-link" href="addcati.php" target="iframe">ادخال التصنيفات </a>
                </li>

            </ul>
        </div>
    </nav>

    <iframe id="iframe" name="iframe"></iframe>

    <!-- يجب أن يكون هذا في نهاية الجسم -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

