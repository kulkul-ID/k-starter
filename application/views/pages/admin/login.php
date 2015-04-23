<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo site_url(); ?>">Administrator Panel</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Please login to access administrator panel.</p>
        <?php if(isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
        <?php endif; ?>
        <form action="<?php echo site_url('user/login'); ?>?redirect=admin&error=admin/login" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="email" class="form-control" placeholder="Email"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">    
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>                        
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
            </div>
        </form>
    <a href="<?php echo site_url('user/reset-password'); ?>">I forgot my password</a><br>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->