<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li>
                <a href="<?= base_url() ?>" aria-expanded="false">
                    <i class="icon-home menu-icon"></i><span class="nav-text">Home</span>
                </a>
            </li>
            <?php $l = $this->session->userdata('level'); if( $l == 'Admin'){ ?>
            <li>
                <a href="<?= base_url('user') ?>" aria-expanded="false">
                    <i class="icon-user menu-icon"></i><span class="nav-text">User</span>
                </a>
            </li>
            <li class="nav-label">Inventaris</li>
            <?php } ?>
            <li>
                <a href="<?= base_url('cabang') ?>" aria-expanded="false">
                    <i class="icon-share menu-icon"></i><span class="nav-text">Cabang</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('layanan') ?>" aria-expanded="false">
                    <i class="icon-tag menu-icon"></i><span class="nav-text">Layanan</span>
                </a>
            </li>
            
            <?php if($l == 'Kasir' || $l == 'Kurir' || $l == 'Admin'){ ?>
            <li class="nav-label">Pengiriman</li>
            <?php } ?>
            <?php if($l == 'Kasir' || $l == 'Admin'){ ?>
            <li>
                <a href="<?= base_url('pengiriman') ?>" aria-expanded="false">
                    <i class="icon-paper-plane menu-icon"></i><span class="nav-text">Pengiriman</span>
                </a>
            </li>
            <?php } ?>
            <?php if($l == 'Kurir' || $l == 'Admin'){ ?>
            <li>
                <a href="<?= base_url('pickup') ?>" aria-expanded="false">
                    <i class="icon-basket menu-icon"></i><span class="nav-text">Pickup</span>
                </a>
            </li>
            <?php } ?>

            <?php if($l == 'Officer' || $l == 'Admin'){ ?>
            <li class="nav-label">Kantor</li>
            <li>
                <a href="<?= base_url('sorting') ?>" aria-expanded="false">
                    <i class="icon-directions menu-icon"></i><span class="nav-text">Sorting Center</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('gateway') ?>" aria-expanded="false">
                    <i class="icon-direction menu-icon"></i><span class="nav-text">Gateway</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('warehouse') ?>" aria-expanded="false">
                    <i class="icon-layers menu-icon"></i><span class="nav-text">Warehouse</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>