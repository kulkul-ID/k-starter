<?php defined('BASEPATH') or die('No direct script access allowed!'); ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">User Form</h3>
                </div>
                <div class="box-body">
                    <?php if(validation_errors()): ?>
                    <div class="alert alert-danger">
                        <?php echo validation_errors() ?>
                    </div>
                    <?php endif; ?>
                    <?php echo form_open(current_url(), 'role="form"') ?>
                        <?php
                            echo form_hidden('id', set_value('id', @$user->id));
                        ?>
                        <div class="form-group">
                            <?php echo form_label('Full Name'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                        'name'  => 'full_name',
                                        'value' => set_value('full_name', @$user->full_name),
                                        'placeholder' => 'Full Name'
                                    )); 
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Email'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'email',
                                        'class' => 'form-control',
                                        'name'  => 'email',
                                        'value' => set_value('email', @$user->email),
                                        'placeholder' => 'Email'
                                    )); 
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Password'); ?>
                            <?php 
                                echo form_password(array(
                                        'class' => 'form-control',
                                        'name'  => 'password',
                                        'placeholder' => 'Password'
                                    )); 
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Is Admin?'); ?>
                            <?php 
                                $is_admin_options = array(
                                    '0' => 'Nope',
                                    '1' => 'Yep'
                                    );

                                echo form_dropdown('is_admin', 
                                        $is_admin_options, 
                                        set_value('is_admin', @$user->is_admin),
                                        'class="form-control"'); 
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Active'); ?>
                            <?php 
                                $is_admin_options = array(
                                    '0' => 'No',
                                    '1' => 'Yes'
                                    );

                                echo form_dropdown('active', 
                                        $is_admin_options, 
                                        set_value('active', @$user->active),
                                        'class="form-control"'); 
                            ?>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </form>
                </div>
                <div class="box-footer clearfix">
                	
                </div>
            </div>
        </div>
    </div>
</section>
