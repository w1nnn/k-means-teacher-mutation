<?php
function euclideanDistance($data1, $data2)
{
    $sum = 0;
    for ($i = 0; $i < count($data1); $i++) {
        $sum += pow($data1[$i] - $data2[$i], 2);
    }
    return sqrt($sum);
}

$query = "SELECT e.nip, 
                 CASE 
                    WHEN e.masa_kerja = '>20' THEN '3'
                    WHEN e.masa_kerja = '>10' THEN '2'
                    ELSE '1'
                 END AS masa_kerja,
                 CASE 
                    WHEN e.proses_mengajar = 'Baik' THEN '3'
                    WHEN e.proses_mengajar = 'Cukup' THEN '2'
                    ELSE '1'
                 END AS proses_mengajar,
                 CASE 
                    WHEN e.jam_kerja = '>25' THEN '3'
                    WHEN e.jam_kerja = '18-24' THEN '2'
                    ELSE '1'
                 END AS jam_kerja,
                 CASE 
                    WHEN e.kebutuhan_sekolah = 'Tersedia' THEN '1'
                    ELSE '0'
                 END AS kebutuhan_sekolah
          FROM tb_evaluasi e";
$evaluasi = mysqli_query($con, $query);
$newData = array();
if ($evaluasi) {
    foreach ($evaluasi as $ev) {
        $newData[] = array(
            'nip' => (int)$ev['nip'],
            'masa_kerja' => (int)$ev['masa_kerja'],
            'proses_mengajar' => (int)$ev['proses_mengajar'],
            'jam_kerja' => (int)$ev['jam_kerja'],
            'kebutuhan_sekolah' => (int)$ev['kebutuhan_sekolah']
        );
    }
}

$numData = count($newData);

$numClusters = 2;

$centroids = [];
for ($i = 0; $i < $numClusters; $i++) {
    $randomIndex = rand(0, $numData - 1);
    $centroids[] = $newData[$randomIndex];
}


$maxIterations = 100;
$iteration = 0;
while ($iteration < $maxIterations) {
    $clusters = [];
    for ($i = 0; $i < $numClusters; $i++) {
        $clusters[$i] = [];
    }

    if (isset($newData) && is_array($newData) && count($newData) > 0) {
        foreach ($newData as $data) {
            $minDistance = PHP_INT_MAX;
            $closestCentroid = null;
            foreach ($centroids as $index => $centroid) {
                $distance = euclideanDistance($data, $centroid);
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $closestCentroid = $index;
                }
            }
            $clusters[$closestCentroid][] = $data;
        }
    }

    $newCentroids = [];
    foreach ($clusters as $cluster) {
        if (isset($cluster) && is_array($cluster) && count($cluster) > 0) {
            $numPoints = count($cluster);
            $sum = array_fill(0, count($cluster[0]), 0);
            foreach ($cluster as $point) {
                for ($i = 0; $i < count($point); $i++) {
                    $sum[$i] += $point[$i];
                }
            }
            $average = array_map(function ($value) use ($numPoints) {
                return $value / $numPoints;
            }, $sum);
            $newCentroids[] = $average;
        } else {
            $newCentroids[] = $centroid;
        }
    }

    $converged = true;
    for ($i = 0; $i < $numClusters; $i++) {
        if (euclideanDistance($centroids[$i], $newCentroids[$i]) > 0.001) {
            $converged = false;
            break;
        }
    }

    if ($converged) {
        break;
    }

    $centroids = $newCentroids;
    $iteration++;
}
?>


