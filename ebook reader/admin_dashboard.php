<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="manage_books.php">Manage Books</a>
            <a href="manage_users.php">Manage Users</a>
        </nav>
    </header>
    <main>
        <h2>Welcome, Admin</h2>
        <section>
            <h3>Books</h3>
            <a href="add_book.php">Add New Book</a>
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
        </section>
        <section>
            <h3>Users</h3>
            <a href="add_user.php">Add New User</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM users");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['created_at']}</td>
                            <td>
                                <a href='edit_user.php?id={$row['id']}'>Edit</a> |
                                <a href='delete_user.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
