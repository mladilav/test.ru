<?php

class Application_Form_Build extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('build');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // создаём текстовый элемент
        $question = new Zend_Form_Element_Text('search');


        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $question->setLabel('Вопрос:')
            ->setRequired(true)
            ->setAttrib('autocomplete','off')
            ->setAttrib('style','width: 98%')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );


        // создаём кнопку submit

        // добавляем элементы в форму
        $this->addElements(array($id,$question));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

