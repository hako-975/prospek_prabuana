<?php 
    require_once 'koneksi.php';
    $sumber = mysqli_query($koneksi, "SELECT * FROM sumber ORDER BY sumber ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sumber - Prospek Prabuana</title>

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
                                        <h6 class="mt-2 font-weight-bold text-primary">Data Sumber</h6>
                                    </div>
                                    <div class="col head-right">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#tambahSumberModal"><i class="fas fa-fw fa-plus"></i> Tambah Sumber</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No.</th>
                                                <th>Sumber</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($sumber as $ds): ?>
                                                <tr>
                                                    <td class="align-middle"><?= $i++; ?></td>
                                                    <td class="align-middle"><?= $ds['sumber']; ?></td>
                                                    <td class="text-center align-middle">
                                                        <a class="btn btn-sm btn-warning text-white m-1" data-toggle="modal" data-target="#ubahSumberModal<?= $ds['id_sumber']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                        <div class="modal fade" id="ubahSumberModal<?= $ds['id_sumber']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahSumberModalLabel<?= $ds['id_sumber']; ?>" aria-hidden="true">
                                                          <div class="modal-dialog text-left">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_sumber" value="<?= $ds['id_sumber']; ?>">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h5 class="modal-title" id="ubahSumberModalLabel<?= $ds['id_sumber']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Sumber - <?= $ds['sumber']; ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="sumber">Sumber<sup class="text-danger">*</sup></label>
                                                                        <input type="text" class="form-control" id="sumber" name="sumber" placeholder="Sumber" required value="<?= (isset($_POST['sumber']) ? ($_POST['sumber'] == '' ? $ds['sumber'] : $_POST['sumber']) : $ds['sumber']); ?>">
                                                                    </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                                                                    <button type="submit" name="btnUbahSumber" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Ubah</button>
                                                                  </div>
                                                                </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                        <a data-nama="<?= $ds['sumber']; ?>" class="btn-delete btn btn-sm btn-danger text-white m-1" href="hapus_sumber.php?id_sumber=<?= $ds['id_sumber']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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

    <?php 
        if (isset($_POST['btnTambahSumber'])) {
            $sumber = htmlspecialchars($_POST['sumber']);

            $insert_sumber = mysqli_query($koneksi, "INSERT INTO sumber (sumber) VALUES ('$sumber')");

            if ($insert_sumber) {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Berhasil!',
                          text: 'Berhasil Tambah Sumber!',
                          icon: 'success'
                        }).then(function() {
                            window.location = 'sumber.php';
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
                          text: 'Gagal Tambah Sumber!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'sumber.php';
                        });
                    </script>
                ";
            }
        }

        if (isset($_POST['btnUbahSumber'])) {
            $id_sumber = htmlspecialchars($_POST['id_sumber']);
            $sumber = htmlspecialchars($_POST['sumber']);
            
            $update_sumber = mysqli_query($koneksi, "UPDATE sumber SET sumber = '$sumber' WHERE id_sumber = '$id_sumber'");

            if ($update_sumber) {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Berhasil!',
                          text: 'Berhasil Ubah Sumber!',
                          icon: 'success'
                        }).then(function() {
                            window.location = 'sumber.php';
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
                          text: 'Gagal Ubah Sumber!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'sumber.php';
                        });
                    </script>
                ";
            }
        }


    ?>

</body>

</html>