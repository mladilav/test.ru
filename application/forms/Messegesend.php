<?php

class Application_Form_Messegesend extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('messegeSend');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';

        // создаём текстовый элемент
        $caption = new Zend_Form_Element_Text('caption');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $caption->setLabel('Заголовок:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // создаём элемент формы для пароля
        $text = new Zend_Form_Element_Textarea('text');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $text->setLabel('Текст:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('send');
        $submit->setLabel('Отправить')
            ->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($caption, $text, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

