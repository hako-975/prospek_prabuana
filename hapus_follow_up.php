<body>
	<?php 
		include_once 'include/head.php';
		include_once 'include/script.php'; 
	?>
</body>
<?php 
	require 'koneksi.php';

	$id_follow_up = $_GET['id_follow_up'];
	$id_prospek = $_GET['id_prospek'];
	
	$query = mysqli_query($koneksi, "DELETE FROM follow_up WHERE id_follow_up = '$id_follow_up'");
	if ($query) {
		echo "
			<script>
			    Swal.fire({
			      title: 'Berhasil!',
			      text: 'Data Follow Up Berhasil Dihapus!',
			      icon: 'success'
			    }).then(function() {
                    window.location = 'follow_up.php?id_prospek=".$id_prospek."';
			    });
			</script>
		";
    } else {
	   header("Location: follow_up.php?id_prospek=$id_prospek");
	}