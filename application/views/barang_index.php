<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<?= $this->session->flashdata('error') ?>
				<div class="default-tab">
					<ul class="nav nav-tabs mb-3" role="tablist">
						<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#acc">Terima</a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fwd">Teruskan</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active show" id="acc" role="tabpanel">
							<h4 class="card-title mb-3">Terima Barang</h4>
							<div class="default-tab">
								<ul class="nav nav-tabs mb-3" role="tablist">
									<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#kode">Kode</a>
									</li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#fwdd">Diteruskan</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane fade active show" id="kode" role="tabpanel">
										<form action="<?= base_url($url.'/pick_barang') ?>" method="post">
											<div class="input-group">
												<input type="text" name="kode" class="form-control" placeholder="Masukkan Kode">
												<div class="input-group-append">
													<button class="btn btn-primary">Terima</button>
												</div>
											</div>
										</form>
									</div>
									<div class="tab-pane fade" id="fwdd">
										<span class="float-right">
											<button class="btn btn-secondary batal-acc-btn" style="display: none;">Batal</button>
											<button class="btn btn-success ok-acc-btn" style="display: none;">OK</button>
											<button class="btn btn-primary acc-btn">Terima</button>
										</span>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th class="slc-acc" style="display: none;">Pilih</th>
														<th>#</th>
														<th>Kode Pengiriman</th>
														<th>Deskripsi Barang</th>
														<th>Nama Penerima</th>
														<th>Alamat Tujuan</th>
													</tr>
												</thead>
												<tbody>
													<?php $n=1; foreach($forwarded as $f){ ?>
														<tr>
															<td class="slc-acc" style="display: none;"><input class="kodes" type="checkbox" value="<?= $f->kode_pengiriman ?>"></td>
															<td><?= $n++ ?></td>
															<td><?= $f->kode_pengiriman ?></td>
															<td><?= $f->deskripsi ?></td>
															<td><?= $f->nama_penerima ?></td>
															<td><?= $f->alamat_tujuan ?></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="fwd">
							<h4 class="card-title mb-3">Teruskan Ke Kantor lain</h4>
							<form action="<?= base_url($url.'/forward') ?>" method="post">
								<div class="form-row">
									<div class="form-group col-md-4">
										<input name="kode_cabang" type="text" class="form-control" placeholder="Masukkan Kode Kantor">
									</div>
									<div class="form-group col-md-8">
										<div class="input-group">
											<input type="text" name="kode_pengiriman" class="form-control" placeholder="Masukkan Kode Pengiriman">
											<div class="input-group-append">
												<button class="btn btn-primary" type="submit">Teruskan</button>
											</div>
										</div>
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
					<h4>Gudang</h4>
					<span>
						<input type="hidden" data-obj="<?= $url ?>" class="edit-btn">
						<button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
						<button class="btn btn-success ok-btn" style="display: none;">OK</button>
						<button class="btn btn-success show-fwd-btn" data-toggle="modal" data-target=".modal-fwd" style="display: none;">OK</button>
						<button class="btn btn-warning hapus-btn">Batalkan</button>
						<button class="btn btn-primary fwd-btn">Teruskan</button>
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
								<th>Aksi</th>
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
									<td></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-fwd" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Teruskan ke kantor</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <form action="<?= base_url($url.'/forward') ?>" method="post">
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Kantor</label>
                            <div class="col-sm-10">
                                <input name="kode_cabang" type="text" class="form-control" placeholder="Masukkan Kode Kantor">
                                <input id="kode_pengiriman" name="kode_pengiriman" type="hidden">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Teruskan</button>
                </div>
            </form>
        </div>
    </div>
</div>