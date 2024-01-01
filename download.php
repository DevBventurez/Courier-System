<?php
session_start();

if (isset($_SESSION['uid'])) {
    // No need to echo an empty string, you can omit this block
} else {
    header('location: ../login.php');
}

// Include TCPDF
require_once('tcpdf/tcpdf.php');

// Fetch data from the database
include('../dbconnection.php');
$qryd = "SELECT * FROM `courier`";
$run = mysqli_query($dbcon, $qryd);

if (mysqli_num_rows($run) < 1) {
    echo "<tr><td colspan='6'>No record found..</td></tr>";
} else {
    // Create a PDF instance
    $pdf = new TCPDF();

    // Set document information
    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Courier Data');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add content to PDF
    $pdf->SetFillColor(0, 128, 0); // Green color for the header
    $pdf->Cell(0, 10, 'Courier Data', 0, 1, 'C', 1); // Colored header
    $pdf->Ln(10);

    // Header for the table
    $pdf->SetFillColor(0, 128, 0); // Green color for the header
    $pdf->SetTextColor(255); // White text
    $pdf->Cell(40, 10, 'Record', 1, 0, 'C', 1);
    $pdf->Cell(60, 10, 'Courier Name', 1, 0, 'C', 1);
    $pdf->Cell(60, 10, 'Receiver Name', 1, 0, 'C', 1);
    $pdf->Cell(60, 10, 'Sender Email', 1, 1, 'C', 1);

    $count = 0;
    while ($data = mysqli_fetch_assoc($run)) {
        $count++;
        $pdf->SetFillColor(255); // White color for the rows
        $pdf->SetTextColor(0); // Black text
        $pdf->Cell(40, 10, $count, 1, 0, 'C', 0);
        $pdf->Cell(60, 10, $data['sname'], 1, 0, 'C', 0);
        $pdf->Cell(60, 10, $data['rname'], 1, 0, 'C', 0);
        $pdf->Cell(60, 10, $data['semail'], 1, 1, 'C', 0);
    }

    // Output the PDF to the browser
    $pdf->Output('courier_data.pdf', 'D');
}
?>