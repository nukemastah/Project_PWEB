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
            padding: 20px;
        }
        .button-container {
            display: flex;
            gap: 10px; /* Memberi jarak antara tombol */
            justify-content: flex-start; /* Mengatur posisi tombol ke kiri */
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
            text-align: center;
            padding: 10px;
            margin-top: 20px; /* Tambahkan margin-top untuk jarak dengan tombol */
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
    </style>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">UTAMA</div>
            <!-- Nav Item - Pages Collapse Menu -->
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
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">TRANSAKSI</div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Transaksi.php"><span>Transaksi</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h2>PELANGGAN</h2>
                </nav>
                <!-- KONTEN KITA -->
                <div class="pasang-konten">
                    <div class="button-container">
                        <div class="tombol-fungsi1">

                            <form method="POST" action="">
                                <input type="text" name="search" placeholder="Search by name">
                                <button type="submit">Search</button>
                            </form>

                        </div>
                            <div class="tombol-fungsi2">
                                <a href="addpelanggan.php"><button>ADD</button></a>
                            </div>
                    </div>
                        <!-- TAMPIL TABEL -->
                        <div class="kontentabel">
                        <h2>Data Pelanggan</h2>

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

                        $dsn = "mysql:host=$servername;dbname=$dbname";
                        $options = [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                            PDO::ATTR_EMULATE_PREPARES => false,
                        ];
                        $pdo = new PDO($dsn, $username, $password, $options);

                            // Menghapus data
                        if (isset($_GET['action']) && $_GET['action'] === 'hapus' && isset($_GET['kodepelanggan'])) {
                            $kodepelanggan = $_GET['kodepelanggan'];

                            $stmt = $pdo->prepare("DELETE FROM pelanggan WHERE kodepelanggan = :kodepelanggan");
                            $stmt->execute(['kodepelanggan' => $kodepelanggan]);

                            echo "<p>Data berhasil dihapus!</p>";
                        }

                        // Mengambil data untuk ditampilkan dan diedit
                        if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['kodepelanggan'])) {
                            $kodeitem = $_GET['kodepelanggan'];

                            $stmt = $pdo->prepare("SELECT * FROM item WHERE kodepelanggan = :kodepelanggan");
                            $stmt->execute(['kodepelanggan' => $kodepelanggan]);
                            $item = $stmt->fetch();
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

                        // Display table
                        if ($result->num_rows > 0) {
                            echo '<table>
                                    <thead>
                                        <tr>';
                            // Table headers
                            $fields_pelanggan = $result->fetch_fields();
                            foreach ($fields_pelanggan as $field) {
                                echo "<th>{$field->name}</th>";
                            }
                            echo "<th>Aksi</th></tr></thead><tbody>";

                            // Table rows
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                foreach ($row as $key => $value) {
                                    echo "<td>$value</td>";
                                }
                                echo "<td class='actions'>
                                        <a class='edit' href='addpelanggan.php?action=edit&kodepelanggan={$row['kodepelanggan']}'>Edit</a>
                                        <a class='delete' href='?action=hapus&kodepelanggan={$row['kodepelanggan']}' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                                    </td>";
                                echo "</tr>";
                            }
                            echo '</tbody></table>';
                        } else {
                            echo "<p>Tidak ada data ditemukan</p>";
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>
