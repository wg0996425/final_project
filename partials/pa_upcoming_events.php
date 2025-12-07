<?php 

$rows = upcoming_events_all();

?>


<h1>Upcoming Events</h1>

<table>
    <thead>
        <th>Title</th>
        <th>Event Date</th>
        <th>Location</th>
        <th>Description</th>
    </thead>

    <tbody>
        <?php if (count($rows) > 0): ?>
            <?php foreach ($rows as $r): ?>
                <td><?= htmlspecialchars($r['title']) ?></td>
                <td><?= htmlspecialchars($r['event_date']) ?></td>
                <td><?= htmlspecialchars($r['location']) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                        <input type="hidden" name="view" value="welcome">
                        <button>View</button>
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