<?php


class Application_Model_DbTable_Topic extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'topic';

    // Метод для получения записи по id
    public function getTopic($name)
    {

        $row = $this->fetchRow('`name` = "'.$name.'"');

        // Если результат пустой, выкидываем исключение
        if (!$row) {
            $data = array('name'=> $name);
            $this->addTopic($data);
            return $this->getTopic($name);

        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }
    public function getTopicId($id)
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

    public function addTopic($data)
    {

        if(!$data){
            return false;
        }

        // Используем метод insert для вставки записи в базу
        $this->insert($data);
        return true;

    }

    public function updateTopic($data)
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

    public function deleteTopic($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }

    public function arrayTopic()
    {
        $result = array();
        $data = $this->fetchAll();
        foreach ($data as $row) {
            $user = new Application_Model_Topic($row);
            $result[] = $user;
        }
        return $result;
    }




}

?>