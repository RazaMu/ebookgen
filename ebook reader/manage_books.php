<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Manage Books</h1>
    </header>
    <main>
        <a href="add_book.php">Add New Book</a>
        <a href="generate_books_report.php" class="report-button">Generate Reports</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Cover</th>
                    <th>Description</th>
                    <th>Featured</th>
                    <th>PDF File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connect.php';
                $result = $conn->query("SELECT * FROM books");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['author']}</td>
                        <td><img src='covers/{$row['cover']}' alt='{$row['title']}' width='50'></td>
                        <td>{$row['description']}</td>
                        <td>" . ($row['featured'] ? 'Yes' : 'No') . "</td>
                        <td>{$row['pdf_file']}</td>
                        <td>
                            <a href='edit_book.php?id={$row['id']}'>Edit</a> |
                            <a href='delete_book.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
