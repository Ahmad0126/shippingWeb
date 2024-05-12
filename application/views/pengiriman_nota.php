<div class="row">
    <div class="col">
        <div class="card">
        <div class="card-header d-flex justify-content-between">
                <span>
                    No Nota <strong><?= $nota->no_nota ?></strong>
                </span>
                <span>
                    <?php 
                        $t = substr($nota->no_nota, 9, 6); 
                        $tanggal =  date('d-m-Y',strtotime($t));
                    ?>
                    <strong>Tanggal:</strong> <?= $tanggal ?>
                </span>
            </div>
            <hr class="m-0">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col">
                        <h6 class="mb-3">Pengirim:</h6>
                        <?php if($nota->nama_pengirim != null){ ?>
                            <div>
                                <strong><?= $nota->nama_pengirim ?></strong>
                            </div>
                            <?php
                                $alamat = explode('; ', $nota->alamat_pengirim);
                            ?>
                            <div><?= $alamat[0] ?></div>
                            <div><?= $alamat[1] ?>, <?= $alamat[2] ?>, <?= substr($nota->no_nota, 3, 5) ?></div>
                            <div>No HP: <?= $nota->no_hp_pengirim ?></div>
                        <?php } ?>
                    </div>
                </div>
				<h4 class="card-title">Daftar Pengiriman</h4>
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
								<td class="text-dark"><strong>Rp <?= number_format($nota->total) ?></strong></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>