<?php
$alternatif_query = mysqli_query($con, "SELECT * FROM tb_kebutuhan WHERE id_sekolah = '$id_login'");

$dataEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi ORDER BY tahun_evaluasi ASC");

$layakMutasi = [];
$tidakLayakMutasi = [];

foreach ($dataEvaluasi as $dE) {
	if ($dE['cluster'] == '1') {
		$layakMutasi[] = $dE;
	} else {
		$tidakLayakMutasi[] = $dE;
	}
}

?>


<div class="page-inner">
	<div class="row">
		<section class="section">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Analisis Kebutuhan Sekolah</h5>
					<!-- <a href="?page=alternatif&act=add" class="btn btn-primary btn-sm text-white"><i class="fa fa-plus"></i> Kebutuhan</a> -->
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped" id="table1">
						<thead>
							<tr>
								<th rowspan="2">#</th>
								<th rowspan="2">NPSN</th>
								<th rowspan="2">Nama Sekolah</th>
								<th rowspan="2">Kecamatan</th>
								<th colspan="7" class="text-center">Kebutuhan Guru</th>
								<!-- <th rowspan="2">Opsi</th> -->
							</tr>
							<tr>
								<th>Matematika</th>
								<th>Penjaskes</th>
								<th>Bahasa Indonesia</th>
								<th>Bahasa Inggris</th>
								<th>IPA</th>
								<th>IPS</th>
								<th>Seni Budaya</th>
								<th>Agama</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = mysqli_fetch_assoc($alternatif_query)) {
							?>
								<tr class="text-center">
									<td>
										<a class="btn btn-primary btn-sm" href="?page=kebutuhan&act=edit&id=<?= $row['id_sekolah'] ?>"><i class="far fa-edit"></i> Usulan</a>
									</td>
									<td><?= htmlspecialchars($row['npsn'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['nama_sekolah'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['kecamatan'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['guru_matematika'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['guru_penjaskes'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['guru_bahasa_indonesia'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['guru_bahasa_ingris'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['guru_ipa'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['guru_ips'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['guru_seni_budaya'] ?? ''); ?></td>
									<td><?= htmlspecialchars($row['guru_agama'] ?? ''); ?></td>
									<!-- <td>
									</td> -->
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>

				</div>
			</div>
		</section>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<section class="section">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Rekomendasi Guru</h5>
				</div>
				<div class="card-body table-responsive">
					<table class="table table-striped" id="guru">
						<thead>
							<tr>
								<th>NIP</th>
								<th>Nama Guru</th>
								<th>Satuan Pendidikan</th>
								<th>Jabatan</th>
								<th>Foto</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$query = "SELECT 
								npsn,
								nama_sekolah,
								SUM(guru_matematika) AS matematika,
								SUM(guru_penjaskes) AS penjaskes,
								SUM(guru_bahasa_indonesia) AS bahasa_indonesia,
								SUM(guru_bahasa_ingris) AS bahasa_inggris,
								SUM(guru_ipa) AS ipa,
								SUM(guru_ips) AS ips,
								SUM(guru_seni_budaya) AS seni_budaya,
								SUM(guru_agama) AS agama
								FROM tb_kebutuhan WHERE id_sekolah = '$id_login'
								GROUP BY npsn, nama_sekolah";

							$result = mysqli_query($con, $query);

							if ($result) {
								$available = false;

								while ($row = mysqli_fetch_assoc($result)) {
									if (
										$row['matematika'] > 0 || $row['penjaskes'] > 0 || $row['bahasa_indonesia'] > 0 ||
										$row['bahasa_inggris'] > 0 || $row['ipa'] > 0 || $row['ips'] > 0 ||
										$row['seni_budaya'] > 0 || $row['agama'] > 0
									) {
										$status = "Tersedia";

										$columns = [];
										if ($row['matematika'] > 0) $columns[] = "Guru Matematika";
										if ($row['penjaskes'] > 0) $columns[] = "Guru Penjaskes";
										if ($row['bahasa_indonesia'] > 0) $columns[] = "Guru Bahasa Indonesia";
										if ($row['bahasa_inggris'] > 0) $columns[] = "Guru Bahasa Inggris";
										if ($row['ipa'] > 0) $columns[] = "Guru IPA";
										if ($row['ips'] > 0) $columns[] = "Guru IPS";
										if ($row['seni_budaya'] > 0) $columns[] = "Guru Seni Budaya";
										if ($row['agama'] > 0) $columns[] = "Guru Agama";

										foreach ($columns as $column) {
											$jabatanTersedia = $column;
											$guruTersedia = mysqli_query($con, "SELECT * FROM tb_guru WHERE jabatan = '$jabatanTersedia'");
											foreach ($guruTersedia as $gT) {
												$namaGuru = $gT['nama_guru'];
												foreach ($layakMutasi as $lM) {
													if ($lM['nama_guru'] == $namaGuru) {
														$nama = $lM['nama_guru'];
														$data = mysqli_query($con, "SELECT * FROM tb_guru WHERE nama_guru = '$nama'");
														while ($d = mysqli_fetch_assoc($data)) {
															$nip = $d['nip'];
															$nama = $d['nama_guru'];
															$satuan_pendidikan = $d['satuan_pendidikan'];
															$jabatan = $d['jabatan'];
															$foto = $d['foto'];

															echo "
																<tr>
																	<td>$nip</td>
																	<td>$nama</td>
																	<td>$satuan_pendidikan</td>
																	<td>$jabatan</td>
																	<td>
																		<img src='../assets/img/user/$foto' width='45' height='45'>
																	</td>
																</tr>";
														}
													}
												}

												if ($layak) {
													$layakMutasi[] = $gT;
												} else {
													$tidakLayakMutasi[] = $gT;
												}
											}
										}

										$available = true;
									}
								}

								if (!$available) {
									$status = "Tidak Tersedia";
								}
							} else {
								echo "Error: " . mysqli_error($con);
							}

							?>
						</tbody>
					</table>

				</div>
			</div>
		</section>
	</div>
</div>