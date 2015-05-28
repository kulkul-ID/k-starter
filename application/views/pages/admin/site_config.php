<?php if(!defined('BASEPATH')) exit('No direct script access allowed!'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title"></h3>
                    <div class="pull-right box-tools">
						<a href="<?php echo admin_url('site-config/form') ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Add User">
							<i class="fa fa-plus"></i> Add Config Item</a>
					</div>
                </div>
                <div class="box-body">
                    <?php if(isset($success)): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    <div class="alert alert-warning">
                        Becarefull for deleting and editing the configuration. It may causes system instable or unexpected error!
                    </div>
                    <table class="table data-table">
                    	<thead>
                    		<tr>
                    			<th>Label</th>
                    			<th>Item</th>
                    			<th>Index</th>
                    			<th>Value</th>
                    			<th>Actions</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	<?php foreach($configs as $config): ?>
                    		<tr>
                    			<td><?php echo $config->label; ?></td>
                    			<td><?php echo $config->item; ?></td>
                                <td><?php echo $config->index; ?></td>
                                <td><?php echo $config->value; ?></td>
                    			<td>
                    				<a href="<?php echo admin_url('site-config/form/'.$config->id); ?>" class="btn btn-xs btn-info">Edit</a>
                    				<a href="<?php echo admin_url('site-config/delete/'.$config->id); ?>" class="btn btn-xs btn-warning">Delete</a>
                    			</td>
                    		</tr>
                    	<?php endforeach; ?>
                    	</tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                	<a href="<?php echo admin_url('site-config/form'); ?>" class="btn btn-sm btn-info">Add Config Item</a>
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
