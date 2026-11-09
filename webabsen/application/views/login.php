<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - <?= title() ?></title>

    <link rel="shortcut icon" href="<?= theme() ?>dist/img/favicon.ico" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= theme() ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= theme() ?>bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= theme() ?>bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= theme() ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= theme() ?>plugins/iCheck/all.css">
    <!-- jQuery 3 -->
    <script src="<?= theme() ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= theme() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= theme() ?>plugins/iCheck/icheck.min.js"></script>
    <script src="<?= theme() ?>bower_components/jquery-ui/jquery-ui.js"></script>
    <script src="<?= theme() ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= theme() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= theme() ?>bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= theme() ?>plugins/iCheck/icheck.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('focusout', '.username', function(e) {
                formData = "&username=" + $('.username').val();
                $.ajax({
                    url: '<?= site_url('Usernamecek')  ?>',
                    type: "post",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        $('.error').html('');
                        if (response.status == true) {
                            $('.username').html("correct mail <i class='text-green fa fa-check'></i>");

                            $('.error').removeClass('text-red');
                            $('.error').addClass('text-green');
                            $('.usernameform').removeClass('has-feedback has-error');
                            $('.usernameform').addClass('has-success');

                        } else {
                            $('.error').removeClass('text-green');
                            $('.error').addClass('text-red');

                            $('.usernameform').removeClass('has-feedback has-success');
                            $('.usernameform').addClass('has-error');
                            $('.username').html("uncorrect mail <i class='text-red fa fa-close'></i>");
                        }
                    }

                });
            });
            $(document).on('focusout', '.password', function(e) {
                formData = "&username=" + $('.username').val() + "&password=" + $('.password').val();

                $.ajax({
                    url: '<?= site_url('Passwordcek')  ?>',
                    type: "post",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        $('.error').html('');
                        if (response.status == true) {
                            $('.password').html("correct password <i class='text-green fa fa-check'></i>");

                            $('.error').removeClass('text-red');
                            $('.error').addClass('text-green');
                            $('.passwordform').removeClass('has-feedback has-error');
                            $('.passwordform').addClass('has-success');

                            setTimeout(function() {
                                $('.btnLogin').click();
                            }, 1000)

                        } else {
                            $('.error').removeClass('text-green');
                            $('.error').addClass('text-red');

                            $('.passwordform').removeClass('has-feedback has-success');
                            $('.passwordform').addClass('has-error');
                            $('.password').html("uncorrect password <i class='text-red fa fa-close'></i>");
                        }
                    },
                        fail: function(xhr, textStatus, errorThrown){
                           console.log(xhr, textStatus, errorThrown);
                           alert('request failed');
                        }

                });
            });
            $(document).on('click', '.btnLogin', function(e) {
                formData = "&username=" + $('.username').val() + "&password=" + $('.password').val();
                $.ajax({
                    url: '<?= site_url('login')  ?>',
                    type: "post",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    beforeSend: function() {
                        $('.boxbuton').removeClass('col-xs-1');
                        $('.boxbuton').addClass('col-xs-2');
                        $('.btnLogin').attr('disabled', 'disabled');
                        $('.btnLogin').html('<i class="fa fa-spin fa-spinner"></i> Login Proses');
                    },
                    success: function(response) {
                        $('.error').html('');
                        $('.iconnotifie').removeClass('text-black fa-spin fa-spinner text-green fa-check text-red fa-close ');
                        if (response.status == true) {
                            //Munculkan_Notifikasi
                            $('#modal-Login-Eror').modal('show');
                            $('.iconnotifie').addClass('text-black fa-spin fa-spinner');
                            setTimeout(function() {
                                $('.iconnotifie').removeClass('text-black fa-spin fa-spinner');
                                $('.iconmesage').text('Login Success');
                                $('.iconnotifie').addClass('text-green fa-check ');
                            }, 1000);
                            //Tutup_Notifikasi
                            setTimeout(function() {
                                $('#modal-Login-Eror').modal('hide');
                                window.location.href = "<?= site_url('auth') ?>";
                            }, 2000);


                        } else {
                            $.each(response.pesan, function(i, m) {
                                $('.' + i).text(m);

                                //Munculkan_Notifikasi

                                $('#modal-Login-Eror').modal('show');
                                $('.iconnotifie').addClass('text-black fa-spin fa-spinner');
                                setTimeout(function() {
                                    $('.iconnotifie').removeClass('text-black fa-spin fa-spinner');
                                    $('.iconmesage').text('Login Filed');
                                    $('.iconnotifie').addClass('text-red fa-close ');
                                }, 1000);
                                //Tutup_Notifikasi
                                setTimeout(function() {
                                    $('#modal-Login-Eror').modal('hide');
                                }, 2000);
                            });
                        }
                    },
                    complete: function() {
                        $('.boxbuton').removeClass('col-xs-2');
                        $('.boxbuton').addClass('col-xs-1');
                        $('.btnLogin').removeAttr('disabled');
                        $('.btnLogin').html('<i class="fa fa-key"></i> Login');
                    }
                });
            });
        });
    </script>
    <style type="text/css">
        .rdbox {
            border-radius: 20px;
        }

        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;

        }

        .example-modal .modal {
            background: transparent !important;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="margin-top: 0px">
        <br><br>
        <div class="login-logo">
            <!-- <img src="<?= theme() ?>dist/img/Gunungmas/logo.jpeg" width="320px" height="180px"><br> -->
            <a style="font-size: 20pt;" href="<?= site_url() ?>"><b>Login</b>Admin</a>
        </div>
        <div class="login-box-body rdbox">
            <p class="login-box-msg">Silahkan masukkan akun Anda</p>
            <?= form_open('#', ['id' => 'form_login', 'class' => 'login-form']) ?>
            <div class="form-group usernameform has-feedback">
                <input type="email" name="username" class="form-control rdbox username" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <span class="error username text-red"></span>
            </div>
            <div class="form-group passwordform has-feedback">
                <input type="password" name="password" class="form-control rdbox password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span class="error password text-red"></span>
            </div>
            <div class="row">
                <div class="col-xs-7"></div>
                <div class="col-xs-1 boxbuton">
                    <button type="button" class="btn btn-primary rdbox pull-right btnLogin "><i class="fa fa-key"></i> Login</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
    <?php include('Notifications/loginEror_Notification.php'); ?>
</body>

</html>
