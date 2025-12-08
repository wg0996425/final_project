<?php

require_once __DIR__ . '/db.php';


function upcoming_events_all(): array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("
        SELECT * FROM events WHERE event_date > NOW()
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

function events_all(): array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("
        SELECT * FROM events
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

function find_registration_by_id(int $event_id): array 
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("
        SELECT * FROM registrations WHERE event_id = :ei
    ");
    $stmt->execute([':ei' => $event_id]);
    return $stmt->fetchAll();
}

function find_event_by_id(int $id): array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("
        SELECT * FROM events WHERE id = :i
    ");
    $stmt->execute([':i' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
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

function event_update(int $id, string $title, string $event_date, string $location, string $description): void
{
    $pdo = get_pdo();
    $sql = "UPDATE events
                SET title = :title,
                event_date = :event_date,
                location = :location,
                description = :description
                WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title'       => $title,
        ':event_date'  => $event_date,
        ':location'    => $location,
        ':description' => $description,
        ':id'          => $id
    ]);
}

function registered_insert(int $event_id, string $name, string $email): void
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("
        INSERT INTO registrations (event_id, name, email)
        VALUES (:event_id, :name, :email)
    ");
    $stmt->execute([
        ':event_id'      => $event_id,
        ':name'          => $name,
        ':email'         => $email,
    ]);
}

function user_find_by_username(string $username): ?array
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :u");
    $stmt->execute([':u' => $username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function user_create(string $username, string $hash): void
{
    $pdo = get_pdo();
    $sql = "INSERT INTO admins (username, password_hash)
            VALUES (:u, :p)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':u' => $username, ':p' => $hash]);
}

function event_delete(int $id)
{
    $pdo = get_pdo();
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = :id");
    $stmt->execute([':id' => $id]);
}
