<?php 
    require_once 'koneksi.php';

    $prospek = mysqli_query($koneksi, "SELECT * FROM prospek 
        INNER JOIN konsumen ON prospek.id_konsumen = konsumen.id_konsumen
        INNER JOIN status ON prospek.id_status = status.id_status
        INNER JOIN sumber ON prospek.id_sumber = sumber.id_sumber
    ");
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Prospek - Prospek Prabuana</title>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include_once 'sidebar.php'; ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include_once 'navbar.php'; ?>
            <!-- Navbar End -->
            
            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col">
                        <div class="bg-light rounded h-100 p-4">
                            <h3 class="mb-4"><i class="fas fa-fw fa-bullseye"></i> Data Prospek</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered border-dark text-dark" id="dataTable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Konsumen</th>
                                            <th>FU ke</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Prospek</th>
                                            <th>Status</th>
                                            <th>Sumber</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($prospek as $data): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data['nama_konsumen']; ?></td>
                                                <td><?= $data['follow_up_ke']; ?></td>
                                                <td><?= $data['keterangan_prospek']; ?></td>
                                                <td><?= $data['tanggal_prospek']; ?></td>
                                                <td><?= $data['status']; ?></td>
                                                <td><?= $data['sumber']; ?></td>
                                                <td><?= $data['id_prospek']; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blank End -->
          
            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Prospek Prabuana</a>, All Right Reserved. 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <?php include_once 'footer.php'; ?>
</body>

</html>