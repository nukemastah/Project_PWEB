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
        form input, form button {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form button {
            background: #333;
            color: #fff;
            cursor: pointer;
        }
        form button:hover {
            background: #555;
        }
        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            color: #fff;
            border-radius: 3px;
            margin-right: 5px;
        }
        form {
            background: #fff;
            padding: 20px;
            /* margin-bottom: px; */
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto; /* Mengatur posisi form menjadi ditengah */
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
                <a class="nav-link collapsed" href="TransaksiJual.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>Transaksi Jual</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="TransaksiBeli.php" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>Transaksi Beli</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h2>TAMBAH DATA ITEM</h2>
                </nav>
                <!-- KONTEN KITA -->
                <div class="pasang-konten">
                    <div class="button-container">
                        <form method="POST">
                        <input type="hidden" name="action" value="<?php echo isset($item) ? 'edit' : 'tambah'; ?>">
                        <?php if (isset($item)): ?>
                            <input type="hidden" name="kodeitem" value="<?php echo $item['kodeitem']; ?>">
                                <?php endif; ?>
                                Kode Item: <input type="text" name="kodeitem" value="<?php echo isset($item) ? $item['kodeitem'] : ''; ?>" <?php echo isset($item) ? 'readonly' : ''; ?> required><br>
                                Nama Item: <input type="text" name="nama" value="<?php echo isset($item) ? $item['nama'] : ''; ?>" required><br>
                                Harga Beli: <input type="text" name="hargabeli" value="<?php echo isset($item) ? $item['hargabeli'] : ''; ?>" required><br>
                                Harga Jual: <input type="text" name="hargajual" value="<?php echo isset($item) ? $item['hargajual'] : ''; ?>" required><br>
                                Stok: <input type="text" name="stok" value="<?php echo isset($item) ? $item['stok'] : ''; ?>" required><br>
                                Satuan: <input type="text" name="satuan" value="<?php echo isset($item) ? $item['satuan'] : ''; ?>" required><br>
                                <button type="submit"><?php echo isset($item) ? 'Update' : 'Tambah'; ?></button>
                            </form>

                        <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "project_pweb";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Process form submission
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $action = $_POST['action'];
                                $kodeitem = $_POST['kodeitem'];
                                $nama = $_POST['nama'];
                                $hargabeli = $_POST['hargabeli'];
                                $hargajual = $_POST['hargajual'];
                                $stok = $_POST['stok'];
                                $satuan = $_POST['satuan'];
                            
                                if ($action == "tambah") {
                                    // SQL to insert data into item table
                                    $sql = "INSERT INTO item (kodeitem, nama, hargabeli, hargajual, stok, satuan)
                                            VALUES ('$kodeitem', '$nama', '$hargabeli', '$hargajual', '$stok', '$satuan')";
                                } else if ($action == "edit") {
                                    // SQL to update data in item table
                                    $sql = "UPDATE item SET nama='$nama', hargabeli='$hargabeli', hargajual='$hargajual', stok='$stok', satuan='$satuan'
                                            WHERE kodeitem='$kodeitem'";
                                }
                            
                                if ($conn->query($sql) === TRUE) {
                                    echo "<script>
                                            alert('Data berhasil " . ($action == "tambah" ? "ditambahkan" : "diperbarui") . "!');
                                            window.location.href = 'Item.php';
                                          </script>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }

                            // Fetch item data for editing
                            if (isset($_GET['kodeitem'])) {
                                $kodeitem = $_GET['kodeitem'];
                                $sql = "SELECT * FROM item WHERE kodeitem='$kodeitem'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $item = $result->fetch_assoc();
                                }
                            }

                            // Close connection
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
