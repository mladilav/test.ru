<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->redirector('login');
    }

    public function loginAction()
    {
        // проверяем, авторизирован ли пользователь
        if (Zend_Auth::getInstance()->hasIdentity()) {
            // если да, то делаем редирект, чтобы исключить многократную авторизацию
            $this->_helper->redirector('index', 'index');
        }

        // создаём форму и передаём её во view
        $form = new Application_Form_Login();
        $this->view->form = $form;

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                // Получаем адаптер подключения к базе данных
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());

                // указываем таблицу, где необходимо искать данные о пользователях
                // колонку, где искать имена пользователей,
                // а также колонку, где хранятся пароли
                $authAdapter->setTableName('users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password');

                // получаем введённые данные
                $username = $this->getRequest()->getPost('username');
                $password = $this->getRequest()->getPost('password');
                $password = md5($password);
                // подставляем полученные данные из формы
                $authAdapter->setIdentity($username)
                    ->setCredential($password);

                // получаем экземпляр Zend_Auth
                $auth = Zend_Auth::getInstance();

                // делаем попытку авторизировать пользователя
                $result = $auth->authenticate($authAdapter);

                // если авторизация прошла успешно
                if ($result->isValid()) {

                    // используем адаптер для извлечения оставшихся данных о пользователе
                    $identity = $authAdapter->getResultRowObject();

                    // получаем доступ к хранилищу данных Zend
                    $authStorage = $auth->getStorage();

                    // помещаем туда информацию о пользователе,
                    // чтобы иметь к ним доступ при конфигурировании Acl
                    $authStorage->write($identity);

                    // Используем библиотечный helper для редиректа
                    // на controller = index, action = index
                    $this->_helper->redirector('profile', 'user');
                } else {
                    $this->view->errMessage = 'Вы ввели неверное имя пользователя или неверный пароль';
                }
            }
        }
    }

    public function logoutAction()
    {
        // уничтожаем информацию об авторизации пользователя
        Zend_Auth::getInstance()->clearIdentity();

        // и отправляем его на главную
        $this->_helper->redirector('index', 'index');
    }

    public function registrationAction()
    {

        // проверяем, авторизирован ли пользователь

        if (Zend_Auth::getInstance()->hasIdentity()) {
            // если да, то делаем редирект, чтобы исключить многократную авторизацию
            $this->_helper->redirector('index', 'index');
        }

        // создаём форму и передаём её во view
        $form = new Application_Form_Registration();
        $this->view->form = $form;


        // Регистрация через контакт

        $client_id = '4445511'; // ID приложения
        $client_secret = 'kkzShivsClQAPAvN2gyx'; // Защищённый ключ
        $redirect_uri = 'http://test.ru/auth/regvk'; // Адрес сайта
        $url = 'http://oauth.vk.com/authorize';

        $params = array(
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code'
        );
        echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Регисрация через ВКонтакте</a></p>';


        // Регистрация через facebook
        $client_id = '885659381448025'; // Client ID
        $client_secret = '8bba37e25902a2cfa8d52e6493bfce6a'; // Client secret
        $redirect_uri = 'http://test.ru/auth/regfc'; // Redirect URIs

        $url = 'https://www.facebook.com/dialog/oauth';

        $params = array(
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'scope' => 'email,user_birthday'
        );

        echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Регистрация через Facebook</a></p>';


        //Регистрация через twitter
        define('CONSUMER_KEY', '53vY96EOcJaIhgRilJjd2RK2K');
        define('CONSUMER_SECRET', '5EaeGioAUOEdkpnF0Iq29enkNUn6u2HZMw3CUqEyC7twnXQiup');

        define('REQUEST_TOKEN_URL', 'https://api.twitter.com/oauth/request_token');
        define('AUTHORIZE_URL', 'https://api.twitter.com/oauth/authorize');
        define('ACCESS_TOKEN_URL', 'https://api.twitter.com/oauth/access_token');
        define('ACCOUNT_DATA_URL', 'https://api.twitter.com/1.1/users/show.json');

        define('CALLBACK_URL', 'http://test.ru/auth/regtw');


// формируем подпись для получения токена доступа
        define('URL_SEPARATOR', '&');

        $oauth_nonce = md5(uniqid(rand(), true));
        $oauth_timestamp = time();

        $params = array(
            'oauth_callback=' . urlencode(CALLBACK_URL) . URL_SEPARATOR,
            'oauth_consumer_key=' . CONSUMER_KEY . URL_SEPARATOR,
            'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
            'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
            'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
            'oauth_version=1.0'
        );

        $oauth_base_text = implode('', array_map('urlencode', $params));
        $key = CONSUMER_SECRET . URL_SEPARATOR;
        $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode(REQUEST_TOKEN_URL) . URL_SEPARATOR . $oauth_base_text;
        $oauth_signature = base64_encode(hash_hmac('sha1', $oauth_base_text, $key, true));


// получаем токен запроса
        $params = array(
            URL_SEPARATOR . 'oauth_consumer_key=' . CONSUMER_KEY,
            'oauth_nonce=' . $oauth_nonce,
            'oauth_signature=' . urlencode($oauth_signature),
            'oauth_signature_method=HMAC-SHA1',
            'oauth_timestamp=' . $oauth_timestamp,
            'oauth_version=1.0'
        );
        $url = REQUEST_TOKEN_URL . '?oauth_callback=' . urlencode(CALLBACK_URL) . implode('&', $params);

        $response = file_get_contents($url);
        parse_str($response, $response);

        $oauth_token = $response['oauth_token'];
        $oauth_token_secret = $response['oauth_token_secret'];


// генерируем ссылку аутентификации

        $link = AUTHORIZE_URL . '?oauth_token=' . $oauth_token;

        echo '<a href="' . $link . '">Регистрация Twitter</a>';

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $username = $form->getValue('username');
                $password = $form->getValue('password');
                $password_rep = $form->getValue('password_rep');
                $email = $form->getValue('email');
                $photo = $form->getValue('photo');
                $gender = $form->getValue('gender');
                $date_reg = time();
                $role = 'guest';
                $vk = '';
                $fc = '';
                $tw = '';

                // Создаём объект модели

                $user = new Application_Model_DbTable_User();


                // Вызываем метод модели addMovie для вставки новой записи
                $user->addUsers($username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw);

                // Используем библиотечный helper для редиректа на action = index
                $this->authreg($username, $password);

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }


    public function regvkAction()
    {

        // проверяем, авторизирован ли пользователь

        if (Zend_Auth::getInstance()->hasIdentity()) {
            // если да, то делаем редирект, чтобы исключить многократную авторизацию
            $this->_helper->redirector('index', 'index');
        }

        $client_id = '4445511'; // ID приложения
        $client_secret = 'kkzShivsClQAPAvN2gyx'; // Защищённый ключ
        $redirect_uri = 'http://test.ru/auth/regvk'; // Адрес сайта
        $url = 'http://oauth.vk.com/authorize';

        $params = array(
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code'
        );

        if (isset($_GET['code'])) {
            $result = false;
            $params = array(
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'code' => $_GET['code'],
                'redirect_uri' => $redirect_uri
            );

            $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

            if (isset($token['access_token'])) {
                $params = array(
                    'uids' => $token['user_id'],
                    'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
                    'access_token' => $token['access_token']
                );

                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['response'][0]['uid'])) {
                    $userInfo = $userInfo['response'][0];
                    $result = true;
                }
            }

            if ($result) {
                $user = new Application_Model_DbTable_User();
                if (Zend_Auth::getInstance()->hasIdentity()) {
                    $username = Zend_Auth::getInstance()->getIdentity()->username;
                    $vk = $userInfo['id'];
                    $fc = Zend_Auth::getInstance()->getIdentity()->fc;
                    $tw = Zend_Auth::getInstance()->getIdentity()->tw;
                    $password = Zend_Auth::getInstance()->getIdentity()->password;
                    $password_rep = Zend_Auth::getInstance()->getIdentity()->password;
                    $email = Zend_Auth::getInstance()->getIdentity()->email;
                    $photo = Zend_Auth::getInstance()->getIdentity()->photo;
                    $gender = Zend_Auth::getInstance()->getIdentity()->gender;
                    $date_reg = Zend_Auth::getInstance()->getIdentity()->date_reg;
                    $role = Zend_Auth::getInstance()->getIdentity()->role;
                    $id = Zend_Auth::getInstance()->getIdentity()->id;
                    $user->updateUser($id, $username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw);
                    $this->_helper->redirector('profile', 'user');
                } else {
                    $username = $userInfo['uid'];
                    $vk = $userInfo['uid'];
                    $fc = '';
                    $tw = '';
                    $password = md5($userInfo['uid']);
                    $password_rep = md5($userInfo['uid']);
                    $email = '';
                    $photo = $userInfo['photo_big'];
                    if ($userInfo['sex'] == 1) {
                        $gender = 'Female';
                    } else {
                        $gender = 'Male';
                    }
                    $date_reg = time();
                    $role = 'guest';
                    $user->addUsers($username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw);
                    $this->authreg($username, $password);
                }
            }
        }
    }


    public function regfcAction()
    {


        $client_id = '885659381448025'; // Client ID
        $client_secret = '8bba37e25902a2cfa8d52e6493bfce6a'; // Client secret
        $redirect_uri = 'http://test.ru/auth/regfc'; // Redirect URIs

        $url = 'https://www.facebook.com/dialog/oauth';

        $params = array(
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'scope' => 'email,user_birthday'
        );

        echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через Facebook</a></p>';

        if (isset($_GET['code'])) {
            $result = false;

            $params = array(
                'client_id' => $client_id,
                'redirect_uri' => $redirect_uri,
                'client_secret' => $client_secret,
                'code' => $_GET['code']
            );

            $url = 'https://graph.facebook.com/oauth/access_token';

            $tokenInfo = null;
            parse_str(file_get_contents($url . '?' . http_build_query($params)), $tokenInfo);

            if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
                $params = array('access_token' => $tokenInfo['access_token']);

                $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['id'])) {
                    $userInfo = $userInfo;
                    $result = true;
                }

            }
            if ($result) {
                $user = new Application_Model_DbTable_User();
                if (Zend_Auth::getInstance()->hasIdentity()) {
                    $username = Zend_Auth::getInstance()->getIdentity()->username;
                    $fc = $userInfo['id'];
                    $vk = Zend_Auth::getInstance()->getIdentity()->vk;
                    $tw = Zend_Auth::getInstance()->getIdentity()->tw;
                    $password = Zend_Auth::getInstance()->getIdentity()->password;
                    $password_rep = Zend_Auth::getInstance()->getIdentity()->password;
                    $email = Zend_Auth::getInstance()->getIdentity()->email;
                    $photo = Zend_Auth::getInstance()->getIdentity()->photo;
                    $gender = Zend_Auth::getInstance()->getIdentity()->gender;
                    $date_reg = Zend_Auth::getInstance()->getIdentity()->date_reg;
                    $role = Zend_Auth::getInstance()->getIdentity()->role;
                    $id = Zend_Auth::getInstance()->getIdentity()->id;
                    $user->updateUser($id, $username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw);
                    $this->_helper->redirector('profile', 'user');
                } else {
                    $username = $userInfo['id'];
                    $fc = $userInfo['id'];
                    $vk = '';
                    $tw = '';
                    $password = md5($userInfo['id']);
                    $password_rep = md5($userInfo['id']);
                    $email = $userInfo['email'];
                    $photo = 'http://graph.facebook.com/' . $userInfo['username'];
                    $gender = $userInfo['gender'];
                    $date_reg = time();
                    $role = 'guest';
                    $user->addUsers($username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw);
                    $this->authreg($username, $password);
                }


            }
        }
    }


    public function regtwAction()
    {

// определяем изначальные конфигурационные данные

        define('CONSUMER_KEY', '53vY96EOcJaIhgRilJjd2RK2K');
        define('CONSUMER_SECRET', '5EaeGioAUOEdkpnF0Iq29enkNUn6u2HZMw3CUqEyC7twnXQiup');

        define('REQUEST_TOKEN_URL', 'https://api.twitter.com/oauth/request_token');
        define('AUTHORIZE_URL', 'https://api.twitter.com/oauth/authorize');
        define('ACCESS_TOKEN_URL', 'https://api.twitter.com/oauth/access_token');
        define('ACCOUNT_DATA_URL', 'https://api.twitter.com/1.1/users/show.json');

        define('CALLBACK_URL', 'http://test.ru/auth/regtw');


// формируем подпись для получения токена доступа
        define('URL_SEPARATOR', '&');

        $oauth_nonce = md5(uniqid(rand(), true));
        $oauth_timestamp = time();

        $params = array(
            'oauth_callback=' . urlencode(CALLBACK_URL) . URL_SEPARATOR,
            'oauth_consumer_key=' . CONSUMER_KEY . URL_SEPARATOR,
            'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
            'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
            'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
            'oauth_version=1.0'
        );

        $oauth_base_text = implode('', array_map('urlencode', $params));
        $key = CONSUMER_SECRET . URL_SEPARATOR;
        $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode(REQUEST_TOKEN_URL) . URL_SEPARATOR . $oauth_base_text;
        $oauth_signature = base64_encode(hash_hmac('sha1', $oauth_base_text, $key, true));


// получаем токен запроса
        $params = array(
            URL_SEPARATOR . 'oauth_consumer_key=' . CONSUMER_KEY,
            'oauth_nonce=' . $oauth_nonce,
            'oauth_signature=' . urlencode($oauth_signature),
            'oauth_signature_method=HMAC-SHA1',
            'oauth_timestamp=' . $oauth_timestamp,
            'oauth_version=1.0'
        );
        $url = REQUEST_TOKEN_URL . '?oauth_callback=' . urlencode(CALLBACK_URL) . implode('&', $params);

        $response = file_get_contents($url);
        parse_str($response, $response);

        $oauth_token = $response['oauth_token'];
        $oauth_token_secret = $response['oauth_token_secret'];


// генерируем ссылку аутентификации

        $link = AUTHORIZE_URL . '?oauth_token=' . $oauth_token;

        echo '<a href="' . $link . '">Аутентификация через Twitter</a>';


        if (!empty($_GET['oauth_token']) && !empty($_GET['oauth_verifier'])) {
            // готовим подпись для получения токена доступа

            $oauth_nonce = md5(uniqid(rand(), true));
            $oauth_timestamp = time();
            $oauth_token = $_GET['oauth_token'];
            $oauth_verifier = $_GET['oauth_verifier'];


            $oauth_base_text = "GET&";
            $oauth_base_text .= urlencode(ACCESS_TOKEN_URL) . "&";

            $params = array(
                'oauth_consumer_key=' . CONSUMER_KEY . URL_SEPARATOR,
                'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
                'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
                'oauth_token=' . $oauth_token . URL_SEPARATOR,
                'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
                'oauth_verifier=' . $oauth_verifier . URL_SEPARATOR,
                'oauth_version=1.0'
            );

            $key = CONSUMER_SECRET . URL_SEPARATOR . $oauth_token_secret;
            $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode(ACCESS_TOKEN_URL) . URL_SEPARATOR . implode('', array_map('urlencode', $params));
            $oauth_signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

            // получаем токен доступа
            $params = array(
                'oauth_nonce=' . $oauth_nonce,
                'oauth_signature_method=HMAC-SHA1',
                'oauth_timestamp=' . $oauth_timestamp,
                'oauth_consumer_key=' . CONSUMER_KEY,
                'oauth_token=' . urlencode($oauth_token),
                'oauth_verifier=' . urlencode($oauth_verifier),
                'oauth_signature=' . urlencode($oauth_signature),
                'oauth_version=1.0'
            );
            $url = ACCESS_TOKEN_URL . '?' . implode('&', $params);

            $response = file_get_contents($url);
            parse_str($response, $response);


            // формируем подпись для следующего запроса
            $oauth_nonce = md5(uniqid(rand(), true));
            $oauth_timestamp = time();

            $oauth_token = $response['oauth_token'];
            $oauth_token_secret = $response['oauth_token_secret'];
            $screen_name = $response['screen_name'];

            $params = array(
                'oauth_consumer_key=' . CONSUMER_KEY . URL_SEPARATOR,
                'oauth_nonce=' . $oauth_nonce . URL_SEPARATOR,
                'oauth_signature_method=HMAC-SHA1' . URL_SEPARATOR,
                'oauth_timestamp=' . $oauth_timestamp . URL_SEPARATOR,
                'oauth_token=' . $oauth_token . URL_SEPARATOR,
                'oauth_version=1.0' . URL_SEPARATOR,
                'screen_name=' . $screen_name
            );
            $oauth_base_text = 'GET' . URL_SEPARATOR . urlencode(ACCOUNT_DATA_URL) . URL_SEPARATOR . implode('', array_map('urlencode', $params));

            $key = CONSUMER_SECRET . '&' . $oauth_token_secret;
            $signature = base64_encode(hash_hmac("sha1", $oauth_base_text, $key, true));

            // получаем данные о пользователе
            $params = array(
                'oauth_consumer_key=' . CONSUMER_KEY,
                'oauth_nonce=' . $oauth_nonce,
                'oauth_signature=' . urlencode($signature),
                'oauth_signature_method=HMAC-SHA1',
                'oauth_timestamp=' . $oauth_timestamp,
                'oauth_token=' . urlencode($oauth_token),
                'oauth_version=1.0',
                'screen_name=' . $screen_name
            );

            $url = ACCOUNT_DATA_URL . '?' . implode(URL_SEPARATOR, $params);

            $response = file_get_contents($url);
            $user_data = json_decode($response, true);
            $user = new Application_Model_DbTable_User();
            if (Zend_Auth::getInstance()->hasIdentity()) {
                $username = Zend_Auth::getInstance()->getIdentity()->username;
                $tw = $user_data['id'];
                $vk = Zend_Auth::getInstance()->getIdentity()->vk;
                $fc = Zend_Auth::getInstance()->getIdentity()->fc;
                $password = Zend_Auth::getInstance()->getIdentity()->password;
                $password_rep = Zend_Auth::getInstance()->getIdentity()->password;
                $email = Zend_Auth::getInstance()->getIdentity()->email;
                $photo = Zend_Auth::getInstance()->getIdentity()->photo;
                $gender = Zend_Auth::getInstance()->getIdentity()->gender;
                $date_reg = Zend_Auth::getInstance()->getIdentity()->date_reg;
                $role = Zend_Auth::getInstance()->getIdentity()->role;
                $id = Zend_Auth::getInstance()->getIdentity()->id;
                $user->updateUser($id, $username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw);
                $this->_helper->redirector('profile', 'user');
            } else {
                $username = $user_data['id'];
                $password = md5($user_data['id']);
                $password_rep = md5($user_data['id']);
                $tw = $user_data['id'];
                $vk = '';
                $fc = '';
                $password_rep = $user_data['id'];
                $email = '';
                $photo = $user_data['profile_image_url'];
                $gender = '';
                $date_reg = time();
                $role = 'guest';

                $user->addUsers($username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw);
                $this->authreg($username, $password);
            }
        }


    }


    public function authreg($username, $password)
    {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());

        // указываем таблицу, где необходимо искать данные о пользователях
        // колонку, где искать имена пользователей,
        // а также колонку, где хранятся пароли
        $authAdapter->setTableName('users')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password');
        // подставляем полученные данные из формы
        $authAdapter->setIdentity($username)
            ->setCredential($password);

        // получаем экземпляр Zend_Auth
        $auth = Zend_Auth::getInstance();

        // делаем попытку авторизировать пользователя
        $result = $auth->authenticate($authAdapter);

        // если авторизация прошла успешно
        if ($result->isValid()) {
            // используем адаптер для извлечения оставшихся данных о пользователе
            $identity = $authAdapter->getResultRowObject();

            // получаем доступ к хранилищу данных Zend
            $authStorage = $auth->getStorage();

            // помещаем туда информацию о пользователе,
            // чтобы иметь к ним доступ при конфигурировании Acl
            $authStorage->write($identity);

            // Используем библиотечный helper для редиректа
            // на controller = index, action = index

            $this->_helper->redirector('edit', 'user');
        }
    }
}