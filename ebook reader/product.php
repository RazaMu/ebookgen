<?php
require_once 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - Ebook Reader</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Ebook Reader</div>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $sql = "SELECT id, title, author, cover, description, pdf_file FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $book = $result->fetch_assoc();
            echo "<div class='book-details'>";
            echo "<img src='covers/{$book['cover']}' alt='{$book['title']}'>";
            echo "<div class='book-info'>";
            echo "<h1>{$book['title']}</h1>";
            echo "<h2>{$book['author']}</h2>";
            echo "<p>{$book['description']}</p>";
            echo "<button onclick='openPdfViewer(\"ebooks/{$book['pdf_file']}\")' class='read-button'>Read</button>";
            echo "</div>";
            echo "</div>";
            echo "<div id='pdf-viewer' class='pdf-viewer'>";
            echo "<div class='pdf-viewer-content'>";
            echo "<embed src='' id='pdf-embed' type='application/pdf'>";
            echo "<div class='button-container'>";
            echo "<button onclick='closePdfViewer()' class='close-button'>Close</button>";
            echo "<button onclick='openGeneratePage()' class='generate-button'>Generate</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>Book not found.</p>";
        }
        $stmt->close();
        ?>
    </main>

    <footer>
        <p>&copy; 2024 Ebook Reader. All rights reserved.</p>
    </footer>

    <script>
        function openPdfViewer(pdfUrl) {
            document.getElementById('pdf-embed').src = pdfUrl;
            document.getElementById('pdf-viewer').style.display = 'flex';
        }

        function closePdfViewer() {
            document.getElementById('pdf-viewer').style.display = 'none';
            document.getElementById('pdf-embed').src = '';
        }

        function openGeneratePage() {
            window.open('generate.html', '_blank');
        }
    </script>
</body>
</html>
<?php
$conn->close();
?>
