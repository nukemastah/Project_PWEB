<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* General layout styles */
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 200px;
            background-color: lightblue;
        }

        .header {
            height: 50px;
            width: calc(100% - 200px);
            background-color: pink;
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .content {
            display: flex;
            width: calc(100% - 200px);
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
        }

        .table-container,
        .form-container {
            background-color: #b0b05f;
            padding: 10px;
            margin: 10px;
        }

        .table-container {
            flex: 2;
        }

        .form-container {
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        th,
        td {
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

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container form input,
        .form-container form button {
            margin: 5px 0;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Add your sidebar content here -->
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h2>PELANGGAN</h2>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Form container (Right box) -->
            <div class="form-container">
                <form method="POST" action="">
                    <input type="text" name="search" placeholder="Search by name">
                    <button type="submit">Search</button>
                    <a href="addpelanggan.php"><button type="button">ADD</button></a>
                </form>
            </div>

            <!-- Table container (Left box) -->
            <div class="table-container">
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
    <!-- End of Main content -->

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
