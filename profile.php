<?php
session_start();

// if not logged in, send back to login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// get user id from GET in a PHP 5-compatible way
$userId = isset($_GET['user']) ? (int) $_GET['user'] : null;

// validate user id matches the logged-in user's id
if ($userId === null || $userId !== (int) $_SESSION['user']['id']) {
    // show a simple message and link back to login
    echo '<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Invalid user</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <div class="alert alert-danger">Invalid user ID. <a href="login.php">Go to login</a></div>
</body>
</html>';
    exit;
}

$user = $_SESSION['user'];
$name  = htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <div class="card w-50">
    <div class="card-body">
      <h2 class="card-title">Welcome, <?php echo $name; ?>!</h2>
      <p class="card-text"><strong>Email:</strong> <?php echo $email; ?></p>
      <p class="card-text"><strong>Username:</strong> <?php echo $name; ?></p>
      <p class="card-text"><strong>User ID (via GET):</strong> <?php echo $userId; ?></p>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
</body>
</html>
