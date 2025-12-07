<?php 

$is_edit     = isset($event) && isset($event['id']);
$action      = $is_edit ? 'update_event' : 'add_event';

$title       = $is_edit ? htmlspecialchars($record['title'])  : '';
$date        = $is_edit ? htmlspecialchars($record['event_date']) : '';
$location    = $is_edit ? htmlspecialchars($record['location'])  : '';
$description = $is_edit ? htmlspecialchars($record['description'])  : '';

?>

<h1><?= $is_edit ? 'Edit Event' : 'Add Event' ?></h1>

<form method="post">
    <div>
        <label>Title</label>
        <input name="title" type="text" value="<?= $title ?>" required>
    </div>

    <div>
        <label>Date</label>
        <input name="date" type="date" value="<?= $date ?>" required>
    </div>

    <div>
        <label>Location</label>
        <input name="location" type="text" value="<?= $location ?>" required>
    </div>

    <div>
        <label>Description</label>
        <input name="description" type="text" value="<?= $description ?>" required>
    </div>


    <input type="hidden" name="action" value="<?= $action ?>">
    <?php if ($is_edit): ?>
        <input type="hidden" name="id" value="<?= (int)$event['id'] ?>">
    <?php endif; ?>

    <div>
        <button><?= $is_edit ? 'Update' : 'Create' ?></button>
        <a href="?view=welcome">Cancel</a>
    </div>
</form>