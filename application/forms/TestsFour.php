<?php


class Application_Form_TestsFour extends Zend_Form
{
    public function init()
    {
        $answer = new Zend_Form_Element_Text('answer');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answer->setRequired(true);

        $submit = new Zend_Form_Element_Submit('add');
        $submit->setAttrib('class','btn btn-success')->setLabel('Далее');

        // добавляем элементы в форму
        $this->addElements(array($answer, $submit));
        // указываем метод передачи данных
        $this->setMethod('post');

        // указываем имя формы


    }
}

