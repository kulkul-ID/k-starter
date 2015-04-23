<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<head>
    <!-- robot speak -->    
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <?php echo chrome_frame(); ?>
    <?php echo view_port(); ?>
    <?php echo apple_mobile('black-translucent'); ?>
    <?php echo $meta; ?><!-- //loads data from $this->stencil->meta($args) in controller -->

    <!-- icons and icons and icons and icons and icons -->
    <?php echo favicons(); ?>

    <!-- crayons and paint -->  
    <?php echo add_css(array('bootstrap','style')); ?>
    <?php echo $css; ?><!-- //loads data from $this->stencil->css($args) in controller -->

    <!-- magical wizardry -->
    <?php //echo jquery('1.9.1'); ?>
    <?php echo add_js('jQuery-2.1.3.min.js'); ?>
    <?php echo shiv(); ?>
    <?php echo add_js(array('bootstrap.min')); ?>
    <?php echo $js; ?><!--  //loads page specific $this->stencil->js($args) from Controller (see docs) -->
</head>
<!-- $body_class will always be the class name -->
<body class="<?php echo $body_class; ?>">

    <header>
    <?php echo $header; ?>
    </header>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                <?php echo $content; ?><!-- This loads home_view -->
                </div>
                <div class="col-md-3">
                <?php echo $sidebar; ?><!-- This loads sidebar -->
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php echo $footer; ?>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>