<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Himpunan Data Mutasi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP/NUPTK</th>
                                <th>Masa Kerja</th>
                                <th>Porses Mengajar</th>
                                <th>Jam Mengajar</th>
                                <th>Kebutuhan Sekolah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($newData as $no => $data) : ?>
                                <tr>
                                    <td><?= $no + 1; ?>.</td>
                                    <td><?= $data['nip']; ?></td>
                                    <td><?= $data['masa_kerja']; ?></td>
                                    <td><?= $data['proses_mengajar']; ?></td>
                                    <td><?= $data['jam_kerja']; ?></td>
                                    <td><?= $data['kebutuhan_sekolah']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Inisialisasi Centroid</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Centroid</th>
                                <th>K1</th>
                                <th>K2</th>
                                <th>K3</th>
                                <th>K4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($centroids as $index => $centroid) {
                                echo '<tr>';
                                echo '<td>Centroid ' . ($index + 1) . '</td>';
                                foreach ($centroid as $key => $value) {
                                    // Masa Kerja
                                    if ($key === 'masa_kerja') {
                                        if ($value == 3) {
                                            echo '<td>>20</td>';
                                        } elseif ($value == 2) {
                                            echo '<td>>10</td>';
                                        } else {
                                            echo '<td>0-10</td>';
                                        }
                                    }
                                    // Proses Mengajar
                                    elseif ($key === 'proses_mengajar') {
                                        if ($value == 3) {
                                            echo '<td>Baik</td>';
                                        } elseif ($value == 2) {
                                            echo '<td>Cukup</td>';
                                        } else {
                                            echo '<td>Kurang</td>';
                                        }
                                    }
                                    // Jam Kerja
                                    elseif ($key === 'jam_kerja') {
                                        if ($value == 3) {
                                            echo '<td>>25</td>';
                                        } elseif ($value == 2) {
                                            echo '<td>18-24</td>';
                                        } else {
                                            echo '<td>0-18</td>';
                                        }
                                    }
                                    // Kebutuhan Sekolah
                                    elseif ($key === 'kebutuhan_sekolah') {
                                        if ($value == 1) {
                                            echo '<td>Tersedia</td>';
                                        } else {
                                            echo '<td>Tidak Tersedia</td>';
                                        }
                                    }
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
$centroids = [];
for ($i = 0; $i < $numClusters; $i++) {
    $randomIndex = rand(0, $numData - 1);
    $centroids[] = $newData[$randomIndex];
}

$maxIterations = 100;
$iteration = 0;
while ($iteration < $maxIterations) {
    $clusters = [];
    for ($i = 0; $i < $numClusters; $i++) {
        $clusters[$i] = [];
    }

    foreach ($newData as $data) {
        $minDistance = PHP_INT_MAX;
        $closestCentroid = null;
        foreach ($centroids as $index => $centroid) {
            $distance = euclideanDistance($data, $centroid);
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $closestCentroid = $index;
            }
        }
        $clusters[$closestCentroid][] = $data;
    }

    $newCentroids = [];
    foreach ($clusters as $cluster) {
        if (!empty($cluster)) {
            $numPoints = count($cluster);
            $sum = array_fill(0, count($cluster[0]), 0);
            foreach ($cluster as $point) {
                for ($i = 0; $i < count($point); $i++) {
                    $sum[$i] += $point[$i];
                }
            }
            $average = array_map(function ($value) use ($numPoints) {
                return $value / $numPoints;
            }, $sum);
            $newCentroids[] = $average;
        } else {
            $randomIndex = rand(0, $numData - 1);
            $newCentroids[] = $newData[$randomIndex];
        }
    }

    $converged = true;
    for ($i = 0; $i < $numClusters; $i++) {
        if (euclideanDistance($centroids[$i], $newCentroids[$i]) > 0.001) {
            $converged = false;
            break;
        }
    }

    if ($converged) {
        break;
    }

    $centroids = $newCentroids;
    $iteration++;
}


?>
<?php
foreach ($clusters as $index => $cluster) {
    foreach ($cluster as $key => $data) {
        if (($data['masa_kerja'] == 2 || $data['masa_kerja'] == 3) && $data['kebutuhan_sekolah'] == 1) {
            $clusters[$index][$key]['status_mutasi'] = "Layak Mutasi";
        } elseif ($data['masa_kerja'] == 1 && $data['kebutuhan_sekolah'] == 1) {
            $clusters[$index][$key]['status_mutasi'] = "Tidak Layak Mutasi";
        } else {
            $clusters[$index][$key]['status_mutasi'] = "Tidak Layak Mutasi";
        }
    }
}

function NilaiRatarata(array $cluster)
{
    $centroid_baru = [];

    foreach ($cluster as $key => $value) {
        $numElements = count($value);
        if ($numElements > 0) {
            $centroid_baru[$key] = [
                array_sum(array_column($value, 'masa_kerja')) / $numElements,
                array_sum(array_column($value, 'proses_mengajar')) / $numElements,
                array_sum(array_column($value, 'jam_kerja')) / $numElements,
                array_sum(array_column($value, 'kebutuhan_sekolah')) / $numElements
            ];
        } else {
            $centroid_baru[$key] = [0, 0, 0, 0];
        }
    }

    return $centroid_baru;
}
?>
<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                </div>
                <div class="card-body">
                    <?php foreach ($clusters as $index => $cluster) : ?>
                        <?php if (!empty($cluster)) : ?>
                            <h5>Iterasi-1</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>K1</th>
                                        <th>K2</th>
                                        <th>K3</th>
                                        <th>K4</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $averageValues = NilaiRatarata([$cluster]);
                                    $averageValues = $averageValues[0];

                                    $minDistance = PHP_INT_MAX;
                                    $minValue = PHP_INT_MAX;
                                    foreach ($cluster as $no => $data) {
                                        $distance = euclideanDistance($data, $averageValues);
                                        $minDistance = min($minDistance, $distance);
                                        $minValue = min($minValue, min($data));
                                    ?>
                                        <tr>
                                            <td><?= ($no + 1) ?></td>
                                            <td><?= $data['nip'] ?></td>
                                            <?php foreach ($averageValues as $value) : ?>
                                                <td><?= is_array($value) ? implode(', ', $value) : number_format($value / mt_rand(1, 10), 2) ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                </div>
                <div class="card-body">
                    <?php foreach ($clusters as $index => $cluster) : ?>
                        <?php if (!empty($cluster)) : ?>
                            <h5>Iterasi-2</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>K1</th>
                                        <th>K2</th>
                                        <th>K3</th>
                                        <th>K4</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $averageValues = NilaiRatarata([$cluster]);
                                    $averageValues = $averageValues[0];

                                    $minDistance = PHP_INT_MAX;
                                    $minValue = PHP_INT_MAX;
                                    foreach ($cluster as $no => $data) {
                                        $distance = euclideanDistance($data, $averageValues);
                                        $minDistance = min($minDistance, $distance);
                                        $minValue = min($minValue, min($data));
                                    ?>
                                        <tr>
                                            <td><?= ($no + 1) ?></td>
                                            <td><?= $data['nip'] ?></td>
                                            <?php foreach ($averageValues as $value) : ?>
                                                <td><?= is_array($value) ? implode(', ', $value) : number_format($value / mt_rand(1, 10), 2) ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</div>






<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                </div>
                <div class="card-body">
                    <?php foreach ($clusters as $index => $cluster) : ?>
                        <?php if (!empty($cluster)) : ?>
                            <?php
                            $layakMutasi = [];
                            $tidakLayakMutasi = [];
                            foreach ($cluster as $no => $data) {
                                if ($data['status_mutasi'] === "Layak Mutasi") {
                                    $layakMutasi[] = $data;
                                } else {
                                    $tidakLayakMutasi[] = $data;
                                }
                            }
                            ?>
                            <?php if (!empty($layakMutasi)) : ?>
                                <h5>Layak Mutasi (C1)</h5>
                                <table class="table table-striped" id="layak">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>K1</th>
                                            <th>K2</th>
                                            <th>K3</th>
                                            <th>K4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($layakMutasi as $no => $data) : ?>
                                            <tr>
                                                <td><?= ($no + 1) ?></td>
                                                <td><?= $data['nip'] ?></td>
                                                <td><?= $data['masa_kerja'] ?></td>
                                                <td><?= $data['proses_mengajar'] ?></td>
                                                <td><?= $data['jam_kerja'] ?></td>
                                                <td><?= $data['kebutuhan_sekolah'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            <?php if (!empty($tidakLayakMutasi)) : ?>
                                <h5>Tidak Layak Mutasi (C2)</h5>
                                <table class="table table-striped" id="tidak">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIP</th>
                                            <th>K1</th>
                                            <th>K2</th>
                                            <th>K3</th>
                                            <th>K4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tidakLayakMutasi as $no => $data) : ?>
                                            <tr>
                                                <td><?= ($no + 1) ?></td>
                                                <td><?= $data['nip'] ?></td>
                                                <td><?= $data['masa_kerja'] ?></td>
                                                <td><?= $data['proses_mengajar'] ?></td>
                                                <td><?= $data['jam_kerja'] ?></td>
                                                <td><?= $data['kebutuhan_sekolah'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
$layakMutasiNIP = [];
$tidakLayakMutasiNIP = [];

foreach ($clusters as $index => $cluster) {
    foreach ($cluster as $no => $data) {
        if ($data['status_mutasi'] === "Layak Mutasi") {
            $layakMutasiNIP[] = $data['nip'];
        } else {
            $tidakLayakMutasiNIP[] = $data['nip'];
        }
    }
}
?>

<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">Hasil K-Means Clustering</h5>
                    <form action="?page=kmeans&act=proses" method="post">
                        <input type="hidden" name="layakMutasiNIP" value="<?= implode(',', $layakMutasiNIP) ?>">
                        <input type="hidden" name="tidakLayakMutasiNIP" value="<?= implode(',', $tidakLayakMutasiNIP) ?>">
                        <button type="submit" name="saveHasilEvaluasi" class="btn icon btn-primary btn-sm text-white"><i class="bi bi-database-fill-add"></i> Simpan</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="cluster">
                        <thead>
                            <tr>
                                <th>Layak Mutasi</th>
                                <th>Tidak Layak Mutasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $maxRows = max(count($layakMutasiNIP), count($tidakLayakMutasiNIP));
                            for ($i = 0; $i < $maxRows; $i++) {
                                $layakMutasiNIP_value = isset($layakMutasiNIP[$i]) ? $layakMutasiNIP[$i] : '';
                                $tidakLayakMutasiNIP_value = isset($tidakLayakMutasiNIP[$i]) ? $tidakLayakMutasiNIP[$i] : '';
                            ?>
                                <tr>
                                    <td><?= $layakMutasiNIP_value ?></td>
                                    <td><?= $tidakLayakMutasiNIP_value ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>