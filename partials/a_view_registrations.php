<h1>View All Registrations</h1>

<?php

$events = events_all();

?>

<table>
    <?php if (count($events) > 0): ?>
        <?php foreach ($events as $e): ?>
            <h2><?= htmlspecialchars($e['title']) ?></h2>
            <thead>
                <th>Name</th>
                <th>Email</th>
            </thead>
            <tbody>
                <?php $registrations = find_registration_by_id((int)$e['id']) ?>
                <?php if (count($registrations) > 0): ?>
                    <?php foreach ($registrations as $r): ?>
                        <td><?= htmlspecialchars($r['name']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                    <?php endforeach; ?>
                <?php else: ?>
                    <td>Nobody Registered!</td>
                <?php endif; ?>
            </tbody>
        <?php endforeach; ?>
    <?php else: ?>
        <th>No events so far!</th>
    <?php endif; ?>
</table>