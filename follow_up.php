<?php 
    require_once 'koneksi.php';

    $id_prospek = $_GET['id_prospek'];

    $data_prospek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM prospek 
    INNER JOIN konsumen ON prospek.id_konsumen = konsumen.id_konsumen
    INNER JOIN status ON prospek.id_status = status.id_status
    INNER JOIN sumber ON prospek.id_sumber = sumber.id_sumber
    WHERE id_prospek = '$id_prospek'"));

    $follow_up_ke = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM follow_up WHERE id_prospek = '$id_prospek'"));

    $status = mysqli_query($koneksi, "SELECT * FROM status");

    $follow_up = mysqli_query($koneksi, "SELECT * FROM follow_up INNER JOIN prospek ON follow_up.id_prospek = prospek.id_prospek INNER JOIN status ON prospek.id_status = status.id_status WHERE follow_up.id_prospek = '$id_prospek'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Follow Up Konsumen - <?= $data_prospek['nama_konsumen']; ?></title>

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
                    <a href="prospek.php" class="mb-3 btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>

                    <!-- Page Heading -->
                    <div class="align-items-center justify-content-between mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col head-left">
                                        <h6 class="mt-2 font-weight-bold text-primary">Follow Up Konsumen - <?= $data_prospek['nama_konsumen']; ?></h6>
                                    </div>
                                    <div class="col head-right">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#tambahFollowUpModal"><i class="fas fa-fw fa-plus"></i> Tambah Follow Up</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col head-left">
                                        <table cellpadding="5">
                                            <tr>
                                                <th class="align-middle">Status</th>
                                                <td class="align-middle"> : </td>
                                                <td class="align-middle"><?= $data_prospek['status']; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">Sumber</th>
                                                <td class="align-middle"> : </td>
                                                <td class="align-middle"><?= $data_prospek['sumber']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col head-right">
                                        <button data-toggle="modal" data-target="#kontakKonsumenModal" class="btn btn-sm btn-success"><i class="fas fa-fw fa-phone"></i> Hubungi</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg">
                                        <table class="table table-bordered" id="dataTable" cellspacing="0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Follow Up Ke</th>
                                                    <th>Tanggal Follow Up</th>
                                                    <th>Keterangan Follow Up</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($follow_up as $df): ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $i++; ?></td>
                                                        <td class="align-middle"><?= date("l, d-M-Y, H:i", strtotime($df['tanggal_follow_up'])); ?></td>
                                                        <td class="align-middle"><?= $df['keterangan_follow_up']; ?></td>
                                                        <td class="align-middle">
                                                            <a class="btn btn-sm btn-warning text-white m-1" data-toggle="modal" data-target="#ubahFollowUpModal<?= $df['id_follow_up']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                            <div class="modal fade" id="ubahFollowUpModal<?= $df['id_follow_up']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahFollowUpModalLabel<?= $df['id_follow_up']; ?>" aria-hidden="true">
                                                              <div class="modal-dialog">
                                                                <form method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id_follow_up" value="<?= $df['id_follow_up']; ?>">
                                                                    <div class="modal-content">
                                                                      <div class="modal-header">
                                                                        <h5 class="modal-title" id="ubahFollowUpModalLabel<?= $df['id_follow_up']; ?>"><i class="fas fa-fw fa-plus"></i> Ubah Follow Up ke-<?= $i-1; ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="nama_konsumen">Nama Konsumen</label>
                                                                            <input style="cursor: not-allowed;" class="form-control" disabled value="<?= $data_prospek['nama_konsumen']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="status">Tanggal Follow Up<sup class="text-danger">*</sup></label>
                                                                            <input type="datetime-local" class="form-control" id="tanggal_follow_up" name="tanggal_follow_up" placeholder="Tanggal Follow Up" required value="<?= (isset($_POST['tanggal_follow_up']) ? ($_POST['tanggal_follow_up'] == '' ? $df['tanggal_follow_up'] : $_POST['tanggal_follow_up']) : $df['tanggal_follow_up']); ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="keterangan_follow_up">Keterangan Follow Up<sup class="text-danger">*</sup></label>
                                                                            <textarea class="form-control" placeholder="Keterangan Follow Up" id="keterangan_follow_up" name="keterangan_follow_up" rows="3" required><?= (isset($_POST['keterangan_follow_up']) ? ($_POST['keterangan_follow_up'] == '' ? $df['keterangan_follow_up'] : $_POST['keterangan_follow_up']) : $df['keterangan_follow_up']); ?></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="id_status">Status<sup class="text-danger">*</sup></label>
                                                                            <select name="id_status" id="id_status" class="custom-select">
                                                                                <option value="<?= $data_prospek['id_status']; ?>"><?= $data_prospek['status']; ?></option>
                                                                                <?php foreach ($status as $ds): ?>
                                                                                    <?php if ($data_prospek['id_status'] != $ds['id_status']): ?>
                                                                                        <option value="<?= $ds['id_status']; ?>"><?= $ds['status']; ?></option>
                                                                                    <?php endif ?>
                                                                                <?php endforeach ?>
                                                                            </select>
                                                                        </div>
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                                                                        <button type="submit" name="btnUbahFollowUp" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                                                      </div>
                                                                    </div>
                                                                </form>
                                                              </div>
                                                            </div>
                                                            <a data-nama="Follow Up Konsumen <?= $data_prospek['nama_konsumen']; ?> Follow Up ke-<?= $i; ?>" class="btn-delete btn btn-sm btn-danger text-white m-1" href="hapus_follow_up.php?id_follow_up=<?= $df['id_follow_up']; ?>&id_prospek=<?= $df['id_prospek']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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

    <div class="modal fade" id="tambahFollowUpModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahFollowUpModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_prospek" value="<?= $data_prospek['id_prospek']; ?>">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahFollowUpModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Follow Up ke-<?= $follow_up_ke+1; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="nama_konsumen">Nama Konsumen</label>
                    <input style="cursor: not-allowed;" class="form-control" disabled value="<?= $data_prospek['nama_konsumen']; ?>">
                </div>
                <div class="form-group">
                    <label for="tanggal_follow_up">Tanggal Follow Up<sup class="text-danger">*</sup></label>
                    <input type="datetime-local" class="form-control" id="tanggal_follow_up" name="tanggal_follow_up" placeholder="Tanggal Follow Up" required value="<?= (isset($_POST['tanggal_follow_up']) ? ($_POST['tanggal_follow_up'] == '' ? date('Y-m-d\TH:i') : $_POST['tanggal_follow_up']) : date('Y-m-d\TH:i')); ?>">
                </div>
                <div class="form-group">
                    <label for="keterangan_follow_up">Keterangan Follow Up<sup class="text-danger">*</sup></label>
                    <textarea class="form-control" placeholder="Keterangan Follow Up" id="keterangan_follow_up" name="keterangan_follow_up" rows="3" required><?= (isset($_POST['keterangan_follow_up']) ? ($_POST['keterangan_follow_up'] == '' ? '' : $_POST['keterangan_follow_up']) : ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="id_status">Status<sup class="text-danger">*</sup></label>
                    <select name="id_status" id="id_status" class="custom-select">
                        <option value="<?= $data_prospek['id_status']; ?>"><?= $data_prospek['status']; ?></option>
                        <?php foreach ($status as $ds): ?>
                            <?php if ($data_prospek['id_status'] != $ds['id_status']): ?>
                                <option value="<?= $ds['id_status']; ?>"><?= $ds['status']; ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                <button type="submit" name="btnTambahFollowUp" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="kontakKonsumenModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="kontakKonsumenModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="kontakKonsumenModalLabel"><i class="fab fa-fw fa-whatsapp"></i> Kontak Konsumen - <?= $data_prospek['nama_konsumen']; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col">
                    <?php if ($data_prospek['whatsapp'] != ""): ?>
                        <a href="https://wa.me/<?= $data_prospek['whatsapp']; ?>" target="_blank" class="btn btn-success"><i class="fab fa-fw fa-whatsapp"></i> WhatsApp</a>
                    <?php endif ?>
                </div>
                <div class="col">
                    <?php if ($data_prospek['instagram'] != ""): ?>
                        <a href="https://instagram.com/<?= $data_prospek['instagram']; ?>" target="_blank" class="btn btn-danger"><i class="fab fa-fw fa-instagram"></i> Instagram</a>
                    <?php endif ?>
                </div>
                <div class="col">
                    <?php if ($data_prospek['email'] != ""): ?>
                        <a href="mailto:<?= $data_prospek['email']; ?>" target="_blank" class="btn btn-primary"><i class="fas fa-fw fa-envelope"></i> Email</a>
                    <?php endif ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <?php include_once 'include/script.php'; ?>

    <?php 
        if (isset($_GET['btn'])) {
            echo "
                <script>
                    $('#tambahFollowUpModal').modal('show');
                </script>
            ";
        }

        if (isset($_POST['btnTambahFollowUp'])) {
            $id_prospek = htmlspecialchars($_POST['id_prospek']);
            $tanggal_follow_up = htmlspecialchars($_POST['tanggal_follow_up']);
            $keterangan_follow_up = htmlspecialchars($_POST['keterangan_follow_up']);
            $id_status = htmlspecialchars($_POST['id_status']);

            $insert_follow_up = mysqli_query($koneksi, "INSERT INTO follow_up (tanggal_follow_up, keterangan_follow_up, id_prospek) VALUES ('$tanggal_follow_up', '$keterangan_follow_up', '$id_prospek')");

            // jika ganti status
            if ($data_prospek['id_status'] != $id_status) {
                $update_status = mysqli_query($koneksi, "UPDATE prospek SET id_status = '$id_status' WHERE id_prospek = '$id_prospek'");
            }

            if ($insert_follow_up) {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Berhasil!',
                          text: 'Berhasil Tambah Follow Up!',
                          icon: 'success'
                        }).then((result) => {
                            window.location = 'follow_up.php?id_prospek=".$id_prospek."';
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
                          text: 'Gagal Tambah Follow Up!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'follow_up.php?id_prospek=".$id_prospek."';
                        });
                    </script>
                ";
            }
        }

        if (isset($_POST['btnUbahFollowUp'])) {
            $id_follow_up = htmlspecialchars($_POST['id_follow_up']);
            $tanggal_follow_up = htmlspecialchars($_POST['tanggal_follow_up']);
            $keterangan_follow_up = htmlspecialchars($_POST['keterangan_follow_up']);
            $id_status = htmlspecialchars($_POST['id_status']);

            $update_follow_up = mysqli_query($koneksi, "UPDATE follow_up SET tanggal_follow_up = '$tanggal_follow_up', keterangan_follow_up = '$keterangan_follow_up' WHERE id_follow_up = '$id_follow_up'");

            // jika ganti status
            if ($data_prospek['id_status'] != $id_status) {
                $update_status = mysqli_query($koneksi, "UPDATE prospek SET id_status = '$id_status' WHERE id_prospek = '$id_prospek'");
            }

            if ($update_follow_up) {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Berhasil!',
                          text: 'Berhasil Ubah Follow Up!',
                          icon: 'success'
                        }).then((result) => {
                            window.location = 'follow_up.php?id_prospek=".$id_prospek."';
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
                          text: 'Gagal Ubah Follow Up!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'follow_up.php?id_prospek=".$id_prospek."';
                        });
                    </script>
                ";
            }
        }
    ?>

</body>

</html>