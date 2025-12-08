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


$admin_views   = ['manage_events', 'view_registrations', 'add_event'];
$admin_actions = ['manage_events', 'view_registrations', 'add_event'];

if ($action && in_array($action, $admin_actions, true)) {
    require_login();
}
if (!$action && in_array($view, $admin_views, true)) {
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
                $view = 'upcoming_events';
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

    case 'event_register':
        $event_id = (int)(filter_input(INPUT_POST, 'event_id') ?? 0);
        $name     = trim((string)(filter_input(INPUT_POST, 'name') ?? ''));
        $email    = trim((string)(filter_input(INPUT_POST, 'email') ?? ''));

        if ($name && $email) {
            registered_insert($event_id, $name, $email);
            $view = 'event_registered';
        } else {
            $view = 'event_register';
        }
        break;

    case 'add_event':
        $title        = trim((string)(filter_input(INPUT_POST, 'title') ?? ''));
        $date         = trim((string)(filter_input(INPUT_POST, 'date') ?? ''));
        $location     = trim((string)(filter_input(INPUT_POST, 'location') ?? ''));
        $description  = trim((string)(filter_input(INPUT_POST, 'description') ?? ''));

        if ($title && $date && $location) {
            event_create($title, $date, $location, $description);
            $view = 'upcoming_events';
        } else {
            $view = 'add_event';
        }
        break;
    
    case 'view_details':
        $event_id = filter_input(INPUT_POST, 'event_id', FILTER_VALIDATE_INT);

        if (!empty($event_id)) {
            $view = 'view_details';
        } else {
            $view = 'upcoming_events';
        };

        break;
    
    case 'edit_event':
        $event_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($event_id) {
            $event = find_event_by_id($event_id);
        }
        $view = 'add_event';
        break;

    case 'delete_event':
        $event_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($event_id) {
            $deleted = event_delete($event_id);
        }
        $view = 'manage_events';
        break;
    
    case 'update_event':
        $id          =         filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $title       = (string)filter_input(INPUT_POST, 'title',  FILTER_UNSAFE_RAW);
        $event_date  = (string)filter_input(INPUT_POST, 'event_date', FILTER_UNSAFE_RAW);
        $location    = (string)filter_input(INPUT_POST, 'location',  FILTER_UNSAFE_RAW);  
        $description = (string)filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);

        if ($id) {
            event_update($id, $title, $event_date, $location, $description);
        }
        $view = 'manage_events';
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
    if ($view === 'login')              include __DIR__ . '/partials/login_form.php';
    elseif ($view === 'event_register')     include __DIR__ . '/partials/pa_event_register_form.php';
    elseif ($view === 'event_registered')   include __DIR__ . '/partials/pa_event_registered.php';
    elseif ($view === 'upcoming_events')    include __DIR__ . '/partials/pa_upcoming_events.php';
    elseif ($view === 'view_details')       include __DIR__ . '/partials/pa_details.php';
    elseif ($view === 'manage_events')      include __DIR__ . '/partials/a_manage_events.php';
    elseif ($view === 'add_event')          include __DIR__ . '/partials/a_add_event.php';
    elseif ($view === 'view_registrations') include __DIR__ . '/partials/a_view_registrations.php';
    elseif ($view === 'details')            include __DIR__ . '/partials/pa_details.php';
    else                                    include __DIR__ . '/partials/upcoming_events.php';
    ?>
</body>

</html>