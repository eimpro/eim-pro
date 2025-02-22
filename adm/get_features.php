<?php
// معلومات الاتصال بقاعدة البيانات 
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM Features WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
  }
}

$sql = "SELECT ID, Feature, Description FROM Features";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["Feature"] . "</td>";
    echo "<td>" . $row["Description"] . "</td>";
    echo "<td><button onclick='editFeature(" . $row["ID"] . ", \"" . $row["Feature"] . "\", \"" . $row["Description"] . "\")'>تعديل</button></td>";
    echo "<td><form method='post' action='' onsubmit='return confirm(\"هل أنت متأكد أنك تريد حذف هذا السجل؟\");'><input type='hidden' name='id' value='" . $row["ID"] . "'/><input type='submit' name='delete' value='حذف'/></form></td>";
    echo "</tr>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>

<script>
function deleteFeature(id) {
  if (confirm("هل أنت متأكد أنك تريد حذف هذا السجل؟")) {
    var form = document.createElement('form');
    form.method = 'post';
    form.action = '';
    var hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'id';
    hiddenField.value = id;
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
  }
}
</script>

