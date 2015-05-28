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
                            echo form_hidden('id', set_value('id', @$config->id));
                        ?>
                        <div class="form-group">
                            <?php echo form_label('Label'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                        'name'  => 'label',
                                        'value' => set_value('label', @$config->label),
                                        'placeholder' => 'label'
                                    )); 
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Config Item'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                        'name'  => 'item',
                                        'value' => set_value('item', @$config->item),
                                        'placeholder' => 'Config Item'
                                    )); 
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Item Index'); ?>
                            <?php 
                                echo form_input(array(
                                        'type'  => 'text',
                                        'class' => 'form-control',
                                        'name'  => 'index',
                                        'value' => set_value('index', @$config->index),
                                        'placeholder' => 'Item Index'
                                    )); 
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Value'); ?>
                            <?php echo form_textarea('value', set_value('value', @$config->value), 'class="form-control"'); ?>
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
