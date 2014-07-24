<?php

class Application_Form_Addcat extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('addPart');

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
        $partId = new Zend_Form_Element_Select('partId');
        $parts = new Application_Model_DbTable_Part();
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $partId->setLabel('Раздел:')
            ->addMultiOptions($parts->arrayParts());


        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить категорию')
            ->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($id, $name,$nameUa, $partId, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

