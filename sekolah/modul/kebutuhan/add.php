<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Tambah Analisis Kebutuhan Sekolah</h3>
                </div>
                <div class="card-body">
                    <form action="?page=alternatif&act=proses" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Satuan Pendidikan</label>
                            <input name="satuan_pendidikan" type="text" class="form-control" placeholder="Satuan Pendidikan" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Matematika</label>
                            <input name="guru_matematika" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Penjaskes</label>
                            <input name="guru_penjaskes" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Bahasa Indonesia</label>
                            <input name="guru_bahasa_indonesia" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Bahasa Inggris</label>
                            <input name="guru_bahasa_inggris" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru IPA</label>
                            <input name="guru_ipa" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru IPS</label>
                            <input name="guru_ips" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Seni Budaya</label>
                            <input name="guru_seni_budaya" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru Agama</label>
                            <input name="guru_agama" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <label>Guru BK</label>
                            <input name="guru_bk" type="number" class="form-control" placeholder="0" required>
                        </div>
                        <div class="form-group">
                            <button name="saveAlternatif" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>