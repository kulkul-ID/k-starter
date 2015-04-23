<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h1><?php echo $title; ?></h1>
<?php if(isset($message)): ?>
<div class="alert alert-danger">
    <?php echo $message; ?>
</div>
<?php endif; ?>
<?php if(validation_errors()): ?>
<div class="alert alert-danger">
    <?php echo validation_errors(); ?>
</div>
<?php endif; ?>
<?php echo form_open( current_url(), '', 'role="form"' ); ?>
<div class="form-group">
    <?php echo form_label('Old Password'); ?>
    <?php echo form_password('old_password', '', 'class="form-control" placeholder="Old Password"'); ?>
</div>
<div class="form-group">
    <?php echo form_label('New Password'); ?>
    <?php echo form_password('password', '', 'class="form-control" placeholder="New Password"'); ?>
</div>
<div class="form-group">
    <?php echo form_label('Confirm New Password'); ?>
    <?php echo form_password('re_password', '', 'class="form-control" placeholder="Confirm New Password"'); ?>
</div>
<button type="submit" class="btn btn-success">Submit</button>
<a href="<?php echo site_url('user'); ?>" class="btn btn-info pull-right">Back</a>
<?php echo form_close(); ?>
