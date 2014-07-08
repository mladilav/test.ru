<?php

class Application_Form_Registration extends Zend_Form
{
    public function init()
    {

        // указываем имя формы
        $this->setName('registration');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';

        // создаём текстовый элемент
        $username = new Zend_Form_Element_Text('username');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $username->setLabel('Логин:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // создаём элемент формы для пароля
        $password = new Zend_Form_Element_Password('password');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $password->setLabel('Пароль:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );


        $password_rep = new Zend_Form_Element_Password('password_rep');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $password_rep->setLabel('Повторите пароль:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $email = new Zend_Form_Element_Text('email');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $email->setLabel('Email:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $photo = new Zend_Form_Element_Text('photo');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $photo->setLabel('Аватар:')
            ->addFilter('StringTrim');

        $gender = new Zend_Form_Element_Select('gender');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $gender->setLabel('Пол:')
            ->addMultiOptions(array(
                'Gender' => 'Gender',
                'Male' => 'Male',
                'Female' => 'Female'
            ));

        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('registration');
        $submit->setLabel('Зарегистрироваться ');

        // добавляем элементы в форму
        $this->addElements(array($username, $password, $password_rep, $email, $photo, $gender, $submit));

        // указываем метод передачи данных
        $this->setMethod('post');

    }
}

