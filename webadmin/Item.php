<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- CSS UNTUK TABEL -->

    <style>
        table {
            width: 66%;
            margin: auto;
            margin-left: 120px;
            position: absolute;
            margin-top: 120px;
            border-collapse: collapse;
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

        button {
            height: 50%;
            width: 50%;
        }

    </style>

    <!-- ================================================================================ -->

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<!-- Load library ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Form pencarian -->
<form class="example" action="item.php">
    <input type="text" placeholder="Cari.." name="search">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>

<!-- CSS -->
<style>
    * {
        box-sizing: border-box;
    }

    /* Gaya bidang pencarian */
    form.example input[type=text] {
        padding: 10px;
        font-size: 17px;
        border: 1px solid grey;
        float: left;
        width: 80%;
        background: #f1f1f1;
    }

    /* Gaya tombol submit */
    form.example button {
        float: left;
        width: 20%;
        padding: 10px;
        background: #2196F3;
        color: white;
        font-size: 17px;
        border: 1px solid grey;
        cursor: pointer;
    }

    form.example button:hover {
        background: #0b7dda;
    }

    /* Membersihkan float */
    form.example::after {
        content: "";
        clear: both;
        display: table;
    }
</style>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                UTAMA
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="Pelanggan.php" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>Pelanggan</span>
                </a>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="Pemasok.php" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <span>Pemasok</span>
                    </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="Item.php" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>Item</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" href="Rekening.php" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>Rekening</span>
                </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                BELI
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>hbeli</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>dbeli</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>dbayarbeli</span>
                </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                JUAL
            </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <span>hjual</span>
                    </a>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <span>djual</span>
                </a>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <span>dbayarjual</span>
                    </a>

        </ul>
        <!-- End of Sidebar -->

        <!-- add button -->

        <!-- ========================================================================================== -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h2>Item</h2>
                </div>
                <!-- /.container-fluid -->

    <!-- tampilin tabel dari tabel pelanggan -->

    <h2>Data Item</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_pweb";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Menjalankan query SQL untuk tabel item
    $sql_item = "SELECT * FROM item";
    $result_item = $conn->query($sql_item);
    
    if (!$result_item) {
        die("Error dalam query SQL: " . $conn->error);
    }
    
    // Menampilkan tabel item
    if ($result_item->num_rows > 0) {
        echo '<h2>Data Item</h2>';
        echo '<table>
                <thead>
                    <tr>';
        // Menampilkan header tabel berdasarkan nama kolom
        $fields_item = $result_item->fetch_fields();
        foreach ($fields_item as $field) {
            echo "<th>{$field->name}</th>";
        }
        echo "<th>Aksi</th></tr></thead><tbody>";
    
        // Menampilkan data baris demi baris
        while($row = $result_item->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td>$value</td>";
            }
            echo "<td class='actions'>
                    <a class='edit' href='?action=edit&kodeitem={$row['kodeitem']}'>Edit</a>
                    <a class='delete' href='?action=hapus&kodeitem={$row['kodeitem']}' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        echo '</tbody></table>';
    } else {
        echo "<p>Tidak ada data ditemukan</p>";
    }

    // Menutup koneksi
    $conn->close();
    ?>

    <!-- ============================================================================= -->

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
