<?php
if (isset($_POST['simpan'])) {
    $iterasi = intval($_POST['pilih_iterasi']);

    $nama_guru = json_decode($_POST['nama_guru'][$iterasi], true);
    $cluster = json_decode($_POST['cluster'][$iterasi], true);
    $euclidean = json_decode($_POST['euclidean'][$iterasi], true);
    $tahunSekarang = date('Y');


    for ($i = 0; $i < count($nama_guru); $i++) {
        $cek = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi WHERE nama_guru = '$nama_guru[$i]'");
        if (mysqli_num_rows($cek) > 0) {
            continue;
        } else {
            $insert = mysqli_query($con, "INSERT INTO tb_hasil_evaluasi (nama_guru, cluster, euclidean, tahun_evaluasi) VALUES ('$nama_guru[$i]', '$cluster[$i]', '$euclidean[$i]', '$tahunSekarang')");

            if ($insert) {
                echo "<script>alert('Data berhasil disimpan!')</script>";
                echo "<script>document.location.href = '?page=kmeans'</script>";
            } else {
                echo "<script>alert('Data gagal disimpan!')</script>";
                echo "<script>document.location.href = '?page=kmeans'</script>";
            }
        }
    }
}
?>

<form action="" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Metode K-Means</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tentukan Cluster</a>
                        </li>
                        <?php if (isset($_POST['proses'])) : ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#hasil" role="tab" aria-controls="hasil" aria-selected="true">Hasil Metode</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <input class="form-control" type="hidden" name="jumlahCluster" id="jumlahCluster" autocomplete="off" value="2">
                                    <label for="maxIterasi">Jumlah Iterasi</label>
                                    <input class="form-control" type="text" name="maxIterasi" id="maxIterasi" autocomplete="off">
                                    <button class="btn btn-primary btn-sm mt-4" type="submit" name="proses" style="width: 38%;">Proses</button>

                                    <table class="table table-striped mt-5" id="table1" style="text-align: center; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="text-align: center;">No</th>
                                                <th colspan="3" style="text-align: center;">Cluster Mutasi</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center;">Layak Mutasi</th>
                                                <th style="text-align: center;">Tidak Layak Mutasi</th>
                                                <th style="text-align: center;">Tahun Evaluasi</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $dataEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi");
                                            $no = 1;
                                            foreach ($dataEvaluasi as $dE) :
                                                $cluster = $dE['cluster'];
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $cluster == '1' ? htmlspecialchars($dE['nama_guru']) : ''; ?></td>
                                                    <td><?= $cluster == '0' ? htmlspecialchars($dE['nama_guru']) : ''; ?></td>
                                                    <td><?= htmlspecialchars($dE['tahun_evaluasi']); ?></td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data?')" href="?page=evaluasi&act=del&id=<?= $dE['id_evaluasi'] ?>">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="hasil" role="tabpanel" aria-labelledby="profile-tab">
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
                            <?php

                            if (isset($_POST['proses'])) {
                                $jumlahCluster = isset($_POST['jumlahCluster']) ? intval($_POST['jumlahCluster']) : 0;
                                $maxIterasi = isset($_POST['maxIterasi']) ? intval($_POST['maxIterasi']) : 0;

                                $dataEvaluasi = mysqli_query($con, "SELECT * FROM tb_evaluasi");

                                $data = [];
                                while ($row = mysqli_fetch_assoc($dataEvaluasi)) {
                                    $data[] = [
                                        'id_guru' => $row['id_guru'],
                                        'nama_guru' => $row['nama_guru'],
                                        'masa_kerja' => intval($row['masa_kerja']),
                                        'jam_kerja' => intval($row['jam_kerja']),
                                        'proses_pembelajaran' => intval($row['proses_pembelajaran']),
                                    ];
                                }

                                function euclideanDistance($data, $centroid)
                                {
                                    $euclidean = [];
                                    foreach ($data as $key => $value) {
                                        $minDistance = PHP_INT_MAX;
                                        $clusterIndex = 0;
                                        foreach ($centroid as $idx => $cent) {
                                            $distance = sqrt(
                                                pow($value['masa_kerja'] - $cent['masa_kerja'], 2) +
                                                    pow($value['jam_kerja'] - $cent['jam_kerja'], 2) +
                                                    pow($value['proses_pembelajaran'] - $cent['proses_pembelajaran'], 2)
                                            );
                                            if ($distance < $minDistance) {
                                                $minDistance = $distance;
                                                $clusterIndex = $idx;
                                            }
                                        }
                                        $euclidean[$key] = [
                                            'cluster' => $clusterIndex,
                                            'euclidean' => $minDistance
                                        ];
                                    }
                                    return $euclidean;
                                }

                                function centroid($data, $euclidean, $jumlahCluster)
                                {
                                    $centroid = [];
                                    for ($i = 0; $i < $jumlahCluster; $i++) {
                                        $masa_kerja_sum = 0;
                                        $jam_kerja_sum = 0;
                                        $proses_pembelajaran_sum = 0;
                                        $count = 0;
                                        foreach ($euclidean as $key => $value) {
                                            if ($value['cluster'] == $i) {
                                                $masa_kerja_sum += $data[$key]['masa_kerja'];
                                                $jam_kerja_sum += $data[$key]['jam_kerja'];
                                                $proses_pembelajaran_sum += $data[$key]['proses_pembelajaran'];
                                                $count++;
                                            }
                                        }
                                        $centroid[$i] = [
                                            'masa_kerja' => $count == 0 ? 0 : $masa_kerja_sum / $count,
                                            'jam_kerja' => $count == 0 ? 0 : $jam_kerja_sum / $count,
                                            'proses_pembelajaran' => $count == 0 ? 0 : $proses_pembelajaran_sum / $count
                                        ];
                                    }
                                    return $centroid;
                                }

                                function kmeans($data, $jumlahCluster, $maxIterasi)
                                {
                                    $minMasaKerja = min(array_column($data, 'masa_kerja'));
                                    $maxMasaKerja = max(array_column($data, 'masa_kerja'));

                                    $centroid = [];
                                    for ($i = 0; $i < $jumlahCluster; $i++) {
                                        $centroid[$i] = [
                                            'masa_kerja' => ($i + 1) * 10,
                                            'jam_kerja' => rand($data[0]['jam_kerja'], $data[count($data) - 1]['jam_kerja']),
                                            'proses_pembelajaran' => rand($data[0]['proses_pembelajaran'], $data[count($data) - 1]['proses_pembelajaran'])
                                        ];
                                    }

                                    $iterasi_table = [];
                                    for ($iterasi = 0; $iterasi < $maxIterasi; $iterasi++) {
                                        $euclidean = euclideanDistance($data, $centroid);
                                        $centroid = centroid($data, $euclidean, $jumlahCluster);

                                        $iterasi_table[$iterasi]['centroid'] = $centroid;
                                        $iterasi_table[$iterasi]['euclidean'] = $euclidean;
                                    }

                                    return $iterasi_table;
                                }

                                $hasilKMeans = kmeans($data, $jumlahCluster, $maxIterasi);

                                echo '<div class="table-responsive">';
                                foreach ($hasilKMeans as $iterasi => $hasil) {
                                    echo '<div class="mt-5">';
                                    echo '<button class="btn btn-primary btn-sm mt-4 mb-3" type="submit" name="simpan" style="width: 20%;">Simpan</button>';

                                    echo '<table class="table table-striped" id="table2">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Centroid</th>';
                                    echo '<th>Masa Kerja</th>';
                                    echo '<th>Jam Kerja</th>';
                                    echo '<th>Proses Pembelajaran</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    foreach ($hasil['centroid'] as $idx => $cent) {
                                        echo '<tr>';
                                        echo '<td>Centroid ' . ($idx + 1) . '</td>';
                                        echo '<td>' . number_format($cent['masa_kerja'], 2) . '</td>';
                                        echo '<td>' . number_format($cent['jam_kerja'], 2) . '</td>';
                                        echo '<td>' . number_format($cent['proses_pembelajaran'], 2) . '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';

                                    echo '<table class="table table-striped">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Nama Guru</th>';
                                    echo '<th>Cluster</th>';
                                    echo '<th>Euclidean Distance</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    echo '<div class="alert alert-info text-center"><i class="bi bi-check-circle"></i> Iterasi ' . ($iterasi + 1) . '</div>';
                                    echo '<label class="my-3"><input required class="form-check-input" type="radio" name="pilih_iterasi" value="' . $iterasi . '"> Pilih Iterasi ' . ($iterasi + 1) . '</label>';
                                    foreach ($hasil['euclidean'] as $dataKey => $dataVal) {
                                        $nama_guru = $data[$dataKey]['nama_guru'];
                                        $nip = $data[$dataKey]['nip'];
                                        echo '<tr>';
                                        echo '<td><input type="text" readonly class="form-control" name="nama_guru[' . $iterasi . '][]" value="' . $nama_guru . '"></td>';
                                        echo '<td><input type="text" readonly class="form-control" name="cluster[' . $iterasi . '][]" value="' . ($dataVal['cluster'] + 1) . '"></td>';
                                        echo '<td><input type="text" readonly class="form-control" name="euclidean[' . $iterasi . '][]" value="' . $dataVal['euclidean'] . '"></td>';
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                    echo '</table>';

                                    echo '<input type="hidden" name="nama_guru[' . $iterasi . ']" value="' . htmlspecialchars(json_encode(array_column($data, 'nama_guru'))) . '">';
                                    echo '<input type="hidden" name="nip[' . $iterasi . ']" value="' . htmlspecialchars(json_encode(array_column($data, 'nip'))) . '">';
                                    echo '<input type="hidden" name="cluster[' . $iterasi . ']" value="' . htmlspecialchars(json_encode(array_column($hasil['euclidean'], 'cluster'))) . '">';
                                    echo '<input type="hidden" name="euclidean[' . $iterasi . ']" value="' . htmlspecialchars(json_encode(array_column($hasil['euclidean'], 'euclidean'))) . '">';

                                    echo '</div>';
                                }

                                echo '</div>';
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>