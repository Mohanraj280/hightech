<?php
// Include your database connection file
include 'db_config.php';

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the POST request
    $department = $_POST['department'];
    $faculty_id = $_POST['faculty_id'];
    $hall = $_POST['hall'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO booking_data (department, faculty_id, hall, date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $department, $faculty_id, $hall, $date, $start_time, $end_time);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data stored successfully."; 
       // Return success message
    } else {
        echo "Error storing data: " . $stmt->error; // Return error message
    }
    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, return an error message
    echo "Invalid request.";
}
?>
