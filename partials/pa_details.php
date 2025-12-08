<?php

$is_set = isset($event_id);

$event       = $is_set ? find_event_by_id($event_id)             : '';
$title       = $is_set ? htmlspecialchars($event['title'])       : '';
$description = $is_set ? htmlspecialchars($event['description']) : '';

?>

<h1>Details for <?= $title ?></h1>
<p><?= $description ?></p>

<br>

<a href="?view=upcoming_events">Back</a>