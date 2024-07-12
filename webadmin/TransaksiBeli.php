<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .pasang-konten {
            border: 5px;
            padding: 20px;
            height: 400px;
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
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
        .table-container {
            width: 200px;
            margin: 0;
        }
        .content-container {
            display: flex;
            justify-content: space-between;
            background-color: blue;
            padding: 10px;
        }
        .left-container {
            width: 48%;
            background-color: lightblue;
            margin-right: 10px;
            padding: 10px;
        }
        .right-container {
            width: 48%;
            background-color: lightblue;
            margin-left: 10px;
            padding: 10px;
        }
        table {
            width: 100%;
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
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h2>TRANSAKSI BELI</h2>
                </nav>
                <div class="pasang-konten">
                    <h4>CHECKOUT</h4>
                    <div class="container">
                        <div class="content-container">
                            <div class="left-container" id="TABELITEM">
                                <table id="itemTable">
                                    <thead>
                                        <tr>
                                            <th>Kode Item</th>
                                            <th>Nama</th>
                                            <th>Qty</th>
                                            <th>Harga Jual</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Total</td>
                                            <td id="totalValue">0</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <form action="generatepdf-beli.php" method="POST">
                                    <input type="hidden" name="tableData" id="tableDataInput">
                                    <button class="btn btn-success" style="background-color: #4e73df; margin-left: 480px;" type="submit">Generate PDF</button>
                                </form>
                            </div>
                            <div class="right-container">
                                <div class="container mt-5">
                                    <div class="form-container">
                                        <h2>Tambahkan Item</h2>
                                        <form id="searchForm">
                                            <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
                                            <button class="btn btn-primary mt-2" type="submit">Search</button>
                                        </form>
                                        <div id="searchResult" style="color: red;"></div>
                                        <form id="itemForm" class="mt-3" onsubmit="addItem(event)">
                                            <div class="form-group">
                                                <label for="kodeitem">Kode Item</label>
                                                <input type="text" id="kodeitem" name="kodeitem" class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" id="nama" name="nama" class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="qty">Qty</label>
                                                <input type="number" id="qty" name="qty" class="form-control" min="1" value="1">
                                            </div>
                                            <div class="form-group">
                                                <label for="hargajual">Harga Jual</label>
                                                <input type="text" id="hargajual" name="hargajual" class="form-control" readonly>
                                            </div>
                                            <div class="button-container">
                                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script>
        let tableData = [];

        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();
                var search = $('#search').val();
                $.ajax({
                    url: 'search_item.php',
                    type: 'POST',
                    data: { search: search },
                    success: function(data) {
                        if (data) {
                            var item = JSON.parse(data);
                            $('#kodeitem').val(item.kodeitem);
                            $('#nama').val(item.nama);
                            $('#hargajual').val(item.hargajual);
                            $('#searchResult').text('');
                        } else {
                            $('#searchResult').text('Item not found');
                            $('#kodeitem').val('');
                            $('#nama').val('');
                            $('#hargajual').val('');
                        }
                    }
                });
            });
        });

        function addItem(event) {
            event.preventDefault();
            let kodeitem = document.getElementById('kodeitem').value;
            let nama = document.getElementById('nama').value;
            let qty = document.getElementById('qty').value;
            let hargajual = document.getElementById('hargajual').value;

            if (kodeitem && nama && qty >= 1 && hargajual) {
                let newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${kodeitem}</td>
                    <td>${nama}</td>
                    <td>${qty}</td>
                    <td>${hargajual}</td>
                    <td><button onclick="deleteRow(this)" class="btn btn-danger">Hapus</button></td>
                `;
                document.querySelector('#itemTable tbody').appendChild(newRow);

                tableData.push({ kodeitem, nama, qty, hargajual });
                updateTotal();
                updateTableDataInput();
            } else {
                alert("Please fill all fields and ensure quantity is at least 1");
            }
        }

        function deleteRow(button) {
            let row = button.closest('tr');
            let index = Array.from(row.parentNode.children).indexOf(row);
            row.remove();

            tableData.splice(index, 1);
            updateTotal();
            updateTableDataInput();
        }

        function updateTotal() {
            let total = 0;
            tableData.forEach(item => {
                total += parseFloat(item.qty) * parseFloat(item.hargajual);
            });
            document.getElementById('totalValue').innerText = total.toFixed(2);
        }

        function updateTableDataInput() {
            document.getElementById('tableDataInput').value = JSON.stringify(tableData);
        }
    </script>
</body>
</html>
