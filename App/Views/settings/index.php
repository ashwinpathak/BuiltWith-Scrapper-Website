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

        textarea {
            resize: none;
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
            <h2 class="center">BuildWith Settings</h2>
            <hr />
            <?php if(isset($_SESSION['ref'])): ?>
                <div class="alert alert-warning center">
                    <p>By default we have already loaded dummy data. You can edit it below :)</p>
                    <?php unset($_SESSION['ref']); ?>
                </div>
            <?php endif; ?>
            <div class="alert alert-success center">
                <p>From here you can edit/config your website details.</p>
            </div>
            <?php if(isset($_SESSION['error'])): ?>
                <br />
                <div class="alert alert-danger">
                    <p><?=$_SESSION['error']; ?></p>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['success'])): ?>
                <br />
                <div class="alert alert-success">
                    <p><?=$_SESSION['success']; ?></p>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            <form action="config" method="POST">
                <fieldset>
                    <legend>Site Basic Details</legend>
                    <div class="form-group">
                        <label>Edit Site Name (e.g. BuildWith)</label>
                        <input type="text" class="form-control" name="site_name" placeholder="Site Name" value="<?=getSetting('site_name'); ?>" />
                    </div>
                    <div class="form-group">
                        <label>Edit Site Title</label>
                        <input type="text" class="form-control" name="site_title" placeholder="Site Title" value="<?=getSetting('site_title'); ?>" />
                        <small class="text-muted" style="font-style: italic;">Site title is the text which will display in the Browser Tabs.</small>
                    </div>
                    <div class="form-group">
                        <label>Edit Site Big Name</label>
                        <textarea class="form-control" name="site_big_name" placeholder="Site Big Name"><?=getSetting('site_big_name'); ?></textarea>
                        <small class="text-muted" style="font-style: italic;">Site big name will be displayed above <b>Search Box</b>. You can use HTML, CSS to customize it.</small>
                    </div>
                    <div class="form-group">
                        <label>Edit Site META Description</label>
                        <input type="text" class="form-control" name="meta_desc" placeholder="Site META Description" value="<?=getSetting('meta_desc'); ?>" />
                    </div>
                </fieldset>
                <br />
                <fieldset>
                    <legend>Change Domain/Homepage URL</legend>
                    <div class="form-group">
                        <label>Edit site Domain/Homepage URL (base url)</label>
                        <input type="url" class="form-control" name="base_url" placeholder="Site BASE URL" value="<?=getSetting('base_url'); ?>" />
                        <small class="text-muted" style="font-style: italic;">Only edit if you have entered wrong URL or if you are shifting on another domain.</small>
                    </div>
                </fieldset>
                <br />
                <fieldset>
                    <legend>Advertisement Banners</legend>
                    <div class="form-group">
                        <label>Ad Banner (780x90)</label>
                        <textarea class="form-control" name="site_ad_780x90" rows="4" placeholder="Add banner code 780x90"><?=getSetting('site_ad_780x90'); ?></textarea>
                        <small class="text-muted" style="font-style: italic;">Enter Advertisemtn banner code. You can use HTML, CSS as well as Javascript.</small>
                    </div>
                    <div class="form-group">
                        <label>Ad Banner (300x250)</label>
                        <textarea class="form-control" name="site_ad_300x250" rows="4" placeholder="Add banner code 300x250"><?=getSetting('site_ad_300x250'); ?></textarea>
                        <small class="text-muted" style="font-style: italic;">Enter Advertisemtn banner code. You can use HTML, CSS as well as Javascript.</small>
                    </div>
                </fieldset>
                <br />
                <fieldset>
                    <legend>Analytics &amp; Stats Code</legend>
                    <div class="form-group">
                        <label>Enter Analytics Code (e.g. Google Analytics or KissMetrics etc)</label>
                        <textarea class="form-control" name="google_analytics" rows="4" placeholder="Enter analytics code here"><?=getSetting('google_analytics'); ?></textarea>
                    </div>
                </fieldset>
                <br />
                <button type="submit" class="btn btn-success btn-lg btn-block">Update/Save Changes to site</button>
            </form>
        </div>
        <a href="<?=Route('/config/logout'); ?>" style="float: right;" class="btn btn-danger">Logout</a><br /><br /><br /><br /><br /><br />
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>