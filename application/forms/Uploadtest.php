<?php

class Application_Form_Uploadtest extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('addUploadTest');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // создаём текстовый элемент



        $file = new Zend_Form_Element_File('file');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $file->setLabel('Файл:')
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $type = new Zend_Form_Element_Select('type');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $type->setLabel('Тип:')
            ->addMultiOptions(array(
                '0' => 'Легкий уровень',
                '2' => 'Средний уровень',
                '3' => 'Тяжелый уровень',
                '4' => 'Задачи'
            ))
            ->addFilter('StripTags')
            ->addFilter('StringTrim');



        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Загрузить');

        // добавляем элементы в форму
        $this->addElements(array($id, $file, $type, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

