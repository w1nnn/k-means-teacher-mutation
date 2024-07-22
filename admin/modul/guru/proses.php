<?php
if (isset($_POST['saveGuru'])) {
	$nip = $_POST['nip'];
	$cekNIP = mysqli_query($con, "SELECT * FROM tb_guru WHERE nip='$nip'");
	$jumlahNIP = mysqli_num_rows($cekNIP);
	if ($jumlahNIP > 0) {
		echo "
            <script type='text/javascript'>
            alert('NIP sudah ada. Silakan gunakan NIP lain.');
            window.location.replace('?page=guru');
            </script>";
	} else {
		$pass = sha1($_POST['nip']);

		$sumber = @$_FILES['foto']['tmp_name'];
		$target = '../assets/img/user/';
		$nama_gambar = @$_FILES['foto']['name'];
		$pindah = move_uploaded_file($sumber, $target . $nama_gambar);
		if ($pindah) {
			$save = mysqli_query($con, "INSERT INTO tb_guru VALUES(NULL,'$_POST[nip]','$_POST[nama]', '$_POST[jabatan]', '$_POST[masa_kerja]', '$_POST[satuan_pendidikan]', '$_POST[jam_kerja]','$_POST[jk]','$nama_gambar')");
			if ($save) {
				echo "
                    <script type='text/javascript'>
                    alert('Data Berhasil Disimpan');            
                    window.location.replace('?page=guru');
                    </script>";
			}
		}
	}
} elseif (isset($_POST['editGuru'])) {
	$gambar = @$_FILES['foto']['name'];
	if (!empty($gambar)) {
		move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/user/$gambar");
		$ganti = mysqli_query($con, "UPDATE tb_guru SET foto='$gambar' WHERE id_guru='$_POST[id]' ");
	}
	$editGuru = mysqli_query($con, "UPDATE tb_guru SET nama_guru='$_POST[nama]', jabatan='$_POST[jabatan]', masa_kerja='$_POST[masa_kerja]', satuan_pendidikan='$_POST[satuan_pendidikan]', jam_kerja='$_POST[jam_kerja]', jenis_kelamin='$_POST[jk]' WHERE id_guru='$_POST[id]' ");

	if ($editGuru) {
		echo "
                <script type='text/javascript'>
                alert('Data Berhasil Diubah');                
                window.location.replace('?page=guru');
                </script>";
	}
}
