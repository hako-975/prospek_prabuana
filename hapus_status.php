<body>
	<?php 
		include_once 'include/head.php';
		include_once 'include/script.php'; 
	?>
</body>
<?php 
	require 'koneksi.php';

	$id_status = $_GET['id_status'];
	
	$query = mysqli_query($koneksi, "DELETE FROM status WHERE id_status = '$id_status'");
	if ($query) {
		echo "
			<script>
			    Swal.fire({
			      title: 'Berhasil!',
			      text: 'Data Status Berhasil Dihapus!',
			      icon: 'success'
			    }).then(function() {
                    window.location = 'status.php';
			    });
			</script>
		";
    } else {
	   header("Location: status.php");
	}