<?php

class Application_Form_Addquestion extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('addQuestion');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // создаём текстовый элемент
        $name = new Zend_Form_Element_Text('name');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $name->setLabel('Вопрос:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        $type = new Zend_Form_Element_Select('type');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $type->setLabel('Тип:')
            ->addMultiOptions(array(
                '0' => '0',
                '1' => '1',
                '2' => '2'
            ));

        $topicId = new Zend_Form_Element_Select('topicId');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $topicId->setLabel('Тема:')
            ->addMultiOptions(array(
                '0' => '0',
                '1' => '1',
                '2' => '2'
            ));
        $testId = new Zend_Form_Element_Select('testId');

        $tests = new Application_Model_DbTable_Test();

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $testId->setLabel('Тест:')
            ->addMultiOptions($tests->arrayTest());

        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить вопрос');

        // добавляем элементы в форму
        $this->addElements(array($id, $name,$type, $topicId,$testId, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

