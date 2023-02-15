<?php 
    require_once 'koneksi.php';
    $konsumen = mysqli_query($koneksi, "SELECT * FROM konsumen ORDER BY nama_konsumen ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Konsumen - Prospek Prabuana</title>

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
                                        <h6 class="mt-2 font-weight-bold text-primary">Data Konsumen</h6>
                                    </div>
                                    <div class="col head-right">
                                        <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#tambahKonsumenModal"><i class="fas fa-fw fa-plus"></i> Tambah Konsumen</button>
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
                                                <th>Jenis Kelamin</th>
                                                <th>Pekerjaan</th>
                                                <th>WhatsApp</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($konsumen as $dk): ?>
                                                <tr>
                                                    <td class="align-middle"><?= $i++; ?></td>
                                                    <td class="align-middle"><?= $dk['nama_konsumen']; ?></td>
                                                    <td class="align-middle"><?= ucwords($dk['jenis_kelamin']); ?></td>
                                                    <td class="align-middle"><?= ucwords($dk['pekerjaan']); ?></td>
                                                    <td class="text-success align-middle"><i class="fab fa-fw fa-whatsapp"></i> <a href="https://wa.me/<?= $dk['whatsapp']; ?>" target="_blank"><?= $dk['whatsapp']; ?></a></td>
                                                    <td class="text-center align-middle">
                                                        <a class="btn btn-sm btn-primary text-white m-1" href="detail_konsumen.php?id_konsumen=<?= $dk['id_konsumen']; ?>"><i class="fas fa-fw fa-bars"></i> Detail</a>
                                                        <a class="btn btn-sm btn-warning text-white m-1" data-toggle="modal" data-target="#ubahKonsumenModal<?= $dk['id_konsumen']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                        <div class="modal fade" id="ubahKonsumenModal<?= $dk['id_konsumen']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahKonsumenModalLabel<?= $dk['id_konsumen']; ?>" aria-hidden="true">
                                                          <div class="modal-dialog text-left">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_konsumen" value="<?= $dk['id_konsumen']; ?>">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h5 class="modal-title" id="ubahKonsumenModalLabel<?= $dk['id_konsumen']; ?>"><i class="fas fa-fw fa-edit"></i> Ubah Konsumen - <?= $dk['nama_konsumen']; ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="nama_konsumen">Nama Konsumen<sup class="text-danger">*</sup></label>
                                                                        <input type="text" class="form-control" id="nama_konsumen" name="nama_konsumen" placeholder="Nama Konsumen" required value="<?= (isset($_POST['nama_konsumen']) ? ($_POST['nama_konsumen'] == '' ? $dk['nama_konsumen'] : $_POST['nama_konsumen']) : $dk['nama_konsumen']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_kelamin">Jenis Kelamin Konsumen<sup class="text-danger">*</sup></label>
                                                                        <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
                                                                            <?php if ($dk['jenis_kelamin'] == 'pria'): ?>
                                                                                <option value="pria" selected>Pria</option>
                                                                                <option value="wanita">Wanita</option>
                                                                            <?php elseif ($dk['jenis_kelamin'] == 'wanita'): ?>
                                                                                <option value="pria">Pria</option>
                                                                                <option value="wanita" selected>Wanita</option>
                                                                            <?php else: ?>
                                                                                <option value="pria" selected>Pria</option>
                                                                                <option value="wanita">Wanita</option>
                                                                            <?php endif ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="whatsapp">WhatsApp Konsumen<sup class="text-danger">*</sup></label>
                                                                        <input type="number" class="form-control" id="whatsapp" name="whatsapp" placeholder="Contoh: 628123456789" required value="<?= (isset($_POST['whatsapp']) ? ($_POST['whatsapp'] == '' ? $dk['whatsapp'] : $_POST['whatsapp']) : $dk['whatsapp']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pekerjaan">Pekerjaan Konsumen<sup class="text-danger">*</sup></label>
                                                                        <select class="custom-select" id="pekerjaan" name="pekerjaan">
                                                                            <?php if ((isset($_POST['pekerjaan'])) ? ($_POST['pekerjaan'] == 'pegawai / karyawan'): ""): ?>
                                                                                <option value="pegawai / karyawan" selected><?= ucwords('pegawai / karyawan'); ?></option> 
                                                                                <option value="profesional"><?= ucwords('profesional'); ?></option>
                                                                                <option value="wiraswasta / swasta / pemilik"><?= ucwords('wiraswasta / swasta / pemilik'); ?></option>
                                                                            <?php elseif ((isset($_POST['pekerjaan'])) ? ($_POST['pekerjaan'] == 'profesional'): ""): ?>
                                                                                <option value="pegawai / karyawan"><?= ucwords('pegawai / karyawan'); ?></option> 
                                                                                <option value="profesional" selected><?= ucwords('profesional'); ?></option>
                                                                                <option value="wiraswasta / swasta / pemilik"><?= ucwords('wiraswasta / swasta / pemilik'); ?></option>
                                                                            <?php elseif ((isset($_POST['pekerjaan'])) ? ($_POST['pekerjaan'] == 'wiraswasta / swasta / pemilik'): ""): ?>
                                                                                <option value="pegawai / karyawan"><?= ucwords('pegawai / karyawan'); ?></option> 
                                                                                <option value="profesional"><?= ucwords('profesional'); ?></option>
                                                                                <option value="wiraswasta / swasta / pemilik" selected><?= ucwords('wiraswasta / swasta / pemilik'); ?></option>
                                                                            <?php else: ?>
                                                                                <option value="pegawai / karyawan" selected><?= ucwords('pegawai / karyawan'); ?></option> 
                                                                                <option value="profesional"><?= ucwords('profesional'); ?></option>
                                                                                <option value="wiraswasta / swasta / pemilik"><?= ucwords('wiraswasta / swasta / pemilik'); ?></option>
                                                                            <?php endif ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="gaji">Gaji Konsumen</label>
                                                                        <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Gaji Konsumen" value="<?= (isset($_POST['gaji']) ? ($_POST['gaji'] == '' ? $dk['gaji'] : $_POST['gaji']) : $dk['gaji']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat">Alamat Konsumen</label>
                                                                        <textarea class="form-control" placeholder="Alamat Konsumen" id="alamat" name="alamat" rows="3"><?= (isset($_POST['alamat']) ? ($_POST['alamat'] == '' ? $dk['alamat'] : $_POST['alamat']) : $dk['alamat']); ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nik">NIK Konsumen</label>
                                                                        <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK Konsumen" value="<?= (isset($_POST['nik']) ? ($_POST['nik'] == '' ? $dk['nik'] : $_POST['nik']) : $dk['nik']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="npwp">NPWP Konsumen</label>
                                                                        <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP Konsumen" value="<?= (isset($_POST['npwp']) ? ($_POST['npwp'] == '' ? $dk['npwp'] : $_POST['npwp']) : $dk['npwp']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="instagram">Instagram Konsumen</label>
                                                                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram Konsumen" value="<?= (isset($_POST['instagram']) ? ($_POST['instagram'] == '' ? $dk['instagram'] : $_POST['instagram']) : $dk['instagram']); ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">Email Konsumen</label>
                                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Konsumen" value="<?= (isset($_POST['email']) ? ($_POST['email'] == '' ? $dk['email'] : $_POST['email']) : $dk['email']); ?>">
                                                                    </div>
                                                                    <label for="upload_ktp">Upload KTP Konsumen</label>
                                                                    <?php if ($dk['upload_ktp'] != ''): ?>
                                                                         <span class="badge bg-success text-white">Sudah Upload</span>
                                                                         <input type="hidden" name="upload_ktp_old" value="<?= $dk['upload_ktp']; ?>">
                                                                         <a href="data/ktp/<?= $dk['upload_ktp']; ?>"><?= $dk['upload_ktp']; ?></a>
                                                                        <br>
                                                                        <div class="input-group mb-3">
                                                                          <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="upload_ktp" name="upload_ktp" aria-describedby="inputGroupFileAddon01" value="<?= $dk['upload_ktp'] ?>">
                                                                            <label class="custom-file-label" for="upload_ktp">Pilih File</label>
                                                                          </div>
                                                                        </div>
                                                                        <small>Upload file lagi jika ingin mengubah data</small>
                                                                    <?php else: ?>
                                                                        <div class="input-group mb-3">
                                                                          <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" id="upload_ktp" name="upload_ktp" aria-describedby="inputGroupFileAddon01">
                                                                            <label class="custom-file-label" for="upload_ktp">Pilih File</label>
                                                                          </div>
                                                                        </div>
                                                                    <?php endif ?>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                                                                    <button type="submit" name="btnUbahKonsumen" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Ubah</button>
                                                                  </div>
                                                                </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                        <a data-nama="<?= $dk['nama_konsumen']; ?>" class="btn-delete btn btn-sm btn-danger text-white m-1" href="hapus_konsumen.php?id_konsumen=<?= $dk['id_konsumen']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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

    <!-- Tambah Konsumen Modal -->
    <div class="modal fade" id="tambahKonsumenModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahKonsumenModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahKonsumenModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Konsumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="nama_konsumen">Nama Konsumen<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" id="nama_konsumen" name="nama_konsumen" placeholder="Nama Konsumen" required value="<?= (isset($_POST['nama_konsumen']) ? ($_POST['nama_konsumen'] == '' ? '' : $_POST['nama_konsumen']) : ""); ?>">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin Konsumen<sup class="text-danger">*</sup></label>
                    <select class="custom-select" id="jenis_kelamin" name="jenis_kelamin">
                        <?php if ((isset($_POST['jenis_kelamin'])) ? ($_POST['jenis_kelamin'] == 'pria'): ""): ?>
                            <option value="pria" selected>Pria</option>
                            <option value="wanita">Wanita</option>
                        <?php elseif ((isset($_POST['jenis_kelamin'])) ? ($_POST['jenis_kelamin'] == 'wanita'): ""): ?>

                            <option value="pria">Pria</option>
                            <option value="wanita" selected>Wanita</option>
                        <?php else: ?>
                            <option value="pria" selected>Pria</option>
                            <option value="wanita">Wanita</option>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="whatsapp">WhatsApp Konsumen<sup class="text-danger">*</sup></label>
                    <input type="number" class="form-control" id="whatsapp" name="whatsapp" placeholder="Contoh: 628123456789" required value="<?= (isset($_POST['whatsapp']) ? ($_POST['whatsapp'] == '' ? '' : $_POST['whatsapp']) : ""); ?>">
                </div>
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan Konsumen<sup class="text-danger">*</sup></label>
                    <select class="custom-select" id="pekerjaan" name="pekerjaan">
                        <?php if ((isset($_POST['pekerjaan'])) ? ($_POST['pekerjaan'] == 'pegawai / karyawan'): ""): ?>
                            <option value="pegawai / karyawan" selected><?= ucwords('pegawai / karyawan'); ?></option> 
                            <option value="profesional"><?= ucwords('profesional'); ?></option>
                            <option value="wiraswasta / swasta / pemilik"><?= ucwords('wiraswasta / swasta / pemilik'); ?></option>
                        <?php elseif ((isset($_POST['pekerjaan'])) ? ($_POST['pekerjaan'] == 'profesional'): ""): ?>
                            <option value="pegawai / karyawan"><?= ucwords('pegawai / karyawan'); ?></option> 
                            <option value="profesional" selected><?= ucwords('profesional'); ?></option>
                            <option value="wiraswasta / swasta / pemilik"><?= ucwords('wiraswasta / swasta / pemilik'); ?></option>
                        <?php elseif ((isset($_POST['pekerjaan'])) ? ($_POST['pekerjaan'] == 'wiraswasta / swasta / pemilik'): ""): ?>
                            <option value="pegawai / karyawan"><?= ucwords('pegawai / karyawan'); ?></option> 
                            <option value="profesional"><?= ucwords('profesional'); ?></option>
                            <option value="wiraswasta / swasta / pemilik" selected><?= ucwords('wiraswasta / swasta / pemilik'); ?></option>
                        <?php else: ?>
                            <option value="pegawai / karyawan" selected><?= ucwords('pegawai / karyawan'); ?></option> 
                            <option value="profesional"><?= ucwords('profesional'); ?></option>
                            <option value="wiraswasta / swasta / pemilik"><?= ucwords('wiraswasta / swasta / pemilik'); ?></option>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gaji">Gaji Konsumen</label>
                    <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Gaji Konsumen" value="<?= (isset($_POST['gaji']) ? ($_POST['gaji'] == '' ? '' : $_POST['gaji']) : ""); ?>">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat Konsumen</label>
                    <textarea class="form-control" placeholder="Alamat Konsumen" id="alamat" name="alamat" rows="3"><?= (isset($_POST['alamat']) ? ($_POST['alamat'] == '' ? '' : $_POST['alamat']) : ""); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="nik">NIK Konsumen</label>
                    <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK Konsumen" value="<?= (isset($_POST['nik']) ? ($_POST['nik'] == '' ? '' : $_POST['nik']) : ""); ?>">
                </div>
                <div class="form-group">
                    <label for="npwp">NPWP Konsumen</label>
                    <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP Konsumen" value="<?= (isset($_POST['npwp']) ? ($_POST['npwp'] == '' ? '' : $_POST['npwp']) : ""); ?>">
                </div>
                <div class="form-group">
                    <label for="instagram">Instagram Konsumen</label>
                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram Konsumen" value="<?= (isset($_POST['instagram']) ? ($_POST['instagram'] == '' ? '' : $_POST['instagram']) : ""); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email Konsumen</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Konsumen" value="<?= (isset($_POST['email']) ? ($_POST['email'] == '' ? '' : $_POST['email']) : ""); ?>">
                </div>
                <label for="upload_ktp">Upload KTP Konsumen</label>
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="upload_ktp" name="upload_ktp" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="upload_ktp">Pilih File</label>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                <button type="submit" name="btnTambahKonsumen" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
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
        if (isset($_GET['btn'])) {
            if ($_GET['btn'] == 'tambahKonsumenModal') {
                echo "
                    <script>
                        $('#tambahKonsumenModal').modal('show');
                    </script>
                ";
            }
        }

        if (isset($_POST['btnTambahKonsumen'])) {
            $nama_konsumen = htmlspecialchars($_POST['nama_konsumen']);
            $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
            $whatsapp = htmlspecialchars($_POST['whatsapp']);
            $pekerjaan = htmlspecialchars($_POST['pekerjaan']);
            $gaji = htmlspecialchars($_POST['gaji']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $nik = htmlspecialchars($_POST['nik']);
            $npwp = htmlspecialchars($_POST['npwp']);
            $instagram = htmlspecialchars($_POST['instagram']);
            $email = htmlspecialchars($_POST['email']);

            $upload_ktp = $_FILES['upload_ktp']['name'];
            if ($upload_ktp != '') {
                $acc_extension = array('png','jpg', 'jpeg', 'gif', 'pdf');
                $extension = explode('.', $upload_ktp);
                $extension_lower = strtolower(end($extension));
                $size = $_FILES['upload_ktp']['size'];
                $file_tmp = $_FILES['upload_ktp']['tmp_name'];   
                
                if(!in_array($extension_lower, $acc_extension))
                {
                    echo "
                        <script>
                            Swal.fire({
                              title: 'Gagal!',
                              text: 'Ekstensi yang Anda masukkan tidak sesuai!',
                              icon: 'error'
                            }).then(function() {
                                $('#tambahKonsumenModal').modal('show');
                            });
                        </script>
                    ";
                    return;
                }

                $upload_ktp = uniqid() . $upload_ktp;
                move_uploaded_file($file_tmp, 'data/ktp/'. $upload_ktp);
            }


            $insert_konsumen = mysqli_query($koneksi, "INSERT INTO konsumen (nama_konsumen, jenis_kelamin, whatsapp, pekerjaan, gaji, alamat, nik, npwp, instagram, email, upload_ktp) VALUES ('$nama_konsumen', '$jenis_kelamin', '$whatsapp', '$pekerjaan', '$gaji', '$alamat', '$nik', '$npwp', '$instagram', '$email', '$upload_ktp')");

            if ($insert_konsumen) {
                echo "
                    <script>
                        $('#tambahKonsumenModal').modal('hide');
                        
                        Swal.fire({
                          showDenyButton: true,
                          denyButtonText: 'Lanjut ke Prospek?',
                          confirmButtonText: 'Tetap di Konsumen',
                          title: 'Berhasil!',
                          text: 'Berhasil Tambah Konsumen!',
                          icon: 'success'
                        }).then((result) => {
                            if (result.isConfirmed)
                            {
                                window.location = 'konsumen.php';
                            }
                            else if (result.isDenied)
                            {
                                window.location = 'prospek.php?id_konsumen=".mysqli_insert_id($koneksi)."';
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
                          text: 'Gagal Tambah Konsumen!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'konsumen.php';
                        });
                    </script>
                ";
            }
        }

        if (isset($_POST['btnUbahKonsumen'])) {
            $id_konsumen = htmlspecialchars($_POST['id_konsumen']);
            $nama_konsumen = htmlspecialchars($_POST['nama_konsumen']);
            $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
            $whatsapp = htmlspecialchars($_POST['whatsapp']);
            $pekerjaan = htmlspecialchars($_POST['pekerjaan']);
            $gaji = htmlspecialchars($_POST['gaji']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $nik = htmlspecialchars($_POST['nik']);
            $npwp = htmlspecialchars($_POST['npwp']);
            $instagram = htmlspecialchars($_POST['instagram']);
            $email = htmlspecialchars($_POST['email']);

            $upload_ktp = $_POST['upload_ktp_old'];

            $upload_ktp_new = $_FILES['upload_ktp']['name'];
            if ($upload_ktp_new != '') {
                $acc_extension = array('png','jpg', 'jpeg', 'gif', 'pdf');
                $extension = explode('.', $upload_ktp_new);
                $extension_lower = strtolower(end($extension));
                $size = $_FILES['upload_ktp']['size'];
                $file_tmp = $_FILES['upload_ktp']['tmp_name'];   
                if(!in_array($extension_lower, $acc_extension))
                {
                    echo "
                        <script>
                            Swal.fire({
                              title: 'Gagal!',
                              text: 'Ekstensi yang Anda masukkan tidak sesuai!',
                              icon: 'error'
                            }).then(function() {
                                $('#tambahKonsumenModal').modal('show');
                            });
                        </script>
                    ";
                    return;
                }

                $upload_ktp = uniqid() . $upload_ktp_new;
                move_uploaded_file($file_tmp, 'data/ktp/'. $upload_ktp);
            }

            $update_konsumen = mysqli_query($koneksi, "UPDATE konsumen SET nama_konsumen = '$nama_konsumen', jenis_kelamin = '$jenis_kelamin', whatsapp = '$whatsapp', pekerjaan = '$pekerjaan', gaji = '$gaji', alamat = '$alamat', nik = '$nik', npwp = '$npwp', instagram = '$instagram', email = '$email', upload_ktp = '$upload_ktp' WHERE id_konsumen = '$id_konsumen'");

            if ($update_konsumen) {
                echo "
                    <script>
                        Swal.fire({
                          title: 'Berhasil!',
                          text: 'Berhasil Ubah Konsumen!',
                          icon: 'success'
                        }).then(function() {
                            window.location = 'konsumen.php';
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
                          text: 'Gagal Ubah Konsumen!',
                          icon: 'error'
                        }).then(function() {
                            window.location = 'konsumen.php';
                        });
                    </script>
                ";
            }
        }


    ?>

</body>

</html>