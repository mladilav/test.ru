<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {

        $post = new Application_Model_DbTable_Blog();
        $this->view->posts = $post->fetchAll();

    }

    public function addAction()
    {
        $form = new Application_Form_Add();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $title = $form->getValue('title');
                $icon = $form->getValue('icon');
                $text = $form->getValue('text');
                $category = $form->getValue('category');
                $description = $form->getValue('description');
                $author = Zend_Auth::getInstance()->getIdentity()->id;

                // Создаём объект модели

                $post = new Application_Model_DbTable_Blog();


                // Вызываем метод модели addMovie для вставки новой записи
                $post->addPost($title, $icon, $description, $text, $category, $author);
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
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $title = $form->getValue('title');
                $text = $form->getValue('text');
                $icon = $form->getValue('icon');
                $category = $form->getValue('category');
                $description = $form->getValue('description');
                $author = Zend_Auth::getInstance()->getIdentity()->id;
                $id = (int)$form->getValue('id');


                // Создаём объект модели
                $post = new Application_Model_DbTable_Blog();

                // Вызываем метод модели addMovie для вставки новой записи
                $post->updatePost($id, $title, $icon, $description, $text, $category, $author);
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
                $posts = new Application_Model_DbTable_Blog();

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
                $post = new Application_Model_DbTable_Blog();

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
            $post = new Application_Model_DbTable_Blog();

            // Достаём запись и передаём в view
            $form->populate($post->getPost($id));
        }
    }

    public function partAction()
    {

        $part = new Application_Model_DbTable_Part();
        $this->view->parts = $part->fetchAll();

    }

    public function addpartAction()
    {

        $form = new Application_Form_Posts_Addpart();

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $userId = Zend_Auth::getInstance()->getIdentity()->id;

                // Создаём объект модели

                $post = new Application_Model_DbTable_Part();


                // Вызываем метод модели addMovie для вставки новой записи
                $post->addPart($name, $userId);
                $this->_helper->redirector('part', 'index');


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

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $userId = Zend_Auth::getInstance()->getIdentity()->id;
                $id = (int)$form->getValue('id');

                // Создаём объект модели

                $post = new Application_Model_DbTable_Part();


                // Вызываем метод модели addMovie для вставки новой записи
                $post->updatePart($id, $name, $userId);
                $this->_helper->redirector('part', 'index');


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
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $part = new Application_Model_DbTable_Part();

                // Вызываем метод модели deleteMovie для удаления записи
                $part->deletePart($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('part', 'index');
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

        $category = new Application_Model_DbTable_Category();
        $this->view->categories = $category->fetchAll();

    }

    public function addcatAction()
    {

        $form = new Application_Form_Addcat();

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $partId = $form->getValue('partId');
                $userId = Zend_Auth::getInstance()->getIdentity()->id;

                // Создаём объект модели

                $category = new Application_Model_DbTable_Category();


                // Вызываем метод модели addMovie для вставки новой записи
                $category->addCategory($name, $userId, $partId);
                $this->_helper->redirector('category', 'index');

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

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $partId = $form->getValue('partId');
                $userId = Zend_Auth::getInstance()->getIdentity()->id;
                $id = (int)$form->getValue('id');

                // Создаём объект модели

                $category = new Application_Model_DbTable_Category();


                // Вызываем метод модели addMovie для вставки новой записи
                $category->updateCategory($id, $name, $userId, $partId);
                $this->_helper->redirector('category', 'index');


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
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $category = new Application_Model_DbTable_Category();

                // Вызываем метод модели deleteMovie для удаления записи
                $category->deleteCategory($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('category', 'index');
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

}