<?php

class Application_Form_Addsubcat extends Zend_Form
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
        $categoryId = new Zend_Form_Element_Select('categoryId');
        $category= new Application_Model_DbTable_Category();
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $categoryId->setLabel('Категория:')
            ->addMultiOptions($category->arraySelect());


        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить подкатегорию')
            ->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($id, $name,$nameUa, $categoryId, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

