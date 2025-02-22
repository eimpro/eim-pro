<!DOCTYPE html>
<html>
<head>
    <title>File Compression</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#checkAll').click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Select files to compress</h2>
        <?php
        function zipData($source, $destination) {
            if (extension_loaded('zip')) {
                if (file_exists($source)) {
                    $zip = new ZipArchive();
                    if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                        $source = realpath($source);
                        if (is_dir($source)) {
                            $iterator = new RecursiveDirectoryIterator($source);
                            // skip dot files while iterating 
                            $iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
                            $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
                            foreach ($files as $file) {
                                $file = realpath($file);
                                if (is_dir($file)) {
                                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                                } else if (is_file($file)) {
                                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                                }
                            }
                        } else if (is_file($source)) {
                            $zip->addFromString(basename($source), file_get_contents($source));
                        }
                    }
                    return $zip->close();
                }
            }
            return false;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['files'])) {
            $zip_name = "myzipfile.zip";
            foreach($_POST['files'] as $file) {
                zipData($file, $zip_name);
            }
            echo "<div class='alert alert-success'>Compression was successful! <a href='$zip_name'>Click here to download</a></div>";
        } else {
            $files = array_slice(scandir('.'), 2);
            echo "<form method='post'>";
            echo "<div class='form-check'>";
            echo "<input class='form-check-input' type='checkbox' id='checkAll'>";
            echo "<label class='form-check-label' for='checkAll'>Select All</label>";
            echo "</div>";
            foreach($files as $file) {
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='checkbox' name='files[]' value='$file' id='$file'>";
                echo "<label class='form-check-label' for='$file'>$file</label>";
                echo "</div>";
            }
            echo "<button type='submit' class='btn btn-primary mt-3'>Compress</button>";
            echo "</form>";
        }
        ?>
    </div>
</body>
</html>

