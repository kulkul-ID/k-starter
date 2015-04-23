<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <?php echo view_port(); ?>
        <?php echo $css; ?>
        <?php echo shiv(); ?>
        <?php echo $js; ?>
    </head>
  <body class="skin-blue">
    <div class="wrapper">
      <!-- header -->
      <?php echo $header; ?>
      <!-- /header -->
      
      <!-- sidebar -->
      <?php echo $sidebar; ?>
      <!-- /sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small><?php echo $tagline; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
          </ol>
        </section>

        <!-- Main content -->
        <?php echo $content; ?>
        <!-- /Main content -->
      </div><!-- /.content-wrapper -->
      
    </div><!-- ./wrapper -->
  </body>
</html>
