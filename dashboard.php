<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            margin-bottom: 30px;
            color: #343a40;
        }
        table {
            background-color: #fff;
        }
        th, td {
            text-align: center;
        }
        .status-booked {
            color: #28a745;
            font-weight: bold;
        }
        .status-not-booked {
            color: #dc3545;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .container {
                margin-top: 20px;
            }
            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Details</h2>
        <?php
        // Include your database connection file
        include 'db_config.php';

        // Get current date and time
        $current_datetime = date("Y-m-d H:i:s");

        // Fetch and display data from the database
        $sql = "SELECT * FROM booking_data";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'><tr><th>Department</th><th>Faculty ID</th><th>Hall</th><th>Date</th><th>Start Time</th><th>End Time</th><th>Status</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['department'] . "</td>";
                echo "<td>" . $row['faculty_id'] . "</td>";
                echo "<td>" . $row['hall'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['start_time'] . "</td>";
                echo "<td>" . $row['end_time'] . "</td>";
                
                // Check if current time falls within the booked time slot
                $start_datetime = $row['date'] . ' ' . $row['start_time'];
                $end_datetime = $row['date'] . ' ' . $row['end_time'];
                
                if ($current_datetime >= $start_datetime && $current_datetime <= $end_datetime) {
                    echo "<td class='status-booked'>Active</td>";
                } else {
                    echo "<td class='status-not-booked'>Inactive</td>";
                }

                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>No data available.</p>";
        }

        // Close database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
