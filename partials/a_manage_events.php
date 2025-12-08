<?php

$rows = events_all();

?>

<h1>Manage Events</h1>

<a href="?view=add_event">Add Event</a>

<table>
    <thead>
        <th>Title</th>
        <th>Event Date</th>
        <th>Location</th>
        <th>Description</th>
        <th>Actions</th>
    </thead>

    <tbody>
        <?php if (count($rows) > 0): ?>
            <?php foreach ($rows as $r): ?>
                <td><?= htmlspecialchars($r['title']) ?></td>
                <td><?= htmlspecialchars($r['event_date']) ?></td>
                <td><?= htmlspecialchars($r['location']) ?></td>
                <td>
                    <?php if (!empty($r['description'])) : ?>
                        <form method="post">
                            <input type="hidden" name="event_id" value="<?= $r['id'] ?>">
                            <input type="hidden" name="action" value="view_details">
                            <button>View</button>
                        </form>
                    <?php else: ?>
                <td>N/A</td>
            <?php endif; ?>
            </td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $r['id'] ?>">
                    <input type="hidden" name="action" value="edit_event">
                    <button>Edit</button>
                </form>

                <form method="post" onsubmit="return confirm('Delete this event?');">
                    <input type="hidden" name="id" value="<?= $r['id'] ?>">
                    <input type="hidden" name="action" value="delete_event">
                    <button>Delete</button>
                </form>
            </td>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td>No events found!</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>