<?php
$del = mysqli_query($con, "DELETE FROM tb_hasil_evaluasi WHERE id_hasil_evaluasi=$_GET[id]");
if ($del) {
    echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=kmeans';
		</script>";
}
