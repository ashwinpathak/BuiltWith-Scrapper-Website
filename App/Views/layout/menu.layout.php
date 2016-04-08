    <header id="header" class="header">  
        <div class="container">            
            <h1 class="logo pull-left">
                <a href="<?=Route('/'); ?>">
                    <span class="logo-title"><?=getSetting('site_name'); ?></span>
                </a>
            </h1>              
            <nav id="main-nav" class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="scrollto" href="#home">BuildWith?</a></li>
                        <li class="nav-item"><a href="<?=Route('/'); ?>">Home</a></li>
                        <li class="nav-item"><a href="<?=Route('/'); ?>#top10">Top 10</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>