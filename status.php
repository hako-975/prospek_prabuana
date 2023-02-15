<?php 
    require_once 'koneksi.php';
    $status = mysqli_query($koneksi, "SELECT * FROM status ORDER BY id_status ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Status - Prospek Prabuana</title>

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
                                        <h6 class="mt-2 font-weight-bold text-primary">Data Status</h6>
                                    </div>
                                    <div class="col head-right">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#tambahStatusModal"><i class="fas fa-fw fa-plus"></i> Tambah Status</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No.</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($status as $ds): ?>
                                                <tr>
                                                    <td class="align-middle"><?= $i++; ?></td>
                                                    <td class="align-middle"><?= $ds['status']; ?></td>
                                                    <td class="text-center align-middle">
                                                        <a class="btn btn-sm btn-warning text-white m-1" data-toggle="modal" data-target="#ubahStatusModal<?= $ds['id_status']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                        <div class="modal fade" id="ubahStatusModal<?= $ds['id_status']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahStatusModalLabel<?= $ds['id_status']; ?>" aria-hidden="true">
                                                          <div class="modal-dialog text-left">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_status" value="<?= $ds['id_status']; ?>">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h5 class="modal-title" id="ubahStatusModalLabel<?= $ds['id_status']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Status - <?= $ds['status']; ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="status">Status<sup class="text-danger">*</sup></label>
                                                                        <input type="text" class="form-control" id="status" name="status" placeholder="Status" required value="<?= (isset($_POST['status']) ? ($_POST['status'] == '' ? $ds['status'] : $_POST['status']) : $ds['status']); ?>">
                                                                    </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                                                                    <button type="submit" name="btnUbahStatus" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Ubah</button>
                                                                  </div>
                                                                </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                        <a data-nama="<?= $ds['status']; ?>" class="btn-delete btn btn-sm btn-danger text-white m-1" href="hapus_status.php?id_status=<?= $ds['id_status']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
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

    <!-- Tambah Status Modal -->
    <div class="modal fade" id="tambahStatusModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahStatusModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahStatusModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="status">Status<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="status" name="status" placeholder="Status" required value="<?= (isset($_POST['status']) ? ($_POST['status'] == '' ? '' : $_POST['status']) : ""); ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                <button type="submit" name="btnTambahStatus" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
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

    <?php 
        if (isset($_POST['btnTambahStatus'])) {
            $status = htmlspecialchars($_POST['status']);

            $insert_status = mysqli_query($koneksi, "INSERT INTO status (status) VALUES ('$status')");

            if ($insert_status) {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Berhasil!',
                          text: 'Berhasil Tambah Status!',
                          icon: 'success'
                        }).then(function() {
                            window.location = 'status.php';
                        });
                    </script>
                ";
            }
            else
            {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Gagal!',
                          text: 'Gagal Tambah Status!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'status.php';
                        });
                    </script>
                ";
            }
        }

        if (isset($_POST['btnUbahStatus'])) {
            $id_status = htmlspecialchars($_POST['id_status']);
            $status = htmlspecialchars($_POST['status']);
            
            $update_status = mysqli_query($koneksi, "UPDATE status SET status = '$status' WHERE id_status = '$id_status'");

            if ($update_status) {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Berhasil!',
                          text: 'Berhasil Ubah Status!',
                          icon: 'success'
                        }).then(function() {
                            window.location = 'status.php';
                        });
                    </script>
                ";
            }
            else
            {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Gagal!',
                          text: 'Gagal Ubah Status!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'status.php';
                        });
                    </script>
                ";
            }
        }


    ?>

</body>

</html>