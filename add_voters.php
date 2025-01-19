<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Voting Verification</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            color: #ffffff;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-size: 1.1em;
        }
        input {
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
        }
        input[type="submit"], .btn {
            background-color: #6200ea;
            color: #ffffff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 10px;
        }
        input[type="submit"]:hover, .btn:hover {
            background-color: #3700b3;
        }
    </style>
    <script>
        function validateForm() {
            const dateOfBirth = document.getElementById('date_of_birth').value;
            const dob = new Date(dateOfBirth);
            const today = new Date();
            const age = today.getFullYear() - dob.getFullYear();
            const monthDifference = today.getMonth() - dob.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            if (age < 18) {
                alert('Age must be at least 18 years.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Verification Form</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "e_voting";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $name = $_POST['name'];
            $date_of_birth = $_POST['date_of_birth'];
            $aadhar_no = $_POST['aadhar_no'];

            $sql = "INSERT INTO verification (name, date_of_birth, aadhar_no) VALUES ('$name', '$date_of_birth', '$aadhar_no')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>New record created successfully</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }

            $conn->close();
        }
        ?>
        <form action="" method="post" onsubmit="return validateForm()">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>
            
            <label for="aadhar_no">Aadhar Number:</label>
            <input type="text" id="aadhar_no" name="aadhar_no" maxlength="12" required>
            
            <input type="submit" value="Submit">
        </form>
        <a href="" class="btn">Enter Another Entry</a>
        <a href="admin_dashboard.php" class="btn">Admin Dashboard</a>
    </div>
</body>
</html>
