<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<?= $this->session->flashdata('error') ?>
				<div class="default-tab">
					<ul class="nav nav-tabs mb-3" role="tablist">
						<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#pickup">Pickup</a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#deliver">Deliver</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active show" id="pickup" role="tabpanel">
							<h4 class="card-title mb-3">Pickup Barang</h4>
							<form action="<?= base_url('pickup/pick_barang') ?>" method="post">
								<div class="input-group">
									<input type="text" name="kode" class="form-control" placeholder="Masukkan Kode">
									<div class="input-group-append">
										<button class="btn btn-primary">Ambil</button>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="deliver">
							<h4 class="card-title mb-3">Antarkan Barang</h4>
							<form id="dlv-form" action="<?= base_url('pickup/deliver') ?>" method="post">
								<div class="input-group">
									<input type="text" id="kode_pengiriman" name="kode" class="form-control" placeholder="Masukkan Kode">
									<div class="input-group-append">
										<button class="btn btn-primary">Antarkan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<div class="card-title d-flex justify-content-between">
					<h4>Bagasi</h4>
					<span>
						<input type="hidden" data-obj="pickup" class="edit-btn">
						<button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
						<button class="btn btn-success ok-btn" style="display: none;">OK</button>
						<button class="btn btn-success ok-dlv-btn" style="display: none;">OK</button>
						<button class="btn btn-primary dlv-btn">Antarkan</button>
						<button class="btn btn-warning hapus-btn">Batalkan</button>
					</span>
				</div>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th class="pilihan" style="display: none;">Pilih</th>
								<th>#</th>
								<th>Kode Pengiriman</th>
								<th>Deskripsi Barang</th>
								<th>Nama Penerima</th>
								<th>Alamat Tujuan</th>
							</tr>
						</thead>
						<tbody>
							<?php $n=1; foreach($barang as $b){ ?>
								<tr>
									<td class="pilihan" style="display: none;"><input class="ids" type="checkbox" value="<?= $b->kode_pengiriman ?>"></td>
									<td><?= $n++ ?></td>
									<td><?= $b->kode_pengiriman ?></td>
									<td><?= $b->deskripsi ?></td>
									<td><?= $b->nama_penerima ?></td>
									<td><?= $b->alamat_tujuan ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
