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
        $row = $this->fetchRow('id = ' . $id);

        // Если результат пустой, выкидываем исключение
        if (!$row) {
            throw new Exception("Нет записи с id - $id");
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }

    public function addTest($name,$type,$author, $userId)
    {

        $data = array(
            'name' => $name,
            'author'=> $author,
            'userId' => $userId,
            'type' => $type,

        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updateTest($id, $name,$type,$author, $userId)
    {
        // Формируем массив значений
        $data = array(
            'name' => $name,
            'author'=> $author,
            'userId' => $userId,
            'type' => $type,
        );

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);

    }

    public function deleteTest($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }
    public function arrayTest()
    {
        $array_tests = $this->fetchAll($this->select()->from('test','name'));
        $i = 0;
        foreach ($array_tests->toArray() as $array){
            foreach($array as $arg){
                $result[$i] = $arg;
                $i++;
            }
        }

        $array_testss = $this->fetchAll($this->select()->from('test','int'));
        $i = 0;
        foreach ($array_testss->toArray() as $array){
            foreach($array as $arg){
                $results[$i] = $arg;
                $i++;
            }
        }


        return array_combine($results, $result);
    }
}

?>