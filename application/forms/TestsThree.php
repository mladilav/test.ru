<?php


class Application_Form_TestsThree extends Zend_Form
{
    public function init()
    {

        // указываем имя формы

        $answerOne = new Zend_Form_Element_Select('answerOne');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answerOne->setLabel('1:')
            ->addMultiOptions(array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ))
            ->setSeparator(' ')
            ->setRequired(true);

        $answerTwo = new Zend_Form_Element_Select('answerTwo');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answerTwo->setLabel('2:')
            ->addMultiOptions(array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ))
            ->setSeparator(' ')
            ->setRequired(true);

        $answerThree = new Zend_Form_Element_Select('answerThree');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answerThree->setLabel('3:')
            ->addMultiOptions(array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ))
            ->setSeparator(' ')
            ->setRequired(true);



        $submit = new Zend_Form_Element_Submit('add');
        $submit->setAttrib('class','btn btn-success')->setLabel('Далее');


        // добавляем элементы в форму
        $this->addElements(array($answerOne,$answerTwo,$answerThree, $submit));
        // указываем метод передачи данных
        $this->setMethod('post');


    }
}

