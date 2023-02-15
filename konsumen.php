<?php 
    require_once 'koneksi.php';

    $konsumen = mysqli_query($koneksi, "SELECT * FROM konsumen ORDER BY nama_konsumen ASC");
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Data Konsumen - Prospek Prabuana</title>
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
            <?php require_once 'navbar.php'; ?>
            <!-- Navbar End -->
            
            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="row">
                                <div class="col-md-6 head-left">
                                    <h3 class="mb-4"><i class="fas fa-fw fa-users"></i> Data Konsumen</h3>
                                </div>
                                <div class="col-md-6 head-right">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#tambahKonsumenModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Konsumen</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered border-dark text-dark bg-white align-middle" id="dataTable">
                                    <thead class="table-dark vertical">
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Konsumen</th>
                                            <th>Jenis Kelamin</th>
                                            <th>WhatsApp</th>
                                            <th>Pekerjaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($konsumen as $data): ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data['nama_konsumen']; ?></td>
                                                <td><?= $data['jenis_kelamin']; ?></td>
                                                <td><?= $data['whatsapp']; ?></td>
                                                <td><?= $data['pekerjaan']; ?></td>
                                                <td><?= $data['id_konsumen']; ?></td>
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
            
            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahKonsumenModal" tabindex="-1" aria-labelledby="tambahKonsumenModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahKonsumenModalLabel"><i class="fas fa-fw fa-plus"></i> Tambah Konsumen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="bg-light rounded h-100 p-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nama_konsumen" name="nama_konsumen" placeholder="Nama Konsumen" required value="<?= (isset($_POST['nama_konsumen']) ? ($_POST['nama_konsumen'] == '' ? '' : $_POST['nama_konsumen']) : ""); ?>">
                                <label for="nama_konsumen">Nama Konsumen <sup class="text-danger">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
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
                                <label for="jenis_kelamin">Jenis Kelamin Konsumen <sup class="text-danger">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp Konsumen" required value="<?= (isset($_POST['whatsapp']) ? ($_POST['whatsapp'] == '' ? '' : $_POST['whatsapp']) : ""); ?>">
                                <label for="whatsapp">WhatsApp Konsumen <sup class="text-danger">*</sup></label>
                                <small>Isi dengan 62 tanpa '+'</small>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="pekerjaan" name="pekerjaan">
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
                                <label for="pekerjaan">Pekerjaan Konsumen <sup class="text-danger">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Gaji" value="<?= (isset($_POST['gaji']) ? ($_POST['gaji'] == '' ? '' : $_POST['gaji']) : ""); ?>">
                                <label for="gaji">Gaji Konsumen</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" style="height: 150px;"><?= (isset($_POST['alamat']) ? ($_POST['alamat'] == '' ? '' : $_POST['alamat']) : ""); ?></textarea>
                                <label for="alamat">Alamat Konsumen</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="nik" name="nik" placeholder="NIK" value="<?= (isset($_POST['nik']) ? ($_POST['nik'] == '' ? '' : $_POST['nik']) : ""); ?>">
                                <label for="nik">NIK Konsumen</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP" value="<?= (isset($_POST['npwp']) ? ($_POST['npwp'] == '' ? '' : $_POST['npwp']) : ""); ?>">
                                <label for="npwp">NPWP Konsumen</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="<?= (isset($_POST['instagram']) ? ($_POST['instagram'] == '' ? '' : $_POST['instagram']) : ""); ?>">
                                <label for="instagram">Instagram Konsumen</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= (isset($_POST['email']) ? ($_POST['email'] == '' ? '' : $_POST['email']) : ""); ?>">
                                <label for="email">Email Konsumen</label>
                            </div>
                            <div>
                                <label for="upload_ktp" class="form-label">Upload KTP</label>
                                <input class="form-control bg-white" type="file" id="upload_ktp" name="upload_ktp">
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                        <button type="submit" name="btnSimpanKonsumen" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>

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

<?php 
    if (isset($_POST['nama_konsumen'])) {
        if ($_POST['nama_konsumen'] != '') {
            echo "
                <script>
                    var tambahKonsumenModal = new bootstrap.Modal(document.getElementById('tambahKonsumenModal'), {});
                    document.onreadystatechange = function () {
                      tambahKonsumenModal.show();
                    };
                </script>
            ";
        }
    }

    if (isset($_POST['btnSimpanKonsumen'])) {
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
                        });
                    </script>
                ";
                return;
            }
            $upload_ktp = uniqid() . $upload_ktp;
            move_uploaded_file($file_tmp, 'data/ktp/'. $upload_ktp_new_name);
        }


        $insert_konsumen = mysqli_query($koneksi, "INSERT INTO konsumen (nama_konsumen, jenis_kelamin, whatsapp, pekerjaan, gaji, alamat, nik, npwp, instagram, email, upload_ktp) VALUES ('$nama_konsumen', '$jenis_kelamin', '$whatsapp', '$pekerjaan', '$gaji', '$alamat', '$nik', '$npwp', '$instagram', '$email', '$upload_ktp')");

        if ($insert_konsumen) {
            echo "
                <script>
                    Swal.fire({
                      title: 'Berhasil!',
                      text: 'Berhasil Tambah Konsumen!',
                      icon: 'success'
                    }).then(function() {
                        window.location = 'konsumen.php';
                    });;
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
                    });;
                </script>
            ";
        }
    }
?>