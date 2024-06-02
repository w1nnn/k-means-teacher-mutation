<?php
$nip = $data['nip'];
$nama_guru = $data['nama_guru'];
$query = "SELECT * FROM tb_hasil_evaluasi WHERE layak= '$nip' OR tidak_layak= '$nip'";
$hasilEvaluasi = mysqli_query($con, $query);

if (!$hasilEvaluasi) {
    die('Error: ' . mysqli_error($con));
}

$data = [];

while ($row = mysqli_fetch_assoc($hasilEvaluasi)) {
    if ($row['layak'] == $nip) {
        $data[] = array('status' => 'Layak Mutasi');
    }
    if ($row['tidak_layak'] == $nip) {
        $data[] = array('status' => 'Tidak Layak Mutasi');
    }
}
?>

<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <h5 class="card-title text-center">Identitas Usulan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nip</th>
                                    <th>Nama </th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $key => $row) { ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= $nip; ?></td>
                                        <td><?= $nama_guru; ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'Layak Mutasi') { ?>
                                                <span class="badge bg-success"><?= $row['status']; ?></span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger"><?= $row['status']; ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>