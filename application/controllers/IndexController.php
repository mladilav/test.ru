<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {

        $array = array();
        $category = new Application_Model_Category($array);
        $menu= new Application_Model_Menu();
        $test= new Application_Model_Tests($array);
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        $this->view->lang = $lang;

        if($lang == "ua"){
            $this->view->layout()->category = $category->getUaCategory();
            $this->view->layout()->auth = $menu->getAuthUa();
            $this->view->layout()->menu = $menu->getUaMenu();
            $this->view->layout()->test = $test->getUaTests();
        }
        else {
            $this->view->layout()->category = $category->getCategory();
            $this->view->layout()->auth = $menu->getAuth();
            $this->view->layout()->menu = $menu->getMenu();
            $this->view->layout()->test = $test->getTests();
        }
    }

    public function indexAction()
    {
        $post = new Application_Model_DbTable_Posts();
        $page = (int) $this->getRequest()->getParam('page');
        if ($page > 0) {
            $this->view->paginator = $post->getPaginatorRows($page);
        } else {
            $this->view->paginator = $post->getPaginatorRows(1);
        }
    }

    public function postAction()
    {
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            $post = new Application_Model_DbTable_Posts();
            $this->view->post= $post->getPost($id);
        }
    }

    public function addAction()
    {
        $form = new Application_Form_Add();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $form->title->setLabel("Назва російською:");
            $form->titleUa->setLabel("Назва українською:");
            $form->description->setLabel("Короткий опис російською:");
            $form->descriptionUa->setLabel("Короткий опис українською:");
            $form->bodyUa->setLabel("Текст українською:");
            $form->body->setLabel("Текст російською:");
            $form->add->setLabel("Додати статтю:");
        }

        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $categories = new Application_Model_DbTable_Category();
                $categories_ar = $categories->getCategory($form->getValue('category'));
                $data = array(
                    'title' => $form->getValue('title'),
                    'titleUa' => $form->getValue('titleUa'),
                    'description' => $form->getValue('description'),
                    'descriptionUa' => $form->getValue('descriptionUa'),
                    'body' => $form->getValue('body'),
                    'bodyUa' => $form->getValue('bodyUa'),
                    'categoryId' => $form->getValue('category'),
                    'category' => $categories_ar['name'],
                    'categoryUa' => $categories_ar['nameUa'],
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                    'user' => Zend_Auth::getInstance()->getIdentity()->username,
                    'date' => time(),
                    'icon' => $form->getValue('icon'),
                );
                // Создаём объект модели
                $post = new Application_Model_DbTable_Posts();

                // Вызываем метод модели addMovie для вставки новой записи
                $post->addPost($data);
                $this->_helper->redirector('index', 'index');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }


    public function editAction()
    {
        $form = new Application_Form_Add();

        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        $form->add->setLabel("Сохранить");
        if($lang == "ua"){
            $form->title->setLabel("Назва російською:");
            $form->titleUa->setLabel("Назва українською:");
            $form->description->setLabel("Короткий опис російською:");
            $form->descriptionUa->setLabel("Короткий опис українською:");
            $form->bodyUa->setLabel("Текст українською:");
            $form->body->setLabel("Текст російською:");
            $form->add->setLabel("Зберегти");
        }

        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();
            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $categories = new Application_Model_DbTable_Category();
                $categories_ar = $categories->getCategory($form->getValue('category'));
                $data = array(
                    'id' => (int)$form->getValue('id'),
                    'title' => $form->getValue('title'),
                    'titleUa' => $form->getValue('titleUa'),
                    'description' => $form->getValue('description'),
                    'descriptionUa' => $form->getValue('descriptionUa'),
                    'body' => $form->getValue('body'),
                    'bodyUa' => $form->getValue('bodyUa'),
                    'categoryId' => $form->getValue('category'),
                    'category' => $categories_ar['name'],
                    'categoryUa' => $categories_ar['nameUa'],
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                    'user' => Zend_Auth::getInstance()->getIdentity()->username,
                    'date' => time(),
                    'icon' => $form->getValue('icon'),
                );


                // Создаём объект модели
                $post = new Application_Model_DbTable_Posts();

                // Вызываем метод модели addMovie для вставки новой записи
                $post->updatePost($data);
                $this->_helper->redirector('index', 'index');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        } else {
            // Если мы выводим форму, то получаем id фильма, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $posts = new Application_Model_DbTable_Posts();
                // Заполняем форму информацией при помощи метода populate
                $form->populate($posts->getPost($id));

            }
        }
    }

    public function deleteAction()
    {
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $post = new Application_Model_DbTable_Posts();

                // Вызываем метод модели deleteMovie для удаления записи
                $post->deletePost($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('index');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $post = new Application_Model_DbTable_Posts();

            // Достаём запись и передаём в view
            $this->view->posts = $post->getPost($id);
        }
    }


    public function addpartAction()
    {

        $form = new Application_Form_Posts_Addpart();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $form->name->setLabel("Назва російською:");
            $form->nameUa->setLabel("Назва українською:");
            $form->add->setLabel("Додати розділ");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                );

                // Создаём объект модели

                $post = new Application_Model_DbTable_Part();


                // Вызываем метод модели addMovie для вставки новой записи
                $post->addPart($data);
                $this->_helper->redirector('settings', 'index');


            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

    public function editpartAction()
    {

        $form = new Application_Form_Posts_Addpart();
        $form->add->setLabel('Сохранить');
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $form->name->setLabel("Назва російською:");
            $form->nameUa->setLabel("Назва українською:");
            $form->add->setLabel("Зберегти");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'id' => (int)$form->getValue('id'),
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                );

                // Создаём объект модели

                $post = new Application_Model_DbTable_Part();


                // Вызываем метод модели addMovie для вставки новой записи
                $post->updatePart( $data);
                $this->_helper->redirector('settings', 'index');


            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        } else {

            // Если мы выводим форму, то получаем id фильма, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $parts = new Application_Model_DbTable_Part();

                // Заполняем форму информацией при помощи метода populate
                $form->populate($parts->getPart($id));
            }
        }
    }

    public function deletepartAction()
    {

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {

            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да' || $del == 'Так' ) {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $part = new Application_Model_DbTable_Part();

                // Вызываем метод модели deleteMovie для удаления записи
                $part->deletePart($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('settings', 'index');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $part = new Application_Model_DbTable_Part();

            // Достаём запись и передаём в view
            $this->view->part = $part->getPart($id);
        }
    }

    public function categoryAction()
    {
        $id = $this->_getParam('id', 0);
        if ($id > 0) {

            $post = new Application_Model_DbTable_Posts();
            $this->view->post = $post->fetchAll($post->select()->from('posts')
                ->where('categoryId = ?', $id));

        }
       /* $category = new Application_Model_DbTable_Category();
        $this->view->categories = $category->fetchAll();*/

    }

    public function addcatAction()
    {

        $form = new Application_Form_Addcat();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $form->name->setLabel("Назва російською:");
            $form->nameUa->setLabel("Назва українською:");
            $form->add->setLabel("Додати категорію");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'partId' => $form->getValue('partId'),
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                );

                // Создаём объект модели

                $category = new Application_Model_DbTable_Category();


                // Вызываем метод модели addMovie для вставки новой записи
                $category->addCategory($data);
                $this->_helper->redirector('settings', 'index');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }

    }

    public function editcatAction()
    {

        $form = new Application_Form_Addcat();
        $form->add->setLabel('Сохранить');
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $form->name->setLabel("Назва російською:");
            $form->nameUa->setLabel("Назва українською:");
            $form->add->setLabel("Зберегти");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'id' => (int)$form->getValue('id'),
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'partId' => $form->getValue('partId'),
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                );

                // Создаём объект модели

                $category = new Application_Model_DbTable_Category();


                // Вызываем метод модели addMovie для вставки новой записи
                $category->updateCategory($data);
                $this->_helper->redirector('settings', 'index');


            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        } else {

            // Если мы выводим форму, то получаем id фильма, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $category = new Application_Model_DbTable_Category();

                // Заполняем форму информацией при помощи метода populate
                $form->populate($category->getCategory($id));
            }
        }
    }


    public function deletecatAction()
    {

        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {

            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да' ||$del == 'Так' ) {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $category = new Application_Model_DbTable_Category();

                // Вызываем метод модели deleteMovie для удаления записи
                $category->deleteCategory($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('settings', 'index');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $category = new Application_Model_DbTable_Category();

            // Достаём запись и передаём в view
            $this->view->category = $category->getCategory($id);
        }
    }

    public function settingsAction()
    {
        $part = new Application_Model_DbTable_Part();
        $this->view->part = $part->fetchAll();

        $category = new Application_Model_DbTable_Category();
        $this->view->category = $category->fetchAll();

    }
    public function analyticAction()
    {

    }

    public function langAction()
    {
        $lang = $this->_getParam('lang');

        $this->getResponse()->setRawHeader(new Zend_Http_Header_SetCookie(
            'lang', $lang, NULL, '/', 'test.ru', false, true
        ));
        $this->_helper->redirector('index', 'index');
    }
}