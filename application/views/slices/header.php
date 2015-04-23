<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $CI = &get_instance(); ?>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url(); ?>">K-Starter</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                <li><a href="<?php echo site_url('welcome/two-cols'); ?>">2-cols Layout</a></li>
            </ul>
            <?php if(!$CI->kulkul_auth->restart()): ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo site_url('user/login'); ?>">Login</a></li>
            </ul>
            <?php else: ?>
            <?php 
                $active_user = (object) $CI->kulkul_auth->user();
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $active_user->full_name ?>&nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php if($active_user->is_admin == 1): ?>
                        <li><a href="<?php echo site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="divider"></li>
                        <?php endif; ?>
                        <li><a href="<?php echo site_url('user/index'); ?>">Profile</a></li>
                        <li><a href="<?php echo site_url('user/update'); ?>">Update Profile</a></li>
                        <li><a href="<?php echo site_url('user/change-password'); ?>">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('user/logout'); ?>">Log out</a></li>
                    </ul>
                </li>
            </ul>
            <?php endif; ?>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
