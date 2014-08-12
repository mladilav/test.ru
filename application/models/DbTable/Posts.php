<?php


class Application_Model_DbTable_Posts extends Zend_Db_Table_Abstract
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

    public function addPost($data)
    {
        if (!$data) {
            return false;
        }

        // Используем метод insert для вставки записи в базу

        $this->insert($data);
        return true;

    }

    public function updatePost($data)
    {
        // Формируем массив значений
        if (!$data) {
            return false;
        }

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$data['id']);
        return true;

    }

    public function deletePost($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }
    public function getPostByCategory($categoryId)
    {

        $result = array();
        $data = $this->fetchAll($this->select()
            ->from('posts')
            ->where('categoryId = ?', $categoryId));
        foreach ($data as $row) {
            $post = new Application_Model_Posts($row);
            $result[] = $post;
        }
        return $result;
    }

    public function getPaginatorRows($pageNumber = 1) {
        $pagi = new Zend_Paginator_Adapter_DbSelect($this->select()->from('posts')->order('date DESC'));
        $paginator = new Zend_Paginator($pagi);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage(5);
        $paginator->setPageRange(1);
        return $paginator;
    }
}

?>