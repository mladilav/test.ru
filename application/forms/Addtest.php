<?php

class Application_Form_Addtest extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('addTest');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $int = new Zend_Form_Element_Hidden('int');
        // создаём текстовый элемент
        $name = new Zend_Form_Element_Text('name');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $name->setLabel('Название теста на русском:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $nameUa = new Zend_Form_Element_Text('nameUa');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $nameUa->setLabel('Название теста на украинском:')
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
                '0' => 'Легкий уровень',
                '2' => 'Средний уровень',
                '3' => 'Тяжелый уровень',
                '4' => 'Задачи',
                '5' => 'Экспресс тест'
            ));


        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить тест')
            ->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($int, $name, $nameUa, $type, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

