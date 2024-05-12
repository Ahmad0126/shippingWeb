<form action="<?= base_url('pengiriman/process') ?>" method="post">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informasi Pengirim</h4>
                    <div class="form-group">
                        <label>Nama Pengirim</label>
                        <input name="nama_penerima" type="text" class="form-control" placeholder="Nama Pengirim">
                    </div>
                    <div class="form-group">
                        <label>Alamat Pengirim</label>
                        <input name="alamat_tujuan[]" type="text" class="form-control" placeholder="Alamat">
                        <?php foreach ($pengiriman as $p) { ?>
                            <input type="hidden" name="kode_pengiriman[]" value="<?= $p->kode_pengiriman ?>">
                        <?php } ?>
                        <input class="_total" type="hidden" name="total" value="<?= $total ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Kota</label>
                            <input name="alamat_tujuan[]" type="text" class="form-control" placeholder="Kota">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Provinsi</label>
                            <input name="alamat_tujuan[]" type="text" class="form-control" placeholder="Provinsi">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Kode Pos</label>
                            <input name="kode_pos" type="number" class="form-control" placeholder="Kode Pos">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor Telepon</label>
                            <input name="no_hp_penerima" type="number" class="form-control" placeholder="Nomor Telepon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Pembayaran</h4>
                    <div class="form-group">
                        <label>Pilih Pembayaran</label>
                        <select class="form-control select-pembayaran" name="pembayaran">
                            <option value="tunai">Tunai</option>
                            <option value="kredit">Kartu Kredit</option>
                        </select>
                    </div>
                    <div class="div-tunai">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td>Rp <?= number_format($total) ?></td>
                                </tr>
                                <tr>
                                    <td>Bayar</td>
                                    <td><input type="number" palceholder="Uang Pembayaran" class="form-control bayar-inp"></td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Kembalian</td>
                                    <td class="text-dark"><strong class="kembalian-text"></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="div-kredit" style="display: none;">
                        <div class="form-group">
                            <label for="">Nomor Rekening</label>
                            <input class="form-control" type="text" placeholder="Nomor Rekening">
                        </div>
                        <div class="form-group">
                            <label for="">PIN</label>
                            <input class="form-control" type="password" placeholder="Masukkan PIN">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-1 mb-1 w-100">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col">
		<div class="card">
            <div class="card-body">
				<h4 class="card-title">Detail Pengiriman</h4>
				<div class="table-responsive">
					<table class="table mb-0">
						<thead>
							<tr>
								<th class="border-top-0">Deskripsi Barang</th>
								<th class="border-top-0">Berat</th>
								<th class="border-top-0">Layanan</th>
								<th class="border-top-0">Nama Penerima</th>
								<th class="border-top-0">Biaya</th>
							</tr>
						</thead>
						<tbody>
                            <?php foreach($pengiriman as $p){ ?>
							<tr>
								<td><?= $p->deskripsi ?></td>
								<td><?= $p->berat ?> gram</td>
								<td><?= $p->nama_layanan ?></td>
								<td><?= $p->nama_penerima ?></td>
								<td>Rp <?= number_format($p->ongkir) ?></td>
							</tr>
                            <?php } ?>
							<tr>
								<td>
									<h6>Total :</h6>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td class="text-dark"><strong>Rp <?= number_format($total) ?></strong></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>