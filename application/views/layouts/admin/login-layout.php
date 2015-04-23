<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <?php echo view_port(); ?>
        <?php echo $css; ?>
        <?php echo shiv(); ?>
        <?php echo $js; ?>
        <script>
            $(function () {
                $('input').iCheck({
                  checkboxClass: 'icheckbox_square-blue',
                  radioClass: 'iradio_square-blue',
                  increaseArea: '20%'
                });
            });
        </script>
    </head>
    <body class="login-page">
        <?php echo $content; ?>
    </body>
</html>