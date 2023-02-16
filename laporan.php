<?php 
    require_once 'koneksi.php';

    $data_prospek = mysqli_query($koneksi, "SELECT * FROM prospek 
    INNER JOIN konsumen ON prospek.id_konsumen = konsumen.id_konsumen
    INNER JOIN status ON prospek.id_status = status.id_status
    INNER JOIN sumber ON prospek.id_sumber = sumber.id_sumber
    ORDER BY id_prospek DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan - Prospek Prabuana</title>

    <?php include_once 'include/head.php'; ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once 'include/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once 'include/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="align-items-center justify-content-between mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col head-left">
                                        <h6 class="mt-2 font-weight-bold text-primary">Laporan</h6>
                                    </div>
                                    <div class="col head-right">
                                        <a href="export_excel.php" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-file-excel fa-sm text-white-50"></i> Export ke Excel</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table border="1" cellpadding="10" cellspacing="0">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Konsumen</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>NIK</th>
                                            <th>NPWP</th>
                                            <th>WhatsApp</th>
                                            <th>Instagram</th>
                                            <th>Email</th>
                                            <th>Pekerjaan</th>
                                            <th>Gaji</th>
                                            <th>Tanggal Prospek Masuk</th>
                                            <th>Sumber</th>
                                            <th>Status</th>
                                            <?php 
                                                $max_fu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT MAX(followup_count)
                                                FROM (
                                                  SELECT COUNT(id_prospek) AS followup_count
                                                  FROM follow_up
                                                  GROUP BY id_prospek
                                                ) AS subquery;"));
                                             ?>
                                            <th colspan="<?= $max_fu['MAX(followup_count)']; ?>">Follow Up</th>
                                        </tr>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data_prospek as $data): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data['nama_konsumen']; ?></td>
                                                <td><?= $data['jenis_kelamin']; ?></td>
                                                <td><?= $data['alamat']; ?></td>
                                                <td><?= $data['nik']; ?></td>
                                                <td><?= $data['npwp']; ?></td>
                                                <td><?= $data['whatsapp']; ?></td>
                                                <td><?= $data['instagram']; ?></td>
                                                <td><?= $data['email']; ?></td>
                                                <td><?= $data['pekerjaan']; ?></td>
                                                <td><?= str_replace(",", ".", number_format($data['gaji'])); ?></td>
                                                <td><?= date("l, d-M-Y, H:i", strtotime($data['tanggal_prospek_masuk'])); ?></td>
                                                <td><?= $data['sumber']; ?></td>
                                                <td><?= $data['status']; ?></td>
                                                <?php 
                                                    $id_prospek = $data['id_prospek'];
                                                    $follow_up = mysqli_query($koneksi, "SELECT * FROM follow_up WHERE id_prospek = '$id_prospek'");
                                                 ?>
                                                 <?php foreach ($follow_up as $df): ?>
                                                    <td>
                                                        Tanggal: <?= date("l, d-M-Y, H:i", strtotime($df['tanggal_follow_up'])); ?><br>
                                                        Keterangan: <?= $df['keterangan_follow_up']; ?>
                                                    </td>
                                                 <?php endforeach ?>
                                            </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once 'include/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Tambah Sumber Modal -->
    <div class="modal fade" id="tambahSumberModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahSumberModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahSumberModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Sumber</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="sumber">Sumber<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="sumber" name="sumber" placeholder="Sumber" required value="<?= (isset($_POST['sumber']) ? ($_POST['sumber'] == '' ? '' : $_POST['sumber']) : ""); ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                <button type="submit" name="btnTambahSumber" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <?php include_once 'include/script.php'; ?>

</body>

</html>