<?php
$id_sub_kriteria = $_GET['id'];

$query_sub_kriteria = mysqli_query($con, "SELECT * FROM tb_sub_kriteria WHERE id_sub_kriteria = '$id_sub_kriteria'");
$sub_kriteria = mysqli_fetch_assoc($query_sub_kriteria);

$kriteria = mysqli_query($con, "SELECT * FROM tb_kriteria");
?>

<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Edit Sub Kriteria</h3>
                </div>
                <div class="card-body">
                    <form action="?page=subkriteria&act=proses&id=<?= $id_sub_kriteria ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Sub Kriteria</label>
                            <input name="nama_sub_kriteria" type="text" class="form-control" placeholder="Nama Sub Kriteria" value="<?= $sub_kriteria['nama_sub_kriteria']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Bobot</label>
                            <input name="bobot" type="text" class="form-control" placeholder="Bobot" value="<?= $sub_kriteria['bobot']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <select class="choices form-select" name="kriteria_id">
                                <option value="">Pilih</option>
                                <?php foreach ($kriteria as $k) : ?>
                                    <option value="<?= $k['id_kriteria']; ?>" <?php if ($k['id_kriteria'] == $sub_kriteria['kriteria_id']) echo 'selected'; ?>><?= $k['nama_kriteria']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button name="updateSubKriteria" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                            <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>