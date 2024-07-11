<?php
require_once(__DIR__ . '/tcpdf/tcpdf.php');

function getHtmlContent($tableData) {
    $html = '<h2>Data Transaksi Jual</h2>';
    $html .= '<table border="1" cellpadding="4">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Kode Item</th>';
    $html .= '<th>Nama</th>';
    $html .= '<th>Qty</th>';
    $html .= '<th>Harga Jual</th>';
    $html .= '<th>Total</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    $totalValue = 0;
    foreach ($tableData as $row) {
        $total = $row['qty'] * $row['hargajual'];
        $totalValue += $total;
        $html .= '<tr>';
        $html .= '<td>' . $row['kodeitem'] . '</td>';
        $html .= '<td>' . $row['nama'] . '</td>';
        $html .= '<td>' . $row['qty'] . '</td>';
        $html .= '<td>' . $row['hargajual'] . '</td>';
        $html .= '<td>' . $total . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '<tfoot>';
    $html .= '<tr>';
    $html .= '<td colspan="4">Total</td>';
    $html .= '<td>' . $totalValue . '</td>';
    $html .= '</tr>';
    $html .= '</tfoot>';
    $html .= '</table>';

    return $html;
}

// Mendapatkan data tabel dari POST request
$tableData = isset($_POST['tableData']) ? json_decode($_POST['tableData'], true) : [];

// Membuat objek TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Mengatur informasi dokumen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Generated PDF');
$pdf->SetSubject('PDF Generation');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Mengatur header data default
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

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

// Mendapatkan konten HTML
$html = getHtmlContent($tableData);

// Menulis HTML ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Menutup dan menghasilkan dokumen PDF
$pdf->Output('generated_pdf.pdf', 'I');
?>
