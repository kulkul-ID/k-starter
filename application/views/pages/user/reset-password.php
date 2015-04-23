<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h1><?php echo $title; ?></h1>
<?php if(isset($info)): ?>
<div class="alert alert-info">
    <?php echo $info; ?>
</div>
<?php endif; ?>
<?php if(isset($error)): ?>
<div class="alert alert-danger">
    <?php echo $error; ?>
</div>
<?php endif; ?>
<div>
    <p>Please input your email and we will send your new password to your email.</p>
</div>
<?php echo form_open( current_url(), '', 'role="form"' ); ?>
<div class="form-group">
    <?php echo form_label('Email'); ?>
    <?php echo form_input('email', '', 'class="form-control" placeholder="Email"'); ?>
</div>
<button type="submit" class="btn btn-success">Reset My Password</button>
<?php echo form_close(); ?>
