<body>
	<?php 
		include_once 'include/head.php';
		include_once 'include/script.php'; 
	?>
</body>
<?php 
	require 'koneksi.php';

	$id_konsumen = $_GET['id_konsumen'];
	
	$query = mysqli_query($koneksi, "DELETE FROM konsumen WHERE id_konsumen = '$id_konsumen'");
	if ($query) {
		echo "
			<script>
			    Swal.fire({
			      title: 'Berhasil!',
			      text: 'Data Konsumen Berhasil Dihapus!',
			      icon: 'success'
			    }).then(function() {
                    window.location = 'konsumen.php';
			    });
			</script>
		";
    } else {
	   header("Location: konsumen.php");
	}