<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ShippingWeb - Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/quixlab/') ?>images/favicon.png">
    <link href="<?= base_url('assets/quixlab/') ?>css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <h4 class="text-center mb-3">ShippingWeb</h4>
                                <?= $this->session->flashdata('username') ?>
                                <?= $this->session->flashdata('password') ?>
                                <form action="<?= base_url('auth/login/') ?>" method="post" class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input name="username" type="text" class="form-control" placeholder="Username" 
                                        <?= $this->session->flashdata('username') != null ? 'style="border-color: #ff5e5e;"' : '' ?>
                                        value="<?= $this->session->flashdata('username_val')?>">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" placeholder="Password"
                                        <?= $this->session->flashdata('password') != null ? 'style="border-color: #ff5e5e;"' : '' ?>>
                                    </div>
                                    <button class="btn login-form__btn submit w-100">LogIn</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?= base_url('assets/quixlab/') ?>plugins/common/common.min.js"></script>
    <script src="<?= base_url('assets/quixlab/') ?>js/custom.min.js"></script>
    <script src="<?= base_url('assets/quixlab/') ?>js/settings.js"></script>
    <script src="<?= base_url('assets/quixlab/') ?>js/gleek.js"></script>
    <script src="<?= base_url('assets/quixlab/') ?>js/styleSwitcher.js"></script>
</body>
</html>





