<?php

class Application_Model_DbTable_Test extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'test';

    // Метод для получения записи по id
    public function getTest($id)
    {
        // Получаем id как параметр
        $id = (int)$id;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('`int` = ' . $id);

        // Если результат пустой, выкидываем исключение
        if (!$row) {
            throw new Exception("Нет записи с id - $id");
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }

    public function addTest($data)
    {
        if(!$data)
        {return false;}

        // Используем метод insert для вставки записи в базу
        $this->insert($data);
        return true;

    }

    public function updateTest($data)
    {
        if(!$data)
        {return false;}
        $this->update($data, '`int` = ' . (int)$data['int']);
        return true;

    }

    public function deleteTest($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('`int` = ' . (int)$id);
    }

    public function arrayTest()
    {
        $array_tests = $this->fetchAll($this->select()->from('test', 'name'));
        foreach ($array_tests->toArray() as $array) {
            foreach ($array as $arg) {
                $result[] = $arg;

            }
        }

        $array_testss = $this->fetchAll($this->select()->from('test', 'int'));

        foreach ($array_testss->toArray() as $array) {
            foreach ($array as $arg) {
                $results[] = $arg;
            }
        }

        return array_combine($results, $result);
    }

    public function arrayObjectsTest($type)
    {
        $result = array();
        $data = $this->fetchAll($this->select()
            ->from('test')
            ->where('type = ?', (int)$type));
        foreach ($data as $row) {
            $user = new Application_Model_Tests($row);
            $result[] = $user;
        }
        return $result;
    }

    public function currentTest()
    {
        $array_tests = $this->fetchAll($this->select()->from('test', 'int'));
        $i = 0;
        foreach ($array_tests->toArray() as $array) {
            foreach ($array as $arg) {
                $result[$i] = $arg;
                $i++;
            }
        }
        return $result[$i - 1];
    }
}


?>