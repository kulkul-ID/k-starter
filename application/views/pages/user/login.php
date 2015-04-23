<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h1><?php echo $title; ?></h1>
<?php if(isset($message)): ?>
<div class="alert alert-info">
    <?php echo $message; ?>
</div>
<?php endif; ?>
<?php if(isset($error)): ?>
<div class="alert alert-danger">
    <?php echo $error; ?>
</div>
<?php endif; ?>
<?php echo form_open( current_url(), '', 'role="form"' ); ?>
<div class="form-group">
    <?php echo form_label('Email'); ?>
    <?php echo form_input('email', '', 'class="form-control" placeholder="Email"'); ?>
</div>
<div class="form-group">
    <?php echo form_label('Password'); ?>
    <?php echo form_password('password', '', 'class="form-control" placeholder="Password"'); ?>
</div>
<button type="submit" class="btn btn-success">Login</button>
<p><a href="<?php echo site_url('user/reset-password'); ?>">I forgot my password</a></p>
<?php echo form_close(); ?>
