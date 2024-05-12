<div class="col">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-0">Pendaftaran Pengiriman</h4>
        </div>
    </div>
</div>
<div class="col">
	<div class="card">
		<div class="card-body">
        <?= $this->session->flashdata('error'); ?>
			<div class="basic-form">
				<form action="<?= base_url('pengiriman/tambah') ?>" method="post">
					<div class="form-row">
						<div class="form-group col-lg-6">
                            <h4 class="card-title">Informasi Penerima</h4>
                            <div class="form-group">
                                <label>Nama Penerima</label>
							    <input name="nama_penerima" type="text" class="form-control" placeholder="Nama Penerima">
                            </div>
							<div class="form-group">
                                <label>Alamat Penerima</label>
							    <input name="alamat_tujuan[]" type="text" class="form-control" placeholder="Alamat">
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
						<div class="form-group col-lg-6">
                            <h4 class="card-title">Informasi Barang</h4>
                            <div class="form-group">
                                <label>Deskripsi Barang</label>
							    <input name="desc" type="text" class="form-control" placeholder="Deskripsi Barang">
                            </div>
							<div class="form-group">
                                <label>Layanan</label>
                                <select name="id_layanan" class="form-control">
                                    <?php foreach($layanan as $l){ ?>
                                    <option value="<?= $l->id_layanan ?>"><?= $l->nama_layanan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Berat Barang</label>
                                    <div class="input-group">
                                        <input name="berat" type="number" class="form-control" placeholder="Berat Barang">
                                        <div class="input-group-append">
                                            <span class="input-group-text">gram</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Koli</label>
                                    <input name="koli" type="number" class="form-control" placeholder="Koli">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Instruksi Khusus</label>
							    <input name="instruksi_khusus" type="text" class="form-control" placeholder="Instruksi Khusus">
                            </div>
						</div>
					</div>
					<div class="form-group">
						<div class="form-check">
							<input id="process" name="process" value="true" class="form-check-input" type="checkbox">
							<label for="process" class="form-check-label">Langsung Proses</label>
						</div>
					</div>
					<button type="submit" class="btn btn-dark">Daftarkan</button>
				</form>
			</div>
		</div>
	</div>
</div>
