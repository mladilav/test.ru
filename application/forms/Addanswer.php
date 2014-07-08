<?php

class Application_Form_Addanswer extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('addAnswer');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // создаём текстовый элемент
        $name = new Zend_Form_Element_Text('name');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $name->setLabel('Ответ:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );


        $bool = new Zend_Form_Element_Select('bool');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $bool->setLabel('Вариант:')
            ->addMultiOptions(array(
                '0' => 'Неправильный',
                '1' => 'Правильный',
            ));


        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить ответ');
        // добавляем элементы в форму
        $this->addElements(array($id, $name, $bool, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

