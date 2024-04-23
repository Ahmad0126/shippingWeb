<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?></title>
	<?php require_once('_css.php') ?>
</head>

<body>

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
	
    <div id="main-wrapper">
        <?php require_once('_navbar.php') ?>
        
        <?php require_once('_sidebar.php') ?>
        
        <div class="content-body">
			<div class="container-fluid mt-3">
            	<?= $contents ?>
			</div>
		</div>
        
        <?php require_once('_footer.php') ?>
		
    </div>
    
    <?php require_once('_js.php') ?>

</body>

</html>