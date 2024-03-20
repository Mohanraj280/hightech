<?php
include 'db_config.php';

$sql = "SELECT * FROM halls";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row['hall_no']."'>".$row['hall_name']."</option>";
    }
} else {
    echo "<option value=''>No halls found</option>";
}
$conn->close();
?>
