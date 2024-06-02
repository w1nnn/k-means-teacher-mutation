<?php
$guru = mysqli_query($con, "SELECT * FROM tb_guru");
$masa_kerja = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE kriteria_id = (SELECT id_kriteria FROM tb_kriteria WHERE nama_kriteria = 'Masa Kerja')");
$proses_mengajar = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE kriteria_id = (SELECT id_kriteria FROM tb_kriteria WHERE nama_kriteria = 'Proses Mengajar')");
$jam_mengajar = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE kriteria_id = (SELECT id_kriteria FROM tb_kriteria WHERE nama_kriteria = 'Jam Kerja')");
$kebutuhan_sekolah = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE kriteria_id = (SELECT id_kriteria FROM tb_kriteria WHERE nama_kriteria = 'Kebutuhan Sekolah')");

$id_evaluasi = $_GET['id'] ?? '';
$edit = mysqli_query($con, "SELECT * FROM tb_evaluasi WHERE id_evaluasi='$id_evaluasi'");
$dataEvaluasi = mysqli_fetch_assoc($edit);
?>
<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Edit Evaluasi</h3>
                </div>
                <div class="card-body">
                    <form id="evaluasiForm" action="?page=evaluasi&act=proses" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>NIP/Nama Guru</label>
                            <input type="hidden" name="id" value="<?= $id_evaluasi; ?>">
                            <select class="choices form-select" name="nip" onchange="isiNama()" readonly>
                                <option value="">Pilih</option>
                                <?php foreach ($guru as $g) : ?>
                                    <option value="<?= $g['nip'] ?>" <?= ($g['nip'] == $dataEvaluasi['nip']) ? 'selected' : '' ?>>
                                        <?= $g['nip'] ?> | <?= $g['nama_guru'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Masa Kerja</label>
                            <select class="choices form-select" name="masa_kerja">
                                <option value="">Pilih</option>
                                <?php foreach ($masa_kerja as $mk) : ?>
                                    <option value="<?= $mk['nama_sub_kriteria'] ?>" <?= ($mk['nama_sub_kriteria'] == $dataEvaluasi['masa_kerja']) ? 'selected' : '' ?>>
                                        <?= $mk['nama_sub_kriteria'] ?> Tahun
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Proses Mengajar</label>
                            <select class="choices form-select" name="proses_mengajar">
                                <option value="">Pilih</option>
                                <?php foreach ($proses_mengajar as $pm) : ?>
                                    <option value="<?= $pm['nama_sub_kriteria'] ?>" <?= ($pm['nama_sub_kriteria'] == $dataEvaluasi['proses_mengajar']) ? 'selected' : '' ?>>
                                        <?= $pm['nama_sub_kriteria'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Mengajar</label>
                            <select class="choices form-select" name="jam_mengajar">
                                <option value="">Pilih</option>
                                <?php foreach ($jam_mengajar as $jm) : ?>
                                    <option value="<?= $jm['nama_sub_kriteria'] ?>" <?= ($jm['nama_sub_kriteria'] == $dataEvaluasi['jam_kerja']) ? 'selected' : '' ?>>
                                        <?= $jm['nama_sub_kriteria'] ?> Jam
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kebutuhan Sekolah</label>
                            <select class="form-select" name="kebutuhan_sekolah">
                                <option value="">Pilih</option>
                                <?php foreach ($kebutuhan_sekolah as $ks) : ?>
                                    <option value="<?= $ks['nama_sub_kriteria'] ?>" <?= ($ks['nama_sub_kriteria'] == $dataEvaluasi['kebutuhan_sekolah']) ? 'selected' : '' ?>>
                                        <?= $ks['nama_sub_kriteria'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button name="updateEvaluasi" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                            <a href="?page=evaluasi" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>