<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'category';

    // Метод для получения записи по id
    public function getCategory($id)
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

    public function addCategory($data)
    {

        if (!$data) {
            return false;
        }
        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updateCategory($data)
    {
        if (!$data) {
            return false;
        }

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$data['id']);

    }

    public function deleteCategory($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }

    public function arrayCategory()
    {
        $result = array();
        $data = $this->fetchAll();
        foreach ($data as $row) {
            $cat = new Application_Model_Category($row);
            $result[] = $cat;
        }
        return $result;
    }

    public function arraySelect()
    {
        $array_tests = $this->fetchAll($this->select()->from('category', 'name'));
        $i = 0;
        foreach ($array_tests->toArray() as $array) {
            foreach ($array as $arg) {
                $result[$i] = $arg;
                $i++;
            }
        }

        $array_testss = $this->fetchAll($this->select()->from('category', 'id'));
        $i = 0;
        foreach ($array_testss->toArray() as $array) {
            foreach ($array as $arg) {
                $results[$i] = $arg;
                $i++;
            }
        }
        return array_combine($results, $result);
    }

}

?>