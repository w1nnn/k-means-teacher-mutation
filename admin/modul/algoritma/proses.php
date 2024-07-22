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
?>
<table class="table table-striped mt-5" id="table1" style="text-align: center; width: 100%;">
    <thead>
        <tr>
            <th rowspan="2" style="text-align: center;">Nama Guru</th>
            <th colspan="3" style="text-align: center;">Nilai Kriteria</th>
        </tr>
        <tr>
            <th style="text-align: center;">Masa Kerja</th>
            <th style="text-align: center;">Jam Kerja</th>
            <th style="text-align: center;">Proses Pembelajaran</th>
        </tr>
    </thead>
    <tbody>
        <?php $dataEvaluasi = mysqli_query($con, "SELECT * FROM tb_evaluasi"); ?>
        <?php foreach ($dataEvaluasi as $data) : ?>
            <tr>
                <td style="text-align: left;"><?= $data['nama_guru']; ?></td>
                <td><?= $data['masa_kerja']; ?></td>
                <td><?= $data['jam_kerja']; ?></td>
                <td><?= $data['proses_pembelajaran']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>