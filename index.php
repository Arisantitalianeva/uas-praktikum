<?php
include 'db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    $stmt = $pdo->prepare("SELECT * FROM books WHERE title LIKE ?");
    $stmt->execute(['%' . $search . '%']);
} else {
    $stmt = $pdo->prepare("SELECT * FROM books");
    $stmt->execute();
}
$books = $stmt->fetchAll();

if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$id]);

    // Reset ID
    $pdo->exec("SET @num = 0; UPDATE books SET id = (@num := @num + 1); ALTER TABLE books AUTO_INCREMENT = 1;");

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Data Buku</h1>

        <form class="d-flex mb-3" method="GET" action="index.php">
            <input class="form-control me-2" type="text" name="search" placeholder="Cari berdasarkan judul..." value="<?= htmlspecialchars($search); ?>">
            <button class="btn btn-outline-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
        <a href="create.php" class="btn btn-success mb-3">
            <i class="bi bi-plus"></i> Tambah Buku
        </a>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Genre</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($books) > 0): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['id']); ?></td>
                            <td><?= htmlspecialchars($book['title']); ?></td>
                            <td><?= htmlspecialchars($book['author']); ?></td>
                            <td><?= htmlspecialchars($book['published_year']); ?></td>
                            <td><?= htmlspecialchars($book['genre']); ?></td>
                            <td>
                                <a href="update.php?id=<?= $book['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                                <a href="?hapus=<?= $book['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?');"><i class="bi bi-trash"></i>Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Buku tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
