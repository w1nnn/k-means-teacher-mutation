<?php
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = mysqli_query($con, "SELECT * FROM tb_kebutuhan WHERE id_sekolah='$id'");
    $data = mysqli_fetch_assoc($query);
}
?>

<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Edit Analisis Kebutuhan Sekolah</h3>
                </div>
                <div class="card-body">
                    <form action="?page=alternatif&act=proses" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data['id_sekolah'] ?>">
                        <div class="form-group">
                            <label>NPSN</label>
                            <input disabled name="npsn" type="text" class="form-control" value="<?= $data['npsn'] ?>" placeholder="NPSN" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input disabled name="nama_sekolah" type="text" class="form-control" value="<?= $data['nama_sekolah'] ?>" placeholder="Nama Sekolah" required>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input disabled name="kecamatan" type="text" class="form-control" value="<?= $data['kecamatan'] ?>" placeholder="Kecamatan" required>
                        </div>
                        <div class="form-group my-4">
                            <h6>Kebutuhan Guru</h6>
                            <hr>
                        </div>
                        <div class="form-group">
                            <label>Guru Matematika</label>
                            <input name="guru_matematika" type="number" class="form-control" value="<?= $data['guru_matematika'] ?>" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Penjaskes</label>
                            <input name="guru_penjaskes" type="number" class="form-control" value="<?= $data['guru_penjaskes'] ?>" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Bahasa Indonesia</label>
                            <input name="guru_bahasa_indonesia" type="number" class="form-control" value="<?= $data['guru_bahasa_indonesia'] ?>" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Bahasa Inggris</label>
                            <input name="guru_bahasa_inggris" type="number" class="form-control" value="<?= $data['guru_bahasa_ingris'] ?>" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru IPA</label>
                            <input name="guru_ipa" type="number" class="form-control" value="<?= $data['guru_ipa'] ?>" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru IPS</label>
                            <input name="guru_ips" type="number" class="form-control" value="<?= $data['guru_ips'] ?>" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Seni Budaya</label>
                            <input name="guru_seni_budaya" type="number" class="form-control" value="<?= $data['guru_seni_budaya'] ?>" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Agama</label>
                            <input name="guru_agama" type="number" class="form-control" value="<?= $data['guru_agama'] ?>" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <button name="editAlternatif" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>