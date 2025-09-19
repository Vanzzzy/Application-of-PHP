<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in SESSION
    if (isset($_SESSION['registered_user']) && 
        $email == $_SESSION['registered_user']['email'] &&
        $password == $_SESSION['registered_user']['password']) {

        $_SESSION['user'] = $_SESSION['registered_user'];
        header("Location: profile.php?user=1"); // GET parameter
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="mb-3">Login Page</h2>
    <?php if (isset($_GET['registered'])) echo "<div class='alert alert-success'>Registration successful! Please login.</div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST" action="login.php" class="w-50">
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Login</button>
    </form>
    <p class="mt-3">Don’t have an account? <a href="register.php">Register here</a></p>
</body>
</html>
