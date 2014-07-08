<?php

class Application_Form_Posts_Addpart extends Zend_Form
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
        $name->setLabel('Название:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );


        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить раздел');

        // добавляем элементы в форму
        $this->addElements(array($id, $name, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

