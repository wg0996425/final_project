<?php 

include __DIR__ . "/data/db.php";
include __DIR__ . "/data/functions.php";

session_start();

$view   = filter_input(INPUT_GET, 'view') ?: 'list';
$action = filter_input(INPUT_POST, 'action');


function require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        header('Location: ?view=login');
        exit;
    }
}


$public_views   = ['login', 'register', 'upcoming_events', 'details'];
$public_actions = ['login', 'register', 'upcoming_events', 'details'];

if ($action && !in_array($action, $public_actions, true)) {
    require_login();
}
if (!$action && !in_array($view, $public_views, true)) {
    require_login();
}


switch ($action) {
    case 'login':
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');

        if ($username && $password) {
            $user = user_find_by_username($username);
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = (int)$user['id'];
                $view = 'list';
            } else {
                $login_error = "Invalid username or password.";
                $view = 'login';
            }
        } else {
            $login_error = "Enter both fields.";
            $view = 'login';
        }
        break;

        case 'logout':
        $_SESSION = [];
        session_destroy();
        session_start();
        $view = 'login';
        break;

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Planner</title>
</head>
<body>
    <?php include __DIR__ . '/components/nav.php'; ?>
    <br>
    <?php
    if     ($view === 'login')              include __DIR__ . '/partials/login_form.php';
    elseif ($view === 'register')           include __DIR__ . '/partials/register_form.php';
    elseif ($view === 'upcoming_events')    include __DIR__ . '/partials/pa_upcoming_events.php';
    elseif ($view === 'manage_events')      include __DIR__ . '/partials/a_manage_events.php';
    elseif ($view === 'view_registrations') include __DIR__ . '/partials/a_view_registrations.php';
    elseif ($view === 'details')            include __DIR__ . '/partials/pa_details.php';
    else                                    include __DIR__ . '/partials/welcome.php';
    ?>
</body>
</html>