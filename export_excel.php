<?php 
	require_once 'koneksi.php';
	$data_prospek = mysqli_query($koneksi, "SELECT * FROM prospek 
    INNER JOIN konsumen ON prospek.id_konsumen = konsumen.id_konsumen
    INNER JOIN status ON prospek.id_status = status.id_status
    INNER JOIN sumber ON prospek.id_sumber = sumber.id_sumber
    ORDER BY id_prospek DESC");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Laporan Prospek Prabuana</title>
	<style type="text/css">
		table th,
		table td{
	 		vertical-align: middle;
		}
	</style>
</head>
<body>
 
	<?php
        $filename = "Data Prospek - ".date('d_m_Y').".xls";
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
	?>
    <center>
        <h1>Data Prospek - <?= date('d/m/Y'); ?></h1>
    </center>
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
                <td>'<?= $data['whatsapp']; ?></td>
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
</body>
</html>