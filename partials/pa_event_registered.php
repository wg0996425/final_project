<?php 

$event = find_event_by_id($event_id);
$title = htmlspecialchars($event['title']);

?>

<h2>Thank you for registering for <?= $title ?>, <?= $name ?>! </h2>
<a href="?view=upcoming_events">Back to Upcoming Events</a>