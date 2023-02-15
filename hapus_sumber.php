<body>
	<?php 
		include_once 'include/head.php';
		include_once 'include/script.php'; 
	?>
</body>
<?php 
	require 'koneksi.php';

	$id_sumber = $_GET['id_sumber'];
	
	$query = mysqli_query($koneksi, "DELETE FROM sumber WHERE id_sumber = '$id_sumber'");
	if ($query) {
		echo "
			<script>
			    Swal.fire({
			      title: 'Berhasil!',
			      text: 'Data sumber Berhasil Dihapus!',
			      icon: 'success'
			    }).then(function() {
                    window.location = 'sumber.php';
			    });
			</script>
		";
    } else {
	   header("Location: sumber.php");
	}