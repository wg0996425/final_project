<?php

$rows = upcoming_events_all();

?>


<h1>Upcoming Events!</h1>

<table class="table">
    <thead>
        <th scope="col">Title</th>
        <th scope="col">Event Date</th>
        <th scope="col">Location</th>
        <th scope="col">Description</th>
    </thead>

    <tbody>
        <?php if (count($rows) > 0): ?>
            <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['title']) ?></td>
                    <td><?= htmlspecialchars($r['event_date']) ?></td>
                    <td><?= htmlspecialchars($r['location']) ?></td>
                    <td>
                        <?php if (!empty($r['description'])) : ?>
                            <form method="post">
                                <input type="hidden" name="event_id" value="<?= $r['id'] ?>">
                                <input type="hidden" name="action" value="view_details">
                                <button class="btn btn-sm btn-outline-success">View</button>
                            </form>
                        <?php else: ?>
                    <td>N/A</td>
                <?php endif; ?>
                </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td>No events found!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>