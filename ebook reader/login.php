<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LoginForm</title>
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
                <h3>Log In</h3>
                <div class="form-wrapper">
                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                    <i class="zmdi zmdi-account"></i>
                </div>
                <div class="form-wrapper">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                    <i class="zmdi zmdi-lock"></i>
                </div>
                <button type="submit" name="submit">Log In
                    <i class="zmdi zmdi-arrow-right"></i>
                </button>
            </form>

            <?php
            // PHP code for handling form submission and user authentication
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
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Hash the password (you should use a stronger hashing method in production)
                $hashed_password = md5($password);

                // SQL query to check if username and hashed password exist in database
                $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
                $stmt->bind_param("ss", $username, $hashed_password);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if user exists in database
                if ($result->num_rows == 1) {
                    // Successful login
                    session_start(); // Start session
                    $_SESSION['username'] = $username; // Store username in session variable
                    header("Location: dashboard.php"); // Redirect to dashboard or another authenticated page
                    exit();
                } else {
                    // Unsuccessful login
                    echo "Invalid username or password";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
    
</body>
</html>
