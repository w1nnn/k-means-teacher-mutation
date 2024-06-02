<?php
$del = mysqli_query($con, "DELETE FROM tb_alternatif WHERE id_aternatif=$_GET[id]");
if ($del) {
	echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=kriteria';
		</script>";
}
