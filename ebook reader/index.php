<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RegistrationForm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="wrapper" style="background-image: url('images/bg-registration-form-1.jpg');">
        <div class="inner">
            <div class="image-holder">
                <img src="images/registration-form-1.jpg" alt="">
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h3>Sign Up</h3>
                <div class="form-group">
                    <input type="text" name="first_name" placeholder="First Name" class="form-control" required>
                    <input type="text" name="last_name" placeholder="Last Name" class="form-control" required>
                </div>
                <div class="form-wrapper">
                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                </div>
                <div class="form-wrapper">
                    <input type="email" name="email" placeholder="Email Address" class="form-control" required>
                </div>
                <div class="form-wrapper">
                    <select name="gender" id="" class="form-control" required>
                        <option value="" disabled selected>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-wrapper">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="form-wrapper">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
                </div>
                <button type="submit" name="submit">Register
                </button>
            </form>

            <?php
            // PHP code for handling form submission and database insertion
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "user_management";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Form data retrieval
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                // Validate that password and confirm password match
                if ($password != $confirm_password) {
                    echo "Passwords do not match";
                    exit();
                }

                // Hash the password
                $hashed_password = md5($password);

                // Use prepared statements to avoid SQL injection
                $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $first_name, $last_name, $username, $email, $gender, $hashed_password);

                if ($stmt->execute()) {
                    echo "Welcome New Reader";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
    
</body>
</html>
