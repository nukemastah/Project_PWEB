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
    } elseif ($_POST['ajax'] === 'delete') {
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
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .pasang-konten {
            border: 5px;
            background-color: lightblue;
            padding: 20px;
        }
        .button-container {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }
        .tombol-fungsi1 {
            width: 290px;
            height: 50px;
            border: 5px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .tombol-fungsi2 {
            width: 150px;
            height: 50px;
            border: 5px;
            margin-left: -60px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .kontentabel {
            border: 5px;
            background-color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .actions a {
            margin-right: 5px;
            text-decoration: none;
        }
        .edit-form {
            display: none;
        }
        .edit-form input[type="text"] {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">UTAMA</div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Pelanggan.php"><span>Pelanggan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Pemasok.php"><span>Pemasok</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Item.php"><span>Item</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Rekening.php"><span>Rekening</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">TRANSAKSI</div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="TransaksiJual.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>Transaksi Jual</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="TransaksiBeli.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>Transaksi Beli</span>
                </a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h2>PELANGGAN</h2>
                </nav>
                <div class="pasang-konten">
                    <div class="button-container">
                        <div class="tombol-fungsi1">
                            <form method="POST" action="">
                                <input type="text" name="search" placeholder="Search by name">
                                <button type="submit">Search</button>
                            </form>
                        </div>
                        <div class="tombol-fungsi2">
                            <a href="addpelanggan.php"><button type="button">ADD</button></a>
                        </div>
                    </div>
                    <div class="kontentabel">
                        <h2>Data Pelanggan</h2>
                        <?php
                        if ($result->num_rows > 0) {
                            echo '<table>
                                    <thead>
                                        <tr>
                                            <th>Kode Pelanggan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr id='row-{$row['kodepelanggan']}'>
                                        <td>{$row['kodepelanggan']}</td>
                                        <td>{$row['namapelanggan']}</td>
                                        <td>{$row['alamat']}</td>
                                        <td>{$row['kota']}</td>
                                        <td>{$row['telepon']}</td>
                                        <td>{$row['email']}</td>
                                        <td class='actions'>
                                            <a class='edit' href='javascript:void(0);' onclick='editRow({$row['kodepelanggan']});'>Edit</a>
                                            <a class='delete' href='javascript:void(0);' onclick='deleteRow({$row['kodepelanggan']});'>Hapus</a>
                                        </td>
                                    </tr>
                                    <tr class='edit-form' id='edit-{$row['kodepelanggan']}'>
                                        <td><input type='text' id='edit-kodepelanggan-{$row['kodepelanggan']}' value='{$row['kodepelanggan']}'></td>
                                        <td><input type='text' id='edit-namapelanggan-{$row['kodepelanggan']}' value='{$row['namapelanggan']}'></td>
                                        <td><input type='text' id='edit-alamat-{$row['kodepelanggan']}' value='{$row['alamat']}'></td>
                                        <td><input type='text' id='edit-kota-{$row['kodepelanggan']}' value='{$row['kota']}'></td>
                                        <td><input type='text' id='edit-telepon-{$row['kodepelanggan']}' value='{$row['telepon']}'></td>
                                        <td><input type='text' id='edit-email-{$row['kodepelanggan']}' value='{$row['email']}'></td>
                                        <td class='actions'>
                                            <button onclick='saveRow({$row['kodepelanggan']});'>Save</button>
                                            <button onclick='cancelEdit({$row['kodepelanggan']});'>Cancel</button>
                                        </td>
                                    </tr>";
                            }
                            echo '</tbody></table>';
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        function editRow(kodepelanggan) {
            document.getElementById('row-' + kodepelanggan).style.display = 'none';
            document.getElementById('edit-' + kodepelanggan).style.display = 'table-row';
        }

        function cancelEdit(kodepelanggan) {
            document.getElementById('edit-' + kodepelanggan).style.display = 'none';
            document.getElementById('row-' + kodepelanggan).style.display = 'table-row';
        }

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
                alert(response);
                location.reload();
            });
        }

        function deleteRow(kodepelanggan) {
            if (confirm('Anda yakin ingin menghapus data ini?')) {
                $.post(window.location.href, {
                    ajax: 'delete',
                    kodepelanggan: kodepelanggan
                }, function(response) {
                    alert(response);
                    location.reload();
                });
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
