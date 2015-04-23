<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h1><?php echo $title; ?></h1>
<?php if(isset($message)): ?>
<div class="alert alert-danger">
    <?php echo $message; ?>
</div>
<?php endif; ?>
<?php if(isset($error)): ?>
<div class="alert alert-danger">
    <?php echo implode('<br />', (array) $error); ?>
</div>
<?php endif; ?>
<?php echo form_open( current_url(), '', 'role="form"' ); ?>
<div class="form-group">
    <?php echo form_label('Full Name'); ?>
    <?php echo form_input('full_name', set_value('full_name'), 'class="form-control" placeholder="Full Name"'); ?>
</div>
<div class="form-group">
    <?php echo form_label('Email'); ?>
    <?php echo form_input('email', set_value('email'), 'class="form-control" placeholder="Email"'); ?>
</div>
<div class="form-group">
    <?php echo form_label('Password'); ?>
    <?php echo form_password('password', '', 'class="form-control" placeholder="Password"'); ?>
</div>
<button type="submit" class="btn btn-success">Register</button>
<?php echo form_close(); ?>
