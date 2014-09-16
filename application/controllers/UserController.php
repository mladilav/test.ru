<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        if($this->getRequest()->isPost()){
            $lang = $this->getRequest()->getPost('lang');
            if(empty($lang)){
                $request = new Zend_Controller_Request_Http();
                $lang = $request->getCookie('lang');
            }
            else{
                $request = new Zend_Controller_Request_Http();
                $this->getResponse()->setRawHeader(new Zend_Http_Header_SetCookie(
                    'lang', $lang, NULL, '/', $request->getServer('HTTP_HOST'), false, true
                ));}
        }
        else {
            $request = new Zend_Controller_Request_Http();
            $lang = $request->getCookie('lang');
        }

        $array = array();
        $part= new Application_Model_Part($array);
        $menu= new Application_Model_Menu();
        $this->view->lang = $lang;

        if($lang == "ua"){
            $this->view->layout()->part = $part->getUaPart();
            $this->view->layout()->auth = $menu->getAuthUa();
            $this->view->layout()->menu = $menu->getUaMenu();
        }
        else {
            $this->view->layout()->part = $part->getPart();
            $this->view->layout()->auth = $menu->getAuth();
            $this->view->layout()->menu = $menu->getMenu();
        }
    }

    public function indexAction()
    {
        // action bod


    }

    public function editAction()
    {


        if (Zend_Auth::getInstance()->getIdentity()) {

            $id = Zend_Auth::getInstance()->getIdentity()->id;

        } else { return;}
        $form = new Application_Form_Registration();
        $form->registration->setLabel('Сохранить');
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if ($lang == "ua") {
            $form->username->setLabel("Логін:");
            $form->password_rep->setLabel("Повторіть пароль:");
            $form->gender->setLabel("Стать:");
            $form->registration->setLabel("Зберегти");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'id' => $id,
                    'username' => (string)$form->getValue('username'),
                    'password' => md5($form->getValue('password')),
                    'email' => $form->getValue('email'),
                    'photo' => $form->getValue('photo'),
                    'group' => $form->getValue('group'),
                    'gender' => $form->getValue('gender'),
                    'letter' => $form->getValue('letter'),
                    'class' => $form->getValue('class'),
                );

                // Создаём объект модели

                $user = new Application_Model_DbTable_User();

                // Вызываем метод модели addMovie для вставки новой записи
                $user->updateUser($data);
                $this->_helper->redirector('index', 'index');
                // Используем библиотечный helper для редиректа на action = index

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        } else {
            // Если мы выводим форму, то получаем id фильма, который хотим обновить

            $users = new Application_Model_DbTable_User();


            $form->populate($users->getUser($id));


        }
    }

    public function deleteAction()
    {

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');

            if ($del == 'Да' || $del == 'Так') {

                $id = $this->getRequest()->getPost('id');
                $users = new Application_Model_DbTable_User();
                $users->deleteUser($id);
            }
            $this->_helper->redirector('settings', 'user');
        } else {

            $id = $this->_getParam('id');
            $users = new Application_Model_DbTable_User();

            // Достаём запись и передаём в view
            $this->view->user = $users->getUser($id);
        }
    }

    public function profileAction()
    {
        $id = $this->_getParam('id', 0);
        if($id == 0){$id = Zend_Auth::getInstance()->getIdentity()->id;}
        if ($id > 0) {
            $user = new Application_Model_DbTable_User();
            $this->view->user = $user->getUser($id);

            $result = new Application_Model_DbTable_Result();
            $results = $result->fetchAll($result->select()
                ->from('result')
                ->where('userId = ' . Zend_Auth::getInstance()->getIdentity()->id));
            $this->view->results = $results;
        }

    }

    public function addgroupsAction()
    {
        $form = new Application_Form_Addgroups();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if ($lang == "ua") {
            $form->name->setLabel("Назва російською:");
            $form->nameUa->setLabel("Назва українською:");
            $form->add->setLabel("Додати групу");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

                $data = array('name' => $form->getValue('name'), 'nameUa' => $form->getValue('nameUa'));
                $groups = new Application_Model_DbTable_Groups();
                $groups->addGroups($data);
                $this->_helper->redirector('settings', 'user');

            } else {
                $form->populate($formData);
            }
        }
    }

    public function editgroupsAction()
    {
        $form = new Application_Form_Addgroups();
        $form->add->setLabel('Сохранить');
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if ($lang == "ua") {
            $form->name->setLabel("Назва російською:");
            $form->nameUa->setLabel("Назва українською:");
            $form->add->setLabel("Зберегти");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

                $data = array('id' => $form->getValue('id'), 'name' => $form->getValue('name'), 'nameUa' => $form->getValue('nameUa'));
                $groups = new Application_Model_DbTable_Groups();
                $groups->updateGroups($data);
                $this->_helper->redirector('settings', 'user');

            } else {

                $form->populate($formData);
            }
        } else {

            $id = $this->_getParam('id', 0);
            if ($id > 0) {

                $groups = new Application_Model_DbTable_Groups();
                $form->populate($groups->getGroups($id));
            }
        }
    }

    public function deletegroupsAction()
    {

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');

            if ($del == 'Да' || $del == 'Так') {

                $id = $this->getRequest()->getPost('id');
                $groups = new Application_Model_DbTable_Groups();
                $groups->deleteGroups($id);
            }
            $this->_helper->redirector('settings', 'user');
        } else {

            $id = $this->_getParam('id');
            $groups = new Application_Model_DbTable_Groups();

            // Достаём запись и передаём в view
            $this->view->groups = $groups->getGroups($id);
        }
    }

    public function settingsAction()
    {
        $group = new Application_Model_DbTable_Groups();
        $this->view->groups = $group->fetchAll();

        $users = new Application_Model_DbTable_User();
        $this->view->users = $users->fetchAll();

    }

    public function homeworkAction()
    {
        $homework = new Application_Model_DbTable_Homework();
        $page = (int)$this->getRequest()->getParam('page');
        if ($page > 0) {
            $this->view->paginator = $homework->getPaginatorRows($page);
        } else {
            $this->view->paginator = $homework->getPaginatorRows(1);
        }
    }

    public function addhomeworkAction()
    {
        date_default_timezone_set('Europe/Kiev');
        $form = new Application_Form_Addhomework();

        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if ($lang == "ua") {
            $form->name->setLabel("Назва російською:");
            $form->nameUa->setLabel("Назва українською:");
            $form->add->setLabel("Додати домашнє завдання");
        }
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {


                // закачка файла на сервер
                $file = $form->file->getFileInfo();
                $ext = split("[/\\.]", $file['file']['name']);
                $newName = 'homework' . date("His", time()) . '.' . $ext[count($ext) - 1];
                $fileUrl = '/uploads/' . date("d-m-Y", time()) . '/' . $newName;
                if (!file_exists('uploads/' . date("d-m-Y", time()))) {
                    mkdir('uploads/' . date("d-m-Y", time()), 0700);
                }
                $form->file->addFilter('Rename', realpath(dirname('.')) .
                    DIRECTORY_SEPARATOR .
                    'uploads/' . date("d-m-Y", time()) . '/' .
                    DIRECTORY_SEPARATOR .
                    $newName);
                $form->file->receive();


                if ($file['file']['name'] == NULL) {
                    $fileUrl = '';
                }
                $data = array(
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'file' => $fileUrl,
                    'text' => $form->getValue('text'),
                    'date' => time(),
                    'test' => '/test/question/test/' . $form->getValue('testId') . '/question/1'
                );

                // Создаём объект модели

                $homework = new Application_Model_DbTable_Homework();

                // Вызываем метод модели addMovie для вставки новой записи
                $homework->addHomework($data);
                $this->_helper->redirector('homework', 'user');


            } else {

                $form->populate($formData);
            }

        }
    }

    public function deletehomeworkAction()
    {

        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');

            if ($del == 'Да' || $del == 'Так') {

                $id = $this->getRequest()->getPost('id');
                $homework = new Application_Model_DbTable_Homework();
                $homework_array = $homework->getHomework($id);
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $homework_array['file'])) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $homework_array['file']);
                }
                $homework->deleteHomework($id);
            }
            $this->_helper->redirector('homework', 'user');
        } else {

            $id = $this->_getParam('id');
            $homework = new Application_Model_DbTable_Homework();
            // Достаём запись и передаём в view
            $this->view->homework = $homework->getHomework($id);
        }
    }

    public function sendhomeworkAction()
    {
        $id = $this->_getParam('id');
        if ($id > 0) {
            $form = new Application_Form_Sendhomework();

            $request = new Zend_Controller_Request_Http();
            $lang = $request->getCookie('lang');
            if ($lang == "ua") {
                $form->group->setLabel("Групі:");
                $form->add->setLabel("Надіслати");
            }
            $this->view->form = $form;

            if ($this->getRequest()->isPost()) {

                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {

                    $users = new Application_Model_DbTable_User();
                    $users_array = $users->fetchAll('groupId = '.$form->getValue('group'));
                    foreach($users_array as $user){
                        $send = new Application_Model_DbTable_Messege();
                        $data = array(
                            'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                            'userIdTo' => $user['id'],
                            'date' => time(),
                            'homeworkId' => $id,
                            'status' => 1,
                        );
                        $send->addMessege($data);

                    }
                    $this->_helper->redirector('homework', 'user');
                }
            }
        }
    }

    public function groupAction()
    {
        $id = $this->_getParam('id');
        if ($id > 0) {
            $users = new Application_Model_DbTable_User();
            $this->view->users = $users->fetchAll('groupId = ' . $id);
            $this->view->id = $id;
            $group = new Application_Model_DbTable_Groups();
            $this->view->group = $group->getGroups($id);
        }
    }

    public function deleteuserAction()
    {
        $id = $this->_getParam('id');
        $groupId = $this->_getParam('groupId');
        if ($id > 0 && $groupId > 0) {
            $user = new Application_Model_DbTable_User();
            $data = array('id' => $id, 'group' => NULL, 'groupId' => NULL);
            $user->updateUser($data);
            $this->_helper->redirector->gotoUrl('/user/group/id/' . $groupId);

        }
    }

    public function addgroupsuserAction()
    {
        $id = $this->_getParam('id');

        if ($id > 0) {
            $this->view->id = $id;
            $group = new Application_Model_DbTable_Groups();
            $this->view->group = $group->getGroups($id);
            $user = new Application_Model_DbTable_User();
            $this->view->users = $user->fetchAll('groupId is NULL');

        }
    }

    public function adduserAction()
    {
        $id = $this->_getParam('id');
        $groupId = $this->_getParam('groupId');
        if ($id > 0 && $groupId > 0) {
            $user = new Application_Model_DbTable_User();
            $group = new Application_Model_DbTable_Groups();
            $groups = $group->getGroups($groupId);
            $name = $groups['name'];
            $data = array('id' => $id, 'group' => $name, 'groupId' => $groupId);
            $user->updateUser($data);
            $this->_helper->redirector->gotoUrl('/user/group/id/' . $groupId);

        }
    }

    public function messegeAction()
    {
        if(Zend_Auth::getInstance()->hasIdentity()){

           $table = new Application_Model_DbTable_Messege();
            $this->view->message = $table->fetchAll($table->select()->where('userIdTo = '.Zend_Auth::getInstance()->getIdentity()->id)
            ->order('date DESC '));

        }
        else $this->_helper->redirector->gotoUrl('/');
    }

    public function userhomeworkAction()
    {
        $id = $this->_getParam('id');
        $idMes = $this->_getParam('idMes');
        if ($id > 0)
        {
            $homework = new Application_Model_DbTable_Homework();
            $this->view->homework = $homework->getHomework($id);
            $data = array('id' => $idMes, 'status' => 0);
            $message = new Application_Model_DbTable_Messege();
            $message->updateMessege($data);

        }
    }
    public function messegesendAction(){
        $form = new Application_Form_Messegesend();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if ($lang == "ua") {
            $form->caption->setLabel("Тема:");
            $form->send->setLabel("Надіслати");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $email=new Application_Model_TEmail();

                $email->from_email = Zend_Auth::getInstance()->getIdentity()->email;

                $email->from_name = 'Автор '.Zend_Auth::getInstance()->getIdentity()->username;

                $email->to_email='mladilav2014@gmail.com';

                $email->to_name= 'Администратору';

                $email->subject= $form->getValue('caption');

                $email->type='text/html';

                $email->body='Тестовий лист в HTML.

                        <h1>Header 1 (Заголовок 1)</h1>

                        <h2>Header 2 (Заголовок 2)</h2>

                        <h3>Header 3 (Заголовок 3)</h3>

                        <h4>Header 4 (Заголовок 4)</h4>

                        <h5>Header 5 (Заголовок 5)</h5>

                        Тест: ІЇҐЭЄ іїґэє';

                if($email->send())

                    echo('HTML email - OK.<br>'); else

                    echo('HTML email - Error!<br>');

                /*$messege = '<table><tr><th>'.$form->getValue('caption').'</th></tr> ';
                $messege .= '<tr><td>'.$form->getValue('text').'</td></tr>';
                $messege .= '<tr><td>  oт '.Zend_Auth::getInstance()->getIdentity()->username.'</td></tr></table>';
               /* mail("dmitrikov_samuel@mail.ru", "New message", $messege, "From: webmaster@moregeo.com\r\n"
                    ."Reply-To: ".Zend_Auth::getInstance()->getIdentity()->username."@moregeo.com\r\n"
                    ."X-Mailer: PHP/" . phpversion());*/
               /* mail("mladi2010@yandex.ua", "New message", $messege, "From: ".Zend_Auth::getInstance()->getIdentity()->username."@moregeo.com\r\n"
                    ."Reply-To: webmaster@moregeo.com\r\n"
                    ."X-Mailer: PHP/" . phpversion());

                /*mail("it.oleh@mail.ru", "New message", $messege, "From: webmaster@moregeo.com\r\n"
                    ."Reply-To: ".Zend_Auth::getInstance()->getIdentity()->username."@moregeo.com\r\n"
                    ."X-Mailer: PHP/" . phpversion());*/


                }
                $this->_helper->redirector('profile', 'user');
            }
        }

}
