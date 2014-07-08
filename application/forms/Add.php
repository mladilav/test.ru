<?php
echo 11;
exit;

class Application_Form_Posts_Addpart extends Zend_Form
{
    public function init()
    {

        // указываем имя формы
        $this->setName('addArticle');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
        $id = new Zend_Form_Element_Hidden('id');
        // Указываем, что данные в этом элементе фильтруются как число int
        $id->addFilter('Int');
        // создаём текстовый элемент
        $title = new Zend_Form_Element_Text('title');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $title->setLabel('Название:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $icon = new Zend_Form_Element_Text('icon');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $icon->setLabel('Картинка:')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        $description = new Zend_Form_Element_Textarea('description');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $description
            ->setLabel('Краткое описание')
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        // создаём элемент формы для пароля
        $text = new Zend_Form_Element_Textarea('text');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $text
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $category = new Zend_Form_Element_Select('category');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $category->setLabel('Рубрика:')
            ->addMultiOptions(array(
                '0' => '0',
                '1' => '1',
                '2' => '2'
            ));

        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить');

        // добавляем элементы в форму
        $this->addElements(array($id, $title, $icon, $description, $text, $category, $submit));
        // указываем метод передачи данных
        $this->setMethod('post');

    }
}

