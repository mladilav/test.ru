<?php


class Application_Form_TestsTwo extends Zend_Form
{
    public function init()
    {

        // указываем имя формы
        $this->setName('testTwo');
        $answerOne = new Zend_Form_Element_Select('answerOne');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answerOne->setLabel('1')
            ->addMultiOptions(array(
                '0' => 'A',
                '1' => 'Б',
                '2' => 'В',
                '3' => 'Г',
                '4' => 'Д'
            ))
            ->setSeparator(' ')
            ->setRequired(true);

        $answerTwo = new Zend_Form_Element_Select('answerTwo');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answerTwo->setLabel('2')
            ->addMultiOptions(array(
                '0' => 'A',
                '1' => 'Б',
                '2' => 'В',
                '3' => 'Г',
                '4' => 'Д'
            ))
            ->setSeparator(' ')
            ->setRequired(true);

        $answerThree = new Zend_Form_Element_Select('answerThree');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answerThree->setLabel('3')
            ->addMultiOptions(array(
                '0' => 'A',
                '1' => 'Б',
                '2' => 'В',
                '3' => 'Г',
                '4' => 'Д'
            ))
            ->setSeparator(' ')
            ->setRequired(true);

        $answerFour = new Zend_Form_Element_Select('answerFour');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $answerFour->setLabel('4')
            ->addMultiOptions(array(
                '0' => 'A',
                '1' => 'Б',
                '2' => 'В',
                '3' => 'Г',
                '4' => 'Д'
            ))
            ->setSeparator(' ')
            ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('add');
        $submit->setAttrib('class','btn btn-success')->setLabel('Далее');

        // добавляем элементы в форму
        $this->addElements(array($answerOne,$answerTwo,$answerThree, $answerFour, $submit));
        // указываем метод передачи данных
        $this->setMethod('post');


    }
}

