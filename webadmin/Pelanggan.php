<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_pweb";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Function to generate unique code
function generateCode($tableName, $prefix, $length = 5) {
    global $conn;
    $lastCodeQuery = "SELECT MAX(kodepelanggan) FROM $tableName WHERE kodepelanggan LIKE '$prefix%'";
    $result = $conn->query($lastCodeQuery);
    $row = $result->fetch_row();
    $lastCode = $row[0];

    $lastNumber = (int)substr($lastCode, strlen($prefix));
    $nextNumber = $lastNumber + 1;
    $nextCode = $prefix . str_pad($nextNumber, $length, '0', STR_PAD_LEFT);
    return $nextCode;
}

// Update logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
    if ($_POST['ajax'] === 'update') {
        $kodepelanggan_old = $_POST['kodepelanggan_old'];
        $kodepelanggan = $_POST['kodepelanggan'];
        $namapelanggan = $_POST['namapelanggan'];
        $alamat = $_POST['alamat'];
        $kota = $_POST['kota'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];

        $sql = "UPDATE pelanggan SET kodepelanggan='$kodepelanggan', namapelanggan='$namapelanggan', alamat='$alamat', kota='$kota', telepon='$telepon', email='$email' WHERE kodepelanggan='$kodepelanggan_old'";
        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil diperbarui!";
        } else {
            echo "Terjadi kesalahan saat memperbarui data.";
        }
        exit;
    }
    
    // Check if code exists
    elseif ($_POST['ajax'] === 'check') {
        $kodepelanggan = $_POST['kodepelanggan'];
        $sql = "SELECT * FROM pelanggan WHERE kodepelanggan = '$kodepelanggan'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Kode pelanggan sudah ada.";
        } else {
            echo "Kode pelanggan tersedia.";
        }
        exit;
    }
    
    // Delete logic
    elseif ($_POST['ajax'] === 'delete') {
        $kodepelanggan = $_POST['kodepelanggan'];
        $stmt = $conn->prepare("DELETE FROM pelanggan WHERE kodepelanggan = ?");
        $stmt->bind_param("s", $kodepelanggan);
        $stmt->execute();
        echo "Data berhasil dihapus!";
        exit;
    }
}

// Handle search
$search = isset($_POST['search']) ? $_POST['search'] : '';
if (!empty($search)) {
    $sql = $conn->prepare("SELECT * FROM pelanggan WHERE namapelanggan LIKE ?");
    $likeSearch = "%" . $search . "%";
    $sql->bind_param("s", $likeSearch);
    $sql->execute();
    $result = $sql->get_result();
} else {
    $sql_pelanggan = "SELECT * FROM pelanggan";
    $result = $conn->query($sql_pelanggan);
}
?>

<!DOCTYPE html>
<html lang="en">
<body id="page-top">
    <div class="pasang-konten">
        <div class="kontentabel">
            <h2>Data Pelanggan</h2>

            <script>
                // ... (Bagian fungsi JavaScript editRow dan deleteRow sama seperti sebelumnya, HANYA PERUBAHAN DI BAGIAN saveRow) ... -->
                function saveRow(kodepelanggan) {
                var kodepelanggan_new = document.getElementById('edit-kodepelanggan-' + kodepelanggan).value;
                var namapelanggan = document.getElementById('edit-namapelanggan-' + kodepelanggan).value;
                var alamat = document.getElementById('edit-alamat-' + kodepelanggan).value;
                var kota = document.getElementById('edit-kota-' + kodepelanggan).value;
                var telepon = document.getElementById('edit-telepon-' + kodepelanggan).value;
                var email = document.getElementById('edit-email-' + kodepelanggan).value;
                 
                $.post(window.location.href, {
                    ajax: 'update',
                    kodepelanggan_old: kodepelanggan,
                    kodepelanggan: kodepelanggan_new,
                    namapelanggan: namapelanggan,
                    alamat: alamat,
                    kota: kota,
                    telepon: telepon,
                    email: email
                  }, function(response) {
                    if(response=="Terjadi kesalahan saat memperbarui data."){
                        $.post(window.location.href, {
                        ajax: 'check',
                        kodepelanggan: kodepelanggan_new
                      }, function(response) {
                          if(response=="Kode pelanggan sudah ada."){
                              alert(response);
                              location.reload();
                          }
                          else{
                              alert(response);
                              location.reload();
                          }
                        });
                    }
                    else{
                        alert(response);
                        location.reload();
                    }
                  });
                }
            </script>

        </div>
    </div>

    </body>
</html>

<?php
$conn->close();
?>
