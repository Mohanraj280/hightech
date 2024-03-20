<?php
include 'db_config.php';

$sql = "SELECT * FROM departments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row['id']."'>".$row['name']."</option>";
    }
} else {
    echo "<option value=''>No departments found</option>";
}

$conn->close();
?>
