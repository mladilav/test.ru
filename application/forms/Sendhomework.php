<?php

class Application_Form_Sendhomework extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('sendHomework');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // создаём текстовый элемент
        $group = new Zend_Form_Element_Select('group');
        $groups = new Application_Model_DbTable_Groups();
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $group->setLabel('Группе:')
            ->addMultiOptions($groups->arraySelect())
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );


        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Отправить');
        // добавляем элементы в форму
        $this->addElements(array($id, $group, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

