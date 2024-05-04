<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<?= $this->session->flashdata('error'); ?>
				<div class="card-title d-flex justify-content-between">
					<h4>Daftar User</h4>
					<span>
						<button class="btn btn-secondary batal-btn" style="display: none;">Batal</button>
						<button class="btn btn-success ok-btn" style="display: none;">OK</button>
						<div class="btn-group">
							<button class="btn btn-primary" type="button" data-toggle="modal" data-target=".modal-tambah">Tambah</button>
							<button type="button" class="btn btn-primary tambah-btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false"></button>
							<div class="dropdown-menu" x-placement="bottom-start">
								<a class="dropdown-item edit-btn" style="font-size: 0.875rem;" data-obj="user">
									<i class="fa fa-pencil text-primary m-r-5"></i>
									Edit User
								</a> 
                                <a class="dropdown-item hapus-btn" style="font-size: 0.875rem;">
									<i class="fa fa-trash text-danger m-r-5"></i>
									Hapus User
								</a> 
                                <a class="dropdown-item reset-btn" style="font-size: 0.875rem;">
									<i class="fa fa-refresh text-warning m-r-5"></i>
									Reset PW User
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
								<th>Username</th>
								<th>Nama</th>
								<th>Status</th>
								<th>Domisili</th>
								<th>No Telp</th>
							</tr>
						</thead>
						<tbody>
							<?php $n=1; foreach($user as $u): ?>
							<tr>
								<td class="pilihan" style="display: none;"><input class="ids" type="checkbox" value="<?= $u->id_user ?>"></td>
								<td><?= $n++ ?></td>
								<td><?= $u->username ?></td>
								<td class="nama"><?= $u->nama ?></td>
								<td class="level"><?= $u->level ?></td>
								<td class="kota"><?= $u->kota ?></td>
								<td class="telp"><?= $u->telp ?></td>
								<td>
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
				<h5 class="modal-title">Tambahkan User</h5>
				<button type="button" class="close" data-dismiss="modal"><span>×</span>
				</button>
			</div>
			<form action="<?= base_url('user/tambah') ?>" method="post">
				<div class="modal-body">
					<div class="basic-form">

						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Username</label>
							<div class="col-sm-10">
								<input name="username" type="text" class="form-control" placeholder="Buat Username">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Password</label>
							<div class="col-sm-10">
								<input name="password" type="password" class="form-control" placeholder="Buat Password">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input name="nama" type="text" class="form-control" placeholder="Masukkan Nama">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Status</label>
							<div class="col-sm-10">
								<select name="level" class="custom-select mr-sm-2">
									<option value="Admin">Admin</option>
									<option value="Kasir">Kasir</option>
									<option value="Officer">Officer</option>
									<option value="Kurir">Kurir</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Domisili</label>
							<div class="col-sm-10">
								<input name="kota" type="text" class="form-control" placeholder="Masukkan Kota">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">No Telp</label>
							<div class="col-sm-10">
								<input name="telp" type="number" class="form-control" placeholder="Masukkan No Telp">
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
				<h5 class="modal-title">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal"><span>×</span>
				</button>
			</div>
			<form action="<?= base_url('user/edit') ?>" method="post">
				<div class="modal-body">
					<div class="basic-form">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input name="nama" id="nama" type="text" class="form-control"
									placeholder="Masukkan Nama">
								<input name="id_user" id="id" type="hidden">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Status</label>
							<div class="col-sm-10">
								<select name="level" id="level" class="custom-select mr-sm-2">
									<option value="Admin">Admin</option>
									<option value="Kasir">Kasir</option>
									<option value="Officer">Officer</option>
									<option value="Kurir">Kurir</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Domisili</label>
							<div class="col-sm-10">
								<input name="kota" id="kota" type="text" class="form-control"
									placeholder="Masukkan Kota">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">No Telp</label>
							<div class="col-sm-10">
								<input name="telp" id="telp" type="number" class="form-control"
									placeholder="Masukkan No Telp">
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
