<?php
include 'db.php';

header('Content-Type: application/json');

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch single movie
            $id = $_GET['id'];
            $stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
            $stmt->execute([$id]);
            $movie = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($movie);
        } else {
            // Fetch all movies
            $stmt = $pdo->query("SELECT * FROM movies");
            $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($movies);
        }
        break;

    case 'POST':
        // Insert movie
        $data = json_decode(file_get_contents("php://input"));
        $stmt = $pdo->prepare("INSERT INTO movies (title, genre, duration) VALUES (?, ?, ?)");
        $stmt->execute([$data->title, $data->genre, $data->duration]);
        echo json_encode(['status' => 'Movie added']);
        break;

    case 'PUT':
        // Update movie
        $data = json_decode(file_get_contents("php://input"));
        $stmt = $pdo->prepare("UPDATE movies SET title = ?, genre = ?, duration = ? WHERE id = ?");
        $stmt->execute([$data->title, $data->genre, $data->duration, $data->id]);
        echo json_encode(['status' => 'Movie updated']);
        break;

    case 'DELETE':
        // Delete movie
        $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['status' => 'Movie deleted']);
        break;

    default:
        echo json_encode(['status' => 'Invalid request']);
        break;
}
?>