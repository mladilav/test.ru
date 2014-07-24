<?php


class Application_Form_Add extends Zend_Form
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
        $title->setLabel('Название на русском:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $titleUa = new Zend_Form_Element_Text('titleUa');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $titleUa->setLabel('Название на украинском:')
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
            ->setLabel('Краткое описание на русском')
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $descriptionUa = new Zend_Form_Element_Textarea('descriptionUa');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $descriptionUa
            ->setLabel('Краткое описание на украинском')
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $textUa = new Zend_Form_Element_Textarea('bodyUa');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $textUa->setLabel("Текст на украинском")
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        // создаём элемент формы для пароля
        $text = new Zend_Form_Element_Textarea('body');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $text->setLabel("Текст на русском")
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        $categories = new Application_Model_DbTable_Category();
        $category = new Zend_Form_Element_Select('category');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $category->setLabel('Рубрика:')
            ->addMultiOptions($categories->arraySelect());

        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить статью')
               ->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($id, $title,$titleUa, $icon,$category, $description,$descriptionUa, $text,$textUa, $submit));
        // указываем метод передачи данных
        $this->setMethod('post');

    }
}

