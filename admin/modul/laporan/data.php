<?php
$hasilEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi ORDER BY tahun DESC");
?>
<div class="page-inner">
    <div class="row">
        <section class="section">
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <h5 class="card-title text-center">Data Rekomendasi Usulan Mutasi Guru</h5>
                    </div>
                    <div class="card-body">
                        <form action="?page=laporan&act=tahun" method="POST">
                            <div class="input-group mb-3" style="width: 300px;">
                                <input type="date" class="form-control flatpickr-no-config" placeholder="Pilih Tahun" aria-label="Example text with button addon" aria-describedby="button-addon1" name="tahun">
                                <button name="btn" class="btn btn-info btn-sm" type="submit" id="button-addon1">Cetak Tahun</button>
                            </div>
                        </form>
                        <table class="table table-striped" id="laporan">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Layak Mutasi</th>
                                    <th>Tidak Layak Mutasi</th>
                                    <th>Tahun Mutasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($hasilEvaluasi as $no => $hasil) : ?>
                                    <tr>
                                        <td><?= $no + 1; ?>.</td>
                                        <td><?= $hasil['layak']; ?></td>
                                        <td><?= $hasil['tidak_layak']; ?></td>
                                        <td><?= $hasil['tahun']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>