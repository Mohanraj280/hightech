<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Booking System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-1">Hall Booking System</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Department Selection Dropdown -->
                <div class="form-group">
                    <label for="department">Select Department:</label>
                    <select class="form-control" id="department">
                        <option value="">Select Department</option>
                        <?php include 'fetch_departments.php'; ?>
                    </select>
                </div>

                <!-- Faculty ID Search -->
                <div class="form-group">
                    <label for="faculty_id">Enter Faculty ID:</label>
                    <input type="text" class="form-control" id="faculty_id" name="faculty_id" required>
                    <div id="faculty_name_result"></div>
                </div>

                <!-- Hall Selection Dropdown -->
                <div class="form-group" id="hall-selection">
                    <label for="hall">Select Hall:</label>
                    <select class="form-control hall-input" id="hall">
                        <option value="">Select Respective Hall</option>
                        <?php include 'fetch_hall.php'; ?>
                    </select>
                </div>

                <!-- Date Input -->
                <div class="form-group" id="date-input">
                    <label for="date">Enter Date:</label>
                    <input type="date" class="form-control date-input" id="date" name="date" required>
                </div>

                <!-- Start and End Time Input -->
                <div class="form-group" id="time-input">
                    <label for="start_time">Select Start Time:</label>
                    <input type="time" id="start_time" name="start_time" class="form-control time-input">
                </div>

                <div class="form-group" id="end-time-input">
                    <label for="end_time">Select End Time:</label>
                    <input type="time" id="end_time" name="end_time" class="form-control time-input">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <button id="submit-btn" type="button" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hide other form elements initially
            $('#hall-selection, #date-input, #time-input, #end-time-input').hide();

            // Faculty ID Search
            $('#faculty_id').on('input', function() {
                var faculty_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'search_faculty.php',
                    data: { faculty_id: faculty_id },
                    success: function(response) {
                        if (response.trim() !== "Invalid ID") {
                            $('#faculty_name_result').html(response);
                            $('#hall-selection, #date-input, #time-input, #end-time-input').show();
                        } else {
                            // Clear and hide other form elements
                            $('.hall-input, .date-input, .time-input').val('');
                            $('#faculty_name_result').html(response);
                            $('#hall-selection, #date-input, #time-input, #end-time-input').hide();
                        }
                    }
                });
            });

            // Form Submission
            $('#submit-btn').on('click', function() {
                var department = $('#department').val();
                var faculty_id = $('#faculty_id').val();
                var hall = $('#hall').val();
                var date = $('#date').val();
                var start_time = $('#start_time').val();
                var end_time = $('#end_time').val();

                // AJAX to PHP script for storing data in database
                $.ajax({
                    type: 'POST',
                    url: 'store_data.php',
                    data: {
                        department: department,
                        faculty_id: faculty_id,
                        hall: hall,
                        date: date,
                        start_time: start_time,
                        end_time: end_time
                    },
                    success: function(response) {
                        // Redirect to dashboard after successful submission
                        window.location.href = 'dashboard.php';
                    }
                });
            });
        });
    </script>
</body>
</html>
