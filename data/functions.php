<?php 

require_once __DIR__ . '/db.php';


function events_all(): array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("
        SELECT id, title, event_date, location FROM events WHERE event_date > NOW()
    ");

    $stmt->execute();
    return $stmt->fetchAll();
}

function event_create(string $title, string $event_date, string $location, string $description): void
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("
        INSERT INTO events (title, event_date, location, description)
        VALUES (:title, :event_date, :location, :description)
    ");
    $stmt->execute([
        ':title'         => $title,
        ':event_date'    => $event_date,
        ':location'      => $location,
        ':description'   => $description
    ]);
}

function user_find_by_username(string $username): ?array {
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :u");
    $stmt->execute([':u'=>$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function user_create(string $username, string $hash): void {
    $pdo = get_pdo();
    $sql = "INSERT INTO admins (username, password_hash)
            VALUES (:u, :p)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':u'=>$username, ':p'=>$hash]);
}

?>