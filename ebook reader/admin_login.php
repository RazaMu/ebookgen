<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
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
                <h3>Admin Log In</h3>
                <div class="form-wrapper">
                    <input type="text" name="username" placeholder="Admin Username" class="form-control" required>
                </div>
                <div class="form-wrapper">
                    <input type="password" name="password" placeholder="Admin Password" class="form-control" required>
                </div>
                <button type="submit" name="submit">Log In
                </button>
                <p>Not an admin? <a href="login.php">User Login</a></p>
            </form>
            <?php
            // PHP code for handling form submission and admin authentication
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
                // Assuming you have an 'admin' column in the users table to distinguish admins
                $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=? AND admin=1");
                $stmt->bind_param("ss", $username, $hashed_password);
                $stmt->execute();
                $result = $stmt->get_result();
                // Check if admin exists in database
                if ($result->num_rows == 1) {
                    // Successful login
                    session_start(); // Start session
                    $_SESSION['admin_username'] = $username; // Store admin username in session variable
                    header("Location: admin_dashboard.php"); // Redirect to admin dashboard
                    exit();
                } else {
                    // Unsuccessful login
                    echo "Invalid admin credentials";
                }
                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
