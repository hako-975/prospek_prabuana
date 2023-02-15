<body>
	<?php 
		include_once 'include/head.php';
		include_once 'include/script.php'; 
	?>
</body>
<?php 
	require 'koneksi.php';

	$id_prospek = $_GET['id_prospek'];
	
	$query = mysqli_query($koneksi, "DELETE FROM prospek WHERE id_prospek = '$id_prospek'");
	if ($query) {
		echo "
			<script>
			    Swal.fire({
			      title: 'Berhasil!',
			      text: 'Data prospek Berhasil Dihapus!',
			      icon: 'success'
			    }).then(function() {
                    window.location = 'prospek.php';
			    });
			</script>
		";
    } else {
	   header("Location: prospek.php");
	}