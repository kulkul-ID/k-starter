<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h1><?php echo $title; ?></h1>

<?php if(isset($message)): ?>
<div class="alert alert-danger">
    <?php echo $message; ?>
</div>
<?php endif; ?>

<p>Full name: <?php echo $user['full_name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<p>Is admin: <?php echo ($user['is_admin'] == 1) ? 'Yep' : 'Nope'; ?></p>
<p>
    <a href="<?php echo site_url('user/update') ?>" class="btn btn-info">Update</a>
    <a href="<?php echo site_url('user/logout') ?>" class="btn btn-info">Logout</a>
</p>
