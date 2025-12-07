<ul>
    <li><a href="?view=upcoming_events">Upcoming Events</a></li>
    <li><a href="?view=event_register">Register for an Event</a></li>
</ul>

<ul>
    <?php if (!empty($_SESSION['user_id'])): ?>
        <li><a href="?view=manage_events">Manage Events</a></li>
        <li><a href="?view=view_registrations">View Registrations</a></li>
        <li>
            <form method="post">
                <input type="hidden" name="action" value="logout">
                <button>Logout</button>
            </form>
        </li>
    <?php else: ?>
        <li><a href="?view=login">Admin Login</a></li>
    <?php endif; ?>
</ul>