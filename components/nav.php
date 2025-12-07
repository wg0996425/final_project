<ul>
    <li><a href="?view=upcoming_events">Upcoming Events</a></li>
    <li><a href="?view=details">View Details</a></li>
</ul>

<ul>
    <?php if (!empty($_SESSION['user_id'])): ?>
        <li><a href="?view=manage_events">Manage Events</a></li>
        <li><a href="?view=view_registrations">View Registration</a></li>
        <li>
            <form method="post">
                <input type="hidden" name="action" value="logout">
                <button class="btn btn-sm btn-outline-secondary">Logout</button>
            </form>
        </li>
    <?php else: ?>
        <li><a href="?view=register">Register</a></li>
        <li><a href="?view=login">Login</a></li>
    <?php endif; ?>
</ul>