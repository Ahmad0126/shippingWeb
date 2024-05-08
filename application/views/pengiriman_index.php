<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<?= $this->session->flashdata('error'); ?>
				<div class="card-title d-flex justify-content-between">
					<h4>Daftar Pengiriman</h4>
					<a class="btn btn-primary" href="<?= base_url('pengiriman/daftar') ?>">Pendaftaran</a>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode Pengiriman</th>
								<th>Nama Penerima</th>
								<th>Kota Tujuan</th>
								<th>Tanggal Dikirim</th>
								<th>Layanan</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $n=1; foreach($pengiriman as $p): ?>
							<tr>
								<td><?= $n++ ?></td>
								<td><?= $p->kode_pengiriman ?></td>
								<td><?= $p->nama_penerima ?></td>
								<td><?= $p->alamat_tujuan ?></td>
								<td><?= $p->tanggal_dikirim ?></td>
								<td><?= $p->nama_layanan ?></td>
								<td><?= $p->status ?></td>
								<td></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
