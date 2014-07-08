<?php

class Application_Model_DbTable_Answer extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'answer';

    // Метод для получения записи по id
    public function getAnswer($id)
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

    public function addAnswer($name,$bool,$questionId)
    {

        $data = array(
            'answer' => $name,
            'bool' => $bool,
            'questionId' => $questionId,

        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updateAnswer($id, $name, $bool,$questionId)
    {
        // Формируем массив значений
        $data = array(
            'answer' => $name,
            'bool' => $bool,
            'questionId' => $questionId,

        );

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);

    }

    public function deleteAnswer($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }

    public function arrayAnswer()
    {
        $array_tests = $this->fetchAll($this->select()->from('question', 'name'));
        $i = 0;
        foreach ($array_tests->toArray() as $array) {
            foreach ($array as $arg) {
                $result[$i] = $arg;
                $i++;
            }
        }
        return $result;
    }



}

?>