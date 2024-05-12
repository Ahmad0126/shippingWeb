<div class="col-12">
	<div class="card">
		<div class="card-header d-flex justify-content-between">
            <span>
                Pengiriman <strong><?= $pengiriman->kode_pengiriman ?></strong>
            </span>
			<span>
                <strong>Status:</strong> <?= ucfirst($pengiriman->status) ?>
            </span>
		</div>
        <hr class="m-0">
		<div class="card-body">
			<div class="row mb-4">
				<div class="col-sm-6">
					<h6 class="mb-3">Pengirim:</h6>
					<?php if($pengiriman->nama_pengirim != null){ ?>
						<div>
							<strong><?= $pengiriman->nama_pengirim ?></strong>
						</div>
						<?php
							$alamat = explode('; ', $pengiriman->alamat_pengirim);
						?>
						<div><?= $alamat[0] ?></div>
						<div><?= $alamat[1] ?>, <?= $alamat[2] ?>, <?= substr($pengiriman->no_nota, 3, 5) ?></div>
						<div>No HP: <?= $pengiriman->no_hp_pengirim ?></div>
					<?php } ?>
				</div>
				<div class="col-sm-6">
					<h6 class="mb-3">Penerima:</h6>
					<div>
						<strong><?= $pengiriman->nama_penerima ?></strong>
					</div>
					<?php
						$alamat = explode('; ', $pengiriman->alamat_tujuan);
					?>
					<div><?= $alamat[0] ?></div>
					<div><?= $alamat[1] ?>, <?= $alamat[2] ?>, <?= $pengiriman->kode_pos ?></div>
					<div>No HP: <?= $pengiriman->no_hp_penerima ?></div>
				</div>
			</div>
			<div class="table-responsive-sm">
				<table class="table table-striped">
					<thead>
						<th>#</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Kantor</th>
						<th>Deskripsi</th>
					</thead>
					<?php $n=1; foreach($histori as $h){ ?>
					<tr>
						<td class="center"><?= $n++ ?></td>
						<td class="left strong"><?= $h->tanggal ?></td>
						<td class="left"><?= ucfirst($h->status) ?></td>
						<td class="right"><?= $h->fasilitas.' '.$h->kota ?></td>
						<td class="center"><?= $h->deskripsi ?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
			<div class="row">
				<div class="col-lg-4 col-12 ms-auto">
					<table class="table table-clear">
						<tbody>
							<tr>
								<td class="left">
									<strong>Layanan</strong>
								</td>
								<td class="right"><?= $pengiriman->nama_layanan ?></td>
							</tr>
							<tr>
								<td class="left">
									<strong>Tanggal Dikirim</strong>
								</td>
								<td class="right"><?= $pengiriman->tanggal_dikirim ?></td>
							</tr>
							<tr>
								<td class="left">
									<strong>Berat</strong>
								</td>
								<td class="right"><?= $pengiriman->berat ?> gram</td>
							</tr>
							<tr>
								<td class="left">
									<strong>Koli</strong>
								</td>
								<td class="right">
									<strong><?= $pengiriman->koli ?></strong>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-lg-4 col-12">
					<table class="table table-clear">
						<tbody>
							<tr>
								<td class="left">
									<strong>Deskripsi:</strong>
								</td>
							</tr>
							<tr>
								<td><?= $pengiriman->deskripsi ?></td>
							</tr>
							<tr>
								<td class="left">
									<strong>Instruksi Khusus:</strong>
								</td>
							</tr>
							<tr>
								<td><?= $pengiriman->instruksi_khusus ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-lg-4 col-12">
					<table class="table table-clear">
						<tr>
							<td><strong>Estimasi Tiba</strong></td>
							<td><?= $pengiriman->estimasi ?> hari</td>
						</tr>
						<tr>
							<td><strong>Biaya</strong></td>
							<td>Rp <?= number_format($pengiriman->ongkir) ?></td>
						</tr>
						<tr>
							<td><strong>Pembayaran</strong></td>
							<td><?= $pengiriman->pembayaran ?></td>
						</tr>
						<tr>
							<td><strong>Nota Terkait</strong></td>
							<td><a href="<?= base_url('pengiriman/nota?p='.$pengiriman->no_nota) ?>"><?= $pengiriman->no_nota ?></a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
