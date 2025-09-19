<?php
// logout.php  — keep this file minimal and avoid any output before header()

session_start();

// Clear session data
$_SESSION = array();

// If session uses cookies, delete the session cookie too (recommended)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// Destroy the session on the server
session_destroy();

// Redirect to login page (no output should have been sent)
header('Location: login.php');
exit;
