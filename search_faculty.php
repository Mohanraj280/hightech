<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['faculty_id'])) {
    $faculty_id = $_POST['faculty_id'];

    $stmt = $conn->prepare("SELECT name FROM faculty WHERE id = ?");
    $stmt->bind_param("i", $faculty_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        echo "Faculty Name: " . $row["name"];
    } else {
      
        echo "Invalid ID";
    }
    
    $stmt->close();
}

$conn->close();
?>
