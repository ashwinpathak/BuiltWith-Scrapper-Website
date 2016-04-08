<?php

Class Home extends BaseController
{
    public function index()
    {
        isCookie(); // checking whether cookie is enabled or not.

        if(getSetting('installed') == 'false')
            Redirect('install');

        // Top 10 List
        $top = new Top10($GLOBALS['pdo']);
        $list = $top->getTopList(10);

        if(isset($_COOKIE['s_key'])) {
            Redirect(Route('/error'));
        }

        if(isset($_GET['u'])) {

            if(isset($_SESSION['attempt'])) {
                if($_SESSION['attempt'] >= 7) {
                    setcookie('s_key', ('_' . str_shuffle('aqQwEzKlk')), (time() + 420), '/');
                    Redirect(Route('/error'));
                }
            }

            if(!empty($_GET['u'])) {

                $url = e($_GET['u']);

                $clean_url = check_url($url);

                if($clean_url !== false) {
                    $data = new BuildWith($clean_url);
                    $content = $data->getDetails();

                    if(isset($content[0])) {

                        if(isset($_SESSION['attempt']))
                            unset($_SESSION['attempt']);

                        if(isset($_SESSION['viewed_urls'])) {
                            if(!in_array($clean_url, $_SESSION['viewed_urls'])) {
                                if($top->addInList($clean_url))
                                    $_SESSION['viewed_urls'][] = $clean_url;
                            }
                        } else {
                            if($top->addInList($clean_url))
                                $_SESSION['viewed_urls'][] = $clean_url;
                        }

                        return $this->View('home', Array(
                            'title'     => 'Looking for ' . strtoupper($clean_url),
                            'site_url'  => strtoupper($clean_url),
                            'fetch'     => $content,
                            'top10'  => $list,
                        ));

                    } else {
                        $_SESSION['attempt'] = (isset($_SESSION['attempt'])) ? $_SESSION['attempt'] + 1 : 1;
                        $_SESSION['error'][] = 'Sorry, we are unable to find or fetch data. Please try again later.';
                        Redirect(Route('/'));
                    }

                } else {
                    $_SESSION['attempt'] = (isset($_SESSION['attempt'])) ? $_SESSION['attempt'] + 1 : 1;
                    $_SESSION['error'][] = 'Invalid/Incorrect website URL entered.';
                    Redirect(Route('/'));
                }
            } else {
                $_SESSION['attempt'] = (isset($_SESSION['attempt'])) ? $_SESSION['attempt'] + 1 : 1;
                $_SESSION['error'][] = 'No website/domain name entered.';
                Redirect(Route('/'));
            }
        }

        return $this->View('home', Array(
            'title' => getSetting('site_title'),
            'top10' => $list,
        ));
    }

    public function error()
    {
        if(getSetting('installed') == 'false')
            Redirect('install');

        if(!isset($_COOKIE['s_key']))
            Redirect(Route('/'));

        if(isset($_SESSION['attempt'])) {
            if($_SESSION['attempt'] >= 7) {
                unset($_SESSION['attempt']);
            }
        }

        return 'Oh! Pal, it seems like you have entered too many invalid/incorrect URL requests. Please try again later.';
    }

    public function cookie()
    {
        if(getSetting('installed') == 'false')
            Redirect('install');

        if(isset($_COOKIE['PHPSESSID'])) {
            Redirect(Route('/notfound'));
        }

        return '<h2>Cookie Not Enabled.</h2><p>Please enable cookie to use our service.</p>';
    }

    public function notfound()
    {
        if(getSetting('installed') == 'false')
            Redirect('install');

        isCookie(); // checking whether cookie is enabled or not.

        return '<h2>404 NOT FOUND</h2><p>The page you were loking is not available.</p>';
    }

    public function install()
    {
        isCookie(); // checking whether cookie is enabled or not.

        if(getSetting('installed') == 'true') {
            Redirect(Route('/notfound'));
        }

        if(request_method('post')) {
            if(isset($_POST['username'], $_POST['password'], $_POST['base_url'])) {

                $post = SanitizeArray($_POST);

                if(!empty($post['username']) && !empty($post['password']) && !empty($post['base_url'])) {                   
                    $uname = setSetting('uname', $post['username']);
                    $upass = setSetting('upass', $post['password']);
                    $b_url = rtrim($post['base_url'], '/');
                    $b_url = setSetting('base_url', $post['base_url']);

                    if($uname && $upass && $b_url) {
                        $installed = setSetting('installed', 'true');
                        $_SESSION['ref'] = 1;
                        $_SESSION['allow_config'] = 1;
                        Redirect('settings');
                    } else {
                        $_SESSION['install_error'] = 'Unkown error occured, please try again.';
                    }
                } else {
                    $_SESSION['install_error'] = 'All fields are required and cannot be left empty.';
                }
            }
        }

        return $this->View('installer/index', Array());
    }

    public function settings()
    {
        if(getSetting('installed') == 'false')
            Redirect('install');
        
        isCookie(); // checking whether cookie is enabled or not.

        if(isset($_SESSION['allow_config']))
            Redirect(Route('/config'));

        if(request_method('post')) {
            if(isset($_POST['username'], $_POST['password'])) {

                $post = SanitizeArray($_POST);

                if(!empty($post['username']) && !empty($post['password'])) {                   
                    $uname = getSetting('uname');
                    $upass = getSetting('upass');

                    if( $uname == $post['username'] && $upass == $post['password'] ) {
                        $_SESSION['allow_config'] = 1;
                        Redirect(Route('/config'));
                    } else {
                        $_SESSION['login_error'] = 'Invalid Username or Password entered.';
                    }


                } else {
                    $_SESSION['login_error'] = 'Username &amp; Password cannot be empty.';
                }
            }
        }

        return $this->View('settings/login', Array('title' => 'Login Panel.'));
    }

    public function config($logout = false)
    {
        if(getSetting('installed') == 'false')
            Redirect('install');

        if(!isset($_SESSION['allow_config']))
            Redirect(Route('/notfound'));

        if($logout == 'logout') {
            unset($_SESSION['allow_config']);
            Redirect(Route('/'));
        }

        if(request_method('post')) {
            $post = SanitizeArray($_POST);
            foreach($post as $key => $value) {
                
                $settings = setSetting($key, $value);

                if($settings == false) {
                    $_SESSION['error'] = 'Unexpected error occured, please try again.';
                    break;
                }
            }

            if(!isset($_SESSION['error']))
                $_SESSION['success'] = 'Settings saved successfully.';
        }

        return $this->View('settings/index', Array('title' => 'Edit Settings of BuildWith.'));
    }
}