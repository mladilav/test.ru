<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */


    }

    public function indexAction()
    {
        // action bod


    }

    public function editAction()
    {


        $form = new Application_Form_Edit();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $username = $form->getValue('username');
                $password = md5($form->getValue('password'));
                $password_rep = md5($form->getValue('password_rep'));
                $email = $form->getValue('email');
                $photo = $form->getValue('photo');
                $gender = $form->getValue('gender');
                $vk = Zend_Auth::getInstance()->getIdentity()->vk;
                $tw = Zend_Auth::getInstance()->getIdentity()->tw;
                $fc = Zend_Auth::getInstance()->getIdentity()->fc;
                $date_reg = Zend_Auth::getInstance()->getIdentity()->date_reg;
                $role = Zend_Auth::getInstance()->getIdentity()->role;
                // Создаём объект модели

                $user = new Application_Model_DbTable_User();

                $id = Zend_Auth::getInstance()->getIdentity()->id;
                // Вызываем метод модели addMovie для вставки новой записи
                $user->updateUser($id, $username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw);

                // Используем библиотечный helper для редиректа на action = index

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

    public function profileAction()
    {


    }
}
