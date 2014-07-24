<?php


class Application_Form_Typequestion extends Zend_Form
{
    public function init()
    {

        // указываем имя формы

        $type = new Zend_Form_Element_Select('type');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $type->setLabel('Сложность вопроса: ')
            ->addMultiOptions(array(
                '0' => 'Легкий уровень',
                '1' => 'Средний уровень',
                '2' => 'Тяжелый уровень',
                '3' => 'Задача',
            ))
            ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Далее')->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($type, $submit));
        // указываем метод передачи данных
        $this->setMethod('post');

    }
}

