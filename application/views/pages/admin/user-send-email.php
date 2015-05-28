<?php if(!defined('BASEPATH')) exit('No direct script access allowed!'); ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Compose new email</h3>
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
                    <?php echo form_open(); ?>
                        <div class="form-group">
                            <?php echo form_label('To'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                        'name'  => 'to',
                                        'value' => set_value('to', @$user->email),
                                        'placeholder' => 'To'
                                    )); 
                            ?>
                            <p class="help-block">More than 1 reciever, please separate by comma(,).</p>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('CC'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                        'name'  => 'cc',
                                        'value' => set_value('cc'),
                                        'placeholder' => 'CC'
                                    )); 
                            ?>
                            <p class="help-block">More than 1 reciever, please separate by comma(,).</p>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('BCC'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                        'name'  => 'bcc',
                                        'value' => set_value('bcc'),
                                        'placeholder' => 'BCC'
                                    )); 
                            ?>
                            <p class="help-block">More than 1 reciever, please separate by comma(,).</p>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Subject'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                        'name'  => 'subject',
                                        'value' => set_value('subject'),
                                        'placeholder' => 'Subject'
                                    )); 
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Message'); ?>
                            <?php echo form_textarea('body', set_value('body'), 'class="form-control wysiwyg"'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-envelope"></i> Send</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="box-footer clearfix">
                	<a href="<?php echo admin_url('user'); ?>" class="btn btn-warning">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function(){
        $('.wysiwyg').wysihtml5();
    })
</script>