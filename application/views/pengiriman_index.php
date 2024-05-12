<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<?= $this->session->flashdata('error'); ?>
				<div class="card-title d-flex justify-content-between">
					<h4>Daftar Pengiriman</h4>
					<span>
						<button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
						<button class="btn btn-success checkout-btn" style="display: none;">Checkout</button>
						<button class="btn btn-success cck-btn">Checkout</button>
						<a class="btn btn-primary tambah-btn" href="<?= base_url('pengiriman/daftar') ?>">Pendaftaran</a>
					</span>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="pilihan" style="display: none;">Pilih</th>
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
							<form id="chot_pngrmn" action="<?= base_url('pengiriman/checkout') ?>" method="get">
								<?php 
									$n=1; 
									foreach($pengiriman as $p): 
										$kota = explode('; ', $p->alamat_tujuan);
								?>
								<tr>
									<td class="pilihan" style="display: none;">
										<?php if($p->status == 'registered'){ ?>
										<input class="ids" type="checkbox" name="kode_pengiriman[]" value="<?= $p->kode_pengiriman ?>">
										<?php } ?>
									</td>
									<td><?= $n++ ?></td>
									<td><?= $p->kode_pengiriman ?></td>
									<td><?= $p->nama_penerima ?></td>
									<td><?= $kota[1] ?></td>
									<td><?= $p->tanggal_dikirim ?></td>
									<td><?= $p->nama_layanan ?></td>
									<td><?= strtoupper($p->status) ?></td>
									<td>
										<a href="<?= base_url('pengiriman/detail?p='.$p->kode_pengiriman) ?>">
											Detail<i class="fa fa-arrow-up-right-from-square"></i>
										</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
