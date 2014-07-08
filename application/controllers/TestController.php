<?php

class TestController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        $test = new Application_Model_DbTable_Test();
        $this->view->tests = $test->fetchAll();

    }

    public function addtestAction()
    {
        $form = new Application_Form_Addtest();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $type = $form->getValue('type');
                $userId = Zend_Auth::getInstance()->getIdentity()->id;
                $author = Zend_Auth::getInstance()->getIdentity()->username;

                // Создаём объект модели

                $test = new Application_Model_DbTable_Test();


                // Вызываем метод модели addMovie для вставки новой записи
                $test->addTest($name, $type, $author, $userId);
                $this->_helper->redirector('addquestion', 'test');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

    public function questionAction()
    {
        $_SESSION['test']['testId'] = '';
    }

    public function addquestionAction()
    {
        $form = new Application_Form_Addquestion();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $type = $form->getValue('type');
                $topicId = $form->getValue('topicId');
                $testId = $form->getValue('testId');
                // Создаём объект модели

                $question = new Application_Model_DbTable_Question();


                // Вызываем метод модели addMovie для вставки новой записи
                $question->addQuestion($name, $type, $topicId, $testId);

                $this->_helper->redirector('addanswer', 'test');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }


    public function addanswerAction()
    {
        $form = new Application_Form_Addanswer();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {

            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $name = $form->getValue('name');
                $bool = $form->getValue('bool');


                // Создаём объект модели

                $answer = new Application_Model_DbTable_Answer();
                $question = new Application_Model_DbTable_Question();


                // Вызываем метод модели addMovie для вставки новой записи
                $answer->addAnswer($name, $bool, $question->currentQuestion());
                $this->_helper->redirector('addanswer', 'test');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

}