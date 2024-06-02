<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveSubKriteria'])) {
    $nama_sub_kriteria = $_POST['nama_sub_kriteria'];
    $bobot = $_POST['bobot'];
    $kriteria_id = intval($_POST['kriteria_id']);

    $check_query = "SELECT COUNT(*) as count FROM tb_sub_kriteria WHERE nama_sub_kriteria = '$nama_sub_kriteria' AND kriteria_id = '$kriteria_id'";
    $result = mysqli_query($con, $check_query);
    $row = mysqli_fetch_assoc($result);
    $existing_count = $row['count'];

    if ($existing_count > 0) {
        echo "<script>
        alert('Sub kriteria dengan nama yang sama untuk kriteria tersebut sudah ada');
        window.location='?page=subkriteria&act=add';
        </script>";
    } else {
        $insert_query = "INSERT INTO tb_sub_kriteria (nama_sub_kriteria, bobot, kriteria_id) VALUES ('$nama_sub_kriteria', '$bobot', '$kriteria_id')";

        if (mysqli_query($con, $insert_query)) {
            echo "<script>
            alert('Data sub kriteria berhasil disimpan');
            window.location='?page=subkriteria';
            </script>";
        } else {
            echo "<script>alert('Gagal menyimpan data sub kriteria: " . mysqli_error($con) . "');</script>";
        }
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateSubKriteria'])) {
    $nama_sub_kriteria = $_POST['nama_sub_kriteria'];
    $bobot = $_POST['bobot'];
    $kriteria_id = intval($_POST['kriteria_id']);
    $id_sub_kriteria = $_GET['id'];

    $check_query = "SELECT COUNT(*) as count FROM tb_sub_kriteria WHERE nama_sub_kriteria = '$nama_sub_kriteria' AND kriteria_id = '$kriteria_id' AND id_sub_kriteria != '$id_sub_kriteria'";
    $result = mysqli_query($con, $check_query);
    $row = mysqli_fetch_assoc($result);
    $existing_count = $row['count'];

    if ($existing_count > 0) {
        echo "<script>
        alert('Sub kriteria dengan nama yang sama untuk kriteria tersebut sudah ada');
        window.location='?page=subkriteria&act=edit&id=$id_sub_kriteria';
        </script>";
    } else {
        $update_query = "UPDATE tb_sub_kriteria SET nama_sub_kriteria = '$nama_sub_kriteria', bobot = '$bobot', kriteria_id = '$kriteria_id' WHERE id_sub_kriteria = '$id_sub_kriteria'";

        if (mysqli_query($con, $update_query)) {
            echo "<script>
            alert('Data sub kriteria berhasil diupdate');
            window.location='?page=subkriteria';
            </script>";
        } else {
            echo "<script>alert('Gagal mengupdate data sub kriteria: " . mysqli_error($con) . "');</script>";
        }
    }
}
