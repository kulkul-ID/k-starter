<?php
    $CI =&get_instance();
    $user = $CI->kulkul_auth->user();
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo asset_url('img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p><?php echo $user['full_name']; ?></p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
          <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="treeview">
      	<a href="#">
          <i class="fa fa-users"></i> <span>Users</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        	<li><a href="<?php echo admin_url('user'); ?>"><i class="fa fa-circle-o"></i> All Users</a></li>
        	<li><a href="<?php echo admin_url('user/form'); ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
        </ul>
      </li>
      <li class="treeview">
      	<a href="#">
          <i class="glyphicon glyphicon-wrench"></i> <span>Configuration</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
        	<li><a href="<?php echo admin_url('site-config/'); ?>"><i class="fa fa-circle-o"></i>All Configurations</a></li>
        	<li><a href="<?php echo admin_url('site-config/form'); ?>"><i class="fa fa-circle-o"></i> Add Configuration</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>