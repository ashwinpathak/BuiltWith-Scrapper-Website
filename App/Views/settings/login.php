<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$data['title']; ?></title>
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
            <h2 class="center">Login Panel</h2>
            <hr />
            <form action="<?=Route('/settings'); ?>" method="POST" class="frm">
                <?php if(isset($_SESSION['login_error'])): ?>
                    <div class="alert alert-danger">
                        <?=$_SESSION['login_error'];unset($_SESSION['login_error']); ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label>Enter your usename:</label>
                    <input type="text" class="form-control username" name="username" placeholder="Username" maxlength="20" />
                </div>
                <div class="form-group">
                    <label>Enter your password:</label>
                    <input type="password" class="form-control password" name="password" placeholder="Password" maxlength="32" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-success btn-block">
                        Login to my Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('.frm').on('submit', function() {
            if($.trim($('.username').val()) == '') {
                alert('Please enter correct Username.');
                return false;
            }

            if($.trim($('.password').val()) == '') {
                alert('Please enter correct Password.');
                return false;
            }
        });
    </script>
</body>
</html>