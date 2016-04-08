<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to BuildWith Installation Wizard.</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <style type="text/css">

        body {
            background-color: #eee;
            padding-top: 70px;
        }

        .center {
            text-align: center;
        }

        @media(min-width: 800px) {
            .container {
                width: 600px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="well well-lg">
            <h2 class="center">BuildWith Installer</h2>
            <hr />
            <div class="alert alert-success">
                <p>Welcome to the Installer, let us start by setting a Username &amp; Password and Homepage URL. Using which you can configure or edit details your website.</p>
            </div>
            <form action="install" method="POST" class="frm">
                <?php if(isset($_SESSION['install_error'])): ?>
                    <div class="alert alert-danger">
                        <?=$_SESSION['install_error'];unset($_SESSION['install_error']); ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Choose a username:</label>
                    <input type="text" class="form-control username" name="username" placeholder="Username" maxlength="20" />
                </div>
                <div class="form-group">
                    <label>Choose a password:</label>
                    <input type="password" class="form-control password" name="password" placeholder="Password" maxlength="32" />
                </div>
                <div class="form-group">
                    <label>Enter Domain URL or Homepage URL (base url):</label>
                    <input type="url" class="form-control base_url" name="base_url" placeholder="Base/Homepage URL" required="required" />
                    <small class="text-muted" style="font-style: italic;">Example: http://youdomain.com</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-success btn-block">
                        Set my Username &amp; Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('.frm').on('submit', function() {
            if($.trim($('.username').val()).length > 20 || $.trim($('.username').val()).length <= 3) {
                alert('Username length must be greater than 3 characters and less than 20 characters.');
                return false;
            }

            if($.trim($('.password').val()).length > 32 || $.trim($('.password').val()).length <= 5) {
                alert('Password length must be greater than 5 characters and less than 32 characters.');
                return false;
            }

            if($.trim($('.base_url').val()) == '') {
                alert('Without domain/homepage URL the installation wont work. Please enter it.');
                return false;
            }
        });
    </script>
</body>
</html>