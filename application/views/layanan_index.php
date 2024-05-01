<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <?= $this->session->flashdata('error'); ?>
                <div class="card-title d-flex justify-content-between">
                    <h4>Daftar Layanan</h4>
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target=".modal-tambah">Tambah</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Layanan</th>
                                <th>Kapasitas</th>
                                <th>Waktu</th>
                                <th>Biaya</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $n=1; foreach($layanan as $l): ?>
                            <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $l->nama_layanan ?></td>
                                <td><?= $l->kapasitas ?> Kg</td>
                                <td><?= $l->waktu ?> Jam/Km</td>
                                <td>Rp <?= number_format($l->ongkir) ?> /Km</td>
                                <td>
                                    <button class="btn btn-primary edit-layanan" 
                                    data-id="<?= $l->id_layanan ?>"
                                    data-nama="<?= $l->nama_layanan ?>"
                                    data-kapasitas="<?= $l->kapasitas ?>"
                                    data-waktu="<?= $l->waktu ?>"
                                    data-ongkir="<?= $l->ongkir ?>"
                                    >Edit</button>
                                    <button class="btn btn-danger hapus-layanan" data-id="<?= $l->id_layanan ?>">Hapus</button>
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
                <h5 class="modal-title">Tambahkan Layanan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <form action="<?= base_url('layanan/tambah') ?>" method="post">
                <div class="modal-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Layanan</label>
                            <div class="col-sm-10">
                                <input name="nama_layanan" type="text" class="form-control" placeholder="Masukkan Nama Layanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kapasitas</label>
                            <div class="col-sm-10">
                                <input name="kapasitas" type="number" class="form-control" placeholder="Masukkan Kapasitas(Kg)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Perkiraan Waktu</label>
                            <div class="col-sm-10">
                                <input name="waktu" type="number" class="form-control" placeholder="Masukkan Waktu(jam/Km)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Biaya</label>
                            <div class="col-sm-10">
                                <input name="ongkir" type="number" class="form-control" placeholder="Masukkan Biaya(Rp/Km)">
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
                <h5 class="modal-title">Edit Layanan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <form action="<?= base_url('layanan/edit') ?>" method="post">
                <div class="modal-body">
                    <div class="basic-form">
                        <input name="id_layanan" id="id" type="hidden">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Layanan</label>
                            <div class="col-sm-10">
                                <input name="nama_layanan" id="nama" type="text" class="form-control" placeholder="Masukkan Nama Layanan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kapasitas</label>
                            <div class="col-sm-10">
                                <input name="kapasitas" id="kapasitas" type="number" class="form-control" placeholder="Masukkan Kapasitas(Kg)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Perkiraan Waktu</label>
                            <div class="col-sm-10">
                                <input name="waktu" id="waktu" type="number" class="form-control" placeholder="Masukkan Waktu(jam/Km)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Biaya</label>
                            <div class="col-sm-10">
                                <input name="ongkir" id="ongkir" type="number" class="form-control" placeholder="Masukkan Biaya(Rp/Km)">
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