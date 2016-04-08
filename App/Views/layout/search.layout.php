    <section id="home" class="promo section offset-header">
        <div class="container text-center">
            <h2 class="title"><?=getSetting('site_big_name'); ?></h2>
            <div class="search-area">
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php foreach($_SESSION['error'] as $error): ?>
                            <p><?=$error; ?></p>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <form action="<?=Route('/'); ?>#details" method="GET" class="search-form">
                    <div class="form-group">
                        <input type="text" class="form-control search-box" name="u"<?php if(isset($data['site_url'])): echo ' value="' . strtolower($data['site_url']) . '"'; endif; ?> placeholder="e.g. google.com" spellcheck="false" />
                    </div>
                    <div class="btns">
                        <button type="submit" class="btn btn-cta-secondary search-btn">Check Now</button>
                        <a class="btn btn-cta-primary scrollto" href="#top10">View Top 10</a>
                    </div>
                </form>
            </div>
            <ul class="meta list-inline">
                <li>
                    <div class="ad-box-780-90">
                        <?=getSetting('site_ad_780x90'); ?>
                    </div>
                </li>
            </ul>
        </div>

        <div class="social-media" style="padding: 4px 0px;"></div>
    </section>