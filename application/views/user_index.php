<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <?= $this->session->flashdata('error'); ?>
                <div class="card-title d-flex justify-content-between">
                    <h4>Daftar User</h4>
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".modal-tambah">Tambah</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Domisili</th>
                                <th>No Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $n=1; foreach($user as $u): ?>
                            <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $u->username ?></td>
                                <td><?= $u->nama ?></td>
                                <td><?= $u->level ?></td>
                                <td><?= $u->kota ?></td>
                                <td><?= $u->telp ?></td>
                                <td>
                                    <button class="btn btn-primary edit-user" 
                                    data-id="<?= $u->id_user ?>"
                                    data-nama="<?= $u->nama ?>"
                                    data-level="<?= $u->level ?>"
                                    data-kota="<?= $u->kota ?>"
                                    data-telp="<?= $u->telp ?>"
                                    >Edit</button>
                                    <button class="btn btn-danger hapus-user" data-id="<?= $u->id_user ?>">Hapus</button>
                                    <button class="btn btn-warning reset-user" data-id="<?= $u->id_user ?>">Reset PW</button>
                                </td>
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
                                <input name="nama" id="nama" type="text" class="form-control" placeholder="Masukkan Nama">
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
                                <input name="kota" id="kota" type="text" class="form-control" placeholder="Masukkan Kota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-10">
                                <input name="telp" id="telp" type="number" class="form-control" placeholder="Masukkan No Telp">
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