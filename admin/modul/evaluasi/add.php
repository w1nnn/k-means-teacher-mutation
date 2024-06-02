<?php
$guru = mysqli_query($con, "SELECT * FROM tb_guru");
$masa_kerja = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE kriteria_id = (SELECT id_kriteria FROM tb_kriteria WHERE nama_kriteria = 'Masa Kerja')");
$proses_mengajar = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE kriteria_id = (SELECT id_kriteria FROM tb_kriteria WHERE nama_kriteria = 'Proses Mengajar')");
$jam_mengajar = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE kriteria_id = (SELECT id_kriteria FROM tb_kriteria WHERE nama_kriteria = 'Jam Kerja')");
$kebutuhan_sekolah = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE kriteria_id = (SELECT id_kriteria FROM tb_kriteria WHERE nama_kriteria = 'Kebutuhan Sekolah')");

?>
<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Evaluasi</h3>
                </div>
                <div class="card-body">
                    <form id="evaluasiForm" action="?page=evaluasi&act=proses" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>NIP/Nama Guru</label>
                            <select required class="choices form-select" name="nip" onchange="isiNama()">
                                <option value="">Pilih</option>
                                <?php foreach ($guru as $g) : ?>
                                    <option value="<?= $g['nip'] ?>"><?= $g['nip'] ?> | <?= $g['nama_guru'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Masa Kerja</label>
                            <select required class="choices form-select" name="masa_kerja">
                                <option value="">Pilih</option>
                                <?php foreach ($masa_kerja as $mk) : ?>
                                    <option value="<?= $mk['nama_sub_kriteria'] ?>"><?= $mk['nama_sub_kriteria'] ?> Tahun</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Proses Mengajar</label>
                            <select required class="choices form-select" name="proses_mengajar">
                                <option value="">Pilih</option>
                                <?php foreach ($proses_mengajar as $pm) : ?>
                                    <option value="<?= $pm['nama_sub_kriteria'] ?>"><?= $pm['nama_sub_kriteria'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Mengajar</label>
                            <select required class="choices form-select" name="jam_mengajar">
                                <option value="">Pilih</option>
                                <?php foreach ($jam_mengajar as $jm) : ?>
                                    <option value="<?= $jm['nama_sub_kriteria'] ?>"><?= $jm['nama_sub_kriteria'] ?> Jam</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kebutuhan Sekolah</label>
                            <select required class="form-select" name="kebutuhan_sekolah">
                                <option value="">Pilih</option>
                                <?php foreach ($kebutuhan_sekolah as $ks) : ?>
                                    <option value="<?= $ks['nama_sub_kriteria'] ?>"><?= $ks['nama_sub_kriteria'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button name="saveEvaluasi" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="?page=evaluasi" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>