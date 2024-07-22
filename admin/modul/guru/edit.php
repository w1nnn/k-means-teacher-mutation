<?php
$edit = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru='$_GET[id]' ");
foreach ($edit as $d);
?>
<div class="page-inner">
	<div class="row">
		<div class="col-lg-8">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3 class="h4">Form Edit Guru</h3>
				</div>
				<div class="card-body">
					<form action="?page=guru&act=proses" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>NIP/NUPTK</label>
							<input type="hidden" name="id" value="<?= $d['id_guru'] ?>">
							<input name="nip" type="text" class="form-control" value="<?= $d['nip'] ?>" readonly>
						</div>

						<div class="form-group">
							<label>Nama Guru</label>
							<input name="nama" type="text" class="form-control" value="<?= $d['nama_guru'] ?>">
						</div>
						<div class="form-group">
							<label>Jabatan</label>
							<select class="choices form-select" name="jabatan">
								<option value="">Pilih</option>
								<option value="Guru Matematika" <?= ($d['jabatan'] == 'Guru Matematika') ? 'selected' : ''; ?>>Guru Matematika</option>
								<option value="Guru Penjaskes" <?= ($d['jabatan'] == 'Guru Penjaskes') ? 'selected' : ''; ?>>Guru Penjaskes</option>
								<option value="Guru Bahasa Indonesia" <?= ($d['jabatan'] == 'Guru Bahasa Indonesia') ? 'selected' : ''; ?>>Guru Bahasa Indonesia</option>
								<option value="Guru Bahasa Inggris" <?= ($d['jabatan'] == 'Guru Bahasa Inggris') ? 'selected' : ''; ?>>Guru Bahasa Inggris</option>
								<option value="Guru IPA" <?= ($d['jabatan'] == 'Guru IPA') ? 'selected' : ''; ?>>Guru IPA</option>
								<option value="Guru IPS" <?= ($d['jabatan'] == 'Guru IPS') ? 'selected' : ''; ?>>Guru IPS</option>
								<option value="Guru Agama" <?= ($d['jabatan'] == 'Guru Agama') ? 'selected' : ''; ?>>Guru Agama</option>
								<option value="Guru Seni Budaya" <?= ($d['jabatan'] == 'Guru Seni Budaya') ? 'selected' : ''; ?>>Guru Seni Budaya</option>
								<!-- <option value="Guru BK" <?= ($d['jabatan'] == 'Guru BK') ? 'selected' : ''; ?>>Guru BK</option> -->
							</select>
						</div>
						<div class="form-group">
							<label>Masa kerja</label>
							<input name="masa_kerja" type="text" class="form-control" placeholder="Masa Kerja" value="<?= $d['masa_kerja'] ?>" readonly>
						</div>
						<div class="row">
							<div class="col-12">
								<p>Satuan Pendidikan</p>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="roundText">Kecamatan</label>
									<select class="form-select" name="kecamatan">
										<option selected>Pilih</option>
										<option value="191205">Sinjai Timur</option>
										<option value="191203">Sinjai Selatan</option>
										<option value="191207">Sinjai Utara</option>
										<option value="191201">Sinjai Barat</option>
										<option value="191206">Sinjai Tengah</option>
										<option value="191202">Sinjai Borong</option>
										<option value="191209">Pulau Sembilan</option>
										<option value="191208">Buluppoddo</option>
										<option value="191204">Tellulimpoe</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="squareText">Nama Sekolah</label>
									<select class="form-select" name="satuan_pendidikan">
										<option value="<?= $d['satuan_pendidikan']; ?>" selected><?= $d['satuan_pendidikan']; ?></option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Jam Kerja / Pekan </label>
							<select class="choices form-select" name="jam_kerja">
								<option value="">Pilih</option>
								<option value=">25" <?= ($d['jam_kerja'] == '>25') ? 'selected' : '' ?>> >25 Jam </option>
								<option value="18-24" <?= ($d['jam_kerja'] == '18-24') ? 'selected' : '' ?>> 18-24 Jam </option>
								<option value="10-17" <?= ($d['jam_kerja'] == '10-17') ? 'selected' : '' ?>> 10-17 Jam </option>
							</select>
						</div>
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<select class="choices form-select" name="jk">
								<option value="">Pilih</option>
								<option value="L" <?= ($d['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki Laki</option>
								<option value="P" <?= ($d['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<p>
								<img src="../assets/img/user/<?= $d['foto']; ?>" class="img-fluid rounded-circle kotak" style="height: 65px; width: 65px;">
							</p>
							<label>Foto</label>
							<input type="file" name="foto">
						</div>
						<div class="form-group">
							<button name="editGuru" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
							<a href="javascript:history.back()" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Batal</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	const kecamatan = document.querySelector('select[name="kecamatan"]');
	kecamatan.addEventListener('change', async function() {
		const kecamatanValue = kecamatan.value;
		const response = await fetch(`https://api-sekolah-indonesia.vercel.app/sekolah/sd?kec=${kecamatanValue}&page=1&perPage=200`);
		const data = await response.json();

		const dataSekolah = data.dataSekolah;
		const select = document.querySelector('select[name="satuan_pendidikan"]');
		select.innerHTML = '';
		const option = document.createElement('option');
		option.value = '';
		option.text = 'Pilih';
		select.appendChild(option);

		dataSekolah.forEach(function(item) {
			const option = document.createElement('option');
			option.value = item.sekolah.toLowerCase().replace(/(^|\s)\S/g, function(first) {
				return first.toUpperCase();
			});
			option.text = item.sekolah.toLowerCase().replace(/(^|\s)\S/g, function(first) {
				return first.toUpperCase();
			});
			select.appendChild(option);
		});
	});

	const nip = document.querySelector('input[name="nip"]');
	nip.addEventListener('input', function() {
		const tahunSekarang = new Date().getFullYear();
		const tahunKerja = nip.value.substr(8, 4);
		masaKerja = tahunSekarang - parseInt(tahunKerja);
		document.querySelector('input[name="masa_kerja"]').value = masaKerja;
	});
</script>