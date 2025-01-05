<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $author = htmlspecialchars(trim($_POST['author']));
    $published_year = intval($_POST['published_year']);
    $genre = htmlspecialchars(trim($_POST['genre']));

    $stmt = $pdo->prepare("INSERT INTO books (title, author, published_year, genre) VALUES (?, ?, ?, ?)");
    $stmt->execute([$title, $author, $published_year, $genre]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container p-4 bg-white shadow rounded" style="max-width: 500px;">
        <h2 class="text-center mb-4">Tambah Buku</h2>
        <form action="create.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Judul:</label>
                <input type="text" id="title" name="title" placeholder="Enter book title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Pengarang:</label>
                <input type="text" id="author" name="author" placeholder="Enter author name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="published_year" class="form-label">Tahun:</label>
                <input type="number" id="published_year" name="published_year" placeholder="Enter published year" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre:</label>
                <input type="text" id="genre" name="genre" placeholder="Enter genre" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
        <a href="index.php" class="d-block mt-3 text-center text-decoration-none text-primary">Back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
