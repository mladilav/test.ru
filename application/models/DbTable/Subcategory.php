<?php

class Application_Model_DbTable_Subcategory extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'subcategory';

    // Метод для получения записи по id
    public function getSubcategory($id)
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

    public function addSubcategory($data)
    {

        if (!$data) {
            return false;
        }
        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updateSubcategory($data)
    {
        if (!$data) {
            return false;
        }

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$data['id']);

    }

    public function deleteSubcategory($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }

    public function arraySubcategory($catId)
    {
        $result = array();
        $data = $this->fetchAll('categoryId ='.$catId);
        if(!$data){
            return false;
        }
        foreach ($data as $row) {
            $cat = new Application_Model_Subcategory($row);
            $result[] = $cat;
        }
        return $result;
    }

    public function arraySelect()
    {
        $array_tests = $this->fetchAll($this->select()->from('subcategory', 'name'));
        $i = 1;
        $result[0] = 'Без подкатегории';
        $results[0] = 0;
        foreach ($array_tests->toArray() as $array) {
            foreach ($array as $arg) {
                $result[$i] = $arg;
                $i++;
            }
        }

        $array_testss = $this->fetchAll($this->select()->from('subcategory', 'id'));
        $i = 1;
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