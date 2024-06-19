<div class="page-inner">
	<div class="row">
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3 class="h4">Form Tambah Guru</h3>
				</div>
				<div class="card-body">
					<form action="?page=guru&act=proses" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>NIP/NUPTK</label>
							<input required name="nip" type="text" class="form-control" placeholder="NIP/NUPTK">
						</div>

						<div class="form-group">
							<label>Nama Guru</label>
							<input required name="nama" type="text" class="form-control" placeholder="Nama dan Gelar">
						</div>
						<div class="form-group">
							<label>Jabatan</label>
							<select required class="choices form-select" name="jabatan">
								<option value="">Pilih</option>
								<option value="Guru Matematika">Guru Matematika</option>
								<option value="Guru Penjaskes">Guru Penjaskes</option>
								<option value="Guru Bahasa Indonesia">Guru Bahasa Indonesia</option>
								<option value="Guru Bahasa Inggris">Guru Bahasa Inggris</option>
								<option value="Guru IPA">Guru IPA</option>
								<option value="Guru IPS">Guru IPS</option>
								<option value="Guru Agama">Guru Agama</option>
								<option value="Guru Seni Budaya">Guru Seni Budaya</option>
								<option value="Guru BK">Guru BK</option>
							</select>
						</div>
						<div class="form-group">
							<label>Satuan Pendidikan</label>
							<input required name="satuan_pendidikan" type="text" class="form-control" placeholder="Satuan Pendidikan">
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select class="choices form-select" name="jk">
								<option value="">Pilih</option>
								<option value="L">Laki Laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<p>
								<img src="../assets/img/user/<?= $data['foto']; ?>" class="img-fluid rounded-circle kotak" style="height: 65px; width: 65px;">
							</p>
							<label>Foto</label>
							<input required type="file" name="foto">
						</div>
						<div class="form-group">
							<button name="saveGuru" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
							<a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>