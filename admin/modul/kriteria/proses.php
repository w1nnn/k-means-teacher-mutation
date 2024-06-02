<?php
if (isset($_POST['saveKriteria'])) {
    $nama_kriteria = mysqli_real_escape_string($con, $_POST['nama_kriteria']);
    $cekKriteria = mysqli_query($con, "SELECT * FROM tb_kriteria WHERE nama_kriteria='$nama_kriteria'");
    $jumlahKriteria = mysqli_num_rows($cekKriteria);
    if ($jumlahKriteria > 0) {
        echo "
            <script type='text/javascript'>
            alert('Kriteria Sudah Ada. Silakan gunakan Kriteria lain.');
            window.location.replace('?page=kriteria');
            </script>";
    } else {
        $save = mysqli_query($con, "INSERT INTO tb_kriteria (nama_kriteria) VALUES ('$nama_kriteria')");
        if ($save) {
            echo "
                <script type='text/javascript'>
                alert('Data Berhasil Disimpan');
                window.location.replace('?page=kriteria');
                </script>";
        }
    }
} elseif (isset($_POST['editKriteria'])) {
    $nama_kriteria = mysqli_real_escape_string($con, $_POST['nama_kriteria']);
    $id_kriteria = mysqli_real_escape_string($con, $_POST['id']);
    $editKriteria = mysqli_query($con, "UPDATE tb_kriteria SET nama_kriteria='$nama_kriteria' WHERE id_kriteria='$id_kriteria'");

    if ($editKriteria) {
        echo "
                <script type='text/javascript'>
                alert('Data Berhasil Diubah');
                window.location.replace('?page=kriteria');
                </script>";
    }
}
