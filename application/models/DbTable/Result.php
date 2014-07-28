<?php


class Application_Model_DbTable_Result extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'result';


    public function getResult($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = '.$id);

        // Если результат пустой, выкидываем исключение
        if (!$row) {
            return false;
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }

    public function addResult($data)
    {

        if(!$data){
            return false;
        }

        $result = $this->fetchAll('testId = '.$data['testId'].' AND userId = '.$data['userId']);
        if ($result->count() != 0)
        {
            $test = new Application_Model_DbTable_Test();
            $testArray = $test->getTest($data['testId']);
            if($testArray['topicId'] == 1){
            $this->update($data, 'testId = '.$data['testId'].' AND userId = '.$data['userId']);
            return true;
            }
            else {return false;}

        } else {
        $this->insert($data);
        return true;}

    }

    public function updateResult($data)
    {
        // Формируем массив значений
        if(!$data)
        {
            return false;
        }

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$data['id']);
        return true;

    }

    public function deleteResult($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }

    public function arrayResult($testId)
    {
        $result = array();
        $data = $this->fetchAll();
        foreach ($data as $row) {
            $user = new Application_Model_Result($row);
            $result[] = $user;
        }
        return $result;
    }




}

?>