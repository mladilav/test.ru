<?php

class Application_Model_DbTable_Homework extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'homework';


    // Метод для получения записи по id
    public function getHomework($id)
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

    public function addHomework($data)
    {

        if (!$data) {
            return false;
        }
        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updateHomework($data)
    {
        if (!$data) {
            return false;
        }

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$data['id']);

    }

    public function deleteHomework($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }




    public function getPaginatorRows($pageNumber = 1) {
        $pagi = new Zend_Paginator_Adapter_DbSelect($this->select()->from('homework'));
        $paginator = new Zend_Paginator($pagi);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(1);
        return $paginator;
    }

}

?>