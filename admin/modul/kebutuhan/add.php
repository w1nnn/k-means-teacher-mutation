<div class="page-inner">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Form Tambah Analisis Kebutuhan Sekolah</h3>
                </div>
                <div class="card-body">
                    <form action="?page=kebutuhan&act=proses" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>NPSN</label>
                            <input autocomplete="off" name="npsn" type="text" class="form-control" placeholder="NPSN" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Sekolah</label>
                            <input autocomplete="off" name="nama_sekolah" type="text" class="form-control" placeholder="Nama Sekolah" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input autocapitalize="off" name="kecamatan" type="text" class="form-control" placeholder="Kecamatan" required readonly>
                        </div>

                        <div class="form-group my-4">
                            <h6>Kebutuhan Guru</h6>
                            <hr>
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
                        <!-- <div class="form-group">
                            <label>Guru BK</label>
                            <input name="guru_bk" type="number" class="form-control" placeholder="0" required>
                        </div> -->
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

<script>
    npsn = document.querySelector('input[name="npsn"]');
    npsn.addEventListener('input', function() {
        const value = this.value;
        console.log(value);
        fetch(`https://api-sekolah-indonesia.vercel.app/sekolah?npsn=${value}`)
            .then(response => response.json())
            .then(data => {
                document.querySelector('input[name="nama_sekolah"]').value = data.dataSekolah[0].sekolah.toLowerCase().replace(/(^|\s)\S/g, function(first) {
                    return first.toUpperCase();
                    console.log(data.dataSekolah[0].sekolah);
                });
                // document.querySelector('input[name="provinsi"]').value = data.dataSekolah[0].propinsi;
                // document.querySelector('input[name="kabupaten"]').value = data.dataSekolah[0].kabupaten_kota;
                document.querySelector('input[name="kecamatan"]').value = data.dataSekolah[0].kecamatan;
                // document.querySelector('input[name="alamat"]').value = data.dataSekolah[0].alamat_jalan.toLowerCase().replace(/(^|\s)\S/g, function(first) {
                return first.toUpperCase();
                // })
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>