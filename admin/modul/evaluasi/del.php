<?php
$del = mysqli_query($con, "DELETE FROM tb_evaluasi WHERE id_evaluasi=$_GET[id]");
if ($del) {
    echo " <script>
		alert('Data telah dihapus !');
		window.location='?page=evaluasi';
		</script>";
}
