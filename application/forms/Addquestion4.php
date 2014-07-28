<?php

class Application_Form_Addquestion4 extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('addQuestion');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // создаём текстовый элемент


        $name = new Zend_Form_Element_Text('name');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $name->setLabel('Вопрос на русском:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $nameUa = new Zend_Form_Element_Text('nameUa');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $nameUa->setLabel('Вопрос на украинском:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $capture = new Zend_Form_Element_Text('capture');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $capture->setLabel(' Ссылка на картинку (url): *Если вопрос с картинкой')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $topics = new Application_Model_DbTable_Topic();
        $topic = new Zend_Form_Element_Select('topic');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $topic->setLabel('Тема:')
            ->addMultiOptions($topics->arraySelect());

        $answer = new Zend_Form_Element_Text('answer');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answer->setLabel('Правильный ответ:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $cost = new Zend_Form_Element_Text('cost');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $cost->setLabel('Количество баллов за ответ:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );


        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить вопрос')->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($id, $name,$nameUa,$capture, $topic, $answer, $cost, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

