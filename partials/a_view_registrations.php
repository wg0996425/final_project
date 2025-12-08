<h1>View All Registrations</h1>

<?php

$events = events_all();

?>

<table class="table">
    <?php if (count($events) > 0): ?>
        <?php foreach ($events as $e): ?>

            <thead>
                <th><?= htmlspecialchars($e['title']) ?></th>
                <th></th>
            </thead>

            <tbody>
                <?php $registrations = find_registration_by_id((int)$e['id']);
                if (count($registrations) > 0): ?>
                    <?php foreach ($registrations as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['name']) ?></td>
                            <td><?= htmlspecialchars($r['email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <td>Nobody Registered!</td>
                    <td></td>
                <?php endif; ?>
            </tbody>

        <?php endforeach; ?>
    <?php else: ?>
        <th>No events so far!</th>
    <?php endif; ?>
</table>