<?php
$namaGuru = $data['nama_guru'];
$evaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi WHERE nama_guru = '$namaGuru'");
$guru = mysqli_query($con, "SELECT * FROM tb_guru WHERE nama_guru = '$namaGuru'");

$statusEvaluasi = mysqli_num_rows($evaluasi) > 0 ? 'Sudah Terevaluasi' : 'Belum Terevaluasi';



?>
<div class="page-inner" style="margin-bottom: 5rem;">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<div class="row">
						<h6 class="text-center" id="typedText"><span></span></h6>
						<h6 class="text-center">MUTASI GURU PADA DINAS PENDIDIKAN KAB SINJAI DENGAN ALGORITMA K-MEANS</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<h6 class="text-center">Usulan Rekomendasi Mutasi</h6>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Nip</th>
								<th>Nama</th>
								<th>Satuan Pendidikan</th>
								<th>Jabatan</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($statusEvaluasi == 'Sudah Terevaluasi') :  ?>
								<div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
									<div class="toast-header">
										<svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
											<?php
											foreach ($evaluasi as $dataEvaluasi) {
												if ($dataEvaluasi['cluster'] == '1') {
													echo '<rect width="100%" height="100%" fill="#007aff"></rect>'; // Blue color for proposed
												} else {
													echo '<rect width="100%" height="100%" fill="#ff0000"></rect>'; // Red color for not proposed

												}
											}
											?>
										</svg>
										<strong class="me-auto"><button style="font-size: 8px;" type="button" class="btn btn-primary btn-sm position-relative">
												Pesan
												<span style="font-size: 8px;" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
													1
													<span class="visually-hidden">unread messages</span>
												</span>
											</button></strong>
										<small><i class="bi bi-patch-check"></i></small>
										<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
									</div>
								<?php endif; ?>
								<div class="toast-body">
									<?php
									foreach ($evaluasi as $dataEvaluasi) {
										if ($dataEvaluasi['cluster'] == '1') {
											echo 'Layak Mutasi';
										} else {
											echo 'Tidak Layak Mutasi';
										}
									}
									?>
								</div>
								</div>
								<?php foreach ($guru as $dataGuru) : ?>

									<tr>
										<td>#</td>
										<td><?= $dataGuru['nip'] ?></td>
										<td><?= $dataGuru['nama_guru'] ?></td>
										<td><?= $dataGuru['satuan_pendidikan'] ?></td>
										<td><?= $dataGuru['jabatan'] ?></td>
										<td><?= $statusEvaluasi; ?></td>
									</tr>
								<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>