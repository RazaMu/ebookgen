<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimalist Bookstore</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Minimalist Bookstore</div>
            <ul>
                <li><a href="#featured">Featured</a></li>
                <li><a href="#new-releases">New Releases</a></li>
                <li><a href="#bestsellers">Bestsellers</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="featured">
            <h2>Featured Books</h2>
            <div class="book-grid">
                <?php
                $featured_books = [
                    ['id' => 1, 'title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'cover' => 'great_gatsby.jpg'],
                    ['id' => 2, 'title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'cover' => 'mockingbird.jpg'],
                    ['id' => 3, 'title' => '1984', 'author' => 'George Orwell', 'cover' => '1984.jpg'],
                ];

                foreach ($featured_books as $book) {
                    echo "<div class='book'>";
                    echo "<a href='product.php?id={$book['id']}'>";
                    echo "<img src='covers/{$book['cover']}' alt='{$book['title']}'>";
                    echo "<h3>{$book['title']}</h3>";
                    echo "<p>{$book['author']}</p>";
                    echo "</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>

        <!-- Add similar sections for New Releases and Bestsellers -->
    </main>

    <footer>
        <p>&copy; 2024 Minimalist Bookstore. All rights reserved.</p>
    </footer>
</body>
</html>
