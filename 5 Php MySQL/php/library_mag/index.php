<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $mysqli->query("INSERT INTO library_users (username, password) VALUES ('$username', '$password')") or die($mysqli->error);
        $_SESSION['message'] = "Registration successful!";
        header("Location: index.php");

    } elseif (isset($_POST['add_book'])) {
        $title = $mysqli->real_escape_string($_POST['title']);
        $author = $mysqli->real_escape_string($_POST['author']);
        $user_id = $_SESSION['user_id'];

        $result = $mysqli->query("SELECT COUNT(*) AS book_count FROM books WHERE user_id='$user_id'");
        $book_count = $result->fetch_assoc()['book_count'];

        if ($book_count < 2) {
            $mysqli->query("INSERT INTO books (title, author, user_id) VALUES ('$title', '$author', '$user_id')") or die($mysqli->error);
            $_SESSION['message'] = "Book added successfully!";
        } else {
            $_SESSION['message'] = "You can only add up to 2 books!";
        }
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>Library Management System</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <p>Welcome, <?= $_SESSION['username']; ?>! <a href="logout.php">Logout</a></p>
    <h2>Add a New Book</h2>
    <form action="index.php" method="POST">
        <input type="text" name="title" class="form-control" placeholder="Title" required>
        <input type="text" name="author" class="form-control" placeholder="Author" required>
        <input type="submit" name="add_book" value="Add Book" class="btn btn-primary">
    </form>
    <h2>Your Books</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_id = $_SESSION['user_id'];
            $result = $mysqli->query("SELECT * FROM books WHERE user_id='$user_id'");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['title']; ?></td>
                <td><?= $row['author']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>