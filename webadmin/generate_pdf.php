<?php
// generate_pdf.php

// Meng-include file tcpdf.php
require_once(__DIR__ . '/tcpdf/tcpdf.php');

// Mengatur koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_pweb";

$dsn = "mysql:host=$servername;dbname=$dbname";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $username, $password, $options);

// Fungsi untuk mengambil data dan mengembalikannya dalam bentuk array
function fetchDataArray($pdo, $tableName, $columns) {
    $stmt = $pdo->query("SELECT " . implode(", ", $columns) . " FROM $tableName");
    $data = $stmt->fetchAll();
    return $data;
}

// Columns for each table
$pemasokColumns = ['kodepemasok', 'namapemasok', 'alamat', 'kota', 'telepon', 'email'];
$rekeningColumns = ['koderekening', 'namarekening', 'saldo'];
$itemColumns = ['kodeitem', 'nama', 'hargabeli', 'hargajual', 'stok', 'satuan'];
$pelangganColumns = ['kodepelanggan', 'namapelanggan', 'alamat', 'kota', 'telepon', 'email'];

// Fetch data for each table
$pemasokData = fetchDataArray($pdo, 'pemasok', $pemasokColumns);
$rekeningData = fetchDataArray($pdo, 'rekening', $rekeningColumns);
$itemData = fetchDataArray($pdo, 'item', $itemColumns);
$pelangganData = fetchDataArray($pdo, 'pelanggan', $pelangganColumns);

// Fungsi untuk menggambar tabel menggunakan TCPDF
function drawTable($pdf, $header, $data) {
    $pdf->SetFillColor(240, 240, 240); // Warna latar belakang header
    $pdf->SetTextColor(0); // Warna teks header
    $pdf->SetDrawColor(0, 0, 0); // Warna border
    $pdf->SetLineWidth(0.3);

    // Set header
    foreach ($header as $col) {
        $pdf->Cell(30, 7, $col, 1, 0, 'C', 1);
    }
    $pdf->Ln();

    // Set data
    foreach ($data as $row) {
        foreach ($row as $cell) {
            $pdf->Cell(30, 6, $cell, 1);
        }
        $pdf->Ln();
    }
}

// Membuat dokumen PDF baru
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Mengatur informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PROJECT PWEB');
$pdf->SetTitle('Generated PDF');
$pdf->SetSubject('PDF Generation');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// Mengatur font header dan footer
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Mengatur font monospace default
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Mengatur margin
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Mengatur auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Mengatur image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Menambah halaman
$pdf->AddPage();

// Mengatur font
$pdf->SetFont('helvetica', '', 12);

// Gambar tabel pemasok
$pdf->Cell(0, 10, 'Data Pemasok', 0, 1, 'C');
drawTable($pdf, $pemasokColumns, $pemasokData);

$pdf->AddPage();

// Gambar tabel rekening
$pdf->Cell(0, 10, 'Data Rekening', 0, 1, 'C');
drawTable($pdf, $rekeningColumns, $rekeningData);

$pdf->AddPage();

// Gambar tabel item
$pdf->Cell(0, 10, 'Data Item', 0, 1, 'C');
drawTable($pdf, $itemColumns, $itemData);

$pdf->AddPage();

// Gambar tabel pelanggan
$pdf->Cell(0, 10, 'Data Pelanggan', 0, 1, 'C');
drawTable($pdf, $pelangganColumns, $pelangganData);

// Menutup dan menghasilkan dokumen PDF
$pdf->Output('generated_pdf.pdf', 'I');
?>
