<?php

class Application_Model_DbTable_Blog extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'posts';

    // Метод для получения записи по id
    public function getPost($id)
    {
        // Получаем id как параметр
        $id = (int)$id;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('id = ' . $id);

        // Если результат пустой, выкидываем исключение
        if (!$row) {
            throw new Exception("Нет записи с id - $id");
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }

    public function addPost($title, $icon, $description, $text, $category, $author)
    {

        $data = array(
            'title' => $title,
            'description' => $description,
            'body' => $text,
            'categoryId' => $category,
            'userId' => $author,
            'date' => time(),
            'icon' => $icon,

        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updatePost($id, $title, $icon, $description, $text, $category, $author)
    {
        // Формируем массив значений
        $data = array(
            'title' => $title,
            'description' => $description,
            'body' => $text,
            'categoryId' => $category,
            'userId' => $author,
            'date' => time(),
            'icon' => $icon,

        );

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);

    }

    public function deletePost($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }
}

?>