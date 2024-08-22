<?php
require_once('tcpdf/tcpdf.php');
include 'db_connect.php';

// Create new PDF document
$pdf = new TCPDF();
$pdf->AddPage();

// Set title and font
$pdf->SetTitle('Users Report');
$pdf->SetFont('helvetica', '', 12);

// Fetch users from the database
$sql = "SELECT first_name, last_name, username, email FROM users";
$result = $conn->query($sql);

$html = '<h1>Users Report</h1><table border="1" cellpadding="5">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
            </tr>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['first_name'] . '</td>
                <td>' . $row['last_name'] . '</td>
                <td>' . $row['username'] . '</td>
                <td>' . $row['email'] . '</td>
              </tr>';
}

$html .= '</table>';

// Print HTML content
$pdf->writeHTML($html);

// Close and output PDF document
$pdf->Output('users_report.pdf', 'D');
?>
