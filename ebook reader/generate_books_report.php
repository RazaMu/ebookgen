<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'tcpdf/tcpdf.php'; // Make sure this path is correct
include 'db_connect.php'; // Ensure this file connects to your database

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Author Name');
$pdf->SetTitle('Books Report');
$pdf->SetSubject('TCPDF Tutorial');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add title
$pdf->Cell(0, 10, 'Books Report', 0, 1, 'C');

// Fetch books from the database
$sql = "SELECT title, author FROM books";
$result = $conn->query($sql);

if ($result) {
    $html = '<table border="1" cellpadding="5">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                </tr>';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . htmlspecialchars($row['title']) . '</td>
                    <td>' . htmlspecialchars($row['author']) . '</td>
                  </tr>';
    }
    $html .= '</table>';
    
    // Write HTML content
    $pdf->writeHTML($html);
    
    // Output PDF document
    $pdf->Output('books_report.pdf', 'I'); // 'I' for inline display in the browser
} else {
    echo "Database query failed: " . $conn->error;
}
?>
