<?php
$del = mysqli_query($con, "DELETE FROM tb_kebutuhan WHERE id_sekolah=$_GET[id]");
if ($del) {
	echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=kebutuhan';
		</script>";
}
