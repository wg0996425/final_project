<?php 

$events = upcoming_events_all();

?>

<h1>Register for an Event!</h1>

<?php if (!empty($register_error)): ?>
    <div><?= $register_error ?></div>
<?php endif; ?>

<form method="post">
    <div>
        <label>Name</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Event</label>
        <select name="event_id" required>
            <option value="">Select...</option>
            <?php foreach ($events as $e): ?>
                <?php $eid = (int)$e['id']; ?>
                <option value="<?= $eid ?>">
                    <?= htmlspecialchars($e['title']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <input type="hidden" name="action" value="event_register">
    <button>Register</button>
</form>
