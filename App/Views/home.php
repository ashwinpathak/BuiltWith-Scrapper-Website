<?php require_once __DIR__ . '/layout/header.layout.php'; ?>
<?php require_once __DIR__ . '/layout/menu.layout.php'; ?>
<?php require_once __DIR__ . '/layout/search.layout.php'; ?>

<?php if(isset($data['fetch'])): ?>
    <section id="details" class="about section">
        <div class="container">
            <h1 class="title text-center"><?=$data['site_url']; ?></h1>
            <div class="search-area">
                <?php for($i = 0; $i < count($data['fetch']); $i++): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><b><?=$data['fetch'][$i]['title']; ?></b></div>
                        <div class="panel-body">
                            <?php for($j = 0; $j < count($data['fetch'][$i]['descr']); $j++): ?>
                                <h4 style="color: #000;"><?=$data['fetch'][$i]['descr'][$j]; ?></h4>
                                <small><?=$data['fetch'][$i]['detail'][$j]; ?></small>
                                <hr />
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php endfor; ?>
                <center>
                <div class="ad-box-300-250" style="padding-top: 10px;">
                    <?=getSetting('site_ad_300x250'); ?>
                </div>
                </center>
            </div>
        </div>
    </section>
<?php else: ?>
    <section id="top10" class="about section">
        <div class="container">
            <h2 class="title text-center">Top 10 Searches</h2>
            <div class="search-area table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Website</th>
                            <th>Searches</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($data['top10']); $i++): ?>
                            <tr>
                                <td><a href="http://<?=$data['top10'][$i]['site_url']; ?>" target="_blank"><?=$data['top10'][$i]['site_url']; ?></a></td>
                                <td><span class="label label-primary"><?=$data['top10'][$i]['views']; ?></span></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php require_once __DIR__ . '/layout/footer.layout.php'; ?>