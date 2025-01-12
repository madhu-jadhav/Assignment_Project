<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .form-container {
            max-width: 400px;
            margin: auto;
        }
        .message { margin-top: 10px; }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .message {
            display: none;
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        #loader {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        input[type=text]:focus {
          border: 3px solid #555;
        }
    </style>
</head>
<body>
    <div class="form-container">
    <h1>Add Employee Form</h1>
    <form id="employeeForm">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="department">Department:</label><br>
        <select id="department" name="department" required>
            <option value="">Select Department</option>
            <!-- Departments will be loaded here via AJAX -->
        </select><br><br>

        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <div id="loader">Loading...</div>
    <div id="successMessage" class="message" style="color: green; display: none;"></div>
    <div id="errorMessage" class="message" style="color: red; display: none;"></div>
    </div>
    <script>
        $(document).ready(function() {
            // Fetch departments for the dropdown
            $.ajax({
                url: 'fetch_departments.php',
                type: 'GET',
                success: function(data) {
                    $('#department').append(data);
                }
            });

            // Handle form submission
            $('#employeeForm').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize();
                $('#loader').show();

                $.ajax({
                    url: 'submit_employee.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#loader').hide();
                        let result = JSON.parse(response);
                        if (result.success) {
                            $('#successMessage').text(result.message).show();
                            $('#errorMessage').hide();
                            $('#employeeForm')[0].reset();
                        } else {
                            $('#errorMessage').text(result.message).show();
                            $('#successMessage').hide();
                        }
                    },
                    error: function() {
                        $('#loader').hide();
                        $('#errorMessage').text("An error occurred. Please try again.").show();
                        $('#successMessage').hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
