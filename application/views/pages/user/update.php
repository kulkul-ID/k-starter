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
    <?php echo form_label('Full Name'); ?>
    <?php echo form_input('full_name', set_value('full_name', $user->full_name), 'class="form-control" placeholder="Full Name"'); ?>
</div>
<div class="form-group">
    <?php echo form_label('Email'); ?>
    <?php echo form_input('email', set_value('email', $user->email), 'class="form-control" placeholder="Email"'); ?>
</div>
<button type="submit" class="btn btn-success">Submit</button>
<a href="<?php echo site_url('user'); ?>" class="btn btn-info pull-right">Back</a>
<?php echo form_close(); ?>
