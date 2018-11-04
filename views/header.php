<!DOCTYPE html>
<html lang="<?= $this->idioma; ?>">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->title; ?></title>
        <link rel="stylesheet" href="<?= URL; ?>public/css/spinner.css">
        <!-- BOOTSTRAP -->
        <link href="<?= URL; ?>public/css/bootstrap.min.css" rel="stylesheet">
        <!-- FONT AWESOME -->
        <link href="<?= URL; ?>public/css/font-awesome.min.css" rel="stylesheet">

        <!-- PREETTYPHOTO -->
        <link href="<?= URL; ?>public/css/prettyPhoto.css" rel="stylesheet">
        <!-- OWL CAROSEL -->
        <link href="<?= URL; ?>public/css/owl.carousel.css" rel="stylesheet">
        <link href="<?= URL; ?>public/css/owl.theme.css" rel="stylesheet">
        <link href="<?= URL; ?>public/css/owl.transitions.css" rel="stylesheet">
        <!-- PORTFOLIO GRID -->
        <link href="<?= URL; ?>public/bfassets/css/bootFolio.css" rel="stylesheet">
        <link href="<?= URL; ?>public/css/helper.css" rel="stylesheet">
        <!-- ICON -->
        <link href="<?= URL; ?>public/css/pe-icon-7-stroke.css" rel="stylesheet">
        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= URL; ?>public/images/favicon.png" />
        <!-- CUSTOM STYLE -->
        <link href="<?= URL; ?>public/css/style.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-22820445-4"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-22820445-4');
        </script>

    </head>

    <body>
        <div class="spinner_hol">
            <div class="spinner"> </div>
        </div>


        <!-- =========================
             START HEADER SECTION
        ============================== -->

        <header class="page home parallax home-parallax" id="HOME" data-type="parallax" data-animate-up="header-hide" data-animate-down="header-hide">
            <div class="header_overlay">
                <!-- Navbar Start -->
                <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-crafty-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            <a class="navbar-brand" href="index.html"><img src="<?= URL; ?>public/images/logo.png" alt="logo"> </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-crafty-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <?php foreach ($this->menu as $menu): ?>
                                    <?php if (empty($this->page)): ?>
                                        <li><a href="#<?= $menu['id_menu']; ?>"><?= utf8_encode($menu['menu']) ?></a></li>
                                    <?php else: ?>
                                        <li><a href="<?= URL; ?>#<?= $menu['id_menu']; ?>"><?= utf8_encode($menu['menu']) ?></a></li>
    <?php endif; ?>
<?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Navbar End -->