<?php 
    require_once 'koneksi.php';

    $prospek = mysqli_query($koneksi, "SELECT * FROM prospek 
    INNER JOIN konsumen ON prospek.id_konsumen = konsumen.id_konsumen
    INNER JOIN status ON prospek.id_status = status.id_status
    INNER JOIN sumber ON prospek.id_sumber = sumber.id_sumber
    ORDER BY id_prospek DESC");

    $konsumen_not_in = mysqli_query($koneksi, "SELECT * FROM konsumen WHERE id_konsumen NOT IN (SELECT id_konsumen FROM prospek)");
    $konsumen_in = mysqli_query($koneksi, "SELECT * FROM konsumen WHERE id_konsumen IN (SELECT id_konsumen FROM prospek)");
    $status = mysqli_query($koneksi, "SELECT * FROM status");
    $sumber = mysqli_query($koneksi, "SELECT * FROM sumber");

    $follow_up = mysqli_query($koneksi, "SELECT * FROM follow_up INNER JOIN prospek ON prospek.id_prospek = follow_up.id_prospek GROUP BY prospek.id_prospek");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Prospek - Prospek Prabuana</title>

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
                                        <h6 class="mt-2 font-weight-bold text-primary">Data Prospek</h6>
                                    </div>
                                    <div class="col head-right">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#tambahProspekModal"><i class="fas fa-fw fa-plus"></i> Tambah Prospek</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No.</th>
                                                <th>Nama Konsumen</th>
                                                <th>Tanggal Prospek Masuk</th>
                                                <th>Sumber</th>
                                                <th>Follow Up</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($prospek as $dp): ?>
                                                <tr>
                                                    <td class="align-middle"><?= $i++; ?></td>
                                                    <td class="align-middle"><?= $dp['nama_konsumen']; ?></td>
                                                    <td class="align-middle"><?= date("l, d-M-Y, H:i", strtotime($dp['tanggal_prospek_masuk'])); ?></td>
                                                    <td class="align-middle"><?= $dp['sumber']; ?></td>
                                                    <td class="align-middle">
                                                        <?php 
                                                            $id_prospek = $dp['id_prospek'];
                                                            $jml_follow_up = mysqli_query($koneksi, "SELECT count(*) as jml_follow_up FROM follow_up WHERE id_prospek = '$id_prospek'");
                                                            $data_jml_follow_up = mysqli_fetch_assoc($jml_follow_up);
                                                            echo $data_jml_follow_up['jml_follow_up'];
                                                        ?>
                                                    </td>
                                                    <td class="align-middle"><?= $dp['status']; ?></td>
                                                    <td class="text-center align-middle">
                                                        <a class="btn btn-sm btn-success text-white m-1" href="follow_up.php?id_prospek=<?= $dp['id_prospek']; ?>"><i class="fas fa-fw fa-arrow-up"></i> Follow Up</a>
                                                        <a class="btn btn-sm btn-warning text-white m-1" data-toggle="modal" data-target="#ubahProspekModal<?= $dp['id_prospek']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                        <div class="modal fade" id="ubahProspekModal<?= $dp['id_prospek']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahProspekModalLabel<?= $dp['id_prospek']; ?>" aria-hidden="true">
                                                          <div class="modal-dialog text-left">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_prospek" value="<?= $dp['id_prospek']; ?>">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h5 class="modal-title" id="ubahProspekModalLabel<?= $dp['id_prospek']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Prospek - <?= $dp['nama_konsumen']; ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="id_konsumen">Nama Konsumen<sup class="text-danger">*</sup></label>
                                                                        <select name="id_konsumen" id="id_konsumen" class="custom-select" required>
                                                                            <option value="<?= $dp['id_konsumen']; ?>"><?= $dp['nama_konsumen']; ?></option>
                                                                            <?php foreach ($konsumen_not_in as $dk): ?>
                                                                                <option value="<?= $dk['id_konsumen']; ?>"><?= $dk['nama_konsumen']; ?></option>
                                                                            <?php endforeach ?>
                                                                            <?php foreach ($konsumen_in as $dk): ?>
                                                                                <option disabled value="<?= $dk['id_konsumen']; ?>"><?= $dk['nama_konsumen']; ?> (Sudah ada Prospek)</option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="id_status">Status<sup class="text-danger">*</sup></label>
                                                                        <select name="id_status" id="id_status" class="custom-select" required>
                                                                            <option value="<?= $dp['id_status']; ?>"><?= $dp['status']; ?></option>
                                                                            <?php foreach ($status as $ds): ?>
                                                                                <option value="<?= $ds['id_status']; ?>"><?= $ds['status']; ?></option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="id_sumber">Sumber<sup class="text-danger">*</sup></label>
                                                                        <select name="id_sumber" id="id_sumber" class="custom-select" required>
                                                                            <option value="<?= $dp['id_sumber']; ?>"><?= $dp['sumber']; ?></option>
                                                                            <?php foreach ($sumber as $ds): ?>
                                                                                <option value="<?= $ds['id_sumber']; ?>"><?= $ds['sumber']; ?></option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tanggal_prospek_masuk">Tanggal Prospek Masuk<sup class="text-danger">*</sup></label>
                                                                        <input type="datetime-local" class="form-control" id="tanggal_prospek_masuk" name="tanggal_prospek_masuk" placeholder="Tanggal Follow Up" required value="<?= (isset($_POST['tanggal_prospek_masuk']) ? ($_POST['tanggal_prospek_masuk'] == '' ? $dp['tanggal_prospek_masuk'] : $_POST['tanggal_prospek_masuk']) : $dp['tanggal_prospek_masuk']); ?>">
                                                                    </div>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                                                                    <button type="submit" name="btnUbahProspek" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Ubah</button>
                                                                  </div>
                                                                </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                        <a data-nama="<?= $dp['nama_konsumen']; ?>" class="btn-delete btn btn-sm btn-danger text-white m-1" href="hapus_prospek.php?id_prospek=<?= $dp['id_prospek']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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

    <!-- Tambah Prospek Modal -->
    <div class="modal fade" id="tambahProspekModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahProspekModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahProspekModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Prospek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="id_konsumen">Nama Konsumen<sup class="text-danger">*</sup></label>
                        <select name="id_konsumen" id="id_konsumen" class="custom-select" required>
                            <?php if (isset($_GET['id_konsumen'])): ?>
                                <?php 
                                    $id_konsumen = $_GET['id_konsumen'];
                                    $konsumen_row_id = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM konsumen WHERE id_konsumen = '$id_konsumen'"));
                                 ?>
                                <option value="<?= $konsumen_row_id['id_konsumen']; ?>"><?= $konsumen_row_id['nama_konsumen']; ?></option>
                                <?php foreach ($konsumen_not_in as $dk): ?>
                                    <?php if ($id_konsumen != $dk['id_konsumen']): ?>
                                        <option value="<?= $dk['id_konsumen']; ?>"><?= $dk['nama_konsumen']; ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php foreach ($konsumen_in as $dk): ?>
                                    <?php if ($id_konsumen != $dk['id_konsumen']): ?>
                                        <option disabled value="<?= $dk['id_konsumen']; ?>"><?= $dk['nama_konsumen']; ?> (Sudah ada Prospek)</option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php else: ?>
                                <?php foreach ($konsumen_not_in as $dk): ?>
                                    <option value="<?= $dk['id_konsumen']; ?>"><?= $dk['nama_konsumen']; ?></option>
                                <?php endforeach ?>
                                <?php foreach ($konsumen_in as $dk): ?>
                                    <option disabled value="<?= $dk['id_konsumen']; ?>"><?= $dk['nama_konsumen']; ?> (Sudah ada Prospek)</option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    <small><a href="konsumen.php?btn=tambahKonsumenModal">Tambah Konsumen?</a></small>
                </div>
                <div class="form-group">
                    <label for="id_status">Status<sup class="text-danger">*</sup></label>
                    <select name="id_status" id="id_status" class="custom-select" required>
                        <?php foreach ($status as $ds): ?>
                            <option value="<?= $ds['id_status']; ?>"><?= $ds['status']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_sumber">Sumber<sup class="text-danger">*</sup></label>
                    <select name="id_sumber" id="id_sumber" class="custom-select" required>
                        <?php foreach ($sumber as $ds): ?>
                            <option value="<?= $ds['id_sumber']; ?>"><?= $ds['sumber']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_prospek_masuk">Tanggal Prospek Masuk<sup class="text-danger">*</sup></label>
                    <input type="datetime-local" class="form-control" id="tanggal_prospek_masuk" name="tanggal_prospek_masuk" placeholder="Tanggal Follow Up" required value="<?= (isset($_POST['tanggal_prospek_masuk']) ? ($_POST['tanggal_prospek_masuk'] == '' ? date('Y-m-d\TH:i') : $_POST['tanggal_prospek_masuk']) : date('Y-m-d\TH:i')); ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                <button type="submit" name="btnTambahProspek" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
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
        if (isset($_GET['btn']) || isset($_GET['id_konsumen'])) {
            echo "
                <script>
                    $('#tambahProspekModal').modal('show');
                </script>
            ";
        }

        if (isset($_POST['btnTambahProspek'])) {
            $id_konsumen = htmlspecialchars($_POST['id_konsumen']);
            $id_status = htmlspecialchars($_POST['id_status']);
            $id_sumber = htmlspecialchars($_POST['id_sumber']);
            $tanggal_prospek_masuk = htmlspecialchars($_POST['tanggal_prospek_masuk']);

            $insert_prospek = mysqli_query($koneksi, "INSERT INTO prospek (id_konsumen, id_status, id_sumber, tanggal_prospek_masuk) VALUES ('$id_konsumen', '$id_status', '$id_sumber', '$tanggal_prospek_masuk')");

            if ($insert_prospek) {
                echo "
                    <script>
                        Swal.fire({
                          showDenyButton: true,
                          denyButtonText: 'Lanjut ke Follow Up?',
                          confirmButtonText: 'Tetap di Prospek',
                          title: 'Berhasil!',
                          text: 'Berhasil Tambah Prospek!',
                          icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed)
                            {
                                window.location = 'prospek.php';
                            }
                            else if (result.isDenied)
                            {
                                window.location = 'follow_up.php?id_prospek=".mysqli_insert_id($koneksi)."&btn=follow_up';
                            }
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
                          text: 'Gagal Tambah Prospek!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'prospek.php';
                        });
                    </script>
                ";
            }
        }

        if (isset($_POST['btnUbahProspek'])) {
            $id_prospek = htmlspecialchars($_POST['id_prospek']);
            $id_konsumen = htmlspecialchars($_POST['id_konsumen']);
            $id_status = htmlspecialchars($_POST['id_status']);
            $id_sumber = htmlspecialchars($_POST['id_sumber']);
            $tanggal_prospek_masuk = htmlspecialchars($_POST['tanggal_prospek_masuk']);


            $update_prospek = mysqli_query($koneksi, "UPDATE prospek SET id_prospek = '$id_prospek', id_konsumen = '$id_konsumen', id_status = '$id_status', id_sumber = '$id_sumber', tanggal_prospek_masuk = '$tanggal_prospek_masuk' WHERE id_prospek = '$id_prospek'");

            if ($update_prospek) {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Berhasil!',
                          text: 'Berhasil Ubah Prospek!',
                          icon: 'success'
                        }).then(function() {
                            window.location = 'prospek.php';
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
                          text: 'Gagal Ubah Prospek!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'prospek.php';
                        });
                    </script>
                ";
            }
        }


    ?>

</body>

</html>