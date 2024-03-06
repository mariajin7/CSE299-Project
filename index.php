<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!--link to css-->
    <link rel="stylesheet" href="style.css">
    <!--Box icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    
    <div class="container">
    <?php
            
            $conn = mysqli_connect("localhost", "root", "", "project");

            if (!$conn) {
             die("Connection failed: " . mysqli_connect_error());
             }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["signUp"])) {
                    // Sign Up
                    $name = $_POST["name"];
                    $email =  $_POST["email"];
                    $password = $_POST["password"];
            
                    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            
                    if (mysqli_query($conn, $sql)) {
                        echo "Registration successful!";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } elseif (isset($_POST["signIn"])) {
                    // Sign-in
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                    // Authentication successful, redirect to home.php
                     header("Location: home.php");
                     exit();
                     } else {
                    echo "Invalid email or password!";
                     }
                
                }
            }
            
            mysqli_close($conn);
            ?>
        <div class="form-box">
           <h1 id="title">Sign Up</h1>
           <form action="index.php" method="post">
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <input type="text" name="name" id="name" placeholder="Name" required>
                </div>
                <div class="input-field">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <p>Lost password<a href="#"> Click Here!</a></p>
            </div>
            <div class="btn-field">
                <button type="submit" name="signUp" id="signupBtn">Sign up</button>
                <button type="submit" name="signIn" id="signinBtn" class="disable">Sign in</button>
            </div>
           </form>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>