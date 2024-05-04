<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <?= $this->session->flashdata('error'); ?>
                <div class="card-title d-flex justify-content-between">
                    <h4>Daftar Cabang</h4>
                    <span>
						<button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
						<button class="btn btn-success ok-btn" style="display: none;">OK</button>
						<div class="btn-group">
							<button class="btn btn-primary" type="button" data-toggle="modal" data-target=".modal-tambah">Tambah</button>
							<button type="button" class="btn btn-primary tambah-btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"></button>
							<div class="dropdown-menu" x-placement="bottom-start">
								<a class="dropdown-item edit-btn" style="font-size: 0.875rem;" data-obj="cabang">
                                    <i class="fa fa-pencil text-primary m-r-5"></i>
									Edit Cabang
								</a> 
                                <a class="dropdown-item hapus-btn" style="font-size: 0.875rem;">
									<i class="fa fa-trash text-danger m-r-5"></i>
									Hapus Cabang
								</a> 
							</div>
						</div>
					</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="head">
								<th class="pilihan" style="display: none;">Pilih</th>
                                <th>#</th>
                                <th>Kode Cabang</th>
                                <th>Fasilitas</th>
                                <th>Kota</th>
                                <th>Kode Pos</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $n=1; foreach($cabang as $c): ?>
                            <tr>
                            <td class="pilihan" style="display: none;"><input class="ids" type="checkbox" value="<?= $c->id_cabang ?>"></td>
                                <td><?= $n++ ?></td>
                                <td><?= $c->kode_cabang ?></td>
                                <td class="fasilitas"><?= $c->fasilitas ?></td>
                                <td class="kota"><?= $c->kota ?></td>
                                <td class="kode_pos"><?= $c->kode_pos ?></td>
                                <td class="alamat"><?= $c->alamat ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Cabang</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <form action="<?= base_url('cabang/tambah') ?>" method="post">
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Cabang (Opsional)</label>
                            <div class="col-sm-10">
                                <input name="kode_cabang" type="number" class="form-control" placeholder="*Dibuat otomatis jika kosong">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fasilitas</label>
                            <div class="col-sm-10">
                                <select name="fasilitas" class="custom-select mr-sm-2">
                                    <option value="Warehouse">Warehouse</option>
                                    <option value="Office">Office</option>
                                    <option value="Sorting Center">Sorting Center</option>
                                    <option value="Gateway">Gateway</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Pos</label>
                            <div class="col-sm-10">
                                <input name="kode_pos" type="number" class="form-control" placeholder="Masukkan Kode Pos">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kota</label>
                            <div class="col-sm-10">
                                <input name="kota" type="text" class="form-control" placeholder="Masukkan Kota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input name="alamat" type="text" class="form-control" placeholder="Masukkan Alamat">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade modal-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Cabang</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <form action="<?= base_url('cabang/edit') ?>" method="post">
                <div class="modal-body">
                    <div class="basic-form">
                        <input name="id_cabang" id="id" type="hidden">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fasilitas</label>
                            <div class="col-sm-10">
                                <select name="fasilitas" id="fasilitas" class="custom-select mr-sm-2">
                                    <option value="Warehouse">Warehouse</option>
                                    <option value="Office">Office</option>
                                    <option value="Sorting Center">Sorting Center</option>
                                    <option value="Gateway">Gateway</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode Pos</label>
                            <div class="col-sm-10">
                                <input name="kode_pos" id="kode_pos" type="number" class="form-control" placeholder="Masukkan Kode Pos">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kota</label>
                            <div class="col-sm-10">
                                <input name="kota" id="kota" type="text" class="form-control" placeholder="Masukkan Kota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input name="alamat" id="alamat" type="text" class="form-control" placeholder="Masukkan Alamat">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>