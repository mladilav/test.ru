<?php


class Application_Form_TestsOne extends Zend_Form
{
    public function init()
    {
        $this->setName('testOne');
        $answer = new Zend_Form_Element_Radio('answer');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answer->setName('answer')
            ->addMultiOptions(array(
                '0' => 'A',
                '1' => 'Б',
                '2' => 'В',
                '3' => 'Г'
            ))
            ->setSeparator(' ')
            ->setRequired(true);


        $submit = new Zend_Form_Element_Submit('add');
        $submit->setAttrib('class','btn btn-success')->setLabel('Далее');


        // добавляем элементы в форму
        $this->addElements(array($answer, $submit));
        // указываем метод передачи данных
        $this->setMethod('post');

        // указываем имя формы


    }
}

