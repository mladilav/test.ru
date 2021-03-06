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
        $parts = new Application_Model_DbTable_Part();
        $part = new Zend_Form_Element_Select('partId');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $part->setLabel('Раздел:')
            ->addMultiOptions($parts->arrayParts());


        $categories = new Application_Model_DbTable_Category();
        $category = new Zend_Form_Element_Select('categoryId');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $category->setLabel('Категория:')
            ->addMultiOptions($categories->arraySelect());

        $subcategories = new Application_Model_DbTable_Subcategory();
        $subcategory = new Zend_Form_Element_Select('subcategoryId');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $subcategory->setLabel('Подкатегория:')
            ->addMultiOptions($subcategories->arraySelect());


        $descriptionTeg = new Zend_Form_Element_Text('descriptionTeg');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $descriptionTeg->setLabel('Description:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $keywords = new Zend_Form_Element_Text('keywords');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $keywords->setLabel('Keywords:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('add');
        $submit->setLabel('Добавить статью')
               ->setAttrib('class','btn btn-success');

        // добавляем элементы в форму
        $this->addElements(array($id, $title,$titleUa, $icon,$part,$category, $subcategory, $description,$descriptionUa,
            $text,$textUa, $keywords,$descriptionTeg, $submit));
        // указываем метод передачи данных
        $this->setMethod('post');

    }
}

