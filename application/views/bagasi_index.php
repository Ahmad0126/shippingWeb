<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<?= $this->session->flashdata('error') ?>
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
								<th>Deskripsi Barang</th>
								<th>Nama Penerima</th>
								<th>Kota Tujuan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
