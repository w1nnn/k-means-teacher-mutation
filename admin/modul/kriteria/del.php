<?php
$del = mysqli_query($con, "DELETE FROM tb_kriteria WHERE id_kriteria=$_GET[id]");
if ($del) {
    echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=kriteria';
		</script>";
}
