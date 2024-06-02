<?php
if (isset($_POST['saveEvaluasi'])) {
    $nip = $_POST['nip'];
    $masa_kerja = $_POST['masa_kerja'];
    $proses_mengajar = $_POST['proses_mengajar'];
    $jam_mengajar = $_POST['jam_mengajar'];
    $kebutuhan_sekolah = $_POST['kebutuhan_sekolah'];

    $cekNIPQuery = "SELECT * FROM tb_evaluasi WHERE nip='$nip'";
    $cekNIP = mysqli_query($con, $cekNIPQuery);
    $jumlahNIP = mysqli_num_rows($cekNIP);

    if ($jumlahNIP > 0) {
        echo "
            <script type='text/javascript'>
            alert('NIP sudah ada dalam tabel evaluasi. Silakan gunakan NIP lain.');
            window.location.replace('?page=evaluasi');
            </script>";
    } else {
        $insertQuery = "INSERT INTO tb_evaluasi (nip, masa_kerja, proses_mengajar, jam_kerja, kebutuhan_sekolah) 
                        VALUES ('$nip', '$masa_kerja', '$proses_mengajar', '$jam_mengajar', '$kebutuhan_sekolah')";

        $insert = mysqli_query($con, $insertQuery);

        if ($insert) {
            echo "
                <script type='text/javascript'>
                alert('Data Berhasil Disimpan');
                window.location.replace('?page=evaluasi');
                </script>";
        } else {
            echo "
                <script type='text/javascript'>
                alert('Data Gagal Disimpan');
                window.location.replace('?page=evaluasi');
                </script>";
        }
    }
} else if (isset($_POST['updateEvaluasi'])) {
    $id_evaluasi = $_POST['id'] ?? '';
    $nip = $_POST['nip'];
    $masa_kerja = $_POST['masa_kerja'];
    $proses_mengajar = $_POST['proses_mengajar'];
    $jam_mengajar = $_POST['jam_mengajar'];
    $kebutuhan_sekolah = $_POST['kebutuhan_sekolah'];

    $updateQuery = "UPDATE tb_evaluasi SET nip='$nip', masa_kerja='$masa_kerja', proses_mengajar='$proses_mengajar', jam_kerja='$jam_mengajar', kebutuhan_sekolah='$kebutuhan_sekolah' WHERE id_evaluasi='$id_evaluasi'";

    $update = mysqli_query($con, $updateQuery);

    if ($update) {
        echo "
            <script type='text/javascript'>
            alert('Data Berhasil Diupdate');
            window.location.replace('?page=evaluasi');
            </script>";
    } else {
        echo "
            <script type='text/javascript'>
            alert('Data Gagal Diupdate');
            window.location.replace('?page=evaluasi');
            </script>";
    }
}
