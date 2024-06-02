<?php
if (isset($_POST['saveHasilEvaluasi'])) {
    $layakMutasiNIP = isset($_POST['layakMutasiNIP']) ? $_POST['layakMutasiNIP'] : '';
    $tidakLayakMutasiNIP = isset($_POST['tidakLayakMutasiNIP']) ? $_POST['tidakLayakMutasiNIP'] : '';

    $layakMutasiNIP_array = explode(',', $layakMutasiNIP);
    $tidakLayakMutasiNIP_array = explode(',', $tidakLayakMutasiNIP);

    $tahun = date('Y');
    mysqli_autocommit($con, false);


    $sqlDelete = "DELETE FROM tb_hasil_evaluasi";
    if (!mysqli_query($con, $sqlDelete)) {
        echo "<script>alert('Error deleting previous data: " . mysqli_error($con) . "');</script>";
        mysqli_rollback($con);
        exit;
    }

    $maxRows = max(count($layakMutasiNIP_array), count($tidakLayakMutasiNIP_array));
    for ($i = 0; $i < $maxRows; $i++) {
        $layakMutasiNIP_value = isset($layakMutasiNIP_array[$i]) ? $layakMutasiNIP_array[$i] : '';
        $tidakLayakMutasiNIP_value = isset($tidakLayakMutasiNIP_array[$i]) ? $tidakLayakMutasiNIP_array[$i] : '';

        $sqlInsert = "INSERT INTO tb_hasil_evaluasi (layak, tidak_layak, tahun) VALUES ('$layakMutasiNIP_value', '$tidakLayakMutasiNIP_value', '$tahun')";
        if (!mysqli_query($con, $sqlInsert)) {
            echo "<script>alert('Error inserting new data: " . mysqli_error($con) . "');</script>";
            mysqli_rollback($con);
            exit;
        }
    }

    mysqli_commit($con);

    echo "<script>alert('Data berhasil disimpan ke database!');
          window.location.replace('?page=kmeans');
          </script>";
}
