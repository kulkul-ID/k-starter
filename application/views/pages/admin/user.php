<?php if(!defined('BASEPATH')) exit('No direct script access allowed!'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">All Users</h3>
                    <div class="pull-right box-tools">
						<a href="<?php echo admin_url('user/form') ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Add User">
							<i class="fa fa-plus"></i> Add User</a>
					</div>
                </div>
                <div class="box-body">
                    <?php if(isset($success)): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($error)): ?>
                    <div class="alert alert-success">
                        <?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    <table class="table data-table">
                    	<thead>
                    		<tr>
                    			<th>Full Name</th>
                    			<th>Email</th>
                    			<th>Admin</th>
                    			<th>Status</th>
                    			<th>Actions</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	<?php foreach($users as $user): ?>
                    		<tr>
                    			<td><?php echo $user->full_name; ?></td>
                    			<td><?php echo $user->email; ?></td>
                    			<td><?php echo ($user->is_admin == 1) ? 'Yep' : 'Nope' ; ?></td>
                    			<td><?php echo ($user->active == 1) ? 'Active' : 'Inactive' ; ?></td>
                    			<td>
                    				<a href="<?php echo admin_url('user/form/'.$user->id); ?>" class="btn btn-xs btn-info">Edit</a>
                    				<a href="<?php echo admin_url('user/deactivate/'.$user->id); ?>" class="btn btn-xs btn-warning">Deactivate</a>
                    				<a href="<?php echo admin_url('user/send-email/'.$user->id); ?>" class="btn btn-xs btn-success">Send Email</a>
                    			</td>
                    		</tr>
                    	<?php endforeach; ?>
                    	</tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                	<a href="<?php echo admin_url('user/form'); ?>" class="btn btn-sm btn-info">Add User</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
	$(function(){
		$('.data-table').dataTable();
	})
</script>
