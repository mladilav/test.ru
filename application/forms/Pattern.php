<?php

class Application_Form_Pattern extends Zend_Form
{
    public function init()
    {
        // указываем имя формы
        $this->setName('login');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';

        // создаём текстовый элемент
        $name = new Zend_Form_Element_Text('name');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $name->setLabel('Название шаблона:')
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
        $text->setLabel('Описание:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        // создаём кнопку submit

        $typeOneClass6 = new Zend_Form_Element_Text('typeOneClass6');
        $typeOneClass6->setLabel('Количество вопросов из 6 класса легкого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeOneClass7 = new Zend_Form_Element_Text('typeOneClass7');
        $typeOneClass7->setLabel('Количество вопросов из 7 класса легкого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeOneClass8 = new Zend_Form_Element_Text('typeOneClass8');
        $typeOneClass8->setLabel('Количество вопросов из 8 класса легкого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeOneClass9 = new Zend_Form_Element_Text('typeOneClass9');
        $typeOneClass9->setLabel('Количество вопросов из 9 класса легкого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeOneClass10 = new Zend_Form_Element_Text('typeOneClass10');
        $typeOneClass10->setLabel('Количество вопросов из 10 класса легкого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);




        $typeTwoClass6 = new Zend_Form_Element_Text('typeTwoClass6');
        $typeTwoClass6->setLabel('Количество вопросов из 6 класса среднего уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeTwoClass7 = new Zend_Form_Element_Text('typeTwoClass7');
        $typeTwoClass7->setLabel('Количество вопросов из 7 класса среднего уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeTwoClass8 = new Zend_Form_Element_Text('typeTwoClass8');
        $typeTwoClass8->setLabel('Количество вопросов из 8 класса среднего уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeTwoClass9 = new Zend_Form_Element_Text('typeTwoClass9');
        $typeTwoClass9->setLabel('Количество вопросов из 9 класса среднего уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeTwoClass10 = new Zend_Form_Element_Text('typeTwoClass10');
        $typeTwoClass10->setLabel('Количество вопросов из 10 класса среднего уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);


        $typeThreeClass6 = new Zend_Form_Element_Text('typeThreeClass6');
        $typeThreeClass6->setLabel('Количество вопросов из 6 класса тяжелого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeThreeClass7 = new Zend_Form_Element_Text('typeThreeClass7');
        $typeThreeClass7->setLabel('Количество вопросов из 7 класса тяжелого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeThreeClass8 = new Zend_Form_Element_Text('typeThreeClass8');
        $typeThreeClass8->setLabel('Количество вопросов из 8 класса тяжелого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeThreeClass9 = new Zend_Form_Element_Text('typeThreeClass9');
        $typeThreeClass9->setLabel('Количество вопросов из 9 класса тяжелого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeThreeClass10 = new Zend_Form_Element_Text('typeThreeClass10');
        $typeThreeClass10->setLabel('Количество вопросов из 10 класса тяжелого уровня')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);


        $typeFourClass6 = new Zend_Form_Element_Text('typeFourClass6');
        $typeFourClass6->setLabel('Количество задач из 6 класса')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeFourClass7 = new Zend_Form_Element_Text('typeFourClass7');
        $typeFourClass7->setLabel('Количество задач из 7 класса')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeFourClass8 = new Zend_Form_Element_Text('typeFourClass8');
        $typeFourClass8->setLabel('Количество задач из 8 класса')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeFourClass9 = new Zend_Form_Element_Text('typeFourClass9');
        $typeFourClass9->setLabel('Количество задач из 9 класса')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);
        $typeFourClass10 = new Zend_Form_Element_Text('typeFourClass10');
        $typeFourClass10->setLabel('Количество задач из 10 класса')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setValue(0);

        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Сохранить')
            ->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($name, $text, $typeOneClass6,$typeOneClass7,$typeOneClass8,$typeOneClass9,$typeOneClass10,
            $typeTwoClass6, $typeTwoClass7,  $typeTwoClass8, $typeTwoClass9, $typeTwoClass10,$typeThreeClass6,
            $typeThreeClass7,$typeThreeClass8,$typeThreeClass9,$typeThreeClass10, $typeFourClass6, $typeFourClass7,
            $typeFourClass8, $typeFourClass9, $typeFourClass10,$submit));

        // указываем метод передачи данных
        $this->setMethod('post');
    }
}

