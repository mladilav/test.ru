<?php

class Application_Form_Addtest extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('addTest');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // создаём текстовый элемент
        $name = new Zend_Form_Element_Text('name');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $name->setLabel('Название теста:')
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



        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить тест');

        // добавляем элементы в форму
        $this->addElements(array($id, $name,  $type, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

