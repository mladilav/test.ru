<?php

class Application_Form_Addhomework extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('addHomework');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // создаём текстовый элемент
        $name = new Zend_Form_Element_Text('name');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $name->setLabel('Название на русском:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $nameUa = new Zend_Form_Element_Text('nameUa');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $nameUa->setLabel('Название на украинском:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );


        $file = new Zend_Form_Element_File('file');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $file->setLabel('Файл:')
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $text = new Zend_Form_Element_Textarea('text');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $text->setLabel('Текст:');

        $test = new Application_Model_DbTable_Test();

        $testId = new Zend_Form_Element_Select('testId');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $testId->setLabel('Тест:')
            ->addMultiOptions($test->arrayTest())
            ->addFilter('StripTags')
            ->addFilter('StringTrim');


        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить домашнее задание');

        // добавляем элементы в форму
        $this->addElements(array($id, $name, $nameUa, $file, $text,$testId,$submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

