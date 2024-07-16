<?php
// checkout.php
include 'db_connection.php';

$tableData = json_decode($_POST['tableData'], true);
$rekening = $_POST['rekening'];
$total = $_POST['total'];

$conn->begin_transaction();

try {
    foreach ($tableData as $item) {
        $kodeitem = $item['kodeitem'];
        $qty = $item['qty'];

        // Update item quantity
        $updateItemSql = "UPDATE item SET stok = stok - $qty WHERE kodeitem = '$kodeitem'";
        if (!$conn->query($updateItemSql)) {
            throw new Exception("Failed to update item quantity: " . $conn->error);
        }
    }

    // Update rekening saldo
    $updateRekeningSql = "UPDATE rekening SET saldo = saldo + $total WHERE koderekening = '$rekening'";
    if (!$conn->query($updateRekeningSql)) {
        throw new Exception("Failed to update rekening saldo: " . $conn->error);
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => 'Checkout successful!']);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// Generate PDF (this should ideally be in a separate function/file)
// For simplicity, we're doing it here using FPDF library

require('fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Transaction Receipt', 0, 1, 'C');
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function TransactionTable($header, $data) {
        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $col) {
            $this->Cell(40, 7, $col, 1);
        }
        $this->Ln();
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(40, 6, $col, 1);
            }
            $this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();
$header = ['Kode Item', 'Nama', 'Qty', 'Harga Jual'];
$pdf->TransactionTable($header, $tableData);
$pdf->Output('F', 'receipts/transaction_receipt_' . uniqid() . '.pdf');

?>
