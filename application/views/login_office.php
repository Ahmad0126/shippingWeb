<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Masuk Kantor</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/quixlab/') ?>images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="<?= base_url('assets/quixlab/') ?>css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <h4 class="text-center">Masuk Kantor</h4>
                                <?= $this->session->flashdata('alert') ?>
                                <form action="<?= base_url('auth/login_office') ?>" method="post" class="mt-5 mb-3 login-input">
                                    <div class="form-group">
                                        <input name="kode_cabang" type="text" class="form-control" placeholder="Masukkan Kode Kantor">
                                    </div>
                                    <button type="submit" class="btn login-form__btn submit w-100">Masuk</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="<?= base_url('assets/quixlab/') ?>plugins/common/common.min.js"></script>
    <script src="<?= base_url('assets/quixlab/') ?>js/custom.min.js"></script>
    <script src="<?= base_url('assets/quixlab/') ?>js/settings.js"></script>
</body>
</html>





