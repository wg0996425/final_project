<nav class="navbar mk-navbar navbar-expand-lg">
    <div class="container-fluid">

        <ul class="navbar-nav me-auto">
            <li class="nav-item"><span class="navbar-brand">Event Planner    </span></li>
            <li class="nav-item"><a class="nav-link" href="?view=upcoming_events">Upcoming Events</a></li>
            <li class="nav-item"><a class="nav-link" href="?view=event_register">Register for an Event</a></li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <?php if (!empty($_SESSION['user_id'])): ?>
                <li class="nav-item"><a class="nav-link" href="?view=manage_events">Manage Events</a></li>
                <li class="nav-item"><a class="nav-link" href="?view=view_registrations">View Registrations</a></li>
                <li class="nav-item">
                    <form method="post">
                        <input type="hidden" name="action" value="logout">
                        <button class="btn btn-sm btn-outline-secondary">Logout</button>
                    </form>
                </li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="?view=login">Admin Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>